<?php
// Include the database connection file
include('dbconf.php');

// Check if the story ID is provided
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
} else {
    die("Story ID is missing.");
}

// Here, you would typically process the payment, for example, using PayPal, Stripe, etc.
// For simplicity, we will assume payment is successful after clicking the button

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming payment is successful
    $payment_successful = true; // In a real-world scenario, you would verify payment here

    if ($payment_successful) {
        // Allow the user to read the full story (store in session or database)
        setcookie('paid_for_story_' . $story_id, 'true', time() + 3600, '/'); // Cookie to track payment
        header("Location: read_story.php?story_id=" . $story_id); // Redirect to read the full story
        exit;
    } else {
        $message = "Payment failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - BookHevan</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4"><?= htmlspecialchars($title) ?></h1>
        <h3>Payment for Full Story</h3>

        <?php if (isset($message)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="POST">
            <p>To access the full story, please make a payment of $5.00.</p>
            <!-- Payment gateway integration would go here (e.g., PayPal, Stripe) -->
            <button type="submit" class="btn btn-success">Pay Now</button>
        </form>
    </div>

    <footer class="footer mt-5">
        <p>&copy; 2024 BookHevan. All rights reserved.</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
</body>
</html>
