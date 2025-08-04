<?php
require 'vendor/autoload.php';

use Morilog\Jalali\Jalalian;
session_start();

if (isset($_SESSION['mobileNumber'])) {
    $mobileNumber = $_SESSION['mobileNumber'];
} else {
    header('Location: login-user.php');
    exit();
}

// تابع تبدیل اعداد به فارسی
function convertToPersianNumber($number)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    return str_replace($english, $persian, number_format($number));
}

// دریافت اطلاعات کاربر
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
$userData = json_decode($response, true);

// دریافت اطلاعات پرداخت‌ها
$apiUrl = "http://192.168.50.15:7475/api/BNPL/InstallmentsByDate?mobileNumber=" . urlencode($mobileNumber);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Content-Type: application/json']);

$response = curl_exec($ch);
if (curl_errno($ch))
    die('خطا در ارتباط با API: ' . curl_error($ch));
if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200)
    die('خطا در دریافت داده از API');
curl_close($ch);

$userPayData = json_decode($response, true);
if (!isset($userPayData['success']) || !$userPayData['success'] || !isset($userPayData['data']))
    die('داده دریافتی معتبر نیست');

// پردازش تاریخ‌ها
$today = Jalalian::now();
$saturdayThisWeek = Jalalian::now()->subDays($today->getDayOfWeek())->toCarbon()->startOfDay();
$fridayThisWeek = $saturdayThisWeek->copy()->addDays(6)->endOfDay();
$firstDayOfMonth = (new Jalalian($today->getYear(), $today->getMonth(), 1))->toCarbon()->startOfDay();
$lastDayOfMonth = (new Jalalian($today->getYear(), $today->getMonth(), $today->getMonthDays()))->toCarbon()->endOfDay();

$payments = [];
foreach ($userPayData['data'] as $payment) {
    if (!isset($payment['price']) || !isset($payment['date']))
        continue;

    try {
        $paymentDate = Jalalian::fromFormat('Y/m/d', $payment['date'])->toCarbon();
        $isThisWeek = $paymentDate->between($saturdayThisWeek, $fridayThisWeek);
        $isThisMonth = $paymentDate->between($firstDayOfMonth, $lastDayOfMonth);
        $isOverdue = $paymentDate->lessThan($today->toCarbon()->startOfDay()) && !$isThisWeek;

        $payments[] = [
            'price' => (int) $payment['price'],
            'date' => $payment['date'],
            'is_this_week' => $isThisWeek,
            'is_this_month' => $isThisMonth,
            'is_overdue' => $isOverdue,
            'shamsi_date' => $payment['date'],
            'date_object' => $paymentDate
        ];
    } catch (Exception $e) {
        error_log('Error processing payment: ' . $e->getMessage());
        continue;
    }
}

// دسته‌بندی پرداخت‌ها
$weeklyPayments = array_filter($payments, fn($p) => $p['is_this_week']);
$monthlyPayments = array_filter($payments, fn($p) => $p['is_this_month']);
$overduePayments = array_filter($payments, fn($p) => $p['is_overdue']);

function calculateTotals($payments)
{
    return [
        'count' => count($payments),
        'total' => array_sum(array_column($payments, 'price')),
        'items' => $payments
    ];
}

