
<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/connect.php';
if (!$con) {
    die("Database connection failed. Check logs or contact admin.");
}
require_once '../includes/header.php';
?>
<h1>Public Scoreboard</h1>
<?php
// Query to get total points per user
$result = mysqli_query($con, "SELECT u.username, COALESCE(SUM(s.points), 0) as total_points
                             FROM users u
                             LEFT JOIN scores s ON u.id = s.user_id
                             GROUP BY u.id, u.username
                             ORDER BY total_points DESC");
if (!$result) {
    echo "<p style='color: red'>Error loading scoreboard: " . mysqli_error($con) . "</p>";
} else {
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (empty($users)) {
        echo "<p>No users or scores available.</p>";
    } else {
        echo "<table border='1' style='width: 50%; margin-bottom: 20px;'>";
        echo "<tr><th>Username</th><th>Total Points</th></tr>";
        foreach ($users as $index => $user) {
            $highlight = ($index < 3) ? "style='background-color: #90EE90;'" : ""; // Highlight top 3 with light green
            echo "<tr " . $highlight . ">";
            echo "<td>" . htmlspecialchars($user['username']) . "</td>";
            echo "<td>" . htmlspecialchars($user['total_points']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>
<!-- Auto-refresh every 30 seconds to simulate dynamic updates -->
<meta http-equiv="refresh" content="30">
<?php
mysqli_close($con);
require_once '../includes/footer.php';
?>