<?php
session_start();
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize inputs
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if the user exists in the database
    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user data
        $row = $result->fetch_assoc();

        // Verify password using password_hash()
        if (password_verify($password, $row['password_hash'])) {
            // Login successful, set session variables
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['user_role'];

            // Redirect to the homepage
            header("Location: index.php");
            exit();
        } else {
            // Incorrect password
            $error = "Invalid password.";
        }
    } else {
        // User not found
        $error = "No user found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BookHevan</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar or Navbar Section (Optional) -->
    <div class="container">
        <h2 class="mt-5">Login</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3">Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
</body>
</html>
