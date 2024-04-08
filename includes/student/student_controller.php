<?php

declare(strict_types=1);

function is_student_id_taken(object $pdo, string $student_id)
{
    $result = get_student_id($pdo, $student_id);
    if ($result) {
        return true;
    }
    return false;
}

function is_student_email_taken(object $pdo, string $email)
{
    $result = get_student_email($pdo, $email);
    if ($result) {
        return true;
    }
    return false;
}

function check_student_id_format(string $student_id)
{
    if (preg_match("/^[0-9]{4}-[0-9]{5}$/", $student_id) && strlen($student_id) == 8) {
        return true;
    }
    return false;
}

function check_email_format(string $student_id, string $first_name, string $last_name, string $email)
{
    $name_exploded = explode(" ", $first_name);
    $generated_email = implode("", array_map(function ($name) {
        return $name[0];
    }, $name_exploded));

    // Add the last name
    $generated_email .= $last_name;

    // Add the last four digits of student_id
    $generated_email .= substr($student_id, 4, 4);

    // Add the suffix email format
    $generated_email .= "@student.dmmmsu.edu.ph";

    return $email === $generated_email;
}

function suggest_email(string $student_id, string $first_name, string $last_name)
{
    $name_exploded = explode(" ", $first_name);
    $generated_email = implode("", array_map(function ($name) {
        return $name[0];
    }, $name_exploded));

    // Add the last name
    $generated_email .= $last_name;

    // Add the last four digits of student_id
    $generated_email .= substr($student_id, 4, 4);

    // Add the suffix email format
    $generated_email .= "@student.dmmmsu.edu.ph";

    return $generated_email;
}
