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
    $reportArea = $_POST['reportArea'];
    $creationDate = date("Y-m-d H:i:s");
    $createdBy = $_POST['reportUserID'];

    $reportTeachers = json_encode($_POST['reportTeachers']);
    $reportGoals = json_encode($_POST['reportGoals']);
    $reportActions = json_encode($_POST['reportActions']);
    $reportOutcomes = json_encode($_POST['reportOutcomes']);
    $reportTaskAssignments = json_encode($_POST['reportTaskAssignments']);

    $title = 'Name: '.$reportStudentName.', Area: '.$reportArea.', Date: '.$creationDate;

    $data = array('ID_pupil'=>$studentID,'title'=>$title,'teachers'=>$reportTeachers,'task_assignments'=>$reportTaskAssignments,'goals'=>$reportGoals,'actions'=>$reportActions,'outcomes'=>$reportOutcomes,'created_at'=>$creationDate,'created_by'=>$createdBy,'area'=>$reportArea);

    $crudObj->insert("vd_report",$data);
    $response = array(true);

}

?>