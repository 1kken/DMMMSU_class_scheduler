<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/subject/subject_model.php");
require_once(APP_NAME . "includes/subject/subject_view.php");

if (!is_logged_in()) {
    header("LOCATION: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Management</title>
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

        input[type="text"],
        input[type="number"],
        select {
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

        .subject_table_container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            max-height: 650px;
            /* Adjust the height as needed */
            overflow: auto;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
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
<script src="../jquery.js"></script>
<body>

    <div class="container">
        <div class="form_container">
            <h2>Add Subject</h2>
            <form action="../includes/subject_handler.php" method="post">
                <div class="form-group">
                    <label for="subject-id">Subject ID:</label>
                    <input type="text" id="subject-id" name="subject_id" required>
                </div>
                <div class="form-group">
                    <label for="descriptive-title">Descriptive Title:</label>
                    <input type="text" id="descriptive-title" name="descriptive_title" required>
                </div>
                <div class="form-group">
                    <label for="lecture-units">Lecture Units:</label>
                    <select id="lecture-units" name="lecture_units" required>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lab-units">Laboratory Units:</label>
                    <select id="lab-units" name="laboratory_units" required>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="total-units">Total Units:</label>
                    <input type="text" id="total-units" name="total_units" value="2" readonly>
                </div>
                <div class="form-group">
                    <label for="priority">Priority:</label>
                    <select id="priority" name="priority" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year-level">Year level:</label>
                    <select id="year-level" name="year_level" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <select id="semester" name="semester" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <input type="submit" name="create_subject" value="Add Subject">
                <input type="submit" onclick="redirectToDashboard()" value="Back to Dashboard">
            </form>
            <?php
            check_subject_errors();
            ?>
        </div>
        <div class="subject_table_container">
            <h2>Subject List</h2>
            <div class="search-container">
                    <input type="text" id="search-input" placeholder="Search...">
                    <button onclick="search()">search</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Subject ID</th>
                        <th>Descriptive Title</th>
                        <th>Lecture Units</th>
                        <th>Laboratory Units</th>
                        <th>Total Units</th>
                        <th>Priority</th>
                        <th>Year level</th>
                        <th>Semester</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="subject-show">
                    <?php
                    // Mockup data array
                    $subjects = get_subjects($pdo);
            

                    // Display subject records
                    foreach ($subjects as $subject) {
                        $subject_id = $subject['subject_id'];
                        echo "<tr>";
                        echo "<td>" . $subject['subject_id'] . "</td>";
                        echo "<td>" . $subject['descriptive_title'] . "</td>";
                        echo "<td>" . $subject['lecture_units'] . "</td>";
                        echo "<td>" . $subject['laboratory_units'] . "</td>";
                        echo "<td>" . $subject['total_units'] . "</td>";
                        echo "<td>" . $subject['priority'] . "</td>";
                        echo "<td>" . $subject['year_level'] . "</td>";
                        echo "<td>" . $subject['semester'] . "</td>";
                        echo "<td class='actions'>
                                <form action='../includes/subject_handler.php' method='post'>
                                    <input type='text' name='subject_id' value=$subject_id hidden>
                                    <button class='delete' name='delete_subject'>Delete</button>
                                </form>
                                <form action='../views/subject_update.php' method='get'>
                                    <input type='text' name='subject_id' value=$subject_id hidden>
                                    <button class='update'>Update</button>
                                </form>
                                </td>";
                        echo "</tr>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function search() {
            var student_id = document.getElementById("search-input").value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById("subject-show").innerHTML = xhr.responseText;
                    } else {
                        document.getElementById("subject-show").innerHTML = "No Student Found" + xhr.status;
                    }
                }
            };
            xhr.open("GET", "../includes/jqueries/searchSubject.php?subject_id=" + encodeURIComponent(student_id), true);
            xhr.send();
        }
        document.addEventListener('DOMContentLoaded', () => {
            const lectureUnitsSelect = document.getElementById('lecture-units');
            const labUnitsSelect = document.getElementById('lab-units');
            const totalUnitsInput = document.getElementById('total-units');

            lectureUnitsSelect.addEventListener('change', updateTotalUnits);
            labUnitsSelect.addEventListener('change', updateTotalUnits);

            function updateTotalUnits() {
                const lectureUnits = parseInt(lectureUnitsSelect.value);
                const labUnits = parseInt(labUnitsSelect.value);
                const total = lectureUnits + labUnits;
                totalUnitsInput.value = total ;
            }
        });
        
        function redirectToDashboard() {
            window.location.href = '../views/dashboard.php';
        }
    </script>

</body>

</html>
