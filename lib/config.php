<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : config.php
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

// Change the settings within this file (listed below) to connect the 
// Blog scripts to your database server.


// Database Server
// ---------------
// This setting must reflect the name of your database server. If you are
// installing everything on your own system this will probably be 'localhost'
// - if you are using a commercial web host, the name of the database server
// should have been communicated to you by your host when you set the account up

$db_server = "...";


// Database Name
// -------------
// This setting must reflect the name of the database you have created the
// Blog database tables on. If you are using a commercial web host with a free
// MySQL account, the name of your database should have been sent to you when
// you set the account up.

$db_name = "...";


// Database Username
// -----------------
// This setting must reflect your MySQL user account name. The factory
// default for MySQL installations is 'root'. If you are using a commercial
// web host you will have been notified of your database username when they
// set the account up.

$db_username = "...";


// Database Password
// -----------------
// This setting must reflect your MySQL user password. The factory default
// for MySQL installations is blank. If you are using a commercial web host
// you will have been notified of the database password when they set the
// account up.
$db_password = "...";


// Database Table Prefix
// ---------------------
// Although the blog script is distributed with a default prefix of blog2_
// (also reflected in the database.sql file), there is nothing to stop you
// renaming the tables and using the prefix setting here to ensure the script
// uses the correct tables within your database.
$db_prefix = "blog2_";





// Reset Admin Password
// --------------------

// If you put a new password into the variable below, and then call the URL
// http://yourblog/admin/reset_admin_password.php, the admin password
// will be changed to this setting. Remember to clear it again afterwards.

$reset_admin_password = "";


// ***************************************************************************
// **     PRIVATE SECTION - DO NOT CHANGE PROGRAMMING BEYOND THIS POINT     **
// ***************************************************************************

// Prepare global variables for use later
$theme = "";

$language = "english";


?>