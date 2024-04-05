
<?php
require_once("database_header.php");
require_once('config_session.inc.php');
require_once('instructor/instructor_model.php');
require_once('instructor/instructor_controller.php');


//CREATE
if (isset($_SESSION["user_id"]) && isset($_POST["create_instructor"])) {
    $instructor_id = $_POST["instructor_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $middle_name = $_POST["middle_name"];
    $email = $_POST["email"];

    //check if the instructor_id is already in the database
    if (is_instructor_id_taken($pdo, $instructor_id)) {
        $_SESSION["errors_instructor"] = ["instructor_id_taken" => "Instructor ID is already taken."];
    }
    //check email if already in the database
    if (is_instructor_email_taken($pdo, $email)) {
        $_SESSION["errors_instructor"] = ["email_taken" => "Email is already taken."];
    }

    if ($_SESSION["errors_instructor"]) {
        header("LOCATION: /DMMMSU_class_scheduler/views/instructor.php");
        exit();
    }
    try {
        insert_instructor($pdo, $instructor_id, $first_name, $last_name, $middle_name, $email);
        header("LOCATION: /DMMMSU_class_scheduler/views/instructor.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}