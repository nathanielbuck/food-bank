-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2013 at 03:35 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `sonshine_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household` (
  `household_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `proxy_first_name` varchar(64) DEFAULT NULL,
  `proxy_last_name` varchar(64) DEFAULT NULL,
  `address` varchar(128) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `food_stamps` tinyint(4) NOT NULL DEFAULT '0',
  `disabled` tinyint(4) NOT NULL DEFAULT '0',
  `veteran` tinyint(4) NOT NULL DEFAULT '0',
  `comments` text,
  PRIMARY KEY (`household_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `household`
--


-- --------------------------------------------------------

--
-- Table structure for table `household_income_source`
--

CREATE TABLE `household_income_source` (
  `household_id` int(11) NOT NULL,
  `income_source_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `household_income_source`
--


-- --------------------------------------------------------

--
-- Table structure for table `household_members`
--

CREATE TABLE `household_members` (
  `household_id` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `sex` char(1) NOT NULL COMMENT '1=male, 2=female'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `household_members`
--


-- --------------------------------------------------------

--
-- Table structure for table `income_source`
--

CREATE TABLE `income_source` (
  `income_source_id` int(11) NOT NULL AUTO_INCREMENT,
  `income_source` varchar(64) NOT NULL,
  PRIMARY KEY (`income_source_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `income_source`
--

INSERT INTO `income_source` VALUES(1, 'DPA (Cash)');
INSERT INTO `income_source` VALUES(2, 'WIC');
INSERT INTO `income_source` VALUES(3, 'Private Pension/Annunity');
INSERT INTO `income_source` VALUES(4, 'Employed Full-Time');
INSERT INTO `income_source` VALUES(5, 'SSI');
INSERT INTO `income_source` VALUES(6, 'Social Security');
INSERT INTO `income_source` VALUES(7, 'Medical Assistance');
INSERT INTO `income_source` VALUES(8, 'Employed Part-Time');
INSERT INTO `income_source` VALUES(9, 'Unemployment Compensation');
INSERT INTO `income_source` VALUES(10, 'Food Stamps');

-- --------------------------------------------------------

--
-- Table structure for table `serve`
--

CREATE TABLE `serve` (
  `household_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serve`
--


