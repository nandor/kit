-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2012 at 04:35 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kit`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `promotion` int(11) NOT NULL,
  `university` int(11) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `picture` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `promotion`, `university`, `university_name`, `about`, `picture`) VALUES
(1, 'fadsfads', 2222, 1, '', 'Description of the group goes here!', '61928196613372712711.png'),
(2, 'one', 2, 1, 'Liceul de Informatica', '3', '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `subject` varchar(200) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE IF NOT EXISTS `timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `field` varchar(32) NOT NULL,
  `date` date NOT NULL,
  `value` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`id`, `user`, `field`, `date`, `value`) VALUES
(55, 1, 'address', '2012-04-29', 0x427563686172657374),
(56, 1, 'address', '2012-04-29', 0x4f72616465612c20526f6d616e6961),
(57, 1, 'address', '2012-04-29', 0x436c756a2d4e61706f63612c20526f6d616e6961),
(58, 2, 'full_name', '2012-04-30', 0x536f6d65626f6479),
(59, 5, 'full_name', '2012-04-30', 0x47656f7267652047656f726765736375),
(60, 4, 'full_name', '2012-04-30', 0x53746976),
(61, 1, 'email', '2012-05-15', 0x6c69636b65726e616e646f72407961686f6f2e636f6d),
(62, 1, 'visible', '2012-05-15', 0x31),
(63, 1, 'visible', '2012-05-15', 0x30),
(64, 1, 'workplace', '2012-05-17', 0x4e6577576f726b706c616365),
(65, 1, 'job', '2012-05-17', 0x4e65774a6f62),
(66, 1, 'hobby', '2012-05-17', 0x4e6f7468696e67),
(67, 1, 'birthday', '2012-05-17', 0x32382d30322d31393934),
(68, 1, 'birthday', '2012-05-17', 0x313939342d30322d3238),
(69, 1, 'full_name', '2012-05-17', 0x6661647366647361),
(70, 1, 'visible', '2012-05-17', 0x31),
(71, 1, 'full_name', '2012-05-17', 0x4e616e646f72204c69636b6572),
(72, 1, 'visible', '2012-05-17', 0x31);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `about` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `name`, `address`, `phone_number`, `email`, `picture`, `about`) VALUES
(1, 'Liceul de Informatica', 'Bacau, Romania', '', '', '', 0x6666),
(2, 'UBB', 'Kogalniceanu', '00000000000', 'ubb@a.com', '', ''),
(3, 'Poli', 'Cluj-Napoca', '901323', 'a@b.com', '', 0x506f6c697465686e696361);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `university` int(11) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `visible` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `time_registered` bigint(20) NOT NULL,
  `profile` varchar(32) NOT NULL,
  `address` varchar(256) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `workplace` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `hobby` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group`, `group_name`, `university`, `university_name`, `visible`, `name`, `pass`, `time_registered`, `profile`, `address`, `email`, `full_name`, `birthday`, `workplace`, `job`, `hobby`) VALUES
(1, 2, 'one', 1, 'Liceul de Informatica "Tiberiu Popoviciu"', 1, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1334905843, '173999023113372711891.png', 'Cluj-Napoca, Romania', 'lickernandor@yahoo.com', 'Nandor Licker', '1994-02-28', 'NewWorkplace', 'NewJob', 'Nothing'),
(2, 1, 'fadsfads', 1, '', 1, 'nandor', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1334905843, '35957486713351968292.jpg', '', '', 'Somebody', '0000-00-00', '', '', ''),
(4, 0, '', 0, '', 0, 'stiv', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1335253469, '', '', '', 'Stiv', '0000-00-00', '', '', ''),
(5, 0, '', 0, '', 0, 'another', 'b7c8ffb8fbc67c171328e0e8f643694e8e61b335', 1335768709, '', '', '', 'George Georgescu', '0000-00-00', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
