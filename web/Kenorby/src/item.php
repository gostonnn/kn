<?php
require_once "includes/item.php";
if($_SESSION["UserName"] == null){
    header("location: index.php"); 
}
$_SESSION["Allow"] = CheckAllow($pdo,$_SESSION["UserName"])["Allow"];
if($_SESSION["Allow"] == 1){
    require_once "includes/logout_mainPage.php";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kenorby</title>
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/item.css">
    </head>
<body>
        <header>
            <div class="logo">
                <div class="logo-container"><span class="lo">Ke</span><span class="go">Norby</span></div>
            </div>
            <div class="menu-btn">
                <div class="menu-btn__burger"></div>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="container-item">
                    <div class="big-image">
                        <?php foreach ($item as $key => $value){?>
                            <img class="bannner-img" src="<?php echo $value["Img"];?>" alt="<?php echo $value["Img"];?>">
                        <?php }?>
                    </div>
                    <div class="images-container-outer">
                        <div class="images-container-inner">
                            <div class="images">
                            <?php foreach ($imgs as $key => $value){?>
                                <img class="other-images" src="<?php echo $value["Img"];?>" alt="<?php echo $value["Img"];?>">
                            <?php }?>
                            </div>
                        </div>
                        <i class='bx bxs-right-arrow'></i>
                    </div>
                </div>
                <div class="container-item-details">
                <?php foreach ($item as $key => $value){?>
                    <div class="seller">
                        <h2>Kapcsolat felv??tel</h2>
                        <div class="seller-details">
                            <div class="name">
                                <p><?php echo $value["UserName"]?></p>
                            </div>
                            <div class="active">
                                <span>Legutolj??ra akt??v:<?php echo $value["Date"]?></span>
                            </div>
                            <div class="phone">
                                <p>Telefonsz??m: <?php echo $value["PhoneNumber"]?></p>
                            </div>
                        </div>
                        <h2>??zenetet ??rok</h2>
                        <div class="text-box">
                            <form action="" method="post">
                            <textarea name="mail" id="mail" value="<?php echo $description ?>"></textarea>
                                <input type="submit" name="SendMessage" value="Elk??ld" class="btn-login">
                            </form>
                        </div>
                    </div>
                <?php }?>
                    <div class="items">
                    <?php foreach ($item as $key => $value){?>
                        <div class="item-infos">
                            <div class="details">
                                <h2>
                                    H??rdet??s neve    
                                </h2>
                                <p><?php echo $value["Title"]?></p>
                            </div>
                        </div>
                        <div class="item-infos">
                            <div class="details">
                                <h2>
                                    Kategoria
                                </h2>
                                <table class="table">
                                    <tbody>
                                      <tr>
                                        <th scope="row">T??pus</th>
                                        <td><?php echo $value["Type"]?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">M??ret</th>
                                        <td><?php echo $value["Size"]?> cm</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Hely</th>
                                        <td><?php echo $value["District"]?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">??llapot</th>
                                        <td><?php echo $value["Conditions"]?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">M??rka</th>
                                        <td><?php echo $value["Brand"]?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                        <div class="item-infos">
                            <div class="details">
                                <h2>
                                    Le??r??s
                                </h2>
                                <p class="text"><?php echo $value["Description"]?></p>
                            </div>
                        </div>
                        <div class="item-infos">
                            <div class="details">
                                <h2>
                                    ??r
                                </h2>
                                <p class="price"><?php echo $value["Price"]?> Ft</p>
                            </div>
                        </div>
                        <div class="item-infos">
                            <div class="details">
                                <h2>
                                    Helysz??n
                                </h2>
                                <iframe src="<?php echo $value["Map"]?>" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    <?php }?>
                    </div>
                </div>
            </div>
            </div>
            <div class="menu">
                <ul class="ul-li">
                <?php 
                if(isset($_SESSION["UserName"])){?>
                    <li><a href="index.php"><?php echo $_SESSION["UserName"] ?></a></li> 
                    <li><a href="watch.php">H??rdet??seim</a></li>
                    <li><a href="upload.php">Felad??s</a></li>
                    <li><a href="message.php">??zenetek</a></li>
                    <li><a href="settings.php">Be??ll??t??sok</a></li>
                    <li><a  href="includes/logout.php">Kil??p??s</a></li>
                <?php }?>
                </ul>
            </div>
        </main>
        <script src="js/item.js"></script>
</body>
</html>