<?php

include "../lib/config.php";
include "../lib/database.php";

if ($reset_admin_password!=""){

	$con = db_connect();

	$username = "admin";
	$password = $reset_admin_password;
	$password = crypt($password,"admin");

	$sql = "UPDATE ".$db_prefix."users SET cPassword='".mysql_escape_string($password)."' WHERE cUsername='admin'";
	
	$result = mysql_query($sql,$con);

	db_disconnect($con);

	if ($result!=false){
		print "<li>Admin password reset successfully - remove the 'reset_admin_password' setting from the config file!</li>\n";
	} else {
		print "<li>Admin password has not been reset. There was a problem with the SQL.</li>\n";
	}
	
} else {

	print "<li>Admin password has not been reset - you must put the new password in a variable called 'reset_admin_password' in the config file.</li>\n";

}

?>