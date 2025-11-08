import os
import sqlite3
import time
import threading
import logging
from datetime import datetime, date
from io import BytesIO

import telebot
from telebot import types

# ================= CONFIG =================
BOT_TOKEN = "7536258844:AAHmqPjTHCv87rsmxk6OlQx_NPAjOF2hRhY"   # <-- shu joyga tokenni qo'ying
ADMIN_ID = 8077059920               # <-- shu joyga o'zingizning Telegram ID (son)
DB_PATH = "bot_master.db"
LOG_FILE = "bot_master.log"

BROADCAST_DELAY = 0.05  # sekundlar (broadcast vaqtida)
# ==========================================

# ================ LOGGING =================
logging.basicConfig(level=logging.INFO,
                    format="%(asctime)s [%(levelname)s] %(message)s",
                    handlers=[logging.FileHandler(LOG_FILE, encoding='utf-8'), logging.StreamHandler()])
logger = logging.getLogger(__name__)

# ================= BOT INIT ==============
bot = telebot.TeleBot(BOT_TOKEN, parse_mode='HTML')

# ================ DB HELPERS =============
def init_db():
    conn = sqlite3.connect(DB_PATH)
    c = conn.cursor()
    # users
    c.execute('''
        CREATE TABLE IF NOT EXISTS users (
            user_id INTEGER PRIMARY KEY,
            username TEXT,
            first_name TEXT,
            last_name TEXT,
            joined_at TEXT
        )
    ''')
    # buttons (dynamic buttons added by admin)
    c.execute('''
        CREATE TABLE IF NOT EXISTS buttons (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT UNIQUE,
            type TEXT,    -- text, photo, video, document, sticker
            content TEXT,
            created_by INTEGER,
            created_at TEXT
        )
    ''')
    # mandatory channels for subscription
    c.execute('''
        CREATE TABLE IF NOT EXISTS channels (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE
        )
    ''')
    # messages log
    c.execute('''
        CREATE TABLE IF NOT EXISTS messages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER,
            text TEXT,
            content_type TEXT,
            created_at TEXT
        )
    ''')
    conn.commit()
    conn.close()

def db_execute(query, params=(), fetch=False):
    conn = sqlite3.connect(DB_PATH)
    c = conn.cursor()
    try:
        c.execute(query, params)
        if fetch:
            rows = c.fetchall()
            conn.commit()
            return rows
        conn.commit()
    except Exception as e:
        logger.exception("DB error: %s", e)
    finally:
        conn.close()

init_db()

# =============== UTILS ====================
def save_user(user):
    now = datetime.utcnow().isoformat()
    db_execute('REPLACE INTO users (user_id, username, first_name, last_name, joined_at) VALUES (?,?,?,?,?)',
               (user.id, getattr(user, 'username', '') or '', getattr(user, 'first_name', '') or '', getattr(user, 'last_name', '') or '', now))

def log_message(user_id, text, ctype='text'):
    db_execute('INSERT INTO messages (user_id, text, content_type, created_at) VALUES (?,?,?,?)',
               (user_id, text or '', ctype, datetime.utcnow().isoformat()))

def list_buttons():
    rows = db_execute('SELECT id, name, type, content FROM buttons ORDER BY id DESC', fetch=True)
    return rows or []

def get_button_by_name(name):
    rows = db_execute('SELECT id, name, type, content FROM buttons WHERE name=?', (name,), fetch=True)
    return rows[0] if rows else None

def insert_button(name, btype, content, admin_id):
    now = datetime.utcnow().isoformat()
    db_execute('INSERT OR REPLACE INTO buttons (name, type, content, created_by, created_at) VALUES (?,?,?,?,?)',
               (name, btype, content, admin_id, now))

def delete_button(name):
    db_execute('DELETE FROM buttons WHERE name=?', (name,))

def list_channels():
    rows = db_execute('SELECT username FROM channels ORDER BY id', fetch=True)
    return [r[0] for r in rows] if rows else []

