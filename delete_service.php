<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $conn->query("DELETE FROM services WHERE id = $id");

    header("Location: view_services.php");
    exit;
}
?>
