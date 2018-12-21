<?php

require "userUtility.php";

$uploaddir = "/var/www/html/StartSAW/img";
$filename = basename($_FILES['photo']['name']);
$uploadfile = $uploaddir.$filename;


if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
  echo "File is valid, and was successfully uploaded.\n";
  /* chmod($uploadfile,777); TODO   set  it proprierly */
} else {
   echo "Something went wrong: Upload failed";
}

/* salvataggio delle modifiche sul database */
if(($con= database_connection()) === false)
		header("Location: error.php");

else{
	$query = "UPDATE users SET img = \"/imgs/".$filename."\" WHERE username = \"".$_COOKIE['user']."\";";
	$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			header("Location: error.php");
		}
}

?>