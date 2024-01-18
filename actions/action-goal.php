<?php 
require_once('../controller/crudFunctions.php');
$crudObj = new CrudOparation;

// Insert
if (isset($_POST["goal"]) && $_POST["goal"]!="") {
	$goal = filter_var($_POST["goal"], FILTER_SANITIZE_STRING);

    $where = array('goal'=>$goal);
    $isExist = $crudObj->existence($where,"vd_goal");

    if($isExist[0] > 0){
        $response = array(false);
    }else{
        $data = array("goal" => $goal);
        $crudObj->insert("vd_goal",$data);
        $response = array(true);
    }
    echo json_encode($response);
}

// Update
if (isset($_POST['edit_goal']) && $_POST["edit_goal"]!="" ) {
	$id = $_POST["edit_id"];
	$goal = filter_var($_POST["edit_goal"], FILTER_SANITIZE_STRING);
	
	$where = array('id' => $id);
	$data = array("goal" => $goal);
	$crudObj->update_record("vd_goal",$where,$data);
	$response = array(true);
	echo json_encode($response);
}

// Delete
if (isset($_POST['goal_id'])) {
	$rowNoToDelete = $_POST["goal_id"];
	$where = array("id" => $rowNoToDelete);
	$crudObj->delete_record("vd_goal",$where);
}


?>