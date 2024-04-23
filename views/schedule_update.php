<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/schedule/schedule_model.php");
require_once(APP_NAME . "includes/schedule/schedule_view.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Management - Update Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
            margin-top: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
            if(!isset($_GET['schedule_id'])){
                echo "Room Id not Found";
                exit();
            }
            $schedule = get_schedule($pdo, $_GET['schedule_id']);

            if(empty($schedule)){
                echo "Schedule not found";
                exit();
            }
        ?>
        <h2>Update Schedule</h2>
        <form action="../../DMMMSU_class_scheduler/includes/schedule_handler.php" method="post">
            <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>">
            <div class="form-group">
                <label for="room">Room:</label>
                <select id="room" name="room_id" required>
                    <?php
                    $rooms = get_rooms_sched($pdo);
                    foreach ($rooms as $room) {
                        echo "<option value='" . $room['room_id'] . "'";
                        if ($schedule['room_id'] == $room['room_id']) {
                            echo " selected";
                        }
                        echo ">" . $room['room_id'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Add similar dropdowns for instructor, day, start time, end time, subject, and section -->
            <div class="form-group">
                <label for="instructor">Instructor:</label>
                <select id="instructor" name="instructor_id" required>
                    <!-- Options for instructors -->
                    <option value="1">Instructor 1</option>
                    <option value="2">Instructor 2</option>
                    <option value="3">Instructor 3</option>
                </select>
            </div>
            <!-- Add other dropdowns here -->
            <input type="submit" value="Update Schedule">
        </form>
    </div>
</body>

</html>