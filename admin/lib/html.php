<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : admin/lib/html.php
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


// Description : Provides the default page template for the administration
//               interface - all other chunks get inserted in at the end
//               of this script.
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_page(){
	
	global $lang;

	$version_number = "1.9.9h";
	
	$html = "<html>\n"
		."<head>\n"
		."<title>".$lang["page_title"]." (".$_SERVER["HTTP_HOST"].")</title>\n"
		."<style>\n"
		.".banner_title {font-family:Verdana,Arial,Helvetica;font-size:13px;line-height:22px;font-weight:bold;}\n"
		.".banner_smallprint {font-family:Verdana,Arial,Helvetica;font-size:10px;line-height:12px;font-weight:normal;color:#000;}\n"
		.".menu_top {font-family:Verdana,Arial,Helvetica;font-size:11px;line-height:13px;font-weight:normal;}\n"
		.".menu_side {font-family:Verdana,Arial,Helvetica;font-size:11px;line-height:13px;font-weight:normal;}\n"
		.".menu_user {font-family:Verdana,Arial,Helvetica;font-size:16px;line-height:16px;}\n"
		.".title {font-family:\"Trebuchet MS\",Tahoma,Verdana,Arial,Helvetica;font-size:28px;line-height:30px;font-weight:bold;}\n"
		.".large {font-family:Verdana,Arial,Helvetica;font-size:13px;line-height:15px;}\n"
		.".normal {font-family:Verdana,Arial,Helvetica;font-size:11px;line-height:13px;}\n"
		.".small {font-family:Verdana,Arial,Helvetica;font-size:10px;line-height:12px;}\n"
		.".footer {font-family:Verdana,Arial,Helvetica;font-size:10px;line-height:10px;color:#aaa;}\n"
		."A {color:#0000aa;text-decoration:none;}\n"
		."A:hover {color:#aa0000;text-decoration:underline}\n"
		.".text {font-family:Verdana,Arial,Helvetica;font-size:12px;line-height:16px;}\n"
		."</style>\n"
		."<script src='scripts/menu.js' type='text/javascript'></script>\n"
		."</head>\n"
		."<body style='margin:0px;border:0px;padding:10px;' bgcolor='#eeeeee' text='#000000' onClick='hide_menus();'>\n";
	
	// hidden menu
	$html .= "<div id='menu' style='position:absolute;visibility:hidden;'><!--menu_side--></div>";
	
	// start table holding the page
	$html .= "<table border='0' cellspacing='1' cellpadding='0' width='770' align='center' bgcolor='#aaaaa'><tr><td bgcolor='#ffffff'>\n";
	
	// start containing table for the content
	$html .= "<table border='0' cellspacing='0' cellpadding='0' width='100%'>\n"
		."<tr><td colspan='2'>"
		."<table border='0' cellspacing='0' cellpadding='2' width='100%' bgcolor='#ffffff'>\n"
		."<tr>\n"
		."<td align='left' class='banner_title'>&nbsp;".$lang["banner_title"]." (".$_SERVER["HTTP_HOST"].")</td>\n"
		."<td align='right' class='normal'>";

	// figure out if we are logged in and show the banner appropriately
	if (isset($_SESSION["blog_userid"])){
		$html .= "<table border='0' cellspacing='0' cellpadding='0'><tr>"
			."<td class='normal'>Logged in as '".$_SESSION["blog_username"]."'&nbsp;</td>"
			."<td class='normal'><a href='exec.php?action=user_logout'><img src='images/icon_logout_small.png' width='16' height='16' border='0' title='".$lang["logout"]."'></a></td>"
			."<td class='normal'>&nbsp;<a href='exec.php?action=user_logout'>".$lang["logout"]."</a>&nbsp;</td>"
			."</tr></table>";
	} else {
		$html .= "&nbsp;";
	}
	
	$html .= "</td>\n"
		."</tr>\n"
		."</table>\n"
		."</td></tr>\n";
	
	// dividing line
	$html .= "<tr><td colspan='2' bgcolor='#cccccc'><img src='images/pix1.gif' width='1' height='1'></td></tr>\n";
	
	// version  number
	$html .= "<tr><td colspan='2' bgcolor='#cccccc' background='images/bg.gif'><div style='padding:1px;'>"
		."<table width='100%' border='0' cellspacing='0' cellpadding='1'><tr><td class='banner_smallprint' align='left'>"
		."&nbsp;<b><a href='index.php' onMouseOver='show_menu(this);'>".$lang["main_menu"]."</a></b>"
		."</td><td class='banner_smallprint' align='right'>Version ".$version_number." &copy; <a href='http://www.pluggedout.com/index.php?pk=dev_blog' title='".$lang["visit"]."'>PluggedOut</a>, 2006&nbsp;</td></tr></table>\n"
		."</div></td></tr>\n";
	
	// dividing line
	$html .= "<tr><td colspan='2' bgcolor='#cccccc'><img src='images/pix1.gif' width='1' height='1'></td></tr>\n";
	
	// content row
	$html .= "<tr><td colspan='2' valign='top'><div style='padding:20px;'><!--content--></div></td></tr>\n";

	// gap & copyright
	$html .= "<tr><td colspan='2' class='small' align='center'><br><div style='padding:5px;text-align:center;border-top:1px solid #ccc;'><a href='http://www.pluggedout.com'>Powered by PluggedOut Blog</a> ".$version_number.", &copy; <a href='http://www.pluggedout.com/wiki/wikka.php?wakka=JonathanBeckett'>Jonathan Beckett</a>, 2006, All Rights Reserved</div></td></tr>\n";
		
	// end the containing tables and the page
	$html .= "</table>\n"
		."</td></tr></table>\n"
		."</body>\n"
		."</html>\n";
		
	return $html;
}


// Description : Provides the banner across the top of the admin interface
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_banner(){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2' width='100%' bgcolor='#ffffff'>\n"
		."<tr>\n"
		."<td align='left' class='banner_title'>&nbsp;".$lang["banner_title"]."</td>\n"
		."<td align='right' class='normal'>";

	if (isset($_SESSION["blog_userid"])){
		$html .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td class='normal'><a href='exec.php?action=user_logout'><img src='images/icon_logout_small.png' width='16' height='16' border='0' title='".$lang["logout"]."'></a></td><td class='normal'>&nbsp;<a href='exec.php?action=user_logout'>".$lang["logout"]."</a>&nbsp;</td></tr></table>\n";
	} else {
		$html .= "&nbsp;\n";
	}

	$html .= "</td>\n"
		."</tr>\n"
		."</table>\n";

	return $html;
}


// Description : Provides the menu bar across the top of the admin interface
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_menu_top(){

	global $lang;
	
	$html = "<table width='100%' border='0' cellspacing='0' cellpadding='1'><tr><td class='banner_smallprint' align='left'>&nbsp;".$_SERVER["HTTP_HOST"]."</td><td class='banner_smallprint' align='right'>Version 1.9.9f &copy; <a href='http://www.pluggedout.com/index.php?pk=dev_blog' title='".$lang["visit"]."'>PluggedOut</a>, 2006&nbsp;</td></tr></table>\n";
	return $html;
}


