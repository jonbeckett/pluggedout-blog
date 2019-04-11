-- phpMyAdmin SQL Dump
-- version 2.6.0-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 15, 2005 at 05:31 PM
-- Server version: 4.0.18
-- PHP Version: 4.3.4
-- 
-- Database: `blog2`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `blog2_categories`
-- 

CREATE TABLE `blog2_categories` (
  `nCategoryId` bigint(20) NOT NULL auto_increment,
  `cCategoryName` varchar(254) NOT NULL default '',
  PRIMARY KEY  (`nCategoryId`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `blog2_categories`
-- 

INSERT INTO `blog2_categories` VALUES (1, 'Default');


-- --------------------------------------------------------

-- 
-- Table structure for table `blog2_comments`
-- 

CREATE TABLE `blog2_comments` (
  `nCommentId` bigint(20) NOT NULL auto_increment,
  `nEntryId` bigint(20) NOT NULL default '0',
  `cComment` mediumtext NOT NULL,
  `cName` varchar(254) NOT NULL default '',
  `cEMail` varchar(254) NOT NULL default '',
  `cURL` varchar(254) NOT NULL default '',
  `dAdded` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nCommentId`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `blog2_entries`
-- 

CREATE TABLE `blog2_entries` (
  `nEntryId` bigint(20) NOT NULL auto_increment,
  `dAdded` datetime NOT NULL default '0000-00-00 00:00:00',
  `dEdited` datetime NOT NULL default '0000-00-00 00:00:00',
  `nUserAdded` bigint(20) NOT NULL default '0',
  `nUserEdited` bigint(20) NOT NULL default '0',
  `cTitle` varchar(254) NOT NULL default '',
  `cBody` mediumtext NOT NULL,
  `cTags` varchar(254) NOT NULL default '',
  `nComments` bigint(20) NOT NULL default '0',
  `cStatus` char(1) NOT NULL default '',
  PRIMARY KEY  (`nEntryId`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `blog2_entries`
-- 

INSERT INTO `blog2_entries` VALUES (1, '2005-07-11 00:00:00', '2005-07-11 00:00:00', 1, 1, 'Test Entry', 'This is a quick test entry just to make sure this is working okay', '', 4, 'P');


-- --------------------------------------------------------

-- 
-- Table structure for table `blog2_entry_categories`
-- 

CREATE TABLE `blog2_entry_categories` (
  `nEntryCategoryId` bigint(20) NOT NULL auto_increment,
  `nEntryId` bigint(20) NOT NULL default '0',
  `nCategoryId` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`nEntryCategoryId`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `blog2_settings`
-- 

CREATE TABLE `blog2_settings` (
  `cName` varchar(254) NOT NULL default '',
  `cValue` varchar(254) NOT NULL default '',
  PRIMARY KEY  (`cName`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `blog2_settings`
-- 

INSERT INTO `blog2_settings` VALUES ('theme', 'default');
INSERT INTO `blog2_settings` VALUES ('crypt_salt', 'default');
INSERT INTO `blog2_settings` VALUES ('results_per_page', '25');
INSERT INTO `blog2_settings` VALUES ('default_entry_list_limit', '10');

-- --------------------------------------------------------

-- 
-- Table structure for table `blog2_statistics`
-- 

CREATE TABLE `blog2_statistics` (
  `nStatId` bigint(20) NOT NULL auto_increment,
  `nEntryId` bigint(20) NOT NULL default '0',
  `dViewed` datetime NOT NULL default '0000-00-00 00:00:00',
  `cIP` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`nStatId`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `blog2_statistics`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `blog2_users`
-- 

CREATE TABLE `blog2_users` (
  `nUserId` bigint(20) NOT NULL default '0',
  `cUsername` varchar(30) NOT NULL default '',
  `cPassword` varchar(30) NOT NULL default '',
  `cEMail` varchar(254) NOT NULL default '',
  `cRole` varchar(12) NOT NULL default '',
  UNIQUE KEY `nUserId` (`nUserId`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `blog2_users`
-- 

INSERT INTO `blog2_users` VALUES (1, 'admin', 'deQcvEr1PRPSM', '', 'admin');

        