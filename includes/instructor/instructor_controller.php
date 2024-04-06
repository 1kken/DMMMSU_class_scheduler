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


