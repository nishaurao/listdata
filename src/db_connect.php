<?php
     /*function getdb()
     {
        $servername = "mysql";
        $username = "username";
        $password = "password";
        $db = "myDatabase";
     try {
             $conn = mysqli_connect($servername, $username, $password, $db);
             //echo "Connected successfully"; 
         }
     catch(exception $e)
         {
           echo "Connection failed: " . $e->getMessage();
         }
         return $conn;
    }*/
?>

<?php

 define('DB_HOST', 'mysql');
 define('DB_USER', 'username');
 define('DB_PASSWORD', 'password');
 define('DB_DATABASE', 'myDatabase');



 class DatabaseConnection
 {
     public function __construct()
         {
         $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

         if ($conn->connect_error) {
            die("<h1>Database Connection Failed</h1>");
         }
         $this->conn = $conn;
     }   

     public function getConnection()
     {
         return $this->conn;
     }
}


?>
 
