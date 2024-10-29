<?php

include("../connections/dbh.php");
include("../connections/errorHandling.php");
include("../connections/query.class.php");

try {
    $db = new Dbh("localhost", "root", "Mysqlworkbench14", "clubfiler");
    $conn = $db->connect(); // Connect to the database
} catch (Exception $e) {
    ErrorHandler::handleError("Database connection failed: " . $e->getMessage());
}

$errorMessages = []; // Initialize an array for error messages

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create-college"])) {
    // Sanitize and validate the input
    $college_name = htmlspecialchars(trim($_POST["create-college"]));

    $college_name = strtoupper($college_name);

    if (empty($college_name)) {
        $errorMessages[] = "Field must have input.";
    } else {
        // Check if the college already exists in the database
        $stmt = $conn->prepare("SELECT * FROM colleges WHERE college_name = ?");
        $stmt->bind_param("s", $college_name);
        $stmt->execute();
        $result = $stmt->get_result();

        // Debug output to check the query result
        if ($result->num_rows > 0) {
            $errorMessages[] = "College already exists."; // This should trigger if a college is found
        }

        if (!empty($errorMessages)) {
            ErrorHandler::handleError(implode(" ", $errorMessages));
        }

        try {
            $message = College::create($conn, $college_name);
            // Display success message and login link
            echo "New College Added. ";
            echo '<a href="../dashboards/dashboard.superadmin.php" class="logout-button">Go Back</a>';
            exit;
        } catch (Exception $e) {
            ErrorHandler::handleError("Registration failed: " . $e->getMessage());
        }
        $stmt->close();
    }
}