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
                <li>
                    <form method="post" action="">
                        <input type="submit" name="create100products" id="create100products" value="Ejecutar">
                        <label for="create100products">Crear 100 productos</label>
                    </form>

                    <?php
                    // Verifica si se ha hecho clic en el botón
                    if (isset($_POST['create100products'])) {
                        $generate100products = TestCase::ctrCreate100Products();
                        if ($generate100products) {
                            echo "Código PHP ejecutado correctamente";
                        } else {
                            echo "Hubo un error";
                        }
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</section>