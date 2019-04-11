<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : lib/html.php
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

// *****************************************************************************************
// **                                 PRIVATE FUNCTIONS                                   **
// *****************************************************************************************


// Description : Constructs the HTML representing a month-view calendar
// Arguments   : year  - The year the calendar should show
//               month - The month the calendar should show
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function build_calendar($year="",$month="") {

	global $theme;
	
	// validate data
	if ($month==""){
		// if we have no month, make it THIS month
		$month = date("n");
	}
	
	if ($year==""){
		// if we have no year, make it THIS year
		$year = date("Y");
	}

	global $monthnames_long;
	global $monthnames_short;
	global $daynames_long;
	global $daynames_short;
	
	// fill an array with number of entries per day for hilighting purposes
	$con = db_connect();
	$sql = db_sql_calendar_counts($year,$month);
	$result = mysql_query($sql,$con);
	if ($result!=false){
		while($row =@ mysql_fetch_array($result)){
			$calendar_counts[$row["nDay"]] = $row["nCount"];
		}
	} else {
		report_problem(1,"<b>build_calendar</b>\n\n".mysql_error()."\n\n".$sql);
	}

	define ('ADAY', (60*60*24));

	// make arrays of values representing the first of the month
	$datearray = getdate(mktime(0,0,0,$month,1,$year));
	$start = mktime(0,0,0,$month,1,$year);

	$firstdayarray = getdate($start);

	// work out the URLs for previous and next buttons
	// default
	$prev_month = $month - 1;
	$prev_year = $year;
	$next_month = $month + 1;
	$next_year = $year;

	// handle exceptions
	// end of year
	if ($month==12) {
		$prev_month = $month - 1;
		$prev_year = $year;
		$next_month = 1;
		$next_year = $year + 1;
	}
	// start of year
	if ($month==1) {
		$prev_month = 12;
		$prev_year = $year - 1;
		$next_month = $month + 1;
		$next_year = $year;
	}
	$url_next = $_SERVER["PHP_SELF"]."?month=".$next_month."&year=".$next_year;
	$url_prev = $_SERVER["PHP_SELF"]."?month=".$prev_month."&year=".$prev_year;


	// get template for entire calendar area
	$html = theme_calendar_section();

	// do the replacements
	$html = str_replace("<!--month_previous_url-->",$url_prev,$html);
	$html = str_replace("<!--month_current_url-->","index.php?year=".$year."&month=".$month,$html);
	$html = str_replace("<!--month_next_url-->",$url_next,$html);
	
	$html = str_replace("<!--monthname_long-->",$monthnames_long[$datearray["mon"]-1],$html);
	$html = str_replace("<!--year-->",$year,$html);
	
	// get templates for various squares
	$t_day_heading = theme_calendar_day_heading();
	$t_day_empty = theme_calendar_day_empty();
	$t_day_on = theme_calendar_day_on();
	$t_day_off = theme_calendar_day_off();
	$t_day_today = theme_calendar_day_today();
	$t_calendar_sep = theme_calendar_row_seperator();
	
	foreach($daynames_short as $day)
	{
		$day_heading = $t_day_heading;
		$day_heading = str_replace("<!--day_heading-->",$day,$day_heading);
		$day_headings .= $day_heading;
	}
	
	$html = str_replace("<!--day_headings-->",$day_headings,$html);

	// Create the rows of days
	for ($count=1;$count<(6*7+1);$count++){
	
		$dayarray = getdate($start);
	
		// new rows on mondays
		if((($count) % 7) == 1) {
			if($dayarray['mon'] != $datearray['mon']) break;
			$html_days .= $t_calendar_sep;
		}

		if ($firstdayarray["wday"]==0) {
			$firstday = 7;
		} else {
			$firstday = $firstdayarray["wday"];
		}
		
		if($count < $firstday || $dayarray['mon'] != $month) {
			
			$html_days .= $t_day_empty;
		
		} else {
			
			// build the html for a day within the calendar
			$date_url = "index.php?year=".$dayarray["year"]."&month=".$dayarray["mon"]."&day=".$dayarray["mday"];
			
			$today = getdate();
			
			// work out if the current day is today
			if ( ($today["year"] == $dayarray["year"]) && ($today["mon"] == $dayarray["mon"]) && ($today["mday"] == $dayarray["mday"]) ){
				$html_day = $t_day_today;
				$html_day = str_replace("<!--day-->","<a class='calendar_link' href='".$date_url."'>".$dayarray[mday]."</a>",$html_day);
			} else {
				if ($calendar_counts[$dayarray[mday]]>0){
					$html_day = $t_day_on;
					$html_day = str_replace("<!--day-->","<a class='calendar_link' href='".$date_url."'>".$dayarray[mday]."</a>",$html_day);
				} else {
					$html_day = $t_day_off;
					$html_day = str_replace("<!--day-->",$dayarray[mday],$html_day);
				}
			}

			$html_days .= $html_day;
			
			$start += ADAY;
			
			// check that day has moved on (to solve the daylight savings problem)
			$testday = getdate($start);
			if ($testday["yday"]==$dayarray["yday"]){
				$start += (ADAY/2);
			}
		}
	}
	
	// put the days into the calendar
	$html = str_replace("<!--calendar_days-->",$html_days,$html);
	
	db_disconnect($con);
	
	return $html;
}


