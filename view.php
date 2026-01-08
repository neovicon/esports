<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}
include "dbconnect.php";

$r = mysqli_query($conn, "SELECT id, firstname, surname FROM participant");
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
                <div class="result-item" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <strong
                            style="font-size: 1.1rem;"><?= htmlspecialchars($row['firstname'] . " " . $row['surname']) ?></strong>
                    </div>
                    <div>
                        <a href='edit.php?id=<?= $row['id'] ?>' style="margin-right: 15px;">Edit</a>
                        <a href='delete.php?id=<?= $row['id'] ?>' style="color: var(--accent-error);">Delete</a>
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