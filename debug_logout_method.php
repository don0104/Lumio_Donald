<?php
// Debug logout method
echo "<h1>Debug Logout Method</h1>";

// Test if we can access the logout URL
echo "<h2>Testing Logout URL</h2>";
echo "<p>URL: <a href='user/logout' target='_blank'>user/logout</a></p>";
echo "<p>Full URL: <a href='http://localhost/web2/Activity3/Lumio_Donald/user/logout' target='_blank'>http://localhost/web2/Activity3/Lumio_Donald/user/logout</a></p>";

// Test direct index.php approach
echo "<p>Direct: <a href='index.php/user/logout' target='_blank'>index.php/user/logout</a></p>";

// Test if we can access the controller directly
echo "<h2>Testing Controller Access</h2>";
try {
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
    
} catch (Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><a href='user/login'>Go to Login</a></p>";
?>



