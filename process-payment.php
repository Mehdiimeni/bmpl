<?php
session_start();

if (!isset($_SESSION['mobileNumber'])) {
    header('Location: login-user.php');
    exit;
}

if (!isset($_SESSION['payment_data'])) {
    die('اطلاعات پرداخت یافت نشد');
}

$paymentData = $_SESSION['payment_data'];
$buyResponse = null;

// user data

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://192.168.50.15:7475/api/BNPL/login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
    CURLOPT_POSTFIELDS => json_encode(['mobileNumber' => $_SESSION['mobileNumber']])
));

$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);


// تلاش برای تبدیل به JSON
$userData = json_decode($response, true);



// تابع درخواست API
function callAPI($url, $data)
{
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

// هندل کردن فرم ارسال شده
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'confirm') {

        $_SESSION['payment_result'] = []; // تعریف به عنوان آرایه خالی
        foreach ($paymentData['products'] as $products) {

            $buyResponse = callAPI('http://192.168.50.15:7475/api/BNPL/buy', [
                'buyerMerchantNumber' => $userData['merchantNumber'],
                'sellerMerchantNumber' => $paymentData['terminal_id'],
                'productCode' => $products['id'],
                'productName' => $products['name'],
                'amount' => (int) $products['price'],
                'paymentType' => 0
            ]);
            $_SESSION['payment_result'][] = $buyResponse;

            if (!isset($buyResponse['response']['data']['rrn']))
                continue;

            $confirmResponse = callAPI('http://192.168.50.15:7475/api/BNPL/Verify', [

                'customerId' => (int) $userData['merchantId'] ?? 0,
                'rrn' => (int) $buyResponse['response']['data']['rrn'] ?? 0,
                'amount' => (int) $products['price'] ?? 0,
                'traceNo' => $buyResponse['response']['data']['traceNo'] ?? null
            ]);
        }




        // پردازش پاسخ و هدایت کاربر
        if ($confirmResponse['status'] && isset($confirmResponse['response']['success']) && $confirmResponse['response']['success']) {
            // در صورت موفقیت آمیز بودن تایید تراکنش
            $redirectParams = [
                'status' => 'success',
                'message' => $confirmResponse['response']['data']['message'] ?? 'تراکنش با موفقیت انجام شد',
                'rrn' => $confirmResponse['response']['data']['rrn'] ?? null,
                'traceNo' => $confirmResponse['response']['data']['traceNo'] ?? null
            ];
        } else {
            // در صورت عدم موفقیت در تایید تراکنش
            $redirectParams = [
                'status' => 'fail',
                'message' => $confirmResponse['response']['data']['message'] ?? 'خطا در انجام تراکنش',
                'error' => $confirmResponse['error'] ?? null,
                'http_code' => $confirmResponse['http_code'] ?? null
            ];
        }

        // هدایت کاربر به صفحه بازگشت
        header('Location: ' . $paymentData['return_url'] . '?' . http_build_query($redirectParams));
        exit;
    }

    if ($_POST['action'] === 'cancel') {
        header('Location: ' . $paymentData['return_url']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تأیید پرداخت</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .payment-box {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
        }

        .countdown {
            font-size: 2rem;
            color: #dc3545;
            font-weight: bold;
        }

        .btn-lg {
            min-width: 160px;
        }

        .info-box {
            background: #f0f8ff;
            border: 1px solid #cce5ff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="payment-box text-center">
            <h4 class="mb-4">تأیید نهایی خرید</h4>
            <p class="text-muted">لطفاً ظرف <strong>۹۰ ثانیه</strong> پرداخت را تأیید کنید.</p>

            <div class="countdown mb-4" id="countdown">90</div>

            <div class="info-box text-start">
                <p><strong>مبلغ:</strong> <?= number_format($paymentData['total_amount']) ?> ریال</p>
                <p><strong>شماره ترمینال:</strong> <?= htmlspecialchars($paymentData['terminal_id']) ?></p>
                <p><strong>تاریخ و ساعت:</strong> <?= date('Y/m/d H:i') ?></p>
            </div>

            <!-- فرم تأیید خرید -->
            <form method="POST" id="confirmForm" class="d-inline-block">
                <input type="hidden" name="action" value="confirm">
                <button type="submit" class="btn btn-success btn-lg">تأیید و ادامه</button>
            </form>

            <!-- فرم انصراف -->
            <form method="POST" class="d-inline-block ms-2">
                <input type="hidden" name="action" value="cancel">
                <button type="submit" class="btn btn-outline-secondary btn-lg">انصراف</button>
            </form>
        </div>
    </div>

    <script>
        let seconds = 90;
        const countdownElement = document.getElementById('countdown');
        const confirmForm = document.getElementById('confirmForm');

        const timer = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;

            if (seconds <= 0) {
                clearInterval(timer);
                confirmForm.submit();
            }
        }, 1000);
    </script>
</body>

</html>