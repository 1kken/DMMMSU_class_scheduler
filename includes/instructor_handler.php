
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

    //trim and lowercase
    $instructor_id = strtolower(trim($instructor_id));
    $first_name = strtolower(trim($first_name));
    $last_name = strtolower(trim($last_name));
    $middle_name = strtolower(trim($middle_name));
    $email = strtolower(trim($email));


    //filter
    $instructor_id = htmlspecialchars($instructor_id);
    $first_name = htmlspecialchars($first_name);
    $last_name = htmlspecialchars($last_name);
    $middle_name = htmlspecialchars($middle_name);

    //check if email is valid
    $errors = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["invalid_email"] = "Invalid email.";
    }

    //instructor id check
    if (!check_instructor_id_format($instructor_id)) {
        $errors["id_format"] = "Invalid instructor ID.";
    }

    //check if the instructor_id is already in the database
    if (is_instructor_id_taken($pdo, $instructor_id)) {
        $errors["id_taken"] = "Instructor ID is already taken.";
    }
    //check email if already in the database
    if (is_instructor_email_taken($pdo, $email)) {
        $errors["email_taken"] = "Email is already taken.";
    }

    //check email format
    if (
        !check_email_format_instructor($instructor_id, $first_name, $last_name, $email)
        && $errors["id_format"] == null && $errors["invalid_email"] == null && $errors["id_taken"] == null && $errors["email_taken"] == null
    ) {
        $suggested_email = suggest_email_instructor($instructor_id, $first_name, $last_name);
        $errors["invalid_email"] = "Invalid email. suggestion: $suggested_email";
    }

    if ($errors) {
        $_SESSION["errors_instructor"] = $errors;
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

if (isset($_POST["delete_instructor"]) && isset($_SESSION["user_id"])) {
    $instructor_id = $_POST["instructor_id"];
    try {
        delete_instructor($pdo, $instructor_id);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    header("LOCATION: /DMMMSU_class_scheduler/views/instructor.php");
    exit();
}

if (isset($_POST["update_instructor"]) && isset($_SESSION["user_id"])) {
    $instructor_id = $_POST["instructor_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $middle_name = $_POST["middle_name"];
    $email = $_POST["email"];

    //trim and lowercase
    $instructor_id = strtolower(trim($instructor_id));
    $first_name = strtolower(trim($first_name));
    $last_name = strtolower(trim($last_name));
    $middle_name = strtolower(trim($middle_name));
    $email = strtolower(trim($email));

    //filter
    $instructor_id = htmlspecialchars($instructor_id);
    $first_name = htmlspecialchars($first_name);
    $last_name = htmlspecialchars($last_name);
    $middle_name = htmlspecialchars($middle_name);

    $errors = [];
    //check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["invalid_email"] = "Invalid email.";
    }

    //check email format
    if (!check_email_format_instructor($instructor_id, $first_name, $last_name, $email)) {
        $suggested_email = suggest_email_instructor($instructor_id, $first_name, $last_name);
        $errors["invalid_email"] = "Invalid email. suggestion: $suggested_email";
    }

    //Old values
    $old_instructor_email = $_POST["old_instructor_email"];
    $old_instructor_id = $_POST["old_instructor_id"];
    //check if the instructor_id is already in the database
    if ($old_instructor_id != $instructor_id) {
        if (is_instructor_id_taken($pdo, $instructor_id)) {
            $errors["id_taken"] = "Instructor ID is already taken.";
        }
    }
    //check email if already in the database
    if ($old_instructor_email != $email) {
        if (is_instructor_email_taken($pdo, $email)) {
            $errors["email_taken"] = "Email is already taken.";
        }
    }

    //if error
    if ($errors) {
        $_SESSION["errors_instructor"] = $errors;
        header("LOCATION: /DMMMSU_class_scheduler/views/instructor_update.php?instructor_id=$old_instructor_id");
        exit();
    }

    try {
        $email = suggest_email_instructor($instructor_id, $first_name, $last_name);
        update_instructor($pdo, $old_instructor_id, $instructor_id, $first_name, $last_name, $middle_name, $email);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
    header("LOCATION: /DMMMSU_class_scheduler/views/instructor.php?");
    exit();
}
