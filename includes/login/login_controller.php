<?php
function is_input_empty(string $id_number,string $password, string $user_type)
{
    if (empty($id_number) || empty($password) || empty($user_type)) {
        return true;
    }
    return false;
}

{
    if (empty($id_number) || empty($password)) {
        return true;
    }
    return false;
}

function is_id_number_wrong(bool|array $result){
    if(!$result){
        return true;
    }
    return false;
}

function is_password_wrong(string $password,string $hashed_password){
    if(!password_verify($password,$hashed_password)){
        return true;
    }
    return false;
}
