<?php
// Test base_url function
echo "<h1>Base URL Test</h1>";

// Test if we can access the base_url function
echo "<h2>Testing Base URL Function</h2>";

try {
    // Include the framework
    require_once 'index.php';
    echo "<p>✅ Framework loaded</p>";
    
    // Test base_url function
    $base_url = base_url();
    echo "<p>Base URL: $base_url</p>";
    
    // Test base_url with parameter
    $logout_url = base_url('user/logout');
    echo "<p>Logout URL: $logout_url</p>";
    
    // Test if we can create UserController
    $controller = new UserController();
    echo "<p>✅ UserController created</p>";
    
    // Test if logout method exists
    if (method_exists($controller, 'logout')) {
        echo "<p>✅ Logout method exists</p>";
    } else {
        echo "<p>❌ Logout method not found</p>";
    }
    
} catch (Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
    echo "<p>File: " . $e->getFile() . "</p>";
    echo "<p>Line: " . $e->getLine() . "</p>";
}

echo "<hr>";
echo "<p><a href='user/login'>Go to Login</a></p>";
?>



