-- ============================================================
-- SHIFAURA Wellness - Database Schema for MariaDB / MySQL (LAMP Stack)
-- Target Server: Endor LAMP / Apache / MariaDB / PHP
-- ============================================================

CREATE DATABASE IF NOT EXISTS `shifaura` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `shifaura`;

-- ------------------------------------------------------------
-- Table structure for `bookings` (Consultation Enquiries)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `preferred_date` VARCHAR(50) NOT NULL,
  `preferred_time` VARCHAR(50) NOT NULL,
  `health_goal` VARCHAR(255) NOT NULL,
  `message` TEXT DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'Pending',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table structure for `purchases` (Diet Package Registrations)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `package_name` VARCHAR(255) NOT NULL,
  `package_duration` VARCHAR(50) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `client_name` VARCHAR(255) NOT NULL,
  `client_email` VARCHAR(255) NOT NULL,
  `client_phone` VARCHAR(50) NOT NULL,
  `client_age` INT(11) NOT NULL,
  `client_gender` VARCHAR(50) NOT NULL,
  `health_conditions` TEXT DEFAULT NULL,
  `payment_status` VARCHAR(50) NOT NULL DEFAULT 'Paid',
  `transaction_id` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table structure for `admins` (Practitioner Accounts)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Seed Default Admin (username: admin | password: Password123)
-- ------------------------------------------------------------
INSERT INTO `admins` (`username`, `password`) 
VALUES ('admin', '$2y$10$wJ.0SgWq6h2m6X1m7v.Oce2313s1238917231231238971239')
ON DUPLICATE KEY UPDATE `username`=`username`;
