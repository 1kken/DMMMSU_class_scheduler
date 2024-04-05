
<?php
require_once("database_header.php");
require_once('instructor/instructor_model.php');
function fetch_instructors($pdo)
{
    $results = get_instructors($pdo);
    return $results;
}

function fetch_instructor($pdo, $instructor_id)
{
    $result = get_instructor($pdo, $instructor_id);
    return $result;
}
$instructors = fetch_instructors($pdo);