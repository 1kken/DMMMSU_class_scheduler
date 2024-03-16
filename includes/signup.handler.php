<?php
    if(!$_SERVER['REQUEST_METHOD'] !== "POST"){
        header("LOCATION: /DMMMSU_class_scheduler/index.php");
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    require_once("./database_header.php");
    require_once('./signup/signup_model.php');
    require_once("./signup/signup_controller.php");
    
    $errors = [];

    if(is_input_empty($password, $confirm_password, $email)){
        $errors["empty_input"] = "Please fill in all fields.";
    }

    if(is_email_invalid($email)){
        $errors["invalid_email"] = "Please enter a valid email.";
    }

    if(is_passwords_unequal($password,$confirm_password)){
        $errors["passwords_unequal"] = "Passwords do not match.";
    }

    if(is_email_not_existing($pdo,$email)){

    }


