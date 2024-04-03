<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Design Table</title>
    <!-- Include Material Design fonts and styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.css">
    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.19/sweetalert2.min.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include MDBootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/css/mdb.min.css">
    <style>
        /* Add custom styles here */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            /* تجنب ظهور شريط التمرير أفقيًا */
            background-color: #f8f9fa;
            /* لون خلفية الصفحة */
        }

        .menu {
            position: fixed;
            top: -80px;
            /* أخفاء القائمة في البداية */
            left: 0;
            width: 100%;
            background-color: #ffffff;
            /* لون خلفية القائمة */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            /* تأكد من أن القائمة فوق العناصر الأخرى */
            transition: top 0.3s;
            /* إضافة حركة ناعمة للانتقال */
        }

        .menu.show {
            top: 0;
            /* ظهور القائمة عند التمرير للأعلى */
        }

        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 10px 0;
            text-align: center;
        }

        .menu ul li {
            display: inline-block;
            margin: 0 10px;
        }

        .menu ul li a {
            text-decoration: none;
            color: #333333;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .menu ul li a:hover {
            background-color: #f8f9fa;
        }

        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /* تحديد توجيه العناصر إلى عمودي */
            background-color: #f8f9fa;
            /* لون خلفية الجدول */
            padding: 20px;
            /* إضافة تباعد داخلي للحافة الخارجية للجدول */
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            /* تحديد عرض الجدول */
            border-radius: 8px;
            /* إضافة تقويس للحواف */
            overflow: hidden;
            /* تجنب تسريب الزوايا في حالة التقويس */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* إضافة ظل للجدول */
            background-color: #ffffff;
            /* لون خلفية الجدول */
            margin-bottom: 20px;
            /* تباعد بين الجداول والعنوان */
        }

        .table th,
        .table td {
            padding: 12px 15px;
            /* تحديد الهوامش الداخلية للخلايا */
            border-bottom: 1px solid #dee2e6;
            /* خط تحت كل صف */
            text-align: left;
            /* محاذاة النص إلى اليسار */
        }

        .table thead th {
            background-color: #f8f9fa;
            /* لون خلفية رأس الجدول */
            border-bottom: 2px solid #dee2e6;
            /* خط أسفل عنوان العمود */
            font-weight: 500;
            /* سمك النص */
        }

        .table-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            /* جعل عنوان الجدول في المنتصف */
        }

        /* إضافة الشكل الدائري للأيقونة */
        .create-icon {
            background-color: #007bff;
            /* لون الخلفية للأيقونة */
            color: #ffffff;
            /* لون الأيقونة نفسها */
            border-radius: 50%;
            /* جعل الزوايا دائرية */
            padding: 10px;
            /* تباعد داخلي للأيقونة */
            display: inline-block;
            /* جعل الأيقونة ذات عرض وارتفاع محسوب */
            text-align: center;
            /* محاذاة النص إلى الوسط */
            cursor: pointer;
            /* تحويل المؤشر إلى علامة الاختيار */
            transition: background-color 0.3s;
            /* تحريك ناعم لتغيير لون الخلفية */
            width: 50px;
            /* عرض الأيقونة */
            height: 50px;
            /* ارتفاع الأيقونة */
            line-height: 50px;
            /* تحديد ارتفاع السطر لمحاذاة النص في الوسط */
            font-size: 24px;
            /* حجم الأيقونة */
        }

        .create-icon:hover {
            background-color: #0056b3;
            /* لون الخلفية عند تحويل المؤشر */
        }

        /* تعديل عرض الأزرار ليكون أفقياً */
        .btn {
            display: inline-block;
            margin: 0 5px;
        }
    </style>
</head>

<body>
    <!-- Your menu goes here -->
    <div class="container">
        <br>
        <div class="row" style="margin-bottom: 9px;">
            <button class="btn create-icon"><i class="material-icons">add</i></button>
            <button class="btn btn-primary">Primary Button</button>
            <button class="btn btn-secondary">Secondary Button</button>
            <button class="btn btn-success">Success Button</button>
            <button class="btn btn-danger">Danger Button</button>
            <button class="btn btn-warning">Warning Button</button>


        </div>
    </div>
    <!-- Table Container -->
    <div class="table-container">
        <!-- Your beautiful table goes here -->
        <!-- Add buttons with plus icon -->
        <div>

            <table class="table">
                <thead class="thead-dark" id="Basic">
                    <tr>
                        <th scope="col" colspan="7"
                            style="border: navajowhite;background: #4285f4;padding: 4px;font-size: 20px;border-top-color: #343a40;border-top: 4px solid #619dff; /* يمكنك تغيير اللون والعرض حسب الرغبة */">
                            Basic tasks</th>
                    </tr>
                </thead>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Country</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Country</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>John Doe</td>
                        <td>30</td>
                        <td>USA</td>
                        <td>John Doe</td>
                        <td>30</td>
                        <td>USA</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jane Smith</td>
                        <td>25</td>
                        <td>Canada</td>
                        <td>John Doe</td>
                        <td>30</td>
                        <td>USA</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Mohammed Ahmed</td>
                        <td>35</td>
                        <td>Egypt</td>
                        <td>John Doe</td>
                        <td>30</td>
                        <td>USA</td>
                    </tr>
                </tbody>
            </table>

        </div>
        <!-- Add more tables here if needed -->
    </div>


    <!-- Dummy content to allow scrolling -->
    {{-- <div style="height: 2000px;"></div> --}}

    <!-- Include Material Design scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.js">
    </script>
    <!-- Include SweetAlert2 script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.19/sweetalert2.min.js"></script>
    <!-- Include Bootstrap script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include MDBootstrap script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/js/mdb.min.js"></script>
</body>

</html>
