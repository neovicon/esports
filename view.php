<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}
include "dbconnect.php";

$r = mysqli_query($conn, "SELECT p.id, p.firstname, p.surname, p.email, p.team_id, t.name as team_name 
                          FROM participant p 
                          LEFT JOIN team t ON p.team_id = t.id");
if (!$r) {
    die("Error fetching participants: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Participants | UK E-Sports League</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container wide-container">
        <header>
            <h1>Manage Participants</h1>
            <p>List of all registered league participants</p>
        </header>

        <div style="margin-bottom: 20px; text-align: center;">
            <a href="admin_menu.php">Back to Dashboard</a>
        </div>

        <div class="participant-list">
            <?php while ($row = mysqli_fetch_assoc($r)): ?>
                <div class="result-item"
                    style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
                    <div style="flex: 1;">
                        <strong
                            style="font-size: 1.2rem; color: var(--accent-primary); display: block; margin-bottom: 5px;">
                            <?= htmlspecialchars($row['firstname'] . " " . $row['surname']) ?>
                        </strong>
                        <div style="font-size: 0.9rem; color: var(--text-muted);">
                            <span style="display: block; margin-bottom: 4px;">📧
                                <?= htmlspecialchars($row['email']) ?></span>
                            <span>🎮 Team: <?= htmlspecialchars($row['team_name'] ?? 'Free Agent') ?>
                                <small>(ID: <?= htmlspecialchars($row['team_id'] ?? 'N/A') ?>)</small>
                            </span>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px; padding-top: 5px;">
                        <a href='edit.php?id=<?= $row['id'] ?>' class="nav-link"
                            style="padding: 8px 15px; margin-bottom: 0;">Edit</a>
                        <a href='delete.php?id=<?= $row['id'] ?>' class="nav-link"
                            style="padding: 8px 15px; margin-bottom: 0; border-color: var(--accent-error); color: var(--accent-error);">Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <footer>
            &copy; 2026 UK E-Sports League
        </footer>
    </div>
</body>

</html>