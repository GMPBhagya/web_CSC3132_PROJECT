<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookHevan: Discover, Write & Monetize Stories</title>
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

    /* Features Section */
    .features-section {
      margin-top: 40px;
      background-color: #F0F8FF;
      padding: 40px;
      border-radius: 8px;
    }

    .feature-box {
      background-color: #F3F3F3;
      padding: 30px;
      border-radius: 8px;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .feature-box:hover {
      transform: scale(1.05);
    }

    .feature-box h3 {
      color: #2C3E50;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .feature-box p {
      color: #666;
      font-size: 1rem;
    }

    .feature-image {
      width: 100%;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    /* Testimonials Section */
    .testimonials {
      background: linear-gradient(135deg, #3498DB, #8E44AD);
      color: #FFF;
      padding: 40px 20px;
      margin-top: 40px;
      border-radius: 8px;
    }

    .testimonial {
      font-style: italic;
      color: #F8B400;
    }

    .testimonial-author {
      margin-top: 10px;
      font-weight: bold;
      color: #FFF;
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

    <!-- Hero Section -->
    <section class="hero">
      <h1>Welcome to BookHevan</h1>
      <p>Engage with immersive stories, connect with authors, and explore a world of creativity.</p>
      <a href="#" class="btn-hero">Start Exploring</a>
    </section>

    <!-- Features Section -->
    <section class="features-section">
      <div class="row">
        <!-- Feature for Readers -->
        <div class="col-md-6 mb-4">
          <div class="feature-box">
            <img src="https://www.bookclubbabble.com/wp-content/uploads/2022/04/free-ebook-image.jpg" alt="For Readers" class="feature-image">
            <h3>For Readers</h3>
            <p>Read serialized stories, comment on chapters, and support your favorite authors. The first part of every story is free!</p>
            <a href="discover.php" class="btn btn-primary">Start Reading</a> <!-- Add link here -->
            </div>
        </div>
        <!-- Feature for Writers -->
        <div class="col-md-6 mb-4">
  <div class="feature-box">
    <img src="https://xnote.ai/cdn/shop/files/MG_7799.jpg?v=1725665666&width=1920" alt="For Writers" class="feature-image">
    <h3>For Writers</h3>
    <p>Upload your stories, engage with readers, and monetize your content with paid story parts.</p>
    <a href="write_story.php" class="btn btn-primary">Start Writing</a> <!-- Add link here -->
  </div>
</div>

      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
      <h2 class="text-center">What Our Users Say</h2>
      <div class="row mt-4">
        <div class="col-md-4 text-center">
          <p class="testimonial">"BookHevan has revolutionized my reading experience. I can engage directly with authors!"</p>
          <p class="testimonial-author">- Alex, Reader</p>
        </div>
        <div class="col-md-4 text-center">
          <p class="testimonial">"I've found a supportive community and now earn from my stories. BookHevan is amazing!"</p>
          <p class="testimonial-author">- Emma, Writer</p>
        </div>
        <div class="col-md-4 text-center">
          <p class="testimonial">"Great platform for both reading and writing! The free sample part draws me in every time."</p>
          <p class="testimonial-author">- Leo, Reader</p>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <p>&copy; 2024 BookHevan. All rights reserved.</p>
      <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

  </div>

</body>
</html>