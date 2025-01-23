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
            <h1>Maak een post</h1>
            <div class="new-post-form">
                <form action="create-post.php" method="post">
                    <label for="titel">Titel</label>
                    <input type="text" id="titel" name="titel" required>
                    
                    <label for="inhoud">Inhoud</label>
                    <textarea type="text" id="inhoud" name="inhoud" required></textarea>
                    <input type="submit" name="submit" value="Post">
                </form>
            </div>

            <?php
                /* Start Session to see what user is logged in */
                error_reporting(E_ALL);
                session_start();
            
                /* Confirming login */
                $conn = new mysqli("10.87.38.212", "root", "Leerling123", "stagebedrijf");
                if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}

                if(isset($_POST['submit']) && isset($_SESSION['user_id'])) {
                    $sqlQuery = "INSERT INTO tblPosts (UserID, Title, Content, CreatedAt) VALUES (?, ?, ?, NOW())";
                    $stmt = $conn->prepare($sqlQuery);
                    
                    // Bind and sanitize the parameters
                    $userId = intval($_SESSION['user_id']); // Ensure UserID is an integer
                    $title = htmlspecialchars($_POST['titel'], ENT_QUOTES, 'UTF-8'); // Sanitize input to prevent XSS
                    $content = htmlspecialchars($_POST['inhoud'], ENT_QUOTES, 'UTF-8'); // Sanitize input to prevent XSS
                    
                    // Bind the parameters to the prepared statement
                    $stmt->bind_param("iss", $userId, $title, $content);
                    
                    // Execute the prepared statement
                    $stmt->execute();
                    
                    // Close the statement
                    $stmt->close();
                }
            ?>
        </main>    
    </body>
</html>
