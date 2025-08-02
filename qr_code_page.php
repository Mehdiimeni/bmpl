<?php
session_start();

if (isset($_GET['terminal_id']) && !isset($_SESSION['mobileNumber'])) {
    header('Location: login-user.php?terminal_id=' . $_GET['terminal_id']);
    exit;
}

if (!isset($_SESSION['mobileNumber'])) {
    header('Location: login-user.php');
    exit;
}

// دریافت شناسه ترمینال از URL
$terminal_id = isset($_GET['terminal_id']) ? urldecode($_GET['terminal_id']) : null;

$acquirerName = 'نام پذیرنده';
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => 'http://192.168.50.15:7475/api/BNPL/GetMerchantByTerminalNumber/' . $terminal_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
]);

$merchantResponse = curl_exec($curl);
if (curl_errno($curl)) {
    die('خطا در دریافت اطلاعات پذیرنده: ' . curl_error($curl));
}

$merchantData = json_decode($merchantResponse, true);
if ($merchantData && isset($merchantData['merchantName'])) {
    $acquirerName = $merchantData['merchantName'];
}
curl_close($curl);

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

// پردازش فرم پرداخت
$paymentResult = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount'])) {
    // تبدیل مبلغ به عدد (حذف ویرگول و فاصله)
    $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٤', '٥', '٦'];
    $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '4', '5', '6'];
    $price = str_replace($persianNumbers, $englishNumbers, $_POST['amount']);
    $price = str_replace([',', ' '], '', $price);

    // اعتبارسنجی مبلغ
    if (!is_numeric($price) || $price < 1000000) {
        $paymentResult = [
            'status' => 'error',
            'message' => 'لطفاً مبلغ معتبری وارد کنید (حداقل 1,000,000 ریال)'
        ];
    } else {


        $terminal_id = isset($_POST['terminal_id']) ? $_POST['terminal_id'] : (isset($_GET['terminal_id']) ? $_GET['terminal_id'] : null);

        if (!$terminal_id) {
            $paymentResult = [
                'status' => 'error',
                'message' => 'شناسه ترمینال یافت نشد'
            ];
        } else {
            // فراخوانی API خرید
            $buyResponse = callAPI('http://192.168.50.15:7475/api/BNPL/buy', [
                'buyerMerchantNumber' => $userData['merchantNumber'],
                'sellerMerchantNumber' => $terminal_id,
                'amount' => (int) $price,
                'productCode' => '10',
                'productName' => 'پرداخت به وسیله qr code',
                'paymentType' => 0
            ]);

            // فراخوانی API تایید تراکنش
            if ($buyResponse['status']) {
                $confirmResponse = callAPI('http://192.168.50.15:7475/api/BNPL/Verify', [
                    'customerId' => (int) $userData['merchantId'] ?? 0,
                    'rrn' => (int) $buyResponse['response']['data']['rrn'] ?? 0,
                    'amount' => (int) $price ?? 0,
                    'traceNo' => $buyResponse['response']['data']['traceNo'] ?? null
                ]);

                if ($confirmResponse['status'] && isset($confirmResponse['response']['success']) && $confirmResponse['response']['success']) {
                    $paymentResult = [
                        'status' => 'success',
                        'message' => $confirmResponse['response']['data']['message'] ?? 'تراکنش با موفقیت انجام شد',
                        'amount' => number_format($price),
                        'rrn' => $confirmResponse['response']['data']['rrn'] ?? null,
                        'traceNo' => $confirmResponse['response']['data']['traceNo'] ?? null
                    ];
                } else {
                    $paymentResult = [
                        'status' => 'error',
                        'message' => $confirmResponse['response']['data']['message'] ?? 'خطا در انجام تراکنش',
                        'error' => $confirmResponse['error'] ?? null
                    ];
                }
            } else {
                $paymentResult = [
                    'status' => 'error',
                    'message' => $buyResponse['response']['message'] ?? 'خطا در ارتباط با سرور',
                    'error' => $buyResponse['error'] ?? null
                ];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت با QR Code</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/brands.min.css">
    <link href="./assets/css/Vazirmatn-Variable-font-face.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./assets/css/animate.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <style>
        /* استایل‌های قبلی شما (همانند قبل) */
        :root {
            --primary-color: #5b86e5;
            --secondary-color: #3656a8;
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --text-color-light: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
        }

        body {
            font-family: 'Vazirmatn', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
            line-height: 1.6;
            padding-bottom: 80px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }



        /* Header Styles - Consistent with previous pages */
        .app-header {
            padding: 1.5rem 0;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 0 0 25px 25px;
            box-shadow: 0 8px 25px rgba(78, 115, 223, 0.2);
            position: relative;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .app-header::before,
        .app-header::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            filter: blur(3px);
            z-index: 0;
        }

        .app-header::before {
            top: -40px;
            right: -40px;
            width: 150px;
            height: 150px;
        }

        .app-header::after {
            bottom: -60px;
            left: -20px;
            width: 200px;
            height: 200px;
        }

        .app-header .container {
            position: relative;
            z-index: 1;
        }

        .app-header h3 {
            font-weight: 800;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }

        /* Main Card Container */
        .main-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            margin: -30px auto 3rem auto;
            max-width: 600px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
            width: 100%;
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        }

        .main-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        /* QR Scanner Placeholder and product details */
        .qr-section {
            width: 100%;
            border-radius: 15px;
            margin-bottom: 2rem;
            flex-direction: column;
            text-align: center;
        }

        .qr-scanner-placeholder {
            background-color: #f0f0f0;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            /* Stack children vertically */
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            color: var(--text-color-light);
            border: 2px dashed #ccc;
            height: 250px;
            /* Fixed height for consistent layout */
            cursor: pointer;
            /* Indicates it's clickable */
            transition: background-color 0.3s ease, border-color 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .qr-scanner-placeholder:hover {
            background-color: #e6e6e6;
            border-color: var(--primary-color);
        }

        .qr-scanner-placeholder i {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        #scanner-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .scanner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            z-index: 10;
        }

        .scanner-controls {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn-scan {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-start-scan {
            background-color: var(--success-color);
            color: white;
        }

        .btn-stop-scan {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-start-scan:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-stop-scan:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        .product-details {
            display: none;
            /* Hidden by default */
            text-align: right;
            /* Align text to the right for RTL */
            margin-top: 0;
            /* Adjusted margin */
            padding: 1.5rem;
            /* Padding for spacing */
            /* border: 1px solid #e9ecef; Remove border as it's part of the placeholder */
            border-radius: 10px;
            background-color: transparent;
            /* Make background transparent */
            animation: fadeIn 0.5s ease-out;
        }

        .product-details p {
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
            color: var(--dark-color);
        }

        .product-details p strong {
            color: var(--primary-color);
        }

        .scan-success-message {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--success-color);
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.5s ease-out;
        }

        .camera-permission-denied {
            color: var(--danger-color);
            font-weight: bold;
            margin-top: 1rem;
            display: none;
        }


        .product-details {
            display: none;
            /* Hidden by default */
            text-align: right;
            /* Align text to the right for RTL */
            margin-top: 0;
            /* Adjusted margin */
            padding: 1.5rem;
            /* Padding for spacing */
            /* border: 1px solid #e9ecef; Remove border as it's part of the placeholder */
            border-radius: 10px;
            background-color: transparent;
            /* Make background transparent */
            animation: fadeIn 0.5s ease-out;
        }

        .product-details p {
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
            color: var(--dark-color);
        }

        .product-details p strong {
            color: var(--primary-color);
        }

        .scan-success-message {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--success-color);
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.5s ease-out;
        }


        /* Input Field */
        .form-label {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.85rem 1rem;
            font-size: 1.1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(91, 134, 229, 0.25);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.2);
        }

        .invalid-feedback {
            font-size: 0.85rem;
            margin-top: 0.5rem;
            font-weight: 500;
            color: var(--danger-color);
        }

        /* Buttons */
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 0.9rem 1.8rem;
            font-weight: 700;
            border-radius: 15px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: white;
            box-shadow: 0 8px 20px rgba(91, 134, 229, 0.3);
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(91, 134, 229, 0.4);
            background: linear-gradient(135deg, #3a62d0, #2040c0);
        }

        .btn-submit:disabled {
            background: #c5c7ce;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            color: #999;
        }

        /* Payment Options */
        .payment-options {
            margin-top: 2rem;
            border-top: 1px dashed #eee;
            padding-top: 2rem;
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
        }

        .payment-option-card {
            background-color: var(--light-color);
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;
            color: var(--dark-color);
            text-align: right;
            /* Ensure text aligns right in RTL */
        }

        .payment-option-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transform: translateY(-3px);
        }

        .payment-option-card.selected {
            border-color: var(--primary-color);
            background-color: rgba(91, 134, 229, 0.1);
            box-shadow: 0 5px 15px rgba(91, 134, 229, 0.2);
        }

        .payment-option-card input[type="radio"] {
            margin-left: 10px;
            /* Space from radio button */
            transform: scale(1.3);
            /* Larger radio button */
            cursor: pointer;
        }

        .installment-details {
            font-size: 0.9rem;
            color: var(--text-color-light);
            margin-top: 0.5rem;
            font-weight: 400;
        }

        .installment-details strong {
            color: var(--dark-color);
        }

        /* Final Payment Button */
        .btn-pay-now {
            background: var(--success-color);
            border: none;
            padding: 0.9rem 1.8rem;
            font-weight: 700;
            border-radius: 15px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: white;
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
            margin-top: 1.5rem;
        }

        .btn-pay-now:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(40, 167, 69, 0.4);
            background: #218838;
        }

        .btn-pay-now:disabled {
            background: #cccccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            color: #999;
        }

        /* Bottom Navigation Bar - Consistent with previous pages */
        .bottom-navigation-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -8px 20px rgba(0, 0, 0, 0.08);
            padding: 0.85rem 0;
            z-index: 1000;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .tf-navigation-bar {
            display: flex;
            justify-content: space-around;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tf-navigation-bar li a {
            color: #888;
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.2s ease, background-color 0.2s ease;
            font-weight: 500;
            padding: 0.5rem;
            border-radius: 10px;
        }

        .tf-navigation-bar li a i,
        .tf-navigation-bar li a svg {
            font-size: 1.4rem;
            margin-bottom: 0.35rem;
            transition: color 0.2s ease;
        }

        .tf-navigation-bar li a.active {
            color: var(--primary-color);
            background-color: rgba(91, 134, 229, 0.08);
            font-weight: 700;
        }

        .tf-navigation-bar li a.active i,
        .tf-navigation-bar li a.active svg {
            color: var(--primary-color);
        }

        .tf-navigation-bar li a:hover {
            color: var(--primary-color);
            background-color: rgba(91, 134, 229, 0.05);
        }

        .tf-navigation-bar li a:hover i,
        .tf-navigation-bar li a:hover svg {
            color: var(--primary-color);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Style for Rescan Button */
        .btn-rescan {
            background-color: var(--primary-color);
            /* استفاده از رنگ اصلی تم */
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            border-radius: 10px;
            /* کمی گردتر */
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            /* برای قرار گرفتن آیکون و متن در کنار هم */
            align-items: center;
            justify-content: center;
            gap: 8px;
            /* فاصله بین آیکون و متن */
        }

        .btn-rescan:hover {
            background-color: var(--secondary-color);
            /* تغییر رنگ در هاور */
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            color: white;
            /* اطمینان از سفید ماندن متن در هاور */
        }

        .btn-rescan i {
            font-size: 1.1rem;
            /* اندازه آیکون */
        }

        /* Responsive adjustment for rescan button */
        @media (max-width: 768px) {
            .btn-rescan {
                padding: 0.7rem 1.2rem;
                font-size: 0.9rem;
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            body {
                padding-bottom: 70px;
            }

            .app-header {
                padding: 1.2rem 0;
                border-radius: 0 0 20px 20px;
            }

            .app-header h3 {
                font-size: 1.8rem;
            }

            .main-card {
                padding: 1.8rem;
                margin: -30px auto 2rem auto;
                transform: translateY(0);
            }

            .main-card:hover {
                transform: translateY(0);
            }

            .qr-scanner-placeholder {
                height: 200px;
                font-size: 1rem;
            }

            .qr-scanner-placeholder i {
                font-size: 2.5rem;
            }

            .form-control {
                padding: 0.75rem 1rem;
                font-size: 1rem;
            }

            .btn-submit,
            .btn-pay-now {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }

            .payment-option-card {
                padding: 1.2rem;
                font-size: 0.95rem;
            }

            .installment-details {
                font-size: 0.8rem;
            }

            .tf-navigation-bar li a {
                font-size: 0.7rem;
            }

            .tf-navigation-bar li a i,
            .tf-navigation-bar li a svg {
                font-size: 1.1rem;
            }


        }

        .scanner-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        #scanner {
            width: 100%;
            height: 300px;
            border: 2px dashed #ccc;
            border-radius: 10px;
            margin: 1rem 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        #scanner video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            display: none;
        }

        .terminal-info {
            background-color: #e9ecef;
            padding: 1.5rem;
            border-radius: 10px;
            margin: 1.5rem 0;
            text-align: center;
        }

        .btn-action {
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 10px;
            margin: 0.5rem;
        }



        /* استایل جدید برای مخفی کردن فرم پرداخت */
        .payment-form-container {
            display: none;
            animation: fadeIn 0.5s ease-out;
        }

        .payment-form-container.show {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="app-header text-center">
        <div class="container">
            <h3>پرداخت با QR Code</h3>
        </div>
    </div>

    <div class="container flex-grow-1 d-flex flex-column justify-content-center align-items-center">
        <div class="main-card animate__animated animate__fadeInUp">
            <?php if ($paymentResult): ?>
                <div class="alert alert-<?= $paymentResult['status'] === 'success' ? 'success' : 'danger' ?> mt-4">
                    <h5 class="alert-heading">
                        <?= $paymentResult['status'] === 'success' ? 'تراکنش موفق' : 'خطا در تراکنش' ?>
                    </h5>
                    <p><?= $paymentResult['message'] ?></p>
                    <?php if ($paymentResult['status'] === 'success'): ?>
                        <hr>
                        <p class="mb-0">
                            مبلغ: <?= $paymentResult['amount'] ?> ریال<br>
                            شماره پیگیری: <?= $paymentResult['traceNo'] ?? '--' ?><br>
                            شماره ارجاع: <?= $paymentResult['rrn'] ?? '--' ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($terminal_id): ?>
                <!-- اگر terminal_id از URL دریافت شده باشد -->
                <div class="terminal-info">
                    <h5 class="mb-1">پذیرنده: <?= htmlspecialchars($acquirerName) ?></h5>
                    <p>شناسه ترمینال دریافت شده:</p>
                    <h3 class="text-primary"><?= htmlspecialchars($terminal_id) ?></h3>
                </div>

                <!-- نمایش فرم پرداخت فقط وقتی terminal_id وجود دارد -->
                <div class="payment-form-container show">
                    <form id="paymentForm" method="post">
                        <div class="mb-3">
                            <label for="amountInput" class="form-label">مبلغ (ریال)</label>
                            <input type="text" class="form-control" id="amountInput" name="amount"
                                placeholder="مثلاً ۱۵۰,۰۰۰" required>
                            <div class="invalid-feedback" id="amountError">لطفاً مبلغ معتبری وارد کنید.</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">ثبت و پرداخت</button>
                    </form>
                </div>
            <?php else: ?>
                <!-- اگر terminal_id وجود نداشته باشد، اسکنر نمایش داده می‌شود -->
                <div class="qr-section">
                    <div class="qr-scanner-placeholder" id="scanner">
                        <div class="scanner-overlay" id="scanner-overlay">
                            <i class="fas fa-qrcode mb-3"></i>
                            <span id="qrInitialText">برای شروع اسکن QR Code کلیک کنید</span>
                        </div>
                        <video id="scanner-video"></video>
                    </div>

                    <div class="scanner-controls">
                        <button id="startBtn" class="btn-scan btn-start-scan">شروع اسکن</button>
                        <button id="stopBtn" class="btn-scan btn-stop-scan" style="display: none;">توقف اسکن</button>
                    </div>

                    <div id="cameraPermissionDenied" class="camera-permission-denied">
                        دسترسی به دوربین داده نشد. لطفاً مجوز دسترسی را بررسی کنید.
                    </div>

                    <div id="result" class="terminal-info" style="display: none;">
                        <h5 class="mb-1">پذیرنده: <?= htmlspecialchars($acquirerName) ?></h5>
                        <p>شناسه ترمینال:</p>
                        <h3 class="text-primary" id="scanned-terminal"></h3>

                        <!-- فرم پرداخت که پس از اسکن نمایش داده می‌شود -->
                        <div class="payment-form-container" id="scannedPaymentForm">
                            <form id="paymentForm" method="post">
                                        <input type="hidden" name="terminal_id" id="terminal_id_input" value="">

                                <div class="mb-3">
                                    <label for="amountInput" class="form-label">مبلغ (ریال)</label>
                                    <input type="text" class="form-control" id="amountInput" name="amount"
                                        placeholder="مثلاً ۱۵۰,۰۰۰" required>
                                    <div class="invalid-feedback" id="amountError">لطفاً مبلغ معتبری وارد کنید.</div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">ثبت و پرداخت</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column active"
                        href="credit.php<?php echo '?sr=' . random_int(1, 1000000000); ?>" aria-label="خانه"><i
                            class="fas fa-home"></i> خانه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                        href="credit-debt.php<?php echo '?sr=' . random_int(1, 1000000000); ?>" aria-label="پرداخت"><i
                            class="fas fa-credit-card"></i> پرداخت</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                        href="history.php<?php echo '?sr=' . random_int(1, 1000000000); ?>" aria-label="تاریخچه">
                        <i class="fas fa-clock-rotate-left"></i>تاریخچه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                        href="profile.php<?php echo '?sr=' . random_int(1, 1000000000); ?>" aria-label="پروفایل"><i
                            class="fas fa-user-circle"></i> پروفایل</a></li>
            </ul>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            <?php if (!$terminal_id): ?>
                const scannerElement = document.getElementById('scanner');
                const scannerVideo = document.getElementById('scanner-video');
                const scannerOverlay = document.getElementById('scanner-overlay');
                const qrInitialText = document.getElementById('qrInitialText');
                const startBtn = document.getElementById('startBtn');
                const stopBtn = document.getElementById('stopBtn');
                const resultDiv = document.getElementById('result');
                const scannedTerminalSpan = document.getElementById('scanned-terminal');
                const paymentFormContainer = document.getElementById('scannedPaymentForm');
                const permissionDeniedMsg = document.getElementById('cameraPermissionDenied');

                let codeReader;
                let isScanning = false;
                let scannedTerminalId = '';
                let videoStream = null;

                // تنظیمات اسکنر
                function setupScanner() {
                    codeReader = new ZXing.BrowserQRCodeReader();
                    console.log('ZXing initialized:', codeReader);

                    // کلیک روی ناحیه اسکنر
                    scannerElement.addEventListener('click', () => {
                        if (!isScanning) {
                            startScanner();
                        }
                    });

                    // دکمه شروع اسکن
                    startBtn.addEventListener('click', startScanner);

                    // دکمه توقف اسکن
                    stopBtn.addEventListener('click', stopScanner);
                }

                // شروع اسکن
                async function startScanner() {
                    if (isScanning) return;

                    try {
                        // درخواست دسترسی به دوربین
                        videoStream = await navigator.mediaDevices.getUserMedia({
                            video: {
                                facingMode: 'environment'
                            },
                            audio: false
                        });

                        permissionDeniedMsg.style.display = 'none';
                        scannerVideo.srcObject = videoStream;
                        scannerVideo.style.display = 'block';
                        scannerOverlay.style.display = 'none';

                        // شروع اسکن QR
                        await codeReader.decodeFromVideoDevice(
                            null,
                            scannerVideo,
                            (result, err) => {
                                if (result) {
                                    handleScanResult(result.text);
                                }
                                if (err && !(err instanceof ZXing.NotFoundException)) {
                                    console.error('Scan error:', err);
                                }
                            }
                        );

                        isScanning = true;
                        startBtn.style.display = 'none';
                        stopBtn.style.display = 'inline-block';
                        resultDiv.style.display = 'none';

                    } catch (error) {
                        console.error('Camera access error:', error);
                        permissionDeniedMsg.style.display = 'block';
                        qrInitialText.textContent = 'خطا در دسترسی به دوربین';
                    }
                }

                // توقف اسکن
                function stopScanner() {
                    if (!isScanning) return;

                    codeReader.reset();

                    // توقف استریم دوربین
                    if (videoStream) {
                        videoStream.getTracks().forEach(track => track.stop());
                        videoStream = null;
                    }

                    isScanning = false;
                    scannerVideo.style.display = 'none';
                    scannerOverlay.style.display = 'flex';
                    startBtn.style.display = 'inline-block';
                    stopBtn.style.display = 'none';
                }

                // پردازش نتیجه اسکن
                function handleScanResult(scannedData) {
                    try {
                        console.log('Scanned data:', scannedData);

                        // استخراج شناسه ترمینال از URL (اگر داده یک URL است)
                        let terminalId = extractTerminalId(scannedData);

                        if (terminalId) {
                            scannedTerminalId = terminalId;
                            scannedTerminalSpan.textContent = scannedTerminalId;
                            resultDiv.style.display = 'block';

                            // نمایش فرم پرداخت پس از اسکن موفق
                            paymentFormContainer.classList.add('show');

                            const terminalIdInput = document.createElement('input');
                            terminalIdInput.type = 'hidden';
                            terminalIdInput.name = 'terminal_id';
                            terminalIdInput.value = terminalId;
                            paymentForm.appendChild(terminalIdInput);

                            stopScanner();
                        } else {
                            throw new Error('شناسه ترمینال در QR Code یافت نشد');
                        }
                    } catch (e) {
                        console.error('Error parsing QR data:', e);
                        scannedTerminalSpan.textContent = 'خطا: ' + e.message;
                        resultDiv.style.display = 'block';
                        paymentFormContainer.classList.remove('show');
                    }
                }

                // تابع برای استخراج شناسه ترمینال از URL
                function extractTerminalId(data) {
                    try {
                        // اگر داده JSON است
                        const jsonData = JSON.parse(data);
                        if (jsonData.terminal_id) {
                            return jsonData.terminal_id;
                        }
                    } catch (e) {
                        // اگر JSON نبود، شاید URL باشد
                        const urlParams = new URLSearchParams(data.split('?')[1]);
                        const terminalId = urlParams.get('terminal_id');
                        if (terminalId) {
                            return terminalId;
                        }

                        // اگر فقط شناسه ترمینال است
                        if (/^[a-zA-Z0-9_-]+$/.test(data)) {
                            return data;
                        }
                    }
                    return null;
                }

                // راه اندازی اسکنر
                setupScanner();
            <?php endif; ?>

            // مدیریت فرم پرداخت
            // مدیریت فرم پرداخت
            const amountInput = document.getElementById('amountInput');

            if (amountInput) {
                amountInput.addEventListener('input', function (e) {
                    // تبدیل اعداد فارسی به انگلیسی
                    const persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                    const englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                    let value = this.value;

                    for (let i = 0; i < 10; i++) {
                        value = value.replace(new RegExp(persianNumbers[i], 'g'), englishNumbers[i]);
                    }

                    // حذف همه کاراکترهای غیر عددی به جز ویرگول
                    value = value.replace(/[^\d,]/g, '');

                    // فرمت کردن مبلغ با جداکننده هزارگان
                    if (value.length > 0) {
                        let num = value.replace(/,/g, '');
                        if (!isNaN(num)) {
                            this.value = parseInt(num).toLocaleString('fa-IR');
                        }
                    }
                });
            }

            const paymentForm = document.getElementById('paymentForm');

            if (paymentForm) {
                paymentForm.addEventListener('submit', function (e) {
                    // تبدیل اعداد فارسی به انگلیسی و حذف جداکننده‌ها
                    const persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                    const englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                    let amountValue = amountInput.value;

                    for (let i = 0; i < 10; i++) {
                        amountValue = amountValue.replace(new RegExp(persianNumbers[i], 'g'), englishNumbers[i]);
                    }

                    amountValue = amountValue.replace(/[^\d]/g, '');

                    if (!amountValue || parseInt(amountValue) < 1000000) {
                        e.preventDefault();
                        amountInput.classList.add('is-invalid');
                        swal('خطا', 'لطفاً مبلغ معتبری وارد کنید (حداقل 1,000,000 ریال)', 'error');
                    } else {
                        amountInput.classList.remove('is-invalid');
                        // مقدار نهایی را به فرم ارسال می‌کنیم
                        amountInput.value = amountValue;
                    }
                });
            }

            // نمایش پیام نتیجه تراکنش
            <?php if ($paymentResult): ?>
                swal({
                    title: "<?= $paymentResult['status'] === 'success' ? 'تراکنش موفق' : 'خطا' ?>",
                    text: "<?= $paymentResult['message'] ?>",
                    icon: "<?= $paymentResult['status'] === 'success' ? 'success' : 'error' ?>",
                    button: "متوجه شدم",
                });
            <?php endif; ?>
        });
    </script>
</body>

</html>