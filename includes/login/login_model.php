<?php

declare(strict_types=1);
function get_user(object $pdo, string $id_number, string $user_type)
{
    if ($user_type === "student") {
        $sql = "SELECT * FROM user WHERE student_id = :id_number";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_number", $id_number, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    if ($user_type === "instructor") {
        $sql = "SELECT * FROM user WHERE instructor_id = :id_number";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_number", $id_number, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}
