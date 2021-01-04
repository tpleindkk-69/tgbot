<?php

ini_set('error_reporting', E_ALL);

$botToken = "1417387483:AAHWJctrhOSrD7I21sIwk2hM76HfRhRUAi4";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"]; 

if (strpos($message, "/start") === 0){
sendMessage($chatId, 
"⚡️ HEYYY ! ⚡️ 
TYPE /cmds TO KNOW ALL MY COMMANDS 
BOT FOR CC MADE BY => ⚡️ @flash_its_me ⚡️ ", $message_id);
}

//////////=========[Cmds Command]=========//////////

elseif (strpos($message, "/cmds") === 0){
sendMessage($chatId, 
"⚡️ COMMANDS ⚡️
/b3 => braintreeChecker
/st => stripeChecker
/bin => binInfo", $message_id);
}



elseif (strpos($message, "/bin") === 0){
$bin = substr($message, 5);
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
$bin = 'Credit';
}else{
$bin = 'Debit';
};
sendMessage($chatId, '<b>⚡️ VALID BIN ⚡️</b>%0A<b>BANK:</b> '.$bank.'%0A<b>COUNTRY:</b> '.$name.'%0A<b>BRAND:</b> '.$brand.'%0A<b>CARD:</b> '.$scheme.'%0A<b>TYPE:</b> '.$type.'%0A<b>CHECKED By:</b> @'.$username.'%0A%0A<b>Bot Made by:Team Zeltrax  @flash_its_me</b>', $message_id);
}


function sendMessage ($chatId, $message) {

	$url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
	file_get_contents($url);
}

?>
