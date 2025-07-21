<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNPL | استعلام وضعیت</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
     <link rel="stylesheet" href="./assets/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/brands.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-icons.min.css">
    <link href="./assets/css/Vazirmatn-Variable-font-face.css" rel="stylesheet" type="text/css" />

    <style>
        /* Consistent Root Variables */
        :root {
            --primary-color: #007bff;
            /* Bootstrap primary blue */
            --secondary-color: #0056b3;
            /* Darker blue for gradients */
            --success-color: #28a745;
            /* Green for success */
            --warning-color: #ffc107;
            /* Yellow for warning/pending */
            --danger-color: #dc3545;
            /* Red for errors */
            --info-color: #17a2b8;
            /* Cyan for info */
            --background-light: #f0f2f5;
            /* Light gray background */
            --text-dark: #333;
            /* Dark gray for main text */
            --text-muted: #6c757d;
            /* Muted gray for secondary text */
            --card-background: #ffffff;
            /* White card background */
            --card-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
            /* Soft, large shadow */
            --border-light: #e0e0e0;
            /* Light border color */
            --gradient-blue: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
            padding-bottom: 80px;
            /* Space for fixed bottom navigation */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Header Styles - Enhanced for visual appeal */
        .club-header {
            padding: 2rem 0;
            /* More padding for a grander feel */
            background: var(--gradient-blue);
            color: white;
            border-radius: 0 0 35px 35px;
            /* More rounded bottom corners */
            box-shadow: 0 10px 30px rgba(0, 123, 255, 0.3);
            /* Deeper shadow */
            position: relative;
            overflow: hidden;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
            /* More pronounced text shadow */
        }

        .club-header::before,
        .club-header::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            /* Subtle white overlay */
            border-radius: 50%;
            filter: blur(5px);
            /* Increased blur */
            opacity: 0.8;
            /* Slightly more visible */
        }

        .club-header::before {
            top: -50px;
            right: -50px;
            width: 180px;
            height: 180px;
        }

        .club-header::after {
            bottom: -80px;
            left: -30px;
            width: 250px;
            height: 250px;
        }

        .club-header h3 {
            /* Changed from h4 to h3 for prominence */
            font-weight: 800;
            /* Extra bold */
            margin-bottom: 0.5rem;
            font-size: 2.5rem;
            /* Larger font size */
            position: relative;
            z-index: 2;
        }

        .club-header p {
            font-weight: 500;
            /* Medium weight */
            opacity: 0.95;
            /* Less transparent */
            margin-bottom: 0;
            font-size: 1.2rem;
            /* Slightly larger */
            position: relative;
            z-index: 2;
        }

        /* Credit Status Card - Central Focus */
        .status-card {
            background: var(--card-background);
            border-radius: 25px;
            /* More rounded */
            padding: 2.5rem;
            margin: -30px auto 2rem auto;
            /* Lifted higher, more bottom margin */
            max-width: 650px;
            /* Wider card */
            width: calc(100% - 40px);
            /* Responsive width with padding */
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-light);
            text-align: center;
            position: relative;
            z-index: 10;
            /* Ensure it's above other elements */
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
            animation: fadeInScale 0.8s ease-out forwards;
            /* Entry animation */
        }

        .status-card:hover {
            transform: translateY(-10px);
            /* More subtle lift on hover */
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            /* Enhanced shadow on hover */
        }

        .status-card h5 {
            font-weight: 800;
            /* Extra bold */
            font-size: 1.6rem;
            /* Larger title */
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            line-height: 1.4;
        }

        .status-card .status-icon {
            font-size: 4rem;
            /* Larger icon */
            color: var(--warning-color);
            /* Yellow for "in review" */
            margin-bottom: 1.5rem;
            animation: pulse 1.8s infinite cubic-bezier(0.4, 0, 0.6, 1);
            /* Smoother pulse animation */
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.08);
                opacity: 0.8;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .status-card .status-desc {
            color: var(--text-muted);
            line-height: 1.8;
            font-size: 1rem;
            /* Slightly larger description */
            margin-bottom: 2rem;
            max-width: 500px;
            /* Limit width for readability */
            margin-left: auto;
            margin-right: auto;
        }

        /* How to Use Section */
        .how-to-use-section {
            max-width: 650px;
            width: calc(100% - 40px);
            margin: 0 auto 2rem auto;
            padding-top: 2rem;
            /* Space from the card above */
            animation: fadeInUp 0.8s ease-out forwards;
            animation-delay: 0.3s;
            opacity: 0;
        }

        .how-to-use-title {
            font-weight: 800;
            font-size: 1.5rem;
            /* Larger title */
            color: var(--text-dark);
            margin-bottom: 1rem;
            text-align: center;
        }

        .how-to-use-desc {
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-size: 1rem;
            text-align: center;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Installment Boxes - Refined appearance */
        .installment-box {
            background-color: var(--card-background);
            /* White background for boxes */
            border-radius: 18px;
            /* More rounded corners */
            padding: 1.5rem;
            margin-bottom: 1.2rem;
            text-align: right;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            /* Deeper shadow */
            border: 1px solid var(--border-light);
            transition: all 0.3s ease;
        }

        .installment-box:hover {
            transform: translateY(-5px);
            /* More pronounced lift */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .installment-box h6 {
            /* Changed from h5 to h6 for hierarchy */
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.25rem;
            /* Larger title */
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }

        .installment-box .icon {
            font-size: 2.2rem;
            /* Larger icon */
            margin-left: 1rem;
            /* More margin for RTL */
            color: var(--primary-color);
            flex-shrink: 0;
            /* Prevent icon from shrinking */
        }

        .installment-box.monthly .icon {
            color: var(--success-color);
        }

        .installment-box.installment .icon {
            color: var(--info-color);
        }


        .installment-box .sub-info {
            color: var(--text-muted);
            font-size: 0.95rem;
            /* Slightly larger */
            margin-bottom: 0.8rem;
            font-weight: 500;
        }

        .installment-box p {
            color: var(--text-dark);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 0;
        }

        /* Alert Box */
        .alert-info {
            background-color: rgba(0, 123, 255, 0.08);
            /* Lighter background */
            color: var(--primary-color);
            border-color: rgba(0, 123, 255, 0.15);
            border-radius: 18px;
            /* More rounded */
            padding: 1.2rem 1.8rem;
            /* More padding */
            font-size: 0.95rem;
            font-weight: 600;
            margin-top: 2.5rem;
            /* More top margin */
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.05);
            /* Subtle shadow */
        }

        .alert-info i {
            margin-left: 0.7rem;
            /* More margin for icon */
            font-size: 1.2rem;
            vertical-align: middle;
        }

        /* Bottom Navigation Bar - Consistent with other pages */
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
            background-color: rgba(0, 123, 255, 0.08);
            font-weight: 700;
        }

        .tf-navigation-bar li a.active i,
        .tf-navigation-bar li a.active svg {
            color: var(--primary-color);
        }

        .tf-navigation-bar li a:hover {
            color: var(--primary-color);
            background-color: rgba(0, 123, 255, 0.05);
        }

        .tf-navigation-bar li a:hover i,
        .tf-navigation-bar li a:hover svg {
            color: var(--primary-color);
        }

        /* Animations */
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            body {
                padding-bottom: 70px;
            }

            .club-header {
                padding: 1.5rem 0;
                border-radius: 0 0 25px 25px;
            }

            .club-header h3 {
                font-size: 2rem;
            }

            .club-header p {
                font-size: 1rem;
            }

            .status-card {
                padding: 2rem;
                margin: -30px auto 1.5rem auto;
                /* Adjusted lift for smaller screens */
                border-radius: 20px;
            }

            .status-card h5 {
                font-size: 1.4rem;
            }

            .status-card .status-icon {
                font-size: 3.5rem;
            }

            .status-card .status-desc,
            .how-to-use-desc,
            .installment-box p,
            .alert-info {
                font-size: 0.9rem;
            }

            .how-to-use-section {
                padding-top: 1.5rem;
            }

            .how-to-use-title {
                font-size: 1.3rem;
            }

            .installment-box {
                padding: 1.2rem;
                border-radius: 15px;
            }

            .installment-box h6 {
                font-size: 1.1rem;
            }

            .installment-box .icon {
                font-size: 1.8rem;
                margin-left: 0.8rem;
            }

            .tf-navigation-bar li a {
                font-size: 0.8rem;
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
            <h3 class="mb-3">استعلام وضعیت اعتبار</h3>
            <p class="mb-3">ما در حال بررسی درخواست شما هستیم.</p>
        </div>
    </div>

    <div class="container">
        <div class="status-card">
            <i class="fas fa-hourglass-half status-icon"></i>
            <h5>درخواست اعتبار شما در حال بررسی است.</h5>
            <p class="status-desc">
                اعتبار شما توسط بانک عامل در حال بررسی می‌باشد. به محض اختصاص اعتبار به شما اطلاع‌رسانی خواهد شد و
                پس از آن می‌توانید به صورت اعتباری از فروشگاه‌های طرف قرارداد ما خرید کنید.
            </p>
            <p class="status-desc">
                معمولاً این فرآیند **تا ۷۲ ساعت کاری** زمان می‌برد. از صبر و شکیبایی شما سپاسگزاریم.
            </p>
        </div>
    </div>


    <div class="container how-to-use-section">
        <h5 class="how-to-use-title">چطور از اعتبار BNPL استفاده کنم؟</h5>
        <p class="how-to-use-desc">
            می‌توانید با اعتبارتان از فروشگاه‌های حاضر در BNPL به‌صورت آنلاین یا حضوری
            خرید کرده و با یکی از روش‌های زیر تسویه کنید:
        </p>

        <div class="installment-box installment">
            <h6><i class="fas fa-money-bill-wave icon"></i> پرداخت قسطی</h6>
            <p class="sub-info">دریافت تسهیلات تا سقف اعتبار شما</p>
            <p>هزینه خرید شما به **۴ قسط** تقسیم می‌شود. یک قسط را هنگام خرید و ۳ قسط دیگر را در ۳ ماه آینده پرداخت
                می‌کنید. این روش برای خریدهای بزرگ‌تر مناسب است.</p>
        </div>

        <div class="installment-box monthly">
            <h6><i class="fas fa-calendar-check icon"></i> پرداخت آخر ماه</h6>
            <p class="sub-info">خرید امروز، پرداخت تا پایان ماه</p>
            <p>در این روش، مبلغ خریدهایتان را تا پایان همان ماه، به‌صورت یک‌جا تسویه می‌کنید. مناسب برای خریدهای روزمره
                و مدیریت هزینه‌ها.</p>
        </div>

        <div class="alert alert-info mt-4">
            <i class="fas fa-info-circle"></i>
            اعتبار BNPL شما فقط در **فروشگاه‌های همکار و پذیرندگان رسمی** قابل استفاده است.
        </div>
    </div>

    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column active" href="intro.php"
                        aria-label="خانه"><i class="fas fa-home"></i> خانه</a></li>


            </ul>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>