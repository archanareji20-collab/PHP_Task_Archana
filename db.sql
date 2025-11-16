-- Create database tables
CREATE DATABASE IF NOT EXISTS event_db;
USE event_db;

CREATE TABLE IF NOT EXISTS events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  event_date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS registrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  event_id INT NOT NULL,
  date_registered DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

-- Sample events
INSERT INTO events (name, description, event_date) VALUES
('Intro to PHP', 'Beginner friendly PHP workshop', '2025-12-01'),
('Web Security Basics', 'Learn web security essentials', '2025-12-10'),
('MySQL Fundamentals', 'Hands-on MySQL session', '2025-12-20');
