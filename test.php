<?php
$dsn = "mysql:host=localhost;dbname=class_schedule;";
$db_user_name = "root";
$db_password = "";

try {
    $pdo = new PDO($dsn, $db_user_name, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error Database: " . $e->getMessage();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Schedule Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            /* Arrange elements vertically */
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            margin-top: 25px;
            width: 50%;
            text-align: center;
            border-collapse: collapse;
            border: 1.5px solid black;
        }

        .container td {
            border: 1.5px solid black;
            width: 50%;
        }


        .container h1,
        .container h3 {
            margin: 10px;
        }

        .container img {
            width: 100px;
            height: 100px;
        }

        td {
            text-align: center;
        }

        #information {
            width: 100%;
        }

        #information {
            display: flex;
            justify-content: center;
        }

        #sched table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        #sched td,
        th {
            text-transform: capitalize;
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid black;
            border-right: 1px solid black;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="container" id="header">
        <table>
            <tr>
                <td><img src="./source/dmmsu_logo.png" alt="DMMMSU logo"></td>
                <td>
                    <h1>CLASS SCHEDULE FORM</h1>
                </td>
            </tr>
        </table>
    </div>
    <div id="information">
        <table>
            <tr>
                <td>
                    <h3>______ Semester, School Year 20__ - 20__</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>NAME: _________________ PROGRAM/YEAR/SECTION:______________</h3>
                </td>
            </tr>
        </table>
    </div>
    <div id="sched">
        <table>
            <tr>
                <td>Time</td>
                <td>Monday</td>
                <td>Tuesday</td>
                <!-- <td>Wednesday</td>
                <td>Thursday</td>
                <td>Friday</td>
                <td>Saturday</td> -->
            </tr>
            <?php
            function get_schedules_based_on_time($pdo, $time)
            {
                $sql = "SELECT subject.descriptive_title,schedule.day,schedule.start_time,schedule.end_time FROM SCHEDULE JOIN SUBJECT ON schedule.subject_id = subject.subject_id WHERE start_time =:time;";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['time' => $time]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            $time_1900 = strtotime("19:00");
            $time_0800 = strtotime("07:00");
            $skip_ctr = [0, 0, 0, 0, 0, 0];
            for ($curr_time = $time_0800; $curr_time <= $time_1900; $curr_time += 1800) {
                $days = ['monday'];
                $schedules = get_schedules_based_on_time($pdo, date("H:i:s", $curr_time));
                echo "<tr>";
                echo "<td>" . date("h:i A", $curr_time) . "</td>";
                $counter = 0;
                $index = 0;
                foreach ($days as $day) {
                    $found = false;
                    foreach ($schedules as $schedule) {
                        $rowspan = (strtotime($schedule['end_time']) - strtotime($schedule['start_time'])) / 1800 + 1;
                        if (strtolower($schedule['day']) == $day) {
                            echo "<td rowspan = $rowspan >" . $schedule['descriptive_title'] . "</td>";
                            $found = true;
                            $skip_ctr[$index] = $rowspan;
                            break;
                        }
                    }
                    if (!$found && $skip_ctr[$index] == 0) {
                        echo "<td></td>";
                    } else {
                        $skip_ctr[$index] -= 1;
                    }
                    $index += 1;
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>