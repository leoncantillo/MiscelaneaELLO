<?php

Class FormsController {
    # PRIVATE FUNCTIONS =========================

    # Validate Inputs ---------------------------------
    static private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return($data);
    }

    # Upload Files ------------------------------------
    static private function upload_file($postFile, $destinationFolder) {
        $directory = __DIR__ . $destinationFolder;
        $file = $directory . $postFile['name'];
        $fileBaseName = pathinfo($file, PATHINFO_FILENAME);
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        $counter = 1;
    
        // Verificar si el archivo ya existe
        while (file_exists($file)) {
            $newFileName = $fileBaseName . '(' . $counter . ').' . $fileExtension;
            $file = $directory . $newFileName;
            $counter++;
        }
    
        move_uploaded_file($postFile['tmp_name'], $file);
        return $newFileName ?? $postFile['name'];
    }

    # ================== CRUD USERS  =========================

    # Create Users ------------------------------------
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
            $answer = FormsModel::mdlInsertData($table, $data);
            return $answer;
        }
    }

    # SELECT USERS ------------------------------------------
    static public function ctrSelectUsers() {
        $table = "ellodb_users";
        $answer = FormsModel::mdlFetchData($table, null, null);
        return $answer;
    }

    # SIGNIN ----------------------------------
    public function ctrSignin() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $table = "ellodb_users";
            $columnName = "email";
            $value = filter_var(self::test_input($_POST["login-email"]), FILTER_VALIDATE_EMAIL);
            $answer = FormsModel::mdlFetchData($table, $columnName, $value);

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

    # CONTACT ----------------------------------------
    static public function ctrContactMessage() {
        if (isset($_POST["send_message"])) {
            $name = self::test_input($_POST["name"]);
            $email = self::test_input($_POST["email"]);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $subject = 'Formulario de Contacto';
            $message = self::test_input($_POST["message"]);

            $messageToSend = "De: $name <a href='mailto:$email'>$email</a><br/>";
            $messageToSend .= "Asunto: Mensaje de contacto<br/><br/>";
            $messageToSend .= "Cuerpo del mensaje:";
            $messageToSend .= "<p>$message</p>";
            $messageToSend .= "--<p>Mensaje enviado desde miscelaneaello.com</p>";

            $answer = FormsModel::mdlSendMail($name, $email, $subject, $messageToSend);
            return $answer;
        }
    }

    # ============================= CRUD PRODUCT ==============================

    # Create Products ----------------------------------
    static public function ctrCreateProduct() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $table = "ellodb_products";
            # se empieza desde la carpeta /controllers
            $destinationFolder = "/../view/img/products/";

            $postFile = $_FILES["product-image"];

            $conditionValue = 0;
            if(isset($_POST["condition"])){
                if($_POST["condition"] == "product-new")
                    $conditionValue = 1;
            }

            $data = array("product_name" => self::test_input($_POST["product-name"]),
                          "description" => self::test_input($_POST["description"]),
                          "image" => self::upload_file($postFile, $destinationFolder),
                          "price" => self::test_input($_POST["price"]),
                          "promotion_price" => self::test_input($_POST["promotion-price"]),
                          "tag_id" => self::test_input($_POST["product-tag"]),
                          "category_id" => self::test_input($_POST["product-category"]),
                          "color" => self::test_input($_POST["product-color"]),
                          "condition" => self::test_input($conditionValue));
            
            $answer = FormsModel::mdlInsertData($table, $data);
            return $answer;
        }
    }
}

?>