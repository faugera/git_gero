<?php
// Broadcast from Webview to ChatFuel

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

switch($_SERVER['REQUEST_METHOD']){
	case 'GET':
		$_request = &$_GET;
	break;
	case 'POST':
		$_request = &$_POST;
	break;
	default:
		$_request = &$_GET;
}

$msgrID    = (!empty($_request['messenger_user_id']))? $_request['messenger_user_id'] : '';
$goToBlock = (!empty($_request['goToBlock']))? $_request['goToBlock'] : '';

// HERE IS WHERE YOU SET UP YOUR BROADCAST SETTINGS
// this needs to be your bot ID
$botID  = '58f86249e4b0cd816f523f8a';
// this needs to be your bot's broadcast token
$botToken = 'X0nwdu6OE3Gjvq4J47YnMsuGHheoLWswcerxRPkVaI1YcMkO3TrMTpMpZjeqCeqB';

// HERE IS WHERE YOU WOULD SET UP USER ATTRIBUTES IF NEEDED
// set up the user attributes to send back to the bot
$params = array(
	'user_attribute1' => getRequest('SomeCustomField1'),
	'user_attribute2' => getRequest('SomeCustomField2')
);

$sendUrl  = 'https://api.chatfuel.com/bots/' . $botID . '/users/' . $msgrID . '/send';
$sendUrl .= '?chatfuel_token=' . $botToken;
$sendUrl .= '&chatfuel_block_name=' . urlencode($goToBlock);

$options = array(
	'http' => array(
		'method'  => 'POST',
		'header'  => 'Content-Type: application/json' . "\r\n" . 'Accept: application/json' . "\r\n",
		'content' => json_encode($params)
	)
);

if(!empty($msgrID) && !empty($goToBlock)){
	$context = stream_context_create($options);
	$result  = @file_get_contents($sendUrl,false,$context);
}
echo json_encode(array('ok' => true));

function getRequest($key = '',$fallback = ''){
	global $_request;
	if(!empty($key)){
		if(!empty($_request[$key])){
			return $_request[$key];
		} else {
			return $fallback;
		}
	}
	return '';
}
die();
?>