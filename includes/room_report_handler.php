<?php
require_once("database_header.php");
require_once('config_session.inc.php');
require_once('report/report_model.php');
?>
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

        .normal-td {
            border-bottom: 1px solid black;
            border-right: 1px solid black;
        }

        .sched-td {
            border-right: 1px solid black;
        }

        td {
            text-transform: capitalize;
        }

        #sched th {
            text-transform: capitalize;
            text-align: left;
            padding: 8px;
            border-right: 1px solid black;
            font-size: 20px;
        }

        #header {
            text-align: center;
        }


        #header td {
            border: none;
        }
    </style>
</head>
<?php
if (isset($_POST['room_id']) && isset($_POST['sy_room']) && isset($_POST['semester_room'])) { ?>
    <body>
        <div class="container" id="header">
            <table>
                <tr>
                    <td><img src="../source/dmmsu_logo.png" alt="DMMMSU logo"></td>
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
                        <?php
                        $post_name = "";
                        if ($_POST['semester_room'] == "1") {
                            $post_name = "st Semester";
                        } else {
                            $post_name = "nd Semester";
                        }
                        ?>
                        <h3>School Year: <?php echo $_POST['sy_room'] . " " . $_POST['semester_room'] . $post_name ?></h3>
                    </td>
                    <td>
                        <h3>Room: <?php echo $_POST['room_id'] ?></h3>
                    </td>
                </tr>
            </table>
        </div>
        <div id="sched">
            <table>
                <tr>
                    <th class='normal-td'>Time</th>
                    <th class='normal-td'>Monday</th>
                    <th class='normal-td'>Tuesday</th>
                    <th class='normal-td'>Wednesday</th>
                    <th class='normal-td'>Thursday</th>
                    <th class='normal-td'>Friday</th>
                    <th class='normal-td'>Saturday</th>
                </tr>
                <?php
                $room_id = $_POST['room_id'];
                $sy = $_POST['sy_room'];
                $semester = $_POST['semester_room'];
                function get_schedules_based_on_time($pdo, $room_id, $sy, $semester,$start_time)
                {
                    $query = "SELECT * FROM schedule
                     JOIN subject ON schedule.subject_id = subject.subject_id 
                     WHERE room_id = :room_id AND sy = :sy AND schedule.semester = :semester AND start_time = :start_time ORDER BY start_time ASC";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute(['room_id' => $room_id, 'sy' => $sy, 'semester' => $semester, 'start_time' => $start_time]);
                    return $stmt->fetchAll();
                }
                $time_1900 = strtotime("19:00");
                $time_0800 = strtotime("07:00");
                $skip_ctr = [0, 0, 0, 0, 0, 0];
                for ($curr_time = $time_0800; $curr_time <= $time_1900; $curr_time += 1800) {
                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                    $schedules = get_schedules_based_on_time($pdo, $room_id, $sy, $semester,date("H:i:s", $curr_time)); 
                    echo "<tr>";
                    echo "<td class='normal-td'>" . date("h:i A", $curr_time) . "</td>";
                    $counter = 0;
                    $index = 0;
                    foreach ($days as $day) {
                        $found = false;
                        foreach ($schedules as $schedule) {
                            $rowspan = (strtotime($schedule['end_time']) - strtotime($schedule['start_time'])) / 1800;
                            if (strtolower($schedule['day']) == $day) {
                                $start_time = strtotime($schedule['start_time']);
                                $start_time = date("h:i A", $start_time);
                                $end_time = strtotime($schedule['end_time']);
                                $end_time = date("h:i A", $end_time);
                                echo "<td rowspan = $rowspan class='sched-td' >" . $schedule['descriptive_title'] . "<br>" . $start_time . "-" . $end_time . "</td>";
                                $found = true;
                                $skip_ctr[$index] = $rowspan;
                                break;
                            }
                        }
                        if (!$found && $skip_ctr[$index] == 0) {
                            echo "<td class='normal-td'></td>";
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
<?php } ?>
</html>