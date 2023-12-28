<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <style>
    /* Styles */
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

    .registration-container {
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
  <div class="registration-container">
    <h2>User Registration</h2>
    <form method="POST">
      <div class="input-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required minlength="3">
      </div>
      <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required minlength="6">
      </div>
      <div class="input-group">
        <label for="branch">Branch Name:</label>
        <input type="text" id="branch" name="branch">
      </div>
	   <div class="input-group">
        <label for="branchd">Branch:</label>
        <input type="text" id="branchd" name="branchd">
      </div>
      <div class="input-group">
        <button type="submit" name="submit">Register</button>
      </div>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $servername = "127.0.0.1:4306";
          $username = "root";
          $password = "";
          $dbname = "blood_group";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $user = $_POST['username'];
          $pass = $_POST['password'];
          $branch = $_POST['branch'];
		  $branchd=$_POST['branchd'];

          if (strlen($pass) < 6) {
              echo '<div class="error-message">Password must be at least 6 characters long.</div>';
          } else {
              
              $sql = "INSERT INTO user_data (username, password, branch_name,branchd) VALUES ('$user', '$pass', '$branch','$branchd')";

              if ($conn->query($sql) === TRUE) {
                  echo '<div class="success-message">Registration successful!</div>';
              } else {
                  echo '<div class="error-message">Error: ' . $sql . '<br>' . $conn->error . '</div>';
              }
          }

          $conn->close();
      }
      ?>
    </form>
  </div>
</body>
</html>
