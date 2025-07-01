<?php
session_start(); // شروع سشن


// دریافت اطلاعات از بدنه‌ی POST
$input = json_decode(file_get_contents('php://input'), true);
$mobileNumber = $input['mobileNumber'] ?? null;

// ذخیره شماره موبایل در سشن
if ($mobileNumber) {
    $_SESSION['mobileNumber'] = $mobileNumber;
}

// ارسال درخواست به API
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://192.168.50.15:7475/api/BNPL/login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
    CURLOPT_POSTFIELDS => json_encode(['mobileNumber' => $mobileNumber])
));

$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

// تعیین نوع پاسخ
header('Content-Type: application/json');
http_response_code($http_code);

// تلاش برای تبدیل به JSON
$data = json_decode($response, true);

// اگر داده‌ها معتبر بودن و خطا نبود، در سشن ذخیره شود
if ($http_code >= 200 && $http_code < 300 && is_array($data)) {
    foreach ($data as $key => $value) {
        $_SESSION[$key] = $value;
    }
}

// بازگرداندن پاسخ اصلی API
echo $response;
