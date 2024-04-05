
<?php
require_once("database_header.php");
require_once('instructor/instructor_model.php');
require_once('instructor/instructor_controller.php');
function fetch_instructors($pdo)
{
    $results = get_instructors($pdo);
    return $results;
}
$instructors = fetch_instructors($pdo);