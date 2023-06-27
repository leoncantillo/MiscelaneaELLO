<?php

require_once "connecting.php";

Class FormsModel {

    # REGISTERS ===============================
    static public function mdlRegister($table, $data) {
        $statement = Connection::connect() -> prepare("INSERT INTO $table(username, email, password, useradmin) VALUES
        (:username, :email, :password, :useradmin)");

        $statement -> bindParam(":username", $data["username"], PDO::PARAM_STR);
        $statement -> bindParam(":email", $data["email"], PDO::PARAM_STR);
        $statement -> bindParam(":password", $data["password"], PDO::PARAM_STR);
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