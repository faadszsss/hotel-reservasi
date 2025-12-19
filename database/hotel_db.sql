-- Database: hotel_db
CREATE DATABASE IF NOT EXISTS hotel_db;
USE hotel_db;

-- Table users
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('manager') DEFAULT 'manager',
  status ENUM('inactive','active') DEFAULT 'inactive',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  activation_token VARCHAR(100),
  activation_expired DATETIME
);

-- Table rooms
CREATE TABLE IF NOT EXISTS rooms (
  id INT AUTO_INCREMENT PRIMARY KEY,
  room_number VARCHAR(10) NOT NULL,
  room_type ENUM('single','double','suite') NOT NULL,
  price DECIMAL(10,2) NOT NULL
);
