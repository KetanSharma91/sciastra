<?php
include('db.php');  // Include database connection

if (isset($_POST['course_id']) && isset($_POST['payment_method']) && isset($_POST['amount'])) {
    $course_id = $_POST['course_id'];
    $payment_method = $_POST['payment_method'];
    $amount = $_POST['amount'];

    // Check if course exists in the courses table
    $stmt = $conn->prepare("SELECT id FROM courses WHERE id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Proceed to insert payment into transactions table
        $stmt = $conn->prepare("INSERT INTO transactions (course_id, payment_method, amount) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $course_id, $payment_method, $amount);
        if ($stmt->execute()) {
            echo 'Payment successfully processed. Thank you for your purchase!';
        } else {
            echo 'Error processing payment.';
        }
        $stmt->close();
    } else {
        echo 'Invalid course ID.';
    }
} else {
    echo 'Required fields are missing.';
}
?>
