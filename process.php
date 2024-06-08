<?php

    session_start();  
    
    require_once 'functions.php';
    
    $Visit = new Visit();
    $message = "";
    
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        
            switch ($action) {
                case 'create':
                    
            // Retrieving all form data
            $exam_date = filter_input(INPUT_POST, 'exam_date', FILTER_SANITIZE_STRING);
            $doctor_visited = filter_input(INPUT_POST, 'doctor_visited', FILTER_SANITIZE_STRING);
            $patient_HN = filter_input(INPUT_POST, 'patient_HN', FILTER_SANITIZE_STRING);
            $patient_full_name = filter_input(INPUT_POST, 'patient_full_name', FILTER_SANITIZE_STRING);
            $exam_item = filter_input(INPUT_POST, 'exam_item', FILTER_SANITIZE_STRING);
            $exam_results = filter_input(INPUT_POST, 'exam_results', FILTER_SANITIZE_STRING);

            // Checking that none of the fields are empty
            if ($exam_date && $doctor_visited && $patient_HN && $patient_full_name && $exam_item && $exam_results) {
                $Visit->create($exam_date, $doctor_visited, $patient_HN, $patient_full_name, $exam_item, $exam_results);
                $message = "Successfully inserted.";
            } else {
                $message = "All fields are required.";
            }
            break;
            
            case 'update':
                $visit_ID = filter_input(INPUT_POST, 'visit_ID', FILTER_SANITIZE_NUMBER_INT);
                $exam_date = filter_input(INPUT_POST, 'exam_date', FILTER_SANITIZE_STRING); 
                $doctor_visited = filter_input(INPUT_POST, 'doctor_visited', FILTER_SANITIZE_STRING);
                $patient_HN = filter_input(INPUT_POST, 'patient_HN', FILTER_SANITIZE_NUMBER_INT); 
                $patient_full_name = filter_input(INPUT_POST, 'patient_full_name', FILTER_SANITIZE_STRING);
                $exam_item = filter_input(INPUT_POST, 'exam_item', FILTER_SANITIZE_STRING);
                $exam_results = filter_input(INPUT_POST, 'exam_results', FILTER_SANITIZE_STRING);
                
                if ($exam_date && $doctor_visited && $patient_HN && $patient_full_name && $exam_item && $exam_results) {
                    $Visit->update($visit_ID, $exam_date, $doctor_visited, $patient_HN, $patient_full_name, $exam_item, $exam_results);
                    $message = "Update was successful!";
                } else {
                    $message = "All fields are required.";
                }
                
                break;
            case 'delete':
                $visit_ID = filter_input(INPUT_POST, 'visit_ID', FILTER_SANITIZE_NUMBER_INT);
                $Visit->delete($visit_ID);
                $message = "Successfully deleted!";
                break;
            case 'queryAll':
                $results = $Visit->readAll();
                $_SESSION['results'] = $results;
                break;
            case 'queryHN':
                $patient_HN = filter_input(INPUT_POST, 'patient_HN', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $results = $Visit->readByHN($patient_HN);
                $_SESSION['results'] = $results;
                break;
            case 'queryId':
                $visit_ID = filter_input(INPUT_POST, 'visit_ID', FILTER_SANITIZE_NUMBER_INT);
                $results = $Visit->readById($visit_ID);
                $_SESSION['results'] = $results;
                break;
            case 'queryHN2':
                $patient_HN = filter_input(INPUT_POST, 'patient_HN', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $results = $Visit->readByHN2($patient_HN);
                $_SESSION['results'] = $results;
                break;
        }
    
        $_SESSION['message'] = $message;
        header('Location: medicalEdit.php');  // Redirecting to medicalEdit.php
        exit();
    }

?>
