-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2013 at 05:32 
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kotakjelajah`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `path` varchar(100) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `view_count` int(11) NOT NULL,
  `option` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `type`, `path`, `journal_id`, `caption`, `description`, `created_at`, `view_count`, `option`, `status`) VALUES
(1, '72938d61156e71a4800c935361d19cc3', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 07:54:25', 0, 0, 0),
(2, '631e6b7a9dd9b36fb026a0fc1e40a9cc', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 07:55:22', 0, 0, 0),
(3, '82e2dce010ae69a6eb75fb9e88263d71', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 08:03:17', 0, 0, 0),
(4, '7344001e7122fc7cd7d9744d183ca214', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 08:03:36', 0, 0, 0),
(5, 'f89db0f3ed4faf303d0c40a29cbbecd1', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 08:03:48', 0, 0, 0),
(6, '1f135679866c6c213966732aa1707598', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 08:04:44', 0, 0, 0),
(7, '4f8706eb9147252d23b1603e632b5ba3', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 08:08:17', 0, 0, 0),
(8, '1c800c8ad1de1c6f678d1792bc67217a', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 08:08:31', 0, 0, 0),
(9, '06d952ef441a053c93eb659b5f819d63', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 08:08:34', 0, 0, 0),
(10, '35ad2fd6789d1a7addbb3c007fb0ada1', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 09:02:45', 0, 0, 0),
(11, '537dc76253168b9a38223554c2d9578f', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 09:02:48', 0, 0, 0),
(12, 'eed02dd9bccc4b554c7d053a66378112', 'image/jpeg', 'files/', 0, '', '', '2013-04-05 09:02:50', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE IF NOT EXISTS `journals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `city` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `container` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `related_content` varchar(100) NOT NULL,
  `comments_count` int(11) NOT NULL,
  `read_count` int(11) NOT NULL,
  `noted_count` int(11) NOT NULL,
  `contribution_count` int(11) NOT NULL,
  `likes_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `title`, `description`, `city`, `location`, `created_at`, `updated_at`, `user_id`, `status`, `container`, `category`, `parent_id`, `related_content`, `comments_count`, `read_count`, `noted_count`, `contribution_count`, `likes_count`) VALUES
(1, 'titlesssss', '<p>xncv,sbcvx ,s s scgh scgh suxhj siuxhlaksdbchj</p>', 0, 'locatiooonnssss', '2013-04-05 09:03:07', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', 0, 0, 0, 0, 0),
(2, 'titlesssss', '<p>xncv,sbcvx ,s s scgh scgh suxhj siuxhlaksdbchj</p>', 0, 'locatiooonnssss', '2013-04-05 09:03:36', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', 0, 0, 0, 0, 0),
(3, 'titlesssss', '<p>xncv,sbcvx ,s s scgh scgh suxhj siuxhlaksdbchj</p>', 0, 'locatiooonnssss', '2013-04-05 09:03:52', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `likes`
--


-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `notes`
--


-- --------------------------------------------------------

--
-- Table structure for table `notes_detail`
--

CREATE TABLE IF NOT EXISTS `notes_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notes_id` int(11) NOT NULL,
  `content` varchar(20) NOT NULL,
  `content_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `notes_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(25) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `birthdate` date NOT NULL,
  `company` varchar(50) NOT NULL,
  `location` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `followings` int(11) NOT NULL,
  `followers` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `fullname`, `created_at`, `birthdate`, `company`, `location`, `points`, `followings`, `followers`, `grade`, `status`) VALUES
(1, 'najib', 'c062655b7c7e5c2741aeacafb', '5159dcddae6901.51032212', 'khoirun.najib@gmail.com', 'Khoirun Najib', '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_fans`
--

CREATE TABLE IF NOT EXISTS `user_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fans_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_fans`
--

