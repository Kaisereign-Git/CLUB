<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Login</title>
</head>

<div class="header1">
    <h1>Isabela State University Club Organization</h1>
</div>

<body>
    <?php

    include("../connections/compi.login.php");
    ?>

    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="student-id">Student-Id</label>
                    <input type="text" name="student-id" placeholder="XX-XXXXX" maxlength="8" pattern="^\d{2}-\d{5}$"
                        required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have an account? <a href="signup.php">Sign-up here</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>