<?php 
require_once('../controller/crudFunctions.php');
$crudObj = new CrudOparation;

if (isset($_POST['studentID']) && $_POST["studentID"]!="") {
    $studentID = $_POST['studentID'];
    $where = array('ID_pupil'=>$studentID);
    $get_student = $crudObj->select_record('vd_pupil_code,vd_pupil_sex',$where,'vd_pupil');
    $student_code = $get_student[0]['vd_pupil_code'];
    $student_gender = $get_student[0]['vd_pupil_sex'];

    echo $student_code.'#'.$student_gender;
}

if(isset($_POST['reportStudentID']) && $_POST["reportStudentID"]!=""){
    $studentID = $_POST['reportStudentID'];
    $reportStudentName = $_POST['reportStudentName'];
    $reportClassID = $_POST['reportClassID'];

    $where = array("ID_class"=>$reportClassID);
    $get_class = $crudObj->select_record("vd_class_name",$where,"vd_class");
    $reportClassName = $get_class[0]['vd_class_name'];
    $reportArea = $_POST['reportArea'];
    $creationDate = date("Y-m-d");
    $createdBy = $_POST['reportUserID'];

    $reportStrengths = json_encode($_POST['reportStrengths']);
    $reportDifficulties = json_encode($_POST['reportDifficulties']);
    $reportSupportOne = json_encode($_POST['reportSupportOne']);

    $reportSupportTwo = $_POST['reportSupportTwo'];
    if($reportSupportTwo != ""){
        $reportSupportTwo = json_encode($_POST['reportSupportTwo']);
    }else{
        $reportSupportTwo = "";
    }

    $reportTeachers = json_encode($_POST['reportTeachers']);

    $reportGoals = json_encode($_POST['reportGoals']);
    $reportGoalsb = $_POST['reportGoalsb'];
    if($reportGoalsb != ""){
        $reportGoalsb = json_encode($_POST['reportGoalsb']);
    }else{
        $reportGoalsb = "";
    }

    $reportActions = json_encode($_POST['reportActions']);
    $reportActionsb = $_POST['reportActionsb'];
    if($reportActionsb != ""){
        $reportActionsb = json_encode($_POST['reportActionsb']);
    }else{
        $reportActionsb = "";
    }

    $reportCompensations = $_POST['reportCompensations'];
    if($reportCompensations != ""){
        $reportCompensations = json_encode($_POST['reportCompensations']);
    }else{
        $reportCompensations = "";
    }

    $reportTeacherOne = json_encode($_POST['reportTeacherOne']);
    $reportTeachersOne = json_encode($_POST['reportTeachersOne']);
    $reportDutiesOne = json_encode($_POST['reportDutiesOne']);
    $reportOutcomesOne = json_encode($_POST['reportOutcomesOne']);

    $reportTeacherTwo = $_POST['reportTeacherTwo'];
    if($reportTeacherTwo != ""){
        $reportTeacherTwo = json_encode($_POST['reportTeacherTwo']);
    }else{
        $reportTeacherTwo = "";
    }
    
    $reportTeachersTwo = $_POST['reportTeachersTwo'];
    if($reportTeachersTwo != ""){
        $reportTeachersTwo = json_encode($_POST['reportTeachersTwo']);
    }else{
        $reportTeachersTwo = "";
    }

    $reportDutiesTwo = $_POST['reportDutiesTwo'];
    if($reportDutiesTwo != ""){
        $reportDutiesTwo = json_encode($_POST['reportDutiesTwo']);
    }else{
        $reportDutiesTwo = "";
    }

    $reportOutcomesTwo = $_POST['reportOutcomesTwo'];
    if($reportOutcomesTwo != ""){
        $reportOutcomesTwo = json_encode($_POST['reportOutcomesTwo']);
    }else{
        $reportOutcomesTwo = "";
    }

    $reportEvaluateDate = json_encode($_POST['reportEvaluateDate']);
    $reportTaskAssignments = json_encode($_POST['reportTaskAssignments']);

    $reportTests = $_POST['reportTests'];
    if($reportTests != ""){
        $reportTests = json_encode($_POST['reportTests']);
    }else{
        $reportTests = "";
    }

    $title = 'Name: '.$reportStudentName.', Area: '.$reportArea.', Date: '.$creationDate;

    $data = array(
        'ID_pupil'=>$studentID,
        'pupil_name'=>$reportStudentName,
        'class'=>$$reportClassName,
        'title'=>$title,
        'strengths'=>$reportStrengths,
        'difficulties'=>$reportDifficulties,
        'support_1'=>$reportSupportOne,
        'support_2'=>$reportSupportTwo,
        'teachers'=>$reportTeachers,
        'area'=>$reportArea,
        'tests'=>$reportTests,
        'task_assignments'=>$reportTaskAssignments,
        'goals_1'=>$reportGoals,
        'goals_2'=>$reportGoalsb,
        'actions_1'=>$reportActions,
        'actions_2'=>$reportActionsb,
        'compensations'=>$reportCompensations,
        'teacher_1'=>$reportTeacherOne,
        'members_1'=>$reportTeachersOne,
        'duties_1'=>$reportDutiesOne,
        'outcomes_1'=>$reportOutcomesOne,
        'teacher_2'=>$reportTeacherTwo,
        'members_2'=>$reportTeachersTwo,
        'duties_2'=>$reportDutiesTwo,
        'outcomes_2'=>$reportOutcomesTwo,
        'evaluation_date'=>$reportEvaluateDate,
        'created_at'=>$creationDate,
        'created_by'=>$createdBy
    );

    // print_r($data);

    $crudObj->insert("vd_report",$data);
    $response = array(true);
}

?>