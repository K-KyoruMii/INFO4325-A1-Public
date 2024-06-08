-- to run: sudo mysql -u root -p < testDB.sql


-- Create the TestDB database
CREATE DATABASE examData;

-- Use the TestDB database for the subsequent commands
USE examData;

-- Create the patientVisit table
CREATE TABLE patientVisits (
    visit_ID INT AUTO_INCREMENT PRIMARY KEY,
    exam_date DATE,
    doctor_visited VARCHAR(50),
    patient_HN VARCHAR(9),
    patient_full_name VARCHAR(100),
    exam_item VARCHAR(100),
    exam_results TEXT
);

-- grant privleges to the users
GRANT SELECT, INSERT, DELETE, UPDATE
ON patientVisits
TO mgs_user@localhost;