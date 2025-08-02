<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies


session_start();



function convertToPersianNumber($number, $decimals = 0)
{
    // تبدیل به عدد با جداکنندهٔ هزارگان و اعشار (در صورت نیاز)
    $formatted = number_format($number, $decimals);

    // تبدیل ارقام انگلیسی به فارسی
    $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ','];
    $fa = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٬'];

    return strtr($formatted, array_combine($en, $fa));
}


if (isset($_SESSION['mobileNumber'])) {
    $mobileNumber = $_SESSION['mobileNumber'];
} else {
    session_unset();
    header('Location: login-user.php');
    exit();
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


// تلاش برای تبدیل به JSON
$userData = json_decode($response, true);

// اگر داده‌ها معتبر بودن و خطا نبود، در سشن ذخیره شود


?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اعتبار شما</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link href="./assets/css/Vazirmatn-Variable-font-face.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./assets/css/animate.min.css" />
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/brands.min.css">
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
        }

        body {
            font-family: 'Vazirmatn', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: var(--dark-color);
            line-height: 1.6;
            padding-bottom: 80px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styles */
        .club-header {
            padding: 1.5rem 0;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 0 0 25px 25px;
            box-shadow: 0 8px 25px rgba(78, 115, 223, 0.2);
            position: relative;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .club-header::before,
        .club-header::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            filter: blur(3px);
            z-index: 0;
        }

        .club-header::before {
            top: -40px;
            right: -40px;
            width: 150px;
            height: 150px;
        }

        .club-header::after {
            bottom: -60px;
            left: -20px;
            width: 200px;
            height: 200px;
        }

        .club-header h3,
        .club-header p {
            position: relative;
            z-index: 1;
        }

        .club-header h3 {
            font-weight: 800;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }

        .club-header p {
            font-weight: 400;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        /* Credit Offer Section */
        .credit-offer {
            background: var(--light-color);
            border-radius: 20px;
            padding: 2.5rem;
            margin: -30px auto 3rem auto;
            max-width: 600px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
            position: relative;
            z-index: 2;
        }

        .credit-offer:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .credit-offer h5 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .main-credit-amount {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.08);
        }

        .credit-summary-details {
            margin-top: 2rem;
            border-top: 1px dashed #e0e0e0;
            padding-top: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .credit-summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1rem;
            color: var(--text-color-light);
        }

        .credit-summary-item strong {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 1.1rem;
        }


        .credit-desc {
            color: var(--text-color-light);
            text-align: center;
            margin: 1.5rem 0 2.5rem 0;
            line-height: 1.8;
            font-size: 1rem;
        }

        /* Call to Action Buttons (Shop, Service) */
        .credit-offer .btn {
            padding: 0.9rem 1.8rem;
            font-weight: 700;
            border-radius: 15px;
            font-size: 1.05rem;
            transition: all 0.3s ease;
        }

        .credit-offer .btn-credit {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
        }

        .credit-offer .btn-credit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(91, 134, 229, 0.4);
        }

        .credit-offer .btn-outline-light {
            border: 2px solid #dee2e6;
            color: var(--dark-color) !important;
        }

        .credit-offer .btn-outline-light:hover {
            background-color: var(--light-color);
            border-color: var(--primary-color);
            color: var(--primary-color) !important;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        /* QR Promo Card Styles (outside credit card) */
        .qr-promo-card {
            background: linear-gradient(45deg, var(--accent-color) 0%, #EEB4B4 100%);
            color: white;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: 0 12px 30px rgba(255, 107, 107, 0.4);
            position: relative;
            overflow: hidden;
            margin-top: 2rem;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            z-index: 1;
        }

        .qr-promo-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 45px rgba(255, 107, 107, 0.6);
        }

        .qr-promo-card::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -20%;
            width: 140%;
            height: 140%;
            background: rgba(255, 255, 255, 0.15);
            transform: rotate(30deg);
            filter: blur(15px);
            border-radius: 50%;
            z-index: 0;
        }

        .qr-promo-card .qr-promo-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
            text-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
        }

        .qr-promo-card h4 {
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
            font-size: 1.6rem;
        }

        .qr-promo-card p {
            font-size: 1.15rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }

        .qr-promo-card .btn-light {
            padding: 1rem 2.5rem;
            border-radius: 30px;
            font-weight: bold;
            font-size: 1.1rem;
            color: var(--accent-color);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .qr-promo-card .btn-light:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            color: #d15c5c;
        }

        /* Feature Cards */
        .feature-section {
            padding: 2rem 0;
        }

        .feature-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 25px;
            height: 100%;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 1;
            padding-top: 5px;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            z-index: 0;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.15);
        }

        .card-body {
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .card-title {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark-color);
            font-size: 1.3rem;
        }

        .card-text {
            color: var(--text-color-light);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        /* Bottom Navigation Bar */
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

        /* Call to Action Buttons (Shop, Service, Payment Page) */
        .credit-offer .btn {
            padding: 1rem 1.5rem;
            /* پدینگ یکسان برای همه دکمه‌ها */
            font-weight: 700;
            border-radius: 15px;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            flex-grow: 1;
            /* اطمینان از اینکه دکمه‌ها فضای موجود را به اشتراک می‌گذارند */
            min-width: 120px;
            /* حداقل عرض برای دکمه‌ها */
            text-align: center;
            /* تراز متن در مرکز */
            display: inline-flex;
            /* استفاده از فلکس برای تراز عمودی و افقی محتوا */
            align-items: center;
            /* تراز عمودی آیکون و متن */
            justify-content: center;
            /* تراز افقی آیکون و متن */
        }

        .credit-offer .btn-primary-gradient {
            /* نام کلاس جدید برای دکمه اصلی (خرید کالا) */
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
        }

        .credit-offer .btn-primary-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(91, 134, 229, 0.4);
        }

        .credit-offer .btn-outline-primary-custom {
            /* نام کلاس جدید برای دکمه‌های outline */
            border: 2px solid var(--primary-color);
            /* رنگ حاشیه مطابق با primary-color */
            color: var(--primary-color);
            /* رنگ متن مطابق با primary-color */
            background-color: transparent;
            /* پس‌زمینه شفاف */
        }

        .credit-offer .btn-outline-primary-custom:hover {
            background-color: var(--primary-color);
            /* پر شدن با primary-color در هاور */
            color: white !important;
            /* رنگ متن سفید در هاور */
            border-color: var(--primary-color);
            /* حفظ رنگ حاشیه در هاور */
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        /* Responsive Adjustments for buttons */
        @media (max-width: 768px) {
            .credit-offer .btn {
                padding: 0.8rem 1rem;
                font-size: 0.9rem;
                min-width: unset;
                /* حذف حداقل عرض در موبایل */
            }

            .d-flex.justify-content-between.mt-4.gap-3 {
                flex-direction: column;
                /* چیدمان دکمه‌ها به صورت ستونی در موبایل */
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            body {
                padding-bottom: 70px;
            }

            .club-header {
                padding: 1.2rem 0;
                border-radius: 0 0 20px 20px;
            }

            .club-header h3 {
                font-size: 1.8rem;
            }

            .club-header p {
                font-size: 0.9rem;
            }

            .credit-offer {
                padding: 1.8rem;
                margin: -30px auto 2rem auto;
                transform: translateY(0);
            }

            .credit-offer:hover {
                transform: translateY(0);
            }


            .main-credit-amount {
                font-size: 2.2rem;
            }

            .credit-summary-details {
                margin-top: 1.5rem;
                padding-top: 1rem;
            }

            .credit-summary-item {
                font-size: 0.9rem;
            }

            .credit-summary-item strong {
                font-size: 1rem;
            }


            .credit-desc {
                font-size: 0.9rem;
                margin: 1rem 0 2rem 0;
            }

            .credit-offer .btn {
                padding: 0.8rem 1.2rem;
                font-size: 0.95rem;
            }

            .qr-promo-card {
                padding: 2rem 1.5rem;
                margin-top: 1.5rem;
                transform: translateY(0);
            }

            .qr-promo-card:hover {
                transform: translateY(0);
            }

            .qr-promo-card .qr-promo-icon {
                font-size: 4rem;
                margin-bottom: 1rem;
            }

            .qr-promo-card h4 {
                font-size: 1.4rem;
            }

            .qr-promo-card p {
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .qr-promo-card .btn-light {
                padding: 0.8rem 2rem;
                font-size: 1rem;
            }

            .feature-card {
                padding-top: 0;
            }

            .feature-card::before {
                height: 3px;
            }

            .feature-card:hover {
                transform: translateY(0);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            }

            .feature-icon {
                font-size: 2.5rem;
                margin-bottom: 1rem;
            }

            .card-title {
                font-size: 1.1rem;
            }

            .card-text {
                font-size: 0.85rem;
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
    <div class="club-header text-center">
        <div class="container">
            <h3>اعتبار من</h3>
            <p>با این اعتبار خرید کنید</p>
        </div>
    </div>

    <div class="container flex-grow-1 d-flex flex-column justify-content-center align-items-center">
        <div class="credit-offer text-center">
            <h5 class="mb-3">اعتبار باقی‌مانده <?php echo ($userData['merchantName']); ?>:</h5>
            <div class="main-credit-amount"><?php echo convertToPersianNumber($userData['credit'] ?? 0); ?> ریال</div>

            <div class="credit-summary-details">
               
              <div class="credit-summary-item">
                    <span>مانده بدهی</span>
                    <strong><?php echo convertToPersianNumber($userData['debt'] ?? 0); ?> ریال</strong>
                </div> 

            </div>

            <p class="credit-desc mt-4">
                می‌توانید برای خرید کالا یا خدمات از این اعتبار استفاده کنید.
                کافیست روش «پرداخت اعتباری» را انتخاب کنید و یا مستقیماً از QR Code خرید کنید.
            </p>

            <div class="d-flex justify-content-between mt-4 gap-3">
                <a href="credit-debt.php<?php echo '?sr=' . random_int(1, 1000000000); ?>"
                    class="btn btn-primary-gradient" aria-label="صفحه پرداخت">
                    <i class="fas fa-credit-card me-2"></i> صفحه پرداخت
                </a>

                <a href="history.php<?php echo '?sr=' . random_int(1, 1000000000); ?>" class="btn btn-outline-primary-custom" aria-label="تاریخچه">
                    <i class="fas fa-clock-rotate-left me-2"></i> تاریخچه 
                </a>

            </div>
        </div>

        <div class="container">
            <div class="qr-promo-card animate__animated animate__fadeInUp">
                <div class="qr-promo-icon">
                    <i class="fas fa-qrcode"></i>
                </div>
                <div class="qr-promo-content">
                    <h4 class="mb-2">پرداخت سریع با QR Code</h4>
                    <p>با اسکن QR Code، خریدهای خود را به سادگی و سرعت انجام دهید.</p>
                    <a href="qr_code_page.php<?php echo '?sr=' . random_int(1, 1000000000); ?>" class="btn btn-light btn-lg" aria-label="پرداخت با QR Code">
                        <i class="fas fa-arrow-left ms-2"></i> شروع پرداخت
                    </a>
                </div>
            </div>
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
                            <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="history.php<?php echo '?sr=' . random_int(1, 1000000000); ?>"
                        aria-label="تاریخچه">
                        <i class="fas fa-clock-rotate-left"></i>تاریخچه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php<?php echo '?sr=' . random_int(1, 1000000000); ?>"
                        aria-label="پروفایل"><i class="fas fa-user-circle"></i> پروفایل</a></li>
            </ul>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const creditAmountElement = document.getElementById('creditAmount');

            // فقط اگر عنصر وجود داشت اجرا شود
            if (creditAmountElement) {
                function generateRandomCredit() {
                    const min = 20;
                    const max = 200;
                    const step = 1;
                    const range = (max - min) / step;
                    const randomNumber = Math.floor(Math.random() * (range + 1)) * step + min;
                    return randomNumber * 1000000;
                }

                function formatCurrency(amount) {
                    return amount.toLocaleString('fa-IR') + ' ریال';
                }

                const randomCredit = generateRandomCredit();
                creditAmountElement.textContent = formatCurrency(randomCredit);
            }
        });
    </script>
    >
</body>

</html>