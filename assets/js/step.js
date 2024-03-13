$(document).ready(function () {
  
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
    if(selectedStrengths.length === 0 || selectedDifficulties.length === 0){
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
    if(selectedSupportOne.length === 0){
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
      var supportOne = selectedSupportOne[0];
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
      if(selectedSupportTwo.length > 0){
        var supportTwo = selectedSupportTwo[0];
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
      if(selectedSupportTwo.length > 0){
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

// THIRTEEN : Teachers Distribution (11a)  -------------------------------------------------------------------------------------------
$('.thirteen-next').click(function(){
  if(selectedTeacherOne.length === 0 || selectedTeachersOne.length === 0 || selectedDutiesOne.length === 0 || selectedOutcomesOne.length === 0){
    Swal.fire("Error!", "Please select and enter the form data!", "error");
  }else{
    if(selectedSupportTwo.length > 0){
      $(".step[data-step='13']").removeClass('active').hide();
      $(".step[data-step='14']").addClass('active').show();
    }else{
      $(".step[data-step='13']").removeClass('active').hide();
      $(".step[data-step='15']").addClass('active').show();
    }
  }
})
$('.thirteen-prev').click(function(){
  $(".step[data-step='13']").removeClass('active').hide();
  $(".step[data-step='12']").addClass('active').show();
})

// FOURTEEN : Teachers Distribution (11b) -------------------------------------------------------------------------------------------
$('.fourteen-next').click(function(){
  if(selectedTeacherTwo.length === 0 || selectedTeachersTwo.length === 0 || selectedDutiesTwo.length === 0 || selectedOutcomesTwo.length === 0){
    Swal.fire("Error!", "Please select end enter the form data!", "error");
  }else{
    $(".step[data-step='14']").removeClass('active').hide();
    $(".step[data-step='15']").addClass('active').show();
  }
})
$('.fourteen-prev').click(function(){
  $(".step[data-step='14']").removeClass('active').hide();
  $(".step[data-step='13']").addClass('active').show();
})

// FIFTEEN : Report -------------------------------------------------------------------------------------------
$('.fifteen-prev').click(function(){
  if(selectedTeacherTwo.length === 0 || selectedTeachersTwo.length === 0 || selectedDutiesTwo.length === 0 || selectedOutcomesTwo.length === 0){
    $(".step[data-step='15']").removeClass('active').hide();
    $(".step[data-step='13']").addClass('active').show();
  }else{
    $(".step[data-step='15']").removeClass('active').hide();
    $(".step[data-step='14']").addClass('active').show();
  }
})



  // EDIT \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
  // ONE : Strengths and difficulties -------------------------------------------------------------------------------------------
  $('.edit-one-next').click(function(){
    if(selectedStrengths.length === 0 || selectedDifficulties.length === 0){
      Swal.fire("Error!", "Please enter strengths and difficulties!", "error");
    }else{
      $(".step[data-step='1']").removeClass('active').hide();
      $(".step[data-step='2']").addClass('active').show();
    }
  })

  // TWO : Supports -------------------------------------------------------------------------------------------
  $('.edit-two-next').click(function(){
    if(selectedSupportOne.length === 0){
      Swal.fire("Error!", "Please enter a support in support 1!", "error");
    }else{
      $(".step[data-step='2']").removeClass('active').hide();
      $(".step[data-step='3']").addClass('active').show();
    }
    if(selectedSupportTwo.length > 0){
      $(".goals-b").val(selectedSupportTwo[0]);
      $(".actions-b").val(selectedSupportTwo[0]);
      $(".distribution-b").val(selectedSupportTwo[0]);
    }
  })
  $('.edit-two-prev').click(function(){
    $(".step[data-step='2']").removeClass('active').hide();
    $(".step[data-step='1']").addClass('active').show();
  })

  // THREE : Teachers -------------------------------------------------------------------------------------------
  $('.edit-three-next').click(function(){
    if(selectedOptions.length === 0){
      Swal.fire("Error!", "Please select or enter teachers!", "error");
    }else{
      $(".step[data-step='3']").removeClass('active').hide();
      $(".step[data-step='4']").addClass('active').show();
    }
  })
  $('.edit-three-prev').click(function(){
    $(".step[data-step='3']").removeClass('active').hide();
    $(".step[data-step='2']").addClass('active').show();
  })

  // FOUR : Areas -------------------------------------------------------------------------------------------
  $('.edit-four-next').click(function(){
    if(selectedAreas.length === 0){
      Swal.fire("Error!", "Please select or enter an area!", "error");
    }else{
      $(".step[data-step='4']").removeClass('active').hide();
      $(".step[data-step='5']").addClass('active').show();
    }
  })
  $('.edit-four-prev').click(function(){
    $(".step[data-step='4']").removeClass('active').hide();
    $(".step[data-step='3']").addClass('active').show();
  })

  // FIVE : Task assinment  -------------------------------------------------------------------------------------------
  $('.edit-five-next').click(function(){
    if($('.task-box').find('.remove-btn').length === 0){
      Swal.fire("Error!", "Please assign tasks to the teachers!", "error");
    }else{
      $(".step[data-step='5']").removeClass('active').hide();
      $(".step[data-step='6']").addClass('active').show();
      var supportOne = selectedSupportOne[0];
      $(".set-support-one").val(supportOne);
    }
  })
  $('.edit-five-prev').click(function(){
    $(".step[data-step='5']").removeClass('active').hide();
    $(".step[data-step='4']").addClass('active').show();
  })

  // SIX : Goals (6a) -------------------------------------------------------------------------------------------
  $('.edit-six-next').click(function(){
    if(selectedGoals.length === 0){
      Swal.fire("Error!", "Please select or enter goals!", "error");
    }else{
      if(selectedSupportTwo.length > 0){
        // var supportTwo = selectedSupportTwo[0];
        // $(".set-support-two").val(supportTwo);
        $(".step[data-step='6']").removeClass('active').hide();
        $(".step[data-step='7']").addClass('active').show();
      }else{
        $(".step[data-step='6']").removeClass('active').hide();
        $(".step[data-step='8']").addClass('active').show();
      }
    }
  })
  $('.edit-six-prev').click(function(){
    $(".step[data-step='6']").removeClass('active').hide();
    $(".step[data-step='5']").addClass('active').show();
  })

  // SEVEN : Goals (6b) -------------------------------------------------------------------------------------------
  $('.edit-seven-next').click(function(){
    if(selectedGoalsb.length === 0){
      Swal.fire("Error!", "Please select or enter goals!", "error");
    }else{
      $(".step[data-step='7']").removeClass('active').hide();
      $(".step[data-step='8']").addClass('active').show();
    }
  })
  $('.edit-seven-prev').click(function(){
    $(".step[data-step='7']").removeClass('active').hide();
    $(".step[data-step='6']").addClass('active').show();
  })

  // EIGHT : Actions (7a)  -------------------------------------------------------------------------------------------
  $('.edit-eight-next').click(function(){
    if(selectedActions.length === 0){
      Swal.fire("Error!", "Please select or enter actions!", "error");
    }else{
      if(selectedSupportTwo.length > 0){
        $(".step[data-step='8']").removeClass('active').hide();
        $(".step[data-step='9']").addClass('active').show();
      }else{
        $(".step[data-step='8']").removeClass('active').hide();
        $(".step[data-step='10']").addClass('active').show();
      }
    }
  })
  $('.edit-eight-prev').click(function(){
    if(selectedGoalsb.length === 0){
      $(".step[data-step='8']").removeClass('active').hide();
      $(".step[data-step='6']").addClass('active').show();
    }else{
      $(".step[data-step='8']").removeClass('active').hide();
      $(".step[data-step='7']").addClass('active').show();
    }
  })

  // NINE : Actions (7b)  -------------------------------------------------------------------------------------------
  $('.edit-nine-next').click(function(){
    if(selectedActionsb.length === 0){
      Swal.fire("Error!", "Please select or enter actions!", "error");
    }else{
      $(".step[data-step='9']").removeClass('active').hide();
      $(".step[data-step='10']").addClass('active').show();
    }
  })
  $('.edit-nine-prev').click(function(){
    $(".step[data-step='9']").removeClass('active').hide();
    $(".step[data-step='8']").addClass('active').show();
  })

  // TEN : Compensation -------------------------------------------------------------------------------------------
  $('.edit-ten-next').click(function(){
    $(".step[data-step='10']").removeClass('active').hide();
    $(".step[data-step='11']").addClass('active').show();
  })
  $('.edit-ten-prev').click(function(){
    if(selectedActionsb.length === 0){
      $(".step[data-step='10']").removeClass('active').hide();
      $(".step[data-step='8']").addClass('active').show();
    }else{
      $(".step[data-step='10']").removeClass('active').hide();
      $(".step[data-step='9']").addClass('active').show();
    }
  })

  // ELEVEN : Teachers Distribution (11a)  -------------------------------------------------------------------------------------------
  $('.edit-eleven-next').click(function(){
    if(selectedTeacherOne.length === 0 || selectedTeachersOne.length === 0 || selectedDutiesOne.length === 0 || selectedOutcomesOne.length === 0){
      Swal.fire("Error!", "Please select and enter the form data!", "error");
    }else{
      if(selectedSupportTwo.length > 0){
        $(".step[data-step='11']").removeClass('active').hide();
        $(".step[data-step='12']").addClass('active').show();
      }else{
        $(".step[data-step='11']").removeClass('active').hide();
        $(".step[data-step='13']").addClass('active').show();
      }
    }
  })
  $('.edit-eleven-prev').click(function(){
    $(".step[data-step='11']").removeClass('active').hide();
    $(".step[data-step='10']").addClass('active').show();
  })

  // TWELVE : Teachers Distribution (11b) -------------------------------------------------------------------------------------------
  $('.edit-twelve-next').click(function(){
    if(selectedTeacherTwo.length === 0 || selectedTeachersTwo.length === 0 || selectedDutiesTwo.length === 0 || selectedOutcomesTwo.length === 0){
      Swal.fire("Error!", "Please select end enter the form data!", "error");
    }else{
      $(".step[data-step='12']").removeClass('active').hide();
      $(".step[data-step='13']").addClass('active').show();
    }

    // DISTRIBUTED TEACHERS FOR SUPPORT 2
    if(selectedTeacherTwo.length === 0){
      $('.distribution-section-two').hide();
    }else{
        $('.distribution-section-two').show();
        
        var teacherToSplit = selectedTeacherTwo[0];
        var teacher = teacherToSplit.split("##");
        $('.teacher-support-two').text(teacher[0]);

        for(var i=0; i<selectedTeachersTwo.length; i++){
            var membersToSplit = selectedTeachersOne[i];
            var members = membersToSplit.split("##");
            $('.members-support-two').append('<li>'+members[0]+'</li>');
        }
        for(var i=0; i<selectedDutiesTwo.length; i++){
            $('.duties-support-two').append('<li>'+selectedDutiesTwo[i]+'</li>');
        }
        for(var i=0; i<selectedOutcomesOne.length; i++){
            $('.outcomes-support-two').append('<li>'+selectedOutcomesTwo[i]+'</li>');
        }
    }
    
  })
  $('.edit-twelve-prev').click(function(){
    $(".step[data-step='12']").removeClass('active').hide();
    $(".step[data-step='11']").addClass('active').show();

    // stepped on 13 : Remove all
    $(".report-student-info").find("li").remove();
    // $(".report-school-area").find("li").remove();
    $(".report-strength").find("li").remove();
    $(".report-difficulties").find("li").remove();
    $(".report-support-one").find("li").remove();
    $(".report-support-two").find("li").remove();
    $(".report-teachers").find("li").remove();
    $(".report-goals-one").find("li").remove();
    $(".report-goals-two").find("li").remove();
    $(".report-actions-one").find("li").remove();
    $(".report-actions-two").find("li").remove();
    $(".report-compensation").find("li").remove();
    $("#userTable").find("tr").remove();
    // step 13 data
    $(".members-support-one").find("li").remove();
    $(".duties-support-one").find("li").remove();
    $(".outcomes-support-one").find("li").remove();

    // step 14 data
    $(".members-support-two").find("li").remove();
    $(".duties-support-two").find("li").remove();
    $(".outcomes-support-two").find("li").remove();
    
  })

  // THIRTEEN : Report -------------------------------------------------------------------------------------------
  $('.edit-thirteen-prev').click(function(){
    var supportTwo = $('#support-two').val();
    if(supportTwo == ""){
    // if(selectedTeacherTwo.length === 0 || selectedTeachersTwo.length === 0 || selectedDutiesTwo.length === 0 || selectedOutcomesTwo.length === 0){
      $(".step[data-step='13']").removeClass('active').hide();
      $(".step[data-step='11']").addClass('active').show();

      $(".report-student-info").find("li").remove();
      // $(".report-school-area").find("li").remove();
      $(".report-strength").find("li").remove();
      $(".report-difficulties").find("li").remove();
      $(".report-support-one").find("li").remove();
      $(".report-support-two").find("li").remove();
      $(".report-teachers").find("li").remove();
      $(".report-goals-one").find("li").remove();
      $(".report-goals-two").find("li").remove();
      $(".report-actions-one").find("li").remove();
      $(".report-actions-two").find("li").remove();
      $(".report-compensation").find("li").remove();
      $("#userTable").find("tr").remove();
      // step 13 data
      $(".members-support-one").find("li").remove();
      $(".duties-support-one").find("li").remove();
      $(".outcomes-support-one").find("li").remove();

      // step 14 data
      $(".members-support-two").find("li").remove();
      $(".duties-support-two").find("li").remove();
      $(".outcomes-support-two").find("li").remove();
      
    }else{
      $(".step[data-step='13']").removeClass('active').hide();
      $(".step[data-step='12']").addClass('active').show();

      // stepped on 14 : Remove 14 data
      // step 14 data
      $(".members-support-two").find("li").remove();
      $(".duties-support-two").find("li").remove();
      $(".outcomes-support-two").find("li").remove();
      
    }
  })

}); 