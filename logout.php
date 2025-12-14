<?php
session_start();

// remove all session data
session_unset();

// destroy the session
session_destroy();

// send user back to front-end homepage
header("Location: ../index.php");
exit();
?>
