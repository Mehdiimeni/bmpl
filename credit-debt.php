<?php
session_start();

// تابع تبدیل اعداد به فارسی
function convertToPersianNumber($number)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    return str_replace($english, $persian, number_format($number));
}

// دریافت اطلاعات پرداخت‌ها از API
$api_url = 'http://192.168.50.15:7475/api/BNPL/buy-history?merchantNumber=' . $_SESSION['merchantNumber'];
$response = file_get_contents($api_url);
$payments = json_decode($response, true);

// تفکیک پرداخت‌های تسویه نشده و تسویه شده
$unsettled_payments = array_filter($payments, function ($payment) {
    return !isset($payment['settled']) || $payment['settled'] == false;
});

$settled_payments = array_filter($payments, function ($payment) {
    return isset($payment['settled']) && $payment['settled'] == true;
});
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت‌های من</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #0056b3;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --background-light: #f0f2f5;
            --text-dark: #333;
            --text-muted: #6c757d;
            --card-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.08);
            --border-light: #e0e0e0;
            --green-badge: #e6ffe6;
            --blue-badge: #e6f7ff;
            --purple-badge: #f2e6ff;
            --purple-color: #6f42c1;
            --orange-badge: #fff5e6;
            --orange-color: #fd7e14;
            --red-badge: #ffe6e6;
            --red-color: #dc3545;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
            padding-bottom: 180px;
            /* افزایش فاصله برای نوار پرداخت */
            overflow-x: hidden;
        }

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

        .container {
            max-width: 1800px;
        }

        /* Top Header for Debts Page */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1rem;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        .page-header .icon-buttons i {
            font-size: 1.5rem;
            color: var(--text-dark);
            cursor: pointer;
            padding: 0.5rem;
        }

        /* Tab Navigation */
        .tab-nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: white;
            border-radius: 25px;
            padding: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin: 1rem auto;
            max-width: 450px;
        }

        .tab-nav-item {
            flex: 1;
            text-align: center;
            padding: 0.75rem 0.5rem;
            border-radius: 20px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tab-nav-item.active {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
        }

        .tab-nav-item span.badge {
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
            font-size: 0.75rem;
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
            margin-right: 0.5rem;
        }

        .tab-nav-item:not(.active) span.badge {
            background-color: var(--primary-color);
            /* Matches images */
            color: white;
        }

        /* Credit Balance Section */
        .credit-balance {
            background-color: white;
            border-radius: 15px;
            padding: 1rem 1.5rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .credit-balance i {
            margin-left: 0.5rem;
            font-size: 1.2rem;
            color: var(--primary-color);
        }


        /* Debt Card Styles */
        .debt-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }

        .debt-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .debt-card .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-left: 1rem;
            flex-shrink: 0;
        }

        .debt-card .icon-box.green-theme {
            background-color: #e8ffe8;
            color: #28a745;
        }

        .debt-card .icon-box.pink-theme {
            background-color: #ffe6f2;
            color: #cc0066;
        }

        .debt-card .icon-box.blue-theme {
            background-color: #e6f2ff;
            color: #007bff;
        }

        .debt-card .icon-box.yellow-theme {
            background-color: #fffacd;
            color: #d4a700;
        }

        .debt-card .icon-box.purple-theme {
            background-color: var(--purple-badge);
            color: var(--purple-color);
        }

        .debt-card .icon-box.orange-theme {
            background-color: var(--orange-badge);
            color: var(--orange-color);
        }

        .debt-card .icon-box.red-theme {
            background-color: var(--red-badge);
            color: var(--red-color);
        }


        .debt-card .details {
            flex-grow: 1;
        }

        .debt-card .details .title {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text-dark);
        }

        .debt-card .details .subtitle {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-top: 0.2rem;
        }

        .debt-card .amount-section {
            text-align: left;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .debt-card .amount {
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--text-dark);
            white-space: nowrap;
            /* Prevent wrapping */
        }

        .debt-card .amount-badge {
            font-size: 0.8rem;
            padding: 0.2rem 0.6rem;
            border-radius: 15px;
            display: inline-block;
            margin-top: 0.5rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .debt-card .amount-badge.monthly {
            background-color: var(--green-badge);
            color: var(--success-color);
        }

        .debt-card .amount-badge.installment {
            background-color: var(--blue-badge);
            color: var(--primary-color);
        }

        .debt-card .amount-badge.bank-credit {
            background-color: var(--orange-badge);
            color: var(--orange-color);
        }

        .debt-card .amount-badge.installment i,
        .debt-card .amount-badge.bank-credit i {
            font-size: 0.6rem;
            margin-left: 0.3rem;
            vertical-align: middle;
        }

        .debt-card .checkbox-container {
            position: relative;
            cursor: pointer;
            width: 24px;
            height: 24px;
            margin-right: 0.5rem;
            flex-shrink: 0;
        }

        .debt-card .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .debt-card .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 24px;
            width: 24px;
            background-color: #eee;
            border-radius: 6px;
            border: 1px solid #ddd;
            transition: all 0.2s ease;
        }

        .debt-card .checkbox-container input:checked~.checkmark {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .debt-card .checkmark:after {
            content: "";
            position: absolute;
            display: none;
            left: 8px;
            top: 4px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .debt-card .checkbox-container input:checked~.checkmark:after {
            display: block;
        }

        /* Upcoming Month Section Header */
        .month-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            background-color: white;
            /* Matches image background */
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .month-header h5 {
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-dark);
            margin-bottom: 0;
        }

        .month-header .total-amount {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .month-header i {
            margin-left: 0.5rem;
            color: var(--primary-color);
            font-size: 1.1rem;
        }


        /* Fixed Bottom Payment Bar */
        .bottom-payment-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            padding: 1rem 0;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .bottom-payment-bar .total-info {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 0 1.5rem 0.75rem;
            font-size: 1rem;
            color: var(--text-dark);
        }

        .bottom-payment-bar .total-info span {
            font-weight: 700;
        }

        .bottom-payment-bar button {
            width: calc(100% - 3rem);
            /* Adjust based on padding */
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            background-color: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .bottom-payment-bar button:hover {
            background-color: var(--secondary-color);
        }

        .bottom-payment-bar button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        /* Hide future month content by default */
        .tab-content:not(.active) {
            display: none;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .page-header {
                padding: 0.75rem 1rem;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .page-header .icon-buttons i {
                font-size: 1.3rem;
            }

            .tab-nav {
                padding: 0.3rem;
                max-width: 100%;
            }

            .tab-nav-item {
                font-size: 0.9rem;
                padding: 0.6rem 0.3rem;
            }

            .tab-nav-item span.badge {
                font-size: 0.65rem;
                padding: 0.15rem 0.4rem;
            }

            .credit-balance {
                padding: 0.8rem 1.2rem;
                font-size: 0.85rem;
            }

            .debt-card {
                padding: 1rem;
            }

            .debt-card .icon-box {
                width: 45px;
                height: 45px;
                font-size: 1.6rem;
                margin-left: 0.8rem;
            }

            .debt-card .details .title {
                font-size: 1rem;
            }

            .debt-card .details .subtitle {
                font-size: 0.8rem;
            }

            .debt-card .amount {
                font-size: 1rem;
            }

            .debt-card .amount-badge {
                font-size: 0.7rem;
                padding: 0.15rem 0.5rem;
            }

            .month-header {
                padding: 0.6rem 0.8rem;
            }

            .month-header h5 {
                font-size: 0.9rem;
            }

            .month-header .total-amount {
                font-size: 0.8rem;
            }

            .bottom-payment-bar {
                padding: 0.8rem 0;
            }

            .total-info {
                font-size: 0.9rem;
                padding: 0 1rem 0.5rem;
            }

            .total-info button {
                width: calc(100% - 2rem);
                padding: 0.7rem 1rem;
                font-size: 1rem;
            }
        }

        /* Bottom Navigation Bar - consistent with previous pages */
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


        /* Notification Panel (only if needed, otherwise remove) */
        .tf-panel {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1050;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* Aligned to top for notifications */
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s ease-in-out;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .tf-panel.active {
            visibility: visible;
            opacity: 1;
        }

        .tf-panel .panel-box {
            background: white;
            width: 100%;
            max-width: 500px;
            transform: translateY(-100%);
            /* Starts off-screen at the top */
            transition: transform 0.3s ease-in-out;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 0;
            /* No border-radius for top panel */
        }

        .tf-panel.active .panel-box {
            transform: translateY(0);
        }

        .tf-panel .header {
            padding: 1rem 0;
            background-color: white;
            border-bottom: 1px solid #eee;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .tf-panel .tf-statusbar {
            padding: 0 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tf-panel .tf-statusbar h3 {
            flex-grow: 1;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }

        .tf-panel .tf-statusbar a {
            color: #555;
            font-size: 1.2rem;
            text-decoration: none;
            padding: 5px;
        }

        .payment-bar {
            position: fixed;
            bottom: 100px;
            /* قرار گرفتن بالای نوار نویگیشن */
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            padding: 1rem;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
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
        }
    </style>
</head>

<body>

    <div class="club-header text-center">
        <div class="container">
            <h3 class="mb-3">پرداخت‌های من</h3>
            <p class="mb-0">مدیریت آسان پرداخت‌های شما</p>
        </div>
    </div>

    <div class="container">
        <div class="tab-nav mb-12">
            <div class="tab-nav-item active" data-tab="unsettled">
                این ماه
                <span class="badge" id="unsettled-badge"><?= count($unsettled_payments) ?></span>
            </div>
            <div class="tab-nav-item" data-tab="settled">
                پرداخت شده
                <span class="badge" id="settled-badge"><?= count($settled_payments) ?></span>
            </div>
        </div>

        <div id="unsettled-content" class="tab-content active">
            <?php foreach ($unsettled_payments as $payment): ?>
                <div class="debt-card">
                    <label class="checkbox-container">
                        <input type="checkbox" data-amount="<?= $payment['amount'] ?>" data-id="<?= $payment['id'] ?>">
                        <span class="checkmark"></span>
                    </label>
                    <div class="icon-box <?= $payment['paymentType'] == 0 ? 'green-theme' : 'blue-theme' ?>">
                        <i class="fa-solid fa-<?= $payment['paymentType'] == 0 ? 'calendar' : 'credit-card' ?>"></i>
                    </div>
                    <div class="details">
                        <div class="title"><?= $payment['productName'] ?> (<?= $payment['sellerMerchantName'] ?>)</div>
                        <div class="subtitle"><?= $payment['paymentType'] == 0 ? 'بدهی ماهانه' : 'خرید اقساطی' ?></div>
                    </div>
                    <div class="amount-section">
                        <div class="amount"><?= convertToPersianNumber($payment['amount']) ?> تومان</div>
                        <div class="amount-badge <?= $payment['paymentType'] == 0 ? 'monthly' : 'installment' ?>">
                            <?= $payment['paymentType'] == 0 ? 'بدهی ماهانه' : '<i class="bi bi-dot"></i>قسط' ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="settled-content" class="tab-content">
            <?php if (!empty($settled_payments)): ?>
                <?php foreach ($settled_payments as $payment): ?>
                    <div class="debt-card">
                        <div class="icon-box success-theme">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="details">
                            <div class="title"><?= $payment['productName'] ?> (<?= $payment['sellerMerchantName'] ?>)</div>
                            <div class="subtitle"><?= $payment['paymentType'] == 0 ? 'بدهی ماهانه' : 'خرید اقساطی' ?></div>
                        </div>
                        <div class="amount-section">
                            <div class="amount"><?= convertToPersianNumber($payment['amount']) ?> تومان</div>
                            <div class="amount-badge success">
                                <i class="bi bi-check-circle"></i> پرداخت شده
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-4 text-muted">
                    هیچ پرداخت انجام شده‌ای وجود ندارد
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- نوار پرداخت جدید -->
    <div class="payment-bar">
        <div class="total-info d-flex justify-content-between align-items-center mb-2">
            <span class="fw-bold">مبلغ قابل پرداخت:</span>
            <span id="total-payment-amount" class="fw-bold">۰ تومان</span>
        </div>
        <button id="pay-button" class="btn btn-primary w-100 py-2" disabled>
            پرداخت
        </button>
    </div>

    <!-- نوار نویگیشن پایین -->
    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column" href="credit.php">
                        <i class="fas fa-home"></i> خانه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="service.php">
                        <i class="fas fa-bell-concierge"></i> خدمات</a></li>
                <li>
                    <a class="fw_4 d-flex justify-content-center align-items-center flex-column active" href="shop.php">
                        <i class="fas fa-store-alt"></i>
                        <span class="mt-1">فروشگاه</span>
                    </a>
                </li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="credit-debt.php">
                        <i class="fas fa-clock-rotate-left"></i> پرداخت</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php">
                        <i class="fas fa-user-circle"></i> پروفایل</a></li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabItems = document.querySelectorAll('.tab-nav-item');
            const tabContents = document.querySelectorAll('.tab-content');
            const payButton = document.getElementById('pay-button');
            const totalPaymentAmountSpan = document.getElementById('total-payment-amount');

            function formatCurrency(amount) {
                return new Intl.NumberFormat('fa-IR').format(amount) + ' تومان';
            }

            function calculateAndDisplayTotal() {
                const activeContent = document.querySelector('.tab-content.active');
                let total = 0;
                const selectedItems = [];

                const checkboxes = activeContent.querySelectorAll('.debt-card input[type="checkbox"]:checked');
                checkboxes.forEach(checkbox => {
                    total += parseInt(checkbox.dataset.amount);
                    selectedItems.push({
                        id: checkbox.dataset.id,
                        amount: checkbox.dataset.amount
                    });
                });

                totalPaymentAmountSpan.textContent = formatCurrency(total);
                payButton.disabled = selectedItems.length === 0;

                return selectedItems;
            }

            // فعال کردن انتخاب چک‌باکس‌ها
            document.querySelectorAll('.checkbox-container input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const container = this.closest('.checkbox-container');
                    const debtCard = container.closest('.debt-card');

                    // ایجاد تغییرات ظاهری
                    if (this.checked) {
                        debtCard.style.border = '2px solid var(--primary-color)';
                        container.querySelector('.checkmark').classList.add('checked');
                    } else {
                        debtCard.style.border = 'none';
                        container.querySelector('.checkmark').classList.remove('checked');
                    }

                    calculateAndDisplayTotal();
                });
            });

            // تغییر تب‌ها
            tabItems.forEach(item => {
                item.addEventListener('click', function () {
                    tabItems.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));

                    this.classList.add('active');
                    const targetTab = this.dataset.tab;
                    document.getElementById(targetTab + '-content').classList.add('active');

                    // ریست کردن محاسبات هنگام تغییر تب
                    totalPaymentAmountSpan.textContent = '۰ تومان';
                    payButton.disabled = true;

                    // غیرفعال کردن دکمه پرداخت در تب پرداخت شده
                    if (targetTab === 'settled') {
                        payButton.style.display = 'none';
                    } else {
                        payButton.style.display = 'block';
                    }
                });
            });

            payButton.addEventListener('click', async function () {
                const selectedItems = calculateAndDisplayTotal();

                if (selectedItems.length === 0) return;

                const originalText = payButton.textContent;
                payButton.disabled = true;
                payButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> در حال پردازش...';

                try {
                    const requests = selectedItems.map(item => {
                        return fetch(`proxy-settle.php?id=${item.id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }

                        });
                    });

                    const responses = await Promise.all(requests);

                    // Check if responses are ok before parsing as JSON
                    for (const response of responses) {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                    }

                    const results = await Promise.all(responses.map(res => res.json()));

                    const allSuccess = results.every(result => result.success);

                    if (allSuccess) {
                        await Swal.fire({
                            icon: 'success',
                            title: 'پرداخت موفق',
                            text: `پرداخت ${selectedItems.length} آیتم با موفقیت انجام شد`,
                            confirmButtonText: 'باشه'
                        });
                        window.location.reload(true); // force reload from server
                    } else {
                        throw new Error('برخی پرداخت‌ها انجام نشد');
                    }
                } catch (error) {
                    console.error('Payment error:', error);
                    await Swal.fire({
                        icon: 'error',
                        title: 'خطا در پرداخت',
                        text: error.message || 'خطایی در پرداخت رخ داده است. لطفاً مجدداً تلاش کنید.',
                        confirmButtonText: 'باشه'
                    });
                } finally {
                    payButton.disabled = false;
                    payButton.textContent = originalText;
                }
            });
            // مخفی کردن دکمه پرداخت در تب پرداخت شده در ابتدا
            payButton.style.display = document.querySelector('.tab-nav-item.active').dataset.tab === 'settled' ? 'none' : 'block';
        });
    </script>
</body>

</html>