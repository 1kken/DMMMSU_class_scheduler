<?php
    require_once("database_header.php");
    require_once('config_session.inc.php');
    require_once('subject_instructor/subject_instructor_model.php');
    require_once('subject_instructor/subject_instructor_controller.php');

    //CREATE
if (isset($_SESSION["user_id"]) && isset($_POST["create_subject_instructor"])) {
    $subject_id = $_POST["subject_id"];
    $instructor_id = $_POST["instructor_id"];

    //trim and lowercase
    $subject_id = trim(strtolower($subject_id));
    $instructor_id = trim(strtolower($instructor_id));

    //filter
    $subject_id = htmlspecialchars($subject_id);
    $instructor_id = htmlspecialchars($instructor_id);

    $errors = [];
    if(empty($subject_id) || empty($instructor_id)){
        $errors["empty"] = "Please fill out all fields.";
    }

    if(is_instructor_subject_already_connected($pdo, $subject_id, $instructor_id)){
        $errors["already_connected"] = "Subject and instructor is already connected.";
    }

    if(!is_subject_id_existent($pdo, $subject_id)){
        $errors["subject_not_found"] = "Subject not found.";
    }

    if(!is_instructor_id_existent($pdo, $instructor_id)){
        $errors["instructor_not_found"] = "Instructor not found.";
    }

    if ($errors) {
        $_SESSION["errors"] = $errors;
        header("LOCATION: /DMMMSU_class_scheduler/views/subject_instructor.php");
        exit();
    } else {
        try {
            create_subject_instructor($pdo, $subject_id, $instructor_id);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("LOCATION: /DMMMSU_class_scheduler/views/subject_instructor.php");
        exit();
    }
}