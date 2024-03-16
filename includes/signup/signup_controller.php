<?php
    declare(strict_types=1);
function is_input_empty(string $password,string $confirmed_password, string $email)
{
    if (empty($user_name) || empty($password) || empty($email) || empty($confirmed_password)) {
        return true;
    }

    return false;
}

function is_email_invalid(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function is_email_not_existing(object $pdo,string $email){

}

function is_passwords_unequal(string $password, string $confirmed_password)
{
    if ($password !== $confirmed_password) {
        return true;
    }
    return false;
}
