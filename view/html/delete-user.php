<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $deleteUser = UserController::ctrDeleteuser($id);

        if ($deleteUser) {
            echo "<script>
                alert('El Usuario ha sido eliminado.');
                window.location = 'index.php?rute=manage';
            </script>";
        } else {
            echo "<script>
                alert('Hubo un error, intentelo nuevamente');
                window.location = 'index.php?rute=manage';
            </script>";
        }
    }
}
?>