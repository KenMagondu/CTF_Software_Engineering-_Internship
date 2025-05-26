
<?php
require_once '../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $username = trim($_POST['username']);
    $display_name = trim($_POST['display_name']);

    // Check for empty fields
    if (empty($username) || empty($display_name)) {
        header("Location: index.php?error=All fields are required");
        exit;
    }

    // Validate lengths based on schema
    if (strlen($username) > 50) {
        header("Location: index.php?error=Username must be 50 characters or less");
        exit;
    }
    if (strlen($display_name) > 100) {
        header("Location: index.php?error=Display name must be 100 characters or less");
        exit;
    }

    // Check for duplicate username
    $check_sql = "SELECT id FROM judges WHERE username = ?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    if ($result->num_rows > 0) {
        $check_stmt->close();
        $conn->close();
        header("Location: index.php?error=Username already exists");
        exit;
    }
    $check_stmt->close();

    // Insert the new judge
    $insert_sql = "INSERT INTO judges (username, display_name) VALUES (?, ?)";
    $stmt = $con->prepare($insert_sql);
    $stmt->bind_param("ss", $username, $display_name);

    if ($stmt->execute()) {
        $stmt->close();
        $con->close();
        header("Location: index.php?success=Judge added successfully");
        exit;
    } else {
        $error = $conn->error;
        $stmt->close();
        $con->close();
        header("Location: index.php?error=Failed to add judge: " . urlencode($error));
        exit;
    }
} else {
    header("Location: index.php?error=Invalid request method");
    exit;
}
?>
