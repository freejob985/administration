<div id="subtasksModal" class="modal fade left" tabindex="-1" role="dialog" aria-labelledby="subtasksModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: blue; color: white;">
                <h5 class="modal-title" id="subtasksModalLabel">Subtasks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="subtasks-container">
                <div class="subtasks">
                    <div class="subtask-item draggable">
                        <div class="form-check d-flex align-items-center">
                            <input type="checkbox" id="subtaskCheckbox1" class="form-check-input mr-3"
                                style="transform: scale(1.5);">
                            <label for="subtaskCheckbox1" class="form-check-label mb-0"
                                style="font-size: 1.2em;">Subtask 1 description</label>
                        </div>
                    </div>
                    <!-- Add more subtask items here -->
                </div>
                <!-- Text field for adding new subtask -->
                <div class="mt-3">
                    <label for="newSubtaskInput">Add New Subtask</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="newSubtaskInput"
                            onKeyPress="if(event.keyCode==13){addNewSubtask();}">
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