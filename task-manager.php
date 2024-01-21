<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Add Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <title>Task Assignment Form</title>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 50px;
    }

    h2, h3, h4 {
      color: #007bff;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .user-box {
      background-color: #f8f9fa;
      border: 1px solid #ced4da;
      border-radius: 5px;
      padding: 15px;
      margin-bottom: 20px;
    }

    .task-box {
      background-color: #ffffff;
      border: 1px solid #ced4da;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .remove-btn {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .user-image {
      width: 50px; /* Adjust the width as needed */
      height: 50px; /* Adjust the height as needed */
      border-radius: 50%;
      margin-right: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">Task Assignment</h2>
  <form id="taskForm">
    <div class="form-group">
      <label>Task Entry:</label>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="taskEntry" id="selectTask" value="select" checked>
        <label class="form-check-label" for="selectTask">Select Task</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="taskEntry" id="manualEntry" value="manual">
        <label class="form-check-label" for="manualEntry">Manual Entry</label>
      </div>
    </div>

    <div class="form-group" id="selectTaskGroup">
      <label for="taskSelect">Select Task:</label>
      <select class="form-control" id="taskSelect" required>
        <option value="task1">Task 1</option>
        <option value="task2">Task 2</option>
      </select>
    </div>

    <div class="form-group" id="manualTaskGroup" style="display: none;">
      <label for="manualTask">Manual Entry:</label>
      <input type="text" class="form-control" id="manualTask" placeholder="Enter task manually">
    </div>

    <div class="form-group">
      <label for="userSelect">Select User:</label>
      <select class="form-control" id="userSelect" required>
        <option value="user1">User 1</option>
        <option value="user2">User 2</option>
      </select>
    </div>

    <div class="form-group">
      <label for="deadline">Select Deadline:</label>
      <input type="date" class="form-control" id="deadline" required>
    </div>

    <button type="button" class="btn btn-primary btn-block" onclick="assignTask()">Assign Task</button>
  </form>

  <div class="mt-4">
    <h3 class="text-center mb-4">Assigned Tasks</h3>
    <div id="assignedTasks">
      <!-- Tasks will be displayed here -->
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  // Clear local storage on page load
  localStorage.clear();

  $(document).ready(function() {
    // Load existing tasks from local storage
    loadTasks();

    $('input[name="taskEntry"]').change(function() {
      if ($('#manualEntry').is(':checked')) {
        $('#selectTaskGroup').hide();
        $('#manualTaskGroup').show();
      } else {
        $('#selectTaskGroup').show();
        $('#manualTaskGroup').hide();
      }
    });
  });

  function assignTask() {
    var user = $('#userSelect').val();
    var task = ($('#manualEntry').is(':checked')) ? $('#manualTask').val() : $('#taskSelect').val();
    var deadline = $('#deadline').val();

    if (deadline === "") {
      alert('Please select a deadline.');
      return;
    }

    // Check for existing tasks for the user
    var existingTasks = getTasks(user);

    // Check if the task is already assigned
    if (existingTasks.includes(task)) {
      alert('Task already assigned to the user.');
      return;
    }

    // Save the task to local storage
    existingTasks.push(task);
    saveTasks(user, existingTasks);

    // Display the assigned task
    displayAssignedTask(user, task, deadline);

    // Show alert for successful task assignment
    showAlert('Task assigned successfully!');
  }

  function showAlert(message) {
    var alertDiv = $('<div>').addClass('alert alert-success mt-3').text(message);
    $('.container').prepend(alertDiv);

    // Remove the alert after 3 seconds
    setTimeout(function() {
      alertDiv.remove();
    }, 3000);
  }

  function saveTasks(user, tasks) {
    localStorage.setItem(user, JSON.stringify(tasks));
  }

  function getTasks(user) {
    var tasks = localStorage.getItem(user);
    return tasks ? JSON.parse(tasks) : [];
  }

  function loadTasks() {
    // Do not load tasks on page load
  }

  function displayAssignedTask(user, task, deadline) {
    // Check if the user has already been displayed
    var userDiv = $('#user-' + user);

    if (userDiv.length) {
      // User already displayed, append the new task
      var taskElement = $('<div>').addClass('task-box').text(task + ' (Deadline: ' + deadline + ')');
      var removeButton = $('<button>').text('Remove').addClass('btn btn-danger btn-sm remove-btn').click(function() {
        removeTask(user, task);
        taskElement.remove();
        checkAndRemoveUserSection(user);
      });
      taskElement.append(removeButton);
      userDiv.find('.tasks-container').append(taskElement);
    } else {
      // User not displayed, create a new user entry
      displayUserTasks(user, [task], deadline);
    }
  }

  function displayUserTasks(user, tasks, deadline) {
    var assignedTasksDiv = $('#assignedTasks');
    var userDiv = $('<div>').attr('id', 'user-' + user).addClass('user-box row');
    var userCol = $('<div>').addClass('col-md-2 my-auto');
    var userImage = $('<img>').attr('src', 'path/to/user-image.jpg').addClass('user-image');
    var userName = $('<h4>').text(user).addClass('text-dark mt-2');
    var tasksContainer = $('<div>').addClass('tasks-container col-md-10');

    userCol.append(userImage);
    userCol.append(userName);

    tasks.forEach(function(task) {
      var taskElement = $('<div>').addClass('task-box').text(task + ' (Deadline: ' + deadline + ')');
      var removeButton = $('<button>').text('Remove').addClass('btn btn-danger btn-sm remove-btn').click(function() {
        removeTask(user, task);
        taskElement.remove();
        checkAndRemoveUserSection(user);
      });
      taskElement.append(removeButton);
      tasksContainer.append(taskElement);
    });

    userDiv.append(userCol, tasksContainer);
    assignedTasksDiv.append(userDiv);
  }

  function removeTask(user, task) {
    var existingTasks = getTasks(user);
    var updatedTasks = existingTasks.filter(function(existingTask) {
      return existingTask !== task;
    });
    saveTasks(user, updatedTasks);
  }

  function checkAndRemoveUserSection(user) {
    var userDiv = $('#user-' + user);
    if (userDiv.find('.tasks-container').children('.task-box').length === 0) {
      // If the user has no tasks, remove the entire user section
      userDiv.remove();
    }
  }
</script>

</body>
</html>
