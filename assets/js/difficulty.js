var selectedDifficulties = [];

// Add Option button click event
$("#addDifficulties").click(function () {
    var addedDifficulties = $("#addedDifficulties").val();
    if (addedDifficulties && !selectedDifficulties.includes(addedDifficulties)) {
        selectedDifficulties.push(addedDifficulties);
        updateSelectedDifficultiesList();
    }else{
        Swal.fire("Warning!", "This difficulty is already added!", "error");
    }
    $("#addedDifficulties").val("")
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
    var optionToRemove = $(this).parent().text().trim();
    var index = selectedDifficulties.indexOf(optionToRemove);
    if (index !== -1) {
      selectedDifficulties.splice(index, 1);
      updateSelectedDifficultiesList();
    }
});

// Update the selected options list
function updateSelectedDifficultiesList() {
    $("#selectedDifficultiesList").empty();
    for (var i = 0; i < selectedDifficulties.length; i++) {
        $("#selectedDifficultiesList").append("<li>" + selectedDifficulties[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
    }
}
