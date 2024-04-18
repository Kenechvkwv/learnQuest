<?php
// Start the session
session_start();

// Include dbconn.php file for database connection
include 'dbconn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Prepare SQL statement to retrieve user information based on email
    $sql = "SELECT * FROM fidelitytable WHERE email = '$email'";
    $result = mysqli_query($db, $sql);

    // Check if user with provided email exists
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variable
            $_SESSION['email'] = $email;
            // Close database connection
            mysqli_close($db);
            // Return success response
            echo json_encode(array("status" => "success", "message" => "Login successful"));
            exit;
        }
    }

    // Close database connection
    mysqli_close($db);
    // Return error response if login fails
    echo json_encode(array("status" => "error", "message" => "Invalid email or password"));
} else {
    // Return error response if form is not submitted
    echo json_encode(array("status" => "error", "message" => "Form submission error!"));
}
