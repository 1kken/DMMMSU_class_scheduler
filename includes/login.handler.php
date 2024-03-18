<?php
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("LOCATION: /DMMMSU_class_scheduler/index.php");
    exit();
}

try {
    require_once("./includes/dbh.inc.php");
    require_once("./includes/login/login_model.php");
    require_once("./login/login_controller.php");
    $id_number = $_POST['id-number'];
    $password = $_POST['password'];
    
    $errors = [];
    if(is_input_empty($id_number,$password)){
        $errors["empty_fields"] = "Please fill in all fields";
    }
} catch (PDOException $e) {
    die("Log in failed" . $e->getMessage());
}
