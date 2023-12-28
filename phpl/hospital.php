<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Login</title>
  <style>
   
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;
    }

    .login-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .input-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 8px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    button {
      padding: 8px 15px;
      border: none;
      border-radius: 3px;
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .error-message {
      color: red;
      margin-top: 5px;
    }

    .success-message {
      color: green;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>User Login</h2>
    <form method="POST">
      <div class="input-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="input-group">
        <button type="submit" name="login">Login</button>
      </div>
     <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $servername = "127.0.0.1:4306";
    $username = "root";
    $password = "";
    $dbname = "blood_group";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user = $_POST['username'];
    $enteredPassword = $_POST['password'];

    $sql = "SELECT * FROM user_data WHERE username = '$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['PASSWORD'];

        // Check if the entered password matches the stored password
        if ($enteredPassword === $storedPassword) {
            // Redirect to data.php after successful login
            header("Location: data.php");
            exit();
        } else {
            echo '<div class="error-message">Incorrect password.</div>';
        }
    } else {
        echo '<div class="error-message">User not found.</div>';
    }

    $conn->close();
}
?>

    </form>
  </div>
</body>
</html>
