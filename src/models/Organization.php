<?php

namespace Certify\Certify\models;

use PDOException;

class Organization extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->table = "organization";
    }

    public function create($name, $logo){
        try{
            $query = "INSERT INTO $this->table (name, logo) VALUES (:name, :logo)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":logo", $logo);

            $stmt->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }
}