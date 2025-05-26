<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تاریخچه پرداخت‌ها و سفارشات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
            padding-bottom: 80px;
            /* Ensures space for bottom navigation bar */
        }

        .container {
            max-width: 600px;
        }

        /* Main Header Styles */
        .main-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            /* Using var(--secondary-color) for consistency */
            color: white;
            padding: 2rem 0;
            border-radius: 0 0 25px 25px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 123, 255, 0.2);
            /* Adjust shadow color */
            position: relative;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .main-header::before {
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

        .main-header::after {
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


        .main-header h1 {
            font-weight: 800;
            margin-bottom: 0.5rem;
            font-size: 2.2rem;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .main-header p {
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 0;
            font-size: 1.1rem;
            position: relative;
            z-index: 2;
        }

        /* Section Header Styles */
        .section-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            /* More rounded */
            margin: 2.5rem 0 1.5rem 0;
            /* Adjusted margins */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            /* Softer shadow */
            display: flex;
            align-items: center;
        }

        .section-header h4 {
            margin-bottom: 0;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .section-header i {
            margin-left: 0.75rem;
            /* Adjusted margin for RTL */
            font-size: 1.4rem;
        }

        /* Payment Table Styles */
        .payment-table {
            border-radius: 12px;
            /* More rounded */
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            background-color: white;
        }

        .payment-table thead th {
            background-color: #e9f0f7;
            /* Lighter header background */
            font-weight: 700;
            border-bottom: 2px solid #c8d3e0;
            /* Matching border */
            padding: 1rem 0.75rem;
            color: var(--text-dark);
        }

        .payment-table tbody tr {
            transition: all 0.2s ease;
        }

        .payment-table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.03);
            /* Lighter hover effect */
        }

        .payment-table tbody td {
            padding: 0.75rem;
            vertical-align: middle;
            border-top: 1px solid var(--border-light);
            color: #555;
            font-size: 0.95rem;
        }

        .status-paid {
            color: var(--success-color);
            font-weight: 600;
            background-color: rgba(40, 167, 69, 0.1);
            padding: 0.25rem 0.6rem;
            border-radius: 15px;
            font-size: 0.85rem;
            display: inline-block;
        }

        /* Order Card Styles */
        .order-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            background-color: white;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .order-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            cursor: pointer;
            border-radius: 12px 12px 0 0;
            /* Match card radius */
        }

        .order-card-header:hover {
            background-color: #f8faff;
        }

        .order-title {
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--text-dark);
        }

        .order-card-body {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out, padding 0.4s ease-out;
            /* Smooth transition */
            background-color: #fcfdfe;
            /* Very light background for body */
        }

        .order-card.active .order-card-body {
            padding: 1.5rem;
            max-height: 500px;
            /* Sufficiently large height */
        }

        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .status-delivered {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .status-processing {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }

        .status-cancelled {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        .order-details {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .accordion-icon {
            transition: transform 0.3s ease;
        }

        .order-card.active .accordion-icon {
            transform: rotate(180deg);
        }

        /* Bottom Navigation Bar Styles (Copied from previous examples for consistency) */
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
            .main-header {
                padding: 1.5rem 0;
                border-radius: 0 0 15px 15px;
                margin-bottom: 1.5rem;
            }

            .main-header h1 {
                font-size: 1.8rem;
            }

            .main-header p {
                font-size: 0.95rem;
            }

            .section-header {
                padding: 0.75rem 1rem;
                font-size: 1.1rem;
                margin: 2rem 0 1rem 0;
            }

            .section-header h4 {
                font-size: 1.1rem;
            }

            .section-header i {
                font-size: 1.2rem;
                margin-left: 0.5rem;
            }

            .payment-table thead th,
            .payment-table tbody td {
                padding: 0.6rem;
                font-size: 0.85rem;
            }

            .status-paid,
            .status-badge {
                font-size: 0.75rem;
                padding: 0.2rem 0.5rem;
            }

            .order-card-header {
                padding: 0.8rem 1rem;
            }

            .order-title {
                font-size: 1rem;
            }

            .order-card-body {
                padding: 1rem !important;
            }

            .order-details {
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
    <div class="main-header text-center">
        <div class="container">
           <h1 class="mb-3">تاریخچه خرید</h1>
            <p class="mb-0">مشاهده تمام  خریدهای شما</p>
        </div>
    </div>

    <div class="container">
        <div class="section-header">
            <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i>تاریخچه خرید</h4>
        </div>

        <div class="search-box">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="جستجو در تراکنش‌ها..." aria-label="جستجو در تراکنش‌ها">
            <i class="fas fa-search"></i>
        </div>

        <div class="table-responsive payment-table">
            <table class="table table-hover mb-0" id="paymentTable">
                <thead>
                    <tr>
                        <th>تاریخ</th>
                        <th>وضعیت</th>
                        <th>مبلغ</th>
                        <th>نوع</th>
                        <th>کد </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>۱۴۰۴/۰۱/۰۴</td>
                        <td><span class="status-paid">پرداخت شده</span></td>
                        <td>۲۸۹,۰۰۰</td>
                        <td>گوشی تلفن همراه</td>
                        <td>۱۶۷۳۳۴</td>
                    </tr>
                    <tr>
                        <td>۱۴۰۴/۰۱/۰۴</td>
                        <td><span class="status-paid">پرداخت شده</span></td>
                        <td>۳۰۰,۰۰۰</td>
                        <td>شارژ کیف پول</td>
                        <td>۷۶۵۴۳۲</td>
                    </tr>
                    <tr>
                        <td>۱۴۰۳/۰۸/۲۸</td>
                        <td><span class="status-paid">پرداخت شده</span></td>
                        <td>۱۸۷,۹۶۰</td>
                        <td> خدمات رستوران </td>
                        <td>۸۹۰۱۲۳</td>
                    </tr>
                    <tr>
                        <td>۱۴۰۳/۰۷/۱۰</td>
                        <td><span class="status-paid">پرداخت شده</span></td>
                        <td>۴۵۰,۰۰۰</td>
                        <td>کتاب دیجیتال</td>
                        <td>۴۵۶۷۸۹</td>
                    </tr>
                    <tr>
                        <td>۱۴۰۳/۰۶/۲۰</td>
                        <td><span class="status-paid">پرداخت شده</span></td>
                        <td>۱,۵۰۰,۰۰۰</td>
                        <td>لباس ورزشی</td>
                        <td>۲۳۴۵۶۷</td>
                    </tr>
                    <tr>
                        <td>۱۴۰۳/۰۵/۰۵</td>
                        <td><span class="status-paid">پرداخت شده</span></td>
                        <td>۷۵,۰۰۰</td>
                        <td>قهوه</td>
                        <td>۹۸۷۶۵۴</td>
                    </tr>
                    <tr>
                        <td>۱۴۰۳/۰۴/۱۲</td>
                        <td><span class="status-paid">پرداخت شده</span></td>
                        <td>۲,۰۰۰,۰۰۰</td>
                        <td>تعمیر لپ‌تاپ</td>
                        <td>۱۳۵۷۹۰</td>
                    </tr>
                    <tr>
                        <td>۱۴۰۳/۰۳/۰۱</td>
                        <td><span class="status-paid">پرداخت شده</span></td>
                        <td>۱۲۵,۰۰۰</td>
                        <td>بلیت سینما</td>
                        <td>۲۴۶۸۰۰</td>
                    </tr>
                    <tr>
                        <td>۱۴۰۳/۰۲/۱۵</td>
                        <td><span class="status-paid">پرداخت شده</span></td>
                        <td>۹۵۰,۰۰۰</td>
                        <td>کفش ورزشی</td>
                        <td>۳۶۹۱۵۹</td>
                    </tr>
                    <tr>
                        <td>۱۴۰۳/۰۱/۳۰</td>
                        <td><span class="status-paid">پرداخت شده</span></td>
                        <td>۶۰۰,۰۰۰</td>
                        <td>اشتراک نرم‌افزار</td>
                        <td>۷۸۹۰۱۲</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column active"
                        href="dashboard.php" aria-label="خانه"><i class="fas fa-home"></i> خانه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="service.php"
                        aria-label="خدمات">
                        <i class="fas fa-bell-concierge"></i> خدمات</a></li>
                <li>
                    <a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="shop.php"
                        aria-label="فروشگاه">
                        <i class="fas fa-store-alt"></i>
                        <span class="mt-1">فروشگاه</span>
                    </a>
                </li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="credit-debt.php"
                        aria-label="سوابق"><i class="fas fa-clock-rotate-left"></i> پرداخت</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php"
                        aria-label="پروفایل"><i class="fas fa-user-circle"></i> پروفایل</a></li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleOrderCard(header) {
            const card = header.parentElement;
            card.classList.toggle('active');
        }
    </script>
</body>

</html>