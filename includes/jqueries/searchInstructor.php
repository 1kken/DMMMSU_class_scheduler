<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");

if (isset($_GET['instructor_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM instructor WHERE instructor_id = :instructor_id");
    $stmt->bindParam(":instructor_id", $_GET['instructor_id'], PDO::PARAM_STR);
    $stmt->execute();
    $instructor = $stmt->fetch();

    if ($instructor) {
        echo "<tr>";
        echo "<td>" . $instructor['instructor_id'] . "</td>";
        echo "<td>" . $instructor['last_name'] . "</td>";
        echo "<td>" . $instructor['first_name'] . "</td>";
        echo "<td>" . $instructor['middle_name'] . "</td>";
        echo "<td>" . $instructor['email'] . "</td>";
        echo "<td class='actions'>
                <form action='../../DMMMSU_class_scheduler\includes\instructor_handler.php' method='post'>
                    <input type='text' name='instructor_id' value='" . $instructor['instructor_id'] . "' hidden>
                    <button class='delete' name='delete_instructor'>Delete</button>
                </form>
                <form action='../../DMMMSU_class_scheduler/views/instructor_update.php' method='get'>
                    <input type='text' name='instructor_id' value='" . $instructor['instructor_id'] . "' hidden>
                    <button class='update'>Update</button>
                </form>
            </td>";
        echo "</tr>";
    } else {
        echo "<tr><td colspan='7'>No instructor found</td></tr>";
    }
} else {
    echo "<tr><td colspan='7'>No search term provided</td></tr>";
}