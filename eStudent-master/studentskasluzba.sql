-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2020 at 09:51 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentskasluzba`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnikID` int(11) NOT NULL,
  `imePrezimeKorisnika` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnikID`, `imePrezimeKorisnika`, `username`, `password`) VALUES
(1, 'Milka Matijasevic', 'milka', 'milkaAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

CREATE TABLE `predmet` (
  `predmetID` int(11) NOT NULL,
  `nazivPredmeta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `glavniProfesor` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`predmetID`, `nazivPredmeta`, `glavniProfesor`) VALUES
(1, 'Internet tehnologije', 'Boza Radentkpvic'),
(2, 'Softverski paterni', 'Sinisa Vlajic'),
(3, 'Internet marketing', 'Boza Radenkovic'),
(4, 'Projektovanje softvera', 'Sinisa Vlajic'),
(5, 'Osnove organizacije', 'Ondrej Jasko'),
(6, 'Ekonomija', 'Sandra Jednak');

-- --------------------------------------------------------

--
-- Table structure for table `prijava`
--

CREATE TABLE `prijava` (
  `id` int(11) NOT NULL,
  `rokID` int(11) NOT NULL,
  `brojIndeksa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `predmetID` int(11) NOT NULL,
  `ocena` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NI',
  `datumPrijave` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prijava`
--

INSERT INTO `prijava` (`id`, `rokID`, `brojIndeksa`, `predmetID`, `ocena`, `datumPrijave`) VALUES
(1, 8, '2015/0023', 1, '9', '2020-06-18 03:55:30'),
(2, 16, '2017/0003', 5, '9', '2020-06-18 03:55:30'),
(3, 5, '2015/0023', 2, '10', '2020-06-18 03:58:13'),
(7, 1, '2015/0023', 1, 'NI', '2020-06-18 14:27:19'),
(8, 17, '2015/0023', 6, '7', '2020-06-18 18:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `rok`
--

CREATE TABLE `rok` (
  `rokID` int(11) NOT NULL,
  `nazivRoka` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rok`
--

INSERT INTO `rok` (`rokID`, `nazivRoka`) VALUES
(1, 'Januar 2018'),
(2, 'Februar 2018'),
(3, 'Jun 2018'),
(4, 'Jul 2018'),
(5, 'Septembar 2018'),
(6, 'Oktobar 2018'),
(7, 'Januar 2019'),
(8, 'Februar 2019'),
(9, 'Jun 2019'),
(10, 'Jul 2019'),
(11, 'Septembar 2019'),
(12, 'Oktobar 2019'),
(13, 'Januar 2020'),
(14, 'Februar 2020'),
(15, 'Jun 2020'),
(16, 'Jul 2020'),
(17, 'Septembar 2020'),
(18, 'Oktobar 2020');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `brojIndeksa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imePrezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `godinaUpisa` int(11) NOT NULL,
  `grad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`brojIndeksa`, `imePrezime`, `godinaUpisa`, `grad`, `slika`, `username`, `password`) VALUES
('2015/0023', 'Mirko Nikolic', 2015, 'Nova Pazova', 'dota.png', 'mirko', '1234'),
('2016/222', 'Milojko Mantic', 2016, 'Beograd', '', 'milojko', 'milojko'),
('2017/0003', 'Milena Vukjajlovic', 2017, 'Beograd', '', 'milena', 'milena'),
('2019', 'Marta Marinkovic', 2019, 'Novi Sad', '', 'marta', 'marta'),
('2019/212', 'Misko Selami', 2019, 'Gnjilane', '', 'misko', 'misko');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnikID`);

--
-- Indexes for table `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`predmetID`);

--
-- Indexes for table `prijava`
--
ALTER TABLE `prijava`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brojIndeksa` (`brojIndeksa`),
  ADD KEY `rokID` (`rokID`),
  ADD KEY `predmetID` (`predmetID`);

--
-- Indexes for table `rok`
--
ALTER TABLE `rok`
  ADD PRIMARY KEY (`rokID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`brojIndeksa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnikID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `predmet`
--
ALTER TABLE `predmet`
  MODIFY `predmetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prijava`
--
ALTER TABLE `prijava`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rok`
--
ALTER TABLE `rok`
  MODIFY `rokID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prijava`
--
ALTER TABLE `prijava`
  ADD CONSTRAINT `prijava_ibfk_1` FOREIGN KEY (`brojIndeksa`) REFERENCES `student` (`brojIndeksa`),
  ADD CONSTRAINT `prijava_ibfk_2` FOREIGN KEY (`rokID`) REFERENCES `rok` (`rokID`),
  ADD CONSTRAINT `prijava_ibfk_3` FOREIGN KEY (`predmetID`) REFERENCES `predmet` (`predmetID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
