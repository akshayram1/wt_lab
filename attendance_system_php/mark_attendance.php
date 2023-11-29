<!-- mark_attendance.php -->
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="checkbox"] {
            margin-bottom: 5px;
        }

        input[type="submit"] {
            background: #4caf50;
            color: #fff;
            cursor: pointer;
            margin-top: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php
    include 'db_config.php';

    // Initialize $selectedDate to avoid undefined variable error
    $selectedDate = '';

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if 'attendance' key is set in the $_POST array
        $attendance = isset($_POST['attendance']) ? $_POST['attendance'] : null;

        // Check if 'attendance_date' key is set in the $_POST array
        $selectedDate = isset($_POST['attendance_date']) ? $_POST['attendance_date'] : '';

        // Validate and sanitize the date to prevent SQL injection
        $selectedDate = date('Y-m-d', strtotime($selectedDate));

        // Check if 'attendance' is an array before processing
        if (!is_null($attendance) && is_array($attendance)) {
            // Start a transaction
            $conn->begin_transaction();

            foreach ($attendance as $student_id) {
                $stmt = $conn->prepare("INSERT INTO attendance (student_id, attendance_date, is_present) VALUES (?, ?, 1)");
                $stmt->bind_param("is", $student_id, $selectedDate);

                // Additional debugging output
                echo "<p>Debug: student_id = $student_id, selectedDate = $selectedDate</p>";

                if ($stmt->execute() !== TRUE) {
                    echo "<p>Error: " . $stmt->error . "</p>";
                    // Rollback the transaction in case of an error
                    $conn->rollback();
                } else {
                    echo "<p>Attendance marked successfully for student ID: $student_id</p>";
                }

                $stmt->close();
            }

            // Commit changes to the database
            $conn->commit();
        } else {
            echo "<p>No students selected for attendance.</p>";
        }
    }
    ?>

    <form action="" method="post">
        <?php
        $result = $conn->query("SELECT * FROM students");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<input type='checkbox' name='attendance[]' value='{$row['id']}'> {$row['name']}<br>";
            }
        }
        ?>

        <label for="attendance_date">Attendance Date:</label>
        <input type="date" name="attendance_date" required>

        <input type="submit" value="Mark Attendance">
    </form>
</body>
</html>