<?php

declare(strict_types=1);
function get_instructor_id(object $pdo, string $instructor_id)
{
    $stmt = $pdo->prepare("SELECT 'instructor' AS TYPE, instructor_id AS id
                            FROM instructor
                            WHERE instructor_id = :instructor_id
                            UNION
                            SELECT 'student' AS TYPE, student_id AS id
                            FROM student
                            WHERE student_id =:instructor_id ;");
    $stmt->bindParam(":instructor_id", $instructor_id);
    $stmt->execute();
    return $stmt->fetch();
}
function get_instructor_email(object $pdo, string $instructor_email)
{
    $stmt = $pdo->prepare("SELECT * FROM instructor WHERE email = :email");
    $stmt->bindParam(":email", $instructor_email);
    $stmt->execute();
    return $stmt->fetch();
}
function get_instructors(object $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM instructor");
    $stmt->execute();
    return $stmt->fetchAll();
}

function get_instructor(object $pdo, string $instructor_id)
{
    $stmt = $pdo->prepare("SELECT * FROM instructor WHERE instructor_id = :instructor_id");
    $stmt->bindParam(":instructor_id", $instructor_id);
    $stmt->execute();
    return $stmt->fetch();
}
function insert_instructor(object $pdo, string $instructor_id, string $first_name, string $last_name, string $middle_name, string $email)
{
    if (!$middle_name) {
        $middle_name = null;
    };

    $stmt = $pdo->prepare("INSERT INTO instructor (instructor_id, first_name, last_name, middle_name, email) VALUES (:instructor_id, :first_name, :last_name, :middle_name, :email)");
    $stmt->bindParam(":instructor_id", $instructor_id);
    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":middle_name", $middle_name);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}

function delete_instructor(object $pdo, string $instructor_id)
{
    $stmt = $pdo->prepare("DELETE FROM instructor WHERE instructor_id = :instructor_id");
    $stmt->bindParam(":instructor_id", $instructor_id);
    $stmt->execute();
}

function update_instructor(object $pdo, string $old_instructor_id, string $instructor_id, string $first_name, string $last_name, string $middle_name, string $email)
{
    $stmt = $pdo->prepare("UPDATE instructor SET instructor_id= :instructor_id, first_name = :first_name, last_name = :last_name, middle_name = :middle_name, email = :email WHERE instructor_id = :old_instructor_id");
    $stmt->bindParam(":old_instructor_id", $old_instructor_id);
    $stmt->bindParam(":instructor_id", $instructor_id);
    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":middle_name", $middle_name);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}
