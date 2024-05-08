<?php
    function get_all_available_school_year($pdo){
        $sql = "SELECT DISTINCT sy FROM schedule";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $sql;
    }
    function get_all_sections($pdo){
        $sql = "SELECT DISTINCT section_id FROM schedule";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $sql;
    }

    function get_student($pdo,$student_id){
        $sql = "SELECT CONCAT(last_name,' ',first_name) AS full_name,section_id FROM student WHERE student_id = :student_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['student_id' => $student_id]);
        return $stmt->fetch();
    }

    function get_instructor($pdo,$instructor_id){
        $sql = "SELECT CONCAT(last_name,' ',first_name) AS full_name FROM instructor WHERE instructor_id = :instructor_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['instructor_id' => $instructor_id]);
        return $stmt->fetch();
    }

