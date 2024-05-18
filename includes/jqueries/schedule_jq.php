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
    $lab_lec_counts = get_lecture_lab_count($pdo, $_GET['subject_id'], $_GET['section_id'], $_GET['sy']);
    echo "<option disabled selected value> -- select an option -- </option>";

    if ($lab_lec_counts['lecture_count'] < $subject['lecture_units'] && $lab_lec_counts['laboratory_count'] < $subject['laboratory_units']) {
        echo "<option value='lecture'>Lecture</option>";
        echo "<option value='laboratory'>Laboratory</option>";
    } else if ($lab_lec_counts['lecture_count'] < $subject['lecture_units']) {
        echo "<option value='lecture'>Lecture</option>";
    } else if ($lab_lec_counts['laboratory_count'] < $subject['laboratory_units']) {
        echo "<option value='laboratory'>Laboratory</option>";
    } else {
        echo "<option disabled selected value> -- no available schedule -- </option>";
    }
}
if (isset($_GET['type']) && isset($_GET['subject_id']) && isset($_GET['get_room'])) {
    //get the room where the type of it correspond
    $stmt = $pdo->prepare('SELECT rooms.room_id FROM rooms 
                            JOIN `subject` ON rooms.priority <=  subject.priority
                            WHERE subject.subject_id = :subject_id AND room_type = :type;');
    $stmt->execute(['type' => $_GET['type'], 'subject_id' => $_GET['subject_id']]);
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

    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday']; // Add other days as needed

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
            echo "<option value='$day' disabled>{$day} FULL</option>";
        } else {
            echo "<option value='$day'>{$day}</option>";
        }
    }
}

if (isset($_GET['room_id']) && isset($_GET['sy']) && isset($_GET['day']) && isset($_GET['semester']) && isset($_GET['instructor_id']) && isset($_GET['get_start_time'])) {
    $room_id = $_GET['room_id'];
    $sy = $_GET['sy'];
    $day = $_GET['day'];
    $semester = $_GET['semester'];
    $instructor_id = $_GET['instructor_id'];

    //get the schedule 
    $stmt = $pdo->prepare('SELECT start_time,end_time FROM schedule WHERE room_id = :room_id AND day = :day AND semester = :semester AND code LIKE :sy');
    $stmt->execute(['room_id' => $room_id, 'sy' => "%$sy", 'day' => $day, 'semester' => $semester]);
    $schedules = $stmt->fetchAll();

    //fetch the schedule where instructor is teaching
    $stmt = $pdo->prepare('SELECT start_time,end_time FROM schedule WHERE instructor_id = :instructor_id AND day = :day AND semester = :semester AND code LIKE :sy');
    $stmt->execute(['instructor_id' => $instructor_id, 'sy' => "%$sy", 'day' => $day, 'semester' => $semester]);
    $instructor_schedules = $stmt->fetchAll();

    $availableSlots0800to1600 = [];

    // Loop from 8:00 to 16:00 and check availability
    $currTime = strtotime('08:00:00');
    while ($currTime <= strtotime('16:00:00')) {
        $desiredStartTime = date('H:i:s', $currTime);
        $display_time = date('h:i A', $currTime);

        $slotAvailable = true;
        foreach ($schedules as $slot) {
            $startTime = strtotime($slot['start_time']);
            $endTime = strtotime($slot['end_time']);

            if ($startTime <= $currTime && $endTime > $currTime) {
                $slotAvailable = false;
                break; // No need to continue checking if one slot overlaps
            }
        }

        foreach ($instructor_schedules as $slot) {
            $startTime = strtotime($slot['start_time']);
            $endTime = strtotime($slot['end_time']);
            if ($startTime <= $currTime && $endTime > $currTime) {
                $slotAvailable = false;
                break; // No need to continue checking if one slot overlaps
            }
        }

        if ($slotAvailable) {
            $availableSlots0800to1600[] = ['value' => $desiredStartTime, 'display' => $display_time];
        }

        $currTime += 1800; // Move to the next 30-minute slot
    }
    if ($availableSlots0800to1600 == null) {
        echo "<option disabled selected value> -- no available time -- </option>";
        exit();
    }

    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($availableSlots0800to1600 as $time) {
        echo "<option value='" . $time['value'] . "'>" . $time['display'] . "</option>";
    }
}


