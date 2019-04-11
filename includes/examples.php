<?php

function hello_world(){

	return "Hello World - this data comes from a plugin! To prove it, here is the time on the server right now... ".date('l dS \of F Y h:i:s A');
	
}


// Description : Outputs the 10 most recent comments
function recent_comments(){
	
	global $db_prefix;
	
	$html = "<b>Recent Comments</b><br><ul>";
	
	$con = db_connect();
	$sql = "SELECT * FROM ".$db_prefix."comments ORDER BY dAdded DESC";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			while ($row =@ mysql_fetch_array($result)){
				$entryid = $row["nEntryId"];
				$name = stripslashes($row["cName"]);
				$url = stripslashes($row["cURL"]);
				$comment = stripslashes($row["cComment"]);
				$dateadded = $row["dAdded"];
				
				$html .= "<li><a href='index.php?entryid=".$entryid."' style='text-decoration:none;'>".$comment."</a><br>by ".$name." on ".$dateadded."</li>\n";
			}
		} else {
			$html .= "<li>There are no comments to show.</li>\n";
		}
	}
	$html .= "</ul>\n";
	
	return $html;
}

?>