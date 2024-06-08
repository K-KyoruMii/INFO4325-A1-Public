-- to run: sudo mysql -u root -p < login_register.sql


-- Create the TestDB database
CREATE DATABASE login_register;

-- Use the TestDB database for the subsequent commands
USE login_register;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(128) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(128) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    healthnumber INT(9) NOT NULL
);

-- grant privleges to the users
GRANT SELECT, INSERT, DELETE, UPDATE
ON users
TO mgs_user@localhost;

GRANT SELECT, INSERT, DELETE, UPDATE
ON patients
TO mgs_user@localhost;