<?php
include 'db.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Gallery</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
<a href="delete_gallery.php?id=<?php echo $row['id']; ?>" 
   onclick="return confirm('Delete this image?');">
   Delete
</a>


<?php include 'nav.php'; ?>

<div class="content">
    <h2>Manage Gallery</h2>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Caption</th>
            <th>Uploaded At</th>
            <th>Action</th> 
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");

        if ($result && $result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td><img src='".$row['image_path']."' width='120' style='border-radius:5px;'></td>";
                echo "<td>".htmlspecialchars($row['caption'])."</td>";
                echo "<td>".$row['uploaded_at']."</td>";
                echo "<td><a href='delete_gallery.php?id=".$row['id']."' style='color:red;'>Delete</a></td>";
                echo "</tr>";
            }

        } else {
            echo "<tr><td colspan='5'>No gallery images found.</td></tr>";
        }
        ?>
    </table>
</div>

<?php include 'footer.php'; ?>

</body>
</html>