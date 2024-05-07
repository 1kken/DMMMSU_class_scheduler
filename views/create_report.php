<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-top: 5px;
        }

        input[type="text"][readonly] {
            background-color: #f0f0f0;
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

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        select {
            text-transform: capitalize;
        }

        .separator {
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Report</h1>
        <form action="process_report.php" method="POST">
            <div class="separator">
                <h1>Filter</h1>
            </div>
            <div class="form-group">
                <label for="section">Section:</label>
                <select id="section" name="section">
                    <option value="section1">Section 1</option>
                    <option value="section2">Section 2</option>
                    <option value="section3">Section 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester" name="semester">
                    <option value="semester1">Semester 1</option>
                    <option value="semester2">Semester 2</option>
                    <option value="semester3">Semester 3</option>
                </select>
            </div>
            <div class="separator">
                <h1>Or</h1>
            </div>
            <div class="form-group">
                <label for="report_id">Report by ID:</label>
                <input type="text" id="report_id" name="report_id">
            </div>
            <input type="submit" value="Generate Report">
        </form>
    </div>
</body>
</html>
