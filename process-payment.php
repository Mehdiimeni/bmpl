<?php
session_start();

// بررسی وجود داده‌های ضروری در سشن
if (!isset($_SESSION['payment_data'])) {
    die('اطلاعات پرداخت یافت نشد');
}

$paymentData = $_SESSION['payment_data'];

// تابع فراخوانی API
function callAPI($url, $data) {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($data)
    ]);
    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    
    return [
        'status' => $httpCode === 200,
        'response' => json_decode($response, true),
        'http_code' => $httpCode
    ];
}

// 1. فراخوانی API خرید
$buyResponse = callAPI('http://192.168.50.15:7475/api/BNPL/buy', [
    'buyerMerchantNumber' => '10433',
    'sellerMerchantNumber' => '700000000879',
    'amount' => $paymentData['amount'],
    'productCode' => 'sdg',
    'productName' => 'محصول انتخابی',
    'paymentType' => 0
]);

// ذخیره نتیجه خرید در سشن
$_SESSION['payment_result'] = $buyResponse;

// 2. فراخوانی API تأیید (بعد از 10 ثانیه یا کلیک دکمه)
function confirmPayment() {
    if (!isset($_SESSION['payment_data'])) return false;
    
    $confirmResponse = callAPI('http://192.168.50.15:7475/api/BNPL/confirm', [
        'transactionId' => $_SESSION['payment_result']['response']['transactionId'] ?? null,
        'terminalId' => $_SESSION['payment_data']['terminal_id']
    ]);
    
    return $confirmResponse;
}

// اگر دکمه تأیید زده شده باشد
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    $confirmResult = confirmPayment();
    header('Location: '.$paymentData['return_url'].'?status='.$confirmResult['status'].'&response='.json_encode($confirmResult['response']));
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تکمیل پرداخت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .payment-box {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .countdown {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .product-list {
            border-top: 1px solid #eee;
            margin-top: 1rem;
            padding-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="payment-box text-center">
            <!-- نمایش نتیجه خرید -->
            <h3 class="mb-4">
                <?= $buyResponse['status'] ? '✅ پرداخت با موفقیت انجام شد' : '❌ خطا در پرداخت' ?>
            </h3>
            
            <?php if ($buyResponse['status']): ?>
                <div class="alert alert-success">
                    <p>کد پیگیری: <?= $buyResponse['response']['transactionId'] ?? '--' ?></p>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">
                    <p>خطا: <?= $buyResponse['response']['message'] ?? 'خطای نامشخص' ?></p>
                </div>
            <?php endif; ?>
            
            <!-- اطلاعات پرداخت -->
            <div class="product-list text-start">
                <h5>جزئیات پرداخت:</h5>
                <p>مبلغ: <?= number_format($paymentData['amount']) ?> تومان</p>
                <p>شماره ترمینال: <?= $paymentData['terminal_id'] ?></p>
                <p>زمان: <?= date('Y/m/d H:i') ?></p>
            </div>
            
            <!-- شمارنده معکوس -->
            <div class="my-4">
                <p>در حال انتقال به صفحه نتیجه پرداخت...</p>
                <div class="countdown" id="countdown">10</div>
            </div>
            
            <!-- دکمه تأیید دستی -->
            <form method="POST" action="<?php echo($paymentData['return_url']); ?>" >
                <button type="submit" name="confirm" class="btn btn-primary btn-lg">
                    تکمیل خرید و بازگشت
                </button>
            </form>
        </div>
    </div>

    <script>
        // شمارنده معکوس
        let seconds = 10;
        const countdownElement = document.getElementById('countdown');
        
        const timer = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(timer);
                document.querySelector('form').submit();
            }
        }, 1000);
    </script>
</body>
</html>