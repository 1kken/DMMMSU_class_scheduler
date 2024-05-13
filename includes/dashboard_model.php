<?php
require_once("database_header.php");
require_once('config_session.inc.php');

if(!isset($_SESSION["user_id"])){
    header("LOCATION: ../views/auths/log_in_page.php");
    exit();
}


    function get_full_name_user(object $pdo, string $user_id): string{
            $stmt = $pdo->prepare("SELECT first_name,last_name
                            FROM instructor
                            WHERE instructor_id = :user_id
                            UNION
                            SELECT first_name,last_name
                            FROM student
                            WHERE student_id =:user_id;");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['first_name'] . " " . $result['last_name'];
    }

    function get_count_students(object $pdo): int{
        $stmt = $pdo->prepare("SELECT COUNT(student_id) as count
                            FROM student;");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }

    function get_count_instructors(object $pdo): int{
        $stmt = $pdo->prepare("SELECT COUNT(instructor_id) as count
                            FROM instructor;");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }

    function get_count_rooms(object $pdo): int{
        $stmt = $pdo->prepare("SELECT COUNT(room_id) as count
                            FROM rooms;");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }

    function get_count_subjects(object $pdo): int{
        $stmt = $pdo->prepare("SELECT COUNT(subject_id) as count
                            FROM subject;");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }

    function get_count_schedule($pdo){
        $stmt = $pdo->prepare("SELECT COUNT(schedule_id) as count
                            FROM schedule;");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }

    function get_count_subject_instructor($pdo){
        $stmt = $pdo->prepare("SELECT COUNT(si_id) as count
                            FROM subject_instructor;");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }
