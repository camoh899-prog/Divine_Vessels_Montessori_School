<?php
include 'db.php';
session_start();

$success = "";
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));

    if (!empty($title) && !empty($description)) {
        $stmt = $conn->prepare("INSERT INTO services (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);

        if ($stmt->execute()) {
            $success = "Service added successfully!";
        } else {
            $error = "Database error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css">
    <title>Add Service - Admin</title>
</head>
<body>
<?php include 'nav.php'; ?>

<div class="content">
    <h2>Add New Service</h2>

    <?php
    if (!empty($success)) echo "<p style='color:green;'>$success</p>";
    if (!empty($error)) echo "<p style='color:red;'>$error</p>";
    ?>

    <form action="" method="post">
        <label for="title">Service Title:</label>
        <input type="text" name="title" id="title">

        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>

        <button type="submit">Add Service</button>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
