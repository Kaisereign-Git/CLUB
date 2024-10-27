<?php
include "../src/colleges.php";

if (isset($_GET['College_Name'])) {
    $college_name = $_GET['College_Name'];

    // Prepare the DELETE statement correctly
    $stmt = $conn->prepare("DELETE FROM colleges WHERE College_Name = ?");

    // Bind the parameter correctly
    $stmt->bind_param("s", $college_name); // Use "s" for string type

    if ($stmt->execute()) {
        header("Location: ../homepages/homepage.superadmin.php");
        exit;
    } else {
        echo "Error deleting college: " . $stmt->error;
    }
}

// Fetch colleges from the database to display
$stmt = "SELECT * FROM colleges";
$result = $conn->query($stmt);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        $college_name = htmlspecialchars($row['College_Name']);
        echo "<li>" . $college_name;

        // Button to delete the college
        echo "
        <form action='' method='GET' style='display:inline;'>
            <input type='hidden' name='College_Name' value='$college_name'>
            <button type='submit' onclick='return confirm(\"Are you sure you want to delete this college?\");'>Delete</button>
        </form>
        </li>";
    }
    echo "</ul>";
} else {
    echo "No colleges found.";
}