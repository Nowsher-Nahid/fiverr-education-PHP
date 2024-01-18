<?php 
require_once('../controller/crudFunctions.php');
$crudObj = new CrudOparation;

if (isset($_POST['selectedClass']) && $_POST["selectedClass"]!="" ) {
    $class = $_POST['selectedClass'];
    $get_students = $crudObj->dynamic_query('SELECT vd_pupil.vd_pupil_code,vd_pupil.ID_pupil FROM vd_pupil JOIN vd_class_cont ON vd_pupil.ID_pupil = vd_class_cont.ID_pupil WHERE vd_class_cont.ID_class='.$class.' ');

    $student_str = '<option value="">Select student</option>';

    foreach($get_students as $student){
        $student_id = $student['ID_pupil'];
        $student_code = $student['vd_pupil_code'];
        $student_str .= '<option value='.$student_id.'>'.$student_code.'</option>';
    }

    echo $student_str;
}

?>