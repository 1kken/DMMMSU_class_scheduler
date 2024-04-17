<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/dashboard_model.php");


if (!is_logged_in()) {
    header("LOCATION: /DMMMSU_class_scheduler/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .dashboard {
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: #fff;
            padding: 20px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .sidebar h3 {
            margin-top: 0;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .menu-item {
            margin-bottom: 10px;
        }

        .menu-item a {
            border-bottom: transparent 1px solid;
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 3px 0;
            transition: background-color 0.3s ease; /* Added transition */
            border-radius: 2px;
            margin-bottom: 30px;
        }

        .menu-item a:hover {
            border-bottom: lime 1px solid;
            background-color: #555;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            margin-bottom: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            position: relative; /* Added positioning */
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            width: calc(33% - 20px); /* Adjust the width as needed */
            margin-bottom: 20px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            margin-bottom: 10px;
        }

        .button-group {
            margin-top: 10px;
        }

        .button-group button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 5px;
        }

        .button-group button:hover {
            background-color: #0056b3;
        }

        .user-icon {
            position: absolute;
            top: 10px;
            right: 20px;
            cursor: pointer;
            display: flex; /* Added */
            align-items: center; /* Added */
        }

        .user-icon img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px; /* Added */
        }

        .user-icon p {
            margin: 0; /* Added */
            font-size: 14px; /* Added */
        }
    </style>
</head>

<body>

    <div class="dashboard">
        <div class="sidebar">
            <h3>Menu</h3>
            <div class="menu-item">
                <a href="student.php">Students</a>
            </div>
            <div class="menu-item">
                <a href="instructor.php">Instructors</a>
            </div>
            <div class="menu-item">
                <a href="room.php">Rooms</a>
            </div>
            <div class="menu-item">
                <a href="subject.php">Subjects</a>
            </div>
            <div class="menu-item">
                <a href="#reports">Generate Reports</a>
            </div>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <div class="user-icon" onclick="location.href='user.php'">
                    <img src="../source/user-icon.png" alt="User">
                    <p><?php echo get_full_name_user($pdo,$_SESSION["user_id"])?></p>
                </div>
            </div>
            <div class="card-container">
                <div class="card" id="students">
                    <h2 class="card-title">Students</h2>
                    <p><?php echo get_count_students($pdo)?></p>
                </div>
                <div class="card" id="instructors">
                    <h2 class="card-title">Instructors</h2>
                    <p><?php echo get_count_instructors($pdo)?></p>
                </div>
                <div class="card" id="rooms">
                    <h2 class="card-title">Rooms</h2>
                    <p><?php echo get_count_rooms($pdo)?></p>
                </div>
                <div class="card" id="subjects">
                    <h2 class="card-title">Subjects</h2>
                    <p><?php echo get_count_subjects($pdo)?></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
