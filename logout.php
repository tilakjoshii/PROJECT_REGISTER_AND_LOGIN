<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page with a logout message
header("Location: index.php?success=You have been successfully logged out.");
exit();
?>
