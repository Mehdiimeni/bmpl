<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تاریخچه امتیازات</title>
    <!-- Bootstrap 5 CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="./assets/css/bootstrap-rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
     <link rel="stylesheet" href="./assets/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/brands.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .points-header {
            background-color: #4e73df;
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .filter-buttons .btn {
            margin-left: 5px;
            margin-right: 5px;
        }

        .point-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            background-color: white;
        }

        .point-card .card-body {
            padding: 1.25rem;
        }

        .point-title {
            font-weight: 600;
            color: #2e3a59;
        }

        .point-date {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .point-value {
            font-weight: 700;
            color: #28a745;
        }

        .point-value.negative {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="points-header">
            <h4 class="mb-0">تاریخچه امتیازات</h4>
        </div>

        <div class="filter-buttons mb-4 text-center">
            <button type="button" class="btn btn-outline-primary active">همه</button>
            <button type="button" class="btn btn-outline-success">دریافت شده</button>
            <button type="button" class="btn btn-outline-danger">کسر شده</button>
            <button type="button" class="btn btn-outline-warning">در انتظار دریافت</button>
        </div>

        <div class="point-card card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="point-title mb-1">ماموریت «دانش در ازکی»</h6>
                        <p class="point-date mb-0">تاریخ: 1401/12/03</p>
                    </div>
                    <span class="point-value">+50</span>
                </div>
            </div>
        </div>

        <div class="point-card card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="point-title mb-1">ماموریت «افزودن اولین یادک»</h6>
                        <p class="point-date mb-0">تاریخ: 1401/12/03</p>
                    </div>
                    <span class="point-value">+30</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>