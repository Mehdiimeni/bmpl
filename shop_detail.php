<?php



header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies


session_start();

function convertToPersianNumber($number, $decimals = 0)
{
    $formatted = number_format($number, $decimals);
    $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ','];
    $fa = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٬'];
    return strtr($formatted, array_combine($en, $fa));
}

if (isset($_GET['mobileNumber'])) {
    $mobileNumber = $_GET['mobileNumber'];
    $api_url = 'http://192.168.50.15:7475/api/BNPL/login';
    $data = ['mobileNumber' => $mobileNumber];

    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($api_url, false, $context);
    $merchant = json_decode($response, true);



    if (isset($_SESSION['mobileNumber'])) {
    $mobileNumber = $_SESSION['mobileNumber'];
} else {
    session_unset();
    header('Location: login-user.php');
    exit();
}

// ارسال درخواست به API
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
$data = json_decode($response, true);

    // لیست کامل محصولات
    $products = [
        [
            'id' => 'PROD-101',
            'name' => 'لپ‌تاپ گیمینگ قدرتمند',
            'price' => 35000000,
            'rating' => 5,
            'description' => 'لپ‌تاپی مناسب برای بازی و کارهای سنگین با کارت گرافیک RTX'
        ],
        [
            'id' => 'PROD-102',
            'name' => 'هدفون بی‌سیم نویز کنسلینگ',
            'price' => 4200000,
            'rating' => 4,
            'description' => 'تجربه‌ای بی‌نظیر از صدا با حذف نویز فعال و باتری طولانی'
        ],
        [
            'id' => 'PROD-103',
            'name' => 'ماشین لباسشویی هوشمند',
            'price' => 18000000,
            'rating' => 4,
            'description' => 'ماشین لباسشویی کم‌مصرف با برنامه‌های متنوع شستشو'
        ],
        [
            'id' => 'PROD-104',
            'name' => 'ساعت هوشمند ورزشی',
            'price' => 2800000,
            'rating' => 3,
            'description' => 'همراهی ایده‌آل برای تمرینات ورزشی و پایش سلامتی'
        ],
        [
            'id' => 'PROD-105',
            'name' => 'قهوه‌ساز اتوماتیک',
            'price' => 7500000,
            'rating' => 4,
            'description' => 'تهیه قهوه‌ای لذیذ تنها با یک دکمه، دارای آسیاب داخلی'
        ],
        [
            'id' => 'PROD-106',
            'name' => 'تلفن همراه هوشمند مدل Z',
            'price' => 22000000,
            'rating' => 5,
            'description' => 'جدیدترین مدل گوشی هوشمند با دوربین فوق‌العاده'
        ],
        [
            'id' => 'PROD-107',
            'name' => 'تلویزیون هوشمند 4K',
            'price' => 12000000,
            'rating' => 4,
            'description' => 'تصویری خیره‌کننده با کیفیت 4K و قابلیت‌های هوشمند'
        ],
        [
            'id' => 'PROD-108',
            'name' => 'اسپیکر بلوتوثی قابل حمل',
            'price' => 1500000,
            'rating' => 3,
            'description' => 'صدای قوی و شفاف در یک طراحی جمع‌وجور'
        ],
        [
            'id' => 'PROD-109',
            'name' => 'پکیج آموزشی آنلاین زبان انگلیسی',
            'price' => 900000,
            'rating' => 4,
            'description' => 'دوره جامع آموزش زبان انگلیسی از مبتدی تا پیشرفته'
        ],
        [
            'id' => 'PROD-110',
            'name' => 'دوچرخه کوهستان حرفه‌ای',
            'price' => 11000000,
            'rating' => 4,
            'description' => 'دوچرخه‌ای مقاوم و سبک برای مسیرهای دشوار کوهستانی'
        ],
        [
            'id' => 'PROD-111',
            'name' => 'فر توکار برقی',
            'price' => 9500000,
            'rating' => 3,
            'description' => 'فری با قابلیت‌های پخت متنوع و صفحه نمایش لمسی'
        ],
        [
            'id' => 'PROD-112',
            'name' => 'جاروبرقی رباتیک هوشمند',
            'price' => 5500000,
            'rating' => 4,
            'description' => 'خانه‌ای تمیز با جاروبرقی خودکار و قابلیت کنترل از راه دور'
        ],
        [
            'id' => 'PROD-113',
            'name' => 'کنسول بازی نسل جدید',
            'price' => 16000000,
            'rating' => 5,
            'description' => 'تجربه بازی‌های هیجان‌انگیز با گرافیک بالا و سرعت بی‌نظیر'
        ],
        [
            'id' => 'PROD-114',
            'name' => 'دوربین عکاسی DSLR',
            'price' => 14000000,
            'rating' => 4,
            'description' => 'برای علاقه‌مندان به عکاسی، با لنز قابل تعویض و کیفیت تصویر عالی'
        ],
        [
            'id' => 'PROD-115',
            'name' => 'یخچال ساید بای ساید',
            'price' => 28000000,
            'rating' => 4,
            'description' => 'فضای بزرگ و طراحی مدرن، همراه با سیستم خنک‌کننده پیشرفته'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($merchant['merchantName'] ?? 'فروشگاه') ?></title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/brands.min.css">
    <link href="./assets/css/Vazirmatn-Variable-font-face.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #5b86e5;
            --secondary-color: #3656a8;
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --success-color: #28a745;
            --border-radius: 12px;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            padding-bottom: 80px;
        }

        .merchant-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1.5rem 0;
            margin-bottom: 1.5rem;
            border-radius: 0 0 25px 25px;
            box-shadow: var(--box-shadow);
        }

        .products-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .product-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.25rem;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-title {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.75rem;
        }

        .product-price {
            font-weight: 800;
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .product-rating {
            color: #ffc107;
            margin-bottom: 1rem;
        }

        .btn-buy {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            width: 100%;
        }

        .payment-options {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-top: 1rem;
            box-shadow: var(--box-shadow);
            grid-column: 1 / -1;
        }

        .payment-option-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-option-card:hover {
            background: #e9ecef;
        }

        .payment-option-card input[type="radio"] {
            accent-color: var(--primary-color);
        }

        .btn-pay-now {
            background-color: var(--success-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .products-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .products-container {
                grid-template-columns: 1fr;
            }
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
            background-color: rgba(91, 134, 229, 0.08);
            font-weight: 700;
        }

        .tf-navigation-bar li a.active i,
        .tf-navigation-bar li a.active svg {
            color: var(--primary-color);
        }

        .tf-navigation-bar li a:hover {
            color: var(--primary-color);
            background-color: rgba(91, 134, 229, 0.05);
        }

        .tf-navigation-bar li a:hover i,
        .tf-navigation-bar li a:hover svg {
            color: var(--primary-color);
        }


        /* Notification Panel (only if needed, otherwise remove) */
        .tf-panel {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1050;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* Aligned to top for notifications */
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s ease-in-out;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .tf-panel.active {
            visibility: visible;
            opacity: 1;
        }

        .tf-panel .panel-box {
            background: white;
            width: 100%;
            max-width: 500px;
            transform: translateY(-100%);
            /* Starts off-screen at the top */
            transition: transform 0.3s ease-in-out;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 0;
            /* No border-radius for top panel */
        }

        .tf-panel.active .panel-box {
            transform: translateY(0);
        }

        .tf-panel .header {
            padding: 1rem 0;
            background-color: white;
            border-bottom: 1px solid #eee;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .tf-panel .tf-statusbar {
            padding: 0 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tf-panel .tf-statusbar h3 {
            flex-grow: 1;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }

        .tf-panel .tf-statusbar a {
            color: #555;
            font-size: 1.2rem;
            text-decoration: none;
            padding: 5px;
        }
    </style>
</head>

<body>
    <header class="merchant-header">
        <div class="container">
            <h1 class="h4 mb-0 text-center"><?= htmlspecialchars($merchant['merchantName'] ?? 'فروشگاه') ?></h1>
        </div>
    </header>

    <main class="container">
        <h2 class="h5 mb-4 text-center">محصولات فروشگاه (<?= count($products) ?> محصول)</h2>

        <div class="products-container">
            <?php foreach ($products as $product): ?>
                <div class="product-card" data-product-id="<?= $product['id'] ?>">
                    <h3 class="product-title"><?= $product['name'] ?></h3>
                    <div class="product-price"><?= convertToPersianNumber($product['price']) ?> ریال</div>
                    <div class="product-rating">
                        <?= str_repeat('★', $product['rating']) . str_repeat('☆', 5 - $product['rating']) ?>
                    </div>
                    <p class="product-description mb-3"><?= $product['description'] ?></p>

                    <button class="btn btn-buy"
                        onclick="showPaymentOptions('<?= $product['id'] ?>', '<?= $product['name'] ?>', <?= $product['price'] ?>)">
                        <i class="fas fa-shopping-cart me-2"></i>خرید محصول
                    </button>
                </div>
            <?php endforeach; ?>

            <!-- بخش گزینه‌های پرداخت (در ابتدا مخفی است) -->
            <div id="paymentOptions" class="payment-options d-none">
                <h5 class="text-center mb-4">نحوه بازپرداخت اعتبار</h5>

                <div class="payment-option-card mb-3" data-option="full" onclick="selectPaymentOption('full')">
                    <label class="d-flex align-items-center justify-content-between w-100">
                        <span>تسویه تا 30 ام ماه</span>
                        <input type="radio" name="paymentType" value="full">
                    </label>
                    <div class="installment-details w-100 text-end">
                        مبلغ قابل پرداخت: <strong id="fullPaymentAmount">۰ ریال</strong>
                    </div>
                </div>

                <div class="payment-option-card" data-option="installments"
                    onclick="selectPaymentOption('installments')">
                    <label class="d-flex align-items-center justify-content-between w-100">
                        <span>4 قسط ماهانه</span>
                        <input type="radio" name="paymentType" value="installments">
                    </label>
                    <div class="installment-details w-100 text-end">
                        مبلغ هر قسط: <strong id="installmentAmount">۰ ریال</strong>
                        <small class="text-muted d-block">(۱۰٪ افزایش به دلیل اقساط)</small>
                    </div>
                </div>

                <button type="button" class="btn btn-pay-now w-100 mt-4" id="payNowBtn" onclick="submitPayment()"
                    disabled>
                    ثبت خرید
                </button>
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
                    
                    <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                            href="credit-debt.php<?php echo  '?sr=' . random_int(1, 1000000000) ; ?>" aria-label="سوابق"><i class="fas fa-clock-rotate-left"></i>
                            پرداخت</a></li>
                    <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="profile.php"
                            aria-label="پروفایل"><i class="fas fa-user-circle"></i> پروفایل</a></li>
                </ul>
            </div>
        </div>
    </main>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/sweetalert2@11.js"></script>

    <script>
        let currentProduct = null;

        function showPaymentOptions(productId, productName, productPrice) {
            currentProduct = {
                id: productId,
                name: productName,
                price: productPrice
            };

            // تنظیم مقادیر پرداخت
            $('#fullPaymentAmount').text(productPrice.toLocaleString('fa-IR') + ' ریال');
            $('#installmentAmount').text(Math.round(productPrice * 1.1 / 4).toLocaleString('fa-IR') + ' ریال');

            // مخفی کردن تمام دکمه‌های خرید
            $('.btn-buy').css('visibility', 'hidden');

            // نمایش گزینه‌های پرداخت
            $('#paymentOptions').removeClass('d-none');

            // غیرفعال کردن دکمه ثبت تا انتخاب روش پرداخت
            $('#payNowBtn').prop('disabled', true);

            // اسکرول به بخش پرداخت
            $('html, body').animate({
                scrollTop: $('#paymentOptions').offset().top - 20
            }, 300);
        }

        function selectPaymentOption(optionType) {
            // علامت‌گذاری گزینه انتخاب شده
            $(`input[name="paymentType"][value="${optionType}"]`).prop('checked', true);

            // فعال کردن دکمه ثبت
            $('#payNowBtn').prop('disabled', false);
        }

        function submitPayment() {
            if (!currentProduct) return;

            const paymentType = $('input[name="paymentType"]:checked').val();
            const paymentMethod = paymentType === 'full' ? 0 : 1;

            const postData = {
                buyerMerchantNumber: '<?= $data['merchantNumber'] ?>',
                sellerMerchantNumber: '<?= $merchant['merchantNumber'] ?>',
                amount: currentProduct.price,
                productCode: currentProduct.id,
                productName: currentProduct.name,
                paymentType: paymentMethod
            };

            // نمایش اسپینر
            $('#payNowBtn').html('<i class="fas fa-spinner fa-spin me-2"></i>در حال پردازش...');
            $('#payNowBtn').prop('disabled', true);

            // ارسال درخواست به API
            // ارسال درخواست از طریق پراکسی
            $.ajax({
                url: 'proxy-buy.php', // پراکسی سمت سرور
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(postData),
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'خرید موفق',
                            text: response.data,
                            confirmButtonText: 'باشه'
                        });

                        $('#paymentOptions').addClass('d-none');
                        $('.btn-buy').css('visibility', 'visible');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'خطا',
                            text: response.message || 'خطایی در انجام خرید رخ داده است',
                            confirmButtonText: 'باشه'
                        });
                    }
                },
                error: function (xhr) {
                    let errorMsg = 'خطا در ارتباط با سرور';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: errorMsg,
                        confirmButtonText: 'باشه'
                    });
                },
                complete: function () {
                    $('#payNowBtn').html('ثبت خرید');
                    $('#payNowBtn').prop('disabled', false);
                }
            });

        }
    </script>
</body>

</html>