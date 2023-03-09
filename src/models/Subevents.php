<?php

namespace Certify\Certify\models;

use PDOException;

class Subevents extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->table = "sub_events";
    }

    public function create($name, $competition, $logo){
        try{
            $query = "INSERT INTO $this->table (name, competition, logo) VALUES (:name, :competition, :logo)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":competition", $competition);
            $stmt->bindParam(":logo", $logo);

            $stmt->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }
}