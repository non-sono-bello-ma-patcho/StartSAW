<?php session_start(); ?>
<html>
	<head>
	<title>An error occured</title>
	</head>

	<body bgcolor= "white">
		<div style="position:absolute; top: 5%; bottom: 5%; height:90%; width: 100%; text-align:center;">
            <div style="position:absolute; top:5%; bottom:60%; height:35%; left:20%; right:20%; width:60%">
                <img src="../img/error.png" height="300"><br><br>
            </div>
            <div style="position:absolute; bottom:20%; top:55% height:25%; width:100%;">
			    <label style="font-size:30; color: black;">
				    <?php
					    /*require "databaseUtility.php";*/
					    echo $_SESSION['last_error'];
					    ?>
			    </label>
            </div>
		</div>
	</body>
</html>
