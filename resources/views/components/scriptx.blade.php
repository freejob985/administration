<div>
    <script>
        // تحديد المجلد الرئيسي للصور
        Dropzone.autoDiscover = false;

        // تهيئة Dropzone لرفع الملفات
    $(document).ready(function() {
var schedule = sessionStorage.getItem("schedule");

        var myDropzone = new Dropzone("#fileUploadDropzone", {
            url: "{{ route('files.store') }}",
            maxFilesize: 5, // in MB
            maxFiles: 5,
            acceptedFiles: ".pdf,.doc,.docx,.php",
            dictDefaultMessage: "اسحب الملفات هنا أو انقر لرفعها",
            dictFallbackMessage: "متصفحك لا يدعم رفع الملفات بسحبها وإفلاتها.",
            dictFileTooBig: function(file) {
                var maxFileSizeMB = 5;
                return "الملف كبير جدًا (" + (file.size / (1024 * 1024)).toFixed(2) + "ميجابايت). الحد الأقصى للملف: " + maxFileSizeMB + "ميجابايت.";
            },
            dictInvalidFileType: "لا يمكنك رفع ملفات من هذا النوع.",
            dictCancelUpload: "إلغاء",
            dictRemoveFile: "إزالة",
            headers: {
                "Authorization": "Bearer YourAuthTokenHere"
            },
            params: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            schedule_id: $('.filesModal').data('schedule-id'),
            },
            success: function(file, response) {
                console.log('File uploaded successfully:', response);
                fetchAndDisplayFiles($('#filesModal').data('schedule-id'));
            },
            error: function(file, response, xhr) {
                console.error('Error uploading file:', response);
            }
        });

        $('#filesModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var scheduleId = button.data('schedule-id');
            $(this).data('schedule-id', scheduleId);

sessionStorage.setItem("schedule", scheduleId);


            fetchAndDisplayFiles(scheduleId);
        });

        function fetchAndDisplayFiles(scheduleId) {
            $.ajax({
                url: '{{ route("files.index", ":id") }}'.replace(':id', scheduleId),
                type: 'GET',
                success: function(response) {
                    $('.file-list').html('');
                    response.forEach(function(file) {
                        var fileHtml = `
                            <div class="mb-3">
                                <a href="{{ asset('storage/files/') }}/${file.filename}" class="btn btn-primary" target="_blank">
                                    <i class="fas fa-file"></i> ${file.filename}
                                </a>
                            </div>
                        `;
                        $('.file-list').append(fileHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching files:', error);
                }
            });
        }
    });

        // تهيئة القدرة على السحب والإفلات للجداول
        $(function() {
            $(".sortable tbody").sortable({
                connectWith: ".sortable tbody"
                , items: "tr"
                , helper: "clone"
                , cursor: "move"
                , opacity: 0.6
                , zIndex: 10000
                , delay: 150
                , start: function(event, ui) {
                    ui.item.data('table-name', ui.item.closest('table').find('th:first-child').text());
                }
                , update: function(event, ui) {
                    $("#new-row").remove();

                    var targetTableName = ui.item.closest('.table-header').find('th:first-child').text();
                    var targetTableNamex = ui.item.closest('.table-header').find('table').data('name');

                    var sourceTableName = ui.item.data('table-name');

                    if (targetTableName !== sourceTableName) {
                        var newType = targetTableNamex;

                        var scheduleId = ui.item.find('th:first-child').text();

                        // تحديث نوع المهمة في قاعدة البيانات
                        $.ajax({
                            url: '{{ route("schedule.update-type", ":id") }}'.replace(':id', scheduleId)
                            , type: 'PATCH'
                            , data: {
                                type: newType
                                , _token: $('meta[name="csrf-token"]').attr('content')
                            }
                            , success: function(response) {
                                console.log('تم تحديث نوع المهمة بنجاح');
                            }
                            , error: function(xhr, status, error) {
                                console.error('خطأ في تحديث نوع المهمة:', error);
                            }
                        });
                    }
                }
            }).disableSelection();
        });

        // إضافة مهمة فرعية جديدة
function addNewSubtask() {
    var newSubtaskText = $('#newSubtaskInput').val().trim();
    if (newSubtaskText !== '') {
        var scheduleId = $('#subtasksModal').data('schedule-id');

        $.ajax({
            url: '{{ route("subtasks.store") }}',
            type: 'POST',
            data: {
                name: newSubtaskText,
                     condition: 0, // تحويل القيمة إلى 0 بدلاً من false

                task_id: scheduleId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var newSubtaskHtml = `
                    <div class="card draggable">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" id="subtaskCheckbox-${response.id}" class="form-check-input mr-3" style="transform: scale(1.5);">
                                <label for="subtaskCheckbox-${response.id}" class="form-check-label mb-0" style="font-size: 1.2em;">${response.name}</label>
                            </div>
                            <i class="fas fa-trash delete-icon"></i>
                        </div>
                    </div>
                `;
                $('.subtasks').append(newSubtaskHtml);
                $('#newSubtaskInput').val('');
                updateProgressBar();
            },
            error: function(xhr, status, error) {
                console.error('خطأ في إضافة المهمة الفرعية:', error);
            }
        });
    }
}


        // تحديث شريط التقدم عند إكمال المهمة الفرعية
        $('#subtasksModal .modal-body').on('change', '.form-check-input', function() {
            updateProgressBar();
        });

function updateProgressBar() {
    var totalSubtasks = $('.subtasks .form-check-input').length;
    var completedSubtasks = $('.subtasks .form-check-input:checked').length;
    var progressPercentage = (completedSubtasks / totalSubtasks) * 100;
    $('#subtasksModal .progress-bar').css('width', progressPercentage + '%').text(Math.round(progressPercentage) + '%');
}

        // إضافة تعليق جديد
        $('#addCommentButton').click(function() {
            var commentText = tinyMCE.get('commentTextarea').getContent().trim();
            if (commentText !== '') {
                var newCommentHtml = `
                    <div class="mb-3 comment-card">
                        <div class="d-flex justify-content-between">
                            <h6>المستخدم</h6>
                            <button class="btn btn-danger btn-sm delete-comment"><i class="fas fa-trash"></i></button>
                        </div>
                        <p style="white-space: pre-line;">${commentText}</p>
                    </div>
                `;
                $('#commentsModal .modal-body').append(newCommentHtml);
                tinyMCE.get('commentTextarea').setContent('');
            }
        });

        // حذف تعليق
        $('#commentsModal .modal-body').on('click', '.delete-comment', function() {
            $(this).closest('.comment-card').remove();
        });

        // تهيئة محرر النصوص TinyMCE
        tinymce.init({
            // إعدادات محرر النصوص TinyMCE
        });

        // تمرير إلى أعلى بسلاسة عند فتح/إغلاق نموذج
        $('.modal').on('show.bs.modal', function() {
            $('body').css('overflow', 'hidden');
        }).on('hidden.bs.modal', function() {
            $('body').css('overflow', 'auto');
        });
        $('.modal-dialog-scrollable .modal-body').css({
            'overflow-y': 'auto'
            , 'max-height': 'calc(100vh - 200px)'
        });

        // إظهار نموذج إنشاء جدول جديد عند النقر على الأيقونة
        $('.create-icon').click(function() {
            $('#newTableModal').modal('show');
        });

        // إضافة جدول جديد
        $('#createTableButton').click(function() {
            var tableName = $('#tableNameInput').val();
            var tableColor = $('#tableColorInput').val();

            if (tableName && tableColor) {
                $.ajax({
                    url: '/administration/public/tables'
                    , type: 'POST'
                    , data: {
                        name: tableName
                        , color: tableColor
                        , _token: $('meta[name="csrf-token"]').attr('content')
                    }
                    , success: function(response) {
                        // إنشاء HTML الجدول الجديد
                        var newTableHTML = `
                            <div class="table-header">
                                <button class="btn btn-danger btn-sm delete-table-btn"><i class="fas fa-trash"></i></button>
                                <table class="table sortable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" colspan="7" style="color: #fff; background-color: ${response.color}; border-color: ${response.color}; padding: 5px;">${response.name}</th>
                                        </tr>
                                        <tr>
                                            <th scope="col">المعرف</th>
                                            <th scope="col">الاسم</th>
                                            <th scope="col">الأولوية</th>
                                            <th scope="col">الحالة</th>
                                            <th scope="col">المهام الفرعية</th>
                                            <th scope="col">الملفات</th>
                                            <th scope="col">التعليقات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="sortable">
                                        <tr id="new-row">
                                            <td colspan="6"><button class="btn btn-primary btn-sm">مهمة جديدة</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        `;

                        // إدراج الجدول الجديد قبل آخر جدول
                        $('.table-container table:last').before(newTableHTML);

                        // مسح إدخالات النموذج
                        $('#tableNameInput').val('');
                        $('#tableColorInput').val('#000000');

                        // إغلاق النموذج
                        $('#newTableModal').modal('hide');
                        $('.table-container').trigger('table-created');
                    }
                    , error: function(xhr, status, error) {
                        // معالجة الخطأ
                        console.error(error);
                    }
                });
            }
        });

        // حذف جدول
        $('.table-container').on('click', '.delete-table-btn', function() {
            var $tableHeader = $(this).closest('.table-header');
            var tableId = $tableHeader.find('table').data('id');

            $.ajax({
                url: '/administration/public/tables/' + tableId
                , type: 'DELETE'
                , data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    // إزالة الجدول من الصفحة
                    $tableHeader.remove();
                    console.log(response.message);
                }
                , error: function(xhr, status, error) {
                    // معالجة الخطأ
                    console.error(error);
                }
            });
        });

        // إعادة تهيئة القدرة على السحب والإفلات للجداول الجديدة
        $('.table-container').on('table-created', function() {
            $(".sortable tbody").sortable({
                connectWith: ".sortable tbody"
                , items: "tr"
                , helper: "clone"
                , cursor: "move"
                , opacity: 0.6
                , zIndex: 10000
                , delay: 150
            }).disableSelection();
        });

        // تحديث حالة المهمة وتغيير لون الصف وفقًا لها
        $('.table-container').on('change', '.status-select', function() {
            var selectedStatus = $(this).val();
            var rowElement = $(this).closest('tr');

            switch (selectedStatus) {
                case 'todo':
                    rowElement.css('background-color', '#f8f9fa');
                    break;
                case 'in-progress':
                    rowElement.css('background-color', '#ffeeba');
                    break;
                case 'done':
                    rowElement.css('background-color', '#d4edda');
                    break;
                default:
                    rowElement.css('background-color', '');
            }
        });

        // تحديث أولوية المهمة وتغيير لون الدائرة المميزة وفقًا لها
        $(document).ready(function() {
            $('.priority-select').each(function() {
                var $this = $(this);
                var selectedOption = $this.find('option:selected');
                var priorityClass = selectedOption.val();
                $this.siblings('.priority-circle').addClass(priorityClass);
            });

            $('.priority-select').on('change', function() {
                var $this = $(this);
                var selectedOption = $this.find('option:selected');
                var priorityClass = selectedOption.val();
                $this.siblings('.priority-circle').removeClass('low medium high').addClass(priorityClass);
            });
        });

        // تحديث أولوية ومعلومات المهمة في قاعدة البيانات
        $('.table-container').on('change', '.priority-select, .status-select', function() {
            var $this = $(this);
            var scheduleId = $this.data('id');
            var fieldName = $this.hasClass('priority-select') ? 'priority' : 'status';
            var fieldValue = $this.val();
            var otherFieldName = fieldName === 'priority' ? 'status' : 'priority';
            var otherFieldValue = $this.siblings('.' + otherFieldName + '-select').val();

            $.ajax({
                url: '/administration/public/schedule/' + scheduleId
                , type: 'PATCH'
                , data: {
                    [fieldName]: fieldValue
                    , [otherFieldName]: otherFieldValue
                    , _token: $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    // تحديث لون الصف بناءً على حالة المهمة
                    var rowElement = $this.closest('tr');
                    switch (response.status) {
                        case 'todo':
                            rowElement.css('background-color', '#f8f9fa');
                            break;
                        case 'in-progress':
                            rowElement.css('background-color', '#ffeeba');
                            break;
                        case 'done':
                            rowElement.css('background-color', '#d4edda');
                            break;
                        default:
                            rowElement.css('background-color', '');
                    }
                }
                , error: function(xhr, status, error) {
                    // معالجة الخطأ
                    console.error(error);
                }
            });
        });

        // تحديث لون الصف بناءً على حالة المهمة عند التحميل
        $(document).ready(function() {
            $('.table-container .status-select').each(function() {
                var $this = $(this);
                var selectedStatus = $this.val();
                var rowElement = $this.closest('tr');

                switch (selectedStatus) {
                    case 'todo':
                        rowElement.css('background-color', '#f8f9fa');
                        break;
                    case 'in-progress':
                        rowElement.css('background-color', '#ffeeba');
                        break;
                    case 'done':
                        rowElement.css('background-color', '#d4edda');
                        break;
                    default:
                        rowElement.css('background-color', '');
                }
            });
        });
        $('#subtasksModal .modal-body').on('click', '.card', function() {
            var $checkbox = $(this).find('.form-check-input');
            $checkbox.prop('checked', !$checkbox.prop('checked'));
            $checkbox.trigger('change');
        });

        $('#subtasksModal .modal-body').on('change', '.form-check-input', function() {
            var $card = $(this).closest('.card');
            if ($(this).is(':checked')) {
                $card.css({
                    'text-decoration': 'line-through'
                    , 'background-color': '#9de289'
                });
            } else {
                $card.css({
                    'text-decoration': 'none'
                    , 'background-color': 'transparent'
                });
            }
            updateProgressBar();
        });

    </script>

    <script>
        // تحديد القائمة التي سيتم جعلها قابلة للفرز
        var sortableList = document.getElementById('sortable-list');

        // تهيئة Sortable.js
        new Sortable(sortableList, {
            animation: 150, // مدة الرسم البياني للحركة بالمللي ثانية
            ghostClass: 'sortable-ghost', // تحديد الفئة للعنصر المؤقت أثناء السحب
        });




