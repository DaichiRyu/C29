<?php
$conn = null;
try {
    $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $conn = new PDO("mysql:host=mysql208.phy.lolipop.lan;dbname=LAA1445592-pro4;charset=utf8;","LAA1445592","UrVcXdC5zQJP",$option);
} catch (PDOException $e) {
    die($e->getMessage());
}