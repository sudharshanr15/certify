<?php

use Certify\Certify\models\Participants;

$id = $_GET['id'] ?? null;

if(!$id){
    die("Invalid arguments");
}

$participant = new Participants;
$result = $participant->remove($id);

if($result['result']){
    header("Location: /admin/participants/");
}else{
    die("Unable to delete participants");
}