// $('#subtasksModal').on('show.bs.modal', function(event) {
//     var button = $(event.relatedTarget);
//     var scheduleId = button.data('schedule-id');
//     $(this).data('schedule-id', scheduleId);
// });




$('#subtasksModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var scheduleId = button.data('schedule-id');
    $(this).data('schedule-id', scheduleId);

    $.ajax({
        url: '{{ route("subtasks.show", ":id") }}'.replace(':id', scheduleId),
        type: 'GET',
        success: function(response) {
            $('.subtasks').html('');
            var completedSubtasks = '';
            var incompletedSubtasks = '';

            response.forEach(function(subtask) {
                var newSubtaskHtml = `
                    <div class="card draggable ${subtask.condition ? 'completed' : ''}">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" id="subtaskCheckbox-${subtask.id}" class="form-check-input mr-3" style="transform: scale(1.5);" ${subtask.condition ? 'checked' : ''}>
                                <label for="subtaskCheckbox-${subtask.id}" class="form-check-label mb-0" style="font-size: 1.2em;">${subtask.name}</label>
                            </div>
                            <i class="fas fa-trash delete-icon" data-subtask-id="${subtask.id}"></i>
                        </div>
                    </div>
                `;

                if (subtask.condition) {
                    completedSubtasks += newSubtaskHtml;
                } else {
                    incompletedSubtasks += newSubtaskHtml;
                }
            });

            $('.subtasks').append(completedSubtasks + incompletedSubtasks);
            updateProgressBar();

            // Apply the styles to the completed subtasks
            $('.subtasks .completed .card-body').css({
                'text-decoration': 'line-through',
                'background-color': '#9de289',
                'opacity': '0.5'
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching subtasks:', error);
        }
    });
});
$('.subtasks').on('click', '.delete-icon', function() {
    var $this = $(this);
    var subtaskId = $this.data('subtask-id');

    $.ajax({
        url: '{{ route("subtasks.destroy", ":id") }}'.replace(':id', subtaskId),
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $this.closest('.card').remove();
            console.log(response.message);
        },
        error: function(xhr, status, error) {
            console.error('خطأ في حذف التاسك الفرعي:', error);
        }
    });
});


function updateSubtaskStatus(subtaskId, condition) {
    $.ajax({
        url: '{{ route("subtasks.update", ":id") }}'.replace(':id', subtaskId),
        type: 'PATCH',
        data: {
            condition: condition ? 1 : 0,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('تم تحديث حالة التاسك الفرعي بنجاح');
            updateProgressBar();
        },
        error: function(xhr, status, error) {
            console.error('خطأ في تحديث حالة التاسك الفرعي:', error);
        }
    });
}

$('.subtasks').on('change', '.form-check-input', function() {
    var $this = $(this);
    var $cardBody = $this.closest('.card-body');
    var subtaskId = $this.closest('.card').find('.delete-icon').data('subtask-id');
    var isChecked = $this.is(':checked');

    if (isChecked) {
        $cardBody.css({
            'text-decoration': 'line-through',
            'background-color': '#9de289',
            'opacity': '0.5'
        });
    } else {
        $cardBody.css({
            'text-decoration': 'none',
            'background-color': 'transparent',
            'opacity': '1'
        });
    }

    // تحديث حالة التاسك الفرعي في الخادم
    updateSubtaskStatus(subtaskId, isChecked);
});



    </script>

</div>