def add_channel(username):
    if not username.startswith('@'):
        username = '@' + username
    db_execute('INSERT OR IGNORE INTO channels (username) VALUES (?)', (username,))

def remove_channel(username):
    if not username.startswith('@'):
        username = '@' + username
    db_execute('DELETE FROM channels WHERE username=?', (username,))

def users_count():
    rows = db_execute('SELECT COUNT(*) FROM users', fetch=True)
    return rows[0][0] if rows else 0

def users_today_count():
    today = date.today().isoformat()
    rows = db_execute("SELECT COUNT(*) FROM users WHERE date(substr(joined_at,1,10)) = ?", (today,), fetch=True)
    return rows[0][0] if rows else 0

def buttons_count():
    rows = db_execute('SELECT COUNT(*) FROM buttons', fetch=True)
    return rows[0][0] if rows else 0

def channels_count():
    rows = db_execute('SELECT COUNT(*) FROM channels', fetch=True)
    return rows[0][0] if rows else 0

# ========== SUBSCRIPTION CHECK ===========
def user_subscribed_to_all(user_id):
    # channels are stored as @username
    chans = list_channels()
    if not chans:
        return True  # no mandatory channels
    for ch in chans:
        try:
            member = bot.get_chat_member(ch, user_id)
            status = getattr(member, 'status', '')
            if status in ('left', 'kicked'):
                return False
        except Exception as e:
            logger.warning("get_chat_member error for %s: %s", ch, e)
            return False
    return True

# ============ KEYBOARDS ================
def build_user_keyboard():
    buttons = list_buttons()
    kb = types.ReplyKeyboardMarkup(resize_keyboard=True)
    # show buttons in rows of 2
    row = []
    for i, b in enumerate(buttons, start=1):
        row.append(types.KeyboardButton(b[1]))
        if len(row) == 2:
            kb.row(*row)
            row = []
    if row:
        kb.row(*row)
    # if admin, add Admin button
    kb.add(types.KeyboardButton("🔒 Admin")) if ADMIN_ID else None
    return kb

def build_admin_main_kb():
    kb = types.ReplyKeyboardMarkup(resize_keyboard=True)
    kb.add(types.KeyboardButton("🎛 Tugmalar muharriri"), types.KeyboardButton("➖ Tugma o'chirish"))
    kb.add(types.KeyboardButton("📢 Majburiy obuna"), types.KeyboardButton("📊 Statistika"))
    kb.add(types.KeyboardButton("📣 Broadcast"), types.KeyboardButton("⬅️ Orqaga"))
    return kb

def build_channel_inline_kb():
    chans = list_channels()
    kb = types.InlineKeyboardMarkup()
    for ch in chans:
        # button text: @kanal  url: https://t.me/kanal (we store with @)
        channel_without_at = ch.lstrip('@')
        kb.add(types.InlineKeyboardButton(ch, url=f"https://t.me/{channel_without_at}"))
    kb.add(types.InlineKeyboardButton("✅ Obuna bo'ldim", callback_data="i_checked_subs"))
    return kb

# ============ HANDLERS =================
@bot.message_handler(commands=['start'])
def cmd_start(m):
    save_user(m.from_user)
    log_message(m.from_user.id, '/start', 'command')
    if not user_subscribed_to_all(m.from_user.id):
        # send mandatory channels message with inline buttons
        text = "⚠️ Botdan to‘liq foydalanish uchun quyidagi kanallarga obuna bo‘ling:"
        kb = build_channel_inline_kb()
        bot.send_message(m.chat.id, text, reply_markup=kb)
        return
    # subscribed -> show normal keyboard
    kb = build_user_keyboard()
    bot.send_message(m.chat.id, f"Assalomu alaykum, {m.from_user.first_name or ''}!\nAsosiy menyu:", reply_markup=kb)

