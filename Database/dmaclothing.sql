-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2023 at 10:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmaclothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productStock` int(11) NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `userid` int(11) NOT NULL,
  `cartID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(5, 'ACCESSORIES'),
(3, 'BABY'),
(4, 'CHILDREN'),
(2, 'MENWEAR'),
(1, 'WOMENWEAR');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_tbl`
--

CREATE TABLE `inquiry_tbl` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `message` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry_tbl`
--

INSERT INTO `inquiry_tbl` (`id`, `fullname`, `message`, `email`) VALUES
(33, 'Jimin Yu', 'hi po winter', 'jiminyu@gmail.com'),
(34, 'Winter Kim', ' hi po karina', 'wkim@gmail.com'),
(39, 'Shayyanne Marasigan', 'hello po :))', 'shayyannedominiq.marasigan@letran.edu.ph'),
(40, 'Paul Dimaunahan', ' hello', 'dimaunahan.paul203@gmail.com'),
(43, 'Shayyanne Dominiq Marasigan', ' How can I change my delivery address?', 'shayyannedominiq.marasigan@letran.edu.ph');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `orderID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cartID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `paymentoptions` varchar(255) NOT NULL,
  `total` float NOT NULL,
  `orderdate` date NOT NULL,
  `ordernumber` bigint(20) NOT NULL,
  `shippingfee` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `delivery_status` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productStock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `paymentstatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`orderID`, `userid`, `cartID`, `productID`, `firstname`, `lastname`, `phone`, `address`, `paymentoptions`, `total`, `orderdate`, `ordernumber`, `shippingfee`, `subtotal`, `delivery_status`, `productName`, `productStock`, `quantity`, `paymentstatus`) VALUES
(190, 44, 256, 5, 'Shayyanne', 'Marasigan', 2147483647, '2114 F. Munoz St. Malate Manila', 'Debit Card', 4085, '2023-05-07', 361683473029706, 85, 4000, 'Complete', 'AIRism T-Shirt', 9, 5, 'Paid'),
(191, 44, 257, 1, 'Shayyanne Dominiq', 'Marasigan', 2147483647, '2114 F. Munoz St. Malate Manila', 'Cash On Delivery', 19525, '2023-05-07', 981683480003298, 85, 19440, 'Complete', 'American Sleeve', 8, 4, 'Paid'),
(192, 44, 258, 2, 'Shayyanne Dominiq', 'Marasigan', 2147483647, '2114 F. Munoz St. Malate Manila', 'Cash On Delivery', 19525, '2023-05-07', 981683480003298, 85, 19440, 'Complete', 'Cropped Bra', 8, 4, 'Paid'),
(193, 44, 259, 7, 'Shayyanne Dominiq', 'Marasigan', 2147483647, '2114 F. Munoz St. Malate Manila', 'Cash On Delivery', 19525, '2023-05-07', 981683480003298, 85, 19440, 'Complete', 'Stretchy Jeans', 8, 4, 'Paid'),
(194, 44, 260, 6, 'Shayyanne Dominiq', 'Marasigan', 2147483647, '2114 F. Munoz St. Malate Manila', 'Cash On Delivery', 19525, '2023-05-07', 981683480003298, 85, 19440, 'Complete', 'Denim Shorts', 8, 4, 'Paid'),
(195, 44, 261, 4, 'Shayyanne Dominiq', 'Marasigan', 2147483647, '2114 F. Munoz St. Malate Manila', 'Cash On Delivery', 19525, '2023-05-07', 981683480003298, 85, 19440, 'Complete', 'Polo Shirt', 8, 3, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `categoryID` int(11) DEFAULT NULL,
  `productID` int(11) NOT NULL,
  `subcategoryID` int(11) DEFAULT NULL,
  `productImage` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productBrand` varchar(255) NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `productSize` int(11) NOT NULL,
  `productStock` int(11) NOT NULL,
  `productDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`categoryID`, `productID`, `subcategoryID`, `productImage`, `productName`, `productBrand`, `productPrice`, `productSize`, `productStock`, `productDesc`) VALUES
