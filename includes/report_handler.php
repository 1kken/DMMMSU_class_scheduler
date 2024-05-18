<?php
require_once("database_header.php");
require_once('config_session.inc.php');
require_once('report/report_model.php');
?>
<?php
if (isset($_POST['section']) && isset($_POST['semester']) && isset($_POST['sy']) && isset($_POST['student_id'])) {
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

      #sched th,
      td {
        font-size: 12px;
      }

      #header {
        text-align: center;
      }


      #header td {
        border: none;
      }

      #summary {
        position: relative;
        margin-top: 15px;
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
      }




      #summary td,
      th {
        border: 1px solid black;
        font-size: 14px;
      }

      @media print {
        body {
          margin: 10mm;
        }

        table {
          page-break-inside: auto;
        }

        tr {
          page-break-inside: avoid;
          page-break-after: auto;
        }

        thead {
          display: table-header-group;
        }

        tfoot {
          display: table-footer-group;
        }
      }

      table {
        page-break-inside: avoid;
      }

      .small{
        font-size: 10px;
      }
    </style>
  </head>

  <body>
    <div class="container" id="header">
      <table>
        <tr>
          <td><img src="../source/dmmsu_logo.png" alt="DMMMSU logo"></td>
          <td>
            <h4>CLASS SCHEDULE FORM</h4>
          </td>
        </tr>
      </table>
    </div>
    <?php
    $student = get_student($pdo, $_POST['student_id']);
    ?>
    <div id="information">
      <table>
        <tr>
          <td>
            <?php
            $post_name = "";
            if ($_POST['semester'] == "1") {
              $post_name = "st Semester";
            } else {
              $post_name = "nd Semester";
            }
            ?>
            <h3><?php echo $_POST['semester'] . $post_name . ", School Year " . $_POST['sy']; ?></h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3>NAME: <?php echo $student['full_name']; ?> PROGRAM/YEAR/SECTION:BSCS <?php echo $_POST['section']; ?></h3>
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
        $section_id = $_POST['section'];
        $semester = $_POST['semester'];
        $sy = $_POST['sy'];
        function get_schedules_based_on_time($pdo, $time)
        {
          $sql = "SELECT subject.descriptive_title,schedule.day,schedule.start_time,schedule.end_time 
                FROM schedule JOIN subject ON schedule.subject_id = subject.subject_id WHERE start_time =:time
                AND section_id = :section_id AND schedule.semester = :semester AND sy =:sy;";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(['time' => $time, 'section_id' => $_POST['section'], 'semester' => $_POST['semester'], 'sy' => $_POST['sy']]);
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $time_1900 = strtotime("19:00");
        $time_0800 = strtotime("07:00");
        $skip_ctr = [0, 0, 0, 0, 0, 0];
        for ($curr_time = $time_0800; $curr_time <= $time_1900; $curr_time += 1800) {
          $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
          $schedules = get_schedules_based_on_time($pdo, date("H:i:s", $curr_time));
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
    <div id="summary_container">
      <table id="summary">
        <tbody>
          <tr>
            <th>Code No.</th>
            <th>Course Number</th>
            <th>Descriptive Title</th>
            <th>Instructor</th>
            <th>Units</th>
            <th>Time</th>
            <th>Day</th>
            <th>Room</th>
          </tr>
          <?php
          function get_summary($pdo)
          {
            $sql = "SELECT schedule.`code`,schedule.`subject_id`,subject.descriptive_title,
                          CONCAT(instructor.last_name,' ', instructor.first_name) AS instructor_name,
                          subject.total_units,schedule.start_time,schedule.`end_time`,schedule.`day`,schedule.`room_id`
                          FROM `student`
                          JOIN `schedule` ON student.section_id = schedule.section_id
                          JOIN `subject` ON subject.subject_id = schedule.`subject_id`
                          JOIN `instructor` ON instructor.instructor_id = schedule.instructor_id
                          WHERE student.student_id = :student_id AND schedule.`semester` = :semester AND schedule.`sy` = :sy;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['student_id' => $_POST['student_id'], 'semester' => $_POST['semester'], 'sy' => $_POST['sy']]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
          }
          $summary = get_summary($pdo);
          foreach ($summary as $row) {
            echo "<tr>";
            echo "<td>" . $row['code'] . "</td>";
            echo "<td>" . $row['subject_id'] . "</td>";
            echo "<td>" . $row['descriptive_title'] . "</td>";
            echo "<td>" . $row['instructor_name'] . "</td>";
            echo "<td>" . $row['total_units'] . "</td>";
            echo "<td>" . date("h:i A", strtotime($row['start_time'])) . "-" . date("h:i A", strtotime($row['end_time']))  . "</td>";
            echo "<td>" . $row['day'] . "</td>";
            echo "<td>" . $row['room_id'] . "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
      <?php
      function get_total_units($pdo)
      {
        $sql = "SELECT SUM(subquery.total_units) AS total_units
                FROM (
                  SELECT DISTINCT subject.descriptive_title, subject.total_units
                  FROM `student`
                  JOIN `schedule` ON student.section_id = schedule.section_id
                  JOIN `subject` ON subject.subject_id = schedule.subject_id
                  JOIN `instructor` ON instructor.instructor_id = schedule.instructor_id
                  WHERE student.student_id = :student_id AND schedule.semester = :semester AND schedule.sy = :sy
                ) AS subquery;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['student_id' => $_POST['student_id'], 'semester' => $_POST['semester'], 'sy' => $_POST['sy']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }
      $total_units = get_total_units($pdo);
      ?>
      <p style="margin-left: 500px;">total units: <?php echo $total_units['total_units'] ?></p>
    </div>
    <div style="margin-right:0px; width:100%;">
      <p>Approved:</p>
      <p>__________________________</p>
      <p>College Dean/institute Director/Program Chair</p>
    </div>
    <div style="margin-right:0px; width: 100%;" class="small">
      <p>DMMMSU-SAR-F005</p>
      <p>Rev. No. 01 (10-26-2020)</p>
    </div>
  </body>
  <script>
    window.print();
  </script>

  </html>
<?php } ?>