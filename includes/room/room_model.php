<?php
declare(strict_types=1);


function get_rooms(object $pdo)
{
    $sql = "SELECT * FROM rooms";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function get_room(object $pdo, string $room_id)
{
    $sql = "SELECT * FROM rooms WHERE room_id = :room_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch();
}

function insert_room(object $pdo,string $room_id,string $room_type,string $room_priority){
    $sql = "INSERT INTO rooms (room_id, room_type, priority) VALUES (:room_id, :room_type, :priority)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_STR);
    $stmt->bindParam(':room_type', $room_type, PDO::PARAM_STR);
    $stmt->bindParam(':priority', $room_priority, PDO::PARAM_INT);
    $stmt->execute();
}

function delete_room(object $pdo, string $room_id){
    $sql = "DELETE FROM rooms WHERE room_id = :room_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_STR);
    $stmt->execute();
}

function update_room(object $pdo, string $room_id, string $room_type, string $room_priority,string $old_room_id){
    $sql = "UPDATE rooms SET room_id=:room_id, room_type = :room_type, priority = :priority WHERE room_id = :old_room_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_STR);
    $stmt->bindParam(':room_type', $room_type, PDO::PARAM_STR);
    $stmt->bindParam(':priority', $room_priority, PDO::PARAM_INT);
    $stmt->bindParam(':old_room_id', $old_room_id, PDO::PARAM_STR);
    $stmt->execute();
}