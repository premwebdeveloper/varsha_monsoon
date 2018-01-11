-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2018 at 05:59 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`, `status`) VALUES
(1, 'aaa', 1),
(2, 'bbb', 1),
(3, 'ABC', 1),
(4, 'XYZ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `breakfast_lunch_dinner`
--

CREATE TABLE `breakfast_lunch_dinner` (
  `id` int(11) NOT NULL,
  `meal_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breakfast_lunch_dinner`
--

INSERT INTO `breakfast_lunch_dinner` (`id`, `meal_name`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_date`, `updated_date`, `status`) VALUES
(1, 10, 33, 2, '2017-11-14 17:28:08', '2017-11-29 16:15:49', 1),
(10, 9, 29, 3, '2017-11-15 09:58:16', '2017-11-15 09:59:18', 1),
(11, 9, 28, 2, '2017-11-15 09:58:16', '2017-11-15 09:58:16', 1),
(18, 10, 36, 2, '2017-11-29 14:54:39', '2017-11-29 14:54:39', 1),
(19, 10, 35, 1, '2017-11-29 16:05:40', '2017-11-29 16:05:40', 1),
(20, 10, 40, 1, '2017-11-29 16:07:18', '2017-11-29 16:07:18', 1),
(21, 31, 40, 2, '2017-12-01 09:58:07', '2017-12-01 09:58:07', 1),
(22, 32, 40, 1, '2017-12-01 12:27:51', '2017-12-01 12:27:51', 1),
(23, 32, 28, 3, '2017-12-01 12:34:27', '2017-12-01 12:34:27', 1),
(24, 32, 30, 1, '2017-12-01 12:35:42', '2017-12-01 12:35:42', 1),
(25, 32, 31, 1, '2017-12-01 12:58:37', '2017-12-01 12:58:37', 1),
(26, 32, 34, 4, '2017-12-01 12:59:58', '2017-12-01 12:59:58', 1),
(27, 32, 35, 1, '2017-12-01 13:26:35', '2017-12-01 13:26:35', 1),
(28, 32, 29, 2, '2017-12-01 14:21:48', '2017-12-01 14:21:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `status`) VALUES
(1, 'cat 1', 1),
(2, 'cat 2', 1),
(3, 'cat 3', 1),
(4, 'cat 4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_images`
--

CREATE TABLE `food_images` (
  `id` int(11) NOT NULL,
  `food_listing_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_images`
--

INSERT INTO `food_images` (`id`, `food_listing_id`, `image`, `status`) VALUES
(187, 28, 'Rasgulla-2.jpg', 1),
(188, 28, 'Rasgulla-pic-1_thumb.jpg', 1),
(189, 28, 'rasagulla.jpg', 1),
(190, 29, 'gulab-jamun.jpg', 1),
(191, 29, 'gulab_jamun_2014.jpg', 1),
(192, 29, 'gulabs.jpg', 1),
(193, 30, 'peda.jpg', 1),
(194, 31, 'IMG_1880.JPG', 1),
(195, 31, 'ras_malai.jpg', 1),
(196, 32, '13D966467BD08BE9_Gulab-halwa-3.jpg', 1),
(197, 32, 'gulab-halwa-indian-sweet-food-isolate-white-90621876.jpg', 1),
(198, 32, 'gulab.jpg', 1),
(199, 31, 'Delicious-Bengali-RASMALAI-Classic-Bengali-Ras-Malai.jpg', 1),
(200, 30, 'pedaas.jpg', 1),
(202, 33, 'maxresdefault.jpg', 1),
(203, 33, 'paneer-lababdar.jpg', 1),
(204, 34, 'KallummakayaBiriyani.jpg', 1),
(205, 34, 'main-qimg-a41a7feb6989721076588beac75b2ab3-c.jpg', 1),
(206, 34, 'mm.jpg', 1),
(207, 34, 'mumbai-style-veg-swasthis-recipes.jpg', 1),
(208, 35, 'Special-Thali_1423637207.jpg', 1),
(209, 35, 'normal_thali.jpg', 1),
(210, 35, 'north-indian-dish-malai.jpg', 1),
(211, 35, 'thalies.jpg', 1),
(212, 36, 'DSCN4026.JPG', 1),
(213, 36, 'bati-dal-churma-625_625x350_61448611452.jpg', 1),
(214, 36, 'daal_bati_pakwan_520_070915013641.jpg', 1),
(215, 37, 'samosa-recipe-snacks-recipes.jpg', 1),
(216, 37, 'samosaaaa.jpg', 1),
(217, 37, 'samosss.jpg', 1),
(218, 38, 'kachoris.jpg', 1),
(219, 38, 'kachorooo.jpg', 1),
(220, 39, 'gulab-jamun1.jpg', 1),
(221, 39, 'gulabs1.jpg', 1),
(222, 40, 'mumbai-style-veg-swasthis-recipes1.jpg', 1),
(223, 40, 'slide-3.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_listings`
--

CREATE TABLE `food_listings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_type` int(11) NOT NULL,
  `food_category` int(11) DEFAULT NULL,
  `breakfast_lunch_dinner` int(11) DEFAULT NULL,
  `optional_category` varchar(255) DEFAULT NULL,
  `food_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `today_delivery_by_seller` tinyint(4) DEFAULT NULL,
  `created_on` date NOT NULL,
  `updated_on` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_listings`
--

INSERT INTO `food_listings` (`id`, `user_id`, `food_type`, `food_category`, `breakfast_lunch_dinner`, `optional_category`, `food_name`, `description`, `price`, `image`, `today_delivery_by_seller`, `created_on`, `updated_on`, `status`) VALUES
(28, 8, 1, 1, 1, NULL, 'Rasgulla', 'Rasgulla is a syrupy dessert popular in the Indian subcontinent and regions with South Asian diaspora. It is made from ball shaped dumplings of chhena and semolina dough, cooked in light syrup made of sugar.', 120, 'index.jpg', NULL, '2017-10-30', '2017-11-08', 1),
(29, 8, 1, 2, 1, NULL, 'Gulab Jamun', 'Homemade gulab jamun is usually made up of powdered milk, a pinch of all-purpose flour (optional), baking powder and clarified butter (ghee); kneaded to form a dough, moulded into balls, deep fried and dropped into simmering sugar syrup', 110, '56a288e117d3f8_50310584.jpg', NULL, '2017-10-30', '2017-10-30', 1),
(30, 8, 1, 3, 2, NULL, 'Mava Peda', 'Peda (pronounced [?pe??a?]) is a sweet from the Indian subcontinent, usually prepared in thick, semi-soft pieces. The main ingredients are khoa, sugar and traditional flavorings, including cardamom seeds, pistachio nuts and saffron.', 80, 'kesar-peda.jpg', NULL, '2017-10-30', '2017-10-30', 1),
(31, 8, 1, 4, 2, NULL, 'Rash Malai', 'Ras malai or rossomalai is a dessert originating from the south asia. The name ras malai comes from two words in Hindi: ras, meaning &quot;juice&quot;, and malai, meaning &quot;cream&quot;. It has been described as &quot;a rich cheesecake without a crust&quot;', 50, '640x478_ac.jpg', NULL, '2017-10-30', '2017-10-30', 1),
(32, 8, 1, 5, 2, NULL, 'Gulab Halwa', 'Gulab Halwa from halwai sweets is considered to be the pride of Marwar. Adeptly cooked with the right balance of milk, sugar, ghee and pistachio this gulab halwa qualifies to be the unsurpassed king of desserts. Edible silver foil on the top makes it a preeminent gift box too!', 100, '2-500x500.jpg', NULL, '2017-10-30', '2017-10-30', 1),
(33, 8, 1, 6, 3, NULL, 'Matar Panner', 'matar paneer or mutter paneer recipe with step by step photos – one popular paneer recipe amongst all the north indian paneer recipes. ... so here is a simple and easy recipe for matar paneer. ... i have also shared spicy dhaba style matar paneer recipe which taste awesome', 90, 'matar-paneer-recipe.jpg', NULL, '2017-10-30', '2017-11-11', 1),
(34, 8, 2, 7, 3, NULL, 'Matan Biriyani', 'Biryani, also known as biriyani, biriani or briyani, is a South Asian mixed rice dish with its origins among the Muslims of the South Asia. It is popular throughout the South Asia and among the diaspora from the region.', 60, 'biriyanii.jpg', NULL, '2017-10-30', '2017-10-30', 1),
(35, 8, 2, 8, 3, NULL, 'Special Thali', 'Indian Special Thali means an Indian Plate, that is made up of variety of Indian vegetables. You can make your favorite Thali by adding the veggies, rice and chapati of your choice. This is the Special tasty-indian-recipes.com Thali, that is fulfilled with lots of healthy salad and nutritional vegetables. You can see the steamed rice, vegetables made with very less oil, yogurt, chapati, pickle and roasted papad.', 20, 'Ghar-Ki-Thali-Menu_1.jpg', NULL, '2017-10-30', '2017-10-30', 1),
(36, 8, 1, 9, 3, NULL, 'Dal Bati Churma', 'Rajasthani food is incomplete without the mention of the famed Dal-Baati-Churma. It consists of baatis or flaky round breads baked over firewood or over kandas (i.e. cow dung cakes) as done in villages. Baatis can be baked in a gas tandoor or an electric oven as well. But one thing common for baatis, irrespective of their cooking technique is that they are always served dipped in ghee accompanied with panchmel or panch kutti dal and churma. The dal is cooked with ghee, the masalas in the dal are fried in ghee and more ghee is mixed into the dal before serving. Often a large batch of baatis is made and part of the dough is left unsalted. This unsalted dough then shaped into rounds and deep fried in ghee. Later these deep fried baatis are crushed and sugar or jaggery is mixed into them to make a sweet dessert- churma. The three together, simple though they sound, make a very filling meal. No Rajasthani festive or wedding menu is complete without this popular recipe', 10, '19729847952_b5cc81291a_o.jpg', NULL, '2017-10-30', '2017-10-30', 1),
(37, 8, 1, 10, 3, NULL, 'Samosa', 'https://en.wikipedia.org/wiki/SamosaThe samosa is made with a wheat flour or maida flour shell stuffed with some filling, generally a mixture of mashed boiled potato, onions, green peas, spices and green chili or fruits. The entire pastry is then deep-fried to a golden brown color, in vegetable oil.', 30, 'samosaaa.jpg', NULL, '2017-10-30', '2017-10-30', 1),
(38, 8, 1, 1, 3, NULL, 'Kachori', 'Kachori is a spicy snack from India, also eaten in other parts of South Asia, and common in places with South Asian diaspora, such as Trinidad and Tobago, Guyana, and Suriname. Alternative names for the snack include kachauri, kachodi and katchuri.', 5, 'kachori.jpg', NULL, '2017-10-30', '2017-10-30', 1),
(40, 8, 2, 2, 3, NULL, 'Chicken BIriyani', 'Chicken BIriyani', 25, 'masala_kachori-620.jpg', NULL, '2017-11-11', '2017-11-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_types`
--

CREATE TABLE `food_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_types`
--

INSERT INTO `food_types` (`id`, `type`) VALUES
(1, 'Pure Veg'),
(2, 'Non Veg');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'user', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(100) DEFAULT NULL,
  `created_on` date NOT NULL,
  `updated_on` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `title`, `price`, `description`, `image`, `created_on`, `updated_on`, `status`) VALUES
(2, 'offer 1', '128', '', 'paneer.jpg', '2018-01-11', '2018-01-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `sku_code` varchar(255) DEFAULT NULL,
  `price1` varchar(255) DEFAULT NULL,
  `price2` varchar(255) DEFAULT NULL,
  `description` text,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `sub_category_id`, `name`, `sku_code`, `price1`, `price2`, `description`, `created_date`, `updated_date`, `status`) VALUES
(1, 3, 3, NULL, 'product 1', '001', '259', '199', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-12-29 16:45:04', '2017-12-29 16:45:04', 0),
(2, 4, 1, NULL, 'Product 2', '002', '599', '439', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-12-29 16:46:17', '2017-12-29 16:46:17', 1),
(3, 2, 2, NULL, 'Product 3', '003', '999', '899', '', '2017-12-29 16:47:55', '2017-12-29 16:47:55', 1),
(4, 3, 3, NULL, 'Prod Four', '004', '295', '395', 'Desc', '2018-01-11 12:07:44', '2018-01-11 15:07:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_available_on`
--

CREATE TABLE `product_available_on` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `available_on` tinyint(4) DEFAULT NULL,
  `available_weak_days` varchar(255) DEFAULT NULL,
  `available_on_date` date DEFAULT NULL,
  `available_from_time` time DEFAULT NULL,
  `available_to_time` time DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_date`, `updated_date`, `status`) VALUES
(1, 1, '13245.jpg', '2017-12-29 16:45:04', '2017-12-29 16:45:04', 0),
(2, 1, 'download.jpg', '2017-12-29 16:45:04', '2017-12-29 16:45:04', 0),
(3, 1, 'landlord.jpg', '2017-12-29 16:45:04', '2017-12-29 16:45:04', 0),
(4, 2, '132451.jpg', '2017-12-29 16:46:17', '2017-12-29 16:46:17', 1),
(6, 2, 'headshot.jpg', '2017-12-29 16:46:17', '2017-12-29 16:46:17', 1),
(7, 2, 'HIGH_CORT.jpg', '2017-12-29 16:46:17', '2017-12-29 16:46:17', 1),
(8, 3, '132452.jpg', '2017-12-29 16:47:55', '2017-12-29 16:47:55', 1),
(9, 4, 'rolls.jpg', '2018-01-11 12:07:44', '2018-01-11 12:07:44', 1),
(11, 4, 'sweetdises.jpg', '2018-01-11 12:07:44', '2018-01-11 12:07:44', 1),
(13, 4, 'Biriyani1.jpg', '2018-01-11 14:51:33', '2018-01-11 14:51:33', 1),
(15, 4, 'Northindian.jpg', '2018-01-11 15:07:08', '2018-01-11 15:07:08', 1),
(16, 4, 'paneer.jpg', '2018-01-11 15:07:08', '2018-01-11 15:07:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(100) DEFAULT NULL,
  `created_on` date NOT NULL,
  `updated_on` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `description`, `image`, `created_on`, `updated_on`, `status`) VALUES
(5, 'new slider', 'new slider', 'parathas.jpg', '2018-01-11', '2018-01-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `sub_category`, `status`) VALUES
(1, 0, 'sub cat 1', 0),
(2, 0, 'sub cat 2', 1),
(3, 1, 'sub cat 1', 0),
(4, 2, 'sub cat B', 1),
(5, 4, 'Sub Cat D', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `verify_token` varchar(50) DEFAULT NULL,
  `email_otp` int(11) DEFAULT NULL,
  `mobile_otp` int(11) DEFAULT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `verify_token`, `email_otp`, `mobile_otp`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$k3qsZ9bkIpmTk4Dfx2LiDevEVfHDiw5FAE4DS.uVWVbWHCvml8oN6', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1515660151, NULL, NULL, NULL, 1, 'Admin', 'istrator', 'ADMIN', '9602947878');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `default_address` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `default_address`, `name`, `mobile`, `address`, `city`, `state`, `country`, `zip`, `created_on`, `updated_on`, `status`) VALUES
(1, 10, 0, 'Prem Saini', '9602947878', 'B-62, Unnati tower, Central Spine, Vidhya dhar Nagar', 'Jaipur', 'Rajasthan', 'India', '302039', '2017-11-27 16:12:23', '2017-11-28 11:58:20', 1),
(2, 10, 1, 'Prem Singhania', '8005609866', 'P-112, Vinayak enclave, benad', 'jaipur', 'Rajasthan', 'India', '302012', '2017-11-27 16:13:55', '2017-11-28 11:58:20', 1),
(3, 10, 0, 'Kuku saini', '9602947878', 'Rajeev colony, khetri nagar', 'khetri nagar', 'Rajasthan', 'India', '333504', '2017-11-27 16:14:35', '2017-11-28 11:58:20', 1),
(8, 10, 0, 'Ravi', '9602947878', 'Unnati tower', 'jaipur', 'Rajasthan', 'India', '302039', '2017-11-28 13:03:53', '2017-11-28 13:03:53', 1),
(22, 32, 1, 'Ravi', '8005609865', 'Unnati tower', 'jaipur', 'Rajasthan', 'India', '302039', '2017-12-01 15:08:37', '2017-12-01 15:08:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `bio` text,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `weak_days`
--

CREATE TABLE `weak_days` (
  `id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weak_days`
--

INSERT INTO `weak_days` (`id`, `day`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breakfast_lunch_dinner`
--
ALTER TABLE `breakfast_lunch_dinner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_images`
--
ALTER TABLE `food_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_listings`
--
ALTER TABLE `food_listings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_types`
--
ALTER TABLE `food_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_available_on`
--
ALTER TABLE `product_available_on`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weak_days`
--
ALTER TABLE `weak_days`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `breakfast_lunch_dinner`
--
ALTER TABLE `breakfast_lunch_dinner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `food_images`
--
ALTER TABLE `food_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;
--
-- AUTO_INCREMENT for table `food_listings`
--
ALTER TABLE `food_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `food_types`
--
ALTER TABLE `food_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_available_on`
--
ALTER TABLE `product_available_on`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `weak_days`
--
ALTER TABLE `weak_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
