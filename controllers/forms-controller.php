<?php

Class FormsController {
    static public function ctrSignUp() {
        if(isset($_POST["username"])){
            return true;
        }
    }
}

?>