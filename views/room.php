<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/room/room_model.php");
require_once(APP_NAME . "includes/room/room_view.php");
?>
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
            max-height: 400px;
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
            <h2>Add Room</h2>
            <form action="../../DMMMSU_class_scheduler\includes\room_handler.php" method="post">
                <div class="form-group">
                    <label for="room-id">Room ID:</label>
                    <input type="text" id="room-id" name="room_id" required>
                </div>
                <div class="form-group">
                    <label for="room-type">Room Type:</label>
                    <select id="room-type" name="room_type" required>
                        <option value="Lecture">Lecture</option>
                        <option value="Laboratory">Laboratory</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="priority">Priority:</label>
                    <select id="room-priority" name="room_priority" required>
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                    </select>
                </div>
                <input type="text" name="create_room" hidden>
                <input type="submit" value="Add Room">
                <input type="submit" onclick="redirectToDashboard()" value="Back to Dashboard">
            </form>
            <?php
            check_create_room_errors();
            ?>
        </div>

        <div class="room_table_container">
            <h2>Room List</h2>
            <div class="search-container">
                <input type="text" id="search-input" placeholder="Search...">
                <button onclick="search()">search</button>
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
                <tbody id="room-show">
                    <?php
                    // Mockup data array
                    $rooms = get_rooms($pdo);

                    // Display room records
                    foreach ($rooms as $room) {
                        $room_id = $room['room_id'];
                        echo "<tr>";
                        echo "<td>" . $room['room_id'] . "</td>";
                        echo "<td>" . $room['room_type'] . "</td>";
                        echo "<td>" . $room['priority'] . "</td>";
                        echo "<td class='actions'>
                                <form action='../../DMMMSU_class_scheduler\includes/room_handler.php' method='post'>
                                    <input type='text' name='room_id' value=$room_id hidden>
                                    <button class='delete' name='delete_room'>Delete</button>
                                </form>
                                <form action='../../DMMMSU_class_scheduler/views/room_update.php' method='get'>
                                    <input type='text' name='room_id' value=$room_id hidden>
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
                        document.getElementById("room-show").innerHTML = xhr.responseText;
                    } else {
                        document.getElementById("room-show").innerHTML = "No Student Found" + xhr.status;
                    }
                }
            };
            xhr.open("GET", "../includes/jqueries/searchRoom.php?room_id=" + encodeURIComponent(student_id), true);
            xhr.send();
        }

        function redirectToDashboard() {
            window.location.href = '/DMMMSU_class_scheduler/views/dashboard.php';
        }
    </script>
</body>

</html>