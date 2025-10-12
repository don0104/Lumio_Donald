-- =====================================================
-- LavaLust User Management System - Complete Database
-- =====================================================

-- Create database (uncomment if needed)
-- CREATE DATABASE IF NOT EXISTS `mockdata` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE `mockdata`;

-- =====================================================
-- USERS TABLE (Main table for user management)
-- =====================================================

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `first_name` varchar(50) DEFAULT NULL,
    `last_name` varchar(50) DEFAULT NULL,
    `role` enum('user','admin') DEFAULT 'user',
    `picture` varchar(255) DEFAULT NULL,
    `is_active` tinyint(1) DEFAULT 1,
    `last_login` timestamp NULL DEFAULT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE KEY `email` (`email`),
    KEY `idx_users_email` (`email`),
    KEY `idx_users_username` (`username`),
    KEY `idx_users_role` (`role`),
    KEY `idx_users_is_active` (`is_active`),
    KEY `idx_users_last_login` (`last_login`),
    KEY `idx_users_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- AUTH_USERS TABLE (Authentication table)
-- =====================================================

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
    KEY `idx_auth_users_last_login` (`last_login`),
    KEY `idx_auth_users_created_at` (`created_at`),
    KEY `idx_auth_users_updated_at` (`updated_at`),
    KEY `idx_auth_users_failed_attempts` (`failed_login_attempts`),
    KEY `idx_auth_users_locked_until` (`locked_until`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- SAMPLE DATA FOR USERS TABLE
-- =====================================================

-- Insert default admin user (password: 'admin123')
INSERT INTO `users` (
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
INSERT INTO `users` (
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
    'mike_wilson', 
    'mike@example.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'user', 
    'Mike', 
    'Wilson', 
    1
),
(
    'sarah_jones', 
    'sarah@example.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'user', 
    'Sarah', 
    'Jones', 
    1
),
(
    'test_admin', 
    'testadmin@example.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'admin', 
    'Test', 
    'Admin', 
    1
) ON DUPLICATE KEY UPDATE username=username;

-- =====================================================
-- SAMPLE DATA FOR AUTH_USERS TABLE
-- =====================================================

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

-- =====================================================
-- USEFUL QUERIES FOR TESTING
-- =====================================================

-- View all users
-- SELECT * FROM users ORDER BY created_at DESC;

-- View all auth_users
-- SELECT * FROM auth_users ORDER BY created_at DESC;

-- Count users by role
-- SELECT role, COUNT(*) as count FROM users GROUP BY role;

-- Count auth_users by role
-- SELECT role, COUNT(*) as count FROM auth_users GROUP BY role;

-- =====================================================
-- NOTES
-- =====================================================
-- 
-- Default Login Credentials:
-- Username: admin
-- Email: admin@example.com
-- Password: admin123
-- Role: admin
--
-- All sample users have password: 'admin123'
-- Password hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
--
-- Database: mockdata
-- Character Set: utf8mb4
-- Collation: utf8mb4_unicode_ci
--
-- =====================================================
