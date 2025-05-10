-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 21, 2025 lúc 12:59 PM
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
-- Cơ sở dữ liệu: `lamcutoa3`
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
(1, '2025-04-13 09:42:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(2, '2025-04-13 09:44:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(3, '2025-04-13 09:45:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(4, '2025-04-13 09:45:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(5, '2025-04-13 09:46:35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(6, '2025-04-13 09:52:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(7, '2025-04-13 09:55:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(8, '2025-04-13 09:55:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(9, '2025-04-13 09:55:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(10, '2025-04-13 09:55:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(11, '2025-04-13 09:56:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(12, '2025-04-13 09:56:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(13, '2025-04-13 09:57:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(14, '2025-04-13 09:57:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(15, '2025-04-13 09:57:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(16, '2025-04-13 09:57:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(17, '2025-04-13 09:57:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(18, '2025-04-13 09:59:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(19, '2025-04-13 09:59:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(20, '2025-04-13 10:00:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(21, '2025-04-13 10:00:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/?search=12'),
(22, '2025-04-13 10:00:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/?search=12'),
(23, '2025-04-13 10:00:54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(24, '2025-04-13 10:01:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?search=3'),
(25, '2025-04-18 15:02:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(26, '2025-04-18 15:22:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(27, '2025-04-18 15:22:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(28, '2025-04-18 15:24:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php'),
(29, '2025-04-18 15:24:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?search=2'),
(30, '2025-04-18 15:24:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?search=2'),
(31, '2025-04-18 15:24:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php?search=2323'),
(32, '2025-04-19 14:33:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/'),
(33, '2025-04-19 14:33:35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '/cutonama3/admin/index.php');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `user_id` int(11) DEFAULT NULL,
  `celebrity_name` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `celebrity_news`
--

INSERT INTO `celebrity_news` (`celebrity_news_id`, `title`, `slug`, `summary`, `content`, `image`, `view_count`, `is_published`, `created_at`, `updated_at`, `user_id`, `celebrity_name`, `category`) VALUES
(1, 'Sơn Tùng M-TP ra mắt MV mới gây sốt', 'son-tung-m-tp-mv-moi', 'MV mới nhất của Sơn Tùng M-TP đang nhận được sự quan tâm lớn từ khán giả.', 'Nội dung chi tiết về quá trình sản xuất, ý tưởng MV...', 'assets/celebrity/sontung.jpg', 1500, 1, '2025-04-19 03:45:00', '2025-04-19 03:45:00', 9, 'Sơn Tùng M-TP', 'Ca sĩ'),
(2, 'Hồ Ngọc Hà lần đầu chia sẻ về cuộc sống gia đình', 'ho-ngoc-ha-chia-se-gia-dinh', 'Những tiết lộ cảm động của Hồ Ngọc Hà về tổ ấm hạnh phúc.', 'Bài phỏng vấn độc quyền về các thành viên trong gia đình...', 'assets/celebrity/hongocHa.jpg', 1200, 1, '2025-04-19 03:45:30', '2025-04-19 03:45:30', 10, 'Hồ Ngọc Hà', 'Ca sĩ'),
(3, 'Chi Pu lấn sân sang lĩnh vực điện ảnh', 'chi-pu-lan-san-dien-anh', 'Chi Pu chính thức tham gia dự án phim điện ảnh mới.', 'Thông tin về vai diễn, đạo diễn và các diễn viên khác...', 'assets/celebrity/chipu.jpg', 900, 1, '2025-04-19 03:46:00', '2025-04-19 03:46:00', 9, 'Chi Pu', 'Diễn viên'),
(4, 'Ngọc Trinh gây tranh cãi với phát ngôn mới', 'ngoc-trinh-gay-tranh-cai', 'Phát ngôn của Ngọc Trinh về vấn đề...', 'Toàn bộ nội dung phát ngôn và phản ứng của dư luận...', 'assets/celebrity/ngoctrinh.jpg', 1800, 1, '2025-04-19 03:46:30', '2025-04-19 03:46:30', 10, 'Ngọc Trinh', 'Người mẫu'),
(5, 'Isaac tái xuất với hình ảnh lịch lãm', 'isaac-tai-xuat', 'Isaac trở lại showbiz sau thời gian vắng bóng.', 'Hình ảnh mới nhất và dự án âm nhạc sắp tới của Isaac...', 'assets/celebrity/isaac.jpg', 1100, 1, '2025-04-19 03:47:00', '2025-04-19 03:47:00', 9, 'Isaac', 'Ca sĩ'),
(6, 'Lan Khuê hé lộ bí quyết giữ dáng sau sinh', 'lan-khue-bi-quyet-sau-sinh', 'Những chia sẻ hữu ích của Lan Khuê về việc lấy lại vóc dáng.', 'Các phương pháp tập luyện và chế độ ăn uống của siêu mẫu...', 'assets/celebrity/lankhue.jpg', 1300, 1, '2025-04-19 03:47:30', '2025-04-19 03:47:30', 10, 'Lan Khuê', 'Người mẫu'),
(7, 'Trấn Thành đạo diễn phim điện ảnh mới', 'tran-thanh-dao-dien-phim', 'Trấn Thành tiếp tục thử sức với vai trò đạo diễn.', 'Thông tin về dự án phim, dàn diễn viên và lịch chiếu dự kiến...', 'assets/celebrity/tranthanh.jpg', 1600, 1, '2025-04-19 03:48:00', '2025-04-19 03:48:00', 9, 'Trấn Thành', 'Diễn viên'),
(8, 'Mỹ Tâm tổ chức liveshow kỷ niệm sự nghiệp', 'my-tam-liveshow-ky-niem', 'Mỹ Tâm thông báo về liveshow đặc biệt đánh dấu chặng đường ca hát.', 'Chi tiết về thời gian, địa điểm và khách mời của liveshow...', 'assets/celebrity/mytam.jpg', 2000, 1, '2025-04-19 03:48:30', '2025-04-19 03:48:30', 10, 'Mỹ Tâm', 'Ca sĩ');

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
  `user_id` int(11) DEFAULT NULL,
  `match_date` datetime DEFAULT NULL,
  `teams` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `football_news`
--

INSERT INTO `football_news` (`football_news_id`, `title`, `slug`, `summary`, `content`, `image`, `view_count`, `is_published`, `created_at`, `updated_at`, `user_id`, `match_date`, `teams`) VALUES
(1, 'Kết quả trận đấu Manchester United vs Liverpool: Quỷ đỏ thua đậm', 'man-utd-vs-liverpool', 'Manchester United nhận thất bại nặng nề trước Liverpool trên sân nhà.', 'Diễn biến chi tiết của trận đấu, các bàn thắng và điểm nhấn...', 'assets/football/mu-liverpool.jpg', 2500, 1, '2025-04-19 03:41:00', '2025-04-19 03:41:00', 9, '2025-04-18 23:30:00', 'Manchester United vs Liverpool'),
(2, 'Arsenal ngược dòng đánh bại Tottenham trong trận derby Bắc London', 'arsenal-vs-tottenham', 'Arsenal đã có màn trình diễn ấn tượng để lội ngược dòng giành chiến thắng trước Tottenham.', 'Phân tích chiến thuật, các cầu thủ ghi bàn và những khoảnh khắc đáng chú ý...', 'assets/football/arsenal-tottenham.jpg', 2200, 1, '2025-04-19 03:41:30', '2025-04-19 03:41:30', 10, '2025-04-18 21:00:00', 'Arsenal vs Tottenham'),
(3, 'Real Madrid vô địch La Liga sớm 3 vòng đấu', 'real-madrid-vo-dich-la-liga', 'Real Madrid chính thức lên ngôi vô địch La Liga mùa giải 2024-2025.', 'Hành trình vô địch, những đóng góp của các cầu thủ chủ chốt...', 'assets/football/real-vcl.jpg', 2800, 1, '2025-04-19 03:42:00', '2025-04-19 03:42:00', 9, NULL, 'Real Madrid'),
(4, 'Bayern Munich giành chiến thắng nghẹt thở trước Borussia Dortmund', 'bayern-vs-dortmund', 'Trận cầu đỉnh cao giữa Bayern Munich và Borussia Dortmund kết thúc với chiến thắng sát nút cho Hùm xám.', 'Tường thuật trực tiếp, những pha bóng gay cấn và kết quả cuối cùng...', 'assets/football/bayern-dortmund.jpg', 2100, 1, '2025-04-19 03:42:30', '2025-04-19 03:42:30', 10, '2025-04-19 01:45:00', 'Bayern Munich vs Borussia Dortmund'),
(5, 'Lionel Messi lập hat-trick giúp PSG đè bẹp đối thủ', 'messi-hattrick-psg', 'Lionel Messi tiếp tục phong độ ấn tượng với một cú hat-trick trong trận đấu vừa qua.', 'Thống kê chi tiết về các bàn thắng và màn trình diễn của Messi...', 'assets/football/messi-psg.jpg', 2600, 1, '2025-04-19 03:43:00', '2025-04-19 03:43:00', 9, NULL, 'PSG'),
(6, 'Chelsea bất ngờ thua sốc trên sân nhà', 'chelsea-thua-soc', 'Chelsea đã phải nhận một thất bại khó tin ngay tại Stamford Bridge.', 'Phân tích nguyên nhân thất bại và những vấn đề của The Blues...', 'assets/football/chelsea-thua.jpg', 1900, 1, '2025-04-19 03:43:30', '2025-04-19 03:43:30', 10, '2025-04-19 02:00:00', 'Chelsea'),
(7, 'Cristiano Ronaldo ghi bàn thắng thứ 800 trong sự nghiệp', 'ronaldo-ban-thang-800', 'Cristiano Ronaldo đạt cột mốc lịch sử với bàn thắng thứ 800 trong sự nghiệp thi đấu chuyên nghiệp.', 'Nhìn lại hành trình sự nghiệp và những kỷ lục của Ronaldo...', 'assets/football/ronaldo-800.jpg', 3000, 1, '2025-04-19 03:44:00', '2025-04-19 03:44:00', 9, NULL, 'Cristiano Ronaldo'),
(8, 'Man City thắng đậm, tiến gần chức vô địch Ngoại hạng Anh', 'man-city-thang-dam', 'Manchester City có chiến thắng thuyết phục, củng cố vị trí đầu bảng.', 'Diễn biến trận đấu và cơ hội vô địch của Man City...', 'assets/football/mancity-thang.jpg', 2300, 1, '2025-04-19 03:44:30', '2025-04-19 03:44:30', 10, '2025-04-19 00:30:00', 'Manchester City');

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
  `user_id` int(11) DEFAULT NULL,
  `game_title` varchar(255) DEFAULT NULL,
  `platform` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `game_news`
--

INSERT INTO `game_news` (`game_news_id`, `title`, `slug`, `summary`, `content`, `image`, `view_count`, `is_published`, `created_at`, `updated_at`, `user_id`, `game_title`, `platform`) VALUES
(1, 'The Last of Us Part III được hé lộ tại sự kiện lớn', 'the-last-of-us-part-iii-he-lo', 'Naughty Dog chính thức công bố phần tiếp theo của tựa game đình đám The Last of Us.', 'Thông tin chi tiết về cốt truyện, nhân vật và gameplay...', 'assets/game/tlou3.jpg', 3500, 1, '2025-04-19 03:38:00', '2025-04-19 03:38:00', 9, 'The Last of Us Part III', 'PlayStation 5'),
(2, 'Cyberpunk 2077 Phantom Liberty nhận đánh giá tích cực từ giới phê bình', 'cyberpunk-2077-phantom-liberty-danh-gia', 'Bản mở rộng Phantom Liberty của Cyberpunk 2077 được khen ngợi về cốt truyện và cải tiến gameplay.', 'Tổng hợp các bài đánh giá từ các trang tin game uy tín...', 'assets/game/cp2077-dlc.jpg', 2800, 1, '2025-04-19 03:38:30', '2025-04-19 03:38:30', 10, 'Cyberpunk 2077 Phantom Liberty', 'PC, PlayStation 5, Xbox Series X|S'),
(3, 'God of War Ragnarök chuẩn bị ra mắt trên PC', 'god-of-war-ragnarok-pc', 'Sony thông báo God of War Ragnarök sẽ có phiên bản PC trong thời gian tới.', 'Ngày phát hành dự kiến, cấu hình yêu cầu và những cải tiến cho PC...', 'assets/game/gow-pc.jpg', 3200, 1, '2025-04-19 03:39:00', '2025-04-19 03:39:00', 9, 'God of War Ragnarök', 'PC'),
(4, 'Liên Minh Huyền Thoại cập nhật phiên bản mới với nhiều thay đổi', 'lien-minh-huyen-thoai-cap-nhat', 'Riot Games tung ra bản cập nhật lớn cho Liên Minh Huyền Thoại, mang đến nhiều tướng mới và chỉnh sửa cân bằng.', 'Chi tiết về các thay đổi, tướng mới và meta hiện tại...', 'assets/game/lol-update.jpg', 2500, 1, '2025-04-19 03:39:30', '2025-04-19 03:39:30', 10, 'Liên Minh Huyền Thoại', 'PC'),
(5, 'Elden Ring Shadow of the Erdtree ấn định ngày phát hành', 'elden-ring-shadow-of-the-erdtree', 'DLC được mong chờ nhất của Elden Ring cuối cùng cũng có ngày ra mắt chính thức.', 'Thông tin về cốt truyện, khu vực mới và những boss khủng...', 'assets/game/eldenring-dlc.jpg', 3800, 1, '2025-04-19 03:40:00', '2025-04-19 03:40:00', 9, 'Elden Ring Shadow of the Erdtree', 'PC, PlayStation 5, Xbox Series X|S'),
(6, 'Nintendo Switch thế hệ mới rò rỉ thông tin về cấu hình', 'nintendo-switch-moi-ro-ri', 'Những tin đồn mới nhất về cấu hình và tính năng của Nintendo Switch 2.', 'Phân tích các thông tin rò rỉ và dự đoán về thời điểm ra mắt...', 'assets/game/switch2.jpg', 2900, 1, '2025-04-19 03:40:30', '2025-04-19 03:40:30', 10, 'Nintendo Switch', 'Console'),
(7, 'Assassin\'s Creed Red hé lộ bối cảnh Nhật Bản thời phong kiến', 'assassins-creed-red-nhat-ban', 'Ubisoft chính thức giới thiệu Assassin\'s Creed Red lấy bối cảnh Nhật Bản.', 'Những hình ảnh đầu tiên, thông tin về nhân vật và gameplay...', 'assets/game/ac-red.jpg', 3100, 1, '2025-04-19 03:41:00', '2025-04-19 03:41:00', 9, 'Assassin\'s Creed Red', 'PC, PlayStation 5, Xbox Series X|S'),
(8, 'Starfield nhận bản cập nhật lớn, cải thiện hiệu năng', 'starfield-cap-nhat-hieu-nang', 'Bethesda phát hành bản vá lớn cho Starfield, tập trung vào việc tối ưu hóa hiệu suất.', 'Chi tiết về các cải tiến và những thay đổi khác trong bản cập nhật...', 'assets/game/starfield-update.jpg', 2700, 1, '2025-04-19 03:41:30', '2025-04-19 03:41:30', 10, 'Starfield', 'PC, Xbox Series X|S');

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`news_id`, `title`, `slug`, `summary`, `content`, `image`, `view_count`, `is_published`, `created_at`, `updated_at`, `user_id`) VALUES
(3, '12', NULL, '12', '12', '../assets/image67fb89dfb9bf9-Group 37845.png', 0, 1, '2025-04-13 09:54:39', '2025-04-13 09:54:39', NULL),
(5, '2323', NULL, '2332', '2323', '../assets/image67fb8b56e0f96-image 387.png', 3, 1, '2025-04-13 10:00:54', '2025-04-18 15:39:39', NULL),
(6, '1231', NULL, '2323', '3112212', '../assets/image68026ea079447-Acer_Wallpaper_03_5000x2814 - Copy.jpg', 1, 1, '2025-04-18 15:24:16', '2025-04-18 15:39:32', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_categories`
--

CREATE TABLE `news_categories` (
  `news_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Chỉ mục cho bảng `celebrity_news`
--
ALTER TABLE `celebrity_news`
  ADD PRIMARY KEY (`celebrity_news_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `football_news`
--
ALTER TABLE `football_news`
  ADD PRIMARY KEY (`football_news_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `game_news`
--
ALTER TABLE `game_news`
  ADD PRIMARY KEY (`game_news_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `news_categories`
--
ALTER TABLE `news_categories`
  ADD PRIMARY KEY (`news_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

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
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `celebrity_news`
--
ALTER TABLE `celebrity_news`
  MODIFY `celebrity_news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `football_news`
--
ALTER TABLE `football_news`
  MODIFY `football_news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `game_news`
--
ALTER TABLE `game_news`
  MODIFY `game_news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `celebrity_news`
--
ALTER TABLE `celebrity_news`
  ADD CONSTRAINT `celebrity_news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `football_news`
--
ALTER TABLE `football_news`
  ADD CONSTRAINT `football_news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `game_news`
--
ALTER TABLE `game_news`
  ADD CONSTRAINT `game_news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `news_categories`
--
ALTER TABLE `news_categories`
  ADD CONSTRAINT `news_categories_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
