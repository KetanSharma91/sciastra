CREATE DATABASE sciastra;

USE sciastra;

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    discount VARCHAR(50)
);

CREATE TABLE blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    publish_time DATETIME
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    amount DECIMAL(10, 2),
    payment_status VARCHAR(50)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY ,
    username VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255)
);

ALTER TABLE transactions
    ADD FOREIGN KEY (course_id) REFERENCES courses(id);
