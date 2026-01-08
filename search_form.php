<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Portal | UK E-Sports League</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Search Portal</h1>
            <p>Find participants or team records</p>
        </header>

        <div style="margin-bottom: 25px;">
            <h3>Participant Search</h3>
            <form action="search_result.php" method="POST">
                <input type="text" name="firstname_surname" placeholder="Firstname or Surname" required>
                <input type="hidden" name="participant" value="1">
                <button type="submit">Search Participants</button>
            </form>
        </div>

        <hr>

        <div style="margin-top: 25px;">
            <h3>Team Search</h3>
            <form action="search_result.php" method="POST">
                <input type="text" name="team" placeholder="Team Name" required>
                <button type="submit">Search Teams</button>
            </form>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="admin_menu.php">Back to Dashboard</a>
        </div>

        <footer>
            &copy; 2026 UK E-Sports League
        </footer>
    </div>
</body>

</html>