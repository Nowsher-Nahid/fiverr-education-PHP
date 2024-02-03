$(document).ready(function () {

  var currentStep = 1;

  // Show the first step initially
  $(".step[data-step='" + currentStep + "']").addClass('active');

  $(".next").click(function () {
    $(".step[data-step='" + currentStep + "']").removeClass('active').hide();
    currentStep++;
    $(".step[data-step='" + currentStep + "']").addClass('active').show();
  });

  $(".prev").click(function () {
    $(".step[data-step='" + currentStep + "']").removeClass('active').hide();
    currentStep--;
    $(".step[data-step='" + currentStep + "']").addClass('active').show();
  });            

}); 