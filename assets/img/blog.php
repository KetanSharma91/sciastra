<?php
session_start();

// Check if user is admin
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    echo "Unauthorized access";
    exit();
}

include('db.php');

// Prepare and insert new blog post if admin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Insert blog post into the database
    $stmt = $conn->prepare("INSERT INTO blogs (title, content, publish_time) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        echo "Blog post added successfully.";
    } else {
        echo "Error adding blog post: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: ../blog.html");  // Redirect back to blog page
    exit();
}
?>
