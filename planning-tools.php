<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

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
			         <div class="row">
			         	<div class="col-md-12 mt-3 mb-5">
			         		<img src="assets/img/avatar.png" alt="Image" width="150">
			         	</div>
			         	<div class="col-md-12 table-responsive">
			         		<table id="example" class="table table-striped" style="width:100%">
						        <thead>
						            <tr>
						                <th>Area</th>
						                <th>Tests</th>
						                <th>Scores</th>
						                <th>Remarks</th>
						            </tr>
						        </thead>
						        <tbody>
						            <tr>
						                <td>Tiger Nixon</td>
						                <td>System Architect</td>
						                <td>61</td>
						                <td>2011-04-25</td>
						            </tr>
						            <tr>
						                <td>Hope Fuentes</td>
						                <td>San Francisco</td>
						                <td>41</td>
						                <td>2010-02-12</td>
						            </tr>
						            <tr>
						                <td>Financial Controller</td>
						                <td>San Francisco</td>
						                <td>62</td>
						                <td>2009-02-14</td>
						            </tr>
						            <tr>
						                <td>Office Manager</td>
						                <td>London</td>
						                <td>37</td>
						                <td>2008-12-11</td>
						            </tr>
						            <tr>
						                <td>Director</td>
						                <td>New York</td>
						                <td>65</td>
						                <td>2008-09-26</td>
						            </tr>
						            <tr>
						                <td>Tiger Nixon</td>
						                <td>System Architect</td>
						                <td>61</td>
						                <td>2011-04-25</td>
						            </tr>
						            <tr>
						                <td>Hope Fuentes</td>
						                <td>San Francisco</td>
						                <td>41</td>
						                <td>2010-02-12</td>
						            </tr>
						            <tr>
						                <td>Financial Controller</td>
						                <td>San Francisco</td>
						                <td>62</td>
						                <td>2009-02-14</td>
						            </tr>
						            <tr>
						                <td>Office Manager</td>
						                <td>London</td>
						                <td>37</td>
						                <td>2008-12-11</td>
						            </tr>
						            <tr>
						                <td>Director</td>
						                <td>New York</td>
						                <td>65</td>
						                <td>2008-09-26</td>
						            </tr>
						            <tr>
						                <td>Tiger Nixon</td>
						                <td>System Architect</td>
						                <td>61</td>
						                <td>2011-04-25</td>
						            </tr>
						            <tr>
						                <td>Hope Fuentes</td>
						                <td>San Francisco</td>
						                <td>41</td>
						                <td>2010-02-12</td>
						            </tr>
						            <tr>
						                <td>Financial Controller</td>
						                <td>San Francisco</td>
						                <td>62</td>
						                <td>2009-02-14</td>
						            </tr>
						            <tr>
						                <td>Office Manager</td>
						                <td>London</td>
						                <td>37</td>
						                <td>2008-12-11</td>
						            </tr>
						            <tr>
						                <td>Director</td>
						                <td>New York</td>
						                <td>65</td>
						                <td>2008-09-26</td>
						            </tr>
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
	            <h2>Step 2</h2>
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
	            <h2>Step 3</h2>
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
	            <h2>Step 4</h2>
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
	            <h2>Step 5</h2>
	            <div class="form-group">
	              <label for="field5">Field 5:</label>
	              <input type="text" class="form-control" id="field5" name="field5" required>
	            </div>
	            <div class="form-group">
	              <label for="textarea5">Textarea 5:</label>
	              <textarea class="form-control" id="textarea5" name="textarea5" rows="3" required></textarea>
	            </div>
	            <div class="text-center both-btn">
	            	<button type="button" class="btn btn-secondary prev mr-2">Previous Step</button>
	            	<button type="button" class="btn btn-primary next ml-2">Next Step</button>
	            </div>
	          </div>

	          <!-- Repeat the above HTML block for Steps 6 through 8 -->

	          <!-- Step 6 -->
	          <div class="step" data-step="6">
	            <h2>Step 6</h2>
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
	            <h2>Step 7</h2>
	            <div class="form-group">
		            <label for="selectedAction">Select actions</label>
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
	// on change classes show students 
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
</script>
