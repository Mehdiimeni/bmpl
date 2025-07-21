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
    <title>BNPL | تأیید کد فعال‌سازی</title>

    <link rel="preload" href="./assets/css/bootstrap.rtl.min.css" as="style">
    <link rel="preload" href="./assets/fonts/Vazirmatn-Regular.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">

    <link href="./assets/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        /* CSS Variables for theming */
        :root {
            --primary-color: #2196F3;
            /* Bright Blue */
            --primary-dark: #1976D2;
            /* Darker Blue for hover/active */
            --secondary-color: #4CAF50;
            /* Green for success/positive feedback */
            --error-color: #F44336;
            /* Red for errors */
            --background-light: #f0f2f5;
            /* Light grey background */
            --card-background: #ffffff;
            /* White card background */
            --text-color-dark: #333;
            /* Dark grey text */
            --text-color-light: #777;
            /* Lighter grey text */
            --shadow-light: rgba(0, 0, 0, 0.08);
            /* Light shadow */
            --shadow-medium: rgba(0, 0, 0, 0.15);
            /* Medium shadow */
            --border-color: #e0e0e0;
            /* Light border */
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

        .verification-card {
            background-color: var(--card-background);
            max-width: 450px;
            width: 100%;
            border-radius: 20px;
            /* More rounded corners */
            box-shadow: 0 12px 30px var(--shadow-medium);
            /* Deeper, softer shadow */
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

        h2 {
            font-size: 2.2rem;
            /* Larger title */
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
            font-size: 1.5rem;
            /* Larger font for code input */
            text-align: center;
            letter-spacing: 0.5rem;
            /* More spacing for digits */
            transition: all 0.3s ease;
            background-color: var(--card-background);
            color: var(--text-color-dark);
            font-weight: 700;
            /* Bold numbers */
        }

        /* Adjust placeholder for better visual */
        .input-field input::placeholder {
            color: var(--text-color-light);
            letter-spacing: normal;
            /* Reset for placeholder */
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
            animation-delay: 0.5s;
            /* Adjusted delay */
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

        .timer-container {
            text-align: center;
            margin: 1.5rem 0 2rem 0;
            /* More margin bottom */
            color: var(--text-color-light);
            font-size: 1rem;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.6s;
            /* Adjusted delay */
            opacity: 0;
        }

        .timer {
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1.2rem;
            /* Larger timer text */
            direction: ltr;
            /* Ensure timer displays LTR */
            display: inline-block;
            /* For proper spacing with text */
            margin-left: 5px;
            /* Space between text and timer */
        }

        .resend-link {
            color: var(--primary-color);
            text-decoration: none;
            cursor: pointer;
            font-weight: 600;
            display: block;
            /* Make it block to take full width */
            margin-top: 1rem;
            opacity: 0;
            /* Hidden initially */
            animation: fadeIn 0.5s ease-out forwards;
            animation-delay: 0.7s;
            transition: color 0.2s ease;
        }

        .resend-link:hover {
            text-decoration: underline;
            color: var(--primary-dark);
        }

        .resend-link.disabled {
            color: var(--text-color-light);
            cursor: not-allowed;
            text-decoration: none;
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
            .verification-card {
                margin: 1rem auto;
                border-radius: 15px;
            }

            .form-container {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.8rem;
            }

            p.text-muted {
                font-size: 1rem;
            }

            .input-field input {
                padding: 12px 15px;
                font-size: 1.2rem;
                letter-spacing: 0.4rem;
            }

            .submit-btn {
                padding: 12px;
                font-size: 1.1rem;
            }

            .timer {
                font-size: 1rem;
            }


        }

        .container {
            width: 100%;
            max-width: 100%;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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
    </style>
</head>

<body>
    <div id="preloader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">در حال بارگذاری...</span>
        </div>
    </div>

    <div class="container">
        <div class="verification-card">
            <div class="logo-container">
                <img src="./assets/icons/android-icon-192.png" alt="BNPL Logo">
            </div>

            <div class="form-container">
                <h2 class="text-center">تأیید کد فعال‌سازی</h2>
                <p class="text-center text-muted">کد 6 رقمی ارسال شده به شماره موبایل شما را وارد نمایید</p>

                <form id="verificationForm" action="credit-register.php" method="post" novalidate>
                    <div class="input-field">
                        <label for="activationCode">کد فعال‌سازی</label>
                        <input type="tel" id="activationCode" name="activationCode" maxlength="6" minlength="6"
                            pattern="[0-9]{6}" placeholder="------" required>
                        <div class="error-message" id="codeError">کد فعال‌سازی باید 6 رقم عددی باشد.</div>
                    </div>

                    <div class="timer-container">
                        <span>زمان باقی‌مانده: </span>
                        <span id="timer" class="timer">02:00</span>
                        <a href="javascript:void(0);" id="resendLink" class="resend-link disabled"
                            style="display: none;">ارسال مجدد کد</a>
                    </div>

                    <button type="submit" id="submitBtn" class="submit-btn" disabled>
                        ورود به سیستم
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const activationCodeInput = document.getElementById('activationCode');
            const codeError = document.getElementById('codeError');
            const submitButton = document.getElementById('submitBtn');
            const timerElement = document.getElementById('timer');
            const resendLink = document.getElementById('resendLink');
            const preloader = document.getElementById('preloader');

            let timeLeft = 120; // 2 minutes = 120 seconds
            let timerInterval;

            // Function to validate form inputs and enable/disable button
            function validateForm() {
                const codeRegex = /^[0-9]{6}$/;
                const isCodeValid = codeRegex.test(activationCodeInput.value);

                if (activationCodeInput.value.length > 0 && !isCodeValid) {
                    activationCodeInput.classList.remove('is-valid');
                    activationCodeInput.classList.add('is-invalid');
                    codeError.style.display = 'block';
                } else if (isCodeValid) {
                    activationCodeInput.classList.remove('is-invalid');
                    activationCodeInput.classList.add('is-valid');
                    codeError.style.display = 'none';
                } else {
                    activationCodeInput.classList.remove('is-valid', 'is-invalid');
                    codeError.style.display = 'none';
                }

                submitButton.disabled = !isCodeValid;
            }

            // Timer function
            function startTimer() {
                timeLeft = 120; // Reset timer
                resendLink.classList.add('disabled');
                resendLink.style.display = 'none'; // Hide resend link
                clearInterval(timerInterval); // Clear any existing timer

                timerInterval = setInterval(() => {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;

                    timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        resendLink.classList.remove('disabled');
                        resendLink.style.display = 'block'; // Show resend link
                        timerElement.textContent = '00:00'; // Ensure it shows 00:00
                        submitButton.disabled = true; // Disable submit button if timer runs out
                        // Optionally, redirect after a short delay or allow resend
                        // window.location.href = 'login-user.php'; // Uncomment to redirect
                    } else {
                        timeLeft--;
                    }
                }, 1000);
            }

            // Event listeners
            activationCodeInput.addEventListener('input', validateForm);
            resendLink.addEventListener('click', function (event) {
                if (!this.classList.contains('disabled')) {
                    // Prevent default link action (e.g., if it's a real link)
                    event.preventDefault();
                    console.log('Resending code...');
                    // Here you would typically make an AJAX request to resend the code
                    // On successful resend, restart the timer
                    startTimer();
                }
            });

            // Initial calls on page load
            validateForm(); // Validate initial state
            startTimer(); // Start the timer

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