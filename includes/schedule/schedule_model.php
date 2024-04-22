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