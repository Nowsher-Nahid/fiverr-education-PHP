$(document).ready(function () {

  // var currentStep = 1;

  // // Show the first step initially
  // $(".step[data-step='" + currentStep + "']").addClass('active');

  // $(".next").click(function () {
  //   $(".step[data-step='" + currentStep + "']").removeClass('active').hide();
  //   currentStep++;
  //   $(".step[data-step='" + currentStep + "']").addClass('active').show();
  // });

  // $(".prev").click(function () {
  //   $(".step[data-step='" + currentStep + "']").removeClass('active').hide();
  //   currentStep--;
  //   $(".step[data-step='" + currentStep + "']").addClass('active').show();
  // }); 
  
  // ONE -------------------------------------------------------------------------------------------
  $('.one').click(function(){
    var studentClass = $('#class').val()
    var student = $('#student').val()
    if(studentClass != "" && student!= ""){
      $(".step[data-step='1']").removeClass('active').hide();
      $(".step[data-step='2']").addClass('active').show();
    }else{
      Swal.fire("Error!", "Please select a class and a student!", "error");
    }

    // show student name in step 2 and 3
    var studentData = student.split("#")
    var studentID = studentData[0]
    $.ajax({
        url: "actions/action-report.php",
        method: "POST",
        data: {studentID:studentID},
        crossDomain: true,
        cache: false,
        success: function(data) {
            var info = data.split("#");
            $('.student-name').val(info[0]);
        }
    });

  })

  // TWO : Strength and difficulties -------------------------------------------------------------------------------------------

  $('.two-next').click(function(){
    if(selectedStrengths.length === 0 && selectedDifficulties.length === 0){
      Swal.fire("Error!", "Please enter strengths and difficulties!", "error");
    }else{
      $(".step[data-step='2']").removeClass('active').hide();
      $(".step[data-step='3']").addClass('active').show();
    }
  })
  $('.two-prev').click(function(){
    $(".step[data-step='2']").removeClass('active').hide();
    $(".step[data-step='1']").addClass('active').show();
  })

  // THREE : Supports -------------------------------------------------------------------------------------------
  $('.three-next').click(function(){
    if(selectedSupportOneList.length === 0){
      Swal.fire("Error!", "Please enter a support in support 1!", "error");
    }else{
      $(".step[data-step='3']").removeClass('active').hide();
      $(".step[data-step='4']").addClass('active').show();
    }
  })
  $('.three-prev').click(function(){
    $(".step[data-step='3']").removeClass('active').hide();
    $(".step[data-step='2']").addClass('active').show();
  })

  // FOUR : Teachers -------------------------------------------------------------------------------------------
  $('.four-next').click(function(){
    if(selectedOptions.length === 0){
      Swal.fire("Error!", "Please select or enter teachers!", "error");
    }else{
      $(".step[data-step='4']").removeClass('active').hide();
      $(".step[data-step='5']").addClass('active').show();
    }
  })
  $('.four-prev').click(function(){
    $(".step[data-step='4']").removeClass('active').hide();
    $(".step[data-step='3']").addClass('active').show();
  })

  // FIVE : School area -------------------------------------------------------------------------------------------
  $('.five-next').click(function(){
    if(selectedAreas.length === 0){
      Swal.fire("Error!", "Please select or enter an area!", "error");
    }else{
      $(".step[data-step='5']").removeClass('active').hide();
      $(".step[data-step='6']").addClass('active').show();
    }
  })
  $('.five-prev').click(function(){
    $(".step[data-step='5']").removeClass('active').hide();
    $(".step[data-step='4']").addClass('active').show();
  })

  // SIX : Test -------------------------------------------------------------------------------------------
  $('.six-next').click(function(){
    $(".step[data-step='6']").removeClass('active').hide();
    $(".step[data-step='7']").addClass('active').show();
  })
  $('.six-prev').click(function(){
    $(".step[data-step='6']").removeClass('active').hide();
    $(".step[data-step='5']").addClass('active').show();
  })

  // SEVEN : Task assinment  -------------------------------------------------------------------------------------------
  $('.seven-next').click(function(){
    if($('.task-box').find('.remove-btn').length === 0){
      Swal.fire("Error!", "Please assign tasks to the teachers!", "error");
    }else{
      $(".step[data-step='7']").removeClass('active').hide();
      $(".step[data-step='8']").addClass('active').show();
      var supportOne = selectedSupportOneList[0];
      $(".set-support-one").val(supportOne);
    }
  })
  $('.seven-prev').click(function(){
    $(".step[data-step='7']").removeClass('active').hide();
    $(".step[data-step='6']").addClass('active').show();
  })

  // EIGHT : Goals (8a) -------------------------------------------------------------------------------------------
  $('.eight-next').click(function(){
    if(selectedGoals.length === 0){
      Swal.fire("Error!", "Please select or enter goals!", "error");
    }else{
      if(selectedSupportTwoList.length > 0){
        var supportTwo = selectedSupportTwoList[0];
        $(".set-support-two").val(supportTwo);
        $(".step[data-step='8']").removeClass('active').hide();
        $(".step[data-step='9']").addClass('active').show();
      }else{
        $(".step[data-step='8']").removeClass('active').hide();
        $(".step[data-step='10']").addClass('active').show();
      }
    }
  })
  $('.eight-prev').click(function(){
    $(".step[data-step='8']").removeClass('active').hide();
    $(".step[data-step='7']").addClass('active').show();
  })

  // NINE : Goals (8b) -------------------------------------------------------------------------------------------
  $('.nine-next').click(function(){
    if(selectedGoalsb.length === 0){
      Swal.fire("Error!", "Please select or enter goals!", "error");
    }else{
      $(".step[data-step='9']").removeClass('active').hide();
      $(".step[data-step='10']").addClass('active').show();
    }
  })
  $('.nine-prev').click(function(){
    $(".step[data-step='9']").removeClass('active').hide();
    $(".step[data-step='8']").addClass('active').show();
  })

  // TEN : Actions (9a)  -------------------------------------------------------------------------------------------
  $('.ten-next').click(function(){
    if(selectedActions.length === 0){
      Swal.fire("Error!", "Please select or enter actions!", "error");
    }else{
      if(selectedSupportTwoList.length > 0){
        // var supportTwo = selectedSupportTwoList[0];
        // $(".set-support-two").val(supportTwo);
        $(".step[data-step='10']").removeClass('active').hide();
        $(".step[data-step='11']").addClass('active').show();
      }else{
        $(".step[data-step='10']").removeClass('active').hide();
        $(".step[data-step='12']").addClass('active').show();
      }
    }
  })
  $('.ten-prev').click(function(){
    if(selectedGoalsb.length === 0){
      $(".step[data-step='10']").removeClass('active').hide();
      $(".step[data-step='8']").addClass('active').show();
    }else{
      $(".step[data-step='10']").removeClass('active').hide();
      $(".step[data-step='9']").addClass('active').show();
    }
  })

// ELEVEN : Actions (9b)  -------------------------------------------------------------------------------------------
$('.eleven-next').click(function(){
  if(selectedActionsb.length === 0){
    Swal.fire("Error!", "Please select or enter actions!", "error");
  }else{
    $(".step[data-step='11']").removeClass('active').hide();
    $(".step[data-step='12']").addClass('active').show();
  }
})
$('.eleven-prev').click(function(){
  $(".step[data-step='11']").removeClass('active').hide();
  $(".step[data-step='10']").addClass('active').show();
})

// TWELVE : Compensation -------------------------------------------------------------------------------------------
$('.twelve-next').click(function(){
  $(".step[data-step='12']").removeClass('active').hide();
  $(".step[data-step='13']").addClass('active').show();
})
$('.twelve-prev').click(function(){
  if(selectedActionsb.length === 0){
    $(".step[data-step='12']").removeClass('active').hide();
    $(".step[data-step='10']").addClass('active').show();
  }else{
    $(".step[data-step='12']").removeClass('active').hide();
    $(".step[data-step='11']").addClass('active').show();
  }
})

  // EDIT \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
  // ONE : Teachers -------------------------------------------------------------------------------------------
  $('.edit-one-next').click(function(){
    if(selectedOptions.length === 0){
      Swal.fire("Error!", "Please select or enter teachers!", "error");
    }else{
      $(".step[data-step='1']").removeClass('active').hide();
      $(".step[data-step='2']").addClass('active').show();
    }
  })

  // TWO : Task Assignment -------------------------------------------------------------------------------------------
  $('.edit-two-next').click(function(){
    if($('.task-box').find('.remove-btn').length === 0){
      Swal.fire("Error!", "Please assign tasks to the teachers!", "error");
    }else{
      $(".step[data-step='2']").removeClass('active').hide();
      $(".step[data-step='3']").addClass('active').show();
    }
  })
  $('.edit-two-prev').click(function(){
    $(".step[data-step='2']").removeClass('active').hide();
    $(".step[data-step='1']").addClass('active').show();
  })

  // THREE : Goals -------------------------------------------------------------------------------------------
  $('.edit-three-next').click(function(){
    if(selectedGoals.length === 0){
      Swal.fire("Error!", "Please select or enter goals!", "error");
    }else{
      $(".step[data-step='3']").removeClass('active').hide();
      $(".step[data-step='4']").addClass('active').show();
    }
  })
  $('.edit-three-prev').click(function(){
    $(".step[data-step='3']").removeClass('active').hide();
    $(".step[data-step='2']").addClass('active').show();
  })

  // FOUR : Actions  -------------------------------------------------------------------------------------------
  $('.edit-four-next').click(function(){
    if(selectedActions.length === 0){
      Swal.fire("Error!", "Please select or enter actions!", "error");
    }else{
      $(".step[data-step='4']").removeClass('active').hide();
      $(".step[data-step='5']").addClass('active').show();
    }
  })
  $('.edit-four-prev').click(function(){
    $(".step[data-step='4']").removeClass('active').hide();
    $(".step[data-step='3']").addClass('active').show();
  })

  // FIVE : REPORT -------------------------------------------------------------------------------------------
  $('.edit-five-prev').click(function(){
    $(".step[data-step='5']").removeClass('active').hide();
    $(".step[data-step='4']").addClass('active').show();
  })

}); 