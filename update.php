<?php
include "dbconnect.php";

$id = $_POST['id'] ?? '';
$kills = $_POST['kills'] ?? 0;
$deaths = $_POST['deaths'] ?? 0;

if (empty($id)) {
    die("ID is required.");
}

$stmt = $conn->prepare("UPDATE participant SET kills = ?, deaths = ? WHERE id = ?");
$stmt->bind_param("ddi", $kills, $deaths, $id);

if ($stmt->execute()) {
    header("Location: view.php");
    exit();
} else {
    die("Error updating record: " . $stmt->error);
}
?>