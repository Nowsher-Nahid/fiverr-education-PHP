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
      $('#selectedArea').val("");
      $('#addedArea').val("");
      // console.log($(this).parent().text())
      var optionToRemove = $(this).parent().text().trim();
      var index = selectedAreas.indexOf(optionToRemove);
      if (index !== -1) {
        selectedAreas.splice(index, 1);
        updateSelectedAreasList();
      }
      $('#selectedArea').val('')
      $('#addedArea').val('')
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