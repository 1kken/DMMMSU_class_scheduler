<?php
    declare(strict_types=1);
function is_input_empty(string $password,string $confirmed_password, string $user_id,string $user_type)
{
    if (empty($password) || empty($user_id) || empty($confirmed_password) || empty($user_type)) {
        return true;
    }

    return false;
}

function is_passwords_unequal(string $password, string $confirmed_password) {
    if ($password !== $confirmed_password) {
        return true;
    }
    return false;
}

function is_user_type_invalid(string $user_type) {
    if ($user_type !== "student" && $user_type !== "instructor") {
        return true;
    }
    return false;
}

function is_user_id_not_available(object $pdo,string $user_type,string $user_id){
    $result = get_user_id_by_user_typer($pdo,$user_type,$user_id);
    if(!$result){
        return true;
    }
    return false;
}


function is_user_id_taken(object $pdo,string $user_id){
    $result = get_user_id($pdo,$user_id);
    if($result){
        return true;
    }
    return false;
}