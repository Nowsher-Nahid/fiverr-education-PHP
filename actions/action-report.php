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

?>