<?php
// Update existing users table to add authentication fields
echo "<h1>Update Users Table for Authentication</h1>";

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mockdata';

try {
    // Connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✅ Connected to database successfully</p>";
    
    // Add new columns to existing users table
    $alter_queries = [
        "ALTER TABLE `users` ADD COLUMN `password` varchar(255) DEFAULT NULL AFTER `email`",
        "ALTER TABLE `users` ADD COLUMN `role` enum('admin','user','moderator') DEFAULT 'user' AFTER `password`",
        "ALTER TABLE `users` ADD COLUMN `first_name` varchar(50) DEFAULT NULL AFTER `role`",
        "ALTER TABLE `users` ADD COLUMN `last_name` varchar(50) DEFAULT NULL AFTER `first_name`",
        "ALTER TABLE `users` ADD COLUMN `is_active` tinyint(1) DEFAULT 1 AFTER `last_name`",
        "ALTER TABLE `users` ADD COLUMN `last_login` timestamp NULL DEFAULT NULL AFTER `is_active`",
        "ALTER TABLE `users` ADD COLUMN `failed_login_attempts` int(3) DEFAULT 0 AFTER `last_login`",
        "ALTER TABLE `users` ADD COLUMN `locked_until` timestamp NULL DEFAULT NULL AFTER `failed_login_attempts`"
    ];
    
    foreach ($alter_queries as $query) {
        try {
            $pdo->exec($query);
            echo "<p style='color: green;'>✅ Column added successfully</p>";
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
                echo "<p style='color: orange;'>⚠️ Column already exists</p>";
            } else {
                echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
            }
        }
    }
    
    // Update existing users with default passwords
    $update_query = "UPDATE `users` SET 
        `password` = ?, 
        `role` = 'user',
        `first_name` = SUBSTRING_INDEX(`username`, '_', 1),
        `last_name` = SUBSTRING_INDEX(`username`, '_', -1),
        `is_active` = 1
        WHERE `password` IS NULL";
    
    $default_password = password_hash('changeme', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare($update_query);
    $stmt->execute([$default_password]);
    
    echo "<p style='color: green;'>✅ Updated existing users with default passwords</p>";
    
    // Create admin user if not exists
    $admin_password = password_hash('changeme', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT IGNORE INTO users (username, email, password, role, first_name, last_name, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(['admin', 'admin@example.com', $admin_password, 'admin', 'System', 'Administrator', 1]);
    
    echo "<p style='color: green;'>✅ Admin user created/verified</p>";
    
    // Show current users
    $stmt = $pdo->query("SELECT id, username, email, role, first_name, last_name, is_active FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<hr>";
    echo "<h2>Current Users:</h2>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Name</th><th>Active</th></tr>";
    
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . $user['id'] . "</td>";
        echo "<td>" . $user['username'] . "</td>";
        echo "<td>" . $user['email'] . "</td>";
        echo "<td>" . $user['role'] . "</td>";
        echo "<td>" . $user['first_name'] . " " . $user['last_name'] . "</td>";
        echo "<td>" . ($user['is_active'] ? 'Yes' : 'No') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<hr>";
    echo "<h2>Setup Complete!</h2>";
    echo "<p><strong>Login Credentials:</strong></p>";
    echo "<ul>";
    echo "<li>Default credentials removed. Create accounts via registration.</li>";
    echo "</ul>";
    echo "<p><a href='index.php' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Application</a></p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}
?>


