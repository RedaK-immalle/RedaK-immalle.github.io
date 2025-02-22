<?php
    /* Start Session to see what user is logged in */
    error_reporting(E_ALL);
    session_start();
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Sarala:wght@400;700&display=swap" rel="stylesheet">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account</title>
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
				<li><a href="./stage-info.php">Info</a></li>
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
        <img style="overflow-y: hidden;" id="background" src="Icons/AlldusBackground.jpg"/>
        <h1>Maak een post</h1>
            <div class="new-post-form">
                <form action="create-post.php" method="post" class="account-form">
                    <label for="titel">Titel</label>
                    <input type="text" id="titel" name="titel" required>
                    
                    <label for="inhoud">Inhoud</label>
                    <textarea type="text" id="inhoud" name="inhoud" required></textarea>
                    <input type="submit" name="submit" value="Post">
                </form>
            </div>

            <?php            
                /* Confirming login */
                $conn = new mysqli("localhost", "guest", "guestPassword", "stagebedrijf");
                if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}

                if(isset($_POST['submit']) && isset($_SESSION['user_id'])) {
                    $sqlQuery = "INSERT INTO tblposts (UserID, Title, Content, CreatedAt) VALUES (?, ?, '".$_POST['inhoud']."', NOW())";
                    $stmt = $conn->prepare($sqlQuery);
                    
                    // Bind and sanitize the parameters
                    $userId = intval($_SESSION['user_id']); // Ensure UserID is an integer
                    $title = htmlspecialchars($_POST['titel'], ENT_QUOTES, 'UTF-8'); // Sanitize input to prevent XSS
                    
                    // Bind the parameters to the prepared statement
                    $stmt->bind_param("is", $userId, $title);
                    
                    // Execute the prepared statement
                    $stmt->execute();
                    
                    // Close the statement
                    $stmt->close();
                }
            ?>
        </main>    
    </body>
</html>
