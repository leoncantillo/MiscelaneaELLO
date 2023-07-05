<?php

require_once "connecting.php";

Class FormsModel {

    # REGISTERS ===============================
    static public function mdlRegister($table, $data) {
        // Validación y saneamiento de email y contraseña
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            // El correo electrónico no es válido
            return false;
        }
        $password = filter_var($data["password"], FILTER_SANITIZE_STRING);

        $statement = Connection::connect() -> prepare("INSERT INTO $table (`username`, `email`, `password`, `useradmin`)
        VALUES (:username, :email, :password, :useradmin)");

        $statement -> bindParam(":username", $data["username"], PDO::PARAM_STR);
        $statement -> bindParam(":email", $email, PDO::PARAM_STR);
        $statement -> bindParam(":password", $password, PDO::PARAM_STR);
        $statement -> bindParam(":useradmin", $data["useradmin"], PDO::PARAM_STR);

        if($statement -> execute()) {
            return true;
        }else {
            print_r(Connection::connect()->errorInfo());
        }

        $statement->closeCursor();
        $statement = null;
    }

    static public function mdlSelectRegister($table, $columnName, $value) {
        if ($columnName == "email") {
            $value = filter_var($value, FILTER_VALIDATE_EMAIL);
            if (!$value) {
                // El valor de email no es válido
                return null;
            }
        }
        if ($columnName == null && $value == null) {
            $statement = Connection::connect()->prepare("SELECT * FROM $table");
            $statement->execute();
            $result = $statement->fetchAll();
    
            $statement->closeCursor();
            $statement = null;
    
            return $result;
        } else {
            $statement = Connection::connect()->prepare("SELECT * FROM $table WHERE $columnName = :$columnName");
            $statement->bindParam(":".$columnName, $value, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetch();
    
            $statement->closeCursor();
            $statement = null;
    
            return $result;
        }
    }

    # PRODUCTS ===================================================
    static public function mdlCreateProduct($table, $data) {
        $statement = Connection::connect() -> prepare("INSERT INTO
        $table (`product_name`, `description`, `image`, `price`, `promotion_price`, `tag_id`, `category_id`, `color`, `condition`)
        VALUES (:product_name, :description, :image, :price, :promotion_price, :tag_id, :category_id, :color, :condition)");

        $statement -> bindParam(":product_name", $data["product_name"], PDO::PARAM_STR);
        $statement -> bindParam(":description", $data["description"], PDO::PARAM_STR);
        $statement -> bindParam(":image", $data["image"], PDO::PARAM_STR);
        $statement -> bindParam(":price", $data["price"], PDO::PARAM_STR);
        $statement -> bindParam(":promotion_price", $data["promotion_price"], PDO::PARAM_STR);
        $statement -> bindParam(":tag_id", $data["tag_id"], PDO::PARAM_STR);
        $statement -> bindParam(":category_id", $data["category_id"], PDO::PARAM_STR);
        $statement -> bindParam(":color", $data["color"], PDO::PARAM_STR);
        $statement -> bindParam(":condition", $data["condition"], PDO::PARAM_STR);


        if($statement -> execute()) {
            return true;
        }else {
            print_r(Connection::connect()->errorInfo());
        }

        $statement->closeCursor();
        $statement = null;
    }
}

?>