<?php
// Test session functionality
echo "<h1>Session Test</h1>";

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

echo "<p>Session ID: " . session_id() . "</p>";
echo "<p>Session Status: " . session_status() . "</p>";

// Test session variables
if (isset($_SESSION['user_id'])) {
    echo "<p>User ID: " . $_SESSION['user_id'] . "</p>";
} else {
    echo "<p>No user ID in session</p>";
}

// Test session destruction
echo "<h2>Testing Session Destruction</h2>";
echo "<p>Before: " . (isset($_SESSION['user_id']) ? 'Has user_id' : 'No user_id') . "</p>";

// Clear session
$_SESSION = array();
session_destroy();

echo "<p>After: " . (isset($_SESSION['user_id']) ? 'Has user_id' : 'No user_id') . "</p>";

echo "<hr>";
echo "<p><a href='user/login'>Go to Login</a></p>";
?>



