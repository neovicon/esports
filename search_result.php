<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}
include 'dbconnect.php';

function calculateKD($kills, $deaths)
{
    if ($deaths == 0)
        return $kills > 0 ? $kills : 0;
    return round($kills / $deaths, 2);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results | UK E-Sports League</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container wide-container">
        <header>
            <h1>Search Results</h1>
        </header>

        <div style="margin-bottom: 20px; text-align: center;">
            <a href="search_form.php">Back to Search</a>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['participant']) && $_POST['participant'] == "1") {
                $search = $_POST['firstname_surname'] ?? '';
                $param = "%$search%";

                $stmt = $conn->prepare("SELECT p.*, t.name as team_name 
                                      FROM participant p 
                                      LEFT JOIN team t ON p.team_id = t.id 
                                      WHERE p.firstname LIKE ? OR p.surname LIKE ? OR p.email LIKE ?");
                $stmt->bind_param("sss", $param, $param, $param);
                $stmt->execute();
                $result = $stmt->get_result();

                echo "<h2>Participant Results</h2>";
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $kd = calculateKD($row['kills'], $row['deaths']);
                        echo "<div class='result-item'>";
                        echo "<h3>" . htmlspecialchars($row['firstname'] . " " . $row['surname']) . "</h3>";
                        echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
                        echo "<p>Kills: <span style='color:var(--accent-success)'>" . htmlspecialchars($row['kills']) . "</span> | Deaths: <span style='color:var(--accent-error)'>" . htmlspecialchars($row['deaths']) . "</span></p>";
                        echo "<p><strong>K/D Ratio: <span style='color:var(--accent-primary)'>$kd</span></strong></p>";
                        echo "<p>Team: " . htmlspecialchars($row['team_name'] ?? 'None') . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No participants found matching '$search'.</p>";
                }
            } elseif (isset($_POST['team'])) {
                $search = $_POST['team'] ?? '';
                $param = "%$search%";

                $stmt = $conn->prepare("SELECT * FROM team WHERE name LIKE ?");
                $stmt->bind_param("s", $param);
                $stmt->execute();
                $teams = $stmt->get_result();

                echo "<h2>Team Results</h2>";
                if ($teams->num_rows > 0) {
                    while ($team = $teams->fetch_assoc()) {
                        echo "<div class='result-item' style='border-left-color: var(--accent-secondary)'>";
                        echo "<h3>" . htmlspecialchars($team['name']) . "</h3>";
                        echo "<p>Location: " . htmlspecialchars($team['location']) . "</p>";

                        $stmt2 = $conn->prepare("SELECT * FROM participant WHERE team_id = ?");
                        $stmt2->bind_param("i", $team['id']);
                        $stmt2->execute();
                        $members = $stmt2->get_result();

                        if ($members->num_rows > 0) {
                            echo "<div style='background: rgba(0,0,0,0.2); padding: 15px; border-radius: 10px; margin-top: 10px;'>";
                            echo "<strong>Roster & Performance:</strong><br>";
                            $totalKills = 0;
                            $totalDeaths = 0;
                            while ($member = $members->fetch_assoc()) {
                                $mkd = calculateKD($member['kills'], $member['deaths']);
                                echo "- " . htmlspecialchars($member['firstname'] . " " . $member['surname']) . " (K: " . htmlspecialchars($member['kills']) . ", D: " . htmlspecialchars($member['deaths']) . ", <strong>K/D: $mkd</strong>)<br>";
                                $totalKills += $member['kills'];
                                $totalDeaths += $member['deaths'];
                            }
                            $teamKD = calculateKD($totalKills, $totalDeaths);
                            echo "<div style='margin-top:10px; padding-top:10px; border-top: 1px solid var(--glass-border);'>";
                            echo "<strong>Total Kills: <span style='color:var(--accent-success)'>$totalKills</span></strong> | ";
                            echo "<strong>Total Deaths: <span style='color:var(--accent-error)'>$totalDeaths</span></strong><br>";
                            echo "<strong>Team K/D Ratio: <span style='color:var(--accent-primary)'>$teamKD</span></strong>";
                            echo "</div></div>";
                        } else {
                            echo "<p>No members in this team.</p>";
                        }
                        echo "</div>";
                    }
                } else {
                    echo "<p>No teams found matching '$search'.</p>";
                }
            }
        }
        ?>

        <footer>
            &copy; 2026 UK E-Sports League
        </footer>
    </div>
</body>

</html>