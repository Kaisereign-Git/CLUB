<?php
session_start();
// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../src/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<style>
    /* Styling the button */
    .plus-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        background-color: #4CAF50;
        /* Green background */
        color: white;
        border-radius: 50%;
        font-size: 24px;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    /* Hover effect */
    .plus-icon:hover {
        background-color: #45a049;
    }

    .dashboard {
        text-decoration: none;
    }

    .logout-button {
        text-decoration: none;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage_SuperAdmin</title>
</head>

<body>
    <a href="../src/colleges.php" class="plus-icon"'>+</a>
    <a href="../dashboards/dashboard.superadmin.php" class="dashboard">Dashboard</a>
    <a href="../src/logout.php" class="logout-button">Logout</a>
    <br>
    <br>
</body>

</html>

<?php
include("../connections/create.colleges.php");

$stmt = "SELECT * FROM colleges";
$result = $conn->query($stmt);

if ($result->num_rows > 0) {
    echo "COLLEGES<br>";
    while ($row = $result->fetch_assoc()) {
        $college_name = htmlspecialchars($row['College_Name']);
        echo $college_name . "<br>";
    }
}

?>