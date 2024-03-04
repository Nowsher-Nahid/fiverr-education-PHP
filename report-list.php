<?php 
include('includes/header.php');
include('includes/navbar.php');

if(isset($_GET['from_date']) && isset($_GET['to_date'])){
    $from_date = $_GET['from_date'];
    $to_date  = $_GET['to_date'];
}else{
    $from_date = date('Y-m-01');
    $to_date  = date('Y-m-t');
}

$condition = "created_at BETWEEN '$from_date' AND '$to_date'";
$get_reports = $crudObj->dynamic_query('SELECT * FROM vd_report WHERE '.$condition.' ORDER BY id DESC');
?>

<div class="container">

    <div class="row justify-content-center">
	    <div class="col-md-12">
	        <div class="form-container">
                <form method="GET">
                    <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                        <label for="">From date</label>
                        <input type="date" class="form-control" value="<?php echo $from_date ?>" name="from_date" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                        <label for="">To date</label>
                        <input type="date" class="form-control" value="<?php echo $to_date ?>" name="to_date" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block" type="submit" style="margin-top: 30px;">Search</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<div class="row justify-content-center">
	    <div class="col-md-12">
	        <div class="form-container mt-0">
                <h3 class="text-center">Report List</h3>
                <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter = 1;
                            foreach ($get_reports as  $data) {
                                $get_name = $crudObj->dynamic_query("SELECT vd_user_1_name,vd_user_2_name FROM vd_user WHERE ID='".$data['created_by']."' ");
                        ?>
                        <tr>
                            <td><?php echo $counter++ ?></td>
                            <td><?php echo $data['title'] ?></td>
                            <td><?php echo $get_name[0]['vd_user_1_name'].' '.$get_name[0]['vd_user_2_name'] ?></td>
                            <td><?php echo $data['created_at'] ?></td>
                            <td class="d-flex">
                                <form action="edit-data.php" method="post">
                                    <input type="text" name="plan" value="<?php echo $data['title'] ?>" hidden>
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>
                                </form>
                                <a href="pdf.php?id=<?php echo $data['id'] ?>" target="_blank">
                                    <button type="button" class="btn btn-sm btn-primary mx-2"><i class="fas fa-share-square"></i></button>
                                </a>
                                <button class="btn btn-sm btn-info"><i class="fas fa-envelope"></i></button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>
