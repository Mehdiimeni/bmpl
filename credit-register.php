<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ورود با کد ملی</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-Variable-font-face.css"
        rel="stylesheet" type="text/css" />

    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Vazirmatn', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
            padding-bottom: 80px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-header {
            /* Reduced padding and height */
            padding: 1.5rem 0;
            /* More attractive background */
            background: linear-gradient(135deg, #5b86e5 0%, #3656a8 100%);
            color: white;
            border-radius: 0 0 25px 25px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 25px rgba(78, 115, 223, 0.2);
            position: relative;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .main-header::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            filter: blur(3px);
        }

        .main-header::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -20px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            filter: blur(3px);
        }

        .login-card {
            background: white;
            border-radius: 25px;
            padding: 2.5rem;
            margin: auto;
            max-width: 500px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border: none;
            transform: translateY(-30px);
            transition: transform 0.3s ease-out;
        }

        .login-card:hover {
            transform: translateY(-35px);
        }

        .login-card h6 {
            color: #555;
            line-height: 1.8;
        }

        .input-field {
            margin-bottom: 1.8rem;
            position: relative;
        }

        .input-field label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .input-field input {
            width: 100%;
            padding: 0.85rem 1.2rem;
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            background-color: #fdfdfd;
        }

        .input-field input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.3rem rgba(78, 115, 223, 0.2);
            outline: none;
            background-color: #ffffff;
        }

        .input-field input.error {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 0.3rem rgba(220, 53, 69, 0.15);
        }

        .error-message {
            color: var(--danger-color);
            font-size: 0.88rem;
            margin-top: 0.6rem;
            display: none;
            font-weight: 500;
        }

        .submit-btn {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, var(--primary-color), #2c58e0);
            color: white;
            border: none;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(78, 115, 223, 0.4);
            background: linear-gradient(135deg, #3a62d0, #2040c0);
        }

        .submit-btn:disabled {
            background: #c5c7ce;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        #loadingBox {
            display: none;
            text-align: center;
            margin-top: 2rem;
            color: #666;
            font-size: 0.95rem;
        }

        .spinner-border {
            width: 2.2rem;
            height: 2.2rem;
            color: var(--primary-color);
            border-width: 0.25em;
        }

        .bottom-navigation-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -8px 20px rgba(0, 0, 0, 0.08);
            padding: 0.85rem 0;
            z-index: 1000;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .tf-navigation-bar {
            display: flex;
            justify-content: space-around;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tf-navigation-bar li a {
            color: #888;
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.2s ease;
            font-weight: 500;
            padding: 0.5rem;
            border-radius: 10px;
        }

        .tf-navigation-bar li a i,
        .tf-navigation-bar li a svg {
            font-size: 1.4rem;
            margin-bottom: 0.35rem;
            transition: color 0.2s ease;
        }

        .tf-navigation-bar li a.active {
            color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.08);
            font-weight: 700;
        }

        .tf-navigation-bar li a.active i,
        .tf-navigation-bar li a.active svg {
            color: var(--primary-color);
        }

        .tf-navigation-bar li a:hover {
            color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.05);
        }

        .tf-navigation-bar li a:hover i,
        .tf-navigation-bar li a:hover svg {
            color: var(--primary-color);
        }


        @media (max-width: 768px) {
            body {
                padding-bottom: 70px;
            }

            .main-header {
                padding: 1.0rem 0;
                border-radius: 0 0 25px 25px;
                margin-bottom: 2rem;
            }

            .login-card {
                padding: 1.8rem;
                border-radius: 20px;
                transform: translateY(-20px);
            }

            .submit-btn {
                padding: 0.8rem;
                font-size: 1rem;
            }

            .tf-navigation-bar li a {
                font-size: 0.8rem;
            }

            .tf-navigation-bar li a i,
            .tf-navigation-bar li a svg {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>


    <div class="container flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="login-card">
            <h6 class="text-center mb-4">برای دریافت اعتبار **کد ملی** خود را وارد کنید. کد ملی و شماره همراه باید برای
                یک نفر
                باشد.</h6>
            <form id="nationalCodeForm">
                <div class="input-field">
                    <label for="nationalCode">کد ملی</label>
                    <input type="text" id="nationalCode" class="form-control" maxlength="10"
                        placeholder="مثلاً 1234567890" required inputmode="numeric" pattern="[0-9]*"
                        aria-label="کد ملی">
                    <div class="error-message" id="codeError">کد ملی باید ۱۰ رقم باشد و فقط شامل اعداد باشد</div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn" disabled aria-label="تایید و ادامه">
                    تأیید و ادامه
                </button>

                <div id="loadingBox">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">در حال بررسی اطلاعات...</p>
                </div>
            </form>
        </div>
    </div>


  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const nationalCodeInput = document.getElementById("nationalCode");
        const codeError = document.getElementById("codeError");
        const submitBtn = document.getElementById("submitBtn");
        const loadingBox = document.getElementById("loadingBox");
        const form = document.getElementById("nationalCodeForm");

        // اعتبارسنجی کد ملی
        function validateNationalCode(code) {
            // بررسی طول کد
            if (code.length !== 10) return false;

            // بررسی اینکه فقط عدد باشد
            if (!/^\d+$/.test(code)) return false;

            // الگوریتم بررسی کد ملی
            const check = parseInt(code[9]);
            let sum = 0;

            for (let i = 0; i < 9; i++) {
                sum += parseInt(code[i]) * (10 - i);
            }

            const remainder = sum % 11;
            const isValid = (remainder < 2 && check === remainder) || (remainder >= 2 && check === 11 - remainder);

            return isValid;
        }

        nationalCodeInput.addEventListener("input", () => {
            const value = nationalCodeInput.value.trim();

            // حذف هر چیزی غیر از عدد
            nationalCodeInput.value = value.replace(/\D/g, '');

            if (nationalCodeInput.value.length === 10) { // Check value after replacing non-digits
                if (validateNationalCode(nationalCodeInput.value)) { // Validate the cleaned value
                    codeError.style.display = "none";
                    nationalCodeInput.classList.remove("error");
                    submitBtn.disabled = false;
                } else {
                    codeError.textContent = "کد ملی وارد شده معتبر نیست";
                    codeError.style.display = "block";
                    nationalCodeInput.classList.add("error");
                    submitBtn.disabled = true;
                }
            } else {
                codeError.textContent = "کد ملی باید ۱۰ رقم باشد";
                codeError.style.display = nationalCodeInput.value.length > 0 ? "block" : "none"; // Check cleaned value length
                nationalCodeInput.classList.add("error");
                submitBtn.disabled = true;
            }
        });

        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const nationalCode = nationalCodeInput.value.trim();

            if (!validateNationalCode(nationalCode)) {
                codeError.textContent = "لطفاً یک کد ملی معتبر وارد کنید";
                codeError.style.display = "block";
                nationalCodeInput.classList.add("error");
                return;
            }

            // نمایش لودینگ
            loadingBox.style.display = "block";
            submitBtn.disabled = true;

            // شبیه‌سازی ارسال به سرور
            setTimeout(() => {
                // در اینجا می‌توانید اطلاعات را به سرور ارسال کنید
                console.log("کد ملی ارسال شد:", nationalCode);

                // انتقال به صفحه بعد
                window.location.href = "credit-status.php";
            }, 2000);
        });
    </script>
</body>

</html>