// Description : Constructs the HTML representing the <!--entry_list--> section of a page
// Arguments   : sql_entrylist - the SQL required to provide records to build the HTML
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function build_entrylist($sql_entrylist){

	global $theme;
	global $daynames_long;
	global $daynames_short;
	global $monthnames_long;
	global $monthnames_short;

	$con = db_connect();
	$result_entrylist = mysql_query($sql_entrylist,$con);
	if ($result_entrylist!=false){
	
		// get the entries from the database
		if (mysql_num_rows($result_entrylist)>0){

			// loop throught the entries
			while ($row =@ mysql_fetch_array($result_entrylist)){

				// get the template for one item in the list
				$html_item = theme_entrylist_item();

				// do replaces against that template to put data in place
				$html_item = str_replace("<!--entryid-->",$row["nEntryId"],$html_item);
				$html_item = str_replace("<!--url-->","index.php?entryid=".$row["nEntryId"],$html_item);
				$html_item = str_replace("<!--title-->",stripslashes($row["cTitle"]),$html_item);
				$html_item = str_replace("<!--user_added-->",stripslashes($row["cUserAdded"]),$html_item);
				$html_item = str_replace("<!--user_edited-->",stripslashes($row["cUserEdited"]),$html_item);
				$html_item = str_replace("<!--comments_num-->",$row["dEdited"],$html_item);

				// do date added replacements
				$a_date_added = db_datetoarray($row["dAdded"]);
				$html_item = str_replace("<!--date_added-->",$row["dAdded"],$html_item);
				$html_item = str_replace("<!--date_added_daynum-->",$a_date_added["mday"],$html_item);
				$html_item = str_replace("<!--date_added_dayname_long-->",$daynames_long[$a_date_added["wday"]-1],$html_item);
				$html_item = str_replace("<!--date_added_dayname_short-->",$daynames_short[$a_date_added["wday"]-1],$html_item);
				$html_item = str_replace("<!--date_added_monthnum-->",$a_date_added["mon"],$html_item);
				$html_item = str_replace("<!--date_added_monthname_long-->",$monthnames_long[$a_date_added["mon"]-1],$html_item);
				$html_item = str_replace("<!--date_added_monthname_short-->",$monthnames_short[$a_date_added["mon"]-1],$html_item);
				$html_item = str_replace("<!--date_added_yearnum-->",$a_date_added["year"],$html_item);
				$html_item = str_replace("<!--date_added_hour-->",$a_date_added["hours"],$html_item);
				$html_item = str_replace("<!--date_added_minute-->",str_pad($a_date_added["minutes"],2,"0",STR_PAD_LEFT),$html_item);
				$html_item = str_replace("<!--date_added_second-->",str_pad($a_date_added["seconds"],2,"0",STR_PAD_LEFT),$html_item);
				$html_item = str_replace("<!--date_added_time_short-->",($a_date_added["hours"]>12 ? $a_date_added["hours"]-12 : $a_date_added["hours"]).":".str_pad($a_date_added["minutes"],2,"0",STR_PAD_LEFT).($a_date_added["hours"]>=12 ? "pm" : "am"),$html_item);


				// do date edited replacements
				$a_date_edited = db_datetoarray($row["dEdited"]);
				$html_item = str_replace("<!--date_edited-->",$row["dEdited"],$html_item);
				$html_item = str_replace("<!--date_edited_daynum-->",$a_date_edited["mday"],$html_item);
				$html_item = str_replace("<!--date_edited_dayname_long-->",$daynames_long[$a_date_edited["wday"]-1],$html_item);
				$html_item = str_replace("<!--date_edited_dayname_short-->",$daynames_short[$a_date_edited["wday"]-1],$html_item);
				$html_item = str_replace("<!--date_edited_monthnum-->",$a_date_edited["mon"],$html_item);
				$html_item = str_replace("<!--date_edited_monthname_long-->",$monthnames_long[$a_date_edited["mon"]-1],$html_item);
				$html_item = str_replace("<!--date_edited_monthname_short-->",$monthnames_short[$a_date_edited["mon"]-1],$html_item);
				$html_item = str_replace("<!--date_edited_yearnum-->",$a_date_edited["year"],$html_item);
				$html_item = str_replace("<!--date_edited_hour-->",$a_date_edited["hours"],$html_item);
				$html_item = str_replace("<!--date_edited_minute-->",str_pad($a_date_edited["minutes"],2,"0",STR_PAD_LEFT),$html_item);
				$html_item = str_replace("<!--date_edited_second-->",str_pad($a_date_edited["seconds"],2,"0",STR_PAD_LEFT),$html_item);
				$html_item = str_replace("<!--date_edited_time_short-->",($a_date_edited["hours"]>12 ? $a_date_edited["hours"]-12 : $a_date_edited["hours"]).":".str_pad($a_date_edited["minutes"],2,"0",STR_PAD_LEFT).($a_date_edited["hours"]>=12 ? "pm" : "am"),$html_item);

				// put the constructed item inside an array
				$a_html_items[] = $html_item;
			}
			// construct the section
			$html_items = implode(theme_entrylist_seperator(),$a_html_items);

		} else {
			// no entries
			$html_items = theme_entrylist_noitems();
		}

		// get the section template
		$html_section = theme_entrylist_section();

		// put the entries within the section template
		$html_section = str_replace("<!--items-->",$html_items,$html_section);
	
	} else {
		report_problem(1,"build_entrylist ".$sql_entrylist);
	}
	
	db_disconnect($con);
	
	return $html_section;
	
}


