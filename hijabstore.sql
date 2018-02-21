-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2017 at 10:04 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hijabstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` bigint(50) NOT NULL,
  `id_user` varchar(50) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `jumlah` bigint(50) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(11) NOT NULL DEFAULT '0',
  `city_name` varchar(41) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `type` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `postal_code`, `province_id`, `type`) VALUES
(1, 'Aceh Barat', 23681, 21, 'Kabupaten'),
(2, 'Aceh Barat Daya', 23764, 21, 'Kabupaten'),
(3, 'Aceh Besar', 23951, 21, 'Kabupaten'),
(4, 'Aceh Jaya', 23654, 21, 'Kabupaten'),
(5, 'Aceh Selatan', 23719, 21, 'Kabupaten'),
(6, 'Aceh Singkil', 24785, 21, 'Kabupaten'),
(7, 'Aceh Tamiang', 24476, 21, 'Kabupaten'),
(8, 'Aceh Tengah', 24511, 21, 'Kabupaten'),
(9, 'Aceh Tenggara', 24611, 21, 'Kabupaten'),
(10, 'Aceh Timur', 24454, 21, 'Kabupaten'),
(11, 'Aceh Utara', 24382, 21, 'Kabupaten'),
(12, 'Agam', 26411, 32, 'Kabupaten'),
(13, 'Alor', 85811, 23, 'Kabupaten'),
(14, 'Ambon', 97222, 19, 'Kota'),
(15, 'Asahan', 21214, 34, 'Kabupaten'),
(16, 'Asmat', 99777, 24, 'Kabupaten'),
(17, 'Badung', 80351, 1, 'Kabupaten'),
(18, 'Balangan', 71611, 13, 'Kabupaten'),
(19, 'Balikpapan', 76111, 15, 'Kota'),
(20, 'Banda Aceh', 23238, 21, 'Kota'),
(21, 'Bandar Lampung', 35139, 18, 'Kota'),
(22, 'Bandung', 40311, 9, 'Kabupaten'),
(23, 'Bandung', 40115, 9, 'Kota'),
(24, 'Bandung Barat', 40721, 9, 'Kabupaten'),
(25, 'Banggai', 94711, 29, 'Kabupaten'),
(26, 'Banggai Kepulauan', 94881, 29, 'Kabupaten'),
(27, 'Bangka', 33212, 2, 'Kabupaten'),
(28, 'Bangka Barat', 33315, 2, 'Kabupaten'),
(29, 'Bangka Selatan', 33719, 2, 'Kabupaten'),
(30, 'Bangka Tengah', 33613, 2, 'Kabupaten'),
(31, 'Bangkalan', 69118, 11, 'Kabupaten'),
(32, 'Bangli', 80619, 1, 'Kabupaten'),
(33, 'Banjar', 70619, 13, 'Kabupaten'),
(34, 'Banjar', 46311, 9, 'Kota'),
(35, 'Banjarbaru', 70712, 13, 'Kota'),
(36, 'Banjarmasin', 70117, 13, 'Kota'),
(37, 'Banjarnegara', 53419, 10, 'Kabupaten'),
(38, 'Bantaeng', 92411, 28, 'Kabupaten'),
(39, 'Bantul', 55715, 5, 'Kabupaten'),
(40, 'Banyuasin', 30911, 33, 'Kabupaten'),
(41, 'Banyumas', 53114, 10, 'Kabupaten'),
(42, 'Banyuwangi', 68416, 11, 'Kabupaten'),
(43, 'Barito Kuala', 70511, 13, 'Kabupaten'),
(44, 'Barito Selatan', 73711, 14, 'Kabupaten'),
(45, 'Barito Timur', 73671, 14, 'Kabupaten'),
(46, 'Barito Utara', 73881, 14, 'Kabupaten'),
(47, 'Barru', 90719, 28, 'Kabupaten'),
(48, 'Batam', 29413, 17, 'Kota'),
(49, 'Batang', 51211, 10, 'Kabupaten'),
(50, 'Batang Hari', 36613, 8, 'Kabupaten'),
(51, 'Batu', 65311, 11, 'Kota'),
(52, 'Batu Bara', 21655, 34, 'Kabupaten'),
(53, 'Bau-Bau', 93719, 30, 'Kota'),
(54, 'Bekasi', 17837, 9, 'Kabupaten'),
(55, 'Bekasi', 17121, 9, 'Kota'),
(56, 'Belitung', 33419, 2, 'Kabupaten'),
(57, 'Belitung Timur', 33519, 2, 'Kabupaten'),
(58, 'Belu', 85711, 23, 'Kabupaten'),
(59, 'Bener Meriah', 24581, 21, 'Kabupaten'),
(60, 'Bengkalis', 28719, 26, 'Kabupaten'),
(61, 'Bengkayang', 79213, 12, 'Kabupaten'),
(62, 'Bengkulu', 38229, 4, 'Kota'),
(63, 'Bengkulu Selatan', 38519, 4, 'Kabupaten'),
(64, 'Bengkulu Tengah', 38319, 4, 'Kabupaten'),
(65, 'Bengkulu Utara', 38619, 4, 'Kabupaten'),
(66, 'Berau', 77311, 15, 'Kabupaten'),
(67, 'Biak Numfor', 98119, 24, 'Kabupaten'),
(68, 'Bima', 84171, 22, 'Kabupaten'),
(69, 'Bima', 84139, 22, 'Kota'),
(70, 'Binjai', 20712, 34, 'Kota'),
(71, 'Bintan', 29135, 17, 'Kabupaten'),
(72, 'Bireuen', 24219, 21, 'Kabupaten'),
(73, 'Bitung', 95512, 31, 'Kota'),
(74, 'Blitar', 66171, 11, 'Kabupaten'),
(75, 'Blitar', 66124, 11, 'Kota'),
(76, 'Blora', 58219, 10, 'Kabupaten'),
(77, 'Boalemo', 96319, 7, 'Kabupaten'),
(78, 'Bogor', 16911, 9, 'Kabupaten'),
(79, 'Bogor', 16119, 9, 'Kota'),
(80, 'Bojonegoro', 62119, 11, 'Kabupaten'),
(81, 'Bolaang Mongondow (Bolmong)', 95755, 31, 'Kabupaten'),
(82, 'Bolaang Mongondow Selatan', 95774, 31, 'Kabupaten'),
(83, 'Bolaang Mongondow Timur', 95783, 31, 'Kabupaten'),
(84, 'Bolaang Mongondow Utara', 95765, 31, 'Kabupaten'),
(85, 'Bombana', 93771, 30, 'Kabupaten'),
(86, 'Bondowoso', 68219, 11, 'Kabupaten'),
(87, 'Bone', 92713, 28, 'Kabupaten'),
(88, 'Bone Bolango', 96511, 7, 'Kabupaten'),
(89, 'Bontang', 75313, 15, 'Kota'),
(90, 'Boven Digoel', 99662, 24, 'Kabupaten'),
(91, 'Boyolali', 57312, 10, 'Kabupaten'),
(92, 'Brebes', 52212, 10, 'Kabupaten'),
(93, 'Bukittinggi', 26115, 32, 'Kota'),
(94, 'Buleleng', 81111, 1, 'Kabupaten'),
(95, 'Bulukumba', 92511, 28, 'Kabupaten'),
(96, 'Bulungan (Bulongan)', 77211, 16, 'Kabupaten'),
(97, 'Bungo', 37216, 8, 'Kabupaten'),
(98, 'Buol', 94564, 29, 'Kabupaten'),
(99, 'Buru', 97371, 19, 'Kabupaten'),
(100, 'Buru Selatan', 97351, 19, 'Kabupaten'),
(101, 'Buton', 93754, 30, 'Kabupaten'),
(102, 'Buton Utara', 93745, 30, 'Kabupaten'),
(103, 'Ciamis', 46211, 9, 'Kabupaten'),
(104, 'Cianjur', 43217, 9, 'Kabupaten'),
(105, 'Cilacap', 53211, 10, 'Kabupaten'),
(106, 'Cilegon', 42417, 3, 'Kota'),
(107, 'Cimahi', 40512, 9, 'Kota'),
(108, 'Cirebon', 45611, 9, 'Kabupaten'),
(109, 'Cirebon', 45116, 9, 'Kota'),
(110, 'Dairi', 22211, 34, 'Kabupaten'),
(111, 'Deiyai (Deliyai)', 98784, 24, 'Kabupaten'),
(112, 'Deli Serdang', 20511, 34, 'Kabupaten'),
(113, 'Demak', 59519, 10, 'Kabupaten'),
(114, 'Denpasar', 80227, 1, 'Kota'),
(115, 'Depok', 16416, 9, 'Kota'),
(116, 'Dharmasraya', 27612, 32, 'Kabupaten'),
(117, 'Dogiyai', 98866, 24, 'Kabupaten'),
(118, 'Dompu', 84217, 22, 'Kabupaten'),
(119, 'Donggala', 94341, 29, 'Kabupaten'),
(120, 'Dumai', 28811, 26, 'Kota'),
(121, 'Empat Lawang', 31811, 33, 'Kabupaten'),
(122, 'Ende', 86351, 23, 'Kabupaten'),
(123, 'Enrekang', 91719, 28, 'Kabupaten'),
(124, 'Fakfak', 98651, 25, 'Kabupaten'),
(125, 'Flores Timur', 86213, 23, 'Kabupaten'),
(126, 'Garut', 44126, 9, 'Kabupaten'),
(127, 'Gayo Lues', 24653, 21, 'Kabupaten'),
(128, 'Gianyar', 80519, 1, 'Kabupaten'),
(129, 'Gorontalo', 96218, 7, 'Kabupaten'),
(130, 'Gorontalo', 96115, 7, 'Kota'),
(131, 'Gorontalo Utara', 96611, 7, 'Kabupaten'),
(132, 'Gowa', 92111, 28, 'Kabupaten'),
(133, 'Gresik', 61115, 11, 'Kabupaten'),
(134, 'Grobogan', 58111, 10, 'Kabupaten'),
(135, 'Gunung Kidul', 55812, 5, 'Kabupaten'),
(136, 'Gunung Mas', 74511, 14, 'Kabupaten'),
(137, 'Gunungsitoli', 22813, 34, 'Kota'),
(138, 'Halmahera Barat', 97757, 20, 'Kabupaten'),
(139, 'Halmahera Selatan', 97911, 20, 'Kabupaten'),
(140, 'Halmahera Tengah', 97853, 20, 'Kabupaten'),
(141, 'Halmahera Timur', 97862, 20, 'Kabupaten'),
(142, 'Halmahera Utara', 97762, 20, 'Kabupaten'),
(143, 'Hulu Sungai Selatan', 71212, 13, 'Kabupaten'),
(144, 'Hulu Sungai Tengah', 71313, 13, 'Kabupaten'),
(145, 'Hulu Sungai Utara', 71419, 13, 'Kabupaten'),
(146, 'Humbang Hasundutan', 22457, 34, 'Kabupaten'),
(147, 'Indragiri Hilir', 29212, 26, 'Kabupaten'),
(148, 'Indragiri Hulu', 29319, 26, 'Kabupaten'),
(149, 'Indramayu', 45214, 9, 'Kabupaten'),
(150, 'Intan Jaya', 98771, 24, 'Kabupaten'),
(151, 'Jakarta Barat', 11220, 6, 'Kota'),
(152, 'Jakarta Pusat', 10540, 6, 'Kota'),
(153, 'Jakarta Selatan', 12230, 6, 'Kota'),
(154, 'Jakarta Timur', 13330, 6, 'Kota'),
(155, 'Jakarta Utara', 14140, 6, 'Kota'),
(156, 'Jambi', 36111, 8, 'Kota'),
(157, 'Jayapura', 99352, 24, 'Kabupaten'),
(158, 'Jayapura', 99114, 24, 'Kota'),
(159, 'Jayawijaya', 99511, 24, 'Kabupaten'),
(160, 'Jember', 68113, 11, 'Kabupaten'),
(161, 'Jembrana', 82251, 1, 'Kabupaten'),
(162, 'Jeneponto', 92319, 28, 'Kabupaten'),
(163, 'Jepara', 59419, 10, 'Kabupaten'),
(164, 'Jombang', 61415, 11, 'Kabupaten'),
(165, 'Kaimana', 98671, 25, 'Kabupaten'),
(166, 'Kampar', 28411, 26, 'Kabupaten'),
(167, 'Kapuas', 73583, 14, 'Kabupaten'),
(168, 'Kapuas Hulu', 78719, 12, 'Kabupaten'),
(169, 'Karanganyar', 57718, 10, 'Kabupaten'),
(170, 'Karangasem', 80819, 1, 'Kabupaten'),
(171, 'Karawang', 41311, 9, 'Kabupaten'),
(172, 'Karimun', 29611, 17, 'Kabupaten'),
(173, 'Karo', 22119, 34, 'Kabupaten'),
(174, 'Katingan', 74411, 14, 'Kabupaten'),
(175, 'Kaur', 38911, 4, 'Kabupaten'),
(176, 'Kayong Utara', 78852, 12, 'Kabupaten'),
(177, 'Kebumen', 54319, 10, 'Kabupaten'),
(178, 'Kediri', 64184, 11, 'Kabupaten'),
(179, 'Kediri', 64125, 11, 'Kota'),
(180, 'Keerom', 99461, 24, 'Kabupaten'),
(181, 'Kendal', 51314, 10, 'Kabupaten'),
(182, 'Kendari', 93126, 30, 'Kota'),
(183, 'Kepahiang', 39319, 4, 'Kabupaten'),
(184, 'Kepulauan Anambas', 29991, 17, 'Kabupaten'),
(185, 'Kepulauan Aru', 97681, 19, 'Kabupaten'),
(186, 'Kepulauan Mentawai', 25771, 32, 'Kabupaten'),
(187, 'Kepulauan Meranti', 28791, 26, 'Kabupaten'),
(188, 'Kepulauan Sangihe', 95819, 31, 'Kabupaten'),
(189, 'Kepulauan Seribu', 14550, 6, 'Kabupaten'),
(190, 'Kepulauan Siau Tagulandang Biaro (Sitaro)', 95862, 31, 'Kabupaten'),
(191, 'Kepulauan Sula', 97995, 20, 'Kabupaten'),
(192, 'Kepulauan Talaud', 95885, 31, 'Kabupaten'),
(193, 'Kepulauan Yapen (Yapen Waropen)', 98211, 24, 'Kabupaten'),
(194, 'Kerinci', 37167, 8, 'Kabupaten'),
(195, 'Ketapang', 78874, 12, 'Kabupaten'),
(196, 'Klaten', 57411, 10, 'Kabupaten'),
(197, 'Klungkung', 80719, 1, 'Kabupaten'),
(198, 'Kolaka', 93511, 30, 'Kabupaten'),
(199, 'Kolaka Utara', 93911, 30, 'Kabupaten'),
(200, 'Konawe', 93411, 30, 'Kabupaten'),
(201, 'Konawe Selatan', 93811, 30, 'Kabupaten'),
(202, 'Konawe Utara', 93311, 30, 'Kabupaten'),
(203, 'Kotabaru', 72119, 13, 'Kabupaten'),
(204, 'Kotamobagu', 95711, 31, 'Kota'),
(205, 'Kotawaringin Barat', 74119, 14, 'Kabupaten'),
(206, 'Kotawaringin Timur', 74364, 14, 'Kabupaten'),
(207, 'Kuantan Singingi', 29519, 26, 'Kabupaten'),
(208, 'Kubu Raya', 78311, 12, 'Kabupaten'),
(209, 'Kudus', 59311, 10, 'Kabupaten'),
(210, 'Kulon Progo', 55611, 5, 'Kabupaten'),
(211, 'Kuningan', 45511, 9, 'Kabupaten'),
(212, 'Kupang', 85362, 23, 'Kabupaten'),
(213, 'Kupang', 85119, 23, 'Kota'),
(214, 'Kutai Barat', 75711, 15, 'Kabupaten'),
(215, 'Kutai Kartanegara', 75511, 15, 'Kabupaten'),
(216, 'Kutai Timur', 75611, 15, 'Kabupaten'),
(217, 'Labuhan Batu', 21412, 34, 'Kabupaten'),
(218, 'Labuhan Batu Selatan', 21511, 34, 'Kabupaten'),
(219, 'Labuhan Batu Utara', 21711, 34, 'Kabupaten'),
(220, 'Lahat', 31419, 33, 'Kabupaten'),
(221, 'Lamandau', 74611, 14, 'Kabupaten'),
(222, 'Lamongan', 64125, 11, 'Kabupaten'),
(223, 'Lampung Barat', 34814, 18, 'Kabupaten'),
(224, 'Lampung Selatan', 35511, 18, 'Kabupaten'),
(225, 'Lampung Tengah', 34212, 18, 'Kabupaten'),
(226, 'Lampung Timur', 34319, 18, 'Kabupaten'),
(227, 'Lampung Utara', 34516, 18, 'Kabupaten'),
(228, 'Landak', 78319, 12, 'Kabupaten'),
(229, 'Langkat', 20811, 34, 'Kabupaten'),
(230, 'Langsa', 24412, 21, 'Kota'),
(231, 'Lanny Jaya', 99531, 24, 'Kabupaten'),
(232, 'Lebak', 42319, 3, 'Kabupaten'),
(233, 'Lebong', 39264, 4, 'Kabupaten'),
(234, 'Lembata', 86611, 23, 'Kabupaten'),
(235, 'Lhokseumawe', 24352, 21, 'Kota'),
(236, 'Lima Puluh Koto/Kota', 26671, 32, 'Kabupaten'),
(237, 'Lingga', 29811, 17, 'Kabupaten'),
(238, 'Lombok Barat', 83311, 22, 'Kabupaten'),
(239, 'Lombok Tengah', 83511, 22, 'Kabupaten'),
(240, 'Lombok Timur', 83612, 22, 'Kabupaten'),
(241, 'Lombok Utara', 83711, 22, 'Kabupaten'),
(242, 'Lubuk Linggau', 31614, 33, 'Kota'),
(243, 'Lumajang', 67319, 11, 'Kabupaten'),
(244, 'Luwu', 91994, 28, 'Kabupaten'),
(245, 'Luwu Timur', 92981, 28, 'Kabupaten'),
(246, 'Luwu Utara', 92911, 28, 'Kabupaten'),
(247, 'Madiun', 63153, 11, 'Kabupaten'),
(248, 'Madiun', 63122, 11, 'Kota'),
(249, 'Magelang', 56519, 10, 'Kabupaten'),
(250, 'Magelang', 56133, 10, 'Kota'),
(251, 'Magetan', 63314, 11, 'Kabupaten'),
(252, 'Majalengka', 45412, 9, 'Kabupaten'),
(253, 'Majene', 91411, 27, 'Kabupaten'),
(254, 'Makassar', 90111, 28, 'Kota'),
(255, 'Malang', 65163, 11, 'Kabupaten'),
(256, 'Malang', 65112, 11, 'Kota'),
(257, 'Malinau', 77511, 16, 'Kabupaten'),
(258, 'Maluku Barat Daya', 97451, 19, 'Kabupaten'),
(259, 'Maluku Tengah', 97513, 19, 'Kabupaten'),
(260, 'Maluku Tenggara', 97651, 19, 'Kabupaten'),
(261, 'Maluku Tenggara Barat', 97465, 19, 'Kabupaten'),
(262, 'Mamasa', 91362, 27, 'Kabupaten'),
(263, 'Mamberamo Raya', 99381, 24, 'Kabupaten'),
(264, 'Mamberamo Tengah', 99553, 24, 'Kabupaten'),
(265, 'Mamuju', 91519, 27, 'Kabupaten'),
(266, 'Mamuju Utara', 91571, 27, 'Kabupaten'),
(267, 'Manado', 95247, 31, 'Kota'),
(268, 'Mandailing Natal', 22916, 34, 'Kabupaten'),
(269, 'Manggarai', 86551, 23, 'Kabupaten'),
(270, 'Manggarai Barat', 86711, 23, 'Kabupaten'),
(271, 'Manggarai Timur', 86811, 23, 'Kabupaten'),
(272, 'Manokwari', 98311, 25, 'Kabupaten'),
(273, 'Manokwari Selatan', 98355, 25, 'Kabupaten'),
(274, 'Mappi', 99853, 24, 'Kabupaten'),
(275, 'Maros', 90511, 28, 'Kabupaten'),
(276, 'Mataram', 83131, 22, 'Kota'),
(277, 'Maybrat', 98051, 25, 'Kabupaten'),
(278, 'Medan', 20228, 34, 'Kota'),
(279, 'Melawi', 78619, 12, 'Kabupaten'),
(280, 'Merangin', 37319, 8, 'Kabupaten'),
(281, 'Merauke', 99613, 24, 'Kabupaten'),
(282, 'Mesuji', 34911, 18, 'Kabupaten'),
(283, 'Metro', 34111, 18, 'Kota'),
(284, 'Mimika', 99962, 24, 'Kabupaten'),
(285, 'Minahasa', 95614, 31, 'Kabupaten'),
(286, 'Minahasa Selatan', 95914, 31, 'Kabupaten'),
(287, 'Minahasa Tenggara', 95995, 31, 'Kabupaten'),
(288, 'Minahasa Utara', 95316, 31, 'Kabupaten'),
(289, 'Mojokerto', 61382, 11, 'Kabupaten'),
(290, 'Mojokerto', 61316, 11, 'Kota'),
(291, 'Morowali', 94911, 29, 'Kabupaten'),
(292, 'Muara Enim', 31315, 33, 'Kabupaten'),
(293, 'Muaro Jambi', 36311, 8, 'Kabupaten'),
(294, 'Muko Muko', 38715, 4, 'Kabupaten'),
(295, 'Muna', 93611, 30, 'Kabupaten'),
(296, 'Murung Raya', 73911, 14, 'Kabupaten'),
(297, 'Musi Banyuasin', 30719, 33, 'Kabupaten'),
(298, 'Musi Rawas', 31661, 33, 'Kabupaten'),
(299, 'Nabire', 98816, 24, 'Kabupaten'),
(300, 'Nagan Raya', 23674, 21, 'Kabupaten'),
(301, 'Nagekeo', 86911, 23, 'Kabupaten'),
(302, 'Natuna', 29711, 17, 'Kabupaten'),
(303, 'Nduga', 99541, 24, 'Kabupaten'),
(304, 'Ngada', 86413, 23, 'Kabupaten'),
(305, 'Nganjuk', 64414, 11, 'Kabupaten'),
(306, 'Ngawi', 63219, 11, 'Kabupaten'),
(307, 'Nias', 22876, 34, 'Kabupaten'),
(308, 'Nias Barat', 22895, 34, 'Kabupaten'),
(309, 'Nias Selatan', 22865, 34, 'Kabupaten'),
(310, 'Nias Utara', 22856, 34, 'Kabupaten'),
(311, 'Nunukan', 77421, 16, 'Kabupaten'),
(312, 'Ogan Ilir', 30811, 33, 'Kabupaten'),
(313, 'Ogan Komering Ilir', 30618, 33, 'Kabupaten'),
(314, 'Ogan Komering Ulu', 32112, 33, 'Kabupaten'),
(315, 'Ogan Komering Ulu Selatan', 32211, 33, 'Kabupaten'),
(316, 'Ogan Komering Ulu Timur', 32312, 33, 'Kabupaten'),
(317, 'Pacitan', 63512, 11, 'Kabupaten'),
(318, 'Padang', 25112, 32, 'Kota'),
(319, 'Padang Lawas', 22763, 34, 'Kabupaten'),
(320, 'Padang Lawas Utara', 22753, 34, 'Kabupaten'),
(321, 'Padang Panjang', 27122, 32, 'Kota'),
(322, 'Padang Pariaman', 25583, 32, 'Kabupaten'),
(323, 'Padang Sidempuan', 22727, 34, 'Kota'),
(324, 'Pagar Alam', 31512, 33, 'Kota'),
(325, 'Pakpak Bharat', 22272, 34, 'Kabupaten'),
(326, 'Palangka Raya', 73112, 14, 'Kota'),
(327, 'Palembang', 31512, 33, 'Kota'),
(328, 'Palopo', 91911, 28, 'Kota'),
(329, 'Palu', 94111, 29, 'Kota'),
(330, 'Pamekasan', 69319, 11, 'Kabupaten'),
(331, 'Pandeglang', 42212, 3, 'Kabupaten'),
(332, 'Pangandaran', 46511, 9, 'Kabupaten'),
(333, 'Pangkajene Kepulauan', 90611, 28, 'Kabupaten'),
(334, 'Pangkal Pinang', 33115, 2, 'Kota'),
(335, 'Paniai', 98765, 24, 'Kabupaten'),
(336, 'Parepare', 91123, 28, 'Kota'),
(337, 'Pariaman', 25511, 32, 'Kota'),
(338, 'Parigi Moutong', 94411, 29, 'Kabupaten'),
(339, 'Pasaman', 26318, 32, 'Kabupaten'),
(340, 'Pasaman Barat', 26511, 32, 'Kabupaten'),
(341, 'Paser', 76211, 15, 'Kabupaten'),
(342, 'Pasuruan', 67153, 11, 'Kabupaten'),
(343, 'Pasuruan', 67118, 11, 'Kota'),
(344, 'Pati', 59114, 10, 'Kabupaten'),
(345, 'Payakumbuh', 26213, 32, 'Kota'),
(346, 'Pegunungan Arfak', 98354, 25, 'Kabupaten'),
(347, 'Pegunungan Bintang', 99573, 24, 'Kabupaten'),
(348, 'Pekalongan', 51161, 10, 'Kabupaten'),
(349, 'Pekalongan', 51122, 10, 'Kota'),
(350, 'Pekanbaru', 28112, 26, 'Kota'),
(351, 'Pelalawan', 28311, 26, 'Kabupaten'),
(352, 'Pemalang', 52319, 10, 'Kabupaten'),
(353, 'Pematang Siantar', 21126, 34, 'Kota'),
(354, 'Penajam Paser Utara', 76311, 15, 'Kabupaten'),
(355, 'Pesawaran', 35312, 18, 'Kabupaten'),
(356, 'Pesisir Barat', 35974, 18, 'Kabupaten'),
(357, 'Pesisir Selatan', 25611, 32, 'Kabupaten'),
(358, 'Pidie', 24116, 21, 'Kabupaten'),
(359, 'Pidie Jaya', 24186, 21, 'Kabupaten'),
(360, 'Pinrang', 91251, 28, 'Kabupaten'),
(361, 'Pohuwato', 96419, 7, 'Kabupaten'),
(362, 'Polewali Mandar', 91311, 27, 'Kabupaten'),
(363, 'Ponorogo', 63411, 11, 'Kabupaten'),
(364, 'Pontianak', 78971, 12, 'Kabupaten'),
(365, 'Pontianak', 78112, 12, 'Kota'),
(366, 'Poso', 94615, 29, 'Kabupaten'),
(367, 'Prabumulih', 31121, 33, 'Kota'),
(368, 'Pringsewu', 35719, 18, 'Kabupaten'),
(369, 'Probolinggo', 67282, 11, 'Kabupaten'),
(370, 'Probolinggo', 67215, 11, 'Kota'),
(371, 'Pulang Pisau', 74811, 14, 'Kabupaten'),
(372, 'Pulau Morotai', 97771, 20, 'Kabupaten'),
(373, 'Puncak', 98981, 24, 'Kabupaten'),
(374, 'Puncak Jaya', 98979, 24, 'Kabupaten'),
(375, 'Purbalingga', 53312, 10, 'Kabupaten'),
(376, 'Purwakarta', 41119, 9, 'Kabupaten'),
(377, 'Purworejo', 54111, 10, 'Kabupaten'),
(378, 'Raja Ampat', 98489, 25, 'Kabupaten'),
(379, 'Rejang Lebong', 39112, 4, 'Kabupaten'),
(380, 'Rembang', 59219, 10, 'Kabupaten'),
(381, 'Rokan Hilir', 28992, 26, 'Kabupaten'),
(382, 'Rokan Hulu', 28511, 26, 'Kabupaten'),
(383, 'Rote Ndao', 85982, 23, 'Kabupaten'),
(384, 'Sabang', 23512, 21, 'Kota'),
(385, 'Sabu Raijua', 85391, 23, 'Kabupaten'),
(386, 'Salatiga', 50711, 10, 'Kota'),
(387, 'Samarinda', 75133, 15, 'Kota'),
(388, 'Sambas', 79453, 12, 'Kabupaten'),
(389, 'Samosir', 22392, 34, 'Kabupaten'),
(390, 'Sampang', 69219, 11, 'Kabupaten'),
(391, 'Sanggau', 78557, 12, 'Kabupaten'),
(392, 'Sarmi', 99373, 24, 'Kabupaten'),
(393, 'Sarolangun', 37419, 8, 'Kabupaten'),
(394, 'Sawah Lunto', 27416, 32, 'Kota'),
(395, 'Sekadau', 79583, 12, 'Kabupaten'),
(396, 'Selayar (Kepulauan Selayar)', 92812, 28, 'Kabupaten'),
(397, 'Seluma', 38811, 4, 'Kabupaten'),
(398, 'Semarang', 50511, 10, 'Kabupaten'),
(399, 'Semarang', 50135, 10, 'Kota'),
(400, 'Seram Bagian Barat', 97561, 19, 'Kabupaten'),
(401, 'Seram Bagian Timur', 97581, 19, 'Kabupaten'),
(402, 'Serang', 42182, 3, 'Kabupaten'),
(403, 'Serang', 42111, 3, 'Kota'),
(404, 'Serdang Bedagai', 20915, 34, 'Kabupaten'),
(405, 'Seruyan', 74211, 14, 'Kabupaten'),
(406, 'Siak', 28623, 26, 'Kabupaten'),
(407, 'Sibolga', 22522, 34, 'Kota'),
(408, 'Sidenreng Rappang/Rapang', 91613, 28, 'Kabupaten'),
(409, 'Sidoarjo', 61219, 11, 'Kabupaten'),
(410, 'Sigi', 94364, 29, 'Kabupaten'),
(411, 'Sijunjung (Sawah Lunto Sijunjung)', 27511, 32, 'Kabupaten'),
(412, 'Sikka', 86121, 23, 'Kabupaten'),
(413, 'Simalungun', 21162, 34, 'Kabupaten'),
(414, 'Simeulue', 23891, 21, 'Kabupaten'),
(415, 'Singkawang', 79117, 12, 'Kota'),
(416, 'Sinjai', 92615, 28, 'Kabupaten'),
(417, 'Sintang', 78619, 12, 'Kabupaten'),
(418, 'Situbondo', 68316, 11, 'Kabupaten'),
(419, 'Sleman', 55513, 5, 'Kabupaten'),
(420, 'Solok', 27365, 32, 'Kabupaten'),
(421, 'Solok', 27315, 32, 'Kota'),
(422, 'Solok Selatan', 27779, 32, 'Kabupaten'),
(423, 'Soppeng', 90812, 28, 'Kabupaten'),
(424, 'Sorong', 98431, 25, 'Kabupaten'),
(425, 'Sorong', 98411, 25, 'Kota'),
(426, 'Sorong Selatan', 98454, 25, 'Kabupaten'),
(427, 'Sragen', 57211, 10, 'Kabupaten'),
(428, 'Subang', 41215, 9, 'Kabupaten'),
(429, 'Subulussalam', 24882, 21, 'Kota'),
(430, 'Sukabumi', 43311, 9, 'Kabupaten'),
(431, 'Sukabumi', 43114, 9, 'Kota'),
(432, 'Sukamara', 74712, 14, 'Kabupaten'),
(433, 'Sukoharjo', 57514, 10, 'Kabupaten'),
(434, 'Sumba Barat', 87219, 23, 'Kabupaten'),
(435, 'Sumba Barat Daya', 87453, 23, 'Kabupaten'),
(436, 'Sumba Tengah', 87358, 23, 'Kabupaten'),
(437, 'Sumba Timur', 87112, 23, 'Kabupaten'),
(438, 'Sumbawa', 84315, 22, 'Kabupaten'),
(439, 'Sumbawa Barat', 84419, 22, 'Kabupaten'),
(440, 'Sumedang', 45326, 9, 'Kabupaten'),
(441, 'Sumenep', 69413, 11, 'Kabupaten'),
(442, 'Sungaipenuh', 37113, 8, 'Kota'),
(443, 'Supiori', 98164, 24, 'Kabupaten'),
(444, 'Surabaya', 60119, 11, 'Kota'),
(445, 'Surakarta (Solo)', 57113, 10, 'Kota'),
(446, 'Tabalong', 71513, 13, 'Kabupaten'),
(447, 'Tabanan', 82119, 1, 'Kabupaten'),
(448, 'Takalar', 92212, 28, 'Kabupaten'),
(449, 'Tambrauw', 98475, 25, 'Kabupaten'),
(450, 'Tana Tidung', 77611, 16, 'Kabupaten'),
(451, 'Tana Toraja', 91819, 28, 'Kabupaten'),
(452, 'Tanah Bumbu', 72211, 13, 'Kabupaten'),
(453, 'Tanah Datar', 27211, 32, 'Kabupaten'),
(454, 'Tanah Laut', 70811, 13, 'Kabupaten'),
(455, 'Tangerang', 15914, 3, 'Kabupaten'),
(456, 'Tangerang', 15111, 3, 'Kota'),
(457, 'Tangerang Selatan', 15332, 3, 'Kota'),
(458, 'Tanggamus', 35619, 18, 'Kabupaten'),
(459, 'Tanjung Balai', 21321, 34, 'Kota'),
(460, 'Tanjung Jabung Barat', 36513, 8, 'Kabupaten'),
(461, 'Tanjung Jabung Timur', 36719, 8, 'Kabupaten'),
(462, 'Tanjung Pinang', 29111, 17, 'Kota'),
(463, 'Tapanuli Selatan', 22742, 34, 'Kabupaten'),
(464, 'Tapanuli Tengah', 22611, 34, 'Kabupaten'),
(465, 'Tapanuli Utara', 22414, 34, 'Kabupaten'),
(466, 'Tapin', 71119, 13, 'Kabupaten'),
(467, 'Tarakan', 77114, 16, 'Kota'),
(468, 'Tasikmalaya', 46411, 9, 'Kabupaten'),
(469, 'Tasikmalaya', 46116, 9, 'Kota'),
(470, 'Tebing Tinggi', 20632, 34, 'Kota'),
(471, 'Tebo', 37519, 8, 'Kabupaten'),
(472, 'Tegal', 52419, 10, 'Kabupaten'),
(473, 'Tegal', 52114, 10, 'Kota'),
(474, 'Teluk Bintuni', 98551, 25, 'Kabupaten'),
(475, 'Teluk Wondama', 98591, 25, 'Kabupaten'),
(476, 'Temanggung', 56212, 10, 'Kabupaten'),
(477, 'Ternate', 97714, 20, 'Kota'),
(478, 'Tidore Kepulauan', 97815, 20, 'Kota'),
(479, 'Timor Tengah Selatan', 85562, 23, 'Kabupaten'),
(480, 'Timor Tengah Utara', 85612, 23, 'Kabupaten'),
(481, 'Toba Samosir', 22316, 34, 'Kabupaten'),
(482, 'Tojo Una-Una', 94683, 29, 'Kabupaten'),
(483, 'Toli-Toli', 94542, 29, 'Kabupaten'),
(484, 'Tolikara', 99411, 24, 'Kabupaten'),
(485, 'Tomohon', 95416, 31, 'Kota'),
(486, 'Toraja Utara', 91831, 28, 'Kabupaten'),
(487, 'Trenggalek', 66312, 11, 'Kabupaten'),
(488, 'Tual', 97612, 19, 'Kota'),
(489, 'Tuban', 62319, 11, 'Kabupaten'),
(490, 'Tulang Bawang', 34613, 18, 'Kabupaten'),
(491, 'Tulang Bawang Barat', 34419, 18, 'Kabupaten'),
(492, 'Tulungagung', 66212, 11, 'Kabupaten'),
(493, 'Wajo', 90911, 28, 'Kabupaten'),
(494, 'Wakatobi', 93791, 30, 'Kabupaten'),
(495, 'Waropen', 98269, 24, 'Kabupaten'),
(496, 'Way Kanan', 34711, 18, 'Kabupaten'),
(497, 'Wonogiri', 57619, 10, 'Kabupaten'),
(498, 'Wonosobo', 56311, 10, 'Kabupaten'),
(499, 'Yahukimo', 99041, 24, 'Kabupaten'),
(500, 'Yalimo', 99481, 24, 'Kabupaten'),
(501, 'Yogyakarta', 55222, 5, 'Kota');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE IF NOT EXISTS `detail_pemesanan` (
  `id` bigint(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_pemesanan` varchar(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `jumlah` bigint(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id`, `id_user`, `id_pemesanan`, `sku`, `jumlah`, `keterangan`) VALUES
(1, '5', 'ORD27495468', 'PASJ0090JP', 3, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE IF NOT EXISTS `foto` (
  `id` bigint(50) NOT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `sku`, `file`) VALUES
(1, 'SQUA9172FA', 'SQUA9172FA_875220.jpg'),
(2, 'SQUA9172FA', 'SQUA9172FA_706247.jpg'),
(3, 'PASJ0090JP', 'PASJ0090JP_804572.jpg'),
(5, 'PASJ0090JP', 'PASJ0090JP_328613.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(20) NOT NULL,
  `id_kategori` varchar(50) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `id_kategori`, `nama_kategori`) VALUES
(1, 'INS', 'Instant Hijab'),
(2, 'KHI', 'Khimar'),
(3, 'PAS', 'Pashmina'),
(4, 'SQU', 'Square Hijab');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `link`, `status`) VALUES
(1, 'Home', 'index.php', '0'),
(2, 'Daftar Produk', 'daftar-produk.php', '0'),
(3, 'Tambah Produk', 'tambah-produk.php', '0'),
(4, 'Daftar Pesanan', 'daftar-pesanan.php', '0'),
(9, 'Logout', 'action.php?action=logout', '0'),
(10, 'Home', 'index.php', '1'),
(11, 'Status Pemesanan', 'pemesanan.php', '1'),
(19, 'Logout', 'action.php?action=logout', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id` bigint(50) NOT NULL,
  `id_user` varchar(50) DEFAULT NULL,
  `id_pemesanan` varchar(50) DEFAULT NULL,
  `nama_penerima` varchar(250) DEFAULT NULL,
  `provinsi` varchar(20) DEFAULT NULL,
  `kota` varchar(20) DEFAULT NULL,
  `kurir` varchar(20) DEFAULT NULL,
  `alamat_lengkap` varchar(250) DEFAULT NULL,
  `ongkir` bigint(50) DEFAULT NULL,
  `berat` int(20) DEFAULT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL,
  `konfirmasi` varchar(50) DEFAULT NULL,
  `kode_unik` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_user`, `id_pemesanan`, `nama_penerima`, `provinsi`, `kota`, `kurir`, `alamat_lengkap`, `ongkir`, `berat`, `metode_pembayaran`, `konfirmasi`, `kode_unik`) VALUES
(1, '5', 'ORD27495468', 'Nanda', '19', '14', 'jne', 'Jl. ambon manise', 0, 300, 'transfer', '1', '468');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint(50) NOT NULL,
  `sku` varchar(20) NOT NULL DEFAULT '',
  `nama_produk` varchar(250) DEFAULT NULL,
  `merk` varchar(250) DEFAULT NULL,
  `id_kategori` varchar(50) NOT NULL DEFAULT '',
  `harga` bigint(50) DEFAULT NULL,
  `deskripsi` text,
  `deskripsi_singkat` text,
  `stok` bigint(50) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `berat` int(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `sku`, `nama_produk`, `merk`, `id_kategori`, `harga`, `deskripsi`, `deskripsi_singkat`, `stok`, `link`, `berat`) VALUES
(1, 'SQUA9172FA', 'Floris Angel Lelga', 'Angel Lelga', 'SQU', 120000, 'Lengkapi gayamu dengan hijab trendi.', 'Lengkapi gayamu dengan hijab trendi. Hijab scarf dengan aksen motif yang cantik. Padukan hijab ini dengan gamis berwarna netral dan sepatu favoritmu', 0, 'floris-angel-lelga', 100),
(2, 'PASJ0090JP', 'Jaedra Pashmina Pink', 'Jaedra', 'PAS', 172000, 'Lengkapi tampilanmu dengan hijab phasmina bermotif seru', 'Lengkapi tampilanmu dengan hijab phasmina bermotif seru. Padankan dengan atasan simpel warna natural.', 0, 'jaedra-pashmina-pink', 100);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `province` varchar(30) DEFAULT NULL,
  `province_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`province`, `province_id`) VALUES
('Bali', 1),
('Bangka Belitung', 2),
('Banten', 3),
('Bengkulu', 4),
('DI Yogyakarta', 5),
('DKI Jakarta', 6),
('Gorontalo', 7),
('Jambi', 8),
('Jawa Barat', 9),
('Jawa Tengah', 10),
('Jawa Timur', 11),
('Kalimantan Barat', 12),
('Kalimantan Selatan', 13),
('Kalimantan Tengah', 14),
('Kalimantan Timur', 15),
('Kalimantan Utara', 16),
('Kepulauan Riau', 17),
('Lampung', 18),
('Maluku', 19),
('Maluku Utara', 20),
('Nanggroe Aceh Darussalam (NAD)', 21),
('Nusa Tenggara Barat (NTB)', 22),
('Nusa Tenggara Timur (NTT)', 23),
('Papua', 24),
('Papua Barat', 25),
('Riau', 26),
('Sulawesi Barat', 27),
('Sulawesi Selatan', 28),
('Sulawesi Tengah', 29),
('Sulawesi Tenggara', 30),
('Sulawesi Utara', 31),
('Sumatera Barat', 32),
('Sumatera Selatan', 33),
('Sumatera Utara', 34);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `status` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama_lengkap`, `email`, `password`, `status`) VALUES
(3, 'adiholick', 'Adi Nugroho', 'adinugroho.it@gmail.com', 'ab2581c2db33a94962c512619dd9e668', 0),
(4, 'admin', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 0),
(5, 'user', 'user', 'user@user.com', 'ee11cbb19052e40b07aac0ca060c23ee', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`), ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`), ADD KEY `sku` (`sku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`,`id_kategori`), ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`,`id_kategori`), ADD KEY `id_kategori` (`id_kategori`), ADD KEY `sku` (`sku`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`username`), ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
ADD CONSTRAINT `province_id` FOREIGN KEY (`province_id`) REFERENCES `province` (`province_id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
ADD CONSTRAINT `id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
