-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 11, 2025 lúc 06:52 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `access_logs`
--

CREATE TABLE `access_logs` (
  `log_id` int(11) NOT NULL,
  `access_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `access_logs`
--

INSERT INTO `access_logs` (`log_id`, `access_time`, `ip_address`, `user_agent`, `page_url`) VALUES
(1, '2025-04-20 17:00:00', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'http://localhost/'),
(2, '2025-04-20 17:05:00', '10.0.0.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4 Mobile/15E148 Safari/604.1', 'http://localhost/news/1'),
(3, '2025-04-20 17:10:00', '192.168.1.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 'http://localhost/celebrity/2'),
(4, '2025-04-20 17:15:00', '10.0.0.6', 'Mozilla/5.0 (iPad; CPU OS 16_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4 Mobile/15E148 Safari/604.1', 'http://localhost/football/3'),
(5, '2025-04-20 17:20:00', '192.168.1.102', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'http://localhost/game/1'),
(6, '2025-04-20 17:25:00', '10.0.0.7', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/112.0.5615.137 Mobile/15E148 Safari/604.1', 'http://localhost/'),
(7, '2025-04-20 17:30:00', '192.168.1.103', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4 Safari/605.1.15', 'http://localhost/news/4'),
(8, '2025-04-20 17:35:00', '10.0.0.8', 'Mozilla/5.0 (Linux; Android 10; SM-G975F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', 'http://localhost/celebrity/5'),
(9, '2025-04-20 17:40:00', '192.168.1.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Edge/112.0.1722.58 Safari/537.36', 'http://localhost/football/6'),
(10, '2025-04-20 17:45:00', '10.0.0.9', 'Mozilla/5.0 (Linux; Android 11; Pixel 4a) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', 'http://localhost/game/2'),
(11, '2025-04-20 17:50:00', '192.168.1.105', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/112.0', 'http://localhost/'),
(12, '2025-04-20 17:55:00', '10.0.0.10', 'Mozilla/5.0 (iPad; CPU OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1', 'http://localhost/news/7'),
(13, '2025-04-20 18:00:00', '192.168.1.106', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'http://localhost/celebrity/8'),
(14, '2025-04-20 18:05:00', '10.0.0.11', 'Mozilla/5.0 (Linux; Android 12; SM-G991B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', 'http://localhost/football/1'),
(15, '2025-04-20 18:10:00', '192.168.1.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0', 'http://localhost/game/3'),
(16, '2025-04-20 18:15:00', '10.0.0.12', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.5 Mobile/15E148 Safari/604.1', 'http://localhost/'),
(17, '2025-04-20 18:20:00', '192.168.1.108', 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'http://localhost/news/2'),
(18, '2025-04-20 18:25:00', '10.0.0.13', 'Mozilla/5.0 (iPad; CPU OS 14_8 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.8 Mobile/15E148 Safari/604.1', 'http://localhost/celebrity/3'),
(19, '2025-04-20 18:30:00', '192.168.1.109', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_16) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15', 'http://localhost/football/4'),
(20, '2025-04-20 18:35:00', '10.0.0.14', 'Mozilla/5.0 (Linux; Android 9; SM-G960F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', 'http://localhost/game/4'),
(21, '2025-04-20 18:40:00', '192.168.1.110', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 'http://localhost/'),
(22, '2025-04-20 18:45:00', '10.0.0.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.7.1 Mobile/15E148 Safari/604.1', 'http://localhost/news/5'),
(23, '2025-04-20 18:50:00', '192.168.1.111', 'Mozilla/5.0 (X11; CrOS armv7l 13597.84.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.192 Safari/537.36', 'http://localhost/celebrity/6'),
(24, '2025-04-20 18:55:00', '10.0.0.16', 'Mozilla/5.0 (iPad; CPU OS 13_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.2 Mobile/15E148 Safari/604.1', 'http://localhost/football/5'),
(25, '2025-04-20 19:00:00', '192.168.1.112', 'Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', 'http://localhost/game/5'),
(26, '2025-04-20 19:05:00', '10.0.0.17', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.3 Safari/605.1.15', 'http://localhost/'),
(27, '2025-04-20 19:10:00', '192.168.1.113', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'http://localhost/news/6'),
(28, '2025-04-20 19:15:00', '10.0.0.18', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', 'http://localhost/celebrity/7'),
(29, '2025-04-20 19:20:00', '192.168.1.114', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:109.0) Gecko/20100101 Firefox/112.0', 'http://localhost/football/7'),
(30, '2025-04-20 19:25:00', '10.0.0.19', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.3 Mobile/15E148 Safari/604.1', 'http://localhost/game/6'),
(31, '2025-04-20 19:30:00', '192.168.1.115', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'http://localhost/'),
(32, '2025-04-20 19:35:00', '10.0.0.20', 'Mozilla/5.0 (Linux; Android 11; SM-A525F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36', 'http://localhost/news/3'),
(33, '2025-04-20 19:40:00', '192.168.1.116', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:109.0) Gecko/20100101 Firefox/112.0', 'http://localhost/celebrity/4'),
(34, '2025-05-17 19:45:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(35, '2025-05-17 19:45:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(36, '2025-05-17 19:45:21', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '/cutonama3/admin/?search='),
(37, '2025-05-17 19:45:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '/cutonama3/admin/?page=2'),
(38, '2025-05-17 19:45:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(39, '2025-05-17 19:45:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(40, '2025-05-17 19:45:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(41, '2025-05-17 19:45:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(42, '2025-06-03 02:25:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(43, '2025-06-03 02:25:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=2'),
(44, '2025-06-03 02:25:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(45, '2025-06-07 13:05:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(46, '2025-06-07 15:07:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(47, '2025-06-07 15:07:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(48, '2025-06-07 15:08:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=2'),
(49, '2025-06-07 15:08:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=1'),
(50, '2025-06-07 15:11:26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=1'),
(51, '2025-06-07 15:11:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(52, '2025-06-07 15:12:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=general'),
(53, '2025-06-07 15:12:36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=football'),
(54, '2025-06-07 15:12:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=general'),
(55, '2025-06-07 15:12:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=football'),
(56, '2025-06-07 15:12:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=game'),
(57, '2025-06-07 15:12:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=celebrity'),
(58, '2025-06-07 15:12:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=all'),
(59, '2025-06-07 15:12:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=football'),
(60, '2025-06-07 15:12:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=all'),
(61, '2025-06-07 15:12:57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(62, '2025-06-07 15:20:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(63, '2025-06-07 15:25:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(64, '2025-06-07 15:28:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(65, '2025-06-07 15:28:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(66, '2025-06-07 15:29:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(67, '2025-06-07 15:31:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(68, '2025-06-07 15:32:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(69, '2025-06-07 15:34:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(70, '2025-06-07 15:34:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(71, '2025-06-07 15:34:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(72, '2025-06-07 15:34:26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=3'),
(73, '2025-06-07 15:34:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=3'),
(74, '2025-06-07 15:35:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(75, '2025-06-07 15:35:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=2'),
(76, '2025-06-07 15:35:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(77, '2025-06-07 15:36:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(78, '2025-06-07 15:36:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(79, '2025-06-07 15:36:35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(80, '2025-06-07 15:37:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(81, '2025-06-07 15:42:36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(82, '2025-06-07 15:42:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(83, '2025-06-07 15:43:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(84, '2025-06-07 15:43:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(85, '2025-06-07 15:45:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(86, '2025-06-07 15:45:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(87, '2025-06-07 15:45:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(88, '2025-06-07 15:46:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(89, '2025-06-07 15:46:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(90, '2025-06-07 15:47:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(91, '2025-06-07 15:47:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(92, '2025-06-07 15:47:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(93, '2025-06-07 15:47:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(94, '2025-06-07 15:47:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=3'),
(95, '2025-06-09 01:46:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(96, '2025-06-29 07:47:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(97, '2025-06-29 07:48:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=general'),
(98, '2025-06-29 07:48:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=all'),
(99, '2025-06-29 07:48:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=football'),
(100, '2025-06-29 07:48:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=game'),
(101, '2025-06-29 07:48:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=celebrity'),
(102, '2025-06-29 07:48:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?search=12'),
(103, '2025-06-29 07:48:20', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?search='),
(104, '2025-06-29 07:56:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(105, '2025-06-29 07:57:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(106, '2025-06-29 07:58:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(107, '2025-06-29 07:59:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(108, '2025-07-11 04:23:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(109, '2025-07-11 04:23:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=general'),
(110, '2025-07-11 04:23:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?search=&filter=football'),
(111, '2025-07-11 04:24:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(112, '2025-07-11 04:24:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(113, '2025-07-11 04:24:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(114, '2025-07-11 04:24:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(115, '2025-07-11 04:24:26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(116, '2025-07-11 04:39:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(117, '2025-07-11 04:39:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?page=2'),
(118, '2025-07-11 04:39:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?page=3'),
(119, '2025-07-11 04:39:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?page=4'),
(120, '2025-07-11 04:39:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?page=4'),
(121, '2025-07-11 04:39:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/?page=5'),
(122, '2025-07-11 04:40:02', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(123, '2025-07-11 04:40:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=5'),
(124, '2025-07-11 04:40:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(125, '2025-07-11 04:40:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=2'),
(126, '2025-07-11 04:43:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=2'),
(127, '2025-07-11 04:44:02', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=3'),
(128, '2025-07-11 04:44:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=1'),
(129, '2025-07-11 04:51:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=1'),
(130, '2025-07-11 04:52:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=2'),
(131, '2025-07-11 04:52:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=3'),
(132, '2025-07-11 04:52:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=4'),
(133, '2025-07-11 04:52:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?page=5');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `celebrity_news`
--

CREATE TABLE `celebrity_news` (
  `celebrity_news_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `celebrity_name` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `celebrity_news`
--

INSERT INTO `celebrity_news` (`celebrity_news_id`, `title`, `slug`, `summary`, `content`, `image`, `view_count`, `is_published`, `created_at`, `updated_at`, `celebrity_name`, `category`) VALUES
(1, 'Hollywood Starlet Announces New Charity Initiative', 'hollywood-starlet-charity-initiative', 'Actress Emma Stone has launched a new global charity initiative focused on environmental conservation.', 'Emma Stone, known for her roles in \"La La Land\" and \"Cruella,\" held a press conference today to unveil her latest philanthropic endeavor. The \"Green Earth Alliance\" aims to raise awareness and funds for sustainable practices worldwide. Stone emphasized the urgency of climate action and encouraged fans to get involved through various volunteer programs and donation drives. The initiative has already garnered support from several other high-profile celebrities and environmental organizations.', 'https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2021/3/23/891849/Blackpink_Donz.jpg', 15230, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Emma Stone', 'Philanthropy'),
(2, 'Pop Icon Releases Surprise Album', 'pop-icon-surprise-album', 'Global sensation Justin Bieber shocked fans with the unannounced release of his fifth studio album, \"Midnight Echoes.\"', 'Justin Bieber\'s new album, \"Midnight Echoes,\" dropped at midnight without any prior promotion, sending his fanbase into a frenzy. The 12-track album features collaborations with several renowned artists and explores new musical directions for the pop star. Critics are already praising its experimental sound and introspective lyrics. The lead single, \"Starlight Serenade,\" has quickly climbed to the top of streaming charts worldwide, breaking several records in its first few hours.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzAwN3044FPqra6T9qxGFePlJtHoPOmtQM6w&s', 28765, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Justin Bieber', 'Music'),
(3, 'Veteran Actor Honored with Lifetime Achievement Award', 'veteran-actor-lifetime-award', 'Legendary actor Morgan Freeman was presented with the prestigious Lifetime Achievement Award at the Annual Film Gala.', 'Morgan Freeman, a cinematic icon with a career spanning over five decades, was celebrated last night at the Annual Film Gala. The emotional ceremony saw tributes from fellow actors, directors, and industry veterans who lauded his profound impact on film. Freeman, known for his distinctive voice and commanding presence, accepted the award with humility, thanking his family, colleagues, and fans for their unwavering support throughout his illustrious career. He also shared a few words of wisdom for aspiring actors.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGTw1THJqKDSR9-7fODDoA4Xsa5ALbqhgTkQ&s', 9870, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Morgan Freeman', 'Awards'),
(4, 'Reality TV Star Launches New Fashion Line', 'reality-tv-fashion-line', 'Kylie Jenner expands her empire with the debut of her highly anticipated new fashion collection, \"Kylie Style.\"', 'Kylie Jenner, the youngest of the Kardashian-Jenner clan and a successful entrepreneur, has officially launched her new fashion line, \"Kylie Style.\" The collection features a range of ready-to-wear apparel, accessories, and footwear, reflecting Jenner\'s signature bold and trendy aesthetic. The launch event, attended by numerous celebrities and fashion influencers, showcased pieces that are already generating significant buzz on social media. Fans can expect limited edition drops and collaborations in the coming months.', 'https://thanhnien.mediacdn.vn/Uploaded/trucdl/2022_11_09/nhomnhackpopthanhviennguoivietthanggiai13-5620.jpeg', 21005, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Kylie Jenner', 'Fashion'),
(5, 'Sports Legend Announces Retirement', 'sports-legend-retirement', 'Basketball superstar LeBron James has announced his retirement from professional basketball after an illustrious career.', 'In an emotional press conference, LeBron James, widely regarded as one of the greatest basketball players of all time, confirmed his decision to retire from the NBA. His career, marked by multiple championships, MVP awards, and countless records, has left an indelible mark on the sport. James expressed gratitude to his teammates, coaches, and fans, and spoke about his plans to focus on family and philanthropic endeavors. The announcement sent shockwaves through the sports world, with tributes pouring in from athletes and fans globally.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSszVz8sXC3_Dwj6PYugV3Fmeuf1BcHg4xObg&s', 35400, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'LeBron James', 'Sports'),
(6, 'Award-Winning Director Teases Next Blockbuster', 'director-next-blockbuster', 'Christopher Nolan hints at his upcoming film, promising a mind-bending cinematic experience.', 'Acclaimed director Christopher Nolan, known for his complex narratives and stunning visuals, has given fans a glimpse into his next highly anticipated project. While details remain scarce, Nolan suggested the film would push the boundaries of storytelling and visual effects. Speculation is rife among film enthusiasts about the cast and genre, with many hoping for another thought-provoking thriller in the vein of \"Inception\" or \"Interstellar.\" Production is expected to begin later this year.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTx4RkWnXuJOYVO2pXgUl7pUDJrGn5835MbOA&s', 18500, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Christopher Nolan', 'Film'),
(7, 'Singer-Songwriter Announces World Tour Dates', 'singer-songwriter-world-tour', 'Taylor Swift reveals dates for her highly anticipated global concert tour, \"The Eras Continues Tour.\"', 'Global music phenomenon Taylor Swift has unveiled the full itinerary for her \"The Eras Continues Tour,\" much to the delight of her millions of fans. The tour will span multiple continents, with tickets expected to sell out within minutes of going on sale. Swift promised a spectacular show, featuring hits from across her extensive discography and new arrangements. Fans are already preparing for the fierce competition for tickets and planning their attendance at the nearest venues.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqMakG6lkyWAvgLHtGrJ7gN1tYCXj_XZ3EhQ&s', 42100, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Taylor Swift', 'Music'),
(8, 'Tech Mogul Invests in Sustainable Energy Startup', 'tech-mogul-sustainable-energy', 'Elon Musk\'s latest venture sees a significant investment in a groundbreaking renewable energy company.', 'Billionaire entrepreneur Elon Musk has announced a major investment in \"SolarFlare Innovations,\" a startup specializing in cutting-edge solar energy solutions. This move aligns with Musk\'s long-standing commitment to sustainable technology and combating climate change. The investment is expected to accelerate SolarFlare\'s research and development, potentially bringing their innovative solar panel technology to a wider market much sooner than anticipated. Industry experts believe this could be a game-changer for the renewable energy sector.', 'https://www.zila.com.vn/wp-content/uploads/2021/08/seo-taiji-boys.jpg', 25900, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Elon Musk', 'Business'),
(9, 'Culinary Star Opens New Restaurant Chain', 'culinary-star-restaurant-chain', 'Chef Gordon Ramsay launches \"Ramsay\'s Kitchen,\" a new chain of casual dining restaurants.', 'Celebrity chef Gordon Ramsay, famous for his fiery personality and Michelin-starred restaurants, is venturing into the casual dining market with \"Ramsay\'s Kitchen.\" The new chain promises high-quality, accessible cuisine inspired by his classic dishes. The first few locations have already opened to rave reviews, with diners praising the vibrant atmosphere and delicious food. Ramsay aims to bring his culinary expertise to a broader audience, offering a taste of his renowned kitchens without the formal dining experience.', 'https://phapluat.tuoitrethudo.vn/stores/news_dataimages/buingocduong/112019/13/12/2509_HQ_2.jpg', 11300, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Gordon Ramsay', 'Food'),
(10, 'Olympic Gold Medalist Pens Memoir', 'olympic-gold-medalist-memoir', 'Simone Biles shares her inspiring journey in her new autobiography, \"Beyond the Mat.\"', 'Gymnastics phenom and multiple Olympic gold medalist Simone Biles has released her highly anticipated memoir, \"Beyond the Mat.\" The book delves into her personal struggles, triumphs, and her advocacy for mental health in sports. Biles offers an intimate look at the pressures of elite athleticism and the importance of prioritizing well-being. Early reviews commend her honesty and vulnerability, making the memoir a must-read for fans and anyone interested in her incredible story.', 'https://i.vietgiaitri.com/2018/10/27/nhung-nhom-nhac-nam-han-quoc-noi-tieng-duoc-yeu-thich-nhat-5e925d.jpg', 19800, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Simone Biles', 'Sports'),
(11, 'Actor Becomes Advocate for Mental Health', 'actor-mental-health-advocate', 'Dwayne \"The Rock\" Johnson speaks out about his struggles and advocates for mental health awareness.', 'Dwayne \"The Rock\" Johnson, known for his larger-than-life persona, recently shared his personal journey with mental health, urging others to seek help and support. His candid revelations have resonated with millions, sparking important conversations about mental well-being, especially among men. Johnson emphasized that it\'s okay not to be okay and that seeking professional help is a sign of strength, not weakness. He plans to launch a campaign to destigmatize mental health discussions.', 'https://www.zila.com.vn/wp-content/uploads/2021/06/yg-entertainment-blackpink.jpg', 23500, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Dwayne Johnson', 'Advocacy'),
(12, '', 'scientist-nobel-prize', 'Dr. Jane Goodall awarded the Nobel Prize for her groundbreaking work in primatology.', 'Dr. Jane Goodall, the world-renowned primatologist and conservationist, has been awarded the Nobel Prize for her revolutionary research on chimpanzees and her tireless efforts in environmental conservation. Her pioneering work has transformed our understanding of animal behavior and our responsibility towards the natural world. Goodall expressed her gratitude and reiterated her commitment to protecting wildlife and their habitats for future generations.', 'https://placehold.co/800x600/008080/FFFFFF?text=Jane+Goodall+Nobel', 10500, 1, '2025-07-11 04:27:58', '2025-07-11 04:43:50', 'Jane Goodall', 'Science'),
(13, 'Fashion Designer Unveils Eco-Friendly Collection', 'designer-eco-friendly-collection', 'Stella McCartney showcases her new sustainable fashion line at Paris Fashion Week.', 'British fashion designer Stella McCartney, a pioneer in ethical and sustainable fashion, presented her latest collection at Paris Fashion Week. The collection, made entirely from recycled and organic materials, received widespread acclaim for its innovative designs and commitment to environmental responsibility. McCartney continues to push the boundaries of sustainable fashion, proving that luxury and eco-consciousness can go hand in hand. Her show was a highlight of the week, inspiring many in the industry.', 'https://placehold.co/800x600/DAA520/FFFFFF?text=Stella+McCartney+Eco', 14000, 1, '2025-07-11 04:27:58', '2025-07-11 04:27:58', 'Stella McCartney', 'Fashion'),
(14, 'Comedian Announces Stand-Up Special', 'comedian-stand-up-special', 'Kevin Hart reveals details for his upcoming Netflix stand-up comedy special, \"Laugh Out Loud.\"', 'Comedian and actor Kevin Hart has announced his new stand-up special, \"Laugh Out Loud,\" set to premiere exclusively on Netflix. Known for his high-energy performances and relatable humor, Hart promises an hour of non-stop laughter, covering topics from family life to current events. Fans are eagerly anticipating the special, which was filmed during his sold-out arena tour. Hart continues to be one of the most bankable names in comedy, consistently delivering hilarious and engaging content.', 'https://placehold.co/800x600/8B4513/FFFFFF?text=Kevin+Hart+Comedy', 17000, 1, '2025-07-11 04:27:58', '2025-07-11 04:27:58', 'Kevin Hart', 'Comedy'),
(15, 'Chef and TV Personality Releases New Cookbook', 'chef-tv-personality-cookbook', 'Ina Garten, \"Barefoot Contessa,\" launches her latest cookbook, \"Modern Comfort Food.\"', 'Beloved chef and TV personality Ina Garten, widely known as the \"Barefoot Contessa,\" has released her newest cookbook, \"Modern Comfort Food.\" The book features a collection of comforting yet sophisticated recipes, perfect for home cooks looking to elevate their everyday meals. Garten\'s signature approachable style and foolproof instructions make this cookbook a must-have for her loyal fanbase. She emphasizes fresh ingredients and simple techniques to create delicious and satisfying dishes.', 'https://placehold.co/800x600/B0C4DE/FFFFFF?text=Ina+Garten+Cookbook', 9500, 1, '2025-07-11 04:27:58', '2025-07-11 04:27:58', 'Ina Garten', 'Food');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `football_news`
--

CREATE TABLE `football_news` (
  `football_news_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `match_date` datetime DEFAULT NULL,
  `teams` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `football_news`
--

INSERT INTO `football_news` (`football_news_id`, `title`, `slug`, `summary`, `content`, `image`, `view_count`, `is_published`, `created_at`, `updated_at`, `match_date`, `teams`) VALUES
(9, 'Trang tin bo', NULL, '13w21', '<p>2313</p>', 'https://media.vov.vn/sites/default/files/styles/large/public/2022-04/277585955_567301081419468_985314393548630327_n.jpg', 0, 1, '2025-06-29 07:57:12', '2025-07-11 04:46:35', '2025-06-04 00:00:00', '1221'),
(11, 'Real Madrid Vô Địch Champions League Lần Thứ 15', 'real-madrid-vo-dich-champions-league-lan-thu-15', 'Real Madrid đã xuất sắc đánh bại đối thủ để giành chức vô địch Champions League lịch sử.', '<p>Trong một trận đấu đầy kịch tính, Real Madrid đã thể hiện bản lĩnh của mình và vượt qua đối thủ mạnh để lên ngôi vô địch Champions League lần thứ 15. Vinicius Jr. và Rodrygo là những người hùng với các bàn thắng quyết định.</p>', 'https://media.vov.vn/sites/default/files/styles/large/public/2022-04/277464545_10160283564398598_5145459475732446726_n.jpg', 15000, 1, '2025-06-01 15:00:00', '2025-07-11 04:46:35', '2025-05-28 21:00:00', 'Real Madrid vs Borussia Dortmund'),
(12, 'Manchester City Thống Trị Premier League Mùa Giải Mới', 'man-city-thong-tri-premier-league-mua-giai-moi', 'Man City bắt đầu mùa giải Premier League với phong độ hủy diệt, dẫn đầu bảng xếp hạng.', '<p>Manchester City đã khởi đầu mùa giải Premier League một cách ấn tượng, giành chiến thắng liên tiếp và thể hiện sức mạnh vượt trội. Erling Haaland tiếp tục là cỗ máy ghi bàn đáng sợ.</p>', 'https://kenh14cdn.com/203336854389633024/2022/12/19/photo-8-1671457580636229578792.jpg', 12000, 1, '2025-07-05 08:30:00', '2025-07-11 04:46:35', '2025-07-01 19:00:00', 'Manchester City vs Chelsea'),
(13, 'Messi Lập Kỷ Lục Ghi Bàn Mới Tại MLS', 'messi-lap-ky-luc-ghi-ban-moi-tai-mls', 'Lionel Messi tiếp tục phá vỡ các kỷ lục, lần này là tại giải nhà nghề Mỹ.', '<p>Siêu sao Lionel Messi đã chứng minh đẳng cấp của mình khi phá vỡ kỷ lục ghi bàn tại MLS chỉ trong một mùa giải. Anh đang là đầu tàu giúp Inter Miami bay cao.</p>', 'https://uploads.nguoidothi.net.vn/content/ca3e3023-4e50-429e-8700-cc04f9ebfaf1.jpg', 9500, 1, '2025-07-08 02:00:00', '2025-07-11 04:46:35', '2025-07-06 20:30:00', 'Inter Miami vs Orlando City'),
(14, 'Bayern Munich Tăng Cường Hàng Công Với Ngôi Sao Mới', 'bayern-munich-tang-cuong-hang-cong-voi-ngoi-sao-moi', 'Bayern Munich đã chiêu mộ thành công một tiền đạo đẳng cấp thế giới.', '<p>Nhằm củng cố sức mạnh tấn công, Bayern Munich đã hoàn tất bản hợp đồng bom tấn với một tiền đạo trẻ đầy tài năng. Đây hứa hẹn sẽ là sự bổ sung chất lượng cho Hùm Xám.</p>', 'https://cdn.nhandan.vn/images/1ef398c4e2fb4bf07980a2ded785b3ef26472cc25661c86a70abdc881c53d56602d6a7fbe90befb252aa0bf7342eafbeefd30aa7774d4a991df20f84d426f3096a8b263c343c96c1ca38b60b7a894800/cristiano-ronaldo-1-copy-4469.jpg', 8000, 1, '2025-06-20 04:45:00', '2025-07-11 04:46:35', '2025-06-15 18:00:00', 'Bayern Munich vs RB Leipzig'),
(15, 'Liverpool Khởi Đầu Mùa Giải Premier League Đầy Hứa Hẹn', 'liverpool-khoi-dau-mua-giai-premier-league-day-hua-hen', 'Liverpool có khởi đầu mạnh mẽ tại Premier League, cho thấy tiềm năng lớn.', '<p>Dưới sự dẫn dắt của tân huấn luyện viên, Liverpool đã có một khởi đầu ấn tượng tại Premier League. Đội bóng đang thể hiện lối chơi tấn công đẹp mắt và hiệu quả.</p>', 'https://bcp.cdnchinhphu.vn/334894974524682240/2022/11/22/photo-1-16690491248612117238438-crop-16690491757671508677349-1669081915832624285516.jpg', 7000, 1, '2025-07-02 03:15:00', '2025-07-11 04:46:35', '2025-06-29 17:30:00', 'Liverpool vs Arsenal'),
(16, 'Barcelona Vượt Qua Khủng Hoảng Tài Chính, Tái Thiết Đội Hình', 'barcelona-vuot-qua-khung-hoang-tai-chinh-tai-thiet-doi-hinh', 'Barcelona đang dần ổn định tài chính và bắt đầu quá trình tái thiết đội hình.', '<p>Sau giai đoạn khó khăn, Barcelona đang cho thấy những dấu hiệu tích cực trong việc ổn định tài chính. Đội bóng cũng đang tích cực chiêu mộ các tài năng trẻ để xây dựng tương lai.</p>', 'https://vnanet.vn/Data/Articles/2022/12/11/6486545/vna_potal_world_cup_2022_anh_gap_phap_tran_dai_chien_cua_bong_da_chau_au_stand.jpg', 6000, 1, '2025-06-25 07:00:00', '2025-07-11 04:46:35', '2025-06-22 22:00:00', 'Barcelona vs Real Sociedad'),
(17, 'Giải Vô Địch Quốc Gia Việt Nam: HAGL Thăng Hoa', 'giai-vo-dich-quoc-gia-viet-nam-hagl-thang-hoa', 'Hoàng Anh Gia Lai đang có phong độ cao tại V-League, dẫn đầu bảng xếp hạng.', '<p>Hoàng Anh Gia Lai đang là hiện tượng tại V-League mùa này với chuỗi trận bất bại ấn tượng. Các cầu thủ trẻ của HAGL đang thi đấu đầy nhiệt huyết và cống hiến.</p>', 'https://cellphones.com.vn/sforum/wp-content/uploads/2022/11/qua-bong-ai-rihla-worldcup-2022-1.jpg', 4500, 1, '2025-07-07 09:00:00', '2025-07-11 04:46:35', '2025-07-04 17:00:00', 'HAGL vs Viettel'),
(18, 'Đội Tuyển Pháp Chuẩn Bị Cho Vòng Loại World Cup', 'doi-tuyen-phap-chuan-bi-cho-vong-loai-world-cup', 'Đội tuyển Pháp đang tích cực tập luyện cho các trận đấu vòng loại World Cup sắp tới.', '<p>Các ngôi sao của đội tuyển Pháp đã hội quân và bắt đầu quá trình chuẩn bị cho vòng loại World Cup. Huấn luyện viên Didier Deschamps đang thử nghiệm nhiều chiến thuật mới.</p>', 'https://bcp.cdnchinhphu.vn/334894974524682240/2022/11/20/khai-mac-khai-mac-16689172558442005297765.png', 3000, 1, '2025-06-18 01:30:00', '2025-07-11 04:46:35', '2025-06-10 20:45:00', 'France vs Belgium'),
(19, 'Inter Milan Giành Scudetto Với Phong Độ Ấn Tượng', 'inter-milan-gianh-scudetto-voi-phong-do-an-tuong', 'Inter Milan đã chính thức lên ngôi vô địch Serie A sau một mùa giải xuất sắc.', '<p>Inter Milan đã có một mùa giải Serie A không thể tin được, thể hiện sự ổn định và sức mạnh vượt trội. Họ đã sớm giành Scudetto với nhiều vòng đấu còn lại.</p>', 'https://vff.org.vn/wp-content/uploads/2021/09/1.jpg', 5500, 1, '2025-05-15 12:00:00', '2025-07-11 04:46:35', '2025-05-10 18:00:00', 'Inter Milan vs AC Milan'),
(20, 'Copa America 2025: Brazil và Argentina Đối Đầu', 'copa-america-2025-brazil-va-argentina-doi-dau', 'Hai kỳ phùng địch thủ Brazil và Argentina sẽ có cuộc chạm trán nảy lửa tại Copa America.', '<p>Trận đấu được mong chờ nhất Copa America 2025 sẽ là cuộc đối đầu kinh điển giữa Brazil và Argentina. Cả hai đội đều đang có phong độ cao và hứa hẹn một trận cầu đỉnh cao.</p>', 'https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2021/6/12/919781/Doi-Tuyen-Viet-Nam-1.jpg', 18000, 1, '2025-07-09 06:00:00', '2025-07-11 04:46:35', '2025-07-12 23:00:00', 'Brazil vs Argentina');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `game_news`
--

CREATE TABLE `game_news` (
  `game_news_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `game_title` varchar(255) DEFAULT NULL,
  `platform` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `game_news`
--

INSERT INTO `game_news` (`game_news_id`, `title`, `slug`, `summary`, `content`, `image`, `view_count`, `is_published`, `created_at`, `updated_at`, `game_title`, `platform`) VALUES
(1, 'Cyberpunk 2077: Phantom Liberty - Đánh giá chi tiết bản mở rộng', 'cyberpunk-2077-phantom-liberty-danh-gia-chi-tiet', 'Bản mở rộng Phantom Liberty mang đến một câu chuyện mới hấp dẫn và nhiều cải tiến đáng kể cho Cyberpunk 2077.', 'Phantom Liberty là một bản mở rộng lớn, đưa người chơi trở lại Night City với một khu vực mới, Dogtown, và một cốt truyện điệp viên đầy kịch tính. CD Projekt Red đã làm rất tốt trong việc lắng nghe phản hồi của cộng đồng và cải thiện đáng kể trải nghiệm chơi game.', 'https://i-sohoa.vnecdn.net/2022/07/11/dd-4702-1657538769.png', 15000, 1, '2025-06-20 03:00:00', '2025-07-11 04:48:52', 'Cyberpunk 2077', 'PC, PS5, Xbox Series X/S'),
(2, 'Top 5 game nhập vai đáng chơi nhất năm 2025', 'top-5-game-nhap-vai-dang-choi-nhat-2025', 'Danh sách các tựa game RPG không thể bỏ qua trong năm nay, từ thế giới mở rộng lớn đến cốt truyện sâu sắc.', 'Năm 2025 chứng kiến sự ra mắt của nhiều tựa game nhập vai đỉnh cao. Từ Elden Ring: Shadow of the Erdtree đến The Witcher 4, mỗi tựa game đều mang đến những trải nghiệm độc đáo và đáng nhớ cho người hâm mộ thể loại RPG.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCazp_pjPcA3qXRwAVZkkfas3gdNLUxGweUA&s', 8000, 1, '2025-06-25 04:30:00', '2025-07-11 04:48:52', NULL, 'Đa nền tảng'),
(3, 'Sự trở lại của thể loại game kinh dị sinh tồn', 'su-tro-lai-game-kinh-di-sinh-ton', 'Các tựa game kinh dị sinh tồn đang dần lấy lại vị thế với những cái tên mới đầy hứa hẹn.', 'Sau một thời gian vắng bóng, thể loại kinh dị sinh tồn đang có dấu hiệu trở lại mạnh mẽ với các tựa game như Silent Hill 2 Remake và Alone in the Dark, mang đến nỗi sợ hãi và sự căng thẳng tột độ cho người chơi.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZ7Q_cguJG7FHNGBRoN18hgy6T4IVwUOpeew&s', 6500, 1, '2025-06-28 02:15:00', '2025-07-11 04:48:52', NULL, 'PC, Console'),
(4, 'Final Fantasy VII Rebirth đạt doanh số ấn tượng', 'final-fantasy-vii-rebirth-doanh-so-an-tuong', 'Tựa game JRPG đình đám của Square Enix tiếp tục gặt hái thành công về mặt doanh số.', 'Final Fantasy VII Rebirth, phần tiếp theo của Final Fantasy VII Remake, đã nhanh chóng đạt được doanh số triệu bản trên toàn cầu, khẳng định sức hút của thương hiệu này.', 'https://cdn.oneesports.vn/cdn-data/sites/4/2023/12/LienQuan-AOVision-2024-Co-creation.jpg', 12000, 1, '2025-07-01 07:00:00', '2025-07-11 04:48:52', 'Final Fantasy VII Rebirth', 'PS5'),
(5, 'Call of Duty 2025: Những tin đồn mới nhất về chế độ Multiplayer', 'call-of-duty-2025-tin-don-multiplayer', 'Cộng đồng game thủ đang xôn xao về các thông tin rò rỉ liên quan đến chế độ chơi mạng của CoD 2025.', 'Các tin đồn cho thấy Call of Duty 2025 sẽ mang trở lại một số bản đồ cổ điển được yêu thích và giới thiệu cơ chế di chuyển mới, hứa hẹn một trải nghiệm multiplayer đầy phấn khích.', 'https://photo.znews.vn/w660/Uploaded/lce_uxlcq/2020_12_25/wp6526536.jpg', 9500, 1, '2025-07-03 09:00:00', '2025-07-11 04:48:52', 'Call of Duty 2025', 'PC, PS5, Xbox Series X/S'),
(6, 'Genshin Impact: Hướng dẫn xây dựng đội hình tối ưu cho Fontaine', 'genshin-impact-huong-dan-doi-hinh-fontaine', 'Khám phá các chiến lược đội hình hiệu quả nhất để chinh phục vùng đất Fontaine mới trong Genshin Impact.', 'Fontaine mang đến nhiều thử thách mới và các nhân vật độc đáo. Bài viết này sẽ hướng dẫn bạn cách kết hợp các nhân vật để tạo ra đội hình mạnh mẽ nhất, tận dụng tối đa các nguyên tố và kỹ năng.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTN0gapMLa_l4Q_5i_NOSmc1Db-jLqnBWvy1A&s', 7200, 1, '2025-07-05 01:45:00', '2025-07-11 04:48:52', 'Genshin Impact', 'Mobile, PC, PS5'),
(7, 'Elden Ring: Shadow of the Erdtree - Ấn tượng đầu tiên', 'elden-ring-shadow-of-the-erdtree-an-tuong', 'Bản DLC được mong chờ nhất của Elden Ring đã ra mắt, mang đến những thử thách mới và một thế giới rộng lớn hơn.', 'Shadow of the Erdtree không chỉ mở rộng bản đồ mà còn giới thiệu thêm kẻ thù, vũ khí và phép thuật mới. Đây là một bản mở rộng xứng đáng với danh tiếng của Elden Ring.', 'https://cdnphoto.dantri.com.vn/_ypY_Vkk9qHEbdl8tXn2orIYO3E=/thumb_w/1020/2022/07/16/promote-maris-1607docx-1657940889904.png', 18000, 1, '2025-07-07 03:30:00', '2025-07-11 04:48:52', 'Elden Ring', 'PC, PS5, Xbox Series X/S'),
(8, 'Nintendo Switch 2: Những kỳ vọng và tin đồn mới nhất', 'nintendo-switch-2-ky-vong-tin-don', 'Cộng đồng game thủ đang háo hức chờ đợi thông tin chính thức về thế hệ console tiếp theo của Nintendo.', 'Tin đồn về Nintendo Switch 2 bao gồm khả năng đồ họa nâng cao, màn hình OLED lớn hơn và thời lượng pin cải thiện, hứa hẹn một bước tiến lớn cho hệ máy cầm tay này.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToeOvvnsDh-6yDissD964JHNM3-jH4Ci8zoA&s', 11000, 1, '2025-07-09 04:00:00', '2025-07-11 04:48:52', NULL, 'Nintendo Switch'),
(9, 'Valorant: Cập nhật Agent mới và bản đồ cân bằng', 'valorant-cap-nhat-agent-ban-do', 'Riot Games vừa tung ra bản cập nhật lớn cho Valorant, giới thiệu một Agent mới và điều chỉnh nhiều bản đồ.', 'Bản cập nhật này nhằm mục đích làm mới meta game và mang lại sự cân bằng hơn cho các trận đấu. Agent mới hứa hẹn sẽ thay đổi đáng kể chiến thuật của người chơi.', 'https://didongviet.vn/dchannel/wp-content/uploads/2023/12/12-cac-tuong-trong-lien-quan-didongviet.jpg', 7800, 1, '2025-07-10 02:00:00', '2025-07-11 04:48:52', 'Valorant', 'PC'),
(10, 'Diablo 4: Mùa giải mới và sự kiện trong game', 'diablo-4-mua-giai-moi-su-kien', 'Mùa giải thứ 4 của Diablo 4 đã chính thức bắt đầu với nhiều nội dung và phần thưởng hấp dẫn.', 'Mùa giải mới mang đến các nhiệm vụ, trang bị và sự kiện đặc biệt, khuyến khích người chơi khám phá lại thế giới Sanctuary với những thử thách mới mẻ.', 'https://media-cdn-v2.laodong.vn/storage/newsportal/2024/11/5/1417514/Lien-Quan-Mobilie.jpg', 9000, 1, '2025-07-10 23:00:00', '2025-07-11 04:48:52', 'Diablo 4', 'PC, PS5, Xbox Series X/S');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`news_id`, `title`, `slug`, `summary`, `content`, `image`, `view_count`, `is_published`, `created_at`, `updated_at`) VALUES
(7, 'dá', NULL, 'dsa', '<p>sad</p>', 'https://i.ytimg.com/vi/MpocvVh9h3U/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLD6krZNuGosWZAOxxcubG20PofsBA', 0, 1, '2025-06-29 07:59:14', '2025-07-11 04:51:51'),
(8, 'Phát hiện mới về biến đổi khí hậu ở Bắc Cực', NULL, 'Các nhà khoa học công bố dữ liệu đáng báo động về tốc độ tan băng ở Bắc Cực, cảnh báo về những tác động toàn cầu.', '<p>Báo cáo mới nhất từ Viện Nghiên cứu Khí hậu Quốc tế cho thấy Bắc Cực đang ấm lên nhanh hơn gấp đôi so với phần còn lại của thế giới. Điều này dẫn đến sự tan chảy nhanh chóng của các sông băng và băng biển, gây ra mực nước biển dâng cao và ảnh hưởng đến hệ sinh thái toàn cầu.</p><p>Các chuyên gia kêu gọi hành động khẩn cấp để giảm lượng khí thải carbon và hạn chế sự nóng lên toàn cầu.</p>', 'https://i.ytimg.com/vi/SiR2ebLU5kM/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLDY7-za5Nwg376D153JiWfqH3qIww', 450, 1, '2025-07-11 04:39:09', '2025-07-11 04:51:51'),
(9, 'Công nghệ AI đột phá giúp chẩn đoán bệnh sớm hơn', NULL, 'Một hệ thống AI mới đã chứng minh khả năng phát hiện các dấu hiệu bệnh hiểm nghèo với độ chính xác cao.', '<p>Các nhà nghiên cứu tại Đại học Y khoa hàng đầu đã phát triển một thuật toán trí tuệ nhân tạo có khả năng phân tích hình ảnh y tế và dữ liệu bệnh án để nhận diện sớm các bệnh như ung thư và Alzheimer.</p><p>Hệ thống này được kỳ vọng sẽ cách mạng hóa quy trình chẩn đoán, giúp bệnh nhân tiếp cận điều trị kịp thời và tăng tỷ lệ sống sót.</p>', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQwmBh68RVfa0sjfw2OLYE8znDI4gJOm44-w&s', 380, 1, '2025-07-11 04:39:09', '2025-07-11 04:51:51'),
(10, 'Thị trường chứng khoán toàn cầu phục hồi mạnh mẽ', NULL, 'Sau giai đoạn biến động, các chỉ số chứng khoán lớn trên thế giới đang cho thấy tín hiệu tích cực.', '<p>Trong tuần qua, các thị trường chứng khoán lớn như Dow Jones, S&P 500, NASDAQ, FTSE 100 và Nikkei 225 đều ghi nhận mức tăng trưởng ấn tượng.</p><p>Sự phục hồi này được thúc đẩy bởi niềm tin vào chính sách tiền tệ ổn định và triển vọng kinh tế toàn cầu sáng sủa hơn.</p>', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTX5i6dwTxUq4FtfzpgnJMEv2ylYAIXG-a2Jw&s', 520, 1, '2025-07-11 04:39:09', '2025-07-11 04:51:51'),
(11, 'Khám phá loài sinh vật biển sâu mới lạ', NULL, 'Một đoàn thám hiểm đại dương đã tìm thấy một loài cá chưa từng được biết đến ở độ sâu hơn 8000 mét.', '<p>Trong chuyến hành trình khám phá Rãnh Mariana, các nhà khoa học đã sử dụng tàu lặn tự hành để ghi lại hình ảnh và thu thập mẫu vật của một loài cá có hình dạng độc đáo, phát sáng trong bóng tối.</p><p>Phát hiện này mở ra những hiểu biết mới về sự đa dạng sinh học ở những môi trường khắc nghiệt nhất trên Trái Đất.</p>', 'https://ddk.1cdn.vn/2025/06/16/vang-mieng-trong-nuoc-duy-tri-muc-120-trieu-dong-luong-ban-ra-ddk-2.png', 290, 1, '2025-07-11 04:39:09', '2025-07-11 04:51:51'),
(12, 'Chính phủ công bố gói kích cầu kinh tế lớn nhất lịch sử', NULL, 'Nhằm đối phó với những thách thức kinh tế, một gói hỗ trợ tài chính khổng lồ đã được phê duyệt.', '<p>Gói kích cầu trị giá hàng tỷ đô la này bao gồm các khoản đầu tư vào cơ sở hạ tầng, hỗ trợ doanh nghiệp nhỏ và vừa, cùng với các chương trình an sinh xã hội.</p><p>Mục tiêu là thúc đẩy tăng trưởng, tạo việc làm và ổn định đời sống người dân trong bối cảnh kinh tế toàn cầu còn nhiều bất ổn.</p>', 'https://i.ytimg.com/vi/KmAI5B0Pv2A/maxresdefault.jpg', 490, 1, '2025-07-11 04:39:09', '2025-07-11 04:51:51'),
(13, 'Thành công bước đầu của vaccine thế hệ mới', NULL, 'Các thử nghiệm lâm sàng giai đoạn 3 của một loại vaccine mới cho thấy hiệu quả vượt trội.', '<p>Loại vaccine này được thiết kế để chống lại nhiều biến thể của virus gây bệnh hô hấp, sử dụng công nghệ mRNA tiên tiến.</p><p>Kết quả ban đầu rất hứa hẹn, với tỷ lệ bảo vệ cao và ít tác dụng phụ, mở ra hy vọng kiểm soát dịch bệnh tốt hơn trong tương lai.</p>', 'https://file3.qdnd.vn/data/images/0/2023/05/06/hieu_tv/mu%201.jpg?dpi=150&quality=100&w=870', 350, 1, '2025-07-11 04:39:09', '2025-07-11 04:51:51'),
(14, 'Phát triển năng lượng sạch đột phá từ phản ứng tổng hợp hạt nhân', NULL, 'Một lò phản ứng tổng hợp hạt nhân thử nghiệm đã tạo ra năng lượng ròng, mở ra kỷ nguyên mới cho năng lượng sạch.', '<p>Các nhà khoa học tại phòng thí nghiệm quốc gia đã đạt được một cột mốc quan trọng trong việc khai thác năng lượng từ phản ứng tổng hợp hạt nhân, quá trình tương tự như Mặt Trời.</p><p>Thành tựu này có thể cung cấp nguồn năng lượng sạch, gần như vô tận và an toàn cho tương lai.</p>', 'https://cdn-i.doisongphapluat.com.vn/resize/th/upload/2025/06/13/2-vo-chong-mat-tich-khi-di-cat-ro-tren-song-dinh-15313254.jpg', 410, 1, '2025-07-11 04:39:09', '2025-07-11 04:51:51'),
(15, 'Giải vô địch thể thao điện tử phá kỷ lục người xem', NULL, 'Trận chung kết giải đấu eSports lớn nhất năm đã thu hút hàng triệu khán giả trên toàn thế giới.', '<p>Giải đấu Liên Minh Huyền Thoại Quốc tế (Worlds) năm nay đã phá vỡ mọi kỷ lục về số lượng người xem trực tuyến, khẳng định vị thế của thể thao điện tử trên bản đồ giải trí toàn cầu.</p><p>Sự kiện này cho thấy tiềm năng phát triển khổng lồ của ngành công nghiệp game và eSports.</p>', 'https://cdn2.tuoitre.vn/thumb_w/480/471584752817336320/2024/8/26/capture-17246317934091960250110.jpg', 580, 1, '2025-07-11 04:39:09', '2025-07-11 04:51:51'),
(16, 'Thành phố thông minh đầu tiên chính thức đi vào hoạt động', NULL, 'Một thành phố được xây dựng hoàn toàn dựa trên công nghệ thông minh đã bắt đầu đón cư dân.', '<p>Với hệ thống giao thông tự động, quản lý năng lượng thông minh và cơ sở hạ tầng kết nối IoT, thành phố này hứa hẹn mang lại chất lượng cuộc sống cao và hiệu quả vận hành tối ưu.</p><p>Đây là mô hình tiên phong cho các đô thị tương lai trên thế giới.</p>', 'https://cdn-i.doisongphapluat.com.vn/resize/th/upload/2025/05/24/no-luc-tim-kiem-2-me-con-nghi-mat-tich-do-lu-cuon-o-son-la-16281513.jpg', 330, 1, '2025-07-11 04:39:09', '2025-07-11 04:51:51'),
(17, 'Nghệ thuật AI tạo ra kiệt tác mới gây tranh cãi', NULL, 'Một bức tranh được tạo ra hoàn toàn bởi trí tuệ nhân tạo đã được bán với giá kỷ lục, gây ra nhiều cuộc tranh luận.', '<p>Tác phẩm nghệ thuật này, được tạo ra bởi một thuật toán học sâu, đã gây chấn động giới nghệ thuật khi được đấu giá thành công với số tiền chưa từng có.</p><p>Sự kiện này đặt ra câu hỏi về vai trò của con người trong sáng tạo nghệ thuật và định nghĩa về \"nghệ thuật\" trong kỷ nguyên AI.</p>', 'https://vcdn1-vnexpress.vnecdn.net/2025/04/24/bh-1745461769-1745461939-4110-1745463010.png?w=500&h=300&q=100&dpr=1&fit=crop&s=YP3K6Qqo4yV6Ks86NHZE6g', 270, 1, '2025-07-11 04:39:09', '2025-07-11 04:51:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `role` enum('admin','editor') DEFAULT 'editor',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`, `role`, `created_at`, `updated_at`) VALUES
(9, 'admin', '$2y$10$PSWVhQ683flczMPlO50q/e7aHsTL2PefjjH57rq18VSFemLRgjPlW', 'admin@gmail.com', 'admin', 'admin', '2025-04-13 09:41:22', '2025-04-13 09:42:06'),
(10, '1', '$2y$10$JlTy7Hilwp/5B9HaQfKd8OXz7MxJ4GzC3NuKpfIZVesT6w3iPgCwC', '1@gmail.com', '1', 'editor', '2025-04-13 09:42:23', '2025-04-13 09:42:23'),
(11, '12', '$2y$10$y20ahP8Iy4M/c2BxSW2bWu2JXVYO61t2Jef3rCELJA8/MuMqk1UCS', '12@gmail.com', '12', 'editor', '2025-04-18 15:02:48', '2025-04-18 15:02:48');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `access_logs`
--
ALTER TABLE `access_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Chỉ mục cho bảng `celebrity_news`
--
ALTER TABLE `celebrity_news`
  ADD PRIMARY KEY (`celebrity_news_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `football_news`
--
ALTER TABLE `football_news`
  ADD PRIMARY KEY (`football_news_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `game_news`
--
ALTER TABLE `game_news`
  ADD PRIMARY KEY (`game_news_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT cho bảng `celebrity_news`
--
ALTER TABLE `celebrity_news`
  MODIFY `celebrity_news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `football_news`
--
ALTER TABLE `football_news`
  MODIFY `football_news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `game_news`
--
ALTER TABLE `game_news`
  MODIFY `game_news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
