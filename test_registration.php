<?php
// Test registration functionality
echo "<h1>Test Registration</h1>";

// Include LavaLust
define('PREVENT_DIRECT_ACCESS', TRUE);
require_once 'scheme/kernel/LavaLust.php';

try {
    // Test database connection
    $lava = &get_instance();
    echo "<p style='color: green;'>✅ LavaLust loaded successfully</p>";
    
    // Test UserModel
    $lava->call->model('UserModel');
    echo "<p style='color: green;'>✅ UserModel loaded successfully</p>";
    
    // Test registration data
    $test_data = [
        'username' => 'test_user_' . time(),
        'email' => 'test' . time() . '@example.com',
        'password' => 'test123',
        'first_name' => 'Test',
        'last_name' => 'User'
    ];
    
    echo "<h3>Testing registration with data:</h3>";
    echo "<pre>" . print_r($test_data, true) . "</pre>";
    
    // Test registration
    $result = $lava->UserModel->register($test_data);
    
    echo "<h3>Registration result:</h3>";
    echo "<pre>" . print_r($result, true) . "</pre>";
    
    if ($result['success']) {
        echo "<p style='color: green;'>✅ Registration successful!</p>";
    } else {
        echo "<p style='color: red;'>❌ Registration failed: " . $result['message'] . "</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    echo "<p>Stack trace:</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>




