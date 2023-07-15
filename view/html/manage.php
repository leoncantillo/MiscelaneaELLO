<?php

if (!isset($_SESSION["validate-login"]) || !isset($_SESSION["validate-useradmin"])) {
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
} else if ($_SESSION["validate-login"] != true || $_SESSION["validate-useradmin"] != true) {
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
}

?>

<link rel="stylesheet" href="view/css/manage.css">
<title>Administrador</title>

<section>
    <div class="container">
        <h4>Administrador</h4>
        <div class="admin-actions">
            <ul>
                <li>
                    <a href="index.php?rute=manage-products">
                        <i class="fa-solid fa-wrench"></i> Administrar Productos
                    </a>
                </li>
                <li>
                    <a href="index.php?rute=manage-users">
                        <i class="fa-solid fa-wrench"></i> Administrar Usuarios
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>