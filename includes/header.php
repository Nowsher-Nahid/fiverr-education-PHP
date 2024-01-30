<?php  session_start();
require_once('controller/crudFunctions.php');
$crudObj = new CrudOparation;

$user_id = 4;
$where_user = array('ID'=>$user_id);
$get_user = $crudObj->select_record('vd_user_sex,vd_user_1_name,vd_user_2_name',$where_user,'vd_user');
$full_name = $get_user[0]['vd_user_1_name'].' '.$get_user[0]['vd_user_2_name'];
$user_gender = $get_user[0]['vd_user_sex'];

// if(isset($_SESSION['user_email']) && $_SESSION['user_type']=="Admin") {
// 	$user_id = $_SESSION['user_id'];
// 	$user_fname = $_SESSION['user_fname'];
// 	$user_lname = $_SESSION['user_lname'];
// 	$user_full_name = $user_fname." ".$user_lname;
// 	$user_email = $_SESSION['user_email'];
// 	$user_type = $_SESSION['user_type'];
// 	$user_img = $_SESSION['user_img'];
	
// }else{
//   echo '<script>window.location.href = "index.php";</script>';
// 	exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lernlinie</title>
  <!-- Include Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
  <!-- datatable -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <!-- Sweet alert -->
	<link rel="stylesheet" href="assets/vendor/sweetalert2/sweetalert2.min.css">
  <!-- theme css -->
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>