<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../styles/style.css"> -->
    <title>Document</title>
</head>

<body>
    <?php include("../connections/create.colleges.php"); ?>
    <div class="container">
        <div class="box form-box">
            <header>Add College</header>
            <form action="../homepages/homepage.superadmin.php" method="post">
                <div class="field input">
                    <label for="create-college">College Name</label>
                    <input type="text" name="create-college" placeholder="College Name" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Create College" required>
                </div>
            </form>


        </div>
    </div>
</body>

</html>