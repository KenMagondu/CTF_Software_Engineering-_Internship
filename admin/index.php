
<?php
require_once '../config/connect.php';
require_once '../includes/header.php';
?>
<h1>Admin Panel: Manage Judges</h1>
<?php
// Display success or error messages
if (isset($_GET['success'])) {
    echo "<p style='color: green'>" . htmlspecialchars($_GET['success']) . "</p>";
}
if (isset($_GET['error'])) {
    echo "<p style='color: red'>" . htmlspecialchars($_GET['error']) . "</p>";
}
?>
<!-- Form to add a new judge -->
<form action="add_judge.php" method="post" id="add-judge-form">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" maxlength="50" required>
    <label for="display_name">Display Name:</label>
    <input type="text" id="display_name" name="display_name" maxlength="100" required>
    <button type="submit">Add Judge</button>
</form>
<!-- Display existing judges -->
<h2>Existing Judges</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Display Name</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $con->query("SELECT * FROM judges");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['display_name']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No judges found.</td></tr>";
        }
        $con->close();
        ?>
    </tbody>
</table>
<?php 
//require_once '../includes/footer.php'; 
?>
