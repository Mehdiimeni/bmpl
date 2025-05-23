<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- اضافه کردن Font Awesome برای آیکون‌ها -->
    <link rel="stylesheet" href="./assets/css/all.min.css">
    <!-- اضافه کردن Animate.css برای انیمیشن‌ها -->
    <link rel="stylesheet" href="./assets/css/animate.min.css">
    <link rel="stylesheet" href="./assets/fonts.css" />
    <!-- Icons -->
    <link rel="stylesheet" href="./assets/icons-alipay.css">
    <link rel="stylesheet" href="./assets/bootstrap.css">
    <link rel="stylesheet" href="./assets/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/styles.css" />
    <script>
        if ('serviceWorker' in navigator && 'PushManager' in window) {
            navigator.serviceWorker.ready.then(function (registration) {
                registration.pushManager.getSubscription().then(function (subscription) {
                    if (!subscription) {
                        // کاربر عضو اعلان نشده است، بنابراین اعلان خوش‌آمدی را ارسال کنید
                        registration.showNotification('خوش‌آمدید!', {
                            body: 'به داشبورد خوش آمدید.',
                            icon: './', // آیکون اعلان
                            badge: './', // بج اعلان
                            data: {
                                url: '/',
                            },
                        });
                    }
                });
            });
        }
    </script>
    <style>
        /* استایل آیکون‌ها و انیمیشن‌ها */
        .icon {
            font-size: 48px;
            margin: 20px;
            opacity: 0.5;
            transition: opacity 0.3s ease-in-out;
        }

        .icon.active {
            opacity: 1;
        }

        .animated-icon {
            animation: bounce 2s infinite;
        }

        /* استایل داشبورد */
        .container {
            text-align: center;
        }

        /* استایل متن زیر آیکون رای دهی */
        .icon-label {
            font-size: 16px;
            display: block;
            margin-top: 10px;
        }
    </style>

    <style>
        .credit-offer {
            
            color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 2rem;
        }

        .credit-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .credit-amount {
            font-size: 2rem;
            font-weight: bold;
            margin: 1.5rem 0;
            color: #4e54c8;
        }

        .btn-credit {
            background-color: white;
            color: #4e54c8;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 30px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin: 10px;
            transition: all 0.3s ease;
        }

        .btn-credit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-more {
            color: white;
            background-color: transparent;
            border: 2px solid white;
            padding: 10px 25px;
            border-radius: 30px;
            margin: 10px;
            transition: all 0.3s ease;
        }

        .btn-more:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body>
    <!-- preloade -->
    <div class="preload preload-container">
        <div class="preload-logo"></div>
    </div>
    <!-- /preload -->

    <div class="app-header">
        <div class="tf-container">
            <div class="tf-topbar d-flex justify-content-between align-items-center">
                <a class="user-info d-flex justify-content-between align-items-center" href="#">
                    <img src="./images/user1.jpg" alt="image">

                    <div class="content">
                        <h4 class="white_color">کاربر</h4>
                        <p class="white_color fw_4">BMPL </p>
                    </div>
                </a>
                <a href="#" id="btn-popup-up" class="icon-notification1"><span>1</span></a>
            </div>
        </div>
    </div>
    <div class="card-secton">
        <div class="tf-container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="credit-offer">

                            <div class="d-flex flex-column flex-md-row justify-content-center">
                                <a class="btn btn-credit" href="credit-service.php">خدمات اعتباری </a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </div>
    <div class="mt-5">
        <div class="tf-container">

            <div class="tf-balance-box">
                <div class="balance">
                    <div class="row">
                        <div class="col-6 br-right">
                            <div class="inner-left">
                                <p>کیف پول </p>
                                <h3>تومان 2،000،000</h3>
                            </div>
                        </div>
                        <div class="col-6">
                            <a href="score.php">
                                <div class="inner-right">
                                    <p>امتیاز</p>
                                    <h3>
                                        <ul class="icon-gift-box">
                                            <li class="path1"></li>
                                            <li class="path2"></li>
                                            <li class="path3"></li>
                                            <li class="path4"></li>
                                            <li class="path5"></li>
                                            <li class="path6"></li>
                                            <li class="path7"></li>
                                            <li class="path8"></li>
                                            <li class="path9"></li>
                                            <li class="path10"></li>
                                        </ul>
                                        4,500

                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="wallet-footer">
                    <ul class="d-flex justify-content-between align-items-center">
                        <li class="wallet-card-item">
                            <a class="fw_6 text-center" id="btn-popup-down">
                                <ul class="icon icon-group-transfers">
                                    <li class="path1"></li>
                                    <li class="path2"></li>
                                    <li class="path3"></li>
                                </ul>
                                تراکنش
                            </a>
                        </li>
                        <li class="wallet-card-item"><a class="fw_6" href="wallet.php">
                                <ul class="icon icon-topup">
                                    <li class="path1"></li>
                                    <li class="path2"></li>
                                    <li class="path3"></li>
                                    <li class="path4"></li>
                                </ul>
                                کیف پول
                            </a></li>
                        <li class="wallet-card-item"><a class="fw_6 btn-card-popup" href="#">
                                <ul class="icon icon-group-credit-card">
                                    <li class="path1"></li>
                                    <li class="path2"></li>
                                    <li class="path3"></li>
                                </ul>
                                کارت
                            </a></li>
                        <li class="wallet-card-item">
                            <a class="fw_6" href="#" data-bs-toggle="modal" data-bs-target="#qrModal">
                                <ul class="icon icon-my-qr">
                                    <li class="path1"></li>
                                    <li class="path2"></li>
                                    <li class="path3"></li>
                                    <li class="path4"></li>
                                    <li class="path5"></li>
                                    <li class="path6"></li>
                                    <li class="path7"></li>
                                </ul>
                                QR
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-5">
        <div class="tf-container">
            <div class="tf-title d-flex justify-content-between">
                <h3 class="fw_6">خدمات شما</h3>
                <a href="#" class="primary_color fw_6">مشاهده همه</a>
            </div>
            <ul class="box-service mt-3">
                <li>
                    <a href="#">
                        <div class="icon-box bg_color_1">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_4355_17017)">
                                    <rect x="6.375" y="2" width="12" height="19" fill="white" />
                                    <path
                                        d="M17.7247 0H7.02484C6.13341 0 5.40381 0.728914 5.40381 1.62103V22.3783C5.40381 23.2704 6.13341 24 7.02484 24H17.7247C18.6161 24 19.3457 23.2718 19.3457 22.379V1.62103C19.3457 0.728914 18.6161 0 17.7247 0ZM10.6632 1.16846H14.0863C14.1947 1.16846 14.2824 1.25623 14.2824 1.36526C14.2824 1.4736 14.1947 1.56137 14.0863 1.56137H10.6632C10.5549 1.56137 10.4671 1.4736 10.4671 1.36526C10.4671 1.25623 10.5549 1.16846 10.6632 1.16846ZM12.3748 23.1895C11.927 23.1895 11.5643 22.8267 11.5643 22.3783C11.5643 21.9298 11.927 21.5678 12.3748 21.5678C12.8226 21.5678 13.1853 21.9298 13.1853 22.3783C13.1853 22.8267 12.8226 23.1895 12.3748 23.1895ZM18.2177 21H6.53181V2.57074H18.2177V21Z"
                                        fill="#283EB4" />
                                    <path
                                        d="M12.3749 6C13.9704 6 15.4719 6.6175 16.6019 7.7385C16.7979 7.9325 16.7994 8.2495 16.6049 8.445C16.5074 8.5435 16.3784 8.593 16.2499 8.593C16.1229 8.593 15.9954 8.5445 15.8979 8.448C14.9564 7.5145 13.7049 7 12.3749 7C11.0449 7 9.79344 7.5145 8.85194 8.4485C8.65644 8.643 8.33944 8.642 8.14494 8.4455C7.95044 8.2495 7.95194 7.9325 8.14794 7.7385C9.27794 6.6175 10.7794 6 12.3749 6Z"
                                        fill="#39A3F8" />
                                    <path
                                        d="M11.25 12.75H10C9.793 12.75 9.625 12.918 9.625 13.125C9.625 13.332 9.793 13.5 10 13.5H11.25C11.319 13.5 11.375 13.556 11.375 13.625V14.375H10C9.793 14.375 9.625 14.543 9.625 14.75C9.625 14.957 9.793 15.125 10 15.125H11.375V15.875C11.375 15.944 11.319 16 11.25 16H10C9.793 16 9.625 16.168 9.625 16.375C9.625 16.582 9.793 16.75 10 16.75H11.25C11.7325 16.75 12.125 16.3575 12.125 15.875V13.625C12.125 13.1425 11.7325 12.75 11.25 12.75Z"
                                        fill="#39A3F8" />
                                    <path
                                        d="M14.75 14.5H14C13.793 14.5 13.625 14.668 13.625 14.875C13.625 15.082 13.793 15.25 14 15.25H14.375V16H13.5C13.431 16 13.375 15.944 13.375 15.875V13.625C13.375 13.556 13.431 13.5 13.5 13.5H14.75C14.957 13.5 15.125 13.332 15.125 13.125C15.125 12.918 14.957 12.75 14.75 12.75H13.5C13.0175 12.75 12.625 13.1425 12.625 13.625V15.875C12.625 16.3575 13.0175 16.75 13.5 16.75H14.75C14.957 16.75 15.125 16.582 15.125 16.375V14.875C15.125 14.668 14.957 14.5 14.75 14.5Z"
                                        fill="#39A3F8" />
                                    <path
                                        d="M12.3751 7.89099C11.2896 7.89099 10.2671 8.31199 9.49706 9.07649C9.30106 9.27099 9.29956 9.58699 9.49406 9.78299C9.68906 9.97949 10.0051 9.98049 10.2011 9.78599C10.7831 9.20849 11.5551 8.89099 12.3751 8.89099C13.1951 8.89099 13.9671 9.20899 14.5491 9.78649C14.6466 9.88299 14.7736 9.93149 14.9011 9.93149C15.0296 9.93149 15.1586 9.88199 15.2561 9.78349C15.4506 9.58749 15.4491 9.27099 15.2531 9.07649C14.4831 8.31199 13.4606 7.89099 12.3751 7.89099Z"
                                        fill="#39A3F8" />
                                    <path
                                        d="M10.8429 10.4165C11.2489 10.0075 11.7929 9.78198 12.3749 9.78198C12.9569 9.78198 13.5009 10.0075 13.9069 10.416C14.1014 10.612 14.1004 10.9285 13.9044 11.123C13.8064 11.22 13.6794 11.2685 13.5519 11.2685C13.4234 11.2685 13.2949 11.2195 13.1974 11.121C12.7629 10.6835 11.9869 10.6835 11.5524 11.121C11.3579 11.3165 11.0414 11.318 10.8454 11.1235C10.6494 10.929 10.6484 10.6125 10.8429 10.4165Z"
                                        fill="#39A3F8" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_4355_17017">
                                        <rect width="24" height="24" fill="white" transform="translate(0.375)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        شارژ
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-box bg_color_2">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_4355_17182)">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.1251 3.44482C11.8537 3.44482 11.5823 3.44929 11.3754 3.45819C7.2762 3.6346 3.36945 5.25275 0.34614 8.02658C0.0409477 8.30659 0.0419856 8.78279 0.334879 9.07568L1.73847 10.4793C2.03137 10.7722 2.50495 10.7704 2.81312 10.4937C5.17879 8.36971 8.20079 7.11796 11.3755 6.94708C11.7891 6.92482 12.4612 6.92482 12.8748 6.94708C16.0495 7.11796 19.0716 8.36971 21.4372 10.4937C21.7454 10.7704 22.219 10.7722 22.5119 10.4793L23.9154 9.07568C24.2083 8.78279 24.2094 8.30659 23.9042 8.02658C20.8809 5.25275 16.9742 3.63459 12.8749 3.45819C12.668 3.44929 12.3966 3.44482 12.1251 3.44482ZM12.0831 10.4116L11.3339 10.4416C9.09872 10.6112 6.9762 11.4953 5.28166 12.9627C4.9686 13.2338 4.97027 13.7111 5.26316 14.004L6.66667 15.4076C6.95956 15.7005 7.43228 15.6967 7.75477 15.437C8.79066 14.603 10.0444 14.0826 11.3663 13.9378L12.1251 13.8964C14.1994 14.0799 15.4569 14.6008 16.4955 15.437C16.818 15.6967 17.2907 15.7005 17.5836 15.4076L18.9872 14.004C19.2801 13.7111 19.2817 13.2338 18.9686 12.9627C17.2632 11.4859 15.1247 10.6002 12.8745 10.4385C12.4614 10.4089 12.1063 10.4116 12.0831 10.4116ZM12.1251 17.3954C11.854 17.3954 11.5828 17.4175 11.3809 17.4616C10.9771 17.5499 10.5921 17.7094 10.2442 17.9325C9.89616 18.1556 9.89855 18.6394 10.1914 18.9323L11.5949 20.3357C11.7355 20.4763 11.9263 20.5553 12.1252 20.5553C12.3241 20.5553 12.5148 20.4763 12.6555 20.3357L14.0589 18.9323C14.3518 18.6394 14.3542 18.1556 14.0062 17.9325C13.6582 17.7094 13.2732 17.5499 12.8694 17.4616C12.6674 17.4175 12.3963 17.3954 12.1251 17.3954Z"
                                        fill="#1E90FF" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.134 3.44482V6.93042C12.4023 6.93056 12.6702 6.93599 12.8746 6.94699C16.0493 7.11786 19.0714 8.36962 21.4371 10.4937C21.7453 10.7703 22.2189 10.7721 22.5118 10.4792L23.9153 9.07559C24.2082 8.7827 24.2093 8.3065 23.9041 8.02649C20.8808 5.25266 16.974 3.6345 12.8748 3.4581C12.6703 3.4493 12.4024 3.44492 12.134 3.44482ZM0.133981 8.39334C0.110813 8.49681 0.111064 8.60452 0.133981 8.70874V8.39334ZM12.134 10.4115V13.8971C14.2028 14.0814 15.4582 14.602 16.4954 15.437C16.8179 15.6966 17.2906 15.7004 17.5835 15.4075L18.9871 14.0039C19.28 13.711 19.2815 13.2337 18.9685 12.9626C17.2631 11.4858 15.1246 10.6001 12.8744 10.4384C12.5312 10.4138 12.2401 10.4116 12.134 10.4115ZM12.134 17.3955V20.5552C12.3298 20.5529 12.5169 20.474 12.6554 20.3356L14.0588 18.9322C14.3517 18.6393 14.3541 18.1556 14.0061 17.9324C13.6581 17.7093 13.273 17.5498 12.8692 17.4615C12.6695 17.4179 12.4021 17.396 12.134 17.3955Z"
                                        fill="#0584FF" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_4355_17182">
                                        <rect width="24" height="24" fill="white" transform="translate(0.125)" />
                                    </clipPath>
                                </defs>
                            </svg>

                        </div>
                        اینترنت
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-box bg_color_3">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.87511 1.25C5.49974 1.24954 5.1266 1.30757 4.76911 1.422C4.00043 1.65173 3.32708 2.12475 2.85029 2.76998C2.37349 3.4152 2.11901 4.19775 2.12511 5V10C2.12564 10.7292 2.41554 11.4284 2.93115 11.944C3.44676 12.4596 4.14592 12.7495 4.87511 12.75H8.87511C9.07402 12.75 9.26479 12.671 9.40544 12.5303C9.54609 12.3897 9.62511 12.1989 9.62511 12V5C9.62379 4.00585 9.22827 3.05279 8.5253 2.34981C7.82232 1.64684 6.86926 1.25133 5.87511 1.25Z"
                                    fill="#DA9B00" />
                                <path
                                    d="M23.6248 6.00002V20C23.625 20.3612 23.5541 20.7189 23.416 21.0527C23.2779 21.3865 23.0753 21.6897 22.8199 21.9452C22.5645 22.2006 22.2612 22.4031 21.9275 22.5412C21.5937 22.6793 21.236 22.7503 20.8748 22.75H10.8748C10.5136 22.7503 10.1558 22.6793 9.82208 22.5412C9.48831 22.4031 9.18505 22.2006 8.92964 21.9452C8.67422 21.6897 8.47167 21.3865 8.33356 21.0527C8.19545 20.7189 8.1245 20.3612 8.12477 20V4.25002C8.12328 3.54389 7.87275 2.86092 7.41729 2.32131C6.96182 1.78171 6.33062 1.42006 5.63477 1.30002C5.70929 1.26345 5.79184 1.24626 5.87477 1.25002H18.8748C20.1342 1.25108 21.3418 1.75186 22.2324 2.64243C23.1229 3.533 23.6237 4.74057 23.6248 6.00002Z"
                                    fill="#FECC0E" />
                                <path
                                    d="M15.875 8.75H12.875C12.6761 8.75 12.4853 8.67098 12.3447 8.53033C12.204 8.38968 12.125 8.19891 12.125 8C12.125 7.80109 12.204 7.61032 12.3447 7.46967C12.4853 7.32902 12.6761 7.25 12.875 7.25H15.875C16.0739 7.25 16.2647 7.32902 16.4053 7.46967C16.546 7.61032 16.625 7.80109 16.625 8C16.625 8.19891 16.546 8.38968 16.4053 8.53033C16.2647 8.67098 16.0739 8.75 15.875 8.75Z"
                                    fill="white" />
                                <path
                                    d="M18.875 11.75H12.875C12.6761 11.75 12.4853 11.671 12.3447 11.5303C12.204 11.3897 12.125 11.1989 12.125 11C12.125 10.8011 12.204 10.6103 12.3447 10.4697C12.4853 10.329 12.6761 10.25 12.875 10.25H18.875C19.0739 10.25 19.2647 10.329 19.4053 10.4697C19.546 10.6103 19.625 10.8011 19.625 11C19.625 11.1989 19.546 11.3897 19.4053 11.5303C19.2647 11.671 19.0739 11.75 18.875 11.75Z"
                                    fill="white" />
                                <path
                                    d="M18.875 14.75H12.875C12.6761 14.75 12.4853 14.671 12.3447 14.5303C12.204 14.3897 12.125 14.1989 12.125 14C12.125 13.8011 12.204 13.6103 12.3447 13.4697C12.4853 13.329 12.6761 13.25 12.875 13.25H18.875C19.0739 13.25 19.2647 13.329 19.4053 13.4697C19.546 13.6103 19.625 13.8011 19.625 14C19.625 14.1989 19.546 14.3897 19.4053 14.5303C19.2647 14.671 19.0739 14.75 18.875 14.75Z"
                                    fill="white" />
                                <path
                                    d="M18.875 17.75H12.875C12.6761 17.75 12.4853 17.671 12.3447 17.5303C12.204 17.3897 12.125 17.1989 12.125 17C12.125 16.8011 12.204 16.6103 12.3447 16.4697C12.4853 16.329 12.6761 16.25 12.875 16.25H18.875C19.0739 16.25 19.2647 16.329 19.4053 16.4697C19.546 16.6103 19.625 16.8011 19.625 17C19.625 17.1989 19.546 17.3897 19.4053 17.5303C19.2647 17.671 19.0739 17.75 18.875 17.75Z"
                                    fill="white" />
                            </svg>

                        </div>
                        قبوض
                    </a>
                </li>



                <li>
                    <a href="#">
                        <div class="icon-box bg_color_7">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_4355_15432)">
                                    <path
                                        d="M4.2248 7.60006L16.7592 0.603265C17.1297 0.396475 17.5672 0.345328 17.9754 0.461073C18.3836 0.576818 18.7292 0.849977 18.936 1.22047L20.146 3.38807C20.2362 3.54579 20.2691 3.72987 20.2391 3.90908C20.209 4.08828 20.1179 4.25158 19.9812 4.37127C19.5254 4.75969 19.1876 5.26814 19.0063 5.83888C18.8249 6.40962 18.8072 7.01978 18.9552 7.60006L18.8752 8.80007H4.0752L4.2248 7.60006Z"
                                        fill="#F7C331" />
                                    <path
                                        d="M21.2749 15.6001C21.275 16.3406 21.5317 17.0583 22.0014 17.6308C22.4711 18.2033 23.1247 18.5953 23.8509 18.7401C24.0286 18.7774 24.1879 18.875 24.3016 19.0165C24.4154 19.158 24.4766 19.3346 24.4749 19.5161V22.0001C24.4749 22.4244 24.3063 22.8314 24.0063 23.1315C23.7062 23.4315 23.2993 23.6001 22.8749 23.6001H2.8749C2.45056 23.6001 2.04359 23.4315 1.74353 23.1315C1.44347 22.8314 1.2749 22.4244 1.2749 22.0001V9.2001C1.2749 8.77575 1.44347 8.36879 1.74353 8.06873C2.04359 7.76867 2.45056 7.6001 2.8749 7.6001H22.8749C23.2993 7.6001 23.7062 7.76867 24.0063 8.06873C24.3063 8.36879 24.4749 8.77575 24.4749 9.2001V11.6841C24.4766 11.8656 24.4154 12.0422 24.3016 12.1837C24.1879 12.3251 24.0286 12.4228 23.8509 12.4601C23.1247 12.6049 22.4711 12.9969 22.0014 13.5694C21.5317 14.1419 21.275 14.8596 21.2749 15.6001Z"
                                        fill="#E5354B" />
                                    <path
                                        d="M18.4748 22.4V23.6H17.6748V22.4C17.6748 22.2939 17.7169 22.1922 17.792 22.1172C17.867 22.0421 17.9687 22 18.0748 22C18.1809 22 18.2826 22.0421 18.3576 22.1172C18.4327 22.1922 18.4748 22.2939 18.4748 22.4Z"
                                        fill="#C12748" />
                                    <path
                                        d="M18.0748 19.6001C17.9687 19.6001 17.867 19.6422 17.792 19.7173C17.7169 19.7923 17.6748 19.894 17.6748 20.0001V20.8001C17.6748 20.9062 17.7169 21.0079 17.792 21.0829C17.867 21.158 17.9687 21.2001 18.0748 21.2001C18.1809 21.2001 18.2826 21.158 18.3576 21.0829C18.4327 21.0079 18.4748 20.9062 18.4748 20.8001V20.0001C18.4748 19.894 18.4327 19.7923 18.3576 19.7173C18.2826 19.6422 18.1809 19.6001 18.0748 19.6001Z"
                                        fill="#C12748" />
                                    <path
                                        d="M18.0748 17.2002C17.9687 17.2002 17.867 17.2423 17.792 17.3174C17.7169 17.3924 17.6748 17.4941 17.6748 17.6002V18.4002C17.6748 18.5063 17.7169 18.608 17.792 18.683C17.867 18.7581 17.9687 18.8002 18.0748 18.8002C18.1809 18.8002 18.2826 18.7581 18.3576 18.683C18.4327 18.608 18.4748 18.5063 18.4748 18.4002V17.6002C18.4748 17.4941 18.4327 17.3924 18.3576 17.3174C18.2826 17.2423 18.1809 17.2002 18.0748 17.2002Z"
                                        fill="#C12748" />
                                    <path
                                        d="M18.0748 14.8003C17.9687 14.8003 17.867 14.8424 17.792 14.9174C17.7169 14.9925 17.6748 15.0942 17.6748 15.2003V16.0003C17.6748 16.1064 17.7169 16.2081 17.792 16.2831C17.867 16.3582 17.9687 16.4003 18.0748 16.4003C18.1809 16.4003 18.2826 16.3582 18.3576 16.2831C18.4327 16.2081 18.4748 16.1064 18.4748 16.0003V15.2003C18.4748 15.0942 18.4327 14.9925 18.3576 14.9174C18.2826 14.8424 18.1809 14.8003 18.0748 14.8003Z"
                                        fill="#C12748" />
                                    <path
                                        d="M18.0748 12.3999C17.9687 12.3999 17.867 12.442 17.792 12.5171C17.7169 12.5921 17.6748 12.6938 17.6748 12.7999V13.5999C17.6748 13.706 17.7169 13.8077 17.792 13.8827C17.867 13.9578 17.9687 13.9999 18.0748 13.9999C18.1809 13.9999 18.2826 13.9578 18.3576 13.8827C18.4327 13.8077 18.4748 13.706 18.4748 13.5999V12.7999C18.4748 12.6938 18.4327 12.5921 18.3576 12.5171C18.2826 12.442 18.1809 12.3999 18.0748 12.3999Z"
                                        fill="#C12748" />
                                    <path
                                        d="M18.0748 10C17.9687 10 17.867 10.0421 17.792 10.1172C17.7169 10.1922 17.6748 10.2939 17.6748 10.4V11.2C17.6748 11.3061 17.7169 11.4078 17.792 11.4828C17.867 11.5579 17.9687 11.6 18.0748 11.6C18.1809 11.6 18.2826 11.5579 18.3576 11.4828C18.4327 11.4078 18.4748 11.3061 18.4748 11.2V10.4C18.4748 10.2939 18.4327 10.1922 18.3576 10.1172C18.2826 10.0421 18.1809 10 18.0748 10Z"
                                        fill="#C12748" />
                                    <path
                                        d="M18.4748 7.6001V8.8001C18.4748 8.90618 18.4327 9.00793 18.3576 9.08294C18.2826 9.15796 18.1809 9.2001 18.0748 9.2001C17.9687 9.2001 17.867 9.15796 17.792 9.08294C17.7169 9.00793 17.6748 8.90618 17.6748 8.8001V7.6001H18.4748Z"
                                        fill="#C12748" />
                                    <path
                                        d="M5.67482 20.8002C5.59572 20.8001 5.5184 20.7767 5.45263 20.7327C5.38687 20.6888 5.33561 20.6263 5.30535 20.5532C5.27508 20.4801 5.26716 20.3997 5.28258 20.3222C5.29801 20.2446 5.33609 20.1733 5.39202 20.1174L14.192 11.3174C14.2675 11.2445 14.3685 11.2042 14.4734 11.2051C14.5783 11.206 14.6786 11.2481 14.7527 11.3222C14.8269 11.3964 14.869 11.4967 14.8699 11.6016C14.8708 11.7065 14.8305 11.8075 14.7576 11.883L5.95762 20.683C5.88262 20.758 5.7809 20.8001 5.67482 20.8002Z"
                                        fill="white" />
                                    <path
                                        d="M7.2749 15.2002C6.87934 15.2002 6.49266 15.0829 6.16376 14.8631C5.83486 14.6434 5.57852 14.331 5.42714 13.9656C5.27577 13.6001 5.23616 13.198 5.31333 12.81C5.3905 12.4221 5.58098 12.0657 5.86069 11.786C6.14039 11.5063 6.49676 11.3158 6.88472 11.2386C7.27268 11.1615 7.67482 11.2011 8.04027 11.3524C8.40572 11.5038 8.71808 11.7602 8.93784 12.0891C9.15761 12.418 9.2749 12.8046 9.2749 13.2002C9.27427 13.7304 9.06335 14.2388 8.68842 14.6137C8.31348 14.9886 7.80514 15.1996 7.2749 15.2002ZM7.2749 12.0002C7.03757 12.0002 6.80556 12.0706 6.60822 12.2024C6.41088 12.3343 6.25707 12.5217 6.16625 12.741C6.07542 12.9602 6.05166 13.2015 6.09796 13.4343C6.14426 13.6671 6.25855 13.8809 6.42638 14.0487C6.5942 14.2165 6.80802 14.3308 7.0408 14.3771C7.27357 14.4234 7.51485 14.3997 7.73412 14.3089C7.95339 14.218 8.14081 14.0642 8.27267 13.8669C8.40452 13.6695 8.4749 13.4375 8.4749 13.2002C8.4749 12.8819 8.34848 12.5767 8.12343 12.3517C7.89839 12.1266 7.59316 12.0002 7.2749 12.0002Z"
                                        fill="white" />
                                    <path
                                        d="M12.875 20.7998C12.4794 20.7998 12.0928 20.6825 11.7639 20.4627C11.435 20.243 11.1786 19.9306 11.0272 19.5652C10.8759 19.1997 10.8363 18.7976 10.9134 18.4096C10.9906 18.0217 11.1811 17.6653 11.4608 17.3856C11.7405 17.1059 12.0969 16.9154 12.4848 16.8382C12.8728 16.7611 13.2749 16.8007 13.6404 16.952C14.0058 17.1034 14.3182 17.3598 14.5379 17.6887C14.7577 18.0176 14.875 18.4042 14.875 18.7998C14.8744 19.33 14.6634 19.8384 14.2885 20.2133C13.9136 20.5883 13.4052 20.7992 12.875 20.7998ZM12.875 17.5998C12.6377 17.5998 12.4057 17.6702 12.2083 17.802C12.011 17.9339 11.8572 18.1213 11.7663 18.3406C11.6755 18.5599 11.6518 18.8011 11.6981 19.0339C11.7444 19.2667 11.8586 19.4805 12.0265 19.6483C12.1943 19.8162 12.4081 19.9304 12.6409 19.9767C12.8737 20.0231 13.1149 19.9993 13.3342 19.9085C13.5535 19.8176 13.7409 19.6638 13.8728 19.4665C14.0046 19.2692 14.075 19.0371 14.075 18.7998C14.075 18.4815 13.9486 18.1763 13.7235 17.9513C13.4985 17.7262 13.1933 17.5998 12.875 17.5998Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_4355_15432">
                                        <rect width="24" height="24" fill="white" transform="translate(0.875)" />
                                    </clipPath>
                                </defs>
                            </svg>

                        </div>
                        دیگر
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="mt-5 mb-9">
        <div class="tf-container">
            <div class="tf-title d-flex justify-content-between">
                <h3 class="fw_6">فروشگاه </h3>
                <a href="#" class="primary_color fw_6 btn-repicient">مشاهده همه</a>
            </div>
            <div class="mt-3">
                <div class="swiper-container recipient-tes">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#">
                                <img src="./images/shop (1).jpg" alt="images">
                                فروشگاه 1
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#">
                                <img src="./images/shop (1)11.jpg" alt="images">
                                فروشگاه 2
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#">
                                <img src="./images/shop (144).jpg" alt="images">
                                فروشگاه 3
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#l">
                                <img src="./images/shop (2).jpg" alt="images">
                                فروشگاه 4
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#">
                                <img src="./images/shop (69872).jpg" alt="images">
                                فروشگاه 5
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#">
                                <img src="./images/shop (2222).jpg" alt="images">
                                فروشگاه 6
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#">
                                <img src="./images/shop (2df).jpg" alt="images">
                                فروشگاه 7
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#l">
                                <img src="./images/shop (3).jpg" alt="images">
                                فروشگاه 8
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#l">
                                <img src="./images/shop (3).png" alt="images">
                                فروشگاه 9
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#">
                                <img src="./images/shop (3777).jpg" alt="images">
                                فروشگاه 10
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#">
                                <img src="./images/shop (44441).jpg" alt="images">
                                فروشگاه 11
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#">
                                <img src="./images/shop (4543).jpg" alt="images">
                                فروشگاه 12
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="recipient-box btn-repicient" href="#l">
                                <img src="./images/shop (dfh1).jpg" alt="images">
                                فروشگاه 13
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="swiper-container banner-tes">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="./images/banner4.jpg" alt="images">
                        </div>
                        <div class="swiper-slide">
                            <img src="./images/banner2.jpg" alt="images">
                        </div>
                        <div class="swiper-slide">
                            <img src="./images/banner3.jpg" alt="images">
                        </div>
                        <div class="swiper-slide">
                            <img src="./images/banner.jpg" alt="images">
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="bottom-navigation-bar">
        <div class="tf-container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php"><i
                            class="icon-user-outline"></i> پروفایل</a> </li>

                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="#"><i
                            class="icon-history"></i> سوابق</a> </li>
                <li>
                    <a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="#">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 11V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V11"
                                stroke="#717171" stroke-width="1.5" stroke-linecap="round" />
                            <path
                                d="M3.5 7L5.05335 3.7236C5.18965 3.3912 5.51059 3.16667 5.86852 3.16667H18.1315C18.4894 3.16667 18.8104 3.3912 18.9466 3.7236L20.5 7"
                                stroke="#717171" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M9 11V15C9 16.1046 9.89543 17 11 17H13C14.1046 17 15 16.1046 15 15V11"
                                stroke="#717171" stroke-width="1.5" stroke-linecap="round" />
                            <circle cx="9" cy="7" r="1" fill="#717171" />
                            <circle cx="15" cy="7" r="1" fill="#717171" />
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

                <li class="active"><a class="fw_6 d-flex justify-content-center align-items-center flex-column"
                        href="dashboard.php"><i class="icon-home2"></i> خانه</a> </li>
            </ul>
            <!-- <span class="line"></span> -->
        </div>
    </div>




    <div class="modal fade" id="modalhome1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="heading">
                    <h4 class="fw_6 text-center">
                        اپلیکیشن BMPL اجازه ارسال پیام می خواهد
                    </h4>
                    <p class="fw_4 mt-2 text-center">پیام ها شامل اخبارها ، نکته ها ، تخفیفات .....</p>
                </div>
                <div class="bottom">
                    <a href="#" class="secondary_color btn-hide-modal" data-dismiss="modal" aria-label="Close">اجازه
                        نیست
                    </a>
                    <a href="#" class="primary_color btn-hide-modal" data-toggle="modal" data-target="#modalhome2"
                        data-dismiss="modal" aria-label="Close"> اجازه هست</a>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="tf-panel up">
        <div class="panel-box panel-up panel-noti">
            <div class="header is-fixed">
                <div class="tf-container">
                    <div class="tf-statusbar d-flex justify-content-center align-items-center">
                        <a href="#" class="clear-panel"> <i class="icon-left"></i> </a>
                        <h3>پیام ها</h3>
                    </div>
                </div>
            </div>
            <div id="app-wrap" class="style1">
                <div class="tf-container">
                    <div class="tf-tab mt-3">
                        <div class="swiper-container tes-noti">
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
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 4H2C1.44772 4 1 4.44772 1 5V13C1 13.5523 1.44772 14 2 14H14C14.5523 14 15 13.5523 15 13V5C15 4.44772 14.5523 4 14 4Z"
                                                stroke="#9C27B0" stroke-width="1.5" />
                                            <path d="M4 7H6" stroke="#9C27B0" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M8 7H12" stroke="#9C27B0" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M4 10H6" stroke="#9C27B0" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M8 10H12" stroke="#9C27B0" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div class="content-right">
                                        <div class="title">
                                            <h3 class="fw_6">به روزرسانی سامانه</h3>
                                            <span class="fw_6 text-info">اطلاعیه</span>
                                        </div>
                                        <div class="desc">
                                            <p class="on_surface_color fw_4">نسخه جدید اپلیکیشن منتشر شد. لطفاً
                                                بروزرسانی کنید</p>
                                            <span class="time">2 روز پیش</span>
                                            <i class="dot"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="noti-box">
                                <div class="noti-list">
                                    <div class="icon-box bg_service-3">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 11L5 13V9L3 7L5.5 6.5L7 4L8 6L10 4L11.5 6.5L14 7L12 9V13L8 11Z"
                                                stroke="#FF9800" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="content-right">
                                        <div class="title">
                                            <h3 class="fw_6">امتیاز جدید</h3>
                                            <span class="fw_6 text-warning">پاداش</span>
                                        </div>
                                        <div class="desc">
                                            <p class="on_surface_color fw_4">برای خرید قبلی ۱۵۰ امتیاز دریافت کردید</p>
                                            <span class="time">دیروز</span>
                                            <i class="dot"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- پیام 1 - مالی -->
                            <div class="noti-box">
                                <div class="noti-list">
                                    <div class="icon-box bg_service-1">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 4H2C1.44772 4 1 4.44772 1 5V13C1 13.5523 1.44772 14 2 14H14C14.5523 14 15 13.5523 15 13V5C15 4.44772 14.5523 4 14 4Z"
                                                stroke="#4CAF50" stroke-width="1.5" />
                                            <path d="M1 7H15" stroke="#4CAF50" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M4 10H5" stroke="#4CAF50" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M7 10H8" stroke="#4CAF50" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div class="content-right">
                                        <div class="title">
                                            <h3 class="fw_6">واریز وجه موفق</h3>
                                            <span class="fw_6 text-success">جدید</span>
                                        </div>
                                        <div class="desc">
                                            <p class="on_surface_color fw_4">مبلغ ۲۵۰,۰۰۰ تومان به حساب شما واریز شد</p>
                                            <span class="time">10 دقیقه پیش</span>
                                            <i class="dot"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- پیام 2 - خدمات -->
                            <div class="noti-box">
                                <div class="noti-list">
                                    <div class="icon-box bg_service-2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z"
                                                stroke="#2196F3" stroke-width="1.5" />
                                            <path d="M8 5V8L10 9" stroke="#2196F3" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div class="content-right">
                                        <div class="title">
                                            <h3 class="fw_6">نوبت شما رسید</h3>
                                            <span class="fw_6 text-primary">مهم</span>
                                        </div>
                                        <div class="desc">
                                            <p class="on_surface_color fw_4">نوبت خدمات فنی شما برای فردا ساعت ۱۰ صبح
                                                تنظیم شد</p>
                                            <span class="time">1 ساعت پیش</span>
                                            <i class="dot"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- پیام 3 - امتیاز -->



                            <!-- پیام 5 - عمومی -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tf-panel down">
        <div class="panel_overlay"></div>
        <div class="panel-box panel-down">
            <div class="header bg_white_color">
                <div class="tf-container">
                    <div class="tf-statusbar d-flex justify-content-center align-items-center">
                        <a href="#" class="clear-panel"> <i class="icon-close1"></i> </a>
                        <h3>تراکنش</h3>
                        <a href="#" class="action-right"><i class="icon-qrcode4"></i></a>
                    </div>
                </div>
            </div>
            <div class="wrap-transfer mb-5">
                <div class="tf-container">
                    <!-- پرداخت قسط -->
                    <a href="#" class="action-sheet-transfer">
                        <div class="icon"><i class="icon-wallet"></i></div>
                        <div class="content">
                            <h4 class="fw_6">پرداخت قسط</h4>
                            <p>مدیریت اقساط پرداختی</p>
                        </div>
                    </a>

                    <!-- معوقه -->
                    <a href="#" class="action-sheet-transfer">
                        <div class="icon"><i class="icon-alert-triangle"></i></div>
                        <div class="content">
                            <h4 class="fw_6">معوقه</h4>
                            <p>بررسی بدهی‌های سررسید گذشته</p>
                        </div>
                    </a>

                    <!-- پاداش -->
                    <a href="#" class="action-sheet-transfer">
                        <div class="icon"><i class="icon-gift"></i></div>
                        <div class="content">
                            <h4 class="fw_6">پاداش</h4>
                            <p>دریافت جوایز و امتیازات</p>
                        </div>
                    </a>

                    <!-- خرید -->
                    <a href="#" class="action-sheet-transfer">
                        <div class="icon"><i class="icon-cart"></i></div>
                        <div class="content">
                            <h4 class="fw_6">خرید</h4>
                            <p>سوابق خریدهای انجام‌شده</p>
                        </div>
                    </a>

                    <!-- بازگشت پول -->
                    <a href="#" class="action-sheet-transfer">
                        <div class="icon"><i class="icon-undo2"></i></div>
                        <div class="content">
                            <h4 class="fw_6">بازگشت پول</h4>
                            <p>مشاهده مبالغ برگشتی</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>

    <div class="tf-panel card-popup">
        <div class="panel_overlay"></div>
        <div class="panel-box panel-down">
            <div class="header">
                <div class="tf-container">
                    <div class="tf-statusbar d-flex justify-content-center align-items-center">
                        <a href="#" class="clear-panel"> <i class="icon-left"></i> </a>
                        <h3>مدیریت کارت ها</h3>
                    </div>
                </div>
            </div>
            <div class="content-card mt-3 mb-5">
                <div class="tf-container">
                    <div class="tf-card-list bg_surface_color large out-line">

                        <div class="info">
                            <h4 class="fw_6"><a href="#">صادرات</a></h4>
                            <p>**** **** **** 7576</p>
                        </div>
                        <input type="checkbox" class="tf-checkbox circle-check" checked>
                    </div>
                    <p class="auth-line">انتخاب کارت های دیگر</p>

                    <div class="tf-spacing-20"></div>
                    <a href="#" class="tf-btn large">افزودن کارت <i class="icon-plus fw_7"></i> </a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var qrModal = document.getElementById('qrModal');

            qrModal.addEventListener('shown.bs.modal', function () {
                // حذف QR قبلی برای جلوگیری از تکرار
                document.getElementById('qrcode').innerHTML = "";

                // مقدار QR (اینجا می‌تونی لینک یا اطلاعات کارت یا نام کاربری بذاری)
                var qrData = "https://example.com/user/12345";

                // تولید QR
                new QRCode(document.getElementById("qrcode"), {
                    text: qrData,
                    width: 200,
                    height: 200
                });
            });
        });
    </script>



    <script type="text/javascript" src="./assets/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/bootstrap.min.js"></script>
    <script type="text/javascript" src="./assets/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="./assets/swiper.js"></script>
    <script type="text/javascript" src="./assets/main.js"></script>
    <script type="text/javascript" src="./assets/js/qrcode.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>



</body>

</html>