@bot.callback_query_handler(func=lambda c: c.data == 'i_checked_subs')
def callback_checked_subs(c):
    # user clicked "Obuna bo'ldim"
    uid = c.from_user.id
    if user_subscribed_to_all(uid):
        bot.answer_callback_query(c.id, "✅ Rahmat! Endi botdan foydalanishingiz mumkin.")
        try:
            bot.delete_message(c.message.chat.id, c.message.message_id)
        except Exception:
            pass
        kb = build_user_keyboard()
        bot.send_message(c.message.chat.id, "Asosiy menyu:", reply_markup=kb)
    else:
        bot.answer_callback_query(c.id, "🚫 Siz hali ham qandaydir kanalga obuna bo‘lmagansiz.", show_alert=True)

# ========== ADMIN PANEL ================
@bot.message_handler(func=lambda m: m.text == "🔒 Admin")
def open_admin(m):
    if m.from_user.id != ADMIN_ID:
        bot.send_message(m.chat.id, "❌ Siz admin emassiz.")
        return
    bot.send_message(m.chat.id, "🔐 Admin panelga hush kelibsiz:", reply_markup=build_admin_main_kb())

# Admin -> Tugmalar muharriri (qo'shish)
@bot.message_handler(func=lambda m: m.text == "🎛 Tugmalar muharriri")
def admin_add_menu(m):
    if m.from_user.id != ADMIN_ID: return
    bot.send_message(m.chat.id, "🆕 Yangi tugma qo‘shish — avvalo tugma nomini yuboring:")
    bot.register_next_step_handler(m, admin_receive_button_name)

def admin_receive_button_name(m):
    if m.from_user.id != ADMIN_ID: return
    name = m.text.strip()
    if not name:
        bot.send_message(m.chat.id, "❌ Tugma nomi bo‘sh bo‘lishi mumkin emas. Qayta yuboring:")
        bot.register_next_step_handler(m, admin_receive_button_name)
        return
    # save name temporarily in user storage via simple in-memory dict
    # Use a simple session dict on bot (per admin only one flow expected)
    global admin_temp
    admin_temp = {'name': name}
    bot.send_message(m.chat.id, f"Endi '{name}' uchun xabar, rasm, video yoki fayl yuboring (turini avtomatik aniqlaydi).")
    bot.register_next_step_handler(m, admin_receive_button_content)

def admin_receive_button_content(m):
    if m.from_user.id != ADMIN_ID: return
    global admin_temp
    if not admin_temp or 'name' not in admin_temp:
        bot.send_message(m.chat.id, "❌ Iltimos yana /admin orqali boshlang.")
        return
    name = admin_temp['name']
    ctype = m.content_type
    content_repr = None
    if ctype == 'text':
        content_repr = m.text
        btype = 'text'
    elif ctype == 'photo':
        file_id = m.photo[-1].file_id
        content_repr = file_id
        btype = 'photo'
    elif ctype == 'video':
        file_id = m.video.file_id
        content_repr = file_id
        btype = 'video'
    elif ctype == 'document':
        file_id = m.document.file_id
        content_repr = file_id
        btype = 'document'
    elif ctype == 'sticker':
        file_id = m.sticker.file_id
        content_repr = file_id
        btype = 'sticker'
    else:
        bot.send_message(m.chat.id, "❌ Ushbu turdagi xabar qo'llab-quvvatlanmaydi. Matn, rasm, video, hujjat yoki sticker yuboring.")
        return
    insert_button(name, btype, content_repr, m.from_user.id)
    bot.send_message(m.chat.id, f"✅ Tugma qo‘shildi: '{name}' (turi: {btype})", reply_markup=build_admin_main_kb())
    admin_temp = {}

# Admin -> Tugma o'chirish
@bot.message_handler(func=lambda m: m.text == "➖ Tugma o'chirish")
def admin_delete_menu_prompt(m):
    if m.from_user.id != ADMIN_ID: return
    rows = list_buttons()
    if not rows:
        bot.send_message(m.chat.id, "📭 Hozircha hech qanday tugma yo'q.", reply_markup=build_admin_main_kb())
        return
    kb = types.ReplyKeyboardMarkup(resize_keyboard=True)
    for r in rows:
        kb.add(types.KeyboardButton(r[1]))
    kb.add(types.KeyboardButton("⬅️ Orqaga"))
    bot.send_message(m.chat.id, "❌ Qaysi tugmani o'chirmoqchisiz? Tugma nomini bosing:", reply_markup=kb)
    bot.register_next_step_handler(m, admin_delete_menu_confirm)

