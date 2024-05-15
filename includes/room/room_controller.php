<?php
declare(strict_types=1);
function is_room_id_taken(object $pdo, string $room_id)
{
    $sql = "SELECT COUNT(*) FROM rooms WHERE room_id = :room_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

function is_room_id_valid(string $room_id)
{
    return preg_match('/[A-Z]+[0-9]+/', $room_id);
}

function is_room_type_valid(string $room_type)
{
    return $room_type === 'Lecture' || $room_type === 'Laboratory';
}

function is_room_priority_valid(int $room_priority)
{
    return $room_priority >= 1 && $room_priority <= 5;
}