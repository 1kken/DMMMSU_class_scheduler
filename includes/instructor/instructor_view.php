<?php
declare(strict_types=1);
function check_update_errors(){
    if(isset($_SESSION["errors_instructor"])){
        $errors = $_SESSION["errors_instructor"];
        foreach($errors as $error){
            echo "<p style='color:red;'>$error</p>";
        }
    }
    unset($_SESSION["errors_instructor"]);
}