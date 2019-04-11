<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : admin/install.php
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
require "lib/html.php";
require "../lib/misc.php";

// include the appropriate language file
if (file_exists("../lang/".$language.".php")){
	require "../lang/".$language.".php";
} else {
	header("Location: problem.php?f=install.php&p=language_file_not_found");
}

// connect
$con = db_connect();

// find out if the tables exist
$sql = "show table status like '".$db_prefix."entries'";
$result = mysql_query($sql,$con);
if (mysql_num_rows($result) == 1){

	// a Blog installation exists
	$content .= "<p class='title' align='center'>Caution</p>\n"
		."<p class='normal' align='center'>An installation already exists based on the parameters in the lib/config file specified.</p>";

} else {

	// no installation exists


	// SQL to generate tables...


	// Categories
	
	$sql = "CREATE TABLE `".$db_prefix."categories` ("
		."  `nCategoryId` bigint(20) NOT NULL auto_increment,"
		."  `cCategoryName` varchar(254) NOT NULL default '',"
		."  PRIMARY KEY  (`nCategoryId`)"
		.") TYPE=MyISAM AUTO_INCREMENT=2";

	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."categories` VALUES (1, 'Default')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";


	// Comments
	
	$sql = "CREATE TABLE `".$db_prefix."comments` ("
		."  `nCommentId` bigint(20) NOT NULL auto_increment,"
		."  `nEntryId` bigint(20) NOT NULL default '0',"
		."  `cComment` mediumtext NOT NULL,"
		."  `cName` varchar(254) NOT NULL default '',"
		."  `cEMail` varchar(254) NOT NULL default '',"
		."  `cURL` varchar(254) NOT NULL default '',"
		."  `dAdded` datetime NOT NULL default '0000-00-00 00:00:00',"
		."  PRIMARY KEY  (`nCommentId`)"
		.") TYPE=MyISAM AUTO_INCREMENT=1";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";


	// entries

	$sql = "CREATE TABLE `".$db_prefix."entries` ("
		."  `nEntryId` bigint(20) NOT NULL auto_increment,"
		."  `dAdded` datetime NOT NULL default '0000-00-00 00:00:00',"
		."  `dEdited` datetime NOT NULL default '0000-00-00 00:00:00',"
		."  `nUserAdded` bigint(20) NOT NULL default '0',"
		."  `nUserEdited` bigint(20) NOT NULL default '0',"
		."  `cTitle` varchar(254) NOT NULL default '',"
		."  `cBody` mediumtext NOT NULL,"
		."  `cTags` varchar(254) NOT NULL default '',"
		."  `nComments` bigint(20) NOT NULL default '0',"
		."  `cStatus` char(1) NOT NULL default '',"
		."  PRIMARY KEY  (`nEntryId`)"
		.") TYPE=MyISAM AUTO_INCREMENT=2";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."entries` VALUES (1, '2005-07-11 00:00:00', '2005-07-11 00:00:00', 1, 1, 'Test Entry', 'This is a quick test entry just to make sure this is working okay', '', 0, 'P')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";


	// Entry Categories
	
	$sql = "CREATE TABLE `".$db_prefix."entry_categories` ("
		."  `nEntryCategoryId` bigint(20) NOT NULL auto_increment,"
		."  `nEntryId` bigint(20) NOT NULL default '0',"
		."  `nCategoryId` bigint(20) NOT NULL default '0',"
		."  PRIMARY KEY  (`nEntryCategoryId`)"
		.") TYPE=MyISAM AUTO_INCREMENT=1";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";


	// Settings
	
	$sql = "CREATE TABLE `".$db_prefix."settings` ("
		."  `cName` varchar(254) NOT NULL default '',"
		."  `cValue` varchar(254) NOT NULL default '',"
		."  PRIMARY KEY  (`cName`)"
		.") TYPE=MyISAM";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	// populate the basic settings
	
	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('theme', 'cleanlines')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('crypt_salt', 'default')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('results_per_page', '25')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('default_entry_list_limit', '10')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('parse_crlf', 'x')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";
	
	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('banned_words', 'viagra,poker,cialis,valium,penis,breast,casino')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";
	
	
	// populate some of the RSS data
	
	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('rss_root_url', 'http://yourdomain/blog')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('rss_title', 'Title of your Blog')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('rss_description', 'Description of your blog')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('rss_language', 'en-us')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('rss_copyright', 'Copyright YOUR NAME, All Rights Reserved')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('rss_editor', 'somebody@somewhere.com')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('rss_webmaster', 'somebody@somewhere.com')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('rss_category', 'Personal Blog')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";

	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('rss_ttl', '60')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";
	
	$sql = "INSERT INTO `".$db_prefix."settings` VALUES ('rss_image', '')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";


	// Users
	
	$sql = "CREATE TABLE `".$db_prefix."users` ("
		."  `nUserId` bigint(20) NOT NULL auto_increment,"
		."  `cUsername` varchar(30) NOT NULL default '',"
		."  `cPassword` varchar(30) NOT NULL default '',"
		."  `cEMail` varchar(254) NOT NULL default '',"
		."  `cRole` varchar(12) NOT NULL default '',"
		."  PRIMARY KEY `nUserId` (`nUserId`)"
		.") TYPE=MyISAM AUTO_INCREMENT=2";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";
	
	$sql = "INSERT INTO `".$db_prefix."users` VALUES (1, 'admin', '".mysql_escape_string(crypt("password","admin"))."', '', 'admin')";
	$result = mysql_query($sql,$con);
	if (!$result) $sql_problem .= htmlentities($sql)."\n<br /><br />\n";


	// Construct Results
	
	if ($result!=false){
	
		// finished - successful
		$content .= "<p class='large' align='center'>Finished!</p>\n<p class='normal' align='center'>The blog database has been successfully created.</p>\n"
			."<p class='normal' align='center'><a href='index.php'>Go to the admin page</a></p>\n";

	} else {
	
		// failed
		$content .= "<p class='large' align='center'>Caution</p>\n<p class='normal' align='center'>A problem occurred executing the Blog database creation SQL.</p>\n<pre>".mysql_error()."</pre><br><br><b>What to do next...</b><br>Copy the data below, and paste it into the Blog Development Forum (<a href='http://www.pluggedout.com/development/forums/viewforum.php?f=26'>http://www.pluggedout.com/development/forums/viewforum.php?f=26</a>)<br><br><pre>".$sql_problem."</pre>";
		
	}

}

// Output the results

$html = html_page();
$html = str_replace("<!--banner-->",html_banner(),$html);
$html = str_replace("<!--menu_top-->",html_menu_top(),$html);
$html = str_replace("<!--menu_side-->",html_menu_side(),$html);
$html = str_replace("<!--content-->",$content,$html);

print $html;

?>