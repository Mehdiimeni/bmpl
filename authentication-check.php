<?php
session_start();
require_once __DIR__ . '/./vendor/autoload.php'; // مسیر به autoload
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;

// ذخیره کد در سشن برای بررسی بعدی
if (isset($_POST['token']) && $_POST['token'] != '') {
    $_SESSION['payment_data'] = [
        'mobile' => $_POST['mobile'],
        'terminal_id' => $_POST['terminal_id'],
        'total_amount' => $_POST['total_amount'],
        'token' => $_POST['token'],
        'return_url' => $_POST['return_url'],
        'products' => $_POST['products']
    ];
}

if (!isset($_SESSION['mobileNumber'])) {
    showError('خطای دسترسی', 'شما وارد سیستم نشده‌اید. لطفاً ابتدا وارد شوید.', 'login-user.php?return_url=' . urlencode($_POST['return_url']));
}

if (!isset($_SESSION['payment_data']['mobile']) || $_SESSION['mobileNumber'] !== $_SESSION['payment_data']['mobile']) {
    showError('خطای احراز هویت', 'شماره موبایل نامعتبر است یا با اطلاعات حساب شما مطابقت ندارد.');
}

if (empty($_SESSION['payment_data']['token'])) {
    showError('خطای پرداخت', 'توکن پرداخت نامعتبر است یا ارسال نشده است.');
}

function showError($title, $message, $redirect = null)
{
    $redirect = $redirect ?? (isset($_SESSION['payment_data']['return_url']) ? htmlspecialchars($_SESSION['payment_data']['return_url']) : 'index.php');

    echo <<<HTML
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>$title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }
        .modal-dialog-centered-custom {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .modal-content {
            max-width: 100%;
            width: 90%;
            margin: auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .modal-body p {
            text-align: center;
            font-size: 1.1rem;
        }
        .modal-header, .modal-footer {
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="modal fade show d-block" id="errorModal" tabindex="-1" role="dialog" aria-modal="true">
      <div class="modal-dialog modal-dialog-centered-custom">
        <div class="modal-content border-danger">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title w-100 text-center">$title</h5>
          </div>
          <div class="modal-body">
            <p>$message</p>
          </div>
          <div class="modal-footer">
            <button id="redirectBtn" class="btn btn-danger w-50">ادامه</button>
          </div>
        </div>
      </div>
    </div>

    <script>
        document.getElementById('redirectBtn').addEventListener('click', function () {
            location.href = "$redirect";
        });

        setTimeout(() => {
            location.href = "$redirect";
        }, 7000); // Redirect after 7 seconds automatically
    </script>
</body>
</html>
HTML;
    exit;
}

// ذخیره اطلاعات دریافتی
$mobileNumber = $_SESSION['payment_data']['mobile'];
$terminalId = $_SESSION['payment_data']['terminal_id'];
$totalAmount = $_SESSION['payment_data']['total_amount'];
$products = $_SESSION['payment_data']['products'] ?? [];
$token = $_SESSION['payment_data']['token'];
$return_url = $_SESSION['payment_data']['return_url'];

// تابع بررسی توکن
function validateToken($receivedToken, $mobile, $terminalId)
{
    $secretKey = 'bnpl-intek-iw-123!@#'; // باید همان کلید تولید توکن باشد

    try {
        // دیکد کردن توکن
        $decoded = JWT::decode($receivedToken, new Key($secretKey, 'HS256'));

        // بررسی انقضای توکن
        if (time() > $decoded->exp) {
            return false;
        }

        // بررسی issuer (اختیاری)
        if ($decoded->iss !== 'your-app-name') {
            return false;
        }

        // بررسی تطابق موبایل و ترمینال
        if ($decoded->data->mobile !== $mobile || $decoded->data->terminal_id !== $terminalId) {
            return false;
        }

        return true;

    } catch (SignatureInvalidException $e) {
        error_log('Invalid token signature: ' . $e->getMessage());
        return false;
    } catch (BeforeValidException $e) {
        error_log('Token not yet valid: ' . $e->getMessage());
        return false;
    } catch (ExpiredException $e) {
        error_log('Expired token: ' . $e->getMessage());
        return false;
    } catch (DomainException | UnexpectedValueException $e) {
        error_log('Token validation error: ' . $e->getMessage());
        return false;
    }
}

if (!validateToken($token, $mobileNumber, $terminalId)) {
    die('توکن پرداخت نامعتبر یا منقضی شده است');
}

// دریافت نام پذیرنده
$acquirerName = 'نام پذیرنده';
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => 'http://192.168.50.15:7475/api/BNPL/GetMerchantByTerminalNumber/' . $terminalId,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
]);

$merchantResponse = curl_exec($curl);
if (curl_errno($curl)) {
    die('خطا در دریافت اطلاعات پذیرنده: ' . curl_error($curl));
}

