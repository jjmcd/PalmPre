-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: 192.68.0.4
-- Generation Time: Apr 06, 2010 at 10:44 AM
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

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `shortname`, `name`, `color`, `comment`, `updated`) VALUES
(1, 'Rad', 'Radio', 'palevioletred', NULL, '2010-04-05 21:50:58'),
(2, 'Biz', 'Business', 'palegreen', NULL, '2010-03-29 10:59:04'),
(3, 'ARES', 'ARES/RACES/NTS', 'pink', NULL, '2010-03-29 10:58:41'),
(4, 'Pers', 'Personal', 'thistle', NULL, '2010-04-05 21:49:48'),
(5, 'Fedora', 'Fedora', 'lightskyblue', NULL, '2010-04-05 21:52:05'),
(6, 'Sys', 'System', '#FFFF99', NULL, '2010-04-05 21:54:12');
