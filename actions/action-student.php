<?php 
require_once('../controller/crudFunctions.php');
$crudObj = new CrudOparation;

if (isset($_POST['studentID']) && $_POST["studentID"]!="") {
    $studentID = $_POST['studentID'];
    $area = $_POST['selectedArea'];
    $where = array('ID_pupil'=>$studentID);
    $get_student = $crudObj->select_record('vd_pupil_code',$where,'vd_pupil');
    $student_code = $get_student[0]['vd_pupil_code'];

    $where_area = array('vd_test_idx_fb'=>$area);
    $get_prefixes = $crudObj->select_record('vd_test_idx_file',$where_area,'vd_test_idx');

    $dataOption = '<option value="">Select test data</option>';
    foreach($get_prefixes as $data){
        $prefix = $data['vd_test_idx_file'];
        $table = 'vd_tb_'.$prefix;
        $where = array('ID_pupil'=>$studentID);
        $isStudentExist = $crudObj->existence($where, $table);
        if($isStudentExist[0] > 0){
            $columnPrefix = substr($prefix, 0, 2);
            $columnName = $columnPrefix.'_tst_gw';
            $get_marks = $crudObj->dynamic_query('SELECT '.$columnName.' FROM '.$table.' WHERE ID_pupil = "'.$studentID.'" ');
            $mark = $get_marks[0][0];
            $dataOption .= '<option value='.$mark.'>'.$mark.'</option>';
        }
    }

    echo $student_code.'#'.$dataOption;
}

?>