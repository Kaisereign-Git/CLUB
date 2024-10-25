<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Register</title>
</head>

<body>
    <?php include("../connections/compi.signup.php"); ?>
    <div class="header1">
        <h1>Isabela State University Club Organization</h1>
    </div>

    <div class="container">
        <div class="box form-box">
            <header>Sign-up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="student-id">Student-ID</label>
                    <input type="text" name="student-id" id="student-id" placeholder="XX-XXXXX" maxlength="8"
                        pattern="^\d{2}-\d{5}$" required>

                </div>

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="uid" id="uid" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="pwd" id="pwd" required>
                </div>

                <div class="field input">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="pwdConfirm" id="pwdConfirm" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="field input">
                    <select name="college" required>
                        <option value="" selected disabled>
                            -- College --
                        </option>
                        <option value="CCSICT">CCSICT</option>
                    </select>
                </div>

                <div class="field input">
                    <select name="program" required>
                        <option value="" selected disabled>
                            -- Program --
                        </option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Information Technology">
                            Information Technology
                        </option>
                        <option value="Entertainment and Multimedia Computing">
                            Entertainment and Multimedia Computing
                        </option>
                    </select>
                </div>

                <div class="field input">
                    <select name="section" required>
                        <option value="" selected disabled>
                            -- Section --
                        </option>
                        <option value="Business Analytics">Business Analytics</option>
                        <option value="Business Processing Outsourcing">Business Processing Outsourcing</option>
                        <option value="Data Mining">Data Mining</option>
                        <option value="Digital Animation">Digital Animation</option>
                        <option value="Game Development">Game Development</option>
                        <option value="Network Security">Network Security</option>
                        <option value="Web and Mobile Application Development">Web and Mobile Application Development
                        </option>
                    </select>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already have an account? <a href="login.php">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>