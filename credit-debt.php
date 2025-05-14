<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بدهی‌ها</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/animate.min.css">
    <link rel="stylesheet" href="./assets/fonts.css" />
    <link rel="stylesheet" href="./assets/icons-alipay.css">
    <link rel="stylesheet" href="./assets/bootstrap.css">
    <link rel="stylesheet" href="./assets/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/styles.css" />
    <style>
        body {
            background-color: #f1f3f5;
            font-family: "IRANSans", sans-serif;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .debt-header {
            background-color: #ffffff;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .debt-item {
            background-color: #fff;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .debt-item:last-child {
            border-bottom: none;
        }

        .debt-title {
            font-weight: 700;
            font-size: 1.0rem;
        }

        .debt-meta {
            font-size: 0.7rem;
            color: #6c757d;
        }

        .payment-section {
            background-color: #ffffff;
            padding: 1.5rem;
            margin-top: 1rem;
            border-radius: 0.75rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.03);
        }

        .deadline-text {
            color: #dc3545;
            font-weight: bold;
        }

        .bottom-navigation-bar {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #fff;
            border-top: 1px solid #dee2e6;
            z-index: 1000;
        }

        .tf-navigation-bar {
            display: flex;
            justify-content: space-around;
            padding: 0.5rem 0;
            list-style: none;
            margin: 0;
        }

        .tf-navigation-bar li a {
            text-decoration: none;
            color: #444;
            font-size: 0.85rem;
        }

        .tf-navigation-bar li a.active {
            color: #007bff;
        }

        .amount {
            font-size: 0.9rem;
            color: #28a745;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="container py-4 mb-5">
        <div class="card shadow">
            <div class="debt-header">
                <h4 class="mb-0">لیست بدهی‌ها</h4>
            </div>

            <div class="debt-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="debt-title">اعتبار بانکی</div>
                        <div class="debt-meta">تاریخ: ۱۴۰۳/۰۲/۱۰</div>
                    </div>
                    <div class="amount">۱,۲۰۰,۰۰۰ تومان</div>
                </div>
            </div>

            <div class="debt-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="debt-title">خدمات اینترنت</div>
                        <div class="debt-meta">تاریخ: ۱۴۰۳/۰۲/۱۵</div>
                    </div>
                    <div class="amount">۵۵۰,۰۰۰ تومان</div>
                </div>
            </div>

            <div class="debt-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="debt-title">خرید از فروشگاه</div>
                        <div class="debt-meta">تاریخ: ۱۴۰۳/۰۲/۲۰</div>
                    </div>
                    <div class="amount">۶۷۰,۵۵۰ تومان</div>
                </div>
            </div>

            <div class="p-3">
                <p class="deadline-text mb-3">مهلت پرداخت: تا پایان روز ۳۰ ماه</p>
                <hr>

                <div class="payment-section">
                    <h5 class="fw-bold mb-3">پرداخت</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>مبلغ کل قابل پرداخت:</span>
                        <span class="amount">۲,۴۲۰,۵۵۰ تومان</span>
                    </div>
                    <button class="btn btn-primary w-100 mt-3 py-2">پرداخت آنلاین</button>
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

                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column" href="dashboard.php"><i
                            class="icon-home"></i> خانه</a> </li>
            </ul>
            <!-- <span class="line"></span> -->
        </div>
    </div>
    <script src="./assets/jquery.min.js"></script>
    <script src="./assets/bootstrap.min.js"></script>
    <script src="./assets/swiper-bundle.min.js"></script>
    <script src="./assets/swiper.js"></script>
    <script src="./assets/main.js"></script>
    <script src="./assets/js/qrcode.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>