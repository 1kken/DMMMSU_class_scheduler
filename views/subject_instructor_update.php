<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/subject_instructor/subject_instructor_model.php");
require_once(APP_NAME . "includes/subject_instructor/subject_instructor_view.php");

// Check if subject ID and instructor ID are provided
if (empty($_GET['si_id'])) {
    echo "Subject ID or Instructor ID not provided.";
    exit();
}

$si_id = $_GET['si_id'];
$si_id = trim($si_id);
$si_id = htmlspecialchars($si_id);


$subject_instructor = get_subject_instructor($pdo, $si_id);
$subject_id = $subject_instructor['subject_id'];
$instructor_id = $subject_instructor['instructor_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Subject Instructor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"],
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Update Subject Instructor</h1>
        <form action="../../DMMMSU_class_scheduler\includes\subject_instructor_handler.php" method="post">
            <input type="hidden" name="si_id" value="<?php echo $si_id; ?>">

            <div>
                <label for="subject_id">Subject Name:</label>
                <select id="subject" name="subject_id" required>
                    <?php
                    $subjects = get_subjects($pdo);
                    $select = "";
                    foreach ($subjects as $subject) {
                        if ($subject['subject_id'] == $subject_id) {
                            $select = "selected";
                        } else {
                            $select = "";
                        }
                        echo "<option value='" . $subject['subject_id'] . "' $select>" . $subject['subject_id'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="instructor_name">Instructor Name:</label>
                <select id="instructor" name="instructor_id" required>
                    <?php
                    $instructors = get_instructors($pdo);
                    $select = "";
                    foreach ($instructors as $instructor) {
                        if ($instructor['instructor_id'] == $instructor_id) {
                            $select = "selected";
                        } else {
                            $select = "";
                        }
                        echo "<option value='" . $instructor['instructor_id'] . "' $select>" . $instructor['instructor_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" name="update_subject_instructor">Update</button>
        </form>
        <?php check_errors_si(); ?>
    </div>
</body>

</html>