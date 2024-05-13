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
<script src="../jquery.js"></script>

<body>
    <div class="container">
        <?php
        if (!isset($_GET['schedule_id'])) {
            echo "Schedule Id not Found";
            exit();
        }
        $schedule = get_schedule($pdo, $_GET['schedule_id']);
        $schedule_id = $_GET['schedule_id'];
        $code = $schedule['code'];
        $room_id = $schedule['room_id'];
        $instructor_id = $schedule['instructor_id'];
        $day = $schedule['day'];
        $start_time = $schedule['start_time'];
        $end_time = $schedule['end_time'];
        $subject_id = $schedule['subject_id'];
        $section_id = $schedule['section_id'];
        $sy = $schedule['sy'];
        $type = $schedule['type'];
        $semester = $schedule['semester'];

        if (empty($schedule)) {
            echo "Schedule not found";
            exit();
        }
        ?>
        <h2>Update Schedule</h2>
        <form action="../includes/schedule_handler.php" method="post" id="forms">
            <div class="form-group">
                <label for="code">Code:</label>
                <h1 id="code"><?php echo $code?></h1>
                <input type="text" id="code" name="code" readonly value=<?php echo $code ?> required hidden>
                <input type="text" id="schedule_id" name ="schedule_id" value="<?php echo $schedule_id ?>" hidden>
                <input type="text" id="room_id" name="room_id" value="<?php echo $room_id ?>" hidden>
                <input type="text" id="instructor_id" name="instructor_id" value="<?php echo $instructor_id ?>" hidden>
                <input type="text" id="day" name="day" value="<?php echo $day ?>" hidden>
                <input type="text" id="start_time" name ="start_time" value="<?php echo $start_time ?>" hidden>
                <input type="text" id="end_time" name="end_time" value="<?php echo $end_time ?>" hidden>
                <input type="text" id="subject_id" name="subject_id" value="<?php echo $subject_id ?>" hidden>
                <input type="text" id="section_id" name="section_id" value="<?php echo $section_id ?>" hidden>
                <input type="text" id="sy" name="sy" value="<?php echo $sy ?>" hidden>
                <input type="text" id="type" name="type" value="<?php echo $type ?>" hidden>
                <input type="text" id="semester" name="semester" value="<?php echo $semester ?>" hidden>

                <div class="form-group">
                    <label for="room">Room:</label>
                    <select id="new_room_id" name="new_room_id" required>
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
                </div>
                <div class="form-group">
                    <label for="day">Day:</label>
                    <select id="new_day" name="new_day" required disabled>
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
                </div>
                <div class="form-group">
                    <label for="start-time">Start Time:</label>
                    <select id="new_start_time" name="new_start_time" required disabled>
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
                </div>
                <div class="form-group">
                    <label for="end-time">End Time:</label>
                    <select id="new_end_time" name="new_end_time" required disabled>
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
                </div>
                <div class="form-group">
                    <label for="sy">School Year:</label>
                    <input type="text" id="new_sy" name="new_sy" placeholder="YYYY-YYYY" value=<?php echo $schedule["sy"]; ?> required readonly>
                </div>
                <input type="submit" value="Update Schedule" name="update_schedule">
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const roomIdInput = document.getElementById('new_room_id');
            const dayInput = document.getElementById('new_day');
            const startTimeInput = document.getElementById('new_start_time');
            const endTimeInput = document.getElementById('new_end_time');
            const syInput = document.getElementById('new_sy');

            getRooms();
            function getRooms() { 
                const type = document.getElementById('type').value;
                const subject_id = document.getElementById('subject_id').value; 
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("new_room_id").innerHTML = '';
                            document.getElementById("new_room_id").innerHTML = xhr.responseText;
                            console.log(xhr.responseText)
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/schedule_update_jq.php?type=${type}&subject_id=${subject_id}&get_room=true`, true);
                xhr.send();
            }
            roomIdInput.addEventListener('change', getDays);
            function getDays() {
                const room_id = document.getElementById('new_room_id').value;
                const sy = document.getElementById('sy').value;
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("new_day").innerHTML = '';
                            document.getElementById("new_day").innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/schedule_update_jq.php?new_room_id=${room_id}&sy=${sy}&get_day=true`, true);
                xhr.send();
            }
            dayInput.addEventListener('change', getStartTimes);
            function getStartTimes() {
                const room_id = document.getElementById('new_room_id').value;
                const sy = document.getElementById('sy').value;
                const day = document.getElementById('new_day').value;
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("new_start_time").innerHTML = '';
                            document.getElementById("new_start_time").innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/schedule_update_jq.php?new_room_id=${room_id}&sy=${sy}&day=${day}&get_start_time=true`, true);
                xhr.send();
            }

            //enabling in sequence
            roomIdInput.addEventListener('change', enableSelects);
            dayInput.addEventListener('change', enableSelects);
            startTimeInput.addEventListener('change', enableSelects);
            endTimeInput.addEventListener('change', enableSelects);

            function enableSelects() {
                const inputs = [dayInput, startTimeInput, endTimeInput, syInput];
                const currentIndex = inputs.findIndex(input => input === this);

                if (currentIndex < inputs.length - 1 && this.value !== "") {
                    inputs[currentIndex + 1].disabled = false;
                }
            }
        });


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



        const roomIdInput = document.getElementById('new_room_id');
        const dayInput = document.getElementById('new_day');
        const startTimeInput = document.getElementById('new_start_time');
        const endTimeInput = document.getElementById('new_end_time');
        const syInput = document.getElementById('new_sy');
        handleSelectChange(roomIdInput, [dayInput, startTimeInput, endTimeInput]);
        handleSelectChange(dayInput, [startTimeInput, endTimeInput]);
        handleSelectChange(startTimeInput, [endTimeInput]);
    </script>
</body>

</html>