<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : exec.php
#= Version: 1.9.9h (2006-06-02)
#= Author : Jonathan Beckett
#= Email  : jonbeckett@pluggedout.com
#= Website: http://www.pluggedout.com/index.php?pk=dev_blog
#= Support: http://www.pluggedout.com/development/forums/viewforum.php?f=26
#===========================================================================
#= Copyright (c) 2005 Jonathan Beckett
#= You are free to use and modify this script as long as this header
#= section stays intact. This file is part of PluggedOut Blog.
#=
#= This program is free software; you can redistribute it and/or modify
#= it under the terms of the GNU General Public License as published by
#= the Free Software Foundation; either version 2 of the License, or
#= (at your option) any later version.
#=
#= This program is distributed in the hope that it will be useful,
#= but WITHOUT ANY WARRANTY; without even the implied warranty of
#= MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#= GNU General Public License for more details.
#=
#= You should have received a copy of the GNU General Public License
#= along with CMS files; if not, write to the Free Software
#= Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#===========================================================================
*/

include "lib/config.php";
include "lib/database.php";
include "lib/session.php";
include "lib/misc.php";


// Description : Checks the banned words list
// Returns     : true (comment can go ahead)
//               false (comment should be disregarded)
// Author      : Jonathan Beckett
// Last Change : 2006-04-06
function check_banned_words($text){

	$result = true;
	$banned_words = get_setting("banned_words");
	
	if ($banned_words!=""){	
		$words = explode(",",$banned_words);	
		foreach ($words as $word){
			if (strpos(strtoupper($text),strtoupper($word))!==false){
				$result = false;
			}
		}
	}
	return $result;
}

