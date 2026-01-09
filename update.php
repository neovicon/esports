<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}
include "dbconnect.php";

$id = $_POST['id'] ?? '';
$kills = $_POST['kills'] ?? 0;
$deaths = $_POST['deaths'] ?? 0;

if (empty($id)) {
    die("ID is required.");
}

// Convert to numbers and ensure non-negative
$kills = max(0, (float) $kills);
$deaths = max(0, (float) $deaths);

$stmt = $conn->prepare("UPDATE participant SET kills = ?, deaths = ? WHERE id = ?");
$stmt->bind_param("ddi", $kills, $deaths, $id);

if ($stmt->execute()) {
    header("Location: view.php?success=updated");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>