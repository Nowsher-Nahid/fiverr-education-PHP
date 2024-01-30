$(document).ready(function(){

    $(".next-seven").click(function(){
        var selectedStudent = $('#student').val()
        var studentData = selectedStudent.split("#")
        var studentID = studentData[0]

        if(selectedGoals.length === 0){
            $('.goals-section').hide()
        }else{
            for(var i=0; i<selectedGoals.length; i++){
                $('.report-goals').append('<li>'+selectedGoals[i]+'</li>')
            }
        }

        if(selectedActions.length === 0){
            $('.actions-section').hide()
        }else{
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

});