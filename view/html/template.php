<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="view/css/reset.css">
    <link rel="stylesheet" href="view/css/header.css">
    <link rel="stylesheet" href="view/css/footer.css">
</head>
<body>
    <section class="dinamic-contain">
        <?php
            if (isset($_GET["rute"])) {
                if ($_GET["rute"] == "home" ||
                    $_GET["rute"] == "shop" ||
                    $_GET["rute"] == "about-us" ||
                    $_GET["rute"] == "contact") {
                    
                    include "view/html/header.php";
                    include "view/html/".$_GET["rute"].".php";
                    include "view/html/footer.php";

                }elseif ($_GET["rute"] == "signin" ||
                         $_GET["rute"] == "signup"){
                            
                    include "view/html/".$_GET["rute"].".php";

                }else {
                    include "view/html/404.php";
                }
            } else {
                include "view/html/header.php";
                include "view/html/home.php";
                include "view/html/footer.php";
            }
        ?>
    </section>
</body>
</html>