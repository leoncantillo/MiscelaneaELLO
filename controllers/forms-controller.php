<?php

Class FormsController {
    # SIGNUP  =========================
    static public function ctrSignUp() {
        if(isset($_POST["register-username"])){
            $table = "ellodb_users";
            $data = array("username" => $_POST["register-username"],
                           "email" => $_POST["register-email"],
                           "password" => $_POST["register-password"]);
            $answer = FormsModel::mdlRegister($table, $data);
            return $answer;
        }
    }

    # SELECT REGISTERS ==============================
    static public function ctrSelectRegister() {
        $table = "registered_users";
        $answer = FormsModel::mdlSelectRegister($table, null, null);
        return $answer;
    }

    # SIGNIN =========================
    public function ctrSignin() {
        if(isset($_POST["login-email"])){
            $table = "ellodb_users";
            $columnName = "email";
            $value = $_POST["login-email"];
            $answer = FormsModel::mdlSelectRegister($table, $columnName, $value);

            if(is_array($answer)) {
                if($answer["email"] == $_POST["login-email"] && $answer["password"] == $_POST["login-password"]){
                    $_SESSION["validate-login"] = true;
                    if ($answer["useradmin"] == 1) {
                        $_SESSION["validate-useradmin"] = true;
                    }
                    echo "<script>
                            if (window.history.replaceState) {
                                window.history.replaceState(null,null,window.location.href);
                            }
                            window.location = 'index.php?rute=shop'
                        </script>";
                }
            }else {
                echo "<script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null,null,window.location.href);
                        }
                    </script>";
                echo "<div>El email o la contraseña son incorrectos</div>";
            }
        }
    }
}
?>