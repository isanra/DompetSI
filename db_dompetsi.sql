-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 21, 2025 at 04:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dompetsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id` int(11) NOT NULL,
  `santri_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tipe` enum('masuk','keluar') NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id`, `santri_id`, `jumlah`, `tipe`, `keterangan`, `tanggal`) VALUES
(1, 1, 0, 'masuk', 'Saldo awal', '2025-05-17 09:05:37'),
(2, 2, 0, 'masuk', 'Saldo awal', '2025-05-17 09:18:38'),
(3, 3, 0, 'masuk', 'Saldo awal', '2025-05-17 09:19:01'),
(4, 4, 0, 'masuk', 'Saldo awal', '2025-05-17 09:19:32'),
(5, 5, 0, 'masuk', 'Saldo awal', '2025-05-17 09:22:05'),
(6, 6, 0, 'masuk', 'Saldo awal', '2025-05-17 09:22:39'),
(7, 7, 0, 'masuk', 'Saldo awal', '2025-05-17 09:23:18'),
(8, 8, 0, 'masuk', 'Saldo awal', '2025-05-18 08:59:32'),
(9, 8, 100000, 'masuk', 'jajan seminggu', '2025-05-18 09:22:08'),
(10, 8, 50000, 'keluar', 'jajan seminggu', '2025-05-18 09:22:44'),
(11, 9, 0, 'masuk', 'Saldo awal', '2025-05-18 10:01:24'),
(12, 9, 500000, 'masuk', 'gabut tf', '2025-05-18 10:01:55'),
(13, 9, 500000, 'masuk', 'gabut tf', '2025-05-18 10:01:57'),
(14, 8, 100000, 'masuk', 'gabut tf', '2025-05-18 10:08:52'),
(15, 8, 100000, 'masuk', 'gabut tf', '2025-05-19 08:59:56'),
(16, 10, 0, 'masuk', 'Saldo awal', '2025-05-19 10:03:07'),
(17, 11, 0, 'masuk', 'Saldo awal', '2025-05-19 10:07:12'),
(18, 14, 0, 'masuk', 'Saldo awal', '2025-05-19 10:50:39'),
(19, 15, 0, 'masuk', 'Saldo awal', '2025-05-19 10:52:09'),
(20, 16, 0, 'masuk', 'Saldo awal', '2025-05-19 10:53:39'),
(21, 17, 0, 'masuk', 'Saldo awal', '2025-05-19 10:55:16'),
(22, 18, 0, 'masuk', 'Saldo awal', '2025-05-19 10:56:44'),
(23, 19, 0, 'masuk', 'Saldo awal', '2025-05-19 10:58:02'),
(24, 20, 0, 'masuk', 'Saldo awal', '2025-05-19 10:59:15'),
(25, 21, 0, 'masuk', 'Saldo awal', '2025-05-19 11:00:41'),
(26, 22, 0, 'masuk', 'Saldo awal', '2025-05-19 11:01:49'),
(27, 23, 0, 'masuk', 'Saldo awal', '2025-05-19 11:03:08'),
(28, 24, 0, 'masuk', 'Saldo awal', '2025-05-19 11:05:26'),
(29, 25, 0, 'masuk', 'Saldo awal', '2025-05-19 13:37:28'),
(30, 26, 0, 'masuk', 'Saldo awal', '2025-05-19 13:39:21'),
(31, 27, 0, 'masuk', 'Saldo awal', '2025-05-19 13:41:39'),
(32, 28, 0, 'masuk', 'Saldo awal', '2025-05-19 13:43:03'),
(33, 29, 0, 'masuk', 'Saldo awal', '2025-05-19 13:44:10'),
(34, 30, 0, 'masuk', 'Saldo awal', '2025-05-19 13:45:53'),
(35, 31, 0, 'masuk', 'Saldo awal', '2025-05-19 13:47:07'),
(36, 32, 0, 'masuk', 'Saldo awal', '2025-05-19 13:48:32'),
(37, 33, 0, 'masuk', 'Saldo awal', '2025-05-19 13:49:49'),
(38, 34, 0, 'masuk', 'Saldo awal', '2025-05-19 13:50:48'),
(39, 35, 0, 'masuk', 'Saldo awal', '2025-05-19 13:52:52'),
(40, 36, 0, 'masuk', 'Saldo awal', '2025-05-19 13:54:16'),
(41, 37, 0, 'masuk', 'Saldo awal', '2025-05-19 13:56:18'),
(42, 38, 0, 'masuk', 'Saldo awal', '2025-05-19 13:58:46'),
(43, 39, 0, 'masuk', 'Saldo awal', '2025-05-19 14:00:16'),
(44, 40, 0, 'masuk', 'Saldo awal', '2025-05-19 14:03:49'),
(45, 41, 0, 'masuk', 'Saldo awal', '2025-05-19 14:04:39'),
(46, 42, 0, 'masuk', 'Saldo awal', '2025-05-19 14:05:30'),
(47, 43, 0, 'masuk', 'Saldo awal', '2025-05-19 14:06:45'),
(48, 44, 0, 'masuk', 'Saldo awal', '2025-05-19 14:07:39'),
(49, 45, 0, 'masuk', 'Saldo awal', '2025-05-19 14:08:20'),
(50, 46, 0, 'masuk', 'Saldo awal', '2025-05-19 14:09:00'),
(51, 47, 0, 'masuk', 'Saldo awal', '2025-05-19 14:09:44'),
(52, 48, 0, 'masuk', 'Saldo awal', '2025-05-19 14:10:24'),
(53, 49, 0, 'masuk', 'Saldo awal', '2025-05-19 14:11:09'),
(54, 50, 0, 'masuk', 'Saldo awal', '2025-05-19 14:11:56'),
(55, 51, 0, 'masuk', 'Saldo awal', '2025-05-19 14:12:46'),
(56, 52, 0, 'masuk', 'Saldo awal', '2025-05-19 14:13:24'),
(57, 53, 0, 'masuk', 'Saldo awal', '2025-05-19 14:14:06'),
(58, 54, 0, 'masuk', 'Saldo awal', '2025-05-19 14:14:44'),
(59, 55, 0, 'masuk', 'Saldo awal', '2025-05-19 14:15:27'),
(60, 56, 0, 'masuk', 'Saldo awal', '2025-05-19 14:16:42'),
(61, 57, 0, 'masuk', 'Saldo awal', '2025-05-19 14:17:42'),
(62, 58, 0, 'masuk', 'Saldo awal', '2025-05-19 14:19:00'),
(63, 59, 0, 'masuk', 'Saldo awal', '2025-05-19 14:20:19'),
(64, 60, 0, 'masuk', 'Saldo awal', '2025-05-19 14:21:42'),
(65, 61, 0, 'masuk', 'Saldo awal', '2025-05-19 14:22:37'),
(66, 22, 1000, 'masuk', 'mantap', '2025-05-21 10:56:32'),
(67, 22, 500, 'keluar', 'mantap', '2025-05-21 10:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id` int(11) NOT NULL,
  `santri_id` int(11) NOT NULL,
  `total_saldo` int(11) DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id`, `santri_id`, `total_saldo`, `updated_at`) VALUES
(1, 1, 0, '2025-05-17 09:05:37'),
(2, 2, 0, '2025-05-17 09:18:38'),
(3, 3, 0, '2025-05-17 09:19:01'),
(4, 4, 0, '2025-05-17 09:19:32'),
(5, 5, 0, '2025-05-17 09:22:05'),
(6, 6, 0, '2025-05-17 09:22:39'),
(7, 7, 0, '2025-05-17 09:23:18'),
(8, 8, 250000, '2025-05-19 08:59:56'),
(9, 9, 1000000, '2025-05-18 10:01:57'),
(10, 10, 0, '2025-05-19 10:03:07'),
(11, 11, 0, '2025-05-19 10:07:12'),
(12, 14, 0, '2025-05-19 10:50:39'),
(13, 15, 0, '2025-05-19 10:52:09'),
(14, 16, 0, '2025-05-19 10:53:39'),
(15, 17, 0, '2025-05-19 10:55:16'),
(16, 18, 0, '2025-05-19 10:56:44'),
(17, 19, 0, '2025-05-19 10:58:02'),
(18, 20, 0, '2025-05-19 10:59:15'),
(19, 21, 0, '2025-05-19 11:00:41'),
(20, 22, 500, '2025-05-21 10:56:48'),
(21, 23, 0, '2025-05-19 11:03:08'),
(22, 24, 0, '2025-05-19 11:05:26'),
(23, 25, 0, '2025-05-19 13:37:28'),
(24, 26, 0, '2025-05-19 13:39:21'),
(25, 27, 0, '2025-05-19 13:41:39'),
(26, 28, 0, '2025-05-19 13:43:03'),
(27, 29, 0, '2025-05-19 13:44:10'),
(28, 30, 0, '2025-05-19 13:45:53'),
(29, 31, 0, '2025-05-19 13:47:07'),
(30, 32, 0, '2025-05-19 13:48:32'),
(31, 33, 0, '2025-05-19 13:49:49'),
(32, 34, 0, '2025-05-19 13:50:48'),
(33, 35, 0, '2025-05-19 13:52:52'),
(34, 36, 0, '2025-05-19 13:54:16'),
(35, 37, 0, '2025-05-19 13:56:18'),
(36, 38, 0, '2025-05-19 13:58:46'),
(37, 39, 0, '2025-05-19 14:00:16'),
(38, 40, 0, '2025-05-19 14:03:49'),
(39, 41, 0, '2025-05-19 14:04:39'),
(40, 42, 0, '2025-05-19 14:05:30'),
(41, 43, 0, '2025-05-19 14:06:45'),
(42, 44, 0, '2025-05-19 14:07:39'),
(43, 45, 0, '2025-05-19 14:08:20'),
(44, 46, 0, '2025-05-19 14:09:00'),
(45, 47, 0, '2025-05-19 14:09:44'),
(46, 48, 0, '2025-05-19 14:10:24'),
(47, 49, 0, '2025-05-19 14:11:09'),
(48, 50, 0, '2025-05-19 14:11:56'),
(49, 51, 0, '2025-05-19 14:12:46'),
(50, 52, 0, '2025-05-19 14:13:24'),
(51, 53, 0, '2025-05-19 14:14:06'),
(52, 54, 0, '2025-05-19 14:14:44'),
(53, 55, 0, '2025-05-19 14:15:27'),
(54, 56, 0, '2025-05-19 14:16:42'),
(55, 57, 0, '2025-05-19 14:17:42'),
(56, 58, 0, '2025-05-19 14:19:00'),
(57, 59, 0, '2025-05-19 14:20:19'),
(58, 60, 0, '2025-05-19 14:21:42'),
(59, 61, 0, '2025-05-19 14:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `id` int(11) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `tgl_lahir` varchar(255) DEFAULT NULL,
  `kampus` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`id`, `nis`, `nama`, `kelas`, `tgl_lahir`, `kampus`, `password`, `foto`) VALUES
(10, '222302232', 'Hanifa fitri ramadhani', '3', '2010-08-14', 'admin', '$2y$10$5t8xe7lW8KQJBWISFAcLsOZugy/eecoKDbnJk/YuijyDXF7JXqwEK', 'webcam-toy-photo-20240921081155.jpg'),
(11, '192003015', 'Azmi Abid Izzati', '6', '2007-01-18', 'QBS', '$2y$10$/AGvRpzS2W5UPw/3cqQ4rukS/LUDuptPaB50qmDIVBbR50UpVBGtG', '192003015.webp'),
(14, '192003099', 'Royyan Ariefiansyah', '6', '2007-12-07', 'QBS', '$2y$10$IAeksqbexbor7Oqze2SbruWW3Kf7T2HUfh4CQWuc5tyXWpdGySxQS', '192003099.webp'),
(15, '202103126', 'Hudzaifa Ahmad Al-faiz', '5', '2007-10-13', 'QBS', '$2y$10$6dUjrAJcjNAbibeq5Th9BeWU3BMeBAGj3aIORt2Xl1z2Wvp0o4kfa', '202103126.webp'),
(16, '202103144', 'Imam Daffa Muntazhar', '5', '2007-11-24', 'QBS', '$2y$10$ZKmnx4PA99dFTges23llvuAfK1puq89PherDBxUcmMKRiDqVKOugm', '202103144.webp'),
(17, '202103128', 'Muhammad Azzam Mustafidh', '5', '2008-04-23', 'QBS', '$2y$10$eMJbw8mtYf5O3qvmZSYqKOexR5KAi7yzGiYBKNY7jVQ.jHIb7Irj2', '202103128.webp'),
(18, '202103132', 'Muhammad Al Fathur Rabbani', '5', '2008-05-24', 'QBS', '$2y$10$NvRD8lq2FDZYAvPgLv9vL.Lm3WJ/nmJuhihpQ0BVYkISW/.WENhMq', '202103132.webp'),
(19, '202103135', 'Muhammad Ihsan Aviandy', '5', '2007-06-29', 'QBS', '$2y$10$MBL65E.YXoaBcybZEiM1O.Z8rfeaDq/jj64ntL5bFgwpMIA7UYN2S', '202103135.webp'),
(20, '202103131', 'Muhammad Zakirullah', '5', '2008-04-24', 'QBS', '$2y$10$pNPl2amcKbfd24n4lwV/g.GMTVxqHoRdOor1aXGpIuHatgVC41Xv2', '202103131.webp'),
(21, '202103139', 'Muhammad Fidiansyah Al-arif', '5', '2008-01-27', 'QBS', '$2y$10$x0mjtnTmgbQy51r7iy3aX.7JQW5la9cmhNUxlFlyvxPbPiLFWvhZi', '202103139.webp'),
(22, '202103149', 'Yazid Fathurrahman', '5', '2008-02-29', 'QBS', '$2y$10$uEhBZmOE/ntcmmmCbf3yUOnakQaS6MvblI0z2ukEZsJedCwDdQf9C', '202103149.webp'),
(23, '202103115', 'Afghan Hafizh Taqiyya', '5', '2008-02-28', 'QBS', '$2y$10$Zw/NcFaHPUnplMb3yAunuuCMlHeGP7uYrcj.Z4jDHb.NI1GxnLBqy', '202103115.webp'),
(24, '202103145', 'Muhammad Amir Al0fath', '5', '2008-05-25', 'QBS', '$2y$10$RHsKs.jgfUjircOCIW8f1edlVseDy3AMfRE9Ppkr12byLuru2G.R6', '202103132.webp'),
(25, '212203160', 'Hafidz Muhammad Yasin	Hafidz', '4', '2009-01-10', 'QBS', '$2y$10$/AeXN7/P8IWSCcjNqLRf8eMIn39vLPRvSJIBDc39vw1guiQu6DeQS', '212203160.webp'),
(26, '212203162', 'Harits Athif Rafi\' \'Uddin', '4', '2009-02-10', 'QBS', '$2y$10$MhlOZw3pwehsxqL2AococuXspuznlsb2zgM5Riq98GDMTXIakAMkC', '212203162.webp'),
(27, '212203169', 'Muhammad Shidqi Fathul Islam', '4', '2009-03-21', 'QBS', '$2y$10$ncYG9lMsDlWbIG9gmKAebumbxrOqQXKciRm3Eru5GkMzKKnF9cZB2', '212203169.webp'),
(28, '212203175', 'Abduh Abdullah Muhammad Al Hurr', '3', '2006-08-17', 'QBS', '$2y$10$ccJeaXmWj0I408khDXLvQOL0IMgI9yy7q55As7J/uCV76158pYLeG', '212203175.webp'),
(29, '222303176', 'Althaf Setiawan Shabilli Haq', '3', '2009-12-29', 'QBS', '$2y$10$z8hP9JOFO9X/Vf8kkrAyrO8yBy9S2NtmTASWQ8DmPti.9yQrI82jq', '222303176.webp'),
(30, '222303177', 'Arjun Rizki El Rumi', '3', '2010-06-11', 'QBS', '$2y$10$VOI3EivtfPRhVKVvbzOdEu5ll.onuQaBWdlKK1h6XTB8pG9mUu3Nu', '222303177.webp'),
(31, '222303178', 'Arlevi Arya Saputra', '3', '2010-01-24', 'QBS', '$2y$10$PGPyhTFcGrVlBQfbGh7rd.ufckYpmrw2wfD7QnVCjLoP/NK4lTfyW', '222303178.webp'),
(32, '222303179', 'Dzakwan Adinata Adji', '3', '2010-02-10', 'QBS', '$2y$10$WOwm5qikPeFXIMQKvQM6EuI5ijQ2U60qNL03L6ahHpjqwEjmwtJNu', '222303179.webp'),
(33, '222303180', 'Fathi Zain Rayyansyah', '3', '2010-08-01', 'QBS', '$2y$10$7J5pHZFtCynSljA.6w1f6OfvsT40zECZzs5yj62nVCqJGun6rMDma', '222303180.webp'),
(34, '222303181', 'Haris Abdi', '3', '2007-04-07', 'QBS', '$2y$10$V0sv4UVt7kweRGodXTme2O2/S6gq8cQPABp9Wo3vidsIpk656CSqW', '222303181.webp'),
(35, '232403216', 'Muhammad Arifin Ali', '2', '2010-02-15', 'QBS', '$2y$10$tnrhbc/KD9X/.lM4DWGLaOET6bb0yGEEbjt2.6ZzKBwV8a78r8G0W', '232403216.webp'),
(36, '232403218', 'Muhammad Dzulfikar', '2', '2006-05-12', 'QBS', '$2y$10$Gy5w.zO81m7lAYIjD1yjlOAKOGedGylG.MXpLZ4Ziep47Ar7PV1im', '232403218.webp'),
(37, '242503249', 'Nizam Wahyu Maulana', '1', '2012-02-20', 'QBS', '$2y$10$nNUH5VVyGglCYDAcwCqBxOAPGK7nfhPwEmEaPZH3BaM1P8O5PLnde', '242503249.webp'),
(38, '242503236', 'Daryl Achmad Kayzan', '1', '2009-05-02', 'QBS', '$2y$10$N/AJMUj9.G7RUOL7r3TLUeHXR88cgrwNc6NNkFU.KxsnetE0gE9tC', '242503236.webp'),
(39, '192002121', 'Aisha Fathia Nur Kamila', '6', '2006-09-23', 'FQ', '$2y$10$h/H5DK2lGQ7z.uYq4RSNXeLdAZCECeRtI0uC0IElP8xqgZ8V2bCaS', '192002121.webp'),
(40, '192002129', 'Alya Adibah', '6', '2006-12-03', 'FQ', '$2y$10$TmXTlg4glzGM0aUExLofLerO/w4ctn8mMyUQKbumGcykBFFBLtTli', '192002129.webp'),
(41, '192002132', 'Balqis Anisah Hartoyo', '6', '2007-05-14', 'FQ', '$2y$10$6oW2fhzLqFU.aoVyIC/fDOEmG7hd3M6m.Po/h4xubor.JWzXste7O', '192002132.webp'),
(42, '192002144', 'Kayla Awfa Nuha Wibowo', '6', '2006-11-26', 'FQ', '$2y$10$9LIFQPehseG98aAYsQY7SeBrksD6zB3.9Bz4Fb2t09jxUaT9wjBIa', '192002144.webp'),
(43, '192002150', 'Nadiya Shabrina Asy Syifa', '6', '2006-12-13', 'FQ', '$2y$10$CEq/.NXY2hkB6SOi/CVNTuFArc2rpWW0EPZnzn1UGS/3qHjlJcAY.', '192002150.webp'),
(44, '192002151', 'Naura Kamila Maharani', '6', '2007-06-10', 'FQ', '$2y$10$PMnWmxWppIlUdTx19A5xEuQvPK8MCUEEe4ZnWncV0Ykh/14dnOA32', '192002151.webp'),
(45, '202102177', 'Azzahra Rajni Danica', '5', '2008-08-06', 'FQ', '$2y$10$2ikE.E1fmxicq3nFW8xQve/XVxD4PXHZDZFL3bL1M1y19o2wGXOsi', '202102177.webp'),
(46, '202102179', 'Danish Izza Aulia', '5', '2007-09-29', 'FQ', '$2y$10$V7PstrrHbbCpxr5zWo2qKOHVmLTQ13n7FyZlxpnnNP7Po1xSzkCf.', '202102179.webp'),
(47, '232402257', 'Baiq Amira Raihana', '5', '2007-04-03', 'FQ', '$2y$10$SSMyxS03I.74lO/Dmg6JZeKrtelgwKULhBtnrOS6rd96lce1xlSzO', '232402257.webp'),
(48, '212202203', 'Alifia Rizkia Putri', '4', '2008-12-28', 'FQ', '$2y$10$tsku71EIQLfwwad4lf1oCOVtV0mCxKdp7JxYVnxD7Vup/fuJeeBjy', '212202203.webp'),
(49, '212202211', 'Kayla Nuryana Hidayati', '4', '2008-04-28', 'FQ', '$2y$10$Ksrs31EuPYBiyw1sBmmv5.NmMWDxLDNGsG/kuwddG.OufXf/vqIPi', '212202211.webp'),
(50, '212202212', 'Kayyisah Althafunnisa', '4', '2009-03-23', 'FQ', '$2y$10$oRV/kV5TyDjrMDYOWca7wOdkrLcsgaNGKKyrLjNaHZ0CDs.fix2Di', '212202212.webp'),
(51, '212202219', 'Raihani Qorrata A\'\'Yun', '4', '2009-06-12', 'FQ', '$2y$10$oyJt94hZ.0lQRdG4LY1YhuYgxmsIiGUTLWCGYmC02.6by/KdOt4fq', '212202219.webp'),
(52, '212202220', 'Rani Apriliana Putri', '4', '2009-04-13', 'FQ', '$2y$10$4O13GDSPKFCmHJ8jmyP0qe8UblQIh0k4yG6V4BtGVTiCeil0Wo1L6', '212202220.webp'),
(53, '212202222', 'Syafa Dwi Aurel', '4', '2009-10-17', 'FQ', '$2y$10$hkPhqNSwUGi2Yf7udpYLQusoQNIXCm3G22bwxpqVjbg3jofbrvTWe', '212202222.webp'),
(54, '212202226', 'Zalfa Khairunnisa Taher', '4', '2008-11-07', 'FQ', '$2y$10$LswChbQoF.7uTrj6jcTr4enjiCDLl1QVfnc.tBVkYDuNwALeaIGnq', '212202226.webp'),
(55, '222302229', 'Aisyah Rizqi Kamila	Aisyah', '4', '2009-08-24', 'FQ', '$2y$10$wVrMqiPswLd6oEROJGOr7eyUdAEoQXXyX01NHpsnsN6EUSWczjYSy', '222302229.webp'),
(56, '222302230', 'Baiq Naazilah Shaahifah', '3', '2009-06-26', 'FQ', '$2y$10$J7rOP7PiulBeGBVetcZ89.aGez2EBu4Eev8EuC/.KraSAGIxAvkhC', '222302230.webp'),
(57, '222302233', 'Humaira Azka Mufidah', '3', '2010-05-07', 'FQ', '$2y$10$.4af.iYFI.amDAMU7H6lcOaWl4L4/7xPlraptRml.55ipeYxfQfUi', '222302233.webp'),
(58, '232402243', 'Alivia Lathifah Budiman', '2', '2008-04-21', 'FQ', '$2y$10$GTx6KZxngylfKWk5m7dhPOtUyPtr6GwFxXGpwg9unLTFlU0FJox5C', '232402243.webp'),
(59, '232402250', 'Khansa Aqilah Falihah', '2', '2010-10-10', 'FQ', '$2y$10$Xwy9E0zVw8lb1n2T2/AqBOrfM/OOrwyX3w8J98bPLyPeBOnSPWWq6', '232402250.webp'),
(60, '242502266', 'Haniyya Syahidah', '1', '2011-09-20', 'FQ', '$2y$10$Ve69MLwan0QwOJuUNR4OC.Tz.5uF2qFR3A9kdkmzcEyCIvtg8plvC', '242502266.webp'),
(61, '242502262', 'Fathiyya Zahirah', '1', '2009-04-27', 'FQ', '$2y$10$ON2SaWZIeof9r1Mf62sEAegm8y7HvmXYi/eA1cVctb9YR.9jsREXi', '242502262.webp'),
(62, '0123', 'admin', '13', '25/08/2010', 'admin', '$2y$10$OebdkTK8rOnVVtVFp0Cn0eu0PppKJnT4aazvxYBhlayn0HR9Yj1jy', 'admin'),
(63, '123', 'parent', '14', '12/08/2000', 'parent', '$2y$10$jB78HQdyqhltjhHX3wpLEuqb8rH6vOagTXRuDRyne0ivRPkm4T9y.', 'parent'),
(64, '242502259', 'Alisha Talitha Samantha', '1', '05/09/2012', 'FQ', '$2y$10$HrFrIcB0N.yj62VkTTjml.MNEwBkJhaoSucwl4y6r0BjVbBlKZo8u', '242502259.webp'),
(65, '222303201', 'Thoriq Mustafid Ahyan', '3', '28/08/2009', 'QBS', '$2y$10$EwjFBtF7rf64F/8nGb9DWOfbeDplo8T4.CFQ3qfp3pv/6nqIHhhdy', '222303201.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `santri_id` (`santri_id`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `santri_id` (`santri_id`);

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `santri`
--
ALTER TABLE `santri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
