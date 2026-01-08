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
    <title>Admin Dashboard | UK E-Sports League</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
            <p>Welcome, Administrator</p>
        </header>

        <nav>
            <ul>
                <li>
                    <a href="view.php" class="nav-link">
                        <strong>Manage Participants</strong><br>
                        <small>View, Edit, or Delete members</small>
                    </a>
                </li>
                <li>
                    <a href="search_form.php" class="nav-link">
                        <strong>Search Portal</strong><br>
                        <small>Find participants or teams</small>
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="nav-link"
                        style="border-color: var(--accent-error); color: var(--accent-error);">
                        <strong>Logout</strong>
                    </a>
                </li>
            </ul>
        </nav>

        <footer>
            &copy; 2026 UK E-Sports League
        </footer>
    </div>
</body>

</html>