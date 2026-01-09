<?php
include "dbconnect.php";

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$terms = isset($_POST['terms']) ? 1 : 0;

if (empty($name) || empty($email) || $terms === 0) {
    die("All fields and terms acceptance are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// Simple split for firstname/surname
$parts = explode(' ', $name, 2);
$firstname = $parts[0];
$surname = $parts[1] ?? '';

$stmt = $conn->prepare("INSERT INTO merchandise (firstname, surname, email, terms) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $firstname, $surname, $email, $terms);

if ($stmt->execute()) {
    header("Location: index.html?success=registered");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>