-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2020 at 06:57 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `money-tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id_accounts` int(11) NOT NULL,
  `name_accounts` tinytext NOT NULL,
  `country_accounts` tinytext NOT NULL,
  `currency_accounts` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id_accounts`, `name_accounts`, `country_accounts`, `currency_accounts`) VALUES
(1, 'BNP Paribas', 'France', '€'),
(2, 'Société Générale', 'France', '€'),
(3, 'HSBC France', 'France', '€'),
(4, 'LCL Banque et assurance', 'France', '€'),
(5, 'Crédit Mutuel (CIC)', 'France', '€'),
(6, 'Banque Populaire', 'France', '€'),
(7, 'Crédit Agricole', 'France', '€'),
(8, 'Caisse d\'Épargne', 'France', '€'),
(9, 'La Banque Postale', 'France', '€');

-- --------------------------------------------------------

--
-- Table structure for table `moves`
--

CREATE TABLE `moves` (
  `id_moves` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_accounts` int(11) NOT NULL,
  `amount_moves` int(255) NOT NULL,
  `ref_moves` tinytext DEFAULT NULL,
  `date_moves` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moves`
--

INSERT INTO `moves` (`id_moves`, `id_users`, `id_accounts`, `amount_moves`, `ref_moves`, `date_moves`) VALUES
(1, 3, 1, 200, 'test', '0000-00-00'),
(2, 3, 1, -5, 'culo', '2000-12-12'),
(3, 3, 2, 100, 'pene', '2000-10-10'),
(4, 3, 1, 23, 'I\'m a move', '2020-07-10'),
(5, 3, 2, 32, 'maxime', '2020-07-10'),
(6, 3, 1, 600, 'Other move', '2020-07-11'),
(7, 3, 1, -203, 'lost money', '2020-07-11'),
(8, 3, 1, 20, '50', '2020-07-24'),
(9, 3, 6, 500, 'mouvement', '2020-07-24'),
(10, 3, 3, 200, 'init', '2020-07-26'),
(11, 3, 9, 200, 'ultimo', '2020-07-30'),
(12, 3, 9, 200, 'ultimo', '2020-07-30'),
(13, 3, 9, 200, 'ultimo', '2020-07-30'),
(14, 3, 9, 200, 'ultimo', '2020-07-30'),
(15, 3, 9, 200, 'hola', '2020-07-30'),
(16, 3, 9, 200, 'hola', '2020-07-30'),
(17, 3, 9, 200, 'hola', '2020-07-30'),
(18, 3, 9, 200, 'hola', '2020-07-30'),
(19, 3, 9, 200, 'hola', '2020-07-30'),
(30, 5, 1, 230, 'initial', '2020-07-31'),
(31, 5, 4, 230, 'initial', '2020-07-31'),
(32, 5, 4, 230, 'initial', '2020-07-31'),
(33, 5, 6, 20, 'start', '2020-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `email_users` tinytext NOT NULL,
  `uid_users` tinytext NOT NULL,
  `pwd_users` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `email_users`, `uid_users`, `pwd_users`) VALUES
(3, 'nicofilizzola@gmail.com', 'Admin', '$2y$10$0leMk0upUv77nc.A1/RmWuUnqXkTkLUETJZSAMc.St3e/jiwPxsn.'),
(4, 'test@test.com', 'test', '$2y$10$XCF.n6Dpg4hjLyXi22Vp7.28JsQEC1uAqTv0n1h7PG8uNJ1Zkr1vO'),
(5, 'leyda@rodriguez.com', 'Leyda', '$2y$10$.uitVOxRowqZ0ouphuRCZeErPlw579ddGmitTm7u0FhfCpxJZD9DC'),
(6, 'claudia@gmail.com', 'claudia', '$2y$10$m4wxCDtYQtkYy7YrTCayaO6g1rFOxvv9iZnYqc5AxjFdNitdy7WTG'),
(7, 'claudia@gmail.com', 'claudia', '$2y$10$WHnpVv.ic8DeFPqNKdKnvOlliLcSiA0iMuMVtrJ1vw5CIcKksLhnS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id_accounts`);

--
-- Indexes for table `moves`
--
ALTER TABLE `moves`
  ADD PRIMARY KEY (`id_moves`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_account` (`id_accounts`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id_accounts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `moves`
--
ALTER TABLE `moves`
  MODIFY `id_moves` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `moves`
--
ALTER TABLE `moves`
  ADD CONSTRAINT `moves_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`),
  ADD CONSTRAINT `moves_ibfk_2` FOREIGN KEY (`id_accounts`) REFERENCES `accounts` (`id_accounts`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
