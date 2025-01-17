<?php
// Include the database connection file
include('dbconf.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_email = $_COOKIE['user_email']; // Assuming the user is logged in

    // SQL query to insert the new story into the database
    $sql = "INSERT INTO stories (title, content, author_email) VALUES ('$title', '$content', '$author_email')";

    if ($conn->query($sql) === TRUE) {
        $message = "Story uploaded successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Write a Story - BookHevan</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Add styles here as needed */
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>BookHevan</h2>
    <a href="index.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="#">Discover Stories</a>
    <a href="write_story.php">Write a Story</a>
    <a href="#">Contact</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <section class="about-section">
      <h1>Upload Your Story</h1>
      <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
      
      <form action="write_story.php" method="POST">
        <div class="form-group">
          <label for="title">Story Title</label>
          <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
          <label for="content">Story Content</label>
          <textarea class="form-control" id="content" name="content" rows="6" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Upload Story</button>
      </form>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <p>&copy; 2024 BookHevan. All rights reserved.</p>
      <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
  </div>
</body>
</html>
