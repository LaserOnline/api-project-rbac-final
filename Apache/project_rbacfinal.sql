-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2023 at 02:04 AM
-- Server version: 8.0.32
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_rbacfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `Primary_Key` int NOT NULL,
  `Content_Key` varchar(255) NOT NULL,
  `UserKey` varchar(255) NOT NULL,
  `Content_Title` varchar(255) NOT NULL,
  `Content_Detail` varchar(255) NOT NULL,
  `Content_Region` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Content_Like` int DEFAULT '0',
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Comment` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`Primary_Key`, `Content_Key`, `UserKey`, `Content_Title`, `Content_Detail`, `Content_Region`, `Image`, `Content_Like`, `Time`, `Comment`) VALUES
(1, '596465a5fe46067143f5cdb169c7a6', '57ada13350a79d79', 'City Top 10', 'City life has its own unique charm and excitement. From the hustle and bustle of busy streets to the bright lights of towering skyscrapers, cities offer a diverse range of experiences for residents and visitors alike', 'ไม่ระบุบ', '57ada13350a79d792f8637.jpg', 1, '2023-01-29 01:52:56', 0),
(4, '0b3f86ec96c297561e5df9863d7a60', '57ada13350a79d79', 'Tokyo View', 'Tokyo ', 'ภาคกลาง', '57ada13350a79d79702791.jpg', 0, '2023-01-29 19:43:11', 0),
(5, '3940e321ace8c4145932d6f8a5573a', '57ada13350a79d79', 'Sky', 'Oh Sky', 'ภาคตะวันออกเฉียงเหนือ', '57ada13350a79d79982354.jpg', 0, '2023-01-29 19:46:26', 0),
(6, '429be1b9a1f5986946d2a4944397a4', '57ada13350a79d79', 'Venice', 'Oh Venice', 'ภาคตะวันตก', '57ada13350a79d7902fe37.jpg', 0, '2023-01-29 19:51:38', 0),
(7, '45534d793ad89a4addcbdeb52d9c10', '57ada13350a79d79', 'Berlin', 'Oh Berlin', 'ภาคตะวันตก', '57ada13350a79d790ace7b.jpg', 0, '2023-01-29 19:52:42', 0),
(8, 'c19a3102b1dea050dcfc8368c729c7', '57ada13350a79d79', 'Phuket', 'Oh Phuket', 'ไม่ระบุบ', '57ada13350a79d799dac9e.jpg', 0, '2023-01-29 20:15:01', 0),
(9, 'adea5abcfbf99459aa338208c536ee', '57ada13350a79d79', 'Chiang Mai', 'Oh Chiang Mai', 'ภาคตะวันตก', '57ada13350a79d79ebd28f.jpg', 0, '2023-01-29 20:16:14', 0),
(10, 'dd8e0a7aa9058d9f43c6dd3292acf5', '57ada13350a79d79', 'Paris', 'Oh Paris', 'ภาคตะวันตก', '57ada13350a79d79869a61.jpg', 0, '2023-01-29 20:17:42', 0),
(11, '0c2a70790883a8b9c4451327f4a469', '57ada13350a79d79', 'Sea View', 'Oh Sea', 'ภาคตะวันออกเฉียงเหนือ', '57ada13350a79d795802e8.jpg', 0, '2023-01-29 20:18:27', 0),
(12, 'a96ba3b7f32dd145b74306c56fd5d1', '57ada13350a79d79', 'Norway', 'This Norway', 'ภาคเหนือ', '57ada13350a79d79e37318.jpg', 0, '2023-01-29 20:19:54', 0),
(13, '73c0235da3cd2f4daeb620b19ea75a', '57ada13350a79d79', 'Sea Animal', 'Oh Animal', 'ภาคใต้', '57ada13350a79d793b2bd7.jpg', 0, '2023-01-29 20:24:29', 0),
(14, '69a2bbd6027ca5b8d1a60caea56795', '57ada13350a79d79', 'Akihabara', 'This Akihabara', 'ภาคตะวันออก', '57ada13350a79d79a2cda5.jpg', 0, '2023-01-29 20:29:49', 0),
(16, '4f4cc56abcc453473c52c43b119f14', '57ada13350a79d79', 'วัดพระธาตุดอยสุเทพ', 'เปิดบริการแล้ว:06:00-20:00 เวลาในการเยี่ยมชมแนะนำ:1-2 ชั่วโมง', 'ภาคกลาง', '57ada13350a79d7977f8b2.jpg', 0, '2023-01-29 20:38:26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `content_comment`
--

CREATE TABLE `content_comment` (
  `ID` int NOT NULL,
  `Content_Key` varchar(255) NOT NULL,
  `UserKey` varchar(255) NOT NULL,
  `Comment` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `content_comment`
--

INSERT INTO `content_comment` (`ID`, `Content_Key`, `UserKey`, `Comment`, `create_time`) VALUES
(8, '4f4cc56abcc453473c52c43b119f14', '57ada13350a79d79', 'HelloOk', '2023-01-31 11:30:58'),
(20, '4f4cc56abcc453473c52c43b119f14', '4b3d60747a35589e', 'test', '2023-01-31 14:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `content_image`
--

CREATE TABLE `content_image` (
  `ID_Images` int NOT NULL,
  `Content_Key` varchar(255) NOT NULL,
  `Content_image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `content_image`
--

INSERT INTO `content_image` (`ID_Images`, `Content_Key`, `Content_image`) VALUES
(1, '596465a5fe46067143f5cdb169c7a6', 'ede61409b3fe50194e6ae7b0b96936.jpg'),
(2, '596465a5fe46067143f5cdb169c7a6', '596465a5fe46067143f5cdb169c7a6ec73e225aa.jpg'),
(3, '596465a5fe46067143f5cdb169c7a6', '596465a5fe46067143f5cdb169c7a6223174c41a.jpg'),
(4, '596465a5fe46067143f5cdb169c7a6', '596465a5fe46067143f5cdb169c7a6dd431bc9e8.jpg'),
(5, '596465a5fe46067143f5cdb169c7a6', '596465a5fe46067143f5cdb169c7a6616d1a2c92.jpg'),
(6, '596465a5fe46067143f5cdb169c7a6', '596465a5fe46067143f5cdb169c7a67fdd830935.jpg'),
(7, '596465a5fe46067143f5cdb169c7a6', '596465a5fe46067143f5cdb169c7a639160b4e21.jpg'),
(8, '3b69d48ee53e6ca796347f87a14b16', '3b69d48ee53e6ca796347f87a14b16a79bcae7a8.jpg'),
(9, '3b69d48ee53e6ca796347f87a14b16', '3b69d48ee53e6ca796347f87a14b167799fff170.jpg'),
(10, '3b69d48ee53e6ca796347f87a14b16', '3b69d48ee53e6ca796347f87a14b16b274963fb2.jpg'),
(11, '494499180402447cdc1de0a496961c', '494499180402447cdc1de0a496961c7d4a8c9bcf.jpg'),
(12, '494499180402447cdc1de0a496961c', '494499180402447cdc1de0a496961ca5dcb73e7d.jpg'),
(13, '494499180402447cdc1de0a496961c', '494499180402447cdc1de0a496961c44e28225ed.jpg'),
(14, '494499180402447cdc1de0a496961c', '494499180402447cdc1de0a496961c1e67d7c5f6.jpg'),
(15, '0b3f86ec96c297561e5df9863d7a60', '0b3f86ec96c297561e5df9863d7a6066a16972cc.jpg'),
(16, '0b3f86ec96c297561e5df9863d7a60', '0b3f86ec96c297561e5df9863d7a6058e45056e0.jpg'),
(17, '0b3f86ec96c297561e5df9863d7a60', '0b3f86ec96c297561e5df9863d7a60c38d6259d9.jpg'),
(18, '0b3f86ec96c297561e5df9863d7a60', '0b3f86ec96c297561e5df9863d7a605b02e34b90.jpg'),
(19, '0b3f86ec96c297561e5df9863d7a60', '0b3f86ec96c297561e5df9863d7a609df88f0102.jpg'),
(20, '0b3f86ec96c297561e5df9863d7a60', '0b3f86ec96c297561e5df9863d7a605afd597427.jpg'),
(21, '0b3f86ec96c297561e5df9863d7a60', '0b3f86ec96c297561e5df9863d7a60e0032365fd.jpg'),
(22, '0b3f86ec96c297561e5df9863d7a60', '0b3f86ec96c297561e5df9863d7a60d76083b50a.jpg'),
(23, '0b3f86ec96c297561e5df9863d7a60', '0b3f86ec96c297561e5df9863d7a60c15c7e27c9.jpg'),
(24, '3940e321ace8c4145932d6f8a5573a', '3940e321ace8c4145932d6f8a5573a8e53af82eb.jpg'),
(25, '3940e321ace8c4145932d6f8a5573a', '3940e321ace8c4145932d6f8a5573adaf90f8b07.jpg'),
(26, '3940e321ace8c4145932d6f8a5573a', '3940e321ace8c4145932d6f8a5573ac67ce8281e.jpg'),
(27, '3940e321ace8c4145932d6f8a5573a', '3940e321ace8c4145932d6f8a5573a6cfe935ceb.jpg'),
(28, '3940e321ace8c4145932d6f8a5573a', '3940e321ace8c4145932d6f8a5573ac020e14ab0.jpg'),
(29, '429be1b9a1f5986946d2a4944397a4', '429be1b9a1f5986946d2a4944397a42fd7ded3c1.jpg'),
(30, '429be1b9a1f5986946d2a4944397a4', '429be1b9a1f5986946d2a4944397a47f814ab2d4.jpg'),
(31, '429be1b9a1f5986946d2a4944397a4', '429be1b9a1f5986946d2a4944397a42096deac19.jpg'),
(32, '429be1b9a1f5986946d2a4944397a4', '429be1b9a1f5986946d2a4944397a466af328ab6.jpg'),
(33, '45534d793ad89a4addcbdeb52d9c10', '45534d793ad89a4addcbdeb52d9c10559e5d179a.jpg'),
(34, '45534d793ad89a4addcbdeb52d9c10', '45534d793ad89a4addcbdeb52d9c107ff8f049c6.jpg'),
(35, '45534d793ad89a4addcbdeb52d9c10', '45534d793ad89a4addcbdeb52d9c10febe711d0e.jpg'),
(36, '45534d793ad89a4addcbdeb52d9c10', '45534d793ad89a4addcbdeb52d9c10aedad3ee09.jpg'),
(37, 'c19a3102b1dea050dcfc8368c729c7', 'c19a3102b1dea050dcfc8368c729c72602fb63a4.jpg'),
(38, 'c19a3102b1dea050dcfc8368c729c7', 'c19a3102b1dea050dcfc8368c729c7057dc6e1b6.jpg'),
(39, 'c19a3102b1dea050dcfc8368c729c7', 'c19a3102b1dea050dcfc8368c729c708b3fc3bdf.jpg'),
(40, 'c19a3102b1dea050dcfc8368c729c7', 'c19a3102b1dea050dcfc8368c729c73c84b74a16.jpg'),
(41, 'c19a3102b1dea050dcfc8368c729c7', 'c19a3102b1dea050dcfc8368c729c743ce35360d.jpg'),
(42, 'c19a3102b1dea050dcfc8368c729c7', 'c19a3102b1dea050dcfc8368c729c712f40b2215.jpg'),
(43, 'c19a3102b1dea050dcfc8368c729c7', 'c19a3102b1dea050dcfc8368c729c7a349412e2b.jpg'),
(44, 'adea5abcfbf99459aa338208c536ee', 'adea5abcfbf99459aa338208c536ee67c61cf72f.jpg'),
(45, 'adea5abcfbf99459aa338208c536ee', 'adea5abcfbf99459aa338208c536ee304bdd5248.jpg'),
(46, 'adea5abcfbf99459aa338208c536ee', 'adea5abcfbf99459aa338208c536ee6566fb7810.jpg'),
(47, 'adea5abcfbf99459aa338208c536ee', 'adea5abcfbf99459aa338208c536ee94081c9ac9.jpg'),
(48, 'adea5abcfbf99459aa338208c536ee', 'adea5abcfbf99459aa338208c536ee8f8adee2be.jpg'),
(49, 'dd8e0a7aa9058d9f43c6dd3292acf5', 'dd8e0a7aa9058d9f43c6dd3292acf53c05762a7c.jpg'),
(50, 'dd8e0a7aa9058d9f43c6dd3292acf5', 'dd8e0a7aa9058d9f43c6dd3292acf520c96dc353.jpg'),
(51, 'dd8e0a7aa9058d9f43c6dd3292acf5', 'dd8e0a7aa9058d9f43c6dd3292acf52cd6bdc602.jpg'),
(52, '0c2a70790883a8b9c4451327f4a469', '0c2a70790883a8b9c4451327f4a469ff9bee045d.jpg'),
(53, '0c2a70790883a8b9c4451327f4a469', '0c2a70790883a8b9c4451327f4a4699adca1bf17.jpg'),
(54, '0c2a70790883a8b9c4451327f4a469', '0c2a70790883a8b9c4451327f4a4692c46ed659a.jpg'),
(55, '0c2a70790883a8b9c4451327f4a469', '0c2a70790883a8b9c4451327f4a469aa4ff784af.jpg'),
(56, '0c2a70790883a8b9c4451327f4a469', '0c2a70790883a8b9c4451327f4a469dbb960ccdf.jpg'),
(57, '0c2a70790883a8b9c4451327f4a469', '0c2a70790883a8b9c4451327f4a46978d053159f.jpg'),
(58, 'a96ba3b7f32dd145b74306c56fd5d1', 'a96ba3b7f32dd145b74306c56fd5d1a93aebfb10.jpg'),
(59, 'a96ba3b7f32dd145b74306c56fd5d1', 'a96ba3b7f32dd145b74306c56fd5d15f54e4250f.jpg'),
(60, 'a96ba3b7f32dd145b74306c56fd5d1', 'a96ba3b7f32dd145b74306c56fd5d13184bfbad1.jpg'),
(61, 'a96ba3b7f32dd145b74306c56fd5d1', 'a96ba3b7f32dd145b74306c56fd5d116edc96595.jpg'),
(62, '73c0235da3cd2f4daeb620b19ea75a', '73c0235da3cd2f4daeb620b19ea75ab09235049e.jpg'),
(63, '73c0235da3cd2f4daeb620b19ea75a', '73c0235da3cd2f4daeb620b19ea75a93a356a5e0.jpg'),
(64, '73c0235da3cd2f4daeb620b19ea75a', '73c0235da3cd2f4daeb620b19ea75abf9adbc1a3.jpg'),
(65, '73c0235da3cd2f4daeb620b19ea75a', '73c0235da3cd2f4daeb620b19ea75a8b741cf8c4.jpg'),
(66, '73c0235da3cd2f4daeb620b19ea75a', '73c0235da3cd2f4daeb620b19ea75a7f9e89a79a.jpg'),
(67, '69a2bbd6027ca5b8d1a60caea56795', '69a2bbd6027ca5b8d1a60caea567951f7e985693.jpg'),
(68, '69a2bbd6027ca5b8d1a60caea56795', '69a2bbd6027ca5b8d1a60caea56795db7663139a.jpg'),
(69, '69a2bbd6027ca5b8d1a60caea56795', '69a2bbd6027ca5b8d1a60caea567957e4d7351b5.jpg'),
(70, '69a2bbd6027ca5b8d1a60caea56795', '69a2bbd6027ca5b8d1a60caea5679508722a3089.jpg'),
(71, '69a2bbd6027ca5b8d1a60caea56795', '69a2bbd6027ca5b8d1a60caea56795879bbb3c12.jpg'),
(72, '69a2bbd6027ca5b8d1a60caea56795', '69a2bbd6027ca5b8d1a60caea5679529988aae42.jpg'),
(73, '3eb41c0855c35c20f2150b23d2e7ff', '3eb41c0855c35c20f2150b23d2e7ffdd5e80dccd.jpg'),
(74, '3eb41c0855c35c20f2150b23d2e7ff', '3eb41c0855c35c20f2150b23d2e7ffe76c52a3dd.jpg'),
(75, '3eb41c0855c35c20f2150b23d2e7ff', '3eb41c0855c35c20f2150b23d2e7ff1a15dbb9b3.jpg'),
(76, '3eb41c0855c35c20f2150b23d2e7ff', '3eb41c0855c35c20f2150b23d2e7ff04b8bdeae6.jpg'),
(77, '3eb41c0855c35c20f2150b23d2e7ff', '3eb41c0855c35c20f2150b23d2e7ff44d80cc54b.jpg'),
(78, '4f4cc56abcc453473c52c43b119f14', '867bac3791cf8b694e7f46e3adfddd.jpg'),
(79, '4f4cc56abcc453473c52c43b119f14', '4f4cc56abcc453473c52c43b119f14457df7aa48.jpg'),
(80, '4f4cc56abcc453473c52c43b119f14', '4f4cc56abcc453473c52c43b119f149a0492200e.jpg'),
(81, '4f4cc56abcc453473c52c43b119f14', '4f4cc56abcc453473c52c43b119f143ade2c39d7.jpg'),
(82, '4f4cc56abcc453473c52c43b119f14', '4f4cc56abcc453473c52c43b119f14b088e910d8.jpg'),
(83, '4f4cc56abcc453473c52c43b119f14', '4f4cc56abcc453473c52c43b119f14276fd48cce.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `content_like`
--

CREATE TABLE `content_like` (
  `ID_Like` int NOT NULL,
  `Content_Key` varchar(255) NOT NULL,
  `UserKey` varchar(255) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `content_like`
--

INSERT INTO `content_like` (`ID_Like`, `Content_Key`, `UserKey`, `Time`) VALUES
(3, '596465a5fe46067143f5cdb169c7a6', '21460a724bd3e29b', '2023-02-19 12:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `ID_Hotel` int NOT NULL,
  `Hotel_Key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Detail` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Star` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `City` varchar(255) NOT NULL,
  `LocationR` varchar(255) NOT NULL,
  `LocationL` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`ID_Hotel`, `Hotel_Key`, `Title`, `Detail`, `Star`, `City`, `LocationR`, `LocationL`, `Image`, `Price`) VALUES
(1, '02638e08225787b611f16c4df82fee', 'ไดมอนด์ บางกอก อพาร์ทเมนท์', 'ที่พักให้บริการที่จอดรถฟรีเพื่อการเดินทางเข้าออกที่พักได้อย่างสะดวกสบาย รวมถึง Wi-Fi ฟรีให้ท่องเน็ตได้ทุกเมื่อ ที่พักตั้งอยู่ในย่านสนามบินสุวรรณภูมิของกรุงเทพ ผู้เข้าพักจึงได้อยู่ใกล้สถานที่ท่องเที่ยวน่าสนใจและร้านอาหารอร่อยๆ ทริปยังไม่จบถ้าไม่ได้แวะไปที่เที่ยวชื่อดังอย่าง วัดพระเชตุพนวิมลมังคลาราม (วัดโพธิ์) ด้วยอีกสักที่ ที่พัก 3.5 ดาวคุณภาพสูงแห่งนี้มี สระว่ายน้ำกลางแจ้ง และ ห้องอาหาร คอยอำนวยความสะดวกแก่ผู้เข้าพัก', '4.6', 'กรุงเทพ', '13.77428511403106', '100.49949186450337', 'a71a339aa8.jpg', '5000'),
(2, '3bdb8d7d878a915fb096245f303a8e', 'THE BELONG BOUTIQUE HOTEL', 'Boasting a garden, shared lounge, terrace and free WiFi, THE BELONG BOUTIQUE HOTEL is situated in Phuket Town, 700 metres from Thai Hua Museum and 700 metres from Chinpracha House. The property is set 5.4 km from Prince of Songkla University, 8.6 km from Chalong Temple and 9.4 km from Chalong Pier. The accommodation features a shared kitchen, an ATM and organising tours for guests.\r\n\r\nAll rooms at the hotel have air conditioning and a desk.\r\n\r\nPhuket Aquarium is 11 km from THE BELONG BOUTIQUE HOTEL, while Two Heroines Monument is 13 km from the property. The nearest airport is Phuket International Airport, 31 km from the accommodation.\r\n\r\nนี่เป็นบริเวณโปรดของผู้เข้าพักในเมืองภูเก็ต อิงตามความคิดเห็นที่ตรงไปตรงมา\r\n\r\nคู่รักชอบทำเลนี้เป็นพิเศษ โดยให้คะแนน 9.7 สำหรับการเข้าพัก 2 ท่าน', '5.5', 'ภูเก็ต', '7.956820314316736', '98.33451625170302', '57b88d814e.jpg', '6000');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_image`
--

CREATE TABLE `hotel_image` (
  `Hotel_Image` int NOT NULL,
  `Hotel_Key` varchar(255) NOT NULL,
  `Image_Detail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `hotel_image`
--

INSERT INTO `hotel_image` (`Hotel_Image`, `Hotel_Key`, `Image_Detail`) VALUES
(1, '02638e08225787b611f16c4df82fee', '5b5eca7a3c566562.jpg'),
(2, '02638e08225787b611f16c4df82fee', '2e8c94ee1569148a.jpg'),
(3, '02638e08225787b611f16c4df82fee', '2ce8bbf04a2b6580.jpg'),
(4, '02638e08225787b611f16c4df82fee', '4a8e4b1ac43fc36e.jpg'),
(5, '02638e08225787b611f16c4df82fee', 'e433177bf94c4332.jpg'),
(6, '3bdb8d7d878a915fb096245f303a8e', 'bcaf266411630e3a.jpg'),
(7, '3bdb8d7d878a915fb096245f303a8e', 'ca734ea42da0fabc.jpg'),
(8, '3bdb8d7d878a915fb096245f303a8e', '6c9ee85004db40ce.jpg'),
(9, '3bdb8d7d878a915fb096245f303a8e', '793d8a63c8e5e6eb.jpg'),
(10, '3bdb8d7d878a915fb096245f303a8e', 'df7575f257a67d9d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_like`
--

CREATE TABLE `hotel_like` (
  `hotel_like` int NOT NULL,
  `UserKey` varchar(255) NOT NULL,
  `Hotel_Key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `hotel_like`
--

INSERT INTO `hotel_like` (`hotel_like`, `UserKey`, `Hotel_Key`) VALUES
(26, '4b3d60747a35589e', '3bdb8d7d878a915fb096245f303a8e'),
(27, '21460a724bd3e29b', '02638e08225787b611f16c4df82fee'),
(28, '21460a724bd3e29b', '3bdb8d7d878a915fb096245f303a8e');

-- --------------------------------------------------------

--
-- Table structure for table `register_otp`
--

CREATE TABLE `register_otp` (
  `Primary_Key` int NOT NULL,
  `OTPPlatform` varchar(255) NOT NULL,
  `OTPKey` varchar(255) NOT NULL,
  `OTPStstus` varchar(255) NOT NULL,
  `OTPEmail` varchar(255) NOT NULL,
  `OTPUsername` varchar(255) NOT NULL,
  `OTPPassword` varchar(255) NOT NULL,
  `OTP` varchar(255) NOT NULL,
  `Time_OTP` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `relax`
--

CREATE TABLE `relax` (
  `Relax_ID` int NOT NULL,
  `Relax_Key` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Detail` text NOT NULL,
  `Star` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `LocationR` varchar(255) NOT NULL,
  `LocationL` varchar(255) NOT NULL,
  `Relax_Images_Cover` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `relax`
--

INSERT INTO `relax` (`Relax_ID`, `Relax_Key`, `Title`, `Detail`, `Star`, `City`, `LocationR`, `LocationL`, `Relax_Images_Cover`, `Price`) VALUES
(7, '4854636df3a03f4218deb28453427e', 'แหลมหงา', 'สวัสดีครับ ขอแนะนำสถานที่ท่องเที่ยวแหลมหงา อ.เมือง จังหวัดภูเก็ต เป็นทะเลที่ไม่ค่อยมีนักท่องเที่ยวรู้จักเท่าไหร่ เพราะอย่างนี้ผมจึงคิดว่ามีเสน่ห์มาก ๆ ผู้คนไม่พลุกพล่าน เป็นทะเลที่เหมาะแก่การมาล่าแสงเช้า ชมพระอาทิตย์ขึ้น คุ้มกับการตื่นเช้ามาก ๆ ครับ มาชมภาพสวย ๆ กันได้เลยครับ', '4.5', 'ภูเก็ต', '7.91213425365147', '98.43995384248807', '1b9407c2e8.jpg', '8000');

-- --------------------------------------------------------

--
-- Table structure for table `relax_image`
--

CREATE TABLE `relax_image` (
  `Relax_image_id` int NOT NULL,
  `Relax_Key` varchar(255) NOT NULL,
  `Relax_Images_Detail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `relax_image`
--

INSERT INTO `relax_image` (`Relax_image_id`, `Relax_Key`, `Relax_Images_Detail`) VALUES
(4, '4854636df3a03f4218deb28453427e', 'd8b9af7582cbdc2f.jpg'),
(5, '4854636df3a03f4218deb28453427e', 'd2483aa4b078d8eb.jpg'),
(6, '4854636df3a03f4218deb28453427e', '749ad2aa1e49bff7.jpg'),
(7, '4854636df3a03f4218deb28453427e', '9b761a369057c00d.jpg'),
(8, '4854636df3a03f4218deb28453427e', 'f592b72b9b86e2e4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `Restaurant_ID` int NOT NULL,
  `Restaurant_Key` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Detail` text NOT NULL,
  `Star` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `LocationR` varchar(255) NOT NULL,
  `LocationL` varchar(255) NOT NULL,
  `Restaurant_Images_Cover` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`Restaurant_ID`, `Restaurant_Key`, `Title`, `Detail`, `Star`, `City`, `LocationR`, `LocationL`, `Restaurant_Images_Cover`, `Price`) VALUES
(12, 'be766aa9e5494781e585956b80097d', 'ร้านจะสั่งมั้ย', '14 229 ซอย คู้บอน 27 แยก 10 แขวงท่าแร้ง เขตบางเขน กรุงเทพมหานคร 10220', '2.5', 'กรุงเทพ', '13.859465069246399', '100.66645183706581', '0b7c6ebb50.jpg', '50');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_image`
--

CREATE TABLE `restaurant_image` (
  `Restaurant_ID` int NOT NULL,
  `Restaurant_Key` varchar(255) NOT NULL,
  `Restaurant_Image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `restaurant_image`
--

INSERT INTO `restaurant_image` (`Restaurant_ID`, `Restaurant_Key`, `Restaurant_Image`) VALUES
(7, 'be766aa9e5494781e585956b80097d', 'be766aa9e5494781e585956b80097dd8475a7dd3b7fc02.jpg'),
(8, 'be766aa9e5494781e585956b80097d', 'be766aa9e5494781e585956b80097d18fab59e0a8e2f2f.jpg'),
(9, 'be766aa9e5494781e585956b80097d', 'be766aa9e5494781e585956b80097d001f34ad8fba4dfc.jpg'),
(10, 'be766aa9e5494781e585956b80097d', 'be766aa9e5494781e585956b80097de9386d4b5275dd81.jpg'),
(11, 'be766aa9e5494781e585956b80097d', 'be766aa9e5494781e585956b80097d1f4b18600742c8fc.jpg'),
(12, 'be766aa9e5494781e585956b80097d', 'be766aa9e5494781e585956b80097db53c17fc265e20d1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shopping`
--

CREATE TABLE `shopping` (
  `Shopping_ID` int NOT NULL,
  `Shopping_Key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Detail` text NOT NULL,
  `Star` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `LocationR` varchar(255) NOT NULL,
  `LocationL` varchar(255) NOT NULL,
  `Shopping_Images_Cover` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `shopping`
--

INSERT INTO `shopping` (`Shopping_ID`, `Shopping_Key`, `Title`, `Detail`, `Star`, `City`, `LocationR`, `LocationL`, `Shopping_Images_Cover`, `Price`) VALUES
(9, '0202c91931051ffa677171d4ce387a', 'เซ็นทรัลเวิลด์', 'เซ็นทรัลเวิลด์ เดิมชื่อ เวิลด์เทรดเซ็นเตอร์ เป็นโครงการพัฒนาพื้นที่เชิงพาณิชยกรรมแบบผสมบริเวณใจกลางกรุงเทพมหานคร ตั้งอยู่ทางหัวมุมฝั่งตะวันตกเฉียงเหนือของแยกราชประสงค์ ระหว่างถนนพระรามที่ 1 และถนนราชดำริ ในพื้นที่แขวงปทุมวัน เขตปทุมวัน โครงการประกอบด้วยศูนย์การค้า โรงแรม', '4.9', 'กรุงเทพ', '13.747514450443882', '100.53990516080547', '6c9c2d7090.jpg', '150');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_image`
--

CREATE TABLE `shopping_image` (
  `Shopping_images` int NOT NULL,
  `Shopping_Key` varchar(255) NOT NULL,
  `Shopping_Images_Detail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `shopping_image`
--

INSERT INTO `shopping_image` (`Shopping_images`, `Shopping_Key`, `Shopping_Images_Detail`) VALUES
(7, '0202c91931051ffa677171d4ce387a', '0202c91931051ffa677171d4ce387af0a3fd4ef21328c8.jpg'),
(8, '0202c91931051ffa677171d4ce387a', '0202c91931051ffa677171d4ce387a77f80b11237a3804.jpg'),
(9, '0202c91931051ffa677171d4ce387a', '0202c91931051ffa677171d4ce387aa1cae9ce661d8eac.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `Tour_ID` int NOT NULL,
  `Tour_Key` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Detail` text NOT NULL,
  `Star` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `LocationR` varchar(255) NOT NULL,
  `LocationL` varchar(255) NOT NULL,
  `Tuor_Images_Cover` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`Tour_ID`, `Tour_Key`, `Title`, `Detail`, `Star`, `City`, `LocationR`, `LocationL`, `Tuor_Images_Cover`, `Price`) VALUES
(13, '29f5d42bdfb51215f2ecdde8cf306c', 'ทัวร์เที่ยวชมและชิมอาหารที่กุนมะ', 'หยุดพักการใช้ชีวิตอย่างวุ่นวายในเมืองหลวงอย่างโตเกียว และไปเที่ยวชมวิวอันงดงามของต่างจังหวัดอย่างกุนมะ', '4.5', 'โตเกียว', '35.81565830600192', '139.6678633356179', '4192dcce7f.jpg', '16799');

-- --------------------------------------------------------

--
-- Table structure for table `tour_images`
--

CREATE TABLE `tour_images` (
  `tour_images_id` int NOT NULL,
  `Tour_Key` varchar(255) NOT NULL,
  `Tour_Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tour_images`
--

INSERT INTO `tour_images` (`tour_images_id`, `Tour_Key`, `Tour_Image`) VALUES
(8, '29f5d42bdfb51215f2ecdde8cf306c', '29f5d42bdfb51215f2ecdde8cf306c76b37a6fd7676220.jpg'),
(9, '29f5d42bdfb51215f2ecdde8cf306c', '29f5d42bdfb51215f2ecdde8cf306c069928ab4ff9b668.jpg'),
(10, '29f5d42bdfb51215f2ecdde8cf306c', '29f5d42bdfb51215f2ecdde8cf306c6a964ef73497e443.jpg'),
(11, '29f5d42bdfb51215f2ecdde8cf306c', '29f5d42bdfb51215f2ecdde8cf306cc09051f85b888c3f.jpg'),
(12, '29f5d42bdfb51215f2ecdde8cf306c', '29f5d42bdfb51215f2ecdde8cf306cfdf2858605fdc87b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Primary_Key` int NOT NULL,
  `UserKey` varchar(255) NOT NULL,
  `UserPlatform` varchar(255) NOT NULL,
  `UserStstus` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `UserPassword` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Primary_Key`, `UserKey`, `UserPlatform`, `UserStstus`, `UserEmail`, `Username`, `UserPassword`) VALUES
(40, '21460a724bd3e29b', 'ByGoogle', 'Normal', 'razeroffline@gmail.com', 'Laser Online', NULL),
(46, '57ada13350a79d79', 'ByEmail', 'Admin', 'razeronline@hotmail.com', 'James', '$2y$10$Xn9SV4qZzkKddGdGt340/.Ttc5UKPbxr6suNGa1xyWM2.N3UmVO7q'),
(47, 'd0dc802bb56f5dad', 'ByEmail', 'Ban', '62017150@rbac.ac.th', 'Ornpreeya', '$2y$10$loA8G1Z33f1kMlmoZhGbIe4UnWVvW4j.m6JQjHp7oSsqUNbIvno.S'),
(48, '2e6d89fe04b9accb', 'ByEmail', 'Admin', 'cartoonboonma@gmail.com', 'Toon', '$2y$10$5q/R5VRolyGE4SIZAhZrBez.wg/u.wqpQ91y9SNIDFcelxZ8ZNlq.'),
(51, '4b3d60747a35589e', 'ByEmail', 'Normal', 'thawiyod13940@gmail.com', 'kai', '$2y$10$on73i1f7VdgfpitEznmZA.uPbSQ3wDMgwt3XOwIhEcDXFkNg3TzKa'),
(54, '9e9afe102dd18c77', 'ByEmail', 'Normal', 'jinnawat8@gmail.com', 'aaaa', '$2y$10$DIsWLTSUDtsfb8tSO5RFYePcO3daiOLaDcfVnf3qc7FBi7I7wS42K');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `Primary_Key` int NOT NULL,
  `UserKey` varchar(255) NOT NULL,
  `FirstName` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'ไม่ได้ระบุบ',
  `LastName` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'ไม่ได้ระบุบ',
  `Address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'ไม่ได้ระบุบ',
  `UserProfile` varchar(255) NOT NULL,
  `MoneyCoin` float NOT NULL DEFAULT '0',
  `UserPhone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'Phone'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`Primary_Key`, `UserKey`, `FirstName`, `LastName`, `Address`, `UserProfile`, `MoneyCoin`, `UserPhone`) VALUES
(47, '21460a724bd3e29b', 'Kaochiam', 'Vigrantont', 'Thai', 'https://lh3.googleusercontent.com/a/ALm5wu06q8Io8noSLG_ppsB2MX8R1WnvlWMsDOPzVYPfHA', 0, '0969514044'),
(53, '57ada13350a79d79', 'Kaochiam', 'Superuser', 'Thai', '57ada13350a79d7957ac04.jpg', 0, '0969514044'),
(54, 'd0dc802bb56f5dad', 'ไม่ได้ระบุบ', 'ไม่ได้ระบุบ', 'ไม่ได้ระบุบ', 'User.png', 0, 'ไม่ได้ระบุบ'),
(55, '2e6d89fe04b9accb', 'ไม่ได้ระบุบ', 'ไม่ได้ระบุบ', 'ไม่ได้ระบุบ', 'User.png', 0, 'ไม่ได้ระบุบ'),
(58, '4b3d60747a35589e', 'รัชนี', 'ทวียศ', '306 ซ.ลาดพร้าว 107', '4b3d60747a35589e386446.jpg', 0, '0987654321'),
(61, '9e9afe102dd18c77', 'ไม่ได้ระบุบ', 'ไม่ได้ระบุบ', 'ไม่ได้ระบุบ', 'User.png', 0, 'Phone');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`Primary_Key`);

--
-- Indexes for table `content_comment`
--
ALTER TABLE `content_comment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `content_image`
--
ALTER TABLE `content_image`
  ADD PRIMARY KEY (`ID_Images`);

--
-- Indexes for table `content_like`
--
ALTER TABLE `content_like`
  ADD PRIMARY KEY (`ID_Like`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`ID_Hotel`);

--
-- Indexes for table `hotel_image`
--
ALTER TABLE `hotel_image`
  ADD PRIMARY KEY (`Hotel_Image`);

--
-- Indexes for table `hotel_like`
--
ALTER TABLE `hotel_like`
  ADD PRIMARY KEY (`hotel_like`);

--
-- Indexes for table `register_otp`
--
ALTER TABLE `register_otp`
  ADD PRIMARY KEY (`Primary_Key`);

--
-- Indexes for table `relax`
--
ALTER TABLE `relax`
  ADD PRIMARY KEY (`Relax_ID`);

--
-- Indexes for table `relax_image`
--
ALTER TABLE `relax_image`
  ADD PRIMARY KEY (`Relax_image_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`Restaurant_ID`);

--
-- Indexes for table `restaurant_image`
--
ALTER TABLE `restaurant_image`
  ADD PRIMARY KEY (`Restaurant_ID`);

--
-- Indexes for table `shopping`
--
ALTER TABLE `shopping`
  ADD PRIMARY KEY (`Shopping_ID`);

--
-- Indexes for table `shopping_image`
--
ALTER TABLE `shopping_image`
  ADD PRIMARY KEY (`Shopping_images`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`Tour_ID`);

--
-- Indexes for table `tour_images`
--
ALTER TABLE `tour_images`
  ADD PRIMARY KEY (`tour_images_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Primary_Key`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`Primary_Key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `Primary_Key` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `content_comment`
--
ALTER TABLE `content_comment`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `content_image`
--
ALTER TABLE `content_image`
  MODIFY `ID_Images` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `content_like`
--
ALTER TABLE `content_like`
  MODIFY `ID_Like` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `ID_Hotel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotel_image`
--
ALTER TABLE `hotel_image`
  MODIFY `Hotel_Image` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hotel_like`
--
ALTER TABLE `hotel_like`
  MODIFY `hotel_like` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `register_otp`
--
ALTER TABLE `register_otp`
  MODIFY `Primary_Key` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `relax`
--
ALTER TABLE `relax`
  MODIFY `Relax_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `relax_image`
--
ALTER TABLE `relax_image`
  MODIFY `Relax_image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `Restaurant_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `restaurant_image`
--
ALTER TABLE `restaurant_image`
  MODIFY `Restaurant_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shopping`
--
ALTER TABLE `shopping`
  MODIFY `Shopping_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shopping_image`
--
ALTER TABLE `shopping_image`
  MODIFY `Shopping_images` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `Tour_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tour_images`
--
ALTER TABLE `tour_images`
  MODIFY `tour_images_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Primary_Key` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `Primary_Key` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
