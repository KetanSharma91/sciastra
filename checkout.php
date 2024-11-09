<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
        <h1>Checkout</h1>
        <?php
        include('backend/db.php');  // Connect to the database

        if (isset($_GET['course_id'])) {
            $course_id = $_GET['course_id'];
            $query = "SELECT * FROM courses WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $course_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $course = $result->fetch_assoc();
                echo '<h2>' . htmlspecialchars($course['title']) . '</h2>';
                echo '<p>' . htmlspecialchars($course['description']) . '</p>';
                echo '<p><strong>Price:</strong> ₹' . htmlspecialchars($course['price']) . '</p>';
        ?>
                <form action="backend/payment.php" method="POST">
                    <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" required>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Debit Card">Debit Card</option>
                        <option value="UPI">UPI</option>
                    </select><br><br>
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" value="<?php echo $course['price']; ?>" readonly><br><br>
                    <button type="submit">Proceed to Payment</button>
                </form>
        <?php
            } else {
                echo '<p>Course not found.</p>';
            }
        } else {
            echo '<p>No course selected.</p>';
        }
        ?>
    </main>

    <footer>
      <p>&copy; 2024 SciAstra</p>
    </footer>

</body>
</html>
