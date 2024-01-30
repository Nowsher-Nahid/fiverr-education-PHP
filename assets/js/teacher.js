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
      if (addedTeacher && !selectedOptions.includes(addedTeacher)) {
        selectedOptions.push(addedTeacher);
        updateSelectedOptionsList();
      }else{
        Swal.fire("Warning!", "This teacher is already added!", "error");
      }
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
    $(document).on("click", ".remove-option-btn", function () {
      var optionToRemove = $(this).parent().text().trim();
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
      for (var i = 0; i < selectedOptions.length; i++) {
        $("#selectedOptionsList").append("<li>" + selectedOptions[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
    }