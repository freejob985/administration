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
                <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3">
                    <i class="fas fa-times text-danger delete-project" onclick="deleteProject(this)"></i>
                </div>
                <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3">${projectName}</div>
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