// Description : Constructs the HTML representing the <!--entry_view--> section of a page
// Arguments   : sql_entryview - the SQL required to provide records to build the HTML
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function build_entryview($sql_entryview){

	global $theme;
	global $daynames_long;
	global $daynames_short;
	global $monthnames_long;
	global $monthnames_short;
	global $lang;
	
	// get any settings required later
	$parse_smilies = get_setting("parse_smilies");
	$parse_crlf = get_setting("parse_crlf");
	$timezone = get_setting("timezone");
	
	$con = db_connect();
	$result_entryview = mysql_query($sql_entryview,$con);#
	if ($result_entryview!=false){
	
		// get the entries from the database
		if (mysql_num_rows($result_entryview)>0){

			// loop throught the entries
			while ($row =@ mysql_fetch_array($result_entryview)){

				// prepare the body text
				$body = stripslashes($row["cBody"]);
				
				// Change carriage returns to line breaks
				if ($parse_crlf!=""){
					$body = nl2br($body);
				}
				
				// Implement BBCode
				$body = bbcode($body);
				
				if ($parse_smilies!=""){
					$body = parse_smilies($body);
				}
								
				// get the template for one item in the list
				$html_item = theme_entryview_item();

				$date_added = $row["dAdded"];
				
				// do replaces against that template to put data in place
				$html_item = str_replace("<!--entryid-->",$row["nEntryId"],$html_item);
				$html_item = str_replace("<!--entry_url-->","index.php?entryid=".$row["nEntryId"],$html_item);
				$html_item = str_replace("<!--title-->",strip_tags(stripslashes($row["cTitle"])),$html_item);
				$html_item = str_replace("<!--body-->",$body,$html_item);
				$html_item = str_replace("<!--user_added-->",strip_tags(stripslashes($row["cUserAdded"])),$html_item);
				$html_item = str_replace("<!--user_edited-->",strip_tags(stripslashes($row["cUserEdited"])),$html_item);
				$html_item = str_replace("<!--comment_count-->",$row["nComments"],$html_item);
				$html_item = str_replace("<!--comment_url-->","index.php?entryid=".$row["nEntryId"],$html_item);
				
				// if we came here from the comment_add action, show the verify tag
				if ($_GET["result"]=="posted" && get_setting("verify_comments")!="" ){
					$html_item = str_replace("<!--verify_response-->",theme_comment_verify(),$html_item);
				}
				if ($_GET["result"]=="problem"){
					$html_item = str_replace("<!--problem_response-->",theme_comment_problem(),$html_item);
				}
				
				// do date added replacements
				$a_date_added = db_datetoarray($row["dAdded"]);
				$html_item = str_replace("<!--date_added-->",$row["dAdded"],$html_item);
				$html_item = str_replace("<!--date_added_daynum-->",$a_date_added["mday"],$html_item);
				$html_item = str_replace("<!--date_added_dayname_long-->",$daynames_long[$a_date_added["wday"]-1],$html_item);
				$html_item = str_replace("<!--date_added_dayname_short-->",$daynames_short[$a_date_added["wday"]-1],$html_item);
				$html_item = str_replace("<!--date_added_monthnum-->",$a_date_added["mon"],$html_item);
				$html_item = str_replace("<!--date_added_monthname_long-->",$monthnames_long[$a_date_added["mon"]-1],$html_item);
				$html_item = str_replace("<!--date_added_monthname_short-->",$monthnames_short[$a_date_added["mon"]-1],$html_item);
				$html_item = str_replace("<!--date_added_yearnum-->",$a_date_added["year"],$html_item);
				$html_item = str_replace("<!--date_added_hour-->",$a_date_added["hours"],$html_item);
				$html_item = str_replace("<!--date_added_minute-->",str_pad($a_date_added["minutes"],2,"0",STR_PAD_LEFT),$html_item);
				$html_item = str_replace("<!--date_added_second-->",str_pad($a_date_added["seconds"],2,"0",STR_PAD_LEFT),$html_item);
				$html_item = str_replace("<!--date_added_time_short-->",($a_date_added["hours"]>12 ? $a_date_added["hours"]-12 : $a_date_added["hours"]).":".str_pad($a_date_added["minutes"],2,"0",STR_PAD_LEFT).($a_date_added["hours"]>=12 ? "pm" : "am"),$html_item);

				// do date edited replacements
				$a_date_edited = db_datetoarray($row["dEdited"]);
				$html_item = str_replace("<!--date_edited-->",$row["dEdited"],$html_item);
				$html_item = str_replace("<!--date_edited_daynum-->",$a_date_edited["mday"],$html_item);
				$html_item = str_replace("<!--date_edited_dayname_long-->",$daynames_long[$a_date_edited["wday"]-1],$html_item);
				$html_item = str_replace("<!--date_edited_dayname_short-->",$daynames_short[$a_date_edited["wday"]-1],$html_item);
				$html_item = str_replace("<!--date_edited_monthnum-->",$a_date_edited["mon"],$html_item);
				$html_item = str_replace("<!--date_edited_monthname_long-->",$monthnames_long[$a_date_edited["mon"]-1],$html_item);
				$html_item = str_replace("<!--date_edited_monthname_short-->",$monthnames_short[$a_date_edited["mon"]-1],$html_item);
				$html_item = str_replace("<!--date_edited_yearnum-->",$a_date_edited["year"],$html_item);
				$html_item = str_replace("<!--date_edited_hour-->",$a_date_edited["hours"],$html_item);
				$html_item = str_replace("<!--date_edited_minute-->",str_pad($a_date_edited["minutes"],2,"0",STR_PAD_LEFT),$html_item);
				$html_item = str_replace("<!--date_edited_second-->",str_pad($a_date_edited["seconds"],2,"0",STR_PAD_LEFT),$html_item);
				$html_item = str_replace("<!--date_edited_time_short-->",($a_date_edited["hours"]>12 ? $a_date_edited["hours"]-12 : $a_date_edited["hours"]).":".str_pad($a_date_edited["minutes"],2,"0",STR_PAD_LEFT).($a_date_edited["hours"]>=12 ? "pm" : "am"),$html_item);
				
				// build a list of categories that the entry is filed against and put them in the template
				$sql = db_sql_entry_categorylist($row["nEntryId"]);
				$result = mysql_query($sql,$con);
				if ($result!=false){
					if (mysql_num_rows($result)>0){
						unset($a_items);
						while ($row=@mysql_fetch_array($result)){
							$catlist_item = theme_entry_categorylist_item();
							$catlist_item = str_replace("<!--name-->",stripslashes($row["cCategoryName"]),$catlist_item);
							$catlist_item = str_replace("<!--url-->","index.php?categoryid=".$row["nCategoryId"],$catlist_item);

							$a_items[] = $catlist_item;
						}
						$html_catlist_items = implode("<!--entry_categorylist_seperator-->",$a_items);
						$html_catlist_items = str_replace("<!--entry_categorylist_seperator-->",theme_entry_categorylist_seperator(),$html_catlist_items);
					} else {
						$html_catlist_items = theme_entry_categorylist_noitems();
					}
				}
				$html_catlist_section = theme_entry_categorylist_section();
				$html_catlist_section = str_replace("<!--items-->",$html_catlist_items,$html_catlist_section);

				$html_item = str_replace("<!--entry_categorylist-->",$html_catlist_section,$html_item);

				// Replace the next and previous links
				if (isset($_GET["entryid"])){
					if ($_GET["entryid"]!=""){
						$html_entry_link_section = theme_entry_link_section();
						$html_entry_link_section = str_replace("<!--link_previous-->",build_previouslink($date_added),$html_entry_link_section);
						$html_entry_link_section = str_replace("<!--link_next-->",build_nextlink($date_added),$html_entry_link_section);
						$html_item = str_replace("<!--entry_link_section-->",$html_entry_link_section,$html_item);
						
					}
				}
	
				// process entry includes on the item
				$html_item = process_includes($html_item,$row["nEntryId"]);
	
				// put the constructed item inside an array
				$a_html_items[] = $html_item;
			}
			// construct the section
			$html_items = implode(theme_entryview_seperator(),$a_html_items);

		} else {
			// no entries
			$html_items = theme_entryview_noitems();
		}

		// get the section template
		$html_section = theme_entryview_section();

		// put the entries within the section template
		$html_section = str_replace("<!--items-->",$html_items,$html_section);
	
	} else {
		report_problem(1,"build_entryview ".$sql_entryview);
	}
	
	db_disconnect($con);
	
	return $html_section;
}


