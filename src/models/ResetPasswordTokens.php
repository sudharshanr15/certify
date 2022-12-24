<?php

namespace Certify\Certify\models;

use Certify\Certify\models\Common;
use PDO;
use PDOException;

class ResetPasswordTokens extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->table = "reset_password_tokens";
    }

    public function verifyUserToken($user_id, $token){
        $query = "SELECT * FROM $this->table WHERE user_id=:user_id and token=:token";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function removeUserToken($user_id){
        try{
            $query = "DELETE FROM $this->table WHERE user_id=:user_id";
            $result = $this->db->prepare($query);
            $result->bindParam(":user_id", $user_id);
            $result->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }

    public function updateToken($user_id, $token){
        try{
            $query = "UPDATE $this->table SET token=:token WHERE user_id=:user_id";
            $result = $this->db->prepare($query);
            $result->bindParam(":token", $token);
            $result->bindParam(":user_id", $user_id);
            $result->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }

    public function insert($user_id, $token){
        try{
            $query = "INSERT INTO $this->table (user_id, token) VALUES (:user_id, :token)";
            $result = $this->db->prepare($query);
            $result->bindParam(":token", $token);
            $result->bindParam(":user_id", $user_id);
            $result->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }

    public function getUserToken($user_id){
        $query = "SELECT * FROM $this->table WHERE user_id=:user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}