<?php
include 'db.php';
session_start();

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM applications WHERE id = $delete_id");
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css">
    <title>View Job Applications - Admin</title>
    <script>
        function searchApplications() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("applicationsTable");
            var tr = table.getElementsByTagName("tr");

            for (var i = 1; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    var txtValue = td.textContent || td.innerText;
                    tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
                }
            }
        }

        window.onload = function () {
            let current = "applications.php";
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
    <h2>Job Applications</h2>
    <p>View all job applications submitted by applicants:</p>

    <input type="text" id="searchInput" onkeyup="searchApplications()" placeholder="Search by Name">

    <?php
    $result = $conn->query("SELECT * FROM applications ORDER BY applied_at DESC");

    if ($result->num_rows > 0) {
        echo "<table id='applicationsTable' border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>CV</th>
                <th>Date Applied</th>
                <th>Action</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['position']) . "</td>
                    <td><a href='" . htmlspecialchars($row['cv_path']) . "' target='_blank'>Download CV</a></td>
                    <td>" . $row['applied_at'] . "</td>
                    <td>
                        <a href='applications.php?delete_id=" . $row['id'] . "' 
                           onclick='return confirm(\"Are you sure you want to delete this application?\");' 
                           style='color:red;'>Delete</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No applications found.</p>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
