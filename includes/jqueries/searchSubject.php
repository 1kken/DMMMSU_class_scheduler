<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");
//subject
if (isset($_GET['subject_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM subject WHERE subject_id = :subject_id");
    $stmt->bindParam(":subject_id", $_GET['subject_id'], PDO::PARAM_STR);
    $stmt->execute();
    $subject = $stmt->fetch();

    if ($subject) {
        // Generate HTML elements with subject data
        echo "<tr>";
        echo "<td>" . $subject['subject_id'] . "</td>";
        echo "<td>" . $subject['descriptive_title'] . "</td>";
        echo "<td>" . $subject['lecture_units'] . "</td>";
        echo "<td>" . $subject['laboratory_units'] . "</td>";
        echo "<td>" . $subject['total_units'] . "</td>";
        echo "<td>" . $subject['priority'] . "</td>";
        echo "<td class='actions'>
                <form action='../../DMMMSU_class_scheduler\includes/subject_handler.php' method='post'>
                    <input type='text' name='subject_id' value='" . $subject['subject_id'] . "' hidden>
                    <button class='delete' name='delete_subject'>Delete</button>
                </form>
                <form action='../../DMMMSU_class_scheduler/views/subject_update.php' method='get'>
                    <input type='text' name='subject_id' value='" . $subject['subject_id'] . "' hidden>
                    <button class='update'>Update</button>
                </form>
            </td>";
        echo "</tr>";
    } else {
        echo "<tr><td colspan='6'>No subject found</td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>No search term provided</td></tr>";
}
