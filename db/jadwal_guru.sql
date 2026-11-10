-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 08:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwal_guru`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_ke` varchar(10) DEFAULT NULL,
  `pengganti_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nbm` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nbm`, `nama`) VALUES
(6, 979261, 'Zaki Abdul Wahid'),
(7, 953476, 'Ria Pusvita Sari'),
(8, 1005918, 'Athiq Amiliyah'),
(9, 1005915, 'Niswatul Mujtahidah'),
(10, 1005914, 'Arif Wahyudi'),
(11, 979259, 'Rudi Purnawan'),
(12, 686336, ' AH. Nurhasan Anwar'),
(13, 963637, 'Sri Isna Wardhani'),
(14, 678817, 'Ahmad Faizun'),
(15, 950694, 'Siti Mariyanti'),
(16, 950691, 'Indah Nur Rahmawati'),
(17, 0, 'Prima Ari Rosyida'),
(18, 0, 'Ida Poerwaningrum'),
(20, 0, 'Muhammad Zainul Arif'),
(21, 0, 'Nurul Mahmudiyah'),
(22, 0, 'Pradita Eka Putri'),
(23, 0, 'Naharun Mubarak'),
(24, 0, 'Fitri Musrofihah'),
(25, 0, 'Nur Asiyah'),
(26, 0, 'Rika Maharani'),
(27, 0, 'Umi Syarifah'),
(28, 0, 'Nisfil Mafidah'),
(29, 0, 'Shofan Hariyanto'),
(30, 0, 'Nur Yanidha Qomariyah'),
(31, 0, 'Syafa\'atul Ilmiah'),
(32, 0, 'Ita Muflikhatul Ummah'),
(33, 0, 'Ria Eka Lestari'),
(34, 0, 'Putri Suci  Muliyah'),
(35, 0, 'Askiyatin'),
(36, 0, 'Nur Aini Ochtafiya'),
(37, 0, 'Achmad Nazarudin'),
(38, 0, 'Eka Yunita Rakhmawati'),
(39, 0, 'Rizqi Rahman'),
(40, 0, 'Zahara Firdausi'),
(41, 0, 'Ema Rohmah Hayati'),
(42, 0, 'Muhammad Ilham Yahya'),
(43, 0, 'Reza Dwi Anistawati'),
(44, 0, 'Bijak Laksono Putro'),
(45, 0, 'Ajeng Putri Dwi Rohma'),
(46, 0, 'Wardatul Khumairok'),
(47, 0, 'Dyah Novira Dwi Jayanti'),
(48, 0, 'Fidyah Izzul Islami'),
(49, 0, 'Heyma Aqira'),
(50, 0, 'Nur Wahyu Mahdiyan'),
(51, 0, 'Hasbi Ash Shiddieqi'),
(52, 950690, 'M. Fadloli Aziz ');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `mapel_id` int(11) DEFAULT NULL,
  `hari` varchar(10) DEFAULT NULL,
  `jam_ke` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `guru_id`, `kelas_id`, `mapel_id`, `hari`, `jam_ke`) VALUES
(24, 6, 11, 4, 'Senin', '3-4'),
(25, 6, 12, 6, 'Rabu', '3-4'),
(26, 6, 12, 4, 'Senin', '5-6'),
(27, 6, 13, 6, 'Rabu', '5-6'),
(28, 6, 11, 6, 'Rabu', '7-8'),
(29, 6, 4, 5, 'Senin', '9-10'),
(30, 6, 13, 4, 'Rabu', '9-10'),
(31, 6, 5, 4, 'Senin', '11-12'),
(32, 6, 5, 6, 'Rabu', '11-12'),
(43, 13, 14, 8, 'Rabu', '3-4'),
(44, 13, 15, 7, 'Kamis', '3-4'),
(45, 13, 14, 12, 'Jumat', '3-4'),
(46, 13, 15, 8, 'Rabu', '5-6'),
(47, 13, 10, 7, 'Senin', '7-8'),
(48, 13, 3, 8, 'Rabu', '7-8'),
(49, 13, 3, 7, 'Kamis', '7-8'),
(50, 13, 9, 7, 'Senin', '9-10'),
(51, 13, 2, 7, 'Senin', '11-12'),
(52, 13, 14, 9, 'Selasa', '11-12'),
(53, 13, 14, 7, 'Kamis', '11-12'),
(54, 6, 5, 5, 'Selasa', '9-10'),
(55, 16, 1, 19, 'Senin', '1-2'),
(56, 16, 1, 12, 'Kamis', '1-2'),
(57, 16, 8, 14, 'Selasa', '3-4'),
(58, 16, 1, 6, 'Rabu', '3-4'),
(59, 16, 7, 14, 'Selasa', '5-6'),
(60, 16, 1, 14, 'Selasa', '7-8'),
(61, 16, 7, 6, 'Rabu', '7-8'),
(62, 16, 8, 6, 'Rabu', '11-12'),
(63, 20, 1, 2, 'Senin', '5-6'),
(64, 20, 1, 15, 'Jumat', '5-6'),
(65, 20, 8, 2, 'Senin', '7-8'),
(66, 20, 8, 2, 'Kamis', '7-8'),
(67, 20, 1, 15, 'Jumat', '7-8'),
(68, 20, 1, 2, 'Selasa', '11-12'),
(69, 20, 1, 2, 'Kamis', '11-12'),
(70, 43, 8, 1, 'Kamis', '1-2'),
(71, 43, 7, 1, 'Selasa', '3-4'),
(72, 43, 7, 1, 'Rabu', '3-4'),
(73, 43, 7, 1, 'Senin', '5-6'),
(74, 43, 1, 1, 'Selasa', '5-6'),
(75, 43, 7, 1, 'Kamis', '5-6'),
(76, 43, 8, 29, 'Jumat', '5-6'),
(77, 43, 1, 1, 'Senin', '7-8'),
(78, 43, 8, 1, 'Selasa', '7-8'),
(79, 43, 1, 1, 'Rabu', '7-8'),
(80, 43, 1, 1, 'Kamis', '7-8'),
(81, 43, 1, 32, 'Selasa', '9-10'),
(82, 43, 8, 1, 'Rabu', '9-10'),
(83, 43, 8, 32, 'Selasa', '11-12'),
(84, 45, 7, 19, 'Senin', '1-2'),
(85, 45, 8, 4, 'Kamis', '5-6'),
(86, 45, 7, 7, 'Selasa', '7-8'),
(87, 45, 7, 4, 'Kamis', '7-8'),
(88, 45, 1, 4, 'Kamis', '9-10'),
(89, 45, 8, 7, 'Kamis', '11-12'),
(90, 43, 7, 32, 'Rabu', '11-12'),
(91, 24, 8, 19, 'Senin', '1-2'),
(92, 24, 7, 18, 'Kamis', '1-2'),
(93, 24, 8, 15, 'Senin', '5-6'),
(94, 24, 8, 30, 'Selasa', '5-6'),
(95, 24, 1, 18, 'Kamis', '5-6'),
(96, 24, 8, 15, 'Jumat', '7-8'),
(97, 24, 1, 7, 'Rabu', '9-10'),
(98, 24, 8, 30, 'Kamis', '9-10'),
(99, 24, 7, 18, 'Selasa', '11-12'),
(100, 18, 7, 2, 'Senin', '7-8'),
(101, 18, 1, 16, 'Kamis', '1-2'),
(102, 18, 7, 15, 'Jumat', '5-6'),
(103, 18, 7, 15, 'Jumat', '7-8'),
(104, 18, 7, 2, 'Selasa', '9-10'),
(105, 18, 7, 28, 'Rabu', '9-10'),
(106, 18, 8, 2, 'Kamis', '9-10'),
(107, 18, 8, 16, 'Kamis', '11-12'),
(108, 20, 1, 28, 'Rabu', '11-12'),
(109, 38, 2, 19, 'Senin', '1-2'),
(110, 38, 2, 2, 'Rabu', '3-4'),
(111, 38, 2, 28, 'Senin', '5-6'),
(112, 38, 10, 28, 'Selasa', '5-6'),
(113, 38, 10, 2, 'Jumat', '5-6'),
(114, 38, 10, 2, 'Senin', '7-8'),
(115, 38, 2, 2, 'Selasa', '7-8'),
(116, 38, 2, 4, 'Rabu', '7-8'),
(117, 38, 2, 16, 'Kamis', '7-8'),
(118, 38, 10, 2, 'Rabu', '9-10'),
(119, 38, 2, 2, 'Kamis', '9-10'),
(120, 38, 9, 16, 'Rabu', '11-12'),
(121, 17, 9, 19, 'Senin', '1-2'),
(122, 17, 2, 1, 'Selasa', '3-4'),
(123, 17, 9, 4, 'Rabu', '3-4'),
(124, 17, 9, 1, 'Senin', '5-6'),
(125, 17, 9, 1, 'Selasa', '5-6'),
(126, 17, 2, 1, 'Kamis', '5-6'),
(127, 17, 9, 1, 'Jumat', '5-6'),
(128, 17, 2, 1, 'Senin', '7-8'),
(129, 17, 10, 1, 'Selasa', '7-8'),
(130, 17, 9, 1, 'Kamis', '7-8'),
(131, 17, 2, 1, 'Jumat', '7-8'),
(132, 17, 10, 1, 'Senin', '9-10'),
(133, 17, 9, 32, 'Rabu', '9-10'),
(134, 17, 10, 32, 'Rabu', '11-12'),
(135, 47, 10, 19, 'Senin', '1-2'),
(136, 47, 10, 4, 'Rabu', '1-2'),
(137, 47, 10, 15, 'Kamis', '3-4'),
(138, 47, 10, 15, 'Jumat', '5-6'),
(139, 47, 2, 15, 'Jumat', '7-8'),
(140, 47, 10, 31, 'Kamis', '9-10'),
(141, 47, 2, 15, 'Kamis', '11-12'),
(142, 49, 9, 2, 'Rabu', '1-2'),
(143, 49, 9, 18, 'Selasa', '3-4'),
(144, 49, 9, 15, 'Kamis', '3-4'),
(145, 49, 9, 2, 'Jumat', '5-6'),
(146, 49, 9, 28, 'Senin', '7-8'),
(147, 49, 9, 2, 'Selasa', '7-8'),
(148, 49, 2, 15, 'Jumat', '7-8'),
(149, 49, 9, 18, 'Senin', '11-12'),
(150, 49, 9, 2, 'Kamis', '11-12'),
(151, 30, 10, 30, 'Selasa', '3-4'),
(152, 30, 2, 14, 'Kamis', '3-4'),
(153, 30, 9, 14, 'Kamis', '5-6'),
(154, 30, 10, 6, 'Rabu', '7-8'),
(155, 30, 9, 6, 'Kamis', '9-10'),
(156, 30, 10, 30, 'Senin', '11-12'),
(157, 30, 2, 6, 'Rabu', '11-12'),
(158, 30, 10, 14, 'Kamis', '11-12'),
(159, 28, 2, 32, 'Rabu', '1-2'),
(160, 28, 10, 29, 'Kamis', '5-6'),
(161, 51, 1, 17, 'Rabu', '1-2'),
(162, 51, 9, 17, 'Rabu', '7-8'),
(163, 51, 2, 17, 'Rabu', '9-10'),
(164, 51, 1, 33, 'Senin', '9-10'),
(165, 51, 7, 33, 'Senin', '11-12'),
(166, 51, 2, 33, 'Selasa', '9-10'),
(167, 51, 10, 33, 'Selasa', '11-12'),
(168, 51, 14, 35, 'Jumat', '9-10'),
(169, 51, 16, 35, 'Jumat', '11-12'),
(170, 51, 10, 17, 'Rabu', '3-4'),
(171, 34, 3, 19, 'Senin', '1-2'),
(172, 34, 14, 18, 'Kamis', '1-2'),
(173, 34, 3, 2, 'Kamis', '3-4'),
(174, 34, 15, 9, 'Selasa', '5-6'),
(175, 34, 3, 2, 'Jumat', '5-6'),
(176, 34, 14, 18, 'Senin', '7-8'),
(177, 34, 3, 34, 'Jumat', '9-10'),
(178, 34, 3, 18, 'Senin', '11-12'),
(179, 34, 3, 9, 'Selasa', '11-12'),
(180, 34, 3, 18, 'Kamis', '11-12'),
(181, 34, 14, 34, 'Jumat', '11-12'),
(182, 21, 14, 1, 'Selasa', '1-2'),
(183, 21, 15, 29, 'Kamis', '1-2'),
(184, 21, 3, 1, 'Senin', '3-4'),
(185, 21, 3, 32, 'Rabu', '3-4'),
(186, 21, 14, 1, 'Senin', '5-6'),
(187, 21, 14, 32, 'Rabu', '5-6'),
(188, 21, 15, 1, 'Senin', '7-8'),
(189, 21, 3, 1, 'Selasa', '7-8'),
(190, 21, 15, 32, 'Rabu', '7-8'),
(191, 21, 14, 1, 'Kamis', '7-8'),
(192, 21, 3, 12, 'Jumat', '7-8'),
(193, 21, 3, 1, 'Kamis', '9-10'),
(194, 21, 15, 1, 'Selasa', '11-12'),
(195, 39, 14, 19, 'Senin', '1-2'),
(196, 39, 15, 6, 'Jumat', '3-4'),
(197, 39, 3, 14, 'Senin', '5-6'),
(198, 39, 3, 6, 'Rabu', '5-6'),
(199, 39, 14, 6, 'Rabu', '7-8'),
(200, 39, 15, 14, 'Senin', '9-10'),
(201, 39, 14, 15, 'Senin', '11-12'),
(202, 36, 14, 28, 'Senin', '3-4'),
(203, 36, 14, 2, 'Kamis', '3-4'),
(204, 36, 14, 2, 'Jumat', '3-4'),
(205, 36, 15, 30, 'Senin', '5-6'),
(206, 36, 15, 12, 'Jumat', '5-6'),
(207, 36, 15, 2, 'Kamis', '7-8'),
(208, 36, 15, 2, 'Jumat', '7-8'),
(210, 36, 15, 30, 'Kamis', '9-10'),
(211, 36, 15, 28, 'Senin', '11-12'),
(212, 46, 15, 19, 'Senin', '1-2'),
(213, 46, 3, 9, 'Kamis', '1-2'),
(214, 46, 15, 9, 'Senin', '3-4'),
(215, 46, 15, 15, 'Rabu', '3-4'),
(216, 46, 3, 15, 'Jumat', '3-4'),
(217, 46, 14, 15, 'Jumat', '5-6'),
(218, 46, 3, 9, 'Senin', '7-8'),
(219, 46, 14, 15, 'Jumat', '7-8'),
(220, 46, 14, 9, 'Senin', '9-10'),
(221, 46, 14, 9, 'Kamis', '9-10'),
(222, 46, 15, 31, 'Kamis', '11-12'),
(223, 50, 3, 4, 'Selasa', '1-2'),
(224, 50, 14, 4, 'Selasa', '5-6'),
(225, 50, 15, 4, 'Selasa', '7-8'),
(226, 44, 15, 17, 'Selasa', '1-2'),
(227, 44, 3, 17, 'Selasa', '5-6'),
(228, 44, 14, 17, 'Selasa', '7-8'),
(229, 44, 14, 33, 'Rabu', '9-10'),
(230, 44, 14, 34, 'Jumat', '9-10'),
(231, 44, 15, 33, 'Rabu', '11-12'),
(232, 44, 15, 34, 'Jumat', '11-12'),
(233, 35, 4, 9, 'Senin', '3-4'),
(234, 35, 16, 9, 'Kamis', '3-4'),
(235, 35, 18, 16, 'Jumat', '3-4'),
(236, 35, 4, 9, 'Kamis', '5-6'),
(237, 35, 18, 12, 'Jumat', '5-6'),
(238, 35, 16, 9, 'Senin', '7-8'),
(239, 35, 17, 16, 'Jumat', '7-8'),
(240, 35, 17, 9, 'Senin', '11-12'),
(241, 15, 16, 19, 'Senin', '1-2'),
(242, 15, 18, 20, 'Rabu', '1-2'),
(243, 15, 18, 8, 'Kamis', '5-6'),
(244, 15, 16, 12, 'Jumat', '5-6'),
(245, 15, 17, 20, 'Rabu', '7-8'),
(246, 15, 4, 20, 'Jumat', '7-8'),
(247, 15, 16, 8, 'Kamis', '9-10'),
(248, 15, 16, 20, 'Rabu', '11-12'),
(249, 15, 17, 8, 'Kamis', '11-12'),
(250, 42, 4, 1, 'Selasa', '1-2'),
(251, 42, 16, 1, 'Rabu', '1-2'),
(252, 42, 18, 29, 'Kamis', '1-2'),
(253, 42, 16, 1, 'Senin', '3-4'),
(254, 42, 17, 1, 'Selasa', '3-4'),
(255, 42, 4, 1, 'Kamis', '3-4'),
(256, 42, 18, 1, 'Selasa', '5-6'),
(257, 42, 18, 1, 'Rabu', '5-6'),
(258, 42, 16, 32, 'Kamis', '5-6'),
(259, 42, 4, 32, 'Jumat', '5-6'),
(260, 42, 17, 1, 'Senin', '7-8'),
(261, 42, 4, 1, 'Rabu', '7-8'),
(262, 42, 17, 5, 'Senin', '9-10'),
(263, 42, 17, 32, 'Kamis', '9-10'),
(264, 42, 4, 1, 'Senin', '11-12'),
(265, 42, 16, 1, 'Selasa', '11-12'),
(266, 42, 17, 1, 'Rabu', '11-12'),
(267, 42, 18, 32, 'Kamis', '11-12'),
(268, 25, 17, 19, 'Senin', '1-2'),
(269, 25, 17, 14, 'Rabu', '1-2'),
(270, 25, 17, 6, 'Senin', '3-4'),
(271, 25, 16, 6, 'Selasa', '3-4'),
(272, 25, 4, 6, 'Selasa', '5-6'),
(273, 25, 4, 14, 'Rabu', '5-6'),
(274, 25, 18, 6, 'Senin', '7-8'),
(275, 25, 16, 14, 'Rabu', '7-8'),
(276, 25, 18, 5, 'Senin', '9-10'),
(277, 25, 18, 14, 'Rabu', '11-12'),
(278, 41, 18, 19, 'Senin', '1-2'),
(279, 41, 4, 18, 'Rabu', '1-2'),
(280, 41, 18, 30, 'Senin', '3-4'),
(281, 41, 17, 18, 'Rabu', '5-6'),
(282, 41, 17, 18, 'Kamis', '5-6'),
(283, 41, 4, 18, 'Senin', '7-8'),
(284, 41, 18, 30, 'Rabu', '7-8'),
(285, 41, 18, 5, 'Senin', '9-10'),
(286, 41, 16, 18, 'Senin', '11-12'),
(287, 41, 16, 18, 'Kamis', '11-12'),
(288, 41, 18, 34, 'Jumat', '9-10'),
(289, 41, 18, 34, 'Jumat', '11-12'),
(290, 33, 18, 5, 'Senin', '9-10'),
(291, 33, 18, 34, 'Jumat', '9-10'),
(292, 33, 18, 31, 'Senin', '11-12'),
(293, 33, 18, 34, 'Jumat', '11-12'),
(294, 44, 4, 17, 'Selasa', '3-4'),
(295, 44, 17, 17, 'Selasa', '9-10'),
(296, 51, 18, 17, 'Selasa', '1-2'),
(297, 51, 4, 17, 'Selasa', '3-4'),
(298, 51, 16, 17, 'Selasa', '5-6'),
(299, 35, 18, 9, 'Kamis', '7-8'),
(300, 48, 17, 28, 'Selasa', '1-2'),
(301, 48, 4, 2, 'Kamis', '1-2'),
(302, 48, 18, 28, 'Selasa', '3-4'),
(303, 48, 17, 2, 'Kamis', '3-4'),
(304, 48, 4, 2, 'Jumat', '3-4'),
(305, 48, 17, 2, 'Jumat', '5-6'),
(306, 48, 16, 2, 'Kamis', '7-8'),
(307, 48, 16, 16, 'Jumat', '7-8'),
(308, 48, 16, 28, 'Selasa', '9-10'),
(309, 48, 18, 2, 'Kamis', '9-10'),
(310, 48, 4, 28, 'Selasa', '11-12'),
(311, 48, 4, 16, 'Kamis', '11-12'),
(312, 23, 16, 7, 'Jumat', '3-4'),
(313, 23, 4, 7, 'Kamis', '7-8'),
(314, 23, 18, 7, 'Senin', '9-10'),
(315, 23, 17, 7, 'Senin', '11-12'),
(316, 50, 17, 4, 'Jumat', '3-4'),
(317, 50, 16, 4, 'Rabu', '5-6'),
(318, 50, 18, 4, 'Jumat', '7-8'),
(319, 50, 4, 4, 'Rabu', '11-12'),
(320, 9, 5, 19, 'Senin', '1-2'),
(321, 9, 12, 15, 'Selasa', '1-2'),
(322, 9, 12, 20, 'Senin', '3-4'),
(323, 9, 5, 15, 'Selasa', '3-4'),
(324, 9, 11, 20, 'Senin', '5-6'),
(325, 9, 11, 15, 'Selasa', '7-8'),
(326, 9, 5, 20, 'Senin', '9-10'),
(327, 9, 13, 15, 'Selasa', '11-12'),
(328, 9, 5, 12, 'Jumat', '7-8'),
(329, 32, 11, 19, 'Senin', '1-2'),
(330, 32, 5, 9, 'Selasa', '1-2'),
(331, 32, 12, 9, 'Kamis', '3-4'),
(332, 32, 11, 9, 'Jumat', '3-4'),
(333, 32, 13, 9, 'Kamis', '7-8'),
(334, 32, 11, 12, 'Jumat', '7-8'),
(335, 32, 12, 5, 'Selasa', '9-10'),
(336, 32, 13, 20, 'Senin', '11-12'),
(337, 32, 11, 9, 'Selasa', '11-12'),
(338, 32, 5, 9, 'Kamis', '11-12'),
(339, 32, 12, 9, 'Rabu', '9-10'),
(340, 32, 11, 9, 'Rabu', '11-12'),
(341, 40, 12, 19, 'Senin', '1-2'),
(342, 40, 11, 2, 'Selasa', '1-2'),
(343, 40, 12, 28, 'Kamis', '1-2'),
(344, 40, 13, 2, 'Selasa', '3-4'),
(345, 40, 11, 28, 'Kamis', '3-4'),
(346, 40, 5, 2, 'Jumat', '3-4'),
(347, 40, 13, 2, 'Senin', '5-6'),
(348, 40, 5, 2, 'Selasa', '7-8'),
(349, 40, 5, 28, 'Kamis', '7-8'),
(350, 40, 12, 12, 'Jumat', '7-8'),
(351, 40, 12, 2, 'Senin', '9-10'),
(352, 40, 11, 2, 'Senin', '11-12'),
(353, 40, 12, 2, 'Selasa', '11-12'),
(354, 40, 13, 28, 'Kamis', '11-12'),
(355, 11, 5, 1, 'Selasa', '1-2'),
(356, 11, 5, 1, 'Kamis', '1-2'),
(357, 11, 13, 1, 'Senin', '3-4'),
(358, 11, 12, 1, 'Selasa', '3-4'),
(359, 11, 13, 29, 'Kamis', '3-4'),
(360, 11, 12, 1, 'Jumat', '3-4'),
(361, 11, 5, 1, 'Senin', '5-6'),
(362, 11, 11, 1, 'Kamis', '5-6'),
(363, 11, 13, 1, 'Selasa', '7-8'),
(364, 11, 11, 1, 'Senin', '9-10'),
(365, 11, 11, 5, 'Selasa', '9-10'),
(366, 11, 12, 1, 'Senin', '11-12'),
(367, 11, 11, 1, 'Selasa', '11-12'),
(368, 22, 13, 19, 'Senin', '1-2'),
(369, 22, 11, 18, 'Rabu', '3-4'),
(370, 22, 13, 30, 'Jumat', '3-4'),
(371, 22, 12, 18, 'Rabu', '5-6'),
(372, 22, 5, 18, 'Kamis', '5-6'),
(373, 22, 11, 18, 'Kamis', '7-8'),
(374, 22, 13, 12, 'Jumat', '7-8'),
(375, 22, 13, 9, 'Senin', '9-10'),
(376, 22, 5, 18, 'Rabu', '9-10'),
(377, 22, 12, 18, 'Kamis', '11-12'),
(378, 14, 12, 14, 'Rabu', '1-2'),
(379, 14, 5, 9, 'Senin', '3-4'),
(380, 14, 13, 14, 'Rabu', '3-4'),
(381, 14, 5, 14, 'Rabu', '7-8'),
(382, 14, 12, 9, 'Kamis', '7-8'),
(383, 14, 11, 14, 'Rabu', '9-10'),
(384, 14, 11, 9, 'Kamis', '11-12'),
(385, 28, 13, 32, 'Selasa', '1-2'),
(386, 28, 11, 32, 'Selasa', '3-4'),
(387, 28, 12, 32, 'Selasa', '7-8'),
(388, 28, 5, 32, 'Selasa', '11-12'),
(389, 22, 13, 30, 'Rabu', '1-2'),
(390, 12, 11, 8, 'Rabu', '1-2'),
(391, 12, 5, 8, 'Rabu', '5-6'),
(392, 12, 13, 8, 'Rabu', '7-8'),
(393, 12, 12, 8, 'Rabu', '11-12'),
(394, 23, 5, 7, 'Rabu', '3-4'),
(395, 23, 11, 7, 'Rabu', '5-6'),
(396, 23, 12, 7, 'Rabu', '7-8'),
(397, 23, 13, 7, 'Rabu', '11-12'),
(398, 44, 11, 17, 'Rabu', '1-2'),
(399, 44, 5, 17, 'Rabu', '3-4'),
(400, 44, 12, 17, 'Rabu', '5-6'),
(401, 52, 13, 31, 'Kamis', '5-6'),
(402, 6, 18, 21, 'Jumat', '9-10'),
(403, 6, 13, 21, 'Jumat', '11-12'),
(404, 50, 17, 5, 'Senin', '9-10'),
(405, 50, 13, 5, 'Selasa', '9-10'),
(406, 50, 18, 35, 'Jumat', '9-10'),
(407, 50, 19, 35, 'Jumat', '11-12'),
(408, 29, 6, 19, 'Senin', '1-2'),
(409, 29, 19, 15, 'Rabu', '1-2'),
(410, 29, 6, 4, 'Kamis', '1-2'),
(411, 29, 20, 15, 'Selasa', '3-4'),
(412, 29, 6, 15, 'Rabu', '3-4'),
(413, 29, 19, 4, 'Kamis', '3-4'),
(414, 29, 20, 15, 'Rabu', '5-6'),
(415, 29, 6, 12, 'Jumat', '5-6'),
(416, 29, 6, 15, 'Selasa', '9-10'),
(417, 29, 19, 9, 'Rabu', '9-10'),
(418, 29, 19, 15, 'Selasa', '11-12'),
(419, 29, 6, 16, 'Rabu', '11-12'),
(420, 29, 20, 4, 'Kamis', '11-12'),
(421, 31, 20, 19, 'Senin', '1-2'),
(422, 31, 20, 2, 'Selasa', '1-2'),
(423, 31, 6, 2, 'Senin', '3-4'),
(424, 31, 6, 2, 'Jumat', '3-4'),
(425, 31, 19, 2, 'Senin', '5-6'),
(426, 31, 19, 2, 'Selasa', '5-6'),
(427, 31, 19, 2, 'Jumat', '5-6'),
(428, 31, 6, 2, 'Selasa', '7-8'),
(429, 31, 20, 2, 'Rabu', '9-10'),
(430, 31, 20, 2, 'Senin', '11-12'),
(431, 31, 20, 2, 'Selasa', '11-12'),
(432, 31, 6, 2, 'Rabu', '11-12'),
(433, 31, 20, 12, 'Jumat', '11-12'),
(434, 12, 19, 8, 'Senin', '3-4'),
(435, 12, 20, 8, 'Senin', '7-8'),
(436, 12, 6, 8, 'Senin', '5-6'),
(437, 37, 20, 14, 'Senin', '3-4'),
(438, 37, 6, 6, 'Kamis', '5-6'),
(439, 37, 19, 14, 'Senin', '7-8'),
(440, 37, 20, 6, 'Kamis', '7-8'),
(441, 37, 19, 6, 'Kamis', '9-10'),
(442, 37, 6, 14, 'Senin', '11-12'),
(443, 31, 20, 28, 'Rabu', '1-2'),
(444, 31, 19, 28, 'Rabu', '3-4'),
(445, 31, 6, 28, 'Rabu', '5-6'),
(446, 8, 20, 29, 'Kamis', '1-2'),
(447, 8, 6, 1, 'Selasa', '3-4'),
(448, 8, 6, 29, 'Kamis', '3-4'),
(449, 8, 20, 1, 'Senin', '5-6'),
(450, 8, 20, 1, 'Selasa', '5-6'),
(451, 8, 19, 1, 'Kamis', '5-6'),
(452, 8, 6, 1, 'Senin', '7-8'),
(453, 8, 19, 1, 'Selasa', '7-8'),
(454, 8, 6, 1, 'Jumat', '7-8'),
(455, 8, 20, 1, 'Selasa', '9-10'),
(456, 8, 19, 1, 'Senin', '11-12'),
(457, 8, 19, 1, 'Jumat', '3-4'),
(458, 10, 19, 18, 'Selasa', '1-2'),
(459, 10, 6, 18, 'Selasa', '5-6'),
(460, 10, 20, 30, 'Kamis', '5-6'),
(461, 10, 20, 30, 'Selasa', '7-8'),
(462, 10, 19, 18, 'Kamis', '7-8'),
(463, 10, 6, 18, 'Kamis', '9-10'),
(464, 27, 6, 9, 'Selasa', '1-2'),
(465, 27, 6, 9, 'Rabu', '1-2'),
(466, 27, 19, 9, 'Selasa', '3-4'),
(467, 27, 20, 9, 'Rabu', '3-4'),
(468, 27, 19, 20, 'Selasa', '9-10'),
(469, 27, 19, 9, 'Rabu', '9-10'),
(470, 27, 6, 20, 'Selasa', '11-12'),
(471, 27, 19, 16, 'Rabu', '11-12'),
(472, 27, 20, 31, 'Jumat', '3-4'),
(473, 27, 20, 20, 'Jumat', '5-6'),
(474, 27, 19, 12, 'Jumat', '7-8'),
(475, 26, 19, 9, 'Rabu', '5-6'),
(476, 26, 6, 9, 'Rabu', '9-10'),
(477, 26, 20, 9, 'Rabu', '11-12'),
(478, 44, 6, 17, 'Kamis', '7-8'),
(479, 44, 20, 17, 'Kamis', '9-10'),
(480, 44, 19, 17, 'Kamis', '11-12'),
(481, 23, 19, 7, 'Kamis', '1-2'),
(482, 23, 20, 7, 'Kamis', '3-4'),
(483, 23, 6, 7, 'Kamis', '11-12');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`) VALUES
(1, '1A-Eagle'),
(2, '2A-Fuji'),
(3, '3A-Arjuno'),
(4, '4A-Permata'),
(5, '5A-Ummarah'),
(6, '6A-Malik'),
(7, '1B-Lion'),
(8, '1C-Shark'),
(9, '2B-Lumix'),
(10, '2C-Leica'),
(11, '5B-Salamah'),
(12, '5C-Aiman'),
(13, '5D-Kulsum'),
(14, '3B-Bromo'),
(15, '3C-Rinjani'),
(16, '4B-Safir'),
(17, '4C-Zamrud'),
(18, '4D-Ruby'),
(19, '6B-Soetomo'),
(20, '6C-Basweda');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `nama_mapel`) VALUES
(1, 'Matematika'),
(2, 'Bahasa Indonesia'),
(3, 'IPA'),
(4, 'Komputer'),
(5, 'The Club'),
(6, 'Bahasa Arab'),
(7, 'Seni Musik'),
(8, 'Kemuhammadiyahan'),
(9, 'IPAS'),
(10, 'Renang'),
(11, 'Eskul Bina Vokalia'),
(12, 'Seni Rupa'),
(14, 'Pendidikan Agama Islam'),
(15, 'Pendidikan Pancasila'),
(16, 'Seni Teater'),
(17, 'PJOK'),
(18, 'Bahasa Inggris'),
(19, 'Bahasa Jawa'),
(20, 'Pendidikan Lingkungan Hidup'),
(21, 'Eskul Catur'),
(22, 'Eskul Panahan'),
(23, 'Eskul HW'),
(24, 'Eskul Tapak Suci'),
(25, 'Eskul Cooking Class'),
(26, 'Eskul Bahasa Jepang'),
(27, 'Eskul Jurnalistik '),
(28, 'Reading Log'),
(29, 'Mathmatics Cambridge'),
(30, 'English Cambridge'),
(31, 'Science Cambridge'),
(32, 'MNR'),
(33, 'Eskul Renang'),
(34, 'Eskul Pilihan'),
(35, 'Eskul Tenis Meja');

