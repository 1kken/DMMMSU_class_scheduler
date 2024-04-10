<?php
declare(strict_types=1);
function is_room_id_taken(object $pdo, string $room_id): bool
{
    $sql = "SELECT COUNT(*) FROM rooms WHERE room_id = :room_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}