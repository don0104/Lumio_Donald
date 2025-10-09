<?php
// Final logout test
echo "<h1>Final Logout Test</h1>";

// Test if we can access the logout method
echo "<h2>Testing Logout Method</h2>";

try {
    // Include the framework
    require_once 'index.php';
    echo "<p>✅ Framework loaded</p>";
    
    // Test if we can create UserController
    $controller = new UserController();
    echo "<p>✅ UserController created</p>";
    
    // Test if logout method exists
    if (method_exists($controller, 'logout')) {
        echo "<p>✅ Logout method exists</p>";
    } else {
        echo "<p>❌ Logout method not found</p>";
    }
    
    // Test logout method
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



