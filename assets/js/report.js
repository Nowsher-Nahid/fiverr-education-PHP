$(document).ready(function(){

    var userDataArray = [];

    $(".thirteen-next").click(function(){
        var selectedStudent = $('#student').val()
        var studentData = selectedStudent.split("#")
        var studentID = studentData[0]
        $('#reportStudentTable').removeClass("d-none");

        if(selectedTests.length === 0){
            $('.student-section').hide()
        }else{
            $('.student-section').show()
            for(var i=0; i<selectedTests.length; i++){
                $('.report-student-info').append('<li>'+selectedTests[i]+'</li>')
            }
        }

        // STRENGTH
        if(selectedStrengths.length === 0){
            $('.strength-section').hide()
        }else{
            $('.strength-section').show()
            for(var i=0; i<selectedStrengths.length; i++){
                $('.report-strength').append('<li>'+selectedStrengths[i]+'</li>')
            }
        }

        // DIFFICULTY
        if(selectedDifficulties.length === 0){
            $('.difficulties-section').hide()
        }else{
            $('.difficulties-section').show()
            for(var i=0; i<selectedDifficulties.length; i++){
                $('.report-difficulties').append('<li>'+selectedDifficulties[i]+'</li>')
            }
        }

        // SUPPORT 1
        if(selectedSupportOne.length === 0){
            $('.support-one-section').hide()
        }else{
            $('.support-one-section').show()
            for(var i=0; i<selectedSupportOne.length; i++){
                $('.report-support-one').append('<li>'+selectedSupportOne[i]+'</li>')
            }
        }

        // SUPPORT 2
        if(selectedSupportTwo.length === 0){
            $('.support-two-section').hide()
        }else{
            $('.support-two-section').show()
            for(var i=0; i<selectedSupportTwo.length; i++){
                $('.report-support-two').append('<li>'+selectedSupportTwo[i]+'</li>')
            }
        }

        // AREA 
        if(selectedAreas.length === 0){
            $('.area-section').hide()
        }else{
            $('.area-section').show()
            for(var i=0; i<selectedAreas.length; i++){
                $('.report-school-area').append('<li>'+selectedAreas[i]+'</li>')
            }
        }

        // TEACHERS
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

        // SET SUPPORTS TEXTS WITH GOALS AND ACTIONS 
        // var supportOne = selectedSupportOne[0];
        // $(".set-support-one-text").text(supportOne);
        // if(selectedSupportTwo.length != 0){
        //     var supportTwo = selectedSupportTwo[0];
        //     $(".set-support-two-text").text(supportTwo);
        // }

        // GOALS FOR SUPPORT 1
        if(selectedGoals.length === 0){
            $('.goals-section-one').hide()
        }else{
            $('.goals-section-one').show()
            for(var i=0; i<selectedGoals.length; i++){
                $('.report-goals-one').append('<li>'+selectedGoals[i]+'</li>')
            }
        }

        // GOALS FOR SUPPORT 2
        if(selectedGoalsb.length === 0){
            $('.goals-section-two').hide()
        }else{
            $('.goals-section-two').show()
            for(var i=0; i<selectedGoalsb.length; i++){
                $('.report-goals-two').append('<li>'+selectedGoalsb[i]+'</li>')
            }
        }

        // ACTIONS FOR SUPPORT 1
        if(selectedActions.length === 0){
            $('.actions-section-one').hide()
        }else{
            $('.actions-section-one').show()
            for(var i=0; i<selectedActions.length; i++){
                $('.report-actions-one').append('<li>'+selectedActions[i]+'</li>')
            }
        }

        // ACTIONS FOR SUPPORT 2
        if(selectedActionsb.length === 0){
            $('.actions-section-two').hide()
        }else{
            $('.actions-section-two').show()
            for(var i=0; i<selectedActionsb.length; i++){
                $('.report-actions-two').append('<li>'+selectedActionsb[i]+'</li>')
            }
        }

        // COMPENSATION
        if(selectedCompensations.length === 0){
            $('.compensation-section').hide()
        }else{
            $('.compensation-section').show()
            for(var i=0; i<selectedCompensations.length; i++){
                $('.report-compensation').append('<li>'+selectedCompensations[i]+'</li>')
            }
        }

        // DISTRIBUTED TEACHERS FOR SUPPORT 1
        if(selectedTeacherOne.length === 0){
            $('.distribution-section-one').hide()
        }else{
            $('.distribution-section-one').show();
            
            var teacherToSplit = selectedTeacherOne[0];
            var teacher = teacherToSplit.split("##");
            $('.teacher-support-one').text(teacher[0]);

            for(var i=0; i<selectedTeachersOne.length; i++){
                var membersToSplit = selectedTeachersOne[i];
                var members = membersToSplit.split("##");
                $('.members-support-one').append('<li>'+members[0]+'</li>');
            }
            for(var i=0; i<selectedDutiesOne.length; i++){
                $('.duties-support-one').append('<li>'+selectedDutiesOne[i]+'</li>');
            }
            for(var i=0; i<selectedOutcomesOne.length; i++){
                $('.outcomes-support-one').append('<li>'+selectedOutcomesOne[i]+'</li>');
            }
        }

        // check if distribution support 2 is empty to show in report page
        if(selectedTeacherTwo.length === 0){
            $('.distribution-section-two').hide();
        }else{
            $('.distribution-section-two').show();
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

    $(".fourteen-next").click(function(){
        // DISTRIBUTED TEACHERS FOR SUPPORT 2
        if(selectedTeacherTwo.length === 0){
            $('.distribution-section-two').hide()
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

    $(".fifteen-prev").click(function(){
        if(selectedTeacherTwo.length === 0 || selectedTeachersTwo.length === 0 || selectedDutiesTwo.length === 0 || selectedOutcomesTwo.length === 0){
            // stepped on 13 : Remove all
            $(".report-student-info").find("li").remove();
            $(".report-school-area").find("li").remove();
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
            // stepped on 14 : Remove 14 data
            // step 14 data
            $(".members-support-two").find("li").remove();
            $(".duties-support-two").find("li").remove();
            $(".outcomes-support-two").find("li").remove();
        }
    });

    $(".fourteen-prev").click(function(){
        // stepped on 13 : Remove all
        $(".report-student-info").find("li").remove();
        $(".report-school-area").find("li").remove();
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
    });


    
    var selectedEvaluateDate = [];
    // Add Option button click event
    $("#addEvaluateDate").click(function () {
        // var addedOutcome = $("#addedOutcome").val();
        var evaluationDate = $("#evaluationDate").val();
        if(evaluationDate == ""){
            Swal.fire("Warning!", "Please, set a re-evaluation date!", "error");
        }else{
            if (evaluationDate && !selectedEvaluateDate.includes(evaluationDate)) {
                selectedEvaluateDate.push(evaluationDate);
                updateSelectedEvaluateList();
            }

            // if (addedOutcome && !selectedOutcomes.includes(addedOutcome+' (Date: '+evaluationDate+')')) {
            //     selectedOutcomes.push(addedOutcome+' (Date: '+evaluationDate+')');
            //     updateSelectedEvaluateList();
            // }else{
            //     Swal.fire("Warning!", "This outcome is already added!", "error");
            // }
        }
        // $('#addedOutcome').val('');
        $('#evaluationDate').val('');
    });

    // Remove Option button click event
    $(document).on("click", ".remove-option-btn", function () {
        var optionToRemove = $(this).parent().text().trim();
        var index = selectedEvaluateDate.indexOf(optionToRemove);
        if (index !== -1) {
            selectedEvaluateDate.splice(index, 1);
            updateSelectedEvaluateList();
        }
    });

    // Update the selected options list
    function updateSelectedEvaluateList() {
        $("#selectedEvaluateList").empty();
        for (var i = 0; i < selectedEvaluateDate.length; i++) {
            $("#selectedEvaluateList").append("<li>" + selectedEvaluateDate[i] + " <i class='fas fa-trash no-print text-danger ml-2 remove-option-btn'></i></li>");
        }
    }

    $(".save-report").click(function () {
        var selectedStudent = $('#student').val();
        var studentData = selectedStudent.split("#");
        var reportStudentID = studentData[0];
        var reportStudentName = $('.eight-student-name').html();
        var classID = $('#class').val();
        var reportArea = selectedAreas[0];
        var userID = $('#user-id').val();

        // var outcome = $('#addedOutcome').val()
        // var evaluationDate = $('#evaluationDate').val();
        if(selectedEvaluateDate.length !== 0){
            $.ajax({
                url: "actions/action-report.php",
                method: "POST",
                data: {
                    reportStudentID:reportStudentID,
                    reportStudentName:reportStudentName,
                    reportClassID:classID,
                    reportStrengths:selectedStrengths,
                    reportDifficulties:selectedDifficulties,
                    reportSupportOne:selectedSupportOne,
                    reportSupportTwo:selectedSupportTwo,
                    reportTeachers:selectedOptions,
                    reportArea:reportArea,
                    reportTests:selectedTests,
                    reportTaskAssignments:taskAssignments,
                    reportGoals:selectedGoals,
                    reportGoalsb:selectedGoalsb,
                    reportActions:selectedActions,
                    reportActionsb:selectedActionsb,
                    reportCompensations:selectedCompensations,
                    reportTeacherOne:selectedTeacherOne,
                    reportTeachersOne:selectedTeachersOne,
                    reportDutiesOne:selectedDutiesOne,
                    reportOutcomesOne:selectedOutcomesOne,
                    reportTeacherTwo:selectedTeacherTwo,
                    reportTeachersTwo:selectedTeachersTwo,
                    reportDutiesTwo:selectedDutiesTwo,
                    reportOutcomesTwo:selectedOutcomesTwo,
                    reportEvaluateDate:selectedEvaluateDate,
                    reportUserID:userID
                },
                crossDomain: true,
                cache: false,
                success: function(data) {
                    Swal.fire("Done!", "Report saved!", "success");
                }
            });
        }else{
            Swal.fire("Error!", "Please set a re-evaluation date!", "error");
        }
    });

});