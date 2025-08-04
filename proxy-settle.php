<?php
header('Content-Type: application/json');

$mobileNumber = $_GET['mobileNumber'] ?? '';
$amount = $_GET['amount'] ?? '';

$url = "http://192.168.50.15:7475/api/BNPL/Settle?mobileNumber=" . urlencode($mobileNumber) . "&amount=" . urlencode($amount);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
// اگر API بدنه خالی می‌پذیرد:
curl_setopt($ch, CURLOPT_POSTFIELDS, ''); 
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Length: 0',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

http_response_code($httpcode);
echo $response;
