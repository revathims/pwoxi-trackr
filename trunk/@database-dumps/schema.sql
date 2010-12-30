-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2010 at 06:14 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trackr`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `clientsid` bigint(20) NOT NULL AUTO_INCREMENT,
  `cid` bigint(20) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `contact_type` varchar(45) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `datecreated` int(11) NOT NULL,
  PRIMARY KEY (`clientsid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientsid`, `cid`, `first_name`, `last_name`, `company_name`, `contact_type`, `email`, `phone`, `fax`, `address`, `url`, `datecreated`) VALUES
(1, 2, 'Anshu', 'Aggerwal', 'Zebek', '0', 'kaa@sss.com', '001+4484+48484', '001+4484+48484', '', 'http://www.zebek.com', 1293714657);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `cid` bigint(20) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='All companies.' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`cid`, `company_name`, `phone`, `fax`, `address`, `url`, `logo`) VALUES
(2, 'Softmatics', NULL, NULL, NULL, NULL, NULL),
(3, 'Zebek', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logging`
--

DROP TABLE IF EXISTS `logging`;
CREATE TABLE IF NOT EXISTS `logging` (
  `logid` bigint(20) NOT NULL AUTO_INCREMENT,
  `text` text,
  `uid` bigint(20) DEFAULT NULL,
  `cid` bigint(20) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `targetid` bigint(20) DEFAULT NULL,
  `datelogged` bigint(20) NOT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `logging`
--

INSERT INTO `logging` (`logid`, `text`, `uid`, `cid`, `type`, `targetid`, `datelogged`) VALUES
(1, 'Zebek is added as one of clients.', 21, 2, 'clients', 1, 1293714657);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `projectid` bigint(20) NOT NULL AUTO_INCREMENT,
  `cid` bigint(20) NOT NULL,
  `clientsid` bigint(20) NOT NULL,
  `project_name` varchar(100) DEFAULT NULL,
  `project_overview` varchar(512) DEFAULT NULL,
  `project_status` tinyint(4) DEFAULT NULL,
  `datecreated` int(11) NOT NULL,
  PRIMARY KEY (`projectid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `projects`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_components`
--

DROP TABLE IF EXISTS `project_components`;
CREATE TABLE IF NOT EXISTS `project_components` (
  `componentid` bigint(20) NOT NULL AUTO_INCREMENT,
  `projectid` bigint(20) NOT NULL,
  `cid` bigint(20) NOT NULL,
  `component_name` varchar(100) NOT NULL,
  `component_overview` varchar(512) DEFAULT NULL,
  `component_leader` bigint(20) DEFAULT NULL COMMENT 'User ID from the same company.',
  `datecreated` int(11) NOT NULL,
  PRIMARY KEY (`componentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `project_components`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_releases`
--

DROP TABLE IF EXISTS `project_releases`;
CREATE TABLE IF NOT EXISTS `project_releases` (
  `releaseid` bigint(20) NOT NULL AUTO_INCREMENT,
  `projectid` bigint(20) NOT NULL,
  `cid` bigint(20) NOT NULL,
  `release_name` varchar(100) NOT NULL,
  `release_overview` varchar(512) DEFAULT NULL,
  `release_identifier` varchar(45) NOT NULL,
  `start_date` int(11) DEFAULT '0',
  `end_date` int(11) DEFAULT '0',
  `release_status` varchar(45) DEFAULT 'Pending',
  PRIMARY KEY (`releaseid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `project_releases`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_stories`
--

DROP TABLE IF EXISTS `project_stories`;
CREATE TABLE IF NOT EXISTS `project_stories` (
  `storyid` bigint(20) NOT NULL AUTO_INCREMENT,
  `projectid` bigint(20) NOT NULL,
  `cid` bigint(20) NOT NULL,
  `story_name` varchar(255) NOT NULL,
  `story_overview` text,
  `start_date` int(11) DEFAULT NULL,
  `modify_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `componentid` bigint(20) DEFAULT NULL,
  `releaseid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`storyid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `project_stories`
--


-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d3dbfa5e3459dd3aa5545c09e98a5d66', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv', 1293714755, 'a:4:{s:8:"username";s:6:"arfeen";s:3:"uid";s:2:"21";s:12:"main_contact";s:1:"1";s:12:"is_logged_in";s:1:"1";}'),
('437a44fab225b5921c64764087ab3ee2', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv', 1293712983, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `cid` bigint(20) NOT NULL COMMENT 'Company ID',
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(34) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `main_contact` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Main Contact for the company',
  `profile_pic` varchar(45) DEFAULT NULL,
  `lastlogin` int(11) DEFAULT NULL,
  `datecreated` int(11) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `maincontact_index` (`main_contact`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='users tables' AUTO_INCREMENT=23 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `cid`, `first_name`, `last_name`, `job_title`, `email`, `username`, `password`, `main_contact`, `profile_pic`, `lastlogin`, `datecreated`) VALUES
(21, 2, 'Arfeen', 'Arif', 'Project Manager', 'arfeen@softmatics.com', 'arfeen', '5f4dcc3b5aa765d61d8327deb882cf99', 1, NULL, 1293713009, 1293562001),
(22, 3, 'Anshu', 'Aggerwal', '', 'admin@admin.com', 'anshu', '5f4dcc3b5aa765d61d8327deb882cf99', 1, NULL, 1293564339, 1293564313);
