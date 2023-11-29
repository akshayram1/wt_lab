<!-- Design and develop a responsive website to calculate Electricity bill using PHP. Condition for first 
50 units – Rs. 3.50/unit, for next 100 units – Rs. 4.00/unit, for next 100 units – Rs. 5.20/unit and for 
units above 250 – Rs. 6.50/unit. You can make the use of bootstrap as well as jQuery -->
<!DOCTYPE html>
<html>
<head>
    <title>Electricity Bill Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #135b67; /* Light blue background */
        }
        .container {
            max-width: 600px; /* Increased container width */
            margin: 30px auto; /* Center the container */
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #0056b3; /* Dark blue heading */
        }
        .mseb-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .mseb-logo img {
            max-width: 60px; /* Reduced logo size */
            height: auto;
        }
        form {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 10px; /* Reduced margin */
        }
        label {
            font-weight: bold;
            color: #0056b3; /* Dark blue label text */
        }
        input[type="number"], input[type="text"], input[type="date"] {
            padding: 8px; /* Reduced input padding */
            font-size: 14px; /* Smaller font size */
            border: 1px solid #ced4da;
            border-radius: 5px;
            width: 100%;
        }
        .btn-primary {
            padding: 10px; /* Reduced button padding */
            font-size: 14px; /* Smaller font size */
            width: 100%;
            background-color: #0056b3; /* Dark blue button background */
            border-color: #0056b3; /* Dark blue button border */
        }
        .btn-primary:hover {
            background-color: #003d80; /* Darker blue on hover */
            border-color: #003d80; /* Darker blue button border on hover */
        }
        #result {
            text-align: center;
            margin-top: 20px;
        }
        #bill-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        #bill-table th, #bill-table td {
            padding: 8px; /* Reduced table cell padding */
            border: 1px solid #ced4da;
            text-align: left;
        }
        #bill-table th {
            background-color: #0056b3;
            color: #fff;
        }
        .download-link {
            text-align: center;
            margin-top: 20px;
        }
        .download-link a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0056b3; /* Dark blue link background */
            color: #fff; /* White link text color */
            text-decoration: none;
            border-radius: 5px;
        }
        .download-link a:hover {
            background-color: #003d80; /* Darker blue link background on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="mseb-logo">
                    <img src="maha.png" alt="MSEB Logo">
                </div>
                <h1>MSEB</h1>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">User Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="house_number">House Number:</label>
                        <input type="text" class="form-control" id="house_number" name="house_number" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="consumer_id">Consumer ID:</label>
                        <input type="text" class="form-control" id="consumer_id" name="consumer_id" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="units">Enter Units Consumed:</label>
                        <input type="number" class="form-control" id="units" name="units" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="month">Review </label>
                        <input type="text" class="form-control" id="month" name="month" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="issue_date">Date of Issuing:</label>
                        <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="due_date">Due Date:</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
        <div id="result" class="mt-4">
           <?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $houseNumber = $_POST["house_number"];
    $consumerId = $_POST["consumer_id"];
    $units = (int)$_POST["units"];
    $issueDate = $_POST["issue_date"];
    $dueDate = $_POST["due_date"];
       if ($dueDate < $issueDate) {
        echo "<div class='alert alert-danger' role='alert'>Due date cannot be less than the issue date.</div>";
        exit;
    }
    $totalBill = 0;
    $billBreakdown = array();

    if ($units > 250) {
        $billBreakdown[] = "Units (above 250): " . ($units - 250) . " x Rs. 6.50";
        $totalBill += ($units - 250) * 6.50;
        $units = 250;
    }
    if ($units > 150) {
        $billBreakdown[] = "Units (next 100): " . ($units - 150) . " x Rs. 5.20";
        $totalBill += ($units - 150) * 5.20;
        $units = 150;
    }
    if ($units > 50) {
        $billBreakdown[] = "Units (next 100): " . ($units - 50) . " x Rs. 4.00";
        $totalBill += ($units - 50) * 4.00;
        $units = 50;
    }

    $billBreakdown[] = "Units (first 50): " . $units . " x Rs. 3.50";
    $totalBill += $units * 3.50;

    echo "<h4>Hi, " . htmlspecialchars($name) . "!</h4>";
    echo "<p>Address: " . htmlspecialchars($address) . "</p>";
    echo "<p>House Number: " . htmlspecialchars($houseNumber) . "</p>";
    echo "<p>Consumer ID: " . htmlspecialchars($consumerId) . "</p>";
    echo "<p>Units Consumed: " . $_POST["units"] . "</p>";
    echo "<p>Date of Issuing: " . htmlspecialchars($issueDate) . "</p>";
    echo "<p>Due Date: " . htmlspecialchars($dueDate) . "</p>";
    echo "<h4>Total Bill: Rs. " . number_format($totalBill, 2) . "</h4>";

    echo "<h4>Bill Breakdown:</h4>";
    echo "<ul>";
    foreach ($billBreakdown as $item) {
        echo "<li>" . $item . "</li>";
    }
    echo "</ul>";

    // Generate download link
    $filename = $name . "_electricity_bill.txt";
    $fileContent = "User Name: " . $name . "\n";
    $fileContent .= "Address: " . $address . "\n";
    $fileContent .= "House Number: " . $houseNumber . "\n";
    $fileContent .= "Consumer ID: " . $consumerId . "\n";
    $fileContent .= "Units Consumed: " . $_POST["units"] . "\n";
    $fileContent .= "Date of Issuing: " . $issueDate . "\n";
    $fileContent .= "Due Date: " . $dueDate . "\n\n";
    $fileContent .= "Bill Breakdown:\n";
    foreach ($billBreakdown as $item) {
        $fileContent .= $item . "\n";
    }
    $fileContent .= "\nTotal Bill: Rs. " . number_format($totalBill, 2);

    file_put_contents($filename, $fileContent);
    echo '<div class="download-link"><a href="' . $filename . '" download>Download Bill</a></div>';
}
?>

        </div>
    </div>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>