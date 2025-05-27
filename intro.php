<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNPL | انتخاب ورود</title>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css" as="style">
    <link rel="preload"
        href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Regular.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Bold.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-Variable-font-face.css"
        rel="stylesheet" type="text/css" />

    <style>
        /* Consistent Root Variables */
        :root {
            --primary-color: #007bff;
            /* Bootstrap primary blue */
            --secondary-color: #0056b3;
            /* Darker blue for gradients */
            --success-color: #28a745;
            /* Green */
            --warning-color: #ffc107;
            /* Yellow */
            --danger-color: #dc3545;
            /* Red */
            --background-light: #f0f2f5;
            /* Light gray background */
            --card-background: #ffffff;
            /* White card background */
            --text-dark: #333;
            /* Dark gray for main text */
            --text-muted: #6c757d;
            /* Muted gray for secondary text */
            --card-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            /* Prominent card shadow */
            --border-light: #e0e0e0;
            /* Light border color */
            --gradient-blue: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            --option-blue: #283EB4; /* Specific blue for register */
            --option-yellow: #FECC0E; /* Specific yellow for login */
            --option-text-light: #fefefe; /* Light text on colored boxes */
            --option-text-dark: #333; /* Dark text for titles */
        }

        body {
            background-color: var(--background-light);
            font-family: 'Vazirmatn', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden; /* Prevents horizontal scroll */
        }

        /* Main Container/Card holding the options */
        .choice-card {
            background-color: var(--card-background);
            border-radius: 25px; /* More rounded */
            padding: 40px; /* Increased padding */
            box-shadow: var(--card-shadow);
            max-width: 500px; /* Wider card */
            width: 100%;
            text-align: center;
            animation: fadeInScale 0.8s ease-out forwards; /* Entry animation */
        }

        .choice-card h2 {
            font-size: 2.5rem; /* Larger, more impactful title */
            font-weight: 800; /* Extra bold */
            color: var(--primary-color);
            margin-bottom: 2.5rem; /* More space below title */
            position: relative; /* For decorative element */
        }

        .choice-card h2::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
            margin: 1rem auto 0 auto; /* Centered underline */
        }

        /* Individual Action Items (Register/Login) */
        .action-item {
            margin-bottom: 30px; /* More space between items */
        }

        .action-item:last-child {
            margin-bottom: 0; /* No bottom margin for the last item */
        }

        .action-item a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-dark);
            transition: all 0.3s ease-in-out;
            padding: 25px; /* Increased padding within the clickable area */
            border-radius: 18px; /* More rounded */
            background-color: var(--background-light); /* Lighter background for options */
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05); /* Softer shadow for options */
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border-light);
        }

        .action-item a:hover {
            transform: translateY(-8px); /* More pronounced lift on hover */
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15); /* Stronger shadow on hover */
            color: var(--primary-color);
            border-color: var(--primary-color); /* Highlight border on hover */
        }
        
        /* Background gradient on hover for better visual feedback */
        .action-item a:hover .icon-box {
            background-color: var(--primary-color); /* Change icon box color on hover */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: scale(1.1); /* Slight zoom on icon */
        }


        .action-item .icon-box {
            width: 80px; /* Larger icon box */
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px; /* More space below icon */
            font-size: 3rem; /* Larger icon size */
            color: var(--option-text-light); /* Light text for icons */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); /* Deeper shadow for icon box */
            transition: all 0.3s ease-in-out;
            flex-shrink: 0; /* Prevent icon box from shrinking */
        }

        /* Specific background colors for icon boxes */
        .bg_color_1 {
            background-color: var(--option-blue);
        }

        .bg_color_3 {
            background-color: var(--option-yellow);
        }

        .action-item span {
            font-weight: 700; /* Bold text */
            font-size: 1.3rem; /* Larger text for option description */
            margin-top: 10px; /* Adjusted margin */
            color: var(--option-text-dark); /* Dark text for description */
        }

        /* Animations */
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .choice-card {
                padding: 30px;
                border-radius: 20px;
            }

            .choice-card h2 {
                font-size: 2rem;
                margin-bottom: 2rem;
            }

            .choice-card h2::after {
                width: 60px;
                height: 3px;
            }

            .action-item a {
                padding: 20px;
                border-radius: 15px;
            }

            .action-item .icon-box {
                width: 70px;
                height: 70px;
                font-size: 2.5rem;
                margin-bottom: 15px;
            }

            .action-item span {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .choice-card {
                padding: 20px;
            }

            .choice-card h2 {
                font-size: 1.8rem;
                margin-bottom: 1.5rem;
            }

            .action-item a {
                padding: 15px;
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
    <div class="choice-card">
        <h2>انتخاب خود را انجام دهید</h2>
        <div class="row">
            <div class="col-12 action-item">
                <a href="login-user2.php" aria-label="ثبت نام اعتبار جدید">
                    <div class="icon-box bg_color_1">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <span>ثبت نام اعتبار جدید</span>
                </a>
            </div>

            <div class="col-12 action-item">
                <a href="login-user.php" aria-label="ورود به حساب اعتبار">
                    <div class="icon-box bg_color_3">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <span>ورود به حساب کاربری</span>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>