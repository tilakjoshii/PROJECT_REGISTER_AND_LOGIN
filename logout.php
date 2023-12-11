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
<?php

//logout.php

include('sign_in_with_google.php');

//Reset OAuth access token
$google_client->revokeToken();

//Destroy entire session data.
session_destroy();

//redirect page to index.php
header('location:index.php?success=You have been successfully logged out.by using google');

?>
