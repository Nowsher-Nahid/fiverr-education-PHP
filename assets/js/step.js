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
  })

  // TWO -------------------------------------------------------------------------------------------
  $('.two-next').click(function(){
    if(selectedOptions.length === 0){
      Swal.fire("Error!", "Please select or enter teachers!", "error");
    }else{
      $(".step[data-step='2']").removeClass('active').hide();
      $(".step[data-step='3']").addClass('active').show();
    }
  })
  $('.two-prev').click(function(){
    $(".step[data-step='2']").removeClass('active').hide();
    $(".step[data-step='1']").addClass('active').show();
  })

  // THREE -------------------------------------------------------------------------------------------
  $('.three-next').click(function(){
    if(selectedAreas.length === 0){
      Swal.fire("Error!", "Please select or enter an area!", "error");
    }else{
      $(".step[data-step='3']").removeClass('active').hide();
      $(".step[data-step='4']").addClass('active').show();
    }
  })
  $('.three-prev').click(function(){
    $(".step[data-step='3']").removeClass('active').hide();
    $(".step[data-step='2']").addClass('active').show();
  })

  // FOUR -------------------------------------------------------------------------------------------
  $('.four-next').click(function(){
    if(selectedTests.length === 0){
      Swal.fire("Error!", "Please select test data!", "error");
    }else{
      $(".step[data-step='4']").removeClass('active').hide();
      $(".step[data-step='5']").addClass('active').show();
    }
  })
  $('.four-prev').click(function(){
    $(".step[data-step='4']").removeClass('active').hide();
    $(".step[data-step='3']").addClass('active').show();
  })

  // FIVE : Task Assignment -------------------------------------------------------------------------------------------
  $('.five-next').click(function(){
    if($('.task-box').find('.remove-btn').length === 0){
      Swal.fire("Error!", "Please assign tasks to the teachers!", "error");
    }else{
      $(".step[data-step='5']").removeClass('active').hide();
      $(".step[data-step='6']").addClass('active').show();
    }
  })
  $('.five-prev').click(function(){
    $(".step[data-step='5']").removeClass('active').hide();
    $(".step[data-step='4']").addClass('active').show();
  })

  // SIX : Goals -------------------------------------------------------------------------------------------
  $('.six-next').click(function(){
    if(selectedGoals.length === 0){
      Swal.fire("Error!", "Please select or enter goals!", "error");
    }else{
      $(".step[data-step='6']").removeClass('active').hide();
      $(".step[data-step='7']").addClass('active').show();
    }
  })
  $('.six-prev').click(function(){
    $(".step[data-step='6']").removeClass('active').hide();
    $(".step[data-step='5']").addClass('active').show();
  })

  // SEVEN : Actions  -------------------------------------------------------------------------------------------
  $('.seven-next').click(function(){
    if(selectedActions.length === 0){
      Swal.fire("Error!", "Please select or enter actions!", "error");
    }else{
      $(".step[data-step='7']").removeClass('active').hide();
      $(".step[data-step='8']").addClass('active').show();
    }
  })
  $('.seven-prev').click(function(){
    $(".step[data-step='7']").removeClass('active').hide();
    $(".step[data-step='6']").addClass('active').show();
  })

  // EIGHT   -------------------------------------------------------------------------------------------
  $('.eight-prev').click(function(){
    $(".step[data-step='8']").removeClass('active').hide();
    $(".step[data-step='7']").addClass('active').show();
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