<?php
// Include the database connection file
include('dbconf.php');

// Fetch stories from the database
$storyQuery = "SELECT * FROM writers_stories ORDER BY date_uploaded DESC";
$storyResult = $conn->query($storyQuery);

$stories = [];
if ($storyResult->num_rows > 0) {
    while ($row = $storyResult->fetch_assoc()) {
        $stories[] = $row; // Store story data in an array
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookHevan: Discover Stories</title>
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

    /* Hero Section with Background Image */
    .hero {
      background: url('https://img.freepik.com/free-vector/watercolor-background-world-book-day-celebration_23-2150230426.jpg?t=st=1733078946~exp=1733082546~hmac=050e9832108d0c9c786e4d66a95b5b026c8a6c95f104ed5b2ada62e0da340ebc&w=740') no-repeat center center;
      background-size: cover;
      color: #FFF;
      padding: 80px 20px;
      text-align: center;
      border-radius: 8px;
    }

    .hero h1 {
      font-size: 2.8rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: #5b2c6f;
    }

    .hero p {
      font-size: 1.2rem;
      margin-bottom: 30px;
      color: #5b2c6f;
    }

    .btn-hero {
      background-color: #34495E;
      color: #FFF;
      padding: 10px 20px;
      border-radius: 5px;
      text-transform: uppercase;
    }

    .btn-hero:hover {
      background-color: #2C3E50;
    }

    /* Story List Section */
    .story-list {
      margin-top: 40px;
    }

    .story-item {
      background-color: #F8F8F8;
      padding: 20px;
      margin-bottom: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .story-item:hover {
      transform: scale(1.05);
    }

    .story-item h3 {
      font-size: 1.8rem;
      color: #2C3E50;
      font-weight: bold;
    }

    .story-item p {
      color: #666;
      font-size: 1.1rem;
    }

    .story-item .author {
      font-weight: bold;
      color: #F8B400;
      font-size: 1rem;
    }

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

    <!-- Hero Section -->
    <section class="hero">
      <h1>Discover Engaging Stories</h1>
      <p>Browse through stories written by our talented authors and dive into new adventures.</p>
      <a href="write_story.php" class="btn-hero">Start Writing</a>
    </section>

    <!-- Story List Section -->
    <section class="story-list">
      <?php if (count($stories) > 0): ?>
        <?php foreach ($stories as $story): ?>
          <div class="story-item">
            <h3><?php echo htmlspecialchars($story['title']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars(substr($story['content'], 0, 300))) . '...'; ?></p>
            <p class="author">By: <?php echo htmlspecialchars($story['author_email']); ?></p>
            <a href="view_story.php?id=<?php echo $story['id']; ?>" class="btn btn-primary">Read Full Story</a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No stories available at the moment. Please check back later!</p>
      <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <p>&copy; 2024 BookHevan. All rights reserved.</p>
      <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

  </div>

</body>
</html>
