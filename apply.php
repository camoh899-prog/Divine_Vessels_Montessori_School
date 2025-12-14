<?php
include 'db.php'; // database connection

$successMessage = "";
$errorMessage = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $position = htmlspecialchars(trim($_POST['position']));

    // Handle CV upload
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        $allowed = ['pdf', 'doc', 'docx'];
        $fileName = $_FILES['cv']['name'];
        $fileTmp = $_FILES['cv']['tmp_name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);

        if (in_array(strtolower($ext), $allowed)) {
            // Ensure uploads folder exists
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            $cvPath = 'uploads/' . time() . '_' . basename($fileName);
            if (move_uploaded_file($fileTmp, $cvPath)) {
                // Insert into database
                $stmt = $conn->prepare("INSERT INTO applications (name, email, position, cv_path) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $email, $position, $cvPath);

                if ($stmt->execute()) {
                    $successMessage = "Thank you, $name! Your application has been submitted.";
                } else {
                    $errorMessage = "Database error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $errorMessage = "Failed to upload CV.";
            }

        } else {
            $errorMessage = "Invalid file type. Only PDF, DOC, DOCX allowed.";
        }

    } else {
        $errorMessage = "Please upload your CV.";
    }
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css">
    <title>Apply for Job - Divine Vessels Montessori School</title>

    <script>
        function validateForm() {
            var name = document.forms["applyForm"]["name"].value;
            var email = document.forms["applyForm"]["email"].value;
            var position = document.forms["applyForm"]["position"].value;
            var cv = document.forms["applyForm"]["cv"].value;

            if (name === "" || email === "" || position === "" || cv === "") {
                alert("Please fill all fields and upload CV.");
                return false;
            }

            var allowed = /(\.pdf|\.doc|\.docx)$/i;
            if (!allowed.exec(cv)) {
                alert("Invalid file type. Only PDF, DOC, DOCX allowed.");
                return false;
            }
            return true;
        }

        window.onload = function() {
            let current = "apply.php";
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
    <h2>Apply for a Job</h2>
    <p>Fill the form and upload your CV to apply:</p>

    <?php
    if (!empty($successMessage)) echo "<p style='color:green; font-weight:bold;'>$successMessage</p>";
    if (!empty($errorMessage)) echo "<p style='color:red; font-weight:bold;'>$errorMessage</p>";
    ?>

    <form name="applyForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email">

        <label for="position">Position Applying For:</label>
        <input type="text" name="position" id="position">

        <label for="cv">Upload CV:</label>
        <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx">

        <button type="submit">Submit Application</button>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
