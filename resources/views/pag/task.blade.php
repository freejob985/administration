<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة المهام</title>
    <link rel="stylesheet" href="task.css">
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
    padding-bottom: 150px; /* إضافة هامش أسفل لعدم تغطية الفوتر */
}

.project-row {
    height: calc(100vh - 150px - 60px); /* تحديد الارتفاع بعد طرح ارتفاع الفوتر وبعض المساحة الإضافية */
    overflow-y: auto; /* السماح بالتمرير العمودي عند تجاوز الارتفاع المحدد */
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
    </style>
</head>
<body>

{{-- <header class="bg-primary text-white py-3 mb-4">
    <div class="container">
        <h1 class="text-center mb-0">TASKS</h1>
    </div>
    <br>
    <br>
</header> --}}
 <br>
    <br>
    <div class="container-fluid">
        <div class="row project-row">

            <div class="col-md-4">
                <div class="project-container mb-4">
                    <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3" style="font-family: 'Changa', sans-serif;">
                        <i class="fas fa-times text-danger delete-project" onclick="deleteProject(this)"></i>
                    </div>
                    <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3" style="font-family: 'Changa', sans-serif;">اسم المشروع 1</div>
                    <div class="task-list">
                        <!-- مربع النص -->
                        <div class="mb-3">
                            <input type="text" class="form-control newTaskInput" placeholder="أدخل المهمة الجديدة" onkeyup="addNewTaskOnEnter(event, this, 'sortable1')">
                        </div>
                        <div class="progress mb-3">
                            <div class="progress-bar" id="progressBar1" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <div id="sortable1" class="sortable">
                            <!-- التاسكات -->
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-1"></div> --}}

        </div>
    </div>

    {{-- <div class="fixed-bottom d-flex justify-content-center mb-3">
        <button class="btn btn-primary btn-lg" >إضافة مشروع جديد</button>
    </div> --}}


<div class="footer-container fixed-bottom" style="background-color: #f0f0f0;padding: 15px;box-shadow: 0px -2px 5px #d5d1d1;">
    <div class="d-flex justify-content-center">
        <button class="btn btn-primary btn-lg me-3">زر 1</button>
        <button class="btn btn-secondary btn-lg me-3">زر 2</button>
        <button class="btn btn-success btn-lg me-3">زر 3</button>
        <button class="btn btn-danger btn-lg me-3">زر 4</button>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addProjectModal" onclick="showAddProjectModal()">إضافة مشروع جديد</button>
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
    <script>
        // Initialize Draggable.js
        $(function() {
            initializeSortable();
        });

        function initializeSortable() {
            $(".sortable").sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    updateProgressBar(this);
                }
            });
            $(".sortable").disableSelection();
        }

        // Event listeners for task completion
        function toggleTaskCompletion(checkbox) {
            const taskElement = checkbox.parentElement.parentElement;
            taskElement.classList.toggle('completed');
            updateProgressBar(taskElement.closest('.sortable'));
        }

        function toggleTaskCompletionText(taskText) {
            const taskElement = taskText.parentElement.parentElement;
            taskElement.classList.toggle('completed');
            const checkbox = taskElement.querySelector('input[type="checkbox"]');
            checkbox.checked = taskElement.classList.contains('completed');
            updateProgressBar(taskElement.closest('.sortable'));
        }

        // Function to delete task
        function deleteTask(event, taskElement) {
            const task = taskElement.parentElement;
            const sortableList = task.parentElement;
            const isCompleted = task.classList.contains('completed');
            if (task) {
                task.remove();
                updateProgressBar(sortableList, isCompleted);
            }
        }

        // Function to add new task
        function addNewTaskOnEnter(event, input, sortableId) {
            if (event.key === 'Enter') {
                addNewTask(input, sortableId);
            }
        }

function addNewTask(input, sortableId) {
    const newTaskInput = input;
    const newTaskText = newTaskInput.value.trim();

    if (newTaskText !== '') {
        const taskList = $(`#${sortableId}`);
        const newTask = document.createElement('div');
        newTask.className = 'task d-flex align-items-center bg-white rounded shadow-sm mb-2 p-2 draggable';
        newTask.innerHTML = `
            <label class="d-flex align-items-center mb-0" onclick="deleteTask(event, this)">
                <i class="fas fa-times text-danger"></i>
            </label>
            <div class="delete-icon ms-auto">
                <input type="checkbox" class="me-2" onchange="toggleTaskCompletion(this)">
                <span class="task-text me-2" onclick="toggleTaskCompletionText(this)">${newTaskText}</span>
            </div>
        `;

        newTask.addEventListener('click', function() {
            const checkbox = this.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            toggleTaskCompletion(checkbox);
        });

        taskList.append(newTask);
        newTaskInput.value = '';

        updateProgressBar(taskList);
        initializeSortable(); // Re-initialize Sortable for the new list
    }
}

        // Function to update progress bar
        function updateProgressBar(sortableList, decrementPercentage = false) {
            const tasks = $(sortableList).find('.task');
            const completedTasks = $(sortableList).find('.completed');
            const progressBar = $(sortableList).closest('.task-list').find('.progress-bar');
            let progressPercentage = (completedTasks.length / tasks.length) * 100;

            if (decrementPercentage) {
                progressPercentage -= (100 / tasks.length);
            }

            progressBar.css('width', `${progressPercentage}%`);
            progressBar.attr('aria-valuenow', progressPercentage);
            progressBar.text(`${progressPercentage.toFixed(0)}%`);
        }

        function showAddProjectModal() {
            $('#addProjectModal').modal('show');
        }

  function addNewProject() {
    const projectName = $('#projectNameInput').val().trim();

    if (projectName !== '') {
        // إنشاء عنصر جديد لمشروع جديد
        const newProjectContainer = document.createElement('div');
        newProjectContainer.className = 'col-md-4';
        const sortableId = 'sortable' + new Date().getTime(); // معرف فريد للقائمة الجديدة
        newProjectContainer.innerHTML = `
            <div class="project-container mb-4">
                <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3" style="font-family: 'Changa', sans-serif;">
                    <i class="fas fa-times text-danger delete-project" onclick="deleteProject(this)"></i>
                </div>
                <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3" style="font-family: 'Changa', sans-serif;">${projectName}</div>
                <div class="task-list">
                    <div class="mb-3">
                        <input type="text" class="form-control newTaskInput" placeholder="أدخل المهمة الجديدة" onkeyup="addNewTaskOnEnter(event, this, '${sortableId}')">
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <div id="${sortableId}" class="sortable"></div>
                </div>
            </div>
        `;

        // إضافة المشروع الجديد إلى الصفحة
        const projectsRow = document.querySelector('.project-row');
        projectsRow.appendChild(newProjectContainer);

        // إعادة تهيئة Sortable للقائمة الجديدة
        const newSortableList = document.querySelector(`#${sortableId}`);
        initializeSortable();

        // إغلاق النموذج
        $('#addProjectModal').modal('hide');
        $('#projectNameInput').val('');
    }
}

        function deleteProject(deleteIcon) {
            const projectContainer = deleteIcon.closest('.project-container');
            projectContainer.remove();
        }
    </script>
</body>
</html>