// Description : Constructs the HTML representing the <!--category_list--> section of a page
// Arguments   : sql_categories - the SQL required to provide records to build the HTML
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function build_categorylist($sql_categories){

	global $theme;
	
	$con = db_connect();
	$result_categories = mysql_query($sql_categories,$con);

	if ($result_categories!=false){
	
		if (mysql_num_rows($result_categories)>0){
			while ($row =@ mysql_fetch_array($result_categories)){

				// get the template for an item in the category list
				$html_item = theme_categorylist_item();

				// replace data into it from the category data
				$html_item = str_replace("<!--url-->","index.php?categoryid=".stripslashes($row["nCategoryId"]),$html_item);
				$html_item = str_replace("<!--name-->",strip_tags(stripslashes($row["cCategoryName"]))." (".$row["nCount"].")",$html_item);			

				$a_html_items[] = $html_item;
			}
			$html_items = implode(theme_categorylist_seperator(),$a_html_items);
		} else {
			$html_items = theme_categorylist_noitems();
		}

		// get the category list section template
		$html_section = theme_categorylist_section();

		// put the categories into the template
		$html_section = str_replace("<!--items-->",$html_items,$html_section);
	
	} else {
		report_problem(1,"build_categorylist ".$sql_categories);
	}
	
	db_disconnect($con);
	
	return $html_section;
}


