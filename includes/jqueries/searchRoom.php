<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");

if (isset($_GET['room_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM rooms WHERE room_id = :room_id");
    $stmt->bindParam(":room_id", $_GET['room_id'], PDO::PARAM_STR);
    $stmt->execute();
    $room = $stmt->fetch();

    if ($room) {
        // Generate HTML elements with room data
        echo "<tr>";
        echo "<td>" . $room['room_id'] . "</td>";
        echo "<td>" . $room['room_type'] . "</td>";
        echo "<td>" . $room['priority'] . "</td>";
        echo "<td class='actions'>
                <form action='../../DMMMSU_class_scheduler\includes/room_handler.php' method='post'>
                    <input type='text' name='room_id' value='" . $room['room_id'] . "' hidden>
                    <button class='delete' name='delete_room'>Delete</button>
                </form>
                <form action='../../DMMMSU_class_scheduler/views/room_update.php' method='get'>
                    <input type='text' name='room_id' value='" . $room['room_id'] . "' hidden>
                    <button class='update'>Update</button>
                </form>
            </td>";
        echo "</tr>";
    } else {
        echo "<tr><td colspan='5'>No room found</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>No search term provided</td></tr>";
}