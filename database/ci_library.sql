-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2020 at 12:02 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-26+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `M_Admin`
--

CREATE TABLE `M_Admin` (
  `AdminID` int(11) NOT NULL,
  `AdminName` varchar(100) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varbinary(50) NOT NULL,
  `SuperUser` varchar(1) NOT NULL,
  `AdminImage` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(30) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(30) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Admin`
--

INSERT INTO `M_Admin` (`AdminID`, `AdminName`, `DateOfBirth`, `email`, `UserName`, `Password`, `SuperUser`, `AdminImage`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(2, 'abrian Inf', '2020-01-09', 'abriantama@gmail.com', 'brian', 0x6362643434663862356234386135316637646162393861626364663435643465, 'Y', 'cs7.png', 'N', 'admin', '2020-01-10 16:37:32', 'brian', '2020-07-13 22:52:58'),
(6, 'efira', '1994-02-01', 'efivara.steel@gmail.com', 'efi', 0x6139353835656532366239396230326664313934363539303266326664346435, 'N', 'cs3.png', 'Y', 'brian', '2020-05-09 15:01:43', 'efi', '2020-07-14 23:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `M_Book`
--

CREATE TABLE `M_Book` (
  `BookID` varchar(10) NOT NULL,
  `Isbn` varchar(20) NOT NULL,
  `TitleBuku` varchar(150) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `NumberOfPages` varchar(15) NOT NULL,
  `CategoryCode` varchar(10) NOT NULL,
  `BookshelfID` int(11) NOT NULL,
  `ImageBook` varchar(200) NOT NULL,
  `StockBook` int(11) NOT NULL,
  `LightDamageCosts` double NOT NULL,
  `HeavyDamageCosts` double NOT NULL,
  `LostCost` double NOT NULL,
  `DailyLateFee` double NOT NULL,
  `Status` varchar(1) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Book`
--

INSERT INTO `M_Book` (`BookID`, `Isbn`, `TitleBuku`, `Author`, `NumberOfPages`, `CategoryCode`, `BookshelfID`, `ImageBook`, `StockBook`, `LightDamageCosts`, `HeavyDamageCosts`, `LostCost`, `DailyLateFee`, `Status`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('BK-000001', '123', 'Belajar Singkat Php 7', 'lokomediaa', '123', 'C-000001', 1, 'php7.png', 1, 12000, 40000, 72000, 4000, '5', 'Y', 'brian', '2020-05-11 16:58:39', 'brian', '2020-07-14 23:53:38'),
('BK-000002', '43355', 'Cara Efektif Belajar Framework Laravel', 'lokomedia', '108', 'C-000002', 1, 'laravel2.jpg', 1, 10000, 30000, 55000, 5000, '5', 'Y', 'brian', '2020-05-14 10:52:51', 'brian', '2020-07-14 22:43:40'),
('BK-000003', '12344', 'Otodidak Pemograman Phyton', 'elex media', '122', 'C-000006', 4, 'phyton1.jpg', 10, 35000, 48000, 78000, 2000, '5', 'Y', 'brian', '2020-07-14 22:35:14', 'brian', '2020-07-14 22:35:14'),
('BK-000004', '28737', 'Pemograman Android & Database', 'elex media', '148', 'C-000006', 4, 'android.jpg', 1, 22000, 38000, 56000, 2000, '5', 'Y', 'brian', '2020-07-14 22:36:39', 'brian', '2020-07-14 22:36:39'),
('BK-000005', '63633', 'Panduan Mudah Belajar Framework Laravel', 'elex media', '167', 'C-000006', 4, 'laravel.jpg', 0, 32000, 45000, 86500, 2500, '7', 'Y', 'brian', '2020-07-14 22:38:05', 'brian', '2020-07-14 23:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `M_BookShelf`
--

CREATE TABLE `M_BookShelf` (
  `BookshelfID` int(11) NOT NULL,
  `ShelfCode` varchar(20) NOT NULL,
  `ShelfName` varchar(35) NOT NULL,
  `Position` text NOT NULL,
  `Descripton` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_BookShelf`
--

INSERT INTO `M_BookShelf` (`BookshelfID`, `ShelfCode`, `ShelfName`, `Position`, `Descripton`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(1, 'Shelf-1', 'Shelf-1-comunication', 'Depan', 'Sipp', 'Y', '2020-05-10 16:41:44', '0000-00-00 00:00:00', 'brian', '2020-05-21 15:46:58'),
(2, 'Shelf-2', 'Shelf-2 Accounting', 'Kiri', '', 'Y', '2020-05-10 16:54:50', '0000-00-00 00:00:00', 'brian', '2020-05-21 15:44:20'),
(3, 'Shelf-2', 'Shelf-2-nature', 'Belakang', '', 'Y', '2020-05-10 16:57:07', '0000-00-00 00:00:00', 'brian', '2020-05-21 13:41:58'),
(4, 'Shelf-4', 'Shelf-4-computer', 'Kanan Atas', '', 'Y', '2020-05-10 16:59:38', '0000-00-00 00:00:00', 'brian', '2020-05-21 13:42:35'),
(5, 'Shelf-5', 'Shelf-5-manajamen', 'Kiri Bawah', '', 'Y', '2020-05-10 17:01:21', '0000-00-00 00:00:00', 'brian', '2020-05-21 13:43:14'),
(6, 'Shelf-6', 'Shelf-6-multimedia', 'Depan Atas', '', 'Y', '2020-05-10 17:04:21', '0000-00-00 00:00:00', 'brian', '2020-05-21 13:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `M_Borrowers`
--

CREATE TABLE `M_Borrowers` (
  `BorrowerID` varchar(10) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `MobilePhone` varchar(14) NOT NULL,
  `HomePhone` varchar(14) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Address` longtext NOT NULL,
  `IdentityID` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `BorrowerImage` varchar(200) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Borrowers`
--

INSERT INTO `M_Borrowers` (`BorrowerID`, `CustomerName`, `MobilePhone`, `HomePhone`, `DateOfBirth`, `Address`, `IdentityID`, `Email`, `Gender`, `BorrowerImage`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('BRW-000001', 'Nani Kusuma', '08217844677', '0219388399', '1996-10-06', 'Bekasi Utara Jaya', '873366363553', 'nanikusuma99@gmail.com', 'M', 'flat-head-3.png', 'Y', 'brian', '2020-05-12 15:05:15', 'brian', '2020-05-12 15:13:44'),
('BRW-000002', 'Astuti Farha', '085778904567', '0218333877', '1996-04-21', 'Jakarta Timur', '32765494884774', 'ast.farha@gmail.com', 'F', 'flat-icon-4.png', 'Y', 'brian', '2020-05-16 10:27:50', 'brian', '2020-05-16 14:04:55'),
('BRW-000003', 'Ade Irawan', '087786373688', '0219847474', '1998-03-11', 'Bekasi Selatan', '32751190876554', 'adeirawan@gmail.com', 'M', 'avatar5.png', 'Y', 'brian', '2020-05-16 14:06:04', 'brian', '2020-07-14 23:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `M_Category`
--

CREATE TABLE `M_Category` (
  `CategoryCode` varchar(10) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `Descripton` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Category`
--

INSERT INTO `M_Category` (`CategoryCode`, `CategoryName`, `Descripton`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('C-000001', 'Accounting', 'Category Accountng', 'Y', 'brian', '2020-05-11 14:08:33', 'brian', '2020-05-21 14:14:34'),
('C-000002', 'Computer', '', 'Y', 'brian', '2020-05-14 10:51:40', 'brian', '2020-05-21 13:44:15'),
('C-000003', 'Communication', '', 'Y', 'brian', '2020-05-14 10:51:52', 'brian', '2020-05-21 13:44:06'),
('C-000004', 'Multimedia', '', 'Y', 'brian', '2020-05-21 13:44:28', 'brian', '2020-05-21 13:44:28'),
('C-000005', 'Management', '', 'Y', 'brian', '2020-05-21 13:44:42', 'brian', '2020-05-21 13:44:42'),
('C-000006', 'Informatika', '', 'Y', 'brian', '2020-05-21 14:13:40', 'brian', '2020-05-21 14:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `M_ConfigDamage`
--

CREATE TABLE `M_ConfigDamage` (
  `ConfigDamage` int(11) NOT NULL,
  `DamageID` varchar(10) NOT NULL,
  `DamageName` varchar(100) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_ConfigDamage`
--

INSERT INTO `M_ConfigDamage` (`ConfigDamage`, `DamageID`, `DamageName`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(1, 'Light', 'LightBook', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(2, 'Heavy', 'HeavyBook', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(3, 'Lost', 'LostBook', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `M_Months`
--

CREATE TABLE `M_Months` (
  `MonthID` int(11) NOT NULL,
  `MonthName` varchar(100) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Months`
--

INSERT INTO `M_Months` (`MonthID`, `MonthName`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(1, 'Januari', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(2, 'Febuari', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(3, 'Maret', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(4, 'April', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(5, 'Mei', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(6, 'Juni', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(7, 'Juli', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(8, 'Agustus', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(9, 'September', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(10, 'Oktober', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(11, 'November', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(12, 'Desember', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `M_Setupprofile`
--

CREATE TABLE `M_Setupprofile` (
  `SetupprofileID` int(11) NOT NULL,
  `SetupTitle` varchar(200) NOT NULL,
  `SetupName` varchar(200) NOT NULL,
  `SetupDescription` longtext NOT NULL,
  `SetupImageDasbor` varchar(1) NOT NULL,
  `SetupImage` longtext NOT NULL,
  `SetupImageLogo` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Setupprofile`
--

INSERT INTO `M_Setupprofile` (`SetupprofileID`, `SetupTitle`, `SetupName`, `SetupDescription`, `SetupImageDasbor`, `SetupImage`, `SetupImageLogo`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(1, 'Lib Bryn', 'App Library Bryn', 'aplikasi perpustakaan brian', '', 'library.jpg', 'lib-logo.png', 'Y', 'efi', '2020-07-07 15:33:03', 'brian', '2020-07-13 22:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `T_Borrowing`
--

CREATE TABLE `T_Borrowing` (
  `BorrowingID` varchar(20) NOT NULL,
  `BorrowerID` varchar(10) NOT NULL,
  `BookID` varchar(10) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `TotalBook` int(11) NOT NULL,
  `Description` longtext NOT NULL,
  `Status` varchar(1) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_Borrowing`
--

INSERT INTO `T_Borrowing` (`BorrowingID`, `BorrowerID`, `BookID`, `StartDate`, `EndDate`, `TotalBook`, `Description`, `Status`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('BRG-200513-000001', 'BRW-000001', 'BK-000001', '2020-05-13', '2020-05-19', 1, 'Pinjaman', '7', 'Y', 'brian', '2020-05-13 15:54:10', 'brian', '2020-05-15 16:07:01'),
('BRG-200516-000002', 'BRW-000002', 'BK-000002', '2020-05-16', '2020-05-19', 2, 'Test 2 Qty', '7', 'Y', 'brian', '2020-05-16 10:28:51', 'brian', '2020-05-16 13:56:48'),
('BRG-200517-000003', 'BRW-000001', 'BK-000002', '2020-05-17', '2020-05-22', 1, 'Test', '1', 'N', 'brian', '2020-05-17 12:19:41', 'adrian', '2020-05-17 15:14:58'),
('BRG-200517-000004', 'BRW-000001', 'BK-000001', '2020-05-17', '2020-05-25', 1, '', '1', 'N', 'adrian', '2020-05-17 16:10:47', 'adrian', '2020-05-18 10:23:26'),
('BRG-200518-000005', 'BRW-000002', 'BK-000001', '2020-05-18', '2020-05-25', 1, 'Test', '7', 'Y', 'adrian', '2020-05-18 10:40:39', 'brian', '2020-07-14 23:53:38'),
('BRG-200518-000006', 'BRW-000001', 'BK-000001', '2020-05-18', '2020-05-24', 1, '', '1', 'Y', 'adrian', '2020-05-18 11:17:08', 'adrian', '2020-05-18 11:17:08'),
('BRG-200714-000007', 'BRW-000002', 'BK-000005', '2020-07-14', '2020-07-19', 1, '', '1', 'N', 'brian', '2020-07-14 23:35:22', 'brian', '2020-07-14 23:55:25'),
('BRG-200714-000008', 'BRW-000001', 'BK-000005', '2020-07-14', '2020-07-17', 1, '', '5', 'Y', 'brian', '2020-07-14 23:37:08', 'brian', '2020-07-14 23:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `T_ReturnBook`
--

CREATE TABLE `T_ReturnBook` (
  `ReturnBookID` varchar(20) NOT NULL,
  `BorrowingID` varchar(20) NOT NULL,
  `ReturnDate` date NOT NULL,
  `TotalReturnBook` int(11) NOT NULL,
  `LateCharge` double NOT NULL,
  `DamageOrLostBook` varchar(10) NOT NULL,
  `DamageCost` double NOT NULL,
  `TotalCost` double NOT NULL,
  `Description` longtext NOT NULL,
  `Status` varchar(1) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_ReturnBook`
--

INSERT INTO `T_ReturnBook` (`ReturnBookID`, `BorrowingID`, `ReturnDate`, `TotalReturnBook`, `LateCharge`, `DamageOrLostBook`, `DamageCost`, `TotalCost`, `Description`, `Status`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('RTB-200515-000001', 'BRG-200513-000001', '2020-05-20', 1, 4000, 'Heavy', 40000, 44000, 'Buku Copot Lemnya', '5', 'Y', 'brian', '2020-05-15 15:31:44', 'brian', '2020-05-15 16:07:01'),
('RTB-200516-000002', 'BRG-200516-000002', '2020-05-20', 0, 10000, 'Lost', 55000, 120000, '', '5', 'Y', 'brian', '2020-05-16 12:02:31', 'brian', '2020-05-16 13:56:48'),
('RTB-200714-000003', 'BRG-200518-000005', '2020-05-25', 1, 0, '', 0, 0, '', '5', 'Y', 'brian', '2020-07-14 23:47:35', 'brian', '2020-07-14 23:53:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `M_Admin`
--
ALTER TABLE `M_Admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `M_Book`
--
ALTER TABLE `M_Book`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `M_BookShelf`
--
ALTER TABLE `M_BookShelf`
  ADD PRIMARY KEY (`BookshelfID`);

--
-- Indexes for table `M_Borrowers`
--
ALTER TABLE `M_Borrowers`
  ADD PRIMARY KEY (`BorrowerID`);

--
-- Indexes for table `M_Category`
--
ALTER TABLE `M_Category`
  ADD PRIMARY KEY (`CategoryCode`);

--
-- Indexes for table `M_ConfigDamage`
--
ALTER TABLE `M_ConfigDamage`
  ADD PRIMARY KEY (`ConfigDamage`);

--
-- Indexes for table `M_Months`
--
ALTER TABLE `M_Months`
  ADD PRIMARY KEY (`MonthID`);

--
-- Indexes for table `M_Setupprofile`
--
ALTER TABLE `M_Setupprofile`
  ADD PRIMARY KEY (`SetupprofileID`);

--
-- Indexes for table `T_Borrowing`
--
ALTER TABLE `T_Borrowing`
  ADD PRIMARY KEY (`BorrowingID`);

--
-- Indexes for table `T_ReturnBook`
--
ALTER TABLE `T_ReturnBook`
  ADD PRIMARY KEY (`ReturnBookID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `M_Admin`
--
ALTER TABLE `M_Admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `M_BookShelf`
--
ALTER TABLE `M_BookShelf`
  MODIFY `BookshelfID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `M_ConfigDamage`
--
ALTER TABLE `M_ConfigDamage`
  MODIFY `ConfigDamage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `M_Setupprofile`
--
ALTER TABLE `M_Setupprofile`
  MODIFY `SetupprofileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
