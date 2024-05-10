<?php
require_once("database_header.php");
require_once('config_session.inc.php');
require_once('schedule/schedule_model.php');
require_once('schedule/schedule_controller.php');

if (!isset($_SESSION["user_id"])) {
    header("LOCATION: /DMMMSU_class_scheduler/index.php");
    exit();
}

if (isset($_POST["create_schedule"]) && isset($_SESSION["user_id"])) {
    $code = $_POST["code"];
    $room_id = $_POST["room_id"];
    $instructor_id = $_POST["instructor_id"];
    $day = $_POST["day"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $subject_id = $_POST["subject_id"];
    $section_id = $_POST["section_id"];
    $sy = $_POST["sy"];
    $type = $_POST["type"];
    $semester = $_POST["semester"];

    $errors = [];
    if (empty($code) || empty($room_id) || empty($instructor_id) || empty($day) || empty($start_time) || empty($end_time) || empty($subject_id) || empty($section_id) || empty($sy) || empty($type) || empty($semester)) {
        $errors["missing_fields"] = "All fields are required.";
    }

    if (strtotime($start_time) >= strtotime($end_time)) {
        $errors["invalid_time"] = "Invalid time.";
    }


    //check for conflicts
    $stmt = $pdo->prepare("SELECT * FROM schedule WHERE room_id = :room_id AND day = :day AND ((start_time <= :start_time AND end_time >= :start_time) AND (start_time <= :end_time AND end_time >= :end_time) AND section_id = :section_id AND sy = :sy AND semester = :semester)");
    $stmt->execute(['room_id' => $room_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'section_id' => $section_id, 'sy' => $sy, 'semester' => $semester]);
    if ($stmt->rowCount() > 0) {
        $errors["room_conflict"] = "Room is already taken.";
    }
    //check for instructor conflict
    $stmt = $pdo->prepare("SELECT * FROM schedule WHERE instructor_id = :instructor_id AND day = :day AND ((start_time <= :start_time AND end_time >= :start_time) AND (start_time <= :end_time AND end_time >= :end_time) AND section_id = :section_id AND sy = :sy AND semester = :semester)");
    $stmt->execute(['instructor_id' => $instructor_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'section_id' => $section_id, 'sy' => $sy, 'semester' => $semester]);
    if ($stmt->rowCount() > 0) {
        $errors["instructor_conflict"] = "Instructor is already taken.";
    }

    if ($errors) {
        $_SESSION["schedule_errors"] = $errors;
        $schedule_id = $_POST["schedule_id"];
        header("LOCATION: /DMMMSU_class_scheduler/views/schedule.php");
        exit();
    }

    try {
        create_schedule($pdo, $code, $room_id, $instructor_id, $day, $start_time, $end_time, $subject_id, $section_id, $sy, $type, $semester);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
    header("LOCATION: /DMMMSU_class_scheduler/views/schedule.php");
    exit();
}


if (isset($_POST["delete_schedule"]) && isset($_SESSION["user_id"])) {
    $schedule_id = $_POST["schedule_id"];
    try {
        $stmt = $pdo->prepare("DELETE FROM schedule WHERE schedule_id = :schedule_id");
        $stmt->execute(['schedule_id' => $schedule_id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    header("LOCATION: /DMMMSU_class_scheduler/views/schedule.php");
    exit();
}

//UPDATE ===========================================================================
if (isset($_POST["update_schedule"]) && isset($_SESSION["user_id"])) {
    //old schedule
    $old_code = $_POST["code"];
    $old_schedule_id = $_POST["schedule_id"];
    $old_room_id = $_POST["room_id"];
    $old_instructor_id = $_POST["instructor_id"];
    $old_day = $_POST["day"];
    $old_start_time = $_POST["start_time"];
    $old_end_time = $_POST["end_time"];
    $old_subject_id = $_POST["subject_id"];
    $old_section_id = $_POST["section_id"];
    $old_semester = $_POST["semester"];
    $old_sy = $_POST["sy"];
    $old_type = $_POST["type"];

    //new schedule
    $room_id = $_POST["new_room_id"];
    $day = $_POST["new_day"];
    $start_time = $_POST["new_start_time"];
    $end_time = $_POST["new_end_time"];

    $errors = [];
    if (empty($room_id) || empty($day) || empty($start_time) || empty($end_time)){
        $errors["missing_fields"] = "All fields are required.";
    }
    //check if same value
    if ($day == $old_day && $start_time == $old_start_time && $end_time == $old_end_time && $room_id == $old_room_id) {
        $errors["same_values"] = "No changes were made.";
        $_SESSION["schedule_errors"] = $errors;
        $schedule_id = $_POST["schedule_id"];
        header("LOCATION: /DMMMSU_class_scheduler/views/schedule_update.php?schedule_id=$schedule_id");
        exit();
    }
    if (strtotime($start_time) >= strtotime($end_time)) {
        $errors["invalid_time"] = "Invalid time.";
    }

    //check fo  room conflicts
    $stmt = $pdo->prepare("SELECT start_time,end_time FROM schedule WHERE room_id = :room_id AND day = :day AND start_time = :start_time AND end_time = :end_time AND semester = :semester");
    $stmt->execute(['room_id' => $room_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time,'semester' => $old_semester]);
    if ($stmt->rowCount() > 0) {
        $errors["room_conflict"] = "Room is already taken.";
    }
    //check for instructor conflict
    $stmt = $pdo->prepare("SELECT * FROM schedule WHERE instructor_id = :instructor_id AND day = :day AND ((start_time <= :start_time AND end_time >= :start_time) OR (start_time <= :end_time AND end_time >= :end_time))");
    $stmt->execute(['instructor_id' => $instructor_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time]);
    if ($stmt->rowCount() > 0) {
        $errors["instructor_conflict"] = "Instructor is already taken.";
    }

    if ($errors) {
        $_SESSION["schedule_errors"] = $errors;
        $schedule_id = $_POST["schedule_id"];
        header("LOCATION: /DMMMSU_class_scheduler/views/schedule_update.php?schedule_id=$schedule_id");
        exit();
    }

    try {
        //update schedule
        $stmt = $pdo->prepare("UPDATE schedule SET code = :code, room_id = :room_id, instructor_id = :instructor_id, day = :day, start_time = :start_time, end_time = :end_time, subject_id = :subject_id, section_id = :section_id, sy = :sy WHERE code = :old_schedule AND room_id = :old_room_id AND instructor_id = :old_instructor_id AND day = :old_day AND start_time = :old_start_time AND end_time = :old_end_time AND subject_id = :old_subject_id AND section_id = :old_section_id AND sy = :old_sy");
        $stmt->execute(['code' => $code, 'room_id' => $room_id, 'instructor_id' => $instructor_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'subject_id' => $subject_id, 'section_id' => $section_id, 'sy' => $sy, 'old_schedule' => $old_schedule, 'old_room_id' => $old_room_id, 'old_instructor_id' => $old_instructor_id, 'old_day' => $old_day, 'old_start_time' => $old_start_time, 'old_end_time' => $old_end_time, 'old_subject_id' => $old_subject_id, 'old_section_id' => $old_section_id, 'old_sy' => $old_sy]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
    header("LOCATION: /DMMMSU_class_scheduler/views/schedule.php");
    exit();
}
