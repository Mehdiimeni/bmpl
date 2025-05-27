<!DOCTYPE HTML>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>BNPL | تایید هویت تصویری</title>

    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css" as="style">
    <link rel="preload"
        href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Regular.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Bold.woff2" as="font"
        type="font/woff2" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.rtl.min.css" rel="stylesheet"
        integrity="sha384-MdqCcafa5BLgxBDJ3d/4D292geNL64JyRtSGjEszRUQX9rhL1QkcnId+OT7Yw+D+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <style>
        /* CSS Variables - Consistent with previous pages */
        :root {
            --primary-color: #2196F3;
            /* Blue */
            --primary-dark: #1976D2;
            /* Darker Blue */
            --secondary-color: #4CAF50;
            /* Green for valid states */
            --error-color: #F44336;
            /* Red for error states */
            --background-light: #f0f2f5;
            /* Light gray background */
            --card-background: #ffffff;
            /* White card background */
            --text-color-dark: #333;
            /* Dark text */
            --text-color-light: #777;
            /* Muted text */
            --shadow-light: rgba(0, 0, 0, 0.08);
            --shadow-medium: rgba(0, 0, 0, 0.15);
            --border-color: #e0e0e0;
            /* Light border for inputs */
        }

        /* Dark mode adjustments */
        @media (prefers-color-scheme: dark) {
            :root {
                --background-light: #1a1a1a;
                --card-background: #2b2b2b;
                --text-color-dark: #e0e0e0;
                --text-color-light: #a0a0a0;
                --shadow-light: rgba(0, 0, 0, 0.3);
                --shadow-medium: rgba(0, 0, 0, 0.5);
                --border-color: #3a3a3a;
            }
        }

        /* Vazirmatn Font Import */
        @font-face {
            font-family: 'Vazirmatn';
            src: url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Regular.woff2') format('woff2');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Vazirmatn';
            src: url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/fonts/webfonts/Vazirmatn-Bold.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }

        body {
            background-color: var(--background-light);
            font-family: 'Vazirmatn', sans-serif;
            color: var(--text-color-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        /* Preloader Styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--background-light);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
            opacity: 1;
        }

        #preloader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.3em;
            color: var(--primary-color) !important;
        }

        /* Main Card Styles */
        .verification-card {
            background-color: var(--card-background);
            max-width: 500px;
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 12px 30px var(--shadow-medium);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            animation: fadeInScale 0.8s ease-out forwards;
        }

        .header-container {
            background-color: var(--primary-color);
            padding: 1.5rem 0;
            text-align: center;
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideInFromTop 0.7s ease-out forwards;
            position: relative;
            overflow: hidden;
        }

        .header-container::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            filter: blur(2px);
        }

        .header-container::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -10px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            filter: blur(2px);
        }

        .header-container i {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .content-container {
            padding: 2.5rem;
            text-align: center;
        }

        h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }

        .instruction-text {
            font-size: 1.1rem;
            color: var(--text-color-light);
            margin-bottom: 2rem;
            line-height: 1.8;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.3s;
            opacity: 0;
        }

        .user-info-box {
            background-color: #f7f7f7;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2.5rem;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }

        .user-info-box p {
            margin-bottom: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-color-dark);
        }

        .user-info-box strong {
            color: var(--primary-dark);
            font-weight: 700;
        }

        /* Camera Section (now simulated) */
        .camera-section {
            margin-bottom: 2.5rem;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.5s;
            opacity: 0;
        }

        .camera-preview-area {
            width: 100%;
            max-height: 300px;
            min-height: 200px;
            /* Ensure it has a height */
            background-color: #eee;
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
            flex-direction: column;
            /* For stacking icon and text */
            color: var(--text-color-light);
            font-size: 1.1rem;
        }

        .camera-preview-area i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .camera-preview-area.recording-active {
            border-color: var(--error-color);
            /* Red border during recording */
            box-shadow: 0 0 0 4px rgba(244, 67, 54, 0.2);
        }

        .camera-btn {
            width: 100%;
            padding: 12px 15px;
            background-color: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
            margin-top: 1rem;
        }

        .camera-btn:hover {
            background-color: #388e3c;
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
            transform: translateY(-2px);
        }

        .camera-btn:disabled {
            background-color: #cccccc;
            box-shadow: none;
            cursor: not-allowed;
            color: #999999;
        }

        /* Recording Timer Overlay */
        .recording-timer {
            position: absolute;
            top: 10px;
            left: 10px;
            /* Adjust for RTL */
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
            z-index: 10;
        }

        .recording-timer i {
            color: var(--error-color);
            /* Red dot for recording */
            font-size: 1rem;
        }


        .consent-checkbox {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            margin-bottom: 2.5rem;
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.6s;
            /* Adjusted delay */
            opacity: 0;
        }

        .consent-checkbox input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 22px;
            height: 22px;
            border: 2px solid var(--border-color);
            border-radius: 6px;
            margin-left: 12px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .consent-checkbox input[type="checkbox"]:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .consent-checkbox input[type="checkbox"]:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 16px;
            font-weight: bold;
        }

        .consent-checkbox label {
            font-size: 0.95rem;
            color: var(--text-color-dark);
            cursor: pointer;
            margin-bottom: 0;
            text-align: right;
            line-height: 1.6;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
            animation: fadeInUp 0.7s ease-out forwards;
            animation-delay: 0.7s;
            /* Adjusted delay */
            opacity: 0;
        }

        .submit-btn:disabled {
            background-color: #cccccc;
            box-shadow: none;
            cursor: not-allowed;
            color: #999999;
        }

        .submit-btn:hover:not(:disabled) {
            background-color: var(--primary-dark);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
            transform: translateY(-2px);
        }

        /* Progress Bar Styles */
        .progress-section {
            display: none;
            margin-top: 2.5rem;
            animation: fadeIn 0.5s ease-out forwards;
        }

        .progress {
            height: 25px;
            /* Thicker progress bar */
            border-radius: 10px;
            background-color: #e9ecef;
            overflow: hidden;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            background-color: var(--primary-color);
            border-radius: 10px;
            /* Match outer border-radius */
            transition: width 0.5s ease-in-out;
            /* Smooth fill */
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 0.9rem;
        }

        /* General Animations - Consistent with previous pages */
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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .verification-card {
                margin: 1rem auto;
                border-radius: 15px;
            }

            .header-container {
                padding: 1rem 0;
            }

            .header-container i {
                font-size: 2.5rem;
                margin-bottom: 0.8rem;
            }

            .content-container {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            .instruction-text {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }

            .user-info-box {
                padding: 1rem;
                margin-bottom: 2rem;
            }

            .user-info-box p {
                font-size: 0.9rem;
            }

            .consent-checkbox label {
                font-size: 0.85rem;
            }

            .submit-btn {
                padding: 12px;
                font-size: 1.1rem;
            }

            .camera-preview-area {
                min-height: 150px;
            }
        }
    </style>
