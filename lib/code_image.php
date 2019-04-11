<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : admin/exec.php
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

session_start();

$code = $_SESSION["blog_verifycode"];

header("Content-type: image/jpeg");
$img = imagecreate(80,20);

$bgcolor = imagecolorallocate($img,255,255,255);
$textcolor = imagecolorallocate($img,0,0,0);

// fill the background
imagefilledrectangle($img,0,0,79,19,$bgcolor);
imagerectangle($img,0,0,79,19,$textcolor);

// put text in
imagestring($img,5,4,2,$code,$textcolor);

// output
imagejpeg($img,NULL,50);

// cleanup
imagedestroy($img);

?>
