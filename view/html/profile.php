<?php
if(!isset($_SESSION["validate-login"])){
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
}else {
    if($_SESSION["validate-login"] != true){
        echo "<script>window.location = 'index.php?rute=signin'</script>";
        return;
    }
}
?>

<h1>Perfil de Usuario</h1>