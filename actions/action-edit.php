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
    $tests = json_encode($_POST['tests']);

    $title = 'Name: '.$student_name.', Area: '.$area.', Date: '.$created_at;

    $data = array('ID_pupil'=>$id_pupil,'title'=>$title,'teachers'=>$teachers,'task_assignments'=>$task_assignments,'goals'=>$goals,'actions'=>$actions,'outcomes'=>$outcomes,'created_at'=>$created_at,'created_by'=>$created_by,'area'=>$area,'tests'=>$tests);

    $crudObj->insert("vd_report",$data);
    $response = array(true);

}

if (isset($_POST['studentID']) && $_POST["studentID"]!="") {
    // student name and image show on the right top
    $studentID = $_POST['studentID'];
    $where = array('ID_pupil'=>$studentID);
    $get_student = $crudObj->select_record('vd_pupil_code,vd_pupil_sex',$where,'vd_pupil');
    $student_code = $get_student[0]['vd_pupil_code'];
    $student_gender = $get_student[0]['vd_pupil_sex'];

    // show student table
    $get_data = $crudObj->dynamic_query('SELECT vd_test_idx_fb,vd_test_idx_file,vd_test_idx_name FROM vd_test_idx');
    $dataTableRow = '';
    foreach($get_data as $data){
        $area = $data['vd_test_idx_fb'];
        $test = $data['vd_test_idx_name'];
        $prefix = $data['vd_test_idx_file'];
        $table = 'vd_tb_'.$prefix;

        $where = array('ID_pupil'=>$studentID);
        $isStudentExist = $crudObj->existence($where, $table);
        if($isStudentExist[0] > 0){
            $columnPrefix = substr($prefix, 0, 2);
            $columnName = $columnPrefix.'_tst_gw';
            $get_marks = $crudObj->dynamic_query('SELECT '.$columnName.' FROM '.$table.' WHERE ID_pupil = "'.$studentID.'" ');
            $mark = $get_marks[0][0];
            $dataTableRow .= '<tr><td>'.$area.'</td><td>'.$test.'</td><td>'.$mark.'</td></tr>';
        }
    }

    echo $student_code.'#'.$student_gender.'#'.$dataTableRow;
}


?>