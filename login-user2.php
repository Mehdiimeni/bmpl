<!DOCTYPE HTML>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>BNPL | ورود به سامانه</title>

    <link rel="preload" href="./assets/css/bootstrap.rtl.min.css" as="style">
    <link rel="preload" href="./assets/fonts/Vazirmatn-Regular.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">

    <link href="./assets/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        /* CSS Variables for theming */
        :root {
            --primary-color: #2196F3;
            --primary-dark: #1976D2;
            --secondary-color: #4CAF50;
            --error-color: #F44336;
            --background-light: #f0f2f5;
            --card-background: #ffffff;
            --text-color-dark: #333;
            --text-color-light: #777;
            --shadow-light: rgba(0, 0, 0, 0.08);
            --shadow-medium: rgba(0, 0, 0, 0.15);
            --border-color: #e0e0e0;
        }


        .container {
            width: 100%;
            max-width: 100%;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        /* Dark mode adjustments */
        @media (prefers-color-scheme: dark) {
            :root {
                --background-light: #1a1a1a;
                --card-background: #2b2b2b;
                --text-color-dark: #e0e0e0;
                --text-color-light: #a0a0a0;
                --shadow-light: rgba(0, 0, 0, 0.3);
                --shadow-medium: rgba(0, 0, 0, 0.5);
                --border-color: #3a3a3a;
            }
        }

        /* Vazirmatn Font Import (ensure font files are in ./assets/fonts/) */
        @font-face {
            font-family: 'Vazirmatn';
            src: url('./assets/fonts/Vazirmatn-Regular.woff2') format('woff2');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Vazirmatn';
            src: url('./assets/fonts/Vazirmatn-Bold.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }

        body {
            background-color: var(--background-light);
            font-family: 'Vazirmatn', sans-serif;
            color: var(--text-color-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--background-light);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
            opacity: 1;
        }

        #preloader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.3em;
            color: var(--primary-color) !important;
        }

        .login-card {
            background-color: var(--card-background);
            max-width: 450px;
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 12px 30px var(--shadow-medium);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            animation: fadeInScale 0.8s ease-out forwards;
        }

        .logo-container {
            background-color: var(--primary-color);
            padding: 1rem 0;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideInFromTop 0.7s ease-out forwards;
        }

        .logo-container img {
            height: 90px;
            width: auto;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .form-container {
            padding: 2.5rem;
        }

        h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.8rem;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }

        p.text-muted {
            font-size: 1.1rem;
            color: var(--text-color-light) !important;
            margin-bottom: 2.5rem;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.3s;
            opacity: 0;
        }

        .input-field {
            margin-bottom: 2rem;
            position: relative;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }

        .input-field label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 600;
            color: var(--text-color-dark);
            font-size: 1rem;
        }

        .input-field input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background-color: var(--card-background);
            color: var(--text-color-dark);
        }

        .input-field input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(33, 150, 243, 0.25);
            outline: none;
        }

        .input-field input.is-invalid {
            border-color: var(--error-color);
            box-shadow: 0 0 0 4px rgba(244, 67, 54, 0.2);
        }

        .input-field input.is-valid {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.2);
        }

        .input-field .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: none;
            animation: fadeIn 0.3s ease-out;
        }

        .terms-checkbox {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.5s;
            opacity: 0;
        }

        .terms-checkbox input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 22px;
            height: 22px;
            border: 2px solid var(--border-color);
            border-radius: 6px;
            margin-left: 12px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .terms-checkbox input[type="checkbox"]:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .terms-checkbox input[type="checkbox"]:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 16px;
            font-weight: bold;
        }

        .terms-checkbox label {
            font-size: 1rem;
            color: var(--text-color-dark);
            cursor: pointer;
            margin-bottom: 0;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.6s;
            opacity: 0;
        }

        .submit-btn:disabled {
            background-color: #cccccc;
            box-shadow: none;
            cursor: not-allowed;
            color: #999999;
        }

        .submit-btn:hover:not(:disabled) {
            background-color: var(--primary-dark);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
            transform: translateY(-2px);
        }

        /* General Animations */
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                margin: 1rem auto;
                border-radius: 15px;
            }

            .form-container {
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.8rem;
            }

            p.text-muted {
                font-size: 1rem;
            }

            .input-field input {
                padding: 12px 15px;
                font-size: 1rem;
            }

            .submit-btn {
                padding: 12px;
                font-size: 1.1rem;
            }

            body {
                background-color: var(--background-light);
                font-family: 'Vazirmatn', sans-serif;
                color: var(--text-color-dark);
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
                padding: 20px;
                box-sizing: border-box;
                text-rendering: optimizeLegibility;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                overflow-x: hidden;
            }

            .login-card {
                background-color: var(--card-background);
                max-width: 450px;
                width: 100%;
                border-radius: 20px;
                box-shadow: 0 12px 30px var(--shadow-medium);
                overflow: hidden;
                display: flex;
                flex-direction: column;
                animation: fadeInScale 0.8s ease-out forwards;
                margin: 0 auto;
                /* این خط برای اطمینان از وسط چین شدن اضافه شد */
            }
        }
    </style>
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

                <form id="loginForm" action="pass-number2.php" method="post" novalidate>
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

                    <input type="hidden" name="scode" value="<?php echo random_int(100000, 999999); ?>">

                    <button type="submit" id="submitBtn" class="submit-btn" disabled>
                        دریافت کد ورود
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const phoneNumberInput = document.getElementById('phoneNumber');
            const phoneError = document.getElementById('phoneError');
            const agreeTermsCheckbox = document.getElementById('agreeTerms');
            const submitButton = document.getElementById('submitBtn');
            const preloader = document.getElementById('preloader');

            // Function to validate form inputs and enable/disable button
            function validateForm() {
                const phoneRegex = /^09[0-9]{9}$/;
                const isPhoneValid = phoneRegex.test(phoneNumberInput.value);
                const isTermsAgreed = agreeTermsCheckbox.checked;

                // Update phone input style and error message
                if (phoneNumberInput.value.length > 0 && !isPhoneValid) {
                    phoneNumberInput.classList.remove('is-valid');
                    phoneNumberInput.classList.add('is-invalid');
                    phoneError.style.display = 'block';
                } else if (isPhoneValid) {
                    phoneNumberInput.classList.remove('is-invalid');
                    phoneNumberInput.classList.add('is-valid');
                    phoneError.style.display = 'none';
                } else {
                    phoneNumberInput.classList.remove('is-valid', 'is-invalid');
                    phoneError.style.display = 'none';
                }

                // Enable/disable submit button
                submitButton.disabled = !(isPhoneValid && isTermsAgreed);
            }

            // Attach event listeners
            phoneNumberInput.addEventListener('input', validateForm);
            agreeTermsCheckbox.addEventListener('change', validateForm);

            // Initial validation call on page load to set initial button state
            validateForm();

            // Hide preloader after everything is loaded
            window.addEventListener('load', function () {
                preloader.classList.add('hidden');
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500); // Allow transition to complete
                window.scrollTo(0, 1); // Scroll to top for mobile browsers
            });
        });
    </script>
</body>

</html>