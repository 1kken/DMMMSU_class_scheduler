<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/change_password/change_password_view.php");
require_once(APP_NAME . "includes/change_password/change_password_model.php");

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
    <title>User Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .button-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn-blue {
            background-color: #007bff;
            color: #fff;
        }

        .btn-blue:hover {
            background-color: #0056b3;
        }

        .btn-tomato {
            background-color: tomato;
            color: #fff;
        }

        .btn-tomato:hover {
            background-color: #ff6347;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .checkbox-group label {
            margin-left: 5px;
            font-size: 14px;
        }

        .errors {
            color: tomato;
        }
    </style>
    <script src="../jquery.js"></script>
</head>

<body>

    <div class="container">
        <h1>Hello <?php echo get_full_name($pdo,$_SESSION["user_id"]); ?> </h1>
        <h2>Change Password</h2>
        <form action="../includes/change_password_handler.php" method="post">
            <div class="form-group">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Retype New Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="old-password">Old Password:</label>
                <input type="password" id="old-password" name="old_password" required>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="show-password">
                <label for="show-password">Show Password</label>
            </div>
            <div class="button-group">
                <button type="submit" name="change_pass" class="btn-blue">Change Password</button>
            </div>
        </form>
        <form action="../includes/change_password_handler.php" method="post">
            <div class="button-group">
                <button type="submit" name="log_out" class="btn-tomato">Log Out</button>
            </div>
        </form>
        <?php check_change_pass_errors(); ?>
    </div>
    <script>
        $(document).ready(function() {
            $('#show-password').change(function() {
                const newPasswordInput = $('#new-password');
                const confirmPasswordInput = $('#confirm-password');
                const oldPasswordInput = $('#old-password');
                if (this.checked) {
                    newPasswordInput.attr('type', 'text'); // Show password
                    confirmPasswordInput.attr('type', 'text'); // Show password
                    oldPasswordInput.attr('type', 'text'); // Show password
                } else {
                    newPasswordInput.attr('type', 'password'); // Hide password
                    confirmPasswordInput.attr('type', 'password'); // Hide password
                    oldPasswordInput.attr('type', 'password'); // Hide password
                }
            });
        });
    </script>

</body>

</html>