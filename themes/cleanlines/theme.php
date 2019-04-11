<?php

// example theme file

function theme_page(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/page.htm");
	return $html;
}

function theme_entrylist_section(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entrylist_section.htm");
	return $html;
}

function theme_entrylist_item(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entrylist_item.htm");
	return $html;
}

function theme_entrylist_seperator(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entrylist_seperator.htm");
	return $html;
}

function theme_entrylist_noitems(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entrylist_noitems.htm");
	return $html;
}

function theme_calendar_section(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/calendar_section.htm");
	return $html;
}

function theme_calendar_day_heading(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/calendar_day_heading.htm");
	return $html;
}

function theme_calendar_day_today(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/calendar_day_today.htm");
	return $html;
}

function theme_calendar_day_on(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/calendar_day_on.htm");
	return $html;
}

function theme_calendar_day_off(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/calendar_day_off.htm");
	return $html;
}
function theme_calendar_day_empty(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/calendar_day_empty.htm");
	return $html;
}

function theme_calendar_row_seperator(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/calendar_row_seperator.htm");
	return $html;
}

function theme_entryview_section(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entryview_section.htm");
	return $html;
}

function theme_entryview_item(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entryview_item.htm");
	return $html;
}

function theme_entryview_seperator(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entryview_seperator.htm");
	return $html;
}

function theme_entryview_noitems(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entryview_noitems.htm");
	return $html;
}

function theme_commentlist_section(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/commentlist_section.htm");
	return $html;
}

function theme_commentlist_item(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/commentlist_item.htm");
	return $html;
}

function theme_commentlist_noitems(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/commentlist_noitems.htm");
	return $html;
}

function theme_commentlist_seperator(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/commentlist_seperator.htm");
	return $html;
}

function theme_comment_form(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/comment_form.htm");
	return $html;
}

function theme_categorylist_section(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/categorylist_section.htm");
	return $html;
}

function theme_categorylist_item(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/categorylist_item.htm");
	return $html;
}

function theme_categorylist_noitems(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/categorylist_noitems.htm");
	return $html;
}

function theme_categorylist_seperator(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/categorylist_seperator.htm");
	return $html;
}


function theme_entry_categorylist_section(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entry_categorylist_section.htm");
	return $html;
}

function theme_entry_categorylist_item(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entry_categorylist_item.htm");
	return $html;
}

function theme_entry_categorylist_seperator(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entry_categorylist_seperator.htm");
	return $html;
}

function theme_entry_categorylist_noitems(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entry_categorylist_noitems.htm");
	return $html;
}

function theme_entry_link_section(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/entry_link_section.htm");
	return $html;
}

function theme_comment_verify(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/comment_verify.htm");
	return $html;
}

function theme_comment_problem(){
	global $theme;
	$html = file_get_contents("themes/".$theme."/comment_problem.htm");
	return $html;
}

?>