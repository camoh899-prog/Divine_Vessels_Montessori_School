<?php
// Include database connection
include 'db.php';

$successMessage = "";
$errorMessage = "";

// Process form when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    if (!empty($name) && !empty($email) && !empty($message)) {

        // Insert data into enquiries table
        $stmt = $conn->prepare("INSERT INTO enquiries (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $successMessage = "Your enquiry has been sent successfully!";
        } else {
            $errorMessage = "Something went wrong. Please try again.";
        }

        $stmt->close();
    } else {
        $errorMessage = "Please fill in all fields.";
    }
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us - Divine Vessels Montessori School</title>
    <link rel="stylesheet" href="Style.css">

    <script>
        // JavaScript validation
        function validateContact() {
            var name = document.forms["contactForm"]["name"].value;
            var email = document.forms["contactForm"]["email"].value;
            var message = document.forms["contactForm"]["message"].value;

            if (name === "" || email === "" || message === "") {
                alert("Please complete all fields before submitting.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>

<?php include 'nav.php'; ?>

<div class="content">
    <h2>Contact Us</h2>
    <p>If you have any questions, kindly send us a message below.</p>

    <!-- Display Messages -->
    <?php
    if (!empty($successMessage)) {
        echo "<p style='color: green; font-weight: bold;'>$successMessage</p>";
    }

    if (!empty($errorMessage)) {
        echo "<p style='color: red; font-weight: bold;'>$errorMessage</p>";
    }
    ?>

    <!-- Contact Form -->
    <form name="contactForm" action="" method="post" onsubmit="return validateContact();">

        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name">

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email">

        <label for="message">Message:</label>
        <textarea name="message" id="message" rows="5"></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
