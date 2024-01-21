// Clear local storage on page load
localStorage.clear();

$(document).ready(function() {
  // Load existing tasks from local storage

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
    Swal.fire("Warning!", "This task is already assigned to the user!", "error");
    return
  }

  // Save the task to local storage
  existingTasks.push(task);
  saveTasks(user, existingTasks);

  // Display the assigned task
  displayAssignedTask(user, task, deadline);

  // Show alert for successful task assignment
  showAlert();
}

function showAlert() {
  Swal.fire("Done!", "The task has been assigned!", "success");
}

function saveTasks(user, tasks) {
  localStorage.setItem(user, JSON.stringify(tasks));
}

function getTasks(user) {
  var tasks = localStorage.getItem(user);
  return tasks ? JSON.parse(tasks) : [];
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
  var userCol = $('<div>').addClass('col-md-3 my-auto text-center');
  var userImage = $('<img>').attr('src', 'assets/img/avatar.png').addClass('user-image');
  var userName = $('<h4>').text(user.replace("__"," ")).addClass('text-dark mt-2');
  var tasksContainer = $('<div>').addClass('tasks-container col-md-9 my-auto');

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