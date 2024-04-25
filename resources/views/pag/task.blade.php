


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>قائمة المهام</title>
    <link rel="stylesheet" href="{{ asset('css/task.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .project-container {
            max-height: 80vh; /* تحديد الارتفاع الأقصى لمحتوى المشروع */
            overflow-y: auto; /* السماح بالتمرير العمودي عند تجاوز الارتفاع المحدد */
        }
        .completed {
            background-color: #c8ffe0 !important;
            text-decoration: line-through;
            color: #888;
        }
        .task-text {
            word-wrap: break-word;
            white-space: normal;
            overflow-wrap: break-word;
        }
        .task {
            display: flex;
            flex-wrap: nowrap;
            cursor: pointer;
        }

        .delete-icon {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #999;
        }

        ::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }
        /* ضبط الارتفاع للعنصر الحاوي للمشاريع */
        .project-row {
            min-height: calc(100vh - 200px); /* 200px هو ارتفاع الفوتر تقريبًا */
        }

        /* تنسيق لمحتوى المشروع */
        .project-container {
            max-height: calc(100vh - 200px); /* تحديد الارتفاع الأقصى لمحتوى المشروع */
            overflow-y: auto; /* السماح بالتمرير العمودي عند تجاوز الارتفاع المحدد */
        }
        .project-name.bg-warning.text-white.fw-bold.py-2.rounded.mb-3 {
            color: black !important;
        }
        body {
            position: relative; /* تحديد موضع العنصر الجسم */
            min-height: 100vh; /* تحديد الارتفاع الأدنى للجسم إلى ارتفاع الشاشة */
            padding-bottom: 150px; إضافة هامش أسفل لعدم تغطية الفوتر
        }



        .footer-container {
            height: 150px; /* تحديد ارتفاع الفوتر */
        }
        header {
            position: sticky;
            top: 0;
            z-index: 1;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-family: 'Amiri', serif;
            font-weight: 700;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        header.bg-primary.text-white.py-3.mb-4 {
            background: #f0f0f0 !important;
            box-shadow: 1px 3px #bababa;
        }
        h1.text-center.mb-0 {
            color: black;
        }

.completed {
    background-color: #44b89d !important;
    text-decoration: line-through;
    color: #fff;
}
.bg-warning {
    --bs-bg-opacity: 1;
    background-color: unset !important;
    font-size: 25px !important;
}
.text-danger {
    --bs-text-opacity: 1;
    color: unset !important;
}
.project-header.d-flex.justify-content-between.align-items-center.mb-3 {
    background: white;
    color: black;
    padding: 2%;
    border-radius: 16px;
}
.project-name.bg-warning.text-white.fw-bold.py-2.rounded {
    color: black !important;
}
/* .task.completed:before {
    content: '✔️';
    margin-right: 5px;
} */

.bg-warning {
    --bs-bg-opacity: 1;
    background-color: unset !important;
    font-size: 35px !important;
}
.progress-bar {
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
    color: var(--bs-progress-bar-color);
    text-align: center;
    white-space: nowrap;
    background-color: #44b89d !important;
    transition: var(--bs-progress-bar-transition);
}
a#linke-titel {
    color: black !important;
    text-decoration: auto!important;
}


    </style>
</head>
<body>

    <br>
    <br>
    <div class="container-fluid">
        <div class="row project-row" id="projectsContainer">
            <!-- Projects will be loaded here -->
        </div>
    </div>


    <!-- Modal for Adding Project -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">إضافة مشروع جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="projectNameInput">اسم المشروع</label>
                        <input type="text" class="form-control" id="projectNameInput" placeholder="أدخل اسم المشروع">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewProject()">إضافة</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and jQuery UI libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
<script>
document.addEventListener('keydown', function(event) {
    if (event.key === 'Insert') {
        // فتح النافذة المنبثقة لإضافة مشروع جديد
        $('#addProjectModal').modal('show');
    }
});
</script>
</body>
</html>
