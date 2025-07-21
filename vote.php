<?php
require "./top.php";
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رای دهی</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/fonts.css" />
    <!-- Icons -->
    <link rel="stylesheet" href="./assets/icons-alipay.css">
    <link rel="stylesheet" href="./assets/bootstrap.css">
    <link rel="stylesheet" href="./assets/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/styles.css" />

</head>

<body>
    <!-- preloade -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div class="header is-fixed">
        <div class="tf-container">
            <div class="tf-statusbar d-flex justify-content-center align-items-center">
                <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
                <h3>انتخابات</h3>
            </div>
        </div>
    </div>

    <div class="bill-content">
    <div class="tf-container">
<br>
<br>
<br>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"> نکته</div>
                        <div class="card-body">
                            هر شخص در این سامانه یک بار و فقط به یک نفر می تواند رای دهد . قبل از ثبت رای حتما پیامکی برای تشخیص هویت شما اراسل میگردد
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="fw_6 mt-3">نمایندگان</h3>
        <ul class="mt-3 box-outstanding-service">
            <li>
            <div class="swiper-slide">
                        <a class="vote-link" data-id="1">
                            <img src="./images/user2.jpg" alt="images">
                            حسن ابراهیمی
                        </a>
                    </div>
            
            <li>
            <div class="swiper-slide">
                        <a class="vote-link" data-id="2">
                            <img src="./images/user3.jpg" alt="images">
                            محمد ملک
                        </a>
                    </div>


            </li>
            <li>
            <div class="swiper-slide">
                        <a class="vote-link" data-id="3">
                            <img src="./images/user4.jpg" alt="images">
                            اسحاق پور زند
                        </a>
                    </div>

            </li>
            <li>

            <div class="vote-link" data-id="4">
                        <a class="recipient-box btn-repicient" href="#l">
                            <img src="./images/user1.jpg" alt="images">
                            مهدی زمانی
                        </a>
                    </div>
            </li>
        </ul>

        <div class="container mt-5" id="sms-verification" style="display:none;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">تأیید کد اس‌ام‌اس</div>
                        <div class="card-body">
                            <form id="sms-form">
                                <div class="form-group">
                                    <label for="sms_code">کد اس‌ام‌اس 6 عددی را وارد کنید: (
                                        <?php if (!empty($_SESSION["sms_code_2"])) {
                                            echo ($_SESSION["sms_code_2"]);
                                        } ?>)
                                    </label>
                                    <input type="text" class="form-control" id="sms_code" name="sms_code" required>
                                </div>
                                <button type="submit" class="btn btn-primary">تأیید</button>
                            </form>
                            <p id="sms-result"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // کلیک بر روی لینک‌های رای دهی
            $(".vote-link").click(function (e) {
                e.preventDefault();
                var candidateId = $(this).data("id");
                // ارسال درخواست به سرور برای ارسال اس‌ام‌اس
                $.ajax({
                    url: "send_sms.php",
                    type: "POST",
                    data: { candidateId: candidateId },
                    success: function (response) {
                        if (response === "success") {
                            // نمایش کادر تایید اس‌ام‌اس
                            $("#sms-verification").show();
                        } else {
                            alert("خطا در ارسال اس‌ام‌اس.");
                        }
                    }
                });
            });

            // تایید کد اس‌ام‌اس
            $("#sms-form").submit(function (e) {
                e.preventDefault();
                var smsCode = $("#sms_code").val();
                $.ajax({
                    url: "verify_sms2.php",
                    type: "POST",
                    data: { smsCode: smsCode },
                    success: function (response) {
                        if (response === "success") {
                            alert("رای شما با موفقیت ثبت شد.");
                            window.location.href = "dashboard.php";
                        } else {
                            $("#sms-result").text("کد اشتباه است. لطفاً دوباره امتحان کنید.");
                        }
                    }
                });
            });
        });
    </script>


    <script type="text/javascript" src="./assets/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/bootstrap.min.js"></script>
    <script type="text/javascript" src="./assets/main.js"></script>

</body>

</html>