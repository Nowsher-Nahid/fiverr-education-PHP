<!-- Modal -->
<div class="modal fade" id="goalModal" tabindex="-1" role="dialog" aria-labelledby="goalModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="goalModalLabel">Update Goal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form name="update_goal_form">
            <input type="text" id="goalID" name="edit_id" hidden>
            <div class="modal-body">
                <div class="form-group">
                    <label for="editGoal">Goal</label>
                    <textarea class="form-control" name="edit_goal" id="editGoal" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none;">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>

    </div>
  </div>
</div>