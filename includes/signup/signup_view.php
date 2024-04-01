
<?php
    function check_for_signup_errors(){
        if(isset($_SESSION["errors_signup"])){
            $errors = $_SESSION["errors_signup"];
            foreach($errors as $error){
                echo "<p style='color:red'>$error</p>";
            }
        }
        unset($_SESSION["errors_signup"]);
    }