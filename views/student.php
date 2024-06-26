<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/student/student_model.php");
require_once(APP_NAME . "includes/student/student_view.php");

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
    <title>Student Registration</title>
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

        input[type="number"],
        input[type="text"],
        input[type="email"],
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

        .user_table_container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            max-height: 600px;
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

        .errors {
            color: tomato;
        }
    </style>
</head>
<script src="../jquery.js"></script>

<body>
    <div class="container">
        <div class="form_container">
            <h2>Student Registration</h2>
            <form action="../includes/student_handler.php" method="post">
                <div class="form-group">
                    <label for="student-id">Student ID:</label>
                    <input type="number" id="student-id" name="student_id" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="middle-name">Middle Name:</label>
                    <input type="text" id="middle-name" name="middle_name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="section-id">Section ID:</label>
                    <select id="section-id" name="section_id">
                        <?php
                        $sections = get_sections($pdo);
                        foreach ($sections as $section) {
                            echo "<option value='" . $section['section_id'] . "'>" . $section['section_id'] . "</option>";
                        }
                        ?>
                    </select>
                    <?php check_student_errors() ?>
                </div>
                <input type="submit" value="Create Student" name="create_student">
                <input type="submit" onclick="redirectToDashboard()" value="Back to Dashboard">
            </form>
        </div>
        <div class="user_table_container">
            <h2>Student Records</h2>
            <div class="search-container">
                <input type="text" id="search-input" placeholder="Search...">
                <button onclick="search()">search</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Email</th>
                        <th>Section ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="student-show">
                    <?php
                    // Mockup data array
                    $students = get_students($pdo);

                    // Display student records
                    foreach ($students as $student) {
                        $student_id = $student['student_id'];
                        echo "<tr>";
                        echo "<td>" . $student['student_id'] . "</td>";
                        echo "<td>" . $student['last_name'] . "</td>";
                        echo "<td>" . $student['first_name'] . "</td>";
                        echo "<td>" . $student['middle_name'] . "</td>";
                        echo "<td>" . $student['email'] . "</td>";
                        echo "<td>" . $student['section_id'] . "</td>";
                        echo "<td class='actions'>
                                <form action='../includes/student_handler.php' method='post'>
                                    <input type='text' name='student_id' value=$student_id hidden>
                                    <button class='delete' name='delete_student'>Delete</button>
                                </form>
                                <form action='../views/student_update.php' method='get'>
                                    <input type='text' name='student_id' value=$student_id hidden>
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
        function search() {
            var student_id = document.getElementById("search-input").value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById("student-show").innerHTML = xhr.responseText;
                    } else {
                        document.getElementById("student-show").innerHTML = "No Student Found" + xhr.status;
                    }
                }
            };
            xhr.open("GET", "../includes/jqueries/searchStudent.php?student_id=" + encodeURIComponent(student_id), true);
            xhr.send();
        }
        document.addEventListener('DOMContentLoaded', () => {
            const firstNameInput = document.getElementById('first-name');
            const lastNameInput = document.getElementById('last-name');
            const instructorIdInput = document.getElementById('student-id');
            const emailInput = document.getElementById('email');

            firstNameInput.addEventListener('input', generateEmail);
            lastNameInput.addEventListener('input', generateEmail);
            instructorIdInput.addEventListener('input', generateEmail);

            function generateEmail() {
                const firstName = firstNameInput.value.trim().toLowerCase();
                const lastName = lastNameInput.value.trim().replace(/\s/g, '').toLowerCase();
                const instructorId = instructorIdInput.value.trim().toLowerCase();
                let nameExploded = firstName.split(" ");
                let generatedEmail = nameExploded.map(name => name[0]).join("");

                // Add the last name
                generatedEmail += lastName;
                // Add the last four digits of instructorId
                generatedEmail += instructorId.substring(4, 8);
                // Add the suffix email format
                generatedEmail += "@student.dmmmsu.edu.ph";
                // Check if all inputs have values
                if (firstName && lastName && instructorId) {
                    ;
                    emailInput.value = generatedEmail;
                } else {
                    emailInput.value = ''; // Clear the email if any input is empty
                }
            }
        });

        function redirectToDashboard() {
            window.location.href = '../views/dashboard.php';
        }
    </script>
</body>

</html>