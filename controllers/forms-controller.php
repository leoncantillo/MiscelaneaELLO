<?php

Class FormsController {
    # ================== CRUD USERS  =========================

    # SIGNUP ------------------------------------
    static public function ctrSignUp() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $table = "ellodb_users";

            $validUserAdmin = 0;
            if(isset($_POST["register-useradmin"])){
                if($_POST["register-useradmin"] == "is_admin")
                    $validUserAdmin = 1;
            }

            $password = filter_var(GlobalController::test_input($_POST["register-password"]), FILTER_SANITIZE_STRING);
            $password = password_hash($password, PASSWORD_DEFAULT);

            $data = array("username" => GlobalController::test_input($_POST["register-username"]),
                          "email" => filter_var(GlobalController::test_input($_POST["register-email"]), FILTER_VALIDATE_EMAIL),
                          "password" => $password,
                          "useradmin" => GlobalController::test_input($validUserAdmin));
            $answer = GlobalModel::mdlInsertData($table, $data);
            return $answer;
        }
    }

    # READ ------------------------------------------
    static public function ctrSelectUsers() {
        $table = "ellodb_users";
        $answer = GlobalModel::mdlFetchData($table, null, null);
        return $answer;
    }

    static public function ctrSelectUsersWithId($id) {
        $table = "ellodb_users";
        $columnName = "id";
        $idFetch = GlobalController::test_input($id);
        $answer = GlobalModel::mdlFetchData($table, $columnName, $idFetch);
        return $answer;
    }

    public function ctrSignin() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $table = "ellodb_users";
            $columnName = "email";
            $value = filter_var(GlobalController::test_input($_POST["login-email"]), FILTER_VALIDATE_EMAIL);
            $answer = GlobalModel::mdlFetchData($table, $columnName, $value);

            if(is_array($answer)) {
                $passwordHash = $answer["password"];
                $passwordEntered = GlobalController::test_input($_POST["login-password"]);
                if($answer["email"] == $_POST["login-email"] && password_verify($passwordEntered, $passwordHash)){
                    $_SESSION["validate-login"] = true;
                    if ($answer["useradmin"] == 1) {
                        $_SESSION["validate-useradmin"] = true;
                    }
                    echo "<script>
                        window.location = 'index.php?rute=shop'
                    </script>";
                }else {
                    echo "<div>El email o la contraseña son incorrectos</div>";
                }
            }else {
                echo "<div>El usuario ingresado no existe</div>";
            }

            echo "<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null,null,window.location.href);
                }
            </script>";
        }
    }

    static public function ctrUpdateUser() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $table = "ellodb_users";

            $validUserAdmin = 0;
            if(isset($_POST["register-useradmin"])){
                if($_POST["register-useradmin"] == "is_admin")
                    $validUserAdmin = 1;
            }
            
            $data = array("id" => GlobalController::test_input($_POST["user-id"]),
                          "username" => GlobalController::test_input($_POST["register-username"]),
                          "email" => filter_var(GlobalController::test_input($_POST["register-email"]), FILTER_VALIDATE_EMAIL),
                          "useradmin" => GlobalController::test_input($validUserAdmin));

            if (isset ($_POST["register-password"])) {
                $password = filter_var(GlobalController::test_input($_POST["register-password"]), FILTER_SANITIZE_STRING);
                $password = password_hash($password, PASSWORD_DEFAULT);
                $data["password"] = $password;
            }

            $answer = GlobalModel::mdlUpdateData($table, $data);
            return $answer;
        }
    }

    # DELETE -----------------------------------------
    static public function ctrDeleteUser($id) {
        $table = "ellodb_users";
        $idProduct = GlobalController::test_input($id);
        $answer = GlobalModel::mdlDeleteData($table, $idProduct);
        return $answer;
    }

    # CONTACT ----------------------------------------
    static public function ctrContactMessage() {
        if (isset($_POST["send_message"])) {
            $name = GlobalController::test_input($_POST["name"]);
            $email = GlobalController::test_input($_POST["email"]);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $subject = 'Formulario de Contacto';
            $message = GlobalController::test_input($_POST["message"]);

            $messageToSend = "De: $name <a href='mailto:$email'>$email</a><br/>";
            $messageToSend .= "Asunto: Mensaje de contacto<br/><br/>";
            $messageToSend .= "Cuerpo del mensaje:";
            $messageToSend .= "<p>$message</p>";
            $messageToSend .= "--<p>Mensaje enviado desde miscelaneaello.com</p>";

            $answer = GlobalModel::mdlSendMail($name, $email, $subject, $messageToSend);
            return $answer;
        }
    }
}

?>