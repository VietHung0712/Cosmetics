-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 11, 2025 lúc 01:03 PM
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
-- Cơ sở dữ liệu: `shop_mypham`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `administrator`
--

CREATE TABLE `administrator` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `administrator`
--

INSERT INTO `administrator` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL,
  `background_url` varchar(255) DEFAULT NULL,
  `theme_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`id`, `name`, `address`, `phone`, `icon_url`, `background_url`, `theme_url`) VALUES
(1, 'Judydoll', 'Trung Quốc', '0911223344', 'images/judydoll_icon.webp', 'images/judydoll_background.webp', 'images/judydoll_theme.webp'),
(2, 'Zeesea', 'Trung Quốc', '0922334455', 'images/zeesea_icon.webp', 'images/zeesea_background.webp', 'images/zeesea_theme.webp'),
(3, 'Perfect Diary', 'Trung Quốc', '0333456897', './images/perfectdiary_icon.webp', './images/perfectdiary_background.webp', './images/perfectdiary_theme.webp'),
(5, 'AESTURA VN', 'Việt Nam', '0954789327', './images/aesturavn_icon.webp', './images/aesturavn_background.webp', './images/aesturavn_theme.webp'),
(6, 'Wipro Việt Nam Chính Hãng', 'Pháp', '0963528741', './images/enchanteur_icon.webp', './images/enchanteur_background.webp', './images/enchanteur_theme.webp'),
(9, 'LABONNY', 'Anh', '0963258777', './images/labonny_icon.webp', './images/judydoll_background.webp', ''),
(10, 'CYDO', 'Anh', '0933654987', './images/cydo_icon.webp', './images/judydoll_background.webp', ''),
(11, 'ONAYA', 'Anh', '0987888809', './images/onaya_icon.webp', './images/judydoll_background.webp', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Son môi'),
(2, 'Phấn má'),
(3, 'Kem dưỡng'),
(5, 'Phấn nén'),
(6, 'Bút kẻ mắt'),
(7, 'Kem Lót'),
(8, 'Kem Nền'),
(9, 'Phấn mắt'),
(10, 'Dưỡng da'),
(11, 'Dưỡng ẩm'),
(12, 'Sữa rửa mặt'),
(13, 'Nước hoa'),
(14, 'Chống nắng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  `tilte` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `user`, `tilte`, `content`) VALUES
(1, 1, 'Xin chào!', 'Xin chào, rất vui được đến đây.'),
(2, 1, 'Xin chào!', 'Xin chào, rất vui được đến đây.'),
(3, 1, 'Xin chào!', 'Hello World!'),
(4, 1, 'Xin chào!', 'Hello World!'),
(5, 16, 'Bạn có bao nhiêu người', 'Xin chào, tôi muốn biết bạn có bao nhiêu người?'),
(6, 16, 'Hỏi vui', 'Bạn ăn cơm chưa?'),
(7, 16, 'Hỏi vui', 'Bạn ăn cơm chưa?'),
(8, 16, 'Hỏi vui', 'Bạn đang làm gì thế?'),
(9, 1, 'Xin chào!', 'Hello friends'),
(10, 1, 'Xin chào!', 'test');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flash_deal`
--

