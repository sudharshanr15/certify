<?php

namespace Certify\Certify\models;

use PDO;
use PDOException;
use Certify\Certify\core\DatabaseConnection;

class Common{
    protected $table = "";
    protected $db = null;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->db = $this->db->conn;
    }

    public function getAllCount(){
        $query = "SELECT count(*) as count from $this->table";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getAll(){
        $query = "SELECT * FROM $this->table";
        $result = $this->db->prepare($query);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function get($id){
        $query = "SELECT * FROM $this->table WHERE id=:id";
        $result = $this->db->prepare($query);
        $result->bindParam(":id", $id);
        $result->execute();
        $rows = $result->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function remove($id){
        try{
            $query = "DELETE FROM $this->table WHERE id=:id";
            $result = $this->db->prepare($query);
            $result->bindParam(":id", $id);
            $result->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }

    public function getFromUserEmail($email){
        $query = "SELECT * FROM $this->table where email=:email";
        $result = $this->db->prepare($query);
        $result->bindParam(":email", $email);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}