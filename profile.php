<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پروفایل من</title>

    <!-- Font Awesome از CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap Icons از CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- فایل‌های سفارشی -->
    <link rel="stylesheet" href="./assets/css/animate.min.css">
    <link rel="stylesheet" href="./assets/fonts.css" />
    <link rel="stylesheet" href="./assets/icons-alipay.css">
    <link rel="stylesheet" href="./assets/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/styles.css" />

    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'IRANSans', sans-serif;
            direction: rtl;
            text-align: right;
        }
 

        .profile-header {
            background-color: #fff;
            padding: 1rem;
            border-radius: 12px;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .profile-header .status {
            color: red;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .menu-item {
            background-color: #fff;
            padding: 1rem;
            border-radius: 12px;
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .menu-item i {
            font-size: 1.2rem;
            color: #555;
        }

        .menu-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .logout {
            color: #dc3545;
        }

        .version-text {
            text-align: center;
            font-size: 0.8rem;
            color: #aaa;
            margin-top: 2rem;
        }
    </style>
    <link href="./assets/css/bootstrap-icons.css" rel="stylesheet">


</head>
<body>

<div class="container mt-3">

    <!-- هدر پروفایل -->
    <div class="profile-header">
        <div>
            <div class="text-muted small">09199990467</div>
            <div class="status">احراز نشده</div>
        </div>
        <i class="bi bi-person-circle fs-2"></i>
    </div>

    <!-- آیتم‌ها -->
    <div class="menu-item">
        <div class="menu-label">
            <i class="bi bi-gift-fill text-warning"></i>
            <span>کارت هدیه </span>
        </div>
        <i class="bi bi-chevron-left"></i>
    </div>

    <div class="menu-item">
        <div class="menu-label">
            <i class="bi bi-key-fill text-primary"></i>
            <span>تغییر رمز عبور</span>
        </div>
        <i class="bi bi-chevron-left"></i>
    </div>

    <div class="menu-item">
        <div class="menu-label">
            <i class="bi bi-wallet-fill text-primary"></i>
            <span>مدیریت کیف‌ها</span>
        </div>
        <i class="bi bi-chevron-left"></i>
    </div>

    <div class="menu-item">
        <div class="menu-label">
            <i class="bi bi-phone-fill text-primary"></i>
            <span>دستگاه‌های متصل</span>
        </div>
        <i class="bi bi-chevron-left"></i>
    </div>

    <div class="menu-item">
        <div class="menu-label">
            <i class="bi bi-life-preserver text-primary"></i>
            <span>پشتیبانی</span>
        </div>
        <i class="bi bi-chevron-left"></i>
    </div>

    <div class="menu-item">
        <div class="menu-label">
            <i class="bi bi-info-circle-fill text-primary"></i>
            <span>درباره ما</span>
        </div>
        <i class="bi bi-chevron-left"></i>
    </div>

    <div class="menu-item">
        <a href="index.php" class="menu-label logout">
        <div class="menu-label logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>خروج از حساب</span>
        </div>
        </a>
    </div>

    <div class="version-text">نسخه 1.0.4</div>

</div>
<div class="bottom-navigation-bar">
        <div class="tf-container">
            <ul class="tf-navigation-bar">
                <li class="active"><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php"><i
                    class="icon-user-outline"></i> پروفایل</a> </li>

                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="#"><i
                            class="icon-history"></i> سوابق</a> </li>
                            <li>
                                <a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="#">
                                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 11V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V11" stroke="#717171" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M3.5 7L5.05335 3.7236C5.18965 3.3912 5.51059 3.16667 5.86852 3.16667H18.1315C18.4894 3.16667 18.8104 3.3912 18.9466 3.7236L20.5 7" stroke="#717171" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M9 11V15C9 16.1046 9.89543 17 11 17H13C14.1046 17 15 16.1046 15 15V11" stroke="#717171" stroke-width="1.5" stroke-linecap="round"/>
                                    <circle cx="9" cy="7" r="1" fill="#717171"/>
                                    <circle cx="15" cy="7" r="1" fill="#717171"/>
                                  </svg>
                                  <span class="mt-1">فروشگاه</span>
                                </a>
                              </li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="#"><svg
                            width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12.25" cy="12" r="9.5" stroke="#717171" />
                            <path
                                d="M17.033 11.5318C17.2298 11.3316 17.2993 11.0377 17.2144 10.7646C17.1293 10.4914 16.9076 10.2964 16.6353 10.255L14.214 9.88781C14.1109 9.87213 14.0218 9.80462 13.9758 9.70702L12.8933 7.41717C12.7717 7.15989 12.525 7 12.2501 7C11.9754 7 11.7287 7.15989 11.6071 7.41717L10.5244 9.70723C10.4784 9.80483 10.3891 9.87234 10.286 9.88802L7.86469 10.2552C7.59257 10.2964 7.3707 10.4916 7.2856 10.7648C7.2007 11.038 7.27018 11.3318 7.46702 11.532L9.2189 13.3144C9.29359 13.3905 9.32783 13.5 9.31021 13.607L8.89692 16.1239C8.86027 16.3454 8.91594 16.5609 9.0533 16.7308C9.26676 16.9956 9.6394 17.0763 9.93735 16.9128L12.1027 15.7244C12.1932 15.6749 12.3072 15.6753 12.3975 15.7244L14.563 16.9128C14.6684 16.9707 14.7807 17 14.8966 17C15.1083 17 15.3089 16.9018 15.4469 16.7308C15.5845 16.5609 15.6399 16.345 15.6033 16.1239L15.1898 13.607C15.1722 13.4998 15.2064 13.3905 15.2811 13.3144L17.033 11.5318Z"
                                stroke="#717171" stroke-width="1.25" />
                        </svg>
                        خدمات</a> </li>
                
                            <li ><a class="fw_6 d-flex justify-content-center align-items-center flex-column"
                                href="dashboard.php"><i class="icon-home"></i> خانه</a> </li>
            </ul>
            <!-- <span class="line"></span> -->
        </div>
    </div>

    <script type="text/javascript" src="./assets/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="./assets/swiper.js"></script>
    <script type="text/javascript" src="./assets/main.js"></script>
    <script type="text/javascript" src="./assets/js/qrcode.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>



</body>

</html>