(1, 1, 11, 'American Sleeve.jpg', 'American Sleeve', 'UNIQLO', '990.00', 2, 4, 'This top is a combination of a bralette and a sleeveless top with a cropped length. The bralette-style top features a wide band under the bust, while the sleeveless design and breathable fabric make it perfect for warm weather.'),
(1, 2, 11, 'Cropped Bra.jpg', 'Cropped Bra', 'UNIQLO', '690.00', 1, 4, 'This top features a trendy square neckline, cropped length, and bralette-style top with light support. The AIRism fabric helps wick away moisture, making it perfect for layering or wearing on its own in warm weather.'),
(1, 3, 11, 'Striped Bra.jpg', 'Striped Bra', 'UNIQLO', '890.00', 1, 8, 'This t-shirt features a bold stripe pattern, short sleeves, and a cropped length. The bralette-style top provides light support, while the breathable fabric makes it a comfortable and stylish option for casual wear.'),
(1, 4, 11, 'Polo Shirt.jpg', 'Polo Shirt', 'UNIQLO', '920.00', 1, 5, 'This relaxed fit polo shirt features a cropped length and bold stripe pattern. Made from a comfortable and breathable fabric, it\'s perfect for adding a touch of sporty style to your wardrobe.'),
(1, 5, 11, 'AIRism T-Shirt.jpg', 'AIRism T-Shirt', 'UNIQLO', '800.00', 1, 4, 'This t-shirt is made from breathable AIRism fabric, which helps to wick away moisture and keep you cool and comfortable. With a classic short-sleeved design, it\'s perfect for everyday wear.'),
(1, 6, 12, 'Denim Shorts.jpg', 'Denim Shorts', 'UNIQLO', '1490.00', 1, 4, 'These relaxed fit denim shorts have a classic boyfriend cut, with a mid-rise waist and a slightly loose fit through the thighs. They\'re perfect for casual wear in warm weather.'),
(1, 7, 12, 'Stretchy Jeans.jpg', 'Stretchy Jeans', 'UNIQLO', '1000.00', 1, 4, 'These skinny jeans feature a high-rise waist and a stretchy denim fabric that hugs your curves for a flattering fit. Perfect for dressing up or down, they\'re a versatile addition to any wardrobe.'),
(1, 8, 12, 'Baggy Jeans.jpg', 'Baggy Jeans', 'UNIQLO', '890.00', 2, 8, 'These baggy jeans have a relaxed fit through the thighs and legs, with a cropped length and a mid-rise waist. Made from a comfortable denim fabric, they\'re perfect for adding a touch of vintage-inspired style to your look.'),
(1, 9, 12, 'Ankle Pants.jpg', 'Ankle Pants', 'UNIQLO', '1990.00', 2, 9, 'These ankle-length pants feature a classic check pattern, with a slim fit through the hips and thighs. Perfect for dressing up or down, they\'re a versatile addition to any wardrobe.'),
(1, 10, 12, 'Legging Pants.jpg', 'Legging Pants', 'UNIQLO', '1990.00', 1, 9, 'These cropped leggings feature a high-rise waist and a stretchy fabric that hugs your curves for a comfortable and flattering fit. Perfect for working out or lounging, they\'re a wardrobe staple.'),
(1, 11, 13, 'Mercerized Dress.jpg', 'Mercerized Dress', 'UNIQLO', '1490.00', 1, 7, 'This dress is made from mercerized cotton, giving it a lustrous sheen and silky feel. The A-line silhouette features a fitted bodice and flared skirt, with short sleeves and a versatile knee-length hemline.'),
(1, 12, 13, 'Sleeveless Dress.jpg', 'Sleeveless Dress', 'UNIQLO', '1490.00', 1, 10, 'This sleeveless dress is made from AIRism fabric, which helps to wick away moisture and keep you cool and comfortable. The ultra-stretchy material hugs your curves for a flattering fit, while the simple design makes it easy to dress up or down.'),
(1, 13, 13, 'Linen Dress.jpg', 'Linen Dress ', 'UNIQLO', '2990.00', 1, 12, 'This shirt dress features a blend of linen and cotton for a lightweight and breathable feel. The long sleeves can be rolled up for a more casual look, while the belted waist creates a flattering silhouette.'),
(1, 14, 13, 'Cotton Dress.jpg', 'Cotton Dress', 'UNIQLO', '1990.00', 2, 9, 'This sleeveless dress is made from slub cotton, which has a textured, slightly uneven appearance. The relaxed fit and lightweight fabric make it perfect for warm weather, while the simple design makes it a versatile option for any occasion.'),
(1, 15, 13, 'V-Neck Dress.jpg', 'V-Neck Dress', 'UNIQLO', '1590.00', 3, 9, 'This V-neck dress is designed by French fashion icon Ines de la Fressange. The sleeveless design and lightweight fabric make it perfect for warm weather, while the simple, elegant design makes it a versatile option for any occasion.'),
(1, 16, 14, 'Maternity Leggings.jpg', 'Wide Leggings', 'UNIQLO', '790.00', 3, 7, 'These leggings are specifically designed for pregnant women, with a stretchy and supportive AIRism fabric that helps to wick away moisture and keep you cool. The UV-blocking material helps protect your skin from the sun\'s harmful rays, making them perfect'),
(1, 17, 14, 'Maternity Pants.jpg', 'Maternity Pants', 'UNIQLO', '1990.00', 2, 8, 'These ankle-length pants are specifically designed for pregnant women, with a stretchy and supportive fabric that helps to accommodate your growing belly. The smart, tailored design makes them a versatile option for work or casual wear.'),
(1, 18, 14, 'Denim Leggings.jpg', 'Denim Leggings', 'UNIQLO', '1990.00', 1, 8, 'These denim leggings are specifically designed for pregnant women, with a stretchy and supportive fabric that helps to accommodate your growing belly. The denim fabric gives them a classic, versatile look, while the leggings-style cut makes them comfortab'),
(1, 19, 14, 'Maternity Shorts.jpg', 'Low-Rise Shorts', 'UNIQLO', '390.00', 1, 15, 'These low-rise shorts are specifically designed for pregnant women, with a stretchy and supportive fabric that helps to accommodate your growing belly. The simple, classic design makes them a versatile option for warm weather.'),
(1, 20, 14, 'High-Rise Shorts.jpg', 'High-Rise Shorts', 'UNIQLO', '390.00', 3, 15, 'These high-rise shorts are specifically designed for pregnant women, with a stretchy and supportive fabric that helps to accommodate your growing belly. The high-rise waist provides extra support and coverage, making them a comfortable and practical optio'),
(2, 21, 21, 'Shadow Purple Tee.png', 'Shadow Purple ', 'MNLA+', '770.00', 1, 10, 'This tee features an oversized fit and a unique shadow purple color. The classic crewneck and short sleeves make it a versatile option for any occasion, while the relaxed fit provides comfort and style.'),
(2, 22, 21, 'Organic Cotton Tee.png', 'Organic Cotton ', 'MNLA+', '770.00', 1, 10, 'This tee is made from soft and sustainable organic cotton, making it both comfortable and environmentally friendly. The classic crewneck and short sleeves make it a versatile option for any occasion, while the simple design allows it to be easily dressed '),
(2, 23, 21, 'Striped Pique Tee.png', 'Striped Pique ', 'MNLA+', '770.00', 1, 10, 'This tee features an oversized fit and a stylish striped pique design in a natural wood color. The classic crewneck and short sleeves make it a versatile option for any occasion, while the relaxed fit provides comfort and style.'),
(2, 24, 21, 'Camo Neck Tee.png', 'Camo Neck Tee', 'MNLA+', '870.00', 1, 10, 'This tee features a unique camo print and a trendy mock neck design. The short sleeves and relaxed fit make it a comfortable and stylish option for any casual occasion.'),
(2, 25, 21, 'Striped Pique Oat.png', 'Striped Pique Oat', 'MNLA+', '770.00', 1, 10, 'This tee features an oversized fit and a stylish striped pique design in a light oat color. The classic crewneck and short sleeves make it a versatile option for any occasion, while the relaxed fit provides comfort and style.'),
(2, 26, 22, 'Shorts in Anthracite.png', 'Anthracite Short', 'MNLA+', '870.00', 1, 10, 'These shorts are made from lightweight and breathable linen in a stylish anthracite color. The pleated design adds a touch of sophistication, while the relaxed fit and elastic waistband provide comfort and ease of wear.'),
(2, 27, 22, 'Denim Sweatshorts.png', 'Denim Shorts', 'MNLA+', '700.00', 1, 10, 'These shorts feature a denim blue color and a trendy raw hem design. The soft and stretchy fabric provides comfort and flexibility, while the drawstring waistband allows for a customizable fit.'),
(2, 28, 22, 'Forest Camo Corduroy.png', 'Forest Camo Short', 'MNLA+', '970.00', 1, 10, 'These shorts feature a unique forest camo print and a stylish corduroy fabric. The 7-pocket design adds a functional touch, while the relaxed fit and elastic waistband provide comfort and ease of wear.'),
(2, 29, 22, 'Shorts in Mauve.png', 'Shorts in Mauve', 'MNLA+', '870.00', 1, 10, 'These shorts are designed for active wear, with a breathable and moisture-wicking fabric in a trendy mauve color. The lightweight and stretchy material allows for freedom of movement, while the elastic waistband and drawstring provide a customizable fit.'),
(2, 30, 22, 'Vines and Thorns.png', 'Vines and Thorns', 'MNLA+', '870.00', 1, 10, 'These sweatshorts feature a unique vines and thorns print and a soft and comfortable fabric. The relaxed fit and drawstring waistband provide comfort and ease of wear, while the trendy design adds a touch of style to any casual outfit.'),
(2, 31, 23, 'Mauve Polo Shirt.png', 'Mauve Polo Shirt', 'MNLA+', '1070.00', 1, 10, 'This long sleeve polo shirt features a classic design with a modern mauve color. The collar and button placket add a touch of sophistication, while the comfortable and breathable fabric makes it a great option for any casual occasion.'),
(2, 32, 23, 'Olive Polo Shirt.png', 'Olive Polo Shirt', 'MNLA+', '1070.00', 1, 10, 'This short sleeve polo shirt features a classic design with a trendy olive color. The collar and button placket add a touch of sophistication, while the comfortable and breathable fabric makes it a great option for any casual occasion.'),
(2, 33, 26, 'Striped Navy.png', 'Striped Navy', 'MNLA+', '1970.00', 1, 10, 'This jacket features a classic chore design in a versatile navy color. The durable cotton fabric provides warmth and protection, while the multiple pockets add functionality and style.'),
(2, 34, 26, 'Olive Jacket.png', 'Olive Jacket', 'MNLA+', '2270.00', 1, 10, 'This windbreaker features a trendy olive color and a lightweight fabric. The hood and zip-up design provide protection from the elements, while the adjustable cuffs and hem allow for a customizable fit.'),
(2, 35, 26, 'Rogue Khaki.png', 'Rogue Khaki', 'MNLA+', '1670.00', 1, 10, 'This oversized hoodie features a trendy relaxed fit. The soft and comfortable fabric provides warmth and comfort, while the drawstring hood and kangaroo pocket add functionality and style.'),
(2, 36, 24, 'Deep Trench Camo.png', 'Trench Camo', 'MNLA+', '1570.00', 1, 10, 'This long sleeve shirt features a unique deep trench camo print and a comfortable fabric. The classic crewneck and relaxed fit make it a versatile option for any occasion, while the trendy design adds a touch of style.'),
(2, 37, 24, 'Tangerine Longsleeve.png', 'Tangerine Longsleeve', 'MNLA+', '1570.00', 1, 10, 'This long sleeve tee features a bright tangerine color and a stylish pocket design. The classic crewneck and relaxed fit make it a versatile option for any occasion, while the trendy design adds a touch of style.'),
(2, 38, 25, 'Cropped Pants Graphite.png', 'Cropped Pants Graphite', 'MNLA+', '1370.00', 3, 10, 'These pants feature a stylish twill fabric and a trendy wide cropped design in a versatile graphite color. The relaxed fit and elastic waistband provide comfort and ease of wear, while the pockets and belt loops add functionality and style.'),
(2, 39, 25, 'Twill Wide Pants in Flint.png', 'Twill Wide Pants in Flint', 'MNLA+', '1370.00', 3, 10, 'The TWILL Wide Cropped Pants in Flint are a stylish and comfortable pair of pants designed for women. Made from a soft and durable twill fabric, these pants feature a relaxed fit that sits comfortably on the hips and flatters the figure. The Flint color i'),
(2, 40, 25, 'Twill Wide Pants in Navy.png', 'Twill Wide Pants in Navy', 'MNLA+', '1370.00', 5, 10, 'The Twill Wide Cropped Pants in Navy are a stylish and comfortable pair of pants designed for women. These pants are made from a high-quality twill fabric that feels soft against the skin and provides lasting durability. The deep navy color is a classic n'),
(3, 41, 33, 'Daphno Pants.jpg', 'Daphno Pants', 'Raising Little', '810.00', 1, 100, 'These pants are made from a comfortable and breathable material and come in a clean white color. They have a loose, relaxed fit and feature an elastic waistband for a comfortable and secure fit.'),
(3, 42, 33, 'Hudson baby boy pants set.png', 'Hudson pants set', 'Little Kooma', '940.00', 1, 100, ' These pants are made from a comfortable and breathable material and come in a clean white color. They have a loose, relaxed fit and feature an elastic waistband for a comfortable and secure fit.'),
(3, 43, 33, 'Timmo Pants.png', 'Timmo Pants', 'Name It', '499.00', 1, 100, 'These pants are designed for both style and comfort. They feature a tapered fit and an elastic waistband for a comfortable fit. They are made from a soft and stretchy material and come in a range of colors.'),
(3, 44, 33, 'Whale Print Pants.png', 'Whale Print Pants', 'Name It', '499.00', 1, 100, 'These pants feature a cute and colorful whale print and are made from a soft and breathable material. They have a relaxed fit and an elastic waistband for a comfortable and secure fit.'),
(3, 45, 33, 'Kabex Rib Leggings.png', 'Kabex Rib Leggings', 'Name It', '489.00', 1, 100, 'These leggings are made from a soft and stretchy ribbed material and feature a comfortable elastic waistband. They have a fitted, tapered design and are available in a range of colors.'),
(3, 46, 34, 'Hudson Baby Socks 3 Pairs Pack Anti-slip.png', 'Hudson Baby Socks 3 Pairs ', 'Little Kooma', '69.00', 1, 100, 'This pack includes three pairs of socks for babies, each with a comfortable and secure anti-slip sole. They are made from soft and breathable materials and come in a range of fun colors and designs.'),
(3, 47, 34, 'Danyel Sock.png', 'Danyel 3 pairs Socks', 'Raising Little', '255.00', 1, 100, 'These socks are designed for comfort and style. They are made from a soft and breathable material and feature a colorful design. They have a comfortable elastic band to keep them in place.'),
(3, 48, 34, 'Danblu Socks - Multi.png', 'Danblu Socks - Multi', 'Raising Little', '470.00', 1, 100, 'These socks come in a multi-colored design and are made from a soft and breathable material. They have a comfortable elastic band to keep them in place and are perfect for adding a pop of color to any outfit.'),
(3, 49, 34, 'Hudson baby sock3 3pairs pack.png', 'Hudson Baby sock 3 pairs pack ', 'Little Kooma', '630.00', 1, 100, 'This pack includes three pairs of socks for babies, each made from soft and comfortable materials. They have a secure fit and come in a range of cute and colorful designs.'),
(3, 50, 34, 'First step baby socks 3 pairs pack anti-slip.jpg', 'First step baby socks 3 pairs pack', 'Little Kooma', '610.00', 1, 100, 'These socks are designed for babies learning to walk, with a secure anti-slip sole. They are made from a soft and breathable material and come in a pack of three with cute and colorful designs.'),
(4, 51, 41, 'Black Panther Wakanda Forever T-Shirt for Kids V1.png', 'Black Panther: Wakanda Forever T-Shirt for Kids V1', 'Disney', '1106.00', 1, 100, 'A black T-shirt with a graphic print of the Black Panther on the front in purple and black . Available in kids sizes.'),
(4, 52, 41, 'Black Panther Wakanda Forever T-Shirt for Kids V2.png', 'Black Panther: Wakanda Forever T-Shirt for Kids V2', 'Disney', '1106.00', 1, 100, 'A black T-shirt with a graphic print of the Black Panther on the front in purple and black . Available in kids sizes.'),
(4, 53, 41, 'Black Panther Wakanda Forever T-Shirt for Kids V3.png', 'Black Panther: Wakanda Forever T-Shirt for Kids V3', 'Disney', '1106.00', 1, 100, 'A gray T-shirt with a graphic print of the Black Panther on the front and the words \"Wakanda Forever\" in different font colors above it. Available in kids sizes.'),
(4, 54, 41, 'Black Panther Wakanda Forever T-Shirt for Kids V4.png', 'Black Panther: Wakanda Forever T-Shirt for Kids V4', 'Disney', '1106.00', 1, 100, 'A blue T-shirt with a graphic print of the Black Panther on the front in navy blue above it. Available in kids sizes.'),
(4, 55, 42, 'The Kombi Animal Family Heavy Socks - Daisy the Deer.png', 'The Kombi Animal Family Heavy Socks - Daisy the Deer', 'Kombi', '993.00', 1, 100, 'A pair of heavy socks for kids with a graphic print of a deer named Daisy from the Kombi Animal Family. Made with a warm and soft material for cold weather.'),
(4, 56, 42, 'The Kombi Animal Family Heavy Socks - Shawn the Shark.png', 'The Kombi Animal Family Heavy Socks - Shawn the Shark', 'Disney', '993.00', 1, 100, 'A pair of heavy socks for kids with a graphic print of a shark named Shawn from the Kombi Animal Family. Made with a warm and soft material for cold weather.'),
(4, 57, 42, 'The Kombi Animal Family Heavy Socks - Johnny the Giraffe.png', 'The Kombi Animal Family Heavy Socks - Johnny the Giraffe:', 'Kombi', '993.00', 1, 100, 'A pair of heavy socks for kids with a graphic print of a giraffe named Johnny from the Kombi Animal Family. Made with a warm and soft material for cold weather.'),
(4, 58, 42, 'The Kombi Animal Family Heavy Socks - Karlie the Kitten.png', 'The Kombi Animal Family Heavy Socks - Karlie the Kitten', 'Kombi', '993.00', 1, 100, 'A pair of heavy socks for kids with a graphic print of a kitten named Karlie from the Kombi Animal Family. Made with a warm and soft material for cold weather.'),
(4, 59, 43, 'Kids Plain White Long Pants Cotton Bottom.png', 'Kids Plain White Long Pants', 'Little Kooma', '1030.00', 1, 100, 'A pair of plain white long pants for kids made with 100% cotton. Soft, comfortable, and perfect for everyday wear.'),
(4, 60, 43, 'Slim Fit Looney Toons Print Leggings.png', 'Slim Fit Looney Toons Leggings', 'Disney', '419.00', 1, 100, 'A pair of leggings for kids with a slim fit and a graphic print of Looney Toons characters. Made with a stretchy and comfortable material.'),
(4, 61, 43, 'Tom and Jerry Leggings.png', 'Tom and Jerry Leggings', 'Disney', '419.00', 1, 100, ' These leggings for kids feature a fun and colorful print of the beloved cartoon characters, Tom and Jerry. They are made of a stretchy and comfortable material that allows for easy movement.'),
(4, 62, 43, 'KOTON Camo Print Sweat Pants.png', 'KOTON Camo Print Sweat Pants', 'Koton', '749.00', 1, 100, 'These sweatpants for kids feature a trendy camo print in shades of green and brown. They have an elastic waistband and cuffs for a snug fit, and are made of a soft and cozy material for comfort.'),
(4, 63, 44, 'Tili Dahli Fairy Dress - Pasko.png', 'Tili Dahli Fairy Dress - Pasko', 'Disney', '2489.00', 1, 100, 'This dress for kids features a charming design with a mix shades of red, pink, and blue. It has a fitted top and a flared skirt, and is made of a lightweight and breathable fabric'),
(4, 64, 44, 'LC Waikiki Minnie Mouse Dress.png', 'LC Waikiki Minnie Mouse Dress', 'Disney', '2379.00', 1, 100, 'This dress for kids features a cute and playful design with Minnie Mouse icons in different sizes and colors on a light pink background. It has a fitted top and a flared skirt, and is made of a soft and stretchy material for comfort.'),
(4, 65, 44, 'Little Kooma Baby Girl Ruffled Sleeves White Bodysuit.png', 'Little Kooma Bodysuit ', 'Disney', '2489.00', 1, 100, 'This dress for kids features a whimsical design with Disney Princess sidekicks, such as Pascal and Gus, on a light '),
(4, 66, 44, 'Little Kooma Baby girl short sleeves ruffled light pink Bodysuit.png', 'Little Kooma Light Pink Bodysuit', 'Disney', '2489.00', 1, 100, 'This dress for kids features a playful design with an ocean theme, including seashells, starfish, and coral in shades of blue and pink. It has a fitted top and a flared skirt, and is made of a soft and lightweight material for comfort.'),
(4, 67, 45, 'ADIDAS Black and White Shorts.jpg', 'ADIDAS Black and White Shorts', 'Adidas', '1399.00', 1, 100, 'These shorts for kids feature the classic ADIDAS three-stripe design in black and white. They have an elastic waistband and are made of a lightweight and breathable fabric for comfort during physical activity.'),
(4, 68, 45, 'Nike Dri-FIT Tempo.png\n', 'Nike Pink Dri-FIT Tempo', 'Nike', '895.00', 1, 100, 'These shorts for kids feature a bright and bold pink color and are made of Nike\'s Dri-FIT material, which wicks away sweat to keep the wearer dry and comfortable during physical activity. They have an elastic waistband and a relaxed fit for ease of moveme'),
(4, 69, 45, 'ADIDAS future icons 3-stripes loose cotton shorts.jpg', 'ADIDAS 3-stripes shorts', 'Adidas', '1845.00', 1, 100, 'These shorts for kids feature the ADIDAS three-stripe design in white on a dark blue background. They are made of a soft and lightweight cotton material and have a loose fit for comfort.'),
(4, 70, 45, 'Under Armour UA Woven Shorts.jpg', 'Under Armour UA Woven Shorts', 'Under Armour', '1395.00', 1, 100, 'These shorts for kids feature a breathable and lightweight woven material and a relaxed fit for ease of movement. They have an elastic waistband with a drawstring for a secure fit and a side pocket for storage of small items.'),
(5, 71, 51, 'UNIQLO Commemorative RF Cap.png', 'Commemorative RF Cap', 'UNIQLO', '990.00', 1, 100, 'This stylish cap is designed to commemorate the 20th anniversary of UNIQLO\'s partnership with Roger Federer. It comes in a classic black color and features the RF logo embroidered in white on the front, and the UNIQLO logo on the back. Made of high-qualit'),
(5, 72, 51, 'UNIQLO UV Protection Denim Metro Hat.png', 'UV Protection Denim Metro Hat', 'UNIQLO', '990.00', 1, 100, 'This trendy denim hat from UNIQLO is perfect for protecting your face from the sun\'s harmful UV rays. It is designed with a wide brim and features a stylish washed denim look. Made with high-quality materials, it is durable and comfortable to wear.'),
(5, 73, 53, 'UNIQLO Sofia Coppola Cotton Tote Bag.png', 'Sofia Coppola Cotton Tote Bag', 'UNIQLO', '790.00', 1, 100, 'This UNIQLO tote bag is a collaboration with renowned filmmaker and designer Sofia Coppola. It features a simple yet elegant design, with a sleek black color and the words \"Sofia Coppola\" printed in white. Made of high-quality cotton, it is both stylish a'),
(5, 74, 52, 'UNIQLO Boston Square Sunglasses.png', 'UNIQLO Boston Square Sunglasses', 'UNIQLO', '990.00', 1, 100, 'These stylish sunglasses from UNIQLO are perfect for any sunny day. They feature a classic square design and come in a sleek black color. Made of high-quality materials, they are durable and comfortable to wear.'),
(5, 75, 52, 'H&M 6-pack earrings and studs.png', 'H&M 6-pack earrings and studs', 'H&M', '799.00', 1, 100, 'This set of earrings and studs from H&M is perfect for adding some variety to your jewelry collection. It includes six different pairs, each with a unique design. Made of high-quality materials, they are both durable and stylish.'),
(5, 76, 52, 'H&M Rectangular sunglasses.png', 'H&M Rectangular sunglasses', 'H&M', '599.00', 1, 100, 'These trendy sunglasses from H&M are perfect for any sunny day. They feature a sleek rectangular design and come in a classic red cheetah pattern color. Made of high-quality materials, they are durable and comfortable to wear.'),
(5, 77, 53, 'H&M x Keith Haring Small wallet.jpg', 'H&M x Keith Haring wallet', 'H&M', '999.00', 1, 100, 'This stylish wallet from H&M is part of a collaboration with iconic artist Keith Haring. It comes in a beautiful shade of black and features Haring\'s signature artwork printed on the front. Made of high-quality materials, it is both stylish and practical.'),
(5, 78, 51, 'H&M Patterned cotton bucket hat.png', 'H&M Checkered bucket hat', 'H&M', '599.00', 1, 100, 'A comfortable and stylish bucket hat made from soft and breathable cotton fabric. It features a fun pattern in various colors and has a wide brim to protect from the sun.'),
(5, 79, 52, 'H&M 9-pack rings.png', 'H&M 3-pack rings', 'H&M', '399.00', 1, 100, 'A set of eight assorted rings in different sizes and designs. The rings are made from metal and come in gold-tone or silver-tone finishes, with some adorned with stones or beads for added flair.'),
(5, 80, 53, 'H&M Black Wristlet.png', 'H&M Black Wristlet', 'H&M', '599.00', 1, 100, 'A compact and sleek wallet made from shiny silver-colored faux leather. It features multiple compartments for cards, bills, and coins, and has a zippered closure to keep everything secure'),
(5, 81, 53, 'UNIQLO Utility Neck Pouch.png', 'UNIQLO Utility Neck Pouch', 'UNIQLO', '790.00', 1, 100, 'A practical and versatile neck pouch made from sturdy and water-resistant nylon material. It has multiple compartments for organizing small essentials such as cards, keys, and phone, and can be worn around the neck or across the body.'),
(5, 82, 53, 'UNIQLO Nylon Body Bag.png', 'UNIQLO Nylon Body Bag', 'UNIQLO', '790.00', 1, 100, 'A lightweight and durable crossbody bag made from water-repellent nylon material. It features multiple compartments and pockets for organizing essentials and can be adjusted to fit comfortably around the body.'),
(5, 83, 52, 'H&M Braided belt.png', 'H&M Brown Braided belt', 'H&M', '799.00', 1, 100, 'A versatile and chic braided belt made from faux leather. It features a woven design with a metallic buckle and can be paired with jeans, pants, or dresses for a fashionable look.'),
(5, 84, 53, 'UNIQLO Roll Top Backpack.png', 'UNIQLO Roll Top Backpack', 'UNIQLO', '1990.00', 2, 100, 'This UNIQLO backpack is perfect for anyone on the go. It features a roll-top closure, which provides easy access to your belongings while keeping them secure. The backpack is made of durable, water-resistant material, and comes with adjustable straps for '),
(5, 85, 53, 'H&M Shoulder bag.png', 'H&M Shoulder bag', 'H&M', '1190.00', 1, 100, ' This stylish shoulder bag from H&M is perfect for any occasion. It comes in a classic black color. Made of high-quality materials, it is both durable and stylish.'),
(5, 86, 53, 'H&M Small shoulder bag.png', 'H&M Small shoulder bag', 'H&M', '1190.00', 1, 100, 'This stylish shoulder bag from H&M is perfect for any occasion. It comes in a classic pink color and features a sleek design with a magnetic snap closure. Made of high-quality materials, it is both durable and stylish.'),
(5, 87, 53, 'H&M Silver Wristlet.png', 'H&M Silver Wristlet', 'H&M', '599.00', 1, 100, 'A compact and sleek wallet made from shiny silver-colored faux leather. It features multiple compartments for cards, bills, and coins, and has a zippered closure to keep everything secure.'),
(5, 88, 52, 'UNIQLO Ines de la Fressange Narrow Belt.jpg', 'UNIQLO  Narrow Belt', 'UNIQLO', '1490.00', 3, 100, ': A stylish and elegant belt designed in collaboration with French fashion icon Ines de la Fressange. It features a slim and adjustable design, made from high-quality leather and finished with a polished buckle.'),
(5, 89, 52, 'H&M Satin scarf.png', 'H&M Pink Satin scarf ', 'H&M', '599.00', 2, 100, 'A soft and silky satin scarf that adds a touch of elegance to any outfit. It features a colorful pattern and can be worn in various ways, such as around the neck, as a headband, or tied to a bag.'),
(5, 90, 52, 'H&M Butterfly Necklace.png', 'H&M Butterfly Necklace ', 'H&M', '399.00', 1, 100, 'A delicate and charming necklace featuring a butterfly pendant. The pendant is adorned with small stones and hangs from a thin chain with an adjustable length. It is perfect for adding a touch of whimsy to any outfit.'),
(3, 91, 31, 'Mickey Short Sleeves Romper.png', 'Mickey Mouse Romper', 'Disney', '1499.00', 2, 100, 'This romper is a one-piece outfit that features short sleeves and shorts. It is made of soft, lightweight fabric and has a relaxed fit. It comes in a variety of colors and patterns to choose from.'),
(3, 92, 31, 'Baby Kimono Romper.png', 'Baby Kimono Romper ', 'Little Kooma', '790.00', 1, 100, 'This baby romper features a kimono-style design with wrap-around closure and jungle animal prints all over it. It is made of soft and breathable fabric, making it comfortable for babies to wear.'),
(3, 93, 31, 'Baby Girl Pink Rose Bodysuit Dress.png', 'Pink Rose Bodysuit Dress ', 'Little Kooma', '910.00', 1, 100, 'This two-piece set includes a white bodysuit dress with pink roses and a pink cardigan with \"I Love Mummy\" printed on it. The dress has short sleeves and a snap closure at the bottom, while the cardigan has long sleeves and button closure. It is made of s'),
(3, 94, 31, 'Baby girl short sleeves bodysuit dress.png', 'Baby girl ruffled bodysuit dress', 'Little Kooma', '770.00', 1, 100, 'This baby girl\'s bodysuit dress features ruffles, short sleeves, and a cute butterfly and flower print. It is made of soft and breathable fabric, providing comfort and ease of movement for little ones.'),
(3, 95, 31, 'Henri 3-Pack T-Shirts.png', 'Henri 3-Pack T-Shirts', 'Name It', '719.00', 1, 100, 'This set includes three short-sleeve T-shirts in different colors or patterns. They are made of soft and comfortable fabric, perfect for everyday wear. Disney Baby Mickey Mouse Round Neck T-shirt Bundle Of Two Ecru/Navy: This bundle includes two T-shirts '),
(3, 96, 31, 'Mickey Mouse T-shirt.png', 'Mickey Mouse T-shirt ', 'Disney', '599.00', 1, 100, 'This bundle of two Disney Baby Mickey Mouse Round Neck T-shirts in ecru and navy colors is the perfect addition to your little one\'s wardrobe. Made from soft and breathable materials, these shirts feature a cute Mickey Mouse graphic and are perfect for pl'),
(3, 97, 31, 'Mickey Mouse Jumper Set.png', 'Mickey Mouse Jumper Set', 'Disney', '999.00', 2, 100, 'Get ready to play and explore with this adorable Mickey Mouse Jumper Set! Made from soft and comfortable materials, this set includes a cute jumper with Mickey Mouse graphics, paired with coordinating pants. Perfect for little ones who love to move and gr'),
(3, 98, 32, 'Gingersnaps Taco Print Polo.png', 'Gingersnaps Dino Print Polo ', 'Gingersnaps', '799.00', 4, 100, 'Spice up your little boy\'s wardrobe with this fun and playful Taco Print Polo from Gingersnaps. Featuring a trendy taco print on a classic polo design, this shirt is perfect for casual outings or playdates with friends. Made with high-quality materials fo'),
(3, 99, 32, 'Gingersnaps Mao Collar.png', 'Gingersnaps Mao Collar ', 'Gingersnaps', '799.00', 2, 100, 'Add a touch of sophistication to your little boy\'s outfit with this elegant Mao Collar from Gingersnaps. This classic collar design adds a stylish edge to any top and is made with high-quality materials for long-lasting wear. Perfect for special occasions'),
(3, 100, 31, 'Baby Girl Cheongsam Romper.png', 'Baby Girl Cheongsam Romper', 'Little Kooma', '1100.00', 1, 12, 'This baby romper has a cheongsam-inspired design, featuring red and pink stripes with white flowers. It has a round neckline, short sleeves, and snap closure at the bottom for easy diaper changes. Made of soft and breathable fabric, it is comfortable for ');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `size_name`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XXL'),
(6, 'XXXL');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `categoryID` int(11) NOT NULL,
  `subCategoryID` int(11) NOT NULL,
  `subCategory` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`categoryID`, `subCategoryID`, `subCategory`) VALUES
