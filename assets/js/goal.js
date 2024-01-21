var selectedGoals = [];

    // Add Option button click event
    $("#addGoal").click(function () {
      var addedGoal = $("#addedGoal").val();
      if (addedGoal && !selectedGoals.includes(addedGoal)) {
        selectedGoals.push(addedGoal);
        updateSelectedGoalList();
      }
    });

    // Handle select change event
    $("#selectedGoal").change(function () {
      var selectedGoal = $(this).val();
      if (selectedGoal && !selectedGoals.includes(selectedGoal)) {
        selectedGoals.push(selectedGoal);
        updateSelectedGoalList();
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
    });

    // Update the selected options list
    function updateSelectedGoalList() {
      $("#selectedGoalsList").empty();
      for (var i = 0; i < selectedGoals.length; i++) {
        $("#selectedGoalsList").append("<li>" + selectedGoals[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
    }