<?php

namespace Certify\Certify\models;

use PDOException;

class Participants extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->table = "participants";
    }

    public function create($first_name, $last_name, $email, $degree, $organization, $competition, $winner, $place=0){
        try{
            $query = "INSERT INTO $this->table (first_name, last_name, email, degree, organization, competition, winner, place) VALUES (:first_name, :last_name, :email, :degree, :organization, :competition, :winner, :place)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":first_name", $first_name);
            $stmt->bindParam(":last_name", $last_name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":degree", $degree);
            $stmt->bindParam(":organization", $organization);
            $stmt->bindParam(":competition", $competition);
            $stmt->bindParam(":winner", $winner);
            $stmt->bindParam(":place", $place);

            $stmt->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }

    public function update($first_name, $last_name, $email, $degree, $organization, $competition, $winner, $place=0){
        try{
            $query = "UPDATE $this->table SET first_name=:first_name, last_name=:last_name, degree=:degree, organization=:organization, competition=:competition, winner=:winner, place=:place WHERE email=:email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":first_name", $first_name);
            $stmt->bindParam(":last_name", $last_name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":degree", $degree);
            $stmt->bindParam(":organization", $organization);
            $stmt->bindParam(":competition", $competition);
            $stmt->bindParam(":winner", $winner);
            $stmt->bindParam(":place", $place);

            $stmt->execute();

            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }
}