CREATE TABLE `flash_deal` (
  `id` int(10) NOT NULL,
  `product` int(10) NOT NULL,
  `discount` double DEFAULT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `flash_deal`
--

INSERT INTO `flash_deal` (`id`, `product`, `discount`, `starttime`, `endtime`) VALUES
(1, 1, 25, '09:00:00', '12:00:00'),
(2, 1, 10, '06:00:00', '09:00:00'),
(3, 2, 20, '12:00:00', '15:00:00'),
(4, 2, 40, '09:00:00', '12:00:00'),
(6, 1, 10, '09:00:00', '12:00:00'),
(7, 2, 10, '21:00:00', '24:00:00'),
(9, 30, 15, '18:00:00', '21:00:00'),
(10, 24, 20, '18:00:00', '21:00:00'),
(12, 30, 30, '06:00:00', '09:00:00'),
(13, 29, 20, '06:00:00', '09:00:00'),
(14, 28, 10, '06:00:00', '09:00:00'),
(15, 27, 15, '06:00:00', '09:00:00'),
(16, 21, 50, '06:00:00', '09:00:00'),
(17, 17, 25, '06:00:00', '09:00:00'),
(18, 17, 20, '09:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `categories` int(10) NOT NULL,
  `brand` int(10) NOT NULL,
  `review` text NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `categories`, `brand`, `review`, `image_url`) VALUES
(1, 'Phấn má hồng Pretty Blush Powder', 2, 1, 'Phấn má hồng xinh xắn mang lại màu sắc độc đáo có thể giúp tạo thêm vẻ ửng hồng tự nhiên cho má và dễ dàng hòa trộn lên da.\r\nBao bì nhỏ để cầm đi dễ dàng.\r\nPhấn má hồng xinh xắn mang lại màu sắc độc đáo có thể giúp tạo thêm vẻ ửng hồng tự nhiên cho má và dễ dàng hòa trộn lên da.', './images/judydollPM01_0.webp'),
(2, 'Merzy Soft Touch Lip Tint', 1, 1, 'Son môi màu Iced Tea Watery Lip Gloss là sản phẩm son kem bóng đình đám đến từ nhà JUDYDOLL. Với cảm hứng từ những ly trà trái cây mùa hè ngọt ngào, mát lạnh, Iced Tea Watery Lip Gloss mang đến những tông màu thời thượng nhưng cũng không kém phần mới mẻ và sảng khoái, như một làn gió mới thổi dịu cơn nóng mùa hè.', './images/judydollSM01_0.webp'),
(3, 'JUDYDOLL Phấn nén Soft & Velvet Matte Powder Found', 5, 1, 'JUDYDOLL Phấn phủ dạng bột che khuyết điểm kiềm dầu cố định lớp trang điểm lâu trôi 4g\r\n\r\n Phấn phủ dạng bột che khuyết điểm kiềm dầu cố định lớp trang điểm lâu trôi JUDYDOLL với các hạt phấn siêu mịn sẽ cho bạn lớp nền hoàn hảo, tan chảy vào da ngay khi sử dụng.', './images/judydollPN01_0.webp'),
(5, 'JUDYDOLL Son dưỡng có màu Judydoll Watery Glow Lip', 1, 1, 'Son màu có dưỡng Watery Glow Lipstick của nhà JUDYDOLL là thỏi son đình đám với khả năng cấp ẩm cho đôi môi mềm dịu mà vẫn lên màu môi tươi tắn, ngọt ngào như kẹo thạch.', './images/judydollSM02_0.webp'),
(6, 'JUDYDOLL Bút kẻ mắt nước Siêu mảnh Slim liquid eye', 6, 1, 'Bút Kẻ Mắt Judydoll Slim Liquid Eyeliner với đầu cọ siêu mảnh 0,014mm giúp kẻ những đường kẻ sắc nét. Bút kẻ mắt chất lượng cao, đường kẻ lâu trôi, bền màu suốt cả ngày. Đầu bút siêu mảnh tạo nên đường viền mắt tinh tế. Sản phẩm dễ dàng tẩy sạch bằng nước ấm.', './images/judydollKM01_0.webp'),
(7, 'JUDYDOLL Kem lót Judydoll Makeup Base', 7, 2, 'Kem Lót Mattifying Makeup Base của JUDYDOLL là sản phẩm kem lót dành cho da dầu đến hỗn hợp thiên dầu, giúp lớp nền mịn lì và bền màu suốt ngày dài.', './images/judydollKL01_0.webp'),
(8, 'Kem nền Zeesea dạng lỏng', 8, 2, '1. Trang điểm hoàn hảo, không nhờn, tinh tế và mịn màng.\r\n\r\n2. Tăng cường màu da. Màu da có thể được sửa đổi tùy theo các vấn đề về màu da khác nhau\r\n\r\n3. Trang điểm kiểm soát dầu. Trang điểm tươi tắn, giúp lớp trang điểm tự nhiên hơn', './images/zeeseaKN01_0.webp'),
(9, 'Kem nền dạng lỏng ZEESEA Kiểm soát dầu', 8, 2, 'Thích hợp cho da vàng và sẫm màu\r\n\r\n1. Lớp trang điểm hoàn hảo, không nhờn dính, tinh tế và mịn màng.\r\n\r\n2. Tăng cường tông màu da. Màu da có thể được thay đổi tùy theo các vấn đề về màu da khác nhau\r\n\r\n3. Trang điểm kiểm soát dầu. Lớp trang điểm tươi tắn, giúp lớp trang điểm tự nhiên hơn', './images/zeeseaCN01_0.webp'),
(10, 'Son kem lì ZEESEA', 1, 2, 'Tan vào môi như mousse\r\n\r\nLip mist tan chảy trong trang điểm\r\n\r\nKết cấu nhẹ và mượt , mịn và dễ tán đều như kem\r\n\r\nQuang học che giấu nếp nhăn trên môi\r\n\r\nBột hình cầu silica chiết suất thấp đi kèm với bộ lọc lấy nét mềm\r\n\r\nMàu sắc lâu trôi , để lại một kết thúc mờ đồng thời dưỡng ẩm cho đôi môi .\r\n\r\nMàu cố định và tạo màng không dễ phai và không bị đốm', './images/zeeseaSM1_0.webp'),
(11, 'Mascara ZEESEA kháng nước', 6, 2, 'Mascara chống thấm nước Zeesea Mascara lâu trôi 36H Smudge\r\n\r\nDùng dụng cụ uốn mi để cuộn tròn từ gốc đến ngọn lông mi, tiếp xúc đầu cọ với gốc lông mi và chải hướng lên dọc theo chiều lông mi mọc và lặp lại thao tác nếu cần.', './images/zeeseaKM01_0.webp'),
(12, 'Bút kẻ mắt trang điểm ZEESEA', 6, 2, 'Các đường nét với độ bão hòa cao mang lại trải nghiệm hình ảnh tuyệt đẹp và tạo ra một lớp trang điểm mắt sâu sắc và quyến rũ. \r\n\r\nĐịnh hình ngay với một nét kẻ.\r\n\r\nLên màu đầy đủ và nhanh khô.\r\n\r\nKhông thấm nước và chống nhòe, mịn và dạng lỏng.', './images/zeeseaKM02_0.webp'),
(13, 'Bảng phấn trang điểm mắt ZEESEA', 9, 2, 'Bảng phấn trang điểm mắt ZEESEA x Viện bảo tàng Anh Alice In Wonderland 9 màu sắc kết hợp.', './images/zeeseaPM01_0.webp'),
(14, 'Mascara Zeesea Chống Thấm Nước', 6, 2, '  Những sợi cọ mềm và dài, dễ tạo đôi mắt quyến rũ\r\n\r\n  Cọ nhẹ mềm mại dễ chuốt lông mi, tạo đôi mi cong dày tự nhiên.\r\n\r\n  Mascara đen 4D, tạo đôi mắt gợi cảm và trở thành quý cô quyến rũ.\r\n\r\n  Công thức uốn cong ma thuật, dễ dàng làm cong mi.\r\n\r\n  Mực dịu nhẹ, dễ tẩy trang, đáp ứng nhu cầu uốn cong lông mi của bạn.', './images/zeeseaKM03_0.webp'),
(15, 'Son kem PERFECT DIARY DreamMatte', 1, 3, 'Thành phần\r\n\r\n1.Octyldodecanol\r\n\r\n2.Chất béo trung tính Caprylic / CAPRIC\r\n\r\n3.Sáp tổng hợp, SILICA\r\n\r\n4. Khác', './images/perfectdiarySM01_0.webp'),
(16, 'Phấn phủ kiềm dầu PERFECT DIARY', 5, 3, '  Thành phần:\r\n\r\n  1. Octyldodecanol\r\n\r\n  2. Caprylic / CAPRIC TRIGLYCERIDE\r\n\r\n  3. Silica chung, SILICA\r\n\r\n  4. Khác', './images/perfectdiaryPN01_0.webp'),
(17, 'Kem dưỡng da PERFECT DIARY', 10, 3, 'Tính năng sản phẩm:\r\n\r\nĐặc điểm nổi bật:\r\n\r\n1. Làm sáng da tự nhiên. Sở hữu làn da trắng sáng một cách tự nhiên và trong suốt chỉ với 1 lần chạm. Với thành phần niacinamide giúp tăng cường khả năng dưỡng ẩm và làm đều màu da. \r\n\r\n2. Mỏng nhẹ, dễ tán đều. Chất kem lỏng nhẹ, không bết dính và thẩm thấu nhanh giúp da thông thoáng. \r\n\r\n3. Thành phần từ thực vật giữ độ ẩm cho da. Duy trì làn da tươi sáng và căng bóng tự nhiên. \r\n\r\nChứa 1.25% niacinamide (dưỡng trắng da mờ thâm), hoa anh đào, ngân nhĩ, hoa súng trắng (chứa nhiều thành phần tự nhiên, kết hợp dưỡng da và trang điểm trong một bước)\r\n\r\n4. Chỉ cần dùng sữa rửa mặt để làm sạch. \r\n\r\n*Hiệu quả sử dụng tùy thuộc vào từng cá nhân, môi trường khác nhau sẽ có kết quả khác nhau. ', './images/perfectdiaryDD01_0.webp'),
(18, 'Phấn Phủ Perfect Diary', 2, 3, '  Thành phần:\r\n\r\n  1.Talc 、\r\n\r\n  2.Boron NITRIDE 、\r\n\r\n  3.Silica 、\r\n\r\n  4.Caprylic / CAPRIC TRIGLYCERIDE 、\r\n\r\n  5.Glyceryl DIBEHENATE', './images/perfectdiaryPM01_0.webp'),
(19, 'Kem dưỡng ẩm AESTURA ATOBARRIER365', 11, 5, 'Kem dưỡng ẩm chuyên sâu với viên nang 3 lớp lipid có thể nhìn thấy được bằng mắt thường (công nghệ được cấp bằng sáng chế DERMAON®) giúp cung cấp độ ẩm tối ưu và chăm sóc, củng cố hàng rào bảo vệ da cho làn da yếu, nhạy cảm, da đang bị hoặc dễ bị kích ứng bởi các tác nhân bên ngoài môi trường.', './images/aesturavnDA01_0.webp'),
(20, 'Sữa rửa mặt  AESTURA ', 12, 5, 'Sữa rửa mặt tạo bọt giúp loại bỏ 98,7% các tạp chất, bụi bẩn nằm sâu trong lỗ chân lông, đồng thời  tăng cường hàng rào bảo vệ da.', './images/aesturavnRM01_0.webp'),
(21, 'Nước hoa bỏ túi EDT Enchanteur', 13, 6, 'Đặc điểm nổi bật:\r\n- Hương thơm ngọt ngào, tươi mát\r\n- Mùi hương bền lâu, có thể giữ\r\n- Tạo nét đẹp gợi cảm, ấn tượng của người phụ nữ\r\n- Thiết kế chai nhỏ gọn, xinh xắn', './images/enchanteurNH01_0.webp'),
(22, 'Nước hoa cao cấp Enchanteur Charming', 13, 6, 'Đặc điểm nổi bật\r\n\r\n- Hương thơm ngọt ngào, tươi mát\r\n\r\n- Mùi hương bền lâu, có thể giữ\r\n\r\n- Tạo nét đẹp gợi cảm, ấn tượng của người phụ nữ\r\n\r\n- Thiết kế chai nhỏ gọn, xinh xắn', './images/enchanteurNH02_0.webp'),
(23, 'Kem nền Perfect Diary dạng lỏng', 8, 3, 'Chiết xuất từ ​​Cơ thể lucidum Ganoderma, chiết xuất từ ​​Rễ nhân sâm, lô hội, chiết xuất ​​Lá, chiết xuất ​​Trà', './images/perfectdiaryKN01_0.webp'),
(24, 'Son môi PERFECT DIARY', 1, 3, ' Thiết kế giống như một tấm thiệp, chất son mịn như nhung, mờ, nhẹ', './images/perfectdiarySM02_0.webp'),
(25, 'Phấn phủ PERFECT DIARY PerfectStay chống thấm', 5, 3, '  Thành phần:\r\n\r\n  1. Octyldodecanol\r\n\r\n  2. Chất béo trung tính Caprylic / CAPRIC\r\n\r\n  3. Silica chung, SILICA\r\n\r\n  4. Khác', './images/perfectdiaryPN02_0.webp'),
(26, 'Kem lót PERFECT DIARY trang điểm cao cấp', 7, 3, '  Thành phần \"\r\n\r\n  1.Dimethicone\r\n\r\n  2.Phenyl TRIMETHICONE\r\n\r\n  3.Etylen / PROPYLENE COPOLYMER\r\n\r\n  4.Khác', './images/perfectdiaryKL01_0.webp'),
(27, 'Kem nền ZEESEA dạng sương mềm mại', 8, 2, 'Có thể dùng làm má hồng, bóng mắt, son môi\r\n\r\nMở khóa lớp trang điểm cùng màu trong không khí', './images/zeeseaKN02_0.webp'),
(28, 'Kem chống nắng dưỡng ẩm AESTURA DERMA UV365', 14, 5, 'Nếu bạn có làn da nhạy cảm và đang băn khoăn liệu làn da của mình có thể sử dụng được kem chống nắng hay không? Hoặc đang lo lắng vì lớp kem chống nắng hóa học có thể gây kích ứng, khô da hay làm cay mắt? Thì câu trả lời chính là nên sử dụng một sản phẩm chống nắng dịu nhẹ lành tính cho làn da bởi việc chống nắng bảo vệ làn da nhạy cảm là điều cần thiết. ', './images/aesturavnCN01_0.webp'),
(29, 'Kem dưỡng ẩm (dạng gel) Bio-Essence Bio-Water B5 M', 11, 6, 'Kem dưỡng ẩm Bio-Essence Bio-Water B5 Moisturizing gel 50gr/hũ', './images/enchanteurDA01_0.webp'),
(30, 'Nước hoa cao cấp EDP Enchanteur Luxe ', 13, 6, 'Nước hoa cao cấp ENCHANTEUR LUXE (50ml) – tuyệt tác từ những nhà điều hương hàng đầu thế giới, lấy cảm hứng từ Paris lộng lẫy, ghi dấu ấn ngọt ngào từ những xúc cảm không lời.', './images/wiproNH01_0.webp'),
(33, 'Kem chống nắng dưỡng ẩm AESTURA DERMA UV365 phiên bản mới', 14, 5, 'Chống năng, bảo vệ da khỏi ánh nắng mặt trời, dưỡng ẩm, bổ sung vitamin C cho da', './images/aesturavnCN01_1.webp'),
(34, 'Kem chống nắng Labonny', 14, 9, 'Giúp bảo vệ da trước tác động của ánh sáng mặt trời và tia UV. Cấp ẩm cho da giúp da mềm mịn hơn. Cung cấp các dưỡng chất giúp mang lại làn da trắng sáng mịn màng, giảm nếp nhăn chống lão hóa da.', './images/labonnyCN01_0.webp'),
(35, 'Sữa rửa mặt Labonny', 12, 9, 'Giúp làm sạch dầu nhờn, bụi bẩn trên bề mặt da. Giúp làm thông thoáng lỗ chân lông, hỗ trợ ngăn ngừa các tác nhân gây nên sự hình thành mụn trên da. Dưỡng ẩm giúp làn da mềm mại, mịn màng hơn.', './images/labonnyCRM1_0.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_image`
--

CREATE TABLE `product_image` (
  `id` int(10) NOT NULL,
  `product` int(10) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_image`
--

INSERT INTO `product_image` (`id`, `product`, `image_url`) VALUES
(1, 1, 'images/judydollPM01_1.webp'),
(2, 1, 'images/judydollPM01_2.webp'),
(3, 2, 'images/judydollSM01_1.webp'),
(4, 3, './images/judydollPN01_1.webp'),
(6, 3, './images/judydollPN01_2.webp'),
(7, 2, './images/judydollSM01_2.webp'),
(10, 5, './images/judydollSM02_1.webp'),
(11, 5, './images/judydollSM02_3.webp'),
(12, 6, './images/judydollKM01_1.webp'),
(13, 6, './images/judydollKM01_2.webp'),
(14, 7, './images/judydollKL01_1.webp'),
(15, 7, './images/judydollKL01_2.webp'),
(16, 8, './images/zeeseaKN01_1.webp'),
(17, 8, './images/zeeseaKN01_2.webp'),
(18, 10, './images/zeeseaSM1_1.webp'),
(19, 10, './images/zeeseaSM1_2.webp'),
(20, 10, './images/zeeseaSM1_3.webp'),
(21, 11, './images/zeeseaKM01_1.webp'),
(23, 11, './images/zeeseaKM01_2.webp'),
(24, 9, './images/zeeseaCN01_1.webp'),
(25, 9, './images/zeeseaCN01_2.webp'),
(26, 12, './images/zeeseaKM02_1.webp'),
(27, 12, './images/zeeseaKM02_12webp.webp'),
(28, 13, './images/zeeseaPM01_1.webp'),
(29, 13, './images/zeeseaPM01_2.webp'),
(30, 13, './images/zeeseaPM01_3.webp'),
(31, 14, './images/zeeseaKM03_1.webp'),
(32, 14, './images/zeeseaKM03_2.webp'),
(33, 14, './images/zeeseaKM03_2.webp'),
(34, 14, './images/zeeseaKM03_3.webp'),
(35, 15, './images/perfectdiarySM01_1.webp'),
(36, 15, './images/perfectdiarySM01_2.webp'),
(37, 16, './images/perfectdiaryPN01_1.webp'),
(38, 16, './images/perfectdiaryPN01_2.webp'),
(39, 17, './images/perfectdiaryDD01_1.webp'),
(40, 17, './images/perfectdiaryDD01_2.webp'),
(41, 18, './images/perfectdiaryPM01_1.webp'),
(42, 18, './images/perfectdiaryPM01_2.webp'),
(43, 19, './images/aesturavnDA01_1.webp'),
(44, 19, './images/aesturavnDA01_2.webp'),
(45, 20, './images/aesturavnRM01_1.webp'),
(46, 20, './images/aesturavnRM01_2.webp'),
(47, 21, './images/enchanteurNH01_1.webp'),
(48, 21, './images/enchanteurNH01_2.webp'),
(49, 22, './images/enchanteurNH02_1.webp'),
(50, 22, './images/enchanteurNH02_2.webp'),
(51, 23, './images/perfectdiaryKN01_1.webp'),
(52, 23, './images/perfectdiaryKN01_2.webp'),
(53, 24, './images/perfectdiarySM02_1.webp'),
(54, 24, './images/perfectdiarySM02_2.webp'),
(55, 25, './images/perfectdiaryPN02_1.webp'),
(56, 25, './images/perfectdiaryPN02_2.webp'),
(58, 26, './images/perfectdiaryKL01_1.webp'),
(59, 26, './images/perfectdiaryKL01_2.webp'),
(60, 27, './images/zeeseaKN02_1.webp'),
(61, 27, './images/zeeseaKN02_2.webp'),
(62, 28, './images/aesturavnCN01_1.webp'),
(63, 29, './images/enchanteurDA01_1.webp'),
(64, 29, './images/enchanteurDA01_2.webp'),
(65, 29, './images/enchanteurDA01_3.webp'),
(66, 30, './images/wiproNH01_1.webp'),
(67, 30, './images/wiproNH01_2.webp'),
(70, 33, './images/aesturavnCN01_0.webp'),
(71, 34, './images/labonnyCN01_1.webp'),
(72, 35, './images/labonnyCRM1_1.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_item`
--

CREATE TABLE `product_item` (
  `id` int(10) NOT NULL,
  `product` int(10) NOT NULL,
  `attributes` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `count` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_item`
--

INSERT INTO `product_item` (`id`, `product`, `attributes`, `price`, `count`) VALUES
(1, 2, 'Màu đỏ', 210000, 333),
(2, 2, 'Màu hồng', 210000, 300),
(3, 2, 'Màu cam', 200000, 200),
(4, 1, '100g', 200000, 100),
(5, 1, '120g', 240000, 200),
(12, 3, 'Màu hồng', 260000, 300),
(15, 5, 'Siêu dưỡng', 270000, 400),
(16, 5, 'Màu hồng', 260000, 400),
(17, 6, 'Nâu đậm', 180000, 300),
(18, 6, 'Đen', 170000, 3000),
(19, 7, 'Màu cam', 220000, 400),
(20, 7, 'Màu coffe', 215000, 300),
(21, 8, 'Da dầu', 100000, 300),
(22, 8, 'Da khô', 110000, 200),
(23, 10, 'Đỏ tươi', 210000, 300),
(24, 10, 'Đỏ sẫm', 210000, 300),
(25, 10, 'Đỏ cam', 220000, 300),
(26, 11, 'Gel - Đen', 90000, 200),
(27, 11, 'Gel - Nâu', 100000, 200),
(28, 9, '100g', 100000, 200),
(29, 9, '150g', 130000, 200),
(30, 12, 'Đen', 100000, 200),
(31, 12, 'Nâu', 110000, 300),
(32, 13, 'Bảng vừa', 120000, 100),
(33, 13, 'Bảng to', 150000, 150),
(34, 14, 'Đen huyền', 100000, 200),
(35, 14, 'Nâu đen', 110000, 100),
(36, 15, 'Đỏ tươi', 120000, 100),
(37, 15, 'Đỏ cam', 115000, 100),
(38, 15, 'Đỏ hồng', 125000, 150),
(39, 16, 'Kiềm dầu', 210000, 200),
(40, 17, '40g', 210000, 200),
(41, 18, '7g', 260000, 100),
(42, 19, '10ml', 75000, 100),
(43, 20, '30g', 75000, 100),
(44, 21, '18ml', 50000, 300),
(45, 22, '50ml', 230000, 300),
(46, 23, '30ml', 250000, 300),
(47, 24, '4ml', 240000, 300),
(48, 25, '7g', 280000, 300),
(49, 26, 'Cao cấp', 200000, 300),
(50, 26, 'Hoa oải hương', 210000, 200),
(51, 27, '3g', 120000, 200),
(52, 28, '1ml SPF50+ PA++++', 100000, 200),
(53, 29, '50g', 500000, 200),
(54, 30, '50g', 300000, 200),
(56, 33, 'Phiên bản mới', 150000, 200),
(57, 34, 'Chống nắng', 350000, 200),
(58, 35, 'Sữa rửa mặt', 200000, 200);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sales_invoices`
--

CREATE TABLE `sales_invoices` (
  `id` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sales_invoices`
--

INSERT INTO `sales_invoices` (`id`, `user`, `time`) VALUES
(1, 1, '2024-10-21 04:52:23'),
(2, 1, '2024-10-21 04:52:57'),
(3, 1, '2024-10-21 15:18:56'),
(4, 1, '2024-10-29 11:31:10'),
(5, 1, '2024-10-29 17:41:36'),
(6, 1, '2024-10-29 17:45:57'),
(7, 1, '2024-10-29 17:46:20'),
(8, 1, '2024-10-29 17:46:34'),
(9, 1, '2024-10-29 17:46:41'),
(10, 16, '2024-11-02 19:51:55'),
(11, 1, '2024-11-03 09:08:14'),
(12, 1, '2024-11-03 09:09:02'),
(13, 1, '2024-11-03 09:09:45'),
(14, 1, '2024-11-03 09:10:48'),
(15, 1, '2024-11-03 09:11:07'),
(16, 1, '2024-11-03 09:12:46'),
(17, 1, '2024-11-03 09:14:09'),
(18, 1, '2024-11-03 09:14:43'),
(19, 1, '2024-11-03 09:23:09'),
(20, 1, '2024-11-03 09:24:47'),
(21, 1, '2024-11-03 09:25:18'),
(22, 1, '2024-11-03 09:28:02'),
(23, 1, '2024-11-03 09:31:31'),
(24, 1, '2024-11-03 09:38:24'),
(25, 1, '2024-11-03 09:38:44'),
(26, 1, '2024-11-03 09:43:06'),
(27, 1, '2024-11-03 09:44:12'),
(28, 1, '2024-11-03 09:45:21'),
(29, 1, '2024-11-03 09:45:51'),
(30, 1, '2024-11-03 09:49:36'),
(31, 1, '2024-11-03 09:50:53'),
(32, 1, '2024-11-03 09:52:52'),
(33, 1, '2024-11-03 10:02:13'),
(34, 1, '2024-11-03 10:04:34'),
(35, 1, '2024-11-03 10:06:31'),
(36, 1, '2024-11-03 10:08:19'),
(37, 1, '2024-11-03 10:09:43'),
(38, 1, '2024-11-03 10:10:45'),
(39, 1, '2024-11-03 10:26:10'),
(40, 1, '2024-11-03 10:40:43'),
(41, 1, '2024-11-03 10:44:55'),
(42, 1, '2024-11-03 10:46:42'),
(43, 1, '2024-11-03 10:47:12'),
(44, 1, '2024-11-03 10:47:35'),
(45, 1, '2024-11-03 20:48:58'),
(46, 1, '2024-11-03 21:28:10'),
(47, 1, '2024-11-03 22:21:07'),
(48, 1, '2024-11-05 15:03:16'),
(49, 16, '2024-11-05 17:50:09'),
(50, 16, '2024-11-05 17:51:09'),
(51, 1, '2024-11-21 10:39:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sales_invoice_items`
--

CREATE TABLE `sales_invoice_items` (
  `id` int(10) NOT NULL,
  `sales_invoices` int(10) NOT NULL,
  `product_item` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sales_invoice_items`
--

INSERT INTO `sales_invoice_items` (`id`, `sales_invoices`, `product_item`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 200000),
(5, 1, 5, 2, 480000),
(7, 1, 3, 2, 400000),
(8, 4, 2, 1, 126000),
(9, 4, 5, 2, 480000),
(10, 5, 3, 1, 120000),
(11, 5, 5, 2, 480000),
(12, 6, 3, 1, 120000),
(13, 7, 5, 2, 480000),
(14, 8, 5, 2, 480000),
(15, 9, 5, 2, 480000),
(16, 10, 54, 1, 300000),
(17, 10, 53, 1, 500000),
(18, 10, 48, 1, 280000),
(19, 11, 12, 1, 260000),
(20, 12, 23, 1, 210000),
(21, 13, 23, 1, 210000),
(22, 14, 23, 1, 210000),
(23, 15, 23, 1, 210000),
(24, 16, 23, 1, 210000),
(25, 17, 23, 1, 210000),
(26, 18, 23, 1, 210000),
(27, 19, 23, 1, 210000),
(28, 20, 23, 1, 210000),
(29, 21, 23, 1, 210000),
(30, 22, 17, 1, 180000),
(31, 23, 36, 1, 120000),
(32, 24, 47, 1, 240000),
(33, 25, 47, 1, 240000),
(34, 26, 3, 1, 200000),
(35, 27, 3, 1, 200000),
(36, 28, 3, 1, 200000),
(37, 29, 54, 1, 300000),
(38, 30, 45, 1, 230000),
(39, 30, 54, 1, 300000),
(40, 31, 45, 1, 230000),
(41, 31, 54, 1, 300000),
(42, 32, 48, 1, 280000),
(43, 33, 40, 1, 210000),
(44, 34, 19, 1, 220000),
(45, 35, 46, 1, 250000),
(46, 36, 51, 1, 120000),
(47, 37, 45, 1, 230000),
(48, 38, 52, 1, 100000),
(49, 39, 28, 1, 100000),
(50, 40, 32, 2, 240000),
(51, 41, 41, 1, 260000),
(52, 42, 32, 1, 120000),
(53, 43, 44, 1, 50000),
(54, 44, 44, 1, 50000),
(55, 45, 53, 1, 500000),
(56, 46, 53, 1, 500000),
(57, 47, 48, 1, 280000),
(58, 48, 46, 1, 250000),
(59, 49, 48, 2, 560000),
(60, 49, 37, 1, 115000),
(61, 50, 53, 2, 1000000),
(62, 50, 54, 1, 300000),
(63, 51, 53, 3, 1500000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `displayname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `displayname`, `username`, `password`, `gender`, `address`, `phone`, `birthday`, `image_url`) VALUES
(1, 'TRANVIETHUNG', 'tranviethung712@gmail.com', '12345678', 'Nam', 'Quả Cảm, Hòa Long, Thành phố Bắc Ninh', '0369709603', '2003-12-07', 'images/ionia_emblem.png'),
(15, 'Demo', 'demo@gmail.com.vn', '12345678', 'Nam', '0', '0999999999', '2024-10-30', ''),
(16, 'QUYVUONGBN', 'quyvuongbn@gmail.com', '12345678', 'Nam', 'Bắc Ninh', '0369709603', '2003-12-07', './images/SGTitleCrest.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  `product_item` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_cart`
--

INSERT INTO `user_cart` (`id`, `user`, `product_item`, `quantity`) VALUES
(68, 1, 42, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_reviews`
--

CREATE TABLE `user_reviews` (
  `id` int(10) NOT NULL,
  `product` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  `rating` int(1) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `review_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_reviews`
--

INSERT INTO `user_reviews` (`id`, `product`, `user`, `rating`, `review_text`, `review_date`) VALUES
(1, 1, 1, 5, 'Màu xinh xỉu , hợp với da trắng , tạo cảm giác tự nhiên , hộp nhỏ nhỏ xinh xinh', '2024-10-21 10:33:34'),
(3, 1, 1, 4, 'Màu đẹp thanh lịch', '2024-10-22 10:10:51'),
(4, 2, 1, 5, 'Rất đẹp', '2024-10-29 19:03:52'),
(5, 1, 1, 5, 'Đẹp xinh tự nhiên', '2024-10-29 19:05:48'),
(6, 30, 16, 5, '', '2024-11-02 19:52:09'),
(7, 29, 16, 5, 'dưỡng ẩm tốt', '2024-11-02 19:52:35'),
(8, 25, 16, 5, 'đẹp xinh lắm!', '2024-11-02 19:52:55');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Chỉ mục cho bảng `flash_deal`
--
ALTER TABLE `flash_deal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_brand` (`brand`),
  ADD KEY `product_categories` (`categories`);

--
-- Chỉ mục cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_image` (`product`);

--
-- Chỉ mục cho bảng `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product`);

--
-- Chỉ mục cho bảng `sales_invoices`
--
ALTER TABLE `sales_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Chỉ mục cho bảng `sales_invoice_items`
--
ALTER TABLE `sales_invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_invoices_id` (`sales_invoices`),
  ADD KEY `product` (`product_item`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `product_item` (`product_item`);

--
-- Chỉ mục cho bảng `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `product` (`product`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `flash_deal`
--
ALTER TABLE `flash_deal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `product_item`
--
ALTER TABLE `product_item`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `sales_invoices`
--
ALTER TABLE `sales_invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `sales_invoice_items`
--
ALTER TABLE `sales_invoice_items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `user_reviews`
--
ALTER TABLE `user_reviews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `flash_deal`
--
ALTER TABLE `flash_deal`
  ADD CONSTRAINT `flash_deal_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_brand` FOREIGN KEY (`brand`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_categories` FOREIGN KEY (`categories`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_item`
--
ALTER TABLE `product_item`
  ADD CONSTRAINT `product_item_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sales_invoices`
--
ALTER TABLE `sales_invoices`
  ADD CONSTRAINT `sales_invoices_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_invoices_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sales_invoice_items`
--
ALTER TABLE `sales_invoice_items`
  ADD CONSTRAINT `sales_invoice_items_ibfk_1` FOREIGN KEY (`sales_invoices`) REFERENCES `sales_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_invoice_items_ibfk_2` FOREIGN KEY (`product_item`) REFERENCES `product_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cart_ibfk_2` FOREIGN KEY (`product_item`) REFERENCES `product_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD CONSTRAINT `user_reviews_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_reviews_ibfk_2` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
