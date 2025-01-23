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
				<li><a href="./index.php">Home</a></li>
				<li><a href="./create-post.php">Post</a></li>
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
			<h1 id='hallo-gebruiker'>Hallo {Voornaam},</h1>
			<form method="POST" action="index.php">
				<select name="datums" id="blogDatums" onchange="this.form.submit()">
					<option value="all" <?php if(!isset($_SESSION['datums'])) {echo " selected";}?>>All</option>
					<!-- Distinct dates for all the blogs made -->
					<?php
					$conn = new mysqli("10.87.38.212", "root", "Leerling123", "stagebedrijf");
					if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}
					
					$sql = $conn->prepare("SELECT DISTINCT(DATE_FORMAT(CreatedAt, '%M %e')) AS Date FROM tblPosts ORDER BY DATE_FORMAT(CreatedAt, '%M %e') ASC;");
					$sql->execute();
					$sqlResult = $sql->get_result();
					
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						$selectedOption = $_POST['datums'];
						$_SESSION['datums'] = $selectedOption;
						if($_POST['datums'] === "all") {
							$_SESSION['datums'] = null;
						}
					}

					if($sqlResult->num_rows > 0) {
						while($row = $sqlResult->fetch_assoc()) {
							echo '<option value="'.$row['Date'].'"';
							if($row['Date'] === $_SESSION['datums']) {echo " selected";}
							echo '>'.$row['Date'].'</option>';
						}
					}
					?>
				</select>
			</form>

			<!-- Blog Posts -->
			<?php
				$conn = new mysqli("10.87.38.212", "root", "Leerling123", "stagebedrijf");
				if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}

				$query = "SELECT CONCAT(tblusers.FirstName, ' ', tblusers.LastName) AS FullName, tblposts.Title, tblposts.Content, DATE_FORMAT(tblposts.CreatedAt, '%M %e') AS CreatedAt FROM tblposts LEFT JOIN tblusers ON tblposts.UserID = tblusers.UserID";
				if (isset($_SESSION['datums'])) {
					$query .= " WHERE DATE_FORMAT(tblposts.CreatedAt, '%M %e') = ?";
				}
				$query .= " ORDER BY tblposts.CreatedAt DESC";
				$sql = $conn->prepare($query);
				if (isset($_SESSION['datums'])) {
					$sql->bind_param("s", $_SESSION['datums']);
				}
				$sql->execute();
				$sqlResult = $sql->get_result();
				if($sqlResult->num_rows > 0) {
					while($row = $sqlResult->fetch_assoc()) {
						echo'
							<div class="blog-post">
								<table>
									<tr class="blog-header">
										<td><h2 class="blog-title">'.$row['Title'].'</h2></td>
										<td><p class="blog-writer">'.$row['FullName'].'</p></td>
									</tr>
									<tr>
										<td colspan="2"><p class="blog-content">'.$row['Content'].'</p></td>
									</tr>
									<tr>
										<td></td>
										<td><p class="blog-writer">'.$row['CreatedAt'].'</p></td>
									</tr>
								</table>
							</div>
						';
					}
				}
			
			?>



			<!-- Customize home screen to logged in user -->
			<?php
			error_reporting(E_ALL);
			session_start();
			$conn = new mysqli("10.87.38.212", "root", "Leerling123", "stagebedrijf");
			if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}

			$stmt = $conn->prepare("SELECT FirstName, LastName, Username FROM tblUsers WHERE UserID = ?");
			$stmt->bind_param("s", $_SESSION['user_id']);
			$stmt->execute();
			$sqlResult = $stmt->get_result();
			$row = $sqlResult->fetch_assoc();


			if(isset($_SESSION['user_id'])) {
				echo '<script>
				let titelTekst = document.getElementById("hallo-gebruiker");
				titelTekst.innerHTML = "Hallo, '.$row['FirstName'].'";
				</script>';
			}
			?>
		</main>
    </body>
</html>