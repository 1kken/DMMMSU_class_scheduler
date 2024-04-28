<?php
function check_errors_si()
{
    if (isset($_SESSION["errors"])) {
        $errors = $_SESSION["errors"];
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
    unset($_SESSION["errors"]);
}
