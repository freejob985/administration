$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Load projects from the server
    loadProjects();

    // Initialize Sortable.js
    initializeSortable();
});

function loadProjects() {
    $.ajax({
        url: '/administration/public/projects',
        type: 'GET',
        success: function(response) {
            $('#projectsContainer').html(response);
            initializeSortable();
        },
        error: function() {
            alert('Error loading projects');
        }
    });
}

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
    const taskId = taskElement.id.replace('task-', '');
    const isCompleted = taskElement.classList.contains('completed');

    $.ajax({
        url: `/administration/public/tasks/${taskId}`,
        type: 'PUT',
        data: {
            completed: !isCompleted ? 1 : 0,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            taskElement.classList.toggle('completed');
            updateProgressBar(taskElement.closest('.sortable'));
        },
        error: function() {
            alert('Error updating task status');
        }
    });
}

function toggleTaskCompletionByClick(taskElement) {
    const checkbox = taskElement.querySelector('input[type="checkbox"]');
    const isCompleted = taskElement.classList.contains('completed');

    // Toggle the completed class based on the current state
    taskElement.classList.toggle('completed');

    // Update the checkbox state
    checkbox.checked = !isCompleted;

    // Update the progress bar
    const sortableList = taskElement.closest('.sortable');
    updateProgressBar(sortableList);

    // Send an AJAX request to update the task status on the server
    const taskId = taskElement.id.replace('task-', '');
    $.ajax({
        url: `/administration/public/tasks/${taskId}`,
        type: 'PUT',
        data: {
            completed: !isCompleted ? 1 : 0,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        error: function() {
            alert('Error updating task status');
        }
    });
}

// Function to delete task
function deleteTask(taskId, event) {
    event.stopPropagation(); // Prevent event propagation to parent elements

    $.ajax({
        url: `/administration/public/tasks/${taskId}`,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            // Remove the task from the view
            $(`#task-${taskId}`).remove();
        },
        error: function() {
            alert('Error deleting task');
        }
    });
}

// Function to add new task
function addNewTaskOnEnter(event, input, projectId) {
    if (event.key === 'Enter') {
        const taskName = input.value.trim();
        if (taskName !== '') {
            addNewTask(projectId, taskName);
            input.value = '';
        }
    }
}

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

function loadProject(projectId) {
    $.ajax({
        url: `/administration/public/projects/${projectId}`,
        type: 'GET',
        success: function(response) {
            $(`#project-${projectId}`).html(response);
            initializeSortable();
        },
        error: function() {
            alert('Error loading project');
        }
    });
}

function showAddProjectModal() {
    $('#addProjectModal').modal('show');
}

function addNewProject() {
    const projectName = $('#projectNameInput').val().trim();

    if (projectName !== '') {
        $.ajax({
            url: '/administration/public/projects',
            type: 'POST',
            data: {
                name: projectName,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                loadProjects();
                $('#addProjectModal').modal('hide');
                $('#projectNameInput').val('');
            },
            error: function() {
                alert('Error adding new project');
            }
        });
    }
}

function deleteProject(button) {
    const projectContainer = button.closest('.project-container');
    const projectId = projectContainer.id.replace('project-', '');

    $.ajax({
        url: `/administration/public/projects/${projectId}`,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            projectContainer.remove();
        },
        error: function() {
            alert('Error deleting project');
        }
    });
}
