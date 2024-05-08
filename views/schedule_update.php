<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/schedule/schedule_model.php");
require_once(APP_NAME . "includes/schedule/schedule_view.php");
require_once(APP_NAME . "includes/schedule/schedule_view.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically */
            height: 100vh;
            margin: 0;
        }

        .container {
            margin-top: 200px;
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
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-top: 5px;
            font-family: inherit;
            /* Maintain font family */
        }

        input[type="text"][readonly] {
            background-color: #f0f0f0;
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

        select {
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        if (!isset($_GET['schedule_id'])) {
            echo "Schedule Id not Found";
            exit();
        }
        $schedule = get_schedule($pdo, $_GET['schedule_id']);

        if (empty($schedule)) {
            echo "Schedule not found";
            exit();
        }
        ?>
        <h2>Update Schedule</h2>
        <form action="../../DMMMSU_class_scheduler\includes\schedule_handler.php" method="post" id="forms">
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" readonly value=<?php echo $schedule['code'] ?> required>
                <input type="text" id="old_section_id" name="old_section_id" value=<?php echo $schedule["section_id"] ?> hidden>
                <input type="text" id="old_subject_id" name="old_subject_id" value=<?php echo $schedule["subject_id"] ?> hidden>
                <input type="text" name="old_instructor_id" id="old_instructor_id" value=<?php echo $schedule["instructor_id"] ?> hidden>
            <div class="form-group">
                <label for="room">Room:</label>
                <select id="room-id" name="room_id" required>
                    <?php
                    $rooms = get_classroom_name_id($pdo);
                    foreach ($rooms as $room) {
                        echo "<option value='" . $room['room_id'] . "'";
                        if ($schedule['room_id'] == $room['room_id']) {
                            echo " selected";
                        }
                        echo ">" . $room['room_id'] . "</option>";
                    }
                    ?>
                </select>
                <input type="text" name="old_room_id" id="old_room_id" value=<?php echo $schedule["room_id"] ?> hidden>
            </div>
            <div class="form-group">
                <label for="day">Day:</label>
                <select id="day" name="day" required disabled>
                    <?php
                    $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                    foreach ($days as $day) {
                        $day = strtolower($day);
                        echo "<option value='$day'";
                        if ($schedule['day'] == $day) {
                            echo " selected";
                        }
                        $day = ucfirst($day);
                        echo ">$day</option>";
                    }
                    ?>
                </select>
                <input type="text" name="old_day" id="old_day" value=<?php echo $schedule["day"] ?> hidden>
            </div>
            <div class="form-group">
                <label for="start-time">Start Time:</label>
                <select id="start-time" name="start_time" required disabled>
                    <?php
                    $start_time = strtotime('8:00'); // Convert start time to Unix timestamp
                    $end_time = strtotime('16:00'); // Convert end time to Unix timestamp
                    $time_format = 'H:i'; // Time format

                    for ($time = $start_time; $time <= $end_time; $time += 1800) { // 1800 seconds = 30 minutes
                        if ($time == strtotime($schedule['start_time'])) {
                            echo '<option value="' . date($time_format, $time) . '" selected>' . date($time_format, $time) . '</option>';
                        } else {
                            echo '<option value="' . date($time_format, $time) . '">' . date($time_format, $time) . '</option>';
                        }
                    }
                    ?>
                </select>
                <input type="text" name="old_start_time" id="old_start_time" value=<?php echo $schedule["start_time"] ?> hidden>
            </div>
            <div class="form-group">
                <label for="end-time">End Time:</label>
                <select id="end-time" name="end_time" required disabled>
                    <?php
                    $start_time = strtotime('9:00'); // Convert start time to Unix timestamp
                    $end_time = strtotime('17:00'); // Convert end time to Unix timestamp
                    $time_format = 'H:i'; // Time format

                    for ($time = $start_time; $time <= $end_time; $time += 1800) { // 1800 seconds = 30 minutes
                        if ($time == strtotime($schedule['end_time'])) {
                            echo '<option value="' . date($time_format, $time) . '" selected>' . date($time_format, $time) . '</option>';
                        } else {
                            echo '<option value="' . date($time_format, $time) . '">' . date($time_format, $time) . '</option>';
                        }
                    }
                    ?>
                </select>
                <input type="text" id="old_end_time" name="old_end_time" value=<?php echo $schedule["end_time"] ?> hidden>
            </div>
            <div class="form-group">
                <label for="sy">School Year:</label>
                <input type="text" id="sy" name="sy" placeholder="YYYY-YYYY" value=<?php echo $schedule["sy"]; ?> required readonly>
                <input type="text" id="old_sy" name="old_sy" value=<?php echo $schedule["sy"] ?> hidden>
            </div>
            <input type="submit" value="Update Schedule" name="update_schedule">
            <input type="text" name="old_schedule_code" value=<?php echo $schedule["code"] ?> hidden>
            <input type="text" name="schedule_id" value=<?php echo $_GET["schedule_id"] ?> hidden>
        </form>
        <?php
        check_schedule_errors();
        ?>
    </div>
    <script>
        //reset if go back
        function handleSelectChange(inputElement, targetElements) {
            inputElement.addEventListener('change', () => {
                // Disable all target elements
                targetElements.forEach(element => {
                    element.disabled = true;
                    element.selectedIndex = 0;
                });

                // Enable the target element based on the input element's value
                if (inputElement.value !== '') {
                    targetElements[0].disabled = false; // Enable the first target element
                }
            });
        }

        const roomIdInput = document.getElementById('room-id');
        const dayInput = document.getElementById('day');
        const startTimeInput = document.getElementById('start-time');
        const endTimeInput = document.getElementById('end-time');
        const syInput = document.getElementById('sy');

        handleSelectChange(roomIdInput, [dayInput, startTimeInput, endTimeInput]);
        handleSelectChange(dayInput, [startTimeInput, endTimeInput]);
        handleSelectChange(startTimeInput, [endTimeInput]);
    </script>
</body>

</html>