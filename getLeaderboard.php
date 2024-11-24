<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'quiz_app');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => $conn->connect_error]));
}

// Fetch leaderboard data from the database
$query = "SELECT user_name, topic, marks, percentage, time_taken FROM results ORDER BY marks DESC, percentage DESC LIMIT 10";
$result = $conn->query($query);

// Check if results were returned
if ($result->num_rows > 0) {
    $leaderboard = [];
    while ($row = $result->fetch_assoc()) {
        $leaderboard[] = $row;
    }
    echo json_encode(['success' => true, 'leaderboard' => $leaderboard]);
} else {
    echo json_encode(['success' => false, 'message' => 'No leaderboard data available.']);
}

$conn->close();
?>
