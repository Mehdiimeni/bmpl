<?php
header('Content-Type: application/json');

// دریافت داده‌های JSON ارسالی
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// لاگ کردن داده‌های دریافتی برای دیباگ

// اعتبارسنجی داده‌های دریافتی
if (!$data || !isset($data['mobileNumber']) || !isset($data['amount'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request data'
    ]);
    exit;
}

$mobileNumber = $data['mobileNumber'];
$amount = $data['amount'];

// ارسال به API اصلی
$api_url = "http://192.168.50.15:7475/api/BNPL/Settle?mobileNumber=" . urlencode($mobileNumber) . "&amount=" . urlencode($amount);



$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json',
    'Content-Length: 0'
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// لاگ کردن پاسخ API

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

// بازگرداندن پاسخ اصلی API
echo $response;
?>