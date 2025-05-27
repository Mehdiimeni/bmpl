<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه ها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-Variable-font-face.css"
        rel="stylesheet" type="text/css" />
    <style>
        :root {
            --primary-color: #5b86e5;
            --secondary-color: #3656a8;
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --text-color-light: #fefefe;
            --text-color-dark: #333;
            --background-light: #f0f2f5; /* Added for consistency with previous designs */
        }

        body {
            background-color: var(--background-light);
            font-family: 'Vazirmatn', sans-serif;
            line-height: 1.6;
            color: var(--text-color-dark);
            padding-bottom: 80px; /* Space for the fixed bottom navigation */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden; /* Prevent horizontal scroll */
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

        /* Shop Grid Styles */
        .tf-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            margin-top: 1.5rem; /* Added margin-top to separate from header */
        }

        .tf-title h4 {
            font-weight: 700;
            color: var(--dark-color);
            font-size: 1.0rem;
        }

        .shop-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns, equal width */
            gap: 15px; /* Space between grid items */
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .shop-grid li {
            text-align: center;
        }

        .shop-grid li a {
            background-color: white;
            border-radius: 15px;
            padding: 0.75rem; /* Adjusted padding */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-color-dark);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
            height: 100%; /* Ensure uniform height for cards */
        }

        .shop-grid li a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .shop-grid .shop-img {
            width: 80px; /* Larger image size */
            height: 80px; /* Larger image size */
            border-radius: 15px; /* More rounded corners for images */
            object-fit: cover;
            margin-bottom: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .shop-grid li a:hover .shop-img {
            transform: scale(1.05); /* Slight scale on image hover */
        }

        .shop-grid li a span {
            font-weight: 600;
            font-size: 0.9rem;
            padding-top: 0.25rem; /* Space between image and text */
            white-space: nowrap; /* Prevent text wrapping */
            overflow: hidden; /* Hide overflow */
            text-overflow: ellipsis; /* Add ellipsis if text overflows */
            max-width: 100%; /* Ensure text respects its container */
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
            align-items: flex-start; /* Aligned to top for notifications */
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
            transform: translateY(-100%); /* Starts off-screen at the top */
            transition: transform 0.3s ease-in-out;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 0; /* No border-radius for top panel */
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

        /* Specific background colors for notification icons (if kept) */
        .bg_service-5 { background-color: #9C27B0; }
        .bg_service-3 { background-color: #FF9800; }
        .bg_service-1 { background-color: #4CAF50; }
        .bg_service-2 { background-color: #2196F3; }


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

            .tf-title h3 {
                font-size: 1.2rem;
            }

            .shop-grid {
                grid-template-columns: repeat(3, 1fr); /* Still 3 columns on smaller screens */
                gap: 10px;
            }

            .shop-grid li a {
                padding: 0.5rem;
            }

            .shop-grid .shop-img {
                width: 60px; /* Adjust image size for mobile */
                height: 60px;
            }

            .shop-grid li a span {
                font-size: 0.75rem; /* Smaller text for mobile */
            }

            .tf-navigation-bar li a {
                font-size: 0.75rem;
            }

            .tf-navigation-bar li a i,
            .tf-navigation-bar li a svg {
                font-size: 1.2rem;
            }

            .tf-panel .panel-box {
                max-height: 95vh;
            }

            .panel-noti .noti-list .content-right .title h3 {
                font-size: 0.9rem;
            }

            .panel-noti .noti-list .content-right .desc p {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="app-header">
        <div class="container">
            <div class="tf-topbar d-flex justify-content-between align-items-center">
                
            </div>
        </div>
    </div>

    <div class="container">
        <div class="tf-title">
            <h4 class="fw_6">لیست فروشگاه هایی که می توانید با اعتبار خود خرید کنید</h4>
        </div>
        <ul class="shop-grid mb-4">
            <li>
                <a href="#" aria-label="فروشگاه 1">
                    <img class="shop-img" src="./images/shop (1).jpg" alt="فروشگاه 1">
                    <span>فروشگاه 1</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 2">
                    <img class="shop-img" src="./images/shop (1)11.jpg" alt="فروشگاه 2">
                    <span>فروشگاه 2</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 3">
                    <img class="shop-img" src="./images/shop (144).jpg" alt="فروشگاه 3">
                    <span>فروشگاه 3</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 4">
                    <img class="shop-img" src="./images/shop (2).jpg" alt="فروشگاه 4">
                    <span>فروشگاه 4</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 5">
                    <img class="shop-img" src="./images/shop (69872).jpg" alt="فروشگاه 5">
                    <span>فروشگاه 5</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 6">
                    <img class="shop-img" src="./images/shop (2222).jpg" alt="فروشگاه 6">
                    <span>فروشگاه 6</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 7">
                    <img class="shop-img" src="./images/shop (2df).jpg" alt="فروشگاه 7">
                    <span>فروشگاه 7</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 8">
                    <img class="shop-img" src="./images/shop (3).jpg" alt="فروشگاه 8">
                    <span>فروشگاه 8</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 9">
                    <img class="shop-img" src="./images/shop (3).png" alt="فروشگاه 9">
                    <span>فروشگاه 9</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 10">
                    <img class="shop-img" src="./images/shop (3777).jpg" alt="فروشگاه 10">
                    <span>فروشگاه 10</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 11">
                    <img class="shop-img" src="./images/shop (44441).jpg" alt="فروشگاه 11">
                    <span>فروشگاه 11</span>
                </a>
            </li>
            <li>
                <a href="#" aria-label="فروشگاه 12">
                    <img class="shop-img" src="./images/shop (4543).jpg" alt="فروشگاه 12">
                    <span>فروشگاه 12</span>
                </a>
            </li>
            
        </ul>
    </div>

    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column "
                        href="credit.php" aria-label="خانه"><i class="fas fa-home"></i> خانه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="service.php"
                        aria-label="خدمات">
                        <i class="fas fa-bell-concierge"></i> خدمات</a></li>
                <li>
                    <a class="fw_4 d-flex justify-content-center align-items-center flex-column active" href="shop.php"
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

    <div class="tf-panel" id="notificationPanel">
        <div class="panel_overlay"></div>
        <div class="panel-box panel-noti">
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
                        <ul class="menu-tabs d-flex justify-content-around">
                            <li class="nav-tab active"><a href="#">سیستم</a></li>
                            <li class="nav-tab"><a href="#">امتیاز</a></li>
                            <li class="nav-tab"><a href="#">مالی</a></li>
                            <li class="nav-tab"><a href="#">خدمات</a></li>
                        </ul>
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
                                            <p>مبلغ ۲۵۰,۰۰۰ تومان به حساب شما واریز شد</p>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Panel (Modal) Open/Close Logic
        $(document).ready(function () {
            function openPanel(panelId) {
                $(panelId).addClass('active');
                $('body').addClass('overflow-hidden'); // Prevent body scroll when panel is open
            }

            function closePanels() {
                $('.tf-panel').removeClass('active');
                $('body').removeClass('overflow-hidden');
            }

            $('#btn-popup-up').on('click', function (e) {
                e.preventDefault();
                openPanel('#notificationPanel');
            });

            $('.clear-panel, .panel_overlay').on('click', function (e) {
                e.preventDefault();
                closePanels();
            });

            // Handle notification tabs (simple click effect)
            $('.menu-tabs .nav-tab').on('click', function(e) {
                e.preventDefault();
                $('.menu-tabs .nav-tab').removeClass('active');
                $(this).addClass('active');
                // You can add logic here to load content based on the clicked tab
            });
        });

        // Removed all Swiper initializations
        // Removed QR Modal functionality
        // Removed PWA push notification script
    </script>
</body>

</html>