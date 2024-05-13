<?php
    require_once("database_header.php");
    function get_sections_by_sy_instructor_id($pdo, $sy, $instructor_id) {
        $query = "SELECT DISTINCT section_id FROM `schedule` WHERE sy=:sy AND instructor_id = :instructor_id;";
        $pdo_statement = $pdo->prepare($query);
        $pdo_statement->execute(array(":sy" => $sy, ":instructor_id" => $instructor_id));
        return $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    }