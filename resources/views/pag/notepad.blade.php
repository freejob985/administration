<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Design</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Lalezar&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.19/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/css/mdb.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        body {
            font-family: 'Alexandria', sans-serif;
            direction: rtl;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .card {
            width: 300px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 16px;
            margin: 10px;
            font-family: 'Alexandria', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .delete-button {
            position: absolute;
            top: 16px;
            right: 16px;
        }

        .delete-button i {
            color: #ffffff;
            font-size: 32px;
            cursor: pointer;
        }

        .card-icon {
            font-size: 64px;
            margin-bottom: 12px !important;
            color: #ffffff;
        }

        .card-title {
            font-size: 24px;
            font-weight: 500;
            margin-top: 8px;
            margin-bottom: 8px;
            text-align: center;
        }

        .card-description {
            font-size: 16px;
            margin-bottom: 17px;
            text-align: center;
        }

        a.create-button {
            text-align: center;
            padding: 6%;
            font-size: 18px;
        }

        a:hover {
            color: #ffffff;
            text-decoration: none;
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
        }

        .create-button {
            width: 100%;
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .create-button:hover {
            background-color: #388e3c;
        }

        @media (min-width: 768px) {
            .card:nth-child(4n+1) {
                margin-left: 0;
            }

            .card:nth-child(4n) {
                margin-right: 0;
            }
        }

        .modal-header {
            background: blueviolet;
            color: white;
        }

        button.close {
            display: contents;
        }

        /* Styles for card colors */
        .card.color-1 {
            background-color: #e57373; /* Red 300 */
            color: #ffffff; /* White */
        }

        .card.color-2 {
            background-color: #ba68c8; /* Purple 300 */
            color: #ffffff; /* White */
        }

        .card.color-3 {
            background-color: #7986cb; /* Indigo 300 */
            color: #ffffff; /* White */
        }

        .card.color-4 {
            background-color: #4db6ac; /* Teal 300 */
            color: #ffffff; /* White */
        }

        .card.color-5 {
            background-color: #81c784; /* Green 300 */
            color: #ffffff; /* White */
        }

        .card.color-6 {
            background-color: #ffb74d; /* Orange 300 */
            color: #ffffff; /* White */
        }
.blue-background-class {
    background-color: #007bff;
    color: #ffffff;
    opacity: 0.8;
}
.edit-button {
    position: absolute;
    top: 16px;
    left: 16px;
}

.edit-button i {
    color: #ffffff;
    font-size: 32px;
    cursor: pointer;
}

.notepad-modal .modal-dialog {
    max-width: 800px;
}

.notepad-modal .modal-content {
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
}

.notepad-header {
    background-color: #f0d9b5;
    color: #b58863;
    padding: 15px 20px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.notepad-body {
    padding: 20px;
}

.notepad-textarea-container {
    background-color: #fff9e6;
    border: 2px solid #b58863;
    padding: 10px;
    border-radius: 5px;
    position: relative;
    box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
}

.notepad-textarea {
    width: 100%;
    border: none;
    outline: none;
    resize: none;
    font-family: 'Courier New', Courier, monospace;
    font-size: 16px;
    line-height: 1.5;
    padding: 0;
    background-color: transparent;
    color: #4d4d4d;
}

.notepad-footer {
    background-color: #f0d9b5;
    padding: 15px 20px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
/* للتيكست اريا */
.notepad-textarea {
    scrollbar-width: thin;
    scrollbar-color: #b58863 #f0d9b5;
}

.notepad-textarea::-webkit-scrollbar {
    width: 8px;
}

.notepad-textarea::-webkit-scrollbar-track {
    background-color: #f0d9b5;
}

.notepad-textarea::-webkit-scrollbar-thumb {
    background-color: #b58863;
    border-radius: 4px;
}

.notepad-textarea::-webkit-scrollbar-thumb:hover {
    background-color: #a37a51;
}

/* للصفحة */
::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-track {
    background-color: #f0d9b5;
}

::-webkit-scrollbar-thumb {
    background-color: #b58863;
    border-radius: 6px;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #a37a51;
}
.full-screen-modal .modal-dialog {
    max-width: 100%;
    max-height: 100vh;
    margin: 0;
    height: 100%;
}

.full-screen-modal .modal-content {
    height: 100%;
    border-radius: 0;
}
.full-screen-modal .notepad-textarea {
    height: calc(100vh - 200px); /* 200px هو مجموع ارتفاع العناوين والأزرار */
}
.card-details {
    display: none;
}

        textarea#fileContentTextarea {
            font-family: 'Alexandria';
            font-size: 14px;
            line-height: 24px;
            text-indent: 13px;
        }
        @media (min-width: 992px) {
            .modal-lg,
            .modal-xl {
                max-width: 1500px;
            }
        }
        .card-description {
            display: none;
        }


        .button-group {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            z-index: 9999;
        }

        .button-group button {
            margin: 0 10px;
        }

.modal {
    z-index: 9999; /* قيمة عالية لضمان ظهور الموديول فوق جميع الطبقات الأخرى */
}
body.modal-open {
    overflow: hidden;
}
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="card-container" id="newCardContainer">
                <!-- Cards will be dynamically added here -->
            </div>
        </div>
    </div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable full-screen-modal">
        <div class="modal-content notepad-modal">
            <div class="modal-header notepad-header">
                <h5 class="modal-title" id="editModalLabel">تعديل المفكرة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body notepad-body">
                <div class="notepad-textarea-container">
                    <textarea class="form-control notepad-textarea" id="fileContentTextarea" rows="20"></textarea>
                </div>
            </div>
<div class="modal-footer notepad-footer">
    <div class="formatting-buttons">
        <button type="button" class="btn btn-sm btn-secondary" id="increaseFont"><i class="material-icons">add</i></button>
        <button type="button" class="btn btn-sm btn-secondary" id="decreaseFont"><i class="material-icons">remove</i></button>
        <button type="button" class="btn btn-sm btn-secondary" id="alignLeft"><i class="material-icons">format_align_left</i></button>
        <button type="button" class="btn btn-sm btn-secondary" id="alignRight"><i class="material-icons">format_align_right</i></button>
        <button type="button" class="btn btn-sm btn-secondary" id="directionLTR"><i class="material-icons">arrow_back</i> LTR</button>
        <button type="button" class="btn btn-sm btn-secondary" id="directionRTL">RTL <i class="material-icons">arrow_forward</i></button>
    </div>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
    <button type="button" class="btn btn-primary" id="saveChangesButton">حفظ التغييرات</button>
</div>
        </div>
    </div>
</div>


    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">إنشاء ملف جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="titleInput">العنوان</label>
                            <input type="text" class="form-control" id="titleInput" placeholder="أدخل العنوان هنا">
                        </div>
                        <div class="form-group">
                            <label for="descriptionTextarea">الشرح</label>
                            <textarea class="form-control" id="descriptionTextarea" rows="3" placeholder="أدخل الشرح هنا"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="detailsTextarea">التفاصيل</label>
                            <textarea class="form-control" id="detailsTextarea" rows="5" placeholder="أدخل التفاصيل هنا"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="button" class="btn btn-primary">إنشاء</button>
                </div>
            </div>
        </div>
    </div>


    <div class="button-group" style="
    z-index: 1;
">
        <a class="btn btn-primary"> الرئسية</a>
        <a href="{{ route('Tables.index', [$id]) }}" class="btn btn-secondary"> الجداول</a>
        <a href="http://localhost/administration/public/task" class="btn btn-success"> المشاريع</a>
        <a href="{{ route('mental.index', [$id]) }}" class="btn btn-primary"> مساحة العمل </a>
    </div>

{{-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">حذف الملف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من حذف هذا الملف؟ لن تتمكن من استرداده بعد الحذف.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">حذف</button>
            </div>
        </div>
    </div>
</div> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.3/sweetalert2.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.3/sweetalert2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<script>
document.addEventListener('keydown', function(event) {
   if (event.key === 'Insert') {
       $('#createModal').modal('show');
   }
});

$(document).ready(function() {
    fetchNotepads();

    $('#createModal .btn-primary').click(function() {
        $.ajax({
            url: '/administration/public/notepads/Save',
            type: 'POST',
            data: {
                title: $('#titleInput').val(),
                description: $('#descriptionTextarea').val(),
                details: $('#detailsTextarea').val(),
                project_id: '{{ session()->get('projects') }}',
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                fetchNotepads();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // $(document).on('click', '.delete-button', function() {
    //     var cardElement = $(this).closest('.card');
    //     var notepadId = cardElement.data('id');

    //     $.ajax({
    //         url: '/administration/public/notepads/destroy/' + notepadId,
    //         type: 'DELETE',
    //         data: {
    //             _token: '{{ csrf_token() }}'
    //         },
    //         success: function(response) {
    //             cardElement.remove();
    //         },
    //         error: function(error) {
    //             console.log(error);
    //         }
    //     });
    // });

$(document).on('click', '.delete-button', function() {
    var notepadId = $(this).attr('id').split('-')[1];
    var confirmed = confirm('هل أنت متأكد من حذف هذا الملف؟ لن تتمكن من استرداده بعد الحذف.');

    if (confirmed) {
        $.ajax({
            url: '/administration/public/notepads/destroy/' + notepadId,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Remove the card element from the DOM
                $('#deleteButton-' + notepadId).closest('.card').remove();

                // Delete the associated file
                var fileName = response.file + '.txt';
                var filePath = '{{ public_path("Notepad") }}/' + fileName;

                // Use the File System module to delete the file
                var fs = require('fs');
                fs.unlink(filePath, function(err) {
                    if (err) {
                        console.error('Error deleting file:', err);
                    } else {
                        console.log('File deleted successfully');
                    }
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
});

var cardContainer = document.getElementById('newCardContainer');
new Sortable(cardContainer, {
    animation: 150, // تمكين الحركة أثناء السحب
    ghostClass: 'blue-background-class', // تحديد فئة CSS للعنصر المسحوب
    onEnd: function(evt) {
        // هنا يمكنك إضافة الكود الخاص بك لحفظ الترتيب الجديد للبطاقات على الخادم
    }
});
});

function fetchNotepads() {
    $.ajax({
        url: '/administration/public/notepads/show',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var cardContainer = $('#newCardContainer');
            cardContainer.html(''); // Clear existing cards
            $.each(data, function(index, notepad) {
                var fileName = notepad.file ? notepad.file + '.txt' : null;
                var colorClass = 'color-' + ((index % 6) + 1); // Assign color class based on index
                var card = $(`
<div class="card ${colorClass}" data-id="${notepad.id}" data-file-name="${fileName}">
<div class="delete-button" data-toggle="modal" data-target="#deleteModal" id="deleteButton-${notepad.id}">
    <i class="material-icons">delete</i>
</div>
    <div class="edit-button">
        <i class="material-icons">edit</i>
    </div>
    <div class="card-icon">
        <i class="material-icons">description</i>
    </div>
    <div class="card-title">${notepad.title}</div>
    <div class="card-description">${notepad.description}</div>
    <div class="card-details">${notepad.details}</div>
    <div class="card-buttons">

        <div class="open-file-button">
            <button class="btn btn-secondary btn-sm open-button">
                <i class="material-icons">open_in_new</i>
                فتح الملف
            </button>
        </div>
    </div>
</div>
                `);
                cardContainer.append(card);
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

$(document).on('click', '.copy-button', function() {
    var card = $(this).closest('.card');
    var details = card.find('.card-details').text();

    navigator.clipboard.writeText(details)
        .then(() => {
            Swal.fire({
                icon: 'success',
                title: 'تم نسخ النص!',
                showConfirmButton: false,
                timer: 1500,
                toast: true,
                position: 'bottom-end',
            });
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'حدث خطأ',
                text: 'فشل نسخ النص',
                showConfirmButton: true,
                toast: true,
                position: 'bottom-end',
            });
            console.error('Failed to copy text: ', err);
        });
});

$(document).on('click', '.open-button', function() {
    var card = $(this).closest('.card');
    var fileContent = card.find('.card-details').text();
    var fileId = card.data('id');

    $('#fileContentTextarea').val(fileContent);
    $('#editModal').modal('show');

    $('#saveChangesButton').off('click').on('click', function() {
        var updatedContent = $('#fileContentTextarea').val();

        $.ajax({
            url: '/administration/public/notepads/update/' + fileId,
            type: 'PUT',
            data: {
                details: updatedContent,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                card.find('.card-details').text(updatedContent);
                $('#editModal').modal('hide');
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
$(document).on('click', '.edit-button', function() {
    var card = $(this).closest('.card');
    var fileContent = card.find('.card-details').text();
    var fileId = card.data('id');

    $('#fileContentTextarea').val(fileContent);
    $('#editModal').modal('show');

    $('#saveChangesButton').off('click').on('click', function() {
        var updatedContent = $('#fileContentTextarea').val();

        $.ajax({
            url: '/administration/public/notepads/update/' + fileId,
            type: 'PUT',
            data: {
                details: updatedContent,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                card.find('.card-details').text(updatedContent);
                $('#editModal').modal('hide');
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});

$(document).on('click', '.delete-button', function() {
    var notepadId = $(this).attr('id').split('-')[1];
    var confirmed = confirm('هل أنت متأكد من حذف هذا الملف؟ لن تتمكن من استرداده بعد الحذف.');

    if (confirmed) {
        $.ajax({
            url: '/administration/public/notepads/destroy/' + notepadId,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Remove the card element from the DOM
                $('#deleteButton-' + notepadId).closest('.card').remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
});

$(document).on('click', '.card', function() {
    var card = $(this);
    var details = card.find('.card-details').text();

    navigator.clipboard.writeText(details)
        .then(() => {
            Swal.fire({
                icon: 'success',
                title: 'تم نسخ النص!',
                showConfirmButton: false,
                timer: 1500,
                toast: true,
                position: 'bottom-end',
            });
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'حدث خطأ',
                text: 'فشل نسخ النص',
                showConfirmButton: true,
                toast: true,
                position: 'bottom-end',
            });
            console.error('Failed to copy text: ', err);
        });
});
let fontSize = 16; // القيمة الافتراضية لحجم الخط

// زيادة حجم الخط
$('#increaseFont').click(function() {
    fontSize += 2;
    $('#fileContentTextarea').css('font-size', fontSize + 'px');
});

// تقليل حجم الخط
$('#decreaseFont').click(function() {
    fontSize -= 2;
    $('#fileContentTextarea').css('font-size', fontSize + 'px');
});

// محاذاة النص إلى اليسار
$('#alignLeft').click(function() {
    $('#fileContentTextarea').css('text-align', 'left');
});

// محاذاة النص إلى اليمين
$('#alignRight').click(function() {
    $('#fileContentTextarea').css('text-align', 'right');
});
// تعيين اتجاه النص من اليسار إلى اليمين (LTR)
$('#directionLTR').click(function() {
    $('#fileContentTextarea').css('direction', 'ltr');
    $('#fileContentTextarea').css('text-align', 'left'); // محاذاة النص إلى اليسار بشكل افتراضي
});

// تعيين اتجاه النص من اليمين إلى اليسار (RTL)
$('#directionRTL').click(function() {
    $('#fileContentTextarea').css('direction', 'rtl');
    $('#fileContentTextarea').css('text-align', 'right'); // محاذاة النص إلى اليمين بشكل افتراضي
});
$('#editModal').on('shown.bs.modal', function () {
    $('body').addClass('modal-open');
})

$('#editModal').on('hidden.bs.modal', function () {
    $('body').removeClass('modal-open');
})
</script>


</body>
</html>
