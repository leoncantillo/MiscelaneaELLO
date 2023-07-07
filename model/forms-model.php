<?php

require_once "connecting.php";

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

Class FormsModel {

    static public function mdlFetchData($table, $columnName, $value) {
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

    # Insert Data Into Table ---------------------------------
    static public function mdlInsertData($table, $data) {
        $columns = array_keys($data);

        $columnNames = "`" . implode("`, `", array_map(function($key) {
            return $key;
        }, $columns)) . "`";
        
        $columnValues = ":" . implode(", :", $columns);
    
        $query = "INSERT INTO $table ($columnNames) VALUES ($columnValues)";
    
        $statement = Connection::connect()->prepare($query);
    
        foreach ($data as $key => $value) {
            $statement->bindValue(":" . $key, $value, PDO::PARAM_STR);
        }
    
        if ($statement->execute()) {
            return true;
        } else {
            print_r(Connection::connect()->errorInfo());
        }
    
        $statement->closeCursor();
        $statement = null;
    }

    # Send Mail -------------------------------------------
    static public function mdlSendMail($name, $email, $subject, $messageToSend) {
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
            $mail->Subject = $subject;
            $mail->Body = utf8_decode($messageToSend);

            // Envío del correo
            if ($mail->send()) {
                // Envío de copia al remitente
                $mail->clearAddresses();
                $mail->addAddress($email, $name);
                $mail->Subject = 'Copia del mensaje, correo recibido';
                $mail->Body = "Gracias por contactarnos. Aquí tienes una copia de tu mensaje:<br><br>$messageToSend";
                $mail->send();
            }

            return true;

        }catch(Exception $e) {
            print_r($mail->ErrorInfo);
        }
    }
    
}

?>