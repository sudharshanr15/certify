<?php

namespace Certify\Certify\core;

use PDOException;
use PDO;

class DatabaseConnection{
    private $servername = "localhost";
    private $username = "root";
    private $password = "dharshan";

    public $conn = null;

    public function __construct(){
        try{
            $this->conn = new PDO("mysql:host=". $this->servername .";dbname=certify", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            $this->conn = $e->getMessage();
        }
    }
}
