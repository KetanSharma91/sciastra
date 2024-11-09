<?php
session_start();

// Hardcoded admin credentials
$adminUsername = 'admin';
$adminPassword = 'password123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['isAdmin'] = true;
        header("Location: ../blog.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid credentials.";
        header("Location: ../login.php");
        exit();
    }
}
?>

