<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");

if (isset($_GET['user_id']) && isset($_GET['day'])&& isset($_GET['semester'])) {

    $user_id = $_GET['user_id'];
    $day = $_GET['day'];
    $semester = $_GET['semester'];

    if(empty($user_id) || empty($day) && empty($semester)){
        http_response_code(400);
        exit();
    }
    $type_user = get_if_instructor_student($pdo, $user_id); 
    if($type_user == "student"){
    $query = "SELECT schedule.`start_time`,schedule.`end_time`,subject.`descriptive_title`,schedule.room_id FROM `schedule`
              JOIN student ON schedule.`section_id` = student.`section_id`
              JOIN `subject` ON subject.`subject_id` = schedule.`subject_id`
              WHERE student.`student_id` = :student_id AND schedule.`day` = :day
              AND schedule.`semester` = :semester
              ORDER BY schedule.`start_time` ASC";
    $query = $pdo->prepare($query); 
    $query->bindParam(":student_id", $user_id, PDO::PARAM_INT);
    $query->bindParam(":semester", $semester, PDO::PARAM_INT);
    $query->bindParam(":day", $day, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as &$result){
        $result['start_time'] = date("h:i A", strtotime($result['start_time']));
        $result['end_time'] = date("h:i A", strtotime($result['end_time']));
    }
    echo json_encode($results);
    }elseif($type_user == 'instructor'){
        $query = "SELECT schedule.`start_time`,schedule.`end_time`,subject.`descriptive_title`,schedule.room_id FROM `schedule`
                  JOIN instructor ON schedule.`instructor_id` = instructor.`instructor_id`
                  JOIN `subject` ON subject.`subject_id` = schedule.`subject_id`
                  WHERE instructor.`instructor_id` = :instructor_id AND schedule.`day` = :day
                  AND schedule.`semester` = :semester
                  ORDER BY schedule.`start_time` ASC";
        $query = $pdo->prepare($query); 
        $query->bindParam(":instructor_id", $user_id, PDO::PARAM_INT);
        $query->bindParam(":semester", $semester, PDO::PARAM_INT);
        $query->bindParam(":day", $day, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as &$result){
            $result['start_time'] = date("h:i A", strtotime($result['start_time']));
            $result['end_time'] = date("h:i A", strtotime($result['end_time']));
        }
        echo json_encode($results);
    }else{
        http_response_code(404);
        echo json_encode(array("message" => "User not found"));
        exit();
    }

}

//schedule based on 

function get_if_instructor_student($pdo, $user_id){
    $student = get_student($pdo, $user_id);
    $instructor = get_instructor($pdo, $user_id);
    if($student != null){
        return "student";
    }else if($instructor != null){
        return "instructor";
    } 
    return null;
}

function get_student($pdo,$user_id){
    $query = "SELECT * FROM student WHERE student_id = :student_id";
    $query = $pdo->prepare($query);
    $query->bindParam(":student_id", $user_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_instructor($pdo, $user_id){
    $query = "SELECT * FROM instructor WHERE instructor_id = :instructor_id";
    $query = $pdo->prepare($query);
    $query->bindParam(":instructor_id", $user_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}
