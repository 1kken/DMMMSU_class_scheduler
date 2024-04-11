<?php
    declare(strict_types=1);
    function get_subjects(object $pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM subject");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function get_subject_id(object $pdo, string $subject_id)
    {
        $stmt = $pdo->prepare("SELECT * FROM subject WHERE subject_id = :subject_id");
        $stmt->bindParam(':subject_id', $subject_id,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    function insert_subject(object $pdo, string $subject_id, string $descriptive_title, string $lecture_units, string $laboratory_units, string $total_units, string $priority)
    {
        $stmt = $pdo->prepare("INSERT INTO subject(subject_id, descriptive_title, lecture_units, laboratory_units, total_units, priority) VALUES(:subject_id, :descriptive_title, :lecture_units, :laboratory_units, :total_units, :priority)");
        $stmt->bindParam(':subject_id', $subject_id,PDO::PARAM_STR);
        $stmt->bindParam(':descriptive_title', $descriptive_title,PDO::PARAM_STR);
        $stmt->bindParam(':lecture_units', $lecture_units,PDO::PARAM_INT);
        $stmt->bindParam(':laboratory_units', $laboratory_units,PDO::PARAM_INT);
        $stmt->bindParam(':total_units', $total_units,PDO::PARAM_INT);
        $stmt->bindParam(':priority', $priority,PDO::PARAM_INT);
        $stmt->execute();
    }

    function delete_subject(object $pdo, string $subject_id)
    {
        $stmt = $pdo->prepare("DELETE FROM subject WHERE subject_id = :subject_id");
        $stmt->bindParam(':subject_id', $subject_id,PDO::PARAM_STR);
        $stmt->execute();
    }

    function get_subject(object $pdo, string $subject_id)
    {
        $stmt = $pdo->prepare("SELECT * FROM subject WHERE subject_id = :subject_id");
        $stmt->bindParam(':subject_id', $subject_id,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    function update_subject(object $pdo, string $subject_id, string $descriptive_title, string $lecture_units, string $laboratory_units, string $total_units, string $priority, string $old_subject_id)
    {
        $stmt = $pdo->prepare("UPDATE subject SET subject_id = :subject_id, descriptive_title = :descriptive_title, lecture_units = :lecture_units, laboratory_units = :laboratory_units, total_units = :total_units, priority = :priority WHERE subject_id = :old_subject_id");
        $stmt->bindParam(':subject_id', $subject_id,PDO::PARAM_STR);
        $stmt->bindParam(':descriptive_title', $descriptive_title,PDO::PARAM_STR);
        $stmt->bindParam(':lecture_units', $lecture_units,PDO::PARAM_INT);
        $stmt->bindParam(':laboratory_units', $laboratory_units,PDO::PARAM_INT);
        $stmt->bindParam(':total_units', $total_units,PDO::PARAM_INT);
        $stmt->bindParam(':priority', $priority,PDO::PARAM_INT);
        $stmt->bindParam(':old_subject_id', $old_subject_id,PDO::PARAM_STR);
        $stmt->execute();
    }


