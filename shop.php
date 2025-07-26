<?php 


header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies



session_start(); ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه ها</title>
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
            --secondary-color: #3656a8;
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --text-color-light: #fefefe;
            --text-color-dark: #333;
            --background-light: #f0f2f5;
            /* Added for consistency with previous designs */
        }

        body {
            background-color: var(--background-light);
            font-family: 'Vazirmatn', sans-serif;
            line-height: 1.6;
            color: var(--text-color-dark);
            padding-bottom: 80px;
            /* Space for the fixed bottom navigation */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
            /* Prevent horizontal scroll */
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
            margin-top: 1.5rem;
            /* Added margin-top to separate from header */
        }

        .tf-title h4 {
            font-weight: 700;
            color: var(--dark-color);
            font-size: 1.0rem;
        }

        .shop-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* 3 columns, equal width */
            gap: 15px;
            /* Space between grid items */
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
            padding: 0.75rem;
            /* Adjusted padding */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-color-dark);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
            height: 100%;
            /* Ensure uniform height for cards */
        }

        .shop-grid li a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .shop-grid .shop-img {
            width: 80px;
            /* Larger image size */
            height: 80px;
            /* Larger image size */
            border-radius: 15px;
            /* More rounded corners for images */
            object-fit: cover;
            margin-bottom: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .shop-grid li a:hover .shop-img {
            transform: scale(1.05);
            /* Slight scale on image hover */
        }

        .shop-grid li a span {
            font-weight: 600;
            font-size: 0.9rem;
            padding-top: 0.25rem;
            /* Space between image and text */
            white-space: nowrap;
            /* Prevent text wrapping */
            overflow: hidden;
            /* Hide overflow */
            text-overflow: ellipsis;
            /* Add ellipsis if text overflows */
            max-width: 100%;
            /* Ensure text respects its container */
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
                grid-template-columns: repeat(3, 1fr);
                /* Still 3 columns on smaller screens */
                gap: 10px;
            }

            .shop-grid li a {
                padding: 0.5rem;
            }

            .shop-grid .shop-img {
                width: 60px;
                /* Adjust image size for mobile */
                height: 60px;
            }

            .shop-grid li a span {
                font-size: 0.75rem;
                /* Smaller text for mobile */
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

    <?php

    // دریافت داده از API
    $api_url = 'http://192.168.50.15:7475/api/BNPL/GetAllMerchants';
    $response = file_get_contents($api_url);
    $merchants = json_decode($response, true);

    // آرایه تصاویر فروشگاه‌ها
    $shop_images = [
        './images/shop (1).jpg',
        './images/shop (1)11.jpg',
        './images/shop (144).jpg',
        './images/shop (2).jpg',
        './images/shop (69872).jpg',
        './images/shop (2222).jpg',
        './images/shop (2df).jpg',
        './images/shop (3).jpg',
        './images/shop (3).png',
        './images/shop (3777).jpg',
        './images/shop (44441).jpg',
        './images/shop (4543).jpg'
    ];
    ?>

    <div class="container">
        <div class="tf-title">
            <h4 class="fw_6">لیست فروشگاه هایی که می توانید با اعتبار خود خرید کنید</h4>
        </div>
        <ul class="shop-grid mb-4">
            <?php foreach ($merchants as $index => $merchant):
                $image_index = $index % count($shop_images);
                $shop_image = $shop_images[$image_index];

                if ($merchant['merchantName'] == $_SESSION['merchantName'])
                    continue;

                try {
                    $mobileNumber = $merchant['mobileNumber'];
                    $api_url = 'http://192.168.50.15:7475/api/BNPL/login';
                    $data = ['mobileNumber' => $mobileNumber];

                    $options = [
                        'http' => [
                            'header' => "Content-type: application/json\r\n",
                            'method' => 'POST',
                            'content' => json_encode($data),
                        ],
                    ];
                    $context = stream_context_create($options);
                    $response = @file_get_contents($api_url, false, $context);

                    $is_active = ($response !== FALSE && json_last_error() === JSON_ERROR_NONE);
                } catch (Exception $e) {
                    $is_active = false;
                }
                ?>
                <li class="<?= !$is_active ? 'disabled-shop' : '' ?>">
                    <a href="<?= $is_active ? 'shop_detail.php?mobileNumber=' . $merchant['mobileNumber'] : 'javascript:void(0)' ?><?php echo  '&sr=' . random_int(1, 1000000000) ; ?>"
                        aria-label="<?= htmlspecialchars($merchant['merchantName']) ?>" <?= !$is_active ? 'title="عدم دسترسی از سرور"' : '' ?>>
                        <img class="shop-img" src="<?= $shop_image ?>"
                            alt="<?= htmlspecialchars($merchant['merchantName']) ?>">
                        <span><?= htmlspecialchars($merchant['merchantName']) ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <style>
            .disabled-shop {
                opacity: 0.3;
                pointer-events: none;
            }

            .disabled-shop a {
                cursor: not-allowed;
                text-decoration: none;
            }
        </style>
    </div>

    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column " href="credit.php<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>"
                        aria-label="خانه"><i class="fas fa-home"></i> خانه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="service.php"
                        aria-label="خدمات">
                        <i class="fas fa-bell-concierge"></i> خدمات</a></li>
                <li>
                    <a class="fw_4 d-flex justify-content-center align-items-center flex-column active" href="shop.php<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>"
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>