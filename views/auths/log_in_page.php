<?php
define('APP_NAME', dirname(__FILE__) . "/../../");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/login/login_view.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="number"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome User</h1>
    <form action="/DMMMSU_class_scheduler/includes/login.handler.php" method="post">
        <div>
            <label for="id-number">ID number</label>
            <input type="number" id="id-number" name="id-number" placeholder="21111111" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div>
            <label for="user-type">User Type</label>
            <select name="user-type" id="user-type" required="">
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
            </select>
        </div>
        <div>
            <a href="/DMMMSU_class_scheduler/views/auths/sign_up_page.php">Create Account</a>
        </div>
        <button type="submit">Login</button>
    </form>
    <?php check_login_errors(); ?>
</div>
</body>
</html>
