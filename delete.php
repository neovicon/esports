<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}
include "dbconnect.php";

if (!isset($_GET['id'])) {
    die("ID is required.");
}

$id = $_GET['id'];

if (isset($_GET['confirm'])) {
    $stmt = $conn->prepare("DELETE FROM participant WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: view.php");
        exit();
    } else {
        die("Error deleting record: " . $stmt->error);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete | UK E-Sports League</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container" style="border-color: var(--accent-error);">
        <header>
            <h1
                style="background: var(--accent-error); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Confirm Action</h1>
            <p>Are you sure you want to permanently delete this participant record?</p>
        </header>

        <div style="display: flex; gap: 15px; margin-top: 20px;">
            <a href="delete.php?id=<?= htmlspecialchars($id) ?>&confirm=1" class="nav-link"
                style="flex: 1; border-color: var(--accent-error); color: var(--accent-error); font-weight: bold;">
                YES, DELETE
            </a>
            <a href="view.php" class="nav-link" style="flex: 1;">
                NO, CANCEL
            </a>
        </div>

        <footer>
            &copy; 2026 UK E-Sports League
        </footer>
    </div>
</body>

</html>