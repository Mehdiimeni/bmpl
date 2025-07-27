<?php
session_start();
require_once __DIR__ . '/./vendor/autoload.php'; // مسیر به autoload
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
//use DomainException;
//use UnexpectedValueException;

// بررسی وجود سشن و تطابق شماره موبایل
if (!isset($_SESSION['mobileNumber']) || !isset($_POST['mobile']) || $_SESSION['mobileNumber'] !== $_POST['mobile']) {
    die('خطای احراز هویت: شماره موبایل نامعتبر است');
}

// بررسی وجود توکن
if (empty($_POST['token'])) {
    die('توکن پرداخت نامعتبر است');
}

// ذخیره اطلاعات دریافتی
$mobileNumber = $_POST['mobile'];
$terminalId = $_POST['terminal_id'];
$totalAmount = $_POST['total_amount'];
$products = $_POST['products'] ?? [];
$token = $_POST['token'];
$return_url = $_POST['return_url'];

// تابع بررسی توکن (مثال - باید با سیستم شما تطبیق داده شود)
function validateToken($receivedToken, $mobile, $terminalId)
{


    $secretKey = 'bnpl-intek-iw-123!@#'; // باید همان کلید تولید توکن باشد

    try {
        // دیکد کردن توکن
        $decoded = JWT::decode($receivedToken, new Key($secretKey, 'HS256'));

        // بررسی انقضای توکن
        if (time() > $decoded->exp) {
            return false;
        }

        // بررسی issuer (اختیاری)
        if ($decoded->iss !== 'your-app-name') {
            return false;
        }

        // بررسی تطابق موبایل و ترمینال
        if ($decoded->data->mobile !== $mobile || $decoded->data->terminal_id !== $terminalId) {
            return false;
        }

        return true;

    } catch (SignatureInvalidException $e) {
        // امضای نامعتبر
        error_log('Invalid token signature: ' . $e->getMessage());
        return false;
    } catch (BeforeValidException $e) {
        // توکن هنوز معتبر نیست
        error_log('Token not yet valid: ' . $e->getMessage());
        return false;
    } catch (ExpiredException $e) {
        // توکن منقضی شده
        error_log('Expired token: ' . $e->getMessage());
        return false;
    } catch (DomainException | UnexpectedValueException $e) {
        // خطاهای عمومی
        error_log('Token validation error: ' . $e->getMessage());
        return false;
    }
}

if (!validateToken($token, $mobileNumber, $terminalId)) {
    die('توکن پرداخت نامعتبر یا منقضی شده است');
}

// دریافت نام پذیرنده
$acquirerName = 'نام پذیرنده';
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => 'http://192.168.50.15:7475/api/BNPL/merchant',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode(['terminal_id' => $terminalId])
]);

$merchantResponse = curl_exec($curl);
if (curl_errno($curl)) {
    die('خطا در دریافت اطلاعات پذیرنده: ' . curl_error($curl));
}

$merchantData = json_decode($merchantResponse, true);
if ($merchantData && isset($merchantData['acquirer_name'])) {
    $acquirerName = $merchantData['acquirer_name'];
}
curl_close($curl);

// تولید کد تصادفی 8 رقمی
$verificationCode = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);

// ذخیره کد در سشن برای بررسی بعدی
$_SESSION['verification_code'] = $verificationCode;
$_SESSION['payment_data'] = [
    'mobile' => $mobileNumber,
    'terminal_id' => $terminalId,
    'amount' => $totalAmount,
    'token' => $token,
    'return_url' => $return_url
];

// ارسال کد به موبایل کاربر (این بخش بستگی به سرویس SMS شما دارد)
// sendSms($mobileNumber, "کد تأیید پرداخت شما: $verificationCode");
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأیید پرداخت اعتباری</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .payment-summary {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .product-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .verification-box {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">تأیید پرداخت اعتباری</h4>
                    </div>
                    <div class="card-body">
                        <!-- نمایش اطلاعات پذیرنده -->
                        <div class="alert alert-info">
                            <h5>پذیرنده: <?= htmlspecialchars($acquirerName) ?></h5>
                            <p>شماره ترمینال: <?= htmlspecialchars($terminalId) ?></p>
                        </div>

                        <!-- نمایش اطلاعات محصولات -->
                        <div class="payment-summary">
                            <h5>خلاصه سفارش</h5>
                            <?php foreach ($products as $product): ?>
                                <div class="product-item">
                                    <div class="d-flex justify-content-between">
                                        <span><?= htmlspecialchars($product['name']) ?></span>
                                        <span><?= number_format($product['price']) ?> تومان</span>
                                    </div>
                                    <small class="text-muted">کد: <?= htmlspecialchars($product['id']) ?></small>
                                </div>
                            <?php endforeach; ?>
                            <div class="product-item bg-light">
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>جمع کل:</span>
                                    <span><?= number_format($totalAmount) ?> تومان</span>
                                </div>
                            </div>
                        </div>

                        <!-- فرم وارد کردن کد تأیید -->
                        <div class="verification-box mt-4">
                            <form id="verifyForm" method="POST" action="process-payment.php">
                                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                                <div class="mb-3">
                                    <label for="verificationCode" class="form-label">کد تأیید ارسال شده به
                                        <?= htmlspecialchars($mobileNumber) ?></label>
                                    <input type="text" class="form-control text-center" id="verificationCode"
                                        name="verification_code" required maxlength="8" placeholder="کد 8 رقمی">
                                </div>
                                <button type="submit" class="btn btn-success w-100">تأیید پرداخت</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // اعتبارسنجی کد تأیید
        document.getElementById('verifyForm').addEventListener('submit', function (e) {
            const codeInput = document.getElementById('verificationCode');
            if (!/^\d{8}$/.test(codeInput.value)) {
                e.preventDefault();
                alert('لطفاً کد تأیید 8 رقمی را صحیح وارد کنید');
                codeInput.focus();
            }
        });
    </script>
</body>

</html>