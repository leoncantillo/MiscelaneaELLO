<?php

Class MessageController {

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