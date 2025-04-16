CREATE DATABASE queue_system;

USE queue_system;

CREATE TABLE reasons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reason_id INT NOT NULL,
    created_at DATETIME NOT NULL,
    FOREIGN KEY (reason_id) REFERENCES reasons(id)
);

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    value TEXT NOT NULL
);

INSERT INTO settings (name, value) VALUES ('admin_password', 'default');
