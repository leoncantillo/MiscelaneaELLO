<?php

if (!isset($_SESSION["validate-login"]) || !isset($_SESSION["validate-useradmin"])) {
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
} else if ($_SESSION["validate-login"] != true || $_SESSION["validate-useradmin"] != true) {
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
}

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $fetchUsers = FormsController::ctrSelectUsersWithId($id);
    if (!$fetchUsers) {
        echo "<script>window.location = 'index.php?rute=manage'</script>";
        return;
    }
} else {
    echo "<script>window.location = 'index.php?rute=manage'</script>";
    return;
}

$userNameErr = $emailErr = $passwordErr = $isUserAdminErr = ""; # Empty Fields
$phoneNumberErr = $profilePhotoErr = "";
$countError = 0;
$fullFields = true;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["register-username"])) {
        $userNameErr = "El nombre de usuario es obligatorio.";
        $countError += 1;
    }

    if (empty($_POST["register-email"])) {
        $userNameErr = "El nombre de usuario es obligatorio.";
        $countError += 1;
    }

    if (empty($_POST["register-useradmin"])) {
        $isUserAdminErr = "Indique los permisos para este usuario";
        $countError += 1;
    }
    
    if(isset($_FILES["profile-photo"]) && $_FILES["profile-photo"]["error"] === 0){  
        $fileType = $_FILES["profile-photo"]["type"];
        $allowedTypes = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/webp"];
        if(!in_array($fileType, $allowedTypes)){
            $profilePhotoErr = "* Solo se permiten archivos de imagen (JPEG, PNG, GIF, WebP).";
            $countError += 1;
        }
    }

    if (!empty($_POST["phone-number"])) {
        if ($_POST["phone-number"] < 0 || strlen($_POST["phone-number"]) < 7) {
            $phoneNumberErr = "* Ingrese un número de teléfono válido";
            $countError += 1;
        }
    }

    if ($countError > 0) {
        $fullFields = false;
    }

    if ($fullFields) {
        $createProduct = FormsController::ctrUpdateUser();

        if ($createProduct) {
            echo "<script>
                alert('El usuario ha sido actualizado correctamente');
                window.location = 'index.php?rute=manage';
            </script>";
        } else {
            echo "<script> alert('Ha ocurrido un error, intentelo nuevamente') </script>";
        }
    }
}

echo "<script>
    if (window.history.replaceState) {
        window.history.replaceState(null,null,window.location.href);
    }
</script>";

?>

<link rel="stylesheet" href="view/css/forms.css">
<link rel="stylesheet" href="view/css/create-user.css">
<title>Actualizar Usuarios</title>

<div class="create-user-form fieldset">
    <h4>Actualizar Datos Del Usuario</h4>
    <p class="required-field">Requerido *</p>
    <form method="post" id="form-create-user" enctype="multipart/form-data">
        <div class="inputbox">
            <input type="hidden" name="user-id" value="<?php echo $fetchUsers["id"] ?>"/>
        </div>
        <div class="inputbox">
            <label for="username">Nombre de usuario <span class="required-field">* <?php echo $userNameErr ?></span></label>
            <input type="text" name="register-username" id="username" value="<?php echo $fetchUsers["username"] ?>" required/>
        </div>
        <div class="inputbox">
            <label for="email">Email <span class="required-field">* <?php echo $emailErr ?></span></label>
            <input type="email" name="register-email" id="email" value="<?php echo $fetchUsers["email"] ?>" required>
        </div>
        <div class="inputbox">
            <label for="password">Nueva contraseña <span class="required-field">* <?php echo $passwordErr ?></span></label>
            <input type="password" name="register-password" id="password"/>
        </div>
        <div class="inputbox">
            <label>Usuario Administrador <span class="required-field">* <?php echo $isUserAdminErr ?></span></label>
            <div class="option-admin">
                <div>
                    <label for="is_admin">Si</label>
                    <input type="radio" name="register-useradmin" id="is_admin" value="is_admin" <?php echo $fetchUsers["useradmin"] == "1" ? "checked" : "" ?> required/>
                </div>
                <div>
                    <label for="no_admin">No</label>
                    <input type="radio" name="register-useradmin" id="no_admin" value="no_admin"<?php echo $fetchUsers["useradmin"] == "0" ? "checked" : "" ?>/>
                </div>
            </div>
        </div>

        <br/>
        <p>INFORMACIÓN PERSONAL (OPCIONAL) </p>
        <div class="inputbox">
            <label for="user-name">Nombre</label>
            <input type="text" name="user-name" id="user-name"/>
        </div>
        <div class="inputbox">
            <label for="user-lastname">Apellido</label>
            <input type="text" name="user-lastname" id="user-lastname"/>
        </div>
        <div class="inputbox">
            <label for="profile-photo">Foto <span class="required-field"><?php echo $profilePhotoErr ?></span></label>
            <input type="file" name="profile-photo" id="profile-photo" accept="image/jpg, image/jpeg, image/png, image/gif, image/webp"/>
            <input type="hidden" name="profile-photo-temp" value="<?php // echo $fetchUsers["profile_photo"] ?>"/>
        </div>
        <div class="inputbox">
            <label for="phone-number">Número de celular <span class="required-field"><?php $phoneNumberErr ?></span></label>
            <input type="number"  name="phone-number" id="phone-number" placeholder="(+57)"/>
        </div>
        <div class="action-buttons">
            <button type="submit">Actualizar</button>
            <button type="button" onclick="btnCancelar()">Cancelar</button>
            <script>
                function btnCancelar() {
                    document.querySelector("#form-create-user").reset();
                    window.location = 'index.php?rute=manage';
                }
    </script>
        </div>
    </form>
</div>