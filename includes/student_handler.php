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

    //trim and lowercase
    $student_id = trim(strtolower($student_id));
    $first_name = trim(strtolower($first_name));
    $last_name = trim(strtolower($last_name));
    $middle_name = trim(strtolower($middle_name));
    $email = trim(strtolower($email));


    //filter
    $student_id = htmlspecialchars($student_id);
    $first_name = htmlspecialchars($first_name);
    $last_name = htmlspecialchars($last_name);
    $middle_name = htmlspecialchars($middle_name);
    $section_id = htmlspecialchars($section_id);

    $errors = [];
    //check if student_id is valid
    if(!check_student_id_format($student_id)){
        $errors["id_format"] = "Invalid student ID.";
    }

    //check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email_invalid"] = "Invalid email.";
    }

    // //check email if already in the database
    if(is_student_email_taken($pdo, $email)){
        $errors["email_taken"] =  "Email is already taken.";
    }

    //check if the instructor_id is already in the database
    if(is_student_id_taken($pdo, $student_id)){
        $errors["id_taken"] =  "Student ID is already taken.";
    }

    if(!check_email_format($student_id, $first_name, $last_name, $email) && $errors["id_format"] == null && $errors["email_invalid"] == null 
    && $errors["email_taken"] == null && $errors["id_taken"] == null){
        $suggested_email = suggest_email($student_id, $first_name, $last_name);
        $errors["email_format"] = "Invalid email. suggestion: $suggested_email";
    }



    
    if ($errors) {
        $_SESSION["errors_students"] = $errors;
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

    //trim and lowercase
    $student_id = trim(strtolower($student_id));
    $first_name = trim(strtolower($first_name));
    $last_name = trim(strtolower($last_name));
    $middle_name = trim(strtolower($middle_name));
    $email = trim(strtolower($email));

    //filter
    $student_id = htmlspecialchars($student_id);
    $first_name = htmlspecialchars($first_name);
    $last_name = htmlspecialchars($last_name);
    $middle_name = htmlspecialchars($middle_name);
    $section_id = htmlspecialchars($section_id);

    $errors = [];
    //old values
    $old_student_email = $_POST["old_student_email"];
    $old_student_id = $_POST["old_student_id"];

    //check if the student_id is already in the database
    if($old_student_email != $email){
        if(is_student_email_taken($pdo, $email)){
            $errors["email_taken"] = "Email is already taken.";
        }
    }
    if($old_student_id != $student_id){
        if(is_student_id_taken($pdo, $student_id)){
            $errors["id_taken"] = "Student ID is already taken.";
        }
    }
    //check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email_invalid"] = "Invalid email.";
    }

    if (!check_email_format($student_id, $first_name, $last_name, $email)) {
        $suggested_email = suggest_email($student_id, $first_name, $last_name);
        $errors["email_format"] = "Invalid email. suggestion: $suggested_email";
    }

    if ($errors) {
        $_SESSION["errors_students"] = $errors;
        header("LOCATION: /DMMMSU_class_scheduler/views/student_update.php?student_id=$old_student_id");
        exit();
    }

    try {
        $email = suggest_email($student_id, $first_name, $last_name);
        update_student($pdo, $student_id, $first_name, $last_name, $middle_name, $email, $section_id,$old_student_id);
        echo "Success";
        header("LOCATION: /DMMMSU_class_scheduler/views/student.php");
        exit();
    } catch (\Throwable $th) {
        echo "Error: " . $th->getMessage();
    }
}