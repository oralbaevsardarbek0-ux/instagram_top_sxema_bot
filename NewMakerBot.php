<?php
ob_start();
error_reporting(0);
//🔵Manba @Oralbaev_uz Tarqatsang Manba Bilan Tarqat  Vijdonilaga Xavola
//👨‍💻Dasturchi @Kotta_Dasturchi 
define('API_KEY',"LITE_TOKEN"); 
echo "https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME'];

$admin = "LITE_ID"; 
$adminuser = file_put_contents("admin/user.txt");
$admins = file_get_contents("admin/admins.txt");
$bonkan = file_get_contents("bonkan.txt");
$get = file_get_contents("referal/$fid.txt");

define("DB_SERVER","localhost");
define("DB_USERNAME"," impsend_openbudjet");
define("DB_PASSWORD","111111");
define("DB_NAME"," impsend_openbudjet");
$connect = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query($connect,"CREATE TABLE `data` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `name` varchar(100) NOT NULL,

  `doc_id` text NOT NULL,

  `size` varchar(15) NOT NULL,

  `type` varchar(10) NOT NULL,

  `top` int(20) NOT NULL,

  `creator` varchar(30) NOT NULL,

  PRIMARY KEY (`id`)

)");

mysqli_query($connect,"CREATE TABLE `users` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `user_id` varchar(30) NOT NULL,

  `reg` varchar(20) NOT NULL,

  `lang` int(11) NOT NULL,
  
  `id` varchar(11) NOT NULL

  PRIMARY KEY (`id`)

)");


function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

function typing($cid){ 
    return bot("sendChatAction",[
    "chat_id"=>$cid,
    "action"=>"typing",
    ]);
    }
   
function kurs(){ 
$response = ""; 
$xml = file_get_contents("http://cbu.uz/uzc/arkhiv-kursov-valyut/xml/"); 
$m = new SimpleXMLElement($xml); 
foreach ($m as $val) { 
if($val->Ccy == 'USD'){ 
$response .= "🇺🇸 1 Aqsh Dollari - " . $val->Rate . "so'm\n"; 
} 
if($val->Ccy == 'EUR'){ 
$response .= "🇪🇺 1 Evro - " . $val->Rate . "so'm\n"; 
} 
if($val->Ccy == 'RUB'){ 
$response .= "🇷🇺 1 Rossiya Rubli - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'GBP'){ 
$response .= "🇬🇧 1 Angliya Funt Sterling - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'JPY'){ 
$response .= "🇯🇵 1 Yaponiya Iyenasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'QAR'){ 
$response .= "🇶🇦 1 Qatar Riali - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'KGS'){ 
$response .= "🇲🇪 1 Qirg‘iz Somi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'NZD'){ 
$response .= "🇦🇺 1 Yangi Zenlandiya Dollari - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'YER'){ 
$response .= "🇾🇪 1 Yaman Riali - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'IRR'){ 
$response .= "🇮🇷 1 Eron Riali - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'SEK'){ 
$response .= "🇸🇪 1 Shvesiya Kronasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'CHF'){ 
$response .= "🇨🇭 1 Shvesariya Franki - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'CZK'){ 
$response .= "🇨🇿 1 Chexia Kronasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'CNY'){ 
$response .= "🇨🇳 1 Xitoy Yuani - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'PHP'){ 
$response .= "🇫🇮 1 Filippin Pessosi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'UYU'){ 
$response .= "🇺🇾 1 Urugvay Pesosi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'OMR'){ 
$response .= "🇺🇬 1 Ummon Riali - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'UAH'){ 
$response .= "🇺🇦 1 Ukraina Grivnasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'TMT'){ 
$response .= "🇹🇲 1 Turkmaniston Manati - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'TRY'){ 
$response .= "🇹🇷 1 Turkiya Lirasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'TND'){ 
$response .= "🇹🇳 1 Tunis Dinori - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'TJS'){ 
$response .= "🇹🇰 1 Tojikiston somonisi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'THB'){ 
$response .= "🇹🇼 1 Tailand Bati - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'SYP'){ 
$response .= "🇸🇷 1 Suriya Funti - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'SDG'){ 
$response .= "🇸🇩 1 Sudan Funti - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'SGD'){ 
$response .= "🇸🇬 1 Singapur Dollari - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'RSD'){ 
$response .= "🇷🇸 1 Serbiya Dinori - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'XDR'){ 
$response .= "🇸🇬 1 XDR - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'SAR'){ 
$response .= "🇸🇦 1 Saudiya Arabiston Riali - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'RON'){ 
$response .= "🇷🇴 1 Ruminiya Leyi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'KWD'){ 
$response .= "🇦🇸 1 Quvayt Dinori - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'PLN'){ 
$response .= "🇵🇱 1 Polsha Elotiysi- " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'PKR'){ 
$response .= "🇵🇰 1 Pokiston Rupiyasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'AZN'){ 
$response .= "🇴🇲 1 Ozarbayjon Manati - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'NOK'){ 
$response .= "🇳🇴 1 Norvegiya Kronasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'MMK'){ 
$response .= "🇲🇲 1 Myanma Kyati- " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'MNT'){ 
$response .= "🇲🇳 1 Mongoliya Tugriki - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'MDL'){ 
$response .= "🇲🇩 1 Moldova Leyi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'EGP'){ 
$response .= "🇲🇴 1 Misr Funti - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'MXN'){ 
$response .= "🇲🇽 1 Meksika Pessosi- " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'MAD'){ 
$response .= "🇲🇪 1 Marokash Dirhami - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'MYR'){ 
$response .= "🇲🇼 1 Malaysiya Ringgiti - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'LYD'){ 
$response .= "🇩🇰 1 Liviya Dinori - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'LBP'){ 
$response .= "🇱🇾 1 Livan Funti - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'LAK'){ 
$response .= "🇱🇦 1 Laos Kipisi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'CUP'){ 
$response .= "🇰🇼 1 Kuba Pessosi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'KRW'){ 
$response .= "🇰🇷 1 Koreya Voni - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'CAD'){ 
$response .= "🇨🇦 1 Kanada Dollari - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'KHR'){ 
$response .= "🇨🇲 1 Kambodja Rieli - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'ILS'){ 
$response .= "🇮🇱 1 Isroil Shekeli - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'ISK'){ 
$response .= "🇳🇫 1 Islandiya Kronasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'IQD'){ 
$response .= "🇮🇷 1 Iroq Dinori - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'JOD'){ 
$response .= "🇮🇶 1 Iordaniya Dinori - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'IDR'){ 
$response .= "🇮🇩 1 Indoneziya Rupiyasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'ZAR'){ 
$response .= "🇨🇫 1 Janubiy Afrika Randi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'DZD'){ 
$response .= "🇸🇯 1 Jazoyir Dinori- " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'DKK'){ 
$response .= "🇩🇰 1 Daniya Kronasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'GEL'){ 
$response .= "🇬🇱 1 Gruziya Larisi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'VND'){ 
$response .= "🇨🇻 1 Vetnam Dongi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'VES'){ 
$response .= "🇩🇲 1 Venesuela Bolivari - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'HUF'){ 
$response .= "🇻🇪 1 Vengriya Foriniti- " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'BND'){ 
$response .= "🇧🇳 1 Bruney Dollari- " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'BRL'){ 
$response .= "🇧🇷 1 Braziliya Reali - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'BGN'){ 
$response .= "🇧🇴 1 Bolgariya Levi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'BYN'){ 
$response .= "🇧🇾 1 Belorus Rubli - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'BHD'){ 
$response .= "🇧🇭 1 Bahrayn Dinori - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'BDT'){ 
$response .= "🇧🇩 1 Bangladesh Takasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'AED'){ 
$response .= "🇦🇪 1 BAA Dirhami - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'AFN'){ 
$response .= "🇦🇫 1 Afg'oniston Afg'onisi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'AMD'){ 
$response .= "🇦🇲 1 Armaniston Drami - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'ARS'){ 
$response .= "🇦🇷 1 Argentina Pesosi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'KZT'){ 
$response .= "🇰🇿 1 Qozog'iston Tengesi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'AUD'){ 
$response .= "🇦🇹 1 Avstraliya Dollari - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'INR'){ 
$response .= "🇮🇳 1 Hindiston Rupiyasi - " . $val->Rate . " so'm\n"; 
} 
if($val->Ccy == 'HKD'){ 
$response .= "🇭🇰 1 Gonkong Dollari - " . $val->Rate . " so'm\n"; 
} 
} 
 return $response; 
}
  
function deleteFolder($path){
if(is_dir($path) === true){
$files = array_diff(scandir($path), array('.', '..'));
foreach ($files as $file)
deleteFolder(realpath($path) . '/' . $file);
return rmdir($path);
}else if (is_file($path) === true)
return unlink($path);
return false;
}

function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$get = file_get_contents("admin/kanal.txt");
$ex = explode("\n",$get);
for($i=0;$i<=count($ex) -1;$i++){
$first_line = $ex[$i];
$first_ex = explode("-",$first_line);
$name = $first_ex[0];
$url = $first_ex[1];
     $ret = bot("getChatMember",[
         "chat_id"=>"@$url",
         "user_id"=>$id,
         ]);
$stat = $ret->result->status;
 if((($stat=="creator" or $stat=="administrator" or $stat=="member"))){
$array['inline_keyboard']["$i"][0]['text'] = "✅ ". $name;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$url";
 }else{
$array['inline_keyboard']["$i"][0]['text'] = "❌ ". $name;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$url";
$uns = true;
}
}
if($uns == true){
$kanal2 = file_get_contents("admin/kanal2.txt");
        bot('sendMessage',[
        'chat_id'=>$id,
        'text'=>"$kanal2",
        "parse_mode"=>"html",
        "reply_to_message_id"=>$mid,
"disable_web_page_preview"=>true,
"reply_markup"=>json_encode($array),
]);  
return false;
}else{
return true;
}
}



$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$tx = $message->text;
$forward_ch = $message->forward_from_chat;
$forward = $message->forward_from;
$forward = $message->forward;
$chat_id = $message->chat->id;
$chat_id = $update->message->chat->id;
$channel=$update->channel_post;
$channel_id =$channel->chat->id;
$channel_mid =$channel->message_id;
$from_id = $update->callback_query->from->id;
$from_id = $update->message->from->id;
$from_id = $message->from->id;
$from_id = $message->chat->id;
$from_id = $update->callback_query->from->id;
$mid = $message->message_id;
$contact = $message->contact;
$phonenumber = $contact->phone_number;
$name = $message->from->first_name;
$fid = $message->from->id;
$callback = $update->callback_query;
$message = $update->message;
$data = $update->callback_query->data;
$type = $message->chat->type;
$text = $message->text;
$cid = $message->chat->id;
$uid = $message->from->id;
$id = $message->chat->id;
$number = $message->number;
$gname = $message->chat->title;
$left = $message->left_chat_member;
$new = $message->new_chat_member;
$name = $message->from->first_name;
$repid = $message->reply_to_message->from->id;
$repname = $message->reply_to_message->from->first_name;
$newid = $message->new_chat_member->id;
$leftid = $message->left_chat_member->id;
$newname = $message->new_chat_member->first_name;
$leftname = $message->left_chat_member->first_name;
$username = $message->from->username;
$cmid = $update->callback_query->message->message_id;
$cusername = $message->chat->username;
$nomer = $message->contact->phone_number;
$repmid = $message->reply_to_message->message_id; 
$ccid = $update->callback_query->message->chat->id;
$cuid = $update->callback_query->message->from->id;
$cqid = $update->callback_query->id;
$reply = $message->reply_to_message->text;

$rpl = json_encode([
            'resize_keyboard'=>false,
            'force_reply'=>true,
            'selective'=>true,
        ]);

$photo = $update->message->photo;
$gif = $update->message->animation;
$video = $update->message->video;
$music = $update->message->audio;
$voice = $update->message->voice;
$sticker = $update->message->sticker;
$document = $update->message->document;
$caption = $message->caption;
$for = $message->forward_from;
$from_id = $update->callback_query->from->id;
$forc = $message->forward_from_chat;
$fadmin = $message->from->id;
$data = $callback->data;
$callid = $callback->id;
$cname = $calback->message->from->first_name;
$ccid = $callback->message->chat->id;
$cmid = $callback->message->message_id;
$cid2 = $callback->message->chat->id;
$mid2 = $callback->message->message_id;
$cfid = $callback->message->from->id;
$user = $message->from->username;
$botname = bot('getme',['GlobalBuilderBot'])->result->username;
$nameuz = "<a href='tg://user?id=$callfrid'>$callname $surname</a>";
$nameru = "<a href='tg://user?id=$fid'>$name $familya</a>";
$inlinequery = $update->inline_query;
$inline_id = $inlinequery->id;
$inlineid = $inlinequery->from->id;
$inline_query = $inlinequery->query;
$time=date('H:i:s',strtotime('0 hour'));
$soat = date("H:i:s",strtotime("0 hour"));
$sana = date('d.m.Y',strtotime("0 hour"));
$yukla = date('H:i');
date_default_timezone_set("Asia/Tashkent");
$users = file_get_contents("inew.ids");
$inew = file_get_contents("inew.ids");
$shekih = file_get_contents("shekih.db");
$bonusuz = file_get_contents("$admin.ttxt");
$bepul = file_get_contents("bonus2.txt");
$buyurtma = rand(1111,9999); 
$adminusers = file_get_contents("admin/user.txt");

$maxbon = file_get_contents("bonus/maxbon.txt");
$minbon = file_get_contents("bonus/minbon.txt");
$kanalmax = file_get_contents("bonus/kanalmax.txt");
$kanalmin = file_get_contents("bonus/kanalmin.txt");
$soni = file_get_contents("pul/$chat_id/$fid.db");
$chan = file_get_contents("pul/$chat_id.db");
$users = file_get_contents("shekih.db");
$guruh = file_get_contents("pul/guruh.db");
$step = file_get_contents("step/$fid.step");
$step = file_get_contents("step/$cid.step");
$step = file_get_contents("step/$chat_id.step");
$userstep = file_get_contents("step/$fid.txt");
$userstep1 = file_get_contents("step/$fid.txt1");
$saved = file_get_contents("step/inew.txt");
$save = file_get_contents("step/id.txt");
$userstep = file_get_contents("step/$fid.txt");
$ban = file_get_contents("ban/$cid.txt");
$kunlik = file_get_contents("https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/baza/$ccid/kunlik.txt");


if($connect->connect_error){
bot('sendMessage',[
'chat_id' =>$cid,
'text'=>"<b>❌️ Maʼlumotlar bazasiga ulanishda muammo yuz berdi.</b>",
'parse_mode' =>'html',
]);
return false;
}

if($soni == false){$soni = 0;}

if(file_get_contents("bonus/maxbon.txt")){
}else{
	if(file_put_contents("bonus/maxbon.txt","1000"));
}
if(file_get_contents("bonus/minbon.txt")){
}else{
	if(file_put_contents("bonus/minbon.txt","500"));
}
if(file_get_contents("bonus/kanalmax.txt")){
}else{
	if(file_put_contents("bonus/kanalmax.txt","1000"));
}
if(file_get_contents("bonus/kanalmin.txt")){
}else{
	if(file_put_contents("bonus/kanalmin.txt","500"));
}



