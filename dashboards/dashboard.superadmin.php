<?php
include("../connections/create.colleges.php");


// Fetch colleges from the  database to display
$stmt = "SELECT * FROM colleges";
$result = $conn->query($stmt);

if ($result->num_rows > 0) {
    echo "COLLEGES<br>";
    while ($row = $result->fetch_assoc()) {
        $college_name = htmlspecialchars($row['College_Name']);
        echo $college_name;

        // Button to delete the college
        echo "
    <form action='' method='POST' style='display:inline;'>
        <input type='hidden' name='College_Name' value='$college_name'>
        <button type='submit' onclick='return confirm(\"Are you sure you want to delete this college?\");'>DELETE</button>
    </form>";

        echo "
     <form action='../features/update.college.php' method='POST' style='display:inline;'>
         <input type='hidden' name='College_Name' value='$college_name'>
         <button type='submit' onclick='return confirm(\"Are you sure you want to delete this college?\");'>UPDATE</button>
         <br>
     </form>";
    }
} else {
    echo "No colleges found.";
}

if (isset($_POST['College_Name'])) {
    $college_name = $_POST['College_Name'];

    // Prepare the DELETE statement correctly
    $stmt = $conn->prepare("DELETE FROM colleges WHERE College_Name = ?");

    // Bind the parameter correctly
    $stmt->bind_param("s", $college_name);

    if ($stmt->execute()) {
        header("Location: ../dashboards/dashboard.superadmin.php");
        exit;
    } else {
        echo "Error deleting college: " . $stmt->error;
    }
}

echo "<a href='../src/colleges.php'>Add College</a>" . "<br>";
echo "<a href='../homepages/homepage.superadmin.php'>Go Back</a>";