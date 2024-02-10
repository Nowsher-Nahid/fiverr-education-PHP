<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<div class="container">
	  <div class="row justify-content-center">
	    <div class="col-md-12">
	        <div class="form-container">
                <h3 class="mb-3 text-center">Create a new task</h3>
                <form name="add_task_form">
                    <input type="text" value="<?php echo $user_id ?>" name="user_id" hidden>
                    <div class="form-group">
                        <label for="task">Enter task</label>
                        <textarea class="form-control" name="task" id="task" placeholder="Write here..."></textarea>
                    </div>
                    <div class="btn-submit form-group">
                        <button class="btn btn-primary" type="submit">Add task</button>
                    </div>
                </form>
                <h3 class="mb-3 mt-5 text-center">Task List</h3>
                <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter = 1;
                            $get_tasks = $crudObj->dynamic_query('SELECT * FROM vd_task WHERE created_by="'.$user_id.'"');
                            foreach ($get_tasks as  $task) {
                        ?>
                        <tr>
                            <td><?php echo $counter++ ?></td>
                            <td><?php echo $task['task'] ?></td>
                            <td>
                                <button type="button" class="actionBtn btn btn-sm btn-primary" onclick="show_modal(<?php echo $task['id'] ?>,'<?php echo $task['task'] ?>')"><i class="fas fa-edit"></i></button>
                                <button type="button" onclick="delete_row(<?php echo $task['id'] ?>)" class="actionBtn btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
<?php include('modals/task-modal.php') ?>

<script>
// insert
$("form[name='add_task_form']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "actions/action-task.php",
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data) {
            if(data == 'true') {
            Swal.fire("Done!", "Task added!", "success");
                window.setTimeout(function() {
                location.reload()
                }, 1000); 
            }else if(data == 'false'){
                Swal.fire("Error!", "Task already exists!", "error");
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

// update
$("form[name='update_task_form']").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: "actions/action-task.php",
      type: 'POST',
      dataType: 'json',
      data: formData,
      success: function(data) {
        if (data == 'true') {
            Swal.fire("Done!", "Task updated!", "success");
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
              url: "actions/action-task.php",
              method: "POST",
              data: {task_id:id},
              crossDomain: true,
              cache: false,
              success: function(data) {
                Swal.fire("Done!", "Task deleted!", "success");
                window.setTimeout(function() {
                  location.reload()
                }, 1000)
              }
            });
        }
    });
}

// modal
function show_modal(id,task){
    $('#taskID').val(id)
    $('#editTask').val(task)
    $('#taskModal').modal('show')
}


</script>