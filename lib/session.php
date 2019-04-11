<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : lib/session.php
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

// Initialise the session
session_start();

// Look for the cookies - populate the session variables if possible
if (isset($_COOKIE["pluggedout_blog"])){

	// retrieve the hashed password from the blog
	$hashed_password = $_COOKIE["pluggedout_blog"];

	// find out which user in the user table has the password
	$con = db_connect();
	$sql = "SELECT nUserId,cUsername FROM ".$db_prefix."users WHERE cPassword='".mysql_escape_string($hashed_password)."'";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$row = mysql_fetch_array($result);
			$_SESSION["blog_userid"] = stripslashes($row["nUserId"]);
			$_SESSION["blog_username"] = stripslashes($row["cUsername"]);
		}
	}
	db_disconnect($con);
	
}

?>