// Description : Constructs the HTML representing the <!--comments--> section of a page
// Arguments   : sql_comments - the SQL required to provide records to build the HTML
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function build_comments($sql_comments){

	global $theme;
	global $daynames_short;
	global $daynames_long;
	global $monthnames_short;
	global $monthnames_long;
	
	global $lang;
	
	$con = db_connect();
	$result_comments = mysql_query($sql_comments,$con);
	if ($result_comments!=false){
	
		if (mysql_num_rows($result_comments)>0){
			while ($row =@ mysql_fetch_array($result_comments)){
				// get the template for a comment list item
				$html_item = theme_commentlist_item();
				
				// replace data into the template from the comment record source
				$html_item = str_replace("<!--name-->",strip_tags(stripslashes($row["cName"])),$html_item);
				$html_item = str_replace("<!--email-->",strip_tags(stripslashes($row["cEMail"])),$html_item);
				$html_item = str_replace("<!--url-->",strip_tags(stripslashes($row["cURL"])),$html_item);
				$html_item = str_replace("<!--comment-->",nl2br(strip_tags(stripslashes($row["cComment"]))),$html_item);
		
				$a_date_added = db_datetoarray($row["dAdded"]);
				$html_item = str_replace("<!--date_added-->",$row["dAdded"],$html_item);
				$html_item = str_replace("<!--date_added_daynum-->",$a_date_added["mday"]+1,$html_item);
				$html_item = str_replace("<!--date_added_dayname_long-->",$daynames_long[$a_date_added["wday"]],$html_item);
				$html_item = str_replace("<!--date_added_dayname_short-->",$daynames_short[$a_date_added["wday"]],$html_item);
				$html_item = str_replace("<!--date_added_monthnum-->",$a_date_added["mon"]+1,$html_item);
				$html_item = str_replace("<!--date_added_monthname_long-->",$monthnames_long[$a_date_added["mon"]],$html_item);
				$html_item = str_replace("<!--date_added_monthname_short-->",$monthnames_short[$a_date_added["mon"]],$html_item);
				$html_item = str_replace("<!--date_added_yearnum-->",$a_date_added["year"],$html_item);
				$html_item = str_replace("<!--date_added_hour-->",$a_date_added["hours"],$html_item);
				$html_item = str_replace("<!--date_added_minute-->",str_pad($a_date_added["minutes"],2,"0",STR_PAD_LEFT),$html_item);
				$html_item = str_replace("<!--date_added_second-->",str_pad($a_date_added["seconds"],2,"0",STR_PAD_LEFT),$html_item);
				$html_item = str_replace("<!--date_added_time_short-->",($a_date_added["hours"]>12 ? $a_date_added["hours"]-12 : $a_date_added["hours"]).":".str_pad($a_date_added["minutes"],2,"0",STR_PAD_LEFT).($a_date_added["hours"]>=12 ? "pm" : "am"),$html_item);

				$a_html_items[] = $html_item;
			}
			$html_items = implode(theme_commentlist_seperator(),$a_html_items);
		} else {
			$html_items = theme_commentlist_noitems();
		}

		// get the comment section and form templates
		$html_section = theme_commentlist_section();
		$html_comment_form = theme_comment_form();
		
		// put the comments into the template
		$html_section = str_replace("<!--items-->",$html_items,$html_section);

		// put the verify code into the comment form, and keep track of it in the session

		// make the code
		$code = "";
		$sourcedata = array("a","b","c","d","e","f","1","2","3","4","5","6","7","8","9");
		for ($i=0;$i<8;$i++){
			$code .= $sourcedata[rand(0,15)];
		}
		$_SESSION["blog_verifycode"] = $code;

		// put the verify code into the template
		$html_comment_form = str_replace("<!--verify_code-->","<img src='lib/code_image.php' width='80' height='20'>",$html_comment_form);

		// substitute the entryid placeholder
		$html_comment_form = str_replace("<!--entryid-->",$_REQUEST["entryid"],$html_comment_form);
		
		// reset the variables
		$name = "";
		$email = "";
		$url = "";
		
		// if the form values are in the COOKIES get them
		$name = $_COOKIE["pluggedout_blog_name"];
		$email = $_COOKIE["pluggedout_blog_email"];
		$url = $_COOKIE["pluggedout_blog_url"];
		
		// if the cookies were found, tick the remember box
		if ($name!=""){
			$html_comment_form = str_replace("name='remember'","name='remember' checked",$html_comment_form);
		}
		
		// if the form values are in the GET variables, use them instead
		// (they may have changed them if they are a previous commenter)
		if (isset($_REQUEST["name"])) $name = urldecode($_REQUEST["name"]);
		if (isset($_REQUEST["email"])) $email = urldecode($_REQUEST["email"]);
		if (isset($_REQUEST["url"])) $url = urldecode($_REQUEST["url"]);		
		
		$comment = urldecode($_REQUEST["comment"]);
		if (substr($comment,0,8)=="pending:"){
			$comment = str_replace("pending:","",$comment);
		}
		
		// put previous values into the comment form (they will be populated if the verify code was wrong)
		$html_comment_form = str_replace("<!--name-->",urldecode($name),$html_comment_form);
		$html_comment_form = str_replace("<!--email-->",urldecode($email),$html_comment_form);
		$html_comment_form = str_replace("<!--url-->",urldecode($url),$html_comment_form);
		$html_comment_form = str_replace("<!--comment-->",urldecode($comment),$html_comment_form);

		// put the comment form into the section template
		$html_section = str_replace("<!--comment_form-->",$html_comment_form,$html_section);
	
	} else {
		report_problem(1,"build_comments ".$sql_comments);
	}
	
	db_disconnect($con);
	
	return $html_section;
}


