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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $college = htmlspecialchars(trim($_POST["create-college"]));

    if (empty($college)) {
        ErrorHandler::handleError("Field Must Have Input");
    } else {

        $stmt = $conn->prepare("SELECT * FROM colleges WHERE college_name = ?");
        $stmt->bind_param("s", $college);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    try {
        $message = College::create($conn, $college);
        // Display success message and login link
        echo "New College Added. ";
        echo '<a href="../homepages/homepage.superadmin.php" class="logout-button">Refresh</a>';
        exit;
    } catch (Exception $e) {
        ErrorHandler::handleError("Registration failed: " . $e->getMessage());
    }
}

