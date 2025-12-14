<?php
include 'header.php';
include 'db.php'; // connect to database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css">
    <title>Our Services - Divine Vessels Montessori School</title>

    <script>
        // highlight this page in the navigation
        window.onload = function () {
            let current = "services.php";
            let links = document.querySelectorAll(".nav a");

            links.forEach(link => {
                if (link.getAttribute("href") === current) {
                    link.style.textDecoration = "underline";
                    link.style.fontWeight = "bold";
                }
            });

            // fade in animation
            document.querySelector(".content").style.opacity = 1;
        };
    </script>

    <style>
        .content {
            opacity: 0;
            transition: opacity 1.4s ease-in;
        }
        .service-box {
            transition: transform .3s;
        }
        .service-box:hover {
            transform: scale(1.02);
        }
    </style>
</head>

<body>

<?php include 'nav.php'; ?>

<div class="content">
    <h2>Our Services</h2>

    <!-- Static services -->
    <div class="service-box">
        <h3>Pre-School</h3>
        <p>
            We provide a safe, playful, and nurturing environment for young children 
            to begin their learning journey with joy and curiosity.
        </p>
    </div>

    <div class="service-box">
        <h3>Primary</h3>
        <p>
            Our primary school program focuses on literacy, numeracy, science, and social
            development in a supportive classroom setting.
        </p>
    </div>

    <div class="service-box">
        <h3>Junior High School (JHS)</h3>
        <p>
            Our JHS students are prepared for BECE and lifelong success through structured lessons, 
            mentorship, and strong values.
        </p>
    </div>

    <!-- Dynamic services from DB -->
    <?php
    $result = $conn->query("SELECT * FROM services ORDER BY id ASC");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='service-box'>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "</div>";
        }
    }
    ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
