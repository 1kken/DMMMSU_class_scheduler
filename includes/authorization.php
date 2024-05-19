<?php
define(APP_NAME, dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/config_session.inc.php");
function is_logged_in()
{
    if(isset($_SESSION["user_id"])){
        return true;
    }
    return false;
}

function is_admin()
{
    if(isset($_SESSION["admin"])){
        return true;
    }
    return false;
}