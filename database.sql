CREATE DATABASE hangul CHARACTER SET utf8mb4;
USE hangul;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(30) UNIQUE,
 email VARCHAR(120),
 password VARCHAR(255),
 avatar VARCHAR(255),
 xp INT DEFAULT 0,
 level INT DEFAULT 1,
 premium_expire DATETIME,
 banned TINYINT DEFAULT 0,
 role ENUM('user','admin') DEFAULT 'user',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE progress (
 user_id INT,
 symbol VARCHAR(10),
 correct INT DEFAULT 0,
 wrong INT DEFAULT 0,
 PRIMARY KEY(user_id, symbol)
);

CREATE TABLE achievements (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100),
 description TEXT,
 image VARCHAR(255)
);

CREATE TABLE user_achievements (
 user_id INT,
 achievement_id INT,
 earned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(user_id, achievement_id)
);

CREATE TABLE posts (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 content TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comments (
 id INT AUTO_INCREMENT PRIMARY KEY,
 post_id INT,
 user_id INT,
 content TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE coupons (
 code VARCHAR(20) PRIMARY KEY,
 discount INT,
 days INT,
 expire_at DATETIME,
 used TINYINT DEFAULT 0
);
