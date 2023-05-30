-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 13, 2023 lúc 04:31 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `viettien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `MaBinhLuan` int(11) NOT NULL,
  `NoiDungBinhLuan` text DEFAULT NULL,
  `NgayBinhLuan` datetime DEFAULT NULL,
  `MaSP` int(11) DEFAULT NULL,
  `MaNguoiDung` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`MaBinhLuan`, `NoiDungBinhLuan`, `NgayBinhLuan`, `MaSP`, `MaNguoiDung`) VALUES
(1, 'Sản phẩm đẹp như hình, chất vải rất tốt, giao hàng rất nhanh và đóng hàng rất cẩn thận, rất hợp túi tiền. Mình đã sử dụng sản phẩm của Việt Tiến hơn 5 năm rồi nhưng chưa bao giờ Việt Tiến làm mình thất vọng, mong là sẽ có thêm nhiều đợt sale để mình còn săn sale keke, yêu shop!!!', '2023-04-24 11:09:05', 45, 2),
(2, 'Ai mua sản phẩm này rồi cho mình xin tí review về sản phẩm này với ạ, mình đang phân vân có nên mua hay không huhuuuu???', '2023-04-02 12:58:18', 45, 8),
(3, 'Đẹp quá mà chả có tiền mua huhu', '2023-04-18 13:01:13', 45, 7),
(7, 'xinh qua di nekk', '2023-04-25 21:25:55', 45, 2),
(9, 'cam on mng da ung ho', '2023-04-26 22:01:21', 45, 1),
(15, 'hehehehehehe', '2023-05-10 13:04:32', 45, 8),
(17, 'hehehehhee', '2023-05-10 21:13:36', 45, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `MaDonHang` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `Size` varchar(6) NOT NULL,
  `DonGia` int(11) DEFAULT NULL,
  `SoLuongDatMua` int(11) DEFAULT NULL,
  `ThanhTien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`MaDonHang`, `MaSP`, `Size`, `DonGia`, `SoLuongDatMua`, `ThanhTien`) VALUES
