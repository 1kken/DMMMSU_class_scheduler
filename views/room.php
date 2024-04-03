<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management</title>
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

        .room_table_container {
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
            <h2>Add Room</h2>
            <form action="submit_room.php" method="post">
                <div class="form-group">
                    <label for="room-id">Room ID:</label>
                    <input type="text" id="room-id" name="room_id" required>
                </div>
                <div class="form-group">
                    <label for="room-type">Room Type:</label>
                    <select id="room-type" name="room_type" required>
                        <option value="lecture">Lecture</option>
                        <option value="laboratory">Laboratory</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="priority">Priority:</label>
                    <input type="number" id="priority" name="priority" required>
                </div>
                <input type="submit" value="Add Room">
            </form>
        </div>

        <div class="room_table_container">
            <h2>Room List</h2>
            <div class="search-container">
                <form action="">
                    <input type="text" id="search-input" placeholder="Search...">
                    <button>search</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Room ID</th>
                        <th>Room Type</th>
                        <th>Priority</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mockup data array
                    $rooms = array(
                        array("id" => "LR101", "type" => "Lecture", "priority" => 1),
                        array("id" => "CLR201", "type" => "Laboratory", "priority" => 2),
                    );

                    // Display room records
                    foreach ($rooms as $room) {
                        echo "<tr>";
                        echo "<td>" . $room['id'] . "</td>";
                        echo "<td>" . $room['type'] . "</td>";
                        echo "<td>" . $room['priority'] . "</td>";
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