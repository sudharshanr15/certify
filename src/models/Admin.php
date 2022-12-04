<?php

namespace Certify\Certify\models;

use PDO;
use PDOException;

class Admin extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->table = "admin";
    }

    public function create($first_name, $last_name, $email, $password){
        try{
            $query = "INSERT INTO $this->table (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":first_name", $first_name);
            $stmt->bindParam(":last_name", $last_name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
    
            $stmt->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }

    public function getLogin($email){
        $query = "SELECT id, first_name, password, last_name, email FROM $this->table where email=:email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getUser($email){
        $query = "SELECT id, first_name, last_name, email FROM $this->table where email=:email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function __destruct()
    {
        $this->db = null;
    }

    public function update($id, $first_name, $last_name, $email){
        try{
            $query = "UPDATE $this->table SET first_name=:first_name, last_name=:last_name, email=:email WHERE id=:id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":first_name", $first_name);
            $stmt->bindParam(":last_name", $last_name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return ['result' => true];
        }catch(PDOException $e){
            return ['result' => false, "message" => $e->getMessage()];
        }
    }

    public function updatePassword($id, $password){
        try{
            $query = "UPDATE $this->table SET password=:password WHERE id=:id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }

    public function updateAdminStatus($id, $status){
        try{
            $query = "UPDATE $this->table SET is_admin=:status WHERE id=:id";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }
}