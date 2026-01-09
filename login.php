<?php
session_start();
include "dbconnect.php";

$u = $_POST['username'] ?? '';
$p = $_POST['password'] ?? '';

if (empty($u) || empty($p)) {
    die("Username and password are required.");
}

$stmt = null;
try {
    // Attempt with 'users' (plural) first
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
} catch (mysqli_sql_exception $e) {
    try {
        // Fallback to 'user' (singular)
        $stmt = $conn->prepare("SELECT password FROM user WHERE username = ?");
    } catch (mysqli_sql_exception $e2) {
        die("Database error: Neither 'users' nor 'user' table found. " . $e2->getMessage());
    }
}

if (!$stmt && !$conn->error) {
    // Some older systems might return false instead of throwing exception
    $stmt = $conn->prepare("SELECT password FROM user WHERE username = ?");
}

if (!$stmt) {
    die("Database error: Could not prepare statement. " . $conn->error);
}

$stmt->bind_param("s", $u);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($db_password);
    $stmt->fetch();

    // Support both plain text and hashed passwords
    if ($p === $db_password || password_verify($p, $db_password)) {
        $_SESSION['admin'] = true;
        header("Location: admin_menu.php");
        exit();
    }
}

// Cleanly handle invalid login
echo "Invalid login. Please check your credentials.";
?>