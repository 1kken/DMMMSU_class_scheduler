<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");
//schedule for today based on student id, day
if (isset($_GET['student_id']) && isset($_GET['day'])) {
    $student_id = $_GET['student_id'];
    $day = $_GET['day'];

    if(empty($student_id) || empty($day)){
        echo json_encode(array("message" => "Please provide student id and day"));
        exit();
    }

    $query = "SELECT schedule.`start_time`,schedule.`end_time`,subject.`descriptive_title` FROM `schedule`
              JOIN student ON schedule.`section_id` = student.`section_id`
              JOIN `subject` ON subject.`subject_id` = schedule.`subject_id`
              WHERE student.`student_id` = :student_id AND schedule.`day` = :day;
              ORDER BY schedule.`start_time` ASC";
    $query = $pdo->prepare($query); 
    $query->bindParam(":student_id", $student_id, PDO::PARAM_INT);
    $query->bindParam(":day", $day, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as &$result){
        $result['start_time'] = date("h:i A", strtotime($result['start_time']));
        $result['end_time'] = date("h:i A", strtotime($result['end_time']));
    }
    echo json_encode($results);

}
