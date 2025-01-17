-- Create Database
CREATE DATABASE IF NOT EXISTS bookhevan;

USE bookhevan;

-- Users Table (for storing user info)
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255) UNIQUE NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_name VARCHAR(255) NOT NULL,
    user_role ENUM('reader', 'writer', 'admin') DEFAULT 'reader',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Stories Table (for storing stories)
CREATE TABLE IF NOT EXISTS stories (
    story_id INT AUTO_INCREMENT PRIMARY KEY,
    story_title VARCHAR(255) NOT NULL,
    story_description TEXT,
    story_cover_image VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Story Parts Table (for storing parts of a story)
CREATE TABLE IF NOT EXISTS story_parts (
    part_id INT AUTO_INCREMENT PRIMARY KEY,
    part_title VARCHAR(255) NOT NULL,
    part_content TEXT NOT NULL,
    part_number INT NOT NULL,
    story_id INT,
    FOREIGN KEY (story_id) REFERENCES stories(story_id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Comments Table (for storing comments on story parts)
CREATE TABLE IF NOT EXISTS comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    story_part_id INT,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (story_part_id) REFERENCES story_parts(part_id) ON DELETE CASCADE
);

-- User Login Sessions (for tracking user sessions)
CREATE TABLE IF NOT EXISTS user_sessions (
    session_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    session_token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
CREATE TABLE writers_stories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  author_email VARCHAR(255) NOT NULL,
  date_uploaded TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image_url VARCHAR(255) NOT NULL
);
INSERT INTO images (image_url) VALUES
('/workspaces/web_CSC3132_PROJECT/picture/pexels-lina-1741231.jpg'),
('/workspaces/web_CSC3132_PROJECT/picture/pexels-mark-neal-201020-2954199.jpg'),
('/workspaces/web_CSC3132_PROJECT/picture/pexels-pixabay-256450.jpg'),
('picture/pexels-rodrigo-ortega-2044210904-30213721.jpg'),
('/workspaces/web_CSC3132_PROJECT/picture/pexels-yaroslav-shuraev-5607525.jpg');
