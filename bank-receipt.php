<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسید تراکنش</title>
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

        /* Receipt specific styles */
        .receipt-icon {
            font-size: 4rem;
            color: var(--success-color);
            margin-bottom: 1.5rem;
            animation: fadeIn 0.8s ease-out;
        }

        .receipt-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .receipt-amount {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 2rem;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.08);
        }

        .receipt-details {
            text-align: right;
            border-top: 1px dashed #eee;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        .receipt-details p {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.8rem;
            font-size: 1.05rem;
            color: var(--text-color-light);
        }

        .receipt-details p strong {
            color: var(--dark-color);
            font-weight: 700;
            flex-shrink: 0;
            /* Prevent strong content from shrinking */
            margin-right: 10px;
            /* Space between label and value */
        }

        .receipt-details p span {
            flex-grow: 1;
            /* Allow label to grow */
        }


        /* Back to Home Button */
        .btn-back-home {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 0.9rem 1.8rem;
            font-weight: 700;
            border-radius: 15px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: white;
            box-shadow: 0 8px 20px rgba(91, 134, 229, 0.3);
            margin-top: 2.5rem;
            width: 100%;
        }

        .btn-back-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(91, 134, 229, 0.4);
            background: linear-gradient(135deg, #3a62d0, #2040c0);
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

            .receipt-icon {
                font-size: 3rem;
            }

            .receipt-title {
                font-size: 1.5rem;
            }

            .receipt-amount {
                font-size: 2rem;
            }

            .receipt-details p {
                font-size: 0.95rem;
            }

            .btn-back-home {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
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
            <h3>رسید تراکنش</h3>
        </div>
    </div>

    <div class="container flex-grow-1 d-flex flex-column justify-content-center align-items-center">
        <div class="main-card animate__animated animate__fadeInUp text-center">
            <i class="fas fa-check-circle receipt-icon"></i>
            <h4 class="receipt-title">تراکنش با موفقیت انجام شد!</h4>
            <div class="receipt-amount" id="transactionAmount"></div>

            <div class="receipt-details">
                <p><span>شماره مرجع:</span> <strong id="referenceNumber"></strong></p>
                <p><span>شماره ترمینال:</span> <strong id="terminalNumber"></strong></p>
                <p><span>تاریخ تراکنش:</span> <strong id="transactionDateTime"></strong></p>
            </div>

            <a href="credit.php" class="btn btn-back-home">بازگشت به صفحه اصلی</a>
        </div>
    </div>

    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column active"
                        href="credit.php" aria-label="خانه"><i class="fas fa-home"></i> خانه</a></li>
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
            const transactionAmountElement = document.getElementById('transactionAmount');
            const referenceNumberElement = document.getElementById('referenceNumber');
            const terminalNumberElement = document.getElementById('terminalNumber');
            const transactionDateTimeElement = document.getElementById('transactionDateTime');

            // Function to format currency (from previous pages)
            function formatCurrency(amount) {
                return amount.toLocaleString('fa-IR') + ' تومان';
            }

            // Generate a random 8-digit number
            function generateRandom8DigitNumber() {
                return Math.floor(10000000 + Math.random() * 90000000).toString();
            }

            // Get current date and time in Persian format
            function getPersianDateTime() {
                const now = new Date();
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                };
                return new Intl.DateTimeFormat('fa-IR', options).format(now);
            }

            // Declare finalAmount outside the if/else block
            let finalAmount;

            // دریافت مبلغ از پارامتر URL
            const urlParams = new URLSearchParams(window.location.search);
            const receivedAmount = urlParams.get('amount'); // این مقدار به صورت رشته است

            if (receivedAmount) {
                // تبدیل به عدد و نمایش آن در رسید
                const parsedAmount = parseInt(receivedAmount);
                if (!isNaN(parsedAmount)) {
                    finalAmount = parsedAmount;
                } else {
                    // Fallback if URL amount is invalid, use simulated amount
                    finalAmount = Math.floor(100000 + Math.random() * 49900000); // Random amount between 100,000 and 50,000,000 Toman
                }
            } else {
                // اگر مبلغ از طریق URL ارسال نشد، یک مبلغ پیش‌فرض تصادفی قرار دهید
                finalAmount = Math.floor(100000 + Math.random() * 49900000); // Random amount between 100,000 and 50,000,000 Toman
            }

            // Set the transaction amount
            transactionAmountElement.textContent = formatCurrency(finalAmount);

            // Set the random reference and terminal numbers and current Persian date/time
            referenceNumberElement.textContent = generateRandom8DigitNumber();
            terminalNumberElement.textContent = generateRandom8DigitNumber();
            transactionDateTimeElement.textContent = getPersianDateTime();
        });
    </script>
</body>

</html>