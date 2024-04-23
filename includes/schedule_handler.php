<?php
    require_once("database_header.php");
    require_once('config_session.inc.php');
    require_once('schedule/schedule_model.php');
    require_once('schedule/schedule_controller.php');

    if(!isset($_SESSION["user_id"])){
        header("LOCATION: /DMMMSU_class_scheduler/index.php");
        exit();
    }

    if(isset($_POST["create_schedule"]) && isset($_SESSION["user_id"])){
        $code = $_POST["code"];
        $room_id = $_POST["room_id"];
        $instructor_id = $_POST["instructor_id"];
        $day = $_POST["day"];
        $start_time = $_POST["start_time"];
        $end_time = $_POST["end_time"];
        $subject_id = $_POST["subject_id"];
        $section_id = $_POST["section_id"];
        $sy = $_POST["sy"];

        $errors = [];
        if(empty($code) || empty($room_id) || empty($instructor_id) || empty($day) || empty($start_time) || empty($end_time) || empty($subject_id) || empty($section_id) || empty($sy)){
            $errors["missing_fields"] = "All fields are required.";
        }

        if(strtotime($start_time) >= strtotime($end_time)){
            $errors["invalid_time"] = "Invalid time.";
        }

        if(is_schedule_code_taken($pdo, $code)){
            $errors["code_taken"] = "Code is already taken.";
        }

        //check for conflicts
        $stmt = $pdo->prepare("SELECT * FROM schedule WHERE room_id = :room_id AND day = :day AND ((start_time <= :start_time AND end_time >= :start_time) OR (start_time <= :end_time AND end_time >= :end_time))");
        $stmt->execute(['room_id' => $room_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time]);
        if($stmt->rowCount() > 0){
            $errors["room_conflict"] = "Room is already taken.";
        }
        //check for instructor conflict
        $stmt = $pdo->prepare("SELECT * FROM schedule WHERE instructor_id = :instructor_id AND day = :day AND ((start_time <= :start_time AND end_time >= :start_time) OR (start_time <= :end_time AND end_time >= :end_time))");
        $stmt->execute(['instructor_id' => $instructor_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time]);
        if($stmt->rowCount() > 0){
            $errors["instructor_conflict"] = "Instructor is already taken.";
        }

        if($errors){
            $_SESSION["errors"] = $errors;
            echo "error";
            header("LOCATION: /DMMMSU_class_scheduler/views/schedule.php");
            exit();
        }
        
        try {
            //create schedule
            $stmt = $pdo->prepare("INSERT INTO schedule (code, room_id, instructor_id, day, start_time, end_time, subject_id, section_id, sy) VALUES (:code, :room_id, :instructor_id, :day, :start_time, :end_time, :subject_id, :section_id, :sy)");
            $stmt->execute(['code' => $code, 'room_id' => $room_id, 'instructor_id' => $instructor_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'subject_id' => $subject_id, 'section_id' => $section_id, 'sy' => $sy]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("LOCATION: /DMMMSU_class_scheduler/views/schedule.php");
        exit();
    }