<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : admin/index.php
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

require "../lib/config.php";
require "../lib/database.php";
require "../lib/session.php";
require "../lib/misc.php";

// include the appropriate language file
if (file_exists("../lang/".$language.".php")){
	require "../lang/".$language.".php";
} else {
	header("Location: problem.php?f=install.php&p=language_file_not_found");
}

require "lib/html.php";

// generate basic admin page
$html = html_page();
$html = str_replace("<!--menu_side-->",html_menu_side(),$html);

if (isset($_SESSION["blog_userid"])){

	// handle calls
	$role = get_user_role($_SESSION["blog_userid"]);

	switch ($_REQUEST["action"]){
		case "entry_add":
			$html_content = html_entry_add();
			break;
		case "entry_list":
			$html_content = html_entry_list();
			break;
		case "entry_view":
			$html_content = html_entry_view($_REQUEST["entryid"]);
			break;
		case "entry_edit":
			$html_content = html_entry_edit($_REQUEST["entryid"]);
			break;
		case "comment_edit":
			$html_content = html_comment_edit($_REQUEST["commentid"]);
			break;
		case "entry_remove":
			$html_content = html_entry_remove($_REQUEST["entryid"]);
			break;
		case "comment_remove":
			$html_content = html_comment_remove($_REQUEST["commentid"]);
			break;
		case "theme_list":
			if ($role=="admin"){
				$html_content = html_themes_list();
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "category_list":
			if ($role == "admin"){
				$html_content = html_category_list();
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "category_add":
			if ($role == "admin"){
				$html_content = html_category_add();
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "category_edit":
			if ($role == "admin"){
				$html_content = html_category_edit($_REQUEST["categoryid"]);
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "category_remove":
			if ($role == "admin"){
				$html_content = html_category_remove($_REQUEST["categoryid"]);
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "user_list":
			if ($role == "admin"){
				$html_content = html_user_list();
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "user_add":
			if ($role == "admin"){
				$html_content = html_user_add();
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "user_edit":
			if ($role == "admin"){
				$html_content = html_user_edit($_REQUEST["userid"]);
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "user_remove":
			if ($role == "admin"){
				$html_content = html_user_remove($_REQUEST["userid"]);
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "settings_edit":
			if ($role == "admin"){
				$html_content = html_settings_edit();
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "file_browse":
			if ($role == "admin"){
				$html_content = html_filebrowse();
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "template_file_list":
			if ($role == "admin"){
				$html_content = html_template_file_list();
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "template_file_edit":
			if ($role == "admin"){
				$html_content = html_template_file_edit();
			} else {
				$html_content = html_forbidden();
			}
			break;
		case "comment_list":
			$html_content = html_comment_list();
			break;
		default:
			$html_content = html_welcome();	
			break;
	}

} else {

	// user is not logged in
	$html_content = html_login();

}

$html = str_replace("<!--content-->",$html_content,$html);


print $html;

?>