<!DOCTYPE HTML>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="BNPL">

    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>BNPL | خرید اقساطی</title>

    <link rel="icon" href="./assets/icons/apple-icon-72.png" type="image/png">
    <link rel="apple-touch-icon" href="./assets/icons/android-icon-192.png">
    <link rel="manifest" href="./manifest.json">

    <link rel="preload" href="./assets/css/bootstrap.rtl.min.css" as="style">
    <link rel="preload" href="./assets/icons/android-icon-192.png" as="image">

    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css">

    <meta name="msapplication-TileColor" content="#2196F3">
    <meta name="theme-color" content="#2196F3">
    <meta name="apple-mobile-web-app-status-bar-style" content="#2196F3">

    <meta http-equiv="refresh" content="3; url=./login-user.php">

    <style>
        /* تعریف متغیرهای CSS برای تم و رنگ‌ها */
        :root {
            --primary-color: #2196F3; /* آبی اصلی */
            --primary-dark: #1976D2; /* آبی تیره برای هاور/اکتیو */
            --background-light: #f0f2f5; /* پس‌زمینه روشن */
            --card-background: #ffffff; /* پس‌زمینه کارت */
            --text-color-dark: #333; /* رنگ متن تیره */
            --text-color-light: #777; /* رنگ متن روشن‌تر */
            --shadow-color: rgba(0, 0, 0, 0.1);
            --gradient-start: #2196F3;
            --gradient-end: #0D47A1;
        }

        /* تم تاریک */
        @media (prefers-color-scheme: dark) {
            :root {
                --background-light: #121212;
                --card-background: #1e1e1e;
                --text-color-dark: #e0e0e0;
                --text-color-light: #a0a0a0;
                --shadow-color: rgba(0, 0, 0, 0.3);
                --gradient-start: #3F51B5;
                --gradient-end: #1A237E;
            }
        }

        body {
            background-color: var(--background-light);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Vazirmatn', sans-serif; /* استفاده از یک فونت مدرن‌تر */
            color: var(--text-color-dark);
            text-rendering: optimizeLegibility; /* بهبود رندرینگ متن */
            -webkit-font-smoothing: antialiased; /* صاف کردن فونت در WebKit */
            -moz-osx-font-smoothing: grayscale; /* صاف کردن فونت در Firefox */
        }

        .login-card {
            background-color: var(--card-background);
            max-width: 450px;
            width: 90%; /* واکنش‌گرا برای عرض */
            margin: 2rem auto;
            border-radius: 18px; /* گردی بیشتر لبه‌ها */
            box-shadow: 0 10px 30px var(--shadow-color); /* سایه عمیق‌تر و مدرن‌تر */
            overflow: hidden;
            animation: fadeInScale 0.8s ease-out forwards; /* انیمیشن ورود کارت */
        }

        .loading-container {
            text-align: center;
            padding: 3rem 1.5rem; /* پدینگ بیشتر */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .loading-spinner {
            width: 3.5rem; /* کمی بزرگتر */
            height: 3.5rem;
            border-width: 0.3em; /* کمی ضخیم‌تر */
            border-color: var(--primary-color) transparent var(--primary-color) transparent; /* رنگ‌بندی جذاب‌تر */
            animation: spin 1s linear infinite, fadeIn 0.5s ease-out 0.4s forwards;
            margin-bottom: 2rem; /* فاصله بیشتر */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .wallet-icon {
            width: 6rem; /* بزرگتر */
            height: 6rem;
            margin-bottom: 2rem; /* فاصله بیشتر */
            object-fit: contain;
            animation: bounceIn 0.8s ease-out forwards; /* انیمیشن ورود آیکون */
        }

        h1 {
            color: var(--primary-dark); /* رنگ تیتر */
            margin-bottom: 1rem; /* کاهش فاصله */
            font-size: 2.2rem; /* اندازه بزرگتر */
            font-weight: 700; /* وزن بیشتر */
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }

        p {
            color: var(--text-color-light); /* رنگ متن توضیحی */
            font-size: 1.1rem; /* اندازه مناسب‌تر */
            margin-top: 1rem;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.3s;
            opacity: 0;
        }

        .progress {
            height: 6px; /* ارتفاع کمی بیشتر */
            width: 90%; /* عرض بیشتر */
            margin: 1.5rem auto 0 auto; /* فاصله مناسب */
            border-radius: 3px;
            background-color: rgba(var(--primary-color), 0.2); /* پس‌زمینه کمرنگ‌تر */
            overflow: hidden;
            animation: fadeIn 0.7s ease-out forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }

        .progress-bar {
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end)); /* گرادیانت برای نوار پیشرفت */
            animation: progressBarGrow 3s linear forwards; /* انیمیشن رشد نوار پیشرفت */
        }

        .text-muted {
            color: var(--text-color-light) !important;
            animation: fadeIn 0.7s ease-out forwards;
            animation-delay: 0.5s;
            opacity: 0;
        }

        /* انیمیشن‌های کلی */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounceIn {
            0%, 20%, 40%, 60%, 80%, 100% {
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            }
            0% {
                opacity: 0;
                transform: scale3d(0.3, 0.3, 0.3);
            }
            20% {
                transform: scale3d(1.1, 1.1, 1.1);
            }
            40% {
                transform: scale3d(0.9, 0.9, 0.9);
            }
            60% {
                opacity: 1;
                transform: scale3d(1.03, 1.03, 1.03);
            }
            80% {
                transform: scale3d(0.97, 0.97, 0.97);
            }
            100% {
                opacity: 1;
                transform: scale3d(1, 1, 1);
            }
        }
        
        @keyframes progressBarGrow {
            from { width: 0%; }
            to { width: 100%; }
        }

        /* فونت (برای استفاده از این فونت، فایل آن را در assets/css یا assets/fonts قرار دهید و در CSS @font-face را تعریف کنید) */
        @font-face {
            font-family: 'Vazirmatn';
            src: url('./assets/fonts/Vazirmatn-Regular.woff2') format('woff2'); /* مسیر صحیح فونت را اینجا قرار دهید */
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: 'Vazirmatn';
            src: url('./assets/fonts/Vazirmatn-Bold.woff2') format('woff2'); /* مسیر صحیح فونت را اینجا قرار دهید */
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }
    </style>
