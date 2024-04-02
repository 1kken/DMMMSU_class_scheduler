<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Management</title>
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
            <h2>Create Instructor</h2>
            <form action="submit_instructor.php" method="post">
                <div class="form-group">
                    <label for="instructor-id">Instructor ID:</label>
                    <input type="number" id="instructor-id" name="instructor_id" required>
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
                <input type="submit" value="Create Instructor">
            </form>
        </div>
        <div class="user_table_container">
            <h2>Instructor Records</h2>
            <table>
                <thead>
                    <tr>
                        <th>Instructor ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mockup data array
                    $instructors = array(
                        array("id" => 1, "last_name" => "Doe", "first_name" => "John", "middle_name" => "A.", "email" => "john.doe@example.com"),
                        array("id" => 2, "last_name" => "Smith", "first_name" => "Jane", "middle_name" => "B.", "email" => "jane.smith@example.com"),
                    );

                    // Display instructor records
                    foreach ($instructors as $instructor) {
                        echo "<tr>";
                        echo "<td>" . $instructor['id'] . "</td>";
                        echo "<td>" . $instructor['last_name'] . "</td>";
                        echo "<td>" . $instructor['first_name'] . "</td>";
                        echo "<td>" . $instructor['middle_name'] . "</td>";
                        echo "<td>" . $instructor['email'] . "</td>";
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