//end time ========================================================================================================
if (isset($_GET['room_id']) && isset($_GET['sy']) && isset($_GET['day']) && isset($_GET['semester']) && isset($_GET['instructor_id']) && isset($_GET['start_time']) && isset($_GET['get_end_time'])) {
    //get the end time
    $start_time = $_GET['start_time'];
    $start_time = strtotime($start_time) + 1800;
    $end_time = strtotime('17:00:00');
    $room_id = $_GET['room_id'];
    $sy = $_GET['sy'];
    $day = $_GET['day'];
    $semester = $_GET['semester'];
    $instructor_id = $_GET['instructor_id'];

    $stmt = $pdo->prepare('SELECT start_time,end_time FROM schedule WHERE room_id = :room_id AND day = :day AND semester = :semester AND code LIKE :sy');
    $stmt->execute(['room_id' => $room_id, 'sy' => "%$sy", 'day' => $day, 'semester' => $semester]);
    $schedules = $stmt->fetchAll();

    //fetch the schedule where instructor is teaching
    $stmt = $pdo->prepare('SELECT start_time,end_time FROM schedule WHERE instructor_id = :instructor_id AND day = :day AND semester = :semester AND code LIKE :sy');
    $stmt->execute(['instructor_id' => $instructor_id, 'sy' => "%$sy", 'day' => $day, 'semester' => $semester]);
    $instructor_schedules = $stmt->fetchAll();

    $availableSlots0800to1600 = [];

    // Loop from 8:00 to 16:00 and check availability
    $currTime = $start_time;
    while ($currTime <= $end_time) {
        $desiredStartTime = date('H:i:s', $currTime);
        $display_time = date('h:i A', $currTime);

        $slotAvailable = true;
        foreach ($schedules as $slot) {
            $startTime = strtotime($slot['start_time']);
            $endTime = strtotime($slot['end_time']);

            if ($startTime <= $currTime && $endTime >= $currTime) {
                $slotAvailable = false;
                break; // No need to continue checking if one slot overlaps
            }
        }
        foreach ($instructor_schedules as $slot) {
            $startTime = strtotime($slot['start_time']);
            $endTime = strtotime($slot['end_time']);

            if ($startTime <= $currTime && $endTime >= $currTime) {
                $slotAvailable = false;
                break; // No need to continue checking if one slot overlaps
            }
        }

        if ($slotAvailable) {
            $availableSlots0800to1600[] = ['value' => $desiredStartTime, 'display' => $display_time];
        }

        $currTime += 1800; // Move to the next 30-minute slot
    }
    if ($availableSlots0800to1600 == null) {
        echo "<option disabled selected value> -- no available time -- </option>";
        exit();
    }

    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($availableSlots0800to1600 as $time) {
        echo "<option value='" . $time['value'] . "'>" . $time['display'] . "</option>";
    }
}

function getSubject($pdo, $subject_id)
{
    $stmt = $pdo->prepare('SELECT * FROM subject WHERE subject_id = :subject_id');
    $stmt->execute(['subject_id' => $subject_id]);
    $subject = $stmt->fetch();
    return $subject;
}

function get_lecture_lab_count($pdo, $subject_id, $section_id, $sy)
{
    $stmt = $pdo->prepare('SELECT SUM(lecture_count) AS lecture_count, SUM(laboratory_count) AS laboratory_count FROM `schedule` JOIN unit_counter ON schedule.schedule_id = unit_counter.schedule_id WHERE subject_id = :subject_id AND section_id = :section_id AND schedule.code LIKE :sy');
    $stmt->execute(['subject_id' => $subject_id, 'section_id' => $section_id, 'sy' => "%$sy"]);
    $schedule_counts = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch instead of fetchAll
    return $schedule_counts;
}
