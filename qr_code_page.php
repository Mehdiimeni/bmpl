<?php
session_start();

// دریافت شناسه ترمینال از URL
$terminal_id = isset($_GET['terminal_id']) ? urldecode($_GET['terminal_id']) : null;
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
    <!-- استفاده از نسخه صحیح ZXing -->
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <style>
        :root {
            --primary-color: #5b86e5;
            /* Lighter primary color */
            --secondary-color: #3656a8;
            /* Darker secondary for gradient */
            --accent-color: #ff6b6b;
            /* Accent color for QR promo */
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --text-color-light: #6c757d;
            --success-color: #28a745;
            /* Green for success */
            --danger-color: #dc3545;
            /* Red for errors */
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

        /* بقیه استایل‌ها مانند قبل... */
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
            <?php if ($terminal_id): ?>
                <!-- اگر terminal_id از URL دریافت شده باشد -->
                <div class="terminal-info">
                    <p>شناسه ترمینال دریافت شده:</p>
                    <h3 class="text-primary"><?= htmlspecialchars($terminal_id) ?></h3>
                    <a href="qr_code_page.php?terminal_id=<?= urlencode($terminal_id) ?>"
                        class="btn btn-success btn-action mt-3">
                        ادامه به پرداخت
                    </a>
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
                        <p>شناسه ترمینال :</p>
                        <h3 class="text-primary" id="scanned-terminal"></h3>
                        <button id="proceedBtn" class="btn btn-success btn-action mt-3">
                            ادامه به پرداخت
                        </button>
                    </div>
                </div>
            <?php endif; ?>

            <form id="paymentForm">
                <div class="mb-3">
                    <label for="amountInput" class="form-label">مبلغ (ریال)</label>
                    <input type="number" class="form-control" id="amountInput" placeholder="مثلاً 150000" min="1000"
                        required>
                    <div class="invalid-feedback" id="amountError">لطفاً مبلغ معتبری وارد کنید.</div>
                </div>

                <button type="submit" class="btn btn-submit w-100">تایید مبلغ</button>
            </form>

            <div id="paymentOptions" class="payment-options d-none">
                <h5 class="text-center mb-4">نحوه بازپرداخت اعتبار</h5>

                <div class="payment-option-card mb-3" data-option="full">
                    <label class="d-flex align-items-center justify-content-between w-100">
                        <span>تسویه تا 30 ام ماه</span>
                        <input type="radio" name="paymentType" value="full">
                    </label>
                    <div class="installment-details w-100 text-end">
                        مبلغ قابل پرداخت: <strong id="fullPaymentAmount">۰ ریال</strong>
                    </div>
                </div>

                <div class="payment-option-card" data-option="installments">
                    <label class="d-flex align-items-center justify-content-between w-100">
                        <span>4 قسط ماهانه</span>
                        <input type="radio" name="paymentType" value="installments">
                    </label>
                    <div class="installment-details w-100 text-end">
                        مبلغ هر قسط: <strong id="installmentAmount">۰ ریال</strong>
                    </div>
                </div>

                <button type="button" class="btn btn-pay-now w-100 mt-4" id="payNowBtn" disabled>ثبت</button>
            </div>
        </div>
    </div>

    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column" href="credit.php"
                        aria-label="خانه"><i class="fas fa-home"></i> خانه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="service.php"
                        aria-label="خدمات">
                        <i class="fas fa-bell-concierge"></i> خدمات</a></li>

                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="credit-debt.php"
                        aria-label="سوابق"><i class="fas fa-clock-rotate-left"></i> پرداخت</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php"
                        aria-label="پروفایل"><i class="fas fa-user-circle"></i> پروفایل</a></li>
            </ul>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
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
                const proceedBtn = document.getElementById('proceedBtn');
                const permissionDeniedMsg = document.getElementById('cameraPermissionDenied');

                let codeReader;
                let isScanning = false;
                let scannedTerminalId = '';
                let videoStream = null;

                // تنظیمات اسکنر
                function setupScanner() {
                    // استفاده از ZXing از CDN
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
                                facingMode: 'environment' // اولویت با دوربین پشتی
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
                            proceedBtn.style.display = 'inline-block';

                            stopScanner();
                        } else {
                            throw new Error('شناسه ترمینال در QR Code یافت نشد');
                        }
                    } catch (e) {
                        console.error('Error parsing QR data:', e);
                        scannedTerminalSpan.textContent = 'خطا: ' + e.message;
                        resultDiv.style.display = 'block';
                        proceedBtn.style.display = 'none';
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

                // ادامه به صفحه پرداخت
                proceedBtn.addEventListener('click', () => {
                    if (scannedTerminalId) {
                        window.location.href = `qr_code_page.php?terminal_id=${encodeURIComponent(scannedTerminalId)}`;
                    }
                });

                // راه اندازی اسکنر
                setupScanner();
            <?php endif; ?>

            // مدیریت فرم پرداخت (مانند قبل)
            const paymentForm = document.getElementById('paymentForm');
            if (paymentForm) {
                paymentForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    // منطق پرداخت...
                });
            }
        });
    </script>
</body>

</html>