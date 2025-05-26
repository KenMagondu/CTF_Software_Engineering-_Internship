
<?php
require_once '../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $judge_id = filter_input(INPUT_POST, 'judge_id', FILTER_VALIDATE_INT);
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    $points = filter_input(INPUT_POST, 'points', FILTER_VALIDATE_INT);

    // Check for invalid or missing inputs
    if ($judge_id === false || $judge_id <= 0 || $user_id === false || $user_id <= 0 || $points === false) {
        header("Location: index.php?error=Invalid judge, user, or points value");
        exit;
    }

    // Validate points range
    if ($points < 1 || $points > 100) {
        header("Location: index.php?error=Points must be between 1 and 100");
        exit;
    }

    // Insert the score using prepared statement
    $insert_sql = "INSERT INTO scores (user_id, judge_id, points) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $insert_sql);
    mysqli_stmt_bind_param($stmt, "iii", $user_id, $judge_id, $points);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        header("Location: index.php?success=Score submitted successfully");
        exit;
    } else {
        $error = mysqli_error($con);
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        header("Location: index.php?error=Failed to submit score: " . urlencode($error));
        exit;
    }
} else {
    header("Location: index.php?error=Invalid request method");
    exit;
}
?>
