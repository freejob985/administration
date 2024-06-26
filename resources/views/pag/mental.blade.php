<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة العمل</title>
    <!-- تضمين ملفات CSS الضرورية -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.19/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/css/mdb.min.css">
    <style>
        /* نفس أنماط CSS الموجودة في الملف الأصلي */
        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: auto;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            width: 60px;
            background-color: #3f51b5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            z-index: 1;
        }

        .btn {
            border: none;
            background-color: transparent;
            color: white;
            font-size: 20px;
            padding: 20px;
            margin: 10px 0;
            cursor: pointer;
            transition: color 0.3s;
        }

        .btn.home {
            background-color: #4CAF50;
        }

        .btn.favorite {
            background-color: #FFC107;
        }

        .btn.shopping_cart {
            background-color: #FF5722;
        }

        .btn.settings {
            background-color: #9C27B0;
        }

        .btn:hover {
            color: #FFFFFF;
            /* تغيير لون الهوفر إلى أبيض */
        }

        .card {
            height: auto;
            /* السماح بالارتفاع ليتناسب مع المحتوى */
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #689e96;
            text-align: right;
            color: white !important;
            position: absolute;
            /* لتمكين تحديد موضع العلامة */
            display: inline-block;
            /* تجعل البطاقة تأخذ عرضًا يناسب حجم محتواها */
            z-index: 0;
        }

        .card-title {
            color: #FFFFFF;
            font-size: 19px;
            margin-bottom: 0px;
            font-weight: 500;
        }

        .badge {
            position: absolute;
            top: 0;
            right: -15px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #FFFFFF;
            color: #689e96 !important;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h2.card-title.idea-title {
            font-size: 15px;
            text-align: center;
        }

        .card.idea-card {
            background: #4caf50;
            padding: 11px;
        }

        .card.requirements-card {
            border-radius: 0;
            background: #ffc107;
            padding: 11px;
        }

        h2.card-title.requirements-title {
            color: black;
            font-size: 16px;
        }

        .card.mistakes-card {
            border-radius: 30px;
            background: #ff5722;
        }

        .card.number-card {
            background: #9c27b0;
            width: 519px;
        }

        h2.card-title.number-title {
            font-size: x-large;
        }

        h2.card-title.idea-card-title {
            padding-right: 6px !important;
        }

        h2.card-title.number-card-title {
            font-size: x-large;
        }

        h2.card-title.requirements-card-title {
            color: black;
        }

        .card.task-card {
            background: #3f51b5;
            padding: 17px;
        }

        h2.card-title.task-card-title {
            padding-right: 6px !important;
            font-weight: 600;
            word-spacing: 7px;
        }
button {
    font-family: 'Cairo', sans-serif !important;
font-size: 25px !important;
}
a.btn.material-icons.home {
    font-family: 'Cairo', sans-serif !important;
}
button.btn.material-icons.favorite.requirements {
    color: black;
}
a.btn.material-icons.favorite {
    color: black;
}

a.btn.material-icons.favorite {
    font-family: 'Cairo', sans-serif !important;
}


    </style>
</head>
<body>
    <div class="sidebar">
        <button class="btn material-icons home idea">الأفكار</button>
        <button class="btn material-icons favorite requirements">المتطلبات</button>
        <button class="btn material-icons shopping_cart mistakes">الاخطاء</button>
        <button class="btn material-icons settings number">العناوين</button>
        <a class="btn material-icons home " href="http://localhost/administration/public/task">الرئسية</a>
        <a class="btn material-icons favorite " href="{{ route('Tables.index', [$id]) }}">الجداول</a>


    </div>

    <!-- تضمين ملفات JavaScript الضرورية -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.10.11/interact.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // متغير عام لتخزين رمز CSRF
        var csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/mental/card.js') }}"></script>
    <script src="{{ asset('js/mental/eventListeners.js') }}"></script>

    <!-- عرض البطاقات الموجودة في قاعدة البيانات -->
    @foreach ($tasks as $task)
        <div class="card task-card" draggable="true" ondblclick="deleteCard(event)" data-task="{{ $task->id }}" data-x="{{ $task->data_x }}" data-y="{{ $task->data_y }}" style="transform: translate({{ $task->data_x }}px, {{ $task->data_y }}px);">
            <h2 class="card-title task-card-title">{{ $task->name }}<span class="badge">{{ $loop->iteration }}</span></h2>
        </div>
    @endforeach




        <!-- عرض بطاقات الأفكار (idea-card-title) -->
        @foreach ($ideaLabels as $label)
            <div class="card idea-card" draggable="true" ondblclick="deleteCard(event)" data-label="{{ $label->id }}" data-x="{{ $label->data_x }}" data-y="{{ $label->data_y }}" style="transform: translate({{ $label->data_x }}px, {{ $label->data_y }}px);">
                <h2 class="card-title idea-card-title">{{ $label->text }}</h2>
            </div>
        @endforeach

        <!-- عرض بطاقات المتطلبات (requirements-card) -->
        @foreach ($requirementsLabels as $label)
            <div class="card requirements-card" draggable="true" ondblclick="deleteCard(event)" data-label="{{ $label->id }}" data-x="{{ $label->data_x }}" data-y="{{ $label->data_y }}" style="transform: translate({{ $label->data_x }}px, {{ $label->data_y }}px);">
                <h2 class="card-title requirements-card-title">{{ $label->text }}</h2>
            </div>
        @endforeach

        <!-- عرض بطاقات الأخطاء (mistakes-card) -->
        @foreach ($mistakesLabels as $label)
            <div class="card mistakes-card" draggable="true" ondblclick="deleteCard(event)" data-label="{{ $label->id }}" data-x="{{ $label->data_x }}" data-y="{{ $label->data_y }}" style="transform: translate({{ $label->data_x }}px, {{ $label->data_y }}px);">
                <h2 class="card-title mistakes-card-title">{{ $label->text }}</h2>
            </div>
        @endforeach

        <!-- عرض بطاقات الأرقام (number-card) -->
        @foreach ($numberLabels as $label)
            <div class="card number-card" draggable="true" ondblclick="deleteCard(event)" data-label="{{ $label->id }}" data-x="{{ $label->data_x }}" data-y="{{ $label->data_y }}" style="transform: translate({{ $label->data_x }}px, {{ $label->data_y }}px);">
                <h2 class="card-title number-card-title">{{ $label->text }}</h2>
            </div>
        @endforeach
 <div id="save-code-popup-parent"></div>


</body>
</html>
