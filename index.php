<?php

    session_start();
    
    if (!isset($_SESSION["user"])) {
       header("Location: login.php");
       exit();
    }
    
    if ($_SESSION["user_type"] === "patient") {
        header("Location: logout.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amakumo Medical Labs</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="ClinicCSS.css">
    
</head>

<body>
    <div id="container">
	
        <header>
        <h1>Amakumo Medical Labs</h1>
		<h4>Live life like you never lost anything!</h4>
        </header>
       <nav>
	          <br><br>
		      <ul style="list-style-type: none">
		          <li><a href="index.php">Home<br><desc>The website's homepage.</desc></a></li><br>
		          <li><a href="medicalEdit.php">Medical Data<br><desc>Edit Medical Data Here</desc></a></li><br>
		          <li><a href="upload.php">Upload Files<br><desc>Upload Files</desc></a></li><br>
				  <br>
				  <li><a>Logout Below<br><desc>Return to main login page</desc></a></li>
				  <li><a href="logout.php" class="btn btn-warning">Logout</a></li>
			  </ul>
	   </nav>

        <main>
        
		<h2>Welcome!</h2>

        <p>
            At Amakumo Medical Labs, we pride ourselves in being the leading pioneers of bio-engineered prosthetic limbs and medical care. From consulting, to surgery, to checkups and prosthetic maintainence, Amakumo Labs strives to provide you with the highest quality medical care with our team of highly experienced professionals!
			<br><br>
			Do you or a family member require an advanced synthetic prosthetic or a highly advanced medical procedure done at an affordable cost? Amakumo Medical Labs may be the right choice for you!<br><br>
        </p>
		
        <dl>
            
			<dt>Disclaimer</dt>
			<br>
            <dd>
			Amakumo Medical Labs is a <i><b>FICTIONAL</b></i> company/practice that is part of an IP created, owned and copyrighted by Sergio "Kyo" Siu/K-KyoruMii, who has allowed the use of the concept for use of this project. All non-html/mySQL/php story concepts featured in this project may NOT be reused without express written permission from the copyright holder.
			<br><br>
			No medical claims, information or advice that may be featured on this site page are backed by any medical research of any kind and should <i><b>NOT</b></i> be taken as proper medical advice. Please consult with a real, licensed medical professional for that. We are not responsible for any injury caused from disregarding this warning. 
			<br><br>
			Finally, be advised that all contact information on this page is fake. Please do not contact/harass any emails or phone numbers, listed here, as any potential people on the other ends do not have any real life relevance to this project. We of the team do not claim any responsibility for any damages, injury, impairments or the like as a result of following up on any information provided on this site.
			</dd>
</dl>

</main>
<footer>
    <br>
    Copyright © 2023 Amakumo Medical Group<br>
    <a href="mailto:michealmcdoesntexist@gmail.com">
    amakumomedical@gmail.com</a>
  	<br>
    290-262-5866<br>
    15738 Ascher Lane<br>
    V3V 1T5<br>
    Tsutaiyo, NS<br>
</footer>
</div>
</body>
</html>