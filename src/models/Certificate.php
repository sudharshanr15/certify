<?php

namespace Certify\Certify\models;

use PDO;
use PDOException;

class Certificate extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->table = "certificate";
    }

    public function create($user_id, $certificate){
        try{
            $query = "INSERT INTO $this->table (user_id, certificate) VALUES(:user_id, :certificate)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":certificate", $certificate);
            
            $stmt->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }

    public function update($user_id, $certificate){
        try{
            $query = "UPDATE $this->table SET certificate=:certificate WHERE user_id=:user_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":certificate", $certificate);
            
            $stmt->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }

    public function getFromUserID($user_id){
        $query = "SELECT * FROM $this->table WHERE user_id=:user_id";
        $result = $this->db->prepare($query);
        $result->bindParam(":user_id", $user_id);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}