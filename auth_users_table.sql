-- Authentication Users Table
-- Complete SQL for auth_users table with all authentication features

CREATE TABLE IF NOT EXISTS `auth_users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` enum('user','admin','moderator') DEFAULT 'user',
    `first_name` varchar(50) DEFAULT NULL,
    `last_name` varchar(50) DEFAULT NULL,
    `picture` varchar(255) DEFAULT NULL,
    `is_active` tinyint(1) DEFAULT 1,
    `last_login` timestamp NULL DEFAULT NULL,
    `failed_login_attempts` int(3) DEFAULT 0,
    `locked_until` timestamp NULL DEFAULT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE KEY `email` (`email`),
    KEY `idx_auth_users_email` (`email`),
    KEY `idx_auth_users_username` (`username`),
    KEY `idx_auth_users_role` (`role`),
    KEY `idx_auth_users_is_active` (`is_active`),
    KEY `idx_auth_users_last_login` (`last_login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Additional indexes for performance
CREATE INDEX idx_auth_users_created_at ON auth_users(created_at);
CREATE INDEX idx_auth_users_updated_at ON auth_users(updated_at);
CREATE INDEX idx_auth_users_failed_attempts ON auth_users(failed_login_attempts);
CREATE INDEX idx_auth_users_locked_until ON auth_users(locked_until);

-- Insert default admin user (password: 'admin123')
INSERT INTO `auth_users` (
    `username`, 
    `email`, 
    `password`, 
    `role`, 
    `first_name`, 
    `last_name`, 
    `is_active`
) VALUES (
    'admin', 
    'admin@example.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'admin', 
    'System', 
    'Administrator', 
    1
) ON DUPLICATE KEY UPDATE username=username;

-- Insert sample users for testing
INSERT INTO `auth_users` (
    `username`, 
    `email`, 
    `password`, 
    `role`, 
    `first_name`, 
    `last_name`, 
    `is_active`
) VALUES 
(
    'john_doe', 
    'john@example.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'user', 
    'John', 
    'Doe', 
    1
),
(
    'jane_smith', 
    'jane@example.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'user', 
    'Jane', 
    'Smith', 
    1
),
(
    'moderator1', 
    'mod@example.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'moderator', 
    'Mod', 
    'Erator', 
    1
) ON DUPLICATE KEY UPDATE username=username;
