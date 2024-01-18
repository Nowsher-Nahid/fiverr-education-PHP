<?php 
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost', 
    'user' => 'root', 
    'pass' => 'mysql', 
    'db'   => 'db_education' 
); 
 
// DB table to use 
$table = 'vd_task'; 
 
// Table's primary key 
$primaryKey = 'id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'id',  'dt' => 0 ), 
    array( 'db' => 'task',  'dt' => 1 ), 
    array( 
        'dt'        => 2, 
        'formatter' => function($row) { 
            return "<button class='btn btn-sm btn-primary'><i class='fas fa-edit'></i></button><button onclick='delete_row(".$row[0].")' class='btn btn-sm btn-danger ls-ml-10 m-ml-5'><i class='fas fa-trash'></i></button>"; 
        } 
    ) 
); 
 
// Include SQL query processing class 
require '../assets/vendor/ssp.class.php';

// var_dump();
   
// Output data as json format 
echo json_encode( 
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
);