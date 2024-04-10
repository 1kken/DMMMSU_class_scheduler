<?php
require_once("database_header.php");
require_once('config_session.inc.php');
require_once('room/room_model.php');
require_once('room/room_controller.php');

if (isset($_POST["create_room"]) && isset($_SESSION["user_id"])) {
    $room_id = $_POST["room_id"];
    $room_type = $_POST["room_type"];
    $room_priority = $_POST["room_priority"];


    $errors = [];
    if (is_room_id_taken($pdo, $room_id)) {
        $errors[] = "Room ID is already taken";
    }

    if ($errors) {
        $_SESSION["room_errors"] = $errors;
        header("LOCATION: /DMMMSU_class_scheduler/views/auths/room.php");
        exit();
    }

    header("LOCATION: /DMMMSU_class_scheduler/views/auths/room.php");

    $pdo = null;
    $stmt = null;
}
