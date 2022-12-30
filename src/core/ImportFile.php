<?php

namespace Certify\Certify\core;

use Certify\Certify\models\Participants;

class ImportFile{
    public $participants_target = __DIR__ . "/../../assets/uploads/participants.csv";

    public function import_participants_csv(){
        $participants = new Participants;
        $file = fopen($this->participants_target, "r");
        $i = 0;
        $keys = [];
        $ids = [];
        while(!feof($file)){
            $res = fgetcsv($file);
            if($i == 0){
                $i++;
                foreach($res as $k){
                    $keys[] = strtolower($k);
                }
                continue;
            }
            $data = array_combine($keys, $res);
            $already_exists = $participants->getFromUserEmail($data['student email']);
            if(count($already_exists) > 0){
                continue;
            }
            $is_winner = $data['winner of the event?'] == "Yes" ? 1 : 0;
            $place_secured = $is_winner ? (empty($data['place secured']) ? 3 : $data['place secured']) : 0;
            $result = $participants->create($data['first name'], $data['last name'], $data['student email'], $data['degree'], $data['organization'], $data['event'], $is_winner, $place_secured);
            if($result['result'] == false){
                fclose($file);
                die("Unable to import data");
            }
            $ids[] = $result['id'];
        }
        fclose($file);

        return $ids;
    }
}