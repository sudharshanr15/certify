<?php

use Certify\Certify\models\Admin;

$id = $_GET['id'] ?? null;

if(!$id){
    die("Invalid argument");
}

$admin = new Admin();
$result = $admin->remove($id);
if($result['result']){
    header("Location: /admin/users/");
}else{
    die("Unable to delete user");
}