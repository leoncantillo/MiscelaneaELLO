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

        $statement = Connection::connect() -> prepare("INSERT INTO $table(username, email, password, useradmin) VALUES
        (:username, :email, :password, :useradmin)");

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
}

?>