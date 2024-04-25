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
            <a class="btn btn-primary" href="http://localhost/administration/public/task" >رجوع الي المشاريع</a>
            <a class="btn btn-secondary"  href="http://localhost/administration/public/Lansori" target="_blank">لانسوري </a>
            <a class="btn btn-success"  href="http://localhost/administration/public/Artificial" target="_blank">تكوين سؤال </a>
            <a class="btn btn-danger"  href="http://localhost/wordpress.php" target="_blank">اضافة مشروع برمجي  </a>
            <a class="btn btn-warning"  href="">المدونة </a>
            <a class="btn btn-primary"  href="{{ route('mental.index', [$id]) }}"> مساحة العمل  </a>

        </div>
    </div>


    <!-- Table Container -->
    <div class="table-container">

        <!-- Your beautiful table goes here -->
        <!-- Add buttons with plus icon -->
        <div>
            <div class="text-box-container" data-id="{{ $id }}">
                <input type="text" id="newTaskInput" class="form-control" placeholder="أدخل التاسك الجديد">
            </div>
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

@php
$num =0
@endphp
                    @foreach ($schedule as $item)
                        @php
                        $num ++;
                        @endphp
                    <tr>
                        <th scope="row">{{ $num }}</th>
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
    <option value="error" @if($item->status == 'error') selected @endif>Error</option>
    <option value="study" @if($item->status == 'study') selected @endif>Study</option>
    <option value="research" @if($item->status == 'research') selected @endif>Research</option>
</select>
                        </td>
                        <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#subtasksModal" data-schedule-id="{{ $item->id }}" data-name="{{ $item->name }}">Subtasks</button></td>

                        <td><button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#filesModal"  data-schedule-id="{{ $item->id }}"  data-name="{{ $item->name }}">Files</button></td>
                        <td><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#commentsModal" data-schedule-id="{{ $item->id }}" data-name="{{ $item->name }}">Comments</button></td>
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
                            <th scope="row">{{ $num }}</th>
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
                              <select class="form-control status-select" data-id="{{ $item_schedule->id }}">
    <option value="todo" @if($item_schedule->status == 'todo') selected @endif>Todo</option>
    <option value="in-progress" @if($item_schedule->status == 'in-progress') selected @endif>In Progress</option>
    <option value="done" @if($item_schedule->status == 'done') selected @endif>Done</option>
    <option value="error" @if($item_schedule->status == 'error') selected @endif>Error</option>
    <option value="study" @if($item_schedule->status == 'study') selected @endif>Study</option>
    <option value="research" @if($item_schedule->status == 'research') selected @endif>Research</option>
</select>
                            </td>
                            <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#subtasksModal" data-schedule-id="{{ $item_schedule->id }}" data-name="{{ $item_schedule->name }}" >Subtasks</button></td>

                            <td><button class="btn btn-secondary btn-sm filesModal" data-toggle="modal" data-target="#filesModal"  data-schedule-id="{{ $item_schedule->id }}" data-name="{{ $item_schedule->name }}">Files</button></td>
                            <td><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#commentsModal"  data-schedule-id="{{ $item_schedule->id }}" data-name="{{ $item_schedule->name }}">Comments</button></td>
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
                <div class="modal-header" style="background-color: #4285f4; color: white;">

                    <h5 class="modal-title" id="subtasksModalLabel">Subtasks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Subtasks content goes here -->
                    {{-- <div class="card draggable">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" id="subtaskCheckbox1" class="form-check-input mr-3" style="transform: scale(1.5);">
                                <label for="subtaskCheckbox1" class="form-check-label mb-0" style="font-size: 1.2em;">Subtask 1 description</label>
                            </div>
                            <i class="fas fa-trash delete-icon"></i>
                        </div>
                    </div>
                    <div class="card draggable">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" id="subtaskCheckbox2" class="form-check-input mr-3" style="transform: scale(1.5);">
                                <label for="subtaskCheckbox2" class="form-check-label mb-0" style="font-size: 1.2em;">Subtask 2 description</label>
                            </div>
                            <i class="fas fa-trash delete-icon"></i>
                        </div>
                    </div> --}}
                    <!-- Add your other subtasks here -->

                    <div class="subtasks"  id="sortable-list">

                    </div>
                    <!-- Text field for adding new subtask -->
                   <div class="mt-3">
        <label for="newSubtaskInput">إضافة مهمة فرعية جديدة</label>
        <div class="input-group">
            <input type="text" class="form-control" id="newSubtaskInput" onKeyPress="if(event.keyCode==13){addNewSubtask();}">
            <div class="input-group-append" style="display: none">
                <button class="btn btn-primary" onclick="addNewSubtask()">إضافة</button>
            </div>
        </div>
    </div>

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

  <div class="mt-3 file-list">
                        <!-- Files will be displayed here -->
                    </div>

                    <div class="mt-3">
                        {{-- <a href="#" class="btn btn-primary" style="background: #9551b7 !important;"><i class="fas fa-file-pdf"></i> Download PDF</a>
                        <a href="#" class="btn btn-primary" style="background: #9551b7 !important;"><i class="fas fa-file-word"></i> Download Word</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Modal -->
<div class="modal fade left" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document" >
        <div class="modal-content" style="
    width: 1606px;
">
            <div class="modal-header" style="background-color: #00c851; color: rgb(255, 255, 255);">
                <h5 class="modal-title" id="commentsModalLabel">Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="comments-list">
                    <!-- Comments will be loaded here -->
                </div>
                <div class="form-group">
                    {{-- <label for="commentTextarea">Add Comment</label> --}}
                    <textarea class="form-control" id="commentTextarea"></textarea>
<input type="hidden" name="schedule_id" id="schedule_id">
                    <button class="btn btn-primary" id="addCommentButton" style="
    width: 100%;
    background: #00c851 !important;
"> اضافة تعليق </button>
                </div>
            </div>
        </div>
    </div>
</div>




    <x-jsx />

</body>
</html>
<x-scriptx />
</body>
</html>
