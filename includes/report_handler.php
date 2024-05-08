<?php
require_once("database_header.php");
require_once('config_session.inc.php');
require_once('report/report_model.php');
?>
<?php
if(isset($_POST['section']) && isset($_POST['semester']) && isset($_POST['sy']) && isset($_POST['student_id'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Schedule Report</title>
</head>

<body>
    <h1>Hello World1</h1>
</body>

</html>
<?php
}?>

<?php 
if(isset($_GET['instructor_id']) && isset($_POST['section']) && isset($_POST['semester']) && isset($_POST['sy'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Schedule Report</title>
</head>
<body>
    <h1>Hello World2</h1>
</body>

</html>
<?php } ?>
