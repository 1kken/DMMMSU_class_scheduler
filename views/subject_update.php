<?php
define('APP_NAME', dirname(__FILE__) . "/../");
require_once(APP_NAME . "includes/authorization.php");
require_once(APP_NAME . "includes/config_session.inc.php");
require_once(APP_NAME . "includes/database_header.php");
require_once(APP_NAME . "includes/subject/subject_model.php");
require_once(APP_NAME . "includes/subject/subject_view.php");

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
    <title>Update Subject</title>
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

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
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
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
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
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Update Subject</h2>
        <?php
        if (!isset($_GET["subject_id"])) {
            echo "Subject ID not found.";
            exit();
        }
        $subject_id = $_GET['subject_id']; // Assuming subject_id is passed via URL
        $subject = get_subject($pdo, $subject_id);
        if (empty($subject)) {
            echo "Subject not found.";
            exit();
        }
            ?>
            <form action="../../DMMMSU_class_scheduler\includes\subject_handler.php" method="post">
                <div class="form-group">
                    <label for="subject-id">Subject ID:</label>
                    <input type="text" id="subject-id" name="subject_id" value="<?php echo $subject['subject_id']; ?>">
                </div>
                <div class="form-group">
                    <label for="descriptive-title">Descriptive Title:</label>
                    <input type="text" id="descriptive-title" name="descriptive_title" value="<?php echo $subject['descriptive_title']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="lecture-units">Lecture Units:</label>
                    <select id="lecture-units" name="lecture_units" required>
                        <?php
                        for ($i = 0; $i <= 3; $i++) {
                            $selected = ($i == $subject['lecture_units']) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lab-units">Laboratory Units:</label>
                    <select id="lab-units" name="laboratory_units" required>
                        <?php
                        for ($i = 0; $i <= 3; $i++) {
                            $selected = ($i == $subject['laboratory_units']) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="total-units">Total Units:</label>
                    <input type="text" id="total-units" name="total_units" value="2" readonly>
                </div>
                <div class="form-group">
                    <label for="priority">Priority:</label>
                    <select id="priority" name="priority" required>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            $selected = ($i == $subject['priority']) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="text" name="old_subject_id" value=<?php echo $subject_id?> hidden>
                <input type="submit" name="update_subject" value="Update Subject">
            </form>
        <?php
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const lectureUnitsSelect = document.getElementById('lecture-units');
            const labUnitsSelect = document.getElementById('lab-units');
            const totalUnitsInput = document.getElementById('total-units');

            lectureUnitsSelect.addEventListener('change', updateTotalUnits);
            labUnitsSelect.addEventListener('change', updateTotalUnits);

            function updateTotalUnits() {
                const lectureUnits = parseInt(lectureUnitsSelect.value);
                const labUnits = parseInt(labUnitsSelect.value);
                const total = lectureUnits + labUnits;
                totalUnitsInput.value = total ;
            }
        });
    </script>
</body>

</html>
