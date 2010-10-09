-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host: 173.201.217.62
-- Generation Time: Sep 07, 2010 at 06:15 AM
-- Server version: 5.0.91
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `devdroiddv`
--

-- --------------------------------------------------------

--
-- Table structure for table `dv_comment`
--

CREATE TABLE `dv_comment` (
  `id_comment` int(10) unsigned NOT NULL auto_increment,
  `id_element` int(10) unsigned default NULL,
  `id_user` int(10) unsigned default NULL,
  `user_email` varchar(45) default NULL COMMENT 'just in case, commenting user not registered on the website',
  `comment_approved` varchar(45) default NULL,
  `comment_content` text,
  PRIMARY KEY  (`id_comment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dv_element`
--

CREATE TABLE `dv_element` (
  `id_element` int(10) unsigned NOT NULL auto_increment,
  `id_event` int(10) unsigned default NULL,
  `id_user` int(10) unsigned default NULL,
  `filename` varchar(255) default NULL,
  `ext` varchar(10) NOT NULL,
  `is_best` tinyint(4) default NULL,
  `id_place` int(10) unsigned default NULL,
  `lat` float default NULL,
  `lon` float default NULL,
  `caption` varchar(255) default NULL,
  `description` mediumtext,
  `relevance` float default NULL,
  `metric` float default NULL,
  `is_geo_precise` tinyint(4) default NULL,
  `is_manual` tinyint(4) default NULL,
  `is_public` tinyint(4) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `device_version` varchar(45) default NULL,
  `app_version` varchar(45) default NULL,
  PRIMARY KEY  (`id_element`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dv_event`
--

CREATE TABLE `dv_event` (
  `id_event` int(10) unsigned NOT NULL auto_increment,
  `id_user` int(10) unsigned default NULL,
  `running` tinyint(4) default NULL,
  `id_place_start` int(10) unsigned default NULL,
  `lat_start` float default NULL,
  `lon_start` float default NULL,
  `id_place_end` int(10) unsigned default NULL,
  `lat_end` float default NULL,
  `lon_end` float default NULL,
  `time_start` datetime default NULL,
  `time_end` datetime default NULL,
  `text` varchar(255) default NULL,
  `description` mediumtext,
  PRIMARY KEY  (`id_event`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dv_place`
--

CREATE TABLE `dv_place` (
  `id_place` int(10) unsigned NOT NULL auto_increment,
  `id_user` int(10) unsigned default NULL,
  `lat` float default NULL,
  `lon` float default NULL,
  `text` varchar(255) default NULL,
  PRIMARY KEY  (`id_place`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dv_user`
--

CREATE TABLE `dv_user` (
  `id_user` int(10) unsigned NOT NULL auto_increment,
  `oauth_id` text,
  `oauth_token` text,
  `oauth_secret` text,
  `user_login` varchar(45) default NULL,
  `user_pass` varchar(45) default NULL,
  `user_email` varchar(45) default NULL,
  PRIMARY KEY  (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
