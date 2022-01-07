<?php

if(isset($_POST["Login"])){
   $Username = $_POST["Username"];
   $Password = $_POST["password"];

   require_once "db_connect_MySQLi.php";
   require_once "function.php";

   if(EmptyInputsLogin($Username,$Password) !== false ){
    header("location: ../index.php?error=emptyInput");
    exit();
   }
   if(InvalidInputUsername($Password) !== false ){
    header("location: ../index.php?error=invalidInputUsername");
    exit();
   }
   if(InvalidInputPassword($Password) !== false ){
    header("location: ../index.php?error=invalidinputPassword");
    exit();
   }
   /*if(NotMatchInputsLogin($Username,$Password) !== false ){
    header("location: ../index.php?error=DataNotMatch");
    exit();
   }*/
   loginUser($conn,$Username,$Password);
   exit();
}
else{
    //header("location: ../index.php");
}
if(isset($_POST["ForgetEmail"])){
    $Email = $_POST["Username"];

    require_once "db_connect_MySQLi.php";
    require_once "function.php";
 
    if(InvalidInputEmail($Email) !== false ){
        header("location: ../index.php?error=invalidInputEmail");
        exit();
    }
    if(UserExistForgetPass($conn,$Email) ===false){
        header("location: ../index.php?error=UserNotExist");
        exit();
    }
    sendMail($conn, $Email);
    exit();
 }
 else{
    //header("location: ../index.php");
 }