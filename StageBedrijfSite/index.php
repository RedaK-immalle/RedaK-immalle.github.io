<!DOCTYPE html>
<html lang="nl">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Sarala:wght@400;700&display=swap" rel="stylesheet">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stage bedrijf</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <nav>
			<!-- Main Logo -->
			<div id="logo">Stage Bedrijf</div>
			<!-- Main Buttons -->
			<ul id="main-nav-buttons">
				<li><a href="./index.php">Blogs</a></li>
				<li><a href="./index.php">About Me</a></li>
				<li><a href="./login.php">Account</a></li>
			</ul>

			<!-- Socials -->
			<ul id="social-nav-buttons">
				<li><img class="social-nav-img" src="Icons/envelope.png"/></li>
				<li><img class="social-nav-img" src="Icons/phone-call.png"/></li>
				<li><img class="social-nav-img" src="Icons/linkedin.png"/></li>
			</ul>
		</nav>
		<main>
			<h1 id='titel'>Hallo {Voornaam},</h1>
			<?php
			error_reporting(E_ALL);
			session_start();
			$conn = new mysqli("10.2.2.236", "root", "Leerling123", "stagebedrijf");
			if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}

			$stmt = $conn->prepare("SELECT FirstName, LastName, Username FROM tblUsers WHERE UserID = ?");
			$stmt->bind_param("s", $_SESSION['user_id']);
			$stmt->execute();
			$sqlResult = $stmt->get_result();
			$row = $sqlResult->fetch_assoc();


			if(isset($_SESSION['user_id'])) {
				echo '<script>
				let titelTekst = document.getElementById("titel");
				titelTekst.innerHTML = "Hallo, '.$row['FirstName'].'";
				</script>';
			}
			?>
		</main>
    </body>
</html>