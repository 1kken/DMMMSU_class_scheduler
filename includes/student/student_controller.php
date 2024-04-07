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
        if (preg_match("/^[0-9]{4}-[0-9]{5}$/", $student_id) && strlen($student_id) == 8){
            return true;
        }
        return false;
    }