var selectedGoals = [];

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
