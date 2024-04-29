<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/schedule/schedule_model.php");
require_once(APP_NAME . "includes/schedule/schedule_view.php");

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
            overflow: auto;
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
    </style>
</head>
<script src="../jquery.js"></script>

<body>

    <div class="container">
        <div class="form-container">
            <h2>Add Schedule</h2>
            <form action="../../DMMMSU_class_scheduler\includes\schedule_handler.php" method="post">
                <div class="form-group">
                    <label for="code">Code:</label>
                    <input type="text" id="code" name="code" readonly>
                </div>
                <div class="form-group">
                    <label for="instructor">Instructor:</label>
                    <select id="instructor-id" name="instructor_id" required>
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
                    <label for="subject">Subject:</label>
                    <select id="subject-id" name="subject_id" required>
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
                    <label for="section">Section:</label>
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
                    <label for="room-id">Room ID:</label>
                    <select id="room-id" name="room_id" required>
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
                    <select id="day" name="day" required>
                        <option value="monday">Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start-time">Start Time:</label>
                    <select id="start-time" name="start_time" required>
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
                    <select id="end-time" name="end_time" required>
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
                                                                ?>" required>
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
                        echo "<tr>";
                        echo "<td>" . $schedule['code'] . "</td>";
                        echo "<td>" . $schedule['start_time'] . "</td>";
                        echo "<td>" . $schedule['end_time'] . "</td>";
                        echo "<td>" . $schedule['section_id'] . "</td>";
                        echo "<td>" . $schedule['sy'] . "</td>";
                        echo "<td class='actions'>
                                <form action='../../DMMMSU_class_scheduler\includes/schedule_handler.php' method='post'>
                                    <input type='text' name='schedule_id' value='$schedule_id' hidden>
                                    <button class='delete' name='delete_schedule'>Delete</button>
                                </form>
                                <form action='../../DMMMSU_class_scheduler/views/schedule_update.php' method='get'>
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
            window.location.href = '/DMMMSU_class_scheduler/views/dashboard.php';
        }
        document.addEventListener('DOMContentLoaded', () => {
            const subjectIdInput = document.getElementById('subject-id');
            const sectionIdInput = document.getElementById('section-id');
            const syInput = document.getElementById('sy');
            const codeInput = document.getElementById('code');

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

            // Process SY format from "2023-2024" to "23-24"
            function processSy(syValue) {
                const syParts = syValue.split("-");
                if (syParts.length === 2) {
                    return syParts.map(sy => sy.slice(2, 4)).join("");
                }
                return null;
            }
            let instructorIdInput = document.getElementById('instructor-id');
            let endTimeInput = document.getElementById('end-time');
            let startTimeInput = document.getElementById('start-time');
            let dayInput = document.getElementById('day');

            instructorIdInput.addEventListener('change', getSubject);

            //getting the subject
            function getSubject() {
                let instructor_id = document.getElementById("instructor-id").value;
                let day = document.getElementById("day").value;
                let start_time = document.getElementById("start-time").value;
                let end_time = document.getElementById("end-time").value;
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
                xhr.open("GET", `../../DMMMSU_class_scheduler/includes/jqueries/subject_instructor.php?instructor_id=${instructor_id}`, true);
                xhr.send();
            }
        });
        //getting the classroom

        //adjusting time

        function search() {
            console.log("search");
        }
    </script>
</body>

</html>