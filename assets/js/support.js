var selectedSupportOneList = [];

// SUPPORT 1
$("#addSupportOne").click(function () {
    var addedSupportOne = $("#addedSupportOne").val();
    if (addedSupportOne && !selectedSupportOneList.includes(addedSupportOne)) {
        if(selectedSupportOneList.length > 0){
            Swal.fire("Warning!", "More than one support can't be added!", "error");
        }else{
            selectedSupportOneList.push(addedSupportOne);
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
    var index = selectedSupportOneList.indexOf(optionToRemove);
    if (index !== -1) {
      selectedSupportOneList.splice(index, 1);
      updateSelectedSupportOneList();
    }
});

// Update the selected options list
function updateSelectedSupportOneList() {
$("#selectedSupportOneList").empty();
    for (var i = 0; i < selectedSupportOneList.length; i++) {
        $("#selectedSupportOneList").append("<li>" + selectedSupportOneList[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
    }
}

// SUPPORT 2
var selectedSupportTwoList = [];

$("#addSupportTwo").click(function () {
    var addedSupportTwo = $("#addedSupportTwo").val();
    if (addedSupportTwo && !selectedSupportTwoList.includes(addedSupportTwo)) {
        if(selectedSupportTwoList.length > 0){
            Swal.fire("Warning!", "More than one support can't be added!", "error");
        }else{
            selectedSupportTwoList.push(addedSupportTwo);
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
    var index = selectedSupportTwoList.indexOf(optionToRemove);
    if (index !== -1) {
      selectedSupportTwoList.splice(index, 1);
      updateSelectedSupportTwoList();
    }
});

// Update the selected options list
function updateSelectedSupportTwoList() {
$("#selectedSupportTwoList").empty();
    for (var i = 0; i < selectedSupportTwoList.length; i++) {
        $("#selectedSupportTwoList").append("<li>" + selectedSupportTwoList[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
    }
}
