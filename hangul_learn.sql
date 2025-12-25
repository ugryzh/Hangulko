SET NAMES utf8mb4;
SET time_zone = '+00:00';

-- =========================
-- BAZA DANYCH
-- =========================
CREATE DATABASE IF NOT EXISTS hangul
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE hangul;

-- =========================
-- USERS
-- =========================
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) UNIQUE NOT NULL,
  email VARCHAR(120) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  avatar VARCHAR(255) DEFAULT NULL,
  xp INT DEFAULT 0,
  level INT DEFAULT 1,
  premium_expire DATETIME DEFAULT NULL,
  role ENUM('user','admin') DEFAULT 'user',
  banned TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =========================
-- PREMIUM PAYMENTS
-- =========================
CREATE TABLE premium_payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  days INT NOT NULL,
  amount DECIMAL(10,2) DEFAULT NULL,
  provider ENUM('paypal','revolut','code') NOT NULL,
  status ENUM('pending','paid','failed') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX(user_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =========================
-- COUPONS
-- =========================
CREATE TABLE coupons (
  code VARCHAR(32) PRIMARY KEY,
  discount_percent INT DEFAULT 0,
  bonus_days INT DEFAULT 0,
  expires_at DATETIME DEFAULT NULL,
  max_uses INT DEFAULT 1,
  used INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =========================
-- PROGRESS (NAUKA)
-- =========================
CREATE TABLE progress (
  user_id INT NOT NULL,
  symbol VARCHAR(10) NOT NULL,
  correct INT DEFAULT 0,
  wrong INT DEFAULT 0,
  PRIMARY KEY (user_id, symbol),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =========================
-- ACHIEVEMENTS
-- =========================
CREATE TABLE achievements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  image VARCHAR(255)
) ENGINE=InnoDB;

CREATE TABLE user_achievements (
  user_id INT NOT NULL,
  achievement_id INT NOT NULL,
  earned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id, achievement_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (achievement_id) REFERENCES achievements(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =========================
-- MICROBLOG
-- =========================
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  post_id INT NOT NULL,
  user_id INT NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =========================
-- ADMIN LOGS
-- =========================
CREATE TABLE admin_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  admin_id INT NOT NULL,
  action TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =========================
-- RANKING (opcjonalnie cache)
-- =========================
CREATE TABLE ranking_cache (
  user_id INT PRIMARY KEY,
  xp INT DEFAULT 0,
  level INT DEFAULT 1,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;
