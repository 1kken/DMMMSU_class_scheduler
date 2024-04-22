
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
            text-transform: capitalize;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .button-group {
            margin-top: 20px;
        }

        .button-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 10px;
        }

        .btn-blue {
            background-color: #007bff;
            color: #fff;
        }

        .btn-blue:hover {
            background-color: #0056b3;
        }

        select{
            text-transform: capitalize;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Schedule Form</h2>
        <form action="submit_schedule.php" method="post">
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" required>
            </div>
            <div class="form-group">
                <label for="room_id">Room ID:</label>
                <select id="room_id" name="room_id" required>
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
                <label for="start_time">Start Time:</label>
                <select id="start_time" name="start_time" required>
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
                <label for="end_time">End Time:</label>
                <select id="end_time" name="end_time" required>
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
                <select id="subject" name="subject" required>
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
                <select id="section" name="section" required>
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
                <input type="text" id="sy" name="sy" placeholder="YYYY-YYYY" required>
            </div>
            <div class="button-group">
                <button type="submit" class="btn-blue">Submit</button>
                <button type="button" class="btn-blue" onclick="redirectToDashboard()">Back to Dashboard</button>
            </div>
        </form>
    </div>
<script>
        function redirectToDashboard() {
            window.location.href = '/DMMMSU_class_scheduler/views/dashboard.php';
        }
</script>
</body>

</html>