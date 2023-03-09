<?php

use Certify\Certify\models\Organization;

$id = $_GET['id'] ?? null;

if(!$id){
    die("Invalid arguments");
}
$org = new Organization;
$result = $org->remove($id);

if($result['result']){
    header("Location: /admin/organization/");
}else{
    die("Unable to delete organization");
}