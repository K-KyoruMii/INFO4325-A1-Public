<?php

    session_start();

    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
        exit(); 
    }

    require_once "connection.php"; 

    $patient_HNs = []; 

    if (isset($_SESSION["user"]) && $_SESSION["user_type"] === "patient") {
        
        $userId = $_SESSION["user"]; 
        
        $query = "SELECT healthnumber FROM patients WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $query)) {
            
            mysqli_stmt_bind_param($stmt, "i", $userId); 
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $patient_HNs[] = $row['healthnumber'];
            }
        }
    } else {
        echo "You are not authorized to view this page.";
        exit(); 
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Clinic Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="ClinicCSS.css" rel="stylesheet">
    
</head>
<body>

<main>
    <div class="container mt-5">
        <div class="container">
            <h1>View Your Medical Files</h1>
            <a href="logout.php" class="btn btn-warning">Logout</a>
            <a href="patient_index.php" class="btn btn-primary">Return Home</a>
            <br><br>
        </div>

        <form action="processPatient.php" method="post">
            <div class="form-group">
                <label for="patient_HN">Select Patient HN:</label>
                <select class="form-control" name="patient_HN">

                    <?php foreach ($patient_HNs as $hn) { ?>
                        <option value="<?php echo $hn; ?>"><?php echo $hn; ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- Button for querying by Health Number -->
            <button type="submit" name="action" value="queryHN2" class="btn btn-primary">Query by Health Number</button>
        </form>

        <br>
        <?php
            
            if (isset($_SESSION['results'])) {
                echo "<table class='table table-bordered'>";
                echo "<thead><tr><th>Visit ID</th><th>Exam Date</th><th>Doctor Visited</th><th>Patient HN</th><th>Patient Full Name</th><th>Exam Item</th><th>Exam Results</th></tr></thead>";
                echo "<tbody>";

                foreach ($_SESSION['results'] as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['visit_ID'] . "</td>";
                    echo "<td>" . $row['exam_date'] . "</td>";
                    echo "<td>" . $row['doctor_visited'] . "</td>";
                    echo "<td>" . $row['patient_HN'] . "</td>";
                    echo "<td>" . $row['patient_full_name'] . "</td>";
                    echo "<td>" . $row['exam_item'] . "</td>";
                    echo "<td>" . $row['exam_results'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
                unset($_SESSION['results']);  
            }
        ?>

    </div>
</main>

</body>
</html>
