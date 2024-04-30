<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");

if (isset($_GET['section_id']) && isset($_GET['semester'])) {
    //get the section
    $stmt = $pdo->prepare('SELECT * FROM section WHERE section_id = :section_id');
    $stmt->execute(['section_id' => $_GET['section_id']]);
    $section = $stmt->fetch();
    $section_year = str_split($section['section_id']);
    $year_level = $section_year[0];
    //get the subjects
    $stmt = $pdo->prepare('SELECT * FROM subject WHERE year_level = :year_level AND semester = :semester');
    $stmt->execute(['year_level' => $year_level, 'semester' => $_GET['semester']]);
    $subjects = $stmt->fetchAll();
    if ($subjects == null) {
        echo "<option disabled selected value> -- no available subject -- </option>";
        exit();
    }
    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($subjects as $subject) {
        echo "<option value='" . $subject["subject_id"] . "'>" . $subject["descriptive_title"] . "</option>";
    }
    exit();
}

if (isset($_GET['subject_id'])) {
    //get the instructor that teach the subject in subject_instructor db
    $stmt = $pdo->prepare(('SELECT subject_instructor.instructor_id,CONCAT(instructor.`last_name`,",",instructor.`first_name`) AS full_name FROM subject_instructor
    JOIN instructor ON subject_instructor.instructor_id = instructor.instructor_id
    WHERE subject_id = :subject_id'));
    $stmt->execute(['subject_id' => $_GET['subject_id']]);
    $instructors = $stmt->fetchAll();
    if ($instructors == null) {
        echo "<option disabled selected value> -- no available instructor -- </option>";
        exit();
    }
    //display using option
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($instructors as $instructor) {
        echo "<option value='" . $instructor["instructor_id"] . "'>" . $instructor["full_name"] . "</option>";
    }
}
