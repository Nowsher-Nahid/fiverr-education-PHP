<?php 
require_once('../controller/crudFunctions.php');
$crudObj = new CrudOparation;

// Insert
if (isset($_POST["action"]) && $_POST["action"]!="") {
	$action = filter_var($_POST["action"], FILTER_SANITIZE_STRING);
	$created_by = $_POST["user_id"];
	$created_at = date("Y-m-d H:i:s");

    $where = array('action'=>$action);
    $isExist = $crudObj->existence($where,"vd_action");

    if($isExist[0] > 0){
        $response = array(false);
    }else{
        $data = array("action" => $action,"created_by" => $created_by,"created_at" => $created_at);
        $crudObj->insert("vd_action",$data);
        $response = array(true);
    }
    echo json_encode($response);
}

// Update
if (isset($_POST['edit_action']) && $_POST["edit_action"]!="" ) {
	$id = $_POST["edit_id"];
	$action = filter_var($_POST["edit_action"], FILTER_SANITIZE_STRING);
	
	$where = array('id' => $id);
	$data = array("action" => $action);
	$crudObj->update_record("vd_action",$where,$data);
	$response = array(true);
	echo json_encode($response);
}

// Delete
if (isset($_POST['action_id'])) {
	$rowNoToDelete = $_POST["action_id"];
	$where = array("id" => $rowNoToDelete);
	$crudObj->delete_record("vd_action",$where);
}


?>