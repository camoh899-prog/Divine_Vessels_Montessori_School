<?php
// Include database connection
include 'db.php';

// Start session (for admin login authentication)
session_start();

// For now, we assume admin is logged in
// In real implementation, check session for login
$adminName = "Administrator"; // you can replace with session variable after login
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style.css">
    <title>Admin Dashboard - Divine Vessels Montessori School</title>
</head>
<body>
<?php include 'nav.php'; ?>


<div class="content">
    <h2>Welcome, <?php echo $adminName; ?></h2>
    <p>Select an option above to manage the website</p>

    
</div>

<?php include 'footer.php'; ?>

</body>
</html>
