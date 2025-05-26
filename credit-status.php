<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> استعلام وضعیت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-Variable-font-face.css"
        rel="stylesheet" type="text/css" />

    <style>
        :root {
            --primary-color: #007bff;
            /* Bootstrap primary blue, consistent with profile/debt pages */
            --secondary-color: #0056b3;
            /* Darker blue for gradients */
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --background-light: #f0f2f5;
            /* Consistent light gray background */
            --text-dark: #333;
            /* Consistent dark text */
            --text-muted: #6c757d;
            /* Consistent muted text */
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); /* Soft card shadow */
            --gradient-blue: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
            padding-bottom: 80px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        .club-header {
            padding: 1.5rem 0;
            background: var(--gradient-blue);
            color: white;
            border-radius: 0 0 25px 25px;
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.2); /* Adjusted shadow color */
            position: relative;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .club-header::before,
        .club-header::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.15); /* Slightly brighter for header effects */
            border-radius: 50%;
            filter: blur(3px);
        }

        .club-header::before {
            top: -40px;
            right: -40px;
            width: 150px;
            height: 150px;
        }

        .club-header::after {
            bottom: -60px;
            left: -20px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08); /* Slightly darker for header effects */
        }

        .club-header h3 {
            font-weight: 800;
            margin-bottom: 0.5rem;
            font-size: 2.2rem;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .club-header p {
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 0; /* Remove extra margin */
            font-size: 1.1rem;
            position: relative;
            z-index: 2;
        }


        .credit-card-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin: 0 auto 2rem auto; /* Adjusted bottom margin */
            max-width: 600px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-light); /* Use consistent border variable */
            transform: translateY(-30px);
            transition: transform 0.3s ease-out;
            text-align: center; /* Center content within the card */
        }

        .credit-card-section:hover {
            transform: translateY(-35px);
        }

        .credit-card-section h5 {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
        }

        .credit-card-section .status-icon {
            font-size: 3rem;
            color: var(--warning-color); /* Yellow for "in review" */
            margin-bottom: 1rem;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }


        .credit-card-section .credit-desc {
            color: var(--text-muted);
            line-height: 1.8;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        .how-to-use-title {
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .how-to-use-desc {
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-size: 0.95rem;
            text-align: center;
        }

        .installment-box {
            background-color: var(--background-light); /* Light gray background */
            border-radius: 15px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            text-align: right; /* Align text to right for RTL */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03); /* Subtle shadow */
            transition: all 0.2s ease;
        }

        .installment-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }


        .installment-box h5 {
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--dark-color);
            margin-bottom: 0.75rem;
        }

        .installment-box .icon {
            font-size: 1.8rem;
            margin-left: 0.75rem; /* Margin for RTL */
            color: var(--primary-color); /* Blue color for icons */
        }

        .installment-box .sub-info {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .installment-box p {
            color: var(--text-dark);
            font-size: 0.9rem;
            line-height: 1.7;
            margin-bottom: 0;
        }

        .alert-info {
            background-color: rgba(0, 123, 255, 0.1); /* Lighter blue for alert */
            color: var(--primary-color);
            border-color: rgba(0, 123, 255, 0.2);
            border-radius: 15px;
            padding: 1rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            margin-top: 2rem;
            text-align: center;
        }

        /* Bottom Navigation Bar - consistent with previous pages */
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
            background-color: rgba(0, 123, 255, 0.08); /* Adjusted active background color */
            font-weight: 700;
        }

        .tf-navigation-bar li a.active i,
        .tf-navigation-bar li a.active svg {
            color: var(--primary-color);
        }

        .tf-navigation-bar li a:hover {
            color: var(--primary-color);
            background-color: rgba(0, 123, 255, 0.05); /* Adjusted hover background color */
        }

        .tf-navigation-bar li a:hover i,
        .tf-navigation-bar li a:hover svg {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            body {
                padding-bottom: 70px;
            }

            .club-header {
                padding: 1.2rem 0;
                border-radius: 0 0 20px 20px;
            }

            .club-header h3 {
                font-size: 1.8rem;
            }

            .club-header p {
                font-size: 0.95rem;
            }

            .credit-card-section {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
                transform: translateY(-20px);
            }

            .credit-card-section h5 {
                font-size: 1.2rem;
            }

            .credit-card-section .status-icon {
                font-size: 2.5rem;
            }

            .credit-card-section .credit-desc,
            .how-to-use-desc,
            .installment-box p,
            .alert-info {
                font-size: 0.85rem;
            }

            .how-to-use-title {
                font-size: 1.1rem;
            }

            .installment-box {
                padding: 1rem;
            }

            .installment-box h5 {
                font-size: 1rem;
            }

            .installment-box .icon {
                font-size: 1.5rem;
                margin-left: 0.6rem;
            }

            .tf-navigation-bar li a {
                font-size: 0.75rem;
            }

            .tf-navigation-bar li a i,
            .tf-navigation-bar li a svg {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="club-header text-center">
        <div class="container">
            <h4> استعلام وضعیت</h4>
        </div>
    </div>

    <div class="container flex-grow-1 d-flex flex-column justify-content-start align-items-center mt-4">
        <div class="credit-card-section">
            <i class="fas fa-hourglass-half status-icon"></i> <h5>اعتبار شما در حال بررسی می باشد</h5>

            <p class="credit-desc">
                اعتبار شما توسط بانک عامل در حال بررسی می باشد. به محض اختصاص اعتبار به شما اطلاع رسانی خواهد شد و بعد
                از آن می توانید به صورت اعتباری از فروشگاه های طرف قرارداد ما به صورت اعتباری خرید کنید.
            </p>
        </div>

        <div class="container" style="max-width: 600px;">
            <h5 class="how-to-use-title">چطور از اعتبار BNPL استفاده کنم؟</h5>
            <p class="how-to-use-desc">
                می‌توانید با اعتبارتان از فروشگاه‌های حاضر در BNPL به‌صورت آنلاین یا حضوری
                خرید کرده و با یکی از روش‌های زیر تسویه کنید:
            </p>

            <div class="installment-box">
                <h5><i class="fas fa-sack-dollar icon"></i> پرداخت قسطی</h5>
                <p class="sub-info">تا سقف اعتبار</p>
                <p>هزینه خرید شما به ۴ قسط تقسیم می‌شود. یک قسط را هنگام خرید و ۳ قسط دیگر را در ۳ ماه آینده پرداخت
                    می‌کنید.</p>
            </div>

            <div class="installment-box">
                <h5><i class="fas fa-calendar-alt icon"></i> پرداخت آخر ماه</h5>
                <p class="sub-info">تا سقف اعتبار</p>
                <p>در این روش، مبلغ خریدهایتان را در پایان همان ماه، به‌صورت بدهی ماهانه تسویه می‌کنید.</p>
            </div>

            <div class="alert alert-info mt-4 mb-4">
                <i class="fas fa-info-circle me-2"></i>
                اعتبار شما فقط در فروشگاه‌های عضو BNPL قابل استفاده است.
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Removed the credit amount generation as the page now shows "under review"
        // The previous script related to generating a random credit amount is no longer applicable
        // to a page indicating "اعتبار شما در حال بررسی می باشد".
    </script>
</body>

</html>