function build_previouslink($datetime){
	
	global $db_prefix;
	
	$con = db_connect();
	
	$sql = "SELECT nEntryId,cTitle FROM ".$db_prefix."entries WHERE dAdded<'".$datetime."' ORDER BY dAdded DESC LIMIT 1";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		$row = mysql_fetch_array($result);
		$entryid = $row["nEntryId"];
	}
	
	$html_previouslink = "<a href='index.php?entryid=".$entryid."'>".stripslashes($row["cTitle"])."</a>";
	
	//db_disconnect($con);
	
	return $html_previouslink;
	
}


function build_nextlink($datetime){

	global $db_prefix;
	
	$con = db_connect();
	
	$sql = "SELECT nEntryId,cTitle FROM ".$db_prefix."entries WHERE dAdded>'".$datetime."' ORDER BY dAdded LIMIT 1";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		$row = mysql_fetch_array($result);
		$entryid = $row["nEntryId"];
	}
		
	$html_nextlink = "<a href='index.php?entryid=".$entryid."'>".stripslashes($row["cTitle"])."</a>";
	
	//db_disconnect($con);
	
	return $html_nextlink;
}


// Description : Retrieves data from the database determined by the SQL passed to it
//               and then calls the functions (above) to generate HTML which is then
//               substituted into the page template.
// Arguments   : sql_list       - the SQL required to provide records for the entry list
//               sql_view       - the SQL required to provide records for the entry views
//               sql_categories - the SQL required to provide records for the category list
//               sql_comments   - the SQL required to provide records for the comments on an entry
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function build_page($sql_list,$sql_view,$sql_categories="",$sql_comments=""){

	global $theme;
	
	// work out the current theme (allow for an override though)
	if (isset($_REQUEST["theme"])){
		$theme = $_REQUEST["theme"];
	} else {
		$theme = theme_get_name();
	}

	// include the theme (in order for following function calls to work)
	if (file_exists("themes/".$theme."/theme.php")){
		require "themes/".$theme."/theme.php";
	} else {
		header("Location: problem.php?f=build_page&p=theme_not_found");
	}

	// look in the includes directory for any files and include them
	if ($handle = opendir('./includes')) {
		while (false !== ($file = readdir($handle))) {
			if ($file!="." && $file!=".."){
				include "includes/".$file;
			}
		}
	}

	// Call functions to build the relavant sections of the theme

	// Calendar
	$html_calendar_section = build_calendar($_REQUEST["year"],$_REQUEST["month"]);
	
	// Entry List
	$html_entrylist_section = build_entrylist($sql_list);
	
	// Entry View
	$html_entryview_section = build_entryview($sql_view);
	
	// Category List
	$html_categorylist_section = build_categorylist($sql_categories);
	
	// Comments
	if (isset($_REQUEST["entryid"])){
		$html_comment_section = build_comments($sql_comments);
	}
	
	// Replace the sections into the page template
	$html_page = theme_page();
	$html_page = str_replace("<!--calendar-->",$html_calendar_section,$html_page);
	$html_page = str_replace("<!--entry_list-->",$html_entrylist_section,$html_page);
	$html_page = str_replace("<!--entry_view-->",$html_entryview_section,$html_page);
	$html_page = str_replace("<!--category_list-->",$html_categorylist_section,$html_page);
	$html_page = str_replace("<!--comment_list-->",$html_comment_section,$html_page);
	
	// process the includes
	$html_page = process_includes($html_page);
	
	// insert a copyright notice
	$html_page = str_replace("<head>","<head>\n<meta name='generator' content='PluggedOut Blog (http://www.pluggedout.com/index.php?pk=dev_blog)'/>\n<!-- This blog is based upon the PluggedOut Blog script by Jonathan Beckett -->\n",$html_page);
	
	return $html_page;
}


