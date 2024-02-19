$('#class').change(function(){
  var selectedClass = $(this).val();
  $.ajax({
     url: "actions/action-forms.php",
     method: "POST",
     data: {selectedClass:selectedClass},
     crossDomain: true,
     cache: false,
     success: function(data) {
        $('#student').html(data);
     }
  });
})

$('.na-text').show();
$('#student').change(function(){
      var selectedStudent = $(this).val();
      $.ajax({
        url: "actions/action-forms.php",
        method: "POST",
        data: {selectedStudent:selectedStudent},
        crossDomain: true,
        cache: false,
        success: function(data) {
          var info = data.split("#");
          // show male or female avatar
          if(info[0] == 'm'){
              $(".boy-avatar").removeClass("d-none");
              $(".girl-avatar").addClass("d-none");
          }else{
            $(".boy-avatar").addClass("d-none");
            $(".girl-avatar").removeClass("d-none");
          }
          // set data into the table
          if(info[1] != ''){
            $('.table-body-section').html(info[1]);
            $(".table-section").removeClass("d-none");
            $('.na-text').hide();
            $(".no-data-text").addClass("d-none");
          }else{
            $(".table-section").addClass("d-none");
            $('.na-text').hide();
            $(".no-data-text").removeClass("d-none");
          }
        }
      });
  })

  var selectedOptions = [];

    // Add Option button click event
    $("#addTeacher").click(function () {
      var addedTeacher = $("#addedTeacher").val();
      var addedTeacherGender = $("#addedTeacherGender").val();
      var addedTeacherEmail = $("#addedTeacherEmail").val();
      if(addedTeacherGender == ""){
        Swal.fire("Warning!", "Select a gender!", "error");
      }else if(addedTeacherEmail == ""){
        Swal.fire("Warning!", "Enter an email!", "error");
      }else{
        var TeacherGenderEmail = addedTeacher+"##"+addedTeacherGender+"##"+addedTeacherEmail;
        if (TeacherGenderEmail && !selectedOptions.includes(TeacherGenderEmail)) {
          selectedOptions.push(TeacherGenderEmail);
          updateSelectedOptionsList();
        }else{
          Swal.fire("Warning!", "This teacher is already added!", "error");
        }
      }
      $("#addedTeacher").val("");
      $("#addedTeacherGender").val("");
      $("#addedTeacherEmail").val("");
    });

    // Handle select change event
    $("#selectedOption").change(function () {
      var selectedOption = $(this).val();
      if (selectedOption && !selectedOptions.includes(selectedOption)) {
        selectedOptions.push(selectedOption);
        updateSelectedOptionsList();
      }else{
        Swal.fire("Warning!", "This teacher is already added!", "error");
      }
    });

    // Remove Option button click event
    $(document).on("click", ".remove-teacher-btn", function () {
      var optionToRemove = $(this).parent().attr('data-id').trim();
      var index = selectedOptions.indexOf(optionToRemove);
      if (index !== -1) {
        selectedOptions.splice(index, 1);
        updateSelectedOptionsList();
      }
      $('#selectedOption').val('')
      $('#addedTeacher').val('')
    });

    // Update the selected options list
    function updateSelectedOptionsList() {
      $("#selectedOptionsList").empty();
      $("#userSelect").html("<option value=''>Select teacher</option>");
      for (var i = 0; i < selectedOptions.length; i++) {
        var splitData = selectedOptions[i].split('##');
        var name = splitData[0];
        var gender = splitData[1];
        var email = splitData[2];
        var name_gender = name.replace(/ /g,"__")+"__"+gender;
        var name_gender_email = name.replace(/ /g,"__")+"__"+gender+"__"+email;
        // var setDataID = name+'##'+gender;
        var setDataID = name+'##'+gender+'##'+email;
        var nameEmail = name+" (Email: "+email+")";
        $("#selectedOptionsList").append("<li data-id='"+setDataID+"'>" + nameEmail + " <i class='fas fa-trash text-danger ml-2 remove-teacher-btn'></i></li>");
        $("#userSelect").append("<option value='"+name_gender+"'>" + name + " </option>");
      }
    }