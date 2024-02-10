<?php 
include('includes/header.php');
include('includes/navbar.php');
?>
	<input type="text" value="<?php echo $user_id ?>" id="user-id" hidden>
	<div class="container">
	  <div class="row justify-content-center">
	    <div class="col-md-12">
	      <div class="form-container">
	        <!-- <form id="multiStepForm"> -->
	          <!-- Step 1 -->
	          <div class="step active" data-step="1">
	            <h2 class="mb-4">Step 1 : Student Information</h2>

				<div class="form-group mt-4">
					<form action="edit-data.php" method="post">
						<div class="row">
							<div class="col-md-10">
								<label for="plan">Open Existing Plan</label>
								<select class="form-control" id="plan" name="plan" required>
									<option value="">Select plan</option>
									<?php
									$get_plans = $crudObj->fetch_all_record('title','vd_report');
									foreach($get_plans as $plan){ ?>
										<option value="<?php echo $plan['title'] ?>"><?php echo $plan['title'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-secondary btn-show-report w-100">Show Report</button>
							</div>
						</div>
					</form>
				</div>

	            <div class="row">
	            	<div class="col-md-6">
			            <div class="form-group">
			              <label for="class">Class</label>
			              <select class="form-control" id="class">
				              <option value="">Select class</option>
							  <?php 
							  $get_classes = $crudObj->dynamic_query('SELECT * FROM vd_class WHERE ID='.$user_id.' ORDER BY vd_class_name');
							  foreach($get_classes as $class){ ?>
				              <option value="<?php echo $class['ID_class'] ?>"><?php echo $class['vd_class_name'] ?></option>
				              <?php } ?>
				            </select>
			            </div>
			          </div>
			         	<div class="col-md-6">
							<div class="form-group">
							<label for="student">Student</label>
							<select class="form-control" id="student">
								<option value="">Select class first</option>
								</select>
							</div>
			           </div>
			    	</div>
			         <div class="">
			         	<div class="student-image mt-3 mb-4">
			         		<img class="boy-avatar d-none" src="assets/img/avatar.png" alt="Image" width="150">
			         		<img class="girl-avatar d-none" src="assets/img/avatar-girl.jpg" alt="Image" width="150">
			         	</div>
						<h3 class="text-center my-3">Test Data</h3>
						<h3 class="text-center text-danger na-text">No data available! Please select a class and a student.</h3>
						<h3 class="text-center text-danger no-data-text d-none">Sorry, No data available for this student!</h3>
			         	<div class="table-responsive table-section d-none">
			         		<table id="studentTable" class="table table-bordered" style="width:100%">
						        <thead>
						            <tr>
						                <th>Area</th>
						                <th>Test</th>
						                <th>Score</th>
						            </tr>
						        </thead>
						        <tbody class="table-body-section">
									
						        </tbody>
						        
						    </table>
			         	</div>
			         </div>
	            
		        	<div class="text-center">
	            	<button type="button" class="btn btn-primary next one">Start Planning Tool</button>
	            </div>
	          </div>

	          <!-- Step 2 -->
	          <div class="step" data-step="2">
	            <h2 class="mb-4">Step 2 : Teachers</h2>
				<div class="form-group">
		            <label for="selectedOption">Teacher</label>
		            <select class="form-control" id="selectedOption">
						<option value="">Select teacher</option>
						<?php 
						$get_teachers = $crudObj->dynamic_query('SELECT * FROM vd_user');
						foreach($get_teachers as $teacher){
						$teacher_full_name = $teacher['vd_user_1_name'].' '.$teacher['vd_user_2_name'];
						$teacher_gender = $teacher['vd_user_sex'];
						?>
						<option value="<?php echo $teacher_full_name."##".$teacher_gender ?>"><?php echo $teacher_full_name ?></option>
						<?php } ?>
		            </select>
		        </div>
	            <div class="form-group">
	              <label for="addedGoal">Enter further person</label>
				  <div class="further-person">
					<div class="row">
						<div class="col-md-5">
							<input type="text" class="form-control" id="addedTeacher" placeholder="Text input">
						</div>
						<div class="col-md-5">
							<select class="form-control" id="addedTeacherGender">
								<option value="">Select gender</option>
								<option value="m">Male</option>
								<option value="w">Female</option>
							</select>
						</div>
						<div class="col-md-2">
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
	            	<button type="button" class="btn btn-secondary prev mr-2 two-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 two-next">Next Step</button>
	            </div>
	          </div>

	          <!-- Repeat the above HTML block for Steps 3 through 8 -->

	          <!-- Step 3 -->
	          <div class="step" data-step="3">
	            <h2 class="mb-4">Step 3 : School Area</h2>
	            <div class="form-group">
		            <label for="selectedArea">School Area</label>
		            <select class="form-control" id="selectedArea">
						<option value="">Select area</option>
						<?php 
						$get_areas = $crudObj->dynamic_query('SELECT DISTINCT vd_test_idx_fb FROM vd_test_idx ORDER BY vd_test_idx_fb');
						foreach($get_areas as $area){
						?>
						<option value="<?php echo $area['vd_test_idx_fb'] ?>"><?php echo $area['vd_test_idx_fb'] ?></option>
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
	            	<button type="button" class="btn btn-secondary prev mr-2 three-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 next-three three-next">Next Step</button>
	            </div>
	          </div>

	          <!-- Repeat the above HTML block for Steps 4 through 8 -->

	          <!-- Step 4 -->
	          <div class="step" data-step="4">
	            <h2 class="mb-4">Step 4 : Student Details</h2>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="">Selected student</label>
							<input type="text" class="form-control selected-student" readonly>
						</div>
						<div class="col-md-6">
							<label for="">Selected school area</label>
							<input type="text" class="form-control selected-area" readonly>
						</div>
					</div>
					
				</div>
	            <div class="form-group">
		            <label for="selectedTestData">School relevant test data</label>
		            <select class="form-control" id="selectedTestData">
						
		            </select>
		        </div>

				<!-- Selected Options Section -->
		        <div class="selected-options">
		          <h3>Selected test data:</h3>
		          <ul id="selectedTestsList"></ul>
		        </div>

	            <div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2 four-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 four-next">Next Step</button>
	            </div>
	          </div>

	          <!-- Repeat the above HTML block for Steps 5 through 8 -->

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
							$get_tasks = $crudObj->dynamic_query('SELECT * FROM vd_task WHERE created_by = "'.$user_id.'" ORDER BY task');
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
					<!-- Tasks will be displayed here -->
					</div>
				</div>

				<div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2 five-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 five-next">Next Step</button>
	            </div>
	          </div>

	          <!-- Repeat the above HTML block for Steps 6 through 8 -->

	          <!-- Step 6 -->
	          <div class="step" data-step="6">
	            <h2 class="mb-4">Step 6 : Goals</h2>
	            <div class="form-group">
		            <label for="selectedGoal">Select aimed goals</label>
		            <select class="form-control" id="selectedGoal">
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
	            	<button type="button" class="btn btn-secondary prev mr-2 six-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 six-next">Next Step</button>
	            </div>
	          </div>

	          <!-- Step 7 -->
	          <div class="step" data-step="7">
	            <h2 class="mb-4">Step 7 : Actions</h2>
				<div class="form-group">
		            <label for="selectedGoal">Actions</label>
		            <select class="form-control" id="selectedAction">
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
	            	<button type="button" class="btn btn-secondary prev mr-2 seven-prev">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2 next-seven seven-next">Next Step</button>
	            </div>
	          </div>

	          <!-- Step 8 -->
	          <div class="step" data-step="8">
	            <h2>Report / Summary</h2>
				<div class="image-container">
					<div class="user-info">
						<img src="" width="80" class="rounded-circle eight-student-image" alt="">
						<h5 class="mt-2 eight-student-name"></h5>
					</div>
				</div>
				
				<div class="form-group student-section">
					<h4 class="mb-3">Student Information :</h4>
					<ul class="report-student-info"> </ul>
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
							<tbody class="table-body" id="userTable">
								
							</tbody>
							
						</table>
					</div>
				</div>

				<div class="form-group goals-section">
					<h4 class="mb-3">Goals :</h4>
					<ul class="report-goals"> </ul>
				</div>

				<div class="form-group actions-section">
					<h4 class="mb-3">Actions :</h4>
					<ul class="report-actions"> </ul>
				</div>

				<div class="row mt-5 no-print">
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

	            <div class="text-center both-btn no-print">
	            	<button type="button" class="btn btn-secondary prev prev-step-eight eight-prev">Previous Step</button>
					<a class="text-secondary" href="javascript:void(0)" onclick="printPage()"><i class="fas fa-print"></i></a>
	            	<button type="button" class="btn btn-success submit save-step-eight">Save</button>
	            </div>
	          </div>

	        <!-- </form> -->
	      </div>
	    </div>
	  </div>
	</div>

<?php include('includes/footer.php') ?>

<script>
	function printPage(){
		window.print();
	}
</script>

