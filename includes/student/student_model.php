<?php

declare(strict_types=1);
function get_students(object $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM student");
    $stmt->execute();
    return $stmt->fetchAll();
}

function get_sections(object $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM section");
    $stmt->execute();
    return $stmt->fetchAll();
}
function get_student(object $pdo, string $student_id)
{
    $stmt = $pdo->prepare("SELECT * FROM student WHERE student_id = :student_id");
    $stmt->bindParam(":student_id", $student_id);
    $stmt->execute();
    return $stmt->fetch();
}

function get_student_id(object $pdo, string $student_id)
{
    $stmt = $pdo->prepare("SELECT 'instructor' AS TYPE, instructor_id AS id
                            FROM instructor
                            WHERE instructor_id = :student_id
                            UNION
                            SELECT 'student' AS TYPE, student_id AS id
                            FROM student
                            WHERE student_id =:student_id;");
    $stmt->bindParam(":student_id", $student_id);
    $stmt->execute();
    return $stmt->fetch();
}

function get_student_email(object $pdo, string $email)
{
    $stmt = $pdo->prepare("SELECT * FROM student WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    return $stmt->fetch();
}

function insert_student(object $pdo, string $student_id, string $first_name, string $last_name, string $middle_name, string $email, string $section_id)
{
    $stmt = $pdo->prepare("INSERT INTO student (student_id, first_name, last_name, middle_name, email,section_id) VALUES (:student_id, :first_name, :last_name, :middle_name, :email,:section_id)");
    $stmt->bindParam(":student_id", $student_id);
    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":middle_name", $middle_name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":section_id", $section_id);
    $stmt->execute();
}

function delete_student(object $pdo, string $student_id)
{
    $stmt = $pdo->prepare("DELETE FROM student WHERE student_id = :student_id");
    $stmt->bindParam(":student_id", $student_id);
    $stmt->execute();
}

function update_student(object $pdo, string $student_id, string $first_name, string $last_name, string $middle_name, string $email, string $section_id, string $old_student_id)
{
    $stmt = $pdo->prepare("UPDATE student SET student_id = :student_id, first_name = :first_name, last_name = :last_name, middle_name = :middle_name, email = :email, section_id = :section_id WHERE student_id = :old_student_id");
    $stmt->bindParam(":student_id", $student_id);
    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":middle_name", $middle_name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":old_student_id", $old_student_id);
    $stmt->bindParam(":section_id", $section_id);
    $stmt->execute();
}

function create_student_history($pdo, $student_id, $section_id)
{
    $currentYear = date('Y');
    $nextYear = $currentYear + 1;
    $sy = $currentYear . "-" . $nextYear;
    $stmt = $pdo->prepare("INSERT INTO student_history (student_id, section_id, sy) VALUES (:student_id, :section_id, :sy)");
    $stmt->bindParam(":student_id", $student_id);
    $stmt->bindParam(":section_id", $section_id);
    $stmt->bindParam(":sy", $sy);
    $stmt->execute();
}

function update_history($pdo,$student_id,$section_id){
    $currentYear = date('Y');
    $nextYear = $currentYear + 1;
    $sy = $currentYear . "-" . $nextYear;
    $stmt = $pdo->prepare("UPDATE student_history SET section_id = :section_id WHERE student_id = :student_id AND sy = :sy");
    $stmt->bindParam(":student_id", $student_id);
    $stmt->bindParam(":section_id", $section_id);
    $stmt->bindParam(":sy", $sy);
    $stmt->execute(); 
}

function get_student_history(object $pdo, string $student_id,string $sy)
{
    $stmt = $pdo->prepare("SELECT * FROM student_history WHERE student_id = :student_id AND sy = :sy");
    $stmt->bindParam(":student_id", $student_id);
    $stmt->bindParam(":sy", $sy);
    $stmt->execute();
    return $stmt->fetch();
}
