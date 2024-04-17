<?php
require_once("database_header.php");
require_once('config_session.inc.php');
require_once('change_password/change_password_model.php');

if ($_SESSION['user_id'] == null) {
    header("LOCATION: /DMMMSU_class_scheduler/index.php");
    exit();
}

if (isset($_POST["change_pass"])) {

    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $old_password = $_POST['old_password'];

    $errors = [];
    if (empty($new_password) || empty($confirm_password) || empty($old_password)) {
        $errors["empty_fields"] = "Please fill out all fields.";
    }

    if (password_verify($new_password, get_hashed_password($pdo, $_SESSION['user_id']))) {
        $errors["password_already_used"] = "New password is already used.";
    }

    if ($new_password != $confirm_password) {
        $errors["password_not_matched"] = "New password and confirm password do not match.";
    }

    if (check_if_password_is_incorrect($pdo, $old_password, $_SESSION['user_id'])) {
        $errors["incorrect_old_password"] = "Old password is incorrect.";
    }

    if ($errors) {
        $_SESSION['errors_change_pass'] = $errors;
        header("LOCATION: /DMMMSU_class_scheduler/views/user.php");
        exit();
    }

    try {
        change_password($pdo, $new_password, $_SESSION['user_id']);
        header("LOCATION: /DMMMSU_class_scheduler/views/dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if(isset($_POST["log_out"])){
    session_destroy();
    header("LOCATION: /DMMMSU_class_scheduler/index.php");
    exit();
}
