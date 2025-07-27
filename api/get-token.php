<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../vendor/autoload.php'; // مسیر به autoload

use Firebase\JWT\JWT;

// تنظیمات CORS برای اجازه دسترسی از دامنه‌های مختلف
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// فقط روش POST را قبول کنید
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// دریافت و اعتبارسنجی داده‌های ورودی
$input = json_decode(file_get_contents('php://input'), true);

if (empty($input['mobile']) || empty($input['terminal_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'موبایل و شماره ترمینال الزامی است']);
    exit;
}

$mobile = filter_var($input['mobile'], FILTER_SANITIZE_STRING);
$terminal_id = filter_var($input['terminal_id'], FILTER_SANITIZE_STRING);

// اعتبارسنجی شماره موبایل (ایرانی)
if (!preg_match('/^09[0-9]{9}$/', $mobile)) {
    http_response_code(400);
    echo json_encode(['error' => 'فرمت شماره موبایل نامعتبر است']);
    exit;
}

// اعتبارسنجی شماره ترمینال
if (!preg_match('/^[A-Za-z0-9]{8,20}$/', $terminal_id)) {
    http_response_code(400);
    echo json_encode(['error' => 'فرمت شماره ترمینال نامعتبر است']);
    exit;
}

// اطلاعات کاربر/ترمینال را از دیتابیس چک کنید (مثال)
// $isValid = checkUserInDatabase($mobile, $terminal_id);
$isValid = true; // در واقعیت باید از دیتابیس چک شود

if (!$isValid) {
    http_response_code(401);
    echo json_encode(['error' => 'احراز هویت ناموفق بود']);
    exit;
}

// تولید توکن JWT
$secretKey = 'bnpl-intek-iw-123!@#'; // کلید امنیتی - باید پیچیده باشد
$issuedAt = time();
$expire = $issuedAt + 3600; // انقضا: 1 ساعت بعد

$payload = [
    'iat' => $issuedAt,
    'exp' => $expire,
    'iss' => 'your-app-name',
    'data' => [
        'mobile' => $mobile,
        'terminal_id' => $terminal_id
    ]
];

try {
    $token = JWT::encode($payload, $secretKey, 'HS256');
    
    // پاسخ موفق
    echo json_encode([
        'success' => true,
        'token' => $token,
        'expires_in' => $expire,
        'token_type' => 'Bearer'
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'خطا در تولید توکن: ' . $e->getMessage()]);
}