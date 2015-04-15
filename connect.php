<!DOCTYPE html>
<html>
	<head>
		<?php
			if(isset($_GET["sid"])){
				//database calls to generate a custom URI to be handled by the client program go here
				$servername = "localhost";
				//make sure credentials file is hidden in .gitignore .htaccess
				$credentials = fopen("config/db_credentials.txt", "r");
				$username = trim(fgets($credentials));
				$password = trim(fgets($credentials));
				$conn = new mysqli($servername, $username, $password);
				
				if($conn->connect_error) {
					die("Database connection error.");
				}
				
				//header( 'Location: XXXX://' . $uri ) ;
			}
		?>
	</head>
	<body>
	</body>
</html>