<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت‌های من</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Vazirmatn Font Import */
        @font-face {
            font-family: 'Vazirmatn';
            src: url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Regular.woff2') format('woff2');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Vazirmatn';
            src: url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Bold.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
        }

        /* Root Variables for consistent theming */
        :root {
            --primary-color: #007bff;
            /* Bootstrap primary blue */
            --secondary-color: #0056b3;
            /* Darker blue for gradients */
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
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
            --green-badge: #e6ffe6;
            /* Light green for badges */
            --blue-badge: #e6f7ff;
            /* Light blue for badges */
            --purple-badge: #f2e6ff;
            /* Light purple for badges */
            --purple-color: #6f42c1;
            /* Dark purple */
            --orange-badge: #fff5e6;
            /* Light orange for badges */
            --orange-color: #fd7e14;
            /* Dark orange */
            --red-badge: #ffe6e6;
            /* Light red for badges */
            --red-color: #dc3545;
            /* Dark red */
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
            padding-bottom: 120px;
            /* Space for the fixed footer */
            overflow-x: hidden;
            /* Prevent horizontal scroll */
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

            .bottom-payment-bar .total-info {
                font-size: 0.9rem;
                padding: 0 1rem 0.5rem;
            }

            .bottom-payment-bar button {
                width: calc(100% - 2rem);
                padding: 0.7rem 1rem;
                font-size: 1rem;
            }
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
            <div class="tab-nav-item active" data-tab="this-month">
                این ماه
                <span class="badge" id="this-month-badge">6</span>
            </div>
            <div class="tab-nav-item" data-tab="future-months">
                ماه‌های آینده
                <span class="badge" id="future-months-badge">5</span>
            </div>
            <div class="tab-nav-item" data-tab="bank-credit">
                اعتبار بانکی
                <span class="badge" id="bank-credit-badge">3</span>
            </div>
        </div>

        <div id="this-month-content" class="tab-content active">

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" checked data-amount="45000">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box green-theme">
                    <i class="fa-solid fa-car"></i>
                </div>
                <div class="details">
                    <div class="title">تاکسی آنلاین (تپسی)</div>
                    <div class="subtitle">خدمات حمل و نقل</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۴۵,۰۰۰ تومان</div>
                    <div class="amount-badge monthly">بدهی ماهانه</div>
                </div>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" checked data-amount="1750325">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box pink-theme">
                    <i class="fa-solid fa-mobile-alt"></i>
                </div>
                <div class="details">
                    <div class="title">فروشگاه موبایل (دیجی‌فروش)</div>
                    <div class="subtitle">خرید اقساطی گوشی</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۱,۷۵۰,۳۲۵ تومان</div>
                    <div class="amount-badge installment"><i class="bi bi-dot"></i>قسط چهارم</div>
                </div>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" checked data-amount="186900">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box blue-theme">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <div class="details">
                    <div class="title">کافه رستوران (بامبو)</div>
                    <div class="subtitle">صورتحساب رستوران</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۱۸۶,۹۰۰ تومان</div>
                    <div class="amount-badge monthly">هزینه ثابت</div>
                </div>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" checked data-amount="327825">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box yellow-theme">
                    <i class="fa-solid fa-home"></i>
                </div>
                <div class="details">
                    <div class="title">خدمات خانه (پاکسان)</div>
                    <div class="subtitle">نظافت منزل</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۳۲۷,۸۲۵ تومان</div>
                    <div class="amount-badge monthly">هزینه سرویس</div>
                </div>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" checked data-amount="200000">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box purple-theme">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="details">
                    <div class="title">آموزشگاه زبان (گاما)</div>
                    <div class="subtitle">شهریه ماهانه</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۲۰۰,۰۰۰ تومان</div>
                    <div class="amount-badge monthly">بدهی ماهانه</div>
                </div>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" checked data-amount="500000">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box orange-theme">
                    <i class="fa-solid fa-heartbeat"></i>
                </div>
                <div class="details">
                    <div class="title">کلینیک پزشکی (سلامت)</div>
                    <div class="subtitle">ویزیت پزشک</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۵۰۰,۰۰۰ تومان</div>
                    <div class="amount-badge monthly">خدمات درمانی</div>
                </div>
            </div>

        </div>

        <div id="future-months-content" class="tab-content">
            <div class="credit-balance">
                <i class="bi bi-list-columns"></i>
                <span>مجموع بدهی‌های آینده: <span id="future-total-amount"></span></span>
            </div>

            <div class="month-header">
                <h5>اقساط تیر ماه</h5>
                <i class="bi bi-calendar"></i>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" data-amount="768830">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box market blue-theme">
                    <i class="fa-solid fa-basket-shopping"></i>
                </div>
                <div class="details">
                    <div class="title">سوپرمارکت آنلاین (اکالا)</div>
                    <div class="subtitle">خرید خواربار</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۷۶۸,۸۳۰ تومان</div>
                    <div class="amount-badge installment"><i class="bi bi-dot"></i>قسط سوم</div>
                </div>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" data-amount="2045500">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box gallery yellow-theme">
                    <i class="fa-solid fa-chair"></i>
                </div>
                <div class="details">
                    <div class="title">فروشگاه مبلمان (آرام چوب)</div>
                    <div class="subtitle">قسط خرید مبل</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۲,۰۴۵,۵۰۰ تومان</div>
                    <div class="amount-badge installment"><i class="bi bi-dot"></i>قسط دوم</div>
                </div>
            </div>

            <div class="month-header">
                <h5>اقساط مرداد ماه</h5>
                <i class="bi bi-calendar"></i>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" data-amount="768830">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box market blue-theme">
                    <i class="fa-solid fa-basket-shopping"></i>
                </div>
                <div class="details">
                    <div class="title">سوپرمارکت آنلاین (اکالا)</div>
                    <div class="subtitle">خرید خواربار</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۷۶۸,۸۳۰ تومان</div>
                    <div class="amount-badge installment"><i class="bi bi-dot"></i>قسط چهارم</div>
                </div>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" data-amount="2045500">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box gallery yellow-theme">
                    <i class="fa-solid fa-chair"></i>
                </div>
                <div class="details">
                    <div class="title">فروشگاه مبلمان (آرام چوب)</div>
                    <div class="subtitle">قسط خرید مبل</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۲,۰۴۵,۵۰۰ تومان</div>
                    <div class="amount-badge installment"><i class="bi bi-dot"></i>قسط سوم</div>
                </div>
            </div>
            
            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" data-amount="150000">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box red-theme">
                    <i class="fa-solid fa-dumbbell"></i>
                </div>
                <div class="details">
                    <div class="title">باشگاه ورزشی (فیت‌لند)</div>
                    <div class="subtitle">حق عضویت</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۱۵۰,۰۰۰ تومان</div>
                    <div class="amount-badge monthly">بدهی ماهانه</div>
                </div>
            </div>

        </div>

        <div id="bank-credit-content" class="tab-content">
            <div class="credit-balance">
                <i class="bi bi-bank"></i>
                <span>مجموع اعتبار موجود: <span id="bank-credit-total-amount"></span></span>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" data-amount="5000000">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box purple-theme">
                    <i class="fa-solid fa-piggy-bank"></i>
                </div>
                <div class="details">
                    <div class="title">وام ازدواج (بانک ملی)</div>
                    <div class="subtitle">تاریخ سررسید: ۲۰ شهریور ۱۴۰۴</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۵,۰۰۰,۰۰۰ تومان</div>
                    <div class="amount-badge bank-credit"><i class="bi bi-dot"></i>اعتبار فعال</div>
                </div>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" data-amount="2000000">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box orange-theme">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <div class="details">
                    <div class="title">تسهیلات خرید کالا (بانک سامان)</div>
                    <div class="subtitle">تاریخ سررسید: ۱۰ مرداد ۱۴۰۴</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۲,۰۰۰,۰۰۰ تومان</div>
                    <div class="amount-badge bank-credit"><i class="bi bi-dot"></i>اعتبار فعال</div>
                </div>
            </div>

            <div class="debt-card">
                <label class="checkbox-container">
                    <input type="checkbox" data-amount="1500000">
                    <span class="checkmark"></span>
                </label>
                <div class="icon-box red-theme">
                    <i class="fa-solid fa-money-check-dollar"></i>
                </div>
                <div class="details">
                    <div class="title">کارت اعتباری (بانک پاسارگاد)</div>
                    <div class="subtitle">تاریخ سررسید: ۰۵ تیر ۱۴۰۴</div>
                </div>
                <div class="amount-section">
                    <div class="amount">۱,۵۰۰,۰۰۰ تومان</div>
                    <div class="amount-badge bank-credit"><i class="bi bi-dot"></i>اعتبار فعال</div>
                </div>
            </div>
        </div>
    </div>


    <div class="bottom-payment-bar">
        <div class="total-info">
            <span>مبلغ قابل پرداخت:</span>
            <span id="total-payment-amount"></span>
        </div>
        <button id="pay-button">پرداخت</button>
        <div class="total-info d-none" id="future-months-info">
            <span>سررسید پرداخت:</span>
            <span>تا پایان روز ۳۱ خرداد</span>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabItems = document.querySelectorAll('.tab-nav-item');
            const tabContents = document.querySelectorAll('.tab-content');
            const payButton = document.getElementById('pay-button');
            const totalPaymentAmountSpan = document.getElementById('total-payment-amount');
            const futureMonthsInfo = document.getElementById('future-months-info');
            const thisMonthBadge = document.getElementById('this-month-badge');
            const futureMonthsBadge = document.getElementById('future-months-badge');
            const bankCreditBadge = document.getElementById('bank-credit-badge');

            function formatCurrency(amount) {
                return amount.toLocaleString('fa-IR') + ' تومان';
            }

            function calculateAndDisplayTotal() {
                const activeTabId = document.querySelector('.tab-nav-item.active').dataset.tab;
                const activeContent = document.getElementById(activeTabId + '-content');
                let total = 0;

                // Select all checkboxes within the *active* tab
                const checkboxes = activeContent.querySelectorAll('.debt-card input[type="checkbox"]');

                // For "this-month" and "future-months", sum checked items
                if (activeTabId === 'this-month' || activeTabId === 'future-months') {
                    const checkedCheckboxes = activeContent.querySelectorAll('.debt-card input[type="checkbox"]:checked');
                    checkedCheckboxes.forEach(checkbox => {
                        total += parseInt(checkbox.dataset.amount);
                    });
                    totalPaymentAmountSpan.textContent = formatCurrency(total);
                    // Enable pay button if any item is checked, otherwise disable
                    payButton.disabled = total === 0;

                    if (activeTabId === 'future-months') {
                        // Display total for future debts in the header of that section
                        let futureTotalSum = 0;
                        checkboxes.forEach(checkbox => {
                            futureTotalSum += parseInt(checkbox.dataset.amount);
                        });
                        document.getElementById('future-total-amount').textContent = formatCurrency(futureTotalSum);
                        futureMonthsInfo.classList.remove('d-none');
                    } else {
                        futureMonthsInfo.classList.add('d-none');
                    }

                } else if (activeTabId === 'bank-credit') {
                    // For "bank-credit" tab, sum all items to show total credit available
                    let bankTotalSum = 0;
                    checkboxes.forEach(checkbox => {
                        bankTotalSum += parseInt(checkbox.dataset.amount);
                    });
                    document.getElementById('bank-credit-total-amount').textContent = formatCurrency(bankTotalSum);
                    totalPaymentAmountSpan.textContent = '۰ تومان'; // No direct payment from here
                    payButton.disabled = true; // Always disabled for bank credit as it's not a direct payment
                    futureMonthsInfo.classList.add('d-none');
                }
            }

            function updateBadgeCounts() {
                thisMonthBadge.textContent = document.querySelectorAll('#this-month-content .debt-card').length;
                futureMonthsBadge.textContent = document.querySelectorAll('#future-months-content .debt-card').length;
                bankCreditBadge.textContent = document.querySelectorAll('#bank-credit-content .debt-card').length;
            }

            tabItems.forEach(item => {
                item.addEventListener('click', function () {
                    // Remove active class from all tabs and hide all content
                    tabItems.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    tabContents.forEach(c => c.style.display = 'none');

                    // Add active class to clicked tab
                    this.classList.add('active');

                    // Show corresponding content
                    const targetTab = this.dataset.tab;
                    const targetContent = document.getElementById(targetTab + '-content');
                    targetContent.classList.add('active');
                    targetContent.style.display = 'block';

                    calculateAndDisplayTotal(); // Recalculate total based on new active tab
                });
            });

            // Add event listeners to all checkboxes in all tabs
            document.querySelectorAll('.debt-card input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', calculateAndDisplayTotal);
            });

            // Initial calculations on page load
            updateBadgeCounts();
            calculateAndDisplayTotal();
        });
    </script>
</body>

</html>