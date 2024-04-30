<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");

if (isset($_GET['section_id']) && isset($_GET['semester'])) {
    //get the section
    $stmt = $pdo->prepare('SELECT * FROM section WHERE section_id = :section_id');
    $stmt->execute(['section_id' => $_GET['section_id']]);
    $section = $stmt->fetch();
    $section_year = str_split($section['section_id']);
    $year_level = $section_year[0];
    //get the subjects
    $stmt = $pdo->prepare('SELECT DISTINCT * FROM subject WHERE year_level = :year_level AND semester = :semester');
    $stmt->execute(['year_level' => $year_level, 'semester' => $_GET['semester']]);
    $subjects = $stmt->fetchAll();
    if ($subjects == null) {
        echo "<option disabled selected value> -- no available subject -- </option>";
        exit();
    }

    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($subjects as $subject) {
        echo "<option value='" . $subject["subject_id"] . "'>" . $subject["descriptive_title"] . "</option>";
    }
    exit();
}

if (isset($_GET['subject_id']) && empty($_GET['type'])) {
    //get the instructor that teach the subject in subject_instructor db
    $stmt = $pdo->prepare(('SELECT subject_instructor.instructor_id,CONCAT(instructor.`last_name`,",",instructor.`first_name`) AS full_name FROM subject_instructor
    JOIN instructor ON subject_instructor.instructor_id = instructor.instructor_id
    WHERE subject_id = :subject_id'));
    $stmt->execute(['subject_id' => $_GET['subject_id']]);
    $instructors = $stmt->fetchAll();
    if ($instructors == null) {
        echo "<option disabled selected value> -- no available instructor -- </option>";
        exit();
    }
    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($instructors as $instructor) {
        echo "<option value='" . $instructor["instructor_id"] . "'>" . $instructor["full_name"] . "</option>";
    }
}

if (isset($_GET['subject_id']) && isset($_GET['type']) && isset($_GET['section_id']) && isset($_GET['sy'])) {
    $subject = getSubject($pdo, $_GET['subject_id']);
    $schedules = getScheduleWithSubjectandSection($pdo, $_GET['subject_id'], $_GET['section_id'], $_GET['sy']);

    //flags for checking if the section/subject has schedule for lab and lecture
    $has_lab = false;
    $has_lecture = false;
    foreach ($schedules as $schedule) {
        if ($schedule['type'] == 'laboratory') {
            $has_lab = true;
        }
        if ($schedule['type'] == 'lecture') {
            $has_lecture = true;
        }
    }
    echo "<option disabled selected value> -- select an option -- </option>";
    // display none if the seciotn ahs both lab and lecture
    if ($subject['laboratory_units'] > 0  && $has_lab && $subject['lecture'] > 0 && $has_lecture) {
        echo "<option disabled selected value> -- no available schedule -- </option>";
        exit();
    }

    if ($subject['laboratory_units'] > 0 && !$has_lab) {
        echo "<option value='laboratory'>Laboratory</option>";
    }

    if ($subject['lecture_units'] > 0 && !$has_lecture) {
        echo "<option value='lecture'>Lecture</option>";
    }
}
if (isset($_GET['type']) && isset($_GET['get_room'])) {
    //get the room where the type of it correspond
    $stmt = $pdo->prepare('SELECT * FROM rooms WHERE room_type = :type');
    $stmt->execute(['type' => $_GET['type']]);
    $rooms = $stmt->fetchAll();
    if ($rooms == null) {
        echo "<option disabled selected value> -- no available room -- </option>";
        exit();
    }
    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($rooms as $room) {
        echo "<option value='" . $room["room_id"] . "'>" . $room["room_id"] . "</option>";
    }
}

if (isset($_GET['room_id']) && isset($_GET['get_day']) && isset($_GET['sy'])) {
    //get the day where the room is available
    $room_id = $_GET['room_id'];
    $sy = $_GET['sy'];

    // Function to convert HH:MM time format to Unix timestamp
    function timeToTimestamp($time)
    {
        return strtotime($time);
    }

    $days = ['monday', 'tuesday', 'wednesday']; // Add other days as needed

    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($days as $day) {
        $stmt = $pdo->prepare('SELECT start_time,end_time FROM schedule WHERE room_id = :room_id AND day = :day AND code LIKE :sy');
        $stmt->execute(['room_id' => $room_id, 'sy' => "%$sy", 'day' => $day]);
        $schedules = $stmt->fetchAll();

        $total_time = 0;
        foreach ($schedules as $schedule) {
            $start_time = timeToTimestamp($schedule['start_time']);
            $end_time = timeToTimestamp($schedule['end_time']);
            $total_time += $end_time - $start_time;
        }

        if ($total_time >= (17 * 3600 - 8 * 3600)) { // 17:00 - 8:00 in seconds
            if($day == 'monday') {
                echo "<option value='$day' disabled>{$day} - Thursday FULL</option>";
            }
            if($day == 'tuesday') {
                echo "<option value='$day' disabled>{$day} - Friday FULL</option>";
            }
            if($day == 'wednesday') {
                echo "<option value='$day' disabled>{$day} FULL</option>";
            }
        } else {
            if($day == 'monday') {
                echo "<option value='$day'>{$day} - Thursday FULL</option>";
            }
            if($day == 'tuesday') {
                echo "<option value='$day'>{$day} - Friday FULL</option>";
            }
            if($day == 'wednesday') {
                echo "<option value='$day'>{$day} FULL</option>";
            }
        }
    }
}

function getSubject($pdo, $subject_id)
{
    $stmt = $pdo->prepare('SELECT * FROM subject WHERE subject_id = :subject_id');
    $stmt->execute(['subject_id' => $subject_id]);
    $subject = $stmt->fetch();
    return $subject;
}

function getScheduleWithSubjectandSection($pdo, $subject_id, $section_id, $sy)
{
    $stmt = $pdo->prepare('SELECT * FROM schedule WHERE subject_id = :subject_id AND section_id = :section_id AND code LIKE :sy');
    $stmt->execute(['subject_id' => $subject_id, 'section_id' => $section_id, 'sy' => "%$sy"]);
    $schedules = $stmt->fetchAll();
    return $schedules;
}
