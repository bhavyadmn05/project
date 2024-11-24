<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Update if needed
$dbname = "booked_session";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $state = $_POST['state'];
    $preferred_date = $_POST['date'];
    $mode = $_POST['mode'];

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM sessions WHERE email = ?";
    $checkStmt = $conn->prepare($checkEmailQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>
                alert('Your session has already been booked with this email.');
                window.location.href = 'index3.html'; // Redirect to home page
              </script>";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO sessions (name, email, state, preferred_date, mode) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $state, $preferred_date, $mode);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Congratulations! Your session has been successfully booked. We will reach out to you soon.');
                    window.location.href = 'index3.html'; // Redirect to home page
                  </script>";
        } else {
            echo "<script>
                    alert('There was an error booking your session. Please try again.');
                  </script>";
        }
        $stmt->close();
    }
    $checkStmt->close();
}

$conn->close();
?>