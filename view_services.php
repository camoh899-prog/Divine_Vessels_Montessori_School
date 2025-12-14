<?php
include 'db.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Services</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include 'nav.php'; ?>
<h2>All Services</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Service Title</th>
        <th>Description</th>
        <th>Action</th>
    </tr>

<?php
$result = $conn->query("SELECT * FROM services ORDER BY id DESC");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['title']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td><a href='delete_service.php?id=".$row['id']."' style='color:red;'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No services found</td></tr>";
}
?>

</table>
<?php include 'footer.php'; ?>
</body>
</html>