$result = [
    'weekly' => calculateTotals($weeklyPayments),
    'monthly' => calculateTotals($monthlyPayments),
    'overdue' => calculateTotals($overduePayments)
];
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

            color: var(--text-dark);
            white-space: nowrap;
            margin: 0 40px 0 0;
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
            bottom: 180px;
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

        .checkbox-container {
            display: block;
            position: relative;
            padding-right: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 16px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            right: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 4px;
        }

        .checkbox-container:hover input~.checkmark {
            background-color: #ccc;
        }

        .checkbox-container input:checked~.checkmark {
            background-color: #2196F3;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input:checked~.checkmark:after {
            display: block;
        }

        .checkbox-container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .debt-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s;
        }

        .debt-card.selected {
            border: 2px solid #2196F3;
            background-color: #f8f9fa;
        }

        .payment-bar {
            position: fixed;
            bottom: 100px;
            left: 0;
            right: 0;
            background: white;
            padding: 15px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .amount-input-container {
            position: relative;
            width: 200px;
        }

        .amount-input {
            width: 100%;
            padding: 8px 40px 8px 8px;
            text-align: left;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .amount-input-buttons {
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
        }

        .amount-input-btn {
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            padding: 0 5px;
        }

        .tab-nav {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .tab-nav-item {
            padding: 10px 20px;
            cursor: pointer;
            position: relative;
        }

        .tab-nav-item.active {
            color: #2196F3;
            font-weight: bold;
        }

        .tab-nav-item.active:after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: #2196F3;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .badge {
            background-color: #2196F3;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            margin-right: 5px;
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
                <span class="badge" id="weekly-badge"><?= count($weeklyPayments) ?></span>
            </div>
            <div class="tab-nav-item" data-tab="monthly">
                این ماه
                <span class="badge" id="monthly-badge"><?= count($monthlyPayments) ?></span>
            </div>
            <div class="tab-nav-item" data-tab="overdue">
                معوقه
                <span class="badge" id="overdue-badge"><?= count($overduePayments) ?></span>
            </div>
        </div>

        <div id="weekly-content" class="tab-content active">
            <?php if (!empty($weeklyPayments)): ?>
                <?php foreach ($weeklyPayments as $index => $payment): ?>
                    <div class="debt-card" id="payment-<?= $index ?>">
                        <label class="checkbox-container">
                            <input type="checkbox" data-amount="<?= $payment['price'] ?>" data-id="<?= $index ?>">
                            <span class="checkmark"></span>
                            <div class="amount"><?= convertToPersianNumber($payment['price']) ?> ریال</div>
                        </label>
                        <div class="amount-section">
                            <div class="amount"><?= $payment['shamsi_date'] ?> تاریخ</div>
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
            <?php if (!empty($monthlyPayments)): ?>
                <?php foreach ($monthlyPayments as $index => $payment): ?>
                    <div class="debt-card" id="payment-<?= $index ?>">
                        <label class="checkbox-container">
                            <input type="checkbox" data-amount="<?= $payment['price'] ?>" data-id="<?= $index ?>">
                            <span class="checkmark"></span>
                            <div class="amount"><?= convertToPersianNumber($payment['price']) ?> ریال</div>
                        </label>
                        <div class="amount-section">
                            <div class="amount"><?= $payment['shamsi_date'] ?> تاریخ</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-4 text-muted">
                    هیچ پرداختی برای این ماه وجود ندارد
                </div>
            <?php endif; ?>
        </div>

        <div id="overdue-content" class="tab-content">
            <?php if (!empty($overduePayments)): ?>
                <?php foreach ($overduePayments as $index => $payment): ?>
                    <div class="debt-card" id="payment-<?= $index ?>">
                        <label class="checkbox-container">
                            <input type="checkbox" data-amount="<?= $payment['price'] ?>" data-id="<?= $index ?>">
                            <span class="checkmark"></span>
                            <div class="amount"><?= convertToPersianNumber($payment['price']) ?> ریال</div>
                        </label>
                        <div class="amount-section">
                            <div class="amount"><?= $payment['shamsi_date'] ?> تاریخ</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-4 text-muted">
                    هیچ پرداختی معوقه وجود ندارد
                </div>
            <?php endif; ?>
        </div>
    </div>

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

    <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">پرداخت اینترنتی</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <input type="hidden" id="mobileNumber" value="<?= $mobileNumber ?>">
                        <input type="hidden" id="totalAmount">
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
                        href="credit.php<?= '?sr=' . random_int(1, 1000000000) ?>" aria-label="خانه">
                        <i class="fas fa-home"></i> خانه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                        href="credit-debt.php<?= '?sr=' . random_int(1, 1000000000) ?>" aria-label="پرداخت">
                        <i class="fas fa-credit-card"></i> پرداخت</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                        href="history.php<?= '?sr=' . random_int(1, 1000000000) ?>" aria-label="تاریخچه">
                        <i class="fas fa-clock-rotate-left"></i> تاریخچه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                        href="profile.php<?= '?sr=' . random_int(1, 1000000000) ?>" aria-label="پروفایل">
                        <i class="fas fa-user-circle"></i> پروفایل</a></li>
            </ul>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/sweetalert2@11.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // عناصر DOM
            const tabItems = document.querySelectorAll('.tab-nav-item');
            const tabContents = document.querySelectorAll('.tab-content');
            const payButton = document.getElementById('pay-button');
            const paymentAmountInput = document.getElementById('payment-amount-input');
            const increaseBtn = document.getElementById('increase-amount');
            const decreaseBtn = document.getElementById('decrease-amount');
            const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            const confirmPaymentBtn = document.getElementById('confirmPayment');
            const totalAmountInput = document.getElementById('totalAmount');

            // متغیرهای حالت
            let currentTotal = 0;
            let selectedItems = [];
            let manualAdjustment = 0; // مقدار تنظیم دستی

            // توابع کمکی
            const formatCurrency = (amount) => {
                if (amount === 0) return "۰ ریال";
                return new Intl.NumberFormat('fa-IR').format(amount) + ' ریال';
            };

            const parseCurrency = (currencyStr) => parseInt(currencyStr.replace(/[^0-9]/g, '')) || 0;

            // محاسبه و نمایش مبلغ کل
            const calculateAndDisplayTotal = () => {
                currentTotal = manualAdjustment; // شروع با مقدار تنظیم دستی

                // اضافه کردن مبالغ آیتمهای انتخاب شده
                const activeContent = document.querySelector('.tab-content.active');
                if (activeContent) {
                    const checkboxes = activeContent.querySelectorAll('input[type="checkbox"]:checked');

                    checkboxes.forEach(checkbox => {
                        const amount = parseInt(checkbox.dataset.amount) || 0;
                        const id = checkbox.dataset.id;
                        currentTotal += amount;
                        selectedItems.push({
                            id: id,
                            amount: amount,
                            element: checkbox
                        });
                    });
                }

                paymentAmountInput.value = formatCurrency(currentTotal);
                totalAmountInput.value = currentTotal;

                // فعال/غیرفعال کردن دکمه پرداخت
                payButton.disabled = currentTotal <= 0;

                // به‌روزرسانی تعداد در تب
                const activeTab = document.querySelector('.tab-nav-item.active');
                if (activeTab) {
                    const badge = activeTab.querySelector('.badge');
                    if (badge) {
                        const checkboxes = document.querySelector('.tab-content.active input[type="checkbox"]:checked');
                        badge.textContent = checkboxes ? checkboxes.length : 0;
                    }
                }
            };

            // رویدادهای UI برای تنظیم دستی مبلغ
            increaseBtn.addEventListener('click', () => {
                manualAdjustment += 1000000;
                selectedItems = []; // ریست آیتمهای انتخاب شده
                calculateAndDisplayTotal();
            });

            decreaseBtn.addEventListener('click', () => {
                if (manualAdjustment >= 1000000) {
                    manualAdjustment -= 1000000;
                    selectedItems = []; // ریست آیتمهای انتخاب شده
                    calculateAndDisplayTotal();
                } else if (manualAdjustment > 0) {
                    manualAdjustment = 0;
                    selectedItems = []; // ریست آیتمهای انتخاب شده
                    calculateAndDisplayTotal();
                }
            });

            // مدیریت انتخاب چک‌باکس‌ها
            document.querySelectorAll('.checkbox-container input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    manualAdjustment = 0; // وقتی آیتمی انتخاب شد، مقدار دستی را ریست می‌کنیم
                    const debtCard = this.closest('.debt-card');
                    if (this.checked) {
                        debtCard.classList.add('selected');
                    } else {
                        debtCard.classList.remove('selected');
                    }
                    calculateAndDisplayTotal();
                });
            });

            // مدیریت تب‌ها
            tabItems.forEach(item => {
                item.addEventListener('click', function () {
                    tabItems.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));

                    this.classList.add('active');
                    const targetTab = this.dataset.tab;
                    document.getElementById(targetTab + '-content').classList.add('active');

                    // ریست حالت
                    currentTotal = 0;
                    manualAdjustment = 0;
                    selectedItems = [];
                    paymentAmountInput.value = formatCurrency(currentTotal);
                    payButton.disabled = true;
                });
            });

            // پرداخت
            payButton.addEventListener('click', () => {
                if (currentTotal <= 0) {
                    Swal.fire('خطا', 'لطفاً مبلغی را برای پرداخت وارد کنید', 'warning');
                    return;
                }
                paymentModal.show();
            });

            // اعتبارسنجی فرم پرداخت
            confirmPaymentBtn.addEventListener('click', async function () {
                // اعتبارسنجی اولیه
                if (currentTotal <= 0) {
                    await Swal.fire('خطا', 'مبلغ پرداخت باید بیشتر از صفر باشد', 'error');
                    return;
                }

                const mobileNumber = document.getElementById('mobileNumber').value;
                const totalAmount = document.getElementById('totalAmount').value;

                if (!mobileNumber || !totalAmount) {
                    await Swal.fire('خطا', 'اطلاعات پرداخت ناقص است', 'error');
                    return;
                }

                // اعتبارسنجی اطلاعات کارت
                const cardNumber = document.getElementById('cardNumber').value.replace(/\D/g, '');
                const expiryMonth = document.getElementById('expiryMonth').value.padStart(2, '0');
                const expiryYear = document.getElementById('expiryYear').value;
                const cvv2 = document.getElementById('cvv2').value;
                const password = document.getElementById('password').value;

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

                // UI Feedback
                const originalText = confirmPaymentBtn.innerHTML;
                confirmPaymentBtn.disabled = true;
                confirmPaymentBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> در حال پردازش...';

                try {
                    // ساخت داده‌های ارسالی
                    const paymentData = {
                        mobileNumber: mobileNumber,
                        amount: totalAmount,
                        items: selectedItems,
                        manualPayment: manualAdjustment > 0,
                        cardDetails: {
                            number: cardNumber,
                            expiry: `${expiryMonth}/${expiryYear}`,
                            cvv: cvv2
                        }
                    };

                    const apiUrl = `./proxy-settle.php?mobileNumber=${encodeURIComponent(mobileNumber)}&amount=${encodeURIComponent(totalAmount)}`;

                    const response = await fetch(apiUrl, {
                        method: 'PUT'
                    });


                    if (!response.ok) {
                        const error = await response.text();
                        throw new Error(error || 'خطا در ارتباط با سرور');
                    }

                    const result = await response.json();

                    if (result.success) {
                        paymentModal.hide();
                        await Swal.fire({
                            icon: 'success',
                            title: 'پرداخت موفق',
                            text: `پرداخت مبلغ ${formatCurrency(totalAmount)} با موفقیت انجام شد`,
                            confirmButtonText: 'باشه'
                        });

                        resetPaymentUI();
                        window.location.reload();
                    } else {
                        throw new Error(result.message || 'خطا در پرداخت');
                    }

                } catch (error) {
                    console.error('Payment error:', error);
                    await Swal.fire({
                        icon: 'error',
                        title: 'خطا در پرداخت',
                        text: error.message || 'خطایی در پرداخت رخ داده است',
                        confirmButtonText: 'متوجه شدم'
                    });
                } finally {
                    confirmPaymentBtn.disabled = false;
                    confirmPaymentBtn.innerHTML = originalText;
                }
            });

            function resetPaymentUI() {
                selectedItems.forEach(item => {
                    if (item.element) {
                        item.element.checked = false;
                        item.element.dispatchEvent(new Event('change'));
                    }
                });

                currentTotal = 0;
                manualAdjustment = 0;
                selectedItems = [];
                paymentAmountInput.value = formatCurrency(currentTotal);
                payButton.disabled = true;
            }

            // فرمت شماره کارت
            document.getElementById('cardNumber').addEventListener('input', function (e) {
                let value = this.value.replace(/\D/g, '');
                let formatted = '';
                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) formatted += '-';
                    formatted += value[i];
                }
                this.value = formatted;
            });

            // اعتبارسنجی ماه انقضا
            document.getElementById('expiryMonth').addEventListener('input', function (e) {
                this.value = this.value.replace(/\D/g, '').slice(0, 2);
                if (this.value.length === 1 && parseInt(this.value) > 1) {
                    this.value = '0' + this.value;
                }
                if (this.value.length === 2 && parseInt(this.value) > 12) {
                    this.value = '12';
                }
            });

            // اعتبارسنجی سال انقضا
            document.getElementById('expiryYear').addEventListener('input', function (e) {
                this.value = this.value.replace(/\D/g, '').slice(0, 2);
            });
        });
    </script>
</body>

</html>