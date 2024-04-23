<?php
    declare(strict_types=1);
    function get_instructor_name_id($pdo){
        $stmt = $pdo->prepare('SELECT instructor_id,CONCAT(last_name,",", first_name) AS fullname FROM instructor');
        $stmt->execute();
        $instructors = $stmt->fetchAll();
        return $instructors;
    } 

    function get_classroom_name_id($pdo){
        $stmt = $pdo->prepare('SELECT room_id FROM rooms');
        $stmt->execute();
        $classrooms = $stmt->fetchAll();
        return $classrooms;
    }
    function get_section_name_id($pdo){
        $stmt = $pdo->prepare('SELECT section_id FROM section');
        $stmt->execute();
        $sections = $stmt->fetchAll();
        return $sections;
    }

    function get_subject_name_id($pdo){
        $stmt = $pdo->prepare('SELECT subject_id, descriptive_title FROM subject');
        $stmt->execute();
        $subjects = $stmt->fetchAll();
        return $subjects;
    }

    function get_schedules($pdo){
        $stmt = $pdo->prepare('SELECT * FROM schedule');
        $stmt->execute();
        $schedules = $stmt->fetchAll();
        return $schedules;
    }

    //helper
    function get_rooms_sched($pdo){
        $stmt = $pdo->prepare('SELECT room_id FROM rooms');
        $stmt->execute();
        $rooms = $stmt->fetchAll();
        return $rooms;
    }

    function get_schedule($pdo, $schedule_id){
        $stmt = $pdo->prepare('SELECT * FROM schedule WHERE schedule_id = :schedule_id');
        $stmt->execute(['schedule_id' => $schedule_id]);
        $schedule = $stmt->fetch();
        return $schedule;
    }