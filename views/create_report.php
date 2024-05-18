<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/report/report_model.php");
require_once(APP_NAME . "includes/report/report_view.php");
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
    <title>Reports Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .container {
            width: 30%;
            height: 600px;
            max-width: 600px;
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

        h1 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        select {
            text-transform: capitalize;
        }

        .separator {
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>

<script src="../jquery.js"></script>

<body>
    <div class="container" id="student_form">
        <h1>Create Report Student</h1>
        <form action="../includes/report_handler.php" method="POST">
            <div class="form-group">
                <label for="report_id">Report by Student ID:</label>
                <input type="text" id="student_id" name="student_id">
            </div>
            <div class="separator">
                <h1>Filter</h1>
            </div>
            <div class="form-group">
                <label for="school-year">School Year:</label>
                <select id="school-year" name="sy" required>
                    <option selected value disabled> -- select an option -- </option>;
                    <?php
                    $school_years = get_all_available_school_year($pdo);
                    foreach ($school_years as $school_year) {
                        echo "<option value='{$school_year['sy']}'>{$school_year['sy']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="section">Section:</label>
                <select id="section" name="section" required disabled>
                    <option selected value disabled> -- select an option -- </option>;
                    <?php
                    $sections = get_all_sections($pdo);
                    foreach ($sections as $section) {
                        echo "<option value='{$section['section_id']}'>{$section['section_id']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester" name="semester" required disabled>
                    <option selected value disabled> -- select an option -- </option>;
                    <option value="1">First Semester</option>
                    <option value="2">Second Semester</option>
                </select>
            </div>
            <input type="submit" value="Generate Report">
        </form>
    </div>
    <div class="container" id="instructor_form">
        <h1>Create Report Instructor</h1>
        <form action="../includes/instructor_report_handler.php" method="POST" id="instructor_form">
            <div class="form-group">
                <label for="report_id">Report by Instructor ID:</label>
                <input type="text" id="instructor_id" name="instructor_id">
            </div>
            <div class="separator">
                <h1>Filter</h1>
            </div>
            <div class="form-group">
                <label for="school-year">School Year:</label>
                <select id="school-year_instructor" name="sy_instructor">
                    <option selected value disabled> -- select an option -- </option>;
                </select>
            </div>
            <div class="form-group">
                <label for="section">Section:</label>
                <select id="section_instructor" name="section_instructor" disabled>
                    <option selected value disabled> -- select an option -- </option>;
                    <?php
                    $sections = get_all_sections($pdo);
                    foreach ($sections as $section) {
                        echo "<option value='{$section['section_id']}'>{$section['section_id']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester_instructor" name="semester_instructor" disabled>
                    <option selected value disabled> -- select an option -- </option>;
                    <option value="1">First Semester</option>
                    <option value="2">Second Semester</option>
                </select>
            </div>
            <input type="submit" value="Generate Report">
        </form>
    </div>
        <div class="container" id="room_form">
        <h1>Create Report Rooms</h1>
        <form action="../includes/instructor_report_handler.php" method="POST" id="instructor_form">
            <div class="separator">
                <h1>Filter</h1>
            </div>
            <div class="form-group">
                <label for="room_id">Room ID:</label>
                <select id="room_id" name="room_id">
                    <option selected value disabled> -- select an option -- </option>;
                    <?php
                    $rooms = get_rooms($pdo);
                    foreach ($rooms as $room) {
                        echo "<option value='{$room['room_id']}'>{$room['room_id']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sy_room">School Year:</label>
                <select id="sy_room" name="sy_room" disabled>
                    <option selected value disabled> -- select an option -- </option>;
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester_room" name="semester_room" disabled>
                    <option selected value disabled> -- select an option -- </option>;
                    <option value="1">First Semester</option>
                    <option value="2">Second Semester</option>
                </select>
            </div>
            <input type="submit" value="Generate Report">
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const studentIdInput = document.getElementById('student_id');
            const instructorIdInput = document.getElementById('instructor_id');
            const schoolYearSelect = document.getElementById('school-year');
            const sectionSelect = document.getElementById('section');
            const semesterSelect = document.getElementById('semester');

            //Find the school years that the student is enrolled 
            studentIdInput.addEventListener('input', getSchoolYears);

            function getSchoolYears() {
                if (studentIdInput.value.trim() === '') {
                    return;
                }
                const student_id = studentIdInput.value.trim();
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            schoolYearSelect.innerHTML = '';
                            schoolYearSelect.innerHTML = xhr.responseText;
                            console.log(xhr.responseText)
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/reports_jq.php?student_id=${student_id}&get_sy=true`, true);
                xhr.send();
            }

            //Find the section that is available via student_id in student history
            schoolYearSelect.addEventListener('input', getSections);

            function getSections() {
                if (studentIdInput.value.trim() === '') {
                    return;
                }
                const student_id = studentIdInput.value.trim();
                const sy = schoolYearSelect.value.trim();
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            sectionSelect.innerHTML = '';
                            sectionSelect.innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/reports_jq.php?student_id=${student_id}&sy=${sy}&get_section=true`, true);
                xhr.send();
            }

            //Get the semester that has available schedule for that school year school year
            sectionSelect.addEventListener('input', getSemester);

            function getSemester() {
                if (studentIdInput.value.trim() === '') {
                    return;
                }
                const student_id = studentIdInput.value.trim();
                const sy = schoolYearSelect.value.trim();
                const section = sectionSelect.value.trim();
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            semesterSelect.innerHTML = '';
                            semesterSelect.innerHTML = xhr.responseText;
                            console.log(xhr.responseText);
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/reports_jq.php?student_id=${student_id}&sy=${sy}&section=${section}&get_semester=true`, true);
                xhr.send();
            }


            //Instructor
            const schoolYearSelect_instructor = document.getElementById('school-year_instructor');
            const sectionSelect_instructor = document.getElementById('section_instructor');
            const semesterSelect_instructor = document.getElementById('semester_instructor');

            instructorIdInput.addEventListener('input', getSchoolYearsInstructor);
            function getSchoolYearsInstructor() {
                if (instructorIdInput.value.trim() === '') {
                    return;
                }
                const instructor_id = instructorIdInput.value.trim();
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            schoolYearSelect_instructor.innerHTML = '';
                            schoolYearSelect_instructor.innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/reports_jq.php?instructor_id=${instructor_id}&get_sy=true`, true);
                xhr.send();
            }

            schoolYearSelect_instructor.addEventListener('input', getSectionsInstructor);
            function getSectionsInstructor(){
                if (instructorIdInput.value.trim() === '') {
                    return;
                }
                const instructor_id = instructorIdInput.value.trim();
                const sy = schoolYearSelect_instructor.value.trim();
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            sectionSelect_instructor.innerHTML = '';
                            sectionSelect_instructor.innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/reports_jq.php?instructor_id=${instructor_id}&sy=${sy}&get_section=true`, true);
                xhr.send();
            }

            sectionSelect_instructor.addEventListener('input', getSemesterInstructor);
            function getSemesterInstructor(){
                if (instructorIdInput.value.trim() === '') {
                    return;
                }
                const instructor_id = instructorIdInput.value.trim();
                const sy = schoolYearSelect_instructor.value.trim();
                const section = sectionSelect_instructor.value.trim();
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            semesterSelect_instructor.innerHTML = '';
                            semesterSelect_instructor.innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/reports_jq.php?instructor_id=${instructor_id}&sy=${sy}&section=${section}&get_semester=true`, true);
                xhr.send();
            }

            //room
            const roomSelect = document.getElementById('room_id');
            const sySelect = document.getElementById('sy_room');
            const semesterSelect_room = document.getElementById('semester_room');

            roomSelect.addEventListener('input', getSchoolYearsRoom);
            function getSchoolYearsRoom() {
                if (roomSelect.value.trim() === '') {
                    return;
                }
                const room_id = roomSelect.value.trim();
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            sySelect.innerHTML = '';
                            sySelect.innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/reports_jq.php?room_id=${room_id}&get_sy=true`, true);
                xhr.send();
            }

            sySelect.addEventListener('input', getSemesterRoom);
            function getSemesterRoom(){
                if (roomSelect.value.trim() === '') {
                    return;
                }
                const room_id = roomSelect.value.trim();
                const sy = sySelect.value.trim();
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            semesterSelect_room.innerHTML = '';
                            semesterSelect_room.innerHTML = xhr.responseText;
                        } else {
                            console.log("There was a problem with the request.");
                        }
                    }
                };
                xhr.open("GET", `../includes/jqueries/reports_jq.php?room_id=${room_id}&sy=${sy}&get_semester=true`, true);
                xhr.send();
            }



            //Disable
            studentIdInput.addEventListener('input', toggleReadOnly);
            instructorIdInput.addEventListener('input', toggleReadOnly);

            function toggleReadOnly() {
                const student_form = document.getElementById('student_form');
                const instructor_form = document.getElementById('instructor_form');
                const schoolYearSelect = document.getElementById('school-year');
                const sectionSelect = document.getElementById('section');
                const semesterSelect = document.getElementById('semester');
                const hasStudentIdValue = studentIdInput.value.trim() !== '';
                const hasInstructorIdValue = instructorIdInput.value.trim() !== '';
                student_form.hidden = hasInstructorIdValue;
                instructor_form.hidden = hasStudentIdValue;
            }

            // Initial call to set initial state
            toggleReadOnly();
        });

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
        const schoolYearSelect = document.getElementById('school-year');
        const sectionSelect = document.getElementById('section');
        const semesterSelect = document.getElementById('semester');

        handleSelectChange(schoolYearSelect, [sectionSelect, semesterSelect]);
        handleSelectChange(sectionSelect, [semesterSelect]);

        //instructor form
        const schoolYearSelect_instructor = document.getElementById('school-year_instructor');
        const sectionSelect_instructor = document.getElementById('section_instructor');
        const semesterSelect_instructor = document.getElementById('semester_instructor');
        handleSelectChange(schoolYearSelect_instructor, [sectionSelect_instructor, semesterSelect_instructor]);
        handleSelectChange(sectionSelect_instructor, [semesterSelect_instructor]);

        //room form
        const roomSelect = document.getElementById('room_id');
        const sySelect = document.getElementById('sy_room');
        const semesterSelect_room = document.getElementById('semester_room');
        handleSelectChange(roomSelect, [sySelect, semesterSelect_room]);
        handleSelectChange(sySelect, [semesterSelect_room]);
    </script>
</body>

</html>