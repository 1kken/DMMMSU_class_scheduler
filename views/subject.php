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
        input[type="number"] {
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
            <h2>Add Subject</h2>
            <form action="submit_subject.php" method="post">
                <div class="form-group">
                    <label for="subject-id">Subject ID:</label>
                    <input type="text" id="subject-id" name="subject_id" required>
                </div>
                <div class="form-group">
                    <label for="descriptive-title">Descriptive Title:</label>
                    <input type="text" id="descriptive-title" name="descriptive_title" required>
                </div>
                <div class="form-group">
                    <label for="units">Units:</label>
                    <input type="number" id="units" name="units" required>
                </div>
                <div class="form-group">
                    <label for="priority">Priority:</label>
                    <input type="number" id="priority" name="priority" required>
                </div>
                <input type="submit" value="Add Subject">
            </form>
        </div>
        <div class="subject_table_container">
            <h2>Subject List</h2>
            <div class="search-container">
                <form action="">
                    <input type="text" id="search-input" placeholder="Search...">
                    <button>search</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Subject ID</th>
                        <th>Descriptive Title</th>
                        <th>Units</th>
                        <th>Priority</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mockup data array
                    $subjects = array(
                        array("id" => "CS101", "title" => "Introduction to Computer Science", "units" => 3, "priority" => 1),
                        array("id" => "ENG202", "title" => "Advanced English Literature", "units" => 4, "priority" => 2),
                    );

                    // Display subject records
                    foreach ($subjects as $subject) {
                        echo "<tr>";
                        echo "<td>" . $subject['id'] . "</td>";
                        echo "<td>" . $subject['title'] . "</td>";
                        echo "<td>" . $subject['units'] . "</td>";
                        echo "<td>" . $subject['priority'] . "</td>";
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