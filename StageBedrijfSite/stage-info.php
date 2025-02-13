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

            <h1 id="alldus-title">Alldus International Consulting Ltd</h1>
            <div id="alldus-info">
                <div id="left-side">
                    <h2>Mark Kelly - CEO Alldus International</h2>
                    <div>
                        <img src="https://media.licdn.com/dms/image/v2/D4E03AQHWw2ywo7YcaQ/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1701782347835?e=1744848000&v=beta&t=Rr_SjmKrSAvvbrHdnbqgdZn0qiC3L3vYGlsxdkEqDZM">
                    </div>
                    <h3>
                        The G.E.C., Taylor's Lane<br>
                        Dublin 8<br>
                        D08 ET2R<br>
                        Ireland<br>
                        Call: +353 (01)513 6666<br>
                        Email: info@alldus.com<br>
                    </h3>
                </div>
                <div id="right-side">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4764.221274454734!2d-6.286534623032737!3d53.34127567510256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670d5a845ad825%3A0x5467c3fb93052477!2sThe%20Guinness%20Enterprise%20Centre%20(GEC)!5e0!3m2!1sen!2sbe!4v1739479774258!5m2!1sen!2sbe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                        
                </div>
            </div>
        </main>    
    </body>
</html>
