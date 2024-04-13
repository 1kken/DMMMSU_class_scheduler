<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");

if (isset($_GET['student_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM student WHERE student_id = :student_id");
    $stmt->bindParam(":student_id", $_GET['student_id'], PDO::PARAM_STR);
    $stmt->execute();
    $student = $stmt->fetch();

    if ($student) {
        // Generate HTML elements with student data
        echo "<tr>";
        echo "<td>" . $student['student_id'] . "</td>";
        echo "<td>" . $student['last_name'] . "</td>";
        echo "<td>" . $student['first_name'] . "</td>";
        echo "<td>" . $student['middle_name'] . "</td>";
        echo "<td>" . $student['email'] . "</td>";
        echo "<td>" . $student['section_id'] . "</td>";
        echo "<td class='actions'>
                <form action='../../DMMMSU_class_scheduler\includes\student_handler.php' method='post'>
                    <input type='text' name='student_id' value='" . $student['student_id'] . "' hidden>
                    <button class='delete' name='delete_student'>Delete</button>
                </form>
                <form action='../../DMMMSU_class_scheduler/views/student_update.php' method='get'>
                    <input type='text' name='student_id' value='" . $student['student_id'] . "' hidden>
                    <button class='update'>Update</button>
                </form>
            </td>";
        echo "</tr>";
    } else {
        echo "<tr><td colspan='7'>No student found</td></tr>";
    }
} else {
    echo "<tr><td colspan='7'>No search term provided</td></tr>";
}
?>
