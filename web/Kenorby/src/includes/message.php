<?php
$pdo = require_once "db_connect_PDO.php";
require_once "function.php";
session_start();

$items = SelectItemsMes($pdo,$_SESSION["UserId"]);

if(isset($_GET['show'])) {
  
    $Incoming = $_GET['Incoming'] ?? null;
    $inc = $_GET['inc'] ?? null;
    $id =  $_GET['id'] ?? null;
    $sellerId =  $_GET['SellerId'] ?? null;
    $_SESSION['Id'] = $id;
    $_SESSION['inc']= $inc;
    $_SESSION['SellerId'] = $sellerId;
    $_SESSION['Incoming'] = $Incoming;
    
    $messages = SelectMassage($pdo,$id,$_SESSION["UserId"],$inc);
}

