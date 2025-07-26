<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اعتبار شما</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/brands.min.css">
    <link href="./assets/css/Vazirmatn-Variable-font-face.css" rel="stylesheet" type="text/css" />

    <style>
        :root {
            --primary-color: #5b86e5;
            /* Lighter primary color */
            --secondary-color: #3656a8;
            /* Darker secondary for gradient */
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Vazirmatn', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
            padding-bottom: 80px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        .credit-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin: 0 auto 3rem auto;
            max-width: 600px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transform: translateY(-30px);
            /* Lift card slightly for visual appeal */
            transition: transform 0.3s ease-out;
        }

        .credit-card:hover {
            transform: translateY(-35px);
            /* Slightly more lift on hover */
        }


        .credit-amount {
            font-size: 2.2rem;
            /* Larger font for amount */
            font-weight: 800;
            /* Bolder font */
            color: var(--primary-color);
            /* Primary color for emphasis */
            text-align: center;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.05);
        }

        .text-secondary {
            text-align: center;
            color: #6c757d;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .credit-desc {
            color: #6c757d;
            text-align: center;
            margin: 1.5rem 0;
            line-height: 1.8;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 0.85rem 1.5rem;
            /* More padding */
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(91, 134, 229, 0.3);
            /* Adjust shadow color */
        }

        .btn-outline-secondary {
            border: 2px solid #dee2e6;
            padding: 0.85rem 1.5rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            border-color: #adb5bd;
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
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
        }

        .card-body {
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .card-title {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark-color);
            font-size: 1.2rem;
        }

        .card-text {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.7;
        }

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
            transition: color 0.2s ease;
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
            /* Adjusted active background color */
            font-weight: 700;
        }

        .tf-navigation-bar li a.active i,
        .tf-navigation-bar li a.active svg {
            color: var(--primary-color);
        }

        .tf-navigation-bar li a:hover {
            color: var(--primary-color);
            background-color: rgba(91, 134, 229, 0.05);
            /* Adjusted hover background color */
        }

        .tf-navigation-bar li a:hover i,
        .tf-navigation-bar li a:hover svg {
            color: var(--primary-color);
        }


        @media (max-width: 768px) {
            body {
                padding-bottom: 70px;
            }

            .club-header {
                padding: 1.2rem 0;
                border-radius: 0 0 20px 20px;
                margin-bottom: 1.5rem;
            }

            .main-title {
                font-size: 1.8rem;
            }

            .sub-title {
                font-size: 0.9rem;
            }

            .credit-card {
                padding: 1.5rem;
                margin-bottom: 2rem;
                transform: translateY(-20px);
            }

            .credit-amount {
                font-size: 1.8rem;
            }

            .btn-primary,
            .btn-outline-secondary {
                padding: 0.75rem;
                font-size: 0.95rem;
            }

            .tf-navigation-bar li a {
                font-size: 0.75rem;
            }

            .tf-navigation-bar li a i,
            .tf-navigation-bar li a svg {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="club-header text-center">
        <div class="container">
            <h3 class="mb-3">اعتبار من</h3>
            <p class="mb-0">با این اعتبار خرید کنید</p>
        </div>
    </div>

    <div class="container flex-grow-1 d-flex flex-column justify-content-center align-items-center">
        <div class="credit-card">
            <h5 class="text-center mb-3">اعتبار قابل استفاده شما:</h5>
            <div class="credit-amount" id="creditAmount"></div>
            <div class="text-secondary">اعتبار از ما دریافت کردید</div>

            <p class="credit-desc">
                می‌توانید برای خرید کالا یا خدمات از این اعتبار استفاده کنید.
                کافیست از ما اعتبار بگیرید و بعد از سفارش، روش «پرداخت اعتباری» را انتخاب کنید.
            </p>

            <div class="d-flex justify-content-between mt-4 gap-3">
                <a href="shop.php" class="btn btn-primary flex-grow-1" aria-label="خرید کالا">خرید کالا</a>
                <a href="service.php" class="btn btn-outline-secondary flex-grow-1" aria-label="خرید خدمات">خرید
                    خدمات</a>
            </div>
        </div>


    </div>

    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column active"
                        href="credit.php<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>" aria-label="خانه"><i class="fas fa-home"></i> خانه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="service.php"
                        aria-label="خدمات">
                        <i class="fas fa-bell-concierge"></i> خدمات</a></li>
                <li>
                    <a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="shop.php<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>"
                        aria-label="فروشگاه">
                        <i class="fas fa-store-alt"></i>
                        <span class="mt-1">فروشگاه</span>
                    </a>
                </li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="credit-debt.php<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>"
                        aria-label="سوابق"><i class="fas fa-clock-rotate-left"></i> پرداخت</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php"
                        aria-label="پروفایل"><i class="fas fa-user-circle"></i> پروفایل</a></li>
            </ul>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>

    <script>
        function generateRandomCredit() {
            const min = 20; // 20 million
            const max = 200; // 200 million
            const step = 1; // 1 million

            const range = (max - min) / step;
            const randomNumber = Math.floor(Math.random() * (range + 1)) * step + min;

            return randomNumber * 1000000; // Convert to actual millions
        }

        function formatCurrency(amount) {
            return amount.toLocaleString('fa-IR') + ' ریال';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const creditAmountElement = document.getElementById('creditAmount');
            const randomCredit = generateRandomCredit();
            creditAmountElement.textContent = formatCurrency(randomCredit);
        });
    </script>
</body>

</html>