<?php

define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/authorization.php");

require_once(APP_NAME . "includes/instructor/instructor_model.php");
if (!is_logged_in()) {
    header("LOCATION: /DMMMSU_class_scheduler/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Instructor</title>
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
    <h2>Update Instructor</h2>
    <?php
    $instructor = get_instructor($pdo, $_GET["instructor_id"]);
    ?>

    <form action="update_instructor_handler.php" method="post">
        <div class="form-group">
            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="last_name" value="<?php echo $instructor['last_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="first_name" value="<?php echo $instructor['first_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="middle-name">Middle Name:</label>
            <input type="text" id="middle-name" name="middle_name" value="<?php echo $instructor['middle_name']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $instructor['email']; ?>" required>
        </div>
        <div class="form-group">
            <input type="hidden" id="instructor-id" name="instructor_id" value="<?php echo $_GET["instructor_id"]; ?>">
            <input type="submit" value="Update Instructor">
        </div>
    </form>
</div>

</body>

</html>