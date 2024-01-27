<?php 
include('includes/header.php');
include('includes/navbar.php');
?>

	<div class="container">
	  <div class="row justify-content-center">
	    <div class="col-md-12">
	      <div class="form-container">
	        <form id="multiStepForm">
	          <!-- Step 1 -->
	          <div class="step active" data-step="1">
	            <h2 class="mb-4">Step 1</h2>

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
			         	<div class="student-image mt-3 mb-5">
			         		<img class="boy-avatar d-none" src="assets/img/avatar.png" alt="Image" width="150">
			         		<img class="girl-avatar d-none" src="assets/img/avatar-girl.jpg" alt="Image" width="150">
			         	</div>
						<h3 class="text-center my-4">Test Data</h3>
						<h3 class="text-center text-danger na-text">No data available! Please select a class and a student.</h3>
						<h3 class="text-center text-danger no-data-text d-none">Sorry, No data available for this student!</h3>
			         	<div class="table-responsive table-section d-none">
			         		<table id="" class="table table-bordered" style="width:100%">
						        <thead>
						            <tr>
						                <th>Area</th>
						                <th>Score</th>
						            </tr>
						        </thead>
						        <tbody class="table-body">
									
						        </tbody>
						        
						    </table>
			         	</div>
			         </div>
	            
	            
		        	<div class="text-center">
	            	<button type="button" class="btn btn-primary next">Start Planning Tool</button>
	            </div>
	          </div>

	          <!-- Step 2 -->
	          <div class="step" data-step="2">
	            <h2 class="mb-4">Step 2</h2>
				<div class="form-group">
		            <label for="selectedOption">Teacher</label>
		            <select class="form-control" id="selectedOption">
						<option value="">Select teacher</option>
						<?php 
						$get_teachers = $crudObj->dynamic_query('SELECT * FROM vd_user');
						foreach($get_teachers as $teacher){
						$full_name = $teacher['vd_user_1_name'].' '.$teacher['vd_user_2_name'];
						?>
						<option value="<?php echo $full_name ?>"><?php echo $full_name ?></option>
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
	            	<button type="button" class="btn btn-secondary prev mr-2">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2">Next Step</button>
	            </div>
	          </div>

	          <!-- Repeat the above HTML block for Steps 3 through 8 -->

	          <!-- Step 3 -->
	          <div class="step" data-step="3">
	            <h2 class="mb-4">Step 3</h2>
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
	            	<button type="button" class="btn btn-secondary prev mr-2">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2">Next Step</button>
	            </div>
	          </div>

	          <!-- Repeat the above HTML block for Steps 4 through 8 -->

	          <!-- Step 4 -->
	          <div class="step" data-step="4">
	            <h2 class="mb-4">Step 4</h2>
	            <div class="form-group">
	              <label for="field4">Field 4:</label>
	              <input type="text" class="form-control" id="field4" name="field4" required>
	            </div>
	            <div class="form-group">
	              <label for="textarea4">Textarea 4:</label>
	              <textarea class="form-control" id="textarea4" name="textarea4" rows="3" required></textarea>
	            </div>
	            <div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2">Next Step</button>
	            </div>
	          </div>

	          <!-- Repeat the above HTML block for Steps 5 through 8 -->

	          <!-- Step 5 -->
	          <div class="step" data-step="5">
	            <h2 class="mb-4">Step 5</h2>
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
						<select class="form-control" id="taskSelect" required>
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
						<select class="form-control" id="userSelect" required>
							<option value="">Select teacher</option>
							<?php 
							$get_teachers = $crudObj->dynamic_query('SELECT * FROM vd_user');
							foreach($get_teachers as $teacher){
							$full_name = $teacher['vd_user_1_name'].' '.$teacher['vd_user_2_name'];
							?>
							<option value="<?php echo str_replace(' ', '__', $full_name) ?>"><?php echo $full_name ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label for="deadline">Select Deadline:</label>
						<input type="date" class="form-control" id="deadline" required>
					</div>
					<div class="mt-4 mb-5">
						<button type="button" class="btn btn-primary btn-block" onclick="assignTask()">Assign Task</button>
					</div>
					
				</form>

				<div class="mt-4">
					<h3 class="text-center mb-4">Assigned Tasks</h3>
					<div id="assignedTasks">
					<!-- Tasks will be displayed here -->
					</div>
				</div>

				<div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2">Next Step</button>
	            </div>
	          </div>

	          <!-- Repeat the above HTML block for Steps 6 through 8 -->

	          <!-- Step 6 -->
	          <div class="step" data-step="6">
	            <h2 class="mb-4">Step 6</h2>
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

	          <!-- Step 7 -->
	          <div class="step" data-step="7">
	            <h2 class="mb-4">Step 7</h2>
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
	            	<button type="button" class="btn btn-primary next ml-2">Next Step</button>
	            </div>
	          </div>

	          <!-- Step 8 -->
	          <div class="step" data-step="8">
	            <h2>Step 8</h2>
	            <div class="form-group">
	              <label for="field8">Field 8:</label>
	              <input type="text" class="form-control" id="field8" name="field8" required>
	            </div>
	            <div class="form-group">
	              <label for="textarea8">Textarea 8:</label>
	              <textarea class="form-control" id="textarea8" name="textarea8" rows="3" required></textarea>
	            </div>

	            <div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2">Previous Step</button>
	            	<button type="submit" class="btn btn-success submit ml-2">Submit</button>
	            </div>
	          </div>

	        </form>
	      </div>
	    </div>
	  </div>
	</div>

<?php include('includes/footer.php') ?>

<script>
	// STEP 1 : on change classes show students 
	$('#class').change(function(){
      	var selectedClass = $(this).val();
      	$.ajax({
         	url: "actions/action-forms.php",
         	method: "POST",
         	data: {selectedClass:selectedClass},
         	crossDomain: true,
         	cache: false,
         	success: function(data) {
				$('#student').html(data);
         	}
      	});
   	})

	// STEP 1 : on change students show student data in the table 
	$('.na-text').show();
	$('#student').change(function(){
      	var selectedStudent = $(this).val();
      	$.ajax({
         	url: "actions/action-forms.php",
         	method: "POST",
         	data: {selectedStudent:selectedStudent},
         	crossDomain: true,
         	cache: false,
         	success: function(data) {
				var info = data.split("#");
				// show male or female avatar
				if(info[0] == 'm'){
    				$(".boy-avatar").removeClass("d-none");
    				$(".girl-avatar").addClass("d-none");
				}else{
					$(".boy-avatar").addClass("d-none");
					$(".girl-avatar").removeClass("d-none");
				}
				// set data into the table
				if(info[1] != ''){
					$('.table-body').html(info[1]);
					$(".table-section").removeClass("d-none");
					$('.na-text').hide();
					$(".no-data-text").addClass("d-none");
				}else{
					$(".table-section").addClass("d-none");
					$('.na-text').hide();
					$(".no-data-text").removeClass("d-none");
				}
         	}
      	});
   	})
</script>

