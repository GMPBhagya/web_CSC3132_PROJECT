<?php
// Include the database connection file
include('dbconf.php');

// Check if the 'id' is provided in the URL
if (isset($_GET['id'])) {
    $storyId = $_GET['id'];

    // SQL query to fetch the story by ID
    $storyQuery = "SELECT * FROM writers_stories WHERE id = ?";
    $stmt = $conn->prepare($storyQuery);
    $stmt->bind_param("i", $storyId);
    $stmt->execute();
    $storyResult = $stmt->get_result();

    // Check if the story is found
    if ($storyResult->num_rows > 0) {
        $story = $storyResult->fetch_assoc();
    } else {
        // If no story is found, redirect to discover.php
        header("Location: discover.php");
        exit;
    }
} else {
    // If 'id' is not provided in the URL, redirect to discover.php
    header("Location: discover.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookHevan: Full Story</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      color: #333;
    }

    /* Sidebar Styling */
    .sidebar {
      background-color: #2C3E50;
      color: #F8B400;
      min-height: 100vh;
      padding: 30px 20px;
      position: fixed;
      width: 220px;
    }

    .sidebar h2 {
      font-weight: bold;
      color: #FFF;
    }

    .sidebar a {
      color: #F8B400;
      display: block;
      padding: 10px 0;
      font-size: 1.1rem;
    }

    .sidebar a:hover {
      color: #FFF;
      text-decoration: none;
    }

    /* Main Content */
    .main-content {
      margin-left: 250px;
      padding: 20px;
    }

    /* Full Story Section */
    .story-full {
      background-color: #F8F8F8;
      padding: 40px;
      margin-top: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .story-full h2 {
      font-size: 2rem;
      color: #2C3E50;
      font-weight: bold;
    }

    .story-full p {
      color: #666;
      font-size: 1.2rem;
      line-height: 1.6;
    }

    /* Footer */
    .footer {
      background-color: #2C3E50;
      color: #F8B400;
      padding: 20px;
      text-align: center;
      margin-top: 40px;
    }

    .footer a {
      color: #F8B400;
    }

    .footer a:hover {
      color: #FFF;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>BookHevan</h2>
    <a href="index.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="discover.php">Discover Stories</a>
    <a href="write_story.php">Write a Story</a>
    <?php
    // Check if the user is logged in via the cookie
    if (isset($_COOKIE['user_email'])) {
        // User is logged in, show Profile and Logout links
        $user_email = $_COOKIE['user_email']; // Get the user's email from the cookie
        echo "<a href='#'>Profile ($user_email)</a>";
        echo "<a href='logout.php'>Logout</a>";
    } else {
        // User is not logged in, show the Login link
        echo "<a href='login/index.php'>Login</a>";
    }
    ?>
    <a href="#">Contact</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">

    <!-- Full Story Section -->
    <section class="story-full">
      <h2><?php echo htmlspecialchars($story['title']); ?></h2>
      <p><?php echo nl2br(htmlspecialchars($story['content'])); ?></p>
      <p class="author">By: <?php echo htmlspecialchars($story['author_email']); ?></p>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <p>&copy; 2024 BookHevan. All rights reserved.</p>
      <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

  </div>

</body>
</html>
