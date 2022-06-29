-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 19, 2022 lúc 04:10 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoes`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDetailProductById` (`product_id` INT)  BEGIN
    SELECT A.productName,A.product_desc,A.price,A.image,B.brandName,C.catName
    FROM tbl_product A 
    LEFT JOIN tbl_brand B on A.brandId = B.brandId
    LEFT JOIN tbl_category C ON A.catId = C.catId
    WHERE a.productId = product_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetListDataOrder` ()  BEGIN
	SELECT productName,price,quantity,date_order,o.image,c.name,c.address,c.city,c.phone,c.email,o.status
    FROM `tbl_order` o
    LEFT JOIN tbl_customer c on c.id = o.customer_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetListItemByCategory` (`catId` INT)  BEGIN
SELECT c.catName,p.productName,p.product_desc,p.price,p.image,p.productId 
  FROM tbl_category c 
  JOIN tbl_product p on c.catId = p.catId
  WHERE c.catId = catId;
END$$

--
-- Các hàm
--
CREATE DEFINER=`root`@`localhost` FUNCTION `sum_cart` () RETURNS INT(11) return (select count(*) from tbl_cart)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `getlistdataproduct`
-- (See below for the actual view)
--
CREATE TABLE `getlistdataproduct` (
`productName` tinytext
,`price` varchar(255)
,`image` varchar(255)
,`brandName` varchar(255)
,`catName` varchar(255)
,`product_desc` text
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminid` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminid`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'tuan', 'tuan@gmail.com', 'tuanadmin', '6bee11c36275ae8115e11cf53f057c7a', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(3, 'Sneaker'),
(4, 'Sneaker'),
(5, 'Thể thao'),
(6, 'Thể thao'),
(8, 'Sneaker');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `catId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(7, 'Vans'),
(8, 'Air'),
(9, 'Adidas'),
(10, 'Nike');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(55) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `name`, `email`, `message`) VALUES
(35, 'minhtuan123', 'minhtuan123@gmail.com', ' cảm ơn shop'),
(39, 'tuan123', 'tuan123@gmail.com', 'cam on shop'),
(40, 'tuan123', 'tuan123@gmail.com', ' sdfsdf'),
(41, 'tuan123', 'tuan123@gmail.com', ' 2131231232'),
(42, 'ok', 'tuan123x@gmail.com', 'oke');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES
(26, 'tuan123x', 'asadasd, 123  ', 'vietnam', 'null', '123456  ', '123456789', 'tuan123x@gmail.com  ', '0c278008cec84c6fd2f3eebb3ae27a57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_order` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `productId`, `productName`, `customer_id`, `quantity`, `price`, `image`, `status`, `date_order`) VALUES
(80, 0, 'Giày Vans Old Skool Anaheim', 0, 3, '600000', '994f22021c.jpg', 1, '2022-01-18 03:57:51'),
(81, 0, 'Giày Vans Old Skool Checkerboard', 0, 3, '900000', '916830b09f.png', 1, '2022-01-26 11:44:48'),
(88, 0, 'Giày thể thao Adidas Race Yellow', 0, 1, '200000', '4ff14492a5.jpg', 0, '2022-05-05 13:55:46'),
(89, 0, 'Giày Vans Old Skool Checkerboard', 0, 1, '300000', '916830b09f.png', 0, '2022-05-05 13:55:46'),
(90, 0, 'Giày Adidas Day thể thao Jogger', 0, 1, '300000', '48f441a43c.jpg', 0, '2022-05-05 13:56:05'),
(91, 0, 'Giày Vans Old Skool Checkerboard', 0, 1, '300000', '916830b09f.png', 0, '2022-05-05 13:57:20'),
(92, 0, 'giày 123', 0, 1, '200000', '389530229a.png', 0, '2022-05-07 01:05:41'),
(93, 0, 'Giày Vans Old Skool Anaheim', 0, 4, '800000', '994f22021c.jpg', 0, '2022-05-07 01:13:42'),
(94, 0, 'Giày thể thao Adidas Race Yellow', 0, 2, '400000', '4ff14492a5.jpg', 0, '2022-05-09 08:49:40'),
(95, 0, 'Giày thể thao Nike Zoom Rival Fly 2', 0, 1, '200000', '4d6bf53221.jpg', 1, '2022-06-09 04:04:31'),
(96, 0, 'Giày Adidas Day thể thao Jogger', 0, 2, '600000', '48f441a43c.jpg', 0, '2022-06-11 11:10:28'),
(97, 0, 'Giày Vans Classic Checkerboard', 0, 3, '750000', '19bf9b626e.png', 1, '2022-06-11 11:10:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` tinytext NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `type` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `product_desc`, `type`, `price`, `image`) VALUES
(24, 'Giày Nike X LOUIS VUITTON', 10, 8, '<p>Bản kết hợp giữa LOUIS VUITTON V&Agrave; NIKE tạo n&ecirc;n 1 bản phối m&agrave;u cực k&igrave; thời thượng</p>', 1, '600000', 'a7cf3d7489.jpg'),
(25, 'Giày thể thao Nike Zoom Rival Fly 2', 10, 6, '<p>Nike Zoom Rival Fly c&oacute; kiểu d&aacute;ng tương lai với đệm ở b&agrave;n ch&acirc;n trước cho bạn cảm gi&aacute;c nhạy b&eacute;n. C&aacute;c r&atilde;nh linh hoạt b&ecirc;n dưới tối ưu h&oacute;a việc xỏ ng&oacute;n v&agrave; đệm m&uacute;t mềm gi&uacute;p bạn sải bước.</p>', 1, '200000', '4d6bf53221.jpg'),
(29, 'Giày Vans Classic Checkerboard', 7, 8, '<p>L&agrave; 1 trong những BEST SELLER, kh&ocirc;ng bao giờ lỗi mốt, hot với mọi thời đại, cực dễ phối đồ.</p>', 0, '250000', '19bf9b626e.png'),
(31, 'Giày Air Jordan 1 University Blue', 8, 4, '<p>Nike Jordan 1 University Blue&nbsp;c&oacute; da trắng ở tr&ecirc;n, lớp phủ University Blue l&agrave; da lộn . Đế giữa l&agrave; m&agrave;u trắng, tr&ecirc;n đỉnh đế gi&agrave;y bằng cao su m&agrave;u xanh gi&uacute;p cho thiết kế được ho&agrave;n thiện.</p>', 1, '450000', '924813111d.jpg'),
(32, 'Giày thể thao Adidas Response', 9, 5, '<p>Gi&agrave;y Được l&agrave;m từ chất liệu c&oacute; chọn lọc, đường chỉ may chắc chắn gi&uacute;p sản phẩm c&oacute; độ bền cao v&agrave; n&acirc;ng niu từng bước ch&acirc;n của bạn.</p>', 1, '250000', '3bc19a23c3.jpg'),
(33, 'Giày Vans Old Skool Anaheim', 7, 8, '<p>Kiểu d&aacute;ng Old Skool cổ điển với l&oacute;t gi&agrave;y được n&acirc;ng cấp c&ocirc;ng nghệ Đệm l&oacute;t UltraCush mang đến một cảm nhận kh&aacute;c biệt với d&ograve;ng gi&agrave;y cao cấp n&agrave;y của nh&agrave; Vans mang lại sự thoải m&aacute;i &amp; &ecirc;m &aacute;i cho đ&ocirc;i ch&acirc;n.&nbsp;</p>', 0, '200000', '994f22021c.jpg'),
(34, 'Giày Air Force 1 Trắng', 8, 8, '<p>Nike Air Force 1 All White l&agrave; đ&ocirc;i gi&agrave;y đầu ti&ecirc;n được t&iacute;ch hợp c&ocirc;ng nghệ &lsquo;air&rsquo;, một t&uacute;i kh&iacute; được bố tr&iacute; b&ecirc;n trong đế gi&agrave;y để hấp thu lực khi tiếp đất, giảm chấn thương cho b&agrave;n ch&acirc;n.</p>', 0, '350000', '8928666559.jpg'),
(35, 'Giày Adidas Day thể thao Jogger', 9, 5, '<p>Kh&ocirc;ng kế hoạch. Kh&ocirc;ng quy tắc. Cứ tự nhi&ecirc;n đ&oacute;n nhận ng&agrave;y mới xem bạn sẽ đi tới đ&acirc;u. Đ&ocirc;i gi&agrave;y adidas Day Jogger n&agrave;y thể hiện trọn vẹn tinh thần đ&oacute; , lớp đệm đế giữa mang đến nguồn năng lượng bất tận cho từng bước ch&acirc;n, nhờ đ&oacute; bất kể đi tới đ&acirc;u hay dừng lại bao nhi&ecirc;u lần, bạn sẽ lu&ocirc;n cảm thấy thoải m&aacute;i.</p>', 0, '300000', '48f441a43c.jpg'),
(36, 'Giày Vans Old Skool Checkerboard', 7, 3, '<p>Với thiết kế nửa vải, nửa da lộn tạo n&ecirc;n một tổng thể h&agrave;i h&ograve;a v&agrave; nổi bật.&nbsp;</p>', 1, '300000', '916830b09f.png'),
(37, 'Giày thể thao Adidas Race Yellow', 9, 5, '<p><span>Kh&ocirc;ng giống như bất kỳ mẫu sneaker n&agrave;o kh&aacute;c hiện c&oacute; tr&ecirc;n thị trường, đ&ocirc;i gi&agrave;y thể thao n&agrave;y chắc chắn sẽ khiến bạn ch&uacute; &yacute;.</span></p>', 1, '200000', '4ff14492a5.jpg'),
(40, 'Giày Air Jordan 1 Low Smoke Grey', 8, 8, '<p>Gi&agrave;y được l&agrave;m từ chất liệu da cao cấp với độ &ocirc;m được thiết kế đặc biệt để n&acirc;ng đỡ c&oacute; định hướng v&agrave; hỗ trợ chuyển động. Form gi&agrave;y đi l&ecirc;n ch&acirc;n vừa vặn, c&aacute;c đường n&eacute;t của đ&ocirc;i gi&agrave;y v&ocirc; c&ugrave;ng tinh tế v&agrave; sắc sảo h&agrave;i l&ograve;ng mọi kh&aacute;ch h&agrave;ng. Họa tiết hoa trang tr&iacute; tạo điểm nhấn độc đ&aacute;o ri&ecirc;ng.</p>', 1, '400000', '3febeb651e.jpg'),
(41, 'Giày Vans Authentic Disruptive', 7, 8, '<p>Lớp đệm l&oacute;t OrthoLite tạo độ th&ocirc;ng tho&aacute;ng cho đ&ocirc;i ch&acirc;n khi vận động, đường may tỉ mỉ chắc chắn, dễ vệ sinh ,dễ d&agrave;ng phối đồ trong mọi ho&agrave;n cảnh v&agrave; đế gi&agrave;y c&oacute; độ b&aacute;m cao.</p>', 1, '1120000', 'b043e8e7cb.jpg'),
(42, 'Giày Sneaker NIKE Uptempo', 10, 8, '<p><span>Kiểu d&aacute;ng mới lạ, bắt mắt c&ugrave;ng với c&ocirc;ng nghệ t&uacute;i khi nổi vốn đang rất hot v&agrave; thời thượng.</span></p>', 1, '800000', '0e1088d6d4.jpg'),
(43, 'Giày thể thao Nike More Uptempo', 10, 8, '<p><span><span>Gi&agrave;y thể thao Nike Air More Uptempo OG,Varsity Red</span></span><span>&nbsp;- một trong những mẫu gi&agrave;y được y&ecirc;u th&iacute;ch nhất ở thời điểm hiện tại.&nbsp;</span><span><span>Mẫu Nike Air More Uptempo</span></span><span>&nbsp;đ&atilde; dần được Nike hồi sinh với cả phối m&agrave;u cũ v&agrave; mới. Tiếp nối cho c&aacute;c ph&aacute;t h&agrave;nh&nbsp;</span><span><span>More Uptempo</span></span><span>&nbsp;trước đ&acirc;y, Nike cho ra mắt phối m&agrave;u Bulls của d&ograve;ng gi&agrave;y với thiết kế hầm hố v&agrave; độc đ&aacute;o n&agrave;y.</span></p>', 1, '550000', '3875b9c3e2.jpg');

--
-- Bẫy `tbl_product`
--
DELIMITER $$
CREATE TRIGGER `Delete_cart_order_from_product` AFTER DELETE ON `tbl_product` FOR EACH ROW BEGIN
DELETE FROM tbl_cart WHERE tbl_cart.productId = OLD.productId ;
DELETE FROM tbl_order WHERE tbl_order.productId = OLD.productId ;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `sliderid` int(11) NOT NULL,
  `sliderName` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`sliderid`, `sliderName`, `slider_image`, `type`) VALUES
(5, '', '36a57ba5ee.jpg', 1),
(6, '', '1e3d67a961.jpg', 1),
(9, '', '8869d06fe8.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc cho view `getlistdataproduct`
--
DROP TABLE IF EXISTS `getlistdataproduct`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getlistdataproduct`  AS SELECT `p`.`productName` AS `productName`, `p`.`price` AS `price`, `p`.`image` AS `image`, `c`.`brandName` AS `brandName`, `r`.`catName` AS `catName`, `p`.`product_desc` AS `product_desc` FROM ((`tbl_product` `p` join `tbl_brand` `c` on(`c`.`brandId` = `p`.`brandId`)) join `tbl_category` `r` on(`r`.`catId` = `p`.`catId`)) ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`sliderid`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `sliderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
