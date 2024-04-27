<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/subject_instructor/subject_instructor_model.php");
require_once(APP_NAME . "includes/subject_instructor/subject_instructor_view.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Instructors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
        }

        .container {
            margin: auto auto;
            display: flex;
            max-width: 100%;
        }

        .form_container {
            margin-right: 20px;
            max-width: 300px;
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
            margin-bottom: 5px;
            font-weight: bold;
        }

        select,
        input[type="submit"] {
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

        .room_table_container {
            height: 500px;
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            max-height: 400px;
            /* Adjust the height as needed */
            overflow: auto;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 5px;
            overflow: hidden;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }

        .actions button {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .actions button.delete {
            background-color: #dc3545;
            color: #fff;
        }

        .actions button.update {
            background-color: #1bb21b;
            color: #000;
        }

        .actions button:hover {
            filter: brightness(0.9);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form_container">
            <h2>Add Subject Instructor</h2>
            <form action="../../DMMMSU_class_scheduler/includes/subject_instructor_handler.php" method="post">
                <div class="form-group">
                    <label for="subject">Subject Name:</label>
                    <select id="subject" name="subject_id" required>
                        <?php
                            $subjects = get_subjects($pdo);
                            foreach ($subjects as $subject) {
                                echo "<option value='" . $subject['subject_id'] . "'>" . $subject['subject_id'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="instructor">Instructor Name:</label>
                    <select id="instructor" name="instructor_id" required>
                        <?php
                            $instructors = get_instructors($pdo);
                            foreach ($instructors as $instructor) {
                                echo "<option value='" . $instructor['instructor_id'] . "'>" . $instructor['instructor_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <input type="hidden" name="create_subject_instructor">
                <input type="submit" value="Add Subject Instructor">
            </form>
        </div>

        <div class="room_table_container">
            <h2>Subject Instructors List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Subject ID</th>
                        <th>Instructor Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mockup data array
                    $subject_instructors = get_subject_instructors($pdo);
                    if (!$subject_instructors) {
                        echo "<tr><td colspan='5'>No records found</td></tr>";
                    }
                    // Display subject instructor records
                    foreach ($subject_instructors as $subject_instructor) {
                        echo "<tr>";
                        echo "<td>" . $subject_instructor['subject_id'] . "</td>";
                        echo "<td>" . $subject_instructor['instructor_name'] . "</td>";
                        echo "<td class='actions'>
                                <form action='../../DMMMSU_class_scheduler/includes/subject_instructor_handler.php' method='post'>
                                    <input type='hidden' name='subject_id' value='" . $subject_instructor['si_id'] . "'>
                                    <input type='hidden' name='delete_si'>
                                    <button class='delete' name='delete_subject_instructor'>Delete</button>
                                </form>
                                <form action='../../DMMMSU_class_scheduler/views/subject_instructor_update.php' method='get'>
                                    <button class='update'>Update</button>
                                </form>
        </td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>