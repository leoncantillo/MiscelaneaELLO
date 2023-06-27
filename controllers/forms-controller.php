<?php

Class FormsController {
    # VALIDATE FORM =========================
    static public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return($data);
    }

    # SIGNUP  =========================
    static public function ctrSignUp() {
        if(isset($_POST["register-username"])){
            $table = "ellodb_users";

            $validUserAdmin = 0;
            if(isset($_POST["register-useradmin"])){
                if($_POST["register-useradmin"] == "1")
                    $validUserAdmin = 1;
            }

            $data = array("username" => self::test_input($_POST["register-username"]),
                           "email" => self::test_input($_POST["register-email"]),
                           "password" => self::test_input($_POST["register-password"]),
                           "useradmin" => $validUserAdmin);
            $answer = FormsModel::mdlRegister($table, $data);
            return $answer;
        }
    }

    # SELECT REGISTERS ==============================
    static public function ctrSelectRegister() {
        $table = "ellodb_users";
        $answer = FormsModel::mdlSelectRegister($table, null, null);
        return $answer;
    }

    # SIGNIN =========================
    public function ctrSignin() {
        if(isset($_POST["login-email"])){
            $table = "ellodb_users";
            $columnName = "email";
            $value = self::test_input($_POST["login-email"]);
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