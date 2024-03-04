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



// FOR SUPPORT TWO
// For single teacher
var selectedTeacherTwo = [];

// Handle select change event
$("#selectedTeacherTwo").change(function () {
    var selectedOption = $(this).val();
    if (selectedOption && !selectedTeacherTwo.includes(selectedOption)) {
        if(selectedTeacherTwo.length > 0){
            Swal.fire("Warning!", "You can add only one teacher!", "error");
        }else{
            selectedTeacherTwo.push(selectedOption);
            updateTeacherTwoList();
        }
    }
});

// Remove Option button click event
$(document).on("click", ".remove-teacher-btn", function () {
    var optionToRemove = $(this).parent().attr('data-id').trim();
    var index = selectedTeacherTwo.indexOf(optionToRemove);
    if (index !== -1) {
        selectedTeacherTwo.splice(index, 1);
        updateTeacherTwoList();
    }
    $('#selectedTeacherTwo').val('');
});

// Update the selected options list
function updateTeacherTwoList() {
    $("#selectedTeacherListTwo").empty();
    for (var i = 0; i < selectedTeacherTwo.length; i++) {
      var splitData = selectedTeacherTwo[i].split('##');
      var name = splitData[0];
      var gender = splitData[1];
      var email = splitData[2];
      var name_gender = name.replace(/ /g,"__")+"__"+gender;
      var name_gender_email = name.replace(/ /g,"__")+"__"+gender+"__"+email;
      // var setDataID = name+'##'+gender;
      var setDataID = name+'##'+gender+'##'+email;
      var nameEmail = name+" (Email: "+email+")";
      $("#selectedTeacherListTwo").append("<li data-id='"+setDataID+"'>" + nameEmail + " <i class='fas fa-trash text-danger ml-2 remove-teacher-btn'></i></li>");
    }
}

// For multiple teachers 
var selectedTeachersTwo = [];

// Handle select change event
$("#selectedTeachersTwo").change(function () {
    var selectedOption = $(this).val();
    if (selectedOption && !selectedTeachersTwo.includes(selectedOption)) {
        selectedTeachersTwo.push(selectedOption);
        updateTeachersTwoList();
    }else{
        Swal.fire("Warning!", "This teacher is already added!", "error");
    }
});

// Remove Option button click event
$(document).on("click", ".remove-teachers-btn", function () {
    var optionToRemove = $(this).parent().attr('data-id').trim();
    var index = selectedTeachersTwo.indexOf(optionToRemove);
    if (index !== -1) {
        selectedTeachersTwo.splice(index, 1);
        updateTeachersTwoList();
    }
    $('#selectedTeachersTwo').val('');
});

// Update the selected options list
function updateTeachersTwoList() {
    $("#selectedTeachersListTwo").empty();
    for (var i = 0; i < selectedTeachersTwo.length; i++) {
      var splitData = selectedTeachersTwo[i].split('##');
      var name = splitData[0];
      var gender = splitData[1];
      var email = splitData[2];
      var name_gender = name.replace(/ /g,"__")+"__"+gender;
      var name_gender_email = name.replace(/ /g,"__")+"__"+gender+"__"+email;
      // var setDataID = name+'##'+gender;
      var setDataID = name+'##'+gender+'##'+email;
      var nameEmail = name+" (Email: "+email+")";
      $("#selectedTeachersListTwo").append("<li data-id='"+setDataID+"'>" + nameEmail + " <i class='fas fa-trash text-danger ml-2 remove-teachers-btn'></i></li>");
    }
}

// DUTY
var selectedDutiesTwo = [];

// Add Option button click event
$("#addDutyTwo").click(function () {
    var addedDutyTwo = $("#addedDutyTwo").val();
    if (addedDutyTwo && !selectedDutiesTwo.includes(addedDutyTwo)) {
        selectedDutiesTwo.push(addedDutyTwo);
        updateDutiesTwoList();
        $('#addedDutyTwo').val('')
    }else{
        Swal.fire("Warning!", "This duty is already added!", "error");
    }
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
    var optionToRemove = $(this).parent().text().trim();
    var index = selectedDutiesTwo.indexOf(optionToRemove);
    if (index !== -1) {
        selectedDutiesTwo.splice(index, 1);
        updateDutiesTwoList();
    }
    $('#addedDutyTwo').val('');
});

// Update the selected options list
function updateDutiesTwoList() {
    $("#selectedDutyListTwo").empty();
    for (var i = 0; i < selectedDutiesTwo.length; i++) {
      $("#selectedDutyListTwo").append("<li>" + selectedDutiesTwo[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
    }
}

// OUTCOMES 
var selectedOutcomesTwo = [];

// Add Option button click event
$("#addOutcomeTwo").click(function () {
    var addedOutcome = $("#addedOutcomeTwo").val();
    var outcomeDateTwo = $("#outcomeDateTwo").val();
    if(outcomeDateTwo == ""){
        Swal.fire("Warning!", "Please, set an outcome date!", "error");
    }else{
        if (addedOutcome && !selectedOutcomesTwo.includes(addedOutcome+' (Date: '+outcomeDateTwo+')')) {
            selectedOutcomesTwo.push(addedOutcome+' (Date: '+outcomeDateTwo+')');
            updateOutcomeListTwo();
        }else{
            Swal.fire("Warning!", "This outcome is already added!", "error");
        }
    }
    $('#addedOutcomeTwo').val('');
    $('#outcomeDateTwo').val('');
});

// Remove Option button click event
$(document).on("click", ".remove-option-btn", function () {
    var optionToRemove = $(this).parent().text().trim();
    var index = selectedOutcomesTwo.indexOf(optionToRemove);
    if (index !== -1) {
        selectedOutcomesTwo.splice(index, 1);
        updateOutcomeListTwo();
    }
});

// Update the selected options list
function updateOutcomeListTwo() {
    $("#selectedOutcomesListTwo").empty();
    for (var i = 0; i < selectedOutcomesTwo.length; i++) {
        $("#selectedOutcomesListTwo").append("<li>" + selectedOutcomesTwo[i] + " <i class='fas fa-trash no-print text-danger ml-2 remove-option-btn'></i></li>");
    }
}