<?php 
require_once('../controller/crudFunctions.php');
$crudObj = new CrudOparation;

if (isset($_POST['selectedClass']) && $_POST["selectedClass"]!="") {
    $class = $_POST['selectedClass'];
    $get_students = $crudObj->dynamic_query('SELECT vd_pupil.vd_pupil_code,vd_pupil.ID_pupil,vd_pupil.vd_pupil_sex FROM vd_pupil JOIN vd_class_cont ON vd_pupil.ID_pupil = vd_class_cont.ID_pupil WHERE vd_class_cont.ID_class='.$class.' ');

    $student_str = '<option value="">Select student</option>';

    foreach($get_students as $student){
        $student_id = $student['ID_pupil'].'#'.$student['vd_pupil_sex'];
        $student_code = $student['vd_pupil_code'];
        $student_str .= '<option value='.$student_id.'>'.$student_code.'</option>';
    }

    echo $student_str;
}

if(isset($_POST['selectedStudent']) && $_POST["selectedStudent"]!="" ){
    $studentID_and_gender = explode("#",$_POST['selectedStudent']);
    $studentID = $studentID_and_gender[0];
    $studentGender = $studentID_and_gender[1];
    $get_areas = $crudObj->dynamic_query('SELECT vd_test_idx_fb,vd_test_idx_file FROM vd_test_idx');
    $dataTableRow = '';
    $counter = 0;
    foreach($get_areas as $data){
        $area = $data['vd_test_idx_fb'];
        $prefix = $data['vd_test_idx_file'];
        $table = 'vd_tb_'.$prefix;

        $where = array('ID_pupil'=>$studentID);
        $isStudentExist = $crudObj->existence($where, $table);
        if($isStudentExist[0] > 0){
            $columnPrefix = substr($prefix, 0, 2);
            $columnName = $columnPrefix.'_tst_gw';
            $get_marks = $crudObj->dynamic_query('SELECT '.$columnName.' FROM '.$table.' WHERE ID_pupil = "'.$studentID.'" ');
            $mark = $get_marks[0][0];
            $dataTableRow .= '<tr><td>'.$area.'</td><td>'.$mark.'</td></tr>';
        }
    }
    echo $studentGender.'#'.$dataTableRow;
}

?>