</head>

<body class="theme-light">
    <div class="container">
        <div class="login-card">
            <div class="loading-container">
                <img src="./assets/icons/android-icon-192.png" alt="کیف پول BNPL" class="wallet-icon" loading="eager">
                <h1 class="mb-4">سرویس خرید اقساطی BNPL</h1>
                <div class="spinner-border loading-spinner" role="status" aria-hidden="true">
                    <span class="visually-hidden">در حال انتقال...</span>
                </div>
                <p class="mt-3">در حال انتقال به صفحه ورود...</p>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        style="width: 100%"></div>
                </div>
                <div class="text-muted small mt-2" id="redirect-timer"></div>
            </div>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // مدیریت ریدایرکت با شمارش معکوس
            let redirectTimer = 5; // زمان اولیه برای نمایش (می‌تواند متفاوت از meta refresh باشد)
            const timerElement = document.getElementById('redirect-timer');

            const updateTimer = () => {
                timerElement.textContent = `انتقال خودکار در ${redirectTimer} ثانیه...`;
                if (redirectTimer <= 0) {
                    window.location.href = './login-user.php';
                } else {
                    redirectTimer--;
                    setTimeout(updateTimer, 1000);
                }
            };
            updateTimer(); // شروع شمارش معکوس بلافاصله

            // ثبت Service Worker
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('./sw.js')
                    .then(reg => {
                        console.log('ServiceWorker ثبت شد با محدوده: ', reg.scope);
                        reg.update(); // سعی برای به‌روزرسانی سرویس ورکر
                    })
                    .catch(err => {
                        console.error('خطا در ثبت ServiceWorker: ', err);
                    });
            }

            // بهبود UX برای PWA (اسکرول به بالا در لود)
            window.addEventListener('load', () => {
                setTimeout(() => {
                    window.scrollTo(0, 1);
                }, 0);

                if (window.matchMedia('(display-mode: standalone)').matches) {
                    console.log('در حال اجرا به عنوان PWA');
                }
            });
        });
    </script>
</body>

</html>