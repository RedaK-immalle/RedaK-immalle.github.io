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
            <?php
            error_reporting(E_ALL);
            session_start();
            if(!isset($_SESSION['user_id'])) {
                echo '
                <!-- Login Form -->
                <div class="account-form">
                    <h2>Login</h2>
                    <form method="post">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                        
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        
                        <input type="submit" name="submit" value="Login">
                        <a href="./signup.php">Sign Up</a>
                    </form>
                </div>
                ';
                /* Confirming login */
                $conn = new mysqli("10.87.38.212", "root", "Leerling123", "stagebedrijf");
                if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}
                if (isset($_POST['submit'])) {
                    $stmt = $conn->prepare("SELECT UserID, PasswordHash FROM tblUsers WHERE Username = ?");
                    $stmt->bind_param("s", $_POST['username']);
                    $stmt->execute();
                    $sqlResult = $stmt->get_result();
                    $row = $sqlResult->fetch_assoc();
                    $hash = $row['PasswordHash'];
                    $loggedInUserID = $row['UserID'];
                    $correctLogin = password_verify($_POST['password'], $hash);
                    if ($correctLogin == 1) {
                        $_SESSION['user_id'] = $loggedInUserID;
                        header('Location: login.php');
                    } else {
                        /* Wrong Login */
                        header("Location: login.php");
                    }
                }
            } else {
                $conn = new mysqli("10.87.38.212", "root", "Leerling123", "stagebedrijf");
                if($conn->connect_error) {die("<p>Connection error: " . $conn->connect_error . "</p>");}
                $stmt = $conn->prepare("SELECT * FROM tblUsers WHERE UserID = ?");
                $stmt->bind_param("s", $_SESSION['user_id']);
                $stmt->execute();
                $sqlResult = $stmt->get_result();
                $row = $sqlResult->fetch_assoc();

                if(isset($_POST['submit'])) {
                    $_SESSION['user_id'] = null;
                    header('Location: login.php');
                } else if(isset($_POST['update'])) {
                    if($_POST['password'] != "") {
                        $stmt = $conn->prepare("UPDATE tblUsers SET FirstName = ?, LastName = ?, Username = ?, PasswordHash = ? WHERE UserID = ?");
                        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $stmt->bind_param("sssss", $_POST['firstname'], $_POST['lastname'], $_POST['username'], $hash, $_SESSION['user_id']);
                    } else {
                        $stmt = $conn->prepare("UPDATE tblUsers SET FirstName = ?, LastName = ?, Username = ? WHERE UserID = ?");
                        $stmt->bind_param("ssss", $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_SESSION['user_id']);
                    }
                    $stmt->execute();
                    header('Location: login.php');
                }
                /* Already logged in screen */
                echo '
                <form method="post" class="account-form">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" value="'.$row['FirstName'].'">

                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" value="'.$row['LastName'].'">

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="">
                
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="'.$row['Username'].'">
                    
                    <button type="submit" name="update">Update Profile</button>
                </form>
                <form method="post">
                    <button type="submit" name="submit">Log Out</button>
                </form>
                ';

            }
            ?>
        </main>    
    </body>
</html>
