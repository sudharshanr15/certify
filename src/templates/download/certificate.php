<?php
$c = $_GET['c'] ?? null;

if(!$c){
    die("Invalid request");
}

$file = __DIR__."/../../../assets/certificates/$c";
$file_size = filesize($file);

header('Content-Disposition: attachment; filename=Certificate.jpeg');
header('Content-Type: application/octet-stream');
header( "Content-length: " . $file_size );
readfile($file);
exit;