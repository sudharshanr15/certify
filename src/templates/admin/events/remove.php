<?php

use Certify\Certify\models\Competition;

$id = $_GET['id'] ?? null;

if(!$id){
    die("Invalid arguments");
}

$events = new Competition;
$result = $events->remove($id);

if($result['result']){
    header("Location: /admin/events/");
}else{
    die("Unable to delete event");
}