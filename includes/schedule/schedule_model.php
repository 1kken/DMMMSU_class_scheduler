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
    

    function get_schedule($pdo, $schedule_id){
        $stmt = $pdo->prepare('SELECT * FROM schedule WHERE schedule_id = :schedule_id');
        $stmt->execute(['schedule_id' => $schedule_id]);
        $schedule = $stmt->fetch();
        return $schedule;
    }

    function create_schedule($pdo, $code, $room_id, $instructor_id, $day, $start_time, $end_time, $subject_id, $section_id, $sy, $type, $semester){
        $stmt = $pdo->prepare("INSERT INTO schedule (code, room_id, instructor_id, day, start_time, end_time, subject_id, section_id, sy,type,semester) VALUES (:code, :room_id, :instructor_id, :day, :start_time, :end_time, :subject_id, :section_id, :sy,:type,:semester)");
        $stmt->execute(['code' => $code, 'room_id' => $room_id, 'instructor_id' => $instructor_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'subject_id' => $subject_id, 'section_id' => $section_id, 'sy' => $sy,'type' =>$type, 'semester' => $semester]);
    }

    