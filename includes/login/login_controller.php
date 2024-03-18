<?php
function is_input_empty(string $id_number,string $password)
{
    if (empty($id_number) || empty($password)) {
        return true;
    }
    return false;
}
