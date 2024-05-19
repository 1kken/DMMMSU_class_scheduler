<?php
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("LOCATION: ../index.php");
    exit();
}

try {
    require_once("./database_header.php");
    require_once("./login/login_model.php");
    require_once("./login/login_controller.php");
    $id_number = $_POST['id-number'];
    $password = $_POST['password'];
    $user_type = $_POST['user-type'];


    $errors = [];
    if (is_input_empty($id_number, $password, $user_type)) {
        $errors["empty_fields"] = "Please fill in all fields";
    }

    $user = get_user($pdo, $id_number, $user_type);

    if (is_id_number_wrong($user)) {
        $errors["incorrect_credentials"] = "Check your credentials!";
    }
    if (!is_id_number_wrong($user) && is_password_wrong($password, $user['password'])) {
        $errors["incorrect_credentials"] = "Check your credentials!";
    }

    require_once("./config_session.inc.php");
    if ($errors) {
        $_SESSION["log_in_errors"] = $errors;
        header("LOCATION: ../index.php");
        exit();
    }
    if ($user['admin'] == 0) {
        if ($user_type == "student") {
            $_SESSION["user_id"] = $user['student_id'];
            $a = $_SESSION["user_id"];
            header("LOCATION: ../views/create_report.php");
            exit();
        }
        if ($user_type == "instructor") {
            $_SESSION["user_id"] = $user['instructor_id'];
            $a = $_SESSION["user_id"];
            header("LOCATION: ../views/create_report.php");
            exit();
        }
    }

    if ($user['admin'] == 1) {
        if ($user_type == "instructor") {
            $_SESSION['admin'] = 1;
            $_SESSION["user_id"] = $user['instructor_id'];
            $a = $_SESSION["user_id"];
            header("LOCATION: ../views/dashboard.php");
            exit();
        }
    }
} catch (PDOException $e) {
    die("Log in failed" . $e->getMessage());
}
