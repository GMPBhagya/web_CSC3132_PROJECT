<?php
// Include database connection
include('config.php');

// Fetch books from database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features - BookHevan</title>
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
    <a href="index.html">Home</a>
    <a href="about.html">About Us</a>
    <a href="features.php">Discover Stories</a>
    <a href="#">Write a Story</a>
    <a href="#">Contact</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Features Section -->
    <section class="features-section">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Output data for each book
                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="col-md-6 mb-4">
                        <div class="feature-box">
                            <img src="https://via.placeholder.com/400" alt="Book Cover" class="feature-image">
                            <h3>' . $row["book_name"] . '</h3>
                            <p><strong>Author:</strong> ' . $row["author_name"] . '</p>
                            <p>' . $row["description"] . '</p>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No books found.</p>";
            }
            ?>
        </div>
    </section>
</div>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2024 BookHevan. All rights reserved.</p>
    <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
</footer>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
