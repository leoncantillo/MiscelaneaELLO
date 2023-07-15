<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="view/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="view/css/reset.css">
    <link rel="stylesheet" href="view/css/estilos-globales.css">
</head>
<body>
    <?php
        if (isset($_GET["rute"])) {
            if ($_GET["rute"] == "home" ||
                $_GET["rute"] == "shop" ||
                $_GET["rute"] == "about-us" ||
                $_GET["rute"] == "contact" ||
                $_GET["rute"] == "profile" ||
                $_GET["rute"] == "manage" ||
                $_GET["rute"] == "manage-products" ||
                $_GET["rute"] == "manage-users" ||
                $_GET["rute"] == "create-product" ||
                $_GET["rute"] == "update-product" ||
                $_GET["rute"] == "create-user" ||
                $_GET["rute"] == "update-user") {
                
                include "view/html/header.php";
                include "view/html/".$_GET["rute"].".php";
                include "view/html/footer.php";

            } elseif ($_GET["rute"] == "signin" ||
                      $_GET["rute"] == "signup" ||
                      $_GET["rute"] == "delete-product" ||
                      $_GET["rute"] == "delete-user" ||
                      $_GET["rute"] == "logout"){
                        
                include "view/html/".$_GET["rute"].".php";

            } else {
                include "view/html/404.php";
            }
        } else {
            include "view/html/header.php";
            include "view/html/home.php";
            include "view/html/footer.php";
        }
    ?>
</body>
</html>