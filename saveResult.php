<?php
session_start(); // Start the session to access stored data
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'quiz_app');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Database connection failed: ' . $conn->connect_error]));
}

// Check if the username is in the session
if (!isset($_SESSION['user_name'])) {
    die(json_encode(['success' => false, 'error' => 'User not logged in']));
}

$user_name = $_SESSION['user_name']; // Get the username from the session
$data = json_decode(file_get_contents('php://input'), true);

// Check for missing or invalid data
$topic = isset($data['topic']) ? $data['topic'] : null;
$marks = isset($data['marks']) ? $data['marks'] : null;
$percentage = isset($data['percentage']) ? $data['percentage'] : null;
$time_taken = isset($data['time_taken']) ? $data['time_taken'] : null;

if (!$topic || !is_numeric($marks) || !is_numeric($percentage) || !$time_taken) {
    die(json_encode(['success' => false, 'error' => 'Incomplete or invalid data received']));
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO results (user_name, topic, marks, percentage, time_taken) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die(json_encode(['success' => false, 'error' => 'SQL Prepare failed: ' . $conn->error]));
}

$stmt->bind_param("ssidi", $user_name, $topic, $marks, $percentage, $time_taken);
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Result saved successfully.']);
} else {
    echo json_encode(['success' => false, 'error' => 'SQL Execute failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
