var selectedOptions = [];

    // Add Option button click event
    $("#addTeacher").click(function () {
      var addedTeacher = $("#addedTeacher").val();
      if (addedTeacher && !selectedOptions.includes(addedTeacher)) {
        selectedOptions.push(addedTeacher);
        updateSelectedOptionsList();
      }
    });

    // Handle select change event
    $("#selectedOption").change(function () {
      var selectedOption = $(this).val();
      if (selectedOption && !selectedOptions.includes(selectedOption)) {
        selectedOptions.push(selectedOption);
        updateSelectedOptionsList();
      }
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedOptions.indexOf(optionToRemove);
      if (index !== -1) {
        selectedOptions.splice(index, 1);
        updateSelectedOptionsList();
      }
    });

    // Update the selected options list
    function updateSelectedOptionsList() {
      $("#selectedOptionsList").empty();
      for (var i = 0; i < selectedOptions.length; i++) {
        $("#selectedOptionsList").append("<li>" + selectedOptions[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
    }