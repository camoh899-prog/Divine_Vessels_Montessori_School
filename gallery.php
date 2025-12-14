<?php
include 'header.php';
include 'db.php'; // connect to DB for dynamic gallery
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css">
    <title>Gallery - Divine Vessels Montessori School</title>

    <script>
        window.onload = function () {
            let current = "gallery.php";
            let links = document.querySelectorAll(".nav a");

            links.forEach(link => {
                if (link.getAttribute("href") === current) {
                    link.style.textDecoration = "underline";
                    link.style.fontWeight = "bold";
                }
            });

            document.querySelector(".content").style.opacity = 1;
        };
    </script>

    <style>
        .content {
            opacity: 0;
            transition: opacity 1.4s ease-in;
        }
        .gallery-image img {
            transition: transform 0.3s;
            width: 100%;
            max-width: 400px;
            margin-bottom: 15px;
        }
        .gallery-image img:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>

<?php include 'nav.php'; ?>

<div class="content">
    <h2>Our Gallery</h2>
    <p>Some memories from Divine Vessels Montessori School</p>


    <!-- gallery images -->

    <h3>Group Studies</h3>
    <div class="gallery-image"><img src="images/group studies.jpg"></div>
    <div class="gallery-image"><img src="images/group studies 2.jpg"></div>
    <div class="gallery-image"><img src="images/group studies 3.jpg"></div>
    <div class="gallery-image"><img src="images/group studies 4.jpg"></div>

    <h3>Graduation Ceremony</h3>
    <div class="gallery-image"><img src="images/graduation.jpg"></div>
    <div class="gallery-image"><img src="images/graduation 2.jpg"></div>
    <div class="gallery-image"><img src="images/graduation 3.jpg"></div>

    <h3>Excursion Day</h3>
    <div class="gallery-image"><img src="images/excursion 1.jpg"></div>
    <div class="gallery-image"><img src="images/excursion 2.jpg"></div>
    <div class="gallery-image"><img src="images/our day.jpg"></div>
    <div class="gallery-image"><img src="images/excursion 3.jpg"></div>
    <div class="gallery-image"><img src="images/excursion 4.jpg"></div>
    <div class="gallery-image"><img src="images/excursion 5.jpg"></div>
    <div class="gallery-image"><img src="images/excursion 6.jpg"></div>
    <div class="gallery-image"><img src="images/excursion 7.jpg"></div>

    <h3>Culture Day</h3>
    <div class="gallery-image"><img src="images/culture.jpg"></div>
    <div class="gallery-image"><img src="images/culture 5.jpg"></div>
    <div class="gallery-image"><img src="images/culture 2.jpg"></div>
    <div class="gallery-image"><img src="images/culture 3.jpg"></div>
    <div class="gallery-image"><img src="images/culture 4.jpg"></div>

    <h3>Election Day</h3>
    <div class="gallery-image"><img src="images/election 1.jpg"></div>
    <div class="gallery-image"><img src="images/election 2.jpg"></div>
    <div class="gallery-image"><img src="images/election 3.jpg"></div>

    <h3>Cooking Time</h3>
    <div class="gallery-image"><img src="images/cooking.jpg"></div>
    <div class="gallery-image"><img src="images/cooking 2.jpg"></div>


    <!--  NEW SECTION: Dynamic Gallery from Database  -->
    <h2>More Photos</h2>

    <?php
    $result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = "./admin/".htmlspecialchars($row['image_path']);
            echo "<div class='gallery-image'><img src='$imagePath'></div>";
        }
    } else {
        echo "<p>No additional gallery images uploaded yet.</p>";
    }
    ?>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
