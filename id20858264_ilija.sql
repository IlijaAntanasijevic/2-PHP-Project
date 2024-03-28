-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2024 at 10:36 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20858264_ilija`
--

-- --------------------------------------------------------

--
-- Table structure for table `brend`
--

CREATE TABLE `brend` (
  `brend_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brend`
--

INSERT INTO `brend` (`brend_id`, `name`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'New Balance'),
(4, 'Reebok');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(255) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `date_create`, `user_id`) VALUES
(33, '2023-05-28 17:39:17', 32),
(34, '2023-05-28 17:39:45', 32),
(35, '2023-05-28 17:45:50', 32),
(36, '2023-05-28 17:51:24', 32),
(37, '2023-05-30 17:35:28', 32),
(38, '2023-06-02 18:21:12', 32),
(39, '2023-06-02 19:34:52', 32),
(40, '2023-06-02 19:52:27', 32),
(41, '2023-06-02 19:54:51', 32),
(42, '2023-06-02 23:04:36', 34),
(44, '2023-06-05 22:36:44', 35);

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `cp_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `cart_id` int(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`cp_id`, `product_id`, `cart_id`, `quantity`) VALUES
(111, 4, 37, 1),
(113, 8, 37, 1),
(114, 5, 37, 1),
(115, 11, 38, 1),
(116, 3, 38, 1),
(117, 2, 39, 1),
(119, 11, 40, 1),
(120, 3, 40, 1),
(121, 2, 40, 1),
(129, 3, 41, 1),
(130, 4, 41, 1),
(131, 7, 41, 3),
(132, 11, 42, 1),
(136, 13, 44, 1),
(137, 14, 44, 1),
(138, 9, 44, 1),
(139, 9, 44, 1),
(140, 12, 44, 1),
(143, 6, 44, 1),
(144, 6, 44, 1),
(145, 13, 44, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Sport'),
(2, 'Casual'),
(3, 'Lifestyle');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `color_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `name`) VALUES
(1, 'Black'),
(2, 'White'),
(3, 'Red'),
(4, 'Green'),
(5, 'Grey'),
(6, 'Blue'),
(7, 'Brown');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `answer_id` int(255) DEFAULT NULL,
  `product_id` int(255) NOT NULL,
  `active` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `comment`, `date`, `answer_id`, `product_id`, `active`) VALUES
(1, 33, 'These sneakers are incredibly stylish and versatile. I love how they effortlessly elevate any outfit!', '2023-06-05 21:56:05', NULL, 12, 1),
(2, 34, 'I agree, they are very comfortable and not expensive', '2023-06-05 21:57:05', 1, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(255) NOT NULL,
  `value` int(100) NOT NULL,
  `date_to` date NOT NULL,
  `product_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `value`, `date_to`, `product_id`) VALUES
