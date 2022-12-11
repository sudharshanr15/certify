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
}