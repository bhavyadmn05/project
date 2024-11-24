<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if the user is not logged in
    header("Location: login.php");
    exit();
}

// Display the user's name on the dashboard
echo "Welcome, " . $_SESSION['user_name'];
?>
