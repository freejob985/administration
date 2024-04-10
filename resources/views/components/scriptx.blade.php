<div>
    <script>
        // تحديد المجلد الرئيسي للصور
        Dropzone.autoDiscover = false;

        // تهيئة Dropzone لرفع الملفات
        $(document).ready(function() {
            var myDropzone = new Dropzone("#fileUploadDropzone", {
                url: "/file/post"
                , maxFilesize: 5, // بالميجابايت
                maxFiles: 5
                , acceptedFiles: ".pdf,.doc,.docx"
                , dictDefaultMessage: "اسحب الملفات هنا أو انقر لرفعها"
                , dictFallbackMessage: "متصفحك لا يدعم رفع الملفات بسحبها وإفلاتها."
                , dictFileTooBig: function(file) {
                    var maxFileSizeMB = 5;
                    return "الملف كبير جدًا (" + (file.size / (1024 * 1024)).toFixed(2) + "ميجابايت). الحد الأقصى للملف: " + maxFileSizeMB + "ميجابايت.";
                }
                , dictInvalidFileType: "لا يمكنك رفع ملفات من هذا النوع."
                , dictCancelUpload: "إلغاء"
                , dictRemoveFile: "إزالة"
                , headers: {
                    "Authorization": "Bearer YourAuthTokenHere"
                }
            });
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
                var newSubtaskHtml = `
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" id="subtaskCheckbox-${$('.card').length + 1}" class="form-check-input mr-3" style="transform: scale(1.5);">
                                <label for="subtaskCheckbox-${$('.card').length + 1}" class="form-check-label mb-0" style="font-size: 1.2em;">${newSubtaskText}</label>
                            </div>
                        </div>
                    </div>
                `;
                $('#subtasksModal .subtasks').append(newSubtaskHtml);
                $('#newSubtaskInput').val('');
                updateProgressBar();
            }
        }

        // تحديث شريط التقدم عند إكمال المهمة الفرعية
        $('#subtasksModal .modal-body').on('change', '.form-check-input', function() {
            updateProgressBar();
        });

        function updateProgressBar() {
            var totalSubtasks = $('#subtasksModal .form-check-input').length;
            var completedSubtasks = $('#subtasksModal .form-check-input:checked').length;
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

    </script>
</div>
