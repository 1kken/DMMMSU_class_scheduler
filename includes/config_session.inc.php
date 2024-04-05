<?php
    ini_set("session.use_only_cookies", 1);
    ini_set("session.use_strict_mode",1);

    session_set_cookie_params([
        "path" => "/",
        "domain" => "localhost",
        "secure" => true,
        "httponly" => true,
        "samesite" => "Strict"
    ]);
   
    session_start();
    if(!isset( $_SESSION["last_generation"] )) {
        regenerate_session_id();
        exit();
    }

    function regenerate_session_id(){
        session_regenerate_id(); //regenerate the id
        $_SESSION["last_generation"] = time();
    }