// For single teacher
var selectedTeacherOne = [];

// Handle select change event
$("#selectedTeacherOne").change(function () {
    var selectedOption = $(this).val();
    if (selectedOption && !selectedTeacherOne.includes(selectedOption)) {
        if(selectedTeacherOne.length > 0){
            Swal.fire("Warning!", "You can add only one teacher!", "error");
        }else{
            selectedTeacherOne.push(selectedOption);
            updateTeacherOneList();
        }
    }
});

// Remove Option button click event
$(document).on("click", ".remove-teacher-btn", function () {
    var optionToRemove = $(this).parent().attr('data-id').trim();
    var index = selectedTeacherOne.indexOf(optionToRemove);
    if (index !== -1) {
        selectedTeacherOne.splice(index, 1);
        updateTeacherOneList();
    }
    $('#selectedTeacherOne').val('');
});

// Update the selected options list
function updateTeacherOneList() {
    $("#selectedTeacherListOne").empty();
    for (var i = 0; i < selectedTeacherOne.length; i++) {
      var splitData = selectedTeacherOne[i].split('##');
      var name = splitData[0];
      var gender = splitData[1];
      var email = splitData[2];
      var name_gender = name.replace(/ /g,"__")+"__"+gender;
      var name_gender_email = name.replace(/ /g,"__")+"__"+gender+"__"+email;
      // var setDataID = name+'##'+gender;
      var setDataID = name+'##'+gender+'##'+email;
      var nameEmail = name+" (Email: "+email+")";
      $("#selectedTeacherListOne").append("<li data-id='"+setDataID+"'>" + nameEmail + " <i class='fas fa-trash text-danger ml-2 remove-teacher-btn'></i></li>");
    }
}

// For multiple teachers 
var selectedTeachersOne = [];

// Handle select change event
$("#selectedTeachersOne").change(function () {
    var selectedOption = $(this).val();
    if (selectedOption && !selectedTeachersOne.includes(selectedOption)) {
        selectedTeachersOne.push(selectedOption);
        updateTeachersOneList();
    }else{
        Swal.fire("Warning!", "This teacher is already added!", "error");
    }
});

// Remove Option button click event
$(document).on("click", ".remove-teachers-btn", function () {
    var optionToRemove = $(this).parent().attr('data-id').trim();
    var index = selectedTeachersOne.indexOf(optionToRemove);
    if (index !== -1) {
        selectedTeachersOne.splice(index, 1);
        updateTeachersOneList();
    }
    $('#selectedTeachersOne').val('');
});

// Update the selected options list
function updateTeachersOneList() {
    $("#selectedTeachersListOne").empty();
    for (var i = 0; i < selectedTeachersOne.length; i++) {
      var splitData = selectedTeachersOne[i].split('##');
      var name = splitData[0];
      var gender = splitData[1];
      var email = splitData[2];
      var name_gender = name.replace(/ /g,"__")+"__"+gender;
      var name_gender_email = name.replace(/ /g,"__")+"__"+gender+"__"+email;
      // var setDataID = name+'##'+gender;
      var setDataID = name+'##'+gender+'##'+email;
      var nameEmail = name+" (Email: "+email+")";
      $("#selectedTeachersListOne").append("<li data-id='"+setDataID+"'>" + nameEmail + " <i class='fas fa-trash text-danger ml-2 remove-teachers-btn'></i></li>");
    }
}

// DUTY
var selectedDutiesOne = [];

// Add Option button click event
$("#addDutyOne").click(function () {
    var addedDutyOne = $("#addedDutyOne").val();
    if (addedDutyOne && !selectedDutiesOne.includes(addedDutyOne)) {
        selectedDutiesOne.push(addedDutyOne);
        updateDutiesOneList();
        $('#addedDutyOne').val('')
    }else{
        Swal.fire("Warning!", "This duty is already added!", "error");
    }
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
    var optionToRemove = $(this).parent().text().trim();
    var index = selectedDutiesOne.indexOf(optionToRemove);
    if (index !== -1) {
        selectedDutiesOne.splice(index, 1);
        updateDutiesOneList();
    }
    $('#addedDutyOne').val('');
});

// Update the selected options list
function updateDutiesOneList() {
    $("#selectedDutyListOne").empty();
    for (var i = 0; i < selectedDutiesOne.length; i++) {
      $("#selectedDutyListOne").append("<li>" + selectedDutiesOne[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
    }
}

// OUTCOMES 
var selectedOutcomesOne = [];

// Add Option button click event
$("#addOutcomeOne").click(function () {
    var addedOutcome = $("#addedOutcomeOne").val();
    var outcomeDateOne = $("#outcomeDateOne").val();
    if(outcomeDateOne == ""){
        Swal.fire("Warning!", "Please, set an outcome date!", "error");
    }else{
        if (addedOutcome && !selectedOutcomesOne.includes(addedOutcome+' (Date: '+outcomeDateOne+')')) {
            selectedOutcomesOne.push(addedOutcome+' (Date: '+outcomeDateOne+')');
            updateOutcomeListOne();
        }else{
            Swal.fire("Warning!", "This outcome is already added!", "error");
        }
    }
    $('#addedOutcomeOne').val('');
    $('#outcomeDateOne').val('');
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
    var optionToRemove = $(this).parent().text().trim();
    var index = selectedOutcomesOne.indexOf(optionToRemove);
    if (index !== -1) {
        selectedOutcomesOne.splice(index, 1);
        updateOutcomeListOne();
    }
});

// Update the selected options list
function updateOutcomeListOne() {
    $("#selectedOutcomesListOne").empty();
    for (var i = 0; i < selectedOutcomesOne.length; i++) {
        $("#selectedOutcomesListOne").append("<li>" + selectedOutcomesOne[i] + " <i class='fas fa-trash no-print text-danger ml-2 remove-option-btn'></i></li>");
    }
}