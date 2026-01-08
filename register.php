<?php
include "dbconnect.php";

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';

if (empty($name) || empty($email) || empty($address)) {
    die("All fields required");
}

// Simple split for firstname/surname
$parts = explode(' ', $name, 2);
$firstname = $parts[0];
$surname = $parts[1] ?? '';

$stmt = $conn->prepare("INSERT INTO merchandise (firstname, surname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $surname, $email);

if ($stmt->execute()) {
    header("Location: register_form.html");
} else {
    echo "Error: " . $stmt->error;
}
?>