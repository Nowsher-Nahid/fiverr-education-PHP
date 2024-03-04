var selectedSupportOne = [];

// SUPPORT 1
$("#addSupportOne").click(function () {
    var addedSupportOne = $("#addedSupportOne").val();
    if (addedSupportOne && !selectedSupportOne.includes(addedSupportOne)) {
        if(selectedSupportOne.length > 0){
            Swal.fire("Warning!", "More than one support can't be added!", "error");
        }else{
            selectedSupportOne.push(addedSupportOne);
            updateSelectedSupportOneList();
        }
    }else{
        Swal.fire("Warning!", "This support is already added!", "error");
    }
    $("#addedSupportOne").val("")
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
    var optionToRemove = $(this).parent().text().trim();
    var index = selectedSupportOne.indexOf(optionToRemove);
    if (index !== -1) {
      selectedSupportOne.splice(index, 1);
      updateSelectedSupportOneList();
    }
});

// Update the selected options list
function updateSelectedSupportOneList() {
$("#selectedSupportOneList").empty();
    for (var i = 0; i < selectedSupportOne.length; i++) {
        $("#selectedSupportOneList").append("<li>" + selectedSupportOne[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
    }
}

// SUPPORT 2
var selectedSupportTwo = [];

$("#addSupportTwo").click(function () {
    var addedSupportTwo = $("#addedSupportTwo").val();
    if (addedSupportTwo && !selectedSupportTwo.includes(addedSupportTwo)) {
        if(selectedSupportTwo.length > 0){
            Swal.fire("Warning!", "More than one support can't be added!", "error");
        }else{
            selectedSupportTwo.push(addedSupportTwo);
            updateSelectedSupportTwoList();
        }
    }else{
        Swal.fire("Warning!", "This support is already added!", "error");
    }
    $("#addedSupportTwo").val("")
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
    var optionToRemove = $(this).parent().text().trim();
    var index = selectedSupportTwo.indexOf(optionToRemove);
    if (index !== -1) {
      selectedSupportTwo.splice(index, 1);
      updateSelectedSupportTwoList();
    }
});

// Update the selected options list
function updateSelectedSupportTwoList() {
$("#selectedSupportTwoList").empty();
    for (var i = 0; i < selectedSupportTwo.length; i++) {
        $("#selectedSupportTwoList").append("<li>" + selectedSupportTwo[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
    }
}