(1, 11, 'TOPS'),
(1, 12, 'BOTTOMS'),
(1, 13, 'DRESSES'),
(1, 14, 'MATERNITY CLOTHES'),
(2, 21, 'T-SHIRTS'),
(2, 22, 'SHORTS'),
(2, 23, 'POLO-SHIRT'),
(2, 24, 'SWEATSHIRT'),
(2, 25, 'CROPPED PANTS'),
(2, 26, 'JACKETS'),
(3, 31, 'BABY BODYSUIT & ONE-PIECE (BABY)'),
(3, 32, 'TOP (BABY)'),
(3, 33, 'PANTS & LEGGINGS (BABY)'),
(3, 34, 'SOCK (BABY)'),
(4, 41, 'T-SHIRTS (CHILDREN)'),
(4, 42, 'SOCKS (CHILDREN)'),
(4, 43, 'PANTS (CHILDREN)'),
(4, 44, 'DRESSES (CHILDREN)'),
(4, 45, 'SHORTS (CHILDREN)'),
(5, 51, 'HEADWEAR'),
(5, 52, 'BODY ACCESSORIES'),
(5, 53, 'BAGS');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contactnumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`userid`, `username`, `password`, `firstname`, `lastname`, `email`, `address`, `contactnumber`) VALUES
(35, 'admin01', '$2y$10$53cvIX.vBK6tQ1OEcQmlwu3ZyYnVXiU0ptoumF8Kd0sojJL/GioZC', 'IT2A', 'Admin', 'admin@letran.edu.ph', 'Intramuros', '0927012643'),
(41, 'pauldimaunahan', '$2y$10$ILjQSB9Ydiv8w3wug7AzYuYE2j6dQuaS/OnjehNP0/6Nc35elPKbC', 'Paul', 'Dimaunahan', 'dimaunahan.paul203@gmail.com', 'Bucandala 3, Imus', '09053935415'),
(44, 'shaymarasigan', '$2y$10$cF19Zu1DUgeUWxd2oHWGp.b72t2NKFDC8nyHGNB/TueNcA4PTCTAe', 'Shayyanne Dominiq', 'Marasigan', 'shayyannedominiq.marasigan@letran.edu.ph', '2114 F. Munoz St. Malate Manila', '09270812643'),
(45, 'raizenplanas', '$2y$10$Dx678dkoPD8pYhG3X0YT1.W2uesw6yOOeRDO17WIpfx6MZ5T7Uwjq', 'Raizen', 'Planas', 'raizen.planas@letran.edu.ph', 'Sta. Mesa Manila', '09154981237'),
(46, 'lexinemontemayor', '$2y$10$NPe9EG78ebd0T/VsVyIkLulAnvlEEMDuCYlCdqcnVOZvcAllgH3RW', 'Lexine Rae', 'Montemayor', 'lexinerae.montemayor@letran.edu.ph', 'Blumentritt', '09274983823'),
(47, 'jeffdallo', '$2y$10$0Xug3LixobYwDkYaD5.lE.AtYTqz3HzTAKFX2l9jI9s2Rz6SfiGBe', 'Jeff Matthew', 'Dallo', 'jeffmatthew.dallo@letran.edu.ph', 'Caloocan\nCity', '09171304132');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `fk_productID` (`productID`),
  ADD KEY `user_id_fk` (`userid`),
  ADD KEY `product_name_fk` (`productName`),
  ADD KEY `product_stock_fk` (`productStock`),
  ADD KEY `product_price_fk` (`productPrice`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `inquiry_tbl`
--
ALTER TABLE `inquiry_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `productID` (`productID`) USING BTREE,
  ADD KEY `fk_userid` (`userid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `FK_subcategory` (`subcategoryID`),
  ADD KEY `fk_size` (`productSize`),
  ADD KEY `productName` (`productName`) USING BTREE,
  ADD KEY `productStock` (`productStock`) USING BTREE,
  ADD KEY `productPrice` (`productPrice`) USING BTREE,
  ADD KEY `productPrice_2` (`productPrice`) USING BTREE,
  ADD KEY `productBrand` (`productBrand`),
  ADD KEY `productImage` (`productImage`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subCategoryID`),
  ADD KEY `fk_categoryID` (`categoryID`) USING BTREE;

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `username_3` (`username`),
  ADD UNIQUE KEY `address` (`address`),
  ADD UNIQUE KEY `contactnumber` (`contactnumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `inquiry_tbl`
--
ALTER TABLE `inquiry_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10589;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD CONSTRAINT `fk_productID` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`userid`) REFERENCES `user_tbl` (`userid`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`productSize`) REFERENCES `size` (`size_id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `fk_categoryID` FOREIGN KEY (`categoryID`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