</head>

<body>
    <div id="preloader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">در حال بارگذاری...</span>
        </div>
    </div>

    <div class="container">
        <div class="verification-card">
            <div class="header-container">
                <i class="fa-solid fa-camera"></i>
                <h3 class="mb-0">تایید هویت تصویری</h3>
            </div>

            <div class="content-container">
                <h2>آماده‌سازی برای احراز هویت</h2>
                <p class="instruction-text">
                    لطفاً **کارت ملی خود را در دست بگیرید** و آن را جلوی دوربین قرار دهید. مطمئن شوید تصویر واضح و نور
                    کافی دارد.
                </p>

                <div class="user-info-box">
                    <p>نام و نام خانوادگی: <strong><span id="userName">نام نام خانوادگی</span></strong></p>
                    <p> کد ملی: <strong><span id="nationalCodeDisplay">---</span></strong></p>
                </div>

                <div class="camera-section">
                    <div class="camera-preview-area" id="cameraPreviewArea">
                        <i class="fa-solid fa-video"></i>
                        <span id="cameraStatusText">دوربین فعال نیست.</span>
                    </div>
                    <div class="recording-timer" id="recordingTimer" style="display: none;">
                        <i class="fa-solid fa-circle"></i>
                        <span id="timerCountdown">00:05</span>
                    </div>
                    <button id="activateCameraButton" class="camera-btn">فعال کردن دوربین و ضبط</button>
                </div>


                <div class="consent-checkbox">
                    <input type="checkbox" id="agreeConsent" name="agreeConsent" required>
                    <label for="agreeConsent">
                        من <strong id="userConsentName">نام نام خانوادگی</strong> با شماره ملی <strong
                            id="userConsentNationalCode">---</strong>، کلیه شرایط استفاده از این نرم‌افزار را
                        می‌پذیرم.
                    </label>
                </div>

                <button type="submit" id="submitBtn" class="submit-btn" disabled>
                    ارسال
                </button>

                <div class="progress-section" id="progressBarSection">
                    <p class="text-muted mb-2">در حال بارگذاری ویدیو...</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" id="progressBar" style="width: 0%;"
                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const preloader = document.getElementById('preloader');
            const submitBtn = document.getElementById('submitBtn');
            const agreeConsentCheckbox = document.getElementById('agreeConsent');
            const progressBarSection = document.getElementById('progressBarSection');
            const progressBar = document.getElementById('progressBar');

            const userNameDisplay = document.getElementById('userName');
            const nationalCodeDisplay = document.getElementById('nationalCodeDisplay');
            const userConsentName = document.getElementById('userConsentName');
            const userConsentNationalCode = document.getElementById('userConsentNationalCode');

            const activateCameraButton = document.getElementById('activateCameraButton');
            const cameraPreviewArea = document.getElementById('cameraPreviewArea'); // The visual area
            const cameraStatusText = document.getElementById('cameraStatusText'); // Text inside preview area
            const cameraIcon = cameraPreviewArea.querySelector('i'); // Icon inside preview area
            const recordingTimer = document.getElementById('recordingTimer');
            const timerCountdown = document.getElementById('timerCountdown');

            let videoRecordingSimulated = false; // Flag to ensure recording simulation is complete

            // --- Dummy Data (Replace with actual data fetched from previous page/backend) ---
            const dummyUserName = "علی محمدی";
            const dummyNationalCode = "۱۲۳۴۵۶۷۸۹۰";
            // --- End Dummy Data ---

            // Set the dummy data to the elements
            userNameDisplay.textContent = dummyUserName;
            nationalCodeDisplay.textContent = dummyNationalCode;
            userConsentName.textContent = dummyUserName;
            userConsentNationalCode.textContent = dummyNationalCode;

            // Function to update the state of the submit button
            function updateSubmitButtonState() {
                submitBtn.disabled = !(agreeConsentCheckbox.checked && videoRecordingSimulated);
            }

            // Function to simulate camera activation and recording
            activateCameraButton.addEventListener('click', () => {
                activateCameraButton.disabled = true; // Disable button during simulation
                activateCameraButton.textContent = 'در حال ضبط...';
                cameraPreviewArea.classList.add('recording-active'); // Add visual indicator for recording

                // Update preview area to show "Recording..."
                cameraIcon.className = 'fa-solid fa-circle'; // Red dot icon
                cameraIcon.style.color = 'var(--error-color)'; // Make icon red
                cameraStatusText.textContent = 'در حال ضبط...';

                recordingTimer.style.display = 'flex'; // Show timer
                let timeLeft = 5; // 5 seconds recording simulation
                timerCountdown.textContent = `00:0${timeLeft}`;

                const timerInterval = setInterval(() => {
                    timeLeft--;
                    timerCountdown.textContent = `00:0${timeLeft}`;
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        recordingTimer.style.display = 'none'; // Hide timer

                        // Reset preview area after simulated recording
                        cameraPreviewArea.classList.remove('recording-active');
                        cameraIcon.className = 'fa-solid fa-circle-check'; // Change icon to success
                        cameraIcon.style.color = 'var(--secondary-color)'; // Green checkmark
                        cameraStatusText.textContent = 'ویدیو با موفقیت ضبط شد.';

                        activateCameraButton.textContent = 'ضبط مجدد ویدیو'; // Allow re-recording
                        activateCameraButton.disabled = false; // Re-enable for re-recording

                        videoRecordingSimulated = true; // Mark recording as complete
                        updateSubmitButtonState(); // Update submit button state
                    }
                }, 1000); // Update every second
            });

            // Event listener for the consent checkbox
            agreeConsentCheckbox.addEventListener('change', updateSubmitButtonState);

            // Event listener for the submit button (now only for "upload")
            submitBtn.addEventListener('click', function (e) {
                e.preventDefault();

                // Only proceed if recording is simulated and consent is given
                if (agreeConsentCheckbox.checked && videoRecordingSimulated) {
                    submitBtn.disabled = true; // Disable button immediately
                    progressBarSection.style.display = 'block'; // Show the progress bar

                    let progress = 0;
                    const uploadInterval = setInterval(() => {
                        progress += 10;
                        if (progress <= 100) {
                            progressBar.style.width = progress + '%';
                            progressBar.setAttribute('aria-valuenow', progress);
                            progressBar.textContent = progress + '%';
                        } else {
                            clearInterval(uploadInterval);
                            setTimeout(() => {
                                window.location.href = 'credit-status.php'; // Redirect after upload
                            }, 500);
                        }
                    }, 200); // 2 seconds total for upload simulation (10 steps * 200ms)
                }
            });

            // Initial state check for the button on page load
            updateSubmitButtonState();

            // Hide preloader after page loads
            window.addEventListener('load', function () {
                preloader.classList.add('hidden');
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
                window.scrollTo(0, 1);
            });
        });
    </script>
</body>

</html>