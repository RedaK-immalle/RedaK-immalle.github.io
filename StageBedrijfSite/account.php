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
				<li><a href="./index.php">Blogs</a></li>
				<li><a href="./index.php">About Me</a></li>
				<li><a href="./account.php">Account</a></li>
			</ul>

			<!-- Socials -->
			<ul id="social-nav-buttons">
				<li><img class="social-nav-img" src="Icons/envelope.png"/></li>
				<li><img class="social-nav-img" src="Icons/phone-call.png"/></li>
				<li><img class="social-nav-img" src="Icons/linkedin.png"/></li>
			</ul>
		</nav>
        <main>
            <!-- Login Form -->
            <div class="login-form">
                <h2>Login</h2>
                <form action="account.php" method="post">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    
                    <input type="submit" name="submit" value="Login">
                    <?php 
                    $hash = password_hash("testPass", PASSWORD_DEFAULT);
                    echo password_verify('testPass', $hash)
                    ?>
                </form>
            </div>
            <?php
    
                /* Establishing connection with database */
                $conn = new mysqli("localhost", "root", "Leerling123", "stagebedrijf");
                if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}
    
                if (isset($_POST['submit'])) {
                    $sqlQuery = "SELECT * FROM tblUsers WHERE Username=\"".$_POST['username']."\" AND PasswordHash=\"".password_hash($_POST['password'])."\";";
                    echo $sqlQuery;
                    $sqlResult = $conn->query($sqlQuery);
                }
    
    
                /* Entering data
                if ($sqlResult->num_rows > 0) {
                    while ($row = $sqlResult->fetch_assoc()) {
                        echo "<p>{$row['title']}: {$row['goal']}</p>";
                    }
                } else {
                    echo "<p>Geen data gevonden!</p>";
                }
                */
            ?>
        </main>    
    </body>
</html>
