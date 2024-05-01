<div>
    <script>
        // TinyMCE initialization
        tinymce.init({
            selector: '#commentTextarea',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                title: 'My page 1',
                value: 'https://www.tiny.cloud'
            }, {
                title: 'My page 2',
                value: 'http://www.tiny.cloud'
            }],
            image_list: [{
                title: 'My page 1',
                value: 'https://www.tiny.cloud'
            }, {
                title: 'My page 2',
                value: 'http://www.tiny.cloud'
            }],
            image_class_list: [{
                title: 'None',
                value: ''
            }, {
                title: 'Some class',
                value: 'class-name'
            }],
            importcss_append: true,
            file_picker_callback: function(callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.tiny.cloud/docs/', {
                        text: 'My text'
                    });
                }
                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://picsum.photos/id/123/200/300', {
                        alt: 'My alt text'
                    });
                }
                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('https://www.youtube.com/watch?v=b98sFVVxU_U', {
                        source2: 'alt.mp4',
                        poster: 'https://picsum.photos/id/123/200/300'
                    });
                }
            },
            templates: [{
                title: 'New Table',
                description: 'creates a new table',
                content: '<div class="mceTmElem"></div><table width="98%%">%7<tbody>%7<tr>%7<td></td>%7</tr>%7</tbody>%7</table>'
            }, {
                title: 'Starting my story',
                description: 'A cure for writers block',
                content: 'Once upon a time...'
            }, {
                title: 'New list with dates',
                description: 'New List with dates',
                content: '<div class="mceTmElem"></div><span></span>%7<ul>%7<li>%7<span thutto Monday</span>%7</li>%7<li>%7<span thutto Tuesday</span>%7</li>%7</ul>'
            }],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 350,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table configurepermanentpen',
            skin: 'oxide',
            content_css: 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:25px }',
            font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',
            setup: (editor) => {
                editor.on('init', () => {
                    console.log('TinyMCE is ready!');
                });
            }
        });
        //================================================
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
                    return "الملف كبير جدًا (" + (file.size / (1024 * 1024)).toFixed(2) +
                        "ميجابايت). الحد الأقصى للملف: " + maxFileSizeMB + "ميجابايت.";
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
                    url: '{{ route('files.index', ':id') }}'.replace(':id', scheduleId),
                    type: 'GET',
                    success: function(response) {
                        $('.file-list').html('');
                        response.forEach(function(file) {
                            var fileHtml = `
                            <div class="mb-3">
                                <a href="{{ asset('storage/files/') }}/${file.filename}" class="btn btn-primary" target="_blank" style="background: #9551b7 !important;"  download>
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
                connectWith: ".sortable tbody",
                items: "tr",
                helper: "clone",
                cursor: "move",
                opacity: 0.6,
                zIndex: 10000,
                delay: 150,
                start: function(event, ui) {
                    ui.item.data('table-name', ui.item.closest('table').find('th:first-child').text());
                },
                update: function(event, ui) {
                    $("#new-row").remove();

                    var targetTableName = ui.item.closest('.table-header').find('th:first-child')
                .text();
                    var targetTableNamex = ui.item.closest('.table-header').find('table').data('name');

                    var sourceTableName = ui.item.data('table-name');

                    if (targetTableName !== sourceTableName) {
                        var newType = targetTableNamex;

                        var scheduleId = ui.item.find('th:first-child').text();

                        // تحديث نوع المهمة في قاعدة البيانات
                        $.ajax({
                            url: '{{ route('schedule.update-type', ':id') }}'.replace(':id',
                                scheduleId),
                            type: 'PATCH',
                            data: {
                                type: newType,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log('تم تحديث نوع المهمة بنجاح');
                            },
                            error: function(xhr, status, error) {
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
                    url: '{{ route('subtasks.store') }}',
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
            $('#subtasksModal .progress-bar').css('width', progressPercentage + '%').text(Math.round(progressPercentage) +
                '%');
        }

        // إضافة تعليق جديد


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
            'overflow-y': 'auto',
            'max-height': 'calc(100vh - 200px)'
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
                    url: '/administration/public/tables',
                    type: 'POST',
                    data: {
                        name: tableName,
                        color: tableColor,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
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
                    },
                    error: function(xhr, status, error) {
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
                url: '/administration/public/tables/' + tableId,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // إزالة الجدول من الصفحة
                    $tableHeader.remove();
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    // معالجة الخطأ
                    console.error(error);
                }
            });
        });

        // إعادة تهيئة القدرة على السحب والإفلات للجداول الجديدة
        $('.table-container').on('table-created', function() {
            $(".sortable tbody").sortable({
                connectWith: ".sortable tbody",
                items: "tr",
                helper: "clone",
                cursor: "move",
                opacity: 0.6,
                zIndex: 10000,
                delay: 150
            }).disableSelection();
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
                    'text-decoration': 'line-through',
                    'background-color': '#9de289'
                });
            } else {
                $card.css({
                    'text-decoration': 'none',
                    'background-color': 'transparent'
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
                url: '{{ route('subtasks.show', ':id') }}'.replace(':id', scheduleId),
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
                url: '{{ route('subtasks.destroy', ':id') }}'.replace(':id', subtaskId),
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
                url: '{{ route('subtasks.update', ':id') }}'.replace(':id', subtaskId),
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

        //=====================================================================================

        $('#commentsModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var scheduleId = button.data('schedule-id');
            $('#schedule_id').val(scheduleId);

            // Fetch the main task
            $.ajax({
                url: '/administration/public/schedule/' + scheduleId,
                type: 'GET',
                success: function(data) {
                    // Update the main task information in the modal
                    $('#mainTaskName').text(data.name);
                    // Add any other task details you want to display
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            // Fetch the comments
            fetchComments(scheduleId);
        });


        $('.comments-list').on('click', '.delete-comment', function() {
            var commentId = $(this).data('comment-id');

            $.ajax({
                url: '/administration/public/comments/' + commentId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    // Remove the comment card from the list
                    $(this).closest('.comment-card').remove();
                }.bind(this),
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
        // ===========================================================================================================================


function updateRowColor(taskId, status) {
    $('.table tbody tr[data-task-id="' + taskId + '"]').each(function() {
        var $this = $(this);
        switch (status) {
            case 'todo':
                $this.css('background-color', '#f8f9fa');
                break;
            case 'in-progress':
                $this.css('background-color', '#ffeeba');
                break;
            case 'done':
                $this.css('background-color', '#d4edda');
                break;
            case 'error':
                $this.css('background-color', '#f8d7da');
                break;
            case 'study':
                $this.css('background-color', '#7171CC');
                break;
            case 'research':
                $this.css('background-color', '#3AFFFF');
                break;
            default:
                $this.css('background-color', '');
        }
    });
}




        // تحديث حالة المهمة وتغيير لون الصف وفقًا لها
// $('.table-container').on('change', '.status-select', function() {
//     var selectedStatus = $(this).val();
//     var rowElement = $(this).closest('tr');

//     switch (selectedStatus) {
//         case 'todo':
//             rowElement.css('background-color', '#f8f9fa');
//             break;
//         case 'in-progress':
//             rowElement.css('background-color', '#ffeeba');
//             break;
//         case 'done':
//             rowElement.css('background-color', '#8CEBA2');
//             break;
//         case 'error':
//             rowElement.css('background-color', '#FFA6AD');
//             break;
//         case 'study':
//             rowElement.css('background-color', '#9C9CFF');
//             break;
//         case 'research':
//             rowElement.css('background-color', '#8DF5F5');
//             break;
//         default:
//             rowElement.css('background-color', '');
//     }
// });


function updateTaskStatus(taskId, status, priority) {
    $.ajax({
        url: '/update-task-status',
        type: 'POST',
        data: {
            task_id: taskId,
            status: status,
            priority: priority,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            updateRowColor(taskId, status);
        },
        error: function(xhr, status, error) {
            showErrorMessage('حدث خطأ أثناء تحديث الحالة: ' + error);
        }
    });
}
// =======================================================================================
// Update the task status and priority
// $('.table-container').on('change', '.status-select, .priority-select', function() {
//     var $this = $(this);
//     var scheduleId = $this.data('id');
//     var fieldName = $this.hasClass('priority-select') ? 'priority' : 'status';
//     var fieldValue = $this.val();
//     var otherFieldName = fieldName === 'priority' ? 'status' : 'priority';
//     var otherFieldValue = $this.siblings('.' + otherFieldName + '-select').val();

//     $.ajax({
//         url: '/administration/public/schedule/' + scheduleId,
//         type: 'PATCH',
//         data: {
//             [fieldName]: fieldValue,
//             [otherFieldName]: otherFieldValue,
//             _token: $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function(response) {
//             // Update the row color for all the tables
//             $('.table tbody tr').each(function() {
//                 var $row = $(this);
//                 var rowScheduleId = $row.data('task-id');
//                 updateRowColor(rowScheduleId, response.status);
//             });
//         },
//         error: function(xhr, status, error) {
//             // Handle the error
//         }
//     });
// });




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
    var $table = $this.closest('.table');

    $.ajax({
        url: '/administration/public/schedule/' + scheduleId,
        type: 'PATCH',
        data: {
            [fieldName]: fieldValue,
            [otherFieldName]: otherFieldValue,
            scheduleId:scheduleId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            // Update the row color based on the task status
            var $row = $this.closest('tr');
            switch (response.status) {
                case 'todo':
                    $row.css('background-color', '#f8f9fa');
                    break;
                case 'in-progress':
                    $row.css('background-color', '#F8DB83');
                    break;
                case 'done':
                    $row.css('background-color', '#76C98A');
      $row.css('color', '#FFFFFF');
                    break;
                case 'error':
                    $row.css('background-color', '#E87D86');
                    break;
                case 'study':
                    $row.css('background-color', '#7A7AFA');
    $row.css('color', '#FFFFFF');
                    break;
                case 'research':
                    $row.css('background-color', '#42F0F0');
    $row.css('color', '#FFFFFF');
                    break;
                default:
                    $row.css('background-color', '');
            }
        },
        error: function(xhr, status, error) {
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
                        rowElement.css('background-color', '#F8DB83');
                        break;
                    case 'done':
                        rowElement.css('background-color', '#76C98A');
                rowElement.css('color', '#FFFFFF');

                        break;
   case 'error':
                rowElement.css('background-color', '#E87D86');
                break;
            case 'study':
                rowElement.css('background-color', '#7A7AFA');
                rowElement.css('color', '#FFFFFF');



                break;
            case 'research':
                rowElement.css('background-color', '#42F0F0');
                rowElement.css('color', '#FFFFFF');

                break;
                    default:
                        rowElement.css('background-color', '');
                }
            });
        });
//========================================

$('#addCommentButton').click(function() {
  var commentText = tinyMCE.get('commentTextarea').getContent().trim();
  if (commentText !== '') {
    var scheduleIdValue = document.getElementById("schedule_id").value;
    $.ajax({
      url: '/administration/public/schedule/' + scheduleIdValue + '/comments',
      type: 'POST',
      data: {
        content: commentText,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        $('#commentTextarea').val('');
        var newComment = `
        <div class="mb-3 comment-card">
          <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <img src="https://static.wikia.nocookie.net/harrypotter/images/9/97/Harry_Potter.jpg" alt="Newt Scamander" class="comment-avatar" style="max-width: 40px; max-height: 40px;">
              <div class="comment-author ml-2">Newt Scamander</div>
            </div>
            <button class="btn btn-danger btn-sm delete-comment" data-comment-id="${data.id}">
              <i class="fas fa-trash"></i>
            </button>
          </div>
          <p style="white-space: pre-line;">${data.content}</p>
        </div>
      `;
      $('.comments-list').append(newComment);
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  }
});

function fetchComments(scheduleId) {
  $.ajax({
    url: '/administration/public/schedule/' + scheduleId + '/comments',
    type: 'GET',
    success: function(data) {
      $('.comments-list').empty();
      data.forEach(function(comment) {
        var commentHtml = `
        <div class="mb-3 comment-card">
          <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <img src="https://static.wikia.nocookie.net/harrypotter/images/9/97/Harry_Potter.jpg" alt="Newt Scamander" class="comment-avatar" style="max-width: 40px; max-height: 40px;">
              <div class="comment-author ml-2">Newt Scamander</div>
            </div>
            <button class="btn btn-danger btn-sm delete-comment" data-comment-id="${comment.id}">
              <i class="fas fa-trash"></i>
            </button>
          </div>
          <p style="white-space: pre-line;">${comment.content}</p>
        </div>
      `;
      $('.comments-list').append(commentHtml);
      });
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}

$('.btn[data-toggle="modal"]').click(function() {
    var scheduleId = $(this).data('schedule-id');
    var modalId = $(this).data('target');
    var taskName = $(this).data('name');

    $(modalId + ' .modal-title').text(taskName);
});
        function addNewTask(projectId, taskName) {
            $.ajax({
                url: `/administration/public/projects/${projectId}/tasks`,
                type: 'POST',
                data: {
                    name: taskName,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Reload the project after adding the new task
                    loadProject(projectId);
                },
                error: function() {
                    alert('Error adding new task');
                }
            });
        }

        $('#newTaskInput').on('keydown', function(event) {
            if (event.keyCode === 13) {
                var taskName = $(this).val().trim();

                if (taskName !== '') {
                    var projectId = $('.text-box-container').data('id');
                    addNewTask(projectId, taskName);
                    $(this).val('');
                    location.reload();

                }
            }
        });

    </script>

</div>
