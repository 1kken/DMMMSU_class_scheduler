<?php
    require_once("database_header.php");
    require_once('config_session.inc.php');
    require_once('student/student_model.php');
    require_once('student/student_controller.php');
//CREATE
if (isset($_SESSION["user_id"]) && isset($_POST["create_student"])) {
    $student_id = $_POST["student_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $middle_name = $_POST["middle_name"];
    $email = $_POST["email"];
    $section_id = $_POST["section_id"];

    //sanitize
    $student_id = $_POST["student_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $middle_name = $_POST["middle_name"];
    $email = $_POST["email"];

    //filter
    $student_id = htmlspecialchars($student_id);
    $first_name = htmlspecialchars($first_name);
    $last_name = htmlspecialchars($last_name);
    $middle_name = htmlspecialchars($middle_name);
    $section_id = htmlspecialchars($section_id);

    $_SESSION["errors_students"] = [];
    //check if student_id is valid
    if(!check_student_id_format($student_id)){
        $_SESSION["errors_students"] = ["invalid_student_id" => "Invalid student ID."];
    }

    //check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["errors_students"] = ["invalid_email" => "Invalid email."];
    }

    if(!check_email_format($student_id, $first_name, $last_name, $email)){
        $suggested_email = suggest_email($student_id, $first_name, $last_name);
        $_SESSION["errors_students"] = ["invalid_email_format" => "Invalid email. suggestion: $suggested_email"];
    }

     //check if the instructor_id is already in the database
    if(is_student_id_taken($pdo, $student_id)){
        $_SESSION["errors_students"] = ["instructor_id_taken" => "Instructor ID is already taken."];
    }

    // //check email if already in the database
    if(is_student_email_taken($pdo, $email)){
        $_SESSION["errors_students"] = ["email_taken" => "Email is already taken."];
    }

    if ($_SESSION["errors_students"]) {
        header("LOCATION: /DMMMSU_class_scheduler/views/student.php");
        exit();
    }
    try {
        insert_student($pdo, $instructor_id, $first_name, $last_name, $middle_name, $email,$section_id);
        header("LOCATION: /DMMMSU_class_scheduler/views/student.php");
        exit();
    } catch (\Throwable $th) {
        echo "Error: " . $th->getMessage();
    }
}

if(isset($_POST["delete_student"]) && isset($_SESSION["user_id"])){
    $student_id = $_POST["student_id"];
    try{
        delete_student($pdo, $student_id);
        header("LOCATION: /DMMMSU_class_scheduler/views/student.php");
        exit();
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}

//UPDATE
if (isset($_SESSION["user_id"]) && isset($_POST["update_student"])) {
    $student_id = $_POST["student_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $middle_name = $_POST["middle_name"];
    $email = $_POST["email"];
    $section_id = $_POST["section_id"];

    //sanitize
    $student_id = $_POST["student_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $middle_name = $_POST["middle_name"];
    $email = $_POST["email"];

    //filter
    $student_id = htmlspecialchars($student_id);
    $first_name = htmlspecialchars($first_name);
    $last_name = htmlspecialchars($last_name);
    $middle_name = htmlspecialchars($middle_name);
    $section_id = htmlspecialchars($section_id);

    //check if email is valid
    $_SESSION["errors_students"] = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["errors_students"] = ["invalid_email" => "Invalid email."];
    }

    if ($_SESSION["errors_students"]) {
        header("LOCATION: /DMMMSU_class_scheduler/views/student.php");
        exit();
    }

    try {
        update_student($pdo, $student_id, $first_name, $last_name, $middle_name, $email, $section_id);
        header("LOCATION: /DMMMSU_class_scheduler/views/student.php");
        exit();
    } catch (\Throwable $th) {
        echo "Error: " . $th->getMessage();
    }
}