-- --------------------------------------------------------

--
-- Table structure for table `pengganti`
--

CREATE TABLE `pengganti` (
  `id` int(11) NOT NULL,
  `guru_absen_id` int(11) DEFAULT NULL,
  `guru_pengganti_id` int(11) DEFAULT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `jam_ke` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kelas_id` int(11) NOT NULL,
  `materi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengganti`
--

INSERT INTO `pengganti` (`id`, `guru_absen_id`, `guru_pengganti_id`, `hari`, `jam_ke`, `tanggal`, `kelas_id`, `materi`) VALUES
(1, 6, 8, 'Senin', '1-2', '2025-04-29', 0, ''),
(2, 6, 10, 'Rabu', '3-4', '2025-04-29', 0, ''),
(4, 7, 6, 'Senin', '1-2', '2025-04-29', 0, ''),
(5, 13, 8, 'Rabu', '3-4', '2025-04-29', 0, ''),
(6, 13, 12, 'Rabu', '3-4', '2025-04-29', 0, ''),
(7, 6, 7, 'Senin', '3-4', '2025-04-29', 0, ''),
(8, 6, 7, 'Senin', '3-4', '2025-04-29', 0, ''),
(11, 6, 7, 'Senin', '3-4', '2025-04-29', 0, ''),
(12, 6, 7, 'Rabu', '3-4', '2025-04-29', 0, ''),
(13, 6, 8, 'Rabu', '3-4', '2025-04-29', 0, ''),
(14, 6, 8, 'Rabu', '3-4', '2025-04-29', 0, ''),
(15, 6, 7, 'Rabu', '3-4', '2025-04-29', 0, ''),
(16, 6, 11, 'Selasa', '9-10', '2025-04-29', 0, ''),
(17, 6, 12, 'Rabu', '3-4', '2025-04-29', 0, ''),
(18, 6, 16, 'Rabu', '3-4', '2025-04-29', 0, ''),
(19, 6, 23, 'Rabu', '3-4', '2025-04-29', 0, ''),
(20, 6, 26, 'Rabu', '3-4', '2025-04-29', 0, ''),
(21, 6, 40, 'Rabu', '3-4', '2025-04-29', 12, 'Materi Bahasa Arab'),
(22, 6, 29, 'Senin', '11-12', '2025-04-29', 5, 'Ms. Excel Formula'),
(23, 13, 15, 'Rabu', '3-4', '2025-04-30', 14, 'Musik'),
(24, 13, 26, 'Rabu', '7-8', '2025-04-30', 3, 'Ritmik'),
(25, 6, 37, 'Rabu', '11-12', '2025-04-30', 5, 'Kosa Kata'),
(26, 13, 40, 'Jumat', '3-4', '2025-04-30', 14, 'Seni Rupa'),
(27, 13, 20, 'Kamis', '7-8', '2025-04-30', 3, 'Bermain Gitar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `pengganti_id` (`pengganti_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `mapel_id` (`mapel_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengganti`
--
ALTER TABLE `pengganti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pengganti`
--
ALTER TABLE `pengganti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`),
  ADD CONSTRAINT `absen_ibfk_2` FOREIGN KEY (`pengganti_id`) REFERENCES `guru` (`id`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
