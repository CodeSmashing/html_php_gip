-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2023 at 02:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gip`
--

-- --------------------------------------------------------

--
-- Table structure for table `adres`
--

CREATE TABLE `adres` (
  `id_adres` int(11) NOT NULL,
  `id_klant` int(11) NOT NULL,
  `postcode` int(11) NOT NULL,
  `straat` varchar(255) DEFAULT NULL,
  `nummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `bestelling`
--

CREATE TABLE `bestelling` (
  `id_bestelling` int(11) NOT NULL,
  `producten` varchar(255) NOT NULL,
  `id_klant` int(255) NOT NULL,
  `datum_handeling` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id_gebruiker` int(11) NOT NULL,
  `id_klant` int(11) NOT NULL,
  `gebruiker_naam` varchar(255) DEFAULT NULL,
  `gebruiker_level` int(11) NOT NULL,
  `gebruiker_pass` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id_gebruiker`, `id_klant`, `gebruiker_naam`, `gebruiker_level`, `gebruiker_pass`, `created_at`) VALUES
(1, 1, 'AdminBob', 1, '$2y$10$4Kd1vufbshSAcYlK3LN2pO2jtkC9nujcAiD29hIfWx/CVlsyHLwOy', '2023-05-16'),
(2, 2, 'BobRoss', 0, '$2y$10$4Kd1vufbshSAcYlK3LN2pO2jtkC9nujcAiD29hIfWx/CVlsyHLwOy', '2023-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `klant`
--

CREATE TABLE `klant` (
  `id_klant` int(11) NOT NULL,
  `id_gebruiker` int(11) NOT NULL,
  `voornaam` varchar(255) DEFAULT NULL,
  `achternaam` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `id_adres` int(11) NOT NULL,
  `geboortedatum` date NOT NULL,
  `id_bestelling` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `postcode`
--

CREATE TABLE `postcode` (
  `id_postcode` int(11) NOT NULL,
  `postcode` int(11) NOT NULL,
  `gemeente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `product_naam` varchar(255) NOT NULL,
  `product_prijs` double NOT NULL,
  `id_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `product_naam`, `product_prijs`, `id_stock`) VALUES
(1, 'persavocado', 17.99, 1),
(2, 'persappel', 5.12, 2),
(3, 'perssinaasappel', 0.99, 3),
(4, 'persannanas', 6.8, 4),
(5, 'citroen', 42.03, 5),
(6, 'limoen', 3.5, 6),
(7, 'perscocosnoot', 3.5, 7),
(8, 'persbanaan', 10.09, 8),
(9, 'perskomkommer', 9.99, 9),
(10, 'persperzik', 6.05, 10),
(11, 'perswatermeloen', 5, 11),
(12, 'persfruit', 2.36, 12),
(13, 'perspeer', 10, 13);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `stock`) VALUES
(1, 100),
(2, 100),
(3, 100),
(4, 100),
(5, 100),
(6, 100),
(7, 100),
(8, 100),
(9, 100),
(10, 100),
(11, 100),
(12, 100),
(13, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`id_adres`);

--
-- Indexes for table `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`id_bestelling`);

--
-- Indexes for table `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id_gebruiker`);

--
-- Indexes for table `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`id_klant`);

--
-- Indexes for table `postcode`
--
ALTER TABLE `postcode`
  ADD PRIMARY KEY (`id_postcode`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adres`
--
ALTER TABLE `adres`
  MODIFY `id_adres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `id_bestelling` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id_gebruiker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `klant`
--
ALTER TABLE `klant`
  MODIFY `id_klant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `postcode`
--
ALTER TABLE `postcode`
  MODIFY `id_postcode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;