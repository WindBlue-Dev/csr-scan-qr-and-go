<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$_POST['key'] = '1816207780658161';
$_POST['secret'] = 'f813be829b84c02e4b807fadfeba7f9d';
// Beger-OTP
// $_POST['key'] = '1816129817345828';
// $_POST['secret'] = '6d1f78663379c3324d85676e078eb361';

if ($_GET['t'] === 'r') {
    $url = 'https://otp.thaibulksms.com/v2/otp/request';
} elseif ($_GET['t'] === 'v') {
    $url = 'https://otp.thaibulksms.com/v2/otp/verify';
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/x-www-form-urlencoded",
    "Accept: application/json"
));

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));

$response = curl_exec($ch);
curl_close($ch);

echo $response;