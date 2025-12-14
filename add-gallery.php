<?php
include 'db.php';
session_start();

$success = "";
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caption = htmlspecialchars(trim($_POST['caption']));

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $fileName = $_FILES['image']['name'];
        $fileTmp = $_FILES['image']['tmp_name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);

        if (in_array(strtolower($ext), $allowed)) {
            if (!is_dir('gallery_uploads')) mkdir('gallery_uploads', 0777, true);

            $imagePath = 'gallery_uploads/' . time() . '_' . basename($fileName);
            if (move_uploaded_file($fileTmp, $imagePath)) {
                $stmt = $conn->prepare("INSERT INTO gallery (image_path, caption) VALUES (?, ?)");
                $stmt->bind_param("ss", $imagePath, $caption);

                if ($stmt->execute()) {
                    $success = "Image added successfully!";
                } else {
                    $error = "Database error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $error = "Failed to upload image.";
            }

        } else {
            $error = "Invalid image type. JPG, JPEG, PNG, GIF only.";
        }

    } else {
        $error = "Please select an image to upload.";
    }
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css">
    <title>Add Gallery Image - Admin</title>
</head>
<body>
<?php include 'nav.php'; ?>

<div class="content">
    <h2>Add New Gallery Image</h2>

    <?php
    if (!empty($success)) echo "<p style='color:green;'>$success</p>";
    if (!empty($error)) echo "<p style='color:red;'>$error</p>";
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="caption">Image Caption:</label>
        <input type="text" name="caption" id="caption">

        <label for="image">Select Image:</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button type="submit">Add Image</button>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
