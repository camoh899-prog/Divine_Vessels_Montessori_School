<?php
// include the shared header file
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css"> <!-- link to css -->
    <title>Home</title>
    <script>
        // this function shows a welcome message
        function showWelcome() {
            alert("Welcome to " + "<?php echo $schoolName; ?>" + "! We are excited to have you here."); // pop up alert
        }

        // run this when page loads
        window.onload = function() {
            showWelcome(); // show welcome
            
            // change the message with js
            document.getElementById("enrollMessage").innerHTML = "Enroll now and shape a brighter future! "; // update text
        };

        // for form validation if needed later
        function validateForm() {
            var name = document.forms["contactForm"]["name"].value; // get name
            if (name == "") { // if empty
                alert("Name must be filled out"); // error message
                return false; // stop form
            }
        }
    </script>
</head>
<body>
    <?php
    // include the shared nav
    include 'nav.php';
    ?>
   
    <div class="content">
        <h2>Welcome to Our School</h2>
        <p>We provide quality education and care to children in Gbawe Bulemin, Accra Ghana.</p>
   
        <h3>Our Key Services</h3>
        <ul>
            <li><strong>Pre-School:</strong> Give your child the best start! Our preschool offers nurturing care, engaging activities, and a strong foundation for future success.</li>
            <br><li><strong>Primary:</strong> Unlock your child's potential! Our primary school provides quality education, supportive environment, and opportunities for growth.</li>
            <br><li><strong>JHS:</strong> Empowering young minds! Our Junior High School offers academic excellence, character development, and extracurricular activities to prepare students for success.</li>
        </ul>
        <p id="enrollMessage"><b>Enroll now and shape a brighter future!.</b></p> <!-- js changes this -->
    </div>
   
    <?php
    // include the shared footer
    include 'footer.php';
    ?>
</body>
</html>