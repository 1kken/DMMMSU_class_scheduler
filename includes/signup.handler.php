<?php
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("LOCATION: /DMMMSU_class_scheduler/index.php");
    exit();
}

try {
    $user_id = $_POST['id-number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $user_type = $_POST['user-type'];
    require_once("./database_header.php");
    require_once('./signup/signup_model.php');
    require_once("./signup/signup_controller.php");

    $errors = [];

    if (is_input_empty($password, $confirm_password, $user_id, $user_type)) {
        $errors["empty_input"] = "Please fill in all fields. $password $confirm_password $user_id $user_type";
    }

    if (is_passwords_unequal($password, $confirm_password)) {
        $errors["passwords_unequal"] = "Passwords do not match.";
    }

    if (is_user_type_invalid($user_type)) {
        $errors["invalid_user_type"] = "Invalid user type.";
    }

    if(is_user_id_taken($pdo,$user_id)){
        $errors["id_taken"] = "ID is already taken.";
    }

    if (is_user_id_not_available($pdo, $user_type, $user_id)) {
        $errors["user_id_not_available"] = "User ID is not available.";
    }

    if ($errors) {
        require_once("./config_session.inc.php");
        $_SESSION["errors_signup"] = $errors;
        header("LOCATION: /DMMMSU_class_scheduler/views/sign_up_page.php");
        exit();
    }

    create_user($pdo,$user_type,$user_id,$password);
    header("LOCATION: /DMMMSU_class_scheduler/views/dashboard.php");

    $pdo = null;
    $stmt = null;
} catch (PDOException $e) {
    die("Sign up failed" . $e->getMessage());
}
