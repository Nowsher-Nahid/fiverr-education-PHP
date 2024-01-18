<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Task Manager</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Datepicker CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <!-- Bootstrap Select CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <h2>Task Manager</h2>

      <!-- Dropdown for pre-defined tasks using select tag -->
      <div class="form-group">
        <label for="taskDropdown">Select a Task:</label>
        <select class="form-control" id="taskDropdown" onchange="addTaskFromDropdown()">
          <option value="Task 1">Task 1</option>
          <option value="Task 2">Task 2</option>
          <option value="Task 3">Task 3</option>
        </select>
      </div>

      <!-- Input field for manual task addition -->
      <div class="input-group mb-3">
        <input type="text" class="form-control" id="manualTaskInput" placeholder="Enter a task">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" onclick="addManualTask()">Add</button>
        </div>
      </div>

      <!-- List to display tasks -->
      <ul class="list-group" id="taskList">
        <!-- Tasks will be added here -->
      </ul>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap Select JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/i18n/defaults-en_US.min.js"></script>

<script>
  // Initialize Bootstrap Datepicker
  $(document).ready(function(){
    $('#deadline').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
  });

  // Function to add tasks from dropdown to the list
  function addTaskFromDropdown() {
    var taskDropdown = document.getElementById('taskDropdown');
    var selectedTask = taskDropdown.value;
    addTask(selectedTask);
  }

  // Function to add manually entered tasks to the list
  function addManualTask() {
    var manualTaskInput = document.getElementById('manualTaskInput');
    var task = manualTaskInput.value.trim();
    if (task !== '') {
      if (!isTaskDuplicate(task)) {
        addTask(task);
        manualTaskInput.value = ''; // Clear the input field
      } else {
        alert('Task already exists!');
      }
    }
  }

  // Function to add tasks to the list
  function addTask(task) {
    if (!isTaskDuplicate(task)) {
      var taskList = document.getElementById('taskList');
      var listItem = document.createElement('li');
      listItem.className = 'list-group-item';
      listItem.textContent = task;

      // Create a div for calendar and user dropdown
      var taskOptions = document.createElement('div');
      taskOptions.className = 'd-flex justify-content-between align-items-center';

      // Deadline calendar
      var deadlineInput = document.createElement('input');
      deadlineInput.type = 'text';
      deadlineInput.className = 'form-control';
      deadlineInput.placeholder = 'Select a deadline';
      deadlineInput.setAttribute('data-provide', 'datepicker');
      deadlineInput.setAttribute('data-date-format', 'yyyy-mm-dd');
      deadlineInput.setAttribute('data-date-autoclose', 'true');
      taskOptions.appendChild(deadlineInput);

      // Assign task to users using Bootstrap Select
      var assigneeSelect = document.createElement('select');
      assigneeSelect.className = 'form-control selectpicker ml-2';
      assigneeSelect.setAttribute('data-live-search', 'true');
      var users = ['User 1', 'User 2', 'User 3'];
      for (var i = 0; i < users.length; i++) {
        var option = document.createElement('option');
        option.value = 'user' + (i + 1);
        option.textContent = users[i];
        assigneeSelect.appendChild(option);
      }
      taskOptions.appendChild(assigneeSelect);

      listItem.appendChild(taskOptions);

      taskList.appendChild(listItem);

      // Initialize Bootstrap Select for the new task
      $('.selectpicker').selectpicker('refresh');
    }
  }

  // Function to check if a task already exists in the list
  function isTaskDuplicate(task) {
    var taskListItems = document.querySelectorAll('#taskList li');
    for (var i = 0; i < taskListItems.length; i++) {
      if (taskListItems[i].textContent === task) {
        return true;
      }
    }
    return false;
  }
</script>

</body>
</html>