(3, 10, '2023-06-30', 2),
(5, 10, '2023-05-30', 4);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` int(255) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `name`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Unisex');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(255) NOT NULL,
  `path` varchar(100) NOT NULL,
  `product_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `nav_id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`nav_id`, `name`, `path`) VALUES
(1, 'Home', 'home'),
(2, 'Shop', 'shop'),
(3, 'Login', 'login'),
(4, 'Contact', 'contact'),
(5, 'Author', 'author'),
(7, '/', 'cart'),
(8, 'Admin', 'admin.php');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price_id` int(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `product_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `price`, `date`, `product_id`) VALUES
(1, 150.00, '2023-01-01', 1),
(2, 150.00, '2023-05-08', 2),
(3, 60.00, '2023-05-08', 3),
(4, 180.00, '2023-05-01', 4),
(5, 220.00, '2023-05-08', 5),
(7, 120.00, '2023-05-07', 4),
(8, 99.00, '2023-05-08', 7),
(9, 120.00, '2023-05-08', 8),
(10, 60.00, '2023-05-08', 9),
(11, 180.00, '2023-05-08', 10),
(12, 70.99, '2023-05-08', 6),
(13, 170.00, '2022-05-11', 11),
(69, 120.00, '2023-05-30', 2),
(70, 120.00, '2023-05-30', 8),
(71, 130.00, '2023-05-30', 1),
(73, 169.00, '2023-06-02', 11),
(80, 150.00, '2023-06-05', 12),
(81, 200.00, '2023-06-05', 13),
(82, 80.00, '2023-06-05', 14),
(83, 130.00, '2024-03-01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `description` varchar(1500) NOT NULL,
  `quantity` int(100) NOT NULL,
  `brend_id` int(255) NOT NULL,
  `color_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `gender_id` int(255) NOT NULL,
  `main_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `date`, `description`, `quantity`, `brend_id`, `color_id`, `category_id`, `gender_id`, `main_img`) VALUES
(1, 'Adidas Originals NDM', '2023-05-02', 'The NMD\'s design draws inspiration from adidas\' rich heritage while incorporating contemporary elements. The upper of the shoe often features a combination of breathable and flexible Primeknit material, which hugs the foot and provides a sock-like fit. This lightweight and adaptive material allows for a comfortable and supportive feel during wear.\r\n\r\nThe NMD is characterized by its distinctive midsole design, which incorporates adidas\' Boost cushioning technology. Boost is a responsive and energy-returning foam that provides exceptional cushioning and comfort. The Boost midsole extends from the heel to the forefoot, offering a consistent and plush underfoot feel.', 15, 2, 7, 2, 1, '647e17b3eb92f.png'),
(2, 'Nike Air Max 1', '2023-05-08', 'The Air Max 1 features a low-top silhouette with a combination of mesh, leather, and synthetic materials on the upper. The upper construction provides durability, breathability, and support for the foot. The design typically includes multiple overlays, creating a layered and textured look that adds visual interest to the shoe.\r\n\r\nOne of the most distinctive features of the Air Max 1 is the visible Air unit in the heel. This groundbreaking technology, pioneered by Nike, involves a cushioning system that utilizes compressed air to absorb impact and provide a comfortable and responsive feel. The Air unit is typically encapsulated within a polyurethane midsole for added stability and cushioning throughout the entire foot.', 20, 1, 7, 2, 3, '647e27c0ed1d0.png'),
(3, 'Yeezy 350', '2023-05-09', 'The Yeezy Boost 350 is a highly coveted sneaker collaboration between adidas and Kanye West under the Yeezy brand. The Yeezy 350 is known for its minimalist design, comfortable fit, and premium materials, making it a sought-after choice for sneaker enthusiasts and fashion-forward individuals.\r\n\r\nThe upper of the Yeezy Boost 350 is typically constructed from Primeknit material, which is a flexible and breathable fabric that conforms to the shape of the foot. The Primeknit upper provides a snug and sock-like fit, ensuring a comfortable and supportive feel. The design of the upper often includes a unique pattern and texture, adding visual interest to the shoe.\r\n\r\nOne of the distinctive features of the Yeezy 350 is the absence of a traditional tongue. Instead, the collar of the shoe extends upward, providing a sleek and streamlined look. This design element enhances the overall aesthetics of the shoe while maintaining a comfortable fit around the ankle.', 30, 2, 5, 2, 1, '647e1a3b63888.png'),
(4, 'Nike Air Huarache', '2023-05-08', 'RandomThe Huarache features a neoprene sock-like bootie construction that wraps snugly around the foot, providing a secure and customized fit. This innovative design, inspired by the snug fit of a water-skiing boot, offers a comfortable and supportive feel. The neoprene material is known for its flexibility and stretch, allowing for natural foot movement.\r\n\r\nThe upper of the Nike Huarache often incorporates synthetic leather overlays, which enhance durability and structure while adding visual interest to the shoe. The signature feature of the Huarache is the exoskeleton-like heel strap that provides additional support and stability.\r\n\r\nThe midsole of the Huarache usually includes Nike\'s Air cushioning technology, which offers responsive and lightweight cushioning for a comfortable stride. Some variations of the Huarache may also incorporate Phylon foam in the midsole, which further enhances shock absorption and overall comfort.', 5, 1, 5, 2, 3, '647e1a8cf3b23.png'),
(5, 'Adidas Superstar', '2023-05-08', 'The adidas Superstar is characterized by its timeless and sleek design. The upper of the shoe is typically made of smooth leather, which provides durability and a clean aesthetic. The signature feature of the Superstar is the rubber shell toe cap, which offers protection and adds a distinct look to the shoe.\r\n\r\nThe Superstar features a low-top silhouette, allowing for freedom of movement and a versatile style that can be paired with various outfits. The sneaker incorporates a lace-up closure system that allows for a secure and customizable fit.\r\n\r\nComfort is a priority in the adidas Superstar, with a cushioned insole and a padded collar and tongue providing additional support and a plush feel during wear. The shoe also features a breathable textile lining that helps to keep the foot cool and comfortable.', 30, 2, 2, 3, 1, '647e17d3ab321.png'),
(6, 'Nike Air Force 1', '2023-05-08', 'One of the most recognizable features of the Air Force 1 is the chunky and cushioned midsole, which incorporates Nike\'s Air technology. This visible Air unit in the heel provides superior cushioning and impact absorption, offering a comfortable and responsive feel during wear.\r\n\r\nThe sneaker showcases a versatile design that can be easily styled for both casual and athletic looks. The Air Force 1 is known for its signature perforations on the toe box, which not only add ventilation but also contribute to its distinctive aesthetic. Additionally, the shoe features a padded collar and tongue for enhanced comfort and support around the ankle.', 10, 1, 6, 3, 1, '647e1a5959a70.png'),
(7, 'Nike Air Force 1', '2023-05-06', 'One of the most recognizable features of the Air Force 1 is the chunky and cushioned midsole, which incorporates Nike\'s Air technology. This visible Air unit in the heel provides superior cushioning and impact absorption, offering a comfortable and responsive feel during wear.\r\n\r\nThe sneaker showcases a versatile design that can be easily styled for both casual and athletic looks. The Air Force 1 is known for its signature perforations on the toe box, which not only add ventilation but also contribute to its distinctive aesthetic. Additionally, the shoe features a padded collar and tongue for enhanced comfort and support around the ankle.', 11, 1, 2, 3, 3, '647e1810e2e05.png'),
(8, 'Nike Air VaporMax', '2023-05-08', 'The standout feature of the Air VaporMax is its full-length Air cushioning system. Unlike traditional sneakers that have foam midsoles, the VaporMax replaces the foam with individual Air pods placed directly underfoot. These Air pods are interconnected, creating a responsive and flexible platform that offers a lightweight and bouncy feel with every step.\r\n\r\nThe absence of a traditional foam midsole not only reduces the overall weight of the shoe but also allows for increased flexibility and a more natural range of motion. This design innovation provides a truly \"walking on air\" sensation, where the Air pods compress and spring back with each stride, providing enhanced cushioning and energy return.', 30, 1, 3, 1, 2, '647e185ce532c.png'),
(9, 'Rebook Classic', '2023-05-08', 'Reebok is a globally recognized footwear brand known for its athletic performance shoes and stylish lifestyle sneakers. With a history dating back to the 1950s, Reebok has continuously delivered innovative and quality footwear options for athletes and individuals seeking comfort and style.\r\n\r\nReebok offers a diverse range of shoe models, catering to various sports, activities, and personal preferences. Whether you\'re looking for running shoes, training shoes, basketball sneakers, or casual lifestyle footwear, Reebok has options to suit different needs.\r\n\r\nComfort is a top priority for Reebok, and their shoes incorporate cushioning technologies that provide optimal support and impact absorption. Some popular cushioning systems used by Reebok include EVA (ethylene-vinyl acetate) foam, DMX (Dynamic Motion X) cushioning, and Floatride foam. These technologies deliver a comfortable and responsive underfoot feel, reducing fatigue and enhancing performance.', 8, 4, 2, 2, 3, '647e26393120e.png'),
(10, 'New Balance', '2023-05-08', 'New Balance shoes are known for their exceptional quality, comfort, and performance. With a commitment to craftsmanship and innovative technologies, New Balance offers a diverse range of footwear options for various sports, activities, and lifestyles.\r\n\r\nOne of the key features of New Balance shoes is their attention to fit. New Balance understands that every foot is unique, and they offer a variety of width options to accommodate different foot shapes. This focus on fit ensures a comfortable and supportive experience, reducing the risk of discomfort or injury during wear.\r\n\r\nNew Balance incorporates advanced cushioning technologies into their shoes to provide optimal comfort and impact absorption. One of their most popular cushioning systems is Fresh Foam, which offers a plush and responsive feel underfoot. This lightweight foam delivers a smooth and cushioned ride, making it ideal for running and other athletic activities.', 50, 3, 3, 2, 1, '647e18355898d.png'),
(11, 'Nike Air Zoom', '2023-05-16', 'Nike Air Zoom is a technology used in various Nike footwear models to provide responsive cushioning and enhanced comfort during athletic activities. It is designed to deliver a lightweight and supportive experience, particularly for running and other high-impact sports.\r\n\r\nThe Air Zoom technology utilizes pressurized air units within the midsole of the shoe. These air units are strategically placed in specific areas, typically in the forefoot or heel, to provide targeted cushioning and shock absorption where it is most needed during movement.\r\n\r\nThe Air Zoom units are encased in lightweight and durable materials, such as polyurethane or TPU, which help maintain their structural integrity and responsiveness over time. The pressurized air inside the units compresses upon impact and then quickly returns to its original state, delivering a spring-like effect that propels the foot forward and reduces the strain on joints and muscles.', 20, 1, 3, 1, 2, '647e1a73ba4b2.png'),
(12, 'New Balance 550', '2023-06-05', 'The New Balance 550 is a retro-inspired sneaker that combines classic design elements with modern comfort. It draws inspiration from basketball shoes of the 1980s and is known for its clean and sleek silhouette.\r\n\r\nThe upper of the New Balance 550 is typically crafted from a combination of premium leather and mesh materials. This blend of materials provides durability, breathability, and a stylish aesthetic. The leather overlays offer structural support and a touch of retro flair, while the mesh panels allow for airflow, keeping the foot cool and comfortable.\r\n\r\nThe New Balance 550 features a low-top design, allowing for a versatile style that can be easily paired with different outfits. It incorporates a lace-up closure system, which provides a secure and customizable fit, ensuring optimal support during wear.', 20, 3, 2, 3, 2, '647e26dc5a6de.png'),
(13, 'New Balance 550', '2023-06-05', 'The New Balance 550 is a retro-inspired sneaker that combines classic design elements with modern comfort. It draws inspiration from basketball shoes of the 1980s and is known for its clean and sleek silhouette.\r\n\r\nThe upper of the New Balance 550 is typically crafted from a combination of premium leather and mesh materials. This blend of materials provides durability, breathability, and a stylish aesthetic. The leather overlays offer structural support and a touch of retro flair, while the mesh panels allow for airflow, keeping the foot cool and comfortable.\r\n\r\nThe New Balance 550 features a low-top design, allowing for a versatile style that can be easily paired with different outfits. It incorporates a lace-up closure system, which provides a secure and customizable fit, ensuring optimal support during wear.', 15, 3, 2, 3, 3, '647e270b7b4aa.png'),
(14, 'Rebook Classic', '2023-06-05', 'Reebok is a globally recognized footwear brand known for its athletic performance shoes and stylish lifestyle sneakers. With a history dating back to the 1950s, Reebok has continuously delivered innovative and quality footwear options for athletes and individuals seeking comfort and style.\r\n\r\nReebok offers a diverse range of shoe models, catering to various sports, activities, and personal preferences. Whether you\'re looking for running shoes, training shoes, basketball sneakers, or casual lifestyle footwear, Reebok has options to suit different needs.\r\n\r\nComfort is a top priority for Reebok, and their shoes incorporate cushioning technologies that provide optimal support and impact absorption. Some popular cushioning systems used by Reebok include EVA (ethylene-vinyl acetate) foam, DMX (Dynamic Motion X) cushioning, and Floatride foam. These technologies deliver a comfortable and responsive underfoot feel, reducing fatigue and enhancing performance.', 20, 4, 2, 2, 3, '647e3e1642174.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `order_id` int(255) NOT NULL,
  `cart_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(150) NOT NULL,
  `postcode` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(150) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`order_id`, `cart_id`, `name`, `last_name`, `phone`, `address`, `city`, `postcode`, `email`, `company`, `description`, `total`, `date`) VALUES