if(file_get_contents("admin/qoida.txt")){
	}else{
		if(file_put_contents("admin/qoida.txt","<b>📮 Eng muhim qoidalar.<i>

1 - Ochgan va ochayotgan botingizdan firibgarlik maqsadida foydalanmang.
2 - Mualliflik huquqini buzib, biror tashkilot brendi va logotiplaridan foydalanmang.
3 - Texnik yordam olish uchun biz bilan bogʻlansangiz, murojaatingizni bir yoki ikki post yordamida ifodalashga harakat qiling va tarixni tozalamang.</i>

Yuqorida keltirilgan qoidalarni buzganingiz aniqlansa, botdan bloklanishingiz yoki botingiz oʻchirib yuborilishi mumkin.

⚙️ Tizim versiyasi: V0.1

👨🏻‍💻 Dasturchi:  <a href='tg://user?id=$admin'>$adminuser</a></b>"));
	}
	
if(file_get_contents("admin/qollanma.txt")){
}else{
	if(file_put_contents("admin/qollanma.txt","<b>📮 Bot yaratish qo'llanmasi.<i>

 1 - Telegram ilovangizdan @BotFather ni toping, va /start tugmasini bosing.
 2 - @BotFatherga /newbot buyrug'ini yuboring.
 3 - Yaratmoqchi bo'lgan bot nomini yuboring.
 4 - Bot userini kiriting: @Tetrisbot, @Tetris_bot yoki @Tetris_robot.
 5 - Agar siz hamma narsani to'g'ri bajargan bo'lsangiz, @BotFather sizga bot tokeningizni yuboradi, uni saqlab qo'ying.
 6 - Bot yaratganingizda, botimiz token so‘raganda @BotFather tomonidan yuborilgan token yuborasiz.</i>

⚙️ Tizim versiyasi: V5.0.5

👨🏻‍💻 Dasturchi:  <a href='tg://user?id=$admin'>$adminuser</a></b>"));
}

if(file_get_contents("admin/haqida.txt")){
}else{
	if(file_put_contents("admin/haqida.txt","<b>🖥 @$botname  — Faol Telegram biznes botlarini yaratuvchisi.<i>

Loyiha ishlab chiqilgach, ko'p o'tmay uni ko'plab bot adminlari tomonidan olqishlarga sazovor bo'ldi.  Eng e'tiborli tomoni shundaki, Telegram biznes-botlarini ochish endi qiyin emas, bu bir necha harakatlar asosida amalga oshiriladi.
Loyihaning joriy versiyasi sinovga yuborildi va bu hali boshlanishi.  Kelajakda loyihani eng katta g'alabalar kutmoqda.  Loyiha uchun rejalashtirilgan eng qiziqarli va hayajonli yangilanishlar hali oldinda.
Botlarni ochish, tahrirlash va sozlash juda zo'r va hamma uchun qiziqarli bo'ladi.  Loyihani ishlab chiquvchilar ko'proq boshqaruvni va'da qiladilar.
Barcha yangiliklar va yangiliklarni @Editphp kanalida kuzatib boring.  Barcha yangilanishlar versiya bilan birga to'liq tushuntirilgan versiyada taqdim etiladi.  Eng katta yangilanishlar har oy beriladi.
Rivojlanishdan hech qachon charchamaymiz.  Siz ham biz bilan eng muhim biznes-botlarga ega bo'lishingiz mumkin.  Sizning biznes botlaringiz xavfsiz va tez ishlaydi.  Biz bilan qoling.</i>

⚙️ Tizim versiyasi: V0.1

👨🏻‍💻 Dasturchi:  <a href='tg://user?id=$admin'>$adminuser</a></b>"));
}

if(file_get_contents("admin/valyuta.txt")){
}else{
	if(file_put_contents("admin/valyuta.txt","so'm"));
}

if(file_get_contents("admin/orqa.txt")){
}else{
	if(file_put_contents("admin/orqa.txt","<b>🖥  Asosiy menyuga qaytdingiz.</b>"));
}

if(file_get_contents("admin/kanal2.txt")){
}else{
	if(file_put_contents("admin/kanal2.txt","<b>❌️ Kechirasiz, Quyidagi kanal va guruhlarimizga obuna bo'lmasangiz botdan foydalana olmaysiz.</b>"));
}

if(file_get_contents("admin/referal.txt")){
}else{
	if(file_put_contents("admin/referal.txt","1000"));
}

if(file_get_contents("admin/qiwi.txt")){
}else{
	if(file_put_contents("admin/qiwi.txt","@GPKiritilmagan"));
}

if(file_get_contents("admin/user.txt")){
}else{
	if(file_put_contents("admin/user.txt","GPKiritilmagan"));
}

	if(file_get_contents("admin/click.txt")){
}else{
	if(file_put_contents("admin/click.txt","@GPKiritilmagan"));
}

if(file_get_contents("admin/admins.txt")){
}else{
	if(file_put_contents("admin/admins.txt","GPKiritilmagan"));
}

if(file_get_contents("inew/$cid.limite")){
}else{
	if(file_put_contents("inew/$cid.limite","1"));
}

if(file_get_contents("inew/$cid.max")){
}else{
	if(file_put_contents("inew/$cid.max","0"));
}
if(file_get_contents("Statistika/bots.txt")){
}else{
	if(file_put_contents("Statistika/bots.txt","0"));
}
if(file_get_contents("Statistika/botm.txt")){
}else{
	if(file_put_contents("Statistika/botm.txt","0"));
}
if(file_get_contents("Statistika/botp.txt")){
}else{
	if(file_put_contents("Statistika/botp.txt","0"));
}
$bots = file_get_contents("Statistika/bots.txt");
$botm = file_get_contents("Statistika/botm.txt");
$botp = file_get_contents("Statistika/botp.txt");

$key1 = file_get_contents("Tugma/key1.txt");
$key2 = file_get_contents("Tugma/key2.txt");
$key3 = file_get_contents("Tugma/key3.txt");
$key4 = file_get_contents("Tugma/key4.txt");
$key5 = file_get_contents("Tugma/key5.txt");
$key6 = file_get_contents("Tugma/key6.txt");
$key7 = file_get_contents("Tugma/key7.txt");
$key8 = file_get_contents("Tugma/key8.txt");
$key9 = file_get_contents("Tugma/key9.txt");
$key11 = file_get_contents("Tugma/key11.txt");
$key12 = file_get_contents("Tugma/key12.txt");
$qoida = file_get_contents("admin/qoida.txt");
$haqida = file_get_contents("admin/haqida.txt");
$qollanma = file_get_contents("admin/qollanma.txt");
$start = file_get_contents("admin/start.txt");
$orqa = file_get_contents("admin/orqa.txt");
$kanal2 = file_get_contents("admin/kanal2.txt");
$valyuta = file_get_contents("admin/valyuta.txt");
$narx = file_get_contents("admin/referal.txt");
$limite = file_get_contents("inew/$cid.limite");
$max = file_get_contents("inew/$cid.max");

mkdir("rubl");
mkdir("almash");
mkdir("almash1");
mkdir("bonus");
mkdir("admin");
mkdir("Tugma");
mkdir("admin");
mkdir("referal");
mkdir("inew");
mkdir("odam");
mkdir("stat");
mkdir("Statistika");
mkdir("Narxlar");
mkdir("sozlash");
mkdir("sozlash/narxi");
mkdir("sozlash/tavsif");
mkdir("step");
mkdir("ban");
mkdir("pullik");
mkdir("bots");
mkdir("bots/$fid");
mkdir("baza");
mkdir("baza/$cid");
$uzgramebottavsif = file_get_contents("sozlash/tavsif/uzgrame.txt");
$pulbottavsif = file_get_contents("sozlash/tavsif/pul.txt");
$ucbottavsif = file_get_contents("sozlash/tavsif/uc.txt");
$mbbottavsif = file_get_contents("sozlash/tavsif/mb.txt");
$almazbottavsif = file_get_contents("sozlash/tavsif/almaz.txt");
$turfabottavsif = file_get_contents("sozlash/tavsif/turfa.txt");
$smmbottavsif = file_get_contents("sozlash/tavsif/smm.txt");
$harfbottavsif= file_get_contents("sozlash/tavsif/harf.txt");
$rasmbottavsif = file_get_contents("sozlash/tavsif/rasm.txt");
$raqambottavsif = file_get_contents("sozlash/tavsif/raqam.txt");
$savebottavsif = file_get_contents("sozlash/tavsif/save.txt");
$rublbottavsif = file_get_contents("sozlash/tavsif/rubl.txt");
$premiumbottavsif = file_get_contents("sozlash/tavsif/smmpre.txt");

$uzgramebotnarx = file_get_contents("sozlash/narxi/uzgrame.txt");
$pulbotnarx = file_get_contents("sozlash/narxi/pul.txt");
$ucbotnarx = file_get_contents("sozlash/narxi/uc.txt");
$mbbotnarx = file_get_contents("sozlash/narxi/mb.txt");
$almazbotnarx = file_get_contents("sozlash/narxi/almaz.txt");
$turfabotnarx = file_get_contents("sozlash/narxi/turfa.txt");
$smmbotnarx = file_get_contents("sozlash/narxi/smm.txt");
$harfbotnarx = file_get_contents("sozlash/narxi/harf.txt");
$rasmbotnarx = file_get_contents("sozlash/narxi/rasm.txt");
$raqambotnarx = file_get_contents("sozlash/narxi/raqam.txt");
$savebotnarx = file_get_contents("sozlash/narxi/save.txt");
$rublbotnarx = file_get_contents("sozlash/narxi/rubl.txt");
$premiumbotnarx = file_get_contents("sozlash/narxi/smmpre.txt");
// tavsif sozlamalari
if(!file_exists("sozlash/tavsif/pul.txt")){  
    file_put_contents("sozlash/tavsif/pul.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/rubl.txt")){  
    file_put_contents("sozlash/tavsif/rubl.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/uc.txt")){  
    file_put_contents("sozlash/tavsif/uc.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/mb.txt")){  
    file_put_contents("sozlash/tavsif/mb.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/almaz.txt")){  
    file_put_contents("sozlash/tavsif/almaz.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/harf.txt")){  
    file_put_contents("sozlash/tavsif/harf.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/rasm.txt")){  
    file_put_contents("sozlash/tavsif/rasm.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/turfa.txt")){  
    file_put_contents("sozlash/tavsif/turfa.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/raqam.txt")){  
    file_put_contents("sozlash/tavsif/raqam.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/save.txt")){  
    file_put_contents("sozlash/tavsif/save.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/smm.txt")){  
    file_put_contents("sozlash/tavsif/smm.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/smmpre.txt")){  
    file_put_contents("sozlash/tavsif/smmpre.txt","Kiritilmagan");
}
if(!file_exists("sozlash/tavsif/uzgrame.txt")){  
    file_put_contents("sozlash/tavsif/uzgrame.txt","Kiritilmagan");
}
//narx
if(!file_exists("sozlash/narxi/pul.txt")){  
    file_put_contents("sozlash/narxi/pul.txt","7000");
}
if(!file_exists("sozlash/narxi/rubl.txt")){  
    file_put_contents("sozlash/narxi/rubl.txt","7000");
}
if(!file_exists("sozlash/narxi/uc.txt")){  
    file_put_contents("sozlash/narxi/uc.txt","7000");
}
if(!file_exists("sozlash/narxi/mb.txt")){  
    file_put_contents("sozlash/narxi/mb.txt","7000");
}
if(!file_exists("sozlash/narxi/almaz.txt")){  
    file_put_contents("sozlash/narxi/almaz.txt","7000");
}
if(!file_exists("sozlash/narxi/harf.txt")){  
    file_put_contents("sozlash/narxi/harf.txt","7000");
}
if(!file_exists("sozlash/narxi/rasm.txt")){  
    file_put_contents("sozlash/narxi/rasm.txt","7000");
}
if(!file_exists("sozlash/narxi/turfa.txt")){  
    file_put_contents("sozlash/narxi/turfa.txt","7000");
}
if(!file_exists("sozlash/narxi/raqam.txt")){  
    file_put_contents("sozlash/narxi/raqam.txt","7000");
}
if(!file_exists("sozlash/narxi/save.txt")){  
    file_put_contents("sozlash/narxi/save.txt","7000");
}
if(!file_exists("sozlash/narxi/smm.txt")){  
    file_put_contents("sozlash/narxi/smm.txt","7000");
}
if(!file_exists("sozlash/narxi/smmpre.txt")){  
    file_put_contents("sozlash/narxi/smmpre.txt","7000");
}
if(!file_exists("sozlash/narxi/uzgrame.txt")){  
    file_put_contents("sozlash/narxi/uzgrame.txt","7000");
}



//🔵Manba @WebCoder_Team Tarqatsang Manba Bilan Tarqat 
//👨‍💻Dasturchi @Kotta_Dasturchi 


if(!file_exists("almash/$fid.idraqam")){  
    file_put_contents("almash/$fid.idraqam","");
}
if(!file_exists("almash/$fid.pulraqam")){  
    file_put_contents("almash/$fid.pulraqam","");
}

if(!file_exists("referal/$fid.txt")){  
    file_put_contents("referal/$fid.txt","0");
}

if(file_get_contents("stat/stat.txt")){
} else{
file_put_contents("stat/stat.txt", "0");
}

if(file_get_contents("baza/$cid/botsc.txt")){
} else{
file_put_contents("baza/$cid/botsc.txt", "0");
}

if(!file_exists("Narxlar/Standart.txt")){  
    file_put_contents("Narxlar/Standart.txt","5000");
}
if(!file_exists("Narxlar/Maxsus.txt")){  
    file_put_contents("Narxlar/Maxsus.txt","10000");
}
if(!file_exists("Narxlar/Premium.txt")){  
    file_put_contents("Narxlar/Premium.txt","15000");
}
$botlarsoni = file_get_contents("baza/$cid/botsc.txt");
$kunlik = file_get_contents("baza/$cid/kunlik.txt");
$soni = file_get_contents("soni/$idi.soni");
if(!$soni) $soni = 0;

$stat = file_get_contents("stat/usid.txt");

$status = file_get_contents("status.txt");
$power = file_get_contents("power.txt");

$qiwi = file_get_contents("admin/qiwi.txt");
$click = file_get_contents("admin/click.txt");

$panel = json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
[['text'=>"⚙️ Asosiy sozlamalar"]],
[['text'=>"📢 Kanallar"],['text'=>"📊 Statistika"]],
[['text'=>"🤖 Konstruktor sozlamalar"]],
[['text'=>"📳 Bot holati"],['text'=>"📨 Xabarnoma"]],
[['text'=>"📑 Matnlar"],['text'=>"◀️ Orqaga"]],
]
]);
    

$panels = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"*⃣ Birlamchi sozlamalar"]],
[['text'=>"👤 Adminlar"],['text'=>"🎟 Promokod"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"💳 Hamyonlar"],['text'=>"⏱ To'lov holati"]],
[['text'=>"🎁 Bonus yuborish"]],
[['text'=>"🗄 Boshqarish"]],
]
]);


$main_menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🖥 Botlarni boshqarish"]],
[['text'=>"💳 Hisobim"],['text'=>"💵 Pul ishlash"]],
[['text'=>"📨 Yordam"],['text'=>"📋 Ma'lumotlar"]],
]
]);


$main_menus  = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🖥 Botlarni boshqarish"]],
[['text'=>"💳 Hisobim"],['text'=>"💵 Pul ishlash"]],
[['text'=>"📨 Yordam"],['text'=>"📋 Ma'lumotlar"]],
[['text'=>"🗄 Boshqarish"]],
]
]);


$select_menu = json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
[['text'=>"➕ Yangi bot ochish"]],
[['text'=>"⚙️ Botni sozlash"],['text'=>"💵 To'lov qilish"]],
[['text'=>"🗄 Buyurtmalar"],['text'=>"◀️ Orqaga"]],]
]);
    

if(mb_stripos($tx,"/start $cid")){
	bot('SendMessage',[
	'chat_id'=>$cid,
    'text'=>"<b>❌️ Siz botga o'zingizni taklif qila olmaysiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$main_menu,
    ]);
    }else{
	$idref = "referal/$ex.db";
	$idref2 = file_get_contents($idref);
	$id = "$cid\n";
    $handle = fopen($idref, 'a+');
     fwrite($handle, $id);
     fclose($handle);
if(mb_stripos($idref2,$cid) !== false ){
}else{
$narx = file_get_contents("admin/referal.txt");
$start = file_get_contents("admin/start.txt");
$pub=explode(" ",$text);
$ex=$pub[1];
$pul = file_get_contents("referal/$ex.txt");
$a=$pul+$narx;
file_put_contents("referal/$ex.txt","$a");
$odam = file_get_contents("odam/$ex.dat");
$b=$odam+1;
file_put_contents("odam/$ex.dat","$b");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"$start

<b>Agar siz xatolik va kamchiliklar topsangiz. @RejimParvoz murojaat qiling. Yordamingiz uchun sizga katta mukofot beriladi.</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>$main_menu,
]);
bot('sendmessage',[
'chat_id'=>$ex,
'text'=>"<b>🔗 Siz botga doʻstingizni taklif qildingiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
}
}
	
if($text == "/start"){ 
if($cid!=$admin){
$adminuser = file_get_contents("admin/user.txt");
$start = file_get_contents("admin/start.txt");
bot('Sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>💎 Salom:  $name!

🤖 @$botname ga hush kelibsiz!</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>$main_menu,
]);
}else{
$start = file_get_contents("admin/start.txt");
bot('Sendmessage',[
'chat_id'=>$admin,
'text'=>"<b>💎 Salom:  $name!

🤖 @$botname ga hush kelibsiz!</b>",

'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>$main_menus,
]);
}
}

if($text == "/start" or $text == "🖥 Botlarni boshqarish" or $text == "💳 Hisobim" or $text == "💵 Pul ishlash" or $text == "📨 Yordam" or $text == "📋 Ma'lumotlar" or $text == "➕ Yangi bot ochish" or $text == "⚙️ Botni sozlash" or $text == "💵 To'lov qilish" or $text == "$key9" or $text == "◀️ Orqaga"){
$post = file_get_contents("inew.ids");
$posti = explode("\n",$post);
file_put_contents("inew.ids", "$post\n$cid");
$pul = file_get_contents("referal/$cid.txt");
$mm=$pul+0;
file_put_contents("referal/$cid.txt","$mm");
$odam = file_get_contents("odam/$cid.dat");
$kkd=$odam+0;
file_put_contents("odam/$cid.dat","$kkd");
}


/*if($text=="/start" or $text=="🖥 Botlarni boshqarish" or $text=="💳 Hisobim" or $text=="💵 Pul ishlash" or $text=="📨 Yordam" or $text== or $text=="➕ Yangi bot ochish" or $text=="⚙️ Botni sozlash" or $text=="💵 To'lov qilish" or $text=="$key9" or $text=="◀️ Orqaga" or $text=="$key11"){*/
$result = mysqli_query($connect,"SELECT * FROM users WHERE id = $chat_id");
$rew = mysqli_fetch_assoc($result);
if($rew){
bot('SendMessage',[
'chat_id'=>$chat_id,
]);
}else{
mysqli_query($connect,"INSERT INTO users(id) VALUES ('$chat_id')");
bot('SendMessage',[
'chat_id'=>$chat_id,
]);
}


if($type == "private"){
$result = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$cid'");
$row = mysqli_fetch_assoc($result);
if($row){
}else{
mysqli_query($connect,"INSERT INTO users(id) VALUES ('$chat_id')");
}
}


if($text){
	if($ban == "1"){
	exit();
    }else{
  }
}


if(isset($message)){
$lichka=file_get_contents("shekih.db");
$lich=substr_count($lichka,"\n");
$get = file_get_contents("shekih.db");
 if(mb_stripos($get,$fid)==false){
        file_put_contents("shekih.db", "$get\n$fid");
        bot('sendMessage',[
          'chat_id'=>"$admin",
          'text'=>"<b>
🔰 Yangi Foydalanuvchi.
📊 Umumiy: $lich ta
👨‍💼 Ismi: <a href = 'tg://user?id=$uid'>$name</a>
🆔️ ID raqami: </b><code>$uid</code>",
           'parse_mode'=>'html',
        ]);
    }
 }


if($data == "select"){
	bot('deleteMessage',[
	'chat_id'=>$ccid,
	'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🛠 Botlarni boshqarish bo'limiga xush kelibsiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$select_menu,
]);
}


if($data == "menyu"){
if($ccid!=$admin){
$orqa = file_get_contents("admin/orqa.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"$orqa",
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
}else{
$orqa = file_get_contents("admin/orqa.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"$orqa",
'parse_mode'=>'html',
'reply_markup'=>$main_menus,
]);
}
}


if($text == "◀️ Orqaga" and joinchat($fid)==true){ 
	if($cid!=$admin){
   $orqa = file_get_contents("admin/orqa.txt");
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"$orqa",
    'parse_mode'=>"html",
    'disable_web_page_preview'=>true,
    'reply_markup'=>$main_menu
    ]);
    }else{
	$orqa = file_get_contents("admin/orqa.txt");
	bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"$orqa",
    'parse_mode'=>"html",
'disable_web_page_preview'=>true,
    'reply_markup'=>$main_menus
    ]);
    }
unlink("step/$cid.step");
unlink("step/$cid2.step");
unlink("step/inew.txt");
unlink("step/$fid.txt1");
unlink("step/$cid.txt1");
unlink("step/$ccid.txt1");
unlink("step/$fid.txt");
unlink("step/$cid.txt");
unlink("step/$ccid.txt");
}


if($text == "$key11" and joinchat($fid)==true){ 
if($cid!=$admin){
   $orqa = file_get_contents("admin/orqa.txt");
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"$orqa",
    'parse_mode'=>"html",
    'disable_web_page_preview'=>true,
    'reply_markup'=>$main_menu
    ]);
    }else{
	$orqa = file_get_contents("admin/orqa.txt");
	bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"$orqa",
    'parse_mode'=>"html",
'disable_web_page_preview'=>true,
    'reply_markup'=>$main_menus
    ]);
  }
}


if($data == "oplata"){
        bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
        'parse_mode'=>'html',
]);
       bot('editMessageText',[
       'chat_id'=>$cid2,
       'message_id'=>$mid2 + 1,
       'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"💱 Valyuta kurslari",'callback_data'=>"kurs"]],
[['text'=>"🇺🇿 Click hamyon",'callback_data'=>"click"],['text'=>"🇷🇺 Qiwi hamyon",'callback_data'=>"qiwi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
]
])
]);
}

if($data == "orqa"){
        bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"💱 Valyuta kurslari",'callback_data'=>"kurs"]],
[['text'=>"🇺🇿 Click hamyon",'callback_data'=>"click"],['text'=>"🇷🇺 Qiwi hamyon",'callback_data'=>"qiwi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
]
])
]);
}

if($data == "kurs"){
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>kurs()."",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]
])
]);
}

if($data == "qiwi"){
$qiwi = file_get_contents("admin/qiwi.txt");
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>📋 To'lov tizimi: 🇷🇺 Qiwi hamyon

💡 Avto to'lov holati: OFF

💳 Hamyon: <code>$qiwi</code>
📝 Izoh: <code>$cid2</code>

🔰 Diqqat, izoh kiritishni unutsangiz yoki noto'g'ri kiritsangiz hisobingizga pul tushmaydi. Bu kabi holatlarda, biz bilan bog'lanishingiz mumkin.</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'lov qildim.",'callback_data'=>"money"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]
])
]);
}

