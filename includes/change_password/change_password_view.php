<?php
    function check_change_pass_errors(){
        if(isset($_SESSION['errors_change_pass'])){
            $errors = $_SESSION['errors_change_pass'];
            foreach($errors as $error){
                echo "<p class='errors'>$error</p>";
            }
        }
        unset($_SESSION['errors_change_pass']);
    }