// Description : Provides the menu down the left side of the admin interface
//               Some sections are filtered according to your user role
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_menu_side(){

	global $lang;
	
	if (isset($_SESSION["blog_userid"])){

		$html = "<table border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc' width='150'>\n"
			."<tr><td bgcolor='#ffffff' class='menu_side'>"
			."  <table border='0' cellspacing='0' cellpadding='2'>\n";

		// construct the menu according to the user role setting
		// (admin, author or contributor)
		$role = get_user_role($_SESSION["blog_userid"]);

		$html .= "<tr><td colspan='4' class='normal'><b>".$lang["general"]."</b></td></tr>\n"
			."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_home_small.png' width='16' height='16' title='".$lang["home"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php'>".$lang["home"]."</a></td></tr>\n"
			."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_view_small.png' width='16' height='16' title='".$lang["view_blog"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='../index.php'>".$lang["view_blog"]."</a></td></tr>\n"

			."<tr><td colspan='4' class='small'>&nbsp;</td></tr>\n"
			."<tr><td colspan='4' class='normal'><b>".$lang["entries"]."</b></td></tr>\n"
			."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_entry_small.png' width='16' height='16' title='".$lang["add_entry"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php?action=entry_add'>".$lang["add_entry"]."</a></td></tr>\n"
			."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_entry_small.png' width='16' height='16' title='".$lang["list_entries"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php?action=entry_list'>".$lang["list_entries"]."</a></td></tr>\n"
			."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_entry_small.png' width='16' height='16' title='".$lang["list_comments"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php?action=comment_list'>".$lang["list_comments"]."</a></td></tr>\n";


		// admin only sections
		if ($role=="admin"){

			$html .= "<tr><td colspan='4' class='small'>&nbsp;</td></tr>\n"
				."<tr><td colspan='4' class='normal'><b>".$lang["users"]."</b></td></tr>\n"
				."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_user_small.png' width='16' height='16' title='".$lang["add_user"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php?action=user_add'>".$lang["add_user"]."</a></td></tr>\n"
				."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_users_small.png' width='16' height='16' title='".$lang["list_users"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php?action=user_list'>".$lang["list_users"]."</a></td></tr>\n"

				."<tr><td colspan='4' class='small'>&nbsp;</td></tr>\n"
				."<tr><td colspan='4' class='normal'><b>".$lang["categories"]."</b></td></tr>\n"
				."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_categories_small.png' width='16' height='16' title='".$lang["add_category"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php?action=category_add'>".$lang["add_category"]."</a></td></tr>\n"
				."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_categories_small.png' width='16' height='16' title='".$lang["list_categories"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php?action=category_list'>".$lang["list_categories"]."</a></td></tr>\n"

				."<tr><td colspan='4' class='small'>&nbsp;</td></tr>\n"
				."<tr><td colspan='4' class='normal'><b>".$lang["themes"]."</b></td></tr>\n"
				."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_themes_small.png' width='16' height='16' title='".$lang["theme_list"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php?action=theme_list'>".$lang["theme_list"]."</a></td></tr>\n"

				."<tr><td colspan='4' class='small'>&nbsp;</td></tr>\n"
				."<tr><td colspan='4' class='normal'><b>".$lang["settings"]."</b></td></tr>\n"
				."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_settings_small.png' width='16' height='16' title='".$lang["edit_settings"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php?action=settings_edit'>".$lang["edit_settings"]."</a></td></tr>\n"

				."<tr><td colspan='4' class='small'>&nbsp;</td></tr>\n"
				."<tr><td colspan='4' class='normal'><b>".$lang["files"]."</b></td></tr>\n"
				."<tr><td class='normal'>&nbsp;</td><td><img src='images/icon_files_small.png' width='16' height='16' title='".$lang["browse_files"]."'></td><td class='normal'>&nbsp;</td><td class='normal'><a href='index.php?action=file_browse'>".$lang["browse_files"]."</a></td></tr>\n";

		}
		$html .= "  </table>\n"
			."</td></tr></table>\n";

	} else {

		$html .= "&nbsp;\n";

	}

	return $html;
}


// Description : Provides the home page of the admin interface
//               Some areas are dependent on the user role
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_welcome(){

	global $lang;

	$html = "<div class='title'>".$lang["main_menu"]."</div>\n"
		."<div class='small'>&nbsp;</div>\n"
		."<div class='normal'>".$lang["menu_main_description"]."</div>\n"
		."<div class='small'>&nbsp;</div>\n"
		."<table width='100%' border='0' cellspacing='1' cellpadding='2' bgcolor='#cccccc'>\n"
		."<tr>\n"
		."  <td class='normal' bgcolor='#cccccc' background='images/bg.gif' align='center' width='25%'><b>".$lang["entries"]."</b></td>\n"
		."  <td class='normal' bgcolor='#cccccc' background='images/bg.gif' align='center' width='25%'><b>".$lang["users"]."</b></td>\n"
		."  <td class='normal' bgcolor='#cccccc' background='images/bg.gif' align='center' width='25%'><b>".$lang["categories"]."</b></td>\n"
		."  <td class='normal' bgcolor='#cccccc' background='images/bg.gif' align='center' width='25%'><b>".$lang["misc"]."</b></td>\n"
		."</tr>\n"
		."<tr>\n"
		."  <td class='normal' bgcolor='#ffffff' align='center' width='25%' valign='top'>"
		."    <div class='normal'>&nbsp;</div>\n"
		."    <div class='normal'><a href='index.php?action=entry_add&richedit=x'><img src='images/icon_entry.png' width='48' height='52' border='0' title='".$lang["add_entry"]."'><br>".$lang["add_entry"]."</a></div>\n"
		."    <div class='normal'>&nbsp;</div>\n"
		."    <div class='normal'><a href='index.php?action=entry_list'><img src='images/icon_entry.png' width='48' height='52' border='0' title='".$lang["list_entries"]."'><br>".$lang["list_entries"]."</a></div>\n"
		."    <div class='normal'>&nbsp;</div>\n"
		."    <div class='normal'><a href='index.php?action=comment_list'><img src='images/icon_entry.png' width='48' height='52' border='0' title='".$lang["list_comments"]."'><br>".$lang["list_comments"]."</a></div>\n"
		."    <div class='normal'>&nbsp;</div>\n"
		."  </td>\n";

	if (get_user_role($_SESSION["blog_userid"])=="admin"){
		$html .= "  <td class='normal' bgcolor='#ffffff' align='center' width='25%' valign='top'>"
			."    <div class='normal'>&nbsp;</div>\n"
			."    <div class='normal'><a href='index.php?action=user_add'><img src='images/icon_user.png' width='48' height='48' border='0' title='".$lang["add_user"]."'><br>".$lang["add_user"]."</a></div>\n"
			."    <div class='normal'>&nbsp;</div>\n"
			."    <div class='normal'><a href='index.php?action=user_list'><img src='images/icon_users.png' width='47' height='48' border='0' title='".$lang["list_users"]."'><br>".$lang["list_users"]."</a></div>\n"
			."    <div class='normal'>&nbsp;</div>\n"
			."  </td>\n"
			."  <td class='normal' bgcolor='#ffffff' align='center' width='25%' valign='top'>"
			."    <div class='normal'>&nbsp;</div>\n"
			."    <div class='normal'><a href='index.php?action=category_add'><img src='images/icon_categories.png' width='48' height='48' border='0' title='".$lang["add_category"]."'><br>".$lang["add_category"]."</a></div>\n"
			."    <div class='normal'>&nbsp;</div>\n"
			."    <div class='normal'><a href='index.php?action=category_list'><img src='images/icon_categories.png' width='48' height='48' border='0' title='".$lang["list_categories"]."'><br>".$lang["list_categories"]."</a></div>\n"
			."    <div class='normal'>&nbsp;</div>\n"
			."  </td>\n"
			."  <td class='normal' bgcolor='#ffffff' align='center' width='25%' valign='top'>"
			."    <div class='normal'>&nbsp;</div>\n"
			."    <div class='normal'><a href='index.php?action=theme_list'><img src='images/icon_themes.png' width='48' height='52' border='0' title='".$lang["themes"]."'><br>".$lang["themes"]."</a></div>\n"
			."    <div class='normal'>&nbsp;</div>\n"
			."    <div class='normal'><a href='index.php?action=settings_edit'><img src='images/icon_search.png' width='48' height='47' border='0' title='".$lang["settings"]."'><br>".$lang["settings"]."</a></div>\n"
			."    <div class='normal'>&nbsp;</div>\n"
			."    <div class='normal'><a href='index.php?action=file_browse'><img src='images/icon_files.png' width='48' height='46' border='0' title='".$lang["files"]."'><br>".$lang["files"]."</a></div>\n"
			."    <div class='normal'>&nbsp;</div>\n"
			."  </td>\n"
			."</tr>\n"
			."</table>\n";
	} else {
		$html .= "  <td class='normal' bgcolor='#ffffff' align='center' width='25%' valign='top'>"
			."    <div class='normal'>&nbsp;</div>\n"
			."  </td>\n"
			."  <td class='normal' bgcolor='#ffffff' align='center' width='25%' valign='top'>"
			."    <div class='normal'>&nbsp;</div>\n"
			."  </td>\n"
			."  <td class='normal' bgcolor='#ffffff' align='center' width='25%' valign='top'>"
			."    <div class='normal'>&nbsp;</div>\n"
			."  </td>\n"
			."</tr>\n"
			."</table>\n";
	}
	return $html;
}


// Description : Displays the blog entry list for the administration interface
//               - allows searching, and category filtering
// Arguments   : None (is uses _REQUEST parameters)
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_entry_list(){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_entry.png' width='48' height='52' title='".$lang["entry_list"]."'></td>"
		."  <td class='title'>".$lang["entry_list"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["entry_list_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	global $db_prefix;

	$con = db_connect();

	if (isset($_REQUEST["list_from"])){
		$list_from = $_REQUEST["list_from"];
	} else {
		$list_from = 0;
	}

	// Prepare Status Select
	// (P = Published, U = Unpublished/Unapproved)
	$html_status_select = "<select name='status' class='normal'><option value=''></option>\n";
	if (isset($_REQUEST["status"])){
		switch ($_REQUEST["status"]){
			case "U":
				$status = "U";
				$html_status_select .= "<option value='P'>".$lang["published"]."</option><option value='U' selected>".$lang["unpublished"]."</option>\n";
				break;
			default:
				$status = "P";
				$html_status_select .= "<option value='P' selected>".$lang["published"]."</option><option value='U'>".$lang["unpublished"]."</option>\n";
		}
	} else {
		$status = "P";
		$html_status_select .= "<option value='P' selected>".$lang["published"]."</option><option value='U'>".$lang["unpublished"]."</option>\n";
	}
	$html_status_select .= "</select>\n";

	// prepare category select
	$html_category_select = "<select name='categoryid' class='normal'><option value=''></option>\n";
	$sql = "SELECT * FROM ".$db_prefix."categories ORDER BY cCategoryName";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			while ($row=@mysql_fetch_array($result)){
				if (isset($_REQUEST["categoryid"])){
					if ($_REQUEST["categoryid"]==$row["nCategoryId"]){
						$selected = "selected";
					} else {
						$selected = "";
					}
				}
				$html_category_select .= "<option value='".$row["nCategoryId"]."' ".$selected.">".stripslashes($row["cCategoryName"])."</option>\n";
			}
		} else {
			$html_category_select .= "<option value=''>".$lang["not_found"]."</option>\n";
		}
	} else {
		$html_category_select .= "<option value=''>".$lang["not_found"]."</option>\n";
	}
	$html_category_select .= "</select>\n";

	// work out how we should filter the list
	if (isset($_REQUEST["list_from"])){
		$list_from=$_REQUEST["list_from"];
	} else {
		$list_from = 0;
	}

	$results_per_page = get_setting("results_per_page");

	// construct SQL where clause

	// handle search keywords
	if (isset($_REQUEST["keywords"])){
		$keywords=$_REQUEST["keywords"];
		if ($keywords!=""){
			$a_keywords = explode(" ",$keywords);
			foreach ($a_keywords as $keyword){
				$sql_keywords[] = "(ent.cBody LIKE '%".$keyword."%')";
			}
			$a_sql_where[] = "(".implode(" AND ",$sql_keywords).")";
		}
	}

	// handle status
	if (isset($_REQUEST["status"])){
		$status = $_REQUEST["status"];
		if ($status!=""){
			$a_sql_where[] = "(ent.cStatus='".$status."')";
		}
	}

	// handle category
	if (isset($_REQUEST["categoryid"])){
		$categoryid=$_REQUEST["categoryid"];
		if ($categoryid!=""){
			$a_sql_where[] = "(entcat.nCategoryId=".$categoryid.")";
		}
	}

	// handle month and year
	if (isset($_REQUEST["month"]) && isset($_REQUEST["year"])){
		$month = $_REQUEST["month"];
		$year = $_REQUEST["year"];
		if ($month!="" && $year!=""){
			$a_sql_where[] = "(ent.dAdded>'2001-01-01')";
		}
	}

	// work out user role
	$role = get_user_role($_SESSION["blog_userid"]);

	// handle users that are not admins
	if ($role!="admin"){
		$a_sql_where[] = "(ent.nUserAdded=".$_SESSION["blog_userid"].")";
	}

	// construct the SQL
	if (is_array($a_sql_where)){
		$sql_where_clauses = implode(" AND ",$a_sql_where);
	}
	if ($sql_where_clauses!=""){
		$sql_where = " WHERE ".$sql_where_clauses."\n";
	}


	$con = db_connect();

	// start control output
	$html .= "<form method='POST' action='index.php?action=entry_list'>\n"
		."<input type='hidden' name='list_from' value='".$list_from."'>\n"
		."<table border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='2' class='normal' bgcolor='#cccccc' background='images/bg.gif'><b>".$lang["entry_list"]."</b></td></tr>\n"
		."<tr><td class='normal' bgcolor='#ffffff'>".$lang["keywords"]."</td><td bgcolor='#ffffff'><input type='text' name='keywords' class='text' size='20' value='".$_REQUEST["keywords"]."'></td></tr>\n"
		."<tr><td class='normal' bgcolor='#ffffff'>".$lang["category"]."</td><td bgcolor='#ffffff'>".$html_category_select."</td></tr>\n"
		."<tr><td class='normal' bgcolor='#ffffff'>".$lang["status"]."</td><td bgcolor='#ffffff'>".$html_status_select."</td></tr>\n"
		."<tr><td colspan='2' bgcolor='#ffffff' align='right'><input type='submit' value='".$lang["submit"]."'></td></tr>\n"
		."</table>\n"
		."</form>\n";

	// form actual SQL
	$sql_count = "SELECT DISTINCT ent.nEntryId,ent.nUserAdded,ent.cTitle,ent.dAdded,usr.cUsername,ent.cStatus,ent.nComments"
		." FROM ".$db_prefix."entries ent"
		." INNER JOIN ".$db_prefix."users usr ON ent.nUserAdded=usr.nUserId"
		." LEFT OUTER JOIN ".$db_prefix."entry_categories entcat ON ent.nEntryId=entcat.nEntryId"
		.$sql_where;

	$sql = "SELECT DISTINCT ent.nEntryId,ent.nUserAdded,ent.cTitle,ent.dAdded,usr.cUsername,ent.cStatus,ent.nComments"
		." FROM ".$db_prefix."entries ent"
		." INNER JOIN ".$db_prefix."users usr ON ent.nUserAdded=usr.nUserId"
		." LEFT OUTER JOIN ".$db_prefix."entry_categories entcat ON ent.nEntryId=entcat.nEntryId"
		.$sql_where
		." ORDER BY ent.dAdded DESC"
		." LIMIT ".$list_from.",".$results_per_page;

	$result_count = mysql_query($sql_count,$con);
	$result = mysql_query($sql,$con);

	if ($result!=false){

		$count = mysql_num_rows($result_count);
		$html_pagelinks = $lang["list_result_start"].$count.$lang["list_result_end"];

		if ($count<$list_from){
				$list_from = 0;
		}

		for($i=0;$i<$count;$i+=$results_per_page){
			$start = $i;
			if ($i>=($count-$results_per_page)){
				$start = $i;
				$end = $count-1;
			} else {
				$start = $i;
				$end = $i+$results_per_page-1;
			}
			$html_link = "<a href='index.php?action=entry_list&list_from=".$start."'>".($start+1)." - ".($end+1)."</a>";
			if ($i==$list_from){
				$html_pagelinks .= "<b>".$html_link."</b>&nbsp;";
			} else {
				$html_pagelinks .= $html_link."&nbsp;";
			}
		}

		$html .= "<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
			."<tr><td colspan='6' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["entry_list"]."</b></td></tr>\n"
			."<tr><td colspan='6' bgcolor='#ffffff' class='small'>".$html_pagelinks."</td></tr>\n"
			."<tr>"
			."<td bgcolor='#dddddd' class='normal' background='images/bg.gif'><b>".$lang["dateadded"]."</b></td>"
			."<td bgcolor='#dddddd' class='normal' background='images/bg.gif'><b>".$lang["title"]."</b></td>"
			."<td bgcolor='#dddddd' class='normal' background='images/bg.gif'><b>".$lang["comments"]."</b></td>"
			."<td bgcolor='#dddddd' class='normal' background='images/bg.gif'><b>".$lang["author"]."</b></td>"
			."<td bgcolor='#dddddd' class='normal' background='images/bg.gif'><b>".$lang["status"]."</b></td>"
			."<td bgcolor='#dddddd' class='normal' background='images/bg.gif'><b>".$lang["controls"]."</b></td>"
			."</tr>\n";

		if (mysql_num_rows($result)>0){

			while ($row=@mysql_fetch_array($result)){

				$html .= "<tr>"
					."<td bgcolor='#ffffff' class='normal'>".$row["dAdded"]."</td>"
					."<td bgcolor='#ffffff' class='normal'><a href='index.php?action=entry_edit&entryid=".$row["nEntryId"]."' title='".$lang["edit"]."'>".stripslashes($row["cTitle"])."</a></td>"
					."<td bgcolor='#ffffff' class='normal'><a href='index.php?action=entry_view&entryid=".$row["nEntryId"]."' title='".$lang["view"]."'>".$row["nComments"]."</a> (<a href='index.php?action=entry_view&entryid=".$row["nEntryId"]."' title='".$lang["view"]."'>".$lang["view"]."</a>)</td>"
					."<td bgcolor='#ffffff' class='normal'>".stripslashes($row["cUsername"])."</td>"
					."<td bgcolor='#ffffff' class='normal'>".stripslashes($row["cStatus"])."</td>"
					."<td bgcolor='#ffffff' class='normal'>";

				$html_edit = "&nbsp;<a href='index.php?action=entry_edit&entryid=".$row["nEntryId"]."' title='".$lang["edit"]."'>".$lang["edit"]."</a>";
				$html_remove = "&nbsp;<a href='index.php?action=entry_remove&entryid=".$row["nEntryId"]."' title='".$lang["remove"]."'>".$lang["remove"]."</a>";
				$html_publish = "&nbsp;<a href='exec.php?action=entry_publish&entryid=".$row["nEntryId"]."' title='".$lang["publish"]."'>".$lang["publish"]."</a>";
				$html_unpublish = "&nbsp;<a href='exec.php?action=entry_unpublish&entryid=".$row["nEntryId"]."' title='".$lang["unpublish"]."'>".$lang["unpublish"]."</a>";

				switch ($role){

					case "admin":

						// we are admin - we can do anything - including publish/unpublish
						if ($row["cStatus"]=="P"){
							// show unpublish button
							$html .= $html_unpublish;
						} else {
							// show publish button
							$html .= $html_publish;
						}
						$html .= $html_edit;
						$html .= $html_remove;
						break;

					case "author":

						// we are an author - we can publish our own work
						//                  - we can edit our own work
						//                  - we can remove our own work
						if ($row["nUserAdded"]==$_SESSION["blog_userid"]){

							if ($row["cStatus"]=="P"){
								// show unpublish button
								$html .= $html_unpublish;
							} else {
								// show publish button
								$html .= $html_publish;
							}
							// show the edit and remove buttons
							$html .= $html_edit;
							$html .= $html_remove;

						}
						break;

					case "contributor":

						// we are a contributor - we can add entries as unpublished
						//                      - we can edit unpublished work we wrote
						//                      - we can remove unpublished work we wrote
						if ($row["nUserAdded"]==$_SESSION["blog_userid"]){

							if ($row["cStatus"]=="U"){
								// show edit and remove buttons
								$html .= $html_edit;
								$html .= $html_remove;
							}

						}
						break;


				}

				$html .= "</td>"
					."</tr>\n";
			}
		} else {
			$html .= "<tr><td colspan='6' bgcolor='#ffffff' class='normal' align='center'>".$lang["no_entries_returned"]."</td></tr>\n";
		}

		$html .= "</table>\n";

	} else {
		//report_problem(1,"html_entry_list ".$sql);
		print $sql;
	}

	db_disconnect($con);

	return $html;
}



// Description : Provides the comment list screen
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-05-25
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_comment_list(){

	global $lang;
	global $db_prefix;

	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_entry.png' width='48' height='52' title='".$lang["comment_list"]."'></td>"
		."  <td class='title'>".$lang["comment_list"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["comment_list_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	$con = db_connect();
	
	// construct SQL (remembering to take note of the user authentication level
	// - admins can approve / reject / remove any comment
	// - authors can see / approve / reject / remove comments on their own story
	// - contributors can only see comments on their own story (not interact with them)
	
	$role = get_user_role($_SESSION["blog_userid"]);
	switch ($role){
		case "admin":
			$where_clause = "";
			break;
		case "author":
			$where_clause = " WHERE e.nUserAdded=".$_SESSION["blog_userid"];
			break;
		case "contributor":
			$where_clause = " WHERE e.nUserAdded=".$_SESSION["blog_userid"];
			break;
	}
	
	// work out how we should filter the list
	$results_per_page = get_setting("results_per_page");
	if (isset($_REQUEST["list_from"])){
		$list_from=$_REQUEST["list_from"];
	} else {
		$list_from = 0;
	}

	// find out how many comments there are in total
	$sql = "SELECT *"
		." FROM ".$db_prefix."comments c"
		." INNER JOIN ".$db_prefix."entries e ON c.nEntryId=e.nEntryId"
		.$where_clause;
	$result = mysql_query($sql,$con);
	if ($result!=false){
		$count = mysql_num_rows($result);
	}
	
	// do the shortened query for display
	$sql = "SELECT *"
		." FROM ".$db_prefix."comments c"
		." INNER JOIN ".$db_prefix."entries e ON c.nEntryId=e.nEntryId"
		.$where_clause
		." ORDER BY c.dAdded DESC"
		." LIMIT ".$list_from.",".$results_per_page;
	
	$result = mysql_query($sql,$con);
	if ($result!=false){
		
		$html .= "<form method='POST' action='exec.php?action=verify_comments'>\n"
			."<table border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc' width='100%'>\n"
			."<tr><td bgcolor='#cccccc' background='images/bg.gif' class='normal' colspan='4'><b>".$lang["comment_list"]."</b></td>\n";
			
		if (mysql_num_rows($result)>0){

			// use the record count to put the paging controls in place
			$html .= "<tr><td colspan='4' bgcolor='#ffffff' class='normal'>";
			for($i=0;$i<$count;$i+=$results_per_page){
				$start = $i;
				if ($i>=($count-$results_per_page)){
					$start = $i;
					$end = $count-1;
				} else {
					$start = $i;
					$end = $i+$results_per_page-1;
				}
				$html_link = "<a href='index.php?action=comment_list&list_from=".$start."'>".($start+1)." - ".($end+1)."</a>";
				if ($i==$list_from){
					$html_pagelinks .= "<b>".$html_link."</b>&nbsp;";
				} else {
					$html_pagelinks .= $html_link."&nbsp;";
				}
			}
			$html .= $html_pagelinks;
			$html .= "</td></tr>\n";

			// put the column headers in place
			$html .= "<tr>"
				."<td bgcolor='#dddddd' class='normal'>".$lang["comment"]."</td>"
				."<td bgcolor='#dddddd' class='normal' width='50' align='center'>".$lang["approve"]."</td>"
				."<td bgcolor='#dddddd' class='normal' width='50' align='center'>".$lang["reject"]."</td>"
				."<td bgcolor='#dddddd' class='normal' width='50' align='center'>".$lang["remove"]."</td>"
				."</tr>\n";
			
			while ($row =@ mysql_fetch_array($result)){
				
				$commentid = $row["nCommentId"];
				$body = nl2br(htmlspecialchars(stripslashes($row["cComment"]),ENT_QUOTES));
				$title = stripslashes($row["cTitle"]);
				$entryid = $row["nEntryId"];
				$name = stripslashes($row["cName"]);
				$email = stripslashes($row["cEMail"]);
				$url = $row["cURL"]!="" ? " (<a href='".stripslashes($row["cURL"])."'>".$lang["url"]."</a>)" : "";
				
				// controls
				$approve_checkbox = "";
				$reject_checkbox = "";
				if ($role!="contributor"){
					// work out if we need an approve button
					if (substr($body,0,8)=="pending:"){
						$approve_checkbox = "<input type='radio' name='verify_".$commentid."' value='approve' checked>";
						$reject_checkbox = "<input type='radio' name='verify_".$commentid."' value='reject'>";
					}
					$remove_checkbox = "<input type='checkbox' name='remove_".$commentid."' value='x'>";					
				}
				
				if (substr($body,0,8)=="pending:"){
					$bgcolor = "#eeeeee";
					$body = str_replace("pending:","",$body);
				} else {
					$bgcolor = "#ffffff";
				}
				
				$html .= "<tr><td class='normal' bgcolor='".$bgcolor."'>".$body."<br><i>".$lang["by"]." <a href='mailto:".$email."'>".$name."</a>".$url." | <a href='index.php?action=entry_view&entryid=".$entryid."'>".$title."</a> | ".$row["dAdded"]." | <a href='index.php?action=comment_edit&commentid=".$commentid."'>".$lang["edit"]."</a></i></td>"
					."<td class='normal' bgcolor='".$bgcolor."' align='center'>".$approve_checkbox."</td>"
					."<td class='normal' bgcolor='".$bgcolor."' align='center'>".$reject_checkbox."</td>"
					."<td class='normal' bgcolor='".$bgcolor."' align='center'>".$remove_checkbox."</td>"
					."</tr>\n";
			}
			
			// put the submit buttons in place
			if ($role!="contributor"){
				$html .= "<tr><td colspan='4' align='right' bgcolor='#ffffff'><input type='submit' class='text' value='".$lang["submit"]."'></td></tr>\n";
			}
			
		} else {
			$html .= "<tr><td bgcolor='#ffffff' class='normal' align='center'>".$lang["no_entries_returned"]."</td></tr>\n";
		}
		
		$html .= "</table>\n</form>\n";
		
	} else {
		// problem with sql
		report_problem(1,"html_comment_list ".$sql);
	}
		
	return $html;
	
}

// Description : Shows the form to add a blog entry
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_entry_add(){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_entry.png' width='48' height='52' title='".$lang["add_entry"]."'></td>"
		."  <td class='title'>".$lang["add_entry"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["entry_add_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	global $db_prefix;


	$con = db_connect();

	// build categorylist checkboxes
	$sql = "SELECT * FROM ".$db_prefix."categories ORDER BY cCategoryName";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		$cat_count = mysql_num_rows($result);
		if ($cat_count>0){
			$html_categories = "<div class='normal' style='overflow:auto; height:150px;'>\n";
			while ($row =@ mysql_fetch_array($result)){
				$html_categories .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td><input type='checkbox' name='cat".$row["nCategoryId"]."' value='x'></td><td class='normal'>".stripslashes($row["cCategoryName"])."</td></tr></table>\n";
			}
			$html_categories .= "</div>\n";
		} else {
			$html_categories = "<span class='normal'>".$lang["no_categories_defined"]."</span>";
		}
	} else {
		report_problem(1,"html_entry_add ".$sql);
	}

	db_disconnect($con);

	// use our role to determine the published status
	$role = get_user_role($_SESSION["blog_userid"]);
	if ($role!="contributor"){
		$html_publish = "<select name='status' class='text'><option value='P'>".$lang["published"]."</option><option value='U'>".$lang["unpublished"]."</option></select>\n";
	} else {
		$html_publish = "<span class='normal'>".$lang["unpublished"]." (".$lang["contributor"].")</span>";
	}

	$html .= "<form method='POST' action='exec.php?action=entry_add'>\n"
		."<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc' width='100%'>\n"
		."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["add_entry"]."</b></td></tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["title"]."</td><td bgcolor='#ffffff'><input type='text' name='title' size='60' class='text'></td>"
		."</tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["date"]."</td><td bgcolor='#ffffff'><input type='text' name='dateadded' size='30' class='text' value='".date("Y-m-d H:i:s")."'></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["status"]."</td><td bgcolor='#ffffff'>".$html_publish."</td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["body"]."</td><td bgcolor='#ffffff'><textarea name='body' id='body' cols='100' rows='15' class='text'></textarea></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal' valign='top'>".$lang["categories"]."</td><td bgcolor='#ffffff'><input type='hidden' name='catcount' value='".$cat_count."'>".$html_categories."</td></tr>\n"
		."<tr><td colspan='2' bgcolor='#ffffff' class='normal' align='right'><input type='submit' value='".$lang["add_entry"]."'></td></tr>\n"
		."</table>\n"
		."</form>\n";

	return $html;
}


// Description : Provides the entry editing form
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_entry_edit($entryid){

	global $lang;
	global $db_prefix;

	$con = db_connect();

	// get the existing entry
	$sql = "SELECT * FROM ".$db_prefix."entries WHERE nEntryId=".$entryid;
	$entry_result = mysql_query($sql,$con);
	if ($entry_result!=false){
		if (mysql_num_rows($entry_result)>0){
			$entry_row = mysql_fetch_array($entry_result);
		} else {
			// could not find entry
		}
	} else {
		// problem with sql
	}

	// get the existing categories the entry is filed against
	$sql = "SELECT * FROM ".$db_prefix."entry_categories WHERE nEntryId=".$entryid;
	$entcat_result = mysql_query($sql,$con);
	if ($entcat_result!=false){
		if (mysql_num_rows($entcat_result)>0){
			while ($entcat_row=@mysql_fetch_array($entcat_result)){
				$a_entry_categories[$entcat_row["nCategoryId"]]="x";
			}
		}
	} else {
		// problem with sql
	}

	// build categorylist checkboxes for the editing form
	$sql = "SELECT * FROM ".$db_prefix."categories ORDER BY cCategoryName";
	$cat_result = mysql_query($sql,$con);
	if ($cat_result!=false){
		$cat_count = mysql_num_rows($cat_result);
		if ($cat_count>0){
			$html_categories = "<div style='overflow:auto;height:150px;'>\n";
			while ($cat_row =@ mysql_fetch_array($cat_result)){
				// hilight the category if it is chosen in the entry_categories array we have already built
				if ($a_entry_categories[$cat_row["nCategoryId"]]!=""){
					$checked = "checked";
				} else {
					$checked = "";
				}
				$html_categories .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td><input type='checkbox' name='cat".$cat_row["nCategoryId"]."' value='x' ".$checked."></td><td class='normal'>".stripslashes($cat_row["cCategoryName"])."</td></tr></table>\n";
			}
			$html_categories .= "</div>\n";
		} else {
			$html_categories = "<span class='normal'>".$lang["no_categories_defined"]."</span>";
		}
	} else {
		report_problem(1,"html_entry_edit ".$sql);
	}

	db_disconnect($con);

	// work out what role we are to set the publish field, and use the entry_row to default it
	// (apart from contributor status, where changes cause unpublishing)
	$role = get_user_role($_SESSION["blog_userid"]);
	if ($entry_row["cStatus"]=="P"){
		$select_published = "selected";
		$select_unpublished = "";
	} else {
		$select_published = "";
		$select_unpublished = "selected";
	}
	if ($role!="contributor"){
		$html_publish = "<select name='status' class='text'><option value='P' ".$select_published.">".$lang["published"]."</option><option value='U' ".$select_unpublished.">".$lang["unpublished"]."</option></select>\n";
	} else {
		$html_publish = "<span class='normal'>".$lang["unpublished"]." (".$lang["contributor"].")</span>";
	}

	// build the html entry editing form
	$role = get_user_role($_SESSION["blog_userid"]);
	if ($_SESSION["blog_userid"]==$entry_row["nUserAdded"] || $role == "admin"){

		$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
			."<tr>"
			."  <td rowspan='2'><img src='images/icon_entry.png' width='48' height='52' title='".$lang["edit_entry"]."'></td>"
			."  <td class='title'>".$lang["edit_entry"]."</div>\n"
			."</tr><tr>"
			."  <td class='normal'>".$lang["entry_edit_description"]."</td>\n"
			."</tr>\n"
			."</table>\n"
			."<br>\n";

		$body = $entry_row["cBody"];

		$html .= "<form method='POST' action='exec.php?action=entry_edit'>\n"
			."<input type='hidden' name='entryid' value='".$entry_row["nEntryId"]."'>\n"
			."<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc' width='100%'>\n"
			."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["edit_entry"]."</b></td></tr>\n"
			."<tr>"
			."<td bgcolor='#ffffff' class='normal'>".$lang["title"]."</td><td bgcolor='#ffffff'><input type='text' name='title' size='60' class='text' value='".htmlspecialchars(stripslashes($entry_row["cTitle"]),ENT_QUOTES)."'></td>"
			."</tr>\n"
			."<tr><td bgcolor='#ffffff' class='normal'>".$lang["date"]."</td><td bgcolor='#ffffff'><input type='text' name='dateadded' size='30' class='text' value='".stripslashes($entry_row["dAdded"])."'></td></tr>\n"
			."<tr><td bgcolor='#ffffff' class='normal'>".$lang["status"]."</td><td bgcolor='#ffffff'>".$html_publish."</td></tr>\n"
			."<tr><td bgcolor='#ffffff' class='normal'>".$lang["body"]."</td><td bgcolor='#ffffff'><textarea name='body' id='body' cols='100' rows='15' class='text'>".htmlspecialchars(stripslashes($body))."</textarea></td></tr>\n"
			."<tr><td bgcolor='#ffffff' class='normal' valign='top'>".$lang["categories"]."</td><td bgcolor='#ffffff'><input type='hidden' name='catcount' value='".$cat_count."'>".$html_categories."</td></tr>"
			."<tr><td colspan='2' bgcolor='#ffffff' class='normal' align='right'><input type='submit' value='".$lang["make_changes"]."'></td></tr>\n"
			."</table>\n"
			."</form>\n";

	} else {

		$html .= html_forbidden();

	}

	return $html;
}


// Description : Provides the entry removal form
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_entry_remove($entryid){

	global $lang;
	global $db_prefix;

	$con = db_connect();

	// get the existing entry
	$sql = "SELECT * FROM ".$db_prefix."entries WHERE nEntryId=".$entryid;
	$entry_result = mysql_query($sql,$con);
	if ($entry_result!=false){
		if (mysql_num_rows($entry_result)>0){
			$entry_row = mysql_fetch_array($entry_result);
		} else {
			// could not find entry
		}
	} else {
		// problem with sql
	}

	// get the existing categories the entry is filed against
	$sql = "SELECT entcat.nCategoryId,cat.cCategoryName FROM ".$db_prefix."entry_categories entcat"
		." INNER JOIN ".$db_prefix."categories cat ON entcat.nCategoryId=cat.nCategoryId"
		." WHERE entcat.nEntryId=".$entryid;

	$entcat_result = mysql_query($sql,$con);
	if ($entcat_result!=false){
		if (mysql_num_rows($entcat_result)>0){
			while ($entcat_row=@mysql_fetch_array($entcat_result)){
				$html_catlist .= stripslashes($entcat_row["cCategoryName"])."&nbsp;";
			}
		} else {
			$html_catlist = $lang["not_filed_against_categories"];
		}
	} else {
		// problem with sql
		report_problem(1,"html_entry_remove ".$sql);
	}

	db_disconnect($con);

	// build the html entry editing form

	$role = get_user_role($_SESSION["blog_userid"]);

	if (($_SESSION["blog_userid"]==$entry_row["nUserAdded"] && $role!="contributor") || $role=="admin"){

		$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
			."<tr>"
			."  <td rowspan='2'><img src='images/icon_entry.png' width='48' height='52' title='".$lang["remove_entry"]."'></td>"
			."  <td class='title'>".$lang["remove_entry"]."</div>\n"
			."</tr><tr>"
			."  <td class='normal'>".$lang["entry_remove_description"]."</td>\n"
			."</tr>\n"
			."</table>\n"
			."<br>\n";


		$html .= "<form method='POST' action='exec.php?action=entry_remove'>\n"
			."<input type='hidden' name='entryid' value='".$entry_row["nEntryId"]."'>\n"
			."<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
			."<tr><td colspan='3' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["remove_entry"]."</b></td></tr>\n"
			."<tr><td bgcolor='#ffffff' class='normal'>".$lang["title"]."</td><td bgcolor='#ffffff' class='normal'>".stripslashes($entry_row["cTitle"])."</td></tr>\n"
			."<tr><td bgcolor='#ffffff' class='normal'>".$lang["date_added"]."</td><td bgcolor='#ffffff' class='normal'>".stripslashes($entry_row["dAdded"])."</td></tr>\n"
			."<tr><td bgcolor='#ffffff' class='normal'>".$lang["categories"]."</td><td bgcolor='#ffffff' class='normal'>".$html_catlist."</td></tr>\n"
			."<tr><td bgcolor='#ffffff' class='normal'>".$lang["body"]."</td><td bgcolor='#ffffff' class='normal'>".nl2br(htmlspecialchars(stripslashes($entry_row["cBody"])))."</td></tr>\n"
			."<tr><td colspan='3' bgcolor='#ffffff' class='normal' align='right'><input type='submit' value='".$lang["remove_entry"]."'></td></tr>\n"
			."</form>\n";

	} else {

		$html .= html_forbidden();

	}
	return $html;
}


// Description : Provides the entry view form
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_entry_view($entryid){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_entry.png' width='48' height='52' title='".$lang["view_entry"]."'></td>"
		."  <td class='title'>".$lang["view_entry"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["entry_view_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	global $db_prefix;

	$con = db_connect();

	// get the existing entry
	$sql = "SELECT * FROM ".$db_prefix."entries WHERE nEntryId=".$entryid;
	$entry_result = mysql_query($sql,$con);
	if ($entry_result!=false){
		if (mysql_num_rows($entry_result)>0){
			$entry_row = mysql_fetch_array($entry_result);
		} else {
			// could not find entry
		}
	} else {
		// problem with sql
	}

	// get the existing categories the entry is filed against
	$sql = "SELECT entcat.nCategoryId,cat.cCategoryName FROM ".$db_prefix."entry_categories entcat"
		." INNER JOIN ".$db_prefix."categories cat ON entcat.nCategoryId=cat.nCategoryId"
		." WHERE entcat.nEntryId=".$entryid;

	$entcat_result = mysql_query($sql,$con);
	if ($entcat_result!=false){
		if (mysql_num_rows($entcat_result)>0){
			while ($entcat_row=@mysql_fetch_array($entcat_result)){
				$html_catlist .= stripslashes($entcat_row["cCategoryName"])."&nbsp;";
			}
		} else {
			$html_catlist = $lang["not_filed_against_categories"];
		}
	} else {
		// problem with sql
		report_problem(1,"html_entry_remove ".$sql);
	}

	// show the entry
	$html .= "<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='4' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["view_entry"]."</b></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["title"]."</td><td bgcolor='#ffffff' class='normal'>".stripslashes($entry_row["cTitle"])."</td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["date"]."</td><td bgcolor='#ffffff' class='normal'>".stripslashes($entry_row["dAdded"])."</td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["categories"]."</td><td bgcolor='#ffffff' class='normal'>".$html_catlist."</td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["body"]."</td><td bgcolor='#ffffff' class='normal'>".nl2br(htmlspecialchars(stripslashes($entry_row["cBody"])))."</td></tr>\n"
		."<tr><td colspan='4' bgcolor='#cccccc' class='normal'><b>".$lang["comments"]."</b></td></tr>\n";

	$sql = "SELECT * FROM ".$db_prefix."comments WHERE nEntryId=".$entryid." ORDER BY dAdded";
	$comment_result = mysql_query($sql,$con);
	if ($comment_result!=false){
		if (mysql_num_rows($comment_result)>0){
			$html .= "<tr><td colspan='4' bgcolor='#ffffff' class='normal'>\n"
				."<table border='0' cellspacing='1' cellpadding='3' width='100%' bgcolor='#cccccc'>\n";
			while ($comment_row =@ mysql_fetch_array($comment_result)){
				$comment = htmlspecialchars(stripslashes($comment_row["cComment"]));
				$name = htmlspecialchars(stripslashes($comment_row["cName"]));
				if ($comment_row["cEMail"]!=""){
					$email = "(<a href='mailto:".htmlspecialchars(stripslashes($comment_row["cEMail"]))."'>".$lang["email"]."</a>)&nbsp;";
				} else {
					$email = "&nbsp;";
				}
				if ($comment_row["cURL"]!=""){
					$url = "(<a href='".htmlspecialchars(stripslashes($comment_row["cURL"]))."'>".$lang["url"]."</a>)&nbsp;";
				} else {
					$url = "&nbsp;";
				}
				$date_added = htmlspecialchars(stripslashes($comment_row["dAdded"]));
				$html .= "<tr><td bgcolor='#ffffff' class='small'>"
					."<span class='normal'>".$comment."</span>"
					."<br>".$lang["by"]." ".$name." ".$lang["on"]." ".$date_added." ".$email." ".$url
					."</td><td bgcolor='#ffffff' class='small' align='center' width='75'>"
					."<a href='index.php?action=comment_edit&commentid=".$comment_row["nCommentId"]."'>".$lang["edit"]."</a>"
					."<br><a href='index.php?action=comment_remove&commentid=".$comment_row["nCommentId"]."'>".$lang["remove"]."</a>"
					."</td></tr>\n";
			}
			$html .= "</table>\n"
				."</td></tr>\n";
		} else {
			$html .= "<tr><td colspan='4' bgcolor='#ffffff' class='normal' align='center'>".$lang["no comments yet"]."</td></tr>\n";
		}
	} else {
		report_problem(1,"html_view_entry ".$sql);
	}

	$html .= "</table>\n";


	db_disconnect($con);

	return $html;
}


// Description : Provides the Comment Edit form
// Arguments   : comment_id - the id of the comment within the comments table
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_comment_edit($comment_id){

	global $lang;
	global $db_prefix;

	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_entry.png' width='48' height='52' title='".$lang["edit_comment"]."'></td>"
		."  <td class='title'>".$lang["edit_comment"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["comment_edit_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	// get the comment from the database
	$con = db_connect();
	$sql = "SELECT * FROM ".$db_prefix."comments WHERE nCommentId=".$comment_id;
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$row = mysql_fetch_array($result);

			$entry_id = $row["nEntryId"];

			$name = stripslashes($row["cName"]);
			$email = stripslashes($row["cEMail"]);
			$url = stripslashes($row["cURL"]);
			$body = stripslashes($row["cComment"]);

			$html .= "<form method='POST' action='exec.php?action=comment_edit'>\n"
				."<input type='hidden' name='entryid' value='".$entry_id."'>\n"
				."<input type='hidden' name='commentid' value='".$comment_id."'>\n"
				."<table border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
				."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["edit_comment"]."</b></td></tr>\n"
				."<tr><td bgcolor='#ffffff' class='normal'>".$lang["name"]."</td><td bgcolor='#ffffff'><input type='text' name='name' class='text' value='".$name."' size='30'></td></tr>\n"
				."<tr><td bgcolor='#ffffff' class='normal'>".$lang["email"]."</td><td bgcolor='#ffffff'><input type='text' name='email' class='text' value='".$email."' size='40'></td></tr>\n"
				."<tr><td bgcolor='#ffffff' class='normal'>".$lang["url"]."</td><td bgcolor='#ffffff'><input type='text' name='url' class='text' value='".$url."' size='50'></td></tr>\n"
				."<tr><td bgcolor='#ffffff' class='normal'>".$lang["body"]."</td><td bgcolor='#ffffff'><textarea name='body' class='text' cols='50' rows='3'>".$body."</textarea></td></tr>\n"
				."<tr><td bgcolor='#ffffff' colspan='2' align='right'><input type='submit' value='".$lang["make_changes"]."'></td></tr>\n"
				."</table>\n"
				."</form>\n";
		} else {
			// no comment found
			$html = "<p class='normal'>".$lang["no_comment_found"]."</p>\n";
		}
	} else {
		// problem with SQL
		report_problem(1,"html_comment_edit ".$sql);
	}

	return $html;
}


// Description : Provides the Comment Remove form
// Arguments   : comment_id - the id of the comment within the comments table
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_comment_remove($comment_id){

	global $lang;
	global $db_prefix;

	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_entry.png' width='48' height='52' title='".$lang["remove_comment"]."'></td>"
		."  <td class='title'>".$lang["remove_comment"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["comment_remove_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	// get the comment from the database
	$con = db_connect();
	$sql = "SELECT * FROM ".$db_prefix."comments WHERE nCommentId=".$comment_id;
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$row = mysql_fetch_array($result);

			$entry_id = $row["nEntryId"];

			$name = stripslashes($row["cName"]);
			$email = stripslashes($row["cEMail"]);
			$url = stripslashes($row["cURL"]);
			$body = stripslashes($row["cComment"]);

			$html .= "<form method='POST' action='exec.php?action=comment_remove'>\n"
				."<input type='hidden' name='entryid' value='".$entry_id."'>\n"
				."<input type='hidden' name='commentid' value='".$comment_id."'>\n"
				."<table border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
				."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["remove_comment"]."</b></td></tr>\n"
				."<tr><td bgcolor='#ffffff' class='normal'>".$lang["name"]."</td><td bgcolor='#ffffff' class='normal'>".$name."</td></tr>\n"
				."<tr><td bgcolor='#ffffff' class='normal'>".$lang["email"]."</td><td bgcolor='#ffffff' class='normal'>".$email."</td></tr>\n"
				."<tr><td bgcolor='#ffffff' class='normal'>".$lang["url"]."</td><td bgcolor='#ffffff' class='normal'>".$url."</td></tr>\n"
				."<tr><td bgcolor='#ffffff' class='normal'>".$lang["body"]."</td><td bgcolor='#ffffff' class='normal'>".$body."</td></tr>\n"
				."<tr><td bgcolor='#ffffff' colspan='2' align='right'><input type='submit' value='".$lang["remove_comment"]."'></td></tr>\n"
				."</table>\n"
				."</form>\n";

		} else {
			// no comment found
			$html = "<p class='normal'>No comment found.</p>\n";
		}
	} else {
		// problem with SQL
		report_problem(1,"html_comment_edit ".$sql);
	}

	return $html;
}


// Description : Provides the Login form
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_login(){

	if (isset($_REQUEST["login_failure"])){
		if ($_REQUEST["login_failure"]!=""){
			$failure = "<p><b>".$lang["login_failure"]."</b></p>";
		}
	}
	
	global $lang;
	$html = "<br>\n"
		."<div align='center'><img src='images/blog_logo.png' width='213' height='212' title='PluggedOut Blog'></div>\n"
		."<br><br>\n"
		.$failure
		."<form method='POST' action='exec.php?action=user_login'>\n"
		."<table align='center' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["login"]."</b></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["username"]."</td><td bgcolor='#ffffff'><input type='text' name='username' class='text'></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["password"]."</td><td bgcolor='#ffffff'><input type='password' name='password' class='text'></td></tr>\n"
		."<tr><td colspan='2' bgcolor='#ffffff' align='right'><input type='submit' value='".$lang["login"]."' class='button'></td></tr>\n"
		."</table>\n"
		."</form>\n";
	return $html;
}


// Description : Provides the theme list form, from which the
//               admin user can choose the default theme
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_themes_list(){

	global $lang;
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_themes.png' width='48' height='52' title='".$lang["theme_list"]."'></td>"
		."  <td class='title'>".$lang["theme_list"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["theme_list_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	$html .= "<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='3' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["themes"]."</b></td></tr>\n"
		."<tr>"
		."<td bgcolor='#dddddd' class='normal'>".$lang["name"]."</td>"
		."<td bgcolor='#dddddd' class='normal'>".$lang["selected"]."</td>"
		."<td bgcolor='#dddddd' class='normal'>".$lang["controls"]."</td>"
		."</tr>\n";

	$current_theme = get_setting("theme");

	// look through the themes directory
	$themes_dir = realpath("../themes");
	if (is_dir($themes_dir)) {
		if ($dh = opendir($themes_dir)) {
			while (($file = readdir($dh)) !== false) {
				if ($file!="." && $file!=".." && is_dir($themes_dir."/".$file)){
					if ($current_theme == $file){
						$selected = $lang["selected"];
					} else {
						$selected = "&nbsp;";
					}
					$html .= "<tr>"
						."<td bgcolor='#ffffff' class='normal'>".$file."</td>"
						."<td bgcolor='#ffffff' class='normal'>".$selected."</td>"
						."<td bgcolor='#ffffff' class='normal'><a href='exec.php?action=theme_set&theme=".$file."'>".$lang["select"]."</a>&nbsp;<a href='index.php?action=template_file_list&theme=".$file."'>".$lang["edit"]."</a>&nbsp;<a href='../index.php?theme=".$file."'>".$lang["preview"]."</a></td>"
						."</tr>\n";
				}
			}
			closedir($dh);
		} else {
			header("Location: problem.php?f=themes_list&p=cannot_read_themes_directory");
		}
	} else {
		header("Location: problem.php?f=themes_list&p=cannot_find_themes_directory");
	}
	$html .= "</table>\n";

	return $html;
}


// Description : Provides the category list form
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_category_list(){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_categories.png' width='48' height='52' title='".$lang["category_list"]."'></td>"
		."  <td class='title'>".$lang["category_list"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["category_list_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	global $db_prefix;

	$html .= "<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["category_list"]."</b></td></tr>\n"
		."<tr>"
		."<td bgcolor='#dddddd' class='normal'>".$lang["category_name"]."</td>"
		."<td bgcolor='#dddddd' class='normal'>".$lang["controls"]."</td>"
		."</tr>\n";

	$con = db_connect();

	$sql = "SELECT * FROM ".$db_prefix."categories ORDER BY cCategoryName";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			while ($row=@mysql_fetch_array($result)){
				$html .= "<tr>"
					."<td bgcolor='#ffffff' class='normal'>".stripslashes($row["cCategoryName"])."</td>"
					."<td bgcolor='#ffffff' class='normal'>"
					."<a href='index.php?action=category_edit&categoryid=".$row["nCategoryId"]."'>".$lang["edit"]."</a>"
					."&nbsp;<a href='index.php?action=category_remove&categoryid=".$row["nCategoryId"]."'>".$lang["remove"]."</a>"
					."</td>"
					."</tr>\n";
			}
		} else {
			$html .= "<tr><td colspan='2' bgcolor='#ffffff' class='normal' align='center'>".$lang["no_categories_defined"]."</td></tr>\n";
		}
	} else {
		report_problem(1,"html_category_list ".$sql);
	}

	db_disconnect($con);

	$html .= "</table>\n";

	return $html;
}


// Description : Provides the user list form
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_user_list(){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_users.png' width='48' height='52' title='".$lang["user_list"]."'></td>"
		."  <td class='title'>".$lang["user_list"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["user_list_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	global $db_prefix;

	$html .= "<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='4' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["user_list"]."</b></td></tr>\n"
		."<tr>"
		."<td bgcolor='#dddddd' class='normal'>".$lang["username"]."</td>"
		."<td bgcolor='#dddddd' class='normal'>".$lang["role"]."</td>"
		."<td bgcolor='#dddddd' class='normal'>".$lang["email"]."</td>"
		."<td bgcolor='#dddddd' class='normal'>".$lang["controls"]."</td>"
		."</tr>\n";

	$con = db_connect();

	$sql = "SELECT * FROM ".$db_prefix."users ORDER BY cUsername";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			while ($row=@mysql_fetch_array($result)){
				$html .= "<tr>"
					."<td bgcolor='#ffffff' class='normal'>".stripslashes($row["cUsername"])."</td>"
					."<td bgcolor='#ffffff' class='normal'>".stripslashes($row["cRole"])."</td>"
					."<td bgcolor='#ffffff' class='normal'><a href='mailto:".stripslashes($row["cEMail"])."'>".stripslashes($row["cEMail"])."</a></td>"
					."<td bgcolor='#ffffff' class='normal'>";

				$html .= "<a href='index.php?action=user_edit&userid=".$row["nUserId"]."'>".$lang["edit"]."</a>";
				if ($row["cUsername"]!="admin"){
					$html .= "&nbsp;<a href='index.php?action=user_remove&userid=".$row["nUserId"]."'>".$lang["remove"]."</a>";
				}

				$html .= "</td>"
					."</tr>\n";
			}
		} else {
			$html .= "<tr><td colspan='4' bgcolor='#ffffff' class='normal' align='center'>".$lang["no_users_defined"]."</td></tr>\n";
		}
	} else {
		report_problem(1,"html_user_list ".$sql);
	}
	$html .= "</table>";

	db_disconnect($con);

	return $html;
}


// Description : Provides the add user form
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_user_add(){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_user.png' width='48' height='52' title='".$lang["add_user"]."'></td>"
		."  <td class='title'>".$lang["add_user"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["add_user_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	$html .= "<form method='POST' action='exec.php?action=user_add'>\n"
		."<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["add_user"]."</b></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["username"]."</td><td bgcolor='#ffffff'><input type='text' name='username' class='text' size='20'></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["password"]."</td><td bgcolor='#ffffff'><input type='password' name='password' class='text' size='20'></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["email"]."</td><td bgcolor='#ffffff'><input type='text' name='email' class='text' size='50'></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["role"]."</td><td bgcolor='#ffffff'><select name='role' class='text'><option value='admin'>Administrator</option><option value='author'>Author</option><option value='contributor'>Contributor</option></td></tr>\n"
		."<tr><td colspan='2' bgcolor='#ffffff' align='right'><input type='submit' value='".$lang["add_user"]."' class='button'></td></tr>\n"
		."</table>\n"
		."</form>\n";

	return $html;
}


// Description : Provides the user editing form
// Arguments   : userid - the id of the user we want to edit
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_user_edit($userid){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_user.png' width='48' height='52' title='".$lang["edit_user"]."'></td>"
		."  <td class='title'>".$lang["edit_user"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["edit_user_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	global $db_prefix;

	$con = db_connect();

	$sql = "SELECT * FROM ".$db_prefix."users WHERE nUserId=".$userid;
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$row =@ mysql_fetch_array($result);

			$username = htmlspecialchars(stripslashes($row["cUsername"]),ENT_QUOTES);
			$password = stripslashes($row["cPassword"]);
			$email = stripslashes($row["cEMail"]);
			$role = stripslashes($row["cRole"]);

			if ($username!="admin"){

				switch($role){
					case "administrator":
						$select_administrator = "selected";
						$select_author = "";
						$select_contributor = "";
						break;
					case "author":
						$select_administrator = "";
						$select_author = "selected";
						$select_contributor = "";
						break;
					case "contributor":
						$select_administrator = "";
						$select_author = "";
						$select_contributor = "selected";
						break;
				}
				$html_role_select = "<select name='role' class='text'><option value='admin' ".$select_administrator.">".$lang["administrator"]."</option><option value='author' ".$select_author.">".$lang["author"]."</option><option value='contributor' ".$select_contributor.">".$lang["contributor"]."</option></select>";

			} else {

				// this is the admin user
				$html_role_select = "<span class='normal'>".$lang["administrator"]." <input type='hidden' name='role' value='admin'></span>";
			}

		} else {
			report_problem(2,"html_user_edit");
		}
	} else {
		report_problem(1,"html_user_edit ".$sql);
	}

	db_disconnect($con);

	// prepare contents of form based - to except the admin username from being edited
	if ($username=="admin"){
		$html_username = "<input type='hidden' name='username' value='admin'><span class='normal'>admin</span>";
	} else {
		$html_username = "<input type='text' name='username' class='text' size='20' value='".$username."'>";
	}

	$html .= "<form method='POST' action='exec.php?action=user_edit'>\n"
		."<input type='hidden' name='userid' value='".$userid."'>\n"
		."<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["edit_user"]."</b></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["username"]."</td><td bgcolor='#ffffff'>".$html_username."</td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["password"]."</td><td bgcolor='#ffffff' class='small'><input type='password' name='user_password' class='text' size='20' value=''>&nbsp;(enter a password to change)</td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["email"]."</td><td bgcolor='#ffffff'><input type='text' name='email' class='text' size='50' value='".$email."'></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["role"]."</td><td bgcolor='#ffffff'>".$html_role_select."</td></tr>\n"
		."<tr><td colspan='2' bgcolor='#ffffff' align='right'><input type='submit' value='".$lang["make_changes"]."' class='button'></td></tr>\n"
		."</table>\n"
		."</form>\n";

	return $html;

}


// Description : Provides the user removal form
// Arguments   : userid - the id of the user we want to remove
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_user_remove($userid){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_user.png' width='48' height='52' title='".$lang["remove_user"]."'></td>"
		."  <td class='title'>".$lang["remove_user"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["remove_user_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	global $db_prefix;

	$con = db_connect();

	// create a dropdown for the replaceid
	$sql = "SELECT * FROM ".$db_prefix."users WHERE nUserId<>".$userid." ORDER BY cUsername";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$html_replace = "<select name='replaceid' class='text'>\n";
			while($row=@mysql_fetch_array($result)){
				$html_replace .= "<option value='".$row["nUserId"]."'>".$row["cUsername"]."</option>\n";
			}
			$html_replace .= "</select>\n";
		} else {
			// problem!
		}
	}

	$sql = "SELECT * FROM ".$db_prefix."users WHERE nUserId=".$userid;
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$row =@ mysql_fetch_array($result);

			$username = stripslashes($row["cUsername"]);
			$email = stripslashes($row["cEMail"]);
			$role = stripslashes($row["cRole"]);

		} else {
			header("Location: problem.php?f=user_remove&p=no_records");
		}
	} else {
		header("Location: problem.php?f=user_remove&p=sql_error");
	}

	db_disconnect($con);

	$html .= "<form method='POST' action='exec.php?action=user_remove&userid=".$userid."'>\n"
		."<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["remove_user"]."</b></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["username"]."</td><td bgcolor='#ffffff' class='normal'>".$username."</td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["password"]."</td><td bgcolor='#ffffff' class='normal'>".$email."</td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["email"]."</td><td bgcolor='#ffffff' class='normal'>".$role."</td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["replace_with"]."</td><td bgcolor='#ffffff' class='normal'>".$html_replace."<span class='small'>&nbsp;(".$lang["replace_with_description"].")</span></td></tr>\n"
		."<tr><td colspan='2' bgcolor='#ffffff' align='right'><input type='submit' value='Remove User' class='button'></td></tr>\n"
		."</table>\n"
		."</form>\n";

	return $html;
}


// Description : Provides the category removal form
// Arguments   : categoryid - the id of the category we want to remove
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_category_remove($categoryid){

	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_categories.png' width='48' height='52' title='".$lang["remove_category"]."'></td>"
		."  <td class='title'>".$lang["remove_category"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["remove_category_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	global $db_prefix;

	$con = db_connect();

	$sql = "SELECT * FROM ".$db_prefix."categories WHERE nCategoryId=".$categoryid;
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$row =@ mysql_fetch_array($result);

			$category_name = stripslashes($row["cCategoryName"]);

		} else {
			header("Location: problem.php?f=category_remove&p=no_records");
		}
	} else {
		header("Location: problem.php?f=category_remove&p=sql_error");
	}

	db_disconnect($con);

	$html .= "<form method='POST' action='exec.php?action=category_remove&categoryid=".$categoryid."'>\n"
		."<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["remove_category"]."</b></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["category"]."</td><td bgcolor='#ffffff' class='normal'>".$category_name."</td></tr>\n"
		."<tr><td colspan='2' bgcolor='#ffffff' align='right'><input type='submit' value='".$lang["remove_category"]."' class='button'></td></tr>\n"
		."</table>\n"
		."</form>\n";

	return $html;

}


// Description : Provides the category add form
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_category_add(){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_categories.png' width='48' height='52' title='".$lang["add_category"]."'></td>"
		."  <td class='title'>".$lang["add_category"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["add_category_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	$html .= "<form method='POST' action='exec.php?action=category_add'>\n"
		."<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["add_category"]."</b></td></tr>\n"
		."<tr><td bgcolor='#ffffff' class='normal'>".$lang["category"]."</td><td bgcolor='#ffffff'><input type='text' name='category_name' class='text' size='30'></td></tr>\n"
		."<tr><td colspan='2' bgcolor='#ffffff' align='right'><input type='submit' value='".$lang["add_category"]."' class='button'></td></tr>\n"
		."</table>\n"
		."</form>\n";

	return $html;
}


// Description : Provides the category edit form
// Arguments   : categoryid - the id of the category we want to edit
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_category_edit($categoryid){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_categories.png' width='48' height='52' title='".$lang["edit_category"]."'></td>"
		."  <td class='title'>".$lang["edit_category"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["edit_category_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	global $db_prefix;

	// get the category record we are editing
	$con = db_connect();

	$sql = "SELECT * FROM ".$db_prefix."categories WHERE nCategoryId=".$categoryid;
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$row =@ mysql_fetch_array($result);

			$category_name = htmlspecialchars(stripslashes($row["cCategoryName"]),ENT_QUOTES);

			$html .= "<form method='POST' action='exec.php?action=category_edit'>\n"
				."<input type='hidden' name='categoryid' value='".$categoryid."'>\n"
				."<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
				."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["edit_category"]."</b></td></tr>\n"
				."<tr><td bgcolor='#ffffff' class='normal'>".$lang["category"]."</td><td bgcolor='#ffffff'><input type='text' name='category_name' class='text' size='30' value='".$category_name."'></td></tr>\n"
				."<tr><td colspan='2' bgcolor='#ffffff' align='right'><input type='submit' value='".$lang["make_changes"]."' class='button'></td></tr>\n"
				."</table>\n"
				."</form>\n";

		} else {
			// no record
			header("Location: problem.php?f=category_edit&p=record_not_found");
		}
	}

	db_disconnect($con);


	return $html;
}


// Description : Provides the file browsing form
// Arguments   : None (it uses GET and POST parameters)
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_filebrowse(){

	global $lang;
	
	$site_root = realpath("../.");

	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_files.png' width='48' height='52' title='".$lang["browse_files"]."'></td>"
		."  <td class='title'>".$lang["browse_files"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["browse_files_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	// establish directory we want to show in format /var/html/uploads
	if ($_GET["path"]!=""){
		$path = $_GET["path"];
	} else {
		$path = $site_root."/uploads";
	}

	// clear the file state cache
	clearstatcache();

	if ($handle = opendir($path)) {

		$path = realpath($path);

		if (is_writable($path)){

			// Create path in the format http://sitename/filename
			$shortpath = "..".str_replace($site_root,"",$path);
			$i=0;
			while (($file = readdir($handle))!==false) {
				if (is_dir($path."/".$file)){
					// directory
					// exclude path back out of site root
					if ($path==$site_root && $file==".."){
						// exclude
					} else {
						$i++;
						$directories[$i] = $file;
					}
				} else {
					// file
					if ($file!="." && $file!=".."){
						$j++;
						$files[$j] = $file;
					} else {
						// for some reason '..' is detected as a file in safe mode
						if ($path==$site_root && $file==".."){
							// exclude
						} else {
							$i++;
							$directories[$i] = $file;
						}
					}
				}
			}
			//closedir($handle);

			// sort the arrays
			if (count($directories)>0){
				sort($directories);
			}
			if (count($files)>0){
				sort($files);
			}

			// output the list of directories, then the list of files

			$html .= "<table border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
				."  <tr><td colspan='5' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>File Browse</b></td></tr>\n"
				."  <tr><td colspan='5' bgcolor='#ffffff' class='normal'>".$lang["path"]." : ".$path."</td></tr>\n"
				."  <tr><td colspan='5' bgcolor='#ffffff' class='normal'>".$lang["create_dir_here"]." : "
				."    <form action='exec.php?action=filebrowse_directory_create' method='POST'>\n"
				."    <input name='path' type='hidden' value='".$path."'>\n"
				."    <input name='shortpath' type='hidden' value='".$shortpath."'>\n"
				."    <input name='directory' type='text' class='text'>\n"
				."    <input class='button' type='submit' value='".$lang["create"]."'>\n"
				."    </form>\n"
				."  </td></tr>\n";

			$html .= "  <tr><td colspan='5' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["directories"]."</b></td></tr>\n";
			for ($i=0;$i<count($directories);$i++){

				// determine controls
				if ($directories[$i]!="." && $directories[$i]!=".."){
					$controls = "<a href='exec.php?action=filebrowse_directory_remove&directory=".$path."/".$directories[$i]."&path=".$path."' class='normal'>".$lang["remove"]."</a>";
				} else {
					$controls = "";
				}
				$html.="<tr>"
					."<td bgcolor='#ffffff' width='16'><img src='images/file_icon_folder.png' width='16' height='16'></td>"
					."<td bgcolor='#ffffff' class='normal' colspan='3'><a href='index.php?action=file_browse&path=".$path."/".$directories[$i]."' class='cms_link'>".$directories[$i]."</a></td>"
					."<td bgcolor='#ffffff'>".$controls."</td>"
					."</tr>\n";
			}

			// work out destination for uploads
			$destination = $path;

			$html .= "  <tr><td colspan='5' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["files"]."</b>&nbsp;(<a href='".$_SERVER["REQUEST_URI"]."&showhtml=x'>".$lang["show_html"]."</a>)</td></tr>\n"
				."<tr>"
				."<td bgcolor='#ffffff' class='normal' colspan='5'>".$lang["upload_here"]
				."    <form enctype='multipart/form-data' action='exec.php?action=filebrowse_file_upload&destination=".$destination."' method='POST'>\n"
				."    <input type='hidden' name='MAX_FILE_SIZE' value='8388608'>\n"
				."    <input name='userfile' type='file' class='text'>\n"
				."    <input class='button' type='submit' value='".$lang["upload_file"]."'>\n"
				."    </form>\n"
				."</td>"
				."</tr>\n"
				."<td width='16' bgcolor='#dddddd' class='cms_small'>&nbsp;</td>"
				."<td bgcolor='#dddddd' class='normal'>".$lang["filename"]."</td>"
				."<td bgcolor='#dddddd' class='normal'>".$lang["size_bytes"]."</td>"
				."<td bgcolor='#dddddd' class='normal'>".$lang["size_w_h"]."</td>"
				."<td bgcolor='#dddddd' class='normal'>".$lang["controls"]."</td>"
				."</tr>\n";

			for ($i=0;$i<count($files);$i++){
				// figure out which icon to use
				$controls = "";
				$icon = "";
				switch (strtolower(substr($files[$i],strlen($files[$i])-3,3))){
					case "php":
						$icon = "images/file_icon_script.png";
						$controls = "&nbsp;";
						break;
					case "fnc":
						$icon = "images/file_icon_script.png";
						$controls = "&nbsp;";
						break;
					case "css":
						$icon = "images/file_icon_script.png";
						$controls = "&nbsp;";
						break;
					case ".js":
						$icon = "images/file_icon_script.png";
						$controls = "&nbsp;";
						break;
					case "gif":
						$icon = "images/file_icon_image.png";
						$controls .= "<a href='exec.php?action=filebrowse_file_delete&file=".$path."/".$files[$i]."&path=".$path."' class='normal'>Remove</a>";
						break;
					case "jpg":
						$icon = "images/file_icon_image.png";
						$controls .= "<a href='exec.php?action=filebrowse_file_delete&file=".$path."/".$files[$i]."&path=".$path."' class='normal'>Remove</a>";
						break;
					case "png":
						$icon = "images/file_icon_image.png";
						$controls .= "<a href='exec.php?action=filebrowse_file_delete&file=".$path."/".$files[$i]."&path=".$path."' class='normal'>Remove</a>";
						break;
					case "inc":
						$icon = "images/file_icon_config.png";
						$controls .= "<a href='exec.php?action=filebrowse_file_delete&file=".$path."/".$files[$i]."&path=".$path."' class='normal'>Remove</a>";
						break;
					default:
						$icon = "images/file_icon_script.png";
						$controls .= "<a href='exec.php?action=filebrowse_file_delete&file=".$path."/".$files[$i]."&path=".$path."' class='normal'>Remove</a>";
				}
				// prepare filename (anchor or not)
				if (substr($files[$i],strlen($files[$i])-3,3)=="php" || substr($files[$i],strlen($files[$i])-2,2)=="js"){
					$filename = $files[$i];
				} else {
					$filename = "<a href='".$shortpath."/".$files[$i]."' class='normal'>".$files[$i]."</a>";
				}

				// prepare size if its an image
				if ($files[$i]!="." && $files[$i]!=".."){
					$asize =@ getimagesize($shortpath."/".$files[$i]);
				} else {
					$asize = false;
				}
				if ($asize!=false){
					$size = $asize[0]." x ".$asize[1];
				} else {
					$size = "&nbsp;";
				}

				$html.="<tr>"
					."<td bgcolor='#ffffff' width='16'><img src='".$icon."' width='16' height='16'></td>"
					."<td bgcolor='#ffffff' class='normal'>".$filename."</td>"
					."<td bgcolor='#ffffff' class='normal'>".number_format(filesize($shortpath."/".$files[$i]))."</td>"
					."<td bgcolor='#ffffff' class='normal'>".$size."</td>"
					."<td bgcolor='#ffffff' class='normal'>".$controls."</td>"
					."</tr>\n";

				// if it was a graphic file, show the HTML
				if ($_GET["showhtml"]=="x"){
					$ext = substr($files[$i],strlen($files[$i])-3,3);
					$spath = str_replace("../","",$shortpath);
					$serverpath = str_replace("admin/index.php",$spath,$_SERVER["SCRIPT_URI"]);
					
					//$serverpath = ."/".substr($shortpath,3,strlen($shortpath)-3);
					if ($ext=="png" || $ext=="jpg" || $ext=="gif"){
						$html .= "<tr><td colspan='5' bgcolor='#ffffff' class='small'>&lt;img src='".$serverpath."/".$files[$i]."' width='".$asize[0]."' height='".$asize[1]."' /&gt;</td></tr>\n";
					}
				}
			}
		
			$html.="</table>\n";

		} else {
			header("Location: problem.php?f=filebrowse&p=uploads_dir_not_writable");
		}
		
		closedir($handle);
	} else {
		// cannot find uploads directory
		header("Location: problem.php?f=filebrowse&p=uploads_dir_not_found");
	}
	return $html;

}


// Description : Provides the settings form
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_settings_edit(){

	global $lang;
	
	// get the settings

	$theme = get_setting("theme");
	$results_per_page = get_setting("results_per_page");
	$entry_list_limit = get_setting("default_entry_list_limit");
	$rich_editing = get_setting("rich_editing");
	if ($rich_editing!=""){
		$rich_editing = "checked";
	}
	$banned_words = get_setting("banned_words");

	$rss_root_url = get_setting("rss_root_url");
	$rss_title = get_setting("rss_title");
	$rss_description = get_setting("rss_description");
	$rss_language = get_setting("rss_language");
	$rss_copyright = get_setting("rss_copyright");
	$rss_editor = get_setting("rss_editor");
	$rss_webmaster = get_setting("rss_webmaster");
	$rss_category = get_setting("rss_category");
	$rss_ttl = get_setting("rss_ttl"); // 60 = default
	$rss_image = get_setting("rss_image");

	// set the checked / unchecked status of parse smilies
	$parse_smilies = get_setting("parse_smilies");
	if ($parse_smilies!=""){
		$parse_smilies = "checked";
	}

	// set the checked / unchecked status of notify comments
	$notify_comments = get_setting("notify_comments");
	if ($notify_comments!=""){
		$notify_comments = "checked";
	}
	
	// construct HTML for the timezone option
	$timedelta = get_setting("timedelta");
	if ($timedelta==""){
		$timedelta="0";
	}
	$timedeltas = Array("-11","-10","-9","-8","-7","-6","-5","-4","-3","-2","-1","0","+1","+2","+3","+4","+5","+6","+7","+8","+9","+10","+11");
	
	// construct the timezone dropdown
	$html_select_timedelta = "<select name='timedelta'>";
	foreach($timedeltas as $td){
		if ($timedelta == $td){
			$sel = " selected ";
		} else {
			$sel = "";
		}
		$html_select_timedelta .= "<option value='".$td."' ".$sel.">".$td."</option>";
	}
	$html_select_timedelta .= "</select>\n";
	
	// set the checked / unchecked status of parse carriage returns
	$parse_crlf = get_setting("parse_crlf");
	if ($parse_crlf!=""){
		$parse_crlf = "checked";
	}
	
	// set the comment_code value
	$comment_code = get_setting("comment_code");
	if ($comment_code!=""){
		$comment_code = "checked";
	}

	// set the verify_comments value
	$verify_comments = get_setting("verify_comments");
	if ($verify_comments!=""){
		$verify_comments = "checked";
	}
	
	// set the comment_order contents
	if (get_setting("comment_order")=="DESC"){
		$comment_order_asc = "";
		$comment_order_desc = "selected";
	} else {
		$comment_order_asc = "selected";
		$comment_order_desc = "";
	}
	$comment_order = "<option value='' ".$comment_order_asc.">".$lang["ascending"]."</option>"
		."<option value='DESC' ".$comment_order_desc.">".$lang["descending"]."</option>";
	
	// start outputting the settings page
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_search.png' width='48' height='52' title='".$lang["settings"]."'></td>"
		."  <td class='title'>".$lang["settings"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["settings_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	$html .= "<form method='POST' action='exec.php?action=settings_edit'>\n"
		."<table align='left' border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
		."<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["blog_settings"]."</b></td></tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["admin_results_per_page"]."</td>"
		."<td bgcolor='#ffffff' class='small'><input type='text' name='results_per_page' class='text' size='10' value='".$results_per_page."'> (".$lang["admin_results_per_page_description"].")</td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["visitor_entries_per_page"]."</td>"
		."<td bgcolor='#ffffff' class='small'><input type='text' name='entry_list_limit' class='text' size='10' value='".$entry_list_limit."'> (".$lang["visitor_entries_per_page_description"].")</td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["parse_smilies"]."</td>"
		."<td bgcolor='#ffffff'><input type='checkbox' name='parse_smilies' value='x' ".$parse_smilies."></td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["notify_comments"]."</td>"
		."<td bgcolor='#ffffff' class='small'><input type='checkbox' name='notify_comments' value='x' ".$notify_comments."> (".$lang["notify_comments_description"].")</td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["parse_crlf"]."</td>"
		."<td bgcolor='#ffffff' class='small'><input type='checkbox' name='parse_crlf' value='x' ".$parse_crlf."> (".$lang["parse_crlf_description"].")</td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["timedelta"]."</td>"
		."<td bgcolor='#ffffff' class='small'>".$html_select_timedelta." (".$lang["timedelta_description"].")</td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["banned_words"]."</td>"
		."<td bgcolor='#ffffff' class='small'><input type='text' name='banned_words' class='text' size='30' value='".$banned_words."'> (".$lang["banned_words_description"].")</td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["comment_code"]."</td>"
		."<td bgcolor='#ffffff' class='small'><input type='checkbox' name='comment_code' value='x' ".$comment_code."> (".$lang["comment_code_description"].")</td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["comment_order"]."</td>"
		."<td bgcolor='#ffffff' class='small'><select class='text' name='comment_order'>".$comment_order."</select></td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["verify_comments"]."</td>"
		."<td bgcolor='#ffffff' class='small'><input type='checkbox' name='verify_comments' value='x' ".$verify_comments."> (".$lang["verify_comments_description"].")</td>"
		."</tr>\n"
		
		;


	$html .= "<tr><td colspan='2' bgcolor='#cccccc' class='normal' background='images/bg.gif'><b>".$lang["rss_settings"]."</b></td></tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["root_url"]."</td>"
		."<td bgcolor='#ffffff'><input type='text' name='rss_root_url' class='text' size='60' value='".$rss_root_url."'></td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["blog_title"]."</td>"
		."<td bgcolor='#ffffff'><input type='text' name='rss_title' class='text' size='60' value='".$rss_title."'></td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["description"]."</td>"
		."<td bgcolor='#ffffff'><textarea name='rss_description' class='text' cols='50' rows='2'>".$rss_description."</textarea></td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["language"]."</td>"
		."<td bgcolor='#ffffff'><input type='text' name='rss_language' class='text' size='10' value='".$rss_language."'></td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["copyright"]."</td>"
		."<td bgcolor='#ffffff'><input type='text' name='rss_copyright' class='text' size='50' value='".$rss_copyright."'></td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["editor"]."</td>"
		."<td bgcolor='#ffffff'><input type='text' name='rss_editor' class='text' size='50' value='".$rss_editor."'></td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["webmaster"]."</td>"
		."<td bgcolor='#ffffff'><input type='text' name='rss_webmaster' class='text' size='50' value='".$rss_webmaster."'></td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["category"]."</td>"
		."<td bgcolor='#ffffff'><input type='text' name='rss_category' class='text' size='30' value='".$rss_category."'></td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["ttl"]."</td>"
		."<td bgcolor='#ffffff' class='normal'><input type='text' name='rss_ttl' class='text' size='10' value='".$rss_ttl."'> (".$lang["ttl_description"].")</td>"
		."</tr>\n"
		."<tr>"
		."<td bgcolor='#ffffff' class='normal'>".$lang["image_url"]."</td>"
		."<td bgcolor='#ffffff' class='normal'><input type='text' name='rss_image' class='text' size='50' value='".$rss_image."'></td>"
		."</tr>\n"
		."<tr><td colspan='2' bgcolor='#ffffff' align='right' class='normal'><input type='submit' value='".$lang["make_changes"]."' class='button'></td></tr>\n"
		."</table>\n"
		."</form>\n";

	return $html;

}


// Description : Provides the forbidden screen
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_forbidden(){

	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_help.png' width='48' height='52' title='".$lang["forbidden"]."'></td>"
		."  <td class='title'>".$lang["forbidden"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["forbidden_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	return $html;

}


// Description : Provides a list of the files in a template
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_template_file_list(){

	global $lang;
	
	// show a list of the files in the template
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_files.png' width='48' height='52' title='".$lang["template_files"]."'></td>"
		."  <td class='title'>".$lang["template_files"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["template_files_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";

	// work out path to current theme
	$path = "../themes/".$_GET["theme"];
	$path = realpath($path);
	
	// show files in theme
	if ($handle = opendir($path)) {

		// loop through files within path
		while (($file = readdir($handle))!==false) {
			if (is_dir($path."/".$file)){
				// it's a directory
			} else {
				// it's a file
				$afiles[] = $file;
				$filedate[$file] = date ("F d Y H:i:s.",filemtime($path."/".$file));
				$fsize[$file] = filesize($path."/".$file);
				if (is_writeable($path."/".$file)){
					$filewritable[$file] = "w";
				} else {
					$filewritable[$file] = "n";
				}
				
			}
		}

		// sort the filenames
		asort($afiles);
		
		$html .= "<table border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
			."<tr><td colspan='2' bgcolor='#cccccc' background='images/bg.gif' class='normal'><b>".$lang["templates"]."</b></td></tr>\n";
			
		foreach($afiles as $file){
			if ($filewritable[$file]=="w"){
				$edit_link_start = "<a href='index.php?action=template_file_edit&theme=".$_GET["theme"]."&file=".$file."'>";
				$edit_link_end = "</a>";
			} else {
				$edit_link_start = "";
				$edit_link_end = "";
			}
				
			$html .= "<tr><td class='normal' bgcolor='#ffffff'>".$edit_link_start.$file.$edit_link_end."</td><td class='normal' bgcolor='#ffffff'>".$filedate[$file]."</td></tr>\n";
			
		}
		$html .= "</table>\n";
		
	} else {
		// problem opening file handle
		header("Location: problem.php?f=template_file_list");
	}
	
	return $html;
}


// Description : Provides a form to edit a tempalte file contents
// Arguments   : None
// Returns     : HTML
// Last Change : 2006-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_template_file_edit(){
	
	global $lang;
	
	$html = "<table border='0' cellspacing='0' cellpadding='2'>\n"
		."<tr>"
		."  <td rowspan='2'><img src='images/icon_files.png' width='48' height='52' title='".$lang["edit_template_file"]."'></td>"
		."  <td class='title'>".$lang["edit_template_file"]."</div>\n"
		."</tr><tr>"
		."  <td class='normal'>".$lang["edit_template_file_description"]."</td>\n"
		."</tr>\n"
		."</table>\n"
		."<br>\n";
	
	$path = "../themes/".$_GET["theme"];
	$path = realpath($path);
	$file = $path."/".$_GET["file"];
	
	if (file_exists($file)){
	
		if (is_writeable($file)){

			// get the contents of the file passed in
			$text = file_get_contents($file);

			$html .= "<form method='POST' action='exec.php?action=template_file_edit'>\n"
				."<input type='hidden' name='file' value='".$file."'>\n"
				."<input type='hidden' name='theme' value='".$_REQUEST["theme"]."'>\n"
				."<table border='0' cellspacing='1' cellpadding='3' bgcolor='#cccccc'>\n"
				."<tr><td bgcolor='#cccccc' background='images/bg.gif' class='normal'><b>".$lang["edit_template_file"]."</b></td></tr>\n"
				."<tr><td bgcolor='#ffffff' class='normal'>".$lang["template_file"]." : ".$_GET["theme"]."/".$_GET["file"]."</td></tr>\n"
				."<tr><td bgcolor='#ffffff'>"
				."<textarea name='template' cols='80' rows='25' wrap='off'>".htmlspecialchars($text)."</textarea>"
				."</td></tr>\n"
				."<tr><td bgcolor='#ffffff' align='right'><input type='submit' value='".$lang["make_changes"]."'></td></tr>\n"
				."</table>\n"
				."</form>\n";
		} else {
			// file isnt writeable
			header("Location: problem.php?f=template_file_edit");
		}
		
	} else {
		$html .= "<p class='normal'>".$lang["template_file_not_found"]."</p>\n";
	}
	
	return $html;
	
}

?>