(1, 32, 'XL', 480000, 1, 480000),
(1, 32, 'XXL', 480000, 1, 480000),
(1, 33, '31', 550000, 1, 550000),
(1, 45, 'L', 2570000, 1, 2570000),
(1, 45, 'XXL', 2570000, 6, 15420000),
(2, 23, 'XL', 900000, 2, 1800000),
(3, 45, 'XL', 530000, 2, 1060000),
(4, 16, '10CM', 45000, 10, 450000),
(5, 45, 'L', 2570000, 1, 2570000),
(6, 20, '70cm', 650000, 1, 650000),
(8, 46, 'M', 2400000, 1, 2400000),
(9, 46, 'M', 2400000, 4, 9600000),
(10, 37, '30', 630000, 1, 630000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietsp`
--

CREATE TABLE `chitietsp` (
  `MaChiTietSP` int(11) NOT NULL,
  `ChiTietSP` varchar(300) DEFAULT NULL,
  `MaSP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietsp`
--

INSERT INTO `chitietsp` (`MaChiTietSP`, `ChiTietSP`, `MaSP`) VALUES
(356, 'Áo thun lót kiểu dáng đơn giản, có thể kết hợp với nhiều loại áo.', 1),
(357, 'Áo thun lót kiểu dáng đơn giản, có thể kết hợp với nhiều loại áo.', 2),
(358, 'Quần lót kiểu dáng đơn giản, thoải mái cho người mặc.', 4),
(359, 'Quần lót kiểu dáng đơn giản, thoải mái cho người mặc.', 5),
(360, 'Áo thun lót kiểu dáng đơn giản, có thể kết hợp với nhiều loại áo.', 6),
(361, 'Quần short Khaki với kiểu dáng đơn giản phù hợp với phong cách đường phố.', 7),
(362, 'Kiểu dáng Regular suông nhẹ, thoải mái cho người mặc.', 7),
(363, 'Quần short Khaki với kiểu dáng đơn giản phù hợp với phong cách đường phố.', 8),
(364, 'Kiểu dáng Slim Fit ôm nhẹ, thoải mái cho người mặc nhưng vẫn trẻ trung, thời trang.', 8),
(365, 'Quần short Khaki với kiểu dáng đơn giản phù hợp với phong cách đường phố.', 9),
(366, 'Kiểu dáng Regular Fit ôm nhẹ, thoải mái cho người mặc nhưng vẫn trẻ trung, thời trang.', 9),
(367, 'Quần Jeans là trang phục thông dụng nhất bởi những ưu điểm: bền, chắc, đẹp, mang lại cho bạn vẻ ngoài mạnh mẽ và năng động.', 10),
(368, 'Kiểu dáng Regular Fit suông nhẹ, thoải mái cho người mặc nhưng vẫn trẻ trung, thời trang.', 10),
(369, 'Quần Jeans là trang phục thông dụng nhất bởi những ưu điểm: bền, chắc, đẹp, mang lại cho bạn vẻ ngoài mạnh mẽ và năng động.', 11),
(370, 'Kiểu dáng Regular Fit suông nhẹ, thoải mái cho người mặc nhưng vẫn trẻ trung, thời trang.', 11),
(371, 'Quần Tây với kiểu dáng đơn giản, lịch lãm, phù hợp với môi trường công sở.', 12),
(372, 'Form dáng SLIMFIT ôm nhẹ với ống quần suông nhỏ đem lại sự trẻ trung và thời trang cho bạn.', 12),
(373, 'Quần Tây với kiểu dáng đơn giản, lịch lãm, phù hợp với môi trường công sở.', 13),
(374, 'Kiểu dáng Regular Fit ôm gọn, thoải mái cho người mặc.', 13),
(375, 'Quần Khaki với kiểu dáng đơn giản giúp bạn dễ dàng phối trang phục để phù hợp trong cả phong cách đường phố đến môi trường công sở.', 14),
(376, 'Kiểu dáng Regular suông nhẹ, thoải mái cho người mặc.', 14),
(377, 'Vớ ngắn kiểu dáng đơn giản, thanh lịch, có thể kết hợp với nhiều loại giày và trang phục.', 15),
(378, 'Phom vớ được thiết kế vừa khích với dáng chân của người mang, tạo cảm giác nâng đỡ và thoải mái.', 15),
(379, 'Vớ ngắn kiểu dáng đơn giản, thanh lịch, có thể kết hợp với nhiều loại giày và trang phục.', 16),
(380, 'Phom vớ được thiết kế vừa khích với dáng chân của người mang, tạo cảm giác nâng đỡ và thoải mái.', 16),
(381, 'Cà vạt thắt sẵn với dây kéo linh hoạt, kiểu dáng đơn giản, lịch lãm, phù hợp với nhiều phong cách trang phục khác nhau.', 17),
(382, 'Cà vạt với kiểu dáng đơn giản, lịch lãm, phù hợp với nhiều phong cách trang phục khác nhau.', 18),
(383, 'Cà vạt với kiểu dáng đơn giản, lịch lãm, phù hợp với nhiều phong cách trang phục khác nhau.', 19),
(384, 'Ví ngang kiểu dáng đơn giản, thanh lịch, phù hợp với nhiều loại trang phục, cho quý ông vẻ ngoài lịch lãm, sang trọng.', 20),
(385, 'Bên trong có nhiều ngăn tiện dụng, có thể đựng được các loại thẻ ngân hàng, tiền mặt cũng như danh thiếp.', 20),
(386, 'Áo thun Việt Tiến được thiết kế với form Regular rộng rãi, thoải mái cho người mặc.', 21),
(387, 'Cổ và tay áo được dệt borip bo viền sang trọng và lịch lã.', 21),
(388, 'Áo thun Việt Tiến được thiết kế với form Regular không ôm sát, thoải mái cho người mặc.', 22),
(389, 'Áo được xẻ gấu năng động nhưng vẫn chỉn chu, lịch lãm, thời trang với cổ và tay áo dệt borip bo viền.', 22),
(390, 'Áo thun Việt Tiến được thiết kế với form Regular không ôm sát, thoải mái cho người mặc.', 23),
(391, 'Áo được xẻ gấu năng động nhưng vẫn chỉn chu, lịch lãm, thời trang với cổ và tay áo dệt borip bo viền.', 23),
(392, 'Áo thun Việt Tiến được thiết kế với form Regular không ôm sát, thoải mái cho người mặc.', 24),
(393, 'Áo được xẻ gấu năng động nhưng vẫn chỉn chu, lịch lãm, thời trang với cổ và tay áo dệt borip bo viền.', 24),
(394, 'Áo thun nam có cổ chữ V, tay ngắn đơn giản nhưng lại toát lên vẻ lịch sự, năng động và trẻ trung.', 25),
(395, 'Áo sơ mi ngắn tay mang lại sự trẻ trung, năng động mà không kém phần lịch sự.', 26),
(396, 'Kiểu dáng Slimfit tôn dáng người mặc.', 26),
(397, 'Áo sơ mi dài tay chuẩn lịch lãm.', 27),
(398, 'Kiểu dáng SLIMFIT ôm gọn và tôn dáng, tạo hiệu ứng thời trang và thể thao.', 27),
(399, 'Áo sơ mi dài tay mang lại sự chỉnh chu, lịch sự nơi công sở.', 28),
(400, 'Kiểu dáng Regular rộng rãi thoải mái.', 28),
(401, 'Họa tiết Caro tạo sự mới mẻ, trẻ trung và thời trang.', 28),
(402, 'Áo sơ mi ngắn tay mang lại sự trẻ trung, năng động mà không kém phần lịch sự.', 29),
(403, 'Form dáng Slimfit ôm nhẹ tôn dáng người mặc.', 29),
(404, 'Áo sơ mi ngắn tay mang lại sự trẻ trung, năng động, lịch sự.', 30),
(405, 'Kiểu dáng Regular Fit vừa vặn, suông nhẹ, thoải mái cho người mặc.', 30),
(406, 'Họa tiết Caro mang lại sự mới mẻ, trẻ trung và thời trang.', 30),
(407, 'Áo sơ mi ngắn tay mang lại sự trẻ trung, năng động mà không kém phần lịch sự.', 31),
(408, 'Kiểu dáng Regular rộng rãi, thoải mái cho người mặc.', 31),
(409, 'Hoa văn tinh tế mang lại sự mới mẻ, trẻ trung và thời trang.', 31),
(410, 'Áo sơ mi ngắn tay mang lại sự trẻ trung, năng động mà không kém phần lịch sự.', 32),
(411, 'Kiểu dáng Regular rộng rãi, thoải mái cho người mặc.', 32),
(412, 'Màu trắng với họa tiết vân nổi lịch lãm, sang trọng.', 32),
(413, 'Quần Jeans là trang phục thông dụng nhất bởi những ưu điểm: bền, chắc, đẹp, mang lại cho bạn vẻ ngoài mạnh mẽ và năng động.', 33),
(414, 'Form Regular không ôm sát, thoải mái cho người mặc.', 33),
(415, 'Quần Jeans là trang phục thông dụng nhất bởi những ưu điểm: bền, chắc, đẹp, mang lại cho bạn vẻ ngoài mạnh mẽ và năng động.', 34),
(416, 'Form dáng SLIMFIT ôm nhẹ với ống quần suông nhỏ đem lại sự trẻ trung và thời trang cho bạn.', 34),
(417, 'Quần Jeans là trang phục thông dụng nhất bởi những ưu điểm: bền, chắc, đẹp, mang lại cho bạn vẻ ngoài mạnh mẽ và năng động.', 35),
(418, 'Kiểu dáng Regular Fit suông nhẹ, thoải mái cho người mặc nhưng vẫn trẻ trung, thời trang.', 35),
(419, 'Quần Jeans là trang phục thông dụng nhất bởi những ưu điểm: bền, chắc, đẹp, mang lại cho bạn vẻ ngoài mạnh mẽ và năng động.', 36),
(420, 'Form Regular không ôm sát, thoải mái cho người mặc.', 36),
(421, 'Quần Tây với kiểu dáng đơn giản, lịch lãm, phù hợp với môi trường công sở.', 37),
(422, 'Kiểu dáng Regular ống suông thoải mái cho người mặc.', 37),
(423, 'Quần Tây với kiểu dáng đơn giản, lịch lãm, phù hợp với môi trường công sở.', 38),
(424, 'Kiểu dáng Regular Fit suông nhẹ, thoải mái cho người mặc.', 38),
(425, 'Quần Tây với kiểu dáng đơn giản, lịch lãm, phù hợp với môi trường công sở.', 39),
(426, 'Kiểu dáng Regular Fit với thiết kế 0 ly không ôm sát thời trang, trẻ trung.', 39),
(427, 'Quần Tây với kiểu dáng đơn giản, lịch lãm, phù hợp với môi trường công sở.', 40),
(428, 'Kiểu dáng Regular Fit suông nhẹ, thoải mái cho người mặc.', 40),
(429, 'Quần Tây với kiểu dáng đơn giản, lịch lãm, phù hợp với môi trường công sở.', 41),
(430, 'Kiểu dáng Regularfit ôm vừa phải, thoải mái cho người mặc.', 41),
(431, 'Áo Vest Việt Tiến phom Slim Fit giúp quý ông luôn lịch lãm, chuyên nghiệp, sang trọng và thoải mái phù hợp khi gặp gỡ đối tác hoặc tham dự các sự kiện trang trọng. Sản phẩm được phân phối tại các cửa hàng Việt Tiến trên toàn quốc.', 42),
(432, 'Áo Vest Việt Tiến phom Slim Fit giúp quý ông luôn lịch lãm, chuyên nghiệp, sang trọng và thoải mái phù hợp khi gặp gỡ đối tác hoặc tham dự các sự kiện trang trọng. Sản phẩm được phân phối tại các cửa hàng Việt Tiến trên toàn quốc.', 43),
(433, 'Áo Vest Việt Tiến phom Slim Fit giúp quý ông luôn lịch lãm, chuyên nghiệp, sang trọng và thoải mái phù hợp khi gặp gỡ đối tác hoặc tham dự các sự kiện trang trọng. Sản phẩm được phân phối tại các cửa hàng Việt Tiến trên toàn quốc.', 44),
(434, 'Áo Vest Việt Tiến phom Slim Fit giúp quý ông luôn lịch lãm, chuyên nghiệp, sang trọng và thoải mái phù hợp khi gặp gỡ đối tác hoặc tham dự các sự kiện trang trọng. Sản phẩm được phân phối tại các cửa hàng Việt Tiến trên toàn quốc.', 45),
(435, 'Áo Vest Việt Tiến phom Slim Fit giúp quý ông luôn lịch lãm, chuyên nghiệp, sang trọng và thoải mái phù hợp khi gặp gỡ đối tác hoặc tham dự các sự kiện trang trọng. Sản phẩm được phân phối tại các cửa hàng Việt Tiến trên toàn quốc.', 46);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `MaDonHang` int(11) NOT NULL,
  `MaNguoiDung` int(11) DEFAULT NULL,
  `TenNguoiNhan` varchar(200) DEFAULT NULL,
  `SDTNhanHang` varchar(20) DEFAULT NULL,
  `DiaChiGiaoHang` varchar(200) DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `TrangThaiDonHang` varchar(50) DEFAULT 'Giỏ hàng',
  `NgayLap` datetime DEFAULT NULL,
  `PhiShip` int(11) NOT NULL,
  `TongTien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`MaDonHang`, `MaNguoiDung`, `TenNguoiNhan`, `SDTNhanHang`, `DiaChiGiaoHang`, `Note`, `TrangThaiDonHang`, `NgayLap`, `PhiShip`, `TongTien`) VALUES
