<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="course.php">Courses</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Available Courses</h1>
        <div class="course-list">
            <?php
            include('backend/db.php');  // Connect to the database

            $query = "SELECT * FROM courses";  // Select all courses
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="course-item">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                    echo '<p><strong>Price:</strong> ₹' . htmlspecialchars($row['price']) . '</p>';
                    echo '<a href="checkout.php?course_id=' . $row['id'] . '" class="btn">Buy Now</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>No courses available.</p>';
            }
            ?>
        </div>
    </main>

    <footer>
      <p>&copy; 2024 SciAstra</p>
    </footer>

</body>
</html>
