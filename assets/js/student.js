    
    $(".next-five").click(function(){
        var selectedStudent = $('#student').val()
        var studentData = selectedStudent.split("#")
        var studentID = studentData[0]

        if (selectedAreas.length == 0) {
            var selectedArea = ""
        }else{
            var selectedArea = selectedAreas[0]
        }
        
        $('.selected-area').val(selectedArea)
        $.ajax({
            url: "actions/action-student.php",
            method: "POST",
            data: {studentID:studentID,selectedArea:selectedArea},
            crossDomain: true,
            cache: false,
            success: function(data) {
                var info = data.split("#");
                if(info[0] != ""){
                    $('.selected-student').val(info[0]);
                }
                $('#selectedTestData').html(info[1]);
            }
        });
        
    });

    var selectedTests = [];

    // Handle select change event
    $("#selectedTestData").change(function () {
        var selectedTest = $(this).val();
        if (selectedTest && !selectedTests.includes(selectedTest)) {
            selectedTests.push(selectedTest);
            updateSelectedTestList();
        }
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
        var optionToRemove = $(this).parent().text().trim();
        var index = selectedTests.indexOf(optionToRemove);
        if (index !== -1) {
            selectedTests.splice(index, 1);
            updateSelectedTestList();
        }
        $('#selectedTestData').val('')
    });

    // Update the selected options list
    function updateSelectedTestList() {
        $("#selectedTestsList").empty();
        for (var i = 0; i < selectedTests.length; i++) {
            $("#selectedTestsList").append("<li>" + selectedTests[i] + " <i class='fas fa-trash text-danger ml-2 remove-option-btn'></i></li>");
        }
    }

