<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out | UK E-Sports League</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Logged Out</h1>
            <p>You have been safely disconnected from the portal.</p>
        </header>

        <nav>
            <a href="index.html" class="nav-link">Return to Home</a>
            <a href="admin_login.html" class="nav-link">Log In Again</a>
        </nav>

        <footer>
            &copy; 2026 UK E-Sports League
        </footer>
    </div>
</body>

</html>