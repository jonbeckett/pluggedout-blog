<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : lib/themes.php
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

function theme_get_name(){

	global $db_prefix;
	
	$con = db_connect();
	$sql = "SELECT * FROM ".$db_prefix."settings WHERE cName='theme'";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$row = mysql_fetch_array($result);
			if ($row["cValue"]!=""){
				$theme_name = stripslashes($row["cValue"]);
			} else {
				$theme_name = "default";
			}
		} else {
			$theme_name = "default";
		}
	} else {
		// problem with database connection	
		report_problem(1,"theme_get_name ".$sql);
	}

	db_disconnect($con);

	return $theme_name;
}


?>