<?php
// Include the database connection file
include('dbconf.php');

// Check if the story ID is provided in the URL
if (isset($_GET['story_id'])) {
    $story_id = $_GET['story_id'];

    // Fetch the story details from the database
    $storyQuery = "SELECT * FROM stories WHERE id = ?";
    $stmt = $conn->prepare($storyQuery);
    $stmt->bind_param("i", $story_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $story = $result->fetch_assoc();

    // Close the database connection
    $stmt->close();

    if (!$story) {
        die("Story not found.");
    }

    $title = $story['title'];
    $content = $story['content'];
    $author_email = $story['author_email'];
    
    // Split content in half for preview
    $half_content = substr($content, 0, floor(strlen($content) / 2));
} else {
    die("Story ID is missing.");
}

// Check if the user is logged in (via cookie or session)
$user_logged_in = isset($_COOKIE['user_email']); // Simplified login check
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Story - BookHevan</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4"><?= htmlspecialchars($title) ?></h1>
        <h3>By <?= htmlspecialchars($author_email) ?></h3>

        <div class="story-content mt-4">
            <h4>Story Preview</h4>
            <p><?= nl2br(htmlspecialchars($half_content)) ?></p>
        </div>

        <?php if ($user_logged_in): ?>
            <div class="payment-prompt mt-4">
                <p>If you're interested in reading the full story, please make a payment to unlock it.</p>
                <a href="payment.php?story_id=<?= $story_id ?>" class="btn btn-primary">Pay Now</a>
            </div>
        <?php else: ?>
            <div class="login-prompt mt-4">
                <p>You need to <a href="login/index.php">log in</a> to unlock the full story.</p>
            </div>
        <?php endif; ?>
    </div>

    <footer class="footer mt-5">
        <p>&copy; 2024 BookHevan. All rights reserved.</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
</body>
</html>
