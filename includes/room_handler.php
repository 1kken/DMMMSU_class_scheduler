<?php
require_once("database_header.php");
require_once('config_session.inc.php');
require_once('room/room_model.php');
require_once('room/room_controller.php');

if (isset($_POST["create_room"]) && isset($_SESSION["user_id"])) {
    $room_id = $_POST["room_id"];
    $room_type = $_POST["room_type"];
    $room_priority = $_POST["room_priority"];
    $room_id = strtoupper($room_id);


    $errors = [];
    if (is_room_id_taken($pdo, $room_id)) {
        $errors[] = "Room ID is already taken";
    }

    if(!is_room_id_valid($room_id)){
        $errors[] = "Invalid room ID";
    }

    if(!is_room_priority_valid($room_priority)){
        $errors[] = "Invalid room priority";
    } 

    if(!is_room_type_valid($room_type)){
        $errors[] = "Invalid room type";
    }

    if ($errors) {
        $_SESSION["room_errors"] = $errors;
        header("LOCATION: /DMMMSU_class_scheduler/views/room.php");
        exit();
    }

    try {
        insert_room($pdo, $room_id, $room_type, $room_priority);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    header("LOCATION: /DMMMSU_class_scheduler/views/room.php");

    $pdo = null;
    $stmt = null;
}

if(isset($_POST['delete_room']) && isset($_SESSION["user_id"])){
    $room_id = $_POST["room_id"];
    try {
        delete_room($pdo, $room_id);
        header("LOCATION: /DMMMSU_class_scheduler/views/room.php");
        exit();
    } catch (\Throwable $th) {
        echo "Error: " . $th->getMessage();
    }
}

if(isset($_POST['update_room']) && isset($_SESSION["user_id"])){
    $room_id = $_POST["room_id"];
    $room_type = $_POST["room_type"];
    $room_priority = $_POST["room_priority"];
    $old_room_id = $_POST["old_room_id"];

    $errors = [];

    if($room_id != $old_room_id){
        if (is_room_id_taken($pdo, $room_id)) {
            $errors[] = "Room ID is already taken";
        }
    }

    if(!is_room_id_valid($room_id)){
        $errors[] = "Invalid room ID";
    }

    if(!is_room_priority_valid($room_priority)){
        $errors[] = "Invalid room priority";
    } 

    if(!is_room_type_valid($room_type)){
        $errors[] = "Invalid room type";
    }

    if ($errors) {
        $_SESSION["room_errors"] = $errors;
        header("LOCATION: /DMMMSU_class_scheduler/views/room_update.php?room_id=$old_room_id");
        exit();
    }

    try {
        update_room($pdo, $room_id, $room_type, $room_priority,$old_room_id);
        header("LOCATION: /DMMMSU_class_scheduler/views/room.php");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    header("LOCATION: /DMMMSU_class_scheduler/views/room.php");

    $pdo = null;
    $stmt = null;
}