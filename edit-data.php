<!-- LN 1591 : Show DB data and ADD button works. Same as all JS files. -->
<!-- LN 1955 : On click ELEVENT NEXT button, report generates. Same as REPORT.JS -->

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
$student_name = $get_report[0]['pupil_name'];
$strengths = $get_report[0]['strengths'];
$difficulties = $get_report[0]['difficulties'];
$support_1 = $get_report[0]['support_1'];
$support_2 = $get_report[0]['support_2'];
$area = $get_report[0]['area'];
$teachers = $get_report[0]['teachers'];
$task_assignments = $get_report[0]['task_assignments'];
$goals = $get_report[0]['goals_1'];
$goalsb = $get_report[0]['goals_2'];
$actions = $get_report[0]['actions_1'];
$actionsb = $get_report[0]['actions_2'];
$compensation = $get_report[0]['compensations'];

$teacher_1 = $get_report[0]['teacher_1'];
$members_1 = $get_report[0]['members_1'];
$duties_1 = $get_report[0]['duties_1'];
$outcomes_1 = $get_report[0]['outcomes_1'];
$teacher_2 = $get_report[0]['teacher_2'];
$members_2 = $get_report[0]['members_2'];
$duties_2 = $get_report[0]['duties_2'];
$outcomes_2 = $get_report[0]['outcomes_2'];

$evaluation_date = $get_report[0]['evaluation_date'];
$area = $get_report[0]['area'];
$tests = $get_report[0]['tests'];

// for readonly inputs
$decoded_support_1 = json_decode($support_1);
if($support_2 != ""){
  $decoded_support_2 = json_decode($support_2);
  $set_support_2 = $decoded_support_2[0];
}else{
  $set_support_2 = "";
}

