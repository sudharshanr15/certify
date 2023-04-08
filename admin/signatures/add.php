<?php

session_start();

if(!isset($_SESSION['email'])){
    die("Access Restricted");
}

$_SESSION['page_title'] = "Signatures - Admin";
$_SESSION['sub_menu_title'] = "signatures - add";

require_once "../../vendor/autoload.php";
echo (new \Certify\Certify\core\View)->renderAdmin("signatures/add.php");