<?php

    session_start();
    
    if (isset($_SESSION["user"])) {
       header("Location: index.php");
       exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Patient Registration Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    
</head>

<body>
    <div class="container">
        
        <?php
        
        if (isset($_POST["patient_submit"])) {
            $patient_fullName = $_POST["patient_fullname"];
            $patient_email = $_POST["patient_email"];
            $patient_password = $_POST["patient_password"];
            $patient_passwordRepeat = $_POST["patient_repeat_password"];
            $patient_healthNumber = $_POST["patient_healthnumber"];

            $errors = array();

            
            // Making Sure Passwords Fufill Requirements
            if (empty($patient_fullName) || empty($patient_email) || empty($patient_password) || empty($patient_passwordRepeat) || empty($patient_healthNumber)) {
                array_push($errors, "Please Fill All Fields");
            }
            if (!filter_var($patient_email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Entered Email is Not Valid");
            }
            if (strlen($patient_password) < 8) {
                array_push($errors, "Password Must Be 8 Characters Long");
            }
            if ($patient_password !== $patient_passwordRepeat) {
                array_push($errors, "Password Doesnt Match");
            }
            if (strlen($patient_healthNumber) < 9) {
                array_push($errors, "Health Number Must Be 9 Characters Long");
            }


            // Connecting to Connections PHP
            require_once "connection.php";

            $sql = "SELECT * FROM patients WHERE email = ?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                die("SQL Error");
            } else {
                mysqli_stmt_bind_param($stmt, "s", $patient_email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $emailCheck = mysqli_stmt_num_rows($stmt);
                if ($emailCheck > 0) {
                    array_push($errors, "Email already exists!");
                }
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO patients (full_name, email, password, healthnumber) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    die("SQL Error");
                } else {
                    mysqli_stmt_bind_param($stmt, "ssss", $patient_fullName, $patient_email, $patient_password, $patient_healthNumber);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You have been successfully registered as a patient!</div>";
                }
            }
        }
        ?>
        
        <form action="patient_registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="patient_fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="patient_email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="patient_password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="patient_repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="patient_healthnumber" maxlength="9" placeholder="Health Number (9 digits):" >
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register as Patient" name="patient_submit">
            </div>
        </form>
        <div>
            <p>Already Registered? <a href="login.php">Login Here</a></p>
        </div>
    </div>
</body>
</html>
