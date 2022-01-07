<?php

if(isset($_POST["Regist"])){
   $Username = $_POST["Username"];
   $Password = $_POST["Password"];
   $Email = $_POST["Email"];
   require_once "db_connect_MySQLi.php";
   require_once "function.php";

   if(EmptyInputsRegist($Username,$Password,$Email) !== false ){
    header("location: ../index.php?error=emptyInput");
    exit();
   }
   if(InvalidInputUsername($Username) !== false ){
    header("location: ../index.php?error=invalidInputUsername");
    exit();
   }
   if(InvalidInputPassword($Password) !== false ){
    header("location: ../index.php?error=invalidInputPassword");
    exit();
   }
   if(InvalidInputEmail($Email) !== false ){
    header("location: ../index.php?error=invalidInputEmail");
    exit();
   }
   if(NotLongEnough($Username,$Password) !== false ){
    header("location: ../index.php?error=notLongEnough");
    exit();
   }
   if(UserExist($conn,$Username,$Email) !== false ){
    header("location: ../index.php?error=UserExist");
    exit();
   }
   createUser($conn,$Username,$Password,$Email);
   addSettings($conn,$Email);
}
else{
    header("location: ../index.php");
}