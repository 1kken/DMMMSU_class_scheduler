<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "database_header.php");
if (isset($_GET['student_id']) && isset($_GET['get_sy'])) {
    if (mb_strlen($_GET['student_id']) != 8) {
        echo "<option disabled selected value> -- invalid student id -- </option>";
        exit();
    }
    //get the school years from students history
    $student_id = $_GET['student_id'];
    $sql = "SELECT DISTINCT sy FROM student_history WHERE student_id = :student_id ORDER BY sy ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['student_id' => $student_id]);
    $school_years = $stmt->fetchAll();
    if ($school_years == null) {
        echo "<option disabled selected value> -- no available school year -- </option>";
        exit();
    }
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach ($school_years as $school_year) {
        echo "<option value='{$school_year['sy']}'>{$school_year['sy']}</option>";
    }
}

if(isset($_GET['student_id']) && isset($_GET['sy']) && isset($_GET['get_section'])){
    //get the section available for the student in history
    $student_id = $_GET['student_id'];
    $sy = $_GET['sy'];
    $stmt = $pdo->prepare("SELECT DISTINCT section_id FROM student_history WHERE student_id = :student_id AND sy = :sy ORDER BY section_id ASC");
    $stmt->execute(['student_id' => $student_id, 'sy' => $sy]);

    $sections = $stmt->fetchAll();
    if($sections == null){
        echo "<option disabled selected value> -- no available section -- </option>";
        exit();
    }
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach($sections as $section){
        echo "<option value='{$section['section_id']}'>{$section['section_id']}</option>";
    }
}
