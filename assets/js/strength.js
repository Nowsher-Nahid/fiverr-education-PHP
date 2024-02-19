var selectedStrengths = [];

// Add Option button click event
$("#addStrength").click(function () {
    var addedStrength = $("#addedStrength").val();
    if (addedStrength && !selectedStrengths.includes(addedStrength)) {
        selectedStrengths.push(addedStrength);
        updateSelectedStrengthsList();
    }else{
        Swal.fire("Warning!", "This strength is already added!", "error");
    }
    $("#addedStrength").val("")
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
    var optionToRemove = $(this).parent().text().trim();
    var index = selectedStrengths.indexOf(optionToRemove);
    if (index !== -1) {
      selectedStrengths.splice(index, 1);
      updateSelectedStrengthsList();
    }
});

// Update the selected options list
function updateSelectedStrengthsList() {
$("#selectedStrengthsList").empty();
for (var i = 0; i < selectedStrengths.length; i++) {
    $("#selectedStrengthsList").append("<li>" + selectedStrengths[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
}
}
