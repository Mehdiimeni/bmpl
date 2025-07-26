<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>کیف پول من</title>

  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
  <link rel="stylesheet" href="./assets/css/solid.min.css">
  <link rel="stylesheet" href="./assets/css/brands.min.css">
  <link rel="stylesheet" href="./assets/css/animate.min.css">
  <link rel="stylesheet" href="./assets/fonts.css" />
  <link rel="stylesheet" href="./assets/icons-alipay.css">
  <link rel="stylesheet" href="./assets/bootstrap.css">
  <link rel="stylesheet" href="./assets/swiper-bundle.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/styles.css" />

  <style>
    body {
      background-color: #f5f5f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding-bottom: 100px;
    }

    .wallet-container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }

    .wallet-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
      padding: 2rem;
      margin-bottom: 2rem;
    }

    .wallet-header {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .wallet-header img {
      width: 80px;
      margin-bottom: 1rem;
    }

    .wallet-header h2 {
      font-size: 22px;
      font-weight: bold;
      color: #333;
    }

    .wallet-info {
      margin-bottom: 1rem;
      padding: 0.8rem 1rem;
      border-radius: 8px;
      background-color: #f0f0f0;
      display: flex;
      justify-content: space-between;
    }

    .wallet-info label {
      font-weight: 600;
      color: #555;
    }

    .wallet-info .value {
      font-weight: bold;
      color: #333;
    }

    .repay-btn {
      margin-top: 2rem;
      width: 100%;
      background-color: #2196F3;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .repay-btn:hover {
      background-color: #1976d2;
    }

    .installments {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
      padding: 1.5rem;
    }

    .installments h4 {
      margin-bottom: 1rem;
      font-size: 18px;
      font-weight: bold;
    }

    .installments table {
      width: 100%;
      border-collapse: collapse;
    }

    .installments th,
    .installments td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }

    .installments th {
      background-color: #f8f8f8;
      font-weight: bold;
    }

    .badge-success {
      background-color: #4CAF50;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
    }

    .badge-warning {
      background-color: #FFC107;
      color: #333;
      padding: 5px 10px;
      border-radius: 5px;
    }

    .bottom-navigation-bar {
      position: fixed;
      bottom: 0;
      width: 100%;
      background: #fff;
      box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
      padding: 10px 0;
      z-index: 1000;
    }

    .tf-navigation-bar {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      justify-content: space-around;
    }

    .tf-navigation-bar li {
      flex: 1;
      text-align: center;
    }

    .tf-navigation-bar a {
      text-decoration: none;
      color: #555;
      font-size: 13px;
    }

    .tf-navigation-bar i,
    .tf-navigation-bar svg {
      font-size: 20px;
      margin-bottom: 5px;
    }
  </style>
</head>

<body>

  <div class="wallet-container">
    <div class="wallet-card">
      <div class="wallet-header">
        <img src="./assets/icons/android-icon-192.png" alt="BNPL Logo">
        <h2>کیف پول من</h2>
      </div>

      <div class="wallet-info">
        <label>اعتبار باقی‌مانده:</label>
        <span class="value">۵۰۰٬۰۰۰ ریال</span>
      </div>

      <div class="wallet-info">
        <label>اعتبار مصرف‌شده (۱ تا ۳۰):</label>
        <span class="value">۱٬۲۰۰٬۰۰۰ ریال</span>
      </div>

      <div class="wallet-info">
        <label>باقی‌مانده + جریمه:</label>
        <span class="value">۷۰۰٬۰۰۰ ریال</span>
      </div>

      <button class="repay-btn">بازپرداخت</button>
    </div>

    <div class="installments">
      <h4>ریز پرداختی‌های اقساط</h4>
      <table>
        <thead>
          <tr>
            <th>تاریخ</th>
            <th>مبلغ</th>
            <th>وضعیت</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>۱۴۰۳/۰۲/۰۱</td>
            <td>۴۰۰٬۰۰۰ ریال</td>
            <td><span class="badge-success">پرداخت‌شده</span></td>
          </tr>
          <tr>
            <td>۱۴۰۳/۰۲/۱۵</td>
            <td>۴۰۰٬۰۰۰ ریال</td>
            <td><span class="badge-success">پرداخت‌شده</span></td>
          </tr>
          <tr>
            <td>۱۴۰۳/۰۳/۰۱</td>
            <td>۴۰۰٬۰۰۰ ریال</td>
            <td><span class="badge-warning">در انتظار</span></td>
          </tr>
        </tbody>
      </table>
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