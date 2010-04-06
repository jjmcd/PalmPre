-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: 192.68.0.4
-- Generation Time: Apr 05, 2010 at 09:55 PM
-- Server version: 5.0.88
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myToDo`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` smallint(6) NOT NULL auto_increment,
  `shortname` varchar(8) NOT NULL,
  `name` varchar(64) NOT NULL,
  `color` varchar(32) default NULL,
  `comment` varchar(1024) default NULL,
  `updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`cat_id`),
  UNIQUE KEY `shortname` (`shortname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `memos`
--

CREATE TABLE IF NOT EXISTS `memos` (
  `memo_id` smallint(6) NOT NULL auto_increment,
  `category` tinyint(4) default NULL,
  `title` varchar(80) default NULL,
  `content` longtext,
  `updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`memo_id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `todo_items`
--

CREATE TABLE IF NOT EXISTS `todo_items` (
  `item_id` int(11) NOT NULL auto_increment,
  `due` date default NULL,
  `priority` smallint(6) NOT NULL,
  `category` smallint(6) default NULL,
  `predecessor` int(11) default NULL,
  `hours` tinyint(4) default NULL,
  `percent` tinyint(4) NOT NULL,
  `short_desc` varchar(32) NOT NULL,
  `description` varchar(128) default NULL,
  `comment` varchar(1024) default NULL,
  `updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;
