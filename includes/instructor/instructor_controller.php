<?php

declare(strict_types=1);
function is_instructor_id_taken(object $pdo, string $instructor_id)
{
    $result = get_instructor_id($pdo, $instructor_id);
    if ($result) {
        return true;
    }
    return false;
}

function is_instructor_email_taken(object $pdo, string $instructor_email)
{
    $result = get_instructor_email($pdo, $instructor_email);
    if($result){
        return true;
    }
    return false;
}

function check_email_format_instructor(string $instructor_id, string $first_name, string $last_name, string $email)
{
    $name_exploded = explode(" ", $first_name);
    $generated_email = implode("", array_map(function ($name) {
        return $name[0];
    }, $name_exploded));

    // Add the last name
    $generated_email .= $last_name;

    // Add the last four digits of student_id
    $generated_email .= substr($instructor_id, 4, 4);

    // Add the suffix email format
    $generated_email .= "@instructor.dmmmsu.edu.ph";

    return $email === $generated_email;
}
function check_instructor_id_format(string $instructor_id)
{
    if (strlen($instructor_id) == 8) {
        return true;
    }
    return false;
}

function suggest_email_instructor(string $instructor_id, string $first_name, string $last_name)
{
    $last_name = str_replace(' ', '', $last_name); 
    $name_exploded = explode(" ", $first_name);
    $generated_email = implode("", array_map(function ($name) {
        return $name[0];
    }, $name_exploded));

    // Add the last name
    $generated_email .= $last_name;

    // Add the last four digits of student_id
    $generated_email .= substr($instructor_id, 4, 4);

    // Add the suffix email format
    $generated_email .= "@instructor.dmmmsu.edu.ph";

    return $generated_email;
}


