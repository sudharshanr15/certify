<?php

namespace Certify\Certify\models;

use PDOException;
use PDO;
class Competition extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->table = "competition";
    }

    public function create($organization, $competition, $image, $year){
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

    public function getFromCompetition($name){
        $query = "SELECT * FROM $this->table WHERE competition=:competition";
        $result = $this->db->prepare($query);
        $result->bindParam(":competition", $name);
        $result->execute();
        $rows = $result->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }
}