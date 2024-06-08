<?php
    
    /* Connection is used for login data */

    $host = 'localhost';
    $dbusername = 'mgs_user';
    $dbpassword = 'pa55word';
    $dbname = "login_register";

    $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
    
    if (!$conn) {
        die("Something Went Wrong;");
    }

?>