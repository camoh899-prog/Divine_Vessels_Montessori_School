<?php
session_start();

// Hardcoded login for now
$demoUser = "admin";
$demoPass = "password123";

$errorMessage = "";

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Check credentials
    if ($username === $demoUser && $password === $demoPass) {

        // Save user session
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_username"] = $username;

        // Redirect to backend dashboard
        header("Location: admin/dashboard.php");
        exit();
    } else {
        $errorMessage = "Invalid username or password.";
    }
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css">
    <title>Login - Divine Vessels Montessori School</title>

    <script>
        function validateForm() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;

            if (username === "" || password === "") {
                alert("Please enter both username and password.");
                return false;
            }
            return true;
        }

        window.onload = function () {
            let current = "login.php";
            let links = document.querySelectorAll(".nav a");
            links.forEach(link => {
                if (link.getAttribute("href") === current) {
                    link.style.textDecoration = "underline";
                    link.style.fontWeight = "bold";
                }
            });
        };
    </script>
</head>

<body>

<?php include 'nav.php'; ?>

<div class="content">
    <h2>Login</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "<p style='color:red; font-weight:bold;'>$errorMessage</p>";
    }
    ?>

    <form name="loginForm" action="" method="post" onsubmit="return validateForm();">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <button type="submit">Login</button>
    </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
