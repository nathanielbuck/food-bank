-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 23, 2013 at 08:52 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `sonshine_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `age_range`
--

CREATE TABLE `age_range` (
  `age_range_id` int(11) NOT NULL AUTO_INCREMENT,
  `min_age` tinyint(4) NOT NULL,
  `max_age` tinyint(4) NOT NULL,
  PRIMARY KEY (`age_range_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `age_range`
--

INSERT INTO `age_range` VALUES(1, 0, 5);
INSERT INTO `age_range` VALUES(2, 6, 12);
INSERT INTO `age_range` VALUES(3, 13, 17);
INSERT INTO `age_range` VALUES(4, 18, 34);
INSERT INTO `age_range` VALUES(5, 35, 59);
INSERT INTO `age_range` VALUES(6, 60, 127);

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household` (
  `household_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `food_stamps` tinyint(4) NOT NULL DEFAULT '0',
  `disabled` tinyint(4) NOT NULL DEFAULT '0',
  `veteran` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`household_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `household`
--

-- --------------------------------------------------------

--
-- Table structure for table `household_age_range`
--

CREATE TABLE `household_age_range` (
  `household_id` int(11) NOT NULL,
  `age_range_id` int(11) NOT NULL,
  `individuals` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `household_age_range`
--

-- --------------------------------------------------------

--
-- Table structure for table `household_income_source`
--

CREATE TABLE `household_income_source` (
  `household_id` int(11) NOT NULL,
  `income_source_id` int(11) NOT NULL,
  `description` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `household_income_source`
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


