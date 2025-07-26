<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/brands.min.css">
    <link rel="stylesheet" href="./assets/css/animate.min.css" />
    <link href="./assets/css/Vazirmatn-Variable-font-face.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css" />

    <style>
        :root {
            --primary-color: #5b86e5;
            --secondary-color: #3656a8;
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --text-color-light: #fefefe;
            --text-color-dark: #333;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Vazirmatn', sans-serif;
            line-height: 1.6;
            color: var(--text-color-dark);
            padding-bottom: 80px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .app-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1.5rem 0;
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

        .tf-topbar {
            padding: 0 15px;
            /* Add padding for content inside header */
        }

        .user-info img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-left: 15px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .user-info .content h4 {
            color: var(--text-color-light);
            font-weight: 700;
            margin-bottom: 0.1rem;
        }

        .user-info .content p {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 400;
            font-size: 0.9rem;
        }

        .icon-notification1 {
            color: var(--text-color-light);
            font-size: 1.4rem;
            position: relative;
            text-decoration: none;
            /* Ensure link style is clean */
        }

        .icon-notification1 span {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent-color);
            color: white;
            font-size: 0.7rem;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border: 1px solid white;
        }

        .credit-offer {
            background: linear-gradient(135deg, #43cea2, #185a9d);
            border-radius: 20px;
            padding: 1.5rem;
            color: #fff;
            margin-top: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            z-index: 1;
        }

        .credit-offer::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.05);
            top: -50%;
            left: -50%;
            transform: rotate(45deg);
            animation: shine 8s linear infinite;
        }

        @keyframes shine {
            0% {
                transform: rotate(45deg) translateX(-100%);
            }

            100% {
                transform: rotate(45deg) translateX(100%);
            }
        }

        .btn-credit {
            background-color: #fff;
            color: #185a9d;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 0.95rem;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            /* Ensure link style is clean */
        }

        .btn-credit:hover {
            background: #e3e3e3;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .tf-balance-box {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-top: 1.5rem;
        }

        .wallet-footer {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .wallet-card-item {
            text-align: center;
            flex: 1;
        }

        .wallet-card-item a {
            display: block;
            text-decoration: none;
            color: #555;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .wallet-card-item a:hover {
            color: var(--primary-color);
        }

        .wallet-card-item .icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            transition: transform 0.3s ease;
            color: var(--primary-color);
        }

        .wallet-card-item a:hover .icon {
            transform: scale(1.1);
        }

        /* Styles for the "Services" and "Shop" sections */
        .tf-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .tf-title h3 {
            font-weight: 700;
            color: var(--dark-color);
            font-size: 1.4rem;
        }

        .tf-title .primary_color {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .tf-title .primary_color:hover {
            color: var(--secondary-color);
        }

        .box-service {
            display: grid;
            /* Use CSS Grid for better control */
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            /* Responsive columns */
            gap: 15px;
            /* Space between items */
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .box-service li {
            text-align: center;
        }

        .box-service li a {
            background-color: white;
            border-radius: 15px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-color-dark);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
            height: 100%;
        }

        .box-service li a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .box-service .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.8rem;
            font-size: 1.8rem;
            color: white;
        }

        /* Specific background colors for service icons */
        .bg_color_1 {
            background-color: #283EB4;
        }

        .bg_color_2 {
            background-color: #1E90FF;
        }

        .bg_color_3 {
            background-color: #FECC0E;
        }

        .bg_color_7 {
            background-color: #E5354B;
        }


        .box-service li a span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .swiper {
            width: 100%;
            height: auto;
        }

        .recipient-tes .swiper-wrapper {
            padding-bottom: 10px;
            /* Space for scrollbar if needed */
        }

        .recipient-tes .swiper-slide,
        .banner-tes .swiper-slide {
            width: auto !important;
            margin-left: 15px;
            /* Spacing between slides */
            flex-shrink: 0;
            /* Prevent shrinking too much */
        }

        .recipient-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-color-dark);
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .recipient-box img {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            object-fit: cover;
            margin-bottom: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .recipient-box:hover {
            color: var(--primary-color);
        }

        .recipient-box:hover img {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .banner-tes .swiper-slide img {
            width: 100%;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease;
        }

        .banner-tes .swiper-slide img:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
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


        /* Panel (Modal) Styles */
        .tf-panel {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1050;
            display: flex;
            justify-content: center;
            /* Center horizontally */
            align-items: flex-end;
            /* Align to bottom */
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s ease-in-out;
            background-color: rgba(0, 0, 0, 0.5);
            /* Overlay */
        }

        .tf-panel.active {
            visibility: visible;
            opacity: 1;
        }

        .tf-panel .panel-box {
            background: white;
            width: 100%;
            max-width: 500px;
            /* Limit width for larger screens */
            position: relative;
            /* Changed from absolute to relative inside flex parent */
            transform: translateY(100%);
            transition: transform 0.3s ease-in-out;
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
            max-height: 90vh;
            /* Max height to prevent overflow on small screens */
            overflow-y: auto;
            /* Enable scrolling if content is too long */
        }

        .tf-panel.active .panel-box {
            transform: translateY(0);
        }

        .tf-panel.up {
            /* Specific styles for "up" panel (notification) */
            align-items: flex-start;
            /* Align to top */
        }

        .tf-panel.up .panel-box {
            border-radius: 0;
            /* No rounded corners for top panel */
            max-height: 100vh;
            /* Can take full height */
            transform: translateY(-100%);
            /* Start from top, move down */
        }

        .tf-panel.up.active .panel-box {
            transform: translateY(0);
        }


        .tf-panel .header {
            padding: 1rem 0;
            background-color: white;
            border-bottom: 1px solid #eee;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            position: sticky;
            /* Make header sticky */
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
            /* Add padding for click area */
        }

        /* Notifications panel */
        .panel-noti .noti-box {
            background-color: white;
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .panel-noti .noti-list {
            display: flex;
            align-items: center;
        }

        .panel-noti .noti-list .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
            color: white;
        }

        .panel-noti .noti-list .content-right {
            flex-grow: 1;
        }

        .panel-noti .noti-list .content-right .title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.2rem;
        }

        .panel-noti .noti-list .content-right .title h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }

        .panel-noti .noti-list .content-right .title span {
            font-size: 0.8rem;
            font-weight: 600;
        }

        .panel-noti .noti-list .content-right .desc p {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0.3rem;
        }

        .panel-noti .noti-list .content-right .desc .time {
            font-size: 0.75rem;
            color: #999;
        }

        .panel-noti .noti-list .content-right .desc .dot {
            display: inline-block;
            width: 4px;
            height: 4px;
            background-color: #ccc;
            border-radius: 50%;
            margin: 0 5px;
            vertical-align: middle;
        }

        /* Specific background colors for notification icons */
        .bg_service-5 {
            background-color: #9C27B0;
        }

        .bg_service-3 {
            background-color: #FF9800;
        }

        .bg_service-1 {
            background-color: #4CAF50;
        }

        .bg_service-2 {
            background-color: #2196F3;
        }


        /* Modal styles (e.g., QR modal) */
        .modal-content {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }

        .modal-title {
            font-weight: 700;
            color: var(--dark-color);
        }

        .btn-close {
            margin-left: 0;
            margin-right: auto;
            /* Push to the left in RTL */
        }

        #qrcode {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1.5rem;
        }


        @media (max-width: 768px) {
            body {
                padding-bottom: 70px;
            }

            .app-header {
                padding: 1rem 0;
                border-radius: 0 0 20px 20px;
            }

            .user-info img {
                width: 45px;
                height: 45px;
            }

            .user-info .content h4 {
                font-size: 1rem;
            }

            .user-info .content p {
                font-size: 0.8rem;
            }

            .icon-notification1 {
                font-size: 1.2rem;
            }

            .icon-notification1 span {
                width: 16px;
                height: 16px;
                font-size: 0.65rem;
            }

            .credit-offer {
                margin-top: 1.5rem;
                padding: 1.2rem;
            }

            .btn-credit {
                padding: 10px 25px;
                font-size: 0.85rem;
            }

            .tf-title h3 {
                font-size: 1.2rem;
            }

            .tf-title .primary_color {
                font-size: 0.8rem;
            }

            .box-service {
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                /* Adjust for smaller screens */
                gap: 10px;
            }

            .box-service li a {
                padding: 0.8rem;
            }

            .box-service .icon-box {
                width: 45px;
                height: 45px;
                font-size: 1.5rem;
            }

            .box-service li a span {
                font-size: 0.8rem;
            }

            .recipient-box img {
                width: 50px;
                height: 50px;
            }

            .banner-tes .swiper-slide img {
                height: 100px;
            }

            .tf-navigation-bar li a {
                font-size: 0.75rem;
            }

            .tf-navigation-bar li a i,
            .tf-navigation-bar li a svg {
                font-size: 1.2rem;
            }

            .panel-noti .noti-list .content-right .title h3 {
                font-size: 0.9rem;
            }

            .panel-noti .noti-list .content-right .desc p {
                font-size: 0.8rem;
            }

            .tf-panel .panel-box {
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="preload preload-container">
        <div class="preload-logo"></div>
    </div>
    <div class="app-header">
        <div class="container">
            <div class="tf-topbar d-flex justify-content-between align-items-center">
                <a class="user-info d-flex justify-content-between align-items-center" href="profile.php">
                    <img src="./images/user1.jpg" alt="تصویر کاربر">
                    <div class="content">
                        <h4>کاربر</h4>
                        <p>BMPL</p>
                    </div>
                </a>
                <a href="#" id="btn-popup-up" class="icon-notification1" aria-label="اعلانات">
                    <i class="fas fa-bell"></i>
                    <span>1</span>
                </a>
            </div>
        </div>
    </div>




    <div class="mt-5 mb-5">
        <div class="container mt-4">
            <div class="section-header mb-4">
                <h4><i class="fas fa-hand-holding-dollar"></i> خدمات اعتباری</h4>
            </div>

            <ul class="box-service">
                <li>
                    <a href="credit-register.php" aria-label="ثبت نام اعتبار جدید">
                        <div class="icon-box bg_color_1">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <span>ثبت نام جدید</span>
                    </a>
                </li>

                <li>
                    <a href="credit.php" aria-label="ورود به حساب اعتبار">
                        <div class="icon-box bg_color_3">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <span>ورود به حساب</span>
                    </a>
                </li>

                <li>
                    <a href="credit-status.php" aria-label="استعلام وضعیت اعتبار">
                        <div class="icon-box bg_color_2">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <span>استعلام وضعیت</span>
                    </a>
                </li>


            </ul>
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
                    <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                            href="credit-debt.php" aria-label="سوابق"><i class="fas fa-clock-rotate-left"></i>
                            پرداخت</a></li>
                    <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php"
                            aria-label="پروفایل"><i class="fas fa-user-circle"></i> پروفایل</a></li>
                </ul>
            </div>
        </div>


        <div class="tf-panel up" id="notificationPanel">
            <div class="panel_overlay"></div>
            <div class="panel-box panel-up panel-noti">
                <div class="header is-fixed">
                    <div class="container">
                        <div class="tf-statusbar d-flex justify-content-between align-items-center">
                            <a href="#" class="clear-panel" data-dismiss-panel="#notificationPanel"> <i
                                    class="fas fa-chevron-left"></i> </a>
                            <h3>پیام ها</h3>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="app-wrap style1" style="padding-top: 70px;">
                    <div class="container">
                        <div class="tf-tab mt-3">
                            <div class="swiper tes-noti">
                                <ul class="swiper-wrapper menu-tabs">
                                    <li class="swiper-slide nav-tab active"><a href="#">سیستم</a></li>
                                    <li class="swiper-slide nav-tab"><a href="#">امتیاز</a></li>
                                    <li class="swiper-slide nav-tab"><a href="#">مالی</a></li>
                                    <li class="swiper-slide nav-tab"><a href="#">خدمات</a></li>
                                </ul>
                            </div>
                            <div class="content-tab mt-5">
                                <div class="noti-box">
                                    <div class="noti-list">
                                        <div class="icon-box bg_service-5">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <div class="content-right">
                                            <div class="title">
                                                <h3>به روزرسانی سامانه</h3>
                                                <span class="text-info">اطلاعیه</span>
                                            </div>
                                            <div class="desc">
                                                <p>نسخه جدید اپلیکیشن منتشر شد. لطفاً بروزرسانی کنید</p>
                                                <span class="time">2 روز پیش</span>
                                                <i class="dot"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="noti-box">
                                    <div class="noti-list">
                                        <div class="icon-box bg_service-3">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="content-right">
                                            <div class="title">
                                                <h3>امتیاز جدید</h3>
                                                <span class="text-warning">پاداش</span>
                                            </div>
                                            <div class="desc">
                                                <p>برای خرید قبلی ۱۵۰ امتیاز دریافت کردید</p>
                                                <span class="time">دیروز</span>
                                                <i class="dot"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="noti-box">
                                    <div class="noti-list">
                                        <div class="icon-box bg_service-1">
                                            <i class="fas fa-money-bill-transfer"></i>
                                        </div>
                                        <div class="content-right">
                                            <div class="title">
                                                <h3>واریز وجه موفق</h3>
                                                <span class="text-success">جدید</span>
                                            </div>
                                            <div class="desc">
                                                <p>مبلغ ۲۵۰,۰۰۰ ریال به حساب شما واریز شد</p>
                                                <span class="time">10 دقیقه پیش</span>
                                                <i class="dot"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="noti-box">
                                    <div class="noti-list">
                                        <div class="icon-box bg_service-2">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                        <div class="content-right">
                                            <div class="title">
                                                <h3>نوبت شما رسید</h3>
                                                <span class="text-primary">مهم</span>
                                            </div>
                                            <div class="desc">
                                                <p>نوبت خدمات فنی شما برای فردا ساعت ۱۰ صبح تنظیم شد</p>
                                                <span class="time">1 ساعت پیش</span>
                                                <i class="dot"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tf-panel down" id="transactionPanel">
            <div class="panel_overlay"></div>
            <div class="panel-box panel-down">
                <div class="header bg_white_color">
                    <div class="container">
                        <div class="tf-statusbar d-flex justify-content-between align-items-center">
                            <a href="#" class="clear-panel" data-dismiss-panel="#transactionPanel"> <i
                                    class="fas fa-times"></i> </a>
                            <h3>تراکنش</h3>
                            <a href="#" class="action-right" data-bs-toggle="modal" data-bs-target="#qrModal"><i
                                    class="fas fa-qrcode"></i></a>
                        </div>
                    </div>
                </div>
                <div class="wrap-transfer mb-5" style="padding-top: 20px;">
                    <div class="container">
                        <a href="#" class="action-sheet-transfer">
                            <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                            <div class="content">
                                <h4 class="fw_6">پرداخت قسط</h4>
                                <p>مدیریت اقساط پرداختی</p>
                            </div>
                        </a>
                        <a href="#" class="action-sheet-transfer">
                            <div class="icon"><i class="fas fa-triangle-exclamation"></i></div>
                            <div class="content">
                                <h4 class="fw_6">معوقه</h4>
                                <p>بررسی بدهی‌های سررسید گذشته</p>
                            </div>
                        </a>
                        <a href="#" class="action-sheet-transfer">
                            <div class="icon"><i class="fas fa-gift"></i></div>
                            <div class="content">
                                <h4 class="fw_6">پاداش</h4>
                                <p>دریافت جوایز و امتیازات</p>
                            </div>
                        </a>
                        <a href="#" class="action-sheet-transfer">
                            <div class="icon"><i class="fas fa-cart-shopping"></i></div>
                            <div class="content">
                                <h4 class="fw_6">خرید</h4>
                                <p>سوابق خریدهای انجام‌شده</p>
                            </div>
                        </a>
                        <a href="#" class="action-sheet-transfer">
                            <div class="icon"><i class="fas fa-rotate-left"></i></div>
                            <div class="content">
                                <h4 class="fw_6">بازگشت پول</h4>
                                <p>مشاهده مبالغ برگشتی</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tf-panel down" id="cardPanel">
            <div class="panel_overlay"></div>
            <div class="panel-box panel-down">
                <div class="header">
                    <div class="container">
                        <div class="tf-statusbar d-flex justify-content-between align-items-center">
                            <a href="#" class="clear-panel" data-dismiss-panel="#cardPanel"> <i
                                    class="fas fa-times"></i>
                            </a>
                            <h3>مدیریت کارت ها</h3>
                        </div>
                    </div>
                </div>
                <div class="content-card mt-3 mb-5" style="padding-top: 20px;">
                    <div class="container">
                        <div class="tf-card-list bg_surface_color large out-line">
                            <div class="info">
                                <h4 class="fw_6"><a href="#">صادرات</a></h4>
                                <p>**** **** **** 7576</p>
                            </div>
                            <input type="checkbox" class="tf-checkbox form-check-input" checked>
                        </div>
                        <p class="auth-line text-center mt-3 text-secondary">انتخاب کارت های دیگر</p>

                        <div class="tf-spacing-20" style="height: 20px;"></div>
                        <a href="#" class="btn btn-primary w-100 py-3">افزودن کارت <i class="fas fa-plus ms-2"></i> </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4">
                    <div class="modal-header border-0">
                        <h5 class="modal-title w-100" id="qrModalLabel"> QR </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div>
        </div>

        <script src="./assets/js/bootstrap.bundle.min.js"></script>
        <script src="./assets/js/jquery-3.6.0.min.js"></script>
        <script src="./assets/js/swiper-bundle.min.js"></script>
        <script src="./assets/js/qrcode.min.js"></script>


        <script>
            // Preloader script (Optional, you can remove this if not needed)
            // This is a basic example, you might need a more robust solution
            window.addEventListener('load', function () {
                const preload = document.querySelector('.preload');
                if (preload) {
                    preload.style.display = 'none'; // Hide preloader after content loads
                }
            });

            // Initialize Swiper for recipient (shop) carousel
            var recipientSwiper = new Swiper(".recipient-tes", {
                slidesPerView: "auto",
                spaceBetween: 15,
                freeMode: true,
                // To prevent issues when there are not enough slides
                watchOverflow: true,
            });

            // Initialize Swiper for banner carousel
            var bannerSwiper = new Swiper(".banner-tes", {
                slidesPerView: 1.2,
                spaceBetween: 15,
                centeredSlides: true,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                // To prevent issues when there are not enough slides
                watchOverflow: true,
            });

            // Initialize Swiper for notification tabs
            var notiSwiper = new Swiper(".tes-noti", {
                slidesPerView: "auto",
                spaceBetween: 10,
                freeMode: true,
                // To prevent issues when there are not enough slides
                watchOverflow: true,
            });


            // Handle panel (modal-like) open/close
            $(document).ready(function () {
                // Function to open a panel
                function openPanel(panelId) {
                    $(panelId).addClass('active');
                }

                // Function to close all panels
                function closePanels() {
                    $('.tf-panel').removeClass('active');
                }

                // Open notification panel
                $('#btn-popup-up').on('click', function (e) {
                    e.preventDefault();
                    openPanel('#notificationPanel');
                });

                // Open transaction panel
                $('#btn-popup-down').on('click', function (e) {
                    e.preventDefault();
                    openPanel('#transactionPanel');
                });

                // Open card panel
                $('.btn-card-popup').on('click', function (e) {
                    e.preventDefault();
                    openPanel('#cardPanel');
                });

                // Close panels
                $('.clear-panel, .panel_overlay').on('click', function (e) {
                    e.preventDefault();
                    closePanels();
                });
            });

            // QR Modal functionality
            document.addEventListener('DOMContentLoaded', function () {
                var qrModalElement = document.getElementById('qrModal');
                if (qrModalElement) {
                    qrModalElement.addEventListener('shown.bs.modal', function () {
                        document.getElementById('qrcode').innerHTML = ""; // Clear previous QR
                        var qrData = "https://example.com/user/12345"; // Dynamic QR data
                        new QRCode(document.getElementById("qrcode"), {
                            text: qrData,
                            width: 200,
                            height: 200
                        });
                    });
                }
            });

            // Placeholder for PWA push notification script (from original, simplified)
            if ('serviceWorker' in navigator && 'PushManager' in window) {
                navigator.serviceWorker.ready.then(function (registration) {
                    // This part is for welcome notification, typically handled once after first subscription
                    // For demonstration, simplified. In a real app, manage subscriptions carefully.
                    // You might want to remove showNotification on every page load.
                    // registration.showNotification('خوش‌آمدید!', {
                    //     body: 'به داشبورد خوش آمدید.',
                    //     icon: './',
                    //     badge: './',
                    //     data: { url: '/' },
                    // });
                }).catch(function (error) {
                    console.error('Service Worker registration failed:', error);
                });
            }
        </script>
</body>

</html>