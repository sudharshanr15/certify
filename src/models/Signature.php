<?php

namespace Certify\Certify\models;

use PDO;
use PDOException;

class Signature extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->table = "signature";
    }

    public function add($name, $image){
        try{
            $query = "INSERT INTO $this->table (name, image) VALUES (:name, :image)";
            $result = $this->db->prepare($query);
            $result->bindParam(":name", $name);
            $result->bindParam(":image", $image);
            $result->execute();
            
            return ["result" => true];
        }catch(PDOException $e){
            return ["result" => false, "message" => $e->getMessage()];
        }
    }

    public function update($name, $image, $id){
        try{
            $query = "UPDATE $this->table SET name=:name, image=:image where id=:id";
            $result = $this->db->prepare($query);
            $result->bindParam(":name", $name);
            $result->bindParam(":image", $image);
            $result->bindParam(":id", $id);

            $result->execute();

            return ['result' => true];
        }catch(PDOException $e){
            return ['result' => false, "message" => $e->getMessage()];
        }
    }

    public function getByName($name){
        $query = "SELECT * from $this->table where name=:name";
        $result = $this->db->prepare($query);
        $result->bindParam(":name", $name);

        $result->execute();

        $rows = $result->fetch(PDO::FETCH_ASSOC);

        return $rows;
    }
}