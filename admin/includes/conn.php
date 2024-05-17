<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    try{
        $conn = new PDO("mysql:host=$servername;port=3306; dbname=blogdb", $username,$password); 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

// class Conn{
//    private $servername = "localhost";
//    private $username = "root";
//    private $password = "";
//    private $dbname = "blogdb";
//    private $conn ;
//    public function __construct(){
//       try {
//       $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
//       $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//       }catch(PDOException $e) {
//          echo "Connection failed: " . $e->getMessage();
//       }
//    }
// }
?>