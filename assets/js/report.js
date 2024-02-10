$(document).ready(function(){

    var userDataArray = [];

    $(".next-seven").click(function(){
        var selectedStudent = $('#student').val()
        var studentData = selectedStudent.split("#")
        var studentID = studentData[0]

        if(selectedTests.length === 0){
            $('.student-section').hide()
        }else{
            $('.student-section').show()
            for(var i=0; i<selectedTests.length; i++){
                $('.report-student-info').append('<li>'+selectedTests[i]+'</li>')
            }
        }

        if(selectedOptions.length === 0){
            $('.teachers-section').hide()
        }else{
            $('.teachers-section').show()
            for(var i=0; i<selectedOptions.length; i++){
                var splitData = selectedOptions[i].split('##');
                var name = splitData[0];
                $('.report-teachers').append('<li>'+name+'</li>')
            }
        }
        
        $('.user-box').each(function(){
            var userName = $(this).find('h4').text();
            var tasks = [];
      
            // Collect tasks for the current user
            $(this).find('.task-box').each(function(){
              var taskText = $(this).text();
              
              // Remove the last 6 characters from each task
              var truncatedTask = taskText.substring(0, taskText.length - 6);
              
              tasks.push(truncatedTask);
            });
      
            // Combine tasks into a single string with dots or list items
            var tasksHTML = tasks.length > 1 ? '<ul><li>' + tasks.join('</li><li>') + '</li></ul>' : tasks.join('.');
      
            // Append a new row to the table
            $('#userTable').append('<tr><td>' + userName + '</td><td>' + tasksHTML + '</td></tr>');

            userDataArray.push({
                user: userName,
                tasks: tasks
            });
        });

        if(selectedGoals.length === 0){
            $('.goals-section').hide()
        }else{
            $('.goals-section').show()
            for(var i=0; i<selectedGoals.length; i++){
                $('.report-goals').append('<li>'+selectedGoals[i]+'</li>')
            }
        }

        if(selectedActions.length === 0){
            $('.actions-section').hide()
        }else{
            $('.actions-section').show()
            for(var i=0; i<selectedActions.length; i++){
                $('.report-actions').append('<li>'+selectedActions[i]+'</li>')
            }
        }

        $.ajax({
            url: "actions/action-report.php",
            method: "POST",
            data: {studentID:studentID},
            crossDomain: true,
            cache: false,
            success: function(data) {
                var info = data.split("#");
                $('.eight-student-name').html(info[0]);
                if(info[1] == 'm'){
                    $('.eight-student-image').attr('src', 'assets/img/avatar.png');
                }else{
                    $('.eight-student-image').attr('src', 'assets/img/avatar-girl.jpg');
                }
            }
        });
    });

    $(".prev-step-eight").click(function(){
        $(".report-student-info").find("li").remove();
        $(".report-teachers").find("li").remove();
        $(".report-goals").find("li").remove();
        $(".report-actions").find("li").remove();
        $("#userTable").find("tr").remove();
    });

    var selectedOutcomes = [];

    // Add Option button click event
    $("#addOutcome").click(function () {
        var addedOutcome = $("#addedOutcome").val();
        var evaluationDate = $("#evaluationDate").val();
        if(evaluationDate == ""){
            Swal.fire("Warning!", "Please, set a re-evaluation date!", "error");
        }else{
            if (addedOutcome && !selectedOutcomes.includes(addedOutcome+' (Date: '+evaluationDate+')')) {
                selectedOutcomes.push(addedOutcome+' (Date: '+evaluationDate+')');
                updateSelectedOutcomeList();
            }else{
                Swal.fire("Warning!", "This outcome is already added!", "error");
            }
        }
        $('#addedOutcome').val('');
        $('#evaluationDate').val('');
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
        var optionToRemove = $(this).parent().text().trim();
        var index = selectedOutcomes.indexOf(optionToRemove);
        if (index !== -1) {
            selectedOutcomes.splice(index, 1);
            updateSelectedOutcomeList();
        }
    });

    // Update the selected options list
    function updateSelectedOutcomeList() {
        $("#selectedOutcomesList").empty();
        for (var i = 0; i < selectedOutcomes.length; i++) {
            $("#selectedOutcomesList").append("<li>" + selectedOutcomes[i] + " <i class='fas fa-trash no-print text-danger ml-2 remove-option-btn'></i></li>");
        }
    }

    $(".save-step-eight").click(function () {
        var selectedStudent = $('#student').val()
        var studentData = selectedStudent.split("#")
        var reportStudentID = studentData[0]
        var reportStudentName = $('.eight-student-name').html()
        var reportArea = selectedAreas[0]
        var userID = $('#user-id').val()

        var outcome = $('#addedOutcome').val()
        var evaluationDate = $('#evaluationDate').val()
        if(selectedOutcomes.length !== 0){
            $.ajax({
                url: "actions/action-report.php",
                method: "POST",
                data: {
                    reportStudentID:reportStudentID,
                    reportStudentName:reportStudentName,
                    reportTeachers:selectedOptions,
                    reportGoals:selectedGoals,
                    reportActions:selectedActions,
                    reportOutcomes:selectedOutcomes,
                    reportTaskAssignments:taskAssignments,
                    reportUserID:userID,
                    reportArea:reportArea,
                    reportTests:selectedTests
                },
                crossDomain: true,
                cache: false,
                success: function(data) {
                    Swal.fire("Done!", "Report saved!", "success");
                }
            });
        }else{
            Swal.fire("Error!", "Please set a desired outcome and evaluation date!", "error");
        }
    });

});