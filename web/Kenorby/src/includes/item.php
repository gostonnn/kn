<?php
    $pdo = require_once "db_connect_PDO.php";
    require_once "function.php";
    session_start();
    $id = $_GET['id'] ?? null;
    if ($id == null){
        header("location:index.php");
    }
    $item = SelectItem($pdo,$id);
    $imgs = SelectImgs($pdo,$id);

    if(isset($_POST['SendMessage'])) {

        $description = $_POST['mail'] ?? null;

        if(EmptyInput($description) !== false){
            header("location: item.php?id=".$id."error=emptyInput");
            exit(); 
        }        
        foreach ($item as $i => $date) { 
            SendEmail($pdo,$_SESSION["UserId"],$date['SellerId'],$description,$id,$id."_".$_SESSION["UserId"]);
        }
    }
/*
if(isset($_POST['SendMessage'])) {
        
        $description = $_POST['mail'] ?? null;
        $statement = $pdo->prepare("INSERT INTO messages (Incoming, Outgoing, Msg, ItemId,inc)
                VALUES ( :income, :outgoing, :msg ,:id , :in)");
        foreach ($item as $i => $date) { 
            $statement->bindValue(':income', $_SESSION["UserId"]);
            $statement->bindValue(':outgoing', $date['SellerId']);
            $statement->bindValue(':msg', $description);
            $statement->bindValue(':id', $id);
            $statement->bindValue(':in',$id."_".$_SESSION["UserId"]);
        }
        $statement->execute();
    }
*/