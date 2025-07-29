<?php 

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تاریخچه پرداخت‌ها و سفارشات</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/brands.min.css">
    <link href="./assets/css/Vazirmatn-Variable-font-face.css" rel="stylesheet" type="text/css" />

    <style>
        :root {
            --primary-color: #5b86e5;
            --secondary-color: #3656a8;
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --text-color-light: #6c757d;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --card-shadow-soft: 0 5px 15px rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
            line-height: 1.6;
            padding-bottom: 80px;
        }

        .container {
            max-width: 700px;
            /* Slightly wider container for better card display */
        }

        /* Header Styles */
        .main-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem 0;
            border-radius: 0 0 25px 25px;
            box-shadow: 0 8px 25px rgba(78, 115, 223, 0.2);
            position: relative;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .main-header::before,
        .main-header::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            filter: blur(3px);
            z-index: 0;
        }

        .main-header::before {
            top: -40px;
            right: -40px;
            width: 150px;
            height: 150px;
        }

        .main-header::after {
            bottom: -60px;
            left: -20px;
            width: 200px;
            height: 200px;
        }

        .main-header h1,
        .main-header p {
            position: relative;
            z-index: 1;
        }

        .main-header h1 {
            font-weight: 800;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }

        .main-header p {
            font-weight: 400;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        /* Section Header Styles (for "تسویه ماهانه" and "اقساطی") */
        .section-category-header {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            margin: 2.5rem 0 1rem 0;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* To push icon and text apart */
            font-weight: 700;
            font-size: 1.3rem;
        }

        .section-category-header i {
            margin-left: 0.75rem;
            /* Space from icon in RTL */
            font-size: 1.4rem;
        }

        /* Search Box */
        .search-box {
            position: relative;
            margin-bottom: 2rem;
        }

        .search-box input {
            width: 100%;
            padding: 0.8rem 1.2rem;
            padding-right: 3.5rem;
            /* Space for icon */
            border: 1px solid var(--text-color-light);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: white;
            color: var(--dark-color);
        }

        .search-box input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(91, 134, 229, 0.25);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 1.2rem;
            /* Position icon on the left in RTL */
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-color-light);
            font-size: 1.2rem;
            pointer-events: none;
            /* Make icon non-clickable */
        }

        /* Order Card Styles (General for both types) */
        .order-card {
            background-color: white;
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow-soft);
            margin-bottom: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }

        .order-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            cursor: pointer;
            border-radius: 12px 12px 0 0;
        }

        .order-card-header:hover {
            background-color: #f8faff;
        }

        .order-title {
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--dark-color);
        }

        .order-details-summary {
            font-size: 0.95rem;
            color: var(--text-color-light);
        }

        .accordion-icon {
            transition: transform 0.3s ease;
        }

        .order-card.active .accordion-icon {
            transform: rotate(180deg);
        }

        .order-card-body {
            padding: 0 1.5rem;
            /* Initial horizontal padding */
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out, padding 0.4s ease-out;
            background-color: #fcfdfe;
        }

        .order-card.active .order-card-body {
            padding: 1.5rem;
            max-height: 500px;
            /* Adjust as needed for content */
        }

        .order-detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            color: var(--text-color-light);
        }

        .order-detail-item span:first-child {
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Status Badges */
        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .status-paid {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }

        .status-failed {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        /* Summary Totals */
        .summary-totals {
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow-soft);
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px dashed var(--border-light);
            font-size: 1.1rem;
            color: var(--dark-color);
        }

        .summary-item:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 1.2rem;
            padding-top: 1rem;
        }

        .summary-item span:last-child {
            font-weight: 700;
            color: var(--primary-color);
        }

        /* No transactions message */
        .no-transactions-message {
            text-align: center;
            color: var(--text-color-light);
            padding: 2rem;
            border-radius: 12px;
            background-color: white;
            box-shadow: var(--card-shadow-soft);
            margin-top: 1rem;
        }

        /* Bottom Navigation Bar - Consistent with previous pages */
        .bottom-navigation-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 -0.5rem 2rem rgba(0, 0, 0, 0.08);
            z-index: 1000;
            padding: 0.75rem 0;
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
        }

        .tf-navigation-bar {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100%;
        }

        .tf-navigation-bar li {
            flex: 1;
            text-align: center;
        }

        .tf-navigation-bar li a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0.25rem;
            color: #888;
            text-decoration: none;
            font-size: 0.8rem;
            transition: color 0.3s ease, transform 0.2s ease;
            font-weight: 500;
        }

        .tf-navigation-bar li a i {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
            transition: color 0.3s ease;
        }

        .tf-navigation-bar li a.active,
        .tf-navigation-bar li a:hover {
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .tf-navigation-bar li a.active i,
        .tf-navigation-bar li a:hover i {
            color: var(--primary-color);
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .main-header {
                padding: 1.5rem 0;
                border-radius: 0 0 15px 15px;
                margin-bottom: 1.5rem;
            }

            .main-header h1 {
                font-size: 1.8rem;
            }

            .main-header p {
                font-size: 0.95rem;
            }

            .section-category-header {
                padding: 0.6rem 1rem;
                font-size: 1.1rem;
                margin: 1.5rem 0 0.8rem 0;
            }

            .section-category-header i {
                font-size: 1.2rem;
                margin-left: 0.5rem;
            }

            .search-box input {
                padding: 0.7rem 1rem;
                padding-right: 3rem;
                font-size: 0.9rem;
            }

            .search-box i {
                left: 1rem;
                font-size: 1.1rem;
            }

            .order-card-header {
                padding: 0.8rem 1rem;
            }

            .order-title {
                font-size: 1rem;
            }

            .order-details-summary {
                font-size: 0.85rem;
            }

            .order-card-body {
                padding: 1rem !important;
            }

            .order-detail-item {
                font-size: 0.85rem;
            }

            .status-badge {
                font-size: 0.75rem;
                padding: 0.2rem 0.5rem;
            }

            .summary-totals {
                padding: 1rem;
                margin-top: 1.5rem;
            }

            .summary-item {
                font-size: 1rem;
                padding: 0.3rem 0;
            }

            .summary-item:last-child {
                font-size: 1.1rem;
                padding-top: 0.8rem;
            }

            .bottom-navigation-bar {
                padding: 0.5rem 0;
            }

            .tf-navigation-bar li a {
                font-size: 0.7rem;
            }

            .tf-navigation-bar li a i {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="main-header text-center">
        <div class="container">
            <h1>تاریخچه پرداخت‌ها</h1>
            <p>مشاهده تمام خریدهای شما</p>
        </div>
    </div>

    <div class="container">
        <div class="search-box">
            <input type="text" id="searchInput" onkeyup="filterOrders()" placeholder="جستجو در تراکنش‌ها..."
                aria-label="جستجو در تراکنش‌ها">
            <i class="fas fa-search"></i>
        </div>

        <div class="section-category-header">
            <span><i class="fas fa-calendar-alt me-2"></i>تسویه تا ۳۰ ام ماه</span>
        </div>
        <div id="fullPaymentOrdersList">
            <div class="no-transactions-message" id="noFullPayments" style="display: none;">
                تراکنشی برای تسویه تا ۳۰ ام ماه یافت نشد.
            </div>
        </div>

        <div class="section-category-header">
            <span><i class="fas fa-handshake me-2"></i>اقساط ۴ ماهه</span>
        </div>
        <div id="installmentOrdersList">
            <div class="no-transactions-message" id="noInstallments" style="display: none;">
                تراکنشی برای اقساط ۴ ماهه یافت نشد.
            </div>
        </div>

        <div class="summary-totals">
            <h4 class="text-center mb-3">جمع کل خریدها</h4>
            <div class="summary-item">
                <span>جمع خریدهای تسویه ماهانه:</span>
                <span id="totalFullPayments">۰ ریال</span>
            </div>
            <div class="summary-item">
                <span>جمع خریدهای اقساطی:</span>
                <span id="totalInstallments">۰ ریال</span>
            </div>
            <div class="summary-item">
                <span>جمع کل خریدها:</span>
                <span id="grandTotal">۰ ریال</span>
            </div>
        </div>
    </div>

    <div class="bottom-navigation-bar">
        <div class="container">
            <ul class="tf-navigation-bar">
                <li><a class="fw_6 d-flex justify-content-center align-items-center flex-column " href="credit.php<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>"
                        aria-label="خانه"><i class="fas fa-home"></i> خانه</a></li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="service.php"
                        aria-label="خدمات">
                        <i class="fas fa-bell-concierge"></i> خدمات</a></li>
                
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column active"
                        href="credit-debt.php<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>" aria-label="سوابق"><i class="fas fa-clock-rotate-left"></i> پرداخت</a>
                </li>
                <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>"
                        aria-label="پروفایل"><i class="fas fa-user-circle"></i> پروفایل</a></li>
            </ul>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sample data - In a real application, this would come from a backend (PHP)
        const allOrders = [
            { id: 'O1001', date: '۱۴۰۴/۰۱/۰۴', status: 'paid', amount: 289000, type: 'گوشی تلفن همراه', code: '۱۶۷۳۳۴', paymentType: 'full', description: 'خرید یک عدد گوشی هوشمند جدید', installmentDetails: '' },
            { id: 'O1002', date: '۱۴۰۴/۰۱/۰۴', status: 'paid', amount: 300000, type: 'شارژ کیف پول', code: '۷۶۵۴۳۲', paymentType: 'full', description: 'افزایش موجودی کیف پول اعتباری', installmentDetails: '' },
            { id: 'O1003', date: '۱۴۰۳/۱۲/۱۰', status: 'pending', amount: 1200000, type: 'لوازم خانگی', code: '۲۲۳۴۵۶', paymentType: 'installment', description: 'خرید ماشین لباسشویی', installmentDetails: '۴ قسط ماهیانه ۳۱۵,۰۰۰ ریال' },
            { id: 'O1004', date: '۱۴۰۳/۱۱/۲۰', status: 'paid', amount: 500000, type: 'کتاب دیجیتال', code: '۴۵۶۷۸۹', paymentType: 'full', description: 'خرید مجموعه کتاب‌های آموزشی', installmentDetails: '' },
            { id: 'O1005', date: '۱۴۰۳/۱۰/۱۵', status: 'paid', amount: 800000, type: 'خدمات رستوران', code: '۸۹۰۱۲۳', paymentType: 'full', description: 'پرداخت صورتحساب رستوران', installmentDetails: '' },
            { id: 'O1006', date: '۱۴۰۳/۰۹/۰۵', status: 'pending', amount: 1800000, type: 'بلیت هواپیما', code: '۹۹۸۷۶۵', paymentType: 'installment', description: 'بلیت رفت و برگشت به مشهد', installmentDetails: '۴ قسط ماهیانه ۴۷۲,۵۰۰ ریال' },
            { id: 'O1007', date: '۱۴۰۳/۰۸/۲۸', status: 'paid', amount: 187960, type: 'خدمات اینترنت', code: '۸۹۰۱۲۳', paymentType: 'full', description: 'تمدید اشتراک اینترنت پرسرعت', installmentDetails: '' },
            { id: 'O1008', date: '۱۴۰۳/۰۷/۱۰', status: 'paid', amount: 450000, type: 'کتاب دیجیتال', code: '۴۵۶۷۸۹', paymentType: 'full', description: 'خرید کتاب الکترونیکی', installmentDetails: '' },
            { id: 'O1009', date: '۱۴۰۳/۰۶/۲۰', status: 'paid', amount: 1500000, type: 'لباس ورزشی', code: '۲۳۴۵۶۷', paymentType: 'full', description: 'خرید لباس و کفش ورزشی', installmentDetails: '' },
            { id: 'O1010', date: '۱۴۰۳/۰۵/۰۵', status: 'paid', amount: 75000, type: 'قهوه', code: '۹۸۷۶۵۴', paymentType: 'full', description: 'خرید از کافه', installmentDetails: '' },
            { id: 'O1011', date: '۱۴۰۳/۰۴/۱۲', status: 'paid', amount: 2000000, type: 'تعمیر لپ‌تاپ', code: '۱۳۵۷۹۰', paymentType: 'full', description: 'تعمیرات تخصصی لپ‌تاپ', installmentDetails: '' },
            { id: 'O1012', date: '۱۴۰۳/۰۳/۰۱', status: 'paid', amount: 125000, type: 'بلیت سینما', code: '۲۴۶۸۰۰', paymentType: 'full', description: 'خرید بلیت فیلم', installmentDetails: '' },
            { id: 'O1013', date: '۱۴۰۳/۰۲/۱۵', status: 'paid', amount: 950000, type: 'کفش ورزشی', code: '۳۶۹۱۵۹', paymentType: 'full', description: 'خرید کفش ورزشی جدید', installmentDetails: '' },
            { id: 'O1014', date: '۱۴۰۳/۰۱/۳۰', status: 'paid', amount: 600000, type: 'اشتراک نرم‌افزار', code: '۷۸۹۰۱۲', paymentType: 'full', description: 'تمدید اشتراک سالانه نرم‌افزار', installmentDetails: '' },
            { id: 'O1015', date: '۱۴۰۳/۰۱/۲۵', status: 'pending', amount: 2500000, type: 'لوازم الکترونیک', code: '۱۱۱۵۵۵', paymentType: 'installment', description: 'خرید هدفون بی‌سیم', installmentDetails: '۴ قسط ماهیانه ۶۵۶,۲۵۰ ریال' }
        ];

        function formatCurrency(amount) {
            return amount.toLocaleString('fa-IR') + ' ریال';
        }

        function getStatusBadge(status) {
            switch (status) {
                case 'paid':
                    return '<span class="status-badge status-paid">پرداخت شده</span>';
                case 'pending':
                    return '<span class="status-badge status-pending">در انتظار پرداخت</span>';
                case 'failed':
                    return '<span class="status-badge status-failed">ناموفق</span>';
                default:
                    return '';
            }
        }

        function createOrderCard(order) {
            const card = document.createElement('div');
            card.className = 'order-card';
            card.setAttribute('data-search-terms', `${order.date} ${order.type} ${order.amount} ${order.code} ${order.description} ${order.installmentDetails}`);

            card.innerHTML = `
                <div class="order-card-header" onclick="toggleOrderCard(this)">
                    <div>
                        <div class="order-title">${order.type}</div>
                        <div class="order-details-summary">${formatCurrency(order.amount)} - ${order.date}</div>
                    </div>
                    <i class="fas fa-chevron-down accordion-icon"></i>
                </div>
                <div class="order-card-body">
                    <div class="order-detail-item">
                        <span>تاریخ:</span>
                        <span>${order.date}</span>
                    </div>
                    <div class="order-detail-item">
                        <span>مبلغ:</span>
                        <span>${formatCurrency(order.amount)}</span>
                    </div>
                    <div class="order-detail-item">
                        <span>نوع پرداخت:</span>
                        <span>${order.paymentType === 'full' ? 'تسویه تا ۳۰ام ماه' : '۴ قسط ماهانه'}</span>
                    </div>
                    ${order.paymentType === 'installment' ? `
                    <div class="order-detail-item">
                        <span>جزئیات اقساط:</span>
                        <span>${order.installmentDetails}</span>
                    </div>
                    ` : ''}
                    <div class="order-detail-item">
                        <span>وضعیت:</span>
                        <span>${getStatusBadge(order.status)}</span>
                    </div>
                    <div class="order-detail-item">
                        <span>کد پیگیری:</span>
                        <span>${order.code}</span>
                    </div>
                    <div class="order-detail-item">
                        <span>توضیحات:</span>
                        <span>${order.description}</span>
                    </div>
                </div>
            `;
            return card;
        }

        function renderOrders(orders) {
            const fullPaymentList = document.getElementById('fullPaymentOrdersList');
            const installmentList = document.getElementById('installmentOrdersList');
            const noFullPaymentsMsg = document.getElementById('noFullPayments');
            const noInstallmentsMsg = document.getElementById('noInstallments');

            fullPaymentList.innerHTML = ''; // Clear previous content
            installmentList.innerHTML = '';
            noFullPaymentsMsg.style.display = 'none';
            noInstallmentsMsg.style.display = 'none';

            let totalFullPayments = 0;
            let totalInstallments = 0;
            let fullCount = 0;
            let installmentCount = 0;

            orders.forEach(order => {
                const card = createOrderCard(order);
                if (order.paymentType === 'full') {
                    fullPaymentList.appendChild(card);
                    totalFullPayments += order.amount;
                    fullCount++;
                } else if (order.paymentType === 'installment') {
                    installmentList.appendChild(card);
                    totalInstallments += order.amount;
                    installmentCount++;
                }
            });

            if (fullCount === 0) {
                fullPaymentList.appendChild(noFullPaymentsMsg);
                noFullPaymentsMsg.style.display = 'block';
            }
            if (installmentCount === 0) {
                installmentList.appendChild(noInstallmentsMsg);
                noInstallmentsMsg.style.display = 'block';
            }

            // Update summary totals
            document.getElementById('totalFullPayments').textContent = formatCurrency(totalFullPayments);
            document.getElementById('totalInstallments').textContent = formatCurrency(totalInstallments);
            document.getElementById('grandTotal').textContent = formatCurrency(totalFullPayments + totalInstallments);
        }

        function toggleOrderCard(header) {
            const card = header.closest('.order-card');
            card.classList.toggle('active');
        }

        function filterOrders() {
            const searchInput = document.getElementById('searchInput');
            const filter = searchInput.value.toLowerCase();
            const filteredOrders = allOrders.filter(order => {
                const searchTerms = `${order.date} ${order.type} ${order.amount} ${order.code} ${order.description} ${order.installmentDetails} ${order.status === 'paid' ? 'پرداخت شده' : order.status === 'pending' ? 'در انتظار پرداخت' : 'ناموفق'}`;
                return searchTerms.toLowerCase().includes(filter);
            });
            renderOrders(filteredOrders);
        }

        // Initial rendering on page load
        document.addEventListener('DOMContentLoaded', () => {
            renderOrders(allOrders);
        });
    </script>
</body>

</html>