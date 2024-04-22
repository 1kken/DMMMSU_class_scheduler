<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/schedule/schedule_model.php");
//require_once(APP_NAME . "includes/student/student_view.php");

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
                    <label for="room-id">Room ID:</label>
                    <select id="room-id" name="room_id" required>
                        <?php
                        $classrooms = get_classroom_name_id($pdo);
                        foreach ($classrooms as $classroom) {
                            echo '<option value="' . $classroom['room_id'] . '">' . $classroom['room_id'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="instructor">Instructor:</label>
                    <select id="instructor" name="instructor_id" required>
                        <?php
                        $instructors = get_instructor_name_id($pdo);
                        foreach ($instructors as $instructor) {
                            echo '<option value="' . $instructor['instructor_id'] . '">' . $instructor['fullname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="day">Day:</label>
                    <select id="day" name="day" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
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
                    <label for="subject">Subject:</label>
                    <select id="subject-id" name="subject_id" required>
                        <?php
                        $subjects = get_subject_name_id($pdo);
                        foreach ($subjects as $subject) {
                            echo '<option value="' . $subject['subject_id'] . '">' . $subject['descriptive_title'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section:</label>
                    <select id="section-id" name="section-id" required>
                        <?php
                        $sections = get_section_name_id($pdo);
                        foreach ($sections as $section) {
                            echo '<option value="' . $section['section_id'] . '">' . $section['section_id'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sy">SY:</label>
                    <input type="text" id="sy" name="sy" required>
                </div>
                <input type="submit" value="Add Schedule">
                <input type="submit" onclick="redirectToDashboard()" value="Back to Dashboard">
            </form>
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
                <tbody>
                    <!-- Populate table with schedule records -->
                    <tr>
                        <td>Code</td>
                        <td>Start Time</td>
                        <td>End Time</td>
                        <td>Section</td>
                        <td>SY</td>
                        <td class="actions">
                            <button class="delete">Delete</button>
                            <button class="update">Update</button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
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

            subjectIdInput.addEventListener('input', generateCode);
            sectionIdInput.addEventListener('input', generateCode);
            syInput.addEventListener('input', generateCode);

            function generateCode() {
                //process sy 2023-2024 to 23-24
                let syProcessed =syInput.value.split("-");
                syProcessed = syProcessed.map((sy) => sy.slice(2, 4));
                syProcessed = syProcessed.join("-");
                console.log(syProcessed)
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

        function search() {
            console.log("search");
        }
    </script>
</body>

</html>