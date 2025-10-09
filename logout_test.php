<?php
// Simple logout test
echo "<h1>Logout Test</h1>";

// Test direct logout
echo "<p><a href='index.php/user/logout' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Logout</a></p>";

// Test if we can access the framework
try {
    require_once 'index.php';
    echo "<p>✅ Framework loaded successfully</p>";
    
    // Test if we can create UserController
    $controller = new UserController();
    echo "<p>✅ UserController created</p>";
    
    // Test if logout method exists
    if (method_exists($controller, 'logout')) {
        echo "<p>✅ Logout method exists</p>";
    } else {
        echo "<p>❌ Logout method not found</p>";
    }
    
    // Test if we can call logout
    echo "<p>🔄 Testing logout method...</p>";
    $controller->logout();
    
} catch (Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
    echo "<p>File: " . $e->getFile() . "</p>";
    echo "<p>Line: " . $e->getLine() . "</p>";
}

echo "<hr>";
echo "<p><a href='user/login'>Go to Login</a></p>";
?>



