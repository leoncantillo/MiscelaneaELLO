<?php

$deleteProduct = FormsController::ctrDeleteProducts();
if ($deleteProduct) {
    echo "<script>
        alert('El producto ha sido eliminado.');
        window.location = 'index.php?rute=manage';
    </script>";
} else {
    echo "<script>
        alert('Hubo un error, intentelo nuevamente');
        window.location = 'index.php?rute=manage';
    </script>";
}

?>