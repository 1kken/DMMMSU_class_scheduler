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
            flex-direction: column; /* Arrange elements vertically */
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
        .container td{
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

    </style>
</head>

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
</body>

</html>
