<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

Class FormsController {
    # VALIDATE FORM =========================
    static private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return($data);
    }

    # ================== CRUD USERS  =========================

    # SIGN UP =======================================
    static public function ctrSignUp() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $table = "ellodb_users";

            $validUserAdmin = 0;
            if(isset($_POST["register-useradmin"])){
                if($_POST["register-useradmin"] == "is_admin")
                    $validUserAdmin = 1;
            }

            $data = array("username" => self::test_input($_POST["register-username"]),
                          "email" => filter_var(self::test_input($_POST["register-email"]), FILTER_VALIDATE_EMAIL),
                          "password" => filter_var(self::test_input($_POST["register-password"]), FILTER_SANITIZE_STRING),
                          "useradmin" => self::test_input($validUserAdmin));
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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $table = "ellodb_users";
            $columnName = "email";
            $value = filter_var(self::test_input($_POST["login-email"]), FILTER_VALIDATE_EMAIL);
            $answer = FormsModel::mdlSelectRegister($table, $columnName, $value);

            if(is_array($answer)) {
                if($answer["email"] == $_POST["login-email"] && $answer["password"] == $_POST["login-password"]){
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

    # CONTACT =======================================
    static public function ctrContactMessage() {
        if (isset($_POST["send_message"])) {
            $name = self::test_input($_POST["name"]);
            $email = self::test_input($_POST["email"]);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $message = self::test_input($_POST["message"]);

            $messageToSend = "De: $name <a href='mailto:$email'>$email</a><br/>";
            $messageToSend .= "Asunto: Mensaje de contacto<br/><br/>";
            $messageToSend .= "Cuerpo del mensaje:";
            $messageToSend .= "<p>$message</p>";
            $messageToSend .= "--<p>Mensaje enviado desde miscelaneaello.com</p>";

            $mail = new PHPMailer(true);

            try {
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'mail.nuestromundoinfantil.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'pruebas@nuestromundoinfantil.com';
                $mail->Password = 'Pruebas123';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                // Configuración del correo
                $mail->setFrom($email, 'Remitente');
                $mail->addAddress('pruebas@nuestromundoinfantil.com', 'Destinatario');
                $mail->addReplyTo($email, $name);
                $mail->isHTML(true);
                $mail->Subject = 'Formulario de Contacto';
                $mail->Body = utf8_decode($messageToSend);

                // Envío del correo
                if ($mail->send()) {
                    // Envío de copia al remitente
                    $mail->clearAddresses();
                    $mail->addAddress($email, $name);
                    $mail->Subject = 'Copia del Formulario de Contacto';
                    $mail->Body = "Gracias por contactarnos. Aquí tienes una copia de tu mensaje:<br><br>$messageToSend";
                    $mail->send();
                }

                return true;

            }catch(Exception $e) {
                print_r($mail->ErrorInfo);
            }
        }
    }

    # CRUD PRODUCT ===============================================
    static public function ctrCreateProduct() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $table = "ellodb_products";

            $conditionValue = 0;
            if(isset($_POST["condition"])){
                if($_POST["condition"] == "product-new")
                    $conditionValue = 1;
            }

            $data = array("product_name" => self::test_input($_POST["product-name"]),
                          "description" => self::test_input($_POST["description"]),
                          "image" => self::test_input($_POST["product-image"]),
                          "price" => self::test_input($_POST["price"]),
                          "promotion_price" => self::test_input($_POST["promotion-price"]),
                          "tag_id" => self::test_input($_POST["product-tag"]),
                          "tag_id" => self::test_input($_POST["product-category"]),
                          "color" => self::test_input($_POST["product-color"]),
                          "condition" => self::test_input($conditionValue));
            
            $answer = FormsModel::mdlCreateProduct($table, $data);
            return $answer;
        }
    }
}

?>