<!DOCTYPE HTML>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>BNPL | تأیید کد فعال‌سازی</title>
    
    <!-- Bootstrap CSS -->
    <link href="./assets/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2196F3;
            --error-color: #f44336;
            --success-color: #4CAF50;
        }
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .verification-card {
            max-width: 450px;
            margin: 2rem auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .logo-container {
            text-align: center;
            padding: 1.5rem 0;
        }
        .logo-container img {
            height: 80px;
            width: auto;
        }
        .form-container {
            padding: 2rem;
        }
        .input-field {
            margin-bottom: 1.5rem;
            position: relative;
        }
        .input-field label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }
        .input-field input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            letter-spacing: 5px;
            transition: all 0.3s;
        }
        .input-field input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.2);
            outline: none;
        }
        .input-field .error-message {
            color: var(--error-color);
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .submit-btn:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .submit-btn:hover:not(:disabled) {
            background-color: #0d8bf2;
        }
        .timer-container {
            text-align: center;
            margin: 1.5rem 0;
            color: #666;
        }
        .timer {
            font-weight: bold;
            color: var(--primary-color);
        }
        .resend-link {
            color: var(--primary-color);
            text-decoration: none;
            cursor: pointer;
        }
        .resend-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="preloader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>

    <div class="container">
        <div class="verification-card bg-white">
            <div class="logo-container">
                <img src="./assets/icons/android-icon-192.png" alt="BNPL Logo">
            </div>
            
            <div class="form-container">
                <h2 class="text-center mb-3">تأیید کد فعال‌سازی</h2>
                <p class="text-center text-muted mb-4">کد 6 رقمی ارسال شده را وارد نمایید</p>
                
                <form id="verificationForm" action="dashboard.php" method="post">
                    <div class="input-field">
                        <label for="activationCode">کد فعال‌سازی</label>
                        <input 
                            type="tel" 
                            id="activationCode" 
                            name="activationCode"
                            maxlength="6"
                            minlength="6"
                            pattern="[0-9]{6}"
                            placeholder="_ _ _ _ _ _"
                            required
                            oninput="validateForm()"
                            value="<?php echo @$_POST['scode']; ?>"
                        >
                        <div class="error-message" id="codeError">کد باید 6 رقم عددی باشد</div>
                    </div>
                    
                    <div class="timer-container">
                        <span>زمان باقی‌مانده: </span>
                        <span id="timer" class="timer">02:00</span>
                    </div>
                    
                    <button 
                        type="submit" 
                        id="submitBtn"
                        class="submit-btn"
                        disabled
                    >
                        ورود به سیستم
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="./assets/js/bootstrap.min.js"></script>
    
    <script>
        // اعتبارسنجی فرم
        function validateForm() {
            const codeInput = document.getElementById('activationCode');
            const codeError = document.getElementById('codeError');
            const submitBtn = document.getElementById('submitBtn');
            
            // اعتبارسنجی کد فعال‌سازی
            const codeRegex = /^[0-9]{6}$/;
            const isCodeValid = codeRegex.test(codeInput.value);
            
            if (codeInput.value.length > 0 && !isCodeValid) {
                codeError.style.display = 'block';
                codeInput.style.borderColor = 'var(--error-color)';
            } else {
                codeError.style.display = 'none';
                codeInput.style.borderColor = isCodeValid ? '#28a745' : '#ddd';
            }
            
            // فعال/غیرفعال کردن دکمه
            submitBtn.disabled = !isCodeValid;
        }
        
        // تایمر 2 دقیقه‌ای
        function startTimer() {
            let timeLeft = 120; // 2 دقیقه = 120 ثانیه
            const timerElement = document.getElementById('timer');
            
            const timerInterval = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                
                timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    window.location.href = 'login-user.php';
                } else {
                    timeLeft--;
                }
            }, 1000);
        }
        
        // اسکرول به بالای صفحه
        window.scrollTo(0, 1);
        
        // مخفی کردن preloader پس از لود صفحه
        window.addEventListener('load', function() {
            document.getElementById('preloader').style.display = 'none';
            startTimer();
            validateForm();
        });
    </script>
</body>
</html>