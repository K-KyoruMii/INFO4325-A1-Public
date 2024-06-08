<?php
    
    session_start();
    
    if (isset($_SESSION["user"])) {
       header("Location: index.php");
       exit();
   
    }

    require_once "connection.php";
    
    /* The PHP below handles login (for doctors)
       and patient_login (for Patients)          */

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (isset($_POST["login"])) {
        
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("SQL Error");
            
        } else {
            
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
            
            if ($user) {
                if ($password === $user["password"]) {
                    
                    $_SESSION["user"] = $user["id"];
                    
                    // user_type for session handling
                    $_SESSION["user_type"] = "doctor";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Incorrect password</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Doctor with this email does not exist</div>";
            }
        }
    } elseif (isset($_POST["patient_login"])) {
        
        $patient_email = $_POST["patient_email"];
        $patient_password = $_POST["patient_password"];
        
        $sql = "SELECT * FROM patients WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("SQL Error");
        } else {
            
            mysqli_stmt_bind_param($stmt, "s", $patient_email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
            
            if ($user) {
                
                if ($patient_password === $user["password"]) {
                    
                    $_SESSION["user"] = $user["id"];
                    
                    // user_type for session handling
                    $_SESSION["user_type"] = "patient";
                    header("Location: patient_index.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Incorrect password</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Patient with this email does not exist</div>";
            }
        }
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    
</head>
<body>
    
    <div class="container">
        <h1>Doctor Login:</h1>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div><p>Not Registered Yet? <a href="registration.php">Register Here</a></p></div>
        <br><br>
        
        <h1>Patient Login:</h1>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="patient_email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="patient_password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Patient Login" name="patient_login" class="btn btn-primary">
            </div>
        </form>
        <div><p>Patient Registration: <a href="patient_registration.php">Register Here</a></p></div>
    </div>
    
</body>
</html>
