<?php
// Include the database connection
include('../dbconf.php');

// Start session
session_start();

// Handle login
if (isset($_POST['loginSubmit'])) {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Query to find user by email
    $query = "SELECT * FROM users WHERE user_email = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $user['user_password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $user['user_email'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['user_role'] = $user['user_role'];

                header('Location: ../index.php'); // Redirect after successful login
                exit;
            } else {
                $loginError = "Incorrect password.";
            }
        } else {
            $loginError = "User not found.";
        }

        $stmt->close();
    }
}

// Handle signup
if (isset($_POST['signupSubmit'])) {
    $name = $_POST['signupName'];
    $email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE user_email = ?";
    if ($stmt = $conn->prepare($checkEmailQuery)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $signupError = "Email already in use.";
        } else {
            // Hash the password before saving
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $insertQuery = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
            if ($stmt = $conn->prepare($insertQuery)) {
                $stmt->bind_param('sss', $name, $email, $hashedPassword);
                $stmt->execute();

                // Redirect to login page after successful signup
                header('Location: index.php');
                exit;
            }
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login / Sign Up</title>
  <style>
    /* Global Styles */
    body {
      font-family: 'Arial', sans-serif;
      background: url('https://img.freepik.com/free-vector/watercolor-background-world-book-day-celebration_23-2150230426.jpg?t=st=1733078946~exp=1733082546~hmac=050e9832108d0c9c786e4d66a95b5b026c8a6c95f104ed5b2ada62e0da340ebc&w=740') no-repeat center center;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      overflow: hidden;
      color: #333;
    }

    .container {
      position: relative;
      width: 400px;
      height: 500px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      transition: transform 0.6s ease-in-out;
    }

    /* Buttons */
    .form-btns {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 20px;
    }

    .form-btn {
      padding: 10px 20px;
      font-size: 16px;
      background-color: lightblue;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .form-btn:hover {
      background-color: darkblue;
      color: white;
    }

    /* Form Styles */
    .form {
      display: none;
      flex-direction: column;
      gap: 15px;
      width: 80%;
    }

    .form input {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form input[type="submit"] {
      background-color: darkblue;
      color: white;
      cursor: pointer;
      border: none;
      transition: background-color 0.3s ease;
    }

    .form input[type="submit"]:hover {
      background-color: lightblue;
    }

    /* Active form display */
    .form.active {
      display: flex;
    }
    </style>
</head>
<body>

<div class="container" id="formContainer">
  <div class="form-btns">
    <button class="form-btn" id="loginBtn">Login</button>
    <button class="form-btn" id="signupBtn">Sign Up</button>
  </div>

  <div class="form" id="loginForm">
    <h2>Login</h2>
    <?php if (isset($loginError)) echo "<p style='color:red;'>$loginError</p>"; ?>
    <form method="POST">
      <input type="email" name="loginEmail" placeholder="Enter your email" required>
      <input type="password" name="loginPassword" placeholder="Enter your password" required>
      <br><br>
      <input type="submit" value="Login" name="loginSubmit">
    </form>
  </div>

  <div class="form" id="signupForm">
    <h2>Sign Up</h2>
    <?php if (isset($signupError)) echo "<p style='color:red;'>$signupError</p>"; ?>
    <form method="POST">
      <input type="text" name="signupName" placeholder="Enter your name" required>
      <input type="email" name="signupEmail" placeholder="Enter your email" required>
      <input type="password" name="signupPassword" placeholder="Enter your password" required>
      <br><br>
      <input type="submit" value="Sign Up" name="signupSubmit">
    </form>
  </div>
</div>

<script>
  // Get elements
  const loginBtn = document.getElementById('loginBtn');
  const signupBtn = document.getElementById('signupBtn');
  const formContainer = document.getElementById('formContainer');
  const loginForm = document.getElementById('loginForm');
  const signupForm = document.getElementById('signupForm');

  // Toggle between login and signup forms
  loginBtn.addEventListener('click', function() {
    loginForm.classList.add('active');
    signupForm.classList.remove('active');
    formContainer.classList.remove('slide-left');
  });

  signupBtn.addEventListener('click', function() {
    signupForm.classList.add('active');
    loginForm.classList.remove('active');
    formContainer.classList.add('slide-left');
  });

  // Initially show the login form
  loginForm.classList.add('active');
</script>

</body>
</html>