// Description : Adds a comment to a blog entry and sends email notification
//               if the setting has been made in the admin interface
// Arguments   : entryid - the id of the blog entry
//               name    - the name of the commenter
//               email   - the email address of the commenter
//               url     - the URL of the commenter
//               comment - the text of the comment
// Returns     : Boolean
// Author      : Jonathan Beckett (jonbeckett@pluggeout.com)
// Last Change : 2006-04-02
function comment_add($entryid,$name="",$email="",$url="",$comment="",$verifycode="",$remember=""){

	global $db_prefix;
	
	// only check the verify code if the comment_code setting is switched on
	if (get_setting("comment_code")!=""){
		// codes switched on - check it
		if ($_SESSION["blog_verifycode"] == $verifycode) {
			$code_result = true;
		} else {
			$code_result = false;
		}
	} else {
		// switched off - make it pass
		$code_result = true;
	}
	
	if ($code_result==true && $name!="" && $email!="" && comment!=""){
	
		// check the banned word list (to stop spammers)
		if (check_banned_words($comment)==true){
		
			// if the user ticked the 'remember' box, store their information in cookies
			if ($remember!=""){
				setcookie("pluggedout_blog_name",$name,time()+3600*24*365);
				setcookie("pluggedout_blog_email",$email,time()+3600*24*365);
				setcookie("pluggedout_blog_url",$url,time()+3600*24*365);
			} else {
				// do NOT remember them - if there were cookies, destroy them
				setcookie ("pluggedout_blog_name", "", time() - 3600);
				setcookie ("pluggedout_blog_email", "", time() - 3600);
				setcookie ("pluggedout_blog_url", "", time() - 3600);
			}

			// correct the URL the user entered if they missed the start...
			if ($url!=""){
				if (substr($url,0,4)!="http"){
					$url = "http://".$url;
				}
			}
			
			// if comment verification is switched on, prepend the comment
			// with "pending:"
			if (get_setting("verify_comments")!=""){
				if (substr($comment,0,8)!="pending:"){
					$comment = "pending:".$comment;
				}
			}
			
			$sql = db_sql_comment_add($entryid,$name,$email,$url,$comment);	
			$con = db_connect();
			$result = mysql_query($sql,$con);

			if ($result!=false){

				if (substr($comment,0,8)!="pending:"){
					$sql = db_sql_entry_comments_update($entryid);
					$result = mysql_query($sql,$con);
				} else {
					$result = true;
				}
				
				if ($result!=false){
					$result = true;

					// send an email notification if required
					if (get_setting("notify_comments")!=""){

						// get the admin email address
						$sql = "SELECT cEMail FROM ".$db_prefix."users WHERE cUsername='admin'";
						$result = mysql_query($sql,$con);
						if ($result!=false){
							if (mysql_num_rows($result)>0){
								$row = mysql_fetch_array($result);
								$admin_email = stripslashes($row["cEMail"]);
							}
						} else {
							// problem with SQL
							header("Location: problem.php?f=comment_add&p=sql_error");
						}

						// get the entry author email address and entry title
						$sql = "SELECT ent.cTitle,usr.cEMail FROM ".$db_prefix."users usr"
							." INNER JOIN ".$db_prefix."entries ent ON usr.nUserId=ent.nUserAdded"
							." WHERE ent.nEntryId=".$entryid;
						$result = mysql_query($sql,$con);
						if ($result!=false){
							if (mysql_num_rows($result)>0){
								$row = mysql_fetch_array($result);
								$author_email = stripslashes($row["cEMail"]);
								$entry_title = stripslashes($row["cTitle"]);
							}
						} else {
							// problem with SQL
							header("Location: problem.php?f=comment_add&p=sql_error");
						}

						// only send the email if both email addresses are filled in
						if ($admin_email!="" && $author_email!=""){

							// work out the return URL for the email
							$url = "http://".$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
							$url = preg_replace("/exec.+/","index.php?entryid=".$entryid,$url);

							$admin_url = "http://".$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
							$admin_url = preg_replace("/exec.+/","admin/index.php?action=comment_list",$admin_url);

							// set the from address as the commenter if they filled it in
							if ($email!="") {
								 $from = $email;
							} else {
								 $from = $admin_email;
							} 

							// construct the email data
							$to = $author_email;
							$subject = "PluggedOut Blog Notification : A comment has been written on your entry '".$entry_title."'";
							$body = "Your Blog entry '".$entry_title."' has received a comment.\n\n"
								."=================================================\n\n"
								."Comment...\n"
								.$comment."\n"
								."by ".$name." (".$email.")\n\n"
								."=================================================\n\n"
								."To view the comment in the blog, click on the URL below;\n\n"
								."  ".$url."\n\n"
								."...or go to the comment list at the URL below;\n\n"
								."  ".$admin_url."\n\n"
								."This is a system generated email. Please do not reply to it.\n";

							// construct the email headers
							$headers = "From: \"".$from."\" <".$from.">\n"
								."X-Sender: <".$from.">\n"
								."X-Mailer: PHP\n"
								."X-Priority: 1\n"
								."Return-Path: ".$from.">\n";

							// send the email
							mail($to,$subject,$body,$headers);

						}


					}

					header("Location: index.php?entryid=".$_REQUEST["entryid"]."&result=posted");
					
				} else {
					header("Location: problem.php?f=comment_add&p=sql_error");
				}
			} else {
				header("Location: problem.php?f=comment_add&p=sql_error");
			}

			db_disconnect($con);
	
		}
		
	} else {
		// the verify code did not match or the required fields were not filled
		header("Location: index.php?entryid=".$entryid."&name=".urlencode($name)."&email=".urlencode($email)."&url=".urlencode($url)."&comment=".urlencode($comment)."&result=problem");
		
	}
	
	return $result;	
}


// Handle Calls to this exec library

switch ($_GET["action"]){
	case "comment_add":
		$result = comment_add($_REQUEST["entryid"],$_REQUEST["name"],$_REQUEST["email"],$_REQUEST["url"],$_REQUEST["comment"],$_REQUEST["verifycode"],$_REQUEST["remember"]);
		break;
}



?>