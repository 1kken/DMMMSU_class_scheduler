<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/room/room_model.php");
require_once(APP_NAME . "includes/room/room_view.php");
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
    <title>Room Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
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

        select,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
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
    </style>
</head>

<body>

    <div class="container">
        <?php
            if(!isset($_GET['room_id'])){
                echo "Room Id not Found";
                exit();
            }
            $room = get_room($pdo, $_GET['room_id']);

            if(empty($room)){
                echo "Room not found";
                exit();
            }
        ?>
        <h2>Update Room</h2>
        <?php
        $room_id = $room['room_id'];
        $room_type = $room['room_type']; 
        $priority = $room['priority'];

        // Function to generate the dropdown options for room type
        function generateRoomTypeOptions($selectedType)
        {
            $types = array("Lecture", "Laboratory");
            foreach ($types as $type) {
                $selected = ($type == $selectedType) ? "selected" : "";
                echo "<option value=\"$type\" $selected>$type</option>";
            }
        }

        // Function to generate the dropdown options for priority
        function generatePriorityOptions($selectedPriority)
        {
            for ($i = 1; $i <= 5; $i++) {
                $selected = ($i == $selectedPriority) ? "selected" : "";
                echo "<option value=\"$i\" $selected>$i</option>";
            }
        }
        ?>

        <form action="../includes/room_handler.php" method="post">
            <div class="form-group">
                <label for="room-id">Room ID:</label>
                <input type="text" id="room-id" name="room_id" value="<?php echo $_GET['room_id']; ?>" required>
            </div>
            <div class="form-group">
                <label for="room-type">Room Type:</label>
                <select id="room-type" name="room_type" required>
                    <?php generateRoomTypeOptions($room_type); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="priority">Priority:</label>
                <select id="priority" name="room_priority" required>
                    <?php generatePriorityOptions($priority); ?>
                </select>
            </div>
            <div class="form-group">
                <input type = "text" name="old_room_id" value="<?php echo $room_id; ?>" hidden>
                <input type="submit" name = "update_room"value="Update Room">
            </div>
        </form>
        <?php
            check_create_room_errors()
        ?>
    </div>

</body>

</html>
