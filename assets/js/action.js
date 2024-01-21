var selectedActions = [];

    // Add Option button click event
    $("#addAction").click(function () {
      var addedAction = $("#addedAction").val();
      if (addedAction && !selectedActions.includes(addedAction)) {
        selectedActions.push(addedAction);
        updateSelectedActionList();
      }
    });

    // Handle select change event
    $("#selectedAction").change(function () {
      var selectedAction = $(this).val();
      if (selectedAction && !selectedActions.includes(selectedAction)) {
        selectedActions.push(selectedAction);
        updateSelectedActionList();
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
    });

    // Update the selected options list
    function updateSelectedActionList() {
      $("#selectedActionsList").empty();
      for (var i = 0; i < selectedActions.length; i++) {
        $("#selectedActionsList").append("<li>" + selectedActions[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
    }