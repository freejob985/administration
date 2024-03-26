@foreach ($projects as $project)
<div class="col-md-4">
    <div class="project-container mb-4">
        <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3" style="font-family: 'Changa', sans-serif;">
            <i class="fas fa-times text-danger delete-project" onclick="deleteProject(this)"></i>
        </div>
        <div class="project-name bg-warning text-white fw-bold py-2 rounded mb-3" style="font-family: 'Changa', sans-serif;">{{ $project->name }}</div>
        <div class="task-list">
            <div class="mb-3">
                <input type="text" class="form-control newTaskInput" placeholder="أدخل المهمة الجديدة" onkeyup="addNewTaskOnEnter(event, this, 'sortable{{ $project->id }}')">
            </div>
            <div class="progress mb-3">
                @php
                    $totalTasks = $project->tasks->count();
                    $completedTasks = $project->tasks->where('completed', true)->count();
                    $progressPercentage = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                @endphp
                <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">{{ $progressPercentage }}%</div>
            </div>
            <div id="sortable{{ $project->id }}" class="sortable">
                @foreach ($project->tasks as $task)
                <div class="task d-flex align-items-center bg-white rounded shadow-sm mb-2 p-2 draggable {{ $task->completed ? 'completed' : '' }}">
                    <label class="d-flex align-items-center mb-0" onclick="deleteTask(event, this)">
                        <i class="fas fa-times text-danger"></i>
                    </label>
                    <div class="delete-icon ms-auto">
                        <input type="checkbox" class="me-2" onchange="toggleTaskCompletion(this)" {{ $task->completed ? 'checked' : '' }}>
                        <span class="task-text me-2" onclick="toggleTaskCompletionText(this)">{{ $task->name }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach
