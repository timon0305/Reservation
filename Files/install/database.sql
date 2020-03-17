-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2019 at 04:48 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cc_hoteleo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `sex` enum('M','F','O') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M',
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '2' COMMENT 'admin=0,staff=1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `first_name`, `last_name`, `phone`, `address`, `sex`, `picture`, `status`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'admin', '01811903004', 'admin', 'M', NULL, 1, '$2y$10$DpgbrNPQHxxy0qT18fhMWujnxRkvaHSM/ZyW8W9FbgINPpXzhl1aS', 'ehiqAt8FYBmi09mKw8BSJRRXa3Y3K1EEix5PBCfcsy4oT417BunBzSiLZSkV', 0, NULL, '2019-04-22 02:23:41'),
(2, 'ghdfgh', 'rowjat@gmail.com', 'dghdfgh', 'fghfghf', '01811903004', 'sdgsdfg', 'F', 'pic_1562045360.png', 1, '$2y$10$d60Mv0HwSoNISNaqhSAVh.ZvJsVTANpa9qiJ18spva0azoq1OQHES', 'Qm5lEtptwgqEIrttHHUriz4BBFtIXG6zuDwQP7tJ3eh2cBQqKgRCsw7IVN28', 1, '2019-07-01 23:03:37', '2019-07-02 00:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applied_coupon_codes`
--

CREATE TABLE `applied_coupon_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `reservation_id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `coupon_type` enum('PERCENTAGE','FIXED') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_rate` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_masters`
--

CREATE TABLE `coupon_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `offer_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period_start_time` datetime NOT NULL,
  `period_end_time` datetime NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('PERCENTAGE','FIXED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PERCENTAGE',
  `value` double(8,2) NOT NULL DEFAULT '0.00',
  `min_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `max_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `limit_per_user` int(11) NOT NULL DEFAULT '0',
  `limit_per_coupon` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_masters`
--

INSERT INTO `coupon_masters` (`id`, `offer_title`, `description`, `image`, `period_start_time`, `period_end_time`, `code`, `type`, `value`, `min_amount`, `max_amount`, `limit_per_user`, `limit_per_coupon`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Offer', '1', '1555151626.png', '2019-04-22 12:32:00', '2019-04-24 10:32:00', 'ofer', 'PERCENTAGE', 10.00, 10.00, 30000.00, 100, 100, 1, NULL, '2019-04-13 04:33:47', '2019-04-22 02:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_pivot_include_room_type`
--

CREATE TABLE `coupon_pivot_include_room_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_pivot_include_room_type`
--

INSERT INTO `coupon_pivot_include_room_type` (`id`, `coupon_id`, `room_type_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_pivot_paid_service`
--

CREATE TABLE `coupon_pivot_paid_service` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL,
  `paid_service_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_pivot_paid_service`
--

INSERT INTO `coupon_pivot_paid_service` (`id`, `coupon_id`, `paid_service_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` int(11) NOT NULL,
  `main_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minamo` double(8,2) NOT NULL DEFAULT '0.00',
  `maxamo` double(8,2) NOT NULL DEFAULT '0.00',
  `fixed_charge` double(8,2) NOT NULL DEFAULT '0.00',
  `percent_charge` double(8,2) NOT NULL DEFAULT '0.00',
  `rate` double(8,2) NOT NULL DEFAULT '0.00',
  `val1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val5` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val6` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val7` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `is_offline` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `main_name`, `name`, `minamo`, `maxamo`, `fixed_charge`, `percent_charge`, `rate`, `val1`, `val2`, `val3`, `val4`, `val5`, `val6`, `val7`, `status`, `is_online`, `is_offline`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 'Cash', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, NULL, '2019-07-01 06:43:31'),
(2, 'Bank', 'Bank', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, NULL, '2019-07-02 00:37:25'),
(101, 'PayPal', 'Paypal', 0.00, 0.00, 0.00, 0.00, 79.00, 'rexrifat636@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 05:59:35'),
(102, 'PerfectMoney', 'PerfectMoney', 0.00, 0.00, 0.00, 0.00, 80.00, 'U5376900', 'G079qn4Q7XATZBqyoCkBteGRg', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 05:59:37'),
(103, 'Stripe', 'Stripe', 0.00, 0.00, 0.00, 0.00, 80.00, 'sk_test_aat3tzBCCXXBkS4sxY3M8A1B', 'pk_test_AU3G7doZ1sbdpJLj0NaozPBu', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 05:59:39'),
(104, 'Skrill', 'Skrill', 0.00, 0.00, 0.00, 0.00, 80.00, 'merchant@skrill', 'TheSoftKing', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 05:59:44'),
(105, 'PayTM', 'PayTM', 0.00, 0.00, 0.00, 0.00, 79.00, 'PoojaE46324372286132', 'JAKMX9PVoj208dMq', 'WEB_STAGINGb', 'Retail', 'WEB', 'https://pguat.paytm.com/oltp-web/processTransaction', 'https://pguat.paytm.com/paytmchecksum/paytmCallback.jsp', 0, 1, 0, NULL, '2019-07-01 06:42:42'),
(106, 'Payeer', 'Payeer', 1.00, 100.00, 1.00, 1.00, 1.00, '627881897', 'Admin727096', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 05:59:52'),
(107, 'PayStack', 'PayStack', 0.00, 0.00, 0.00, 0.00, 80.00, 'pk_test_c1775454cc81a5ad2d6a31d0b0471585d44c4dcb', 'sk_test_22327c329aa7ea76448cfe279aa1e5d583d306fa', NULL, NULL, NULL, NULL, '0.0028', 1, 1, 0, NULL, '2019-07-01 05:59:56'),
(108, 'VoguePay', 'VoguePay', 1.00, 100.00, 1.00, 1.00, 1.00, 'demo', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:00'),
(501, 'Blockchain.info', 'BitCoin', 1.00, 20000.00, 1.00, 0.50, 80.00, '3965f52f-ec19-43af-90ed-d613dc60657eSSS', 'xpub6DREmHywjNizvs9b4hhNekcjFjvL4rshJjnrHHgtLNCSbhhx5jKFRgqdmXAecLAddEPudDZY4xoDbV1NVHSCeDp1S7NumPCNNjbxB7sGasY0000', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:05'),
(502, 'block.io - BTC', 'BitCoin', 1.00, 99999.00, 1.00, 0.50, 80.00, '1658-8015-2e5e-9afb', '09876softk', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:09'),
(503, 'block.io - LTC', 'LiteCoin', 100.00, 10000.00, 0.40, 1.00, 80.00, 'cb91-a5bc-69d7-1c27', '09876softk', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:13'),
(504, 'block.io - DOGE', 'DogeCoin', 1.00, 50000.00, 0.51, 2.52, 80.00, '2daf-d165-2135-5951', '09876softk', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:19'),
(505, 'CoinPayment - BTC', 'BitCoin', 1.00, 50000.00, 0.51, 2.52, 80.00, '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:24'),
(506, 'CoinPayment - ETH', 'Etherium', 1.00, 50000.00, 0.51, 2.52, 79.00, '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:30'),
(507, 'CoinPayment - BCH', 'Bitcoin Cash', 1.00, 50000.00, 0.51, 2.52, 80.00, '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:37'),
(508, 'CoinPayment - DASH', 'DASH', 1.00, 50000.00, 0.51, 2.52, 80.00, '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:44'),
(509, 'CoinPayment - DOGE', 'DOGE', 1.00, 50000.00, 0.51, 2.52, 80.00, '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:48'),
(510, 'CoinPayment - LTC', 'LTC', 1.00, 50000.00, 0.51, 2.52, 80.00, '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, '2019-07-01 06:00:53'),
(512, 'CoinGate', 'CoinGate', 10.00, 1000.00, 5.00, 5.00, 80.00, 'Ba1VgPx6d437xLXGKCBkmwVCEw5kHzRJ6thbGo-N', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:00:58'),
(513, 'CoinPayment-ALL', 'Coin Payment', 10.00, 1000.00, 5.00, 5.00, 80.00, 'db1d9f12444e65c921604e289a281c56', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2019-07-01 06:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CURRENCY',
  `cur_sym` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CURRENCY SYMBOL',
  `en` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'EMAIL NOTIFICATION',
  `mn` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'SMS NOTIFICATION',
  `sender_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_message` longtext COLLATE utf8mb4_unicode_ci,
  `sms_api` longtext COLLATE utf8mb4_unicode_ci,
  `check_in_time` time DEFAULT NULL,
  `check_out_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `title`, `name`, `email`, `phone`, `address`, `color`, `cur`, `cur_sym`, `en`, `mn`, `sender_email`, `email_message`, `sms_api`, `check_in_time`, `check_out_time`, `created_at`, `updated_at`) VALUES
(1, 'HOTELEO', NULL, 'support@thesoftking.com', '880123456789', 'City, Country', '2ecc71', 'USD', '$', 1, 0, 'do-not-reply@thesoftking.com', '<br><br>\r\n	<div class=\"contents\" style=\"max-width: 600px; margin: 0 auto; border: 2px solid #000036;\">\r\n\r\n<div class=\"header\" style=\"background-color: #000036; padding: 15px; text-align: center;\">\r\n	<div class=\"logo\" style=\"width: 260px;text-align: center; margin: 0 auto;\">\r\n		<img src=\"https://i.imgur.com/4NN55uD.png\" alt=\"THESOFTKING\" style=\"width: 100%;\">\r\n	</div>\r\n</div>\r\n\r\n<div class=\"mailtext\" style=\"padding: 30px 15px; background-color: #f0f8ff; font-family: \'Open Sans\', sans-serif; font-size: 16px; line-height: 26px;\">\r\n\r\nHi {{name}},\r\n<br><br>\r\n{{message}}\r\n<br><br>\r\n<br><br>\r\n</div>\r\n\r\n<div class=\"footer\" style=\"background-color: #000036; padding: 15px; text-align: center;\">\r\n<a href=\"https://thesoftking.com/\" style=\"	background-color: #2ecc71;\r\n	padding: 10px 0;\r\n	margin: 10px;\r\n	display: inline-block;\r\n	width: 100px;\r\n	text-transform: uppercase;\r\n	text-decoration: none;\r\n	color: #ffff;\r\n	font-weight: 600;\r\n	border-radius: 4px;\">Website</a>\r\n<a href=\"https://thesoftking.com/products\" style=\"	background-color: #2ecc71;\r\n	padding: 10px 0;\r\n	margin: 10px;\r\n	display: inline-block;\r\n	width: 100px;\r\n	text-transform: uppercase;\r\n	text-decoration: none;\r\n	color: #ffff;\r\n	font-weight: 600;\r\n	border-radius: 4px;\">Products</a>\r\n<a href=\"https://thesoftking.com/contact\" style=\"	background-color: #2ecc71;\r\n	padding: 10px 0;\r\n	margin: 10px;\r\n	display: inline-block;\r\n	width: 100px;\r\n	text-transform: uppercase;\r\n	text-decoration: none;\r\n	color: #ffff;\r\n	font-weight: 600;\r\n	border-radius: 4px;\">Contact</a>\r\n</div>\r\n\r\n\r\n<div class=\"footer\" style=\"background-color: #000036; padding: 15px; text-align: center; border-top: 1px solid rgba(255, 255, 255, 0.2);\">\r\n\r\n<strong style=\"color: #fff;\">© 2011 - 2019 THESOFTKING. All Rights Reserved.</strong>\r\n<p style=\"color: #ddd;\">TheSoftKing is not partnered with any other \r\ncompany or person. We work as a team and do not have any reseller, \r\ndistributor or partner!</p>\r\n\r\n\r\n</div>\r\n\r\n	</div>\r\n<br><br>', 'https://api.infobip.com/api/v3/sendsms/plain?user=****&password=*****&sender=E-Wallet&SMSText={{message}}&GSM={{number}}&type=longSMS', '13:30:00', '12:00:00', '2019-04-13 03:30:44', '2019-07-14 08:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_11_17_074545_create_admins_table', 1),
(4, '2018_11_17_092751_create_general_settings_table', 1),
(9, '2019_01_27_061424_create_amenities_table', 1),
(10, '2019_01_27_084925_create_room_types_table', 1),
(11, '2019_01_27_090232_create_room_type_pivot_amenity_table', 1),
(12, '2019_01_27_090546_create_room_type_images_table', 1),
(13, '2019_01_28_054237_create_floors_table', 1),
(14, '2019_01_28_060201_create_rooms_table', 1),
(15, '2019_01_28_065513_create_paid_services_table', 1),
(17, '2019_01_28_084852_create_coupon_masters_table', 1),
(18, '2019_01_28_090032_create_coupon_pivot_include_room_type_table', 1),
(19, '2019_01_28_090142_create_coupon_pivot_paid_service_table', 1),
(20, '2019_01_28_105730_create_regular_prices_table', 1),
(21, '2019_01_28_105847_create_special_prices_table', 1),
(22, '2019_01_31_060024_create_tax_managers_table', 1),
(23, '2019_01_31_081436_create_reservations_table', 1),
(24, '2019_01_31_084426_create_reservation_nights_table', 1),
(25, '2019_01_31_084503_create_reservation_taxes_table', 1),
(26, '2019_01_31_084603_create_reservation_paid_services_table', 1),
(27, '2019_01_31_085704_create_applied_coupon_codes_table', 1),
(28, '2019_02_05_100910_create_gateways_table', 1),
(30, '2019_02_05_121238_create_payments_table', 1),
(33, '2019_03_14_095400_create_transactions_table', 2),
(37, '2019_01_17_144645_create_web_settings_table', 3),
(38, '2019_04_21_062847_create_web_our_teams_table', 4),
(39, '2019_04_21_075544_create_web_galleries_table', 5),
(40, '2019_04_21_080514_create_web_gallery_categories_table', 5),
(43, '2019_04_21_095729_create_web_our_client_feedbacks_table', 6),
(44, '2019_04_21_095847_create_web_counter_sections_table', 6),
(45, '2019_01_19_150430_create_web_faqs_table', 7),
(48, '2019_04_23_062708_create_web_socials_table', 8),
(49, '2019_07_02_112313_create_web_facilities_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `paid_services`
--

CREATE TABLE `paid_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gateway_id` int(10) UNSIGNED NOT NULL,
  `reservetion_id` int(11) DEFAULT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `usd_amo` double(8,2) NOT NULL DEFAULT '0.00',
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('online','offline') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'online',
  `try` tinyint(1) NOT NULL DEFAULT '0',
  `btc_amo` double(8,2) NOT NULL DEFAULT '0.00',
  `btc_wallet` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `hit` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regular_prices`
--

CREATE TABLE `regular_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL,
  `day_1` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_1_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_2` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_2_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_3` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_3_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_4` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_4_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_5` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_5_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_6` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_6_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_7` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_7_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regular_prices`
--

INSERT INTO `regular_prices` (`id`, `room_type_id`, `day_1`, `day_1_amount`, `day_2`, `day_2_amount`, `day_3`, `day_3_amount`, `day_4`, `day_4_amount`, `day_5`, `day_5_amount`, `day_6`, `day_6_amount`, `day_7`, `day_7_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'LESS', 10.00, 'ADD', 10.00, 'ADD', 10.00, 'ADD', 10.00, 'ADD', 10.00, 'ADD', 10.00, 'ADD', 10.00, '2019-04-13 04:02:51', '2019-04-13 04:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `online` tinyint(1) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL,
  `adults` int(11) NOT NULL DEFAULT '1',
  `kids` int(11) NOT NULL DEFAULT '0',
  `extra_bed` int(11) NOT NULL DEFAULT '0',
  `extra_bed_charge` float NOT NULL DEFAULT '0',
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `number_of_room` int(11) NOT NULL DEFAULT '1',
  `status` enum('PENDING','CANCEL','SUCCESS','ONLINE_PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_nights`
--

CREATE TABLE `reservation_nights` (
  `id` int(10) UNSIGNED NOT NULL,
  `reservation_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `price` double(18,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_paid_services`
--

CREATE TABLE `reservation_paid_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `reservation_id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `pad_service_id` int(10) UNSIGNED NOT NULL,
  `value` double(18,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL DEFAULT '0',
  `price` double(18,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_taxes`
--

CREATE TABLE `reservation_taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `reservation_id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL,
  `type` enum('PERCENTAGE','FIXED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double(8,2) NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL,
  `floor_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `higher_capacity` int(11) NOT NULL DEFAULT '0',
  `kids_capacity` int(11) NOT NULL DEFAULT '0',
  `base_price` double(8,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type_images`
--

CREATE TABLE `room_type_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type_pivot_amenity`
--

CREATE TABLE `room_type_pivot_amenity` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL,
  `amenity_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `special_prices`
--

CREATE TABLE `special_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `day_1` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_1_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_2` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_2_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_3` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_3_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_4` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_4_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_5` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_5_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_6` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_6_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `day_7` enum('ADD','LESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_7_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `special_prices`
--

INSERT INTO `special_prices` (`id`, `room_type_id`, `title`, `start_time`, `end_time`, `day_1`, `day_1_amount`, `day_2`, `day_2_amount`, `day_3`, `day_3_amount`, `day_4`, `day_4_amount`, `day_5`, `day_5_amount`, `day_6`, `day_6_amount`, `day_7`, `day_7_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Consectetur Adipisicing Elit', '2019-04-20 06:42:00', '2019-04-23 06:42:00', 'ADD', 0.00, 'ADD', 0.00, 'ADD', 0.00, 'ADD', 0.00, 'ADD', 0.00, 'ADD', 0.00, 'ADD', 0.00, 0, '2019-04-20 00:43:19', '2019-04-20 00:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `tax_managers`
--

CREATE TABLE `tax_managers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('PERCENTAGE','FIXED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PERCENTAGE',
  `rate` double(8,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `sex` enum('M','F','O') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M',
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `vip` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_code` tinyint(1) NOT NULL DEFAULT '0',
  `sms_verified` tinyint(1) NOT NULL DEFAULT '0',
  `sms_verified_code` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_counter_sections`
--

CREATE TABLE `web_counter_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_counter_sections`
--

INSERT INTO `web_counter_sections` (`id`, `name`, `number`, `created_at`, `updated_at`) VALUES
(1, 'Total Guest', 18545.00, '2019-04-21 04:10:25', '2019-07-14 02:02:53'),
(3, 'Total Staff', 500.00, '2019-04-21 04:13:05', '2019-07-14 02:03:25'),
(4, 'Yearly Guest', 53245.00, '2019-04-21 04:13:23', '2019-07-14 02:03:34'),
(5, 'Client Feedbacks', 5534.00, '2019-04-21 04:13:41', '2019-04-21 04:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `web_facilities`
--

CREATE TABLE `web_facilities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_faqs`
--

CREATE TABLE `web_faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_galleries`
--

CREATE TABLE `web_galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('image','url','video') COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_gallery_categories`
--

CREATE TABLE `web_gallery_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_our_client_feedbacks`
--

CREATE TABLE `web_our_client_feedbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `feed` text COLLATE utf8mb4_unicode_ci,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_our_teams`
--

CREATE TABLE `web_our_teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tw` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_settings`
--

CREATE TABLE `web_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `home_banner_section_title_1` text COLLATE utf8mb4_unicode_ci,
  `home_banner_section_title_2` text COLLATE utf8mb4_unicode_ci,
  `home_banner_section_title_3` text COLLATE utf8mb4_unicode_ci,
  `home_about_section_title` text COLLATE utf8mb4_unicode_ci,
  `home_about_section_short_details` text COLLATE utf8mb4_unicode_ci,
  `home_about_section_long_details` longtext COLLATE utf8mb4_unicode_ci,
  `home_room_section_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_room_section_title_sub` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_team_section_title_1` text COLLATE utf8mb4_unicode_ci,
  `home_team_section_title_2` text COLLATE utf8mb4_unicode_ci,
  `home_service_section_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_service_section_sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_video_section_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_video_section_sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_video_section_video_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_gallery_section_title_1` text COLLATE utf8mb4_unicode_ci,
  `gallery_gallery_section_title_2` text COLLATE utf8mb4_unicode_ci,
  `home_testimonial_section_title_1` text COLLATE utf8mb4_unicode_ci,
  `home_testimonial_section_title_2` text COLLATE utf8mb4_unicode_ci,
  `home_facility_section_title_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_facility_section_title_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `general_general_section_footer_content` text COLLATE utf8mb4_unicode_ci,
  `general_general_section_fb_comment_script` longtext COLLATE utf8mb4_unicode_ci,
  `blog_blog_section_title_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_blog_section_title_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_faq_section_title_1` text COLLATE utf8mb4_unicode_ci,
  `faq_faq_section_title_2` text COLLATE utf8mb4_unicode_ci,
  `contact_all_section_title_1` text COLLATE utf8mb4_unicode_ci,
  `contact_all_section_title_2` text COLLATE utf8mb4_unicode_ci,
  `contact_all_section_phone` text COLLATE utf8mb4_unicode_ci,
  `contact_all_section_email_web` text COLLATE utf8mb4_unicode_ci,
  `contact_all_section_address` text COLLATE utf8mb4_unicode_ci,
  `contact_all_section_map` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_settings`
--

INSERT INTO `web_settings` (`id`, `home_banner_section_title_1`, `home_banner_section_title_2`, `home_banner_section_title_3`, `home_about_section_title`, `home_about_section_short_details`, `home_about_section_long_details`, `home_room_section_title`, `home_room_section_title_sub`, `home_team_section_title_1`, `home_team_section_title_2`, `home_service_section_title`, `home_service_section_sub_title`, `home_video_section_title`, `home_video_section_sub_title`, `home_video_section_video_link`, `gallery_gallery_section_title_1`, `gallery_gallery_section_title_2`, `home_testimonial_section_title_1`, `home_testimonial_section_title_2`, `home_facility_section_title_1`, `home_facility_section_title_2`, `general_general_section_footer_content`, `general_general_section_fb_comment_script`, `blog_blog_section_title_1`, `blog_blog_section_title_2`, `faq_faq_section_title_1`, `faq_faq_section_title_2`, `contact_all_section_title_1`, `contact_all_section_title_2`, `contact_all_section_phone`, `contact_all_section_email_web`, `contact_all_section_address`, `contact_all_section_map`, `created_at`, `updated_at`) VALUES
(1, 'Best Hotel to Stay', 'Welcome to Hoteleo', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita enim ex harum maxime nesciunt quae saepe ducimus quidem corporis tempora.', 'About Hoteleo', 'Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.', 'Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.\r\n\r\nConsulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter.', 'Our Rooms', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita enim ex harum maxime nesciunt quae saepe ducimus quidem corporis tempora.', 'Our Team', 'On no twenty spring of in esteem spirit likely estate. Continue new you declared differed learning bringing honoured.', 'Our Services', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita enim ex harum maxime nesciunt quae saepe ducimus quidem corporis tempora.', 'Video Tour', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita enim ex harum maxime nesciunt quae saepe ducimus quidem corporis tempora.', 'http://www.youtube.com/embed/GT6-H4BRyqQ?autoplay=1', 'Our Exclusive Photo Gallery', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita enim ex harum maxime nesciunt quae saepe ducimus quidem corporis tempora.', 'Our Client Feedback', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita enim ex harum maxime nesciunt quae saepe ducimus quidem corporis tempora.', 'Extra Facilities', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita enim ex harum maxime nesciunt quae saepe ducimus quidem corporis tempora.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita enim ex harum maxime nesciunt quae saepe ducimus.', '205856110142667', 'Our Latest Announcements', 'On no twenty spring of in esteem spirit likely estate. Continue new you declared differed learning bringing honoured', 'FAQs', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita enim ex harum maxime nesciunt quae saepe ducimus quidem corporis tempora.', 'Get in Touch', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita enim ex harum maxime nesciunt quae saepe ducimus quidem corporis tempora.', '01000000000', 'support@or&or.com', 'Uttra, Dhaka', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7296.948437944558!2d90.41646837312909!3d23.87279724908633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c5c5849459a3%3A0x627da4ef9bc6539a!2sUttar+Khan%2C+Dhaka+1230!5e0!3m2!1sen!2sbd!4v1563098220046!5m2!1sen!2sbd', NULL, '2019-07-14 08:13:54');

-- --------------------------------------------------------

--
-- Table structure for table `web_socials`
--

CREATE TABLE `web_socials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `amenities_name_unique` (`name`);

--
-- Indexes for table `applied_coupon_codes`
--
ALTER TABLE `applied_coupon_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applied_coupon_codes_reservation_id_foreign` (`reservation_id`),
  ADD KEY `applied_coupon_codes_coupon_id_foreign` (`coupon_id`),
  ADD KEY `applied_coupon_codes_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_masters`
--
ALTER TABLE `coupon_masters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupon_masters_code_unique` (`code`);

--
-- Indexes for table `coupon_pivot_include_room_type`
--
ALTER TABLE `coupon_pivot_include_room_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_pivot_include_room_type_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_pivot_include_room_type_room_type_id_foreign` (`room_type_id`);

--
-- Indexes for table `coupon_pivot_paid_service`
--
ALTER TABLE `coupon_pivot_paid_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_pivot_paid_service_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_pivot_paid_service_paid_service_id_foreign` (`paid_service_id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `floors_name_unique` (`name`),
  ADD UNIQUE KEY `floors_number_unique` (`number`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gateways_main_name_unique` (`main_name`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paid_services`
--
ALTER TABLE `paid_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paid_services_title_unique` (`title`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regular_prices`
--
ALTER TABLE `regular_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regular_prices_room_type_id_foreign` (`room_type_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservations_uid_unique` (`uid`),
  ADD KEY `reservations_user_id_foreign` (`user_id`),
  ADD KEY `reservations_room_type_id_foreign` (`room_type_id`);

--
-- Indexes for table `reservation_nights`
--
ALTER TABLE `reservation_nights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_nights_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservation_nights_room_id_foreign` (`room_id`);

--
-- Indexes for table `reservation_paid_services`
--
ALTER TABLE `reservation_paid_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_paid_services_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservation_paid_services_pad_service_id_foreign` (`pad_service_id`);

--
-- Indexes for table `reservation_taxes`
--
ALTER TABLE `reservation_taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_taxes_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservation_taxes_tax_id_foreign` (`tax_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rooms_number_unique` (`number`),
  ADD KEY `rooms_room_type_id_foreign` (`room_type_id`),
  ADD KEY `rooms_floor_id_foreign` (`floor_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_types_title_unique` (`title`),
  ADD UNIQUE KEY `room_types_slug_unique` (`slug`),
  ADD UNIQUE KEY `room_types_short_code_unique` (`short_code`);

--
-- Indexes for table `room_type_images`
--
ALTER TABLE `room_type_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_images_room_type_id_foreign` (`room_type_id`);

--
-- Indexes for table `room_type_pivot_amenity`
--
ALTER TABLE `room_type_pivot_amenity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_pivot_amenity_room_type_id_foreign` (`room_type_id`),
  ADD KEY `room_type_pivot_amenity_amenity_id_foreign` (`amenity_id`);

--
-- Indexes for table `special_prices`
--
ALTER TABLE `special_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `special_prices_room_type_id_foreign` (`room_type_id`);

--
-- Indexes for table `tax_managers`
--
ALTER TABLE `tax_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `web_counter_sections`
--
ALTER TABLE `web_counter_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_facilities`
--
ALTER TABLE `web_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_faqs`
--
ALTER TABLE `web_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_galleries`
--
ALTER TABLE `web_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_gallery_categories`
--
ALTER TABLE `web_gallery_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_our_client_feedbacks`
--
ALTER TABLE `web_our_client_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_our_teams`
--
ALTER TABLE `web_our_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_settings`
--
ALTER TABLE `web_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_socials`
--
ALTER TABLE `web_socials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applied_coupon_codes`
--
ALTER TABLE `applied_coupon_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_masters`
--
ALTER TABLE `coupon_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon_pivot_include_room_type`
--
ALTER TABLE `coupon_pivot_include_room_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon_pivot_paid_service`
--
ALTER TABLE `coupon_pivot_paid_service`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `paid_services`
--
ALTER TABLE `paid_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regular_prices`
--
ALTER TABLE `regular_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_nights`
--
ALTER TABLE `reservation_nights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_paid_services`
--
ALTER TABLE `reservation_paid_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_taxes`
--
ALTER TABLE `reservation_taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type_images`
--
ALTER TABLE `room_type_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type_pivot_amenity`
--
ALTER TABLE `room_type_pivot_amenity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `special_prices`
--
ALTER TABLE `special_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tax_managers`
--
ALTER TABLE `tax_managers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_counter_sections`
--
ALTER TABLE `web_counter_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `web_facilities`
--
ALTER TABLE `web_facilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_faqs`
--
ALTER TABLE `web_faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_galleries`
--
ALTER TABLE `web_galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_gallery_categories`
--
ALTER TABLE `web_gallery_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_our_client_feedbacks`
--
ALTER TABLE `web_our_client_feedbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_our_teams`
--
ALTER TABLE `web_our_teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_settings`
--
ALTER TABLE `web_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_socials`
--
ALTER TABLE `web_socials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applied_coupon_codes`
--
ALTER TABLE `applied_coupon_codes`
  ADD CONSTRAINT `applied_coupon_codes_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupon_masters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applied_coupon_codes_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applied_coupon_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupon_pivot_include_room_type`
--
ALTER TABLE `coupon_pivot_include_room_type`
  ADD CONSTRAINT `coupon_pivot_include_room_type_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupon_masters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_pivot_include_room_type_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupon_pivot_paid_service`
--
ALTER TABLE `coupon_pivot_paid_service`
  ADD CONSTRAINT `coupon_pivot_paid_service_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupon_masters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_pivot_paid_service_paid_service_id_foreign` FOREIGN KEY (`paid_service_id`) REFERENCES `paid_services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regular_prices`
--
ALTER TABLE `regular_prices`
  ADD CONSTRAINT `regular_prices_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation_nights`
--
ALTER TABLE `reservation_nights`
  ADD CONSTRAINT `reservation_nights_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_nights_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation_paid_services`
--
ALTER TABLE `reservation_paid_services`
  ADD CONSTRAINT `reservation_paid_services_pad_service_id_foreign` FOREIGN KEY (`pad_service_id`) REFERENCES `paid_services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_paid_services_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation_taxes`
--
ALTER TABLE `reservation_taxes`
  ADD CONSTRAINT `reservation_taxes_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_taxes_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax_managers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rooms_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `room_type_images`
--
ALTER TABLE `room_type_images`
  ADD CONSTRAINT `room_type_images_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `room_type_pivot_amenity`
--
ALTER TABLE `room_type_pivot_amenity`
  ADD CONSTRAINT `room_type_pivot_amenity_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_type_pivot_amenity_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `special_prices`
--
ALTER TABLE `special_prices`
  ADD CONSTRAINT `special_prices_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