if($data == "click"){
$click = file_get_contents("admin/click.txt");
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>📋 To'lov tizimi: 🇺🇿 Click hamyon

💡 Avto to'lov holati: OFF

💳 Hamyon: <code>$click</code>
📝 Izoh: <code>$ccid</code>

🔰 Diqqat, izoh kiritishni unutsangiz yoki noto'g'ri kiritsangiz hisobingizga pul tushmaydi! Bu kabi holatlarda, biz bilan bog'lanishingiz mumkin.</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'lov qildim.",'callback_data'=>"money"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]
])
]);
}

if($data == "money"){
	bot('DeleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>💵 To'lov qilgan miqdoringizni kiriting:</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
]);
file_put_contents("step/$cid2.step",'oplata');
}

if($step == "oplata"){
if(is_numeric($text)=="true"){
	file_put_contents("step/inew.txt",$text);
	file_put_contents("step/id.txt",$cid);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>💵 To'lov qilgan ilovangizdan Check yoki Screenshotni yuboring:</b>",
	'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step",'rasm');
}else{
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>❌️ To'lov miqdori faqat sonlardan tashkil topsin. Qayta urinib ko'ring:</b>",
	'parse_mode'=>'html',
]);
}
}

if($step == "rasm"){
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💵 Hisobingizni to'ldirganlik haqida ma'lumot asosiy adminga yuborildi. Agar to'lovni amalga oshirganingiz haqida ma'lumot mavjud bo'lsa, Hisobingiz admin tomonidan avtomatik ravishda to'ldirib beriladi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menu
]);
unlink("step/$cid.step");
    bot('sendPhoto',[
        'chat_id'=>$admin,
        'photo'=>$file,
        'caption'=>"<b>📋 Foydalanuvchidan check.

👮‍♂️ Foydalanuvchi: <a href='https://t.me/$username'>$name</a>
🆔️ ID raqami: </b><code>$uid</code><b>
💵 To'lov miqdori: $saved</b>",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Qabul qilindi.",'callback_data'=>"on"],['text'=>"❌ Qabul qilinmadi.",'callback_data'=>"off"]],
]
])
]);
}

if($data == "on"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$save,
	'text'=>"<b>✅️ Hisobingizni $saved $valyuta ga to'ldirish bo'yicha yuborgan so'rovingiz qabul qilindi.</b>",
	'parse_mode'=>'html',
	]);
		bot('SendMessage',[
	'chat_id'=>$admin,
	'text'=>"<b>✅️ Foydalanuvchi hisobini $saved $valyuta ga to'ldirish bo'yicha yuborgan so'rovi qabul qilindi.</b>",
	'parse_mode'=>'html',
	]);
	unlink("step/id.txt");
	unlink("step/inew.txt");
}

if($data == "off"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$save,
	'text'=>"<b>❌️ Hisobingizni $saved $valyuta ga to'ldirish bo'yicha yuborgan so'rovingiz qabul qilinmadi.</b>",
	'parse_mode'=>'html',
	]);
		bot('SendMessage',[
	'chat_id'=>$admin,
	'text'=>"<b>❌️ Foydalanuvchi hisobini $saved $valyuta ga to'ldirish bo'yicha yuborgan so'rovi qabul qilinmadi.</b>",
	'parse_mode'=>'html',
	]);
	unlink("step/id.txt");
	unlink("step/inew.txt");
}


if($text == "🖥 Botlarni boshqarish" and joinchat($fid)==true){ 
$power = file_get_contents("power.txt");
if($power== "off"){
  bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Texnik xizmat davom etmoqda.

🔹️ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
🔹️ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
🔹️ Barcha funksiyalar tugallangandan keyin tiklanadi.

👮‍♂️ Agar siz ushbu botning adminstratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin.

🗄 Boshqarish | 📱 Rejim sozlamalari.

📱 Keyinroq qaytib keling, va bot holatini tekshirish uchun /start tugmasini bosing.</b>",
        'parse_mode'=>"html",
]);
}else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"<b>🤖 Botlarni boshqarish bo'limiga xush kelibsiz.</b>",
'parse_mode'=>"html",
    'reply_markup'=>$select_menu,
    ]);
}
}


if($text == "⚙️ Botni sozlash" and joinchat($fid)==true){
$botname = file_get_contents("baza/$cid/bots1.txt");
$botname2 = file_get_contents("baza/$cid/bots2.txt");
$botname3 = file_get_contents("baza/$cid/bots3.txt");
$botname4 = file_get_contents("baza/$cid/bots4.txt");
$botname5 = file_get_contents("baza/$cid/bots5.txt");
$botlarsoni = file_get_contents("baza/$cid/botsc.txt");
if($botname == ""){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📂 Sizda hech qanday bot mavjud emas.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi bot ochish",'callback_data'=>"orqaga"]],
]
])
]);
}else{
if($botlarsoni=="1"){
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⚙ 1. $botname",'callback_data'=>"settings ".$botname]],
]
]),
]);
}
if($botlarsoni=="2"){
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⚙ 1. $botname",'callback_data'=>"settings ".$botname]],
[['text'=>"⚙ 2. $botname2",'callback_data'=>"settings ".$botname2]],
]
]),
]);
}
if($botlarsoni=="3"){
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⚙ 1. $botname",'callback_data'=>"settings ".$botname]],
[['text'=>"⚙ 2. $botname2",'callback_data'=>"settings ".$botname2]],
[['text'=>"⚙ 3. $botname3",'callback_data'=>"settings ".$botname3]],
]
]),
]);
}
if($botlarsoni=="4"){
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⚙ 1. $botname",'callback_data'=>"settings ".$botname]],
[['text'=>"⚙ 2. $botname2",'callback_data'=>"settings ".$botname2]],
[['text'=>"⚙ 3. $botname3",'callback_data'=>"settings ".$botname3]],
[['text'=>"⚙ 4. $botname4",'callback_data'=>"settings ".$botname4]],
]
]),
]);
}

if($botlarsoni=="5"){
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⚙ 1. $botname",'callback_data'=>"settings ".$botname]],
[['text'=>"⚙ 2. $botname2",'callback_data'=>"settings ".$botname2]],
[['text'=>"⚙ 3. $botname3",'callback_data'=>"settings ".$botname3]],
[['text'=>"⚙ 4. $botname4",'callback_data'=>"settings ".$botname4]],
[['text'=>"⚙ 5. $botname5",'callback_data'=>"settings ".$botname5]],
]
]),
]);
}
}
}

if(mb_stripos($data,"settings") !== false){
    $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
    $kunlik = file_get_contents("https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/baza/$ccid/kunlik.txt");
        bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>💬 Buyurtma tanlandi: @$ismi

🔑 Bot tokeni: <code>$tokeni</code>
🔗 Bot useri: @$ismi
🗒 Bot turi: $turi
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: $kunlik kun
🔄 Bot holati: Faol
            
📋 Quyidagi tugmalar yordamida botingizni sozlashingiz mumkin.</b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
    [['text'=>"🔄 Buyurtmani yangilash",'callback_data'=>"yangilash ". $ismi]],
    [['text'=>"🗑 Buyurtmani o'chirish",'callback_data'=>"ochirish ". $ismi]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"select"]],
    ]
    ])
  ]);
}

if(mb_stripos($data,"yangilash") !== false){
  $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
    $kod = file_get_contents("pullik/$turi.php");
    $kod = str_replace("API_TOKEN", "$tokeni", $kod);
    $kod = str_replace("ADMIN_ID", "$ccid", $kod);
    $kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    file_put_contents("bots/$ccid/$turi/$turi.php","$kod");
        bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
file_put_contents("bots/$ccid/$turi/$turi.php","$kod");
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
    'text'=>"<b>✅️ @$ismi botingiz muvaffaqiyatli yangilandi.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"🔗 Botga kirish",'url'=>"https://t.me/$ismi"]],
]
])
]);
}

if(mb_stripos($data,"ochirish") !== false){
       $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
        bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
    'text'=>"<b>🗑️ Siz haqiqatdan ham @$ismi buyurtmangizni oʻchirmoqchimisiz.</b>",
    'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Ha",'callback_data'=>"ha ". $ismi],
['text'=>"❌ Yo‘q",'callback_data'=>"settings ". $ismi]],
]
])
]);
}

if(mb_stripos($data,"ha") !== false){
       $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
   'text'=>"<b>✅️ @$ismi ni o'chirish muvaffaqiyatli amalga oshirildi.</b>",
    'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
]
])
]);
deleteFolder("bots/$ccid");
deleteFolder("baza/$ccid");
deleteFolder("inew/$cid2.max");
}

if($data == "botyoq"){
	bot('deleteMessage',[
	'chat_id'=>$ccid,
	'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📂 Sizda hech qanday bot mavjud emas.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi bot ochish",'callback_data'=>"orqaga"]],
]
])
]);
}


if($text == "$key9" and joinchat($fid)==true){
$adminuser = file_get_contents("admin/user.txt");
$power = file_get_contents("power.txt");
if($power== "off"){
  bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Texnik xizmat davom etmoqda.

🔹️ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
🔹️ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
🔹️ Barcha funksiyalar tugallangandan keyin tiklanadi.

👮‍♂️ Agar siz ushbu botning adminstratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin.

🗄 Boshqarish | 📱 Rejim sozlamalari.

📱 Keyinroq qaytib keling, va bot holatini tekshirish uchun /start tugmasini bosing.</b>",
        'parse_mode'=>"html",
]);
}else{
bot('SendVideo',[
'chat_id'=>$cid,
'video'=>"https://t.me/GlobalBuilder/2448",
'caption'=>"<b>🤖 Botimizni ishlatish videosi, Bu videoni bizning You tube kanalimizdan ham tomosha qilishingiz mumkin.


📹 Video yaratuvchi : @$adminuser
🤖 Botimiz: @$botname</b>",
'parse_mode'=>'html',
'reply_markup'=>$select_menu,
]);
}
}


if($text == "💵 To'lov qilish" and joinchat($fid)==true){
$bot = file_get_contents("baza/$cid/bots1.txt");
$bot2 = file_get_contents("baza/$cid/bots2.txt");
$bot3 = file_get_contents("baza/$cid/bots3.txt");
$bot4 = file_get_contents("baza/$cid/bots4.txt");
$bot5 = file_get_contents("baza/$cid/bots5.txt");
$botlarsoni = file_get_contents("baza/$cid/botsc.txt");
if ($bot == ""){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📂 Sizda hech qanday bot mavjud emas.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi bot ochish",'callback_data'=>"orqaga"]],
]
])
]);
}else{
if($botlarsoni=="1"){
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💵 1. $bot",'callback_data'=>"tolov ".$bot]],
]
]),
]);
}
if($botlarsoni=="2"){
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💵 1. $bot",'callback_data'=>"tolov ".$bot]],
[['text'=>"💵 2. $bot2",'callback_data'=>"tolov ".$bot2]],
]
]),
]);
}
if($botlarsoni=="3"){
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💵 1. $bot",'callback_data'=>"tolov ".$bot]],
[['text'=>"💵 2. $bot2",'callback_data'=>"tolov ".$bot2]],
[['text'=>"💵 3. $bot3",'callback_data'=>"tolov ".$bot3]],
]
]),
]);
}
if($botlarsoni=="4"){
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💵 1. $bot",'callback_data'=>"tolov ".$bot]],
[['text'=>"💵 2. $bot2",'callback_data'=>"tolov ".$bot2]],
[['text'=>"💵 3. $bot3",'callback_data'=>"tolov ".$bot3]],
[['text'=>"💵 4. $bot4",'callback_data'=>"tolov ".$bot4]],
]
]),
]);
}
if($botlarsoni=="5"){
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💵 1. $bot",'callback_data'=>"tolov ".$bot]],
[['text'=>"💵 2. $bot2",'callback_data'=>"tolov ".$bot2]],
[['text'=>"💵 3. $bot3",'callback_data'=>"tolov ".$bot3]],
[['text'=>"💵 4. $bot4",'callback_data'=>"tolov ".$bot4]],
[['text'=>"💵 5. $bot5",'callback_data'=>"tolov ".$bot5]],
]
]),
]);
}
}
}

if(mb_stripos($data,"tolov") !== false){
    $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
        bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>💬 Buyurtma tanlandi: @$ismi

📅 1 kunlik to'lov - 150 $valyuta
📅 5 kunlik to'lov - 550 $valyuta
📅 10 kunlik to'lov - 1500 $valyuta
📅 20 kunlik to'lov - 2500 $valyuta
📅 30 kunlik to'lov - 3500 $valyuta</b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
    [['text'=>"💵 To‘lov qilish",'callback_data'=>"tolash ". $ismi]],
[['text'=>"◀️ Orqaga",'callback_data'=>"select"]],
    ]
    ])
    ]);
}

if(mb_stripos($data,"tolash") !== false){
    $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
        bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>📅 Necha kunlik to'lovni amalga oshirmoqchisiz.

📅 1 kunlik to'lov - 150 $valyuta
📅 5 kunlik to'lov - 550 $valyuta
📅 10 kunlik to'lov - 1500 $valyuta
📅 20 kunlik to'lov - 2500 $valyuta
📅 30 kunlik to'lov - 3500 $valyuta</b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
    [['text'=>"1",'callback_data'=>"1". $ismi],['text'=>"5",'callback_data'=>"5". $ismi],['text'=>"10",'callback_data'=>"10". $ismi],['text'=>"20",'callback_data'=>"20". $ismi],['text'=>"30",'callback_data'=>"30". $ismi]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"select"]],
    ]
    ])
    ]);
}

if(mb_stripos($data,"1") !== false){
	$pul = file_get_contents("referal/$ccid.txt");
	if($pul >= 150){
$pul = file_get_contents("referal/$ccid.txt");
$mm=$pul-150;
file_put_contents("referal/$ccid.txt","$mm");
$kunlik = file_get_contents("baza/$ccid/kunlik.txt");
$m = $kunlik + 1;
file_put_contents("baza/$ccid/kunlik.txt","$m");
    $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
        bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>📅 Botingiz uchun 1 kunlik to'lov muvaffaqiyatli amalga oshirildi.

💵 Hisobingizdan 150 $valyuta yechib olindi.</b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"select"]],
    ]
    ])
    ]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"😔 Afsuski, hisobingizda mablag‘ yetarli emas.",
	'show_alert'=>true,
	]);
}
}

if(mb_stripos($data,"5") !== false){
	$pul = file_get_contents("referal/$ccid.txt");
	if($pul >= 550){
$pul = file_get_contents("referal/$ccid.txt");
$mm=$pul-550;
file_put_contents("referal/$ccid.txt","$mm");
$kunlik = file_get_contents("baza/$ccid/kunlik.txt");
$m=$kunlik + 5;
file_put_contents("baza/$ccid/kunlik.txt","$m");
    $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
        bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>📅 Botingiz uchun 5 kunlik to'lov muvaffaqiyatli amalga oshirildi.

💵 Hisobingizdan 550 $valyuta yechib olindi.</b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"select"]],
    ]
    ])
    ]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"😔 Afsuski, hisobingizda mablag‘ yetarli emas.",
	'show_alert'=>true,
	]);
}
}

if(mb_stripos($data,"10") !== false){
	$pul = file_get_contents("referal/$ccid.txt");
	if($pul >= 1500){
$pul = file_get_contents("referal/$ccid.txt");
$mm=$pul-1500;
file_put_contents("referal/$ccid.txt","$mm");
$kunlik = file_get_contents("baza/$ccid/kunlik.txt");
$m=$kunlik + 10;
file_put_contents("baza/$ccid/kunlik.txt","$m");
    $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
        bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>📅 Botingiz uchun 10 kunlik to'lov muvaffaqiyatli amalga oshirildi.

💵 Hisobingizdan 1500 $valyuta yechib olindi.</b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"select"]],
    ]
    ])
    ]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"😔 Afsuski, hisobingizda mablag‘ yetarli emas.",
	'show_alert'=>true,
	]);
}
}

if(mb_stripos($data,"20") !== false){
	$pul = file_get_contents("referal/$ccid.txt");
	if($pul >= 2500){
$pul = file_get_contents("referal/$ccid.txt");
$mm=$pul - 2500;
file_put_contents("referal/$ccid.txt","$mm");
$kunlik = file_get_contents("baza/$ccid/kunlik.txt");
$m=$kunlik + 20;
file_put_contents("baza/$ccid/kunlik.txt","$m");
    $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
        bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>📅 Botingiz uchun 20 kunlik to'lov muvaffaqiyatli amalga oshirildi.

💵 Hisobingizdan 2500 $valyuta yechib olindi.</b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"select"]],
    ]
    ])
    ]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"😔 Afsuski, hisobingizda mablag‘ yetarli emas.",
	'show_alert'=>true,
	]);
}
}

if(mb_stripos($data,"30") !== false){
	$pul = file_get_contents("referal/$ccid.txt");
	if($pul >= 3500){
$pul = file_get_contents("referal/$ccid.txt");
$mm=$pul-3500;
file_put_contents("referal/$ccid.txt","$mm");
$kunlik = file_get_contents("baza/$ccid/kunlik.txt");
$m=$kunlik + 30;
file_put_contents("baza/$ccid/kunlik.txt","$m");
    $ex = explode(" ",$data);
    $ismi = $ex[1];
    $turi = file_get_contents("baza/$ccid/$ismi/turi.txt");
    $tokeni = file_get_contents("baza/$ccid/$ismi/token.txt");
        bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>📅 Botingiz uchun 30 kunlik to'lov muvaffaqiyatli amalga oshirildi.

💵 Hisobingizdan 3500 $valyuta yechib olindi.</b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"select"]],
    ]
    ])
    ]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"😔 Afsuski, hisobingizda mablag‘ yetarli emas.",
	'show_alert'=>true,
	]);
}
}


if($tx=="🗄 Buyurtmalar" and joinchat($fid) == "true"){
$power = file_get_contents("power.txt");
if($power== "off"){
  bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Texnik xizmat davom etmoqda.

🔹️ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
🔹️ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
🔹️ Barcha funksiyalar tugallangandan keyin tiklanadi.

👮‍♂️ Agar siz ushbu botning adminstratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin.

🗄 Boshqarish | 📱 Rejim sozlamalari.

📱 Keyinroq qaytib keling, va bot holatini tekshirish uchun /start tugmasini bosing.</b>",
        'parse_mode'=>"html",
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🛍 Bot buyurtma qilish.

Ushbu jarayon haqida qisqacha ma'lumot berib o'tamiz.

1. Narx qanday bo'ladi?
 — Narx buyurtma qilinayotgan bot turi, funksiyalari va sarflanadigan resurslarga nisbatan belgilanadi.

2. Buyurtma maxsus botlar ro'yxatiga qo'shiladimi?
 — Albatta. Buyurtma tayyor bo'lgach, buyurtma qilingan bot uchun maxsus kod biriktiriladi.

🛍  Buyurtma qilingan bot oylik - kunlik to'lovi @$botname adminlari tomonidan belgilanadi. Buyurtma qilingan botning maxsus kodini va holatini buyurtmachi nazorat qilishi mumkin. Buyurtmaga biriktirilgan kod orqali ochilgan botlarni buyurtmachi yangilashi va o'chirishi imkonsiz va ularga bunday huquq berilmaydi.</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🛒 Buyurtma berish",'callback_data'=>"buy"]],
[['text'=>"🗄 Buyurtmalar ro'yhati",'callback_data'=>"byr"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"select"]],
]
])
]);
}
}

