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
    body {
      font-family: 'Arial', sans-serif;
      background-color: #F7F8FC;
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

    /* Main Content Styling */
    .main-content {
      margin-left: 250px;
      padding: 40px 20px;
    }

    /* Page Header */
    .page-header {
      background: linear-gradient(135deg, #FF6F61, #FF9F9F);
      color: #FFF;
      padding: 60px 20px;
      text-align: center;
      border-radius: 8px;
      margin-bottom: 40px;
    }

    .page-header h1 {
      font-size: 2.8rem;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .page-header p {
      font-size: 1.2rem;
      color: #FFF;
    }

    /* Form Section */
    .form-section {
      background-color: #FFFFFF;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-section h2 {
      color: #2C3E50;
      font-weight: bold;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-control {
      border-radius: 5px;
      border: 1px solid #D5D8DC;
    }

    .btn-primary {
      background-color: #FF6F61;
      border: none;
      color: #FFF;
      padding: 12px 20px;
      border-radius: 5px;
      text-transform: uppercase;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #E04E3F;
    }

    /* Footer Section */
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

    /* Images Styling */
    .image-banner {
      width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    /* Animation Effects */
    .form-group input:focus, .form-group textarea:focus {
      border-color: #FF6F61;
      box-shadow: 0 0 10px rgba(255, 111, 97, 0.5);
    }
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
    <!-- Page Header -->
    <section class="page-header">
      <h1>Write & Share Your Story</h1>
      <p>Bring your creativity to life! Upload your story and connect with readers.</p>
    </section>

    <!-- Form Section -->
    <section class="form-section">
      <h2>Upload Your Story</h2>
      <?php if (isset($message)) { echo "<div class='alert alert-success'>$message</div>"; } ?>

      <form action="write_story.php" method="POST">
        <div class="form-group">
          <label for="title">Story Title</label>
          <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
          <label for="content">Story Content</label>
          <textarea class="form-control" id="content" name="content" rows="6" required></textarea>
        </div>
        <button type="submit" class="btn-primary">Upload Story</button>
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
