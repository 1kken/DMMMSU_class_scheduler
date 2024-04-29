<?php
    define('APP_NAME', dirname(__FILE__) . "/../");
    require_once(APP_NAME . "database_header.php");

if(isset($_GET['subject_id'])){
    //get the year level of the subject
    $subject_id = $_GET['subject_id'];
    $stmt = $pdo->prepare("SELECT year_level FROM subject WHERE subject_id = :subject_id");
    $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_STR);
    $stmt->execute();
    $subject = $stmt->fetch(PDO::FETCH_ASSOC);
    $year_level = $subject['year_level'];

    //get the sections of the year level
    
}