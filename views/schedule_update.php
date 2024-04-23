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
    <title>Update Schedule</title>
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
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-top: 5px;
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
        select{
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
        <form action="update_schedule_handler.php" method="post">
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" readonly value = <?php echo $schedule['code'] ?> required>
            </div>
            <div class="form-group">
                <label for="room">Room:</label>
                <select id="room" name="room" required>
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
                <label for="instructor">Instructor:</label>
                <select id="instructor" name="instructor" required>
                    <?php
                    $instructors = get_instructor_name_id($pdo);
                    foreach ($instructors as $instructor) {
                        echo "<option value='" . $instructor['instructor_id'] . "'";
                        if ($schedule['instructor_id'] == $instructor['instructor_id']) {
                            echo " selected";
                        }
                        echo ">" . $instructor['fullname'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="day">Day:</label>
                <select id="day" name="day" required>
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
                <select id="section" name="start_time" required>
                    <?php
                    $start_time = strtotime('8:00'); // Convert start time to Unix timestamp
                    $end_time = strtotime('16:00'); // Convert end time to Unix timestamp
                    $time_format = 'H:i'; // Time format

                    for ($time = $start_time; $time <= $end_time; $time += 1800) { // 1800 seconds = 30 minutes
                        if($time == strtotime($schedule['start_time'])){
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
                <select id="section" name="end_time" required>
                    <?php
                    $start_time = strtotime('9:00'); // Convert start time to Unix timestamp
                    $end_time = strtotime('17:00'); // Convert end time to Unix timestamp
                    $time_format = 'H:i'; // Time format

                    for ($time = $start_time; $time <= $end_time; $time += 1800) { // 1800 seconds = 30 minutes
                        if($time == strtotime($schedule['end_time'])){
                            echo '<option value="' . date($time_format, $time) . '" selected>' . date($time_format, $time) . '</option>';
                        } else {
                            echo '<option value="' . date($time_format, $time) . '">' . date($time_format, $time) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <select id="subject-id" name="subject" required>
                    <?php
                    $subjects = get_subject_name_id($pdo);
                    foreach ($subjects as $subject) {
                        echo "<option value='" . $subject['subject_id'] . "'";
                        if ($schedule['subject_id'] == $subject['subject_id']) {
                            echo " selected";
                        }
                        echo ">" . $subject['descriptive_title'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="section">Section:</label>
                <select id="section-id" name="section" required>
                <?php
                    $sections = get_section_name_id($pdo);
                    foreach ($sections as $section) {
                        echo "<option value='" . $section['section_id'] . "'";
                        if ($schedule['section_id'] == $section['section_id']) {
                            echo " selected";
                        }
                        echo ">" . $section['section_id'] . "</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sy">School Year:</label>
                <input type="text" id="sy" name="sy" placeholder="YYYY-YYYY" value=<?php echo $schedule["sy"]; ?> required>
            </div>
            <input type="submit" value="Update Schedule">
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const subjectIdInput = document.getElementById('subject-id');
            const sectionIdInput = document.getElementById('section-id');
            const syInput = document.getElementById('sy');
            const codeInput = document.getElementById('code');
            subjectIdInput.addEventListener('input', generateCode);
            sectionIdInput.addEventListener('input', generateCode);
            syInput.addEventListener('input', generateCode);

            function generateCode() {
                //process sy 2023-2024 to 23-24
                let syProcessed = syInput.value.split("-");
                syProcessed = syProcessed.map((sy) => sy.slice(2, 4));
                syProcessed = syProcessed.join("-");
                const subjectId = subjectIdInput.value;
                const sectionId = sectionIdInput.value;
                if (subjectId && sectionId && syProcessed.length === 5) {
                    let generatedCode = `${subjectId}${sectionId}${syProcessed}`;
                    codeInput.value = generatedCode;
                    return;
                }
                codeInput.value = '';
            }
        });
    </script>
</body>

</html>