$adminuser = file_get_contents("admin/user.txt");
if($data == "buy"){
	bot('deleteMessage',[
	'chat_id'=>$ccid,
	'message_id'=>$cmid,
]);
bot('SendMessage',[
  'chat_id'=>$ccid,
  'text'=>"🛍 Buyurtma qilmoqchi bo'lgan botingizning nomini yuboring:",
  'reply_markup'=>$rpl,
    ]);
    }
    if($reply=="🛍 Buyurtma qilmoqchi bo'lgan botingizning nomini yuboring:"){
    bot('SendMessage',[
    'chat_id'=>$admin,
    'text'=>"<b>👮‍♂️ Sizga yangi buyurtma bor.

➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖

$text

➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖

👨🏻‍💻 Foydalanuvchi: <a href = 'tg://user?id=$uid'>$name</a>
📮 Havolasi: @$username
🆔️ ID raqami: <code>$uid</code>

➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖</b>",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"👨🏻‍💻 Adminstrator",'url'=>"https://t.me/$adminuser"]],
]
]),
]);
sleep(2);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🛍 Buyurtmangiz qabul qilindi. Noto'g'ri buyurtma uchun ban olishingiz mumkin. 24 soat ichida admin siz bilan bog'lanadi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$select_menu,
]);
}


if($tx=="➕ Yangi bot ochish" and joinchat($fid) == "true"){
$power = file_get_contents("power.txt");
if($power== "off"){
  bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Texnik xizmat davom etmoqda.

🔹️ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
🔹️ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
🔹️ Barcha funksiyalar tugallangandan keyin tiklanadi.

👮‍♂️ Agar siz ushbu botning adminstratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin.

🗄 Boshqarish | 📱 Rejim sozlamalari.

📱 Keyinroq qaytib keling, va bot holatini tekshirish uchun /start tugmasini bosing.</b>",
        'parse_mode'=>"html",
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"📁 Konstruktor botlar",'callback_data'=>"konstruktor"]],
[['text'=>"📁 Biznes botlar",'callback_data'=>"biznesbotlar"]],
[['text'=>"📁 Nakrutka botlar",'callback_data'=>"nakrutkabotlar"]],
[['text'=>"📁 Antiqa botlar",'callback_data'=>"antiqabotlar"]],
[['text'=>"📁 O'yin uchun botlar",'callback_data'=>"oyinbotlar"]],
]
])
]);
}
}


if($data == "orqaga"){
	bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
	'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"📁 Konstruktor botlar",'callback_data'=>"konstruktor"]],
[['text'=>"📁 Biznes botlar",'callback_data'=>"biznesbotlar"]],
[['text'=>"📁 Nakrutka botlar",'callback_data'=>"nakrutkabotlar"]],
[['text'=>"📁 Antiqa botlar",'callback_data'=>"antiqabotlar"]],
[['text'=>"📁 O'yin uchun botlar",'callback_data'=>"oyinbotlar"]],
]
])
]);
}



if($data == "konstruktor"){
$status = file_get_contents("status.txt");
if($status== "off"){
bot("answerCallbackQuery",[
    "callback_query_id"=>$callid,
    'text'=>"🛑 Konstruktor botlar yaratish vaqtincha o'chirilgan.",
    "show_alert"=>true,
]);
}else{
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>⬇️ Quyidagi botlardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🔒 Konstruktor bot",'callback_data'=>"error"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]],
]
])
]);
}
}

if($data == "oyinbotlar"){
$status = file_get_contents("status.txt");
if($status== "off"){
bot("answerCallbackQuery",[
    "callback_query_id"=>$callid,
    'text'=>"🛑 O'yin uchun botlar yaratish vaqtincha o'chirilgan.",
    "show_alert"=>true,
]);
}else{
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>⬇️ Quyidagi botlardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🤖 UC bot - $ucbotnarx",'callback_data'=>"Uc"]],
[['text'=>"🤖 Almaz bot - $almazbotnarx",'callback_data'=>"almazbot"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]],
]
])
]);
}
}

if($data == "biznesbotlar"){
$status = file_get_contents("status.txt");
if($status== "off"){
bot("answerCallbackQuery",[
    "callback_query_id"=>$callid,
    'text'=>"🛑 Biznes botlar yaratish vaqtincha o'chirilgan.",
    "show_alert"=>true,
]);
}else{
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>⬇️ Quyidagi botlardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🤖 Pul bot - $pulbotnarx ",'callback_data'=>"pulbot"]],
[['text'=>"🤖 MB bot - $mbbotnarx",'callback_data'=>"mbbot"]],
[['text'=>"🤖 Rubl bot - $rublbotnarx",'callback_data'=>"rublbot"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]],
]
])
]);
}
}

if($data == "antiqabotlar"){
$status = file_get_contents("status.txt");
if($status== "off"){
bot("answerCallbackQuery",[
    "callback_query_id"=>$callid,
    'text'=>"🛑 Antiqa botlar yaratish vaqtincha o'chirilgan.",
    "show_alert"=>true,
]);
}else{
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>⬇️ Quyidagi botlardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🤖 TurfaXil bot - $turfabotnarx",'callback_data'=>"turfa"]],
[['text'=>"🤖 Harfgavideo bot - $harfbotnarx",'callback_data'=>"harf"]],
[['text'=>"🤖 AutoNumber bot - $raqambotnarx",'callback_data'=>"raqam"]],
[['text'=>"🤖 Rasm bot - $rasmbotnarx",'callback_data'=>"rasm"]],
[['text'=>"🤖 Save bot - $savebotnarx",'callback_data'=>"save"]],
[['text'=>"🔒 Savdo bot",'callback_data'=>"error"]],
[['text'=>"🔒 Rasmchi bot",'callback_data'=>"error"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]],
]
])
]);
}
}

if($data == "nakrutkabotlar"){
$status = file_get_contents("status.txt");
if($status== "off"){
bot("answerCallbackQuery",[
    "callback_query_id"=>$callid,
    'text'=>"🛑 Nakrutka botlar yaratish vaqtincha o'chirilgan.",
    "show_alert"=>true,
]);
}else{
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>⬇️ Quyidagi botlardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🤖 SpecialSMM Premium - $premiumbotnarx",'callback_data'=>"smmpremium"]],
[['text'=>"🤖 UzgrameBot - $uzgramebotnarx",'callback_data'=>"uzgrame"]],
[['text'=>"🤖 SpecialSMM - $smmbotnarx",'callback_data'=>"smmm"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]],
]
])
]);
}
}


if($data == "error"){
bot("answerCallbackQuery",[
    "callback_query_id"=>$callid,
    'text'=>"🔒 Kechirasiz, ushbu bot aktiv holatda emas.",
    "show_alert"=>true,
]);
}


if($data == "pulbot"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Pul bot

🤖 Botning imkoniyatlari: $pulbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💵 Narxi: $pulbotnarx $valyuta

💳 Bot ochish narxi: $pulbotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: 0 CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"pulbots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]],
]
])
]);
}

if($data == "uc"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 UC bot

🤖 Botning imkoniyatlari: $ucbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $ucbotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!


💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"ucbots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]],
]
])
]);
}


if($data == "mbbot"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 MB bot

🤖 Botning imkoniyatlari: $mbbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $mbnarxbot / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"mbbots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]],
]
])
]);
}

if($data == "rublbot"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Rubl bot

🤖 Botning imkoniyatlari: $rublbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $rublbotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"rublbots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Standart"]],
]
])
]);
}

if($data == "almazbot"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Almaz bot

🤖 Botning imkoniyatlari: $almazbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $almazbotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"almazbots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Standart"]],
]
])
]);
}

if($data == "turfa"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 TurfaXil bot

🤖 Botning imkoniyatlari: $turfabottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $turfabotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"turfabots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Standart"]],
]
])
]);
}

if($data == "harf"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 HarfgaVideo bot

🤖 Botning imkoniyatlari: $harfbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $harfbotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"harfbots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]],
]
])
]);
}

if($data == "raqam"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 AutuNumber bot

🤖 Botning imkoniyatlari: $raqambottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $raqambotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"raqambots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]],
]
])
]);
}

if($data == "rasm"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Rasm bot

🤖 Botning imkoniyatlari: $rasmbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $rasmbotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"rasmbots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]],
]
])
]);
}


if($data == "rasmchi"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Rasmchi bot

🤖 Botning imkoniyatlari: $rasmchibottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $rasmchibotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"error"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]],
]
])
]);
}

if($data == "save"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Save bot

🤖 Botning imkoniyatlari: $savebottavsif

?? Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $savebotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"savebots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]],
]
])
]);
}

if($data == "savdo"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Savdo bot

🤖 Botning imkoniyatlari: $savdobottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $savdobotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"error"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]],
]
])
]);
}

if($data == "smmm"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 SpecialSMM bot

🤖 Botning imkoniyatlari: $smmbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $smmbotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"smmbots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Premium"]],
]
])
]);
}

if($data == "uzgrame"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 UzGrame bot

🤖 Botning imkoniyatlari: $uzgramebottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $uzgramebotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"uzgramebots"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Premium"]],
]
])
]);
}

if($data == "smmpremium"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 SpecialSMM Premium bot

🤖 Botning imkoniyatlari: $uzgramebottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $premiumbotnarx / 1 CreateCard

‼️ Unutmang! Bot ochilgan kundan boshlab, 31 kundan so'ng, bot uchun oylik (yoki kunlik) to'lov to'lashingiz kerak!

💵 Balansingiz: $get $valyuta
🎫 Bot ochish uchun kartalaringiz: $createcard CreateCard</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"smmpre"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"Premium"]],
]
])
]);
}

if($data == "pulbots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $pulbotnarx){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","pulbot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}

if($userstep == "pulbot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/PulBot.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/PulBot");
    if(file_get_contents("bots/$cid/PulBot/PulBot.php")){
        unlink("bots/$cid/PulBot/PulBot.php");
        unlink("bots/$cid/PulBot/usid.txt");
        unlink("bots/$cid/PulBot/grid.txt");
        }
        file_put_contents("bots/$fid/PulBot/PulBot.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/PulBot/PulBot.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","PulBot");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Standart"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $pulbotnarx;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}

if($data == "ucbots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $ucbotnarx){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","ucbot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"⚠️ Siz bot ocha olmaysiz, limitga yetib kelgansiz, bot ochish limiti 10-ta",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
}
}
}

if($userstep == "ucbot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/uc.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/ucbot");
    if(file_get_contents("bots/$cid/ucbot/uc.php")){
        unlink("bots/$cid/ucbot/uc.php");
        unlink("bots/$cid/ucbot/usid.txt");
        unlink("bots/$cid/ucbot/grid.txt");
        }
        file_put_contents("bots/$fid/ucbot/uc.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/ucbot/uc.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","uc");
        file_put_contents("statistika/$cid.stop", $stopp + 1); 
        $stopp = file_get_contents("Statistika/$admin.stop");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Standart"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $ucbotnarx;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}

//mbbot
if($data == "mbbots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $mbbotnarx){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","mbbot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "mbbot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/MBBot.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/MBBot");
    if(file_get_contents("bots/$cid/MBBot/MBBot.php")){
        unlink("bots/$cid/MBBot/MBBot.php");
        unlink("bots/$cid/MBBot/usid.txt");
        unlink("bots/$cid/MBBot/grid.txt");
        }
        file_put_contents("bots/$fid/MBBot/MBBot.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/MBBot/MBBot.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","MBBot");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Standart"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $mbbotnarx;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}

if($data == "rublbots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $rublbotnarx){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","rublbot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "rublbot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/RublBot.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/RublBot");
    if(file_get_contents("bots/$cid/RublBot/RublBot.php")){
        unlink("bots/$cid/RublBot/RublBot.php");
        unlink("bots/$cid/RublBot/usid.txt");
        unlink("bots/$cid/RublBot/grid.txt");
        }
        file_put_contents("bots/$fid/RublBot/RublBot.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/RublBot/RublBot.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","RublBot");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Standart"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $rublbotnarx;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}

//almazbot
if($data == "almazbots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $almazbotnarx){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","almazbot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "almazbot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/AlmazBot.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/AlmazBot");
    if(file_get_contents("bots/$cid/AlmazBot/AlmazBot.php")){
        unlink("bots/$cid/AlmazBot/AlmazBot.php");
        unlink("bots/$cid/AlmazBot/usid.txt");
        unlink("bots/$cid/AlmazBot/grid.txt");
        }
        file_put_contents("bots/$fid/AlmazBot/AlmazBot.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/AlmazBot/AlmazBot.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","AlmazBot");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Standart"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $almazbotnarx;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}

//maxsusbotlar
//turfabot
if($data == "turfabots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $Maxsus){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","turfaxil&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "turfaxil&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/TurfaXil.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/TurfaXil");
    if(file_get_contents("bots/$cid/TurfaXil/TurfaXil.php")){
        unlink("bots/$cid/TurfaXil/TurfaXil.php");
        unlink("bots/$cid/TurfaXil/usid.txt");
        unlink("bots/$cid/TurfaXil/grid.txt");
        }
        file_put_contents("bots/$fid/TurfaXil/TurfaXil.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/TurfaXil/TurfaXil.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","TurfaXil");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $Maxsus;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}
//harfgavideo
if($data == "harfbots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $Maxsus){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","harfbot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "harfbot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/HarfgaVideoBot.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/HarfgaVideoBot");
    if(file_get_contents("bots/$cid/HarfgaVideoBot/HarfgaVideoBot.php")){
        unlink("bots/$cid/HarfgaVideoBot/HarfgaVideoBot.php");
        unlink("bots/$cid/HarfgaVideoBot/usid.txt");
        unlink("bots/$cid/HarfgaVideoBot/grid.txt");
        }
        file_put_contents("bots/$fid/HarfgaVideoBot/HarfgaVideoBot.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/HarfgaVideoBot/HarfgaVideoBot.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","HarfgaVideoBot");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $Maxsus;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}
//autonumber
if($data == "raqambots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $Maxsus){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","autonumberbot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "autonumberbot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/AutoNumber.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/AutoNumber");
    if(file_get_contents("bots/$cid/autonumberbot/AutoNumber.php")){
        unlink("bots/$cid/AutoNumber/AutoNumber.php");
        unlink("bots/$cid/AutoNumber/usid.txt");
        unlink("bots/$cid/AutoNumber/grid.txt");
        }
        file_put_contents("bots/$fid/AutoNumber/AutoNumber.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/AutoNumber/AutoNumber.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","AutoNumber");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $Maxsus;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}
//rasmbot
if($data == "rasmbots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $Maxsus){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","rasmbot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "rasmbot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/RasmBot.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/RasmBot");
    if(file_get_contents("bots/$cid/RasmBot/RasmBot.php")){
        unlink("bots/$cid/RasmBot/RasmBot.php");
        unlink("bots/$cid/RasmBot/usid.txt");
        unlink("bots/$cid/RasmBot/grid.txt");
        }
        file_put_contents("bots/$fid/RasmBot/RasmBot.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/RasmBot/RasmBot.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","RasmBot");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $Maxsus;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}
//savebot
if($data == "savebots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $Maxsus){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","savebot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "savebot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/SaveBot.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/SaveBot");
    if(file_get_contents("bots/$cid/SaveBot/SaveBot.php")){
        unlink("bots/$cid/SaveBot/SaveBot.php");
        unlink("bots/$cid/SaveBot/usid.txt");
        unlink("bots/$cid/SaveBot/grid.txt");
        }
        file_put_contents("bots/$fid/SaveBot/SaveBot.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/SaveBot/SaveBot.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","SaveBot");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Maxsus"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $Maxsus;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}
//smmpremium
if($data == "smmpre"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $Premium){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","smmpremium&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "smmpremium&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/cheksiz.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/smmpremium");
    if(file_get_contents("bots/$cid/smmpremium/cheksiz.php")){
        unlink("bots/$cid/smmpremium/cheksiz.php");
        unlink("bots/$cid/smmpremium/usid.txt");
        unlink("bots/$cid/smmpremium/grid.txt");
        }
        file_put_contents("bots/$fid/smmpremium/cheksiz.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/smmpremium/cheksiz.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt"," SpecilaSMM Premium");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Premium"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $Premium;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}
//uzgramebot
if($data == "uzgramebots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $Premium){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","uzgrambot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "uzgrambot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/uzgrame.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/uzgrame");
    if(file_get_contents("bots/$cid/uzgrame/uzgrame.php")){
        unlink("bots/$cid/uzgrame/uzgrame.php");
        unlink("bots/$cid/uzgrame/usid.txt");
        unlink("bots/$cid/uzgrame/grid.txt");
        }
        file_put_contents("bots/$fid/uzgrame/uzgrame.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/uzgrame/uzgrame.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","uzgrame");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Premium"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $Premium;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}
//premiumbotlar
//smm
if($data == "smmbots"){
$limite = file_get_contents("inew/$cid2.limite");
$max = file_get_contents("inew/$cid2.max");
 $get = file_get_contents("referal/$ccid.txt");
if($max < $limite){
 if($get < $Premium){
    bot('editMessageText',[
    'chat_id'=>$ccid,
   'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]]
    ]
    ])
    ]);
 }else{
 bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
    bot('SendMessage',[
   'chat_id'=>$ccid,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:
  
Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
    ]
    ])
    ]);
    file_put_contents("step/$ccid.txt","smmbot&token");
    }
    }else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"❌️ Siz faqat 1 ta bot yaratishingiz mumkin.

➕️ Yangi bot yaratmoqchi bo'lsangiz, oldingi ochgan botingizni ( 🛠 Botlarni sozlash ) bo'limi orqali o'chirib tashlashingiz lozim.",
	'show_alert'=>true,
	]);
}
}

