<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../src/login.php");
    exit;
}

// Include the error handling and database connection files
include("../connections/dbh.php");
include("../connections/errorHandling.php");

try {
    $db = new Dbh("localhost", "root", "Mysqlworkbench14", "clubfiler");
    $conn = $db->connect(); // Connect to the database
} catch (Exception $e) {
    ErrorHandler::handleError("Database connection failed: " . $e->getMessage());
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT Student_ID, Username, Password FROM superadmins WHERE Student_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$superadmin = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_student_id = $_POST['Student_ID'];
    $new_username = $_POST['Username'];
    $new_password = !empty($_POST['Password']) ? password_hash($_POST['Password'], PASSWORD_DEFAULT) : $superadmin['Password']; // If no new password, keep the old one

    // Validate Student ID format (e.g., numeric and 8 characters long)
    if (!preg_match("/^\d{8}$/", $new_student_id)) {
        ErrorHandler::handleError("Invalid Student-ID format.");
    }

    // Check if the new student ID already exists in the table, excluding the current user
    $check_student_id_query = "SELECT 1 FROM superadmins WHERE Student_ID = ? AND Student_ID != ?";
    $check_stmt = $conn->prepare($check_student_id_query);
    $check_stmt->bind_param("si", $new_student_id, $user_id);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        ErrorHandler::handleError("This Student ID is already in use.");
    }

    // Check if the new username already exists in the table, excluding the current user
    $check_username_query = "SELECT 1 FROM superadmins WHERE Username = ? AND Student_ID != ?";
    $check_stmt = $conn->prepare($check_username_query);
    $check_stmt->bind_param("si", $new_username, $user_id);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        ErrorHandler::handleError("This username is already in use.");
    }

    // Only proceed with the update if no errors were displayed
    if (empty($check_stmt->error)) {
        // Update query for superadmin details, without changing the password if it's not provided
        $update_query = "UPDATE superadmins SET Student_ID = ?, Username = ?, Password = ? WHERE Student_ID = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("sssi", $new_student_id, $new_username, $new_password, $user_id);

        if ($update_stmt->execute()) {
            ErrorHandler::handleError("Profile updated successfully!");
        } else {
            ErrorHandler::handleError("Error updating profile: " . $conn->error);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
</head>

<body>
    <h1>Update Profile</h1>

    <form action="" method="POST">
        <label for="Student_ID">Student ID:</label>
        <input type="text" name="Student_ID" value="<?php echo htmlspecialchars($superadmin['Student_ID']); ?>" required>

        <label for="Username">Username:</label>
        <input type="text" name="Username" value="<?php echo htmlspecialchars($superadmin['Username']); ?>" required>

        <label for="Password">New Password:</label>
        <input type="password" name="Password">

        <button type="submit">Update Profile</button>
    </form>
    <a href="../dashboards/dashboard.superadmin.php">Cancel</a>
</body>

</html>