<?php
    function check_student_errors(){
        if(isset($_SESSION["errors_students"])){
            $errors = $_SESSION["errors_students"];
            foreach($errors as $error){
                echo "<p class=errors>$error</p>";
            }
        }
        unset($_SESSION["errors_students"]);
    }