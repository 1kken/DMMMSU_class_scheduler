
<?php
    require_once("database_header.php");
    require_once('config_session.inc.php');
    require_once('subject/subject_model.php');
    require_once('subject/subject_controller.php');

    //CREATE
    if(isset($_POST['create_subject']) && isset($_SESSION['user_id'])){
        $subject_id = $_POST['subject_id'];
        $descriptive_title = $_POST['descriptive_title'];
        $lecture_units = $_POST['lecture_units'];
        $laboratory_units = $_POST['laboratory_units'];
        $total_units = $_POST['total_units'];
        $priority = $_POST['priority'];

        $errors = [];
        if(is_subject_id_taken($pdo, $subject_id)){
            $errors[] = "Subject ID is already taken.";
        }

        if(is_lecture_lab_units_valid($lecture_units, $laboratory_units, $total_units)){
            $errors[] = "Lecture and Laboratory units must not be both zero or greater than 3.";
        }

        if(is_subject_priority_valid($priority)){
            $errors[] = "Priority must be between 1 and 5.";
        }

        if($errors){
            $_SESSION['subject_errors'] = $errors;
            header("LOCATION: /DMMMSU_class_scheduler/views/subject.php");
            exit();
        }
       
        try {
            insert_subject($pdo, $subject_id, $descriptive_title, $lecture_units, $laboratory_units, $total_units, $priority);
            header("LOCATION: /DMMMSU_class_scheduler/views/subject.php");
            exit();
            
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    //DELETE
    if(isset($_POST['delete_subject']) && isset($_SESSION['user_id'])){
        try {
            delete_subject($pdo, $_POST['subject_id']);
            header("LOCATION: /DMMMSU_class_scheduler/views/subject.php");
            exit();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    //update
    if(isset($_POST['update_subject']) && isset($_SESSION['user_id'])){
        $subject_id = $_POST['subject_id'];
        $descriptive_title = $_POST['descriptive_title'];
        $lecture_units = $_POST['lecture_units'];
        $laboratory_units = $_POST['laboratory_units'];
        $total_units = $_POST['total_units'];
        $priority = $_POST['priority'];
        $old_subject_id = $_POST['old_subject_id'];

        $errors = [];
        if(is_subject_id_taken($pdo, $subject_id) && $subject_id != $old_subject_id){
            $errors[] = "Subject ID is already taken.";
        }

        if(is_lecture_lab_units_valid($lecture_units, $laboratory_units, $total_units)){
            $errors[] = "Lecture and Laboratory units must not be  greater than 3.";
        }

        if(is_subject_priority_valid($priority)){
            $errors[] = "Priority must be between 1 and 5.";
        }

        if($errors){
            $_SESSION['subject_errors'] = $errors;
            header("LOCATION: /DMMMSU_class_scheduler/views/subject.php");
            exit();
        }

        try {
            update_subject($pdo, $subject_id, $descriptive_title, $lecture_units, $laboratory_units, $total_units, $priority,$old_subject_id);
            header("LOCATION: /DMMMSU_class_scheduler/views/subject.php");
            exit();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }