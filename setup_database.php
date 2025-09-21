<?php
// Database setup for hosting
echo "<h1>Database Setup</h1>";

$host = 'sql12.freesqldatabase.com';
$username = 'sql12798319';
$password = 'qvARsvTqGA';
$database = 'sql12798319';

try {
    // Connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✅ Connected to database successfully</p>";
    
    // Create users table
    $sql = "
    CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) NOT NULL,
        `email` varchar(100) NOT NULL,
        `picture` varchar(255) DEFAULT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `username` (`username`),
        UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    
    $pdo->exec($sql);
    echo "<p style='color: green;'>✅ Users table created</p>";
    
    // Insert sample data
    $sampleData = [
        ['john_doe', 'john@example.com'],
        ['jane_smith', 'jane@example.com'],
        ['bob_wilson', 'bob@example.com'],
        ['alice_brown', 'alice@example.com'],
        ['charlie_davis', 'charlie@example.com'],
        ['diana_miller', 'diana@example.com'],
        ['eve_jones', 'eve@example.com'],
        ['frank_garcia', 'frank@example.com'],
        ['grace_lee', 'grace@example.com'],
        ['henry_taylor', 'henry@example.com'],
        ['iris_moore', 'iris@example.com'],
        ['jack_white', 'jack@example.com'],
        ['kate_black', 'kate@example.com'],
        ['leo_green', 'leo@example.com'],
        ['mary_blue', 'mary@example.com']
    ];
    
    $stmt = $pdo->prepare("INSERT IGNORE INTO users (username, email) VALUES (?, ?)");
    $inserted = 0;
    
    foreach ($sampleData as $user) {
        try {
            $stmt->execute($user);
            $inserted++;
        } catch (PDOException $e) {
            // Ignore duplicates
        }
    }
    
    echo "<p style='color: green;'>✅ Sample data inserted: $inserted users</p>";
    
    // Count total users
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $count = $stmt->fetchColumn();
    echo "<p style='color: green;'>✅ Total users: $count</p>";
    
    echo "<hr>";
    echo "<h2>Setup Complete!</h2>";
    echo "<p><a href='index.php' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Application</a></p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}
?>
