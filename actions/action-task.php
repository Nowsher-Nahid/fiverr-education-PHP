<?php 
require_once('../controller/crudFunctions.php');
$crudObj = new CrudOparation;

// Insert
if (isset($_POST["task"]) && $_POST["task"]!="") {
	$task = filter_var($_POST["task"], FILTER_SANITIZE_STRING);

    $where = array('task'=>$task);
    $isExist = $crudObj->existence($where,"vd_task");

    if($isExist[0] > 0){
        $response = array(false);
    }else{
        $data = array("task" => $task);
        $crudObj->insert("vd_task",$data);
        $response = array(true);
    }
    echo json_encode($response);
}

// Update
if (isset($_POST['edit_task']) && $_POST["edit_task"]!="" ) {
	$id = $_POST["edit_id"];
	$task = filter_var($_POST["edit_task"], FILTER_SANITIZE_STRING);
	
	$where = array('id' => $id);
	$data = array("task" => $task);
	$crudObj->update_record("vd_task",$where,$data);
	$response = array(true);
	echo json_encode($response);
}

// Delete
if (isset($_POST['task_id'])) {
	$rowNoToDelete = $_POST["task_id"];
	$where = array("id" => $rowNoToDelete);
	$crudObj->delete_record("vd_task",$where);
}


?>