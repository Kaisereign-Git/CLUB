<?php
session_start();

// Include the database connection class
include("../connections/dbh.php");
include("../connections/errorHandling.php");

// Create a database connection
try {
    $db = new Dbh("localhost", "root", "Mysqlworkbench14", "clubfiler");
    $conn = $db->connect();
} catch (Exception $e) {
    ErrorHandler::handleError("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = trim($_POST["student-id"]);
    $password = trim($_POST["password"]);

    // Validate form fields
    if (empty($student_id) || empty($password)) {
        ErrorHandler::handleError("Student ID and password are required.");
    } else {
        // Check if the student ID is in the user table
        $stmt = $conn->prepare("SELECT * FROM user WHERE student_id = ?");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Check in the super admin table
            $stmt = $conn->prepare("SELECT * FROM superadmins WHERE student_id = ?");
            $stmt->bind_param("s", $student_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                ErrorHandler::handleError("No user found with that Student ID."); // Student ID not found
            } else {
                // Fetch the super admin data
                $superAdmin = $result->fetch_assoc();
                if (!password_verify($password, $superAdmin['password'])) {
                    ErrorHandler::handleError("Incorrect password."); // Password mismatch
                } else {
                    // Successful login for super admin; set session variables
                    $_SESSION['user_id'] = $superAdmin['student_id'];
                    $_SESSION['username'] = $superAdmin['username'];
                    $_SESSION['is_super_admin'] = true; // Set session variable for super admin

                    // Redirect to the homepage
                    header("Location: ../src/homepage.php");
                    exit;
                }
            }
        } else {
            // Fetch the user data
            $user = $result->fetch_assoc();

            // Verify the password
            if (!password_verify($password, $user['password'])) {
                ErrorHandler::handleError("Incorrect password."); // Password mismatch
            } else {
                // Successful login for regular user; set session variables
                $_SESSION['user_id'] = $user['student_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_super_admin'] = false; // Set session variable for regular user

                // Redirect to the homepage
                header("Location: ../src/homepage.php");
                exit;
            }
        }
    }
}
$conn->close();
