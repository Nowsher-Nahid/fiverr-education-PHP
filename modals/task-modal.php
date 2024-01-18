<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="taskModalLabel">Update Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form name="update_task_form">
            <input type="text" id="taskID" name="edit_id" hidden>
            <div class="modal-body">
                <div class="form-group">
                    <label for="editTask">Task</label>
                    <textarea class="form-control" name="edit_task" id="editTask" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none;">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>

    </div>
  </div>
</div>