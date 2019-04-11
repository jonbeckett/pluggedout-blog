<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : index.php
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


require "lib/config.php";
require "lib/database.php";
require "lib/session.php";
require "lib/themes.php";
require "lib/html.php";
require "lib/misc.php";

// include the appropriate language file
if (file_exists("lang/".$language.".php")){
	require "lang/".$language.".php";
} else {
	header("Location: problem.php?f=install.php&p=language_file_not_found");
}

// find out if we are looking at a specific entry, category or search
if ( isset($_REQUEST["entryid"]) || isset($_REQUEST["categoryid"]) || isset($_REQUEST["keywords"]) ){

	$adate = getdate();
	$year = $adate["year"];
	$month = $adate["month"];
	$day = $adate["mday"];

	if ( isset($_REQUEST["entryid"]) ){

		if (is_numeric($_REQUEST["entryid"])){
			$html = html_view_entry($_REQUEST["entryid"]);
		} else {
			$html = html_view_default($year,$month);
		}

	} elseif ( isset($_REQUEST["categoryid"]) ){

		if (is_numeric($_REQUEST["categoryid"])){
			$html = html_view_category($_REQUEST["categoryid"]);
		} else {
			$html = html_view_default($year,$month);
		}

	} elseif ( isset($_REQUEST["keywords"]) ){

		$html = html_view_search($_REQUEST["keywords"]);

	}

} else {

	// get todays date to default month day and year variables
	$adate = getdate();
	$year = $adate["year"];
	$month = $adate["month"];
	$day = $adate["mday"];

	// override today if parameters are supplied
	if ( isset($_REQUEST["year"]) && isset($_REQUEST["month"]) && isset($_REQUEST["day"]) ){

		if ( is_numeric($_REQUEST["year"]) && is_numeric($_REQUEST["month"]) && is_numeric($_REQUEST["day"]) ){
			// show a specific month
			$year = $_REQUEST["year"];
			$month = $_REQUEST["month"];
			$day = $_REQUEST["day"];
			$html = html_view_day($year,$month,$day);
		} else {
			$html = html_view_default($year,$month);
		}

	} elseif ( isset($_REQUEST["year"]) && isset($_REQUEST["month"]) ){

		if ( is_numeric($_REQUEST["year"]) && is_numeric($_REQUEST["month"]) ){
			// show a specific day
			$year = $_REQUEST["year"];
			$month = $_REQUEST["month"];
			$html = html_view_month($year,$month);
		} else {
			$html = html_view_default($year,$month);
		}

	} else {

		// show the default view
		$html = html_view_default($year,$month);

	}

}

// output the constructed HTML
print $html;

?>