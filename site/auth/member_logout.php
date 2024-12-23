<?php
session_start();

// Destroy the member session
session_destroy();

// Redirect the member to the login page
header("Location: ../../");
exit();
?>
