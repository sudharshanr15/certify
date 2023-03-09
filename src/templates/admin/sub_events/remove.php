<?php

use Certify\Certify\models\Subevents;

$id = $_GET['id'] ?? null;

if(!$id){
    die("Invalid arguments");
}
$competition_obj = new Subevents;
$result = $competition_obj->remove($id);

if($result['result']){
    header("Location: /admin/sub_events/");
}else{
    die("Unable to delete sub event");
}