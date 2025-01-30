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
            <!-- Signup Form -->
            <div class="account-form">
                <h2>Maak een account</h2>
                <form action="signup.php" method="post">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" required>
                    
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" required>
                    
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" required>

                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>

                    <input type="submit" name="submit" value="Sign up">
                </form>
            </div>
            <?php
                /* Confirming login */
                $conn = new mysqli("10.30.199.62", "guest", "guestPassword", "stagebedrijf");
                if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}
                if (isset($_POST['submit'])) {
                    $firstName = $_POST['first-name'];
                    $lastName = $_POST['last-name'];
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $sqlQuery = "INSERT INTO tblUsers (FirstName, LastName, Username, PasswordHash, Email, CreatedAt) VALUES (\"".$firstName."\", \"".$lastName."\", \"".$username."\", \"".password_hash($password, PASSWORD_DEFAULT)."\", \"".$email."\", NOW());";
                    $sqlResult = $conn->query($sqlQuery);
                }
            ?>
        </main>    
    </body>
</html>
