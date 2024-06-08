<?php

    require_once 'connection2.php';
    
    class Visit {
        private $conn;
    
        public function __construct() {
            $database = new Database();
            $this->conn = $database->connect();
        }
    
        public function create($exam_date, $doctor_visited, $patient_HN, $patient_full_name, $exam_item, $exam_results) {
            $query = 'INSERT INTO patientVisits (exam_date, doctor_visited, patient_HN, patient_full_name, exam_item, exam_results) VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$exam_date, $doctor_visited, $patient_HN, $patient_full_name, $exam_item, $exam_results]);
        }
    
        public function readAll() {
            $query = 'SELECT * FROM patientVisits';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function readById($visit_ID) {
            $query = 'SELECT * FROM patientVisits WHERE visit_ID = :visit_ID';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':visit_ID', $visit_ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function readByHN($patient_HN) {
            $query = 'SELECT * FROM patientVisits WHERE patient_HN = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$patient_HN]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function update($visit_ID, $exam_date, $doctor_visited, $patient_HN, $patient_full_name, $exam_item, $exam_results) {
            $query = 'UPDATE patientVisits SET exam_date = ?, doctor_visited = ?, patient_HN = ?, patient_full_name = ?, exam_item = ?, exam_results = ? WHERE visit_ID = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$exam_date, $doctor_visited, $patient_HN, $patient_full_name, $exam_item, $exam_results, $visit_ID]);
        }
    
        public function delete($visit_ID) {
            $query = 'DELETE FROM patientVisits WHERE visit_ID = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$visit_ID]);
        }
    }
?>
