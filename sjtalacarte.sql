-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2024 at 06:05 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canteenmgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `sjtalacarte`
--

CREATE TABLE `sjtalacarte` (
  `iid` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sjtalacarte`
--

INSERT INTO `sjtalacarte` (`iid`, `name`, `image`, `price`, `time`) VALUES
(1, 'Pasta', 'red-sauce-pasta-recipe.jpg', 25, 15),
(2, 'Pizza', 'pizza-recipe-1.jpg', 40, 15),
(3, 'Tea', 'Tea-.jpg', 25, 5),
(4, 'Coffee', 'coffee.jpg', 30, 5),
(5, 'Paneer Butter Masala', 'paneer-butter-masala-5.webp', 45, 15),
(6, 'Gobi Manchurian', 'gobi-manchurian-cauliflower-manchurian.jpg', 40, 15),
(7, 'Palak Paneer', 'palak-paneer-recipe.jpg', 45, 20),
(8, 'Sandwich', 'veg-grilled-sandwich-recipe.jpg', 30, 20),
(9, 'Plain Dosa', 'brown-rice-dosa-recipe.jpg', 20, 15),
(10, 'Masala Dosa', 'brown-rice-dosa-recipe.jpg', 25, 15),
(11, 'Ghee Dosa', 'brown-rice-dosa-recipe.jpg', 30, 15),
(12, 'Rava Dosa', 'brown-rice-dosa-recipe.jpg', 30, 15),
(13, 'Sambar Vada', 'Medu-Vada-Recipe-Step-By-Step-Instructions.jpg', 30, 10),
(14, 'Veg Fried Rice', 'veg-fried-rice-featured.jpg', 30, 15),
(15, 'Roti', 'roti.jpg', 15, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sjtalacarte`
--
ALTER TABLE `sjtalacarte`
  ADD PRIMARY KEY (`iid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sjtalacarte`
--
ALTER TABLE `sjtalacarte`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
