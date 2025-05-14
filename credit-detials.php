<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات اعتبار</title>
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
            background-color: #f5f7fa;
        }

        .credit-card {
            border-radius: 1rem;
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
            background: white;
            overflow: hidden;
        }

        .credit-header {
            background: linear-gradient(135deg, #0d6efd, #3c9bfd);
            color: white;
            padding: 1.5rem;
            border-radius: 1rem 1rem 0 0;
        }

        .credit-header h4 {
            margin: 0;
        }

        .balance-box {
            background-color: #f8f9fa;
            padding: 1.25rem;
            border-radius: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            box-shadow: inset 0 0 0.25rem rgba(0, 0, 0, 0.05);
        }

        .installment-box {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.2s ease-in-out;
        }

        .installment-box:hover {
            background-color: #f1f9ff;
            border-color: #b6d4fe;
        }

        .alert-info {
            border-radius: 0.75rem;
            font-weight: 500;
            text-align: center;
        }

        .installment-box h5 {
            display: flex;
            align-items: center;
        }

        .installment-box h5::before {
            content: "💳";
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="credit-card">
            <div class="credit-header">
                <h4>جزئیات اعتبار</h4>
            </div>
            <div class="p-4">
                <div class="balance-box">
                    <div>
                        <div class="text-muted">باقی‌مانده اعتبار</div>
                        <div class="text-success fw-bold fs-4">۱۳,۵۵۷,۹۱۱ تومان</div>
                    </div>
                    <div class="text-end">
                        <div class="text-muted">کل اعتبار</div>
                        <div class="fw-bold fs-6">۲۰,۰۰۰,۰۰۰ تومان</div>
                    </div>
                </div>

                <h5 class="mb-3 fw-bold">چطور از اعتبار BNPL استفاده کنم؟</h5>
                <p class="text-muted mb-4">می‌توانید با اعتبارتان از فروشگاه‌های حاضر در BNPL به‌صورت آنلاین یا حضوری خرید کرده و با یکی از روش‌های زیر تسویه کنید:</p>

                <div class="installment-box">
                    <h5 class="fw-bold mb-2">پرداخت قسطی</h5>
                    <p class="mb-1 text-muted">تا سقف اعتبار</p>
                    <p>هزینه خرید شما به ۴ قسط تقسیم می‌شود. یک قسط را هنگام خرید و ۳ قسط دیگر را در ۳ ماه آینده پرداخت می‌کنید.</p>
                </div>

                <div class="installment-box">
                    <h5 class="fw-bold mb-2">پرداخت آخر ماه</h5>
                    <p class="mb-1 text-muted">تا سقف اعتبار</p>
                    <p>در این روش، مبلغ خریدهایتان را در پایان همان ماه، به‌صورت بدهی ماهانه تسویه می‌کنید.</p>
                </div>

                <div class="alert alert-info mt-4">
                    اعتبار شما فقط در فروشگاه‌های عضو BNPL قابل استفاده است.
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
              <path d="M3 11V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V11" stroke="#717171"
                stroke-width="1.5" stroke-linecap="round" />
              <path
                d="M3.5 7L5.05335 3.7236C5.18965 3.3912 5.51059 3.16667 5.86852 3.16667H18.1315C18.4894 3.16667 18.8104 3.3912 18.9466 3.7236L20.5 7"
                stroke="#717171" stroke-width="1.5" stroke-linecap="round" />
              <path d="M9 11V15C9 16.1046 9.89543 17 11 17H13C14.1046 17 15 16.1046 15 15V11" stroke="#717171"
                stroke-width="1.5" stroke-linecap="round" />
              <circle cx="9" cy="7" r="1" fill="#717171" />
              <circle cx="15" cy="7" r="1" fill="#717171" />
            </svg>
            <span class="mt-1">فروشگاه</span>
          </a>
        </li>
        <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="#"><svg width="25"
              height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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