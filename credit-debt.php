<?php
session_start();

if (isset($_SESSION['mobileNumber'])) {
    $mobileNumber = $_SESSION['mobileNumber'];
} else {
    header('Location: login-user.php');
    exit();
}

// تابع تبدیل اعداد به فارسی
function convertToPersianNumber($number) {
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    return str_replace($english, $persian, number_format($number));
}

// تاریخ امروز
$today = new DateTime();
$currentDay = $today->format('N'); // 1 (Monday) to 7 (Sunday)
$currentDate = $today->format('Y-m-d');

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

$data = json_decode($response, true);

// دریافت اطلاعات پرداخت‌ها از API
$api_url = 'http://192.168.50.15:7475/api/BNPL/buy-history?merchantNumber=' . $data['merchantNumber'];
$response = file_get_contents($api_url);
$payments = json_decode($response, true);

// تفکیک پرداخت‌های هفته جاری و ماه جاری
$weekly_payments = [];
$monthly_payments = [];

foreach ($payments as $payment) {
    if (!isset($payment['settled']) || $payment['settled'] == false) {
        $paymentDate = new DateTime($payment['paymentDate']);
        $paymentMonth = $paymentDate->format('m');
        $currentMonth = $today->format('m');
        
        // اگر پرداخت مربوط به ماه جاری است
        if ($paymentMonth == $currentMonth) {
            $monthly_payments[] = $payment;
            
            // اگر پرداخت مربوط به هفته جاری است (از شنبه تا جمعه)
            $paymentDay = $paymentDate->format('N');
            $daysDiff = $paymentDate->diff($today)->days;
            
            if (($paymentDay >= 6 && $currentDay <= 5 && $daysDiff <= 2) || // پنجشنبه و جمعه هفته قبل
                ($paymentDay <= $currentDay && $daysDiff <= 6)) { // شنبه تا امروز
                $weekly_payments[] = $payment;
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
    <title>پرداخت‌های من</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/brands.min.css">
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
 
        /* استایل‌های قبلی را اینجا قرار دهید */
        /* ... */
        
        /* استایل جدید برای input مبلغ پرداختی */
        .amount-input-container {
            display: flex;
            align-items: center;
            margin-top: 0.5rem;
        }
        
        .amount-input {
            width: 120px;
            text-align: left;
            padding: 0.3rem 0.5rem;
            border: 1px solid var(--border-light);
            border-radius: 6px;
            margin-left: 0.5rem;
        }
        
        .amount-input-buttons {
            display: flex;
            flex-direction: column;
        }
        
        .amount-input-btn {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0.1rem;
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
            <div class="tab-nav-item active" data-tab="weekly">
                این هفته
                <span class="badge" id="weekly-badge"><?= count($weekly_payments) ?></span>
            </div>
            <div class="tab-nav-item" data-tab="monthly">
                این ماه
                <span class="badge" id="monthly-badge"><?= count($monthly_payments) ?></span>
            </div>
        </div>
        
        <div id="weekly-content" class="tab-content active">
            <?php if (!empty($weekly_payments)): ?>
                <?php foreach ($weekly_payments as $payment): ?>
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
                            <div class="amount"><?= convertToPersianNumber($payment['amount']) ?> ریال</div>
                            <div class="amount-badge <?= $payment['paymentType'] == 0 ? 'monthly' : 'installment' ?>">
                                <?= $payment['paymentType'] == 0 ? 'بدهی ماهانه' : '<i class="fas fa-circle"></i>قسط' ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-4 text-muted">
                    هیچ پرداختی برای این هفته وجود ندارد
                </div>
            <?php endif; ?>
        </div>

        <div id="monthly-content" class="tab-content">
            <?php if (!empty($monthly_payments)): ?>
                <?php foreach ($monthly_payments as $payment): ?>
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
                            <div class="amount"><?= convertToPersianNumber($payment['amount']) ?> ریال</div>
                            <div class="amount-badge <?= $payment['paymentType'] == 0 ? 'monthly' : 'installment' ?>">
                                <?= $payment['paymentType'] == 0 ? 'بدهی ماهانه' : '<i class="fas fa-circle"></i>قسط' ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-4 text-muted">
                    هیچ پرداختی برای این ماه وجود ندارد
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- نوار پرداخت جدید -->
    <div class="payment-bar">
        <div class="total-info d-flex justify-content-between align-items-center mb-2">
            <span class="fw-bold">مبلغ قابل پرداخت:</span>
            <div class="amount-input-container">
                <input type="text" id="payment-amount-input" class="amount-input" value="۰ ریال" readonly>
                <div class="amount-input-buttons">
                    <button class="amount-input-btn" id="increase-amount">+</button>
                    <button class="amount-input-btn" id="decrease-amount">-</button>
                </div>
            </div>
        </div>
        <button id="pay-button" class="btn btn-primary w-100 py-2" disabled>
            پرداخت
        </button>
    </div>

    <!-- Modal پرداخت بانکی -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">پرداخت اینترنتی</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">شماره کارت</label>
                            <input type="text" class="form-control" id="cardNumber" placeholder="6037-XXXX-XXXX-XXXX"
                                maxlength="19">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="expiryMonth" class="form-label">ماه انقضا (MM)</label>
                                <input type="text" class="form-control" id="expiryMonth" placeholder="00" maxlength="2"
                                    inputmode="numeric">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="expiryYear" class="form-label">سال انقضا (YY)</label>
                                <input type="text" class="form-control" id="expiryYear" placeholder="00" maxlength="2"
                                    inputmode="numeric">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cvv2" class="form-label">CVV2</label>
                                <input type="password" class="form-control" id="cvv2" placeholder="XXX" maxlength="4">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">رمز دوم</label>
                                <input type="password" class="form-control" id="password" placeholder="رمز دوم کارت">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    <button type="button" id="confirmPayment" class="btn btn-primary">تأیید پرداخت</button>
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
    <!-- اسکریپت‌ها -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/sweetalert2@11.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabItems = document.querySelectorAll('.tab-nav-item');
            const tabContents = document.querySelectorAll('.tab-content');
            const payButton = document.getElementById('pay-button');
            const paymentAmountInput = document.getElementById('payment-amount-input');
            const increaseBtn = document.getElementById('increase-amount');
            const decreaseBtn = document.getElementById('decrease-amount');
            
            let currentTotal = 0;
            let selectedItems = [];

            // تابع تبدیل عدد به فرمت ریال
            function formatCurrency(amount) {
                return new Intl.NumberFormat('fa-IR').format(amount) + ' ریال';
            }

            // تابع تبدیل فرمت ریال به عدد
            function parseCurrency(currencyStr) {
                return parseInt(currencyStr.replace(/[^0-9]/g, ''));
            }

            // محاسبه و نمایش جمع مبلغ
            function calculateAndDisplayTotal() {
                currentTotal = 0;
                selectedItems = [];
                
                const activeContent = document.querySelector('.tab-content.active');
                const checkboxes = activeContent.querySelectorAll('.debt-card input[type="checkbox"]:checked');
                
                checkboxes.forEach(checkbox => {
                    const amount = parseInt(checkbox.dataset.amount);
                    currentTotal += amount;
                    selectedItems.push({
                        id: checkbox.dataset.id,
                        amount: amount
                    });
                });

                paymentAmountInput.value = formatCurrency(currentTotal);
                payButton.disabled = selectedItems.length === 0;
            }

            // افزایش مبلغ پرداختی
            increaseBtn.addEventListener('click', function() {
                currentTotal += 10000; // افزایش 10,000 ریال
                paymentAmountInput.value = formatCurrency(currentTotal);
            });

            // کاهش مبلغ پرداختی
            decreaseBtn.addEventListener('click', function() {
                if (currentTotal > 10000) {
                    currentTotal -= 10000; // کاهش 10,000 ریال
                    paymentAmountInput.value = formatCurrency(currentTotal);
                }
            });

            // فعال کردن انتخاب چک‌باکس‌ها
            document.querySelectorAll('.checkbox-container input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const container = this.closest('.checkbox-container');
                    const debtCard = container.closest('.debt-card');

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
                    currentTotal = 0;
                    selectedItems = [];
                    paymentAmountInput.value = formatCurrency(currentTotal);
                    payButton.disabled = true;
                });
            });
 cardNumberInput.addEventListener('input', function (e) {
                let value = this.value.replace(/\D/g, '');
                let formatted = '';

                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) {
                        formatted += '-';
                    }
                    formatted += value[i];
                }

                this.value = formatted;
            });

            function formatCurrency(amount) {
                return new Intl.NumberFormat('fa-IR').format(amount) + ' ریال';
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
                    totalPaymentAmountSpan.textContent = '۰ ریال';
                    payButton.disabled = true;

                    // غیرفعال کردن دکمه پرداخت در تب پرداخت شده
                    if (targetTab === 'settled') {
                        payButton.style.display = 'none';
                    } else {
                        payButton.style.display = 'block';
                    }
                });
            });

            payButton.addEventListener('click', function () {
                const selectedItems = calculateAndDisplayTotal();
                if (selectedItems.length === 0) return;

                // نمایش مودال پرداخت
                paymentModal.show();
            });




            document.getElementById('expiryMonth').addEventListener('input', function (e) {
                this.value = this.value.replace(/\D/g, '').slice(0, 2);
                if (this.value.length === 1 && parseInt(this.value) > 1) {
                    this.value = '0' + this.value;
                }
                if (this.value.length === 2 && parseInt(this.value) > 12) {
                    this.value = '12';
                }
            });

            document.getElementById('expiryYear').addEventListener('input', function (e) {
                this.value = this.value.replace(/\D/g, '').slice(0, 2);
            });

            confirmPaymentBtn.addEventListener('click', async function () {
                const cardNumber = document.getElementById('cardNumber').value.replace(/\D/g, '');
                const expiryMonth = document.getElementById('expiryMonth').value.padStart(2, '0');
                const expiryYear = document.getElementById('expiryYear').value;
                const cvv2 = document.getElementById('cvv2').value;
                const password = document.getElementById('password').value;
                const selectedItems = calculateAndDisplayTotal();

                // اعتبارسنجی فرم
                if (!cardNumber || cardNumber.length !== 16) {
                    await Swal.fire('خطا', 'شماره کارت معتبر نیست', 'error');
                    return;
                }

                if (!expiryMonth || expiryMonth.length !== 2 || parseInt(expiryMonth) < 1 || parseInt(expiryMonth) > 12) {
                    await Swal.fire('خطا', 'ماه انقضا معتبر نیست', 'error');
                    return;
                }

                if (!expiryYear || expiryYear.length !== 2) {
                    await Swal.fire('خطا', 'سال انقضا معتبر نیست', 'error');
                    return;
                }

                if (!cvv2 || cvv2.length < 3 || cvv2.length > 4) {
                    await Swal.fire('خطا', 'CVV2 معتبر نیست', 'error');
                    return;
                }

                if (!password) {
                    await Swal.fire('خطا', 'رمز دوم را وارد کنید', 'error');
                    return;
                }

                const originalText = confirmPaymentBtn.textContent;
                confirmPaymentBtn.disabled = true;
                confirmPaymentBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> در حال پردازش...';

                try {
                    // ارسال درخواست‌های PUT به proxy-settle.php
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

                    // بررسی پاسخ‌ها
                    for (const response of responses) {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                    }

                    const results = await Promise.all(responses.map(res => res.json()));

                    const allSuccess = results.every(result => result.success);

                    if (allSuccess) {
                        paymentModal.hide();
                        await Swal.fire({
                            icon: 'success',
                            title: 'پرداخت موفق',
                            text: `پرداخت ${selectedItems.length} آیتم با موفقیت انجام شد`,
                            confirmButtonText: 'باشه'
                        });
                        window.location.reload(true);
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
                    confirmPaymentBtn.disabled = false;
                    confirmPaymentBtn.textContent = originalText;
                }
            });
        });
    </script>
</body>
</html>