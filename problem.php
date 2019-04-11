<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : problem.php
#= Version: 1.9.9g (2006-06-02)
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

$html = "<html>\n"
	."<head>\n"
	."<title>PluggedOut Blog - Problem</title>\n"
	."</head>\n"
	."<style>\n"
		."BODY {background-color:#eee;}\n"
		."H1 {font-family:\"Trebuchet MS\",Tahoma,Verdana,Arial,Helvetica;font-size:28px;line-height:30px;font-weight:bold;}\n"
		."P {font-family:Verdana,Arial,Helvetica;font-size:11px;line-height:13px;}\n"
		."TD {font-family:Verdana,Arial,Helvetica;font-size:11px;line-height:13px;}\n"
	."</style>\n"
	."<body>\n"
	."<div style='width:500px;background-color:#fff;border:1px solid #aaa;padding:10px;margin:10px;'>\n"
	."<h1>A Problem Has Occurred</h1>\n";

$html .= "<p>A problem has occurred in the PluggedOut Blog script.</p>\n"
	."<p>File : ".$_SERVER["HTTP_REFERER"]."\n"
	."<br>Function : ".$_REQUEST["f"]."\n"
	."<br>Problem (if specified) : ".$_REQUEST["p"]."\n"
	."</p>\n";
			
// the function usually gets reported back to here as the "f" parameter
switch ($_REQUEST["f"]){
	case "db_connect":
		$html .= "<p>A problem has occurred connecting the the database - this usually means the database connection settings are wrong in the lib/config.php file";
		break;
			
	default:
		$html .= "<p>This problem has no detailed assistance yet.</p>\n";
		break;
}

$html .= "</div>\n"
	."</body>\n"
	."</html>\n";
	

print $html;

?>