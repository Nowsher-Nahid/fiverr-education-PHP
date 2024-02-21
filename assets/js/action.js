// ACTION A
var selectedActions = [];

// Add Option button click event
$("#addAction").click(function () {
  var addedAction = $("#addedAction").val();
  var userID = $("#user-id").val();
  if (addedAction && !selectedActions.includes(addedAction)) {
    selectedActions.push(addedAction);
    updateSelectedActionList();

    $.ajax({
      url: "actions/action-action.php",
      method: "POST",
      data: {action:addedAction,user_id:userID},
      crossDomain: true,
      cache: false,
      success: function(data) {}
    });

  }else{
    Swal.fire("Warning!", "This action is already added!", "error");
  }
});

// Handle select change event
$("#selectedAction").change(function () {
  var selectedAction = $(this).val();
  if (selectedAction && !selectedActions.includes(selectedAction)) {
    selectedActions.push(selectedAction);
    updateSelectedActionList();
  }else{
    Swal.fire("Warning!", "This action is already added!", "error");
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
  $('#selectedAction').val('')
  $('#addedAction').val('')
});

// Update the selected options list
function updateSelectedActionList() {
  $("#selectedActionsList").empty();
  for (var i = 0; i < selectedActions.length; i++) {
    $("#selectedActionsList").append("<li>" + selectedActions[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
  }
}

// ACTION B

var selectedActionsb = [];

// Add Option button click event
$("#addActionb").click(function () {
  var addedActionb = $("#addedActionb").val();
  var userID = $("#user-id").val();
  if (addedActionb && !selectedActionsb.includes(addedActionb)) {
    selectedActionsb.push(addedActionb);
    updateSelectedActionListb();

    $.ajax({
      url: "actions/action-action.php",
      method: "POST",
      data: {action:addedActionb,user_id:userID},
      crossDomain: true,
      cache: false,
      success: function(data) {}
    });

  }else{
    Swal.fire("Warning!", "This action is already added!", "error");
  }
});

// Handle select change event
$("#selectedActionb").change(function () {
  var selectedActionb = $(this).val();
  if (selectedActionb && !selectedActionsb.includes(selectedActionb)) {
    selectedActionsb.push(selectedActionb);
    updateSelectedActionListb();
  }else{
    Swal.fire("Warning!", "This action is already added!", "error");
  }
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
  var optionToRemove = $(this).parent().text().trim();
  var index = selectedActionsb.indexOf(optionToRemove);
  if (index !== -1) {
    selectedActionsb.splice(index, 1);
    updateSelectedActionListb();
  }
  $('#selectedActionb').val('')
  $('#addedActionb').val('')
});

// Update the selected options list
function updateSelectedActionListb() {
  $("#selectedActionsListb").empty();
  for (var i = 0; i < selectedActionsb.length; i++) {
    $("#selectedActionsListb").append("<li>" + selectedActionsb[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
  }
}