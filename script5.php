<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Start the session to access stored data
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'quiz_app');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Database connection failed: ' . $conn->connect_error]));
}

// Query the database for results
$query = "SELECT topic, marks FROM results"; // Assuming 'label' and 'marks' columns exist
$res = $conn->query($query);

// Check if there are any results
if ($res->num_rows > 0) {
    $test = array();  // Initialize an empty array to hold the results

    // Fetch the data
    $count = 0;
    while ($row = $res->fetch_assoc()) {
        $test[$count]["topic"] = $row["topic"];
        $test[$count]["y"] = $row["marks"];
        $count++;
    }

    // Return the data as a JSON response
    echo json_encode($test);
} else {
    echo json_encode(['success' => false, 'error' => 'No data found']);
}

$conn->close();
?>