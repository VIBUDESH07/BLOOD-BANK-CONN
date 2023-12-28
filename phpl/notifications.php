<?php
// Database connection information
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

// Check if the form is submitted and selectedId is set
if (isset($_POST['selectById'])) {
    $selectedId = $_POST['selectedId'];

    // Fetch the entire row based on the selected ID
    $sql = "SELECT * FROM blood_group_data WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $selectedId); // 'i' indicates an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Display the entire row in a table format
    if ($result->num_rows > 0) {
        echo "<h2>Selected Row Data</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Blood Group</th><th>Branch</th><th>Bank Name</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['blood_group'] . "</td>";
            echo "<td>" . $row['branch'] . "</td>";
            echo "<td>" . $row['bank_name'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No data available for the selected ID.</p>";
    }
} else {
    // If no ID is selected, display a message
    echo "<p>No ID selected.</p>";
}

// Close the database connection
$conn->close();
?>
