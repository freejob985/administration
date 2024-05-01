<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تيكست أريا مع اسماء الملفات</title>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include Material Design scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.js"></script>
    <!-- Include SweetAlert2 script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include MDBootstrap script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/js/mdb.min.js"></script>
    <!-- Include jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Filepond JS -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <!-- TinyMCE JS -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6.3.1/tinymce.min.js"></script>

    <!-- Dropzone JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/7e1mldkbut3yp4tyeob9lt5s57pb8wrb5fqbh11d6n782gm7/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

    <!-- Include Material Design fonts and styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.css">
    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.19/sweetalert2.min.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include MDBootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/css/mdb.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="http://localhost/administration/public/css/Tables/Tables.css">

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Filepond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <!-- TinyMCE CSS -->
    <link rel="stylesheet" href="https://cdn.tiny.cloud/1/no-api-key/tinymce/6.3.1/skins/ui/oxide/skin.min.css">

    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    <!-- Custom Arabic Font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap');

        body {
            font-family: "Noto Kufi Arabic", sans-serif;
        }

        .file-input {
            display: none;
        }

        #textArea {
            height: 500px;
            background-color: #112d4e;
            color: #f3f3f3;
            padding: 10px;
            font-size: 16px;
        }

        .file-name {
            font-weight: bold;
            color: #ff4d4d;
        }
#textArea {
    height: 500px;
    background-color: #112d4e;
    color: #f3f3f3;
    padding: 10px;
    font-size: 16px;
    width: 875px;
}

    </style>

</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                            <textarea id="textArea" class="mdc-text-field__input"></textarea>
                            <div class="mdc-notched-outline">
                                <div class="mdc-notched-outline__leading"></div>

                                <div class="mdc-notched-outline__trailing"></div>
                            </div>

                        <div class="text-center mt-4">
                            <label for="fileInput" class="btn btn-primary btn-rounded">
                                <i class="fas fa-upload"></i> فتح الملف
                            </label>
                            <input type="file" id="fileInput" class="file-input" multiple>
                            <button id="copyButton" class="btn btn-success btn-rounded">
                                <i class="fas fa-copy"></i> نسخ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
// دالة لفتح ملف
document.getElementById('fileInput').addEventListener('click', function() {
    this.value = null; // إعادة تعيين قيمة إدخال الملف
});

// دالة للتحقق من اسم الملف وعرضه
function handleFile() {
    var fileInput = document.getElementById('fileInput');
    var files = fileInput.files;
    var textArea = document.getElementById('textArea');

    if (files.length > 0) {
        // عرض كل ملف بشكل منفصل
        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();

            reader.onload = (function(file) {
                return function(event) {
                    textArea.value +=  '\n===========================================================\n';

                    // إضافة اسم الملف ومحتواه إلى التيكست أريا
                    textArea.value += 'اسم الملف: ' + file.name + '\n===========================================================\n';
                    textArea.value += event.target.result ;
                };
            })(files[i]);

            reader.readAsText(files[i]);
        }
    }
}

// استماع لحدث change لإدخال الملف للحصول على اسم الملف
document.getElementById('fileInput').addEventListener('change', handleFile);

// دالة لنسخ محتوى التيكست أريا
document.getElementById('copyButton').addEventListener('click', function() {
    var textArea = document.getElementById('textArea');
    textArea.select(); // تحديد كل محتوى التيكست أريا
    document.execCommand('copy'); // نسخ المحتوى المحدد

    // عرض رسالة تأكيد باستخدام SweetAlert2
    Swal.fire({
        icon: 'success',
        title: 'تم نسخ المحتوى',
        showConfirmButton: false,
        timer: 1500
    });
});
</script>
