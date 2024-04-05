<?php
declare(strict_types=1);
function display_all_instructors(array $instructors)
{

    // Display instructor records
    foreach ($instructors as $instructor) {
        $instructor_id = $instructor['instructor_id'];
        echo "<tr>";
        echo "<td>" . $instructor['instructor_id'] . "</td>";
        echo "<td>" . $instructor['last_name'] . "</td>";
        echo "<td>" . $instructor['first_name'] . "</td>";
        echo "<td>" . $instructor['middle_name'] . "</td>";
        echo "<td>" . $instructor['email'] . "</td>";
        echo "<td class='actions'>
            <form action='../../DMMMSU_class_scheduler\includes\instructor_handler.php' method='post'>
                <input type='text' name='instructor_id' value=$instructor_id hidden>
                <button class='delete' name='delete_instructor'>Delete</button>
                <button class='update'>Update</button>
            </form>
         </td>";

        echo "</tr>";
    }
}
