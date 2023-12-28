<?php
$server = "127.0.0.1:4306";
$username = "root";
$password = "";
$database = "blood_group";

// Create a database connection
$conn = new mysqli($server, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform a query
$sql = "SELECT username, branch_name, branchd FROM user_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url('Blood bank.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            background-color: rgba(255, 255, 255, 0.8);
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Blood Group Search and Delete</h2>
    <table>
        <tr>
            <th>S.No</th>
            <th>USERNAME</th>
            <th>HOSPITAL</th>
            <th>BRANCH</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            $serial = 1; // Initialize serial number counter
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $serial . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["branch_name"] . "</td>
                        <td>" . $row["branchd"] . "</td>
                      </tr>";
                $serial++; // Increment the serial number for the next row
            }
        } else {
            echo "<tr><td colspan='4'>No data available.</td></tr>";
        }
        ?>
    </table>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
