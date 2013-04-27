-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2013 at 08:51 
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
  `size` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `container` varchar(10) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `view_count` int(11) NOT NULL,
  `option` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `type`, `path`, `size`, `journal_id`, `container`, `caption`, `description`, `created_at`, `view_count`, `option`, `status`) VALUES
(1, 'baluran.jpg', 'image/jpeg', 'files/', 121707, 0, '', '', '', '2013-04-16 06:19:12', 0, 0, 1),
(2, 'baluran-3 (1).jpg', 'image/jpeg', 'files/', 155941, 0, '', '', '', '2013-04-16 10:09:23', 0, 0, 1),
(3, 'baluran.jpg', 'image/jpeg', 'files/', 121707, 0, 'avatar', '', '', '2013-04-16 12:39:03', 0, 0, 1),
(4, 'baluran-3 (2).jpg', 'image/jpeg', 'files/', 155941, 0, 'avatar', '', '', '2013-04-16 12:48:11', 0, 0, 1),
(5, 'git.png', 'image/png', 'files/', 196100, 0, 'cover', '', '', '2013-04-16 16:10:35', 0, 0, 1),
(6, 'sportku.jpg', 'image/jpeg', 'files/', 5745, 0, 'avatar', '', '', '2013-04-16 16:26:23', 0, 0, 1),
(7, '25sms_gateway.jpg', 'image/jpeg', 'files/', 33264, 0, 'avatar', '', '', '2013-04-16 16:28:57', 0, 0, 1);

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
  `password` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `cover` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `birthdate` date NOT NULL,
  `company` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `points` int(11) NOT NULL,
  `followings` int(11) NOT NULL,
  `followers` int(11) NOT NULL,
  `posts` int(11) NOT NULL,
  `contributions` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `fullname`, `avatar`, `cover`, `created_at`, `updated_at`, `birthdate`, `company`, `location`, `points`, `followings`, `followers`, `posts`, `contributions`, `grade`, `status`) VALUES
(1, 'najib', '2d54cddb2c00277e5076173fe61b0c3a', '516513a5cbaf60.81888933', 'najib@kotakjelajah.com', 'khoirun Najib', '7', 0, '2013-04-10 09:24:21', '0000-00-00 00:00:00', '1991-10-11', 'Kotak Jelajah', 'Jakarta', 0, 1, 0, 0, 0, 0, 0),
(2, 'salman', 'f2e4b1d01503c600704fd55a006827da', '5166d13c68e649.11826200', 'salman@kotakjelajah.com', 'salman Al Farizi', '', 0, '2013-04-11 17:05:32', '0000-00-00 00:00:00', '1990-10-11', 'Kotak Jelajah', 'Jakarta Selatan', 0, 0, 1, 0, 0, 0, 0),
(3, 'jazzy', '6f70795bf36320c29e5d4ec7aca70b1c', '5167c99adbbf98.64744155', 'jazzy@kotakjelajah.com', 'Jazzy Sabraylla', '', 0, '2013-04-12 10:45:14', '0000-00-00 00:00:00', '1992-04-28', 'Kotak Jelajah', 'Surabaya', 0, 0, 0, 0, 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_fans`
--

INSERT INTO `user_fans` (`id`, `user_id`, `fans_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 2, 1, '2013-04-15 11:10:42', '0000-00-00 00:00:00', 1);
