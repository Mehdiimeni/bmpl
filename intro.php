<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود اولیه</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-Variable-font-face.css"
        rel="stylesheet" type="text/css" />

    <style>
        :root {
            --primary-color: #5b86e5;
            --secondary-color: #3656a8;
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --text-color-light: #fefefe;
            --text-color-dark: #333;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Vazirmatn', sans-serif;
            line-height: 1.6;
            color: var(--text-color-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px; /* اضافه کردن padding برای فضای اطراف محتوا */
            box-sizing: border-box; /* برای اینکه padding باعث افزایش اندازه کلی نشود */
        }

        .container {
            background-color: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 450px; /* محدود کردن عرض برای ظاهر بهتر در دسکتاپ */
            width: 100%;
        }

        .action-item {
            text-align: center;
            margin-bottom: 25px;
        }

        .action-item a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-color-dark);
            transition: all 0.3s ease-in-out;
            padding: 20px;
            border-radius: 15px;
            background-color: #f8f9fa;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .action-item a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            color: var(--primary-color);
        }

        .action-item .icon-box {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 2.5rem;
            color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .bg_color_1 {
            background-color: #283EB4;
        }

        .bg_color_3 {
            background-color: #FECC0E;
        }

        .action-item span {
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .action-item .icon-box {
                width: 60px;
                height: 60px;
                font-size: 2rem;
            }

            .action-item span {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-5" style="color: var(--primary-color); font-weight: bold;">انتخاب خود را انجام دهید
        </h2>
        <div class="row">
            <div class="col-12 action-item">
                <a href="login-user2.php" aria-label="ثبت نام اعتبار جدید">
                    <div class="icon-box bg_color_1">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <span>ثبت نام جدید</span>
                </a>
            </div>

            <div class="col-12 action-item">
                <a href="login-user.php" aria-label="ورود به حساب اعتبار">
                    <div class="icon-box bg_color_3">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <span>ورود به حساب</span>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>