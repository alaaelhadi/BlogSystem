-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 09:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'Post1', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore ullam odit alias distinctio accusamus, at iure, doloremque est necessitatibus rem atque sapiente sit animi non voluptate optio ea qui velit?', '2024-05-12 13:38:01'),
(2, 'Post2', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore ullam odit alias distinctio accusamus, at iure, doloremque est necessitatibus rem atque sapiente sit animi non voluptate optio ea qui velit?', '2024-05-12 13:39:24'),
(3, 'Post3', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. ', '2024-05-12 13:53:30'),
(4, 'Post4', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. ', '2024-05-12 13:54:04'),
(5, 'Post7', '     Lorem ipsum dolor sit, amet consectetur adipisicing elit.           ', '2024-05-12 13:55:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