def admin_delete_menu_confirm(m):
    if m.from_user.id != ADMIN_ID: return
    name = m.text.strip()
    if name == "⬅️ Orqaga":
        bot.send_message(m.chat.id, "🔐 Admin panelga qaytildi.", reply_markup=build_admin_main_kb())
        return
    if get_button_by_name(name):
        delete_button(name)
        bot.send_message(m.chat.id, f"🗑 {name} o'chirildi.", reply_markup=build_admin_main_kb())
    else:
        bot.send_message(m.chat.id, "❌ Bunday tugma topilmadi.", reply_markup=build_admin_main_kb())

# Admin -> Channels management (majburiy obuna)
@bot.message_handler(func=lambda m: m.text == "📢 Majburiy obuna")
def admin_manage_channels(m):
    if m.from_user.id != ADMIN_ID: return
    chans = list_channels()
    txt = "📢 Majburiy kanallar:\n" + ("\n".join(chans) if chans else "❌ Hech qanday kanal yo'q.")
    kb = types.ReplyKeyboardMarkup(resize_keyboard=True)
    kb.add(types.KeyboardButton("➕ Kanal qo'shish"), types.KeyboardButton("➖ Kanal o'chirish"))
    kb.add(types.KeyboardButton("⬅️ Orqaga"))
    bot.send_message(m.chat.id, txt, reply_markup=kb)

@bot.message_handler(func=lambda m: m.text == "➕ Kanal qo'shish")
def admin_channel_add_prompt(m):
    if m.from_user.id != ADMIN_ID: return
    bot.send_message(m.chat.id, "🔎 Kanal username (masalan: @kanalim) ni yuboring:")
    bot.register_next_step_handler(m, admin_channel_add_confirm)

def admin_channel_add_confirm(m):
    if m.from_user.id != ADMIN_ID: return
    ch = m.text.strip()
    if not ch:
        bot.send_message(m.chat.id, "❌ Bo‘sh username qabul qilinmaydi.")
        return
    if not ch.startswith('@'):
        ch = '@' + ch
    add_channel(ch)
    bot.send_message(m.chat.id, f"✅ Kanal qo‘shildi: {ch}", reply_markup=build_admin_main_kb())

@bot.message_handler(func=lambda m: m.text == "➖ Kanal o'chirish")
def admin_channel_remove_prompt(m):
    if m.from_user.id != ADMIN_ID: return
    chans = list_channels()
    if not chans:
        bot.send_message(m.chat.id, "❌ Hech qanday kanal yo'q.", reply_markup=build_admin_main_kb())
        return
    kb = types.ReplyKeyboardMarkup(resize_keyboard=True)
    for ch in chans:
        kb.add(types.KeyboardButton(ch))
    kb.add(types.KeyboardButton("⬅️ Orqaga"))
    bot.send_message(m.chat.id, "❌ Qaysi kanalni o'chirmoqchisiz? (@username bosilsin):", reply_markup=kb)
    bot.register_next_step_handler(m, admin_channel_remove_confirm)

def admin_channel_remove_confirm(m):
    if m.from_user.id != ADMIN_ID: return
    ch = m.text.strip()
    if ch == "⬅️ Orqaga":
        bot.send_message(m.chat.id, "🔐 Admin panelga qaytildi.", reply_markup=build_admin_main_kb())
        return
    remove_channel(ch)
    bot.send_message(m.chat.id, f"❌ Kanal o'chirildi: {ch}", reply_markup=build_admin_main_kb())

