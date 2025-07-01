<?php session_unset(); ?>
<!DOCTYPE HTML>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>BNPL | ورود به سامانه</title>

    <link rel="preload" href="./assets/css/bootstrap.rtl.min.css" as="style">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">




    <link href="./assets/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="./assets/css/iw.css" rel="stylesheet">

</head>

<body>
    <div id="preloader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">در حال بارگذاری...</span>
        </div>
    </div>

    <div class="container">
        <div class="login-card">
            <div class="logo-container">
                <img src="./assets/icons/android-icon-192.png" alt="BNPL Logo">
            </div>

            <div class="form-container">
                <h1 class="text-center">ورود به سامانه</h1>
                <p class="text-center text-muted">لطفاً شماره موبایل خود را وارد کنید</p>

                <form id="loginForm" novalidate>
                    <div class="input-field">
                        <label for="phoneNumber">شماره موبایل</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" maxlength="11" minlength="11"
                            pattern="09[0-9]{9}" placeholder="مثال: 09123456789" required>
                        <div class="error-message" id="phoneError">شماره موبایل باید 11 رقمی و با 09 شروع شود.</div>
                    </div>

                    <div class="terms-checkbox">
                        <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                        <label for="agreeTerms">با ورود، با کلیه قوانین و مقررات موافقم</label>
                    </div>

                    <input type="hidden" name="scode" id="scode" value="">

                    <button type="submit" id="submitBtn" class="submit-btn" disabled>
                        دریافت کد ورود
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/iw.js"></script>
</body>

</html>