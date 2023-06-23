<?php if(isset($_GET["rute"])): ?>
    <!-- HOME -->
    <?php if($_GET["rute"] == "home"): ?>
        <li><a class="active" href="index.php?rute=home">Inicio</a></li>
    <?php else: ?>
        <li><a href="index.php?rute=home">Inicio</a></li>
    <?php endif ?>

    <!-- SHOP -->
    <?php if($_GET["rute"] == "shop"): ?>
        <li><a class="active" href="index.php?rute=shop">Tienda</a></li>
    <?php else: ?>
        <li><a href="index.php?rute=shop">Tienda</a></li>
    <?php endif ?>

    <!-- ABOUT US -->
    <?php if($_GET["rute"] == "about-us"): ?>
        <li><a class="active" href="index.php?rute=about-us">Nosotros</a></li>
    <?php else: ?>
        <li><a href="index.php?rute=about-us">Nosotros</a></li>
    <?php endif ?>

    <!-- CONTACT -->
    <?php if($_GET["rute"] == "contact"): ?>
        <li><a class="active" href="index.php?rute=contact">Contacto</a></li>
    <?php else: ?>
        <li><a href="index.php?rute=contact">Contacto</a></li>
    <?php endif ?>

<?php else:?>

    <li><a href="index.php?rute=home">Inicio</a></li>
    <li><a href="index.php?rute=shop">Tienda</a></li>
    <li><a href="index.php?rute=about_us">Nosotros</a></li>
    <li><a href="index.php?rute=contact">Contacto</a></li>

<?php endif ?>