# PluggedOut Blog


I originally wrote the PluggedOut Blog script in 2003/2004 for my own use, and ended up
making it available as open source software. At one time there were thousands of instances
of it installed all over the world, and it was bundled with the Novell Web Server software.

I haven't looked at the code in years now, but it still works if you're interested in playing with it.


## Contents

 - Introduction
 - Requirements
 - Installation Steps
 - Overview of Themes
 - Overview of Plugins / Includes
 - Development & Support
 - About the Developer
 - Contact Information
 


## Introduction

PluggedOut Blog is an open source Online Diary/Journal solution written
by Jonathan Beckett. It is intended as a "starting point" for you
to build on top of for your own solution - although you must retain
the comments at the top of each page and the accompanying files
(such as this one) detailing things like the project homepage
for the benefit of others.

If you are new to the world of web development, PluggedOut Blog has a
development discussion board (the URL is provided below) for users of
the script to request help and to swap tips with each other.

It is important that the blog script is not seen as a "solution". You
may not be able to just "plug it in and go", so should not complain if
you find your web host causes complications.

If nothing else, please use PluggedOut Blog to help you learn about PHP
and MySQL. It is highly recommended that you use a database administration
tool like PHPMyAdmin to setup your database if you don't already have one
(it makes things much easier for anybody but MySQL gurus). If you do get
stuck, please do visit the support forums detailed in this file - there
are lots of people helping each other there, and of course I am on hand
in the forums too.

Regards

Jonathan Beckett



## Requirements

 - PHP >= 4.x
 - MySQL >= 4.x
 - Apache or IIS (really any web server that will run PHP/MySQL)



## Installation Steps

  
  1. Place the unzipped files somewhere into your web root. Be careful to
     make sure your extraction software maintains the directory structure
     present within the ZIP file when you extract.
     
  2. Make sure the uploads directory is readable and writeable (use CHMOD),
     and that the themes directory, it's subdirectories and the files within
     are readable by everybody. Make sure the rss.xml file is writable.

  3. Change the lib/config.php script to suit your database settings.
     
  4. Run the admin/install.php script through your browser - this creates
     all the tables required for the project.
  
  5. That's it!  You can now access the blog via the path you installed it
     in your webserver. To add and edit entries, visit the URL on your system
     similar to the one depicted below;

          http://yourdomain/admin/index.php

     The default login created for the system (that you can change as soon
     as you are logged in is as follows;
          username : admin
          password : password
          


## Overview of Themes


Most people are going to want to modify the Blog script heavily to suit
the look and feel they want. Blog supports themes through chunks of HTML
stored in a simple file system within subfolders of the "themes" directory.
To create a theme, just copy the "default" theme folder to a differently
named folder (the name of the folder is the name of the theme), and start
fiddling with the html files contained.

* There is a very good diagram in the /docs directory showing you
  how the theme template files fit together.
  
In general, the theme files can all be thought of as being "glued" together
by the system when people ask for a page. The bits and pieces of HTML in the
various HTML files are added together like so;

  1. The system gets the blog entries from the database

  2. The system puts the data from the blog entries into entry_view_item
     templates - substituting the data for markers within the template. The
     available markers for entries are;

     <!--entryid-->        The database ID of the entry
     <!--entry_url-->      The URL required to view the specific entry
     <!--title-->          The title of the entry
     <!--body-->           The body of the entry
     <!--user_added-->     The user who added the entry
     <!--user_edited-->    The user who edited the entry
     <!--comment_count-->  The number of comments against the entry
     <!--comment_url-->    The URL required to view the comments
     <!--entry_categorylist-->  The list of categories an entry is filed against
     
     The date added and date edited can both be substituted in via
     markers similar to those below (modify them for "edited")

     <!--date_added-->                 Date in yyyy-mm-dd hh:mm:ss format
     <!--date_added_daynum-->          Day of the Month (1 to 31)
     <!--date_added_dayname_long-->    The long dayname (e.g. "Wednesday")
     <!--date_added_dayname_short-->   The short dayname (e.g. "Wed")
     <!--date_added_monthnum-->        The month number (1 to 12)
     <!--date_added_monthname_long-->  The long monthname (e.g. "March")
     <!--date_added_monthname_short--> The short monthname (e.g. "Mar")
     <!--date_added_yearnum-->         The year number (e.g. 2005)
     <!--date_added_hour-->            Hour of the day (0-23)
     <!--date_added_minute-->          Minute of the hour (0-59)
     <!--date_added_second-->          Seconds of the minute (0-59)
     
  3. The system glues all the item templates together and puts them into
     the entry_view_section, putting the entry_view_sep template between
     each entry_view_item template.
  
  (the same basic process applies for entry_list as entry_view)
  
  4. The system builds the category list by picking up the category_list
     template, and filling it with categorylist_item templates, which can
     have the following substitutions;
     
     <!--url-->    The URL needed to show the entries within the category
     <!--name-->   The name of the category

  The basic ideas described here are followed throughout the templates,
  with the final chunks substituted into the page template.
  
  If you have questions about making themes, feel free to post to the
  PluggedOut Blog development forum.
  
  

## Overview of Plugins / Includes

You can put your own PHP files in the "/includes" directory, and call
them from blog entries or tempaltes by writing a BBCode tag as follows;

  [include:your_function_name]
  
... where "your_function_name" is the name of a function residing in a
PHP file within the includes directory. There are a couple of example
functions distributed with the Blog script to get you started.



## About The Developer

The PluggedOut Blog script was written by Jonathan Beckett. In the daytime
he is a professional software and website developer, working in both
the Windows and Linux worlds. He's usually got time to reply to emails,
but he would encourage you to visit the PluggedOut Blog support
forum if you are stuck.



## Contact Information

**Jonathan Beckett**
jonathan.beckett@gmail.com

