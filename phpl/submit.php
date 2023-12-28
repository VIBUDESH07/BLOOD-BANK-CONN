<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $name = $_POST["name"];
    $blood_group = $_POST["blood_group"];
    $branch = $_POST["branch"];
    $bank_name = $_POST["bank_name"];

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

    // Prepare and execute a SQL query to insert data into the database
    $sql = "INSERT INTO blood_group_data (name, blood_group, branch, bank_name) VALUES ('$name', '$blood_group', '$branch', '$bank_name')";

    if ($conn->query($sql) === TRUE) {
        echo "Blood group information has been successfully stored in the database.";
    } else {
        echo "Error storing blood group information in the database: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>