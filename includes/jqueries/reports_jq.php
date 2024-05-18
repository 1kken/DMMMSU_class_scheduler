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

if(isset($_GET['student_id']) && isset($_GET['sy']) && isset($_GET['section']) && isset($_GET['get_semester'])){
    //get the semester in schedule based on the student id, sy and section
    $sy = $_GET['sy'];
    $section = $_GET['section'];
    $stmt = $pdo->prepare("SELECT DISTINCT semester FROM schedule WHERE sy = :sy AND section_id = :section ORDER BY semester ASC");
    $stmt->execute(['sy' => $sy, 'section' => $section]);
    $semesters = $stmt->fetchAll();
    if($semesters == null){
        echo "<option disabled selected value> -- no available semester -- </option>";
        exit();
    }
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach($semesters as $semester){
        $semester_name = $semester['semester'] == 1 ? "1st Semester" : "2nd Semester";
        echo "<option value='{$semester['semester']}'>{$semester_name}</option>";
    }
}


//INSTRUCTOR

if(isset($_GET['instructor_id']) && isset($_GET['get_sy'])){
    //get the school years from schedule distinct where the instructor id
    $instructor_id = $_GET['instructor_id'];
    $sql = "SELECT DISTINCT sy FROM schedule WHERE instructor_id = :instructor_id ORDER BY sy ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['instructor_id' => $instructor_id]);
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

if(isset($_GET['instructor_id']) && isset($_GET['sy']) && isset($_GET['get_section']) ){
    //get the section of instructors based on the school year and instructor_id
    $instructor_id = $_GET['instructor_id'];
    $sy = $_GET['sy'];
    $stmt = $pdo->prepare("SELECT DISTINCT section_id FROM schedule WHERE instructor_id = :instructor_id AND sy = :sy ORDER BY section_id ASC");
    $stmt->execute(['instructor_id' => $instructor_id, 'sy' => $sy]);
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

if(isset($_GET['instructor_id']) && isset($_GET['sy']) && isset($_GET['section']) && isset($_GET['get_semester'])){
    //get all the semester of the instructor based on the school year and section
    $sy = $_GET['sy'];
    $section = $_GET['section'];
    $stmt = $pdo->prepare("SELECT DISTINCT semester FROM schedule WHERE sy = :sy AND section_id = :section AND instructor_id = :instructor_id ORDER BY semester ASC");
    $stmt->execute(['sy' => $sy, 'section' => $section, 'instructor_id' => $_GET['instructor_id']]);
    $semesters = $stmt->fetchAll();
    if($semesters == null){
        echo "<option disabled selected value> -- no available semester -- </option>";
        exit();
    }
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach($semesters as $semester){
        $semester_name = $semester['semester'] == 1 ? "First Semester" : "Second Semester";

        echo "<option value='{$semester['semester']}'>{$semester_name}</option>";
    }
}

//ROOMS
if(isset($_GET['room_id']) && isset($_GET['get_sy'])){
    //get the school years from schedule distinct where the room id
    $room_id = $_GET['room_id'];
    $sql = "SELECT DISTINCT sy FROM schedule WHERE room_id = :room_id ORDER BY sy ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['room_id' => $room_id]);
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

if(isset($_GET['room_id']) && isset($_GET['sy']) && isset($_GET['get_semester'])){
    //get all the semester of the room based on the school year
    $sy = $_GET['sy'];
    $stmt = $pdo->prepare("SELECT DISTINCT semester FROM schedule WHERE sy = :sy AND room_id = :room_id ORDER BY semester ASC");
    $stmt->execute(['sy' => $sy, 'room_id' => $_GET['room_id']]);
    $semesters = $stmt->fetchAll();
    if($semesters == null){
        echo "<option disabled selected value> -- no available semester -- </option>";
        exit();
    }
    echo "<option disabled selected value> -- select an option -- </option>";
    foreach($semesters as $semester){
        $semester_name = $semester['semester'] == 1 ? "First Semester" : "Second Semester";

        echo "<option value='{$semester['semester']}'>{$semester_name}</option>";
    }
}