// Description : accepts text and replaces tags with smilies where appropriate
// Arguments   : html - the data you want to be parsed for smilies
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function parse_smilies($html){

	$html = str_replace(":D","<img src='images/smilies/icon_biggrin.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":)","<img src='images/smilies/icon_smile.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":(","<img src='images/smilies/icon_sad.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":o","<img src='images/smilies/icon_surprised.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":shock:","<img src='images/smilies/icon_eek.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":?","<img src='images/smilies/icon_confused.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace("8)","<img src='images/smilies/icon_cool.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":lol:","<img src='images/smilies/icon_lol.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":x","<img src='images/smilies/icon_mad.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":P","<img src='images/smilies/icon_razz.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":oops:","<img src='images/smilies/icon_redface.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":cry:","<img src='images/smilies/icon_cry.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":evil:","<img src='images/smilies/icon_evil.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":twisted:","<img src='images/smilies/icon_twisted.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":roll:","<img src='images/smilies/icon_rolleyes.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":wink:","<img src='images/smilies/icon_wink.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":!:","<img src='images/smilies/icon_exclaim.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":?:","<img src='images/smilies/icon_question.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":idea:","<img src='images/smilies/icon_idea.gif' width='15' height='15' title='Big Grin'>",$html);
	$html = str_replace(":arrow:","<img src='images/smilies/icon_arrow.gif' width='15' height='15' title='Big Grin'>",$html);

	return $html;
}


