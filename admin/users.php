<?php

session_start();
if(!isset($_SESSION['email'])){
    die("Access Restricted");
}

$_SESSION['page_title'] = "Users - Admin";

require_once "./../vendor/autoload.php";

echo (new \Certify\Certify\core\View)->renderAdmin("users.php");