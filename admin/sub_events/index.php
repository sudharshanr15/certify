<?php

session_start();

if(!isset($_SESSION['email'])){
    die("Access Restricted");
}

$_SESSION['page_title'] = "Sub Events - Admin";
$_SESSION['sub_menu_title'] = "sub events - view";

require_once "../../vendor/autoload.php";
echo (new \Certify\Certify\core\View)->renderAdmin("sub_events/index.php");