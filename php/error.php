<?php session_start(); ?>
<html>
	<head>
	<title>An error occured</title>
	</head>

	<body bgcolor= "white">
		<div style="position:absolute; top: 40%; bottom: 30%; height:30%; width: 100%; text-align:center;">
			<label style="font-size:30; color: black;">
				<?php 
					/*require "databaseUtility.php";*/
					echo $_SESSION['last_error'];
					?>
			</label>
		</div>
	</body>
</html>
