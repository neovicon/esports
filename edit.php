<?php
session_start();
if(!isset($_SESSION['admin'])){header("Location: admin_login.html"); exit();}
include "dbconnect.php";

if (!isset($_GET['id'])) {
    die("ID is required.");
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM participant WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Participant not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stats | UK E-Sports League</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Edit Statistics</h1>
            <p>Updating stats for <strong><?= htmlspecialchars($row['firstname'] . " " . $row['surname']) ?></strong></p>
        </header>

        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-muted);">Kills</label>
            <input type="number" step="0.01" name="kills" value="<?= htmlspecialchars($row['kills'] ?? 0) ?>" required>
            
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-muted);">Deaths</label>
            <input type="number" step="0.01" name="deaths" value="<?= htmlspecialchars($row['deaths'] ?? 0) ?>" required>
            
            <button type="submit">Update Participant</button>
        </form>

        <div style="text-align: center;">
            <a href="view.php">Discard Changes</a>
        </div>

        <footer>
            &copy; 2026 UK E-Sports League
        </footer>
    </div>
</body>
</html>