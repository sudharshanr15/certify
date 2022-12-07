<?php

namespace Certify\Certify\models;

use PDOException;

class Competition extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->table = "competition";
    }

    public function create($competition, $organization, $year, $image=""){
        try{
            $query = "INSERT INTO $this->table (organization, competition, image, year) VALUES (:organization, :competition, :image, :year)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":organization", $organization);
            $stmt->bindParam(":competition", $competition);
            $stmt->bindParam(":image", $image);
            $stmt->bindParam(":year", $year);

            $stmt->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }
}