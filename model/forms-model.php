<?php

require_once "connecting.php";

Class FormsModel {

    # REGISTERS ===============================
    static public function mdlRegister($table, $data) {
        $statement = Connection::connect() -> prepare("INSERT INTO $table(username, email, password) VALUES
        (:username, :email, :password)");

        $statement -> bindParam(":username", $data["username"], PDO::PARAM_STR);
        $statement -> bindParam(":email", $data["email"], PDO::PARAM_STR);
        $statement -> bindParam(":password", $data["password"], PDO::PARAM_STR);

        if($statement -> execute()) {
            return true;
        }else {
            print_r(Connection::connect()->errorInfo());
        }

        $statement -> close();
        $statement = null;
    }

    static public function mdlSelectRegister($table, $item, $value) {

        if($item == null && $value == null) {
            $statement = Connection::connect() -> prepare("SELECT * FROM $table");
            $statement -> execute();
            return $statement -> fetchAll();
        }else {
            $statement = Connection::connect() -> prepare("SELECT * FROM $table WHERE $item = :$item ");
            $statement -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $statement -> execute();
            return $statement -> fetch();
        }

        $statement -> close();
        $statement = null;
    }
}

?>