(12, 37, 'Ilija', 'Antanasijevic', '060999999', 'Test', 'Test', 12345, 'ilija@gmail.com', '', '', 679.00, '2023-05-24 18:20:54'),
(13, 38, 'Ilija', 'Antanasijevic', '060999999', 'Test', 'Test', 12345, 'ilija@gmail.com', '', '', 230.00, '2023-06-02 19:32:02'),
(14, 39, 'Ilija', 'Antanasijevic', '060999999', 'Test', 'Test', 12345, 'ilija@gmail.com', '', '', 100.00, '2023-06-02 19:41:22'),
(15, 40, 'Ilija', 'Antanasijevic', '060999999', 'Test', 'Test', 12345, 'ilija@gmail.com', '', '', 529.00, '2023-06-02 19:54:41'),
(16, 41, 'Ilija', 'Antanasijevic', '060999999', 'Test', 'Test', 12345, 'ilija@gmail.com', '', 'TEST', 736.00, '2023-06-02 22:36:42'),
(17, 42, 'Sara', 'James', '256985432', 'Test', 'Test', 12345, 'sara.james@gmail.com', '', '', 369.00, '2023-06-02 23:04:57'),
(19, 44, 'Philip', 'Rogers', '2568753514', 'Test', 'Test', 12345, 'philip.rogers@gmail.com', '', '', 280.00, '2023-06-05 22:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(255) NOT NULL,
  `rating` tinyint(5) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `rating`, `description`, `date`, `user_id`, `product_id`) VALUES
