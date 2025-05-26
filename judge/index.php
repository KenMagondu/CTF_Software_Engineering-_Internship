
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/connect.php';
if (!$con) {
    die("Database connection failed. Check logs or contact admin.");
}
require_once '../includes/header.php';
?>
<h1>Judge Portal: Assign Scores</h1>
<?php
if (isset($_GET['success'])) {
    echo "<p style='color: green'>" . htmlspecialchars($_GET['success']) . "</p>";
}
if (isset($_GET['error'])) {
    echo "<p style='color: red'>" . htmlspecialchars($_GET['error']) . "</p>";
}
?>

<h2>All Users</h2>
<ul>
    <?php
    $users_list_result = mysqli_query($con, "SELECT username FROM users ORDER BY username ASC");
    if (!$users_list_result) {
        echo "<li>Error loading users: " . mysqli_error($con) . "</li>";
    } elseif (mysqli_num_rows($users_list_result) == 0) {
        echo "<li>No users available</li>";
    } else {
        while ($user = mysqli_fetch_assoc($users_list_result)) {
            echo "<li>" . htmlspecialchars($user['username']) . "</li>";
        }
    }
    ?>
</ul>

<form action="submit_score.php" method="post" id="submit-score-form">
    <label for="judge_id">Select Judge:</label>
    <select name="judge_id" id="judge_id" required>
        <option value="">Select a Judge</option>
        <?php
        $judges_result = mysqli_query($con, "SELECT * FROM judges ORDER BY display_name ASC");
        if (!$judges_result) {
            echo "<option value=''>Error loading judges: " . mysqli_error($con) . "</option>";
        } elseif (mysqli_num_rows($judges_result) == 0) {
            echo "<option value=''>No judges available</option>";
        } else {
            while ($judge = mysqli_fetch_assoc($judges_result)) {
                echo "<option value='" . htmlspecialchars($judge['id']) . "'>" . htmlspecialchars($judge['display_name']) . "</option>";
            }
        }
        ?>
    </select>
    <label for="user_id">Select User:</label>
    <select name="user_id" id="user_id" required>
        <option value="">Select a User</option>
        <?php
        $users_result = mysqli_query($con, "SELECT * FROM users ORDER BY username ASC");
        if (!$users_result) {
            echo "<option value=''>Error loading users: " . mysqli_error($con) . "</option>";
        } elseif (mysqli_num_rows($users_result) == 0) {
            echo "<option value=''>No users available</option>";
        } else {
            while ($user = mysqli_fetch_assoc($users_result)) {
                echo "<option value='" . htmlspecialchars($user['id']) . "'>" . htmlspecialchars($user['username']) . "</option>";
            }
        }
        ?>
    </select>
    <label for="points">Points (1-100):</label>
    <input type="number" id="points" name="points" min="1" max="100" required>
    <button type="submit">Submit Score</button>
</form>
<?php
mysqli_close($con);
require_once '../includes/footer.php';
?>
