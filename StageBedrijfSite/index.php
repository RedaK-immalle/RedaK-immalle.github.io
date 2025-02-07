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
			<a href="index.php" id="logo"><img src="Icons/Alldus-logo.png.webp"></a>
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
		<main style="margin-top: 0px;">
			<img id="background" src="Icons/AlldusBackground.jpg"/>
			<div id="front-page">
				<h1 id='hallo-gebruiker'>Hallo {Voornaam},</h1>
				<h2>Nieuwste Post</h2>
				<?php
				$conn = new mysqli("localhost", "guest", "guestPassword", "stagebedrijf");
				if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}
	
				$stmt = $conn->prepare("SELECT tblposts.PostID, tblusers.UserID, CONCAT(tblusers.FirstName, ' ', tblusers.LastName) AS FullName, tblposts.Title, tblposts.Content, DATE_FORMAT(tblposts.CreatedAt, '%M %e') AS CreatedAt FROM tblposts LEFT JOIN tblusers ON tblposts.UserID = tblusers.UserID ORDER BY tblposts.CreatedAt DESC LIMIT 1;");
				$stmt->execute();
				$sqlResult = $stmt->get_result();
				$row = $sqlResult->fetch_assoc();
				
				echo '
				<div class="featured-blog-post">
					<div class="ex-blog-content-holder">
						<h1 class="ex-blog-title">'.$row['Title'].'</h1>
						<p class="ex-blog-content">'.$row['Content'].'</p>
					</div>
				</div>';
				?>

			</div>
			<form method="POST" action="index.php" class="blog-section">
				<select name="datums" id="blogDatums" onchange="this.form.submit()">
					<option value="all" <?php if(!isset($_SESSION['datums'])) {echo " selected";}?>>All</option>
					<!-- Distinct dates for all the blogs made -->
					<?php
					error_reporting(E_ALL);
					session_start();
					$conn = new mysqli("localhost", "guest", "guestPassword", "stagebedrijf");
					if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}
					
					$sql = $conn->prepare("SELECT DISTINCT(DATE_FORMAT(CreatedAt, '%M %e')) AS Date FROM tblposts ORDER BY DATE_FORMAT(CreatedAt, '%M %e') ASC;");
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
				$conn = new mysqli("localhost", "guest", "guestPassword", "stagebedrijf");
				if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}
				
				
				$query = "SELECT tblposts.PostID, tblusers.UserID, CONCAT(tblusers.FirstName, ' ', tblusers.LastName) AS FullName, tblposts.Title, tblposts.Content, DATE_FORMAT(tblposts.CreatedAt, '%M %e') AS CreatedAt FROM tblposts LEFT JOIN tblusers ON tblposts.UserID = tblusers.UserID";
				if (isset($_SESSION['datums'])) {
					$query .= " WHERE DATE_FORMAT(tblposts.CreatedAt, '%M %e') = ?";
				}
				$query .= " ORDER BY tblposts.CreatedAt DESC";
				$sql = $conn->prepare($query);
				if (isset($_SESSION['datums'])) {
					$sql->bind_param("s", $_SESSION['datums']);
				}

				/* Place Comments */
				if(isset($_POST['placeComment']) && isset($_SESSION['user_id'])) { // Ensure that the user is logged in before inserting new comment //
					$sqlQuery = "INSERT INTO tblcomments (UserID, PostID, Content, CreatedAt) VALUES (?, ?, ?, NOW())";
					$stmt = $conn->prepare($sqlQuery);
					
					$userId = intval($_SESSION['user_id']);
					$postId = intval($_POST['hiddenPostID']);
					$content = htmlspecialchars($_POST['commentText'], ENT_QUOTES, 'UTF-8');
					
					$stmt->bind_param("iis", $userId, $postId, $content);									
					$stmt->execute();
					$stmt->close();				
					header("Location: index.php");
				}
				
				$sql->execute();
				$sqlResult = $sql->get_result();
				$currentPostID = 0;
				if($sqlResult->num_rows > 0) {
					while($row = $sqlResult->fetch_assoc()) {
						echo'
						<div class="blog-post">
							<button class="openBtn" id="btn'.$row['PostID'].'"></button>
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
						<div class="expanded-blog-post" id="ex'.$row['PostID'].'">
							<div class="ex-blog-content-holder">
								<h1 class="ex-blog-title">'.$row['Title'].'</h1>
								<p class="ex-blog-content">'.$row['Content'].'</p>
								<h3 class="ex-blog-subtitle">Comments:</h3>
								<form action="index.php" method="post">
									<input name="commentText">
									<input style="display: none;" name="hiddenPostID" value="'.$row['PostID'].'">
									<button type="submit" name="placeComment">Send</button>
								</form>
									';
								/* Show Comments */
								$stmt = $conn->prepare("SELECT tblusers.Username, tblcomments.Content, CONCAT(LEFT(MONTHNAME(tblcomments.CreatedAt), 3), ' ', DAY(tblcomments.CreatedAt), ' ', TIME(tblcomments.CreatedAt)) AS CreatedAt FROM tblusers INNER JOIN tblcomments ON tblusers.UserID = tblcomments.UserID WHERE tblcomments.PostID = ?");
								$stmt->bind_param("s", $row['PostID']);
								$stmt->execute();
								$sqlResult2 = $stmt->get_result();
								if ($sqlResult2->num_rows > 0) {
									while ($cmtRow = $sqlResult2->fetch_assoc()) {
										echo '
										<div class="comment">
										<div class="comment-header">
											<h3>'.$cmtRow['Username'].'</h3>
											<h4>Posted: '.$cmtRow['CreatedAt'].'</h4>
										</div>
										<p>'.$cmtRow['Content'].'</p>
										</div>
										';
									}
								}
								
								echo '
								</div>
								<!-- Bottom Buttons -->

								<button class="ex-blog-close-btn" id="btnClose'.$row['PostID'].'"><p>Close</p></button>
								';
							if($_SESSION['user_id'] == $row['UserID']) {
								echo '
								<form action="index.php" method="post">
											<input type="submit" name="deletePost'.$row['PostID'].'" value="Delete Post" class="ex-blog-delete-post-btn">
										</form>';
										if(isset($_POST['deletePost'.$row['PostID']])) {
									$query = "DELETE FROM tblposts WHERE PostID = ?";
									$sql = $conn->prepare($query);
									$sql->bind_param("s", $row['PostID']);
									$sql->execute();
									header("Location: index.php");
								}
							}
						echo '</div>';
					}
				}
				
				?>



			<!-- Customize home screen to logged in user -->
			<?php
			$conn = new mysqli("localhost", "guest", "guestPassword", "stagebedrijf");
			if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}

			$stmt = $conn->prepare("SELECT FirstName, LastName, Username FROM tblusers WHERE UserID = ?");
			$stmt->bind_param("s", $_SESSION['user_id']);
			$stmt->execute();
			$sqlResult = $stmt->get_result();
			$row = $sqlResult->fetch_assoc();


			if(isset($_SESSION['user_id'])) {
				echo '
				<script>
					let titelTekst = document.getElementById("hallo-gebruiker");
					titelTekst.innerHTML = "Hallo, '.$row['FirstName'].'";
				</script>';
			}
			?>
			<script>
				// Disable scrolling when service card is active
				const serviceCards = document.querySelectorAll('.expanded-blog-post');

				function updateBodyScroll(hidden) {
					console.log(hidden);
					
					if (hidden) {
						document.body.style.overflowY = 'hidden'; // Disable scrolling
					} else {
						document.body.style.overflowY = 'auto'; // Enable scrolling
					}
				}

				// Monitor changes to classes dynamically (e.g., when toggled by user actions)
				serviceCards.forEach(card => {
					card.addEventListener('class-change', updateBodyScroll); // Custom event example
				});
				<?php
					$conn = new mysqli("localhost", "guest", "guestPassword", "stagebedrijf");
					if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error);}
					$sqlServices = "SELECT PostID FROM tblposts;";
					$serviceResults = $conn->query($sqlServices);
					/* Entering data */
					if ($serviceResults->num_rows > 0) {
						while ($row = $serviceResults->fetch_assoc()) {
							echo "
								const button{$row['PostID']} = document.getElementById('btn{$row['PostID']}');
								const targetDiv{$row['PostID']} = document.getElementById('ex{$row['PostID']}');
								const closeButton{$row['PostID']} = document.getElementById('btnClose{$row['PostID']}');


								closeButton{$row['PostID']}.addEventListener('click', function() {
									targetDiv{$row['PostID']}.classList.add('hide');
									targetDiv{$row['PostID']}.classList.remove('show');
									updateBodyScroll(false);
									setTimeout(() => {
										targetDiv{$row['PostID']}.style.display = 'none';
									}, 150);
								});
								button{$row['PostID']}.addEventListener('click', function() {
									setTimeout(() => {
										targetDiv{$row['PostID']}.classList.add('show');
										targetDiv{$row['PostID']}.classList.remove('hide');
									}, 10);
									targetDiv{$row['PostID']}.style.display = 'block';
									updateBodyScroll(true);
								});
							";
						}
					}
				?>
			</script>
		</main>
    </body>
</html>
