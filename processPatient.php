<?php
    session_start();  
    
    require_once 'functions.php';
    
    $Visit = new Visit();
    $message = "";
    
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        
            switch ($action) {

            case 'queryHN2':
                $patient_HN = filter_input(INPUT_POST, 'patient_HN', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $results = $Visit->readByHN($patient_HN);
                $_SESSION['results'] = $results;
                break;

        }
    
        $_SESSION['message'] = $message;
        header('Location: medicalView.php');  
        exit();
    }

?>
