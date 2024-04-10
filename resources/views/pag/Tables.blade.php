<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Design Table</title>
    <x-alert />
</head>
<body>
    <!-- Your menu goes here -->
    <div class="container" id="top-bar">
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
            <table class="table sortable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">priority</th>
                        <th scope="col">status</th>
                        <th scope="col">Subtasks</th>
                        <th scope="col">Files</th>
                        <th scope="col">comments</th>
                    </tr>
                </thead>
                <tbody class="sortable">
                    <!-- Sample row, replace with your data using your backend -->


                    @foreach ($schedule as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>
                            <div class="priority-container">
                                <select class="form-control priority-select" data-id="{{ $item->id }}">
                                    <option value="low" @if($item->priority == 'low') selected @endif>Low</option>
                                    <option value="medium" @if($item->priority == 'medium') selected @endif>Medium</option>
                                    <option value="high" @if($item->priority == 'high') selected @endif>High</option>
                                </select>
                                <span class="priority-circle"></span>
                            </div>
                        </td>


                        <td>
                            <select class="form-control status-select" data-id="{{ $item->id }}">
                                <option value="todo" @if($item->status == 'todo') selected @endif>Todo</option>
                                <option value="in-progress" @if($item->status == 'in-progress') selected @endif>In Progress</option>
                                <option value="done" @if($item->status == 'done') selected @endif>Done</option>
                            </select>
                        </td>
                        <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#subtasksModal" data-id="{{ $item->id }}">Subtasks</button></td>

                        <td><button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#filesModal">Files</button></td>
                        <td><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#commentsModal">Comments</button></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>


            @foreach ($Table as $item)
            <div class="table-header">
                <button class="btn btn-danger btn-sm delete-table-btn"><i class="fas fa-trash"></i></button>
                <table class="table sortable" data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" colspan="7" style="color: #fff; background-color: {{ $item->color }}; border-color: #000000; padding: 5px;">{{ $item->name }}</th>
                        </tr>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">priority</th>
                            <th scope="col">status</th>
                            <th scope="col">Subtasks</th>
                            <th scope="col">Files</th>
                            <th scope="col">comments</th>
                        </tr>
                    </thead>
                    <tbody class="sortable ui-sortable">
                        @if(DB::table('schedule')->where('project_id', $id)->where('type',$item->name)->count() > 0)
                        @foreach (DB::table('schedule')->where('project_id', $id)->where('type',$item->name)->orderBy('id','desc')->get() as $item_schedule)
                        <tr>
                            <th scope="row">{{ $item_schedule->id }}</th>
                            <td>{{ $item_schedule->name }}</td>
                            <td>
                                <div class="priority-container">
                                    <select class="form-control priority-select" data-id="{{ $item->id }}">
                                        <option value="low" @if($item_schedule->priority == 'low') selected @endif>Low</option>
                                        <option value="medium" @if($item_schedule->priority == 'medium') selected @endif>Medium</option>
                                        <option value="high" @if($item_schedule->priority == 'high') selected @endif>High</option>
                                    </select>
                                    <span class="priority-circle"></span>
                                </div>
                            </td>
                            <td>
                                <select class="form-control status-select" data-id="{{ $item->id }}">
                                    <option value="todo" @if($item_schedule->status == 'todo') selected @endif>Todo</option>
                                    <option value="in-progress" @if($item_schedule->status == 'in-progress') selected @endif>In Progress</option>
                                    <option value="done" @if($item_schedule->status == 'done') selected @endif>Done</option>
                                </select>
                            </td>
                            <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#subtasksModal" data-id="{{ $item->id }}">Subtasks</button></td>

                            <td><button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#filesModal">Files</button></td>
                            <td><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#commentsModal">Comments</button></td>
                        </tr>
                        @endforeach
                        @else
                        <tr id="new-row" class="ui-sortable-handle">
                            <td colspan="6"><button class="btn btn-primary btn-sm">New mission schedule</button></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            @endforeach









            {{-- <table class="table sortable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" colspan="7" style="color: #fff;background-color: #2a6198;border-color: #2a6198;padding: 5px;">Develop</th>

                    </tr>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">priority</th>
                        <th scope="col">status</th>
                        <th scope="col">Subtasks</th>
                        <th scope="col">Files</th>
                        <th scope="col">comments</th>
                    </tr>
                </thead>
                <tbody class="sortable">
                    <!-- Sample row, replace with your data using your backend -->
                    <tr id="new-row">
                        <td colspan="6"><button class="btn btn-primary btn-sm waves-effect waves-light">New mission schedule</button></td>
                    </tr>

                </tbody>
            </table> --}}
        </div>
    </div>
    <!-- Modal for Creating New Table -->
    <div class="modal fade" id="newTableModal" tabindex="-1" role="dialog" aria-labelledby="newTableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newTableModalLabel">Create New Table</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="newTableForm">
                        <div class="form-group">
                            <label for="tableNameInput">Table Name</label>
                            <input type="text" class="form-control" id="tableNameInput" required>
                        </div>
                        <div class="form-group">
                            <label for="tableColorInput">Table Color</label>
                            <input type="color" class="form-control" id="tableColorInput" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="createTableButton">Create</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Subtasks Modal -->
    <div class="modal fade left" id="subtasksModal" tabindex="-1" role="dialog" aria-labelledby="subtasksModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blue; color: white;">
                    <h5 class="modal-title" id="subtasksModalLabel">Subtasks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Subtasks content goes here -->
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" id="subtaskCheckbox1" class="form-check-input mr-3" style="transform: scale(1.5);">
                                <label for="subtaskCheckbox1" class="form-check-label mb-0" style="font-size: 1.2em;">Subtask 1 description</label>
                            </div>
                        </div>
                    </div>
                    <div class="subtasks">

                    </div>
                    <!-- Text field for adding new subtask -->
                    <div class="mt-3">
                        <label for="newSubtaskInput">Add New Subtask</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="newSubtaskInput" onKeyPress="if(event.keyCode==13){addNewSubtask();}">
                        </div>
                    </div>

                    <!-- Progress bar -->
                    <div class="mt-3">
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 0%;">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Files Modal -->
    <div class="modal fade left" id="filesModal" tabindex="-1" role="dialog" aria-labelledby="filesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #9551b7; color: white;">
                    <h5 class="modal-title" id="filesModalLabel">Files</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Files content goes here -->
                    <!-- Filepond file upload section -->
                    <div class="dropzone" id="fileUploadDropzone"></div>
                    <!-- File download section -->
                    <div class="mt-3">
                        <a href="#" class="btn btn-primary" style="background: #9551b7 !important;"><i class="fas fa-file-pdf"></i> Download PDF</a>
                        <a href="#" class="btn btn-primary" style="background: #9551b7 !important;"><i class="fas fa-file-word"></i> Download Word</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Modal -->
    <div class="modal fade left" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #00c851; color: rgb(255, 255, 255);">
                    <h5 class="modal-title" id="commentsModalLabel">Comments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Comments content goes here -->
                    <div class="mb-3 comment-card">
                        <div class="d-flex justify-content-between">
                            <h6>User 1</h6>
                            <button class="btn btn-danger btn-sm delete-comment"><i class="fas fa-trash"></i></button>
                        </div>
                        <p style="white-space: pre-line;">Comment text goes here...</p>
                    </div>
                    <!-- Comment input field -->
                    <div class="form-group">
                        <label for="commentTextarea">Add Comment</label>
                        <textarea class="form-control" id="commentTextarea"></textarea>
                        <button class="btn btn-primary" id="addCommentButton">Add Comment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-jsx />

</body>
</html>
<script>
    // Initialize Dropzone
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        var myDropzone = new Dropzone("#fileUploadDropzone", {
            url: "/file/post"
            , maxFilesize: 5, // MB
            maxFiles: 5
            , acceptedFiles: ".pdf,.doc,.docx"
            , dictDefaultMessage: "Drop files here or click to upload"
            , dictFallbackMessage: "Your browser does not support drag'n'drop file uploads."
            , dictFileTooBig: function(file) {
                var maxFileSizeMB = 5;
                return "File is too big (" + (file.size / (1024 * 1024)).toFixed(2) + "MB). Max filesize: " + maxFileSizeMB + "MB.";
            }
            , dictInvalidFileType: "You can't upload files of this type."
            , dictCancelUpload: "Cancel"
            , dictRemoveFile: "Remove"
            , headers: {
                "Authorization": "Bearer YourAuthTokenHere"
            }
        });
    });

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


                // alert(targetTableNamex);


                var sourceTableName = ui.item.data('table-name');

                if (targetTableName !== sourceTableName) {
                    var newType = targetTableNamex;

                    var scheduleId = ui.item.find('th:first-child').text();

                    $.ajax({
                        url: '{{ route("schedule.update-type", ":id") }}'.replace(':id', scheduleId)
                        , type: 'PATCH'
                        , data: {
                            type: newType
                            , _token: $('meta[name="csrf-token"]').attr('content')
                        }
                        , success: function(response) {
                            console.log('Schedule type updated successfully');
                        }
                        , error: function(xhr, status, error) {
                            console.error('Error updating schedule type:', error);
                        }
                    });
                }
            }
        }).disableSelection();
    });


    // Add new subtask
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

    // Update progress bar on subtask completion
    $('#subtasksModal .modal-body').on('change', '.form-check-input', function() {
        updateProgressBar();
    });

    function updateProgressBar() {
        var totalSubtasks = $('#subtasksModal .form-check-input').length;
        var completedSubtasks = $('#subtasksModal .form-check-input:checked').length;
        var progressPercentage = (completedSubtasks / totalSubtasks) * 100;
        $('#subtasksModal .progress-bar').css('width', progressPercentage + '%').text(Math.round(progressPercentage) + '%');
    }
    // Add new comment
    $('#addCommentButton').click(function() {
        var commentText = tinyMCE.get('commentTextarea').getContent().trim();
        if (commentText !== '') {
            var newCommentHtml = `
            <div class="mb-3 comment-card">
                <div class="d-flex justify-content-between">
                    <h6>User</h6>
                    <button class="btn btn-danger btn-sm delete-comment"><i class="fas fa-trash"></i></button>
                </div>
                <p style="white-space: pre-line;">${commentText}</p>
            </div>
        `;
            $('#commentsModal .modal-body').append(newCommentHtml);
            tinyMCE.get('commentTextarea').setContent('');
        }
    });

    // Delete comment
    $('#commentsModal .modal-body').on('click', '.delete-comment', function() {
        $(this).closest('.comment-card').remove();
    });

    // TinyMCE initialization
    tinymce.init({
        selector: '#commentTextarea'
        , plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons'
        , imagetools_cors_hosts: ['picsum.photos']
        , menubar: 'file edit view insert format tools table help'
        , toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link anchor codesample | ltr rtl'
        , toolbar_sticky: true
        , autosave_ask_before_unload: true
        , autosave_interval: '30s'
        , autosave_prefix: '{path}{query}-{id}-'
        , autosave_restore_when_empty: false
        , autosave_retention: '2m'
        , image_advtab: true
        , link_list: [{
                title: 'My page 1'
                , value: 'https://www.tiny.cloud'
            }
            , {
                title: 'My page 2'
                , value: 'http://www.tiny.cloud'
            }
        ]
        , image_list: [{
                title: 'My page 1'
                , value: 'https://www.tiny.cloud'
            }
            , {
                title: 'My page 2'
                , value: 'http://www.tiny.cloud'
            }
        ]
        , image_class_list: [{
                title: 'None'
                , value: ''
            }
            , {
                title: 'Some class'
                , value: 'class-name'
            }
        ]
        , importcss_append: true
        , file_picker_callback: function(callback, value, meta) {
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
                    source2: 'alt.mp4'
                    , poster: 'https://picsum.photos/id/123/200/300'
                });
            }
        }
        , templates: [{
                title: 'New Table'
                , description: 'creates a new table'
                , content: '<div class="mceTmElem"></div><table width="98%%">%7<tbody>%7<tr>%7<td></td>%7</tr>%7</tbody>%7</table>'
            }
            , {
                title: 'Starting my story'
                , description: 'A cure for writers block'
                , content: 'Once upon a time...'
            }
            , {
                title: 'New list with dates'
                , description: 'New List with dates'
                , content: '<div class="mceTmElem"></div><span></span>%7<ul>%7<li>%7<span thutto Monday</span>%7</li>%7<li>%7<span thutto Tuesday</span>%7</li>%7</ul>'
            }
        ]
        , template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]'
        , template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]'
        , height: 600
        , image_caption: true
        , quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable'
        , noneditable_noneditable_class: 'mceNonEditable'
        , toolbar_mode: 'sliding'
        , contextmenu: 'link image imagetools table configurepermanentpen'
        , skin: 'oxide'
        , content_css: 'default'
        , content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        , font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n'
        , setup: (editor) => {
            editor.on('init', () => {
                console.log('TinyMCE is ready!');
            });
        }
    });
    // Smooth scrolling
    $('.modal').on('show.bs.modal', function() {
        $('body').css('overflow', 'hidden');
    }).on('hidden.bs.modal', function() {
        $('body').css('overflow', 'auto');
    });
    $('.modal-dialog-scrollable .modal-body').css({
        'overflow-y': 'auto'
        , 'max-height': 'calc(100vh - 200px)'
    });
    $('.create-icon').click(function() {
        $('#newTableModal').modal('show');
    });
    $('#createTableButton').click(function() {
        var tableName = $('#tableNameInput').val();
        var tableColor = $('#tableColorInput').val();

        if (tableName && tableColor) {
            $.ajax({
                url: '/administration/public/tables',

                type: 'POST'
                , data: {
                    name: tableName
                    , color: tableColor
                    , _token: $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    // Create the new table HTML
                    var newTableHTML = `
<div class="table-header">
    <button class="btn btn-danger btn-sm delete-table-btn"><i class="fas fa-trash"></i></button>
    <table class="table sortable">
        <thead class="thead-dark">
            <tr>
                <th scope="col" colspan="7" style="color: #fff; background-color: ${response.color}; border-color: ${response.color}; padding: 5px;">${response.name}</th>
            </tr>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">priority</th>
                <th scope="col">status</th>
                <th scope="col">Subtasks</th>
                <th scope="col">Files</th>
                <th scope="col">comments</th>
            </tr>
        </thead>
        <tbody class="sortable">
            <tr id="new-row">
                <td colspan="6"><button class="btn btn-primary btn-sm">New mission schedule</button></td>
            </tr>
        </tbody>
    </table>
</div>
`;

                    // Insert the new table before the last table
                    $('.table-container table:last').before(newTableHTML);

                    // Clear the form inputs
                    $('#tableNameInput').val('');
                    $('#tableColorInput').val('#000000');

                    // Close the modal
                    $('#newTableModal').modal('hide');
                    $('.table-container').trigger('table-created');
                }
                , error: function(xhr, status, error) {
                    // Handle the error
                    console.error(error);
                }
            });
        }
    });

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
                // Remove the table from the page
                $tableHeader.remove();
                console.log(response.message);
            }
            , error: function(xhr, status, error) {
                // Handle the error
                console.error(error);
            }
        });
    });


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

    $('.table-container').on('change', '.status-select', function() {
        var selectedStatus = $(this).val();
        var rowElement = $(this).closest('tr');

        // Change the color of the row based on the selected status
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
    // $(document).ready(function() {
    //     $('.priority-select').each(function() {
    //         var $this = $(this);
    //         var selectedOption = $this.find('option:selected');
    //         var color = selectedOption.data('color');
    //         $this.siblings('.priority-circle').css('background-color', color);
    //     });

    //     $('.priority-select').on('change', function() {
    //         var $this = $(this);
    //         var selectedOption = $this.find('option:selected');
    //         var color = selectedOption.data('color');
    //         $this.siblings('.priority-circle').css('background-color', color);
    //     });
    // });

</script>
<script>
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


    $('.table-container').on('change', '.priority-select, .status-select', function() {
        var $this = $(this);
        var scheduleId = $this.data('id');
        var fieldName = $this.hasClass('priority-select') ? 'priority' : 'status';
        var fieldValue = $this.val();
        var otherFieldName = fieldName === 'priority' ? 'status' : 'priority';
        var otherFieldValue = $this.siblings('.' + otherFieldName + '-select').val();

        $.ajax({
            url: '/administration/public/schedule/' + scheduleId,


            type: 'PATCH'
            , data: {
                [fieldName]: fieldValue
                , [otherFieldName]: otherFieldValue
                , _token: $('meta[name="csrf-token"]').attr('content')
            }
            , success: function(response) {
                // Update the row's background color based on the status
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
                // Handle the error
                console.error(error);
            }
        });
    });
    $(document).ready(function() {
        $('.table-container .status-select').each(function() {
            var $this = $(this);
            var selectedStatus = $this.val();
            var rowElement = $this.closest('tr');

            // Change the color of the row based on the selected status
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

</body>
</html>
