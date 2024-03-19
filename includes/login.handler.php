<?php
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("LOCATION: /DMMMSU_class_scheduler/index.php");
    exit();
}

try {
    require_once("./database_header.php");
    require_once("./login/login_model.php");
    require_once("./login/login_controller.php");
    $id_number = $_POST['id-number'];
    $password = $_POST['password'];
    echo $password;
    $user_type = $_POST['user-type'];

     
    $errors = [];
    if(is_input_empty($id_number,$password,$user_type)){
        $errors["empty_fields"] = "Please fill in all fields";
    }

    $user = get_user($pdo,$id_number,$user_type);

    if(is_id_number_wrong($user)){
        $errors["incorrect_credentials"] = "Check your credentials!";
    }
    if(!is_id_number_wrong($user) && is_password_wrong($password,$user['password'])){
        $errors["incorrect_credentials"] = "Check your credentials!";
    }

    require_once("./config_session.inc.php");
    if($errors){
        $_SESSION["log_in_errors"] = $errors;
        header("LOCATION: /DMMMSU_class_scheduler/views/auths/log_in_page.php");
        exit();    
    }

    header("LOCATION: /DMMMSU_class_scheduler/index.php?=log_in_success");
} catch (PDOException $e) {
    die("Log in failed" . $e->getMessage());
}
