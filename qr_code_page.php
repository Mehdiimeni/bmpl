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
            <div class="qr-section">
                <div class="qr-scanner-placeholder text-center" id="qrScannerPlaceholder">
                    <i class="fas fa-qrcode"></i>
                    <span id="qrInitialText">برای شروع اسکن QR Code اینجا کلیک کنید</span>
                </div>

                <div class="product-details" id="productDetails">
                    <p class="scan-success-message">اسکن با موفقیت انجام شد!</p>
                    <p>کد کالا: <strong id="productCode"></strong></p>
                    <p>نام کالا: <strong id="productName"></strong></p>
                    <p>شرح: <strong id="productDescription"></strong></p>
                    <button type="button" class="btn btn-rescan mt-3" id="rescanBtn">
                        <i class="fas fa-redo-alt"></i> اسکن مجدد
                    </button>
                </div>
            </div>

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
                <li>
                    <a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="shop.php"
                        aria-label="فروشگاه">
                        <i class="fas fa-store-alt"></i>
                        <span>فروشگاه</span>
                    </a>
                </li>
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
            const amountInput = document.getElementById('amountInput');
            const amountError = document.getElementById('amountError');
            const paymentForm = document.getElementById('paymentForm');
            const paymentOptionsDiv = document.getElementById('paymentOptions');
            const fullPaymentAmountSpan = document.getElementById('fullPaymentAmount');
            const installmentAmountSpan = document.getElementById('installmentAmount');
            const payNowBtn = document.getElementById('payNowBtn');
            const paymentOptionCards = document.querySelectorAll('.payment-option-card');
            const radioButtons = document.querySelectorAll('input[name="paymentType"]');

            const qrScannerPlaceholder = document.getElementById('qrScannerPlaceholder');
            const qrInitialText = document.getElementById('qrInitialText');
            const productDetailsDiv = document.getElementById('productDetails');
            const productCodeSpan = document.getElementById('productCode');
            const productNameSpan = document.getElementById('productName');
            const productDescriptionSpan = document.getElementById('productDescription');
            const qrIcon = qrScannerPlaceholder.querySelector('i');
            const rescanBtn = document.getElementById('rescanBtn');

            let enteredAmount = 0; // Global variable to store the entered amount

            // Array of sample products
            const sampleProducts = [
                {
                    code: 'PROD-101',
                    name: 'لپ‌تاپ گیمینگ قدرتمند',
                    description: 'لپ‌تاپی مناسب برای بازی و کارهای سنگین با کارت گرافیک RTX.',
                    amount: 35000000
                },
                {
                    code: 'PROD-102',
                    name: 'هدفون بی‌سیم نویز کنسلینگ',
                    description: 'تجربه‌ای بی‌نظیر از صدا با حذف نویز فعال و باتری طولانی.',
                    amount: 4200000
                },
                {
                    code: 'PROD-103',
                    name: 'ماشین لباسشویی هوشمند',
                    description: 'ماشین لباسشویی کم‌مصرف با برنامه‌های متنوع شستشو و قابلیت هوشمند.',
                    amount: 18000000
                },
                {
                    code: 'PROD-104',
                    name: 'ساعت هوشمند ورزشی',
                    description: 'همراهی ایده‌آل برای تمرینات ورزشی و پایش سلامتی روزانه.',
                    amount: 2800000
                },
                {
                    code: 'PROD-105',
                    name: 'قهوه‌ساز اتوماتیک',
                    description: 'تهیه قهوه‌ای لذیذ تنها با یک دکمه، دارای آسیاب داخلی.',
                    amount: 7500000
                },
                {
                    code: 'PROD-106',
                    name: 'تلفن همراه هوشمند مدل Z',
                    description: 'جدیدترین مدل گوشی هوشمند با دوربین فوق‌العاده و عملکرد بی‌نقص.',
                    amount: 22000000
                },
                {
                    code: 'PROD-107',
                    name: 'تلویزیون هوشمند 4K',
                    description: 'تصویری خیره‌کننده با کیفیت 4K و قابلیت‌های هوشمند برای سرگرمی بیشتر.',
                    amount: 12000000
                },
                {
                    code: 'PRO0-108',
                    name: 'اسپیکر بلوتوثی قابل حمل',
                    description: 'صدای قوی و شفاف در یک طراحی جمع‌وجور، مناسب برای هر مکان.',
                    amount: 1500000
                },
                {
                    code: 'PROD-109',
                    name: 'پکیج آموزشی آنلاین زبان انگلیسی',
                    description: 'دوره جامع آموزش زبان انگلیسی از مبتدی تا پیشرفته با پشتیبانی مدرس.',
                    amount: 900000
                },
                {
                    code: 'PROD-110',
                    name: 'دوچرخه کوهستان حرفه‌ای',
                    description: 'دوچرخه‌ای مقاوم و سبک برای مسیرهای دشوار کوهستانی.',
                    amount: 11000000
                },
                {
                    code: 'PROD-111',
                    name: 'فر توکار برقی',
                    description: 'فری با قابلیت‌های پخت متنوع و صفحه نمایش لمسی.',
                    amount: 9500000
                },
                {
                    code: 'PROD-112',
                    name: 'جاروبرقی رباتیک هوشمند',
                    description: 'خانه‌ای تمیز با جاروبرقی خودکار و قابلیت کنترل از راه دور.',
                    amount: 5500000
                },
                {
                    code: 'PROD-113',
                    name: 'کنسول بازی نسل جدید',
                    description: 'تجربه بازی‌های هیجان‌انگیز با گرافیک بالا و سرعت بی‌نظیر.',
                    amount: 16000000
                },
                {
                    code: 'PROD-114',
                    name: 'دوربین عکاسی DSLR',
                    description: 'برای علاقه‌مندان به عکاسی، با لنز قابل تعویض و کیفیت تصویر عالی.',
                    amount: 14000000
                },
                {
                    code: 'PROD-115',
                    name: 'یخچال ساید بای ساید',
                    description: 'فضای بزرگ و طراحی مدرن، همراه با سیستم خنک‌کننده پیشرفته.',
                    amount: 28000000
                }
            ];

            // Helper to format currency
            function formatCurrency(amount) {
                return amount.toLocaleString('fa-IR') + ' ریال';
            }

            // Function to reset the QR scan section to its initial state
            function resetQrScanSection() {
                qrScannerPlaceholder.style.display = 'flex';
                qrScannerPlaceholder.style.pointerEvents = 'auto'; // Enable clicks
                qrScannerPlaceholder.style.opacity = '1';
                qrScannerPlaceholder.style.border = '2px dashed #ccc';
                qrScannerPlaceholder.style.backgroundColor = '#f0f0f0';
                qrScannerPlaceholder.style.height = '250px'; // Reset fixed height

                qrIcon.classList.remove('fa-check-circle', 'text-success');
                qrIcon.classList.add('fa-qrcode');
                qrInitialText.textContent = 'برای شروع اسکن QR Code اینجا کلیک کنید';

                productDetailsDiv.style.display = 'none'; // Hide product details
                productDetailsDiv.classList.remove('animate__animated', 'animate__fadeIn'); // Remove animation classes

                amountInput.value = ''; // Clear amount input
                amountInput.classList.remove('is-valid', 'is-invalid'); // Clear validation styles
                amountError.style.display = 'none';

                paymentOptionsDiv.classList.add('d-none'); // Hide payment options
                paymentOptionsDiv.style.opacity = '0';
            }

            // Simulate QR scan and display product details
            qrScannerPlaceholder.addEventListener('click', () => {
                // Get a random product from the array
                const randomIndex = Math.floor(Math.random() * sampleProducts.length);
                const scannedData = sampleProducts[randomIndex];

                // Hide QR placeholder content and display product details
                qrScannerPlaceholder.style.display = 'none'; // Hide the initial placeholder entirely

                productCodeSpan.textContent = scannedData.code;
                productNameSpan.textContent = scannedData.name;
                productDescriptionSpan.textContent = scannedData.description;

                productDetailsDiv.style.display = 'block'; // Show product details
                productDetailsDiv.classList.add('animate__animated', 'animate__fadeIn');

                // Set the amount input value from scanned data
                amountInput.value = scannedData.amount;
                amountInput.dispatchEvent(new Event('input')); // Trigger input event for validation and calculations

                // Scroll to payment options if already open, or to product details
                if (!paymentOptionsDiv.classList.contains('d-none')) {
                    paymentOptionsDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    productDetailsDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });

            // Handle rescan button click
            rescanBtn.addEventListener('click', () => {
                location.reload(); // Reload the page to reset everything
            });


            // Validate amount input
            amountInput.addEventListener('input', () => {
                const value = parseInt(amountInput.value);
                if (value && value >= 1000) {
                    amountInput.classList.remove('is-invalid');
                    amountInput.classList.add('is-valid');
                    amountError.style.display = 'none';
                } else {
                    amountInput.classList.remove('is-valid');
                    amountInput.classList.add('is-invalid');
                    amountError.style.display = 'block';
                }
            });

            // Handle form submission (Confirm Amount)
            paymentForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const value = parseInt(amountInput.value);

                if (value && value >= 1000) {
                    enteredAmount = value;
                    paymentOptionsDiv.classList.remove('d-none');
                    paymentOptionsDiv.style.animation = 'fadeIn 0.8s ease-out forwards';

                    // Reset radio buttons and pay button state
                    radioButtons.forEach(radio => radio.checked = false);
                    payNowBtn.disabled = true;
                    paymentOptionCards.forEach(card => card.classList.remove('selected'));

                    // Calculate and display payment details
                    fullPaymentAmountSpan.textContent = formatCurrency(enteredAmount);
                    // For installments, typically there's an interest/fee. Let's assume a simple 5% for example.
                    const installmentTotal = enteredAmount * 1.05; // 5% interest
                    const singleInstallment = installmentTotal / 4;
                    installmentAmountSpan.textContent = formatCurrency(Math.round(singleInstallment));

                    // Scroll to payment options
                    paymentOptionsDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });

                } else {
                    amountInput.classList.add('is-invalid');
                    amountError.style.display = 'block';
                }
            });

            // Handle selection of payment option
            paymentOptionCards.forEach(card => {
                card.addEventListener('click', () => {
                    paymentOptionCards.forEach(c => c.classList.remove('selected'));
                    card.classList.add('selected');
                    const radio = card.querySelector('input[type="radio"]');
                    if (radio) {
                        radio.checked = true;
                        payNowBtn.disabled = false; // Enable final pay button
                    }
                });
            });

            // Handle final payment button click
            payNowBtn.addEventListener('click', () => {
                const selectedOption = document.querySelector('input[name="paymentType"]:checked');
                if (selectedOption) {
                    // بجای نمایش alert، کاربر را به صفحه رسید هدایت می‌کنیم
                    // مبلغ تراکنش را به عنوان پارامتر 'amount' به URL اضافه می‌کنیم
                    window.location.href = `bank-receipt.php?amount=${enteredAmount}`;
                } else {
                    alert('لطفاً یک گزینه پرداخت را انتخاب کنید.');
                }
            });
        });
    </script>
</body>

</html>