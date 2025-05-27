<!DOCTYPE HTML>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>BNPL | ورود با کد ملی</title>

    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css" as="style">
    <link rel="preload"
        href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Regular.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Bold.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css" rel="stylesheet"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">

    <style>
        /* CSS Variables for theming - Adjusted to match the login page */
        :root {
            --primary-color: #2196F3; /* Blue */
            --primary-dark: #1976D2; /* Darker Blue */
            --secondary-color: #4CAF50; /* Green for valid states */
            --error-color: #F44336; /* Red for error states */
            --background-light: #f0f2f5; /* Light gray background */
            --card-background: #ffffff; /* White card background */
            --text-color-dark: #333; /* Dark text */
            --text-color-light: #777; /* Muted text */
            --shadow-light: rgba(0, 0, 0, 0.08);
            --shadow-medium: rgba(0, 0, 0, 0.15);
            --border-color: #e0e0e0; /* Light border for inputs */
        }

        /* Dark mode adjustments (if needed) */
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

        /* Vazirmatn Font Import */
        @font-face {
            font-family: 'Vazirmatn';
            src: url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Regular.woff2') format('woff2');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Vazirmatn';
            src: url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Bold.woff2') format('woff2');
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
            overflow-x: hidden; /* Prevents horizontal scrollbar */
        }

        /* Preloader Styles */
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
            pointer-events: none; /* Allows clicks through after fading */
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.3em;
            color: var(--primary-color) !important; /* Use !important to override Bootstrap default */
        }

        /* Login Card Styles */
        .login-card {
            background-color: var(--card-background);
            max-width: 450px;
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 12px 30px var(--shadow-medium);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            animation: fadeInScale 0.8s ease-out forwards; /* Apply animation on load */
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

        /* Validation feedback styles */
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

        /* Loading Box Styles */
        #loadingBox {
            display: none; /* Hidden by default */
            text-align: center;
            margin-top: 2rem;
            color: var(--text-color-light); /* Use muted text color */
            font-size: 0.95rem;
        }

        #loadingBox .spinner-border {
            width: 2.2rem;
            height: 2.2rem;
            color: var(--primary-color);
            border-width: 0.25em;
        }


        /* General Animations (copied from the first code) */
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

        /* Responsive adjustments (copied from the first code) */
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
                <h1 class="text-center">ورود با کد ملی</h1>
                <p class="text-center text-muted">برای دریافت اعتبار، **کد ملی** خود را وارد کنید. کد ملی و شماره
                    همراه باید برای یک نفر باشد.</p>

                <form id="nationalCodeForm" action="id-verification.php" method="post" novalidate>
                    <div class="input-field">
                        <label for="nationalCode">کد ملی</label>
                        <input type="text" id="nationalCode" name="nationalCode" maxlength="10"
                            placeholder="مثلاً 1234567890" required inputmode="numeric" pattern="[0-9]*">
                        <div class="error-message" id="codeError">کد ملی باید ۱۰ رقم باشد و فقط شامل اعداد باشد.</div>
                    </div>

                    <button type="submit" id="submitBtn" class="submit-btn" disabled>
                        تأیید و ادامه
                    </button>

                    <div id="loadingBox" class="mt-3">
                        <div class="spinner-border" role="status"></div>
                        <p class="mt-2">در حال بررسی اطلاعات...</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nationalCodeInput = document.getElementById('nationalCode');
            const codeError = document.getElementById('codeError');
            const submitBtn = document.getElementById('submitBtn');
            const loadingBox = document.getElementById('loadingBox');
            const form = document.getElementById('nationalCodeForm');
            const preloader = document.getElementById('preloader');

            // Function to validate national code (algorithm provided by you)
            function validateNationalCode(code) {
                // Ensure length is 10
                if (code.length !== 10) return false;

                // Ensure it contains only digits
                if (!/^\d+$/.test(code)) return false;

                // National ID algorithm check
                const check = parseInt(code[9]);
                let sum = 0;

                for (let i = 0; i < 9; i++) {
                    sum += parseInt(code[i]) * (10 - i);
                }

                const remainder = sum % 11;
                const isValid = (remainder < 2 && check === remainder) || (remainder >= 2 && check === 11 - remainder);

                return isValid;
            }

            // Function to update input style and button state
            function updateFormState() {
                const value = nationalCodeInput.value.trim();
                // Remove non-digit characters to ensure clean input for validation
                nationalCodeInput.value = value.replace(/\D/g, ''); 

                if (nationalCodeInput.value.length === 10) {
                    if (validateNationalCode(nationalCodeInput.value)) {
                        codeError.style.display = 'none';
                        nationalCodeInput.classList.remove('is-invalid');
                        nationalCodeInput.classList.add('is-valid'); // Add valid state class
                        submitBtn.disabled = false;
                    } else {
                        codeError.textContent = 'کد ملی وارد شده معتبر نیست.';
                        codeError.style.display = 'block';
                        nationalCodeInput.classList.remove('is-valid');
                        nationalCodeInput.classList.add('is-invalid'); // Add invalid state class
                        submitBtn.disabled = true;
                    }
                } else {
                    codeError.textContent = 'کد ملی باید ۱۰ رقم باشد.';
                    // Show error only if input has some value but not 10 digits
                    codeError.style.display = nationalCodeInput.value.length > 0 ? 'block' : 'none'; 
                    nationalCodeInput.classList.remove('is-valid');
                    // Add invalid class if length is not 10 and not empty, otherwise remove both
                    if (nationalCodeInput.value.length > 0) {
                        nationalCodeInput.classList.add('is-invalid');
                    } else {
                        nationalCodeInput.classList.remove('is-invalid');
                    }
                    submitBtn.disabled = true;
                }
            }

            // Attach event listener for input changes
            nationalCodeInput.addEventListener('input', updateFormState);

            // Handle form submission
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                updateFormState(); // Run validation one last time before submitting

                // Only proceed if the button is not disabled (meaning input is valid)
                if (!submitBtn.disabled) {
                    loadingBox.style.display = 'block'; // Show loading spinner
                    submitBtn.disabled = true; // Disable button to prevent multiple submissions
                    nationalCodeInput.disabled = true; // Disable input during loading

                    // Simulate server request with a delay
                    setTimeout(() => {
                        console.log('کد ملی ارسال شد:', nationalCodeInput.value);
                        // Redirect to the next page after successful "submission"
                        window.location.href = 'id-verification.php';
                    }, 2000); // 2-second delay
                }
            });

            // Initial form state update on page load
            updateFormState();

            // Hide preloader after page loads
            window.addEventListener('load', function () {
                preloader.classList.add('hidden');
                setTimeout(() => {
                    preloader.style.display = 'none'; // Fully remove after transition
                }, 500); // Match CSS transition duration
                window.scrollTo(0, 1); // Fix for some mobile browsers not scrolling to top
            });
        });
    </script>
</body>

</html>