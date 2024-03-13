<?php 
require_once('../controller/crudFunctions.php');
$crudObj = new CrudOparation;

if(isset($_POST['userID']) && $_POST["userID"]!=""){
    $created_by = $_POST['userID'];
    $area = $_POST['area'];
    $id_pupil = $_POST['studentID'];
    $created_at = date("Y-m-d H:i:s");

    $where_student = array('ID_pupil'=>$id_pupil);
    // $get_student = $crudObj->select_record('vd_pupil_code',$where_student,'vd_pupil');
    $get_student = $crudObj->select_record('pupil_name,class',$where_student,'vd_report');
    $student_name = $get_student[0]['pupil_name'];
    $class = $get_student[0]['class'];

    $teachers = json_encode($_POST['teachers']);
    $strengths = json_encode($_POST['strengths']);
    $difficulties = json_encode($_POST['difficulties']);
    $support_1 = json_encode($_POST['support_1']);

    if(isset($_POST['support_2']) && $_POST['support_2'] != ""){
        $support_2 = json_encode($_POST['support_2']);
    }else{
        $support_2 = "";
    }
    $goals_1 = json_encode($_POST['goals_1']);
    if(isset($_POST['goals_2']) && $_POST['goals_2'] != ""){
        $goals_2 = json_encode($_POST['goals_2']);
    }else{
        $goals_2 = "";
    }
    $actions_1 = json_encode($_POST['actions_1']);
    if(isset($_POST['actions_2']) && $_POST['actions_2'] != ""){
        $actions_2 = json_encode($_POST['actions_2']);
    }else{
        $actions_2 = "";
    }
    if(isset($_POST['compensations']) && $_POST['compensations'] != ""){
        $compensations = json_encode($_POST['compensations']);
    }else{
        $compensations = "";
    }
    $teacher_1 = json_encode($_POST['teacher_1']);
    $members_1 = json_encode($_POST['members_1']);
    $duties_1 = json_encode($_POST['duties_1']);
    $outcomes_1 = json_encode($_POST['outcomes_1']);
    if(isset($_POST['teacher_2']) && $_POST['teacher_2'] != ""){
        $teacher_2 = json_encode($_POST['teacher_2']);
        $members_2 = json_encode($_POST['members_2']);
        $duties_2 = json_encode($_POST['duties_2']);
        $outcomes_2 = json_encode($_POST['outcomes_2']);
    }else{
        $teacher_2 = "";
        $members_2 = "";
        $duties_2 = "";
        $outcomes_2 = "";
    }
    
    $evaluation_date = json_encode($_POST['evaluation_date']);
    $task_assignments = json_encode($_POST['taskAssignments']);
    $tests = json_encode($_POST['tests']);

    $title = 'Name: '.$student_name.', Area: '.$area.', Date: '.$created_at;

    $data = array(
        'title'=>$title,
        'ID_pupil'=>$id_pupil,
        'pupil_name'=>$student_name,
        'class'=>$class,
        'strengths'=>$strengths,
        'difficulties'=>$difficulties,
        'support_1'=>$support_1,
        'support_2'=>$support_2,
        'teachers'=>$teachers,
        'task_assignments'=>$task_assignments,
        'goals_1'=>$goals_1,
        'goals_2'=>$goals_2,
        'actions_1'=>$actions_1,
        'actions_2'=>$actions_2,
        'compensations'=>$compensations,
        'teacher_1'=>$teacher_1,
        'members_1'=>$members_1,
        'duties_1'=>$duties_1,
        'outcomes_1'=>$outcomes_1,
        'teacher_2'=>$teacher_2,
        'members_2'=>$members_2,
        'duties_2'=>$duties_2,
        'outcomes_2'=>$outcomes_2,
        'evaluation_date'=>$evaluation_date,
        'created_at'=>$created_at,
        'created_by'=>$created_by,
        'area'=>$area,
        'tests'=>$tests
    );

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