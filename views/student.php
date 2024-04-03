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

<body>

    <div class="container">
        <div class="form_container">
            <h2>Student Registration</h2>
            <form action="submit.php" method="post">
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
                        <option value="1">Section A</option>
                        <option value="2">Section B</option>
                        <option value="3">Section C</option>
                    </select>
                </div>
                <input type="submit" value="Create Student">
            </form>
        </div>
        <div class="user_table_container">
            <h2>Student Records</h2>
            <div class="search-container">
                <form action="">
                    <input type="text" id="search-input" placeholder="Search...">
                    <button>search</button>
                </form>
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
                <tbody>
                    <?php
                    // Mockup data array
                    $students = array(
                        array("id" => 1, "last_name" => "Doe", "first_name" => "John", "middle_name" => "A.", "email" => "john.doe@example.com", "section_id" => 1),
                        array("id" => 2, "last_name" => "Smith", "first_name" => "Jane", "middle_name" => "B.", "email" => "jane.smith@example.com", "section_id" => 2),
                    );

                    // Display student records
                    foreach ($students as $student) {
                        echo "<tr>";
                        echo "<td>" . $student['id'] . "</td>";
                        echo "<td>" . $student['last_name'] . "</td>";
                        echo "<td>" . $student['first_name'] . "</td>";
                        echo "<td>" . $student['middle_name'] . "</td>";
                        echo "<td>" . $student['email'] . "</td>";
                        echo "<td>" . $student['section_id'] . "</td>";
                        echo "<td class='actions'><button class='delete'>Delete</button> <button class='update'>Update</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>