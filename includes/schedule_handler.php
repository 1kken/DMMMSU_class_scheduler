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
    //get the created schedule
    $stmt = $pdo->prepare("SELECT * FROM schedule WHERE code = :code AND room_id = :room_id AND instructor_id = :instructor_id AND day = :day AND start_time = :start_time AND end_time = :end_time AND subject_id = :subject_id AND section_id = :section_id AND sy = :sy AND semester = :semester");
    $stmt->execute(['code' => $code, 'room_id' => $room_id, 'instructor_id' => $instructor_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'subject_id' => $subject_id, 'section_id' => $section_id, 'sy' => $sy, 'semester' => $semester]);
    $schedule = $stmt->fetch();

    //after creating the schedule update the unit counter
    //get the unit counter if the id is not existent create a new one
    $stmt = $pdo->prepare("SELECT * FROM unit_counter WHERE schedule_id = :id");
    $stmt->execute(['id' => $schedule["schedule_id"]]);
    $unit_counter = $stmt->fetch();
    if ($stmt->rowCount() == 0) {
        $stmt = $pdo->prepare("INSERT INTO unit_counter (schedule_id,code, lecture_count, laboratory_count) VALUES (:id,:code, 0, 0)");
        $stmt->execute(['id' => $schedule["schedule_id"], 'code' => $schedule["code"]]);
    }
    //update the unit counter depending on the time of the schedule
    $lecture_unit_counter = 0;
    $laboratory_unit_counter = 0;

    //lecture unit 1 hour = 1 unit
    //lab unit 1 hour = .5 unit
    //check for lecture and laboratory
    $time_counter = 0;
    if ($type == "lecture") {
        $time_counter = strtotime($end_time) - strtotime($start_time);
        $lecture_unit_counter = $time_counter / 1800 / 2;
    }
    if ($type == "laboratory") {
        $time_counter = strtotime($end_time) - strtotime($start_time);
        $laboratory_unit_counter = $time_counter / 1800 / 2;
        $laboratory_unit_counter -= 1;
    }

    //fetch the unit counter
    $stmt = $pdo->prepare("SELECT * FROM unit_counter WHERE schedule_id = :id");
    $stmt->execute(['id' => $schedule["schedule_id"]]);
    $stmt->fetch();

    //get the subject
    $stmt = $pdo->prepare("SELECT * FROM subject WHERE subject_id = :subject_id");
    $stmt->execute(['subject_id' => $subject_id]);
    $subject = $stmt->fetch();

    if ($type == "lecture" && $unit_counter["lecture_count"] >= $subject["lecture_units"]) {
        $errors["unit_exceeded"] = "Lecture units exceeded.";
    }

    if ($type == "laboratory" && $unit_counter["laboratory_count"] >= $subject["laboratory_units"]) {
        $errors["unit_exceeded"] = "Laboratory units exceeded.";
    }

    if ($errors) {
        $_SESSION["schedule_errors"] = $errors;
        $schedule_id = $_POST["schedule_id"];
        header("LOCATION: /DMMMSU_class_scheduler/views/schedule.php?");
        exit();
    }


    if ($type == "lecture") {
        $stmt = $pdo->prepare("UPDATE unit_counter SET lecture_count = lecture_count + :lecture_unit_counter WHERE schedule_id = :schedule_id");
        $stmt->bindParam(':lecture_unit_counter', $lecture_unit_counter, PDO::PARAM_STR);
        $stmt->bindParam(':schedule_id', $schedule["schedule_id"], PDO::PARAM_STR);
        $stmt->execute();
    }
    if ($type == "laboratory") {
        $stmt = $pdo->prepare("UPDATE unit_counter SET laboratory_count = laboratory_count + :laboratory_lecture_counter WHERE schedule_id = :schedule_id");
        $stmt->bindParam(':laboratory_lecture_counter', $laboratory_unit_counter, PDO::PARAM_STR);
        $stmt->bindParam(':schedule_id', $schedule["schedule_id"], PDO::PARAM_STR);
        $stmt->execute();
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

if (isset($_POST["update_schedule"]) && isset($_SESSION["user_id"])) {
    //old schedule
    $old_schedule = $_POST["old_schedule_code"];
    $old_room_id = $_POST["old_room_id"];
    $old_instructor_id = $_POST["old_instructor_id"];
    $old_day = $_POST["old_day"];
    $old_start_time = $_POST["old_start_time"];
    $old_end_time = $_POST["old_end_time"];
    $old_subject_id = $_POST["old_subject_id"];
    $old_section_id = $_POST["old_section_id"];
    $old_sy = $_POST["old_sy"];
    $old_type = $_POST["old_type"];

    //new schedule
    $code = $_POST["code"];
    $room_id = $_POST["room_id"];
    $instructor_id = $_POST["instructor_id"];
    $day = $_POST["day"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $subject_id = $_POST["subject_id"];
    $section_id = $_POST["section_id"];
    $semester = $_POST["semester"];
    $sy = $_POST["sy"];
    $type = $_POST["type"];

    $errors = [];
    if (empty($code) || empty($room_id) || empty($instructor_id) || empty($day) || empty($start_time) || empty($end_time) || empty($subject_id) || empty($section_id) || empty($sy) || empty($type)) {
        $errors["missing_fields"] = "All fields are required.";
    }
    //check if same value
    if ($old_schedule == $code && $old_room_id == $room_id && $old_instructor_id == $instructor_id && $old_day == $day && strtotime($old_start_time) == strtotime($start_time) && strtotime($old_end_time) == strtotime($end_time) && $old_subject_id == $subject_id && $old_section_id == $section_id && $old_sy == $sy && $old_type == $type) {
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
    $stmt = $pdo->prepare("SELECT * FROM schedule WHERE room_id != :room_id AND day = :day AND ((start_time <= :start_time AND end_time >= :start_time) OR (start_time <= :end_time AND end_time >= :end_time))");
    $stmt->execute(['room_id' => $room_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time]);
    if ($stmt->rowCount() > 0) {
        $errors["room_conflict"] = "Room is already taken.";
    }
    //check for instructor conflict
    $stmt = $pdo->prepare("SELECT * FROM schedule WHERE instructor_id != :instructor_id AND day = :day AND ((start_time <= :start_time AND end_time >= :start_time) OR (start_time <= :end_time AND end_time >= :end_time))");
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

    //get the created schedule
    $stmt = $pdo->prepare("SELECT * FROM schedule WHERE code = :code AND room_id = :room_id AND instructor_id = :instructor_id AND day = :day AND start_time = :start_time AND end_time = :end_time AND subject_id = :subject_id AND section_id = :section_id AND sy = :sy AND semester = :semester");
    $stmt->execute(['code' => $code, 'room_id' => $room_id, 'instructor_id' => $instructor_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'subject_id' => $subject_id, 'section_id' => $section_id, 'sy' => $sy, 'semester' => $semester]);
    $schedule = $stmt->fetch();

    //get the created schedule
    $stmt = $pdo->prepare("SELECT * FROM schedule WHERE code = :code AND room_id = :room_id AND instructor_id = :instructor_id AND day = :day AND start_time = :start_time AND end_time = :end_time AND subject_id = :subject_id AND section_id = :section_id AND sy = :sy AND semester = :semester");
    $stmt->execute(['code' => $code, 'room_id' => $room_id, 'instructor_id' => $instructor_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'subject_id' => $subject_id, 'section_id' => $section_id, 'sy' => $sy, 'semester' => $semester]);
    $schedule = $stmt->fetch();

    //after creating the schedule update the unit counter
    //get the unit counter if the id is not existent create a new one
    $stmt = $pdo->prepare("SELECT * FROM unit_counter WHERE schedule_id = :id");
    $stmt->execute(['id' => $schedule["schedule_id"]]);
    $unit_counter = $stmt->fetch();
    if ($stmt->rowCount() == 0) {
        $stmt = $pdo->prepare("INSERT INTO unit_counter (schedule_id, lecture_count, laboratory_count) VALUES (:id, 0, 0)");
        $stmt->execute(['id' => $schedule["schedule_id"]]);
    }
    //update the unit counter depending on the time of the schedule
    $lecture_unit_counter = 0;
    $laboratory_unit_counter = 0;

    //lecture unit 1 hour = 1 unit
    //lab unit 1 hour = .5 unit
    //check for lecture and laboratory
    $time_counter = 0;
    if ($type == "lecture") {
        $time_counter = strtotime($end_time) - strtotime($start_time);
        $lecture_unit_counter = $time_counter / 1800 / 2;
    }
    if ($type == "laboratory") {
        $time_counter = strtotime($end_time) - strtotime($start_time);
        $laboratory_unit_counter = $time_counter / 1800 / 2;
        $laboratory_unit_counter -= 1;
    }

    //fetch the unit counter
    $stmt = $pdo->prepare("SELECT * FROM unit_counter WHERE schedule_id = :id");
    $stmt->execute(['id' => $schedule["schedule_id"]]);
    $stmt->fetch();

    //get the subject
    $stmt = $pdo->prepare("SELECT * FROM subject WHERE subject_id = :subject_id");
    $stmt->execute(['subject_id' => $subject_id]);
    $subject = $stmt->fetch();

    if ($type == "lecture" && $unit_counter["lecture_count"] >= $subject["lecture_units"]) {
        $errors["unit_exceeded"] = "Lecture units exceeded.";
    }

    if ($type == "laboratory" && $unit_counter["laboratory_count"] >= $subject["laboratory_units"]) {
        $errors["unit_exceeded"] = "Laboratory units exceeded.";
    }

    if ($errors) {
        $_SESSION["schedule_errors"] = $errors;
        $schedule_id = $_POST["schedule_id"];
        header("LOCATION: /DMMMSU_class_scheduler/views/schedule.php?");
        exit();
    }


    if ($type == "lecture") {
        $stmt = $pdo->prepare("UPDATE unit_counter SET lecture_count = :lecture_unit_counter WHERE schedule_id = :schedule_id");
        $stmt->bindParam(':lecture_unit_counter', $lecture_unit_counter, PDO::PARAM_STR);
        $stmt->bindParam(':schedule_id', $schedule["schedule_id"], PDO::PARAM_STR);
        $stmt->execute();
    }
    if ($type == "laboratory") {
        $stmt = $pdo->prepare("UPDATE unit_counter SET laboratory_count = :laboratory_lecture_counter WHERE schedule_id = :schedule_id");
        $stmt->bindParam(':laboratory_lecture_counter', $laboratory_unit_counter, PDO::PARAM_STR);
        $stmt->bindParam(':schedule_id', $schedule["schedule_id"], PDO::PARAM_STR);
        $stmt->execute();
    }



    header("LOCATION: /DMMMSU_class_scheduler/views/schedule.php");
    exit();
}
