<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing ID']);
    exit;
}

$id = $_GET['id'];
$api_url = "http://192.168.50.15:7475/api/BNPL/Settle?billId=" . urlencode($id);

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, ''); // بدنه خالی
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json',
    'Content-Length: 0'
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// ثبت در لاگ برای بررسی پاسخ API
file_put_contents("log.txt", "HTTP: $http_code\nResponse:\n$response\n");

if ($error) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'cURL error',
        'error' => $error
    ]);
    exit;
}

if ($http_code >= 400) {
    http_response_code($http_code);
    echo json_encode([
        'success' => false,
        'message' => "API error. HTTP status: $http_code",
        'response' => $response
    ]);
    exit;
}

// اگر پاسخ JSON معتبر بود
echo $response;
