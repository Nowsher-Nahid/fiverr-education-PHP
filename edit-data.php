<?php 
include('includes/header.php');
include('includes/navbar.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plan_title = isset($_POST["plan"]) ? $_POST["plan"] : "";
} else {
    header("Location: planning-tools.php");
    exit();
}

$where = array('title'=>$plan_title);
$get_report = $crudObj->select_record('*',$where,'vd_report');
$student_id = $get_report[0]['ID_pupil'];
$task_assignments = $get_report[0]['task_assignments'];
$teachers = $get_report[0]['teachers'];
$goals = $get_report[0]['goals'];
$actions = $get_report[0]['actions'];
$outcomes = $get_report[0]['outcomes'];
$area = $get_report[0]['area'];

?>
	<input type="text" value="<?php echo $user_id ?>" id="user-id" hidden>
	<input type="text" value="<?php echo $area ?>" id="area" hidden>
	<input type="text" value="<?php echo $student_id ?>" id="student-id" hidden>
	<div class="container">
	  <div class="row justify-content-center">
	    <div class="col-md-12">
	      <div class="form-container">
                
          <!-- step 1 -->
          <div class="step active" data-step="1">
            <h2 class="mb-4">Step 1 : Teachers</h2>
            <div class="form-group">
              <label for="selectedOption">Select teachers</label>
              <select class="form-control" id="selectedOption">
                <option value="">Select teacher</option>
                <?php 
                $get_teachers = $crudObj->dynamic_query('SELECT * FROM vd_user');
                foreach($get_teachers as $teacher){
                $teacher_full_name = $teacher['vd_user_1_name'].' '.$teacher['vd_user_2_name'];
                ?>
                <option value="<?php echo $teacher_full_name ?>"><?php echo $teacher_full_name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
	              <label for="addedGoal">Enter further person</label>
                <div class="further-person d-flex">
                  <input type="text" class="form-control" id="addedTeacher" placeholder="Text input">
                  <button type="button" id="addTeacher" class="btn btn-secondary">Add</button>
                </div>
	          </div>
	            
            <!-- Selected Options Section -->
		        <div class="selected-options">
		          <h3>Selected persons:</h3>
		          <ul id="selectedOptionsList"></ul>
		        </div>
		        <div class="text-center both-btn">
	            <button type="button" class="btn btn-primary next ml-2">Next Step</button>
	          </div>
          </div>

	          <!-- Step 2 -->
	          <div class="step" data-step="2">
	            <h2 class="mb-4">Step 2 : Task Assignment</h2>
              <form id="taskForm">
                <div class="form-group">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="taskEntry" id="selectTask" value="select" checked>
                    <label class="form-check-label" for="selectTask">Tasks list</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="taskEntry" id="manualEntry" value="manual">
                    <label class="form-check-label" for="manualEntry">Free task entry</label>
                  </div>
                </div>

                <div class="form-group" id="selectTaskGroup">
                  <label for="taskSelect">Tasks</label>
                  <select class="form-control" id="taskSelect">
                    <option value="">Select task</option>
                    <?php 
                    $get_tasks = $crudObj->dynamic_query('SELECT * FROM vd_task ORDER BY task');
                    foreach($get_tasks as $task){
                    ?>
                    <option value="<?php echo $task['task'] ?>"><?php echo $task['task'] ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group" id="manualTaskGroup" style="display: none;">
                  <label for="manualTask">Enter further task</label>
                  <input type="text" class="form-control" id="manualTask" placeholder="Enter task manually">
                </div>

                <div class="form-group">
                  <label for="userSelect">Teachers</label>
                  <select class="form-control" id="userSelect">
                    <option value="">Select teacher</option>
                    <?php 
                    $get_teachers = $crudObj->dynamic_query('SELECT * FROM vd_user');
                    foreach($get_teachers as $teacher){
                      $user_gender = $teacher['vd_user_sex'];
                      $full_name = $teacher['vd_user_1_name'].' '.$teacher['vd_user_2_name'];
                      $full_name_class = str_replace(' ', '__', $full_name).'__'.$user_gender;
                    ?>
                    <option value="<?php echo $full_name_class ?>"><?php echo $full_name ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="deadline">Select Deadline:</label>
                  <input type="date" class="form-control" id="deadline">
                </div>
                <div class="mt-4 mb-5">
                  <button type="button" class="btn btn-primary btn-block" onclick="assignTask()">Assign Task</button>
                </div>
                
              </form>

            <div class="mt-4">
              <h3 class="text-center mb-4">Assigned Tasks</h3>
              <div id="assignedTasks" class="assignedTasks">

              </div>
            </div>

				    <div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2">Next Step</button>
	            </div>
	        </div>

	          <!-- Step 3 -->
	        <div class="step" data-step="3">
	            <h2 class="mb-4">Step 3 : Goals</h2>
	            <div class="form-group">
		            <label for="selectedGoal">Select aimed goals</label>
		            <select class="form-control" id="selectedGoal">
                  <option value="">Select goal</option>
                  <?php 
                  $get_goals = $crudObj->dynamic_query('SELECT * FROM vd_goal');
                  foreach($get_goals as $goal){
                  ?>
                  <option value="<?php echo $goal['goal'] ?>"><?php echo $goal['goal'] ?></option>
                  <?php } ?>
		            </select>
		          </div>
	            <div class="form-group">
	              <label for="addedGoal">Enter further goal</label>
                <div class="further-person d-flex">
                  <input type="text" class="form-control" id="addedGoal" placeholder="Text input">
                  <button type="button" id="addGoal" class="btn btn-secondary">Add</button>
                </div>
	            </div>
	            
              <!-- Selected Options Section -->
              <div class="selected-options">
                <h3>Selected goals:</h3>
                <ul id="selectedGoalsList"></ul>
              </div>
                <div class="text-center both-btn">
                  <button type="button" class="btn btn-secondary prev mr-2">Previous Step</button>
                  <button type="button" class="btn btn-primary next ml-2">Next Step</button>
                </div>
            </div>

	          <!-- Step 4 -->
	          <div class="step" data-step="4">
	            <h2 class="mb-4">Step 4 : Actions</h2>
              <div class="form-group">
                  <label for="selectedGoal">Actions</label>
                  <select class="form-control" id="selectedAction">
                    <option value="">Select action</option>
                    <?php 
                    $get_actions = $crudObj->dynamic_query('SELECT * FROM vd_action');
                    foreach($get_actions as $action){
                    ?>
                    <option value="<?php echo $action['action'] ?>"><?php echo $action['action'] ?></option>
                    <?php } ?>
                  </select>
              </div>
	            <div class="form-group">
	              <label for="addedAction">Enter further action</label>
                <div class="further-person d-flex">
                  <input type="text" class="form-control" id="addedAction" placeholder="Text input">
                  <button type="button" id="addAction" class="btn btn-secondary">Add</button>
                </div>
	            </div>
	            
		         <!-- Selected Options Section -->
		        <div class="selected-options">
		          <h3>Selected actions:</h3>
		          <ul id="selectedActionsList"></ul>
		        </div>
		        <div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 next-seven">Next Step</button>
	            </div>
	          </div>

	          <!-- Step 5 -->
            <div class="step" data-step="5">
	            <h2 class="mb-4">Step 5 : Outcomes</h2>
	            <div class="row mt-3">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="addedOutcome">Set desired student outcome</label>
                    <input type="text" class="form-control" id="addedOutcome" placeholder="Text input">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="evaluationDate">Set date to re-evaluate plan</label>
                    <input type="date" class="form-control" id="evaluationDate">
                  </div>
                </div>
                <div class="col-md-2">
                  <button type="button" id="addOutcome" class="btn btn-secondary w-100 add-btn">Add</button>
                </div>
              </div>

              <!-- Selected Options Section -->
              <div class="selected-options">
                <h3 class="mt-4 mb-3">Outcome and Date :</h3>
                  <ul id="selectedOutcomesList"></ul>
              </div>

              <div class="text-center both-btn">
                <button type="button" class="btn btn-secondary prev">Previous Step</button>
                <button type="button" class="btn btn-success submit save-step-eight btn-edit-save">Save</button>
              </div>
            </div>

	        </form>
	      </div>
	    </div>
	  </div>
	</div>


<?php include('includes/footer.php') ?>

<script>
    var task_assignments = '<?php echo $task_assignments; ?>';
</script>

<!-- Goals js -->
<script>
    var selectedGoals = jQuery.parseJSON('<?php echo $goals; ?>');
    updateSelectedGoalList();

    // Add Option button click event
    $("#addGoal").click(function () {
    var addedGoal = $("#addedGoal").val();
    if (addedGoal && !selectedGoals.includes(addedGoal)) {
        selectedGoals.push(addedGoal);
        updateSelectedGoalList();
    }else{
        Swal.fire("Warning!", "This goal is already added!", "error");
    }
    });

    // Handle select change event
    $("#selectedGoal").change(function () {
    var selectedGoal = $(this).val();
    if (selectedGoal && !selectedGoals.includes(selectedGoal)) {
        selectedGoals.push(selectedGoal);
        updateSelectedGoalList();
    }else{
        Swal.fire("Warning!", "This goal is already added!", "error");
    }
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
        var optionToRemove = $(this).parent().text().trim();
        var index = selectedGoals.indexOf(optionToRemove);
        if (index !== -1) {
            selectedGoals.splice(index, 1);
            updateSelectedGoalList();
        }
        $('#selectedGoal').val('')
        $('#addedGoal').val('')
    });

    // Update the selected options list
    function updateSelectedGoalList() {
        $("#selectedGoalsList").empty();
        for (var i = 0; i < selectedGoals.length; i++) {
            $("#selectedGoalsList").append("<li>" + selectedGoals[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
        }
    }
</script>

<!-- Action js -->
<script>
var selectedActions = jQuery.parseJSON('<?php echo $actions; ?>');
updateSelectedActionList();

// Add Option button click event
$("#addAction").click(function () {
  var addedAction = $("#addedAction").val();
  if (addedAction && !selectedActions.includes(addedAction)) {
    selectedActions.push(addedAction);
    updateSelectedActionList();
  }else{
    Swal.fire("Warning!", "This action is already added!", "error");
  }
});

// Handle select change event
$("#selectedAction").change(function () {
  var selectedAction = $(this).val();
  if (selectedAction && !selectedActions.includes(selectedAction)) {
    selectedActions.push(selectedAction);
    updateSelectedActionList();
  }else{
    Swal.fire("Warning!", "This action is already added!", "error");
  }
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
  var optionToRemove = $(this).parent().text().trim();
  var index = selectedActions.indexOf(optionToRemove);
  if (index !== -1) {
    selectedActions.splice(index, 1);
    updateSelectedActionList();
  }
  $('#selectedAction').val('')
  $('#addedAction').val('')
});

// Update the selected options list
function updateSelectedActionList() {
  $("#selectedActionsList").empty();
  for (var i = 0; i < selectedActions.length; i++) {
    $("#selectedActionsList").append("<li>" + selectedActions[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
  }
}
</script>

<!-- Teachers js -->
<script>
  var selectedOptions = jQuery.parseJSON('<?php echo $teachers; ?>');
  updateSelectedOptionsList();

// Add Option button click event
$("#addTeacher").click(function () {
  var addedTeacher = $("#addedTeacher").val();
  if (addedTeacher && !selectedOptions.includes(addedTeacher)) {
    selectedOptions.push(addedTeacher);
    updateSelectedOptionsList();
  }else{
    Swal.fire("Warning!", "This teacher is already added!", "error");
  }
});

// Handle select change event
$("#selectedOption").change(function () {
  var selectedOption = $(this).val();
  if (selectedOption && !selectedOptions.includes(selectedOption)) {
    selectedOptions.push(selectedOption);
    updateSelectedOptionsList();
  }else{
    Swal.fire("Warning!", "This teacher is already added!", "error");
  }
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
  var optionToRemove = $(this).parent().text().trim();
  var index = selectedOptions.indexOf(optionToRemove);
  if (index !== -1) {
    selectedOptions.splice(index, 1);
    updateSelectedOptionsList();
  }
  $('#selectedOption').val('')
  $('#addedTeacher').val('')
});

// Update the selected options list
function updateSelectedOptionsList() {
  $("#selectedOptionsList").empty();
  for (var i = 0; i < selectedOptions.length; i++) {
    $("#selectedOptionsList").append("<li>" + selectedOptions[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
  }
}
</script>

<!-- Task assignments js -->
<script>
var taskAssignments = jQuery.parseJSON('<?php echo $task_assignments; ?>');

$(document).ready(function() {
  Object.keys(taskAssignments).forEach(function(user) {
      displayUserTasks(user, taskAssignments[user]);
  });

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
</script>

<!-- Outcomes js -->
<script>
  var selectedOutcomes = jQuery.parseJSON('<?php echo $outcomes; ?>');
  updateSelectedOutcomeList();

// Add Option button click event
$("#addOutcome").click(function () {
    var addedOutcome = $("#addedOutcome").val();
    var evaluationDate = $("#evaluationDate").val();
    if(evaluationDate == ""){
        Swal.fire("Warning!", "Please, set a re-evaluation date!", "error");
    }else{
        if (addedOutcome && !selectedOutcomes.includes(addedOutcome+' (Date: '+evaluationDate+')')) {
            selectedOutcomes.push(addedOutcome+' (Date: '+evaluationDate+')');
            updateSelectedOutcomeList();
        }else{
            Swal.fire("Warning!", "This outcome is already added!", "error");
        }
    }
    $('#addedOutcome').val('');
    $('#evaluationDate').val('');
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
    var optionToRemove = $(this).parent().text().trim();
    var index = selectedOutcomes.indexOf(optionToRemove);
    if (index !== -1) {
        selectedOutcomes.splice(index, 1);
        updateSelectedOutcomeList();
    }
});

// Update the selected options list
function updateSelectedOutcomeList() {
    $("#selectedOutcomesList").empty();
    for (var i = 0; i < selectedOutcomes.length; i++) {
        $("#selectedOutcomesList").append("<li>" + selectedOutcomes[i] + " <i class='fas fa-trash no-print text-danger ml-2 remove-option-btn'></i></li>");
    }
}

</script>

<!-- Save edited data as new data -->
<script>
  $(".btn-edit-save").click(function () {

      var userID = $('#user-id').val()
      var area = $('#area').val()
      var studentID = $('#student-id').val()

      $.ajax({
          url: "actions/action-edit.php",
          method: "POST",
          data: {
              userID:userID,
              area:area,
              studentID:studentID,
              teachers:selectedOptions,
              goals:selectedGoals,
              actions:selectedActions,
              outcomes:selectedOutcomes,
              taskAssignments:taskAssignments
          },
          crossDomain: true,
          cache: false,
          success: function(data) {
              Swal.fire("Done!", "Report saved!", "success");
          }
      });
  });
</script>
