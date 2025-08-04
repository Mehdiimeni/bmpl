<?php
session_start();

if (isset($_SESSION['mobileNumber'])) {
    $mobileNumber = $_SESSION['mobileNumber'];
} else {
    session_unset();
    header('Location: login-user.php');
    exit();
}


$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://192.168.50.15:7475/api/BNPL/login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
    CURLOPT_POSTFIELDS => json_encode(['mobileNumber' => $mobileNumber])
));

$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);


// تلاش برای تبدیل به JSON
$userData = json_decode($response, true);

$merchantNumber = $userData['merchantNumber'];

// دریافت لیست محصولات
$buyHistoryUrl = "http://192.168.50.15:7475/api/BNPL/buy-history?merchantNumber={$merchantNumber}";
$buyHistory = json_decode(file_get_contents($buyHistoryUrl), true);

$inProgress = [];
$completed = [];

if ($buyHistory['success'] && !empty($buyHistory['data'])) {
    foreach ($buyHistory['data'] as $product) {
        $productId = $product['productId'];
        $productName = $product['productName'];

        // دریافت اقساط محصول
        $installmentsUrl = "http://192.168.50.15:7475/api/BNPL/Installments?mobileNumber={$mobileNumber}&productId={$productId}";
        $installments = json_decode(file_get_contents($installmentsUrl), true);

        if ($installments['success'] && !empty($installments['data'])) {
            $totalPrice = 0;
            $totalPaid = 0;
            $allPaid = true;
            $details = [];

            foreach ($installments['data'] as $index => $inst) {
                $price = $inst['price'];
                $isPaid = $inst['isPayed'];
                $payDate = $inst['payDate'];

                $totalPrice += $price;
                if ($isPaid) {
                    $totalPaid += $price;
                } else {
                    $allPaid = false;
                }

                $details[] = [
                    'date' => $payDate,
                    'price' => $price,
                    'isPaid' => $isPaid
                ];
            }

            $productData = [
                'name' => $productName,
                'totalPrice' => $totalPrice,
                'totalPaid' => $totalPaid,
                'installments' => $details
            ];

            if ($allPaid) {
                $completed[] = $productData;
            } else {
                $inProgress[] = $productData;
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خریدهای اقساطی من</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #0056b3;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --background-light: #f8f9fa;
            --text-dark: #212529;
            --text-muted: #6c757d;
            --border-light: #dee2e6;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            padding-bottom: 100px;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1.5rem 0;
            border-radius: 0 0 20px 20px;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .nav-tabs {
            border-bottom: none;
            margin-bottom: 1.5rem;
            justify-content: center;
        }

        .nav-tabs .nav-link {
            border: none;
            color: var(--text-muted);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            position: relative;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            background-color: transparent;
        }

        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 50%;
            transform: translateX(50%);
            width: 50%;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px 3px 0 0;
        }

        .badge-count {
            background-color: var(--primary-color);
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
            margin-right: 0.5rem;
        }

        .product-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product-header {
            padding: 1rem;
            border-bottom: 1px solid var(--border-light);
            cursor: pointer;
        }

        .product-title {
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .product-price {
            color: var(--primary-color);
            font-weight: 600;
        }

        .installment-details {
            padding: 1rem;
        }

        .installment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px dashed var(--border-light);
        }

        .installment-item:last-child {
            border-bottom: none;
        }

        .installment-date {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .installment-amount {
            font-weight: 600;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .status-paid {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .status-unpaid {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }

        .total-paid {
            background-color: rgba(40, 167, 69, 0.15);
            padding: 0.75rem;
            border-radius: 8px;
            margin-top: 1rem;
            font-weight: 600;
            color: var(--success-color);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 0;
            z-index: 1000;
        }

        .nav-item {
            text-align: center;
        }

        .nav-link {
            color: var(--text-muted);
            font-size: 0.8rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .nav-link.active {
            color: var(--primary-color);
        }

        .nav-link i {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        /* اضافه شده برای نمایش صحیح collapse */
        .collapse:not(.show) {
            display: none;
        }

        .collapse.show {
            display: block;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>خریدهای اقساطی من</h1>
        <p>مدیریت خریدها و پرداخت‌های اقساطی</p>
    </div>

    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="inprogress-tab" data-bs-toggle="tab" data-bs-target="#inprogress">
                    <span class="badge-count"><?= count($inProgress) ?></span> در جریان
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed">
                    <span class="badge-count"><?= count($completed) ?></span> تسویه شده
                </button>
            </li>
        </ul>

        <div class="tab-content">
            <!-- تب در جریان -->
            <div class="tab-pane fade show active" id="inprogress">
                <?php foreach ($inProgress as $idx => $prod): ?>
                    <div class="product-card">
                        <div class="product-header" data-bs-toggle="collapse" data-bs-target="#prodIn<?= $idx ?>">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5><?= htmlspecialchars($prod['name']) ?></h5>
                                    <div class="product-price"><?= number_format($prod['totalPrice']) ?> ریال</div>
                                </div>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="collapse" id="prodIn<?= $idx ?>">
                            <div class="installment-details">
                                <?php foreach ($prod['installments'] as $i => $inst): ?>
                                    <div class="installment-item">
                                        <div class="installment-date">قسط <?= $i + 1 ?> - <?= $inst['date'] ?></div>
                                        <div class="d-flex align-items-center">
                                            <span class="installment-amount"><?= number_format($inst['price']) ?> ریال</span>
                                            <?php if ($inst['isPaid']): ?>
                                                <span class="status-badge status-paid ms-2">پرداخت شده</span>
                                            <?php else: ?>
                                                <span class="status-badge status-unpaid ms-2">پرداخت نشده</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="total-paid">
                                    مجموع پرداختی: <?= number_format($prod['totalPaid']) ?> ریال از
                                    <?= number_format($prod['totalPrice']) ?> ریال
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- تب تسویه شده -->
            <div class="tab-pane fade" id="completed">
                <?php foreach ($completed as $idx => $prod): ?>
                    <div class="product-card">
                        <div class="product-header" data-bs-toggle="collapse" data-bs-target="#prodCo<?= $idx ?>">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5><?= htmlspecialchars($prod['name']) ?></h5>
                                    <div class="product-price"><?= number_format($prod['totalPrice']) ?> ریال</div>
                                </div>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="collapse" id="prodCo<?= $idx ?>">
                            <div class="installment-details">
                                <?php foreach ($prod['installments'] as $i => $inst): ?>
                                    <div class="installment-item">
                                        <div class="installment-date">قسط <?= $i + 1 ?> - <?= $inst['date'] ?></div>
                                        <div class="d-flex align-items-center">
                                            <span class="installment-amount"><?= number_format($inst['price']) ?> ریال</span>
                                            <span class="status-badge status-paid ms-2">پرداخت شده</span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="total-paid">
                                    مجموع پرداختی: <?= number_format($prod['totalPaid']) ?> ریال از
                                    <?= number_format($prod['totalPrice']) ?> تومان
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- نوار پایین -->
    <nav class="bottom-nav">
        <div class="container">
            <div class="row">
                <div class="col nav-item">
                    <a href="credit.php<?php echo '?sr=' . random_int(1, 1000000000); ?>" class="nav-link">
                        <i class="fas fa-home"></i>
                        خانه
                    </a>
                </div>
                <div class="col nav-item">
                    <a href="credit-debt.php<?php echo '?sr=' . random_int(1, 1000000000); ?>" aria-label="پرداخت"
                        class="nav-link">
                        <i class="fas fa-credit-card"></i>
                        پرداخت
                    </a>
                </div>
                <div class="col nav-item">
                    <a href="history.php<?php echo '?sr=' . random_int(1, 1000000000); ?>" class="nav-link active">
                        <i class="fas fa-clock-rotate-left"></i>
                        تاریخچه
                    </a>
                </div>
                <div class="col nav-item">
                    <a href="profile.php<?php echo '?sr=' . random_int(1, 1000000000); ?>" class="nav-link">
                        <i class="fas fa-user"></i>
                        پروفایل
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- اضافه کردن jQuery و Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // اسکریپت برای تغییر آیکون هنگام باز و بسته شدن منوهای کرکره‌ای
        document.querySelectorAll('.product-header').forEach(header => {
            header.addEventListener('click', function () {
                const icon = this.querySelector('i');
                const targetId = this.getAttribute('data-bs-target');
                const targetElement = document.querySelector(targetId);

                // استفاده از رویدادهای collapse در بوت‌استرپ 5
                targetElement.addEventListener('show.bs.collapse', function () {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                });

                targetElement.addEventListener('hide.bs.collapse', function () {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                });
            });
        });
    </script>
</body>

</html>