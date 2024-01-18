<?php  

class DatabaseConnection {
    
        protected $conn;
        protected $servername;
        protected $username ;
        protected $password ;
        protected $dbname;
         
        public function __construct()
        {  
	        try 
	        {
	           //   $this->conn =  new PDO("mysql:host=localhost;dbname=toursica_booking;charset=utf8", "toursica_booking", "booking@456258@*");
	              $this->conn =  new PDO("mysql:host=localhost;dbname=db_education;charset=utf8", "root", "mysql");

	             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        }
	        catch (Exception $e)
	        {
	             echo "Error: " . $e->getMessage();
	        }
        }
}

?>