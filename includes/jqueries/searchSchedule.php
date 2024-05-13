<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");
if (isset($_GET['code_desc'])) {
    $stmt = $pdo->prepare("SELECT * FROM `schedule` 
                            JOIN `subject` ON `subject`.`subject_id` = `schedule`.`subject_id`
                            WHERE `schedule`.`code` LIKE :code OR `subject`.`descriptive_title` LIKE :code ;");
    $code_desc = $_GET['code_desc'] . "%";
    $stmt->bindParam(":code", $code_desc, PDO::PARAM_STR);
    $stmt->execute();
    $schedules = $stmt->fetchAll();
    // Display schedule records
    // Display schedule records
    if ($schedules) {
        foreach ($schedules as $schedule) {
            // Display schedule records
            foreach ($schedules as $schedule) {
                $schedule_id = $schedule['schedule_id'];
                $code = $schedule['code'];
                echo "<tr>";
                echo "<td>" . $schedule['code'] . "</td>";
                echo "<td>" . $schedule['start_time'] . "</td>";
                echo "<td>" . $schedule['end_time'] . "</td>";
                echo "<td>" . $schedule['section_id'] . "</td>";
                echo "<td>" . $schedule['day'] . "</td>";
                echo "<td>" . $schedule['sy'] . "</td>";
                echo "<td class='actions'>
                                <form action='../includes/schedule_handler.php' method='post'>
                                    <input type='text' name='schedule_id' value='$schedule_id' hidden>
                                    <button class='delete' name='delete_schedule'>Delete</button>
                                </form>
                                <form action='../views/schedule_update.php' method='get'>
                                    <input type='text' name='schedule_id' value='$schedule_id' hidden>
                                    <button class='update'>Update</button>
                                </form>
                            </td>";
                echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='7'>No schedule found</td></tr>";
    }
} else {
    echo "<tr><td colspan='7'>No search term provided</td></tr>";
}
