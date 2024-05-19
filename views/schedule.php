<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/schedule/schedule_model.php");
require_once(APP_NAME . "includes/schedule/schedule_view.php");

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
    <title>Schedule Management</title>
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
            max-height: 1050px;
        }

        .form-container {
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

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5H7z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
            background-repeat: no-repeat;
            background-position-x: calc(100% - 10px);
            background-position-y: center;
            padding-right: 30px;
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

        select {
            text-transform: capitalize;
        }

        .schedule-table-container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
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

        /* search bar */
        .search-container form {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            width: calc(100% - 100px);
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-right: 10px;
        }

        .search-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 8px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        select {
            text-transform: capitalize;
        }

        td {
            text-transform: capitalize;
        }
    </style>
</head>
<script src="../jquery.js"></script>

<body>

    <div class="container">
        <div class="form-container">
            <h2>Add Schedule</h2>
            <form action="../includes/schedule_handler.php" method="post">
                <div class="form-group">
                    <label for="code">Code:</label>
                    <input type="text" id="code" name="code" readonly>
                </div>
                <div class="form-group">
                    <label for="section-id">Section:</label>
                    <select id="section-id" name="section_id" required>
                        <?php
                        $sections = get_section_name_id($pdo);
                        echo "<option disabled selected value> -- select an option -- </option>";
                        foreach ($sections as $section) {
                            echo '<option value="' . $section['section_id'] . '">' . $section['section_id'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <select id="semester" name="semester" required disabled>
                        <option disabled selected value> -- select an option -- </option>
                        <option value="1">First Semester</option>
                        <option value="2">Second Semester</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject-id">Subject:</label>
                    <select id="subject-id" name="subject_id" required disabled>
                        <?php
                        $subjects = get_subject_name_id($pdo);
                        echo "<option disabled selected value> -- select an option -- </option>";
                        foreach ($subjects as $subject) {
                            echo '<option value="' . $subject['subject_id'] . '">' . $subject['descriptive_title'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="instructor">Instructor:</label>
                    <select id="instructor-id" name="instructor_id" required disabled>
                        <?php
                        $instructors = get_instructor_name_id($pdo);
                        echo "<option disabled selected value> -- select an option -- </option>";
                        foreach ($instructors as $instructor) {
                            echo '<option value="' . $instructor['instructor_id'] . '">' . $instructor['fullname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Lecture type:</label>
                    <select id="type" name="type" required disabled>
                        <option disabled selected value> -- select an option -- </option>
                        <option value="lecture">Lecture</option>
                        <option value="laboratory">Laboratory</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="room-id">Room ID:</label>
                    <select id="room-id" name="room_id" required disabled>
                        <?php
                        $classrooms = get_classroom_name_id($pdo);
                        echo "<option disabled selected value> -- select an option -- </option>";
                        foreach ($classrooms as $classroom) {
                            echo '<option value="' . $classroom['room_id'] . '">' . $classroom['room_id'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="day">Day:</label>
                    <select id="day" name="day" required disabled>
                        <option disabled selected value> -- select an option -- </option>
                        <option value="monday">Monday</option>
                        <option value="tuesday">Tuesday </option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start-time">Start Time:</label>
                    <select id="start-time" name="start_time" required disabled>
                        <option disabled selected value> -- select an option -- </option>
                        <?php
                        $start_time = strtotime('8:00'); // Convert start time to Unix timestamp
                        $end_time = strtotime('16:00'); // Convert end time to Unix timestamp
                        $time_format = 'H:i'; // Time format

                        for ($time = $start_time; $time <= $end_time; $time += 1800) { // 1800 seconds = 30 minutes
                            echo '<option value="' . date($time_format, $time) . '">' . date($time_format, $time) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="end-time">End Time:</label>
                    <select id="end-time" name="end_time" required disabled>
                        <option disabled selected value> -- select an option -- </option>
                        <?php
                        $start_time = strtotime('9:00'); // Convert start time to Unix timestamp
                        $end_time = strtotime('17:00'); // Convert end time to Unix timestamp
                        $time_format = 'H:i'; // Time format

                        for ($time = $start_time; $time <= $end_time; $time += 1800) { // 1800 seconds = 30 minutes
                            echo '<option value="' . date($time_format, $time) . '">' . date($time_format, $time) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sy">SY:</label>
                    <input type="text" id="sy" name="sy" value="<?php
                                                                $current_year = date("Y");
                                                                $next_year = date("Y", strtotime("+1 year"));
                                                                $academic_year = $current_year . "-" . $next_year;
                                                                echo $academic_year;
                                                                ?>" required readonly>
                </div>
                <input type="submit" value="Add Schedule" name="create_schedule">
                <input type="submit" onclick="redirectToDashboard()" value="Back to Dashboard">
            </form>
            <?php
            check_schedule_errors();
            ?>
        </div>

        <div class="schedule-table-container">
            <h2>Schedule List</h2>
            <div class="search-container">
                <input type="text" id="search-input" placeholder="Search...">
                <button onclick="search()">search</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Section</th>
                        <th>Day</th>
                        <th>SY</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="schedule-id">
                    <?php
                    // Assuming you have fetched schedule data and stored it in an array called $schedules
                    $schedules = get_schedules($pdo);

                    // Display schedule records
                    foreach ($schedules as $schedule) {
                        $schedule_id = $schedule['schedule_id'];
                        $code = $schedule['code'];
                        echo "<tr>";
                        echo "<td>" . $schedule['code'] . "</td>";
                        echo "<td>" . $schedule['start_time'] . "</td>";
                        echo "<td>" . $schedule['end_time'] . "</td>";
                        echo "<td>" . $schedule['section_id'] . "</td>";
                        echo "<td>" . $schedule['day'] . "</td>";
                        echo "<td>" . $schedule['sy'] . "</td>";
                        echo "<td class='actions'>
                                <form action='../includes/schedule_handler.php' method='post'>
                                    <input type='text' name='schedule_id' value='$schedule_id' hidden>
                                    <button class='delete' name='delete_schedule'>Delete</button>
                                </form>
                                <form action='../views/schedule_update.php' method='get'>
                                    <input type='text' name='schedule_id' value='$schedule_id' hidden>
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
    <script>
        function redirectToDashboard() {
            window.location.href = '../views/dashboard.php';
        }
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
                xhr.open("GET", `../includes/jqueries/schedule_jq.php?section_id=${section_id}&semester=${semester}`, true);
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
                xhr.open("GET", `../includes/jqueries/schedule_jq.php?subject_id=${subject_id}`, true);
                xhr.send();
            }
            instructorIdInput.addEventListener('input', getType);
            //get type
            function getType() {
                const subject_id = document.getElementById('subject-id').value;
                const section_id = document.getElementById('section-id').value;
                const sy = processSy(syInput.value);
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("type").innerHTML = '';
                            document.getElementById("type").innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/schedule_jq.php?subject_id=${subject_id}&type=true&section_id=${section_id}&sy=${sy}`, true);
                xhr.send();
            }

            //get room
            typeInput.addEventListener('input', getRoom);

            function getRoom() {
                const type = document.getElementById('type').value;
                const subject_id = document.getElementById('subject-id').value;
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("room-id").innerHTML = '';
                            document.getElementById("room-id").innerHTML = xhr.responseText;
                            console.log(xhr.responseText);
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                console.log(`../includes/jqueries/schedule_jq.php?type=${type}&subject_id=${subject_id}&get_room=true`);
                xhr.open("GET", `../includes/jqueries/schedule_jq.php?type=${type}&subject_id=${subject_id}&get_room=true`, true);
                xhr.send();
            }

            //get day
            roomIdInput.addEventListener('input', getDay);

            function getDay() {
                const room_id = document.getElementById('room-id').value;
                const sy = processSy(syInput.value);
                let xhr = new XMLHttpRequest();
                console.log(`../includes/jqueries/schedule_jq.php?room_id=${room_id}&sy=${sy}&get_day=true`)
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("day").innerHTML = '';
                            document.getElementById("day").innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/schedule_jq.php?room_id=${room_id}&sy=${sy}&get_day=true`, true);
                xhr.send();
            }

            //get start time
            dayInput.addEventListener('input', getStartTime);

            function getStartTime() {
                const room_id = document.getElementById('room-id').value;
                const sy = processSy(syInput.value);
                const day = document.getElementById('day').value;
                const semester = document.getElementById('semester').value;
                const instructor_id = document.getElementById('instructor-id').value;
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
                xhr.open("GET", `../includes/jqueries/schedule_jq.php?room_id=${room_id}&sy=${sy}&day=${day}&semester=${semester}&instructor_id=${instructor_id}&get_start_time=true`, true);
                xhr.send();
            }

            //get end time
            startTimeInput.addEventListener('input', getEndTime);

            function getEndTime() {
                const instructor_id = document.getElementById('instructor-id').value;
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
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                const semester = document.getElementById('semester').value;
                xhr.open("GET", `../includes/jqueries/schedule_jq.php?room_id=${room_id}&sy=${sy}&day=${day}&semester=${semester}&instructor_id=${instructor_id}&start_time=${start_time}&get_end_time=true`, true);
                xhr.send();
            }


        });

        function search() {
            var code_title = document.getElementById("search-input").value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById("schedule-id").innerHTML = xhr.responseText;
                    } else {
                        document.getElementById("schedule-id").innerHTML = "No schedule Found" + xhr.status;
                    }
                }
            };
            xhr.open("GET", "../includes/jqueries/searchSchedule.php?code_desc=" + encodeURIComponent(code_title), true);
            xhr.send();
        }

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

        // Usage example
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