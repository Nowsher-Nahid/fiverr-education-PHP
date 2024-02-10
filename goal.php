<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<div class="container">
	  <div class="row justify-content-center">
	    <div class="col-md-12">
	        <div class="form-container">
                <h3 class="mb-3 text-center">Create a new goal</h3>
                <form name="add_goal_form">
                    <input type="text" value="<?php echo $user_id ?>" name="user_id" hidden>
                    <div class="form-group">
                        <label for="goal">Enter goal</label>
                        <textarea class="form-control" name="goal" id="goal" placeholder="Write here..."></textarea>
                    </div>
                    <div class="btn-submit form-group">
                        <button class="btn btn-primary" type="submit">Add goal</button>
                    </div>
                </form>
                <h3 class="mb-3 mt-5 text-center">Goals List</h3>
                <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Goal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter = 1;
                            $get_goals = $crudObj->dynamic_query('SELECT * FROM vd_goal WHERE created_by="'.$user_id.'"');
                            foreach ($get_goals as  $goal) {
                        ?>
                        <tr>
                            <td><?php echo $counter++ ?></td>
                            <td><?php echo $goal['goal'] ?></td>
                            <td>
                                <button type="button" class="actionBtn btn btn-sm btn-primary" onclick="show_modal(<?php echo $goal['id'] ?>,'<?php echo $goal['goal'] ?>')"><i class="fas fa-edit"></i></button>
                                <button type="button" onclick="delete_row(<?php echo $goal['id'] ?>)" class="actionBtn btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>
<?php include('modals/goal-modal.php') ?>

<script>

// insert
$("form[name='add_goal_form']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
    url: "actions/action-goal.php",
    type: 'POST',
    dataType: 'json',
    data: formData,
    success: function(data) {
        if(data == 'true') {
        Swal.fire("Done!", "Goal added!", "success");
            window.setTimeout(function() {
            location.reload()
            }, 1000); 
        }else if(data == 'false'){
            Swal.fire("Error!", "Goal already exists!", "error");
        }
    },
    cache: false,
    contentType: false,
    processData: false
    });
});

// update
$("form[name='update_goal_form']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: "actions/action-goal.php",
      type: 'POST',
      dataType: 'json',
      data: formData,
      success: function(data) {
        if (data == 'true') {
            Swal.fire("Done!", "Goal updated!", "success");
              window.setTimeout(function() {
                  location.reload()
              }, 1000); 
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

// delete
function delete_row(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
              url: "actions/action-goal.php",
              method: "POST",
              data: {goal_id:id},
              crossDomain: true,
              cache: false,
              success: function(data) {
                Swal.fire("Done!", "Goal deleted!", "success");
                window.setTimeout(function() {
                  location.reload()
                }, 1000)
              }
            });
        }
    });
}

// modal
function show_modal(id,goal){
    $('#goalID').val(id)
    $('#editGoal').val(goal)
    $('#goalModal').modal('show')
}

</script>