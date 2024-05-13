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
    $subject_id = trim($subject_id);
    $instructor_id = trim($instructor_id);

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
        header("LOCATION: ../views/subject_instructor.php");
        exit();
    } else {
        try {
            create_subject_instructor($pdo, $subject_id, $instructor_id);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("LOCATION: ../views/subject_instructor.php");
        exit();
    }
}

if(isset($_SESSION["user_id"]) && isset($_POST["delete_si"])){
    $si_id = $_POST["si_id"];
    $si_id = trim($si_id);

    try {
        delete_subject_instructor($pdo, $si_id);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    header("LOCATION: ../views/subject_instructor.php");
    exit();
}

//update
if (isset($_SESSION["user_id"]) && isset($_POST["update_subject_instructor"])) {
    $si_id = $_POST["si_id"];
    $subject_id = $_POST["subject_id"];
    $instructor_id = $_POST["instructor_id"];

    //filter
    $si_id = htmlspecialchars($si_id);
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
        header("LOCATION: ../views/subject_instructor.php");
        exit();
    } else {
        try {
            update_subject_instructor($pdo, $si_id, $subject_id, $instructor_id);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("LOCATION: ../views/subject_instructor.php");
        exit();
    }
}