(1, 2, 'Trần Khánh Băng', '0933156827', 'ấp mới 2, internet X game (từ ngã 3 Mỹ Hạnh chạy về Mỹ Hạnh Nam khoảng 400m), Xã Mỹ Hạnh Nam, Huyện Đức Hòa, Long An', 'Vui lòng nhẹ tay', 'Giỏ hàng', '2023-04-17 19:44:36', 75000, 19575000),
(2, 2, 'Bùi Quốc Tâm', '0933156827', 'ấp mới 2, internet X game (từ ngã 3 Mỹ Hạnh chạy về Mỹ Hạnh Nam khoảng 400m), Xã Mỹ Hạnh Nam, Huyện Đức Hòa, Long An', 'Vui lòng nhẹ tay', 'Đã hoàn tất', '2023-04-17 19:44:36', 15000, 1815000),
(3, 2, 'Trần Khánh Băng', '0703025047', '164/46 Đặng Thúc Vịnh, Xã Thới Tam Thôn, Huyện Hóc Môn, TPHCM', 'Vui lòng nhẹ tay', 'Đã hoàn tất', '2023-04-17 19:44:36', 15000, 1075000),
(4, 2, 'Đặng Quang Trung', '0361254852', 'Công ty Osprey, Nguyễn Văn Bứa, Xã Xuân Thới Sơn, Huyện Hóc Môn, TPHCM', 'Vui lòng nhẹ tay', 'Đang chờ xác nhận', '2023-04-17 19:44:36', 15000, 465000),
(5, 8, 'Nguyễn Thị Thanh', '0956842564', 'TPHCM', NULL, 'Đang chờ xác nhận', '0000-00-00 00:00:00', 15000, 2585000),
(6, 4, 'Nguyễn Thanh Đàn', '0258469752', 'Khánh Hòa', NULL, 'Giỏ hàng', '0000-00-00 00:00:00', 15000, 665000),
(7, 6, 'Trần Công Đức', '0964851265', '123C, Phường Phúc Xá, Quận Ba Đình, Thành phố Hà Nội', NULL, 'Giỏ hàng', '0000-00-00 00:00:00', 0, NULL),
(8, 8, 'Nguyễn Thị Thùy Trang', '0102030405', '145C, Xã Hòa Phú, Huyện Củ Chi, Thành phố Hồ Chí Minh', NULL, 'Đang chờ xác nhận', '0000-00-00 00:00:00', 15000, 2415000),
(9, 8, 'Nguyễn Thị Thanh', '0956842564', 'TPHCM', NULL, 'Giỏ hàng', '2023-05-11 21:56:49', 15000, 9615000),
(10, 11, 'Nguyễn Thành Văn', '0383633081', 'Ấp Mới 2, Xã Mỹ Hạnh Nam, Huyện Đức Hòa, Tỉnh Long An', NULL, 'Đang chờ xác nhận', '0000-00-00 00:00:00', 15000, 645000),
(11, 11, 'Nguyễn Thành Văn', '0383633081', 'Ấp Mới 2, Xã Mỹ Hạnh Nam, Huyện Đức Hòa, Tỉnh Long An', NULL, 'Giỏ hàng', '2023-05-13 20:59:02', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanche`
--

CREATE TABLE `hanche` (
  `MaHanChe` int(11) NOT NULL,
  `TenHanChe` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hanche`
--

INSERT INTO `hanche` (`MaHanChe`, `TenHanChe`) VALUES
(1, 'Khóa bình luận'),
(2, 'Khóa đăng nhập'),
(3, 'Khóa đặt hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanchenguoidung`
--

CREATE TABLE `hanchenguoidung` (
  `MaNguoiDung` int(11) NOT NULL,
  `MaHanChe` int(11) NOT NULL,
  `ThoiGianKetThuc` datetime DEFAULT NULL,
  `LiDo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hanchenguoidung`
--

INSERT INTO `hanchenguoidung` (`MaNguoiDung`, `MaHanChe`, `ThoiGianKetThuc`, `LiDo`) VALUES
(5, 1, '2023-06-01 16:41:33', 'Dùng từ ngữ thô tục, xúc phạm, công kích cá nhân'),
(5, 2, '2023-03-08 21:14:00', '1'),
(5, 3, '2023-05-05 16:42:10', 'Hủy nhiều đơn hàng trong thời gian ngắn'),
(6, 1, '2023-07-01 16:42:23', 'Dùng từ ngữ thô tục, xúc phạm, công kích cá nhân'),
(6, 2, '2023-04-06 21:35:00', 'a'),
(6, 3, '2023-05-11 16:43:15', 'Dùng từ ngữ thô tục, xúc phạm, công kích cá nhân'),
(7, 2, '2023-05-11 16:43:33', 'Dùng từ ngữ thô tục, xúc phạm, công kích cá nhân');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoaiSP` int(11) NOT NULL,
  `TenLoaiSP` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`MaLoaiSP`, `TenLoaiSP`) VALUES
(1, 'Đồ lót'),
(2, 'Quần short'),
(3, 'Quần kaki'),
(4, 'Phụ trang'),
(5, 'Áo thun'),
(6, 'Áo sơ mi'),
(7, 'Quần jean'),
(8, 'Vest/Bộ Vest'),
(9, 'Quần tây');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaithongbao`
--

CREATE TABLE `loaithongbao` (
  `maloaithongbao` int(11) NOT NULL,
  `tenloai` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `loaithongbao`
--

INSERT INTO `loaithongbao` (`maloaithongbao`, `tenloai`) VALUES
(1, 'thích bình luận'),
(2, 'thích phản hồi'),
(3, 'trả lời bình luận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaNguoiDung` int(11) NOT NULL,
  `TenNguoiDung` varchar(100) DEFAULT NULL,
  `DiaChi` varchar(200) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `SDT` varchar(20) DEFAULT NULL,
  `Avatar` varchar(200) NOT NULL,
  `TaiKhoan` varchar(100) DEFAULT NULL,
  `MatKhau` varchar(50) DEFAULT NULL,
  `TrangThai` varchar(20) DEFAULT NULL,
  `MaQuyen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`MaNguoiDung`, `TenNguoiDung`, `DiaChi`, `Email`, `SDT`, `Avatar`, `TaiKhoan`, `MatKhau`, `TrangThai`, `MaQuyen`) VALUES
(1, 'Nguyễn Thành Văn', 'Long An', 'ntvan39a7@gmail.com', '0383633081', 'avt.jpg', 'Admin', '123', 'Bình thường', 1),
(2, 'Hứa Hiền Vinh', 'TPHCM', '40.huahienvinh.97@gmail.com', '0906276846', 'gamer2.png', 'vinh', '123123', 'Bình thường', 2),
(3, 'Trần Văn Thông', 'TPHCM', 'thong@gmail.com', '0358964215', 'man5.png', 'thong', '123', 'Bình thường', 2),
(4, 'Nguyễn Thanh Đàn', 'Khánh Hòa', 'dan@gmail.com', '0258469752', 'man4.jpg', 'dan', '123', 'Bình thường', 2),
(5, 'Huỳnh Thanh Nhã', 'Bình Dương', 'nha@gmail.com', '0936584625', 'man3.png', 'nha', '123', 'Bình thường', 2),
(6, 'Trần Công Đức', '123C, Phường Phúc Xá, Quận Ba Đình, Thành phố Hà Nội', 'duccc@gmail.com', '0964851666', '1683682432_brand-banner-viettien.png', 'duc', '123', 'Bình thường', 2),
(7, 'Võ Thanh Công', 'An Giang', 'cong@gmail.com', '0984563251', 'man.png', 'cong', '123', 'Khóa', 2),
(8, 'Nguyễn Thị Thanh', 'TPHCM', 'thanh@gmail.com', '0956842564', 'girl.png', 'thanh', '123', 'Bình thường', 2),
(9, 'Võ Ngọc Thảo', 'Cà Mau', 'thao@gmail.com', '0986521456', 'lady.png', 'thao', '123', 'Bình thường', 2),
(10, 'Trần Thảo Nguyên', 'TPHCM', 'thong@gmail.com', '0365894521', 'lady2.png', 'nguyen', '123', 'Bình thường', 2),
(11, 'Nguyễn Thành Văn', NULL, 'ntvan39a7@gmail.com', NULL, 'couple.png', 'van', '123123', 'Bình thường', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `MaQuyen` int(11) NOT NULL,
  `TenQuyen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`MaQuyen`, `TenQuyen`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(200) DEFAULT NULL,
  `MaLoaiSP` int(11) DEFAULT NULL,
  `GiaBan` int(11) DEFAULT NULL,
  `GiaSale` int(11) DEFAULT NULL,
  `MauSac` varchar(50) DEFAULT NULL,
  `ChatLieu` varchar(100) DEFAULT NULL,
  `KieuDang` varchar(100) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `HinhAnh` varchar(200) DEFAULT NULL,
  `NgayTao` date DEFAULT NULL,
  `NgayCapNhat` date DEFAULT NULL,
  `TrangThai` varchar(200) DEFAULT NULL,
  `HoaTiet` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `MaLoaiSP`, `GiaBan`, `GiaSale`, `MauSac`, `ChatLieu`, `KieuDang`, `SoLuong`, `HinhAnh`, `NgayTao`, `NgayCapNhat`, `TrangThai`, `HoaTiet`) VALUES
(1, 'ÁO THUN LÓT 3 LỖ NAVY 6N9607NH1/T3', 1, 135000, 135000, 'Navy', '100% COTTON', 'Không', 100, 'ao3lo_navy.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(2, 'ÁO THUN LÓT 3 LỖ WHITE 6N9606NH0/T3', 1, 99000, 95000, 'Trắng', '100% COTTON', 'Không', 100, 'ao3lo_trang.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(4, 'QUẦN LÓT BRIEF BLACK 6N9715NH1/QLO2', 1, 125000, 120000, 'Đen', '95% COTTON-5% SPANDEX', 'Không', 100, 'quanlot_den.png', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(5, 'QUẦN LÓT BRIEF BLUE 6J9755CH1/QL2', 1, 125000, 120000, 'Xanh dương', '95% COTTON-5% SPANDEX', 'Không', 100, 'quanlot_xanh.png', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(6, 'ÁO THUN LÓT 3 LỖ BLACK 6N9611NH1/T3', 1, 135000, 130000, 'Đen', '100% COTTON', 'Không', 100, 'ao3lo_den.png', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(7, 'QUẦN SHORT KHAKI BLACK 6P8122NK4/QSK', 2, 475000, 450000, 'Đen', '60% COTTON - 35% NILON - 5% ELASTAN', 'REGULAR', 100, 'quanshort_den.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(8, 'QUẦN SHORT KHAKI PALE YELLOW 6N8058NT4/QSKS', 2, 445000, 435000, 'Da', '100% COTTON', 'SLIMFIT', 100, 'quanshort_da.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(9, 'QUẦN SHORT KHAKI RED ORANGE 6N8053NT4/QSKF', 2, 460000, 450000, 'Cam Đất', '53%COTTON-45%MICRO-2%SPANDEX', 'REGULARFIT', 100, 'quanshort_camdat.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Hoa văn'),
(10, 'QUẦN SHORT JEAN NAVY 6N8301NH4/QSJF', 2, 475000, 450000, 'Xanh Navy', '98%COTTON-2%SPANDEX', 'REGULARFIT', 100, 'quanshort_jean.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(11, 'QUẦN SHORT JEAN 6N8306NH4/QSJF', 2, 475000, 450000, 'Xanh Navy', '62% COTTON, 25% POLY, 12% RAYON, 1% SPANDEX', 'REGULARFIT', 100, 'quanshort_jeann.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(12, 'QUẦN KHAKI 0 LY 6Q6137NSV/K0LV', 3, 695000, 690000, 'BEIGE', '97% COTTON - 3% SPANDEX', 'SLIMFIT', 100, 'quankaki_be.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(13, 'QUẦN KHAKI 0 LY 1P6038NT6/QK0B', 3, 630000, 620000, 'BLACK/M', '100% COTTON.', 'REGULAR FIT – 0 LY', 100, 'quankaki_den.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(14, 'QUẦN KHAKI 1 LY 1N6043NT6/QK1L', 3, 659000, 640000, 'Xám', '100% COTTON.', 'REGULAR - 1 LY', 100, 'quankaki_xam.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(15, 'VỚ XÁM NGẮN 13CM 6J9609CH0/VN', 4, 50000, 45000, 'Xám', '80% COTTON-15% SPANDEX-5% RUBBER.', 'Không', 100, 'vo_xam.png', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(16, 'VỚ XÁM NGẮN 10CM 6J9587CH0/VN', 4, 50000, 45000, 'Xám', '80% COTTON-15% SPANDEX-5% RUBBER.', 'Không', 100, 'vo_10.png', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(17, 'CÀ VẠT DÂY KÉO 7.5 CM 1P9103NRY/CV759 RED', 4, 199000, 190000, 'Red', '100% MICROFIBER', 'Không', 100, 'cavatdo.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(18, 'CÀ VẠT 5.5CM 1N9032NH1/CVM NAVY-SKY BLUE', 4, 189000, 180000, 'Blue', '100% MICROFIBER', 'Không', 100, 'cavatcaro.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(19, 'CÀ VẠT 6CM 1N9033NH1/CVM D.GREEN', 4, 199000, 190000, 'Green', '100% MICROFIBER', 'Không', 100, 'cavatgreen.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(20, 'DÂY LƯNG ĐẦU TĂNG 1N9350NH6/DL', 4, 665000, 650000, 'Nâu', '100% da bò', 'Không', 100, 'thatlung.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(21, 'ÁO THUN CÓ CỔ 6Q3010CRV/P151', 5, 660000, 640000, 'Vàng', '100% COTTON.', 'REGULAR – CÓ CỔ', 100, 'aothun_vang.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Hoa văn'),
(22, 'ÁO THUN CÓ CỔ 6R3101CRV/P13C', 5, 620000, 600000, 'BLUE - NAVY', '95% COTTON - 5% SPANDEX.', 'REGULAR – CÓ CỔ', 100, 'aothun_navy.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Hoa văn'),
(23, 'ÁO THUN CÓ CỔ 6P3123CH9/SP5', 5, 960000, 900000, 'BLUE', '100% COTTON.', 'REGULAR – CÓ CỔ', 100, 'aothun_xanh.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(24, 'ÁO THUN CÓ CỔ 6Q3011CRV/P151', 5, 660000, 650000, 'BROWN', '100% COTTON.', 'REGULAR – CÓ CỔ', 100, 'aothun_nau.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(25, 'ÁO THUN KHÔNG CỔ 6N4002NT3/ST2', 5, 339000, 330000, 'Xám Melange', '92% COTTON, 8% SPANDEX.', 'Áo cổ chữ V', 100, 'aothun_xam.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(26, 'ÁO SƠ MI NGẮN TAY LAI BẦU 8N0191NT4/S5V', 6, 495000, 490000, 'BORDEAUX', '49%BAMBOO - 49%SPUN - 2% SPANDEX.', 'SLIMFIT - Lai bầu', 100, 'aosomi_do.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(27, 'ÁO SƠ MI DÀI TAY LAI BẦU 8N1006NT3/L2P', 6, 350000, 330000, 'Đỏ gạch', '65% POLYESTER, 35% COTTON', 'SLIMFIT - Lai bầu', 100, 'aosomi_hong.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(28, 'ÁO SƠ MI DÀI TAY LAI BẦU 6P0453NRK/LB41', 6, 550000, 530000, 'NAVY - ORANGE', '100% COTTON', 'REGULAR - Lai bầu', 100, 'aosomitaydai.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(29, 'ÁO SƠ MI NGẮN TAY LAI NGANG 1Q0841NSV/SN5P', 6, 495000, 490000, 'WHITE-BLUE', '35%BAMBOO-50%SPUN – 12% RAYON – 3% SPANDEX', 'SLIMFIT - Lai ngang', 100, 'aosomi_xanh.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Hoa văn'),
(30, 'ÁO SƠ MI NGẮN TAY LAI BẦU 8N0058NT3/S4V', 6, 395000, 380000, 'Xanh biển đậm', '40% MODAL, 39% SPUN, 21% COTTON', 'SLIMFIT - Lai bầu', 100, 'aosomi_caro.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(31, 'ÁO SƠ MI NGẮN TAY LAI NGANG 6N0284NT6/SN5', 6, 395000, 380000, 'BROWN/HV', '100% COTTON.', 'REGULAR - Lai ngang', 100, 'aosomi_dat.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Hoa văn'),
(32, 'ÁO SƠ MI NGẮN TAY LAI NGANG 6N0268NT4/SN8', 6, 497000, 480000, 'WHITE/D', '60% COTTON - 40% POLY.', 'REGULAR - Lai ngang', 100, 'aosomi_trang.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(33, 'QUẦN JEAN 6N7075NH5/QJ', 7, 590000, 550000, 'Xanh Navy', '70% COTTON, 20% POLY, 8% RAYON, 2% SPANDEX', 'REGULAR', 100, 'jean.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(34, 'QUẦN JEAN 6N7935NH5/QJS', 7, 580000, 550000, 'Xanh Navy', '92% COTTON, 6% POLY, 2% SPANDEX', 'SLIMFIT', 100, 'quanjean.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(35, 'QUẦN JEAN 6N7556NH5/QJF', 7, 580000, 550000, 'Xanh Navy nhạt', '98% COTTON, 2% SPANDEX', 'REGULARFIT', 100, 'jeannavy.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(36, 'QUẦN JEAN 6N7554NH5/QJF', 7, 580000, 550000, 'Xanh Navy', '92%COTTON-6%POLY-2%SPANDEX', 'REGULARFIT', 100, 'jeanxanh.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(37, 'QUẦN TÂY 0 LY 1R4078NR1/Q0NL', 9, 650000, 630000, 'Xanh Navy', '69%POLY-29%RAYON-2%LYCRA', 'REGULAR – 0 LY', 100, 'taynavy.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(38, 'QUẦN TÂY 0 LY 8N4111NT5/QT0S', 9, 540000, 520000, 'BROWN', '80% POLYESTER - 20% RAYON', 'REGULAR  FIT – 0 LY', 100, 'taynau.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Sọc'),
(39, 'QUẦN TÂY 0 LY 8N4066NT4/QT0B', 9, 495000, 490000, 'BLACK', '65% POLY - 35% RAYON', 'REGULAR  FIT – 0 LY', 100, 'tayden.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(40, 'QUẦN TÂY 0 LY 8N4120NT5/QT0L', 9, 580000, 520000, 'Light Blue', '81% POLYESTER, 17% RAYON, 2% SPANDEX', 'REGULARFIT', 100, 'tayxam.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(41, 'QUẦN TÂY 0 LY 8N4041NT5/QT0L', 9, 580000, 550000, 'Be', '76%POLY-21%RAYON-3%SPANDEX', 'REGULARFIT', 100, 'taybe.jpg', '2023-03-24', '2023-03-24', 'Kích hoạt', 'Màu trơn'),
(42, 'ÁO VEST 8G9020CT2/B12', 8, 2450000, 2430000, 'Xám', '70%POLY - 30%RAYON', 'SLIM FIT', 100, 'vest_xam.jpg', '2023-03-29', '2023-03-29', 'Kích hoạt', 'Màu trơn'),
(43, 'ÁO VEST 8G9016CT2/B12', 8, 2340000, 2310000, 'Nâu', '80%POLY - 20%RAYON', 'REGULAR', 100, 'vest_nau.jpg', '2023-03-29', '2023-03-29', 'Kích hoạt', 'Màu trơn'),
(44, 'ÁO VEST 8G9063CT2/B22', 8, 2370000, 2350000, 'Nâu Đất', '65%POLY - 35%RAYON', 'REGULAR', 100, 'vest_naudat.jpg', '2023-03-29', '2023-03-29', 'Kích hoạt', 'Sọc'),
(45, 'ÁO VEST 1E9532CT2/C22', 8, 2585000, 2570000, 'Navy', '80%POLYESTER - 20%RAYON', 'REGULAR', 100, 'vest_navy.jpg', '2023-03-29', '2023-03-29', 'Kích hoạt', 'Màu trơn'),
(46, 'ÁO VEST 8G9031CT2/B12', 8, 2410000, 2400000, 'Hồng', '65%POLY - 35%RAYON', 'REGULAR', 100, 'vest_hong.jpg', '2023-03-29', '2023-03-29', 'Kích hoạt', 'Sọc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanphamdaxem`
--

CREATE TABLE `sanphamdaxem` (
  `masp` int(11) NOT NULL,
  `manguoidung` int(11) NOT NULL,
  `ngayxem` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `sanphamdaxem`
--

INSERT INTO `sanphamdaxem` (`masp`, `manguoidung`, `ngayxem`) VALUES
(2, 2, '2023-05-03 17:02:27'),
(12, 1, '2023-05-05 21:52:19'),
(12, 2, '2023-05-03 16:32:08'),
(14, 2, '2023-05-03 16:32:08'),
(15, 2, '2023-05-03 17:02:38'),
(20, 2, '2023-05-04 22:06:29'),
(20, 4, '2023-05-13 20:51:59'),
(21, 2, '2023-05-03 17:01:41'),
(23, 2, '2023-05-05 21:47:59'),
(24, 2, '2023-05-04 22:06:26'),
(26, 2, '2023-05-03 17:02:45'),
(27, 2, '2023-05-03 17:07:32'),
(32, 2, '2023-05-04 22:17:23'),
(33, 2, '2023-05-04 22:06:39'),
(37, 11, '2023-05-13 20:52:58'),
(42, 1, '2023-05-05 21:52:12'),
(42, 2, '2023-05-04 21:27:29'),
(42, 8, '2023-05-11 21:55:10'),
(44, 1, '2023-05-05 21:52:16'),
(45, 1, '2023-05-10 21:04:40'),
(45, 2, '2023-05-11 20:35:27'),
(45, 4, '2023-05-04 22:08:06'),
(45, 6, '2023-05-10 21:13:54'),
(45, 8, '2023-05-13 20:40:12'),
(45, 11, '2023-05-13 20:52:46'),
(46, 2, '2023-05-03 16:32:08'),
(46, 8, '2023-05-11 22:05:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

CREATE TABLE `size` (
  `SizeSP` varchar(6) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `size`
--

INSERT INTO `size` (`SizeSP`, `MaSP`, `SoLuong`) VALUES
('10cm', 16, 100),
('13cm', 15, 100),
('30', 7, 100),
('30', 8, 100),
('30', 9, 100),
('30', 10, 0),
('30', 11, 100),
('30', 12, 100),
('30', 13, 100),
('30', 14, 100),
('30', 33, 0),
('30', 34, 0),
('30', 35, 100),
('30', 36, 100),
('30', 37, 100),
('30', 38, 100),
('30', 39, 100),
('30', 40, 100),
('30', 41, 100),
('31', 7, 1000),
('31', 8, 100),
('31', 9, 100),
('31', 10, 100),
('31', 11, 100),
('31', 12, 100),
('31', 13, 100),
('31', 14, 0),
('31', 33, 100),
('31', 34, 100),
('31', 35, 100),
('31', 36, 0),
('31', 37, 0),
('31', 38, 0),
('31', 39, 0),
('31', 40, 0),
('31', 41, 0),
('32', 7, 100),
('32', 8, 100),
('32', 9, 100),
('32', 10, 100),
('32', 11, 100),
('32', 12, 0),
('32', 13, 100),
('32', 14, 100),
('32', 33, 0),
('32', 34, 0),
('32', 35, 0),
('32', 36, 100),
('32', 37, 100),
('32', 38, 100),
('32', 39, 100),
('32', 40, 100),
('32', 41, 100),
('33', 12, 100),
('33', 13, 0),
('33', 14, 100),
('33', 33, 100),
('33', 34, 100),
('33', 35, 100),
('33', 36, 100),
('33', 37, 100),
('33', 38, 100),
('33', 39, 100),
('33', 40, 100),
('33', 41, 100),
('34', 37, 100),
('34', 38, 100),
('34', 39, 100),
('34', 40, 100),
('34', 41, 100),
('5.5cm', 18, 100),
('6cm', 19, 100),
('7.5cm', 17, 100),
('70cm', 20, 100),
('80cm', 20, 0),
('85cm', 20, 100),
('90cm', 20, 100),
('L', 1, 100),
('L', 2, 100),
('L', 4, 100),
('L', 5, 100),
('L', 6, 100),
('L', 21, 100),
('L', 22, 100),
('L', 23, 100),
('L', 24, 109),
('L', 25, 100),
('L', 26, 100),
('L', 27, 100),
('L', 28, 100),
('L', 29, 100),
('L', 30, 0),
('L', 31, 100),
('L', 32, 0),
('L', 42, 0),
('L', 43, 0),
('L', 44, 100),
('L', 45, 123),
('L', 46, 0),
('M', 1, 100),
('M', 2, 100),
('M', 4, 100),
('M', 5, 100),
('M', 6, 100),
('M', 21, 100),
('M', 22, 100),
('M', 23, 100),
('M', 24, 105),
('M', 25, 100),
('M', 26, 100),
('M', 27, 100),
('M', 28, 100),
('M', 29, 100),
('M', 30, 100),
('M', 31, 100),
('M', 32, 101),
('M', 42, 0),
('M', 43, 100),
('M', 44, 100),
('M', 45, 111),
('M', 46, 97),
('S', 1, 100),
('S', 2, 100),
('S', 6, 100),
('XL', 4, 100),
('XL', 5, 100),
('XL', 21, 0),
('XL', 22, 0),
('XL', 23, 0),
('XL', 24, 0),
('XL', 25, 0),
('XL', 26, 100),
('XL', 27, 100),
('XL', 28, 100),
('XL', 29, 0),
('XL', 30, 100),
('XL', 31, 0),
('XL', 32, 100),
('XL', 42, 0),
('XL', 43, 100),
('XL', 44, 0),
('XL', 45, 0),
('XL', 46, 100),
('XXL', 21, 100),
('XXL', 22, 100),
('XXL', 23, 100),
('XXL', 24, 107),
('XXL', 25, 100),
('XXL', 26, 100),
('XXL', 27, 100),
('XXL', 28, 100),
('XXL', 29, 100),
('XXL', 30, 100),
('XXL', 31, 100),
('XXL', 32, 100),
('XXL', 42, 0),
('XXL', 43, 100),
('XXL', 44, 100),
('XXL', 45, 49),
('XXL', 46, 100),
('XXXL', 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thichbinhluan`
--

CREATE TABLE `thichbinhluan` (
  `MaBinhLuan` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thichbinhluan`
--

INSERT INTO `thichbinhluan` (`MaBinhLuan`, `MaNguoiDung`) VALUES
(1, 1),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 10),
(2, 1),
(2, 2),
(2, 4),
(3, 1),
(3, 2),
(7, 1),
(7, 7),
(7, 8),
(9, 2),
(9, 8),
(15, 2),
(17, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thichtraloibinhluan`
--

CREATE TABLE `thichtraloibinhluan` (
  `MaTraLoi` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thichtraloibinhluan`
--

INSERT INTO `thichtraloibinhluan` (`MaTraLoi`, `MaNguoiDung`) VALUES
(1, 2),
(7, 2),
(11, 2),
(1, 3),
(1, 4),
(1, 5),
(7, 5),
(1, 6),
(7, 6),
(21, 6),
(1, 7),
(1, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `mathongbao` int(11) NOT NULL,
  `maloaithongbao` int(11) DEFAULT NULL,
  `manguoidung` int(11) DEFAULT NULL,
  `manguoituongtac` int(11) DEFAULT NULL,
  `masp` int(11) DEFAULT NULL,
  `manguon` int(11) DEFAULT NULL,
  `loainguon` varchar(20) DEFAULT NULL,
  `TrangThai` varchar(20) NOT NULL,
  `ThoiGian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `thongbao`
--

INSERT INTO `thongbao` (`mathongbao`, `maloaithongbao`, `manguoidung`, `manguoituongtac`, `masp`, `manguon`, `loainguon`, `TrangThai`, `ThoiGian`) VALUES
(1, 1, 2, 1, 45, 1, 'Bình luận', 'Đã xem', '2023-05-02 21:31:31'),
(2, 1, 2, 9, 45, 7, 'Bình luận', 'Đã xem', '2023-05-02 21:30:39'),
(5, 2, 2, 5, 45, 11, 'Trả lời', 'Đã xem', '2023-05-02 21:30:39'),
(7, 1, 2, 1, 45, 7, 'Bình luận', 'Đã xem', '2023-05-02 21:31:33'),
(8, 1, 1, 2, 45, 9, 'Bình luận', 'Đã xem', '2023-05-10 20:37:34'),
(9, 2, 8, 2, 45, 7, 'Trả lời', 'Đã xem', '2023-05-02 21:43:03'),
(10, 1, 8, 2, 45, 2, 'Bình luận', 'Đã xem', '2023-05-02 21:41:40'),
(11, 3, 1, 2, 45, 9, 'Bình luận', 'Đã xem', '2023-05-02 21:50:54'),
(12, 2, 1, 2, 45, 1, 'Trả lời', 'Đã xem', '2023-05-02 21:52:59'),
(13, 3, 8, 2, 45, 2, 'Bình luận', 'Đã xem', '2023-05-10 12:59:55'),
(14, 3, 8, 2, 45, 15, 'Bình luận', 'Đã xem', '2023-05-10 13:24:37'),
(15, 1, 8, 2, 45, 15, 'Bình luận', 'Đã xem', '2023-05-10 20:46:08'),
(16, 2, 8, 2, 45, 17, 'Trả lời', 'Đã xem', '2023-05-10 20:52:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuvien`
--

CREATE TABLE `thuvien` (
  `MaHinhAnh` int(11) NOT NULL,
  `HinhAnh` varchar(200) DEFAULT NULL,
  `MaSP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuvien`
--

INSERT INTO `thuvien` (`MaHinhAnh`, `HinhAnh`, `MaSP`) VALUES
(1, 'ao3lo_navy1.jpg', 1),
(2, 'ao3lo_trang1.jpg', 2),
(3, 'quanshort_den1.jpg', 7),
(4, 'quanshort_den2.jpg', 7),
(5, 'quanshort_da1.jpg', 8),
(6, 'quanshort_da2.jpg', 8),
(7, 'quanshort_camdat1.jpg', 9),
(8, 'quanshort_camdat2.jpg', 9),
(9, 'quanshort_jean1.jpg', 10),
(10, 'quanshort_jean2.jpg', 10),
(11, 'quanshort_jeann1.jpg', 11),
(12, 'quanshort_jeann2.jpg', 11),
(13, 'quankaki_be1.jpg', 12),
(14, 'quankaki_be2.jpg', 12),
(15, 'quankaki_den1.jpg', 13),
(16, 'quankaki_den2.jpg', 13),
(17, 'quankaki_xam1.jpg', 14),
(18, 'quankaki_xam2.jpg', 14),
(19, 'cavatdo1.jpg', 17),
(20, 'cavatcaro1.jpg', 18),
(21, 'cavatgreen1.jpg', 19),
(22, 'aothun_vang1.jpg', 21),
(23, 'aothun_vang2.jpg', 21),
(24, 'aothun_navy1.jpg', 22),
(25, 'aothun_navy2.jpg', 22),
(26, 'aothun_xanh1.jpg', 23),
(27, 'aothun_xanh2.jpg', 23),
(28, 'aothun_nau1.jpg', 24),
(29, 'aothun_nau2.jpg', 24),
(30, 'aothun_xam1.jpg', 25),
(31, 'aothun_xam2.jpg', 25),
(32, 'aosomi_do1.jpg', 26),
(33, 'aosomi_do2.jpg', 26),
(34, 'aosomi_hong1.jpg', 27),
(35, 'aosomi_hong2.jpg', 27),
(36, 'aosomitaydai1.jpg', 28),
(37, 'aosomitaydai2.jpg', 28),
(38, 'aosomi_xanh1.jpg', 29),
(39, 'aosomi_xanh2.jpg', 29),
(40, 'aosomi_caro1.jpg', 30),
(41, 'aosomi_caro2.jpg', 30),
(42, 'aosomi_dat1.jpg', 31),
(43, 'aosomi_dat2.jpg', 31),
(44, 'aosomi_trang1.jpg', 32),
(45, 'aosomi_trang2.jpg', 32),
(46, 'jean1.jpg', 33),
(47, 'jean2.jpg', 33),
(48, 'quanjean1.jpg', 34),
(49, 'quanjean2.jpg', 34),
(50, 'jeannavy1.jpg', 35),
(51, 'jeannavy2.jpg', 35),
(52, 'jeanxanh1.jpg', 36),
(53, 'jeanxanh2.jpg', 36),
(54, 'taynavy1.jpg', 37),
(55, 'taynavy2.jpg', 37),
(56, 'taynau1.jpg', 38),
(57, 'taynau2.jpg', 38),
(58, 'tayden1.jpg', 39),
(59, 'tayden2.jpg', 39),
(60, 'tayxam1.jpg', 40),
(61, 'tayxam2.jpg', 40),
(62, 'taybe1.jpg', 41),
(63, 'taybe2.jpg', 41);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `traloibinhluan`
--

CREATE TABLE `traloibinhluan` (
  `MaTraLoi` int(11) NOT NULL,
  `NoiDungTraLoi` text DEFAULT NULL,
  `NgayTraLoi` datetime DEFAULT NULL,
  `MaNguoiDung` int(11) DEFAULT NULL,
  `MaBinhLuan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `traloibinhluan`
--

INSERT INTO `traloibinhluan` (`MaTraLoi`, `NoiDungTraLoi`, `NgayTraLoi`, `MaNguoiDung`, `MaBinhLuan`) VALUES
(1, 'Chân thành cảm ơn bạn đã ủng hộ Việt Tiến trong 5 năm qua, bật mí là sắp tới Việt Tiến sẽ có đợt sale 5-50% tất cả sản phẩm nhân dịp lễ 30/4 và 1/5 nhé ^^', '2023-04-24 13:19:01', 1, 1),
(7, 'same', '2023-04-26 15:32:41', 8, 3),
(11, 'dep lam do ban', '2023-05-02 13:09:39', 2, 2),
(12, 'kekeke', '2023-05-02 21:50:28', 2, 9),
(13, 'kkkkaaaaa', '2023-05-02 21:50:54', 2, 9),
(14, 'kakakkaka', '2023-05-02 21:51:13', 2, 7),
(15, 'kkk', '2023-05-10 12:59:55', 2, 2),
(21, 'kekekeke', '2023-05-10 21:13:54', 6, 17);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`MaBinhLuan`),
  ADD KEY `MaSP` (`MaSP`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`MaDonHang`,`MaSP`,`Size`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietsp`
--
ALTER TABLE `chitietsp`
  ADD PRIMARY KEY (`MaChiTietSP`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `hanche`
--
ALTER TABLE `hanche`
  ADD PRIMARY KEY (`MaHanChe`);

--
-- Chỉ mục cho bảng `hanchenguoidung`
--
ALTER TABLE `hanchenguoidung`
  ADD PRIMARY KEY (`MaNguoiDung`,`MaHanChe`),
  ADD KEY `fk_hanchenguoidung_manguoidung` (`MaNguoiDung`),
  ADD KEY `fk_hanchenguoidung_mahanche` (`MaHanChe`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoaiSP`);

--
-- Chỉ mục cho bảng `loaithongbao`
--
ALTER TABLE `loaithongbao`
  ADD PRIMARY KEY (`maloaithongbao`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaNguoiDung`),
  ADD KEY `MaQuyen` (`MaQuyen`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`MaQuyen`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaLoaiSP` (`MaLoaiSP`);

--
-- Chỉ mục cho bảng `sanphamdaxem`
--
ALTER TABLE `sanphamdaxem`
  ADD PRIMARY KEY (`masp`,`manguoidung`),
  ADD KEY `fk_sanphamdaxem_manguoidung` (`manguoidung`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`SizeSP`,`MaSP`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `thichbinhluan`
--
ALTER TABLE `thichbinhluan`
  ADD PRIMARY KEY (`MaBinhLuan`,`MaNguoiDung`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `thichtraloibinhluan`
--
ALTER TABLE `thichtraloibinhluan`
  ADD PRIMARY KEY (`MaNguoiDung`,`MaTraLoi`),
  ADD KEY `MaTraLoi` (`MaTraLoi`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`mathongbao`),
  ADD KEY `fk_thongbao_nguoidung` (`manguoidung`),
  ADD KEY `fk_thongbao_loaithongbao` (`maloaithongbao`),
  ADD KEY `fk_thongbao_nguoituongtac` (`manguoituongtac`),
  ADD KEY `fk_thongbao_sanpham` (`masp`);

--
-- Chỉ mục cho bảng `thuvien`
--
ALTER TABLE `thuvien`
  ADD PRIMARY KEY (`MaHinhAnh`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `traloibinhluan`
--
ALTER TABLE `traloibinhluan`
  ADD PRIMARY KEY (`MaTraLoi`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`),
  ADD KEY `MaBinhLuan` (`MaBinhLuan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `MaBinhLuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `chitietsp`
--
ALTER TABLE `chitietsp`
  MODIFY `MaChiTietSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `hanche`
--
ALTER TABLE `hanche`
  MODIFY `MaHanChe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `MaLoaiSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT cho bảng `loaithongbao`
--
ALTER TABLE `loaithongbao`
  MODIFY `maloaithongbao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `MaNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `MaQuyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `mathongbao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `thuvien`
--
ALTER TABLE `thuvien`
  MODIFY `MaHinhAnh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `traloibinhluan`
--
ALTER TABLE `traloibinhluan`
  MODIFY `MaTraLoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`);

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`MaDonHang`) REFERENCES `donhang` (`MaDonHang`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `chitietsp`
--
ALTER TABLE `chitietsp`
  ADD CONSTRAINT `chitietsp_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`);

--
-- Các ràng buộc cho bảng `hanchenguoidung`
--
ALTER TABLE `hanchenguoidung`
  ADD CONSTRAINT `fk_hanchenguoidung_mahanche` FOREIGN KEY (`MaHanChe`) REFERENCES `hanche` (`MaHanChe`),
  ADD CONSTRAINT `fk_hanchenguoidung_manguoidung` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`);

--
-- Các ràng buộc cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `nguoidung_ibfk_1` FOREIGN KEY (`MaQuyen`) REFERENCES `quyen` (`MaQuyen`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaLoaiSP`) REFERENCES `loaisp` (`MaLoaiSP`);

--
-- Các ràng buộc cho bảng `sanphamdaxem`
--
ALTER TABLE `sanphamdaxem`
  ADD CONSTRAINT `fk_sanphamdaxem_manguoidung` FOREIGN KEY (`manguoidung`) REFERENCES `nguoidung` (`MaNguoiDung`),
  ADD CONSTRAINT `fk_sanphamdaxem_masp` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `size`
--
ALTER TABLE `size`
  ADD CONSTRAINT `size_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `thichbinhluan`
--
ALTER TABLE `thichbinhluan`
  ADD CONSTRAINT `thichbinhluan_ibfk_1` FOREIGN KEY (`MaBinhLuan`) REFERENCES `binhluan` (`MaBinhLuan`),
  ADD CONSTRAINT `thichbinhluan_ibfk_2` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`);

--
-- Các ràng buộc cho bảng `thichtraloibinhluan`
--
ALTER TABLE `thichtraloibinhluan`
  ADD CONSTRAINT `thichtraloibinhluan_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`),
  ADD CONSTRAINT `thichtraloibinhluan_ibfk_2` FOREIGN KEY (`MaTraLoi`) REFERENCES `traloibinhluan` (`MaTraLoi`);

--
-- Các ràng buộc cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD CONSTRAINT `fk_thongbao_loaithongbao` FOREIGN KEY (`maloaithongbao`) REFERENCES `loaithongbao` (`maloaithongbao`),
  ADD CONSTRAINT `fk_thongbao_nguoidung` FOREIGN KEY (`manguoidung`) REFERENCES `nguoidung` (`MaNguoiDung`),
  ADD CONSTRAINT `fk_thongbao_nguoituongtac` FOREIGN KEY (`manguoituongtac`) REFERENCES `nguoidung` (`MaNguoiDung`),
  ADD CONSTRAINT `fk_thongbao_sanpham` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `thuvien`
--
ALTER TABLE `thuvien`
  ADD CONSTRAINT `thuvien_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `traloibinhluan`
--
ALTER TABLE `traloibinhluan`
  ADD CONSTRAINT `traloibinhluan_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`),
  ADD CONSTRAINT `traloibinhluan_ibfk_2` FOREIGN KEY (`MaBinhLuan`) REFERENCES `binhluan` (`MaBinhLuan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
