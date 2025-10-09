<?php
// Test logout functionality
echo "<h1>Test Logout</h1>";

// Include LavaLust
define('PREVENT_DIRECT_ACCESS', TRUE);
require_once 'scheme/kernel/LavaLust.php';

try {
    $lava = &get_instance();
    echo "<p style='color: green;'>✅ LavaLust loaded successfully</p>";
    
    // Test session
    if (!isset($_SESSION)) {
        session_start();
    }
    
    echo "<h3>Current Session Data:</h3>";
    echo "<pre>" . print_r($_SESSION, true) . "</pre>";
    
    // Test logout
    echo "<h3>Testing Logout:</h3>";
    echo "<p><a href='user/logout' style='background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Logout</a></p>";
    
    // Test login
    echo "<p><a href='user/login' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Login</a></p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    echo "<p>Stack trace:</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>




