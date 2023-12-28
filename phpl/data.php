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

// Initialize the search and delete variables
$searchBloodGroup = '';
$deleteName = '';

if (isset($_POST['search'])) {
    // Get the blood group to search for
    $searchBloodGroup = $_POST['searchBloodGroup'];
    $sql = "SELECT name, blood_group, branch, bank_name FROM blood_group_data WHERE blood_group = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchBloodGroup);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <html>

    <body>
        <table>
            <tr>
                <th>ID</th>
                <th>Blood Group</th>
                <th>Branch</th>
                <th>Bank Name</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["name"] . "</td><td>" . $row["blood_group"] . "</td><td>" . $row["branch"] . "</td><td>" . $row["bank_name"] . "</td></tr>";
                }
            } else {
                echo "No data available.";
            }
            ?>
        </table>
    </body>
    </html>
    <?php
} else if (isset($_POST['delete'])) {
    // Get the name to be deleted
    $deleteName = $_POST['deleteName'];

    // Prepare and execute a SQL query to delete data from the database based on the name
    $sql = "DELETE FROM blood_group_data WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $deleteName);
    $stmt->execute();
} else if (isset($_POST['selectById'])) {
    // Get the selected ID
    $selectedId = $_POST['selectedId'];

    // Redirect to another webpage with the selected ID
    header("Location: other_webpage.php?id=" . $selectedId);
    exit();
}

// Prepare and execute a SQL query to retrieve all data from the database
$sql = "SELECT name, blood_group, branch, bank_name FROM blood_group_data";
$result = $conn->query($sql);

// Define the background color for the table
$tableBackgroundColor = "#f0f0f0"; // You can change this to the desired color

?>

<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            background-image: url('Blood bank.jpg');
            background-size: cover;
        }

        table {
            background-color: rgba(255, 255, 255, 0.8);
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
        }

        label,
        input[type="text"],
        input[type="submit"] {
            font-family: 'YourSpecialFont', sans-serif;
        }
    </style>
</head>

<body>
    <h2>Blood Group Search, Delete, and Select</h2>
    <!-- Search form -->
    <form method="POST" action="">
        <label for="searchBloodGroup">Search for Blood Group:</label>
        <input type="text" name="searchBloodGroup" id="searchBloodGroup" value="<?php echo $searchBloodGroup; ?>">
        <input type="submit" name="search" value="Search"><br><br>
    </form>

    <!-- Delete form -->
    <form method="POST" action="">
        <label for="deleteName">Delete by Name:</label>
        <input type="text" name="deleteName" id="deleteName" value="<?php echo $deleteName; ?>">
        <input type="submit" name="delete" value="Delete">
    </form>

    <!-- Select by ID form -->
  <!-- Select by ID form -->
<form method="POST" action="notifications.php">
    <label for="selectedId">Select by ID:</label>
    <input type="text" name="selectedId" id="selectedId" value="">
    
    <!-- Additional hidden fields for blood group and branch -->
    <input type="hidden" name="bloodGroup" value="<?php echo $row["blood_group"]; ?>">
    <input type="hidden" name="branch" value="<?php echo $row["branch"]; ?>">

    <input type="submit" name="selectById" value="Select">
</form>


    <!-- Display records in a table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Blood Group</th>
            <th>Branch</th>
            <th>Bank Name</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["name"] . "</td><td>" . $row["blood_group"] . "</td><td>" . $row["branch"] . "</td><td>" . $row["bank_name"] . "</td></tr>";
            }
        } else {
            echo "No data available.";
        }
        ?>
    </table>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
