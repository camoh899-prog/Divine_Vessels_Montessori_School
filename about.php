<?php
// include shared header
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css">
    <title>About Us - Divine Vessels Montessori School</title>

    <script>
        // highlight current page in the nav
        window.onload = function () {
            let current = "about.php";
            let links = document.querySelectorAll(".nav a");

            links.forEach(link => {
                if (link.getAttribute("href") === current) {
                    link.style.textDecoration = "underline";
                    link.style.fontWeight = "bold";
                }
            });

            // small fade-in effect for the content
            document.querySelector(".content").style.opacity = 1;
        };
    </script>

    <style>
        /* simple fade-in style */
        .content {
            opacity: 0;
            transition: opacity 1.5s ease-in;
        }
    </style>
</head>

<body>

<?php
// shared nav bar
include 'nav.php';
?>

<div class="content">

    <h2><u>About Us</u></h2>

    <p><b>Welcome to Divine Vessels Montessori School (DVMS)</b>, located in Gbawe Bulemin, Accra, Ghana.
    We're a dedicated learning institution committed to nurturing academic excellence and strong moral values in
    children from Pre-School to Junior High School (JHS). At <b>DVMS</b>, we empower students to achieve their goals
    through creativity, discipline, and a learner-focused environment.</p>

    <h2><u>Our History</u></h2>
    <p>Founded in 2013 by Mr. and Mrs. Obuobisa Ayeh, DVMS was built on a passion for transforming young minds.
    Through Montessori-based learning, academic excellence, and moral discipline, DVMS has become a leading
    institution within Gbawe Bulemin and beyond.</p>

    <h2><u>Notable Achievements</u></h2>
    <ul>
        <li><b>BECE Excellence:</b> Multiple distinction graduates each year.</li>
        <li><b>Marching Band Champions:</b> Winners of several local competitions.</li>
        <li><b>Science Fair Awards:</b> Recognized for innovation and creativity.</li>
        <li><b>Community Service:</b> Environmental and literacy outreach projects.</li>
        <li><b>Teacher Awards:</b> Recognized for passionate and effective teaching.</li>
    </ul>

    <h2><u>Our Mission</u></h2>
    <ul>
        <li>Learning with joy in a friendly environment.</li>
        <li>Well-motivated and God-fearing staff.</li>
        <li>Daily home link exercises to strengthen learning.</li>
        <li>Excellent writing and reading skills.</li>
        <li>Champions Are Coming – our slogan.</li>
    </ul>

    <h2><u>The Vision</u></h2>
    <ul>
        <li>Equipping learners physically, spiritually, and academically.</li>
        <li>Helping each child discover potential and uniqueness.</li>
        <li>Raising responsible citizens for God, self, and society.</li>
        <li>Team-work inspired learning.</li>
    </ul>

    <h2><u>Core Values</u></h2>
    <ul>
        <li>Discipline</li>
        <li>Honesty</li>
        <li>Hard work</li>
        <li>Team work</li>
    </ul>

    <h2>Location & Contact</h2>
    <p>
        <strong>Location:</strong> Gbawe Bulemin Near Block Factory, Accra-Ghana<br>
    </p>

</div>

<?php
// shared footer
include 'footer.php';
?>

</body>
</html>
