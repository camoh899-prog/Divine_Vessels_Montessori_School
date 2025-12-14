<?php
include 'db.php';
session_start();

// Handle deletion if 'delete_id' is in the URL
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $deleteQuery = "DELETE FROM enquiries WHERE id = $delete_id";
    if ($conn->query($deleteQuery)) {
        $message = "Enquiry deleted successfully.";
    } else {
        $error = "Failed to delete enquiry: " . $conn->error;
    }
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css">
    <title>View Enquiries - Admin</title>

    <script>
        function searchEnquiries() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("enquiriesTable");
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
            let current = "enquiries.php";
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
    <h2>Contact Form Enquiries</h2>
    <?php
        if (!empty($message)) echo "<p style='color:green;'>$message</p>";
        if (!empty($error)) echo "<p style='color:red;'>$error</p>";
    ?>
    <p>View all submissions from the contact form below:</p>

    <input type="text" id="searchInput" onkeyup="searchEnquiries()" placeholder="Search by Name">

    <?php
    $result = $conn->query("SELECT * FROM enquiries ORDER BY submitted_at DESC");

    if ($result->num_rows > 0) {
        echo "<table id='enquiriesTable' border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date Submitted</th>
                <th>Action</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['message']) . "</td>
                    <td>" . $row['submitted_at'] . "</td>
                    <td>
                        <a href='enquiries.php?delete_id=" . $row['id'] . "' 
                           onclick='return confirm(\"Are you sure you want to delete this enquiry?\");' 
                           style='color:red;'>Delete</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No enquiries found.</p>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
