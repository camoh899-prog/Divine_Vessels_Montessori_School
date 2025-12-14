<?php
// CONNECT TO DATABASE
$conn = new mysqli("localhost", "root", "", "your_database_name");

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// FETCH ALL GALLERY IMAGES
$sql = "SELECT * FROM gallery ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gallery List</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            padding: 20px;
        }
        .box {
            width: 280px;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            margin: 10px;
            float: left;
        }
        img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }
        .btn-delete {
            display: block;
            margin-top: 10px;
            padding: 8px;
            background: red;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-delete:hover {
            background: darkred;
        }
    </style>
</head>
<body>

<h2>Gallery Images</h2>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
        
        <div class="box">
            <img src="<?php echo $row['image_path']; ?>" alt="Image">
            <p><b>Caption:</b> <?php echo $row['caption']; ?></p>

            <a class="btn-delete" 
               href="delete_gallery.php?id=<?php echo $row['id']; ?>" 
               onclick="return confirm('Are you sure you want to delete this image?');">
               Delete
            </a>
        </div>

    <?php }
} else {
    echo "<p>No images found.</p>";
}

$conn->close();
?>

</body>
</html>
