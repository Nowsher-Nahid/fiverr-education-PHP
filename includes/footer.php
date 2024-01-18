<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<!-- datatable -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!-- sweet alert  -->
<script src="assets/vendor/sweetalert2/sweetalert2.min.js"></script>


<script>
  $(document).ready(function () {

  	$('#example').DataTable();

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

    // FOR TEACHER -------------------------------------------------
    var selectedOptions = [];

    // Add Option button click event
    $("#addTeacher").click(function () {
      var addedTeacher = $("#addedTeacher").val();
      if (addedTeacher && !selectedOptions.includes(addedTeacher)) {
        selectedOptions.push(addedTeacher);
        updateSelectedOptionsList();
      }
    });

    // Handle select change event
    $("#selectedOption").change(function () {
      var selectedOption = $(this).val();
      if (selectedOption && !selectedOptions.includes(selectedOption)) {
        selectedOptions.push(selectedOption);
        updateSelectedOptionsList();
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
    });

    // Update the selected options list
    function updateSelectedOptionsList() {
      $("#selectedOptionsList").empty();
      for (var i = 0; i < selectedOptions.length; i++) {
        $("#selectedOptionsList").append("<li>" + selectedOptions[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
    }

    // FOR AREA -------------------------------------------------
    $(".area-alert").hide();
    var selectedAreas = [];

    // Add Option button click event
    $("#addArea").click(function () {
      var addedArea = $("#addedArea").val();
      if (addedArea && !selectedAreas.includes(addedArea)) {
        if(selectedAreas.length > 0){
          $(".area-alert").show();
        }else{
          selectedAreas.push(addedArea);
          updateSelectedAreasList();
        }
      }
    });

    // Handle select change event
    $("#selectedArea").change(function () {
      var selectedArea = $(this).val();
      if (selectedArea && !selectedAreas.includes(selectedArea)) {
        if(selectedAreas.length > 0){
          $(".area-alert").show();
        }else{
          selectedAreas.push(selectedArea);
          updateSelectedAreasList();
        }
      }
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
      $(".area-alert").hide();
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedAreas.indexOf(optionToRemove);
      if (index !== -1) {
        selectedAreas.splice(index, 1);
        updateSelectedAreasList();
      }
    });

    // Update the selected options list
    function updateSelectedAreasList() {
      $("#selectedAreaList").empty();
      for (var i = 0; i < selectedAreas.length; i++) {
        $("#selectedAreaList").append("<li>" + selectedAreas[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
    }

    // remove alert on clicking X 
    $('.close-area-alert').click(function(){
      $(".area-alert").hide();
    })

    // FOR GOALS -------------------------------------------------
    var selectedGoals = [];

    // Add Option button click event
    $("#addGoal").click(function () {
      var addedGoal = $("#addedGoal").val();
      if (addedGoal && !selectedGoals.includes(addedGoal)) {
        selectedGoals.push(addedGoal);
        updateSelectedGoalList();
      }
    });

    // Handle select change event
    $("#selectedGoal").change(function () {
      var selectedGoal = $(this).val();
      if (selectedGoal && !selectedGoals.includes(selectedGoal)) {
        selectedGoals.push(selectedGoal);
        updateSelectedGoalList();
      }
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedGoals.indexOf(optionToRemove);
      if (index !== -1) {
        selectedGoals.splice(index, 1);
        updateSelectedGoalList();
      }
    });

    // Update the selected options list
    function updateSelectedGoalList() {
      $("#selectedGoalsList").empty();
      for (var i = 0; i < selectedGoals.length; i++) {
        $("#selectedGoalsList").append("<li>" + selectedGoals[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
    }

    // FOR ACTIONS -------------------------------------------------
    var selectedActions = [];

    // Add Option button click event
    $("#addAction").click(function () {
      var addedAction = $("#addedAction").val();
      if (addedAction && !selectedActions.includes(addedAction)) {
        selectedActions.push(addedAction);
        updateSelectedActionList();
      }
    });

    // Handle select change event
    $("#selectedAction").change(function () {
      var selectedAction = $(this).val();
      if (selectedAction && !selectedActions.includes(selectedAction)) {
        selectedActions.push(selectedAction);
        updateSelectedActionList();
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
    });

    // Update the selected options list
    function updateSelectedActionList() {
      $("#selectedActionsList").empty();
      for (var i = 0; i < selectedActions.length; i++) {
        $("#selectedActionsList").append("<li>" + selectedActions[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
      }
    }

  });
  

</script>

</body>
</html>