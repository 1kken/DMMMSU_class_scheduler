<?php
    function check_for_signup_errors(){
        if(isset($_SESSION["errors_signup"])){
            $errors = $_SESSION["errors_signup"];
            foreach($errors as $error){
                echo "<p class='dark:text-red-500 text-xs italic'>$error</p>";
            }
        }
        unset($_SESSION["errors_signup"]);
    }