?>

	<input type="text" value="<?php echo $user_id ?>" id="user-id" hidden>
	<input type="text" value="<?php echo $area ?>" id="area" hidden>
	<input type="text" value="<?php echo $student_id ?>" id="student-id" hidden>
  <input type="text" value="<?php echo $set_support_2 ?>" id="support-two" hidden>
	<div class="container">
	  <div class="row justify-content-center">
	    <div class="col-md-12">
	      <div class="form-container">

          <!-- step 1 -->
          <div class="step active" data-step="1">
	            <h2 class="mb-4">Step 1 : Strengths and difficulties</h2>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Selected student</label>
                        <!-- Name is coming from step.js on clicking starting tool -->
                        <input type="text" class="form-control student-name" value="<?php echo $student_name ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="">Enter students strength</label>
                        <div class="d-flex">
                          <input type="text" class="form-control" id="addedStrength" placeholder="Text input">
                          <button type="button" id="addStrength" class="btn btn-secondary">Add</button>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">Enter students difficulties</label>
                        <div class="d-flex">
                          <input type="text" class="form-control" id="addedDifficulties" placeholder="Text input">
                          <button type="button" id="addDifficulties" class="btn btn-secondary">Add</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
	            
                <div class="row mt-4">
                  <div class="col-md-6">
                    <!-- Selected strength Section -->
                    <div class="selected-strengths">
                      <h3>Selected strengths:</h3>
                      <ul id="selectedStrengthsList"></ul>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Selected difficulties Section -->
                    <div class="selected-difficulties">
                      <h3>Selected difficulties:</h3>
                      <ul id="selectedDifficultiesList"></ul>
                    </div>
                  </div>
                </div>

		          <div class="text-center both-btn">
	            	<!-- <button type="button" class="btn btn-secondary prev mr-2 edit-two-prev">Previous Step</button> -->
	            	<button type="button" class="btn btn-primary next ml-2 edit-one-next">Next Step</button>
	            </div>
	        </div>

          <!-- Step 2 -->
			    <div class="step" data-step="2">
	            <h2 class="mb-4">Step 2 : Supports</h2>
	            <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Selected student</label>
                      <!-- Name is coming from step.js on clicking starting tool -->
                      <input type="text" class="form-control student-name" value="<?php echo $student_name ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Enter students need for support 1</label>
                      <div class="d-flex">
                        <input type="text" class="form-control" id="addedSupportOne" placeholder="Text input">
                        <button type="button" id="addSupportOne" class="btn btn-secondary">Add</button>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Enter students need for support 2</label>
                      <div class="d-flex">
                        <input type="text" class="form-control" id="addedSupportTwo" placeholder="Text input">
                        <button type="button" id="addSupportTwo" class="btn btn-secondary">Add</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
	            
              <div class="row mt-4">
                <div class="col-md-6">
                  <!-- Selected strength Section -->
                  <div class="selected-support-one">
                    <h3>Support 1:</h3>
                    <ul id="selectedSupportOneList"></ul>
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- Selected difficulties Section -->
                  <div class="selected-support-two">
                    <h3>Support 2:</h3>
                    <ul id="selectedSupportTwoList"></ul>
                  </div>
                </div>
              </div>

	            <div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2 edit-two-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 edit-two-next">Next Step</button>
	            </div>
	        </div>
      
          <!-- step 3 -->
          <div class="step" data-step="3">
	            <h2 class="mb-4">Step 3 : Teachers</h2>
				      <div class="form-group">
		            <label for="selectedOption">Teacher</label>
		            <select class="form-control" id="selectedOption">
                  <option value="">Select teacher</option>
                  <?php 
                  $get_teachers = $crudObj->dynamic_query('SELECT * FROM vd_user');
                  foreach($get_teachers as $teacher){
                  $teacher_full_name = $teacher['vd_user_1_name'].' '.$teacher['vd_user_2_name'];
                  $teacher_gender = $teacher['vd_user_sex'];
                  $teacher_email = $teacher['vd_user_email'];
                  ?>
                  <option value="<?php echo $teacher_full_name."##".$teacher_gender."##".$teacher_email ?>"><?php echo $teacher_full_name ?></option>
                  <?php } ?>
		            </select>
		          </div>
	            <div class="form-group">
	              <label for="addedGoal">Enter further person</label>
				        <div class="further-person">
                  <div class="row">
                    <div class="col-md-4">
                      <input type="text" class="form-control" id="addedTeacher" placeholder="Enter name">
                    </div>
                    <div class="col-md-3">
                      <select class="form-control" id="addedTeacherGender">
                        <option value="">Select gender</option>
                        <option value="m">Male</option>
                        <option value="w">Female</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <input type="email" class="form-control" id="addedTeacherEmail" placeholder="Enter email">
                    </div>
                    <div class="col-md-1">
                      <button type="button" id="addTeacher" class="btn btn-secondary w-100">Add</button>
                    </div>
                  </div>
                </div>
	            </div>
	            
              <!-- Selected Options Section -->
              <div class="selected-options">
                <h3>Selected persons:</h3>
                <ul id="selectedOptionsList"></ul>
              </div>
		          <div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2 edit-three-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 edit-three-next">Next Step</button>
	            </div>
	        </div>

          <!-- Step 4 -->
          <div class="step" data-step="4">
	            <h2 class="mb-4">Step 4 : School Area</h2>
	            <div class="form-group">
		            <label for="selectedArea">School Area</label>
		            <select class="form-control" id="selectedArea">
                  <option value="">Select area</option>
                  <?php 
                  $get_areas = $crudObj->dynamic_query('SELECT DISTINCT vd_test_idx_fb FROM vd_test_idx ORDER BY vd_test_idx_fb');
                  foreach($get_areas as $data){
                  ?>
                  <option value="<?php echo $data['vd_test_idx_fb'] ?>"><?php echo $data['vd_test_idx_fb'] ?></option>
                  <?php } ?>
		            </select>
		          </div>
	            <div class="form-group">
	              <label for="addedArea">Enter further area</label>
                <div class="further-person d-flex">
                  <input type="text" class="form-control" id="addedArea" placeholder="Text input">
                <button type="button" id="addArea" class="btn btn-secondary">Add</button>
                </div>
	            </div>

              <!-- Alert  -->
              <div class="alert alert-warning alert-dismissible fade show area-alert" role="alert">
                <strong class="text-danger">You can add only one area at a time.</strong>
                <button type="button" class="close close-area-alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

				      <!-- Selected Options Section -->
              <div class="selected-options">
                <h3>Selected area (only one):</h3>
                <ul id="selectedAreaList"></ul>
              </div>
	            <div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2 edit-four-prev">Previous Step</button>
					      <!-- next-five class (function : student.js) is for showing data in step 6 -->
	            	<button type="button" class="btn btn-primary next ml-2 edit-four-next">Next Step</button>
	            </div>
	        </div>

	        <!-- Step 5 -->
	        <div class="step" data-step="5">
	          <h2 class="mb-4">Step 5 : Task Assignment</h2>
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
	            	<button type="button" class="btn btn-secondary prev mr-2 edit-five-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 edit-five-next">Next Step</button>
	            </div>
	        </div>

	        <!-- Step 6 -->
	        <div class="step" data-step="6">
	            <h2 class="mb-4">Step 6(a) : Goals</h2>
              <div class="form-group">
                <label for="">Selected need for support 1</label>
                <input type="text" class="form-control" value="<?php echo $decoded_support_1[0] ?>" readonly>
              </div>
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
                  <button type="button" class="btn btn-secondary prev mr-2 edit-six-prev">Previous Step</button>
                  <button type="button" class="btn btn-primary next ml-2 edit-six-next">Next Step</button>
                </div>
          </div>

          <!-- Step 7 -->
          <div class="step" data-step="7">
            <h2 class="mb-4">Step 6(b) : Goals</h2>
            <div class="form-group">
              <label for="">Selected need for support 2</label>
              <!-- goal-support-two class value comes from step.js -->
              <input type="text" class="form-control goals-b" value="" readonly>
            </div>
            <div class="form-group">
              <label for="selectedGoalb">Select aimed goals</label>
              <select class="form-control" id="selectedGoalb">
              <option value="">Select goal</option>
              <?php 
              $get_goals = $crudObj->dynamic_query('SELECT * FROM vd_goal WHERE created_by = "'.$user_id.'"');
              foreach($get_goals as $goal){
              ?>
              <option value="<?php echo $goal['goal'] ?>"><?php echo $goal['goal'] ?></option>
              <?php } ?>

              </select>
            </div>
            <div class="form-group">
              <label for="addedGoalb">Enter further goal</label>
              <div class="further-person d-flex">
                <input type="text" class="form-control" id="addedGoalb" placeholder="Text input">
              <button type="button" id="addGoalb" class="btn btn-secondary">Add</button>
              </div>
            </div>
            
            <!-- Selected Options Section -->
            <div class="selected-options">
              <h3>Selected goals:</h3>
              <ul id="selectedGoalsListb"></ul>
            </div>
            <div class="text-center both-btn">
              <button type="button" class="btn btn-secondary prev mr-2 edit-seven-prev">Previous Step</button>
              <button type="button" class="btn btn-primary next ml-2 edit-seven-next">Next Step</button>
            </div>
          </div>

	        <!-- Step 8 -->
	        <div class="step" data-step="8">
	            <h2 class="mb-4">Step 7(a) : Actions</h2>
              <div class="form-group">
                <label for="">Selected need for support 1</label>
                <input type="text" class="form-control" value="<?php echo $decoded_support_1[0] ?>" readonly>
              </div>
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
	            	<button type="button" class="btn btn-secondary prev mr-2 edit-eight-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 edit-eight-next">Next Step</button>
	            </div>
	        </div>

          <!-- Step 9 -->
	        <div class="step" data-step="9">
	            <h2 class="mb-4">Step 7(b) : Actions</h2>
              <div class="form-group">
                <label for="">Selected need for support 2</label>
                <input type="text" class="form-control actions-b" value="" readonly>
              </div>
				      <div class="form-group">
		            <label for="selectedActionb">Actions</label>
		            <select class="form-control" id="selectedActionb">
                  <option value="">Select action</option>
                  <?php 
                  $get_actions = $crudObj->dynamic_query('SELECT * FROM vd_action WHERE created_by = "'.$user_id.'"');
                  foreach($get_actions as $action){
                  ?>
                  <option value="<?php echo $action['action'] ?>"><?php echo $action['action'] ?></option>
                  <?php } ?>

		            </select>
		          </div>
	            <div class="form-group">
	              <label for="addedActionb">Enter further action</label>
                <div class="further-person d-flex">
                  <input type="text" class="form-control" id="addedActionb" placeholder="Text input">
                <button type="button" id="addActionb" class="btn btn-secondary">Add</button>
                </div>
              </div>
                    
              <!-- Selected Options Section -->
              <div class="selected-options">
                <h3>Selected actions:</h3>
                <ul id="selectedActionsListb"></ul>
              </div>
              <div class="text-center both-btn">
                  <button type="button" class="btn btn-secondary prev mr-2 edit-nine-prev">Previous Step</button>
                  <button type="button" class="btn btn-primary next ml-2 edit-nine-next">Next Step</button>
              </div>
          </div>

          <!-- Step 10 -->
          <div class="step" data-step="10">
	          <h2 class="mb-4">Step 8 : Compensation</h2>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Selected student</label>
                    <input type="text" class="form-control" value="<?php echo $student_name ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="">Enter form of compensation</label>
                    <div class="d-flex">
                      <input type="text" class="form-control" id="addedCompensation" placeholder="Text input">
                      <button type="button" id="addCompensation" class="btn btn-secondary">Add</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
	            
            <div class="selected-compensation">
              <h3>Selected compensation:</h3>
              <ul id="selectedCompensationsList"></ul>
            </div>
				
		        <div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2 edit-ten-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 edit-ten-next">Next Step</button>
	            </div>
	        </div>

          <!-- Step 11 -->
	        <div class="step" data-step="11">
	            <h2 class="mb-4">Step 9(a) : Teachers Distribution</h2>
              <div class="form-group mb-5">
                <label for="">Selected need for support 1</label>
                <!-- goal-support-one class value comes from step.js -->
                <input type="text" class="form-control set-support-one" readonly>
              </div>
				      <div class="form-group">
		            <label for="selectedTeacherOne">Distribute person responsible</label>
		            <select class="form-control" id="selectedTeacherOne">
                  <option value="">Select teacher</option>
                  <?php 
                  $get_teachers = $crudObj->dynamic_query('SELECT * FROM vd_user');
                  foreach($get_teachers as $teacher){
                  $teacher_full_name = $teacher['vd_user_1_name'].' '.$teacher['vd_user_2_name'];
                  $teacher_gender = $teacher['vd_user_sex'];
                  $teacher_email = $teacher['vd_user_email'];
                  ?>
                  <option value="<?php echo $teacher_full_name."##".$teacher_gender."##".$teacher_email ?>"><?php echo $teacher_full_name ?></option>
                  <?php } ?>
		            </select>
		          </div>
				      <!-- Selected Options Section -->
              <div  iv class="selected-teacher-one mb-5">
                <h3>Selected teacher:</h3>
                <ul id="selectedTeacherListOne"></ul>
              </div>
				      <div class="form-group">
		            <label for="selectedTeachersOne">Distribute persons as member</label>
		            <select class="form-control" id="selectedTeachersOne">
                  <option value="">Select teacher</option>
                  <?php 
                  $get_teachers = $crudObj->dynamic_query('SELECT * FROM vd_user');
                  foreach($get_teachers as $teacher){
                  $teacher_full_name = $teacher['vd_user_1_name'].' '.$teacher['vd_user_2_name'];
                  $teacher_gender = $teacher['vd_user_sex'];
                  $teacher_email = $teacher['vd_user_email'];
                  ?>
                  <option value="<?php echo $teacher_full_name."##".$teacher_gender."##".$teacher_email ?>"><?php echo $teacher_full_name ?></option>
                  <?php } ?>
		            </select>
		          </div>
				      <!-- Selected Options Section -->
              <div class="selected-teachers-one mb-5">
                <h3>Selected teachers:</h3>
                <ul id="selectedTeachersListOne"></ul>
              </div>
              <div class="form-group">
                <label>Enter duty</label>
                <div class="d-flex">
                  <input type="text" class="form-control" id="addedDutyOne" placeholder="Text input">
                  <button type="button" id="addDutyOne" class="btn btn-secondary">Add</button>
                </div>
              </div>
				      <!-- Selected Options Section -->
              <div class="selected-duties-one mb-5">
                <h3>Selected duty:</h3>
                <ul id="selectedDutyListOne"></ul>
              </div>

              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="addedOutcomeOne">Set desired outcome 1</label>
                    <input type="text" class="form-control" id="addedOutcomeOne" placeholder="Text input">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="outcomeDateOne">Set date for outcome 1</label>
                    <input type="date" class="form-control" id="outcomeDateOne">
                  </div>
                </div>
                <div class="col-md-2">
                  <button type="button" id="addOutcomeOne" class="btn btn-secondary w-100 add-btn">Add</button>
                </div>
              </div>

				    <!-- Selected Options Section -->
		        <div class="selected-outcomes-one mb-5">
					    <h3>Outcome and Date :</h3>
		          <ul id="selectedOutcomesListOne"></ul>
		        </div>

		        <div class="text-center both-btn">
	            <button type="button" class="btn btn-secondary prev mr-2 edit-eleven-prev">Previous Step</button>
	            <button type="button" class="btn btn-primary next ml-2 edit-eleven-next">Next Step</button>
	          </div>
	        </div>

          <!-- Step 12 -->
	        <div class="step" data-step="12">
	            <h2 class="mb-4">Step 9(b) : Teachers Distribution</h2>
              <div class="form-group mb-5">
                <label for="">Selected need for support 2</label>
                <!-- goal-support-one class value comes from step.js -->
                <input type="text" class="form-control distribution-b" readonly>
              </div>
				      <div class="form-group">
		            <label for="selectedTeacherTwo">Distribute person responsible</label>
		            <select class="form-control" id="selectedTeacherTwo">
                  <option value="">Select teacher</option>
                  <?php 
                  $get_teachers = $crudObj->dynamic_query('SELECT * FROM vd_user');
                  foreach($get_teachers as $teacher){
                  $teacher_full_name = $teacher['vd_user_1_name'].' '.$teacher['vd_user_2_name'];
                  $teacher_gender = $teacher['vd_user_sex'];
                  $teacher_email = $teacher['vd_user_email'];
                  ?>
                  <option value="<?php echo $teacher_full_name."##".$teacher_gender."##".$teacher_email ?>"><?php echo $teacher_full_name ?></option>
                  <?php } ?>
		            </select>
		          </div>
				      <!-- Selected Options Section -->
              <div class="selected-teacher-two mb-5">
                <h3>Selected teacher:</h3>
                <ul id="selectedTeacherListTwo"></ul>
              </div>
				      <div class="form-group">
		            <label for="selectedTeachersTwo">Distribute persons as member</label>
		            <select class="form-control" id="selectedTeachersTwo">
                  <option value="">Select teacher</option>
                  <?php 
                  $get_teachers = $crudObj->dynamic_query('SELECT * FROM vd_user');
                  foreach($get_teachers as $teacher){
                  $teacher_full_name = $teacher['vd_user_1_name'].' '.$teacher['vd_user_2_name'];
                  $teacher_gender = $teacher['vd_user_sex'];
                  $teacher_email = $teacher['vd_user_email'];
                  ?>
                  <option value="<?php echo $teacher_full_name."##".$teacher_gender."##".$teacher_email ?>"><?php echo $teacher_full_name ?></option>
                  <?php } ?>
		            </select>
		          </div>
              <!-- Selected Options Section -->
              <div class="selected-teachers-two mb-5">
                <h3>Selected teachers:</h3>
                <ul id="selectedTeachersListTwo"></ul>
              </div>
              <div class="form-group">
                <label>Enter duty</label>
                <div class="d-flex">
                  <input type="text" class="form-control" id="addedDutyTwo" placeholder="Text input">
                  <button type="button" id="addDutyTwo" class="btn btn-secondary">Add</button>
                </div>
              </div>
              <!-- Selected Options Section -->
              <div class="selected-duties-two mb-5">
                <h3>Selected duty:</h3>
                <ul id="selectedDutyListTwo"></ul>
              </div>

              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="addedOutcomeTwo">Set desired outcome 1</label>
                    <input type="text" class="form-control" id="addedOutcomeTwo" placeholder="Text input">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="outcomeDateTwo">Set date for outcome 1</label>
                    <input type="date" class="form-control" id="outcomeDateTwo">
                  </div>
                </div>
                <div class="col-md-2">
                  <button type="button" id="addOutcomeTwo" class="btn btn-secondary w-100 add-btn">Add</button>
                </div>
              </div>

              <!-- Selected Options Section -->
              <div class="selected-outcomes-two mb-5">
                <h3>Outcome and Date :</h3>
                <ul id="selectedOutcomesListTwo"></ul>
              </div>

              <div class="text-center both-btn">
                <button type="button" class="btn btn-secondary prev mr-2 edit-twelve-prev">Previous Step</button>
                <button type="button" class="btn btn-primary next ml-2 edit-twelve-next">Next Step</button>
              </div>
	        </div>

          <!-- Step 13 -->
          <div class="step" data-step="13">
            <h2>Report / Summary</h2>
            <div class="image-container">
              <div class="user-info">
                <img src="" width="80" class="rounded-circle student-image" alt="">
                <h5 class="mt-2" id="student-name"></h5>
              </div>
            </div>
            
            <div class="form-group">
              <h4 class="mb-3">Student Information :</h4>
              <ul class="report-student-info"> </ul>
            </div>

            <div class="form-group strength-section">
              <h4 class="mb-3">Strengths :</h4>
              <ul class="report-strength"> </ul>
            </div>

            <div class="form-group difficulties-section">
              <h4 class="mb-3">Difficulties :</h4>
              <ul class="report-difficulties"> </ul>
            </div>

            <div class="form-group support-one-section">
              <h4 class="mb-3">Need for support 1 :</h4>
              <ul class="report-support-one"> </ul>
            </div>

            <div class="form-group support-two-section">
              <h4 class="mb-3">Need for support 2 :</h4>
              <ul class="report-support-two"> </ul>
            </div>

            <div class="form-group area-section">
              <h4 class="mb-3">School Area :</h4>
              <ul class="report-school-area">
                <li><?php echo $area ?></li>
              </ul>
            </div>

            <div class="form-group teachers-section">
              <h4 class="mb-3">Teachers :</h4>
              <ul class="report-teachers"> </ul>
            </div>

            <div class="form-group">
              <h4 class="mb-3">Task Assignments :</h4>

              <div class="table-responsive table-section" id="reportStudentTable">
                <table class="table table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Teacher</th>
                      <th>Task</th>
                    </tr>
                  </thead>
                  <tbody class="table-body" id="userTable"></tbody>
                </table>
              </div>
            </div>

            <div class="form-group goals-section-one">
              <h4 class="mb-3">Support 1 goals :</h4>
              <ul class="report-goals-one"> </ul>
            </div>

            <div class="form-group goals-section-two">
              <h4 class="mb-3">Support 2 goals :</h4>
              <ul class="report-goals-two"> </ul>
            </div>

            <div class="form-group actions-section-one">
              <h4 class="mb-3">Support 1 actions :</h4>
              <ul class="report-actions-one"> </ul>
            </div>

            <div class="form-group actions-section-two">
              <h4 class="mb-3">Support 2 actions :</h4>
              <ul class="report-actions-two"> </ul>
            </div>

            <div class="form-group compensation-section">
              <h4 class="mb-3">Form of compensation:</h4>
              <ul class="report-compensation"> </ul>
            </div>

            <div class="form-group distribution-section-one">
					    <h4 class="mb-3">Support 1 teachers distribution :</h4>
              <div class="table-responsive table-section" id="report-distribution-one">
                <table class="table table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Teacher</th>
                      <th>Members</th>
                      <th>Duties</th>
                      <th>Outcomes</th>
                    </tr>
                  </thead>
                  <tbody class="table-body">
                    <tr>
                      <td class="teacher-support-one"></td>
                      <td>
                        <ul class="members-support-one"></ul>
                      </td>
                      <td>
                        <ul class="duties-support-one"></ul>
                      </td>
                      <td>
                        <ul class="outcomes-support-one"></ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
				    </div>

            <div class="form-group distribution-section-two">
              <h4 class="mb-3">Support 2 teachers distribution :</h4>
              <div class="table-responsive table-section" id="report-distribution-two">
                <table class="table table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Teacher</th>
                      <th>Members</th>
                      <th>Duties</th>
                      <th>Outcomes</th>
                    </tr>
                  </thead>
                  <tbody class="table-body">
                    <tr>
                      <td class="teacher-support-two"></td>
                      <td>
                        <ul class="members-support-two"></ul>
                      </td>
                      <td>
                        <ul class="duties-support-two"></ul>
                      </td>
                      <td>
                        <ul class="outcomes-support-two"></ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="row mt-5 no-print">
              <div class="col-md-10">
                <div class="form-group">
                  <label for="evaluationDate">Set date to re-evaluate plan</label>
                  <input type="date" class="form-control" id="evaluationDate">
                </div>
              </div>
              <div class="col-md-2">
                <button type="button" id="addEvaluateDate" class="btn btn-secondary w-100 add-btn">Add</button>
              </div>
            </div>

				    <!-- Selected Options Section -->
		        <div class="selected-options">
              <h3 class="mt-4 mb-3">Re-evaluation Date :</h3>
              <ul id="selectedEvaluateList"></ul>
            </div>

            <div class="text-center both-btn no-print">
              <button type="button" class="btn btn-secondary prev edit-thirteen-prev">Previous Step</button>
              <a class="text-secondary mx-2" href="javascript:void(0)" onclick="printPage()"><i class="fas fa-print"></i></a>
              <button type="button" class="btn btn-success submit btn-edit-save">Save</button>
            </div>

            <!-- <div class="text-center both-btn no-print">
              <button type="button" class="btn btn-secondary prev prev-step-eight edit-five-prev">Previous Step</button>
              <a class="text-secondary" href="javascript:void(0)" onclick="printPage()"><i class="fas fa-print"></i></a>
              <button type="button" class="btn btn-success submit save-step-eight btn-edit-save">Save</button>
            </div> -->
          </div>          

	        </form>
	      </div>
	    </div>
	  </div>
	</div>


