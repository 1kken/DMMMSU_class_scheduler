<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");

if (isset($_GET['type']) && isset($_GET['subject_id']) &&  isset($_GET['get_room'])) {
    $type = $_GET['type'];
    $subject_id = $_GET['subject_id'];
    $get_room = $_GET['get_room'];
    $stmt = $pdo->prepare("SELECT DISTINCT rooms.room_id 
FROM rooms 
JOIN SUBJECT ON rooms.priority = subject.priority 
JOIN SCHEDULE ON schedule.subject_id = subject.subject_id 
WHERE subject.subject_id = :subject_id AND rooms.room_type = schedule.type;");
    $stmt->bindParam(':subject_id', $subject_id);
    $stmt->execute();
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //echo in option
    if($rooms != null){
        echo "<option disabled selected value> -- select an option -- </option>";
        foreach ($rooms as $room) {
            echo "<option value='" . $room['room_id'] . "'>" . $room['room_id'] . "</option>";
        }
    }else{
        echo "<option value='' disabled >No Room Available</option>";
    }
}

if (isset($_GET['new_room_id']) && isset($_GET['get_day']) && isset($_GET['sy'])) {
    //get the day where the room is available
    $room_id = $_GET['room_id'];
    $sy = $_GET['sy'];

    // Function to convert HH:MM time format to Unix timestamp
    function timeToTimestamp($time)
    {
        return strtotime($time);
    }

    $days = ['monday', 'tuesday', 'wednesday','thursday','friday','saturday']; // Add other days as needed

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

if (isset($_GET['new_room_id']) && isset($_GET['sy']) && isset($_GET['get_start_time'])) {
    //get the schedule 
    $room_id = $_GET['new_room_id'];
    $sy = $_GET['sy'];
    $day = $_GET['new_day'];
    $semester = $_GET['semester'];
    $stmt = $pdo->prepare('SELECT start_time,end_time FROM schedule WHERE room_id = :room_id AND day = :day AND semester = :semester AND code LIKE :sy');
    $stmt->execute(['room_id' => $room_id, 'sy' => "%$sy", 'day' => $day, 'semester' => $semester]);
    $schedules = $stmt->fetchAll();

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

        if ($slotAvailable) {
            $availableSlots0800to1600[] = ['value' => $desiredStartTime, 'display' => $display_time];
        }

        $currTime += 1800; // Move to the next 30-minute slot
    }
    if($availableSlots0800to1600 == null){
        echo "<option disabled selected value> -- no available time -- </option>";
        exit();
    }

    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($availableSlots0800to1600 as $time) {
        echo "<option value='" . $time['value'] . "'>" . $time['display'] . "</option>";
    }
}
if (isset($_GET['room_id']) && isset($_GET['sy']) && isset($_GET['get_start_time'])) {
    //get the schedule 
    $room_id = $_GET['room_id'];
    $sy = $_GET['sy'];
    $day = $_GET['day'];
    $semester = $_GET['semester'];
    $stmt = $pdo->prepare('SELECT start_time,end_time FROM schedule WHERE room_id = :room_id AND day = :day AND semester = :semester AND code LIKE :sy');
    $stmt->execute(['room_id' => $room_id, 'sy' => "%$sy", 'day' => $day, 'semester' => $semester]);
    $schedules = $stmt->fetchAll();

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

        if ($slotAvailable) {
            $availableSlots0800to1600[] = ['value' => $desiredStartTime, 'display' => $display_time];
        }

        $currTime += 1800; // Move to the next 30-minute slot
    }
    if($availableSlots0800to1600 == null){
        echo "<option disabled selected value> -- no available time -- </option>";
        exit();
    }

    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($availableSlots0800to1600 as $time) {
        echo "<option value='" . $time['value'] . "'>" . $time['display'] . "</option>";
    }
}

if(isset($_GET['start_time']) && isset($_GET['get_end_time'])){
    //get the end time
    $start_time = $_GET['new_start_time'];
    $start_time = strtotime($start_time) + 1800;
    $end_time = strtotime('17:00:00');
    while($start_time <= $end_time){
        $value_time = date('H:i:s', $start_time);
        $display_time = date('h:i A', $start_time);
        echo "<option value='" . $value_time . "'>" .$display_time. "</option>";
        $start_time += 1800;
    }
}