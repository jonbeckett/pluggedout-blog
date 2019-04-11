<?php
/*
#===========================================================================
#= Project: PluggedOut Blog
#= File   : lang/english.php
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


// About this Language File
// ------------------------
// This file should reside in the /lang directory within the blog root, and provides
// the various piece of descriptive language used throughout the blog administration
// interface. If you want to make another language file, copy this one, change the
// values of all the array elements appropriately, and then set the language to use
// to the filename you have chosen in the blog config file.



// Month and Day Names
// -------------------
// Instead of using the country coding of your webserver, PluggedOut Blog lets you specify
// your own language constants for days and months of the year.
// Change the data in the arrays below in order to reflect your own language

$daynames_long = Array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$daynames_short = Array("M","T","W","T","F","S","S");
$monthnames_long = Array("January","February","March","April","May","June","July","August","September","October","November","December");
$monthnames_short = Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");


// General Words, Phrases and Sentences
// ------------------------------------

$lang["add_category"] = "Add Category";
$lang["add_category_description"] = "Use the form below to add categories to the category list. You can then file entries against the categories.";
$lang["add_entry"] = "Add Entry";
$lang["add_user"] = "Add User";
$lang["add_user_description"] = "Fill in the blanks in the form below to add a user to the system. As a quick guide, 'Administrators' can do everything in the administration interface, Authors can do everything except modify users, and Contributors can only post new entries.";
$lang["admin_results_per_page"] = "Admin Results Per Page";
$lang["admin_results_per_page_description"] = "size of lists in admin pages";
$lang["administrator"] = "Administrator";
$lang["approve"] = "Approve";
$lang["ascending"] = "Ascending";
$lang["author"] = "Author";
$lang["banned_words"] = "Banned Words";
$lang["banned_words_description"] = "Comma seperated list of words not allowed in comments";
$lang["banner_title"] = "PluggedOut Blog Administration Interface";
$lang["blog_settings"] = "Blog Settings";
$lang["blog_title"] = "Blog Title";
$lang["body"] = "Body";
$lang["browse_files"] = "Browse Files";
$lang["browse_files_description"] = "Use the form below to browse files, upload files and remove files from your system.";
$lang["by"] = "by";
$lang["categories"] = "Categories";
$lang["category"] = "Category";
$lang["category_list"] = "Category List";
$lang["category_list_description"] = "The list below shows the categories you can file entries against. You can edit and remove categories from here.";
$lang["category_name"] = "Category Name";
$lang["comment_list"] = "Comment List";
$lang["comment_list_description"] = "This list shows the most recent comments published to the blog script. If you have the appropriate privilages you can approve, reject or remove them.";
$lang["comment_code"] = "Comment Code";
$lang["comment_code_description"] = "anti-spam verification codes";
$lang["comment_order"] = "Comment Order";
$lang["comment"] = "Comment";
$lang["comments"] = "Comments";
$lang["comment_edit_description"] = "The comment editing form lets you change the contents of a comment.";
$lang["comment_list"] = "Comment List";
$lang["comment_remove_description"] = "The comment remove form confirms that you want to remove a comment.";
$lang["contributor"] = "Contributor";
$lang["controls"] = "Controls";
$lang["copyright"] = "Copyright";
$lang["create"] = "Create";
$lang["create_dir_here"] = "Create Dir Here";
$lang["date"] = "Date";
$lang["dateadded"] = "Date Added";
$lang["descending"] = "Descending";
$lang["description"] = "Description";
$lang["directories"] = "Directories";
$lang["edit"] = "Edit";
$lang["edit_category"] = "Edit Category";
$lang["edit_category_description"] = "Use the form below to edit the category name. Any entries already filed against the category will become filed against the renamed category.";
$lang["edit_comment"] = "Edit Comment";
$lang["edit_entry"] = "Edit Entry";
$lang["edit_settings"] = "Edit Settings";
$lang["edit_template_file"] = "Edit Template File";
$lang["edit_template_file_description"] = "Use this page to edit a template file. Remember to save your changes.";
$lang["edit_user"] = "Edit User";
$lang["edit_user_description"] = "Fill in the blanks in the form below to edit a user in the system. As a quick guide, 'Administrators' can do everything in the administration interface, Authors can do everything except modify users, and Contributors can only post new entries.";
$lang["editor"] = "Editor";
$lang["email"] = "E-Mail";
$lang["entries"] = "Entries";
$lang["entry_add_description"] = "Fill in the form below to add an entry to the blog - and don't forget to set some categories to file your entry against. Remember that if you are only a 'contributor' user, your entry will not automatically be set to 'Publish'.";
$lang["entry_edit_description"] = "Use the form below to make changes to a blog entry. Remember to click the 'Make Changes' button when you have finished.";
$lang["entry_remove_description"] = "You have chosen to remove this entry. Please check that the entry displayed below is correct before clicking on 'Remove Entry'. Be careful - you cannot undo this operation.";
$lang["entry_view_description"] = "The view entry form shows you the entry, and any comments it may have. You can use this form to edit and remove comments.";
$lang["entry_list"] = "Entry List";
$lang["entry_list_description"] = "This section shows the entries within the blog, with the option to edit or remove each entry.";
$lang["filename"] = "Filename";
$lang["files"] = "Files";
$lang["forbidden"] = "Forbidden";
$lang["forbidden_description"] = "You have requested a section of the administration interface that you do not have sufficient privilages to access.";
$lang["general"] = "General";
$lang["home"] = "Home";
$lang["image_url"] = "Image (URL)";
$lang["keywords"] = "Keywords";
$lang["language"] = "Language";
$lang["list_categories"] = "List Categories";
$lang["list_comments"] = "List Comments";
$lang["list_controls"] = "List Controls";
$lang["list_entries"] = "List Entries";
$lang["list_result_end"] = " records in total) : ";
$lang["list_result_start"] = "List Results (";
$lang["list_users"] = "List Users";
$lang["logged_in_as"] = "Logged in as";
$lang["login"] = "Login";
$lang["login_failure"] = "The username and/or password you used was not found.";
$lang["logout"] = "Logout";
$lang["main_menu"] = "Main Menu";
$lang["make_changes"] = "Make Changes";
$lang["misc"] = "Misc";
$lang["name"] = "Name";
$lang["no_categories_defined"] = "There are no categories defined.";
$lang["no_comments_yet"] = "This entry has no comments yet.";
$lang["no_comment_found"] = "No comment found.";
$lang["no_entries_returned"] = "No Entries Returned";
$lang["no_users_defined"] = "There are no users";
$lang["not_files_against_categories"] = "Not filed against any categories";
$lang["not_found"] = "Not Found";
$lang["notify_comments"] = "Notify Comments";
$lang["notify_comments_description"] = "notification goes to the author email address from the admin email address<br> - both need to be valid for it to work";
$lang["on"] = "on";
$lang["page_title"] = "Blog Administration Interface";
$lang["parse_crlf"] = "Parse CR/LF";
$lang["parse_crlf_description"] = "Check to turn carriage returns to break tags in entries";
$lang["parse_smilies"] = "Parse Smilies";
$lang["password"] = "Password";
$lang["path"] = "Path";
$lang["powered_by_pluggedout"] = "Powered by PluggedOut";
$lang["preview"] = "Preview";
$lang["problem_response"] = "Your comment could not be added - you either entered a banned word, or the verify code did not match.";
$lang["published"] = "Published";
$lang["publish"] = "Publish";
$lang["unpublish"] = "Un-Publish";
$lang["reject"] = "Reject";
$lang["remove"] = "Remove";
$lang["remove_category"] = "Remove Category";
$lang["remove_category_description"] = "You have chosen to remove this category. Please check that the category displayed below is correct before clicking on 'Remove Category'. Be careful - you cannot undo this operation.";
$lang["remove_comment"] = "Remove Comment";
$lang["remove_entry"] = "Remove Entry";
$lang["remove_user"] = "Remove User";
$lang["remove_user_description"] = "You have chosen to remove this user. Please check that the user displayed below is correct before clicking on 'Remove User'. Also, make sure you choose an appropriate user to replace this one for 'added by' and 'edited by' data on entries created and changed by this user. Be careful - you cannot undo this operation.";
$lang["replace_with"] = "Replace With";
$lang["replace_with_description"] = "re-assign author of existing entries";
$lang["role"] = "Role";
$lang["root_url"] = "Root URL";
$lang["rss_settings"] = "RSS Settings";
$lang["select"] = "Select";
$lang["selected"] = "Selected";
$lang["settings"] = "Settings";
$lang["settings_description"] = "Use the form below to edit the blog settings.";
$lang["show_html"] = "Show HTML";
$lang["size_bytes"] = "Size (Bytes)";
$lang["size_w_h"] = "Size (w x h)";
$lang["status"] = "Status";
$lang["submit"] = "Submit";
$lang["templates"] = "Templates";
$lang["template_file"] = "Template File";
$lang["template_files"] = "Template Files";
$lang["template_files_description"] = "This page gives you access to the Template files. Note that you can only edit them through the web interface if they are writeable.";
$lang["template_file_not_found"] = "Template File Not Found";
$lang["theme_list"] = "Theme List";
$lang["theme_list_description"] = "Choose the active theme from the list below. Note that you can also edit the theme template files directly from the web interface via the edit links - the files need to be writable for this to be enabled though.";
$lang["themes"] = "Themes";
$lang["timedelta"] = "Time Delta";
$lang["timedelta_description"] = "change the apparent server times";
$lang["title"] = "Title";
$lang["ttl"] = "TTL";
$lang["ttl_description"] = "Time to Live - default = 60";
$lang["unpublished"] = "Un-Published";
$lang["upload_file"] = "Upload File";
$lang["upload_here"] = "Upload Here";
$lang["url"] = "URL";
$lang["user_list"] = "User List";
$lang["user_list_description"] = "The table below shows the users of the system. You can edit and remove users from here if you are an 'Administrator'.";
$lang["username"] = "Username";
$lang["users"] = "Users";
$lang["verify_comments"] = "Verify Comments";
$lang["verify_comments_description"] = "comments will not appear until approved";
$lang["verify_response"] = "Your comment has been submitted and is now subject to approval before appearing in the blog.";
$lang["view"] = "View";
$lang["view_blog"] = "View Blog";
$lang["view_entry"] = "View Entry";
$lang["visit"] = "Visit the development homepage";
$lang["visitor_entries_per_page"] = "Visitor Entries Per Page";
$lang["visitor_entries_per_page_description"] = "number of blog entries appearing to visitors";
$lang["webmaster"] = "Webmaster";

?>