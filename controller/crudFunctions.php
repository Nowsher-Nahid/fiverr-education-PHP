<?php include 'dbConnection.php';
require_once('inc/class.phpmailer.php');
$dbObj=new DatabaseConnection;
 


class CrudOparation extends DatabaseConnection {

//Insert Data into database table... starts....
  public function insert($table,$data){
     global $conn;
     ksort ($data);
     $fieldNames = '`'.implode('`, `', array_keys($data)).'`';
     $fieldvalues = "'".implode("','", array_values($data))."'";
     
     $sql = 'INSERT INTO '.$table.' ('.$fieldNames.') VALUES('.$fieldvalues.')';

     $statement = $this->conn->prepare($sql);
     $statement->execute(); 
     return 'true';        
 }

 
//Select Perticular or All data from database table....starts

public function select_record($tblfld,$where,$table){
    $sql = "";
    $condition = "";
    foreach ($where as $key => $value) {
        // id = '5' AND m_name = 'something'
        $condition .= $key . "='" . $value . "' AND ";
    }
    $condition = substr($condition, 0, -5);
    $sql .= "SELECT ".$tblfld." FROM ".$table." WHERE ".$condition;
        //print_r($sql);
    $smt = $this->conn->prepare($sql);
    $smt->execute();
    return $smt->fetchAll();
}
//Select Perticular or All data from database table....ends

//Fetch All record start

public function fetch_all_record($field,$table){
    $sql = "SELECT ".$field." FROM ".$table;
                //echo $sql;
    
    $smt = $this->conn->prepare($sql);
    $smt->execute();
    
    $smt->setFetchMode(PDO::FETCH_ASSOC);
    
    $row = $smt->fetchALL();
    return $row;
}


public function select_record_by_assoc($tblfld,$where,$table){
    $sql = "";
    $condition = "";
    foreach ($where as $key => $value) {
        // id = '5' AND m_name = 'something'
        $condition .= $key . "='" . $value . "' AND ";
    }
    $condition = substr($condition, 0, -5);
    $sql .= "SELECT ".$tblfld." FROM ".$table." WHERE ".$condition;

    $smt = $this->conn->prepare($sql);
    $smt->execute();
    $smt->setFetchMode(PDO::FETCH_ASSOC);
    $row = $smt->fetchALL();
    return $row;
}

//Update existing data table...starts...

public function update_record($table,$where,$fields){                
    $sql = "";
    $condition = "";
    foreach ($where as $key => $value) {
                // id = '5' AND m_name = 'something'
        $condition .= $key . " = '" . $value . "' AND ";
    }
    $condition = substr($condition, 0, -5);
    foreach ($fields as $key => $value) {
                //UPDATE table SET m_name = '' , qty = '' WHERE id = '';
        $sql .= $key . " = '".$value."', ";
    }
    $sql = substr($sql, 0,-2);
    $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
                // echo $sql;
    $smt = $this->conn->prepare($sql);
    if($smt->execute()){
        return true;
    }
}


public function existence($where,$table){
    $sql = "";
    $condition = "";
    foreach ($where as $key => $value) {
        
        $condition .= $key . "='" . $value . "' AND ";
    }
    $condition = substr($condition, 0, -5);
    $sql .= "SELECT COUNT(1) FROM ".$table." WHERE ".$condition;
    
    $smt = $this->conn->prepare($sql);
    $smt->execute();
    return $smt->fetch();
}



public function delete_record($table,$where){
    $sql = "";
    $condition = "";
    foreach ($where as $key => $value) {
        $condition .= $key . "='" . $value . "' AND ";
    }
    $condition = substr($condition, 0, -5);
    $sql = "DELETE FROM ".$table." WHERE ".$condition;
    $smt = $this->conn->prepare($sql);
    if($smt->execute()){
        return true;
    }
}




public function countRows($table){

    $sql = "SELECT COUNT(*) FROM ".$table.";";
    $smt = $this->conn->prepare($sql);
    $smt->execute();
            /*$row = $smt->fetchAll(PDO::FETCH_ASSOC);
            return $sum = $row[0]["total"];*/
            return $number_of_rows = $smt->fetchColumn();

        }


        public function DateExistence($date,$table){
            
            $sql = "SELECT COUNT(1) FROM ".$table." WHERE DATE(date) ='".$date."'";
                     //echo $sql;
            $smt = $this->conn->prepare($sql);
            $smt->execute();
            return $smt->fetch();
        }
        
        
        
        public function ResetData($table){
          
            $sql = "Truncate table ".$table;
            echo $sql;
            $smt = $this->conn->prepare($sql);
            $smt->execute();
            return true;
            
        }
        
        

        public function resetTableIDsSerial($table,$id){

            $sql = "SET @num := 0;
            UPDATE ".$table." SET ".$id." = @num := (@num+1);
            ALTER TABLE ".$table." AUTO_INCREMENT = 1;";
            //echo $sql ;
            $smt = $this->conn->prepare($sql);
            $smt->execute();
            //$row = $smt->fetchAll(PDO::FETCH_ASSOC);
            
        }
        
        
        
        

        public function dynamic_query($query){

            $smt =$this->conn->prepare($query);
            $smt->execute();
            $result =  $smt->fetchAll();
            return $result;

        }

        public function dynamic_query_by_assoc($query){

            $smt =$this->conn->prepare($query);
            $smt->execute();
            $result =  $smt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }

        public function send_mail($receiverName,$receiverEmail,$subject,$messagebody,$replTo="",$replyToName="",$filename=""){
          
            $host = "mail.dstudio.asia";
            $username= "career@dstudio.asia";
            $password=  "career@456258@*";
            $port="587";
            
            $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->IsSMTP(); // telling the class to use SMTP

            try {
                
            //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)

            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            //$mail->SMTPSecure   = "ssl";                  // enable SMTP authentication

            $mail->Host       = $host;  // sets the SMTP server

            $mail->Port       = $port;                    // set the SMTP port for the GMAIL server

            $mail->Username   = $username ; // SMTP account username

            $mail->Password   = $password;        // SMTP account password

            $mail->AddReplyTo($replTo,$replyToName);

            $mail->AddAddress($receiverEmail,$receiverName);

            $mail->SetFrom($username, $replyToName);

            $mail->Subject = $subject;

            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically

            $message = $messagebody; //"Sender Name : ".$receiverName."<br>Email :".$receiverEmail."<br><br>Message : ".$messagebody."<br>"."";
            
            $mail->MsgHTML($message);

            $mail->Send();

            } catch (phpmailerException $e) {
                echo $e->errorMessage(); //Pretty error messages from PHPMailer
    
            } catch (Exception $e) {
    
                echo $e->getMessage(); //Boring error messages from anything else!
    
            }
            
    
        }

    
    
}
    ?>