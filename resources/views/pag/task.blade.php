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
        }

        .delete-icon {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .clock {
            cursor: pointer;
            display: inline-block;
            color: #333;
            font-size: 40px;
            margin-top: 5px;
            transition: color 0.3s ease;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <br>
    <br>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4">
                <div class="project-container mb-4">


                    <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3"
                        style="font-family: 'Changa', sans-serif;">
    <div class="clock" style="cursor: pointer; color: #333; font-size: 40px; margin-top: 5px; transition: color 0.3s ease; border: none; padding: 5px 10px; border-radius: 5px;">00:00:00</div>


</div>

                    <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3"
                        style="font-family: 'Changa', sans-serif;">اسم المشروع 1</div>
                    <div class="task-list">
                        <!-- مربع النص -->
                        <div class="mb-3">
                            <input type="text" class="form-control newTaskInput" placeholder="أدخل المهمة الجديدة" onkeyup="addNewTaskOnEnter(event, this)">
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








      <div class="col-md-4">
                <div class="project-container mb-4">


                    <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3"
                        style="font-family: 'Changa', sans-serif;"><span class="clock" onclick="toggleClock(this)">00:00:00</span></div>

                    <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3"
                        style="font-family: 'Changa', sans-serif;">اسم المشروع 1</div>
                    <div class="task-list">
                        <!-- مربع النص -->
                        <div class="mb-3">
                            <input type="text" class="form-control newTaskInput" placeholder="أدخل المهمة الجديدة" onkeyup="addNewTaskOnEnter(event, this)">
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




      <div class="col-md-4">
                <div class="project-container mb-4">


                    <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3"
                        style="font-family: 'Changa', sans-serif;"><span class="clock" onclick="toggleClock(this)">00:00:00</span></div>

                    <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3"
                        style="font-family: 'Changa', sans-serif;">اسم المشروع 1</div>
                    <div class="task-list">
                        <!-- مربع النص -->
                        <div class="mb-3">
                            <input type="text" class="form-control newTaskInput" placeholder="أدخل المهمة الجديدة" onkeyup="addNewTaskOnEnter(event, this)">
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



      <div class="col-md-4">
                <div class="project-container mb-4">


                    <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3"
                        style="font-family: 'Changa', sans-serif;"><span class="clock" onclick="toggleClock(this)">00:00:00</span></div>

                    <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3"
                        style="font-family: 'Changa', sans-serif;">اسم المشروع 1</div>
                    <div class="task-list">
                        <!-- مربع النص -->
                        <div class="mb-3">
                            <input type="text" class="form-control newTaskInput" placeholder="أدخل المهمة الجديدة" onkeyup="addNewTaskOnEnter(event, this)">
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
            <!-- يكرر هذا الجزء للمشاريع الأخرى -->

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
    // Make task list sortable
    $(".sortable").sortable({
        placeholder: "ui-state-highlight",
        update: function(event, ui) {
            updateProgressBar();
        }
    });
    $(".sortable").disableSelection();
});

// Event listeners for task completion
function toggleTaskCompletion(checkbox) {
    const taskElement = checkbox.parentElement.parentElement;
    taskElement.classList.toggle('completed');
    updateProgressBar();
}

function toggleTaskCompletionText(taskText) {
    const taskElement = taskText.parentElement.parentElement;
    taskElement.classList.toggle('completed');
    const checkbox = taskElement.querySelector('input[type="checkbox"]');
    checkbox.checked = taskElement.classList.contains('completed');
    updateProgressBar();
}

// Function to delete task
function deleteTask(event, taskElement) {
    const task = taskElement.parentElement;
    const isCompleted = task.classList.contains('completed');
    if (task) {
        task.remove();
        if (isCompleted) {
            updateProgressBar(true);
        } else {
            updateProgressBar();
        }
    }
}

// Function to add new task
function addNewTaskOnEnter(event, input) {
    if (event.key === 'Enter') {
        addNewTask(input);
    }
}

function addNewTask(input) {
    const newTaskInput = input;
    const newTaskText = newTaskInput.value.trim();

    if (newTaskText !== '') {
        const taskList = $(input).closest('.task-list').find('.sortable');
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

        taskList.append(newTask);
        newTaskInput.value = '';

        updateProgressBar();
    }
}

// Function to update progress bar
function updateProgressBar(decrementPercentage = false) {
    $(".task-list").each(function() {
        const tasks = $(this).find('.task');
        const completedTasks = $(this).find('.completed');
        const progressBar = $(this).find('.progress-bar');
        let progressPercentage = (completedTasks.length / tasks.length) * 100;

        if (decrementPercentage) {
            progressPercentage -= (100 / tasks.length);
        }

        progressBar.css('width', `${progressPercentage}%`);
        progressBar.attr('aria-valuenow', progressPercentage);
        progressBar.text(`${progressPercentage.toFixed(0)}%`);
    });
}
     // Function to toggle clock
        function toggleClock(clockElement) {
            if (clockElement.classList.contains('running')) {
                stopClock(clockElement);
            } else {
                startClock(clockElement);
            }
        }

        // Function to start the clock
        function startClock(clockElement) {
            if (!clockElement.startTime) {
                clockElement.startTime = new Date();
                clockElement.clockInterval = setInterval(updateClock, 1000, clockElement);
                clockElement.classList.add('running');
                updateClock(clockElement);
            }
        }

        // Function to stop the clock
        function stopClock(clockElement) {
            clearInterval(clockElement.clockInterval);
            clockElement.classList.remove('running');
            clockElement.stopTime = new Date();
        }

        // Function to update the clock time
        function updateClock(clockElement) {
            const currentTime = new Date();
            const elapsedTime = currentTime - clockElement.startTime;
            const elapsedSeconds = Math.floor(elapsedTime / 1000);
            const hours = Math.floor(elapsedSeconds / 3600).toString().padStart(2, '0');
            const minutes = Math.floor((elapsedSeconds % 3600) / 60).toString().padStart(2, '0');
            const seconds = (elapsedSeconds % 60).toString().padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            clockElement.textContent = timeString;
        }

        // Adding event listener to toggle clock
        document.addEventListener("click", function(event) {
            const clickedElement = event.target;
            if (clickedElement.classList.contains('clock')) {
                toggleClock(clickedElement);
            }
        });

</script>
</body>
</html>