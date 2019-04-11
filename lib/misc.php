<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : lib/misc.php
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



function set_setting($name,$value){
	
	global $db_prefix;
	
	$con = db_connect();
	
	// find out if the setting already exists
	// - update it or insert it accordingly
	$sql = "SELECT * FROM ".$db_prefix."settings WHERE cName='".mysql_escape_string($name)."'";
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$sql = "UPDATE ".$db_prefix."settings SET cValue='".mysql_escape_string($value)."' WHERE cName='".mysql_escape_string($name)."'";
			$result = mysql_query($sql,$con);
			if ($result!=false){
				$result = "";
			} else {
				report_problem(1,"set_setting ".$sql);
			}
		} else {
			$sql = "INSERT INTO ".$db_prefix."settings (cName,cValue) VALUES ('".mysql_escape_string($name)."','".mysql_escape_string($value)."')";
			$result = mysql_query($sql,$con);
			if ($result!=false){
				$result = "";
			} else {
				report_problem(1,"set_setting ".$sql);
			}
		}
	} else {
		report_problem(1,"set_setting ".$sql);
	}
	
	//db_disconnect($con);
	
	return $result;
}

function get_setting($name){
	global $db_prefix;
	$con = db_connect();
	$sql = "SELECT * FROM ".$db_prefix."settings WHERE cName='".mysql_escape_string($name)."'";
	//print " ".$sql;
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$row = mysql_fetch_array($result);
			$value = stripslashes($row["cValue"]);
		} else {
			$value = "";
		}
	} else {
		report_problem(1,"get_setting ".$sql);
	}
	//db_disconnect($con);
	return $value;
}

function get_user_role($userid){
	global $db_prefix;
	$con = db_connect();
	$sql = "SELECT cRole FROM ".$db_prefix."users WHERE nUserId=".$userid;
	$result = mysql_query($sql,$con);
	if ($result!=false){
		if (mysql_num_rows($result)>0){
			$row = mysql_fetch_array($result);
			$role = stripslashes($row["cRole"]);
		} else {
			$role = "";
		}
	} else {
		$role = "";
	}
	return $role;
}

function report_problem($id,$data=""){
	header("Location: problem.php?id=".$id."&data=".$data);
}

function bbcode($data){

	//$data = nl2br(htmlspecialchars($data));

	$patterns = array(
		'`\[b\](.+?)\[/b\]`is',
		'`\[i\](.+?)\[/i\]`is',
		'`\[u\](.+?)\[/u\]`is',
		'`\[strike\](.+?)\[/strike\]`is',
		'`\[color=#([0-9]{6})\](.+?)\[/color\]`is',
		'`\[email\](.+?)\[/email\]`is',
		'`\[img\](.+?)\[/img\]`is',
		'`\[url=([a-z0-9]+://)([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\](.*?)\[/url\]`si',
		'`\[url\]([a-z0-9]+?://){1}([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\[/url\]`si',
		'`\[url\]((www|ftp)\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\[/url\]`si',
		'`\[flash=([0-9]+),([0-9]+)\](.+?)\[/flash\]`is',
		'`\[quote\](.+?)\[/quote\]`is',
		'`\[indent](.+?)\[/indent\]`is',
		'`\[size=([1-6]+)\](.+?)\[/size\]`is'
	);

	$replaces = array(
		'<strong>\\1</strong>',
		'<em>\\1</em>',
		'<span style="border-bottom: 1px dotted">\\1</span>',
		'<strike>\\1</strike>',
		'<span style="color:#\1;">\2</span>',
		'<a href="mailto:\1">\1</a>',
		'<img src="\1" alt="" style="border:0px;" />',
		'<a href="\1\2">\6</a>',
		'<a href="\1\2">\1\2</a>',
		'<a href="http://\1">\1</a>',
		'<object width="\1" height="\2"><param name="movie" value="\3" /><embed src="\3" width="\1" height="\2"></embed></object>',
		'<strong>Quote:</strong><div style="margin:0px 10px;padding:5px;background-color:#F7F7F7;border:1px dotted #CCCCCC;width:80%;"><em>\1</em></div>',
		'<ul>\\1</ul>',
		'<h\1>\2</h\1>'
	);

	$data = preg_replace($patterns, $replaces , $data);

	return $data;
}

function process_includes($html){
	
	// find all the include tags, and put them into an array
	preg_match_all("/\[include:((.+))\]/i",$html,$a_inc_result);
	
	// loop through the found tags and replace them with the results of their contents
	foreach ($a_inc_result as $func){
		// rembering that match collections are an array of arrays...
		foreach ($func as $afunc){
			if ($afunc!="" && substr($afunc,0,1)!="["){
				$call_func = $afunc;
				$html_fn_result = call_user_func($call_func);
				$html = str_replace("[include:".$call_func."]",$html_fn_result,$html);
			}
		}
	}
	return $html;
}

function process_entry_includes($html,$entryid){
	
	// find all the include tags, and put them into an array
	preg_match_all("/\[entry_include:((.+))\]/i",$html,$a_inc_result);
	
	// loop through the found tags and replace them with the results of their contents
	foreach ($a_inc_result as $func){
		// rembering that match collections are an array of arrays...
		foreach ($func as $afunc){
			if ($afunc!="" && substr($afunc,0,1)!="["){
				$call_func = $afunc;
				$html_fn_result = call_user_func($call_func,$entryid);
				$html = str_replace("[include:".$call_func."]",$html_fn_result,$html);
			}
		}
	}
	return $html;
}
?>