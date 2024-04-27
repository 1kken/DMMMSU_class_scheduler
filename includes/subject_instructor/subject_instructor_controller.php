<?php
    function is_instructor_subject_already_connected($pdo, $subject_id, $instructor_id){
        $stmt = $pdo->prepare("SELECT * FROM subject_instructor WHERE subject_id = :subject_id AND instructor_id = :instructor_id");
        $stmt->bindParam(":subject_id", $subject_id, PDO::PARAM_STR);
        $stmt->bindParam(":instructor_id", $instructor_id, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->fetch();
        return $stmt->rowCount() > 0;
    }

    function is_subject_id_existent($pdo, $subject_id){
        $stmt = $pdo->prepare("SELECT * FROM subject WHERE subject_id = :subject_id");
        $stmt->bindParam(":subject_id", $subject_id, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->fetch();
        return $stmt->rowCount() > 0;
    }

    function is_instructor_id_existent($pdo, $instructor_id){
        $stmt = $pdo->prepare("SELECT * FROM instructor WHERE instructor_id = :instructor_id");
        $stmt->bindParam(":instructor_id", $instructor_id, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->fetch();
        return $stmt->rowCount() > 0;
    }