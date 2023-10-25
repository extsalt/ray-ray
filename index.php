<?php
const PUSHER_APP_ID = "1694635";
const PUSHER_APP_KEY = "fa57685991b3f68bc676";
const PUSHER_APP_SECRET = "d2d1b9dc07d53d6f0b4b";

$authenticationPayload = ['auth_key' => PUSHER_APP_KEY, 'auth_timestamp' => time(), 'auth_version' => '1.0'];
$body = ['name' => 'event', 'channels' => ['channel'], 'data' => json_encode(['var' => 1])];
$bodyMD5 = md5(json_encode($body));
$endpoint = "http://api-ap2.pusher.com/apps/" . PUSHER_APP_ID . "/events";
$authenticationPayload['body_md5'] = $bodyMD5;
ksort($authenticationPayload);
$plainText = "POST\n/apps/" . PUSHER_APP_ID . "/events\nauth_key=" . PUSHER_APP_KEY . "&auth_timestamp=" . time() . "&auth_version=1.0&body_md5=" . $bodyMD5;
$hash = hash_hmac('sha256', $plainText, PUSHER_APP_SECRET);
$authenticationPayload['auth_signature'] = $hash;
$endpoint = $endpoint . '?' . http_build_query($authenticationPayload);
print_r($endpoint);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $endpoint);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
$response = curl_exec($curl);
curl_close($curl);
var_dump($response);
var_dump(json_encode($body));
