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
            </div>
            <div class="form-group">
                <label for="section">Section:</label>
                <select id="section-id" name="section_id" required>
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
                <input type="text" id="old_section_id" name="old_section_id" value=<?php echo $schedule["section_id"] ?> hidden>
            </div>
            <div class="form-group">
                <label for="section">Semester:</label>
                <select id="semester" name="semester" required disabled>
                    <option disabled selected value> -- select an option -- </option>
                    <option value="1" <?php if ($schedule['semester'] == 1) echo "selected"; ?>>First Semester</option>
                    <option value="2" <?php if ($schedule['semester'] == 2) echo "selected"; ?>>Second Semester</option>
                </select>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <select id="subject-id" name="subject_id" required disabled>
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
                <input type="text" id="old_subject_id" name="old_subject_id" value=<?php echo $schedule["subject_id"] ?> hidden>
            </div>
            <div class="form-group">
                <label for="instructor">Instructor:</label>
                <select id="instructor-id" name="instructor_id" required disabled>
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
                <input type="text" name="old_instructor_id" id="old_instructor_id" value=<?php echo $schedule["instructor_id"] ?> hidden>
            </div>
            <div class="form-group">
                <label for="type">Lecture type:</label>
                <select id="type" name="type" required disabled>
                    <?php
                    if ($schedule['type'] == "lecture") {
                        echo "<option value='lecture' selected>Lecture</option>";
                        echo "<option value='laboratory'>Laboratory</option>";
                    } else {
                        echo "<option value='lecture'>Lecture</option>";
                        echo "<option value='laboratory' selected>Laboratory</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="room">Room:</label>
                <select id="room-id" name="room_id" required disabled>
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
                <input type="text" id="sy" name="sy" placeholder="YYYY-YYYY" value=<?php echo $schedule["sy"]; ?> required>
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
        document.addEventListener('DOMContentLoaded', () => {
            //SY
            const codeInput = document.getElementById('code');
            const sectionIdInput = document.getElementById('section-id');
            const semesterInput = document.getElementById('semester');
            const subjectIdInput = document.getElementById('subject-id');
            const instructorIdInput = document.getElementById('instructor-id');
            const typeInput = document.getElementById('type');
            const roomIdInput = document.getElementById('room-id');
            const dayInput = document.getElementById('day');
            const startTimeInput = document.getElementById('start-time');
            const endTimeInput = document.getElementById('end-time');
            const syInput = document.getElementById('sy');

            // Initial code generation
            generateCode();

            // Event listeners for input changes
            subjectIdInput.addEventListener('input', generateCode);
            sectionIdInput.addEventListener('input', generateCode);
            syInput.addEventListener('input', generateCode);

            function generateCode() {
                const subjectId = subjectIdInput.value;
                const sectionId = sectionIdInput.value;
                const syProcessed = processSy(syInput.value);

                if (subjectId && sectionId && syProcessed) {
                    const generatedCode = `${subjectId}${sectionId}${syProcessed}`;
                    codeInput.value = generatedCode;
                } else {
                    codeInput.value = '';
                }
            }

            // Process SY format from "2023-2024" to "2324"
            function processSy(syValue) {
                const syParts = syValue.split("-");
                if (syParts.length === 2) {
                    return syParts.map(sy => sy.slice(2, 4)).join("");
                }
                return null;
            }

            //readonly froms when the pre requisite is empty

            sectionIdInput.addEventListener('input', enableSelects);
            semesterInput.addEventListener('input', enableSelects);
            subjectIdInput.addEventListener('input', enableSelects);
            instructorIdInput.addEventListener('input', enableSelects);
            typeInput.addEventListener('input', enableSelects);
            roomIdInput.addEventListener('input', enableSelects);
            dayInput.addEventListener('input', enableSelects);
            startTimeInput.addEventListener('input', enableSelects);

            function enableSelects() {
                const inputs = [semesterInput, subjectIdInput, instructorIdInput, typeInput, roomIdInput, dayInput, startTimeInput, endTimeInput];
                const currentIndex = inputs.findIndex(input => input === this);

                if (currentIndex < inputs.length - 1 && this.value !== "") {
                    inputs[currentIndex + 1].disabled = false;
                }
            }

            semesterInput.addEventListener('input', getSubjects);
            // Find the available subjects for the year level based on the section
            function getSubjects() {
                const section_id = sectionIdInput.value;
                const semester = semesterInput.value;
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("subject-id").innerHTML = '';
                            document.getElementById("subject-id").innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../../DMMMSU_class_scheduler/includes/jqueries/schedule_jq.php?section_id=${section_id}&semester=${semester}`, true);
                xhr.send();
            }
            //get instructor
            subjectIdInput.addEventListener('input', getInstructors);

            function getInstructors() {
                const subject_id = document.getElementById('subject-id').value;
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("instructor-id").innerHTML = '';
                            document.getElementById("instructor-id").innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../../DMMMSU_class_scheduler/includes/jqueries/schedule_jq.php?subject_id=${subject_id}`, true);
                xhr.send();
            }


            //get room
            typeInput.addEventListener('input', getRoom);

            function getRoom() {
                const type = document.getElementById('type').value;
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("room-id").innerHTML = '';
                            document.getElementById("room-id").innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../../DMMMSU_class_scheduler/includes/jqueries/schedule_jq.php?type=${type}&get_room=true`, true);
                xhr.send();
            }

            //get day
            roomIdInput.addEventListener('input', getDay);

            function getDay() {
                const room_id = document.getElementById('room-id').value;
                const sy = processSy(syInput.value);
                let xhr = new XMLHttpRequest();
                console.log(`../../DMMMSU_class_scheduler/includes/jqueries/schedule_jq.php?room_id=${room_id}&sy=${sy}&get_day=true`)
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("day").innerHTML = '';
                            document.getElementById("day").innerHTML = xhr.responseText;
                            console.log(xhr.responseText);
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../../DMMMSU_class_scheduler/includes/jqueries/schedule_jq.php?room_id=${room_id}&sy=${sy}&get_day=true`, true);
                xhr.send();
            }

            //get start time
            dayInput.addEventListener('input', getStartTime);

            function getStartTime() {
                const room_id = document.getElementById('room-id').value;
                const sy = processSy(syInput.value);
                const day = document.getElementById('day').value;
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("start-time").innerHTML = '';
                            document.getElementById("start-time").innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../../DMMMSU_class_scheduler/includes/jqueries/schedule_jq.php?room_id=${room_id}&sy=${sy}&day=${day}&get_start_time=true`, true);
                xhr.send();
            }

            //get end time
            startTimeInput.addEventListener('input', getEndTime);

            function getEndTime() {
                const room_id = document.getElementById('room-id').value;
                const sy = processSy(syInput.value);
                const day = document.getElementById('day').value;
                const start_time = document.getElementById('start-time').value;
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("end-time").innerHTML = '';
                            document.getElementById("end-time").innerHTML = xhr.responseText;
                            console.log(xhr.responseText);
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../../DMMMSU_class_scheduler/includes/jqueries/schedule_jq.php?start_time=${start_time}&get_end_time=true`, true);
                xhr.send();
            }
        });



        //reset if go back
        function handleSelectChange(inputElement, targetElements) {
            console.log("entered");
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

        const sectionIdInput = document.getElementById('section-id');
        const semesterInput = document.getElementById('semester');
        const subjectIdInput = document.getElementById('subject-id');
        const instructorIdInput = document.getElementById('instructor-id');
        const typeInput = document.getElementById('type');
        const roomIdInput = document.getElementById('room-id');
        const dayInput = document.getElementById('day');
        const startTimeInput = document.getElementById('start-time');
        const endTimeInput = document.getElementById('end-time');
        const syInput = document.getElementById('sy');

        handleSelectChange(sectionIdInput, [semesterInput, subjectIdInput, instructorIdInput, typeInput, roomIdInput, dayInput, startTimeInput, endTimeInput]);
        handleSelectChange(semesterInput, [subjectIdInput, instructorIdInput, typeInput, roomIdInput, dayInput, startTimeInput, endTimeInput]);
        handleSelectChange(subjectIdInput, [instructorIdInput, typeInput, roomIdInput, dayInput, startTimeInput, endTimeInput]);
        handleSelectChange(instructorIdInput, [typeInput, roomIdInput, dayInput, startTimeInput, endTimeInput]);
        handleSelectChange(typeInput, [roomIdInput, dayInput, startTimeInput, endTimeInput]);
        handleSelectChange(roomIdInput, [dayInput, startTimeInput, endTimeInput]);
        handleSelectChange(dayInput, [startTimeInput, endTimeInput]);
    </script>
</body>

</html>