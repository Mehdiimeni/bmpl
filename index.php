<!DOCTYPE HTML>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">

    <!-- متا تگ‌های PWA پیشرفته -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="BNPL">

    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>BNPL | خرید اقساطی</title>

    <!-- Favicon و آیکون‌های PWA -->
    <link rel="icon" href="./assets/icons/apple-icon-72.png" type="image/png">
    <link rel="apple-touch-icon" href="./assets/icons/android-icon-192.png">
    <link rel="manifest" href="./manifest.json">

    <!-- پیش‌بارگذاری منابع حیاتی -->
    <link rel="preload" href="./assets/css/bootstrap.rtl.min.css" as="style">
    <link rel="preload" href="./assets/icons/android-icon-192.png" as="image">

    <!-- استایل‌های داخلی برای عملکرد بهتر -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css">

    <!-- تنظیمات تم و PWA -->
    <meta name="msapplication-TileColor" content="#2196F3">
    <meta name="theme-color" content="#2196F3">
    <meta name="apple-mobile-web-app-status-bar-style" content="#2196F3">

    <!-- ریدایرکت هوشمند با تایمر -->
    <meta http-equiv="refresh" content="3; url=./login-user.php">

    <style>
        :root {
            --primary-color: #2196F3;
            --background-color: #f5f5f5;
        }

        body {
            background-color: var(--background-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }
        .login-card {
            max-width: 450px;
            margin: 2rem auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .loading-container {
            text-align: center;
            padding: 2rem;
            max-width: 100%;
        }

        .loading-spinner {
            width: 3rem;
            height: 3rem;
            border-width: 0.25em;
        }

        .wallet-icon {
            width: 5rem;
            height: 5rem;
            margin-bottom: 1.5rem;
            object-fit: contain;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --background-color: #f5f5f5;
            }

            body {
                color: #ffffff;
            }
        }
    </style>
</head>

<body class="theme-light">
    <?php
    // بررسی دستگاه کاربر
    $isMobile = false;
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $isMobile = (strpos(strtolower($agent), 'android') !== false) ||
            (strpos(strtolower($agent), 'ios') !== false);
    }


    ?>
    <div class="container">
        <div class="login-card bg-white">
            <div class="loading-container">
                <img src="./assets/icons/android-icon-192.png" alt="کیف پول BNPL" class="wallet-icon" loading="eager">
                <h1 class="mb-4">سرویس خرید اقساطی BNPL</h1>
                <div class="spinner-border text-primary loading-spinner" role="status" aria-hidden="true">
                    <span class="visually-hidden">در حال انتقال...</span>
                </div>
                <p class="mt-3">در حال انتقال به صفحه ورود...</p>
                <div class="progress mt-3" style="height: 4px; width: 80%; margin: 0 auto;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- اسکریپت‌های ضروری -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>

    <!-- ثبت Service Worker با مدیریت خطا -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // مدیریت ریدایرکت
            let redirectTimer = 5;
            const timerElement = document.createElement('div');
            timerElement.className = 'text-muted small mt-2';
            document.querySelector('.loading-container').appendChild(timerElement);

            const updateTimer = () => {
                timerElement.textContent = `انتقال خودکار در ${redirectTimer} ثانیه...`;
                if (redirectTimer <= 0) {
                    window.location.href = './login-user.php';
                } else {
                    redirectTimer--;
                    setTimeout(updateTimer, 1000);
                }
            };
            updateTimer();

            // ثبت Service Worker
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('./sw.js')
                    .then(reg => {
                        console.log('ServiceWorker ثبت شد با محدوده: ', reg.scope);
                        reg.update();
                    })
                    .catch(err => {
                        console.error('خطا در ثبت ServiceWorker: ', err);
                    });
            }

            // بهبود UX برای PWA
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