$merchantData = json_decode($merchantResponse, true);
if ($merchantData && isset($merchantData['merchantName'])) {
    $acquirerName = $merchantData['merchantName'];
}
curl_close($curl);

// تولید کد تصادفی 8 رقمی
$verificationCode = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);

// محاسبه مبلغ اولیه پرداخت
$firstPayment = ($totalAmount / 4);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأیید پرداخت اعتباری</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .payment-summary {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .product-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .verification-box {
            max-width: 400px;
            margin: 0 auto;
        }

        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal {
            z-index: 1050 !important;
        }
    </style>
</head>

<body style="background-color: #f2f4f7; font-family: 'Vazirmatn', sans-serif;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h4 class="mb-0 text-center py-2">تأیید پرداخت اعتباری</h4>
                    </div>
                    <div class="card-body p-4">
                        <!-- اطلاعات پذیرنده -->
                        <div class="alert alert-info rounded-3">
                            <h5 class="mb-1">پذیرنده: <?= htmlspecialchars($acquirerName) ?></h5>
                            <p class="mb-0">شماره ترمینال: <?= htmlspecialchars($terminalId) ?></p>
                        </div>

                        <!-- اطلاعات محصولات -->
                        <div class="payment-summary mb-4">
                            <h5 class="mb-3 border-bottom pb-2">خلاصه سفارش</h5>
                            <?php foreach ($products as $product): ?>
                                <div class="product-item py-2 border-bottom d-flex flex-column">
                                    <div class="d-flex justify-content-between">
                                        <span><?= htmlspecialchars($product['name']) ?></span>
                                        <span class="text-end"><?= number_format($product['price']) ?> ریال</span>
                                    </div>
                                    <small class="text-muted">کد: <?= htmlspecialchars($product['id']) ?></small>
                                </div>
                            <?php endforeach; ?>
                            <div class="product-item py-3 mt-3 bg-light rounded-3 px-3">
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>پرداختی امروز:</span>
                                    <span><?= number_format($firstPayment) ?> ریال</span>
                                </div>
                            </div>
                            <div class="product-item py-3 mt-3 bg-light rounded-3 px-3">
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>جمع کل:</span>
                                    <span><?= number_format($totalAmount) ?> ریال</span>
                                </div>
                            </div>
                        </div>

                        <!-- فرم تأیید -->
                        <div class="verification-box">
                            <form id="verifyForm" method="POST" novalidate>
                                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                                <div class="mb-3">
                                    <label for="verificationCode" class="form-label fw-semibold">
                                        کد تأیید ارسال شده به <span
                                            class="text-primary"><?= htmlspecialchars($mobileNumber) ?></span>
                                    </label>
                                    <input type="text" class="form-control text-center fw-bold fs-5"
                                        id="verificationCode" name="verification_code" required maxlength="8"
                                        placeholder="مثلاً 12345678">
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-between">
                                    <button type="button" id="submitPayment" class="btn btn-success w-100 w-md-50">تأیید
                                        پرداخت</button>
                                    <a href="<?= htmlspecialchars($_SESSION['payment_data']['return_url']) ?>"
                                        class="btn btn-outline-secondary w-100 w-md-50">انصراف و بازگشت</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- مودال پرداخت -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">پیش پرداخت الزامی</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <input type="hidden" id="mobileNumber" value="<?= $mobileNumber ?>">
                        <input type="hidden" id="firstPayment" value="<?= $firstPayment ?>">
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">مبلغ پیش پرداخت</label>
                            <?php echo number_format(($firstPayment)); ?> ریال
                        </div>
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">شماره کارت</label>
                            <input type="text" class="form-control" id="cardNumber" placeholder="6037-XXXX-XXXX-XXXX"
                                maxlength="19">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="expiryMonth" class="form-label">ماه انقضا (MM)</label>
                                <input type="text" class="form-control" id="expiryMonth" placeholder="00" maxlength="2"
                                    inputmode="numeric">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="expiryYear" class="form-label">سال انقضا (YY)</label>
                                <input type="text" class="form-control" id="expiryYear" placeholder="00" maxlength="2"
                                    inputmode="numeric">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cvv2" class="form-label">CVV2</label>
                                <input type="password" class="form-control" id="cvv2" placeholder="XXX" maxlength="4">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">رمز دوم</label>
                                <input type="password" class="form-control" id="password" placeholder="رمز دوم کارت">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    <button type="button" id="confirmPayment" class="btn btn-primary">تأیید پرداخت</button>
                </div>
            </div>
        </div>
    </div>

    <!-- اسکریپت‌های مورد نیاز -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // اعتبارسنجی فرم تأیید
        document.getElementById('verifyForm').addEventListener('submit', function (e) {
            e.preventDefault();
        });

        // باز کردن مودال پرداخت هنگام کلیک روی دکمه تأیید پرداخت
        document.getElementById('submitPayment').addEventListener('click', function () {
            const codeInput = document.getElementById('verificationCode');

            if (!/^\d{8}$/.test(codeInput.value.trim())) {
                Swal.fire({
                    icon: 'error',
                    title: 'خطا',
                    text: 'لطفاً کد تأیید 8 رقمی را صحیح وارد کنید',
                    confirmButtonText: 'متوجه شدم'
                });
                codeInput.focus();
                return;
            }

            // نمایش مودال پرداخت
            const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            paymentModal.show();
        });

        // اعتبارسنجی فرم پرداخت
        document.getElementById('confirmPayment').addEventListener('click', async function () {
            const mobileNumber = document.getElementById('mobileNumber').value;
            const firstPayment = document.getElementById('firstPayment').value;
            const confirmPaymentBtn = document.getElementById('confirmPayment');

            // اعتبارسنجی اطلاعات کارت
            const cardNumber = document.getElementById('cardNumber').value.replace(/\D/g, '');
            const expiryMonth = document.getElementById('expiryMonth').value.padStart(2, '0');
            const expiryYear = document.getElementById('expiryYear').value;
            const cvv2 = document.getElementById('cvv2').value;
            const password = document.getElementById('password').value;

            if (!cardNumber || cardNumber.length !== 16) {
                await Swal.fire('خطا', 'شماره کارت معتبر نیست', 'error');
                return;
            }

            if (!expiryMonth || expiryMonth.length !== 2 || parseInt(expiryMonth) < 1 || parseInt(expiryMonth) > 12) {
                await Swal.fire('خطا', 'ماه انقضا معتبر نیست', 'error');
                return;
            }

            if (!expiryYear || expiryYear.length !== 2) {
                await Swal.fire('خطا', 'سال انقضا معتبر نیست', 'error');
                return;
            }

            if (!cvv2 || cvv2.length < 3 || cvv2.length > 4) {
                await Swal.fire('خطا', 'CVV2 معتبر نیست', 'error');
                return;
            }

            if (!password) {
                await Swal.fire('خطا', 'رمز دوم را وارد کنید', 'error');
                return;
            }

            // UI Feedback
            const originalText = confirmPaymentBtn.innerHTML;
            confirmPaymentBtn.disabled = true;
            confirmPaymentBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> در حال پردازش...';

            try {
                // ساخت داده‌های ارسالی
                const paymentData = {
                    mobileNumber: mobileNumber,
                    amount: firstPayment,
                    cardDetails: {
                        number: cardNumber,
                        expiry: `${expiryMonth}/${expiryYear}`,
                        cvv: cvv2
                    }
                };

                // ارسال درخواست به API
                const apiUrl = `./proxy-settle.php?mobileNumber=${encodeURIComponent(mobileNumber)}&amount=${encodeURIComponent(firstPayment)}`;

                const response = await fetch(apiUrl, {
                    method: 'PUT'
                });

                if (!response.ok) {
                    const error = await response.text();
                    throw new Error(error || 'خطا در ارتباط با سرور');
                }

                const result = await response.json();

                if (result.success) {
                    // بستن مودال
                    const paymentModal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
                    paymentModal.hide();

                    await Swal.fire({
                        icon: 'success',
                        title: 'پرداخت موفق',
                        text: `پرداخت مبلغ ${new Intl.NumberFormat().format(firstPayment)} ریال با موفقیت انجام شد`,
                        confirmButtonText: 'باشه'
                    });

                    // ارسال فرم و انتقال به صفحه پرداخت
                    document.getElementById('verifyForm').action = 'process-payment.php';
                    document.getElementById('verifyForm').submit();
                } else {
                    throw new Error(result.message || 'خطا در پرداخت');
                }
            } catch (error) {
                console.error('Payment error:', error);
                await Swal.fire({
                    icon: 'error',
                    title: 'خطا در پرداخت',
                    text: error.message || 'خطایی در پرداخت رخ داده است',
                    confirmButtonText: 'متوجه شدم'
                });
            } finally {
                confirmPaymentBtn.disabled = false;
                confirmPaymentBtn.innerHTML = originalText;
            }
        });

        // فرمت شماره کارت
        document.getElementById('cardNumber').addEventListener('input', function (e) {
            let value = this.value.replace(/\D/g, '');
            let formatted = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) formatted += '-';
                formatted += value[i];
            }
            this.value = formatted;
        });

        // اعتبارسنجی ماه انقضا
        document.getElementById('expiryMonth').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 2);
            if (this.value.length === 1 && parseInt(this.value) > 1) {
                this.value = '0' + this.value;
            }
            if (this.value.length === 2 && parseInt(this.value) > 12) {
                this.value = '12';
            }
        });

        // اعتبارسنجی سال انقضا
        document.getElementById('expiryYear').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 2);
        });
    </script>

    <!-- فونت فارسی -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn-font@v33.003/Vazirmatn-font-face.css" rel="stylesheet"
        type="text/css" />
</body>

</html>