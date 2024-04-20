<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/signup/signup_view.php");
require_once(APP_NAME . "includes/authorization.php");
if (is_logged_in()) {
    header("LOCATION: /DMMMSU_class_scheduler/views/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
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

        p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create an Account</h1>
        <form action="/DMMMSU_class_scheduler/includes/signup.handler.php" method="post">
            <div>
                <label for="id-number">Your ID Number</label>
                <input type="number" name="id-number" id="id-number" placeholder="21111111" required="">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required="">
            </div>
            <div>
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" required="">
            </div>
            <div>
                <label for="user-type">User Type</label>
                <select name="user-type" id="user-type" required="">
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                </select>
            </div>
            <button type="submit">Create an Account</button>
            <p>
                Already have an account? <a href="/DMMMSU_class_scheduler/views/auths/log_in_page.php">Login here</a>
            </p>
        </form>
        <?php check_for_signup_errors() ?>
    </div>
</body>

</html>