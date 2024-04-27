<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");


//get the proper subjects
if(isset($_GET["instructor_id"]) && (strlen(trim($_GET["instructor_id"])) > 0)){
    //get the proper subjects where the instructor can teach and available for the that time using day, start_time, and end_time
    $stmt = $pdo->prepare("SELECT * FROM subject WHERE subject_id IN (SELECT subject_id FROM subject_instructor WHERE instructor_id = :instructor_id) AND subject_id NOT IN (SELECT subject_id FROM schedule WHERE day = :day AND ((start_time <= :start_time AND end_time >= :start_time) OR (start_time <= :end_time AND end_time >= :end_time)))");
    $stmt->execute(['instructor_id' => $_GET["instructor_id"], 'day' => $_GET["day"], 'start_time' => $_GET["start_time"], 'end_time' => $_GET["end_time"]]);
    $subjects = $stmt->fetchAll();

    if($subjects == null){
        echo "<option disabled selected value> -- no available subject -- </option>";
        exit();
    }
    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach($subjects as $subject){
        echo "<option value='" . $subject["subject_id"] . "'>" . $subject["descriptive_title"] . "</option>";
    }
}
if(isset($_GET["instructor_id"]) && (strlen(trim($_GET["instructor_id"])) == 0)){
    //get all subjects
    $stmt = $pdo->prepare('SELECT subject_id, descriptive_title FROM subject');
    $stmt->execute();
    $subjects = $stmt->fetchAll();

    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach($subjects as $subject){
        echo "<option value='" . $subject["subject_id"] . "'>" . $subject["descriptive_title"] . "</option>";
    }
}
