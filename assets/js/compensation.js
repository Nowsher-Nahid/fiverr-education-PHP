var selectedCompensations = [];

// Add Option button click event
$("#addCompensation").click(function () {
    var addedCompensation = $("#addedCompensation").val();
    if (addedCompensation && !selectedCompensations.includes(addedCompensation)) {
        selectedCompensations.push(addedCompensation);
        updateSelectedCompensationList();
    }else{
        Swal.fire("Warning!", "This compensation is already added!", "error");
    }
    $("#addedCompensation").val("")
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
    var optionToRemove = $(this).parent().text().trim();
    var index = selectedCompensations.indexOf(optionToRemove);
    if (index !== -1) {
        selectedCompensations.splice(index, 1);
        updateSelectedCompensationList();
    }
    $('#selectedCompensationData').val('')
});

// Update the selected options list
function updateSelectedCompensationList() {
    $("#selectedCompensationsList").empty();
    for (var i = 0; i < selectedCompensations.length; i++) {
        $("#selectedCompensationsList").append("<li>" + selectedCompensations[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
    }
}

