<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/student/student_model.php");
require_once(APP_NAME . "includes/student/student_view.php");

if (!is_logged_in()) {
    header("LOCATION: ../index.php");
    exit();
}

if(!is_admin()){
    header("LOCATION: ./create_report.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>
    <div class="container">
        <?php
        if (!isset($_GET["student_id"])) {
            echo "Student ID not found.";
            exit();
        }
        $student = get_student($pdo, $_GET["student_id"]);
        if (empty($student)) {
            echo "Student not found.";
            exit();
        }
        ?>
        <h2>Update Student</h2>
        <form action="../includes/student_handler.php" method="post">
            <div class="form-group">
                <label for="student-id">Student ID:</label>
                <input type="text" id="student-id" name="student_id" value="<?php echo $student['student_id']; ?>" required>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last_name" value="<?php echo $student['last_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first_name" value="<?php echo $student['first_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="middle-name">Middle Name:</label>
                <input type="text" id="middle-name" name="middle_name" value="<?php echo $student['middle_name']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="section-id">Section ID:</label>
                <select id="section-id" name="section_id">
                    <?php
                    $sections = get_sections($pdo);
                    foreach ($sections as $section) {
                        echo "<option value='" . $section['section_id'] . "'";
                        if ($student['section_id'] == $section['section_id']) {
                            echo " selected";
                        }
                        echo ">" . $section['section_id'] . "</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" id="student-id" name="old_student_email" value="<?php echo $student['email']; ?>">
                <input type="hidden" id="student-id" name="old_student_id" value="<?php echo $_GET["student_id"]; ?>">
                <input type="submit" name="update_student" value="Update Student">
            </div>
        </form>
        <?php check_student_update_errors()?>
    </div>
</body>

</html>