if($userstep == "smmbot&token" and joinchat($fid)=="true"){
if(mb_stripos($tx, ":")!==false){
        $getid = bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Sizning buyurtmangiz yaratilmoqda.</b>",
        'parse_mode'=>"html",
        ])->result->message_id;
    $kod = file_get_contents("pullik/SpecialSMM.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
$kod = str_replace("ASOSIY", "$botname", $kod);
$kod = str_replace("AVAZBEK", "$admin", $kod);
    $kod = str_replace("ADMIN_USER", "$user", $kod);
    mkdir("bots/$cid/SpecialSMM");
    if(file_get_contents("bots/$cid/SpecialSMM/SpecialSMM.php")){
        unlink("bots/$cid/SpecialSMM/SpecialSMM.php");
        unlink("bots/$cid/SpecialSMM/usid.txt");
        unlink("bots/$cid/SpecialSMM/grid.txt");
        }
        file_put_contents("bots/$fid/SpecialSMM/SpecialSMM.php", $kod);

        $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/bots/$fid/SpecialSMM/SpecialSMM.php"))->result;

        if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
        $botlarsoni = file_get_contents("baza/$cid/botsc.txt");
        mkdir("baza/$cid/$user");
        file_put_contents("baza/$cid/$user/token.txt","$tx");
        file_put_contents("baza/$cid/$user/turi.txt","SpecialSMM");
        $botscount = $botlarsoni;
        $botscount = $botscount+1;
        file_put_contents("baza/$cid/botsc.txt","$botscount");
        file_put_contents("baza/$cid/bots$botscount.txt","$user");
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$getid,
        'text'=>"<b>🔰 Buyurtmangiz tayyor.

💬 Buyurtma raqami: $buyurtma
🔑 Bot tokeni: </b><code>$tx</code><b>
📆 Buyurtma qilingan sana: $sana
⏰️ Buyurtma qilingan vaqt: $time
⏳️ Qolgan kun: 1/30
🔄 Bot holati: Faol
ℹ️ Bot usernamesi: @$user

botni /mrdevuz, /panel, /admin orqali sozlaysiz.
📋 Quyidagi tugma orqali botingizga oʻtishingiz mumkin.</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        "inline_keyboard"=>[
        [["text"=>"🔗 Botga kirish ","url"=>"https://t.me/$user"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"Premium"]]
        ]
        ])
        ]);
        $gett = file_get_contents("referal/$fid.txt");
        $gett -= $Premium;
        file_put_contents("referal/$fid.txt", $gett);
        $getssss = file_get_contents("Statistika/botm.txt");
        $getssss += 1;
        file_put_contents("Statistika/botm.txt", $getssss);
        $max1 = file_get_contents("inew/$cid.max");
        $max2 = $max1 + 1;
        file_put_contents("inew/$cid.max",$max2);
        } else {        
    bot('deleteMessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid
    ]);        
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html",
    ]);
}
    unlink("step/$fid.txt");
    }else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"",
    'parse_mode'=>"html"
    ]);
  }
}

if($tx == "💳 Hisobim" and joinchat($fid)=="true"){
$odam = file_get_contents("odam/$cid.dat");
$get = file_get_contents("referal/$fid.txt");
$power = file_get_contents("power.txt");
if($power== "off"){
  bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Texnik xizmat davom etmoqda.

🔹️ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
🔹️ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
🔹️ Barcha funksiyalar tugallangandan keyin tiklanadi.

👮‍♂️ Agar siz ushbu botning adminstratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin.

🗄 Boshqarish | 📱 Rejim sozlamalari.

📱 Keyinroq qaytib keling, va bot holatini tekshirish uchun /start tugmasini bosing.</b>",
        'parse_mode'=>"html",
]);
}else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"<b>🗄 Sizning kabinetingiz:
├─ 🔎 UD: </b><code>$uid</code><b>
├─ 💵 Balansingiz: $get $valyuta
└─ 👥 Takliflaringiz soni: $odam ta</b>",
     'parse_mode'=>"html",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"➕ Pul kiritish",'callback_data'=>"oplata"],['text'=>"⚙️ Sozlamalar",'callback_data'=>"sozlamauz"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
    ]
  ])
]);
}
}


if($data == "sozlamauz"){
bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
     'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
     'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
       'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>⚙️ Sozlamalar bo'limiga xush kelibsiz.</b>",
        'parse_mode'=>"html",
        'message_id'=>$cmid,
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
        [['text'=>"💬 Interfeys tilini almashtirish",'callback_data'=>"intil"]],       
        [['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
        ]
      ])
   ]);
}

if($data == "intil"){
bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
     'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
     'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
       'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
        'parse_mode'=>"html",
        'message_id'=>$cmid,
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
        [['text'=>"🇺🇿 O'zbek tili - ✅",'callback_data'=>"uzbekchatil"]],       
        [['text'=>"◀️ Orqaga",'callback_data'=>"sozlamauz"]],
        ]
      ])
   ]);
}

if($data == "uzbekchatil"){
bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
     'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
     'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
       'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>💬 Siz ushbu tildan foydalanayapsiz.</b>",
        'parse_mode'=>"html",
        'message_id'=>$cmid,
        'reply_markup'=>json_encode([
	    'inline_keyboard'=>[
        [['text'=>"◀️ Orqaga",'callback_data'=>"sozlamauz"]],
        ]
      ])
   ]);
}


if($data == "reyting"){
$reyting = reyting();
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"$reyting",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
]
])
]);
}


function reyting(){
$tx = $message->text;
$ex=explode("_",$tx);
$text = "<b>🏆 ТOP 10 ta foydalanuvchilar:</b>\n\n";
$daten = [];
$rev = [];
$fayllar = glob("*referal/$ex[1]/*.*");
foreach($fayllar as $file){
if(mb_stripos($file,".txt")!==false){
$value = file_get_contents($file);
$id = str_replace(["referal/$ex[1]/",".txt"],["",""],$file);
$daten[$value] = $id;
$rev[$id] = $value;
}
echo $file;
}

asort($rev);
$reversed = array_reverse($rev);
for($i=0;$i<10;$i+=1){
$order = $i+1;
$id = $daten["$reversed[$i]"];
$text.= "<b>{$order}</b>. <a href='tg://user?id={$id}'>{$id}</a> - "."<b>".$reversed[$i]."</b>"." <b>$valyuta</b>"."\n";
}
return $text;
}

if($tx == "💵 Pul ishlash" and joinchat($fid) == "true"){
	$kanal = file_get_contents("admin/kanal.txt");
    $power = file_get_contents("power.txt");
if($power== "off"){
  bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Texnik xizmat davom etmoqda.

🔹️ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
🔹️ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
🔹️ Barcha funksiyalar tugallangandan keyin tiklanadi.

👮‍♂️ Agar siz ushbu botning adminstratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin.

🗄 Boshqarish | 📱 Rejim sozlamalari.

📱 Keyinroq qaytib keling, va bot holatini tekshirish uchun /start tugmasini bosing.</b>",
        'parse_mode'=>"html",
]);
}else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"<b>💵 Pul ishlash bo'limiga xush kelibsiz.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🔗 Taklifnoma",'callback_data'=>"refuz"]],
[['text'=>"🎮 O'yin xonasi",'callback_data'=>"game"]],
[['text'=>"🎁 Kunlik bonus",'callback_data'=>"bonusim"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
]
])
]);
}
}


if($data == "refuz"){
bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
     'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
     'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
       'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>⚡️ Sizning taklif havolalaringiz:</b>

<code>https://t.me/$botname?start=$ccid</code>

<b>👨‍💼 Do‘stingiz ushbu havola orqali ro‘yxatdan o‘tsa sizga $narx $valyuta beriladi.</b>",
        'parse_mode'=>"html",
'message_id'=>$cmid,
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🏆 Reyting",'callback_data'=>"reyting"]],
        [['text'=>"◀️ Orqaga",'callback_data'=>"pulser"]],
        ]
        ])
    ]);
}


$frid= $update->callback_query->from->id;
$kunlikbonus = file_get_contents("Narxlar/kunlikbonus.txt");
if($data == "bonusim"){
$minbon = file_get_contents("bonus/minbon.txt");
$maxbon = file_get_contents("bonus/maxbon.txt");
$bonustime = file_get_contents("bonus/$frid.txt");
$vaqt = date("d",strtotime("0 hour"));
$bonusrand = rand($minbon,$maxbon); 
if($bonustime == $vaqt){
bot("answerCallbackQuery",[
        "callback_query_id"=>$callid,
        'text'=>"😈 Siz bonus olib bo‘lgansiz.",
        'parse_mode'=>'html',
        "show_alert"=>true,
]);
}else{
$get = file_get_contents("referal/$frid.txt");
$bonus=$get+$bonusrand;
file_put_contents("referal/$frid.txt","$bonus");
file_put_contents("bonus/$frid.txt","$vaqt");
bot("answerCallbackQuery",[
        "callback_query_id"=>$callid,
        'text'=>"👏 Tabriklaymiz sizga $bonusrand $valyuta miqdorida kunlik bonus taqdim etildi.",
        'parse_mode'=>'html',
        "show_alert"=>true,
]);
}
}


if($data == "game"){
bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>🎮 O'yin xonasi bo'limiga xush kelibsiz.</b>",
    'parse_mode'=>'html',
    'message_id'=>$cmid,
    'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"💈 Baraban o'yini",'callback_data'=>"baraban"],['text'=>"🧰 Sandiq o'yini",'callback_data'=>"sandiq"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"pulser"]],
]
])
]);
}


if($data == "baraban"){
$get = file_get_contents("referal/$ccid.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💈 Baraban o'yini.

Bir marta aylantirish narxi - 3000 $valyuta (Asosiy balansdan sarflanadi). Yutib olgan pullaringiz asosiy balansingizga tushadi.

💸 Asosiy balansingiz: $get $valyuta.

💈 Barabandagi yutuqlar:
1000 $valyuta | 0 $valyuta | 2000 $valyuta | 0 $valyuta | 3000 $valyuta | 0 $valyuta | 4000 $valyuta | 0 $valyuta | 5000 $valyuta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💈 Baraban aylantirish - 100 $valyuta",'callback_data'=>"baraban75"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
]
])
]);
}
    
if($data == "baraban75"){
$rand = array('1000','0','2000','0','3000','0','4000','0','5000');
$ra = array_rand($rand, 1);
$sum= file_get_contents("referal/$ccid.txt");
if($sum>"3000") {
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💈 Baraban o'yini.

💸 Siz $rand[$ra] $valyuta yutib oldingiz, va ushbu pullar asosiy balansingizga qo'shildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
]
])
]);
$gett = file_get_contents("referal/$ccid.txt");
$gett -= 3000;
file_put_contents("referal/$ccid.txt", $gett);
$yut = file_get_contents("referal/$ccid.txt");
$yut += $rand[$ra];
file_put_contents("referal/$ccid.txt", $yut);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"toldir"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"baraban"]],
    ]
    ])
]);
}
}


if($data == "sandiq"){
$get = file_get_contents("referal/$ccid.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
    'text'=>"<b>🧰 Sandiq o'yini.

Agar omadingiz kelsa, tanlangan sandiq yordami undan ko'proq pul ishlashingiz mumkin.

💸 Asosiy balansingiz: $get $valyuta.

🧰 Yutishingiz ehtimoli: 50%</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"5000 $valyuta",'callback_data'=>"500som"],['text'=>"10000 $valyuta",'callback_data'=>"1000som"]],
    [['text'=>"15000 $valyuta",'callback_data'=>"10000som"],['text'=>"20000 $valyuta",'callback_data'=>"20000som"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
    ]
    ])
    ]);
    }

if($data == "500som"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
    'text'=>"<b>🧰 Sandiq o'yini orqali siz 5000 $valyutadan ko'proq $valyuta yutishingiz mumkin.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"5000 $valyuta",'callback_data'=>"500som"],['text'=>"10000 $valyuta",'callback_data'=>"1000som"]],
    [['text'=>"15000 $valyuta",'callback_data'=>"10000som"],['text'=>"20000 $valyuta",'callback_data'=>"20000som"]],
    [['text'=>"🧰 5000 $valyuta lik sandiq ochilsinmi",'callback_data'=>"ochsan"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
    ]
    ])
    ]);
    }

    
if($data == "ochsan"){
$rand = array('3000','0','4000','0','5000','0','6000','0','7000');
$ra = array_rand($rand, 1);
$sum= file_get_contents("referal/$ccid.txt");
if($sum>"5000") {
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💸 Siz $rand[$ra] $valyuta yutib oldingiz, va ushbu pullar asosiy balansingizga qo'shildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
]
])
]);
$gett = file_get_contents("referal/$ccid.txt");
$gett -= 5000;
file_put_contents("referal/$ccid.txt", $gett);
$yut = file_get_contents("referal/$ccid.txt");
$yut += $rand[$ra];
file_put_contents("referal/$ccid.txt", $yut);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"toldir"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"500som"]],
    ]
    ])
]);
}
}



if($data == "1000som"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
    'text'=>"<b>🧰 Sandiq o'yini orqali siz 10000 $valyuta dan ko'proq $valyuta yutishingiz mumkin.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"5000 $valyuta",'callback_data'=>"500som"],['text'=>"10000 $valyuta",'callback_data'=>"1000som"]],
    [['text'=>"15000 $valyuta",'callback_data'=>"10000som"],['text'=>"20000 $valyuta",'callback_data'=>"20000som"]],
    [['text'=>"🧰 10000 $valyuta lik sandiq ochilsinmi",'callback_data'=>"ochsan1"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
    ]
    ])
    ]);
    }

    
if($data == "ochsan1"){
$rand = array('8000','0','9000','0','10000','0','11000','0','12000');
$ra = array_rand($rand, 1);
$sum= file_get_contents("referal/$ccid.txt");
if($sum>"10000") {
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💸 Siz $rand[$ra] $valyuta yutib oldingiz, va ushbu pullar asosiy balansingizga qo'shildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
]
])
]);
$gett = file_get_contents("referal/$ccid.txt");
$gett -= 10000;
file_put_contents("referal/$ccid.txt", $gett);
$yut = file_get_contents("referal/$ccid.txt");
$yut += $rand[$ra];
file_put_contents("referal/$ccid.txt", $yut);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"toldir"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"1000som"]],
    ]
    ])
]);
}
}

if($data == "10000som"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
    'text'=>"<b>🧰 Sandiq o'yini orqali siz 15000 $valyuta dan ko'proq $valyuta yutishingiz mumkin.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"5000 $valyuta",'callback_data'=>"500som"],['text'=>"10000 $valyuta",'callback_data'=>"1000som"]],
    [['text'=>"15000 $valyuta",'callback_data'=>"10000som"],['text'=>"20000 $valyuta",'callback_data'=>"20000som"]],
    [['text'=>"🧰 15000 $valyuta lik sandiq ochilsinmi",'callback_data'=>"ochsan2"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
    ]
    ])
    ]);
    }

    
if($data == "ochsan2"){
$rand = array('13000','0','14000','0','15000','0','16000','0','17000');
$ra = array_rand($rand, 1);
$sum= file_get_contents("referal/$ccid.txt");
if($sum>"15000") {
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💸 Siz $rand[$ra] $valyuta yutib oldingiz, va ushbu pullar asosiy balansingizga qo'shildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
]
])
]);
$gett = file_get_contents("referal/$ccid.txt");
$gett -= 15000;
file_put_contents("referal/$ccid.txt", $gett);
$yut = file_get_contents("referal/$ccid.txt");
$yut += $rand[$ra];
file_put_contents("referal/$ccid.txt", $yut);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"toldir"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"10000som"]],
    ]
    ])
]);
}
}

if($data == "20000som"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
    'text'=>"<b>🧰 Sandiq o'yini orqali siz 20000 $valyuta dan ko'proq $valyuta yutishingiz mumkin.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"5000 $valyuta",'callback_data'=>"500som"],['text'=>"10000 $valyuta",'callback_data'=>"1000som"]],
    [['text'=>"15000 $valyuta",'callback_data'=>"10000som"],['text'=>"20000 $valyuta",'callback_data'=>"20000som"]],
    [['text'=>"🧰 20000 $valyuta lik sandiq ochilsinmi",'callback_data'=>"ochsan3"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
    ]
    ])
    ]);
    }

    
if($data == "ochsan3"){
$rand = array('18000','0','19000','0','20000','0','21000','0','22000');
$ra = array_rand($rand, 1);
$sum= file_get_contents("referal/$ccid.txt");
if($sum>"20000"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💸 Siz $rand[$ra] $valyuta yutib oldingiz, va ushbu pullar asosiy balansingizga qo'shildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"game"]],
]
])
]);
$gett = file_get_contents("referal/$ccid.txt");
$gett -= 20000;
file_put_contents("referal/$ccid.txt", $gett);
$yut = file_get_contents("referal/$ccid.txt");
$yut += $rand[$ra];
file_put_contents("referal/$ccid.txt", $yut);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
    'text'=>"<b>😔 Afsuski, hisobingizda mablag‘ yetarli emas.</b>",
    'parse_mode'=>"html",
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"toldir"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"20000som"]],
    ]
    ])
]);
}
}


if($data == "pulser"){
bot('editMessageText',[
        'chat_id'=>$ccid,
        'message_id'=>$cmid,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$ccid,
     'message_id'=>$cmid + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$ccid,
       'message_id'=>$cmid,
       'text'=>"<b>💸 Pul ishlash bo'limiga xush kelibsiz.</b>",
    'parse_mode'=>"html",
    'message_id'=>$cmid,
    'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"👤 Taklifnoma",'callback_data'=>"refuz"],
['text'=>"🛍 Xarid qilish",'callback_data'=>"oplata"]],
[['text'=>"🎮 O'yin xonasi",'callback_data'=>"game"],
['text'=>"🎁 Kunlik bonus",'callback_data'=>"bonusim"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
]
])
]);
}





if($tx == "📨 Yordam" and joinchat($fid) == "true"){
$kanal = file_get_contents("admin/kanal.txt");
$adminuser = file_get_contents("admin/user.txt");
$power = file_get_contents("power.txt");
if($power== "off"){
  bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Texnik xizmat davom etmoqda.

🔹️ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
🔹️ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
🔹️ Barcha funksiyalar tugallangandan keyin tiklanadi.

👮‍♂️ Agar siz ushbu botning adminstratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin.

🗄 Boshqarish | 📱 Rejim sozlamalari.

📱 Keyinroq qaytib keling, va bot holatini tekshirish uchun /start tugmasini bosing.</b>",
        'parse_mode'=>"html",
]);
}else{
  bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>📋 Bizga savollaringiz yoki taklif va muammolaringiz boʻlsa iltimos bizning qoʻllab-quvvatlash jamoamiz bilan bogʻlaning.

👨🏻‍💻 Adminstrator: @$adminuser</b>",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"📨 Bog'lanish",'callback_data'=>"boglan"],
['text'=>"📺 Xizmatlar",'callback_data'=>"xizm"]],
[['text'=>"‍👨🏻‍💻 Adminstrator",'url'=>"https://t.me/$adminuser"],
['text'=>"📢 Kanalimiz",'url'=>"https://t.me/editphp"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
   ]
  ])
]);
}
}

$adminuser = file_get_contents("admin/user.txt");
if($data == "boglan"){
	bot('deleteMessage',[
	'chat_id'=>$ccid,
	'message_id'=>$cmid,
]);
bot('SendMessage',[
  'chat_id'=>$ccid,
  'text'=>"📨 Bog'lanish uchun xabaringizni yuboring:",
  'reply_markup'=>$rpl,
    ]);
    }
    if($reply=="📨 Bog'lanish uchun xabaringizni yuboring:"){
    bot('SendMessage',[
    'chat_id'=>$admin,
    'text'=>"<b>👮‍♂️ Sizga yangi xabar bor.

➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖

$text

➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖

👨🏻‍💻 Foydalanuvchi: <a href = 'tg://user?id=$uid'>$name</a>
📮 Havolasi: @$username
🆔️ ID raqami: <code>$uid</code>

➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖</b>",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"👨🏻‍💻 Adminstrator",'url'=>"https://t.me/$adminuser"]],
]
]),
]);
sleep(2);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📨 Xabaringiz adminga yuborildi. Noto'g'ri shikoyat uchun ban olishingiz mumkin. 24 soat ichida admin siz bilan bog'lanadi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$main_menu,
]);
}

