<?php 
require_once('../controller/crudFunctions.php');
$crudObj = new CrudOparation;

if(isset($_POST['userID']) && $_POST["userID"]!=""){
    $created_by = $_POST['userID'];
    $area = $_POST['area'];
    $id_pupil = $_POST['studentID'];
    $created_at = date("Y-m-d H:i:s");

    $where_student = array('ID_pupil'=>$id_pupil);
    $get_student = $crudObj->select_record('vd_pupil_code',$where_student,'vd_pupil');
    $student_name = $get_student[0]['vd_pupil_code'];

    $teachers = json_encode($_POST['teachers']);
    $goals = json_encode($_POST['goals']);
    $actions = json_encode($_POST['actions']);
    $outcomes = json_encode($_POST['outcomes']);
    $task_assignments = json_encode($_POST['taskAssignments']);

    $title = 'Name: '.$student_name.', Area: '.$area.', Date: '.$created_at;

    $data = array('ID_pupil'=>$id_pupil,'title'=>$title,'teachers'=>$teachers,'task_assignments'=>$task_assignments,'goals'=>$goals,'actions'=>$actions,'outcomes'=>$outcomes,'created_at'=>$created_at,'created_by'=>$created_by,'area'=>$area);

    $crudObj->insert("vd_report",$data);
    $response = array(true);

}

?>