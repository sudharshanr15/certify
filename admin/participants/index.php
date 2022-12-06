<?php

session_start();

if(!isset($_SESSION['email'])){
    die("Access Restricted");
}

$_SESSION['page_title'] = "Participants - Admin";
$_SESSION['sub_menu_title'] = "participants - view";

require_once "../../vendor/autoload.php";
echo (new \Certify\Certify\core\View)->renderAdmin("participants/index.php");