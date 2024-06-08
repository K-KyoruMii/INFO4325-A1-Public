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
    
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    
</head>

<body>
    <div class="container">
        
        <?php
        if (isset($_POST["submit"])) {
            
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];
            
            
            $errors = array();
            
            // Making Sure Passwords Fill Requirements
            if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
                array_push($errors, "Please Fill All Fields");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Entered Email is Not Valid");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password Must Be 8 Characters Long");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Password Doesnt Match");
            }
        
            // Require connection to connection page
            require_once "connection.php";
            
            // Create Query to fetch email
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            
            // Checking If Email Already Exists
            $emailCheck = mysqli_num_rows($result);
            
            if ($emailCheck > 0) {
                array_push($errors, "Email already exists!");
            }
            
            // Checks If Any Of The Errors are Valid, And Ensures Error Message is Emmited if So
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $password);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You Have Been Sucessfully Registered</div>";
                } else {
                    die("Something went wrong");
                }
            }
        }
        ?>
        
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        <div><p>Already Registered?: <a href="login.php"> Login Here</a></p></div>
      </div>
    </div>
</body>
</html>