<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Design Table</title>
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

    <!-- Custom Arabic Font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap');
        body {
            font-family: "Noto Kufi Arabic", sans-serif;
        }
        td {
            text-align: center;
        }
        /* CSS for Subtasks Modal */
        #subtasksModal .modal-body .card {
            margin-bottom: 10px;
        }

        #subtasksModal .modal-body .card-body {
            display: flex;
            align-items: center;
        }

        #subtasksModal .modal-body .form-check-label {
            margin-bottom: 0;
            margin-left: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #subtasksModal .modal-body input[type="text"] {
            width: 100%;
        }

        .dropzone {
            min-height: 150px;
            border: unset;
            background: #9551b7;
            padding: 20px 20px;
            color: white;
            font-size: 26px;
            text-transform: capitalize !important;
            font-weight: 800;
        }

        /* CSS for Progress Bar */
        .progress-container {
            width: 100%;
            height: 20px;
            background-color: #ddd;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #28a745;
            width: 0%;
            text-align: right;
            line-height: 20px;
            color: white;
            font-weight: bold;
            padding-right: 5px;
        }
        .card {
            box-shadow: -2px 1px 3px 0px #eeeeee;
            border: 0.5px solid #e3e3e3 !important;
        }
        .modal-dialog-scrollable .modal-body {
            overflow-y: unset;
        }
        .comment-card {
            border: 1px solid #e3e3e3;
            padding: 10px;
            border-radius: 5px;
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
            <table class="table sortable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" colspan="7" style="color: #fff;background-color: #2a6198;border-color: #2a6198;padding: 5px;">Develop</th>
                    </tr>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Status</th>
                        <th scope="col">Subtasks</th>
                        <th scope="col">Files</th>
                        <th scope="col">Comments</th>
                    </tr>
                </thead>
                <tbody class="sortable">
                    <!-- Sample row, replace with your data using your backend -->
                    <tr id="New">
                        <td colspan="6"><button class="btn btn-primary btn-sm">New mission schedule</button></td>
                    </tr>
                </tbody>
            </table>
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

    <!-- Add event listener to the "create-icon" button -->
    <script>
    document.querySelector('.create-icon').addEventListener('click', openCreateModuleModal);
    </script>

    <!-- Create a modal for creating a new module -->
    <div class="modal fade" id="createModuleModal" tabindex="-1" role="dialog" aria-labelledby="createModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModuleModalLabel">Create New Module</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createModuleForm">
                        <div class="form-group">
                            <label for="moduleName">Module Name</label>
                            <input type="text" class="form-control" id="moduleName" required>
                        </div>
                        <div class="form-group">
                            <label for="moduleColor">Module Color</label>
                            <input type="color" class="form-control" id="moduleColor" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

 <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include Material Design scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.js"></script>
    <!-- Include SweetAlert2 script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.19/sweetalert2.min.js"></script>
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

</body>
</html>



<script>
// Add event listener to the "create-icon" button
document.querySelector('.create-icon').addEventListener('click', openCreateModuleModal);

// Create a modal for creating a new module
function openCreateModuleModal() {
    $('#createModuleModal').modal('show');
}

document.getElementById('createModuleForm').addEventListener('submit', createNewModule);

function createNewModule(event) {
    event.preventDefault();
    const moduleName = document.getElementById('moduleName').value;
    const moduleColor = document.getElementById('moduleColor').value;

    // Create a new table element
    const newTable = document.createElement('table');
    newTable.classList.add('table', 'sortable');
    newTable.style.backgroundColor = moduleColor;

    // Create a new table header
    const newTableHeader = document.createElement('thead');
    newTableHeader.classList.add('thead-dark');
    const newTableHeaderRow = document.createElement('tr');
    const newTableHeaderCell = document.createElement('th');
    newTableHeaderCell.setAttribute('colspan', '7');
    newTableHeaderCell.style.color = '#fff';
    newTableHeaderCell.style.backgroundColor = '#2a6198';
    newTableHeaderCell.style.borderColor = '#2a6198';
    newTableHeaderCell.style.padding = '5px';
    newTableHeaderCell.textContent = moduleName;
    newTableHeaderRow.appendChild(newTableHeaderCell);
    newTableHeader.appendChild(newTableHeaderRow);

    const newTableColumnHeaders = ['ID', 'Name', 'Priority', 'Status', 'Subtasks', 'Files', 'Comments'];
    const newTableBodyRow = document.createElement('tr');
    newTableColumnHeaders.forEach(column => {
        const newTableColumnHeader = document.createElement('th');
        newTableColumnHeader.scope = 'col';
        newTableColumnHeader.textContent = column;
        newTableBodyRow.appendChild(newTableColumnHeader);
    });
    newTableHeader.appendChild(newTableBodyRow);
    newTable.appendChild(newTableHeader);

    // Create a new table body
    const newTableBody = document.createElement('tbody');
    newTableBody.classList.add('sortable');
    const newTableBodyRowData = document.createElement('tr');
    const newTableBodyRowDataCell = document.createElement('td');
    newTableBodyRowDataCell.setAttribute('colspan', '6');
    const newTableBodyRowDataButton = document.createElement('button');
    newTableBodyRowDataButton.classList.add('btn', 'btn-primary', 'btn-sm');
    newTableBodyRowDataButton.textContent = 'New mission schedule';
    newTableBodyRowDataCell.appendChild(newTableBodyRowDataButton);
    newTableBodyRowData.appendChild(newTableBodyRowDataCell);
    newTableBody.appendChild(newTableBodyRowData);
    newTable.appendChild(newTableBody);

    // Add the new table to the page
    const tableContainer = document.querySelector('.table-container');
    tableContainer.appendChild(newTable);

    // Close the modal
    $('#createModuleModal').modal('hide');
}

// Initialize Dropzone
Dropzone.autoDiscover = false;
$(document).ready(function () {
    var myDropzone = new Dropzone("#fileUploadDropzone", {
        url: "/file/post",
        maxFilesize: 5, // MB
        maxFiles: 5,
        acceptedFiles: ".pdf,.doc,.docx",
        dictDefaultMessage: "Drop files here or click to upload",
        dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
        dictFileTooBig: function(file) {
            var maxFileSizeMB = 5;
            return "File is too big (" + (file.size / (1024 * 1024)).toFixed(2) + "MB). Max filesize: " + maxFileSizeMB + "MB.";
        },
        dictInvalidFileType: "You can't upload files of this type.",
        dictCancelUpload: "Cancel",
        dictRemoveFile: "Remove",
        headers: {
            "Authorization": "Bearer YourAuthTokenHere"
        }
    });
});

$( function() {
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
    selector: '#commentTextarea',
    plugins: 'link image table lists',
    toolbar: 'undo redo | bold italic underline | link image | numlist bullist | align',
    height: 200,
    menubar: false,
    statusbar: false,
    body_class: 'form-control',
    font_formats: 'Arial=arial,helvetica,sans-serif;Times New Roman=times new roman,times,serif;Verdana=verdana,geneva,sans-serif'
});

// Smooth scrolling
$('.modal').on('show.bs.modal', function() {
    $('body').css('overflow', 'hidden');
}).on('hidden.bs.modal', function() {
    $('body').css('overflow', 'auto');
});

$('.modal-dialog-scrollable .modal-body').css({
    'overflow-y': 'auto',
    'max-height': 'calc(100vh - 200px)'
});
</script>



</body>
</html>




























