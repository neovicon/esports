<?php
session_start();
include "dbconnect.php";

$u = $_POST['username'] ?? '';
$p = $_POST['password'] ?? '';

if (empty($u) || empty($p)) {
    die("Username and password are required.");
}

$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $u);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if ($p === $row['password']) {
        $_SESSION['admin'] = true;
        header("Location: admin_menu.php");
        exit();
    }
}

echo "Invalid login";
?>