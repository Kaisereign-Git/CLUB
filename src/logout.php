<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page or homepage after logout
header("Location: ../src/login.php"); // Change this to your desired redirect location
exit;