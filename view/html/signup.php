<?php

$isAdmin = false;
if(isset($_SESSION["validate-useradmin"])) {
    if($_SESSION["validate-useradmin"] == true){
        $isAdmin = true;
    }
}

$requiredAlert = "";
$fullFields = true;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["register-username"]) ||
       empty($_POST["register-email"]) ||
       empty($_POST["register-password"]) ||
       ($isAdmin == true && empty($_POST["register-useradmin"]))){
        $requiredAlert = "*";
        $fullFields = false;
    }
}

?>

<link rel="stylesheet" href="view/css/sign_in-up.css">
<title>Registro</title>

<section class="dinamic_background">
    <section class="signinbox">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>

        <div class="signin">
            <div class="content">
                <h2>Registro</h2>
                <form class="form" method="post">
                    <div class="inputbx">
                        <input type="text" name="register-username" id="" autofocus required>
                        <label>Nombre de usuario <i><?php echo $requiredAlert ?></i></label>
                        <b></b>
                    </div>
                    <div class="inputbx">
                        <input type="email" name="register-email" id="" required>
                        <label>Email <i><?php echo $requiredAlert ?></i></label>
                        <b></b>
                    </div>
                    <div class="inputbx">
                        <input type="password" name="register-password" id="" required>
                        <label>Contraseña <i><?php echo $requiredAlert ?></i></label>
                        <b></b>
                    </div>
                    <?php if($isAdmin):?>
                        <div class="inputbx__admin">
                            <label>Usuario Administrador <i><?php echo $requiredAlert ?></i></label>
                            <div class="inputbx__admin--options">
                                <div>
                                    <label for="is_admin">Si</label>
                                    <input type="radio" name="register-useradmin" id="is_admin" value="is_admin" required>
                                </div>
                                <div>
                                    <label for="no_admin">No</label>
                                    <input type="radio" name="register-useradmin" id="no_admin" value="no_admin">
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="links">
                        <a href="">Términos y condiciones</a>
                        <a href="index.php?rute=signin">Iniciar sesión</a> 
                    </div>
                    <div class="inputbx">
                        <input type="submit" name="signup" value="Entrar">
                    </div>
                </form>
                <?php
                
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        if($fullFields){
                            $signup = FormsController::ctrSignUp();
                    
                            if($signup == true){
                                echo "<script>
                                    alert('El usuario ha sido registrado correctamente');
                                    window.location = 'index.php?rute=signin'
                                </script>";
                            } else {
                                echo "<script>
                                    alert('Hubo un error en el registro, intentelo nuevamente');
                                </script>";
                            }
                        }
                    
                        echo "<script>
                            if (window.history.replaceState) {
                                window.history.replaceState(null,null,window.location.href);
                            }
                        </script>";
                    }
                
                ?>
            </div>
        </div>
    </section>
</section>