(1, 5, 'Great sneakers', '2023-06-05 22:05:13', 34, 12),
(2, 4, NULL, '2023-06-05 22:05:59', 36, 12);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `name`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `username` varchar(150) NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `name`, `last_name`, `email`, `phone`, `password`, `role_id`) VALUES
(32, 'ilija0125', 'Ilija', 'Antanasijevic', 'ilija@gmail.com', '060999999', 'e4baedb51d8bfdd71f48c54340b988aepsw', 2),
(33, 'keith123', 'Keith', 'Johnson', 'keith.johnson@gmail.com', '123456898', 'f94b937b40c946b916c63a1b638ee956psw', 1),
(34, 'saraJames', 'Sara', 'James', 'sara.james@gmail.com', '256985432', 'f94b937b40c946b916c63a1b638ee956psw', 1),
(35, 'philipppp', 'Philip', 'Rogers', 'philip.rogers@gmail.com', '2568753514', 'f94b937b40c946b916c63a1b638ee956psw', 1),
(36, 'maria_perry', 'Maria', 'Perry', 'maria.perry@gmail.com', '147852652', 'f94b937b40c946b916c63a1b638ee956psw', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brend`
--
ALTER TABLE `brend`
  ADD PRIMARY KEY (`brend_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`cp_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`nav_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brend_id` (`brend_id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `gender_id` (`gender_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brend`
--
ALTER TABLE `brend`
  MODIFY `brend_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `cp_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `nav_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `price_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `cart_product_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brend_id`) REFERENCES `brend` (`brend_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `color` (`color_id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`gender_id`);

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
