-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2020 at 04:44 AM
-- Server version: 5.7.32
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfoli_tobacco_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `c_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `image`, `price`) VALUES
(1, '83713282-CA4A-4B1F-A99F-F80FB7494E58.png', '16'),
(2, 'al_waha_png.png', '16'),
(4, 'HOLSTER.png', '16'),
(5, 'AL_FAKHER.png', '16');

-- --------------------------------------------------------

--
-- Table structure for table `flavor`
--

CREATE TABLE `flavor` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `tbc_name` varchar(255) NOT NULL,
  `flavor` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flavor`
--

INSERT INTO `flavor` (`id`, `c_id`, `tbc_name`, `flavor`, `status`) VALUES
(1, 1, 'HANDGEMAGHT & ILLEGAL', 'KIWI, ANANAS', '1'),
(2, 1, 'BLAULIGHT', 'Beerenmix', '0'),
(3, 1, 'GHETTO COLA', 'Cola, Birne', '0'),
(4, 1, '4B - EINE FAMILIE', 'Zitrone, Limette, Ice', '0'),
(5, 1, 'GHETTOLIED', 'Orange, Blutorange, Ice', '0'),
(6, 1, 'MASSIVE', 'Pfirsich, Ico', '0'),
(7, 1, 'BRUDERHERZ', 'Druchentrucht, Ice', '0'),
(8, 1, 'WENN DER MOND', 'Honigmelone, Mango, Ice', '1'),
(10, 2, 'MIAMI VICE', 'Blaubeere', '0'),
(12, 2, 'PINK MELLOW', 'GRAPEFRUIT, LIMETTE, WASSERMELONE', '1'),
(13, 4, 'Smurf Daddy', 'Joghurt, Waldbeere, WaldfrÃ¼chte, Brombeere, Maracuja', '0'),
(14, 4, 'Booster', 'Eis', '0'),
(15, 4, 'Butterkeks Winter Edition', 'Butterkeks', '0'),
(16, 4, 'Classic Grpe Mnt', 'WeiÃŸe Traube, Traube', '0'),
(17, 5, 'Doppelapfel', 'Anis, Apfel', '0'),
(18, 5, 'Orange', 'Orange', '0'),
(19, 5, 'Traube/Minze', 'Traube, Minze', '0'),
(20, 5, 'traube/test bla', 'Bla, BLA, bla', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `flavor_id` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `flavor_id`, `rating`) VALUES
(16, 7, '0.5'),
(15, 5, '5'),
(14, 3, '4'),
(13, 8, '5'),
(12, 2, '4'),
(11, 6, '1.5'),
(10, 3, '5'),
(17, 1, '2.5'),
(18, 2, '2.5'),
(19, 5, '2.5'),
(20, 11, '5'),
(21, 1, '4'),
(22, 4, '0.5'),
(23, 4, '3.5'),
(24, 7, '5'),
(25, 11, '4'),
(26, 11, '5'),
(27, 7, '5'),
(29, 1, '5'),
(30, 1, '5'),
(31, 4, '5'),
(32, 4, '5'),
(33, 2, '5'),
(34, 3, '0.5'),
(35, 6, '5'),
(36, 10, '5'),
(37, 13, '4'),
(38, 11, '2'),
(39, 1, '5'),
(40, 17, '5'),
(41, 14, '4'),
(42, 10, '5'),
(43, 15, '4'),
(44, 16, '4'),
(45, 2, '5'),
(46, 1, '4.5'),
(47, 18, '0.5'),
(48, 20, '2.5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `flavor`
--
ALTER TABLE `flavor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `flavor`
--
ALTER TABLE `flavor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
