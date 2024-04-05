<?php
declare(strict_types=1);
function display_all_instructors(array $instructors)
{

    // Display instructor records
    foreach ($instructors as $instructor) {
        echo "<tr>";
        echo "<td>" . $instructor['instructor_id'] . "</td>";
        echo "<td>" . $instructor['last_name'] . "</td>";
        echo "<td>" . $instructor['first_name'] . "</td>";
        echo "<td>" . $instructor['middle_name'] . "</td>";
        echo "<td>" . $instructor['email'] . "</td>";
        echo "<td class='actions'><button class='delete'>Delete</button> <button class='update'>Update</button></td>";
        echo "</tr>";
    }
}
