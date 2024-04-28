<?php
    function check_subject_errors(){
        if(isset($_SESSION['errors'])){
            $errors = $_SESSION['errors'];
            foreach($errors as $error){
                echo "<p class='error'>$error</p>";
            }
            unset($_SESSION['subject_errors']);
        }
    }