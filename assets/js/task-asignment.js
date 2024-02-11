var taskAssignments = {};

$(document).ready(function() {
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

  if (task === "") {
    Swal.fire("Warning!", "Please select a task!", "error");
    return;
  }
  if (user === "") {
    Swal.fire("Warning!", "Please select a teacher!", "error");
    return;
  }
  if (deadline === "") {
    Swal.fire("Warning!", "Please select a deadline!", "error");
    return;
  }

  // Check for existing tasks for the user
  if (!taskAssignments[user]) {
    taskAssignments[user] = [];
  }

  // Check if the task is already assigned
  if (taskAssignments[user].some(t => t.task === task)) {
    Swal.fire("Warning!", "This task is already assigned to the user!", "error");
    return;
  }

  // Save the task assignment
  taskAssignments[user].push({ task: task, deadline: deadline });

  // Display the assigned task
  displayAssignedTask(user, task, deadline);

  // Show alert for successful task assignment
  showAlert();

  $('#taskSelect').val('');
  $('#manualTask').val('');
  $('#userSelect').val('');
  $('#deadline').val('');
}


function showAlert() {
  Swal.fire("Done!", "The task has been assigned!", "success");
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
    displayUserTasks(user, [{ task: task, deadline: deadline }]);
  }
}

function displayUserTasks(user, tasks) {

  var assignedTasksDiv = $('.assignedTasks');
  var userDiv = $('<div>').attr('id', 'user-' + user).addClass('user-box row');
  var userCol = $('<div>').addClass('col-md-3 my-auto text-center');

  var getUser = user.split('__');

  var userGender = getUser[2];
  if(userGender == 'm'){
    var userImage = $('<img>').attr('src', 'assets/img/sir.jpg').addClass('user-image');
  }else{
    var userImage = $('<img>').attr('src', 'assets/img/miss.jpg').addClass('user-image');
  }
  
  var userName = $('<h4>').text(getUser[0]+' '+getUser[1]).addClass('text-dark mt-2');
  var tasksContainer = $('<div>').addClass('tasks-container col-md-9 my-auto');

  userCol.append(userImage);
  userCol.append(userName);

  tasks.forEach(function(taskObj) {
    var taskElement = $('<div>').addClass('task-box').text(taskObj.task + ' (Deadline: ' + taskObj.deadline + ')');
    var removeButton = $('<button>').text('Remove').addClass('btn btn-danger btn-sm remove-btn').click(function() {
      removeTask(user, taskObj.task);
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
  if (taskAssignments[user]) {
    taskAssignments[user] = taskAssignments[user].filter(function(taskObj) {
      return taskObj.task !== task;
    });
  }
}


function checkAndRemoveUserSection(user) {
  var userDiv = $('#user-' + user);
  if (userDiv.find('.tasks-container').children('.task-box').length === 0) {
    // If the user has no tasks, remove the entire user section
    userDiv.remove();
  }
}