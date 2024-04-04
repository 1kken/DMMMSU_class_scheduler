<?php
require_once("./config_session.inc.php");
function is_logged_in()
{
    if(isset($_SESSION["user_id"])){
        return true;
    }
    return false;
}