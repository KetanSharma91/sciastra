<?php
session_start();
include 'backend/db.php';

// Check if the user is admin
$isAdmin = isset($_SESSION['username']) && $_SESSION['username'] === 'admin';

// Handle blog submission (admin only)
if ($isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $query = "INSERT INTO blogs (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    $stmt->close();
}

// Handle blog deletion (admin only)
if ($isAdmin && isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $query = "DELETE FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: blog.php");
    exit();
}

// Fetch all blog posts
$query = "SELECT id, title, content FROM blogs ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="assets/css/blog.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <ul>
    <li><a href="index.html">Home</a></li>
    <li><a href="course.php">Courses</a></li>
            <li><a href="blog.php">Blog</a></li>
    <?php if ($isAdmin): ?>
        <!-- <a href="blog.php">Blog</a> -->
        <a href="logout.php" class='logout-btn'>Logout</a>
    <?php else: ?>
        <li><a href="login.php">Login</a></li>
    <?php endif; ?>
    </ul>
</nav>

<!-- Display Add Blog form only for admin -->
<?php if ($isAdmin): ?>
    <form action="blog.php" method="POST" class="blog-form">
        <h2>Add Blog</h2>
        <input type="text" name="title" placeholder="Blog Title" required>
        <textarea name="content" placeholder="Blog Content" required></textarea>
        <button type="submit">Add Blog</button>
    </form>
<?php endif; ?>

<div class="blog-list">
    <h1>Blogs</h1>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="blog-post">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                
                <!-- Show Delete button for admin only -->
                <?php if ($isAdmin): ?>
                    <a href="blog.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this blog?');" class="delete-btn">Delete</a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No blogs available.</p>
    <?php endif; ?>
</div>

<footer>
      <p>&copy; 2024 SciAstra</p>
    </footer>

</body>
</html>