# Admin -> Stats
@bot.message_handler(func=lambda m: m.text == "📊 Statistika")
def admin_stats(m):
    if m.from_user.id != ADMIN_ID: return
    total = users_count()
    today = users_today_count()
    btns = buttons_count()
    chans = channels_count()
    txt = (f"📊 Statistika:\n\n"
           f"👥 Umumiy foydalanuvchilar: {total}\n"
           f"📅 Bugun qo'shilganlar: {today}\n"
           f"🔘 Tugmalar soni: {btns}\n"
           f"📢 Majburiy kanallar: {chans}")
    bot.send_message(m.chat.id, txt, reply_markup=build_admin_main_kb())

# Admin -> Broadcast
@bot.message_handler(func=lambda m: m.text == "📣 Broadcast")
def admin_broadcast_prompt(m):
    if m.from_user.id != ADMIN_ID: return
    bot.send_message(m.chat.id, "📣 Xabar matnini yuboring (keyin backgroundda barcha foydalanuvchilarga jo'natiladi):")
    bot.register_next_step_handler(m, admin_broadcast_send)

def admin_broadcast_send(m):
    if m.from_user.id != ADMIN_ID: return
    text = m.text or ''
    if not text:
        bot.send_message(m.chat.id, "❌ Matn bo'sh. Bekor qilindi.", reply_markup=build_admin_main_kb())
        return
    threading.Thread(target=do_broadcast, args=(text,)).start()
    bot.send_message(m.chat.id, "✔️ Broadcast fon rejimida boshlandi.", reply_markup=build_admin_main_kb())

def do_broadcast(text):
    users = db_execute('SELECT user_id FROM users', fetch=True) or []
    total = len(users)
    sent = 0
    for (uid,) in users:
        try:
            bot.send_message(uid, text)
            sent += 1
            time.sleep(BROADCAST_DELAY)
        except Exception as e:
            logger.warning("Broadcast xato %s: %s", uid, e)
    logger.info("Broadcast tugadi: %s/%s", sent, total)

# ========== USER INTERACTIONS ==========
@bot.message_handler(func=lambda m: True, content_types=['text','photo','video','document','sticker'])
def catch_all(m):
    # Save user & message
    save_user(m.from_user)
    log_message(m.from_user.id, getattr(m, 'text', '') or '', getattr(m, 'content_type', 'text'))

    # Back navigation
    if m.text == "⬅️ Orqaga":
        # simulates /start
        cmd_start(m)
        return

    # If user is not subscribed to all mandatory channels -> show channels message
    if not user_subscribed_to_all(m.from_user.id):
        kb = build_channel_inline_kb()
        bot.send_message(m.chat.id, "⚠️ Botdan to‘liq foydalanish uchun quyidagi kanallarga obuna bo‘ling:", reply_markup=kb)
        return

    # Admin commands handled above; regular users hitting button names:
    if m.content_type == 'text':
        # check if button exists
        btn = get_button_by_name(m.text)
        if btn:
            _, name, btype, content = btn
            try:
                if btype == 'text':
                    bot.send_message(m.chat.id, content)
                elif btype == 'photo':
                    bot.send_photo(m.chat.id, content)
                elif btype == 'video':
                    bot.send_video(m.chat.id, content)
                elif btype == 'document':
                    bot.send_document(m.chat.id, content)
                elif btype == 'sticker':
                    bot.send_sticker(m.chat.id, content)
                else:
                    bot.send_message(m.chat.id, "Ushbu turdagi javob hozircha ishlamaydi.")
            except Exception as e:
                logger.exception("Button send error: %s", e)
                bot.send_message(m.chat.id, "Xato yuz berdi — adminga murojaat qiling.")
            return
    # If none matched, show main menu (to avoid confusion)
    kb = build_user_keyboard()
    bot.send_message(m.chat.id, "Asosiy menyu:", reply_markup=kb)

# ========== START POLLING ==========
if __name__ == "__main__":
    logger.info("Bot ishlamoqda...")
    bot.infinity_polling(timeout=60, long_polling_timeout=60)