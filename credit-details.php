<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات اعتبار</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/brands.min.css">
    <style>
        /* Vazirmatn Font Import */
        @font-face {
            font-family: 'Vazirmatn';
            src: url('./assets/fonts/Vazirmatn-Regular.woff2') format('woff2');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Vazirmatn';
            src: url('./assets/fonts/Vazirmatn-Bold.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
        }

        /* Root Variables for consistent theming */
        :root {
            --primary-color: #007bff;
            /* Bootstrap primary blue */
            --secondary-color: #0056b3;
            /* Darker blue for gradients */
            --background-light: #f0f2f5;
            /* Light gray background */
            --text-dark: #333;
            /* Dark gray for main text */
            --text-muted: #6c757d;
            /* Muted gray for secondary text */
            --card-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.08);
            /* Soft, large shadow */
            --border-light: #e0e0e0;
            /* Light border color */
            --success-color: #28a745;
            /* Standard success green */
            --info-bg: #d1ecf1;
            /* Info alert background */
            --info-text: #0c5460;
            /* Info alert text color */
            --info-border: #bee5eb;
            /* Info alert border */
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
            /* Ensures space for bottom navigation bar */
            padding-bottom: 80px;
        }

        .club-header {
            /* Smaller padding */
            padding: 1.5rem 0;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 0 0 25px 25px;
            /* More subtle shadow */
            box-shadow: 0 8px 25px rgba(78, 115, 223, 0.2);
            position: relative;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .club-header::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            filter: blur(3px);
        }

        .club-header::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -20px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            filter: blur(3px);
        }

        .main-title {
            font-weight: 800;
            margin-bottom: 0.5rem;
            font-size: 2.2rem;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sub-title {
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            position: relative;
            z-index: 2;
        }

        .container {
            max-width: 600px;
        }

        /* Credit Card Container Styles */
        .credit-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-top: 2rem;
            margin-bottom: 2rem;
            /* Adjusted to fit the general content flow better */
        }

        /* Credit Header Styles */
        .credit-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            border-radius: 1.5rem 1.5rem 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .credit-header h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.75rem;
            position: relative;
            z-index: 1;
        }

        /* SVG Pattern for header background */
        .credit-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="15" fill="%23ffffff" opacity="0.1"/><circle cx="80" cy="80" r="20" fill="%23ffffff" opacity="0.05"/><circle cx="50" cy="50" r="10" fill="%23ffffff" opacity="0.15"/></svg>') repeat;
            opacity: 0.1;
            z-index: 0;
        }

        /* Balance Box Styles */
        .balance-box {
            background-color: #e9f0f7;
            padding: 1.5rem;
            border-radius: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            box-shadow: inset 0 0 0.5rem rgba(0, 0, 0, 0.05);
            border: 1px solid #d0d8e2;
        }

        .balance-box div:first-child {
            border-left: 3px solid var(--primary-color);
            padding-left: 1rem;
        }

        .balance-box .text-muted {
            font-size: 0.9rem;
            color: var(--text-muted) !important;
            margin-bottom: 0.25rem;
        }

        .balance-box .text-success {
            color: var(--success-color) !important;
            font-weight: 700;
            font-size: 2.25rem !important;
        }

        .balance-box .fw-bold {
            font-weight: 700 !important;
        }

        /* Installment Box Styles */
        .installment-box {
            background-color: white;
            border: 1px solid var(--border-light);
            border-radius: 1rem;
            padding: 1.75rem;
            margin-bottom: 1.25rem;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.03);
            position: relative;
        }

        .installment-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
            border-color: var(--primary-color);
        }

        .installment-box h5 {
            display: flex;
            align-items: center;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            font-size: 1.35rem;
        }

        .installment-box h5 .icon {
            margin-left: 0.75rem;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .installment-box p {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .installment-box p.text-muted {
            font-size: 0.85rem;
            color: #888 !important;
            margin-bottom: 0.5rem;
        }

        /* Alert Info Styles */
        .alert-info {
            border-radius: 1rem;
            font-weight: 500;
            text-align: center;
            background-color: var(--info-bg);
            color: var(--info-text);
            border-color: var(--info-border);
            padding: 1rem 1.5rem;
            margin-top: 2rem;
            font-size: 0.95rem;
        }

        /* Bottom Navigation Bar Styles */
        .bottom-navigation-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 -0.5rem 2rem rgba(0, 0, 0, 0.08);
            z-index: 1000;
            padding: 0.75rem 0;
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
        }

        .tf-navigation-bar {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100%;
        }

        .tf-navigation-bar li {
            flex: 1;
            text-align: center;
        }

        .tf-navigation-bar li a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0.25rem;
            color: #888;
            text-decoration: none;
            font-size: 0.8rem;
            transition: color 0.3s ease, transform 0.2s ease;
            font-weight: 500;
        }

        .tf-navigation-bar li a i {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
            transition: color 0.3s ease;
        }

        .tf-navigation-bar li a.active,
        .tf-navigation-bar li a:hover {
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .tf-navigation-bar li a.active i,
        .tf-navigation-bar li a:hover i {
            color: var(--primary-color);
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .credit-card {
                margin-top: 1.5rem;
            }

            .credit-header {
                padding: 1.5rem;
            }

            .credit-header h4 {
                font-size: 1.5rem;
            }

            .balance-box {
                padding: 1rem;
                flex-direction: column;
                align-items: flex-start;
            }

            .balance-box div:first-child {
                border-left: none;
                padding-left: 0;
                margin-bottom: 0.75rem;
            }

            .balance-box .text-end {
                text-align: start !important;
            }

            .balance-box .text-success {
                font-size: 1.8rem !important;
            }

            .installment-box {
                padding: 1.25rem;
            }

            .installment-box h5 {
                font-size: 1.15rem;
            }

            .installment-box h5 .icon {
                font-size: 1.25rem;
            }

            .installment-box p {
                font-size: 0.9rem;
            }

            .alert-info {
                padding: 0.75rem 1rem;
                font-size: 0.85rem;
            }

            .bottom-navigation-bar {
                padding: 0.5rem 0;
            }

            .tf-navigation-bar li a {
                font-size: 0.7rem;
            }

            .tf-navigation-bar li a i {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="club-header text-center">
        <div class="container">
            <h3 class="mb-3"> جزئیات اعتبار</h3>
            <p class="mb-0">جزئیات اعتبار من</p>
        </div>
    </div>
    <div class="container py-5">
        <div class="credit-card">

            <div class="p-4">
                <div class="balance-box">
                    <div>
                        <div class="text-muted">باقی‌مانده اعتبار</div>
                        <div class="text-success fw-bold fs-4">۱۳,۵۵۷,۹۱۱ ریال</div>
                    </div>
                    <div class="text-end">
                        <div class="text-muted">کل اعتبار</div>
                        <div class="fw-bold fs-6">۲۰,۰۰۰,۰۰۰ ریال</div>
                    </div>
                </div>

                <h5 class="mb-3 fw-bold">چطور از اعتبار BNPL استفاده کنم؟</h5>
                <p class="text-muted mb-4">می‌توانید با اعتبارتان از فروشگاه‌های حاضر در BNPL به‌صورت آنلاین یا حضوری
                    خرید کرده و با یکی از روش‌های زیر تسویه کنید:</p>

                <div class="installment-box">
                    <h5><i class="fas fa-credit-card icon"></i> پرداخت قسطی</h5>
                    <p class="mb-1 text-muted">تا سقف اعتبار</p>
                    <p>هزینه خرید شما به ۴ قسط تقسیم می‌شود. یک قسط را هنگام خرید و ۳ قسط دیگر را در ۳ ماه آینده پرداخت
                        می‌کنید.</p>
                </div>

                <div class="installment-box">
                    <h5><i class="fas fa-calendar-alt icon"></i> پرداخت آخر ماه</h5>
                    <p class="mb-1 text-muted">تا سقف اعتبار</p>
                    <p>در این روش، مبلغ خریدهایتان را در پایان همان ماه، به‌صورت بدهی ماهانه تسویه می‌کنید.</p>
                </div>

                <div class="alert alert-info mt-4">
                    اعتبار شما فقط در فروشگاه‌های عضو BNPL قابل استفاده است.
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column active"
                        href="<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>" aria-label="خانه"><i class="fas fa-home"></i> خانه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="service.php"
                        aria-label="خدمات">
                        <i class="fas fa-bell-concierge"></i> خدمات</a></li>
                
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="credit-debt.php<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>"
                        aria-label="سوابق"><i class="fas fa-clock-rotate-left"></i> پرداخت</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php"
                        aria-label="پروفایل"><i class="fas fa-user-circle"></i> پروفایل</a></li>
            </ul>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>