if($data == "xizm"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📺 Xizmatlar bo'limiga xush kelibsiz.</b>",
        'parse_mode'=>"html",
        'message_id'=>$cmid,
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🤖 Telegram Botlar",'callback_data'=>"teleg"],
['text'=>"🌐 Web Saytlar",'callback_data'=>"web"]],
[['text'=>"⚡ SMM Xizmatlar",'callback_data'=>"smm"],
['text'=>"📮 Reklama xizmati",'callback_data'=>"rek"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bogla"]],
   ]
  ])
]);
}

$adminuser = file_get_contents("admin/user.txt");
if($data == "teleg"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>🤖 Telegram Botlar

Biz sizga telegramda mukammal va ajoyib siz xoxlagandek qilib Telegram botlar tayyorlab beramiz! Bot turi sifati ishlashi dizayni siz xohlagandek bo'ladi!

Narxlar: 7$-150$ gacha

@RejimParvoz © 2022 - 2023</b>",
        'parse_mode'=>"html",
        'message_id'=>$cmid,
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🤖 Telegram Botlar",'callback_data'=>"teleg"],
['text'=>"🌐 Web Saytlar",'callback_data'=>"web"]],
[['text'=>"⚡ SMM Xizmatlar",'callback_data'=>"smm"],
['text'=>"📮 Reklama xizmati",'callback_data'=>"rek"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bogla"]],
   ]
  ])
]);
}

if($data == "web"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>🌐 Web Saytlar

Biz sizga Web-saytlar yaratib beramiz! Web sayt siz xohlagandek bo'ladi! Web-Sayt sifati ishlashi xavfsizligi dizayni siz xohlagandek bo'ladi!

Narxlar: 10$-500$ gacha

@RejimParvoz © 2022 - 2023</b>",
        'parse_mode'=>"html",
        'message_id'=>$cmid,
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🤖 Telegram Botlar",'callback_data'=>"teleg"],
['text'=>"🌐 Web Saytlar",'callback_data'=>"web"]],
[['text'=>"⚡ SMM Xizmatlar",'callback_data'=>"smm"],
['text'=>"📮 Reklama xizmati",'callback_data'=>"rek"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bogla"]],
   ]
  ])
]);
}

if($data == "smm"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>⚡ Smm Xizmatlar

Mening SMM dan xam xabarim bor! SMM da siz xohlagan proektni yarata olaman! YouTube Telegram kanallaringiz uchun Avatarkalar bannerlar tayyorlab beraman! Sifati dizayni hammasi siz xohlagandek bo'ladi!

Narxlar: 6$-100$ gacha

@RejimParvoz © 2022 - 2023</b>",
        'parse_mode'=>"html",
        'message_id'=>$cmid,
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🤖 Telegram Botlar",'callback_data'=>"teleg"],
['text'=>"🌐 Web Saytlar",'callback_data'=>"web"]],
[['text'=>"⚡ SMM Xizmatlar",'callback_data'=>"smm"],
['text'=>"📮 Reklama xizmati",'callback_data'=>"rek"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bogla"]],
   ]
  ])
]);
}

$reknarx = $lich*200;
$lichka=file_get_contents("shekih.db");
$lich=substr_count($lichka,"\n");
if($data == "rek"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>@$botname - bizning botimizda reklama berish xizmati.

👨‍💼 Bot foydalanuvchilari: $lich ta
👨🏻‍💻 Adminstrator: @$adminuser
📅 Hozirgi sana: $sana
⏰ Hozirgi vaqt: $time</b>",
        'parse_mode'=>"html",
        'message_id'=>$cmid,
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🤖 Telegram Botlar",'callback_data'=>"teleg"],
['text'=>"🌐 Web Saytlar",'callback_data'=>"web"]],
[['text'=>"⚡ SMM Xizmatlar",'callback_data'=>"smm"],
['text'=>"📮 Reklama xizmati",'callback_data'=>"rek"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bogla"]],
   ]
  ])
]);
}


if($data == "bogla"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Bizga savollaringiz yoki taklif va muammolaringiz boʻlsa iltimos bizning qoʻllab-quvvatlash jamoamiz bilan bogʻlaning.

👨🏻‍💻 Adminstrator: @$adminuser</b>",
        'parse_mode'=>"html",
        'message_id'=>$cmid,
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"📨 Bog'lanish",'callback_data'=>"boglan"],
['text'=>"📺 Xizmatlar",'callback_data'=>"xizm"]],
[['text'=>"👨🏻‍💻 Adminstrator",'url'=>"https://t.me/$adminuser"],
['text'=>"📢 Kanalimiz",'url'=>"https://t.me/EditPHP"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
   ]
  ])
]);
}


if($tx == "📋 Ma'lumotlar" and joinchat($fid)=="true"){
$kanal = file_get_contents("admin/kanal.txt");
$power = file_get_contents("power.txt");
if($power== "off"){
  bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"<b>🛠 Texnik xizmat davom etmoqda.

🔹️ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
🔹️ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
🔹️ Barcha funksiyalar tugallangandan keyin tiklanadi.

👮‍♂️ Agar siz ushbu botning adminstratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin.

🗄 Boshqarish | 📱 Rejim sozlamalari.

📱 Keyinroq qaytib keling, va bot holatini tekshirish uchun /start tugmasini bosing.</b>",
        'parse_mode'=>"html",
]);
}else{
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"<b>📋 Ma'lumotlar bo'limiga xush kelibsiz.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🖥 Bot haqida",'callback_data'=>"haqi"]],
[['text'=>"📮 Qoidalar",'callback_data'=>"qoida"],
['text'=>"📮 Qo'llanma",'callback_data'=>"qolla"]],
[['text'=>"👨🏻‍💻 Adminstrator",'url'=>"https://t.me/$adminuser"],
['text'=>"📢 Kanalimiz",'url'=>"https://t.me/EditPHP"]],
[['text'=>"☎️ Texnik yordam",'url'=>"tg://user?id=$admin"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
]
])
]);
}
}


if($data == "haqi"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"$haqida",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"malum"]],
    ]
   ])
 ]);
}

if($data == "qolla"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"$qollanma",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"malum"]],
     ]
   ])
 ]);
}

if($data == "qoida"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"$qoida",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"malum"]],
]
])
]);
}


if($data == "malum"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Ma'lumotlar bo'limiga xush kelibsiz.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🖥 Bot haqida",'callback_data'=>"haqi"]],
[['text'=>"📮 Qoidalar",'callback_data'=>"qoida"],
['text'=>"📮 Qo'llanma",'callback_data'=>"qolla"]],
[['text'=>"👨🏻‍💻 Adminstrator",'url'=>"https://t.me/$adminuser"],
['text'=>"📢 Kanalimiz",'url'=>"https://t.me/EditPHP"]],
[['text'=>"☎️ Texnik yordam",'url'=>"tg://user?id=$admin"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
]
])
]);
}

if(mb_stripos($text,"/update") !== false){ 
bot('sendMessage',[
 'chat_id'=>$cid,
 'text'=>"<b>🛠 Yangilanmoqda.</b>",
 'parse_mode'=>"html"
 ]);
  sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'text'=>'⬜⬜⬜⬜⬜⬜⬜⬜⬜⬜ 0%'
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid +1,
 'text'=>'⬛⬜⬜⬜⬜⬜⬜⬜⬜⬜  10%'
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'⬛⬛⬜⬜⬜⬜⬜⬜⬜⬜  20%'
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'⬛⬛⬛⬜⬜⬜⬜⬜⬜⬜  30%'
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'⬛⬛⬛⬛⬜⬜⬜⬜⬜⬜  40%'
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'⬛⬛⬛⬛⬛⬜⬜⬜⬜⬜  50%'
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'⬛⬛⬛⬛⬛⬛⬜⬜⬜⬜  60%'
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'⬛⬛⬛⬛⬛⬛⬛⬜⬜⬜  70%'
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'⬛⬛⬛⬛⬛⬛⬛⬛⬜⬜  80%'
]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'⬛⬛⬛⬛⬛⬛⬛⬛⬛⬜  90%'
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛  100%'
 ]); 
  bot('deletemessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid + 1,
  ]);
 sleep(0.3);
    bot('sendmessage', [
      'chat_id' =>$cid,
 'text' => "<b>✅ Sizning ma'lumotlaringiz yangilandi. 

👨🏻‍💻 Foydalanuvchi: <a href = 'tg://user?id=$uid'>$name</a>
📮 Havolasi: @$username
🆔️ ID raqami: </b><code>$uid</code>",
 'parse_mode'=>'html',  
 'message_id'=>$cmid,
 'reply_markup'=>$main_menu,
]);
}

if($text == "/speed"){
  $load = sys_getloadavg();
  $mem = memory_get_usage();
  $ver = phpversion();  
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"<b>🚀 Bot tezligi.
 	
▪️ Ping: </b><code>$load[0]</code><b>
▪️ Memory: </b><code>$mem KB</code><b>
▪️ Php version: </b><code>$ver</code>",
 'parse_mode'=>"html",
 'reply_to_message_id'=>$message_id,
  ]); 
 }


if($tx == "🗄 Boshqarish" or $text == "/panel"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$admin,
	'text'=>"<b>👨🏻‍💻 <a href = 'tg://user?id=$admin'>$name</a> admin paneliga xush kelibsiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
]);
}
}

if($data == "boshqarish"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>👨🏻‍💻 <a href = 'tg://user?id=$admin'>$name</a> admin paneliga xush kelibsiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
]);
}


if(isset($document)){
 $gett = bot('getChatMember', [
    'chat_id' =>$chat_id,
   'user_id' =>$cid,
   ]);
  $get = $gett->result->status;
  if($get =="member"){
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot ('SendMessage',[
"chat_id"=>$cid,
'text'=>"<b>🛑 Kechirasiz, ushbu botda fayl yuborish mumkin emas.</b>",
 'parse_mode'=>"html",
'reply_markup'=>$home,
]);
}
}


$bott = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
  [['text'=>"▶️ Botni yoqish | ON"],['text'=>"⏸️ Botni o'chirish | OFF"]],
  [['text'=>"▶️ Bot yaratish | ON"],['text'=>"⏸️ Bot yaratish | OFF"]],
  [['text'=>"◀️ Orqaga"]],
]
]);

if($tx =="📳 Bot holati" and ($cid) == $admin){
    bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"<b>🛠 Rejim sozlamalari bo'limiga xush kelibsiz.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>$bott,
]);
}


if($text == "⏸️ Botni o'chirish | OFF" && $cid == $admin){
bot('sendmessage',[
	'chat_id'=>$admin,
	'text'=>"⏸️ <b>@$botname da botni boshqarish rejimi o'chirildi.</b>",
  'parse_mode'=>'html',
  'reply_markup'=>$bott,
]);
file_put_contents("power.txt","off");
}

if($text == "▶️ Botni yoqish | ON" && $cid == $admin){
bot('sendmessage',[
	'chat_id'=>$admin,
	'text'=>"▶️ <b>@$botname da botni boshqarish rejimi yoqildi.</b>",
  'parse_mode'=>'html',
  'reply_markup'=>$bott,
]);
unlink("power.txt");
}


if($text == "⏸️ Bot yaratish | OFF" && $cid == $admin){
bot('sendmessage',[
	'chat_id'=>$admin,
	'text'=>"⏸️ <b>@$botname da bot yaratish rejimi o'chirildi.</b>",
  'parse_mode'=>'html',
  'reply_markup'=>$bott,
]);
file_put_contents("status.txt","off");
}

if($text == "▶️ Bot yaratish | ON" && $cid == $admin){
bot('sendmessage',[
	'chat_id'=>$admin,
	'text'=>"▶️ <b>@$botname da bot yaratish rejimi yoqildi.</b>",
  'parse_mode'=>'html',
  'reply_markup'=>$bott,
]);
unlink("status.txt");
}



$bonuschi = json_encode([
	'inline_keyboard'=>[
	[['text'=>"🚀 Bonus yuborish",'callback_data'=>"bonussend"]],	
    [['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]],	
	]
    ]);

$promokodchi = json_encode([
	'inline_keyboard'=>[
    [['text'=>"🎟 Promokod",'callback_data'=>"bonussends"]],	
    [['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]],	
	]
    ]);

if($tx =="⚙️ Asosiy sozlamalar" and ($cid)== $admin){
    bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"<b>⚙ Asosiy sozlamalar bo'limiga xush kelibsiz!

Nimani o'zgartiramiz?</b>",
    'parse_mode'=>"html",
    'reply_markup'=>$panels,
]);
}

if($tx =="🎁 Bonus yuborish" and ($cid)== $admin){
    bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"<b>🚀 Bonus sozlamalari bo'limiga xush kelibsiz.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>$bonuschi,
]);
}

if($tx =="🎟 Promokod" and ($cid)== $admin){
    bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"<b>🚀 Bonus sozlamalari bo'limiga xush kelibsiz.</b>",
    'parse_mode'=>"html",
    'reply_markup'=>$promokodchi,
]);
}

if($data == "bonussends"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot("sendmessage",[
'chat_id'=>$admin,
'text'=>"<b>🎟 Quyidagi tartibda promokod yarating:
 
Namuna: </b><code>/bonus AUF</code>",
'parse_mode'=>'html',
'reply_markup'=>$rpl,
]);
}
$promo = file_get_contents("ch1.txt");
$ball = file_get_contents("ch2.txt");
$aa = "@$bonkan";
$ab = "@$bonkan";
if(mb_stripos($text, "/bonus")!==false){
if($cid == $admin){
	$m1 = explode(" ",$text);
 $m2 = $m1[1];
 file_put_contents("ch1.txt","$m2");
 bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🎟 Promokod miqdorini quyidagi tartibda yuboring:

Namuna: </b><code>/ball 10</code>",
'parse_mode'=>'html',
'reply_markup'=>$rpl,
]);
}
}

if(mb_stripos($text, "/ball")!==false){
if($cid == $admin){
	$m1 = explode(" ",$text);
 $m2 = $m1[1];
 file_put_contents("ch2.txt","$m2");
 bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🎟 Promokod @$bonkan kanaliga yuborildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
 ]);
 bot("sendmessage",[
 'chat_id'=>$aa,
 'text'=>"<b>🆕 Yangi promkod
🎟 Promokod: $promo
🟢 Holati: Faol
💵 Miqdori: $m2 $valyuta </b>",
 'parse_mode'=>'html',
 'reply_markup'=>json_encode([
 'inline_keyboard'=>[
[['text'=>"🎁 Promkodni olish", "url"=>"https://t.me/$botname?start=$promo"]],
]
])
]);
}
}

if($text=="/start $promo"){
$olmos = file_get_contents("referal/$cid.txt");
$miqdor = $olmos + $ball;
file_put_contents("referal/$cid.txt","$miqdor");
bot("sendmessage",[
'chat_id'=>$cid,
'text'=>"<b>🎉 Tabriklaymiz, sizga $ball $valyuta miqdorida bonus berildi.</b>",
'parse_mode'=>"html",
]);
unlink("ch1.txt");
bot('sendMessage',[
'chat_id'=>$ab,
'text'=>"<b> Promkod ishlatildi
🎁 G'olib: $name
🛑 Holati: Nofaol</b>",
'parse_mode'=>'html',
]);
unlink("ch2.txt");
}


if($data == "bonussend"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"<b>🚀 Bonusdan qancha odam foydalanishini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>$rpl,
]);
file_put_contents("$admin.ttxt","bonusa");
unlink('rubl/olindi1.txt');
unlink('rubl/berildi1.txt');
}

if($bonusuz=="bonusa" and $cid==$admin){
file_put_contents("bonus2.txt","$text");
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"<b>🎟 Promokod @$bonkan kanaliga yuborildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,    
]);
unlink("$admin.ttxt");
bot('sendMessage',[
'chat_id'=>"@$bonkan",
'text'=>"<b>🚀 Oʻyin boshlandi.
🎁 Oʻz sovgʻangizni oling.
👥 Qatnashchi: 0 nafar
👤 Ishtirok etdi: 0/0
💰 Bepul 0 $valyuta tarqatildi.
👨🏻‍💻 Adminstrator: @$adminuser
🤖 Botimiz: @$botname</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎁 Bonus olish","callback_data"=>"bo"]],
]
]),
]);
}

if($data == "bo"){
$olindi=file_get_contents("bonus2.txt");
$ee1 = file_get_contents("rubl/olindi1.txt");
$eea = substr_count($ee1,"\n"); 
if($eea==$olindi or $olindi==$eea){
bot('deleteMessage',[
'chat_id'=>"@$bonkan",
'message_id'=>$cmid,
]);
}else{
$id = $update->callback_query->id;
$frid= $update->callback_query->from->id;
$ee1 = file_get_contents("rubl/olindi1.txt");
if(mb_stripos($ee1,$frid)!==false){
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"😈 Siz bonus olib bo'lgansiz.",
"show_alert"=>true,
]);
}else{
$vipbonus= file_get_contents("Narxlar/vipbonus.txt");
$bonusrand = rand($kanalmin,$kanalmax);
$id = $update->callback_query->id;
$pul = file_get_contents("referal/$frid.txt");
$bonus=$pul+$bonusrand;
file_put_contents("referal/$frid.txt","$bonus");
file_put_contents("rubl/$frid.txt",1);
$frid= $update->callback_query->from->id;
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"🎉 Tabriklaymiz, sizga $bonusrand $valyuta miqdorida bonus berildi.",
'show_alert'=>true,
]);
file_put_contents("rubl/olindi1.txt","\n".$frid, FILE_APPEND);
$ee1 = file_get_contents("rubl/olindi1.txt");
$eea = substr_count($ee1,"\n"); 
$olmos = file_get_contents("rubl/berildi1.txt");
$mm3 = $olmos+$bonusrand;
file_put_contents("rubl/berildi1.txt","$mm3");
$mn2 = file_get_contents("rubl/berildi1.txt");
$olindi=file_get_contents("bonus2.txt");
bot('editMessageText',[
'chat_id'=>"@$bonkan",
'message_id'=>$cmid,
'text'=>"<b>🚀 Oʻyin boshlandi.
🎁 Oʻz sovgʻangizni oling.
👥 Qatnashchi: $olindi nafar
👤 Ishtirok etdi: $eea/$olindi
💰 Bepul $mn2 $valyuta tarqatildi.
👨🏻‍💻 Adminstrator: @$adminuser
🤖 Botimiz: @$botname</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎁 Bonus olish","callback_data"=>"bo"]],
]
]),
]);
}
}
}


if($data=="boshqaruv"){
$saved = file_get_contents("step/inew.txt");
$pul = file_get_contents("referal/$saved.txt");
$odam = file_get_contents("odam/$saved.dat");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🔎 Foydalanuvchi topildi.

🆔️ ID raqami: <a href='tg://user?id=$saved'>$saved</a>
💵 Hisobi: $pul $valyuta
👤 Takliflari: $odam ta.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
    [['text'=>"🔔 Banlash",'callback_data'=>"ban"],['text'=>"🔕 Bandan olish",'callback_data'=>"unban"]],
	[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]],
	[['text'=>"➕ Pul qo'shish ( Maker botiga )",'callback_data'=>"makerplus"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]],	
	]
	])
]);
unlink("step/$cid2.step");
}

