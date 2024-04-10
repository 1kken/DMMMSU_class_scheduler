<?php   

    function check_create_room_errors(){
        if(isset($_SESSION["room_errors"])){
            $errors = $_SESSION["room_errors"];
            foreach($errors as $error){
                echo "<p style='color:tomato;'>$error</p>";
            }
        }
        unset($_SESSION["room_errors"]);
    }