<?php
    function check_schedule_errors(){
        if(isset($_SESSION["schedule_errors"])){
            $errors = $_SESSION["schedule_errors"];
            foreach($errors as $error){
                echo "<p style='color:red'>$error</p>";
            }
        }
        unset($_SESSION["schedule_errors"]);
    }