if($text == "🔎 Foydalanuvchini boshqarish"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Kerakli foydalanuvchining ID raqamini yuboring::</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]
])
]);
file_put_contents("step/$cid.step",'iD');
}
}
if($step == "iD" and $cid == $admin){
if(file_exists("referal/$text.txt")){
file_put_contents("step/inew.txt",$text);
$pul = file_get_contents("referal/$text.txt");
$odam = file_get_contents("odam/$text.dat");
$saved = file_get_contents("step/inew.txt");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔎 Foydalanuvchi topildi.

🆔️ ID raqami: <a href='tg://user?id=$saved'>$saved</a>
💵 Hisobi: $pul $valyuta
👤 Takliflari: $odam ta.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
    [['text'=>"🔔 Banlash",'callback_data'=>"ban"],['text'=>"🔕 Bandan olish",'callback_data'=>"unban"]],
	[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]],	
	]
	])
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>❌️ Ushbu foydalanuvchi botdan foydalanmaydi. Boshqa ID raqamni kiriting:</b>",
	'parse_mode'=>'html',
]);
}
}

//qo'shish
if($data=="plus"){
$saved = file_get_contents("step/inew.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"🆔️ <a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul qo'shmoqchisiz.</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"boshqaruv"]]
]
])
]);
file_put_contents("step/$cid2.step",'plus');
}

if($step == "plus" and $cid == $admin){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>👮‍♂️ Adminstrator tomonidan hisobingiz $text $valyuta to'ldirildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$main_menu,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Foydalanuvchi hisobiga $text $valyuta qo'shildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("referal/$saved.txt");
$miqdor = $pul + $text;
file_put_contents("referal/$saved.txt",$miqdor);
unlink("step/inew.txt");
unlink("step/$cid.step");
}

//ayirish
if($data=="minus"){
$saved = file_get_contents("step/inew.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"🆔️ <a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul ayirmoqchisiz.</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"boshqaruv"]]
]
])
]);
file_put_contents("step/$cid2.step",'minus');
}

if($step == "minus" and $cid == $admin){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>👮‍♂️ Adminstrator tomonidan hisobingizdan $text $valyuta olib tashlandi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$main_menu,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Foydalanuvchi hisobidan $text $valyuta olib tashlandi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("referal/$saved.txt");
$miqdor = $pul - $text;
file_put_contents("referal/$saved.txt",$miqdor);
unlink("step/inew.txt");
unlink("step/$cid.step");
}

//makeiga
if($data=="makerplus"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"🆔️ <a href='tg://user?id=$saved'>$saved</a> <b>ning  maker bot hisobiga qancha pul qo'shmoqchisiz.</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"boshqaruv"]]
]
])
]);
file_put_contents("step/$cid2.step",'makerplus');
}

if($step == "makerplus" and $cid == $admin){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>👮‍♂️ Adminstrator tomonidan maker bot hisobingiz $text $valyuta to'ldirildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$main_menu,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Foydalanuvchi maker bot hisobiga $text $valyuta qo'shildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("bots/$saved/vipkons/admin/$saved.txt");
$miqdor = $pul + $text;
file_put_contents("bots/$saved/vipkons/admin/$saved.txt",$miqdor);
unlink("step/inew.txt");
unlink("step/$cid.step");
}

if($data=="ban"){
file_put_contents("ban/$saved.txt",'1');
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"🆔️ <a href='tg://user?id=$saved'>$saved</a> <b>banlandi.</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"boshqaruv"]]
]
])
]);
}

if($data=="unban"){
unlink("ban/$saved.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"🆔️ <a href='tg://user?id=$saved'>$saved</a> <b>bandan olindi.</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"boshqaruv"]]
]
])
]);
}

//xabar
if($text == "📨 Xabarnoma"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>📨 Yuboriladigan xabar turini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"Forward xabar",'callback_data'=>"mysend"],['text'=>"Oddiy yuborish",'callback_data'=>"send"]],
[['text'=>"Foydalanuvchiga xabar",'callback_data'=>"user"]],	
[['text'=>"Kanalga xabar",'callback_data'=>"kasend"],['text'=>"Guruhga xabar",'callback_data'=>"grsend"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]],	
	]
	])
	]);
  }
}


$xabar=file_get_contents("xabar.txt");
if($data == "send"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
 bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📬 Foydalanuvchilarga xabar yuborish uchun xabar matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$rpl,
]); file_put_contents("xabar.txt","sendpost");
}
if($xabar=="sendpost" and $cid == $admin){
unlink("xabar.txt");
bot('sendMessage',[
  'chat_id'=>$cid,
  'text'=>"<b>✅️ Xabar yuborish boshlandi.</b>",
"parse_mode"=>"html",
]);
$x=0;
$y=0;
$lich=file_get_contents("shekih.db");
$lichim = substr_count($lich,"\n");
$lichka = explode("\n",$lich);
foreach($lichka as $lichkalar){
$ok=bot('SendMessage',[
 'chat_id'=>$lichkalar,
 'text'=>"<b>$tx</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👨🏻‍💻 Adminstrator",'url'=>"https://t.me/$adminuser"]],
]
]),
])->ok;
if($ok==true or $ok==true){
$x=$x+1;
bot('editmessagetext',[
'chat_id'=>$cid,
'text'=>"<b>📤 Xabar yuborish boshlandi.
  
📅 Hozirgi vaqt: $sana
⏰️ Hozirgi soat: $time

✅️ Xabar yuborildi: $x ta
☑️ Xabar yuborilmadi: $y ta</b>",
'message_id'=>$mid+1,
'parse_mode'=>'html',
]);
}elseif($ok==false){
$y=$y+1;
bot('editmessagetext',[
'chat_id'=>$cid,
'text'=>"<b>📤 Xabar yuborish boshlandi.
  
📅 Hozirgi vaqt: $sana
⏰️ Hozirgi soat: $time

✅️ Xabar yuborildi: $x ta
☑️ Xabar yuborilmadi: $y ta</b>",
'message_id'=>$mid+1,
'parse_mode'=>'html',
]);
}
}
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid+1,
]);
bot('sendMessage',[
  'chat_id'=>$cid,
  'text'=>"<b>📥 Xabar yuborish tugadi.
  
📅 Hozirgi vaqt: $sana
⏰️ Hozirgi soat: $time

✅️ Xabar yuborildi: $x ta
☑️ Xabar yuborilmadi: $y ta</b>",
'parse_mode'=>'html',
"reply_markup"=>$panel,
        ]);
exit();
}


$guruh = file_get_contents("guruh.txt");
if($data == "grsend"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
 bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📬 Guruhlarga xabar yuborish uchun xabar matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$rpl,
]); file_put_contents("guruh.txt","sendpost");
}
if($guruh=="sendpost" and $cid == $admin){
unlink("guruh.txt");
bot('sendMessage',[
  'chat_id'=>$cid,
  'text'=>"<b>✅️ Xabar yuborish boshlandi.</b>",
"parse_mode"=>"html",
  ]);
$x=0;
$y=0;
$gu=file_get_contents("group.db");
$gur = substr_count($gu,"\n");
$guru = explode("\n",$gu);
foreach($guru as $guruh){
$okg=bot('SendMessage',[
 'chat_id'=>$guruh,
 'text'=>"<b>$tx</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👨🏻‍💻 Adminstrator",'url'=>"https://t.me/$adminuser"]],
]
]),
])->ok;
if($okg==true or $okg==true){
$x=$x+1;
bot('editmessagetext',[
'chat_id'=>$cid,
'text'=>"<b>📤 Xabar yuborish boshlandi.
  
📅 Hozirgi vaqt: $sana
⏰️ Hozirgi soat: $time

✅️ Xabar yuborildi: $x ta
☑️ Xabar yuborilmadi: $y ta</b>",
'message_id'=>$mid+1,
'parse_mode'=>'html',
]);
}elseif($okg==false){
$y=$y+1;
bot('editmessagetext',[
'chat_id'=>$cid,
'text'=>"<b>📤 Xabar yuborish boshlandi.
  
📅 Hozirgi vaqt: $sana
⏰️ Hozirgi soat: $time

✅️ Xabar yuborildi: $x ta
☑️ Xabar yuborilmadi: $y ta</b>",
'message_id'=>$mid+1,
'parse_mode'=>'html',
]);
}
}
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid+1,
]);
bot('sendMessage',[
  'chat_id'=>$cid,
  'text'=>"<b>📥 Xabar yuborish tugadi.
  
📅 Hozirgi vaqt: $sana
⏰️ Hozirgi soat: $time

✅️ Xabar yuborildi: $x ta
☑️ Xabar yuborilmadi: $y ta</b>",
'parse_mode'=>'html',
"reply_markup"=>$panel,
        ]);
exit();
}


$kanal = file_get_contents("kanal.txt");
if($data == "kasend"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
 bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📬 Kanallarga xabar yuborish uchun xabar matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$rpl,
]); file_put_contents("kanal.txt","sendpost");
}
if($kanal=="sendpost" and $cid == $admin){
unlink("kanal.txt");
bot('sendMessage',[
  'chat_id'=>$cid,
  'text'=>"<b>✅️ Xabar yuborish boshlandi.</b>",
"parse_mode"=>"html",
  ]);
$x=0;
$y=0;
$ka=file_get_contents("channel.db");
$kan = substr_count($ka,"\n");
$kana = explode("\n",$ka);
foreach($kana as $kanal){
$okk=bot('SendMessage',[
 'chat_id'=>$kanal,
 'text'=>"<b>$tx</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👨🏻‍💻 Adminstrator",'url'=>"https://t.me/$adminuser"]],
]
]),
])->ok;
if($okk==true or $okk==true){
$x=$x+1;
bot('editmessagetext',[
'chat_id'=>$cid,
'text'=>"<b>📤 Xabar yuborish boshlandi.
  
📅 Hozirgi vaqt: $sana
⏰️ Hozirgi soat: $time

✅️ Xabar yuborildi: $x ta
☑️ Xabar yuborilmadi: $y ta</b>",
'message_id'=>$mid+1,
'parse_mode'=>'html',
]);
}elseif($okk==false){
$y=$y+1;
bot('editmessagetext',[
'chat_id'=>$cid,
'text'=>"<b>📤 Xabar yuborish boshlandi.
  
📅 Hozirgi vaqt: $sana
⏰️ Hozirgi soat: $time

✅️ Xabar yuborildi: $x ta
☑️ Xabar yuborilmadi: $y ta</b>",
'message_id'=>$mid+1,
'parse_mode'=>'html',
]);
}
}
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid+1,
]);
bot('sendMessage',[
  'chat_id'=>$cid,
  'text'=>"<b>📥 Xabar yuborish tugadi.
  
📅 Hozirgi vaqt: $sana
⏰️ Hozirgi soat: $time

✅️ Xabar yuborildi: $x ta
☑️ Xabar yuborilmadi: $y ta</b>",
'parse_mode'=>'html',
"reply_markup"=>$panel,
        ]);
exit();
}


if($data == "user"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🆔️ Foydalanuvchi ID raqamini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
]);
file_put_contents("step/$cid2.step",'user');
}

if($step == "user" and $cid==$admin){
file_put_contents("step/inew.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$admin,
	'text'=>"<b>📬 Xabaringizni kiriting:</b>",
	'parse_mode'=>'html',
	]);
file_put_contents("step/$cid.step",'xabar');
}
if($step == "xabar" and $cid==$admin){
	bot('SendMessage',[
	'chat_id'=>$saved,
	'text'=>"$text",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👨🏻‍💻 Adminstrator",'url'=>"https://t.me/$adminuser"]],
]
]),
]);
bot('SendMessage',[
	'chat_id'=>$admin,
	'text'=>"<b>✅️ Xabaringiz <a href='tg://user?id=$saved'>$saved</a> foydalanuvchiga yuborildi.</b>",
       'parse_mode'=>'html',
       'reply_markup'=>$panel,
	   ]);
	   unlink("step/$cid.step");
	   unlink("step/inew.txt");
}


$channel=file_get_contents("channel.db");
if($type=="channel" or $type=="chanel"){
if(strpos($channel,"$cid") !==false){
}else{
file_put_contents("channel.db","$channel\n$cid");
}
}

$group=file_get_contents("group.db");
if($type=="group" or $type=="supergroup"){
if(strpos($group,"$cid") !==false){
}else{
file_put_contents("group.db","$group\n$cid");
}
}

$lichka=file_get_contents("shekih.db");
if($type=="private"){
if(strpos($lichka,"$cid") !==false){
}else{
file_put_contents("shekih.db","$lichka\n$cid");
}
}

$gr=file_get_contents("group.db");
$gr=substr_count($gr,"\n");
$ch=file_get_contents("channel.db");
$ch=substr_count($ch,"\n");
$chi=substr_count($ch,"-");
$gri=substr_count($gr,"-");
$lichka=file_get_contents("shekih.db");
$lich=substr_count($lichka,"\n");
$all=substr_count($baza,"\n");
$bots = file_get_contents("Statistika/bots.txt");
$botm = file_get_contents("Statistika/botm.txt");
$botp = file_get_contents("Statistika/botp.txt");
$all = $bots + $botm + $botp;

if($text == "📊 Statistika"){
$inews = file_get_contents("inew.ids");
$shekihs = file_get_contents("shekih.db");
$shekih=substr_count($shekihs,"\n");
$tarks=substr_count($shekihs,"-");
$res = mysqli_query($connect, "SELECT * FROM `users`");
$us = mysqli_num_rows($res);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📊 Bot statistikasi.

▪️ Foydalanuvchilar: $shekih ta
▪️ Faol: $shekih ta
▪️ Nofaol: $tarks ta

▪️ Standart botlar: $bots ta
▪️ Maxsus botlar: $botm ta
▪️ Premium botlar: $botp ta
▪️ Barcha botlar: $all ta 

▪️ Kanallar: $ch ta
▪️ Guruhlar: $gr ta

▪️ Hozirgi sana: $sana
▪️ Hozirgi vaqt: $time</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
}


if($text == "*⃣ Birlamchi sozlamalar"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>*⃣ Birlamchi sozlamalar bo'limi:
</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holatni ko‘rish",'callback_data'=>"xolat"]],
[['text'=>"💵 Narx sozlamalar",'callback_data'=>"narx"]],
[['text'=>"🎁Bonus miqdorlari",'callback_data'=>"bonmiq"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]],
]
])
]);
}
}

if($data == "asosiy"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>⚙️ Asosiy sozlamalar bo'limiga xush kelibsiz!</b>

<b>Nimani o'zgartiramiz.</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holatni ko‘rish",'callback_data'=>"xolat"]],
[['text'=>"💵 Narx sozlamalar",'callback_data'=>"narx"]],
[['text'=>"🎁Bonus miqdorlari",'callback_data'=>"bonmiq"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]],
]
])
]);
}
}

if($data == "xolat"){
if($cid2 == $admin){
$minbon = file_get_contents("bonus/minbon.txt");
$maxbon = file_get_contents("bonus/maxbon.txt");
$kanalmax = file_get_contents("bonus/kanalmax.txt");
$kanalmin = file_get_contents("bonus/kanalmin.txt");
$kanal = file_get_contents("admin/kanal.txt");
$qiwi = file_get_contents("admin/qiwi.txt");
$click = file_get_contents("admin/click.txt");
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Hozirgi sozlamalar.

1. 🔗 Taklif narxi: - $narx $valyuta
2. 💵 Valyuta nomi: - $valyuta
3. 👨🏻‍💻 Yangi admin: - $admins
4. 🔗 Admin useri: - @$adminuser </b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}

if($data == "bonmiq"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holat",'callback_data'=>"bonusxolati"]],
[['text'=>"🚀 Kanalga bonus miqdroni",'callback_data'=>"kanalbonus"],['text'=>"🎁 Kunlik bonus miqdorini",'callback_data'=>"kunlikbon"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}

if($data == "bonusxolati"){
if($cid2 == $admin){
$minbon = file_get_contents("bonus/minbon.txt");
$maxbon = file_get_contents("bonus/maxbon.txt");
$kanalmax = file_get_contents("bonus/kanalmax.txt");
$kanalmin = file_get_contents("bonus/kanalmin.txt");
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Hozirgi holat.

1. 🔺<b>Kunlik maximal bonus $maxbon $valyuta</b>
2. 🔻<b>Kunlik minimal bonus $minbon $valyuta</b>

1. 🔺<b>Kanalga maximal bonus $kanalmax $valyuta</b>
2. 🔻<b>Kanalga minimal bonus $kanalmin $valyuta</b> </b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"bonmiq"]],
]
])
]);
}
}

