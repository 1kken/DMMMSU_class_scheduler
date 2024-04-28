<?php
    function get_subject_instructors($pdo) {
        $stmt = $pdo->prepare("SELECT si.si_id, si.subject_id,si.instructor_id, CONCAT(i.last_name, ', ', i.first_name) AS instructor_name
                                FROM subject_instructor si
                                JOIN subject s ON si.subject_id = s.subject_id
                                JOIN instructor i ON si.instructor_id = i.instructor_id");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function get_subject_instructor($pdo,$si_id) {
        $stmt = $pdo->prepare("SELECT si.si_id, si.subject_id,si.instructor_id, CONCAT(i.last_name, ', ', i.first_name) AS instructor_name
                                FROM subject_instructor si
                                JOIN subject s ON si.subject_id = s.subject_id
                                JOIN instructor i ON si.instructor_id = i.instructor_id
                                WHERE si.si_id = :si_id");
        $stmt->bindParam(":si_id", $si_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    function get_instructors($pdo) {
        $stmt = $pdo->prepare("SELECT instructor_id, CONCAT(last_name, ', ', first_name) AS instructor_name FROM instructor");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function get_subjects($pdo) {
        $stmt = $pdo->prepare("SELECT subject_id FROM subject");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function create_subject_instructor($pdo, $subject_id, $instructor_id) {
        $stmt = $pdo->prepare("INSERT INTO subject_instructor (subject_id, instructor_id) VALUES (:subject_id, :instructor_id)");
        $stmt->bindParam(":subject_id", $subject_id, PDO::PARAM_STR);
        $stmt->bindParam(":instructor_id", $instructor_id, PDO::PARAM_STR);
        $stmt->execute();
    }

    function delete_subject_instructor($pdo, $si_id) {
        $stmt = $pdo->prepare("DELETE FROM subject_instructor WHERE si_id = :si_id");
        $stmt->bindParam(":si_id", $si_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    function update_subject_instructor($pdo, $si_id, $subject_id, $instructor_id) {
        $stmt = $pdo->prepare("UPDATE subject_instructor SET subject_id = :subject_id, instructor_id = :instructor_id WHERE si_id = :si_id");
        $stmt->bindParam(":si_id", $si_id, PDO::PARAM_INT);
        $stmt->bindParam(":subject_id", $subject_id, PDO::PARAM_STR);
        $stmt->bindParam(":instructor_id", $instructor_id, PDO::PARAM_STR);
        $stmt->execute();
    }