<?php include('includes/footer.php') ?>

<!-- Strengths js -->
<script>
    var selectedStrengths = jQuery.parseJSON('<?php echo $strengths; ?>');
    updateSelectedStrengthsList();

    // Add Option button click event
    $("#addStrength").click(function () {
      var addedStrength = $("#addedStrength").val();
      if (addedStrength && !selectedStrengths.includes(addedStrength)) {
          selectedStrengths.push(addedStrength);
          updateSelectedStrengthsList();
      }else{
          Swal.fire("Warning!", "This strength is already added!", "error");
      }
      $("#addedStrength").val("");
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
        var optionToRemove = $(this).parent().text().trim();
        var index = selectedStrengths.indexOf(optionToRemove);
        if (index !== -1) {
          selectedStrengths.splice(index, 1);
          updateSelectedStrengthsList();
        }
    });

    // Update the selected options list
    function updateSelectedStrengthsList() {
        $("#selectedStrengthsList").empty();
        for (var i = 0; i < selectedStrengths.length; i++) {
            $("#selectedStrengthsList").append("<li>" + selectedStrengths[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
        }
    }
</script>

<!-- difficulties js -->
<script>
  var selectedDifficulties = jQuery.parseJSON('<?php echo $difficulties; ?>');
  updateSelectedDifficultiesList();

  // Add Option button click event
  $("#addDifficulties").click(function () {
      var addedDifficulties = $("#addedDifficulties").val();
      if (addedDifficulties && !selectedDifficulties.includes(addedDifficulties)) {
          selectedDifficulties.push(addedDifficulties);
          updateSelectedDifficultiesList();
      }else{
          Swal.fire("Warning!", "This difficulty is already added!", "error");
      }
      $("#addedDifficulties").val("")
  });

  // Remove Option button click event
  $(document).on("click", ".remove-option-btn", function () {
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedDifficulties.indexOf(optionToRemove);
      if (index !== -1) {
        selectedDifficulties.splice(index, 1);
        updateSelectedDifficultiesList();
      }
  });

  // Update the selected options list
  function updateSelectedDifficultiesList() {
      $("#selectedDifficultiesList").empty();
      for (var i = 0; i < selectedDifficulties.length; i++) {
          $("#selectedDifficultiesList").append("<li>" + selectedDifficulties[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
  }
</script>

<!-- Supports -->
<script>
  var selectedSupportOne = jQuery.parseJSON('<?php echo $support_1; ?>');
  updateSelectedSupportOneList();

  // SUPPORT 1
  $("#addSupportOne").click(function () {
      var addedSupportOne = $("#addedSupportOne").val();
      if (addedSupportOne && !selectedSupportOne.includes(addedSupportOne)) {
          if(selectedSupportOne.length > 0){
              Swal.fire("Warning!", "More than one support can't be added!", "error");
          }else{
              selectedSupportOne.push(addedSupportOne);
              updateSelectedSupportOneList();
          }
      }else{
          Swal.fire("Warning!", "This support is already added!", "error");
      }
      $("#addedSupportOne").val("")
  });

  // Remove Option button click event
  $(document).on("click", ".remove-option-btn", function () {
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedSupportOne.indexOf(optionToRemove);
      if (index !== -1) {
        selectedSupportOne.splice(index, 1);
        updateSelectedSupportOneList();
      }
  });

  // Update the selected options list
  function updateSelectedSupportOneList() {
  $("#selectedSupportOneList").empty();
      for (var i = 0; i < selectedSupportOne.length; i++) {
          $("#selectedSupportOneList").append("<li>" + selectedSupportOne[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
  }

  // SUPPORT 2
  var supportTwo = '<?php echo $support_2; ?>';
  if(supportTwo != ""){
    var selectedSupportTwo = jQuery.parseJSON('<?php echo $support_2; ?>');
    updateSelectedSupportTwoList();
  }else{
    var selectedSupportTwo = [];
  }

  $("#addSupportTwo").click(function () {
        var addedSupportTwo = $("#addedSupportTwo").val();
        if (addedSupportTwo && !selectedSupportTwo.includes(addedSupportTwo)) {
            if(selectedSupportTwo.length > 0){
                Swal.fire("Warning!", "More than one support can't be added!", "error");
            }else{
                selectedSupportTwo.push(addedSupportTwo);
                updateSelectedSupportTwoList();
            }
        }else{
            Swal.fire("Warning!", "This support is already added!", "error");
        }
        $("#addedSupportTwo").val("")
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
        var optionToRemove = $(this).parent().text().trim();
        var index = selectedSupportTwo.indexOf(optionToRemove);
        if (index !== -1) {
          selectedSupportTwo.splice(index, 1);
          updateSelectedSupportTwoList();
        }
    });

    // Update the selected options list
    function updateSelectedSupportTwoList() {
    $("#selectedSupportTwoList").empty();
        for (var i = 0; i < selectedSupportTwo.length; i++) {
            $("#selectedSupportTwoList").append("<li>" + selectedSupportTwo[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
        }
    }
</script>

<!-- SCHOOL AREA -->
<script>
    $(".area-alert").hide();
    
    var getArea = <?php echo json_encode($area); ?>;
    var selectedAreas = [];
    selectedAreas.push(getArea);
    updateSelectedAreasList();

    // Add Option button click event
    $("#addArea").click(function () {
      var addedArea = $("#addedArea").val();
      if (addedArea && !selectedAreas.includes(addedArea)) {
        if(selectedAreas.length > 0){
          $(".area-alert").show();
        }else{
          selectedAreas.push(addedArea);
          updateSelectedAreasList();
        }
      }
    });

    // Handle select change event
    $("#selectedArea").change(function () {
      var selectedArea = $(this).val();
      if (selectedArea && !selectedAreas.includes(selectedArea)) {
        if(selectedAreas.length > 0){
          $(".area-alert").show();
        }else{
          selectedAreas.push(selectedArea);
          updateSelectedAreasList();
        }
      }
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
      $(".area-alert").hide();
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedAreas.indexOf(optionToRemove);
      if (index !== -1) {
        selectedAreas.splice(index, 1);
        updateSelectedAreasList();
      }
      $('#selectedArea').val('')
      $('#addedArea').val('')
    });

    // Update the selected options list
    function updateSelectedAreasList() {
      $("#selectedAreaList").empty();
      for (var i = 0; i < selectedAreas.length; i++) {
        $("#selectedAreaList").append("<li>" + selectedAreas[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
    }

    // remove alert on clicking X 
    $('.close-area-alert').click(function(){
      $(".area-alert").hide();
    })
    

    // remove alert on clicking X 
    $('.close-area-alert').click(function(){
      $(".area-alert").hide();
    })
</script>


<!-- Goals js -->
<script>
    // for support 1
    var selectedGoals = jQuery.parseJSON('<?php echo $goals; ?>');
    updateSelectedGoalList();

    // Add Option button click event
    $("#addGoal").click(function () {
    var addedGoal = $("#addedGoal").val();
    var userID = $("#user-id").val();
    if (addedGoal && !selectedGoals.includes(addedGoal)) {
        selectedGoals.push(addedGoal);
        updateSelectedGoalList();

        $.ajax({
          url: "actions/action-goal.php",
          method: "POST",
          data: {goal:addedGoal,user_id:userID},
          crossDomain: true,
          cache: false,
          success: function(data) {}
        });
        
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

    // for support 2
    var goalsTwo = '<?php echo $goalsb; ?>';
    if(goalsTwo != ""){
      var selectedGoalsb = jQuery.parseJSON('<?php echo $goalsb; ?>');
      updateSelectedGoalListb();
    }else{
      var selectedGoalsb = [];
    }

    // Add Option button click event
    $("#addGoalb").click(function () {
        var addedGoalb = $("#addedGoalb").val();
        var userID = $("#user-id").val();
        if (addedGoalb && !selectedGoalsb.includes(addedGoalb)) {
          selectedGoalsb.push(addedGoalb);
          updateSelectedGoalListb();

          $.ajax({
            url: "actions/action-goal.php",
            method: "POST",
            data: {goal:addedGoalb,user_id:userID},
            crossDomain: true,
            cache: false,
            success: function(data) {}
          });
          
        }else{
          Swal.fire("Warning!", "This goal is already added!", "error");
        }
      });

      // Handle select change event
      $("#selectedGoalb").change(function () {
        var selectedGoalb = $(this).val();
        if (selectedGoalb && !selectedGoalsb.includes(selectedGoalb)) {
          selectedGoalsb.push(selectedGoalb);
          updateSelectedGoalListb();
        }else{
          Swal.fire("Warning!", "This goal is already added!", "error");
        }
      });

      // Remove Option button click event
      $(document).on("click", ".remove-option-btn", function () {
        var optionToRemove = $(this).parent().text().trim();
        var index = selectedGoalsb.indexOf(optionToRemove);
        if (index !== -1) {
          selectedGoalsb.splice(index, 1);
          updateSelectedGoalListb();
        }
        $('#selectedGoalb').val('')
        $('#addedGoalb').val('')
      });

      // Update the selected options list
      function updateSelectedGoalListb() {
        $("#selectedGoalsListb").empty();
        for (var i = 0; i < selectedGoalsb.length; i++) {
          $("#selectedGoalsListb").append("<li>" + selectedGoalsb[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
        }
      }
</script>

<!-- Action js -->
<script>
  // for support 1
  var selectedActions = jQuery.parseJSON('<?php echo $actions; ?>');
  updateSelectedActionList();

  // Add Option button click event
  $("#addAction").click(function () {
    var addedAction = $("#addedAction").val();
    var userID = $("#user-id").val();
    if (addedAction && !selectedActions.includes(addedAction)) {
      selectedActions.push(addedAction);
      updateSelectedActionList();

      $.ajax({
        url: "actions/action-action.php",
        method: "POST",
        data: {action:addedAction,user_id:userID},
        crossDomain: true,
        cache: false,
        success: function(data) {}
      });

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

  // for support 2
  var actionTwo = '<?php echo $actionsb; ?>';
  if(actionTwo != ""){
    var selectedActionsb = jQuery.parseJSON('<?php echo $actionsb; ?>');
    updateSelectedActionListb();
  }else{
    var selectedActionsb = [];
  }

  $("#addActionb").click(function () {
      var addedActionb = $("#addedActionb").val();
      var userID = $("#user-id").val();
      if (addedActionb && !selectedActionsb.includes(addedActionb)) {
        selectedActionsb.push(addedActionb);
        updateSelectedActionListb();

        $.ajax({
          url: "actions/action-action.php",
          method: "POST",
          data: {action:addedActionb,user_id:userID},
          crossDomain: true,
          cache: false,
          success: function(data) {}
        });

      }else{
        Swal.fire("Warning!", "This action is already added!", "error");
      }
    });

    $("#selectedActionb").change(function () {
      var selectedActionb = $(this).val();
      if (selectedActionb && !selectedActionsb.includes(selectedActionb)) {
        selectedActionsb.push(selectedActionb);
        updateSelectedActionListb();
      }else{
        Swal.fire("Warning!", "This action is already added!", "error");
      }
    });

    $(document).on("click", ".remove-option-btn", function () {
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedActionsb.indexOf(optionToRemove);
      if (index !== -1) {
        selectedActionsb.splice(index, 1);
        updateSelectedActionListb();
      }
      $('#selectedActionb').val('')
      $('#addedActionb').val('')
    });

    function updateSelectedActionListb() {
      $("#selectedActionsListb").empty();
      for (var i = 0; i < selectedActionsb.length; i++) {
        $("#selectedActionsListb").append("<li>" + selectedActionsb[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
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
      var addedTeacherGender = $("#addedTeacherGender").val();
      var addedTeacherEmail = $("#addedTeacherEmail").val();
      if(addedTeacherGender == ""){
        Swal.fire("Warning!", "Select a gender!", "error");
      }else if(addedTeacherEmail == ""){
        Swal.fire("Warning!", "Enter an email!", "error");
      }else{
        var TeacherGenderEmail = addedTeacher+"##"+addedTeacherGender+"##"+addedTeacherEmail;
        if (TeacherGenderEmail && !selectedOptions.includes(TeacherGenderEmail)) {
          selectedOptions.push(TeacherGenderEmail);
          updateSelectedOptionsList();
        }else{
          Swal.fire("Warning!", "This teacher is already added!", "error");
        }
      }
      $("#addedTeacher").val("");
      $("#addedTeacherGender").val("");
      $("#addedTeacherEmail").val("");
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
    $(document).on("click", ".remove-teacher-btn", function () {
      var optionToRemove = $(this).parent().attr('data-id').trim();
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
      $("#userSelect").html("<option value=''>Select teacher</option>");
      for (var i = 0; i < selectedOptions.length; i++) {
        var splitData = selectedOptions[i].split('##');
        var name = splitData[0];
        var gender = splitData[1];
        var email = splitData[2];
        var name_gender = name.replace(/ /g,"__")+"__"+gender;
        var name_gender_email = name.replace(/ /g,"__")+"__"+gender+"__"+email;
        // var setDataID = name+'##'+gender;
        var setDataID = name+'##'+gender+'##'+email;
        var nameEmail = name+" (Email: "+email+")";
        $("#selectedOptionsList").append("<li data-id='"+setDataID+"'>" + nameEmail + " <i class='fas fa-trash text-danger ml-2 remove-teacher-btn'></i></li>");
        $("#userSelect").append("<option value='"+name_gender+"'>" + name + " </option>");
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

<!-- Compensation js -->
<script>
  var compensationJS = '<?php echo $compensation; ?>';
  if(compensationJS != ""){
    var selectedCompensations = jQuery.parseJSON('<?php echo $compensation; ?>');
    updateSelectedCompensationList();
  }else{
    var selectedCompensations = [];
  }

  $("#addCompensation").click(function () {
        var addedCompensation = $("#addedCompensation").val();
        if (addedCompensation && !selectedCompensations.includes(addedCompensation)) {
            selectedCompensations.push(addedCompensation);
            updateSelectedCompensationList();
        }else{
            Swal.fire("Warning!", "This compensation is already added!", "error");
        }
        $("#addedCompensation").val("")
    });

    $(document).on("click", ".remove-option-btn", function () {
        var optionToRemove = $(this).parent().text().trim();
        var index = selectedCompensations.indexOf(optionToRemove);
        if (index !== -1) {
            selectedCompensations.splice(index, 1);
            updateSelectedCompensationList();
        }
        $('#selectedCompensationData').val('')
    });
    
    function updateSelectedCompensationList() {
        $("#selectedCompensationsList").empty();
        for (var i = 0; i < selectedCompensations.length; i++) {
            $("#selectedCompensationsList").append("<li>" + selectedCompensations[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
        }
    }
</script>

<!-- Teacher distribution js -->
<script>
  // For single teacher
  var selectedTeacherOne = jQuery.parseJSON('<?php echo $teacher_1; ?>');
  updateTeacherOneList();

  // Handle select change event
  $("#selectedTeacherOne").change(function () {
      var selectedOption = $(this).val();
      if (selectedOption && !selectedTeacherOne.includes(selectedOption)) {
          if(selectedTeacherOne.length > 0){
              Swal.fire("Warning!", "You can add only one teacher!", "error");
          }else{
              selectedTeacherOne.push(selectedOption);
              updateTeacherOneList();
          }
      }
  });
  // Remove Option button click event
  $(document).on("click", ".remove-teacher-btn", function () {
      var optionToRemove = $(this).parent().attr('data-id').trim();
      var index = selectedTeacherOne.indexOf(optionToRemove);
      if (index !== -1) {
          selectedTeacherOne.splice(index, 1);
          updateTeacherOneList();
      }
      $('#selectedTeacherOne').val('');
  });
  // Update the selected options list
  function updateTeacherOneList() {
      $("#selectedTeacherListOne").empty();
      for (var i = 0; i < selectedTeacherOne.length; i++) {
        var splitData = selectedTeacherOne[i].split('##');
        var name = splitData[0];
        var gender = splitData[1];
        var email = splitData[2];
        var name_gender = name.replace(/ /g,"__")+"__"+gender;
        var name_gender_email = name.replace(/ /g,"__")+"__"+gender+"__"+email;
        // var setDataID = name+'##'+gender;
        var setDataID = name+'##'+gender+'##'+email;
        var nameEmail = name+" (Email: "+email+")";
        $("#selectedTeacherListOne").append("<li data-id='"+setDataID+"'>" + nameEmail + " <i class='fas fa-trash text-danger ml-2 remove-teacher-btn'></i></li>");
      }
  }


  // For multiple teachers 
  var selectedTeachersOne = jQuery.parseJSON('<?php echo $members_1; ?>');
  updateTeachersOneList();
  // Handle select change event
  $("#selectedTeachersOne").change(function () {
      var selectedOption = $(this).val();
      if (selectedOption && !selectedTeachersOne.includes(selectedOption)) {
          selectedTeachersOne.push(selectedOption);
          updateTeachersOneList();
      }else{
          Swal.fire("Warning!", "This teacher is already added!", "error");
      }
  });
  // Remove Option button click event
  $(document).on("click", ".remove-teachers-btn", function () {
      var optionToRemove = $(this).parent().attr('data-id').trim();
      var index = selectedTeachersOne.indexOf(optionToRemove);
      if (index !== -1) {
          selectedTeachersOne.splice(index, 1);
          updateTeachersOneList();
      }
      $('#selectedTeachersOne').val('');
  });
  // Update the selected options list
  function updateTeachersOneList() {
      $("#selectedTeachersListOne").empty();
      for (var i = 0; i < selectedTeachersOne.length; i++) {
        var splitData = selectedTeachersOne[i].split('##');
        var name = splitData[0];
        var gender = splitData[1];
        var email = splitData[2];
        var name_gender = name.replace(/ /g,"__")+"__"+gender;
        var name_gender_email = name.replace(/ /g,"__")+"__"+gender+"__"+email;
        // var setDataID = name+'##'+gender;
        var setDataID = name+'##'+gender+'##'+email;
        var nameEmail = name+" (Email: "+email+")";
        $("#selectedTeachersListOne").append("<li data-id='"+setDataID+"'>" + nameEmail + " <i class='fas fa-trash text-danger ml-2 remove-teachers-btn'></i></li>");
      }
  }
  // DUTY
  var selectedDutiesOne = jQuery.parseJSON('<?php echo $duties_1; ?>');
  updateDutiesOneList();
  // Add Option button click event
  $("#addDutyOne").click(function () {
      var addedDutyOne = $("#addedDutyOne").val();
      if (addedDutyOne && !selectedDutiesOne.includes(addedDutyOne)) {
          selectedDutiesOne.push(addedDutyOne);
          updateDutiesOneList();
          $('#addedDutyOne').val('')
      }else{
          Swal.fire("Warning!", "This duty is already added!", "error");
      }
  });
  // Remove Option button click event
  $(document).on("click", ".remove-option-btn", function () {
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedDutiesOne.indexOf(optionToRemove);
      if (index !== -1) {
          selectedDutiesOne.splice(index, 1);
          updateDutiesOneList();
      }
      $('#addedDutyOne').val('');
  });
  // Update the selected options list
  function updateDutiesOneList() {
      $("#selectedDutyListOne").empty();
      for (var i = 0; i < selectedDutiesOne.length; i++) {
        $("#selectedDutyListOne").append("<li>" + selectedDutiesOne[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
  }
  // OUTCOMES 
  var selectedOutcomesOne = jQuery.parseJSON('<?php echo $outcomes_1; ?>');
  updateOutcomeListOne();
  // Add Option button click event
  $("#addOutcomeOne").click(function () {
      var addedOutcome = $("#addedOutcomeOne").val();
      var outcomeDateOne = $("#outcomeDateOne").val();
      if(outcomeDateOne == ""){
          Swal.fire("Warning!", "Please, set an outcome date!", "error");
      }else{
          if (addedOutcome && !selectedOutcomesOne.includes(addedOutcome+' (Date: '+outcomeDateOne+')')) {
              selectedOutcomesOne.push(addedOutcome+' (Date: '+outcomeDateOne+')');
              updateOutcomeListOne();
          }else{
              Swal.fire("Warning!", "This outcome is already added!", "error");
          }
      }
      $('#addedOutcomeOne').val('');
      $('#outcomeDateOne').val('');
  });
  // Remove Option button click event
  $(document).on("click", ".remove-option-btn", function () {
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedOutcomesOne.indexOf(optionToRemove);
      if (index !== -1) {
          selectedOutcomesOne.splice(index, 1);
          updateOutcomeListOne();
      }
  });
  // Update the selected options list
  function updateOutcomeListOne() {
      $("#selectedOutcomesListOne").empty();
      for (var i = 0; i < selectedOutcomesOne.length; i++) {
          $("#selectedOutcomesListOne").append("<li>" + selectedOutcomesOne[i] + " <i class='fas fa-trash no-print text-danger ml-2 remove-option-btn'></i></li>");
      }
  }



  // FOR SUPPORT TWO
  // For single teacher
  var teacherTwo = '<?php echo $teacher_2; ?>';
  if(teacherTwo != ""){
    var selectedTeacherTwo = jQuery.parseJSON('<?php echo $teacher_2; ?>');
    updateTeacherTwoList();

    // For multiple teachers 
    var selectedTeachersTwo = jQuery.parseJSON('<?php echo $members_2; ?>');
    updateTeachersTwoList();

    // DUTY
    var selectedDutiesTwo = jQuery.parseJSON('<?php echo $duties_2; ?>');
    updateDutiesTwoList();

    // OUTCOMES 
    var selectedOutcomesTwo = jQuery.parseJSON('<?php echo $outcomes_2; ?>');
    updateOutcomeListTwo();

  }else{
    var selectedTeacherTwo = [];
    var selectedTeachersTwo = [];
    var selectedDutiesTwo = [];
    var selectedOutcomesTwo = [];
  }

  // TEACHER -------------------------------------------------
  // Handle select change event
  $("#selectedTeacherTwo").change(function () {
      var selectedOption = $(this).val();
      if (selectedOption && !selectedTeacherTwo.includes(selectedOption)) {
          if(selectedTeacherTwo.length > 0){
              Swal.fire("Warning!", "You can add only one teacher!", "error");
          }else{
              selectedTeacherTwo.push(selectedOption);
              updateTeacherTwoList();
          }
      }
  });

  // Remove Option button click event
  $(document).on("click", ".remove-teacher-btn", function () {
      var optionToRemove = $(this).parent().attr('data-id').trim();
      var index = selectedTeacherTwo.indexOf(optionToRemove);
      if (index !== -1) {
          selectedTeacherTwo.splice(index, 1);
          updateTeacherTwoList();
      }
      $('#selectedTeacherTwo').val('');
  });

  // Update the selected options list
  function updateTeacherTwoList() {
      $("#selectedTeacherListTwo").empty();
      for (var i = 0; i < selectedTeacherTwo.length; i++) {
        var splitData = selectedTeacherTwo[i].split('##');
        var name = splitData[0];
        var gender = splitData[1];
        var email = splitData[2];
        var name_gender = name.replace(/ /g,"__")+"__"+gender;
        var name_gender_email = name.replace(/ /g,"__")+"__"+gender+"__"+email;
        // var setDataID = name+'##'+gender;
        var setDataID = name+'##'+gender+'##'+email;
        var nameEmail = name+" (Email: "+email+")";
        $("#selectedTeacherListTwo").append("<li data-id='"+setDataID+"'>" + nameEmail + " <i class='fas fa-trash text-danger ml-2 remove-teacher-btn'></i></li>");
      }
  }

  // MEMBERS -------------------------------------------------
  // Handle select change event
  $("#selectedTeachersTwo").change(function () {
    var selectedOption = $(this).val();
    if (selectedOption && !selectedTeachersTwo.includes(selectedOption)) {
        selectedTeachersTwo.push(selectedOption);
        updateTeachersTwoList();
    }else{
        Swal.fire("Warning!", "This teacher is already added!", "error");
    }
  });

  // Remove Option button click event
  $(document).on("click", ".remove-teachers-btn", function () {
      var optionToRemove = $(this).parent().attr('data-id').trim();
      var index = selectedTeachersTwo.indexOf(optionToRemove);
      if (index !== -1) {
          selectedTeachersTwo.splice(index, 1);
          updateTeachersTwoList();
      }
      $('#selectedTeachersTwo').val('');
  });

  // Update the selected options list
  function updateTeachersTwoList() {
      $("#selectedTeachersListTwo").empty();
      for (var i = 0; i < selectedTeachersTwo.length; i++) {
        var splitData = selectedTeachersTwo[i].split('##');
        var name = splitData[0];
        var gender = splitData[1];
        var email = splitData[2];
        var name_gender = name.replace(/ /g,"__")+"__"+gender;
        var name_gender_email = name.replace(/ /g,"__")+"__"+gender+"__"+email;
        // var setDataID = name+'##'+gender;
        var setDataID = name+'##'+gender+'##'+email;
        var nameEmail = name+" (Email: "+email+")";
        $("#selectedTeachersListTwo").append("<li data-id='"+setDataID+"'>" + nameEmail + " <i class='fas fa-trash text-danger ml-2 remove-teachers-btn'></i></li>");
      }
  }

  // DUTIES -----------------------------------------------------
  // Add Option button click event
  $("#addDutyTwo").click(function () {
      var addedDutyTwo = $("#addedDutyTwo").val();
      if (addedDutyTwo && !selectedDutiesTwo.includes(addedDutyTwo)) {
          selectedDutiesTwo.push(addedDutyTwo);
          updateDutiesTwoList();
          $('#addedDutyTwo').val('')
      }else{
          Swal.fire("Warning!", "This duty is already added!", "error");
      }
  });

  // Remove Option button click event
  $(document).on("click", ".remove-option-btn", function () {
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedDutiesTwo.indexOf(optionToRemove);
      if (index !== -1) {
          selectedDutiesTwo.splice(index, 1);
          updateDutiesTwoList();
      }
      $('#addedDutyTwo').val('');
  });

  // Update the selected options list
  function updateDutiesTwoList() {
      $("#selectedDutyListTwo").empty();
      for (var i = 0; i < selectedDutiesTwo.length; i++) {
        $("#selectedDutyListTwo").append("<li>" + selectedDutiesTwo[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
  }

  // OUTCOMES -----------------------------------------------------
    // Add Option button click event
    $("#addOutcomeTwo").click(function () {
        var addedOutcome = $("#addedOutcomeTwo").val();
        var outcomeDateTwo = $("#outcomeDateTwo").val();
        if(outcomeDateTwo == ""){
            Swal.fire("Warning!", "Please, set an outcome date!", "error");
        }else{
            if (addedOutcome && !selectedOutcomesTwo.includes(addedOutcome+' (Date: '+outcomeDateTwo+')')) {
                selectedOutcomesTwo.push(addedOutcome+' (Date: '+outcomeDateTwo+')');
                updateOutcomeListTwo();
            }else{
                Swal.fire("Warning!", "This outcome is already added!", "error");
            }
        }
        $('#addedOutcomeTwo').val('');
        $('#outcomeDateTwo').val('');
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
        var optionToRemove = $(this).parent().text().trim();
        var index = selectedOutcomesTwo.indexOf(optionToRemove);
        if (index !== -1) {
            selectedOutcomesTwo.splice(index, 1);
            updateOutcomeListTwo();
        }
    });

    // Update the selected options list
    function updateOutcomeListTwo() {
        $("#selectedOutcomesListTwo").empty();
        for (var i = 0; i < selectedOutcomesTwo.length; i++) {
            $("#selectedOutcomesListTwo").append("<li>" + selectedOutcomesTwo[i] + " <i class='fas fa-trash no-print text-danger ml-2 remove-option-btn'></i></li>");
        }
    }
</script>

<script>
  // Re-evaluation date
  var selectedEvaluateDate = jQuery.parseJSON('<?php echo $evaluation_date; ?>');
  updateSelectedEvaluateList();
  // Add Option button click event
  $("#addEvaluateDate").click(function () {
      var evaluationDate = $("#evaluationDate").val();
      if (evaluationDate && !selectedEvaluateDate.includes(evaluationDate)) {
          if(selectedEvaluateDate.length > 0){
              Swal.fire("Warning!", "More than one date can't be added!", "error");
          }else{
            selectedEvaluateDate.push(evaluationDate);
            updateSelectedEvaluateList();
          }
      }else{
          Swal.fire("Warning!", "This date is already added!", "error");
      }
      $('#evaluationDate').val('');
  });
  // Remove Option button click event
  $(document).on("click", ".remove-option-btn", function () {
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedEvaluateDate.indexOf(optionToRemove);
      if (index !== -1) {
          selectedEvaluateDate.splice(index, 1);
          updateSelectedEvaluateList();
      }
  });

  // Update the selected options list
  function updateSelectedEvaluateList() {
      $("#selectedEvaluateList").empty();
      for (var i = 0; i < selectedEvaluateDate.length; i++) {
          $("#selectedEvaluateList").append("<li>" + selectedEvaluateDate[i] + " <i class='fas fa-trash no-print text-danger ml-2 remove-option-btn'></i></li>");
      }
  }
</script>

<!-- Outcomes js -->
<!-- <script>
  var selectedOutcomes = jQuery.parseJSON('<//?php echo $outcomes; ?>');
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

</script> -->

<!-- clicking next eleven button to show the report on edit -->
<script>
    var selectedTests = jQuery.parseJSON('<?php echo $tests; ?>');
    $(".edit-eleven-next").click(function(){
      var studentID = $('#student-id').val();

      if(selectedTests.length === 0){
        $('.student-section').hide()
      }else{
        $('.student-section').show()
        for(var i=0; i<selectedTests.length; i++){
          $('.report-student-info').append('<li>'+selectedTests[i]+'</li>')
        }
      }

      // STRENGTH
      if(selectedStrengths.length === 0){
        $('.strength-section').hide();
      }else{
        $('.strength-section').show();
        for(var i=0; i<selectedStrengths.length; i++){
            $('.report-strength').append('<li>'+selectedStrengths[i]+'</li>')
        }
      }

      // DIFFICULTY
      if(selectedDifficulties.length === 0){
        $('.difficulties-section').hide()
      }else{
        $('.difficulties-section').show()
        for(var i=0; i<selectedDifficulties.length; i++){
            $('.report-difficulties').append('<li>'+selectedDifficulties[i]+'</li>')
        }
      }

      // SUPPORT 1
      if(selectedSupportOne.length === 0){
            $('.support-one-section').hide()
        }else{
            $('.support-one-section').show()
            for(var i=0; i<selectedSupportOne.length; i++){
                $('.report-support-one').append('<li>'+selectedSupportOne[i]+'</li>')
            }
        }

        // SUPPORT 2
        var supportTwo = '<?php echo $support_2; ?>';
        if(supportTwo != ""){
          $('.support-two-section').show()
          for(var i=0; i<selectedSupportTwo.length; i++){
              $('.report-support-two').append('<li>'+selectedSupportTwo[i]+'</li>')
          }
        }else{
          $('.support-two-section').hide()
        }

      // TEACHERS
      if(selectedOptions.length === 0){
        $('.teachers-section').hide();
      }else{
        $('.teachers-section').show();
        for(var i=0; i<selectedOptions.length; i++){
            var splitData = selectedOptions[i].split('##');
            var name = splitData[0];
            $('.report-teachers').append('<li>'+name+'</li>')
        }
      }
      
      // Task assignments
      var userDataArray = [];
      $('.user-box').each(function(){
          var userName = $(this).find('h4').text();
          var tasks = [];
    
          // Collect tasks for the current user
          $(this).find('.task-box').each(function(){
            var taskText = $(this).text();
            
            // Remove the last 6 characters from each task
            var truncatedTask = taskText.substring(0, taskText.length - 6);
            
            tasks.push(truncatedTask);
          });
    
          // Combine tasks into a single string with dots or list items
          var tasksHTML = tasks.length > 1 ? '<ul><li>' + tasks.join('</li><li>') + '</li></ul>' : tasks.join('.');
    
          // Append a new row to the table
          $('#userTable').append('<tr><td>' + userName + '</td><td>' + tasksHTML + '</td></tr>');

          userDataArray.push({
              user: userName,
              tasks: tasks
          });
      });

      // GOALS FOR SUPPORT 1
      if(selectedGoals.length === 0){
        $('.goals-section-one').hide()
      }else{
        $('.goals-section-one').show()
        for(var i=0; i<selectedGoals.length; i++){
          $('.report-goals-one').append('<li>'+selectedGoals[i]+'</li>')
        }
      }

        // GOALS FOR SUPPORT 2
        var goalsTwo = '<?php echo $goalsb; ?>';
        if(goalsTwo != ""){
          $('.goals-section-two').show()
          for(var i=0; i<selectedGoalsb.length; i++){
              $('.report-goals-two').append('<li>'+selectedGoalsb[i]+'</li>')
          }
        }else{
          $('.goals-section-two').hide()
        }

        // ACTIONS FOR SUPPORT 1
        if(selectedActions.length === 0){
            $('.actions-section-one').hide()
        }else{
            $('.actions-section-one').show()
            for(var i=0; i<selectedActions.length; i++){
                $('.report-actions-one').append('<li>'+selectedActions[i]+'</li>')
            }
        }

        // ACTIONS FOR SUPPORT 2
        var actionsTwo = '<?php echo $actionsb; ?>';
        if(actionsTwo != ""){
          $('.actions-section-two').show()
          for(var i=0; i<selectedActionsb.length; i++){
              $('.report-actions-two').append('<li>'+selectedActionsb[i]+'</li>')
          }
        }else{
          $('.actions-section-two').hide();
        }

        // COMPENSATION
        var compensationJS = '<?php echo $compensation; ?>';
        if(compensationJS != ""){
          $('.compensation-section').show()
          for(var i=0; i<selectedCompensations.length; i++){
              $('.report-compensation').append('<li>'+selectedCompensations[i]+'</li>')
          }
        }else{
          $('.compensation-section').hide();
        }

        // DISTRIBUTED TEACHERS FOR SUPPORT 1
        if(selectedTeacherOne.length === 0){
            $('.distribution-section-one').hide()
        }else{
            $('.distribution-section-one').show();
            
            var teacherToSplit = selectedTeacherOne[0];
            var teacher = teacherToSplit.split("##");
            $('.teacher-support-one').text(teacher[0]);

            for(var i=0; i<selectedTeachersOne.length; i++){
                var membersToSplit = selectedTeachersOne[i];
                var members = membersToSplit.split("##");
                $('.members-support-one').append('<li>'+members[0]+'</li>');
            }
            for(var i=0; i<selectedDutiesOne.length; i++){
                $('.duties-support-one').append('<li>'+selectedDutiesOne[i]+'</li>');
            }
            for(var i=0; i<selectedOutcomesOne.length; i++){
                $('.outcomes-support-one').append('<li>'+selectedOutcomesOne[i]+'</li>');
            }
        }

        // check if distribution support 2 is empty to show in report page
        var teacherTwo = '<?php echo $teacher_2; ?>';
        if(teacherTwo != ""){
          $('.distribution-section-two').show();

          // DISTRIBUTED TEACHERS FOR SUPPORT 2
          // if(selectedTeacherTwo.length === 0){
          //     $('.distribution-section-two').hide()
          // }else{
          //     $('.distribution-section-two').show();
              
          //     var teacherToSplit = selectedTeacherTwo[0];
          //     var teacher = teacherToSplit.split("##");
          //     $('.teacher-support-two').text(teacher[0]);

          //     for(var i=0; i<selectedTeachersTwo.length; i++){
          //         var membersToSplit = selectedTeachersOne[i];
          //         var members = membersToSplit.split("##");
          //         $('.members-support-two').append('<li>'+members[0]+'</li>');
          //     }
          //     for(var i=0; i<selectedDutiesTwo.length; i++){
          //         $('.duties-support-two').append('<li>'+selectedDutiesTwo[i]+'</li>');
          //     }
          //     for(var i=0; i<selectedOutcomesOne.length; i++){
          //         $('.outcomes-support-two').append('<li>'+selectedOutcomesTwo[i]+'</li>');
          //     }
          // }
        }else{
          $('.distribution-section-two').hide();
        }        

        $.ajax({
            url: "actions/action-report.php",
            method: "POST",
            data: {studentID:studentID},
            crossDomain: true,
            cache: false,
            success: function(data) {
                var info = data.split("#");
                $('.eight-student-name').html(info[0]);
                if(info[1] == 'm'){
                    $('.eight-student-image').attr('src', 'assets/img/avatar.png');
                }else{
                    $('.eight-student-image').attr('src', 'assets/img/avatar-girl.jpg');
                }
            }
        });

      $.ajax({
          url: "actions/action-edit.php",
          method: "POST",
          data: {studentID:studentID},
          crossDomain: true,
          cache: false,
          success: function(data) {
              var info = data.split("#");
              $('#student-name').html(info[0]);
              if(info[1] == 'm'){
                $(".student-image").attr("src", "assets/img/avatar.png");
              }else{
                $(".student-image").attr("src", "assets/img/avatar-girl.jpg");
              }
              // $('.table-body-section').html(info[2]);
          }
      });
  });

  // $(".edit-thirteen-prev").click(function(){
  //     $(".report-teachers").find("li").remove();
  //     $(".report-goals").find("li").remove();
  //     $(".report-actions").find("li").remove();
  //     $("#userTable").find("tr").remove();
  // });

  function printPage(){
		window.print();
	}
</script>

<!-- Save edited data as new data -->
<script>
  $(".btn-edit-save").click(function () {
    var selectedEvaluationDate = $("#selectedEvaluateList").find('li').text();
      console.log(selectedEvaluateDate);
      var userID = $('#user-id').val()
      var area = $('#area').val()
      var studentID = $('#student-id').val()
      if(selectedEvaluationDate != ""){
        $.ajax({
            url: "actions/action-edit.php",
            method: "POST",
            data: {
                userID:userID,
                area:area,
                studentID:studentID,
                strengths:selectedStrengths,
                difficulties:selectedDifficulties,
                support_1:selectedSupportOne,
                support_2:selectedSupportTwo,
                teachers:selectedOptions,
                goals_1:selectedGoals,
                goals_2:selectedGoalsb,
                actions_1:selectedActions,
                actions_2:selectedActionsb,
                compensations:selectedCompensations,
                teacher_1:selectedTeacherOne,
                members_1:selectedTeachersOne,
                duties_1:selectedDutiesOne,
                outcomes_1:selectedOutcomesOne,
                teacher_2:selectedTeacherTwo,
                members_2:selectedTeachersTwo,
                duties_2:selectedDutiesTwo,
                outcomes_2:selectedOutcomesTwo,
                evaluation_date:selectedEvaluateDate,
                taskAssignments:taskAssignments,
                tests:selectedTests
            },
            crossDomain: true,
            cache: false,
            success: function(data) {
                Swal.fire("Done!", "Report saved!", "success");
            }
        });
      }else{
            Swal.fire("Error!", "Please set a desired outcome and evaluation date!", "error");
      }
  });
</script>