// *****************************************************************************************
// **                                  PUBLIC FUNCTIONS                                   **
// *****************************************************************************************


// Description : Calls functions from the database library to generate appropriate SQL
//               statements to show the blog interface with one entry
// Arguments   : entryid - the ID of one entry to show
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_view_entry($entryid){
	
	// Prepare SQL
	$sql_list = db_sql_entries_entry($entryid);
	$sql_view = db_sql_entries_entry($entryid);
	$sql_categories = db_sql_categorylist();
	$sql_comments = db_sql_comments($entryid);
	
	// Build the page
	$html = build_page($sql_list,$sql_view,$sql_categories,$sql_comments);
		
	return $html;
}


// Description : Calls functions from the database library to generate appropriate SQL
//               statements to show the blog interface with all the entries matching
//               the category passed in, then calls build_page in order to construct
//               HTML for the page
// Arguments   : categoryid - the id of the one category to show entries for
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_view_category($categoryid){

	// Prepare SQL
	$sql_list = db_sql_entries_category($categoryid);
	$sql_view = db_sql_entries_category($categoryid);
	$sql_categories = db_sql_categorylist();
	
	// Build the page
	$html = build_page($sql_list,$sql_view,$sql_categories,$sql_comments);
	
	return $html;
}


// Description : Calls functions from the database library to generate appropriate SQL
//               statements to show the blog interface with all the entries matching
//               the search keywords passed in, then calls build_page in order to
//               construct HTML for the page
// Arguments   : keywords - the keywords to filter entries by
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_view_search($keywords){

	// Prepare SQL
	$sql_list = db_sql_entries_search($keywords);
	$sql_view = db_sql_entries_search($keywords);
	$sql_categories = db_sql_categorylist();

	// Build the page	
	$html = build_page($sql_list,$sql_view,$sql_categories,$sql_comments);
	
	return $html;
}


// Description : Calls functions from the database library to generate appropriate SQL
//               statements to show the blog interface with all the entries posted on
//               the year and month passed in, then calls build_page in order to
//               construct HTML for the page
// Arguments   : year  - the year to show entries for
//               month - the month to show entries for
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_view_month($year,$month){
	
	// Prepare SQL
	$sql_list = db_sql_entries_month($year,$month);
	$sql_view = db_sql_entries_month($year,$month);
	$sql_categories = db_sql_categorylist();
	
	// Build the page
	$html = build_page($sql_list,$sql_view,$sql_categories,$sql_comments);
	
	return $html;
}


// Description : Calls functions from the database library to generate appropriate SQL
//               statements to show the blog interface with all the entries posted on
//               the year, month and day passed in, then calls build_page in order to
//               construct HTML for the page
// Arguments   : year  - the year to show entries for
//               month - the month to show entries for
//               day   - the day to show entries for
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_view_day($year,$month,$day){
	
	// Prepare SQL
	$sql_list = db_sql_entries_day($year,$month,$day);
	$sql_view = db_sql_entries_day($year,$month,$day);
	$sql_categories = db_sql_categorylist();
	
	// Build the page
	$html = build_page($sql_list,$sql_view,$sql_categories,$sql_comments);
	
	return $html;

}

// Description : Calls functions from the database library to generate appropriate SQL
//               statements to show the blog interface with the last N entries (global
//               variable set in the Config file), then calls build_page in order to
//               construct HTML for the page
// Arguments   : None (it uses the settings table to default itself)
// Returns     : HTML
// Last Change : 2005-04-02
// Author      : Jonathan Beckett (jonbeckett@pluggedout.com)
function html_view_default(){
	
	// get the number of entries to show from the settings table
	$limit = get_setting("default_entry_list_limit");
	
	// prepare SQL
	$sql_list = db_sql_entries_default($limit);
	$sql_view = db_sql_entries_default($limit);
	$sql_categories = db_sql_categorylist();
	
	// Build the page
	$html = build_page($sql_list,$sql_view,$sql_categories,$sql_comments);
	
	return $html;

}



?>