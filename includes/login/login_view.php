<?php

function check_login_errors(){
    if(isset($_SESSION["log_in_errors"])){
        $errors = $_SESSION["log_in_errors"];
        foreach($errors as $error){
            echo "<p style='color:red'>$error</p>";
        }
    }
    unset($_SESSION["log_in_errors"]);
}