if($data == "kanalbonus"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
  'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
  'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔺 Maximimal bonus",'callback_data'=>"max1bon"]],
[['text'=>"🔻 MInimal bonus",'callback_data'=>"min1bon"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}

if($data == "max1bon"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Maximal beriladigan bonus miqdorini kiriting

Namuna:</b> <code>1000</code>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'max1bon');
}
if($step == "max1bon" and $cid == $admin){
file_put_contents("bonus/kanalmax.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}

if($data == "min1bon"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Maximal beriladigan bonus miqdorini kiriting

Namuna:</b> <code>1000</code>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'min1bon');
}
if($step == "min1bon" and $cid == $admin){
file_put_contents("bonus/kanalmin.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}

if($data == "kunlikbon"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
  'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
  'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔺 Maximimal bonus",'callback_data'=>"maxbon"]],
[['text'=>"🔻 MInimal bonus",'callback_data'=>"minbon"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}

if($data == "maxbon"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Maximal beriladigan bonus miqdorini kiriting

Namuna:</b> <code>1000</code>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'maxbon');
}
if($step == "maxbon" and $cid == $admin){
file_put_contents("bonus/maxbon.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}

if($data == "minbon"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Minimal beriladigan bonus miqdorini kiriting

Namuna:</b> <code>500</code>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'minbon');
}
if($step == "minbon" and $cid == $admin){
file_put_contents("bonus/minbon.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}


if($text == "📢 Kanallar"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:
</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obuna",'callback_data'=>"majkanal"]],
[['text'=>"🎁 Qo'shimcha kanallar",'callback_data'=>"bonuskanal"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}

if($data == "majkanal"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
  'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
  'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Kanallar ro'yxati",'callback_data'=>"kanallar"]],
[['text'=>"📢 Kanal qo'shish",'callback_data'=>"ulash"],['text'=>"📢 Kanal o'chirish",'callback_data'=>"uzish"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}
if($data == "kanallar"){
if($cid2 == $admin){
$kanallar = file_get_contents("admin/kanal.txt");
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Kanallar ro'yxati:
$kanallar

🎁 Bonuslar kanali; @$bonkan</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kanal"]],
]
])
]);
}
}

if($data == "bonuskanal"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📢 Kanlingizni userini kiriting:

Namuna:</b> <code>EditPHP</code>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'bonuskanal');
}
if($step == "bonuskanal" and $cid == $admin){
file_put_contents("bonkan.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}


if($data == "ulash"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📢 Kanlingizni userini kiriting:

Namuna:</b> <code>Yangiliklar-EditPHP</code>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'kanal');
}
if($step == "kanal" and $cid == $admin){
file_put_contents("admin/kanal.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}


if($data == "uzish"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
   'text'=>"<b>📢 Kanallarni o'chirish muvaffaqiyatli yakunlandi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
unlink("admin/kanal.txt");
}

if($text == "👤 Adminlar"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:
</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔗 Admin user",'callback_data'=>"aduser"]],
[['text'=>"➕ Admin qo‘shish",'callback_data'=>"adqosh"],['text'=>"➖ Admin o‘chirish",'callback_data'=>"adoch"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}

if($data == "admin"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔗 Admin user",'callback_data'=>"aduser"]],
[['text'=>"➕ Admin qo‘shish",'callback_data'=>"adqosh"],['text'=>"➖ Admin o‘chirish",'callback_data'=>"adoch"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}

if($data == "aduser"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🔗 Admin userini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'alik');
}
if($step == "alik" and $cid == $admin){
file_put_contents("admin/user.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}

if($data == "adqosh"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>➕ Admin qo‘shish uchun iD raqamini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'admin1');
}
if($step == "admin1"){
if( $cid == $admin){
file_put_contents("admin/admins.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "adoch"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>➖ Admin o‘chirish uchun iD raqamini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'ochirish');
}
if($step == "ochirish" and $cid == $admin){
$file = file_get_contents("admin/admins.txt");
$fayl =  str_replace($text,"",$file);
file_put_contents("admin/admins.txt","$fayl");
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}

if($data == "narx"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔗 Taklif narxi",'callback_data'=>"refnarx"],['text'=>"💵 Valyuta nomi",'callback_data'=>"valyuta"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}

if($text == "💳 Hamyonlar"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:
</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🇺🇿 Karta",'callback_data'=>"clickr"],['text'=>"🇷🇺 Qiwi hamyon",'callback_data'=>"qiwir"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}

$txolat=json_decode(file_get_contents("https://m2318.myxvest.ru/MyKons/foydalanuvchi/bot/$admin/kunlik.tolov"));
$kun = $txolat->kun;
$times = "$sana — $soat";
$b_time = explode(" — ",$times)[1];
$s_time = explode(":",$b_time)[0]*60;
$m_time = explode(":",$b_time)[1];
$minutes = $s_time + $m_time;
$minus = 24*60;
$qoldi = ($minus - $minutes)*60;
$hours = str_pad(floor($qoldi / (60*60)), 2, '0', STR_PAD_LEFT);
$minutes = str_pad(floor(($qoldi - $hours*60*60)/60), 2, '0', STR_PAD_LEFT);
$bots = file_get_contents("foydalanuvchi/bot/$ccid/bots.txt");
if($kun=="0"){
$day="Tugallangan";
}else{
$day="$kun kun
<b>🔐 Keyingi yechilish:</b> $hours soat, $minutes daqiqa";
if($text == "⏱ To'lov holati"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>🤖 @$botname holati: $kun kun
<b>🔐 Keyingi yechilish:</b> $hours soat, $minutes daqiqa

To'lov qilishni unutmang aks holda botingiz o'chiriladi!
</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"@editphpbot",'url'=>"https://t.me/editphpbot"]],
]
])
]);
}
}

if($text == "🤖 Konstruktor sozlamalar"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>🤖 Konstruktor sozlamalar bo'limidasiz:

Nimani o'zgartiramiz?
</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🤖 Botlarni sozlash",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "botlarnisozla"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>❓ Qaysi botni sozlaymiz? 

1. Uzgrame                 | 2. Harfgavideo bot
3. SpecialSMM           | 4. SpecialSMM Premium 
5. Pul bot                     | 6. Almaz bot  
7. AutoNumber         | 8. Turfaxil bot  
9. UC bot                      | 10. Save  bot
11. Rubl bot                | 12. MB bot
13. Rasm bot              | 14. </b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"a"],['text'=>"2",'callback_data'=>"b"],['text'=>"3",'callback_data'=>"s"],['text'=>"4",'callback_data'=>"d"],['text'=>"5",'callback_data'=>"e"]],
[['text'=>"6",'callback_data'=>"f"],['text'=>"7",'callback_data'=>"g"],['text'=>"8",'callback_data'=>"h"],['text'=>"9",'callback_data'=>"i"],['text'=>"10",'callback_data'=>"j"]],
[['text'=>"11",'callback_data'=>"k"],['text'=>"12",'callback_data'=>"l"],['text'=>"13",'callback_data'=>"m"],['text'=>"14",'callback_data'=>"n"]],
]
])
]);
}
}

if($data == "a"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 UzGrame bot

🤖 Botning imkoniyatlari: $uzgramebottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $uzgramebotnarx / 1 CreateCard

</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"aa"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"aaa"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "aa"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'a1a');
}
if($step == "a1a"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/uzgrame.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "aaa"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'a2a');
}
if($step == "a2a"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/uzgrame.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "e"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Pul bot

🤖 Botning imkoniyatlari: $pulbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $pulbotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"ee"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"eee"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "ee"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'ee');
}
if($step == "ee"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/pul.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "eee"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'eee');
}
if($step == "eee"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/pul.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "i"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 UCbot

🤖 Botning imkoniyatlari: $ucbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $ucbotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"ii"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"iii"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "ii"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'ii');
}
if($step == "ii"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/uc.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "iii"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'iii');
}
if($step == "iii"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/uc.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
//mbbot
if($data == "l"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 MB bot

🤖 Botning imkoniyatlari: $mbbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $mbbotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"ll"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"lll"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "ll"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'ll');
}
if($step == "ll"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/mb.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "lll"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'lll');
}
if($step == "lll"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/mb.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
//almaz
if($data == "f"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Almaz bot

🤖 Botning imkoniyatlari: $almazbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $almazbotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"ff"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"fff"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "ff"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'ff');
}
if($step == "ff"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/almaz.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "fff"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'fff');
}
if($step == "fff"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/almaz.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
//turfa
if($data == "h"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Turfa bot

🤖 Botning imkoniyatlari: $turfabottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $turfabotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"hh"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"hhh"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "hh"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'hh');
}
if($step == "hh"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/turfa.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "hhh"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'hhh');
}
if($step == "hhh"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/turfa.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
//specialsmm
if($data == "s"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 SpecialSMM bot

🤖 Botning imkoniyatlari: $smmbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $smmbotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"ss"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"sss"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "ss"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'ss');
}
if($step == "ss"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/smm.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "sss"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'sss');
}
if($step == "sss"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/smm.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
//harf
if($data == "b"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 HarfgaVideo bot

🤖 Botning imkoniyatlari: $harfbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $harfbotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"bb"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"bbb"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "bb"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'bb');
}
if($step == "bb"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/harf.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "bbb"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'bbb');
}
if($step == "bbb"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/harf.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
//rasm
if($data == "m"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Rasm bot

🤖 Botning imkoniyatlari: $rasmbbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $rasmbotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"mm"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"mmm"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "mm"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'mm');
}
if($step == "mm"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/rasm.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "mmm"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'mmm');
}
if($step == "mmm"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/rasm.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
//raqam
if($data == "g"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 AutoNumber bot

🤖 Botning imkoniyatlari: $raqambottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $raqambotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"gg"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"ggg"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "gg"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'gg');
}
if($step == "gg"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/raqam.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "ggg"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'ggg');
}
if($step == "ggg"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/raqam.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
//rubl
if($data == "k"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Rubl bot

🤖 Botning imkoniyatlari: $rublbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $rublbotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"kk"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"kkk"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "kk"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'kk');
}
if($step == "kk"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/rubl.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "kkk"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'kkk');
}
if($step == "kkk"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/rubl.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
//save
if($data == "j"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 Save bot

🤖 Botning imkoniyatlari: $savebottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $savebotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"jj"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"jjj"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "jj"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'jj');
}
if($step == "jj"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/save.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "jjj"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'jjj');
}
if($step == "jjj"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/save.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
//smmpremium
if($data == "d"){
if($cid2 == $admin){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>💎 SpecialSMM Premium

🤖 Botning imkoniyatlari: $premiumbottavsif

💬 Botning interfeys tili: O'zbekcha

🗓 31 kunlik to'lov: 4 500 $valyuta (1 kun - 150 $valyuta)

💳 Bot ochish narxi: $premiumbotnarx $valyuta / 1 CreateCard</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏️ Tavsifni o'zgartirish",'callback_data'=>"dd"]],
[['text'=>"✏️ Narxni o'zgartirish",'callback_data'=>"ddd"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botlarnisozla"]],
]
])
]);
}
}

if($data == "dd"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot tavsifini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'dd');
}
if($step == "dd"){
if( $cid == $admin){
file_put_contents("sozlash/tavsif/smmpre.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "ddd"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Bot narxini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'ddd');
}
if($step == "ddd"){
if( $cid == $admin){
file_put_contents("sozlash/narxi/smmpre.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}
if($text == "📑 Matnlar"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:
</b>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💬 Qoida menyu matni",'callback_data'=>"qoid"]],
[['text'=>"📖 Qo'llanma menyu matni",'callback_data'=>"qollan"]],
[['text'=>"📚 Bot haqida menyu matni",'callback_data'=>"haqidaa"]],
[['text'=>"📢 Majburiy obuna matni",'callback_data'=>"majburiy"]],
[['text'=>"🔄 O'z holiga qaytarish",'callback_data'=>"restarts"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]
])
]);
}
}

if($data == "valyuta"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>💵 Valyuta kursini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'valyuta');
}
if($step == "valyuta"){
if( $cid == $admin){
file_put_contents("admin/valyuta.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}


$qiwi = file_get_contents("admin/qiwi.txt");
if($data == "qiwir"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🇷🇺 Qiwi hamyon raqamingizni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'qiwi');
}
if($step == "qiwi"){
if( $cid == $admin){
file_put_contents("admin/qiwi.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

$click = file_get_contents("admin/click.txt");
if($data == "clickr"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🇺🇿 Click hamyon raqamingizni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'click');
}
if($step == "click"){
if( $cid == $admin){
file_put_contents("admin/click.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}


$narx = file_get_contents("admin/referal.txt");
if($data == "refnarx"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🔗 Taklif narxini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'ref');
}
if($step == "ref"){
if( $cid == $admin){
file_put_contents("admin/referal.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}


if($data == "snarx"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🔥 Standart botlar narxini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'snarx');
}
if($step == "snarx"){
if( $cid == $admin){
file_put_contents("Narxlar/Standart.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}


if($data == "mnarx"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>⭐️ Maxsus botlar narxini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'mnarx');
}
if($step == "mnarx"){
if( $cid == $admin){
file_put_contents("Narxlar/Maxsus.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}


if($data == "pnarx"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>💎 Premium botlar narxini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'pnarx');
}
if($step == "pnarx"){
if( $cid == $admin){
file_put_contents("Narxlar/Premium.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}


if($data == "qoid"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>💬 Qoida menyu matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'qoida');
}
if($step == "qoida"){
if( $cid == $admin){
file_put_contents("admin/qoida.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "qollan"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📖 Qo'llanma menyu matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'qollan');
}
if($step == "qollan"){
if( $cid == $admin){
file_put_contents("admin/qollanma.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "haqidaa"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📚 Bot haqida menyu matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'haqi');
}
if($step == "haqi"){
if( $cid == $admin){
file_put_contents("admin/haqida.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "back"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>◀️ Orqaga menyu matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'back');
}
if($step == "back"){
if( $cid == $admin){
file_put_contents("admin/orqa.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "start"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📱 Start menyu matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'start');
}
if($step == "start"){
if( $cid == $admin){
file_put_contents("admin/start.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "majburiy"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"</b>📢 Majburiy obuna matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
])
]);
file_put_contents("step/$cid2.step",'majbur');
}
if($step == "majbur"){
if( $cid == $admin){
file_put_contents("admin/kanal2.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}
}

if($data == "restarts"){
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>✅️ Muvaffaqiyatli o'z holiga qaytarildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]]
	]
	])
]);
deleteFolder("admin");
}



//tugmalar
if($data == "tugmalar"){
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🖥 Asosiy menyu tugmalari",'callback_data'=>"main_menu"]],
    [['text'=>"🛠 Botlarni boshqarish tugmalari",'callback_data'=>"tugma"]],
	[['text'=>"🔄 O'z holiga qaytarish",'callback_data'=>"restart"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]]
	]
	])
]);
}

if($data == "buttons"){
     bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
	'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🖥 Asosiy menyu tugmalari",'callback_data'=>"main_menu"]],
    [['text'=>"🛠 Botlarni boshqarish tugmalari",'callback_data'=>"tugma"]],
	[['text'=>"🔄 O'z holiga qaytarish",'callback_data'=>"restart"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]]
	]
	])
]);
}

if($data == "main_menu"){
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🛠 Botlarni boshqarish 🛠",'callback_data'=>"botlarni_boshqarish"]],
    [['text'=>"📱 Kabinet",'callback_data'=>"kabinet"],['text'=>"💵 Pul ishlash",'callback_data'=>"pul_ishlash"]],
	[['text'=>"📨 Yordam",'callback_data'=>"bot_dokoni"],['text'=>"📋 Ma'lumotlar",'callback_data'=>"mal_button"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
	]
	])
]);
}

if($data == "tugma"){
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
    [['text'=>"➕ Yangi bot ochish",'callback_data'=>"yangi_bot"]],
[['text'=>"🛠 Botlarni sozlash",'callback_data'=>"botlarni_sozlash"],['text'=>"💵 Kunlik to‘lov",'callback_data'=>"button"]],
	[['text'=>"🛍 Buyurtmalar",'callback_data'=>"buy_button"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"orqaga_button"]],
	]
	])
   ]);
}

if($data == "restart"){
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>🧭 Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>✅️ Muvaffaqiyatli o'z holiga qaytarildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]]
	]
	])
]);
deleteFolder("Tugma");
}

if($data == "botlarni_boshqarish"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key1');
}

if($step == "key1" and $cid == $admin){	
file_put_contents("Tugma/key1.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}
	
if($data == "kabinet"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key2');
}

if($step == "key2" and $cid == $admin){
 file_put_contents("Tugma/key2.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}

if($data == "pul_ishlash"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key3');
}

if($step == "key3" and $cid == $admin){
	file_put_contents("Tugma/key3.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}

if($data == "bot_dokoni"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key4');
}

if($step == "key4" and $cid == $admin){
	file_put_contents("Tugma/key4.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}

if($data == "mal_button"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key5');
}

if($step == "key5" and $cid == $admin){
	file_put_contents("Tugma/key5.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}

if($data == "yangi_bot"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key6');
}

if($step == "key6" and $cid == $admin){
	file_put_contents("Tugma/key6.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}

if($data == "botlarni_sozlash"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key7');
}

if($step == "key7" and $cid == $admin){
	file_put_contents("Tugma/key7.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}

if($data == "button"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key8');
}

if($step == "key8" and $cid == $admin){
	file_put_contents("Tugma/key8.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
        'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}

	if($data == "buyurtmalar_button"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key9');
}

if($step == "key9" and $cid == $admin){
	file_put_contents("Tugma/key9.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}


if($data == "orqaga_button"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key10');
}

if($step == "key10" and $cid == $admin){
	file_put_contents("Tugma/key10.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}

if($data == "button11"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key11');
}

if($step == "key11" and $cid == $admin){
	file_put_contents("Tugma/key11.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}

if($data == "buy_button"){
	bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$admin,
	'text'=>"<b>📋 Tugma nomini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]
]),
	]);
	file_put_contents("step/$cid2.step",'key12');
}

if($step == "key12" and $cid == $admin){
	file_put_contents("Tugma/key12.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅️ Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
}

//<---------- Admins Panel ------->

if($text == "/admin"){
if($cid == $admins){
	bot('SendMessage',[
	'chat_id'=>$admins,
	'text'=>"<b>👨🏻‍💻 <a href = 'tg://user?id=$admin'>$name</a> admin paneliga xush kelibsiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
]);
}
}

/*
if($data == "makerim"){
bot('editMessageText',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
    'text'=>"<b>👑 Maker bot</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"💵 Maker bot hisobi",'callback_data'=>"bilish"],],
[['text'=>"🔁 Maker botga oʻtkazish",'callback_data'=>"makerga"],],
]
]),
    ]);
    }
    
if($data == "bilish"){
$bilish = file_get_contents("bots/$ccid/vipkons/admin/$ccid.txt");
bot('editMessageText',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
    'text'=>"<b>💵 Maker bot hisobi: $bilish $valyuta</b>",
    'parse_mode'=>'html',
      ]);
      }
    

    if($data == "makerga"){
    bot('deleteMessage',[
    'chat_id'=>$ccid,
    'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🆔 Do'stingizning id raqamini kiriting:</b>",
'parse_mode'=>'html',
        'reply_markup'=>$main_menu,
   ]);
   file_put_contents("step/$ccid.txt","perevodid2");
}
if($userstep == "perevodid2" and $tx !== "◀️ Orqaga" and joinchat($fid)=="true"){
file_put_contents("almash1/$fid.idraqam","$tx");
unlink("step/$fid.txt");
unlink("step/$cid.txt");
   unlink("step/$ccid.txt");
     $getid = bot('sendMessage',[
        'chat_id'=>$cid,
'text'=>"<b>💵 Pul miqdorini kiriting:</b>",
'parse_mode'=>'html',
    'reply_markup'=>$main_menu,
   ]);

file_put_contents("step/$ccid.txt","perevodid12");
file_put_contents("step/$cid.txt","perevodid12");
file_put_contents("step/$fid.txt","perevodid12");
}
if($userstep == "perevodid12" and $tx !== "◀️ Orqaga" and joinchat($fid)=="true"){
file_put_contents("almash1/$cid.pulraqam","$tx");
$raqamid = file_get_contents("almash1/$cid.idraqam");
$raqapul = file_get_contents("almash1/$cid.pulraqam");
$olmos1 = file_get_contents("bots/$raqamid/vipkons/admin/$raqamid.txt");
$olmos2 = file_get_contents("referal/$cid.txt");
$csful = $raqapul / 100 * 105;
if($olmos2>=$csful and $tx>=100){
$olmoslar1 = $olmos1 + $raqapul;
$olmoslar2 = $olmos2 - $csful;
file_put_contents("bots/$raqamid/vipkons/admin/$raqamid.txt","$olmoslar1");
file_put_contents("referal/$cid.txt","$olmoslar2");
bot("sendMessage",[
    "chat_id"=>$raqamid,
    "text"=>"👍 Sizning maker bot hisobingizni <a href='tg://user?id=$cid'>foydalanuvchi</a> $tx $valyuta ga to'ldirdi.</b>",
    'parse_mode'=>'html',
]);
    bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👍 Transfer muvaffaqiyatli amalga oshirildi, foydalanuvchi hisobi $raqapul $valyuta ga to'ldirildi.

➗ 5% komissiya kiritilgan, balansingizdan $csful $valyuta yechib olinadi‌‌.</b>",
'parse_mode'=>'html',
    'reply_markup'=>$main_menu,
   ]);
       unlink("step/$fid.txt1");
unlink("step/$cid.txt1");
   unlink("step/$ccid.txt1");
           }else{
bot("sendMessage",[
    "chat_id"=>$cid,
              "text"=>"<b>❌️ Komissiyani hisobga olgan holda pul o'tkazmasi uchun mablag' yetarli emas, sizga $csful $valyuta kerak yoki 1000 $valyuta dan yozing‌‌:</b>",
'parse_mode'=>'html',
]);
}
unlink("step/$fid.txt");
unlink("step/$cid.txt");
   unlink("step/$ccid.txt");
}
*/
}
?>