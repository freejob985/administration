<div class="project-container mb-4" id="project-{{ $project->id }}">
    <div class="project-header d-flex justify-content-between align-items-center mb-3">
        <div class="project-name bg-warning text-white fw-bold py-2 rounded" style="font-family: 'Changa', sans-serif;">

<img src="https://icons.iconarchive.com/icons/aha-soft/free-3d-printer/72/Project-icon.png">

<a href="{{ route('mental.index', [$project->id]) }}" id="linke-titel">{{ $project->name }}</a>
  &nbsp;

        </div>
        <button class="btn btn-danger" onclick="deleteProject(this)">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="task-list">
        <div class="mb-3">
            <input type="text" class="form-control newTaskInput" placeholder="أدخل المهمة الجديدة" onkeyup="addNewTaskOnEnter(event, this, {{ $project->id }})">
        </div>
        <div class="progress mb-3">
            @php
                $totalTasks = $project->tasks->count();
                $completedTasks = $project->tasks->where('completed', true)->count();
            $progressPercentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
            @endphp
            <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">{{ $progressPercentage }}%</div>
        </div>
        <div id="sortable{{ $project->id }}" class="sortable">
            @foreach ($project->tasks as $task)
            <div id="task-{{ $task->id }}" class="task d-flex align-items-center bg-white rounded shadow-sm mb-2 p-2 draggable {{ $task->completed ? 'completed' : '' }}" onclick="toggleTaskCompletionByClick(this)">
                <label class="d-flex align-items-center mb-0" onclick="deleteTask({{ $task->id }}, event)">
                    <i class="fas fa-times text-danger"></i>
                </label>
                <div class="delete-icon ms-auto">
                    <input type="checkbox" class="me-2" onchange="toggleTaskCompletion(this)" {{ $task->completed ? 'checked' : '' }}>
                    <span class="task-text me-2">{{ $task->name }}</span>
                </div>
            </div>

            @endforeach
<a class="btn btn-primary" href="{{ route('Tables.index', [$project->id]) }}" style="background: white;color: black;border: white;box-shadow: -3px 0px #544f4f;">Secondary Button</a>

        </div>
    </div>
</div>
