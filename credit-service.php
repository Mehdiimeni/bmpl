<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سرویس اعتباری | اعتبار خرید</title>
    <!-- فونت‌های جدید -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- آیکون‌های جدید -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- استایل‌های بهینه‌شده -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            direction: rtl;
        }

        .credit-card {
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            border: none;
            transition: var(--transition);
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .credit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .credit-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .credit-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }

        .credit-header h4 {
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .credit-body {
            padding: 2rem;
        }

        .search-box {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 1.2rem;
        }

        .form-control {
            padding: 0.75rem 1.25rem 0.75rem 3rem !important;
            border-radius: 50px !important;
            border: 1px solid #e9ecef;
            background-color: #f8f9fa;
            transition: var(--transition);
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
            border-color: var(--primary-color);
            background-color: white;
        }

        .amount-display {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.03);
            transition: var(--transition);
        }

        .amount-display:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .amount-display a {
            text-decoration: none;
            color: inherit;
        }

        .amount {
            font-size: 1.75rem;
            font-weight: 700;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .payment-info {
            border-top: 1px dashed #e9ecef;
            padding-top: 1.25rem;
            margin-top: 1.25rem;
        }

        .payment-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .deadline {
            color: var(--danger-color);
            font-weight: 600;
            position: relative;
            padding-right: 1.25rem;
        }

        .deadline::before {
            content: '\F1DA';
            font-family: 'remixicon';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 50px;
            padding: 0.75rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        /* نویگیشن بار جدید */
        .bottom-navigation {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.08);
            padding: 0.75rem 0;
            z-index: 1000;
        }

        .nav-list {
            display: flex;
            justify-content: space-around;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            text-align: center;
        }

        .nav-link {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.85rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: var(--transition);
        }

        .nav-link i {
            font-size: 1.4rem;
            margin-bottom: 0.25rem;
        }

        .nav-link.active {
            color: var(--primary-color);
            transform: translateY(-5px);
        }

        .nav-link.active i {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* انیمیشن‌ها */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade {
            animation: fadeIn 0.6s ease forwards;
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }
    </style>
</head>

<body>
    <div class="container py-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="credit-card animate-fade">
                    <div class="credit-header">
                        <h4 class="mb-0">
                            <i class="ri-wallet-3-line align-middle me-2"></i>
                            سرویس اعتباری
                        </h4>
                    </div>
                    <div class="credit-body">
                        <div class="search-box animate-fade delay-1">
                            <div class="search-icon">
                                <i class="ri-search-line"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="جست‌وجوی کالا و فروشگاه...">
                        </div>

                        <div class="amount-display animate-fade delay-1">
                            <a href="credit-detials.php">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        <i class="ri-information-line align-middle me-1"></i>
                                        جزئیات اعتبار
                                    </span>
                                    <span class="amount">۱۳,۵۵۷,۹۱۱ ریال</span>
                                </div>
                            </a>
                        </div>

                        <div class="payment-info animate-fade delay-2">
                            <div class="payment-item">
                                <span class="text-muted">
                                    <i class="ri-money-dollar-circle-line align-middle me-1"></i>
                                    پرداخت:
                                </span>
                                <span class="fw-bold">۲,۴۲۰,۵۵۰ ریال</span>
                            </div>
                            <div class="payment-item">
                                <span class="text-muted">
                                    <i class="ri-time-line align-middle me-1"></i>
                                    سررسید:
                                </span>
                                <span class="deadline">پایان روز ۳۰ ماه</span>
                            </div>
                        </div>

                        <a class="btn btn-primary w-100 mt-4 py-3 animate-fade delay-2" href="credit-debt.php">
                            <i class="ri-bank-card-line align-middle me-2"></i>
                            پرداخت آنلاین
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- نویگیشن بار جدید -->
    <nav class="bottom-navigation">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="profile.php" class="nav-link">
                    <i class="ri-user-line"></i>
                    <span>پروفایل</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="ri-history-line"></i>
                    <span>سوابق</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="ri-store-2-line"></i>
                    <span>فروشگاه</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="ri-customer-service-line"></i>
                    <span>خدمات</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link active">
                    <i class="ri-home-4-line"></i>
                    <span>خانه</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- اسکریپت‌های جدید -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // انیمیشن برای آیتم‌ها
        document.addEventListener('DOMContentLoaded', function () {
            const items = document.querySelectorAll('.animate-fade');
            items.forEach(item => {
                item.style.opacity = '0';
            });

            setTimeout(() => {
                items.forEach(item => {
                    item.style.opacity = '1';
                });
            }, 100);
        });

        // تغییر فعال بودن آیتم‌های نویگیشن
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                navLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>