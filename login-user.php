<!DOCTYPE HTML>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>BNPL | ورود به سامانه</title>
    
    <!-- Bootstrap CSS -->
    <link href="./assets/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2196F3;
            --error-color: #f44336;
        }
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            max-width: 450px;
            margin: 2rem auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .logo-container {
            text-align: center;
            padding: 0.5rem 0;
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
        .terms-checkbox {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }
        .terms-checkbox input {
            margin-left: 8px;
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
    </style>
</head>

<body>
    <div id="preloader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>

    <div class="container">
        <div class="login-card bg-white">
            <div class="logo-container">
                <img src="./assets/icons/android-icon-192.png" alt="BNPL Logo">
            </div>
            
            <div class="form-container">
                <h1 class="text-center mb-3">ورود به سامانه</h1>
                <p class="text-center text-muted mb-4">لطفاً شماره موبایل خود را وارد کنید</p>
                
                <form id="loginForm" action="pass-number.php" method="post">
                    <div class="input-field">
                        <label for="phoneNumber">شماره موبایل</label>
                        <input 
                            type="tel" 
                            id="phoneNumber" 
                            name="phoneNumber"
                            maxlength="11"
                            minlength="11"
                            pattern="09[0-9]{9}"
                            placeholder="مثال: 09123456789"
                            required
                            oninput="validateForm()"
                        >
                        <div class="error-message" id="phoneError">شماره موبایل باید 11 رقمی و با 09 شروع شود</div>
                    </div>
                    
                    <div class="terms-checkbox">
                        <input 
                            type="checkbox" 
                            id="agreeTerms" 
                            name="agreeTerms"
                            required
                            onchange="validateForm()"
                        >
                        <label for="agreeTerms">با ورود، با کلیه قوانین و مقررات موافقم</label>
                    </div>
                    
                    <input type="hidden" name="scode" value="<?php echo random_int(100000, 999999); ?>">
                    
                    <button 
                        type="submit" 
                        id="submitBtn"
                        class="submit-btn"
                        disabled
                    >
                        دریافت کد ورود
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
            const phoneInput = document.getElementById('phoneNumber');
            const phoneError = document.getElementById('phoneError');
            const agreeCheckbox = document.getElementById('agreeTerms');
            const submitBtn = document.getElementById('submitBtn');
            
            // اعتبارسنجی شماره موبایل
            const phoneRegex = /^09[0-9]{9}$/;
            const isPhoneValid = phoneRegex.test(phoneInput.value);
            
            if (phoneInput.value.length > 0 && !isPhoneValid) {
                phoneError.style.display = 'block';
                phoneInput.style.borderColor = 'var(--error-color)';
            } else {
                phoneError.style.display = 'none';
                phoneInput.style.borderColor = isPhoneValid ? '#28a745' : '#ddd';
            }
            
            // فعال/غیرفعال کردن دکمه
            submitBtn.disabled = !(isPhoneValid && agreeCheckbox.checked);
        }
        
        // اسکرول به بالای صفحه
        window.scrollTo(0, 1);
        
        // مخفی کردن preloader پس از لود صفحه
        window.addEventListener('load', function() {
            document.getElementById('preloader').style.display = 'none';
        });
    </script>
</body>
</html>