-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2021 at 09:38 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rongtulibd_dd`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_color_settings`
--

CREATE TABLE `app_color_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_button_color` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#7F6E82',
  `map_button_color` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#7F6E82',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_currencies_settings`
--

CREATE TABLE `app_currencies_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_email_settings`
--

CREATE TABLE `app_email_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_enable` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `mail_host` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'smtp.hostinger.com',
  `mail_port` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '587',
  `mail_encryption` enum('TLS','SSL') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TLS',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'test@smartersvision.com',
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '123456789',
  `sender_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'test@smartersvision.com',
  `sender_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'delivery dot',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_global_settings`
--

CREATE TABLE `app_global_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_maps_key` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AIzaSyC3YYz8jqvHY3Yup1lzIdlU51FsjHKH5yE',
  `default_unit_of_distance` enum('kilometer','mile') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kilometer',
  `language` enum('en','bn') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `application_version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1.1',
  `blocked_ips` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'comma separate',
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_home_screen_layout_settings`
--

CREATE TABLE `app_home_screen_layout_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `row` enum('trending','popular','discounted','favorite','trr','trf') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'trending' COMMENT 'trr=top rating restaurant, trf=top rating food',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_home_screen_layout_settings`
--

INSERT INTO `app_home_screen_layout_settings` (`id`, `row`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'favorite', 'active', '2020-11-08 18:00:00', '2020-11-08 18:00:00', NULL, 1, NULL, NULL),
(2, 'discounted', 'active', '2020-11-08 18:00:00', '2020-11-08 18:00:00', NULL, 1, NULL, NULL),
(3, 'favorite', 'active', '2020-11-08 18:00:00', '2020-11-08 18:00:00', NULL, 1, NULL, NULL),
(4, 'trf', 'active', '2020-11-08 18:00:00', '2020-11-08 18:00:00', NULL, 1, NULL, NULL),
(5, 'trending', 'active', '2020-11-08 18:00:00', '2020-11-08 18:00:00', NULL, 1, NULL, NULL),
(6, 'favorite', 'active', '2020-11-08 18:00:00', '2020-11-08 18:00:00', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_payment_settings`
--

CREATE TABLE `app_payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `default_tax` double(4,2) NOT NULL DEFAULT 4.00,
  `default_vat` double(4,2) NOT NULL DEFAULT 4.00,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_push_notification_settings`
--

CREATE TABLE `app_push_notification_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_enable` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `firebase_cloud_messaging_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AAAApe5CT7I:APA91bFAVF8gtVNbatfRMP8yBluzCaGmm1tmZtgAUhOW96QAYkXVQVxJRmU5KsDMPgyq163z_W3RQOD5ho1N25bykcGPtlBeacxccNZh8J6voZi3ls4NYlvCYhlxlPTo6AeOBkPA5Wnw',
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AIzaSyB_UhyMxj8RU0eTQEhZnsCsiI6hQlNIPmg',
  `database_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://fooddeliver192.firebaseio.com',
  `storage_bucket` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fooddeliver192.appspot.com',
  `application_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1:712666927026:web:7b9bfbb66cf6a07b96deab',
  `auth_domain` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fooddeliver192.firebaseapp.com',
  `project_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fooddeliver192',
  `messaging_sender_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '712666927026',
  `measurement_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_sms_settings`
--

CREATE TABLE `app_sms_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_enable` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'smtp.hostinger.com',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'test@smartersvision.com',
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '123456789',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_social_authentication_settings`
--

CREATE TABLE `app_social_authentication_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_secret` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_enable` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Christiana Barrows', '12345.jpg', 'active', '2020-11-08 18:00:00', '2020-11-09 11:50:40', NULL, 1, NULL, NULL),
(2, 'Glennie Harvey', '12345.jpg', 'active', '2020-11-08 18:00:00', '2020-11-09 11:50:40', NULL, 1, NULL, NULL),
(3, 'Francesco Murazik', '12345.jpg', 'active', '2020-11-08 18:00:00', '2020-11-09 11:50:40', NULL, 1, NULL, NULL),
(4, 'Alivia Lang', '12345.jpg', 'active', '2020-11-08 18:00:00', '2020-11-09 11:50:40', NULL, 1, NULL, NULL),
(5, 'Dr. Rolando Dickens IV', '12345.jpg', 'active', '2020-11-08 18:00:00', '2020-11-09 11:50:40', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_categories`
--

CREATE TABLE `business_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'json data',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `options`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(11, 'Category 1', '<p>Category 1<br></p>', '37202012301609343003.jpeg', NULL, 'active', '2020-12-30 20:43:23', '2020-12-30 20:43:23', NULL, 1, NULL, NULL),
(12, 'Category 2', '<p>Category 2<br></p>', '94202012301609343082.jpg', NULL, 'active', '2020-12-30 20:44:42', '2020-12-30 20:44:42', NULL, 1, NULL, NULL),
(13, 'Category 3', '<p>Category 3<br></p>', '22202012301609343108.jpg', NULL, 'active', '2020-12-30 20:45:08', '2020-12-30 20:45:08', NULL, 1, NULL, NULL),
(14, 'Category 4', '<p>Category 4<br></p>', '8202012301609343166.jpeg', NULL, 'active', '2020-12-30 20:46:07', '2020-12-30 20:46:07', NULL, 1, NULL, NULL),
(15, 'Category 5', '<p>Category 5<br></p>', '70202012301609343193.jpg', NULL, 'active', '2020-12-30 20:46:33', '2020-12-30 20:46:33', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `complain` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `solution` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `complain_date` datetime NOT NULL,
  `status` enum('accepted','canceled','rejected','resolved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'accepted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_code` int(11) NOT NULL,
  `total_used_code` int(11) NOT NULL,
  `discount_type` enum('percent','fixed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percent',
  `discount` double(10,2) NOT NULL DEFAULT 0.00,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `expire_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enabled` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `total_code`, `total_used_code`, `discount_type`, `discount`, `description`, `food_id`, `restaurant_id`, `category_id`, `expire_at`, `enabled`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(24, 'DDR123', 100, 0, 'fixed', 5.00, '<p>asas</p>', 115, 123, 12, '2020-12-31 05:00:00', '1', 'active', '2020-12-30 23:54:58', '2020-12-30 23:54:58', NULL, 1, NULL, NULL),
(30, 'DD132', 100, 0, 'fixed', 20.00, 'NA', 124, 132, 15, '2021-01-29 05:00:00', '1', 'active', '2020-12-30 05:00:00', '2020-12-31 00:54:05', NULL, 1, NULL, NULL),
(31, 'DD133', 100, 0, 'fixed', 20.00, 'NA', 125, 133, 15, '2021-02-03 05:00:00', '1', 'active', '2021-01-04 05:00:00', '2021-01-05 01:34:10', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

CREATE TABLE `cuisines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `device_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone_number`, `isVerified`, `email_verified_at`, `password`, `remember_token`, `status`, `device_token`, `created_at`, `updated_at`) VALUES
(1, 'mukul', NULL, '+8801734183132', 1, NULL, NULL, NULL, 'active', NULL, '2020-12-30 21:09:59', '2021-01-05 00:59:32'),
(2, NULL, NULL, '+88123', 0, NULL, NULL, NULL, 'active', NULL, '2020-12-30 23:08:50', '2020-12-30 23:08:50'),
(3, NULL, NULL, '+8801812386609', 1, NULL, NULL, NULL, 'active', NULL, '2020-12-30 23:40:10', '2021-01-05 19:33:57'),
(4, NULL, NULL, '+8801734183139', 0, NULL, NULL, NULL, 'active', NULL, '2021-01-02 20:25:57', '2021-01-02 20:25:57'),
(7, 'Customer5', 'customer5@dd.com', '+8801734183136', 1, NULL, NULL, NULL, 'active', NULL, '2021-01-04 05:00:00', '2021-01-05 01:16:38'),
(8, 'Customer6', 'customer6@dd.com', '+8801734183130', 1, NULL, NULL, NULL, 'active', NULL, '2021-01-04 05:00:00', '2021-01-07 17:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_current_address` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`id`, `customer_id`, `address`, `is_current_address`) VALUES
(1, 1, 'Unknown', 'no'),
(2, 1, 'Kawuri,Borno,Kawuri,', 'no'),
(3, 1, 'Unknown', 'no'),
(4, 3, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(5, 1, 'Unknown', 'no'),
(6, 1, 'Kostopil\'s\'kyi district,Rivne Oblast,', 'no'),
(7, 1, 'Nola,Sangha-Mbare,', 'no'),
(8, 1, 'Unknown', 'yes'),
(9, 4, 'Dhaka', 'no'),
(10, 4, 'Mymensingh', 'no'),
(11, 4, 'Rongpur', 'yes'),
(12, 7, 'Address', 'no'),
(13, 7, 'dhaka', 'yes'),
(14, 8, 'Address', 'no'),
(15, 8, 'dhaka', 'no'),
(16, 8, 'tyuui', 'no'),
(17, 8, 'Unknown', 'no'),
(18, 8, 'Kufra District,Kufra District,', 'no'),
(19, 8, 'Unknown', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `customer_profiles`
--

CREATE TABLE `customer_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `spouse_dob` date DEFAULT NULL,
  `father_dob` date DEFAULT NULL,
  `mother_dob` date DEFAULT NULL,
  `anniversary` date DEFAULT NULL,
  `first_child_dob` date DEFAULT NULL,
  `second_child_dob` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_biography` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_profiles`
--

INSERT INTO `customer_profiles` (`id`, `customer_id`, `image`, `dob`, `spouse_dob`, `father_dob`, `mother_dob`, `anniversary`, `first_child_dob`, `second_child_dob`, `address`, `short_biography`) VALUES
(3, 7, 'http://rongtulibd.com/deliverydot/public/img/customer/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Address', NULL),
(4, 8, 'http://rongtulibd.com/deliverydot/public/img/customer/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Address', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `from_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_area` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_district` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_post_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pickup_time` datetime NOT NULL,
  `status` enum('processing','on_the_way','delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `extra_group_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extra_groups`
--

CREATE TABLE `extra_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_groups`
--

INSERT INTO `extra_groups` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(11, 'Group 1', 'active', '2020-12-30 20:59:16', '2020-12-30 20:59:16', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_foods`
--

CREATE TABLE `favorite_foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorite_foods`
--

INSERT INTO `favorite_foods` (`id`, `customer_id`, `food_id`, `created_at`, `updated_at`) VALUES
(3, 8, 111, '2021-01-05 22:30:53', '2021-01-05 22:30:53'),
(4, 8, 112, '2021-01-05 22:30:58', '2021-01-05 22:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `favorite_restaurants`
--

CREATE TABLE `favorite_restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '10',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ingredients` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Enter the unit of food (ex:L, ml, Kg, g)',
  `package_count` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Number of item per package (ex: 6, 10)',
  `weight` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Insert Weight of this food default unit is gramme (g)',
  `featured` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deliverable_food` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'json data',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `short_description`, `image`, `discount_price`, `description`, `ingredients`, `unit`, `package_count`, `weight`, `featured`, `deliverable_food`, `restaurant_id`, `category_id`, `options`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(110, 'Food 4', '<p>Food 1<br></p>', 'http://rongtulibd.com/deliverydot/public/img/food/9202012301609345366.jpg', '10', '<p>Food 1<br></p>', '<p>Food 1<br></p>', '334', '345', '345', '0', '1', 121, 11, NULL, 'active', '2020-12-30 21:20:58', '2020-12-30 05:00:00', NULL, 1, 1, NULL),
(111, 'Food 5', '<p>Food 2<br></p>', 'http://rongtulibd.com/deliverydot/public/img/food/11202012301609345524.jpg', '10', '<p>Food 2<br></p>', '<p>Food 2<br></p>', '334', '345', '345', '', '1', 121, 12, NULL, 'active', '2020-12-30 21:25:24', '2020-12-30 21:25:24', NULL, 1, NULL, NULL),
(112, 'Food 6', '<p>Food 1<br></p>', 'http://rongtulibd.com/deliverydot/public/img/food/36202012301609345578.jpeg', '10', '<p>Food 1<br></p>', '<p>Food 1<br></p>', '334', '345', '345', '', '1', 122, 13, NULL, 'active', '2020-12-30 21:26:18', '2020-12-30 21:26:18', NULL, 1, NULL, NULL),
(113, 'Food 7', '<p>Food 2<br></p>', 'http://rongtulibd.com/deliverydot/public/img/food/60202012301609345633.jpg', '10', '<p>Food 2<br></p>', '<p>Food 2<br></p>', '334', '345', '345', '', '1', 122, 14, NULL, 'active', '2020-12-30 21:27:13', '2020-12-30 21:27:13', NULL, 1, NULL, NULL),
(115, 'Food 1', '<p>Food 1<br></p>', 'http://rongtulibd.com/deliverydot/public/img/food/97202012301609354450.jpg', '10', '<p>Food 1<br></p>', '<p>Food 1<br></p>', '334', '345', '345', '', '1', 123, 12, NULL, 'active', '2020-12-30 23:54:10', '2020-12-30 23:54:10', NULL, 1, NULL, NULL),
(124, 'Piza', 'Piza', 'http://rongtulibd.com/deliverydot/public/img/restaurant/default.png', '10', 'NA', 'NA', 'NA', 'NA', 'NA', '1', '1', 132, 15, 'NA', 'active', '2020-12-30 05:00:00', '2020-12-31 00:54:05', NULL, 1, NULL, NULL),
(125, 'Piza', 'Piza', 'http://rongtulibd.com/deliverydot/public/img/restaurant/default.png', '10', 'NA', 'NA', 'NA', 'NA', 'NA', '1', '1', 133, 15, 'NA', 'active', '2021-01-04 05:00:00', '2021-01-05 01:34:10', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food_reviews`
--

CREATE TABLE `food_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double(8,2) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_variants`
--

CREATE TABLE `food_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_variants`
--

INSERT INTO `food_variants` (`id`, `food_id`, `name`, `price`) VALUES
(137, 110, 'Food 1 variant 1', 100.00),
(138, 110, 'Food 1 variant 2', 200.00),
(139, 110, 'Food 1 variant 2', 300.00),
(140, 111, 'Food 2 variant 1', 100.00),
(141, 111, 'Food 2 variant 2', 200.00),
(142, 111, 'Food 2 variant 3', 300.00),
(143, 112, 'Food 1 variant 1', 100.00),
(144, 112, 'Food 1 variant 2', 200.00),
(145, 113, 'Food 2 variant 1', 100.00),
(146, 113, 'Food 2 variant 2', 200.00),
(153, 115, 'Food 1 variant 1', 100.00),
(154, 115, 'Food 1 variant 2', 200.00),
(170, 124, 'Piza 6 inch', 220.00),
(171, 124, 'Piza 9 inch', 420.00),
(172, 124, 'Piza 12 inch', 920.00),
(173, 125, 'Piza 6 inch', 220.00),
(174, 125, 'Piza 9 inch', 420.00),
(175, 125, 'Piza 12 inch', 920.00);

-- --------------------------------------------------------

--
-- Table structure for table `help_and_supports`
--

CREATE TABLE `help_and_supports` (
  `id` int(11) NOT NULL,
  `type` enum('customer','restaurant','rider') DEFAULT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help_and_supports`
--

INSERT INTO `help_and_supports` (`id`, `type`, `question`, `answer`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'rider', 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, NULL, NULL, NULL),
(2, 'rider', 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a ', '2021-01-03 22:55:45', 1, NULL, NULL),
(3, 'rider', 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, NULL, NULL, NULL),
(4, 'rider', 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a ', '2021-01-03 22:55:45', 1, NULL, NULL),
(5, 'customer', 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a ', '2021-01-03 22:55:45', 1, NULL, NULL),
(6, 'customer', 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a ', '2021-01-03 22:55:45', 1, NULL, NULL),
(7, 'customer', 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a ', '2021-01-03 22:55:45', 1, NULL, NULL),
(8, 'customer', 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a ', '2021-01-03 22:55:45', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(5, '2016_06_01_000004_create_oauth_clients_table', 1),
(6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2020_06_28_125713_create_app_color_settings _table', 1),
(9, '2020_06_28_125713_create_app_home _screen_layout_settings _table', 1),
(10, '2020_06_28_125859_create_app_currencies_settings_table', 1),
(11, '2020_06_28_125859_create_app_email _settings_table', 1),
(12, '2020_06_28_125859_create_app_global_settings_table', 1),
(13, '2020_06_28_125859_create_app_payment_settings_table', 1),
(14, '2020_06_28_125859_create_app_push_notification _settings_table', 1),
(15, '2020_06_28_125859_create_app_sms _settings_table', 1),
(16, '2020_06_28_125859_create_app_social_authentication_settings_table', 1),
(17, '2020_07_00_122659_create_business_categories_table', 1),
(18, '2020_07_28_122542_create_restaurants_table', 1),
(19, '2020_07_28_122617_create_restaurant_profiles_table', 1),
(20, '2020_07_28_122659_create_customers_table', 1),
(21, '2020_07_28_122719_create_customer_profiles_table', 1),
(22, '2020_07_28_122720_create_customer_address_table', 1),
(23, '2020_07_28_123046_create_riders_table', 1),
(24, '2020_07_28_123103_create_rider_profiles_table', 1),
(25, '2020_07_28_123250_create_cuisines_table', 1),
(26, '2020_07_28_123800_create_categories_table', 1),
(27, '2020_07_28_124218_create_foods_table', 1),
(28, '2020_07_28_124219_create_food_variants_table', 1),
(29, '2020_07_28_125607_create_coupons_table', 1),
(30, '2020_07_28_125607_create_orders_table', 1),
(31, '2020_07_28_125608_create_extra_groups_table', 1),
(32, '2020_07_28_125608_create_extras_table', 1),
(33, '2020_07_28_125608_create_order_details_table', 1),
(34, '2020_07_28_125713_create_favorite_foods_table', 1),
(35, '2020_07_28_125713_create_favorite_restaurants_table', 1),
(36, '2020_07_28_125738_create_restaurant_reviews_table', 1),
(37, '2020_07_28_125807_create_food_reviews_table', 1),
(38, '2020_10_24_125859_create_rider_settings_table', 1),
(39, '2020_10_24_125859_create_settings_table', 1),
(40, '2020_10_24_125860_create_restaurant_settings_table', 1),
(41, '2020_10_24_125860_create_shops_table', 1),
(42, '2020_10_24_125861_create_deliveries_table', 1),
(43, '2020_10_24_125862_create_complains_table', 1),
(44, '2020_10_24_125862_create_restaurant_operating_locations_table', 1),
(45, '2020_10_24_125862_create_rider_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` enum('order_placed','food_is_cooking','food_ready','rider_accepted','delivery_on_the_way','delivered','canceled','returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'order_placed',
  `payment_method` enum('cash_on_delivery','bKash','visa','amex','master','redeem_point') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash_on_delivery',
  `payment_status` enum('waiting_for_customer','not_paid','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting_for_customer',
  `total_price` double(8,2) NOT NULL DEFAULT 0.00,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `vat` double(8,2) NOT NULL DEFAULT 0.00,
  `delivery_fee` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'free',
  `instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `rider_id` bigint(20) DEFAULT NULL,
  `coupon_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `delivery_address`, `order_date`, `order_status`, `payment_method`, `payment_status`, `total_price`, `discount`, `vat`, `delivery_fee`, `instructions`, `restaurant_id`, `rider_id`, `coupon_code`) VALUES
(1125, 1, 'Unknown', '2021-01-03 15:32:34', 'delivered', 'cash_on_delivery', 'not_paid', 280.00, 0.00, 0.00, '0', '', 121, NULL, ''),
(1126, 1, 'Kawuri,Borno,Kawuri,', '2021-01-03 15:32:40', 'order_placed', 'cash_on_delivery', 'not_paid', 180.00, 0.00, 0.00, '10', '', 122, NULL, ''),
(1134, 3, 'Dhaka,Dhaka Division,Dhaka,1230', '2021-01-03 15:32:51', 'order_placed', 'cash_on_delivery', 'not_paid', 90.00, 0.00, 0.00, '10', '', 122, NULL, ''),
(1135, 3, 'Dhaka,Dhaka Division,Dhaka,1230', '2021-01-03 15:32:56', 'food_ready', 'cash_on_delivery', 'not_paid', 90.00, 0.00, 0.00, '0', '', 123, NULL, ''),
(1136, 3, 'Dhaka,Dhaka Division,Dhaka,1230', '2021-01-03 15:33:01', 'food_ready', 'cash_on_delivery', 'not_paid', 90.00, 0.00, 0.00, '0', '', 123, NULL, ''),
(1137, 3, 'Dhaka,Dhaka Division,Dhaka,1230', '2021-01-03 15:33:14', 'food_ready', 'cash_on_delivery', 'not_paid', 90.00, 0.00, 0.00, '0', '', 123, NULL, ''),
(1138, 3, 'Dhaka,Dhaka Division,Dhaka,1230', '2021-01-03 15:33:10', 'food_ready', 'cash_on_delivery', 'not_paid', 90.00, 0.00, 0.00, '0', '', 123, NULL, ''),
(1139, 1, 'Kostopil\'s\'kyi district,Rivne Oblast,', '2021-01-03 15:34:11', 'delivered', 'cash_on_delivery', 'paid', 190.00, 0.00, 0.00, '0', '', 123, 6, ''),
(1140, 1, 'Unknown', '2021-01-03 15:34:35', 'delivered', 'cash_on_delivery', 'paid', 410.00, 0.00, 0.00, '0', '', 132, 6, ''),
(1141, 4, 'Add Other Location', '2021-01-04 12:18:20', 'delivered', 'cash_on_delivery', 'paid', 210.00, 0.00, 0.00, '0', '', 132, 6, ''),
(1142, 4, 'Unknown', '2021-01-04 12:18:26', 'delivered', 'cash_on_delivery', 'paid', 210.00, 0.00, 0.00, '0', '', 132, 6, ''),
(1143, 8, 'Unknown', '2021-01-04 05:00:00', 'order_placed', 'cash_on_delivery', 'not_paid', 410.00, 0.00, 0.00, '0', '', 133, NULL, ''),
(1144, 8, '123, Mirpur, Dhaka-1216,. Bangladesh', '2021-01-04 05:00:00', 'order_placed', 'cash_on_delivery', 'not_paid', 190.00, 0.00, 0.00, '0', '', 123, NULL, ''),
(1145, 8, 'Unknown', '2021-01-07 12:36:13', 'food_is_cooking', 'cash_on_delivery', 'not_paid', 910.00, 0.00, 0.00, '0', '', 133, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `food_variant_id` bigint(20) UNSIGNED NOT NULL,
  `food_price` double(8,2) NOT NULL DEFAULT 0.00,
  `food_quantity` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `extra_id` bigint(20) UNSIGNED DEFAULT NULL,
  `extra_price` double(8,2) NOT NULL DEFAULT 0.00,
  `sub_total` double(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `food_id`, `food_variant_id`, `food_price`, `food_quantity`, `extra_id`, `extra_price`, `sub_total`) VALUES
(183, 1125, 110, 138, 190.00, '1', NULL, 0.00, 190.00),
(184, 1125, 111, 140, 90.00, '1', NULL, 0.00, 90.00),
(185, 1126, 112, 143, 90.00, '1', NULL, 0.00, 90.00),
(186, 1126, 113, 145, 90.00, '1', NULL, 0.00, 90.00),
(191, 1134, 112, 143, 90.00, '1', NULL, 0.00, 90.00),
(192, 1135, 115, 153, 90.00, '1', NULL, 0.00, 90.00),
(193, 1136, 115, 153, 90.00, '1', NULL, 0.00, 90.00),
(194, 1137, 115, 153, 90.00, '1', NULL, 0.00, 90.00),
(195, 1138, 115, 153, 90.00, '1', NULL, 0.00, 90.00),
(196, 1139, 115, 154, 190.00, '1', NULL, 0.00, 190.00),
(197, 1140, 124, 171, 410.00, '1', NULL, 0.00, 410.00),
(198, 1141, 124, 170, 210.00, '1', NULL, 0.00, 210.00),
(199, 1142, 124, 170, 210.00, '1', NULL, 0.00, 210.00),
(200, 1143, 125, 174, 410.00, '1', NULL, 0.00, 410.00),
(201, 1144, 115, 154, 190.00, '1', NULL, 0.00, 190.00),
(202, 1145, 125, 175, 910.00, '1', NULL, 0.00, 910.00);

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `point` double(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `customer_id`, `order_id`, `amount`, `point`) VALUES
(88, 1, 1125, 280.00, 28.00),
(89, 1, 1126, 180.00, 18.00),
(92, 3, 1134, 90.00, 9.00),
(93, 3, 1135, 90.00, 9.00),
(94, 3, 1136, 90.00, 9.00),
(95, 3, 1137, 90.00, 9.00),
(96, 3, 1138, 90.00, 9.00),
(97, 1, 1139, 190.00, 19.00),
(98, 1, 1140, 410.00, 41.00),
(99, 4, 1141, 210.00, 21.00),
(100, 4, 1142, 210.00, 21.00),
(101, 8, 1143, 410.00, 41.00),
(102, 8, 1144, 190.00, 19.00),
(103, 8, 1145, 910.00, 91.00);

-- --------------------------------------------------------

--
-- Table structure for table `promotional_banners`
--

CREATE TABLE `promotional_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotional_banners`
--

INSERT INTO `promotional_banners` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Christiana Barrows', '12345.jpg', 'active', '2020-11-08 18:00:00', '2020-11-09 11:50:40', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `isNew` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `device_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `email`, `phone_number`, `isVerified`, `email_verified_at`, `password`, `remember_token`, `status`, `isNew`, `device_token`, `created_at`, `updated_at`) VALUES
(121, 'Restaurant 2', 'restaurant2@dd.com', '+8801734183131', 0, NULL, NULL, NULL, 'active', 'yes', NULL, '2020-12-30 05:00:00', '2020-12-30 20:51:35'),
(122, 'Restaurant 3', 'restaurant3@dd.com', '+8801734183132', 0, NULL, NULL, NULL, 'active', 'yes', NULL, '2020-12-30 05:00:00', '2020-12-30 20:52:52'),
(123, 'Restaurant123', 'restaurant123@dd.com', '+8801812386609', 1, NULL, NULL, NULL, 'active', 'no', 'eXe4fyUzQfiXKsExyDFum8:APA91bGLVNzWV95Mpc-lj3qFvL9H2uJIfCIjH0WJOgYK_SHYVsLuIgIF-GG4P0C9xnUwmiucG03NhFAlGc-woEWuOT3isTg9mQ0qmd6n4T5XQoIImD7JZP5tMxl7uKfBSXTUQiVxAajN', '2020-12-30 23:36:50', '2020-12-30 05:00:00'),
(124, 'Restaurant 124', 'restaurant124@dd.com', '+8801734183135', 1, NULL, NULL, NULL, 'active', 'no', 'cggxzimTReCU7PP2vSJ4IP:APA91bHGu6VjbhSmtXS7W-K2UF7l6k5smtDqlq_dlUj7iFC_p6J5ty4Do5AZVAF2pexHCuVSJl7baeAiqhFsXOrY9RHRE3ikhI4YHUmxZsZyce0CrEps5u0A8-nhRyy2U2zOyRI4FPgt', '2020-12-30 23:59:36', '2021-01-04 05:00:00'),
(132, 'Restaurant7', 'restaurant7@dd.com', '+8801734183141', 1, NULL, NULL, NULL, 'active', 'no', 'fA9SoZxOT9eBVTT5lRe80t:APA91bHTqIzmJFHiIcC6-WeyPTAP1cYj7aqBgjkFVXcY0pzyAP8-Ktz5VPU8H8ce742BXgiLzI-9pm4mG_O71PmtlZwLxg38jmrT2_0VPuUEPGPQaenkdoWHptOBo9vFU8M-dBBPWPDm', '2020-12-30 05:00:00', '2020-12-31 01:11:16'),
(133, 'Restaurant6', 'restaurant6@dd.com', '+8801734183130', 1, NULL, NULL, NULL, 'active', 'no', 'fA9SoZxOT9eBVTT5lRe80t:APA91bHTqIzmJFHiIcC6-WeyPTAP1cYj7aqBgjkFVXcY0pzyAP8-Ktz5VPU8H8ce742BXgiLzI-9pm4mG_O71PmtlZwLxg38jmrT2_0VPuUEPGPQaenkdoWHptOBo9vFU8M-dBBPWPDm', '2021-01-04 05:00:00', '2021-01-05 22:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_address`
--

CREATE TABLE `restaurant_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_current_address` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_address`
--

INSERT INTO `restaurant_address` (`id`, `restaurant_id`, `address`, `is_current_address`) VALUES
(3, 1, 'Uttara, Dhaka', 'no'),
(4, 1, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(5, 1, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(6, 1, 'asdasdasdas asdasdasd', 'no'),
(7, 1, 'asdasdasdas asdasdasd', 'no'),
(8, 1, 'asdasdasdas asdasdasd', 'no'),
(9, 1, 'current address', 'no'),
(11, 1, 'asdasdasdas asdasdasd', 'no'),
(12, 1, 'wwwwwwwwwwwwwwwwwwwwwwwwww', 'no'),
(13, 1, 'wwwwwwwwwwwwwwwwwwwwwwwwww', 'no'),
(14, 1, 'ssssssss', 'no'),
(15, 1, 'current address', 'no'),
(16, 1, 'current address', 'no'),
(17, 1, 'ssssssss', 'no'),
(18, 1, 'ssssssss', 'no'),
(19, 1, 'ssssssss', 'no'),
(21, 1, 'ssssssss', 'no'),
(22, 1, 'ssssssss', 'no'),
(24, 1, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(25, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(26, 1, 'asdasdasdas asdasdasd', 'no'),
(27, 205, 'H-23, R-6, Sector-5, Uttara', 'no'),
(28, 1, 'asdasdasdas asdasdasd', 'no'),
(29, 1, 'ssssssss', 'no'),
(30, 1, 'asdasdasdas asdasdasd', 'no'),
(31, 1, 'ssssssss', 'yes'),
(32, 202, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(33, 202, 'H-23, R-6, Sector-5, Uttara, Dhaka', 'no'),
(35, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(36, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(37, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(38, 206, '184,Dhaka Division,Mirpur 10 Roundabout,Dhaka,1216', 'yes'),
(39, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(40, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(41, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(42, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(43, 1, 'asdasdasdas asdasdasd', 'no'),
(45, 1, 'asdasdasdas asdasdasd', 'no'),
(50, 108, 'uttara, dhaka', 'no'),
(51, 108, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(52, 108, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(53, 116, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(54, 108, 'asdasdasdas asdasdasd', 'yes'),
(55, 116, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(56, 117, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(57, 116, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(58, 116, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(59, 117, 'Unknown', 'no'),
(61, 118, 'DHAKA, BANGLADESH', 'no'),
(62, 119, 'Unknown', 'yes'),
(63, 117, 'Unknown', 'yes'),
(64, 120, 'DHAKA, BANGLADESH', 'no'),
(65, 121, 'DHAKA, BANGLADESH', 'no'),
(66, 122, 'DHAKA, BANGLADESH', 'no'),
(76, 123, 'qwqw', 'no'),
(78, 132, 'Kirenowa,Borno,Kirenowa,', 'no'),
(79, 132, 'Zakouma National Park,', 'yes'),
(80, 120, 'Unnamed Road,Județul Mureș,Unnamed Road,Gheja,545205', 'yes'),
(81, 124, 'asssssssssss', 'no'),
(82, 133, 'Unknown', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_operating_locations`
--

CREATE TABLE `restaurant_operating_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_profiles`
--

CREATE TABLE `restaurant_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_licence` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_type` enum('home','collect') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'home',
  `delivery_fee` double NOT NULL DEFAULT 0,
  `delivery_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '30 min',
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `delivery_range` int(11) NOT NULL DEFAULT 5,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closed_restaurant` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `available_for_delivery` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `feature_section` bigint(20) UNSIGNED NOT NULL,
  `sn` int(11) DEFAULT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `information` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'json attributes add in future',
  `ratting` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_profiles`
--

INSERT INTO `restaurant_profiles` (`id`, `restaurant_id`, `name`, `nid`, `trade_licence`, `delivery_type`, `delivery_fee`, `delivery_time`, `discount`, `delivery_range`, `mobile`, `address`, `latitude`, `longitude`, `closed_restaurant`, `available_for_delivery`, `feature_section`, `sn`, `image`, `description`, `information`, `options`, `ratting`) VALUES
(121, 121, 'Restaurant 2', '19888918854219132', '1000000000000000001', 'home', 0, '20 min', 5.00, 10, NULL, 'DHAKA, BANGLADESH', '10', '10', '1', '1', 1, NULL, 'http://rongtulibd.com/deliverydot/public/img/restaurant/69202012301609343495.jpg', '<p><span style=\"color: rgb(103, 106, 108); font-size: 14px; font-weight: 600;\">restaurant</span><br></p>', '<p><span style=\"color: rgb(103, 106, 108); font-size: 14px; font-weight: 600;\">restaurant</span><br></p>', NULL, '5'),
(122, 122, 'Restaurant 3', '19888918854219132', '1000000000000000001', 'home', 10, '20 min', 50.00, 10, NULL, 'DHAKA, BANGLADESH', '10', '10', '1', '1', 1, NULL, 'http://rongtulibd.com/deliverydot/public/img/restaurant/13202012301609343572.jpeg', '<p><span style=\"color: rgb(103, 106, 108); font-size: 14px; font-weight: 600;\">restaurant</span><br></p>', '<p><span style=\"color: rgb(103, 106, 108); font-size: 14px; font-weight: 600;\">restaurant</span><br></p>', NULL, '5'),
(125, 123, 'Restaurant123', '12555', '22555', 'home', 0, '30 min', 0.00, 5, NULL, 'qwqw', '21', '214', '', '', 1, NULL, 'http://rongtulibd.com/deliverydot/public/img/restaurant/default.png', '<p>qw</p>', '<p>qw</p>', NULL, '5'),
(134, 132, 'Restaurant132', '123456789', '12356789', 'home', 0, '30 min', 0.00, 5, NULL, NULL, NULL, NULL, '1', '1', 1, NULL, '', NULL, NULL, NULL, '5'),
(135, 124, 'Restaurant 124', '13345689', '23154896', 'home', 0, '30 min', 0.00, 5, NULL, 'asssssssssss', '21', '214', '', '', 1, NULL, 'http://rongtulibd.com/deliverydot/public/img/restaurant/74202101041609791510.jpg', '<p>as</p>', '<p>as</p>', NULL, '5'),
(136, 133, 'Restaurant6', '12345689', '1234564879', 'home', 0, '30 min', 0.00, 5, NULL, NULL, NULL, NULL, '1', '1', 1, NULL, '/uploads/images/12345689_1609869586.jpg', NULL, NULL, NULL, '5');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_reviews`
--

CREATE TABLE `restaurant_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double(8,2) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_settings`
--

CREATE TABLE `restaurant_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `notification` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `popup_notification` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `sms` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `offer_and_promotion` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_settings`
--

INSERT INTO `restaurant_settings` (`id`, `restaurant_id`, `notification`, `popup_notification`, `sms`, `offer_and_promotion`) VALUES
(19, 121, '1', '1', '1', '1'),
(20, 122, '1', '1', '1', '1'),
(23, 123, '1', '1', '1', '1'),
(32, 132, '1', '1', '1', '1'),
(33, 124, '1', '1', '1', '1'),
(34, 133, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `isNew` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `device_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`id`, `name`, `email`, `phone_number`, `isVerified`, `email_verified_at`, `password`, `remember_token`, `status`, `isNew`, `device_token`, `created_at`, `updated_at`) VALUES
(1, 'adadadsad', 'mukul@gmail.com', '+8801734183134', 1, NULL, '123456', NULL, 'active', 'no', 'f9b2HYevSEC53cpHcPP3h9:APA91bE-2pyqiBg6yzyEiSW5moZyYyWzZHVXuKMovoHc9qzj5JEOPaRBQ0g39AfLBg1fVfbZJsIx381JNmutte7jROI-gzGVxzkxMwVF6XyTTKpVW14ASTB9hO_56s2vgsAWmqpb6RIp', '2020-11-15 04:02:31', '2020-12-30 23:17:12'),
(6, 'mukul', 'mukul', '+8801734183130', 1, NULL, '1234556612345', NULL, 'active', 'no', 'fptVOnwQQdWCcvUeGBqHTV:APA91bHshffmmCwyMet6KIj0ngLB5IPv4eY9MyHgQKuhsfc4SpTCJWddfon0XXXvW6Uo0aiVuU3_59cKxB56Mrayrkc50s7XSa606__omrx_AktQMvRSD3iY_LF09105jwGxAEnnJbzd', '2020-12-31 00:56:08', '2021-01-06 11:54:20'),
(7, 'Rakib', 'rakib@gmail.com', '+8801812386609', 1, NULL, '123456', NULL, 'active', 'no', 'c-cDDGDIS525HLYiJSQ5pu:APA91bHdHRc_O0v3NzV4i3M3wA8yh-vrCJ7GU0nMvkSwMelgpJnj5sskGVSm3znrvhrJo6uEgJCGwDi7eMqIYU5rW9BD3_1QV9IcCS3qEqyucdMX-rmMCdRF2w2m-SC8MNDPPEic2AdP', '2021-01-03 20:51:53', '2021-01-03 23:16:46'),
(8, NULL, NULL, '+8801734183139', 1, NULL, NULL, NULL, 'active', 'no', 'fptVOnwQQdWCcvUeGBqHTV:APA91bHshffmmCwyMet6KIj0ngLB5IPv4eY9MyHgQKuhsfc4SpTCJWddfon0XXXvW6Uo0aiVuU3_59cKxB56Mrayrkc50s7XSa606__omrx_AktQMvRSD3iY_LF09105jwGxAEnnJbzd', '2021-01-03 22:20:49', '2021-01-03 22:22:25'),
(9, NULL, NULL, '+8801734183138', 1, NULL, NULL, NULL, 'active', 'no', 'fptVOnwQQdWCcvUeGBqHTV:APA91bHshffmmCwyMet6KIj0ngLB5IPv4eY9MyHgQKuhsfc4SpTCJWddfon0XXXvW6Uo0aiVuU3_59cKxB56Mrayrkc50s7XSa606__omrx_AktQMvRSD3iY_LF09105jwGxAEnnJbzd', '2021-01-03 22:32:28', '2021-01-03 22:33:14'),
(10, 'Rider10', 'rider10@dd.com', '+8801734183137', 1, NULL, '123456', NULL, 'active', 'no', 'fptVOnwQQdWCcvUeGBqHTV:APA91bHshffmmCwyMet6KIj0ngLB5IPv4eY9MyHgQKuhsfc4SpTCJWddfon0XXXvW6Uo0aiVuU3_59cKxB56Mrayrkc50s7XSa606__omrx_AktQMvRSD3iY_LF09105jwGxAEnnJbzd', '2021-01-03 05:00:00', '2021-01-03 22:57:33'),
(11, 'Rider11', 'rider11@dd.com', '+8801734183136', 1, NULL, NULL, NULL, 'active', 'no', 'fptVOnwQQdWCcvUeGBqHTV:APA91bHshffmmCwyMet6KIj0ngLB5IPv4eY9MyHgQKuhsfc4SpTCJWddfon0XXXvW6Uo0aiVuU3_59cKxB56Mrayrkc50s7XSa606__omrx_AktQMvRSD3iY_LF09105jwGxAEnnJbzd', '2021-01-03 05:00:00', '2021-01-03 22:58:43'),
(12, 'Rider12', 'rider12@dd.com', '+8801734183135', 1, NULL, NULL, NULL, 'active', 'no', 'fptVOnwQQdWCcvUeGBqHTV:APA91bHshffmmCwyMet6KIj0ngLB5IPv4eY9MyHgQKuhsfc4SpTCJWddfon0XXXvW6Uo0aiVuU3_59cKxB56Mrayrkc50s7XSa606__omrx_AktQMvRSD3iY_LF09105jwGxAEnnJbzd', '2021-01-03 05:00:00', '2021-01-03 23:00:20'),
(13, 'Rider13', 'rider13@dd.com', '+8801734183133', 1, NULL, '123456', NULL, 'active', 'no', 'fptVOnwQQdWCcvUeGBqHTV:APA91bHshffmmCwyMet6KIj0ngLB5IPv4eY9MyHgQKuhsfc4SpTCJWddfon0XXXvW6Uo0aiVuU3_59cKxB56Mrayrkc50s7XSa606__omrx_AktQMvRSD3iY_LF09105jwGxAEnnJbzd', '2021-01-03 05:00:00', '2021-01-03 23:28:01'),
(14, 'Rider14', 'rider14@dd.com', '+8801734183132', 1, NULL, '124567', NULL, 'active', 'no', 'fptVOnwQQdWCcvUeGBqHTV:APA91bHshffmmCwyMet6KIj0ngLB5IPv4eY9MyHgQKuhsfc4SpTCJWddfon0XXXvW6Uo0aiVuU3_59cKxB56Mrayrkc50s7XSa606__omrx_AktQMvRSD3iY_LF09105jwGxAEnnJbzd', '2021-01-03 05:00:00', '2021-01-03 23:22:07'),
(15, 'Rider15', 'rider15@dd.com', '+8801307409080', 1, NULL, NULL, NULL, 'active', 'no', 'c-cDDGDIS525HLYiJSQ5pu:APA91bHdHRc_O0v3NzV4i3M3wA8yh-vrCJ7GU0nMvkSwMelgpJnj5sskGVSm3znrvhrJo6uEgJCGwDi7eMqIYU5rW9BD3_1QV9IcCS3qEqyucdMX-rmMCdRF2w2m-SC8MNDPPEic2AdP', '2021-01-03 05:00:00', '2021-01-03 23:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `rider_address`
--

CREATE TABLE `rider_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rider_id` bigint(20) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_current_address` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rider_address`
--

INSERT INTO `rider_address` (`id`, `rider_id`, `address`, `is_current_address`) VALUES
(3, 1, 'Uttara, Dhaka', 'no'),
(4, 1, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(5, 1, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(6, 1, 'asdasdasdas asdasdasd', 'no'),
(7, 1, 'asdasdasdas asdasdasd', 'no'),
(8, 1, 'asdasdasdas asdasdasd', 'no'),
(9, 1, 'current address', 'no'),
(11, 1, 'asdasdasdas asdasdasd', 'no'),
(12, 1, 'wwwwwwwwwwwwwwwwwwwwwwwwww', 'no'),
(13, 1, 'wwwwwwwwwwwwwwwwwwwwwwwwww', 'no'),
(14, 1, 'ssssssss', 'no'),
(15, 1, 'current address', 'no'),
(16, 1, 'current address', 'no'),
(17, 1, 'ssssssss', 'no'),
(18, 1, 'ssssssss', 'no'),
(19, 1, 'ssssssss', 'no'),
(21, 1, 'ssssssss', 'no'),
(22, 1, 'ssssssss', 'no'),
(24, 1, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(25, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(26, 1, 'asdasdasdas asdasdasd', 'no'),
(27, 205, 'H-23, R-6, Sector-5, Uttara', 'no'),
(28, 1, 'asdasdasdas asdasdasd', 'no'),
(29, 1, 'ssssssss', 'no'),
(30, 1, 'asdasdasdas asdasdasd', 'no'),
(31, 1, 'ssssssss', 'no'),
(32, 202, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(33, 202, 'H-23, R-6, Sector-5, Uttara, Dhaka', 'no'),
(35, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(36, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(37, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(38, 206, '184,Dhaka Division,Mirpur 10 Roundabout,Dhaka,1216', 'yes'),
(39, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(40, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(41, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(42, 205, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(43, 1, 'asdasdasdas asdasdasd', 'no'),
(45, 1, 'asdasdasdas asdasdasd', 'no'),
(50, 108, 'uttara, dhaka', 'no'),
(51, 108, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(52, 108, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(53, 116, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(54, 1, 'asdasdasdas asdasdasd', 'no'),
(55, 1, 'efdsfsdfsdf', 'no'),
(56, 1, 'efdsfsdfsdf', 'no'),
(57, 3, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(58, 2, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(59, 2, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(60, 2, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(61, 0, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(62, 0, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(63, 0, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(64, 0, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(65, 1, 'Unknown', 'no'),
(66, 1, 'Unknown', 'no'),
(67, 1, 'Unknown', 'yes'),
(68, 6, 'rttyy', 'no'),
(69, 6, 'rttyy', 'no'),
(70, 6, 'rttyy', 'no'),
(71, 6, 'rttyy', 'no'),
(72, 7, 'Dhaka,Dhaka Division,Dhaka,1230', 'no'),
(73, 7, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(74, 0, 'Unknown', 'yes'),
(75, 8, 'Unknown', 'yes'),
(76, 9, 'Unknown', 'yes'),
(77, 10, 'Unknown', 'yes'),
(78, 11, 'Unknown', 'yes'),
(79, 12, 'Unknown', 'yes'),
(80, 13, 'Unknown', 'yes'),
(81, 14, 'fgjdhdueehheyuhh', 'yes'),
(82, 15, 'Dhaka,Dhaka Division,Dhaka,1230', 'yes'),
(83, 6, 'rttyy', 'no'),
(84, 6, 'rttyy', 'no'),
(85, 6, 'rttyy', 'no'),
(86, 6, 'rttyy', 'no'),
(87, 6, 'Unknown', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `rider_orders`
--

CREATE TABLE `rider_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `rider_id` bigint(20) UNSIGNED NOT NULL,
  `ride_date` datetime NOT NULL,
  `status` enum('accept','cancel','in_restaurant','delivered') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rider_profiles`
--

CREATE TABLE `rider_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rider_id` bigint(20) UNSIGNED NOT NULL,
  `nid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT 'http://rongtulibd.com/deliverydot/public/uploads/images/default.png',
  `dob` date DEFAULT NULL,
  `spouse_dob` date DEFAULT NULL,
  `father_dob` date DEFAULT NULL,
  `mother_dob` date DEFAULT NULL,
  `anniversary` date DEFAULT NULL,
  `first_child_dob` date DEFAULT NULL,
  `second_child_dob` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_biography` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rider_profiles`
--

INSERT INTO `rider_profiles` (`id`, `rider_id`, `nid`, `image`, `dob`, `spouse_dob`, `father_dob`, `mother_dob`, `anniversary`, `first_child_dob`, `second_child_dob`, `address`, `short_biography`) VALUES
(1, 1, '1e323232323', 'http://rongtulibd.com/deliverydot/public', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'efdsfsdfsdf', NULL),
(6, 6, '123456789', 'http://rongtulibd.com/deliverydot/public/img/rider/83202101051609869746.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rttyy', NULL),
(7, 7, '25888', 'http://rongtulibd.com/deliverydot/public/img/rider/18202101031609697806.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Uttara', NULL),
(8, 8, '12356', '/uploads/images/12356_1609694499.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 9, '123456879', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 10, '12345678976', 'http://rongtulibd.com/deliverydot/public/img/rider/25202101031609696652.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uttara', NULL),
(11, 11, '123335888', 'http://rongtulibd.com/deliverydot/public/img/rider/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 12, '22222222222', 'http://rongtulibd.com/deliverydot/public/img/rider/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 13, '1e32323232309', 'http://rongtulibd.com/deliverydot/public/img/rider/37202101031609698481.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'qweryy', NULL),
(14, 14, '2222222222', 'http://rongtulibd.com/deliverydot/public/img/rider/45202101031609697972.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgjdhdueehheyuhh', NULL),
(15, 15, '25888', 'http://rongtulibd.com/deliverydot/public/img/rider/63202101031609697948.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rider_settings`
--

CREATE TABLE `rider_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rider_id` bigint(20) UNSIGNED NOT NULL,
  `notification` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `popup_notification` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `sms` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `offer_and_promotion` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rider_settings`
--

INSERT INTO `rider_settings` (`id`, `rider_id`, `notification`, `popup_notification`, `sms`, `offer_and_promotion`) VALUES
(1, 1, '1', '1', '1', '1'),
(6, 6, '1', '1', '1', '1'),
(7, 7, '1', '1', '1', '1'),
(8, 8, '1', '1', '1', '1'),
(9, 9, '1', '1', '1', '1'),
(10, 10, '1', '1', '1', '1'),
(11, 11, '1', '1', '1', '1'),
(12, 12, '1', '1', '1', '1'),
(13, 13, '1', '1', '1', '1'),
(14, 14, '1', '1', '1', '1'),
(15, 15, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `notification` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `sms` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `offer_and_promotion` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `customer_id`, `notification`, `sms`, `offer_and_promotion`) VALUES
(1, 201, '1', '1', '1'),
(2, 201, '1', '1', '1'),
(3, 202, '1', '1', '1'),
(4, 202, '1', '1', '1'),
(5, 203, '1', '1', '1'),
(6, 203, '1', '1', '1'),
(7, 201, '1', '1', '1'),
(8, 7, '1', '1', '1'),
(9, 8, '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_type` enum('home','collect') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'home',
  `delivery_fee` double NOT NULL DEFAULT 0,
  `delivery_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '30 min',
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `delivery_range` int(11) NOT NULL DEFAULT 5,
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closed_shop` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `available_for_delivery` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `information` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'json attributes add in future'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `delivery_type`, `delivery_fee`, `delivery_time`, `discount`, `delivery_range`, `mobile`, `address`, `latitude`, `longitude`, `closed_shop`, `available_for_delivery`, `image`, `description`, `information`, `options`) VALUES
(1, 'Polly Howe PhD', 'home', 0, '30 min', 0.00, 5, '327.394.7156 x69269', '3704 Tamara Walks\nRutherfordside, IL 41264-3299', '72.411461', '122.319512', '1', '1', 'https://lorempixel.com/640/480/?62786', 'Recusandae facilis et nobis id aut tenetur optio sequi. Illum dicta illum vel dolores at libero. Porro ducimus sint aliquid et commodi aut et. Sint eos velit distinctio qui aliquam.', 'Ab mollitia quia dolores ea fuga consequatur. Aut eaque quis sed et beatae autem nobis. Corrupti ut magni non autem voluptatem.', 'Perferendis inventore ea porro optio quia. Ea a et et animi ea voluptatem.'),
(2, 'Mrs. Rubie Auer III', 'home', 0, '30 min', 0.00, 5, '756.699.1977 x1718', '882 Ismael Overpass Suite 584\nNorth Carrieton, OR 28540', '-65.100231', '-74.229774', '1', '1', 'https://lorempixel.com/640/480/?29530', 'Nostrum minus quis perferendis dolor quod. Modi adipisci quia numquam ullam. Minima dolorem et alias et maxime quod. Culpa aliquid ex sunt fugit.', 'Nulla voluptatem cum sint quia quis temporibus. Illo pariatur ratione sint odit ut optio qui. Accusantium accusantium ut exercitationem. Quo numquam rem sequi consequatur neque nostrum iste.', 'Porro consequatur quisquam excepturi sit. Porro quo voluptatem aut vel voluptatem. Placeat quae a provident.'),
(3, 'Mr. Merl Abbott', 'home', 0, '30 min', 0.00, 5, '987-451-1024', '12350 Casper Crescent Suite 949\nNorth Alleneborough, NJ 06826-2779', '-34.226632', '45.25941', '1', '1', 'https://lorempixel.com/640/480/?82927', 'Iusto ex sint quo harum dolorum adipisci. Non officiis dolorem adipisci est consequatur et voluptatum repudiandae. Qui delectus aperiam nihil quisquam.', 'Recusandae rem adipisci corporis magnam unde sit. Aut quisquam quisquam minima quibusdam libero consequatur sed.', 'Et sunt ut aut doloremque aut maiores amet. Est qui id nostrum qui repudiandae ad. Quas omnis ut magni fugit.'),
(4, 'Lenna Oberbrunner', 'home', 0, '30 min', 0.00, 5, '+14099224945', '9320 Waelchi Shores Apt. 159\nZiemannview, NM 40331', '-82.178028', '-30.370802', '1', '1', 'https://lorempixel.com/640/480/?13808', 'Cumque magnam dolores qui doloribus eveniet et eum. Qui cupiditate commodi aliquid eaque est repellat earum. Perspiciatis ipsa iusto sit voluptatibus autem sapiente.', 'Totam iusto sapiente beatae quisquam possimus optio odio. Delectus nemo in molestiae numquam.', 'Enim quo est accusamus error. Esse sint ab voluptas aut vel. Est eius consequatur earum. Temporibus laborum qui ut quia sed.'),
(5, 'Prof. Marilou Boehm', 'home', 0, '30 min', 0.00, 5, '549.978.6228 x101', '2957 Ferry Forks\nFeeneyville, IL 04598', '-81.151975', '4.561232', '1', '1', 'https://lorempixel.com/640/480/?32610', 'Voluptatem iure et sunt. Similique error rem et quisquam incidunt quidem quo. Tempora quae vero consequatur eum temporibus maxime.', 'Quis pariatur dolore dicta est. Est repellendus non quis corrupti accusamus explicabo. Et non iure in quis asperiores nam. Voluptatem laboriosam voluptate non quod.', 'Eos vero suscipit ea culpa est a. Aliquam commodi fugit ratione tempora minus corrupti. Atque qui beatae quia sit. Dolorem nihil excepturi nihil minus id.'),
(6, 'Zackery Hand', 'home', 0, '30 min', 0.00, 5, '1-934-528-6240 x2691', '80558 Irma Valley\nWest Samir, AR 22467', '87.66939', '-111.777059', '1', '1', 'https://lorempixel.com/640/480/?38481', 'Quibusdam facilis doloremque nisi vel eveniet molestiae omnis. Blanditiis qui rerum voluptatum exercitationem veniam voluptates necessitatibus.', 'Ipsam earum tempora voluptatem nisi consequatur. Perferendis laborum nobis quam voluptas aliquam animi ipsam nam. Error tempora praesentium officiis aut qui a.', 'Aut magni voluptas in eligendi. Optio asperiores enim repellendus officia soluta quas qui.'),
(7, 'Mattie Welch', 'home', 0, '30 min', 0.00, 5, '+1-690-610-6113', '34674 Hellen Trafficway Apt. 130\nMacejkovichaven, MA 68045-4749', '-29.029998', '-100.651176', '1', '1', 'https://lorempixel.com/640/480/?74298', 'Facilis omnis exercitationem consequuntur et officia. Et distinctio assumenda aperiam mollitia perferendis. Error velit optio cum maiores. Odio sapiente necessitatibus aut facilis at eaque.', 'Pariatur autem recusandae eligendi magnam nihil. Similique doloribus sed architecto recusandae et. Vel est eum et ab.', 'Blanditiis est sint aperiam est ea. Officia rerum eligendi accusantium labore. Est voluptas cum nihil culpa.'),
(8, 'Frida Hettinger Sr.', 'home', 0, '30 min', 0.00, 5, '(883) 700-9135', '2192 Hessel Well Apt. 472\nHamillmouth, UT 43087', '16.401359', '-143.928249', '1', '1', 'https://lorempixel.com/640/480/?11207', 'Molestiae hic quis labore numquam reprehenderit non blanditiis harum. Qui ut ut voluptas est quisquam et. Sit ipsam voluptatem consequatur. Non laudantium ducimus ipsum est temporibus iure.', 'Consequatur necessitatibus ratione sequi voluptatem officiis ipsum. Ut id perferendis tenetur praesentium accusamus rerum quis quia. Et ipsam temporibus magnam. Fugiat voluptatem aut rem fuga.', 'Maxime atque voluptatum dolores odio. Error qui illo cupiditate qui atque eum. Omnis et nostrum laboriosam accusantium id. Vel quaerat exercitationem in quia aliquam repellat odit.'),
(9, 'Jayden Stoltenberg', 'home', 0, '30 min', 0.00, 5, '327.873.9303 x147', '729 Herminia Drives Suite 818\nErdmanfort, SD 23105', '38.66284', '-18.079113', '1', '1', 'https://lorempixel.com/640/480/?86131', 'Unde aliquam voluptatem velit sed eos fugiat. Modi qui culpa alias provident ullam explicabo accusamus. Corporis amet omnis iusto optio. Aut cumque non qui et.', 'Voluptatem similique consequatur est. Dolore maiores adipisci maiores cupiditate omnis impedit ducimus. Quisquam et et sunt porro at. Odio error sequi debitis qui quia earum.', 'Minus ipsa ea vel recusandae ducimus aut. Molestiae temporibus reiciendis quam dolor vero modi placeat. Eos quaerat porro distinctio porro pariatur voluptas alias. Ea adipisci eum porro eius.'),
(10, 'Yasmin Beatty', 'home', 0, '30 min', 0.00, 5, '764-914-4310', '75705 Tyrel Pass\nPort Deon, NM 47844', '44.170318', '113.793122', '1', '1', 'https://lorempixel.com/640/480/?53110', 'Incidunt qui nostrum autem repellendus. Nihil dolor et eum placeat vitae ut. Similique optio ullam ullam laborum tenetur nemo minima quo. Voluptatem voluptatum dolores quaerat minima odit velit.', 'Labore quos hic modi voluptas aut. Voluptatum error quia facilis assumenda sequi voluptates ipsum.', 'Molestiae quia sit quod omnis molestiae. Aut maiores optio sit modi ipsam occaecati. Sit rerum velit aspernatur minima non.'),
(11, 'Garth Romaguera', 'home', 0, '30 min', 0.00, 5, '771.619.1835', '907 Kozey Ford Suite 272\nKaciport, TN 88709-7407', '11.956371', '-93.346082', '1', '1', 'https://lorempixel.com/640/480/?58775', 'Molestiae dolorem vero exercitationem laudantium ea. Aspernatur ab dolores sapiente qui. Nisi et aut nihil tenetur corporis iste. Voluptate consequatur ducimus et quam.', 'Aut sed sit quaerat expedita. Molestiae possimus odit consequatur facere facilis enim tempore. Esse placeat ullam rerum.', 'Quia qui facere cupiditate cumque vero qui. Ut non ducimus qui veritatis dolorum nostrum. Facilis in vel hic eligendi repellendus atque incidunt.'),
(12, 'Bart King', 'home', 0, '30 min', 0.00, 5, '(913) 707-2973 x070', '5824 Friesen Centers Apt. 021\nEast Joe, CO 44709', '-36.392886', '143.361889', '1', '1', 'https://lorempixel.com/640/480/?84872', 'Tempora et quam voluptates sit mollitia voluptas. Mollitia ut totam commodi eum itaque. Molestiae consequatur praesentium ab rerum est aut reiciendis.', 'Animi debitis qui molestias aliquam sint et. A ad sint molestiae eum. Ea laborum quas ea nobis dolorum natus.', 'Beatae eius aliquid quia ea perferendis iusto enim. Est eos iure accusamus asperiores. Quaerat quod velit aut aperiam. Minima aut fuga voluptatibus ut.'),
(13, 'Prof. Tressa Schneider II', 'home', 0, '30 min', 0.00, 5, '(214) 437-2019', '564 Lang Ridge\nNorth Verla, KS 77421-4763', '48.787012', '-10.197401', '1', '1', 'https://lorempixel.com/640/480/?12556', 'At fugit ut corrupti nesciunt odio. Modi error expedita et. Et quasi omnis iusto atque quasi. Beatae ab odio ipsa quae distinctio. Delectus omnis est et dolor.', 'Cupiditate fuga consequuntur recusandae eveniet sed quisquam architecto rerum. Ad molestiae eos dolorum vel. Distinctio dignissimos ipsa sequi a voluptatem qui rem aut.', 'Rerum sit unde suscipit commodi dignissimos. Incidunt mollitia voluptas aut molestiae soluta quis quia. Quae eius qui similique et et dicta voluptatum ut.'),
(14, 'Julia Hoeger', 'home', 0, '30 min', 0.00, 5, '(737) 925-6591 x804', '822 Dickens Landing Apt. 243\nPort Kenyatta, MI 14181-9710', '-82.916016', '51.279044', '1', '1', 'https://lorempixel.com/640/480/?12948', 'Voluptates aut eum placeat unde. Et et quam deserunt debitis asperiores. Sint vitae aut omnis est. Beatae magni non aut eos voluptatem sunt. Natus quam officiis architecto vel dolore soluta ex.', 'Eius itaque quae ut totam totam ex. Autem adipisci blanditiis quis dicta odio similique eum cum. Similique officiis consequatur tempore eos laborum earum.', 'Deleniti itaque cupiditate autem recusandae sint. Exercitationem qui eaque nisi saepe sequi. Rerum eius quis voluptas sed. Sit error nulla eveniet alias et possimus.'),
(15, 'Dr. Katrina Langosh', 'home', 0, '30 min', 0.00, 5, '+1.330.629.7866', '7765 Walker Crossing\nHoppeville, WA 17613', '83.996871', '-61.620467', '1', '1', 'https://lorempixel.com/640/480/?23566', 'Dolore quia non culpa. Accusamus aut minus reiciendis ab temporibus quo iure. Molestias iure dolores repudiandae eius alias et.', 'Vero quidem quod minima quos dolorem et. Tenetur non at quam iste deleniti sint. At dicta vel dolor odio.', 'Qui quaerat iusto facilis dolorum. Dolorem qui exercitationem sit molestias esse repudiandae facilis. Vel sit magni dolorum corporis et non. Iste aut atque et a ab libero minima occaecati.'),
(16, 'Dr. Nakia Lockman PhD', 'home', 0, '30 min', 0.00, 5, '(780) 560-4342 x951', '3952 Walter Motorway\nEast Sheilamouth, AR 91660-7746', '47.352122', '160.153061', '1', '1', 'https://lorempixel.com/640/480/?66189', 'Voluptates fugiat labore quos ut necessitatibus autem. Quam doloremque odio qui iste architecto cum unde. Est et ad tempore at.', 'Est enim vel quia est velit est molestiae. Similique quia autem voluptas. Veritatis nostrum omnis ut maiores.', 'Fugit sunt odio maiores corrupti doloremque nihil. Est facilis dolores ut amet corporis aut. Quibusdam est quasi vel esse.'),
(17, 'Quentin Stroman DVM', 'home', 0, '30 min', 0.00, 5, '+1-808-658-6828', '9539 Hauck Streets Suite 915\nAshlyborough, OR 70254', '15.178053', '-137.765582', '1', '1', 'https://lorempixel.com/640/480/?20019', 'Impedit ab placeat omnis alias tenetur. Nostrum laborum rem soluta id illo quas harum. Consectetur modi alias ducimus. Itaque et amet autem non velit eum saepe.', 'Adipisci autem non voluptatem enim et dignissimos. Aut sint dicta voluptatem. Voluptates nam laborum qui in. Necessitatibus nulla odio voluptatem explicabo et est consequatur.', 'Asperiores repellendus nulla nostrum dignissimos. Hic omnis eveniet eveniet iure magnam porro. Molestiae inventore illum incidunt qui.'),
(18, 'Celine Lindgren', 'home', 0, '30 min', 0.00, 5, '1-308-477-7152 x4152', '4641 Haley Cove Apt. 881\nNorth Amieside, IA 34600', '-14.688074', '-96.305649', '1', '1', 'https://lorempixel.com/640/480/?60785', 'Hic officia qui et molestiae impedit aut qui. Consequatur voluptatum ratione laboriosam consequatur omnis et soluta. Qui nobis aspernatur ut ut.', 'Eaque magni sunt qui laboriosam eum. Dolore totam occaecati similique similique optio vel mollitia. Eveniet et reiciendis cupiditate quo facilis corporis. Ea minima facilis animi facilis quas quo.', 'Ullam ad porro et neque ratione. Dolores totam non voluptatem similique itaque. Perspiciatis est non aliquam quisquam incidunt est alias. Vel est non facere.'),
(19, 'Prof. Friedrich Armstrong', 'home', 0, '30 min', 0.00, 5, '+1-258-736-2917', '7230 Timmothy Rue\nBednarfurt, VA 70913-1441', '-84.127986', '23.540033', '1', '1', 'https://lorempixel.com/640/480/?57215', 'Adipisci doloribus suscipit ut consequatur doloremque sapiente. Laborum repellat exercitationem dicta. Eos dolores consequatur sequi quisquam voluptatem.', 'Ratione quia esse magni blanditiis sit. Accusantium quisquam ad natus porro provident. Sunt odio nihil et magni laudantium dolores.', 'Ut eveniet quo asperiores eum veniam. Ad architecto aspernatur excepturi dolores. Sequi quam laudantium qui. Qui commodi repellendus reiciendis et asperiores modi in.'),
(20, 'Antone McGlynn', 'home', 0, '30 min', 0.00, 5, '1-270-933-8472 x07383', '925 Keeley Fork Suite 390\nSouth Guadalupe, OK 84814', '79.550188', '49.265213', '1', '1', 'https://lorempixel.com/640/480/?98693', 'Eos voluptatibus laudantium repudiandae quidem est qui id ea. Maxime nihil facere culpa eum eaque. Temporibus earum provident nostrum minus architecto maxime laborum aut.', 'Dolorem culpa consequatur cum quo architecto. Voluptatum et et est magni reprehenderit placeat. Et aut odit esse.', 'Eveniet quia beatae aut sit sit est. Itaque amet libero libero beatae unde qui. Consequuntur facere voluptatum at. Earum molestiae optio autem tempora.'),
(21, 'Marcos Witting III', 'home', 0, '30 min', 0.00, 5, '430.697.8300 x073', '8023 Nicolas Roads\nNorth Archmouth, MI 10369-2283', '35.42218', '-108.973898', '1', '1', 'https://lorempixel.com/640/480/?47228', 'Ex eos nostrum eos et iste. Quis quidem delectus suscipit quod veritatis fugit. Voluptate esse et in commodi omnis nam minima. Laboriosam nesciunt neque et tempora qui ducimus vel.', 'Atque nostrum laboriosam ab sapiente aperiam eum qui. Qui nihil in et et. Et adipisci molestias fugiat sed.', 'Eveniet inventore eveniet corrupti dolores. Et omnis odit provident dignissimos quis dolorem. Et qui doloremque consequatur iure. Qui atque quia consectetur quia.'),
(22, 'Horacio Feest MD', 'home', 0, '30 min', 0.00, 5, '590-866-9718 x07229', '3235 Toy Plains Suite 727\nWest Gwen, MS 92778', '39.056023', '-42.877825', '1', '1', 'https://lorempixel.com/640/480/?47148', 'Est illum rerum laborum assumenda. Nihil amet iure quo quae aut. Soluta quo est quisquam. Rerum est dolor nesciunt quae quo tenetur. In libero ut qui sit aliquam eum.', 'Odit est tempore non sit ut. Sed possimus placeat aut deserunt iusto sint. Sunt autem iste doloremque. Placeat itaque nam quia perferendis numquam.', 'Sed blanditiis natus ea dolorem modi vero. Eligendi in qui ducimus nihil et quae. Molestias ipsam eligendi amet sed quos sit accusamus. Hic voluptatem omnis molestiae ex esse facere qui.'),
(23, 'Joanne Schaden', 'home', 0, '30 min', 0.00, 5, '473-806-3470 x31679', '5605 Bo Fort Apt. 422\nSouth Zettaton, OH 23971-4773', '56.391999', '13.853076', '1', '1', 'https://lorempixel.com/640/480/?24328', 'Mollitia quo voluptates numquam et. At quia saepe nam ad nam minima. Laudantium earum culpa animi ut omnis non. Ut eius porro porro accusamus.', 'Sit doloribus quod dolorem et hic id. Ratione tempore dicta animi dolores illo. Illo omnis eos commodi iste. Culpa qui non delectus ut sunt eius magni.', 'Rerum aliquam ut placeat quo minus possimus id. Reprehenderit ut ut quae. A officiis laudantium fuga. Iusto autem quo qui tempore. Ad minus impedit assumenda beatae necessitatibus quae.'),
(24, 'Blanche Monahan', 'home', 0, '30 min', 0.00, 5, '1-989-561-9536 x63908', '58574 Shannon Forge\nWest Makayla, WI 60943-8124', '25.189849', '166.559415', '1', '1', 'https://lorempixel.com/640/480/?54338', 'Rerum officiis esse neque placeat dolore ut maiores. Ea et voluptas doloremque dolorem nostrum.', 'Accusamus qui voluptatibus blanditiis totam quia. Beatae non doloribus quidem vero minima consequatur. Pariatur consequatur qui quidem praesentium aut.', 'Asperiores ea doloribus ipsum dolor iste. Aut autem eum dolores molestiae officia. Recusandae eum odio autem eos est vero. Repellendus et enim aut voluptatem molestiae et et.'),
(25, 'Baron Huel', 'home', 0, '30 min', 0.00, 5, '+1 (414) 588-5909', '30085 Kerluke Walk\nWest Kelsi, AL 59579', '83.304773', '-11.892073', '1', '1', 'https://lorempixel.com/640/480/?22145', 'Et consequuntur molestiae et occaecati. Accusamus possimus debitis officia laborum vel. Eaque sint minus officiis fugiat. Aspernatur quibusdam eum sequi aut.', 'Odio dolorem distinctio est debitis vero cum facere doloribus. Aliquam est velit ab illum similique doloremque omnis. Odit voluptas qui est dolore possimus voluptatum. Nam magni esse minima.', 'Tempora eum enim ut dolorem dolores reiciendis. Quisquam vel similique et et quis sed quo. Consequatur tempore consequatur ut natus aut et. Tenetur eligendi quam excepturi incidunt.'),
(26, 'Olga Sauer', 'home', 0, '30 min', 0.00, 5, '672-798-9559', '35490 Isabella Key\nWest Horacefort, AZ 12424-3346', '-85.255524', '96.048096', '1', '1', 'https://lorempixel.com/640/480/?33423', 'Accusantium ex aut necessitatibus qui eum. Dolores molestias ut necessitatibus magni expedita ut veritatis. Et porro saepe voluptate est.', 'Et repellendus et esse nesciunt. Ut qui sit est dolor quas in molestiae. Sunt fugit id molestiae ut itaque. Accusamus repudiandae nesciunt aperiam nihil.', 'Et alias sunt incidunt voluptatem. Et totam eos fugiat magnam esse consequatur deleniti laudantium. Vel sint laborum quia consectetur amet.'),
(27, 'Prof. Doris Leuschke IV', 'home', 0, '30 min', 0.00, 5, '(439) 520-6551 x382', '45478 Leora Overpass Apt. 477\nMillerview, SC 65904', '82.814248', '57.786309', '1', '1', 'https://lorempixel.com/640/480/?67084', 'Ea ut itaque ratione nobis qui at rerum sint. Non et mollitia voluptatem odio est. Non qui impedit et sed magni quasi. Et amet deserunt blanditiis repellendus aperiam.', 'Voluptatem nesciunt doloribus voluptatem quis quo modi aliquam. Ut autem ullam eius sunt aut dolorem nostrum omnis. Ipsa ex quia ad et est quam ex a. Consequatur perferendis perferendis at incidunt.', 'Tenetur illum nihil eum et perspiciatis id est. Accusamus qui error quisquam molestiae non. Doloremque possimus ipsum nesciunt maxime sint.'),
(28, 'Jackie Crist', 'home', 0, '30 min', 0.00, 5, '1-272-839-6892', '92059 Cole Course\nKuhicside, IL 94115-8609', '30.75242', '-154.484164', '1', '1', 'https://lorempixel.com/640/480/?69390', 'Et qui sit culpa eum et velit. Omnis fugit autem inventore velit minus voluptates. Minus in quas nisi voluptatem at. Vel numquam dicta sed rerum officiis quia.', 'Illo non quibusdam quis. Praesentium iusto non ratione ut. Ea alias adipisci quod accusamus ut. In necessitatibus eos repellat praesentium architecto voluptas tempora.', 'Itaque quo id voluptatem quis et. Maiores iure occaecati ab eaque architecto. Cupiditate qui voluptas corrupti vel qui nihil vitae mollitia. Sed accusantium earum quos molestiae ad.'),
(29, 'Piper Becker', 'home', 0, '30 min', 0.00, 5, '494-946-5042', '34444 Dorris Rapid Suite 162\nNew Judah, VA 13705-6083', '83.950305', '99.304303', '1', '1', 'https://lorempixel.com/640/480/?72645', 'Beatae nostrum in tenetur. Voluptates itaque consequatur reprehenderit eos. Nulla laborum beatae minus qui velit. Ullam repudiandae aut explicabo. Eius vitae doloribus id rerum.', 'Ut rerum harum sunt cum praesentium. Architecto aut sit itaque consectetur inventore. Fugiat ea praesentium quibusdam in at. Temporibus officiis commodi qui in sint.', 'Distinctio quod est aliquam sit. Maxime nihil possimus placeat delectus minus. Sit quaerat et nemo ab delectus et voluptate ut. Nihil nobis officia et.'),
(30, 'Isaias Witting', 'home', 0, '30 min', 0.00, 5, '250.738.8861 x743', '623 Hilpert Common Apt. 173\nAuerhaven, IA 93542-3908', '2.371492', '-76.428282', '1', '1', 'https://lorempixel.com/640/480/?19637', 'Reprehenderit qui cupiditate aut velit consequatur. Qui laboriosam harum id non inventore tenetur libero. Aut velit doloribus voluptas sed sit suscipit. Eum totam est est eveniet.', 'Reprehenderit provident ut et delectus cupiditate. Aut ipsam nisi quidem et velit. Odio aut autem ea nesciunt velit est voluptas. Minus voluptatem neque vel dicta.', 'Et ut aliquid impedit est. Aperiam voluptates quae ducimus quae odio itaque quidem. Deleniti laboriosam magni omnis sint in minus.'),
(31, 'Jerad Lynch', 'home', 0, '30 min', 0.00, 5, '+1 (468) 998-6524', '7942 Adelia Mountain Apt. 372\nJaskolskimouth, DE 01617-1118', '61.189045', '47.495295', '1', '1', 'https://lorempixel.com/640/480/?87578', 'Voluptatibus cumque nemo velit sunt est culpa adipisci. Odit qui fugiat asperiores repellat. Est dolorem voluptates et ut tempore et quisquam.', 'Officiis ullam eligendi veritatis est atque aliquid voluptatem qui. Laudantium fuga labore natus rerum et eius. Voluptatem non vel ipsum et doloremque odio provident adipisci.', 'Est blanditiis velit odit. Temporibus ut sunt voluptatum libero a quia et. Repellat rem enim sed rem autem. Illum et quos rerum neque nihil. Perferendis eum odit non neque et voluptates.'),
(32, 'Gwendolyn Little', 'home', 0, '30 min', 0.00, 5, '(423) 321-5066', '5309 Littel Green\nPort Lacyport, CT 50741-5475', '-9.389877', '-76.265965', '1', '1', 'https://lorempixel.com/640/480/?18579', 'Voluptas nihil excepturi vel dolor rerum tempore dolor doloremque. Nemo repellat laudantium et odio culpa. Pariatur a tempore excepturi ullam.', 'Magnam officia facilis beatae suscipit quaerat voluptas facilis eum. Voluptatem earum tenetur et quaerat non voluptate. Excepturi perspiciatis et doloribus at soluta fugit.', 'Ut nisi eius rerum quo quasi. Recusandae alias perspiciatis dolorem dolores deleniti sit. In aliquam aliquid et et eos qui in. In nostrum quae excepturi eos a.'),
(33, 'Conner Lehner', 'home', 0, '30 min', 0.00, 5, '(393) 907-2783', '7526 Alexanne Court\nNorth Raheem, FL 99377-3929', '-46.480124', '103.543817', '1', '1', 'https://lorempixel.com/640/480/?90354', 'Exercitationem reiciendis cumque quia. Qui asperiores iste quas voluptatibus dolorem voluptatum occaecati. Exercitationem in nesciunt non officiis maxime.', 'Debitis nihil maxime at iste. Ullam officiis omnis dolor. Vel provident sed non. Vero sed non blanditiis occaecati recusandae dolorem est.', 'Consequatur voluptatum quis ea eum. Aut error accusantium soluta ratione. Doloremque deleniti molestiae ut molestiae perspiciatis ipsa. Dolore nostrum porro et ipsum iusto.'),
(34, 'Mrs. Kylee O\'Connell', 'home', 0, '30 min', 0.00, 5, '+1-927-287-9071', '6592 Miller Run Apt. 694\nShayneburgh, UT 03604-2963', '54.386434', '-87.167837', '1', '1', 'https://lorempixel.com/640/480/?21803', 'Quis tenetur nisi blanditiis consectetur dicta quas. Natus modi ratione qui qui eum eos. In perferendis error ut molestias quod temporibus.', 'In et nisi sequi soluta quia fugiat. Consequatur possimus odio doloribus veritatis. Et alias consequuntur mollitia voluptatem non rem consequuntur.', 'Blanditiis est voluptate sint. Et ut aut et delectus deserunt quae. Dolore qui numquam et et dolore. Voluptatem iusto ea iusto maxime quia.'),
(35, 'Alessandra Rodriguez', 'home', 0, '30 min', 0.00, 5, '1-217-651-3146 x54912', '981 Torp Highway Apt. 030\nWest Renee, MD 07700', '-84.507493', '-104.887595', '1', '1', 'https://lorempixel.com/640/480/?94549', 'Qui error aperiam eum eos. Nulla ut debitis voluptatem occaecati optio eum. Deleniti nulla nihil esse laudantium facilis a qui.', 'Sint explicabo ducimus at. Est doloremque voluptatem et debitis. Iusto sequi iusto quam ut nostrum expedita accusantium laudantium. Maiores soluta autem et assumenda voluptas.', 'Ut et voluptas necessitatibus molestiae dignissimos. Aliquam sequi optio repudiandae. Qui molestiae perspiciatis mollitia tempora et et sit. Est eos magni voluptatem.'),
(36, 'Guiseppe Greenfelder', 'home', 0, '30 min', 0.00, 5, '330-665-1559 x11701', '991 Melvina Turnpike\nEast Kaitlin, PA 86676-3758', '-17.535932', '114.223634', '1', '1', 'https://lorempixel.com/640/480/?98221', 'Id aut deserunt et enim suscipit fugit. Tempora id explicabo molestiae voluptas nobis non. Quae velit nesciunt dolor voluptate tenetur et. Quis dolores quisquam quod velit.', 'Voluptatem delectus placeat omnis et unde. Sint et ut omnis provident qui. Eaque autem animi laborum aliquam unde quas. Quod officiis voluptatibus voluptatem dolorum labore exercitationem incidunt.', 'Quam aliquam deleniti beatae minus. Ut occaecati molestiae voluptatibus enim eius aliquam fuga. Et voluptate rerum ex non laborum odio necessitatibus.'),
(37, 'Samara Dach', 'home', 0, '30 min', 0.00, 5, '(691) 804-9582 x605', '8507 Harber Mountain Suite 534\nJaydenview, NJ 93515', '33.666217', '171.047985', '1', '1', 'https://lorempixel.com/640/480/?57733', 'Quo explicabo saepe tempora voluptatem nihil animi. Aspernatur suscipit error et nesciunt ut ut. Est dolorum rem iusto et velit. Aut et eaque sit tempora aperiam nam eos.', 'Molestiae ut eaque enim nihil. Culpa ut provident nisi est. Voluptatum sed perferendis recusandae nobis optio tempora exercitationem alias. Dolores qui porro sequi. Est fugit id rerum quia sint.', 'In in ut et quos pariatur. Iste provident tempore est tempore unde esse cumque. Reiciendis qui ipsa voluptas distinctio. Voluptas laborum qui animi. Natus quia dolorum minus voluptas debitis.'),
(38, 'Mrs. Corene Schmidt', 'home', 0, '30 min', 0.00, 5, '+1 (635) 396-5818', '44289 Obie Springs\nLewisburgh, FL 54708-5252', '77.656795', '-17.62362', '1', '1', 'https://lorempixel.com/640/480/?44966', 'Praesentium numquam aliquam molestiae quia. Ea sunt magni architecto. Ut nobis ut deserunt vitae.', 'Magni velit id corporis deserunt ut qui alias. Amet consequatur natus ipsum temporibus perferendis. Sunt illo unde ad aut. Animi quidem cum eos possimus iure.', 'Eum sit impedit numquam voluptatem. Harum dolorem omnis quia. Ipsa aperiam quis delectus praesentium pariatur. Illum autem aspernatur dicta voluptate ipsam facere ad illum.'),
(39, 'Princess Stroman', 'home', 0, '30 min', 0.00, 5, '(615) 730-6098', '5083 Bogan Shoal Apt. 382\nSouth Noelburgh, MT 23846-5927', '-68.076069', '129.090138', '1', '1', 'https://lorempixel.com/640/480/?46642', 'Numquam distinctio magni ducimus aliquid. Voluptatibus accusamus et error quia est repudiandae et. Occaecati vel asperiores commodi est sed. Excepturi accusamus ut non rerum et quis.', 'Magnam molestias maxime laboriosam optio. Corporis magni amet laudantium dicta autem. Explicabo doloremque molestiae est dolores esse sed voluptatem.', 'Aut officia aut quasi placeat. Qui et quos adipisci. Molestias iusto mollitia numquam et omnis voluptatem dolor qui.'),
(40, 'Ubaldo Effertz', 'home', 0, '30 min', 0.00, 5, '+1 (402) 582-0816', '2996 Alfreda Valleys Suite 519\nEast Kim, MT 88557-9539', '26.134059', '11.259027', '1', '1', 'https://lorempixel.com/640/480/?26002', 'Ducimus autem mollitia voluptatem est. Minus amet quidem libero consequuntur enim hic nisi. Cum corporis velit dicta non asperiores vel nobis.', 'Rerum labore atque velit libero beatae et. Omnis excepturi consectetur autem debitis facere. Possimus rerum nihil quis velit amet qui.', 'Voluptatem sit perferendis qui quia itaque id. Magni error occaecati et similique reprehenderit quis. Aut distinctio sint rerum aut incidunt praesentium.'),
(41, 'Vidal Wolf', 'home', 0, '30 min', 0.00, 5, '292.858.3068 x210', '1781 Mathew Fort Apt. 983\nNew Opal, DE 11230', '37.444705', '16.007641', '1', '1', 'https://lorempixel.com/640/480/?58376', 'Aspernatur ad maiores autem porro officia repellendus inventore. In quisquam dolore deserunt nisi voluptatem harum accusamus.', 'Veritatis quia qui officia exercitationem rem impedit ut. Deserunt rerum non eius in. Voluptatem aut est eligendi sequi ut id. Alias ut sed incidunt.', 'Quia est rerum in incidunt dolorem voluptas. Cumque itaque aliquam maiores laboriosam. Voluptatem nostrum eum odio officiis neque incidunt. Est qui nam sint voluptatem.'),
(42, 'Beth Mitchell', 'home', 0, '30 min', 0.00, 5, '268-275-8069 x688', '6453 Zulauf Hills Apt. 795\nPort Aliya, ME 50246-5504', '21.503974', '151.125346', '1', '1', 'https://lorempixel.com/640/480/?45019', 'Vel distinctio quos necessitatibus amet voluptatibus. Et incidunt eius omnis earum minus. Atque libero debitis modi quod sunt labore assumenda. Possimus est voluptatem beatae porro quis itaque.', 'Ut vel qui aperiam ab qui et eos. Alias voluptatem voluptas eum similique explicabo nostrum. Et autem amet quia quia dignissimos.', 'Quo ducimus dicta possimus tempora. Odio consectetur assumenda temporibus dolorem harum. Sunt asperiores accusamus qui voluptate cum aut. Minima eius et nulla velit dignissimos.'),
(43, 'Terrell Robel', 'home', 0, '30 min', 0.00, 5, '337-853-1284', '13238 Reva Lodge Apt. 768\nPort Shanel, KY 50965-3367', '53.701747', '165.618002', '1', '1', 'https://lorempixel.com/640/480/?29785', 'Non iusto non ea et. Aperiam ut perspiciatis dolore. Eos consectetur minima nulla ut hic necessitatibus facilis. Odio quo qui sit nihil.', 'Doloremque ipsam consequatur ipsum explicabo qui aut qui sit. Distinctio officiis doloremque velit veritatis nobis voluptatum vel. Saepe quod et dolore nemo perferendis ratione qui.', 'Assumenda temporibus quae hic. Doloribus consequatur sit ut qui. Magnam deleniti sunt voluptatem consequatur. Tempora optio vel modi deserunt cupiditate.'),
(44, 'Teresa Reilly Jr.', 'home', 0, '30 min', 0.00, 5, '330.939.3366', '186 Alessandra Centers Apt. 208\nNorth Jacquesshire, CA 25579', '83.388293', '11.505583', '1', '1', 'https://lorempixel.com/640/480/?83702', 'Dignissimos debitis ut perferendis ut ut in. Quia modi et aliquid quo. Sequi vitae corporis rerum dignissimos et blanditiis eos adipisci.', 'Numquam neque velit doloremque recusandae in. Distinctio earum eos ut necessitatibus voluptas. Qui eos iure optio maiores et ea.', 'Excepturi fuga voluptatem rerum et dicta. Qui earum omnis nulla suscipit tempore labore. Amet dolor quisquam ut aliquam et sapiente non. Occaecati dolores quam possimus et.'),
(45, 'Mr. Oswald Rau', 'home', 0, '30 min', 0.00, 5, '815.901.5652', '27660 Rempel Junction Suite 506\nGaylordton, IN 75399', '7.701028', '-52.42336', '1', '1', 'https://lorempixel.com/640/480/?37526', 'Illo et aut esse reprehenderit nihil eos rerum. Delectus ea veritatis repellat delectus porro repellendus. Incidunt et architecto doloremque est sunt a odio.', 'Voluptatem non facere in nobis possimus enim est. Et ullam omnis accusantium facilis porro. Libero nemo inventore qui. Corporis dolorum occaecati nisi deserunt dolores. Labore debitis eveniet quod.', 'Est qui saepe odio mollitia tenetur voluptatem impedit. Sint omnis dolores adipisci rerum. Beatae voluptates velit dolorem repellendus esse repudiandae.'),
(46, 'Mrs. Oma Batz I', 'home', 0, '30 min', 0.00, 5, '395-835-1716', '5431 Chaya Passage Apt. 784\nNorth Kileyport, CO 08452', '-18.812458', '134.346178', '1', '1', 'https://lorempixel.com/640/480/?11943', 'Recusandae nemo aut et dignissimos reprehenderit asperiores. Possimus veniam voluptatem explicabo debitis aut. Placeat et aut provident est.', 'Non tenetur deserunt cum in voluptas natus eligendi. Nostrum voluptates quos sed quia nobis inventore recusandae. Nisi reprehenderit inventore illum quibusdam nesciunt.', 'Quae id nostrum voluptatibus praesentium veritatis. Qui praesentium sint eos expedita dolorem sed aut. Quo ex omnis laudantium incidunt. Reiciendis nemo voluptatem harum blanditiis.'),
(47, 'Mr. Gaston Heaney MD', 'home', 0, '30 min', 0.00, 5, '1-650-345-2606', '68633 Cremin Crescent Suite 487\nTinaland, WA 53969-0611', '-47.27464', '-179.871536', '1', '1', 'https://lorempixel.com/640/480/?48867', 'Unde rem autem ab dolorum consequatur. Ipsam velit accusantium non distinctio unde. Omnis quasi fugiat dolor non id voluptas voluptas. Similique aut repudiandae asperiores quia tempore.', 'Accusamus eius voluptas et. Dolores suscipit veniam corporis dolorum velit tempore. Sint illo dolores molestias illum facilis non libero. Pariatur nesciunt consectetur eum voluptas hic.', 'Assumenda odit occaecati dolores sed. Est ut ea est quos ut veniam. Consequatur non voluptatem illum nulla et impedit inventore.'),
(48, 'Jacquelyn Lowe Jr.', 'home', 0, '30 min', 0.00, 5, '(879) 909-7955', '457 Nannie Ways\nGleichnerland, AK 97885-1246', '87.983357', '112.039474', '1', '1', 'https://lorempixel.com/640/480/?85564', 'Enim aut autem inventore maxime quae placeat quod. Sit iste suscipit corporis error. Et reprehenderit qui doloribus non dolore doloremque necessitatibus.', 'Ab perspiciatis in officiis nesciunt ducimus quos quia. Officia eos rem fugiat dolorum. Voluptatem sapiente magni eligendi unde.', 'Fugit sapiente dolorem accusamus velit excepturi omnis ipsa. Modi distinctio consectetur et esse et. Quia praesentium labore aut. Et consequuntur recusandae amet eos voluptates explicabo.'),
(49, 'Gennaro Simonis', 'home', 0, '30 min', 0.00, 5, '819.728.4201 x9350', '2578 Schimmel Key\nLake Kaylinton, PA 23813-2778', '85.44408', '-125.446842', '1', '1', 'https://lorempixel.com/640/480/?72072', 'Corporis est minus harum ducimus dignissimos exercitationem aperiam. Tempora dolorem eum officiis eum officia. Atque dolorum soluta quidem. Ipsa vitae ut quam est eos.', 'Quod nemo fugiat dignissimos aspernatur velit. Fugiat dolor labore voluptatem quasi culpa nihil.', 'Laborum et officia est maxime sed. Architecto perspiciatis nam distinctio sunt dolorem. Maiores consectetur id veniam ut ex vero.'),
(50, 'Jerald Huel', 'home', 0, '30 min', 0.00, 5, '468-299-2976 x48605', '1855 Michelle Creek Apt. 431\nSchmidtmouth, NJ 14995', '60.76037', '-13.893405', '1', '1', 'https://lorempixel.com/640/480/?98936', 'Debitis molestiae est repellendus officia ullam aut. Nesciunt saepe dolorem vel sapiente quo nisi quia vitae. Qui iusto voluptatem est magnam iusto nobis nulla. Saepe libero sed autem sed.', 'Nihil et autem ex in dolores dolores. Voluptates iste dolorum soluta alias est ullam repellat et. Voluptatem velit excepturi et sequi qui.', 'Optio qui qui ipsam deleniti architecto. Est laborum quis cum voluptatem est. Natus eos repudiandae iste. Laudantium sed voluptatum perferendis amet nesciunt sit eveniet.'),
(51, 'Prof. Nicola Bins', 'home', 0, '30 min', 0.00, 5, '1-626-885-8682 x5472', '15807 William Crossing\nPort Andreannehaven, NJ 51851-8801', '47.726389', '160.223438', '1', '1', 'https://lorempixel.com/640/480/?49728', 'Ab animi delectus aliquam aliquam asperiores quia iusto. Molestiae et eos neque aliquam vel quidem sed. Sequi et est sint odit quia totam. Soluta corporis sint vel quod nisi id dolorum sapiente.', 'Aspernatur explicabo aut officia ex. Praesentium maxime voluptas libero est. Sint et quaerat mollitia facere sequi voluptatem porro maxime. Omnis et qui ea reprehenderit.', 'Maxime quae qui qui. Exercitationem aut voluptatum quia quae aut nisi. Dolorem eum vel sint dignissimos. Voluptate optio non voluptatibus rerum maiores aut dolorem.'),
(52, 'Darron Crona', 'home', 0, '30 min', 0.00, 5, '+1-834-546-3914', '756 Enrico Ways Suite 546\nNorth Simeon, WV 83488-0976', '-16.326381', '-74.982418', '1', '1', 'https://lorempixel.com/640/480/?45388', 'Non tenetur tempora quis et animi corrupti sed. Quis alias sed asperiores corporis enim ut. Ut dolores qui sunt est.', 'Est rerum corrupti numquam. Minus non impedit velit soluta saepe laboriosam. Magni quia et magnam non. Maxime nisi alias odio.', 'Dolore culpa incidunt unde. Quia eum tempore sint dolores est. Incidunt ut eum rem sequi. Deserunt minus aut exercitationem consequatur aspernatur sed ex.'),
(53, 'Prof. Ayla Ward DVM', 'home', 0, '30 min', 0.00, 5, '643.486.5362 x62160', '9490 Towne Valley Apt. 813\nFramimouth, FL 85234-8818', '84.850845', '-135.830903', '1', '1', 'https://lorempixel.com/640/480/?47137', 'Animi atque blanditiis quia cum consectetur. Et odio ullam animi ut at voluptates voluptas totam. Ullam minus dolor quia fugiat impedit illo.', 'Fuga quis ducimus qui provident. Ut quasi voluptatibus saepe doloribus aut quaerat. Blanditiis saepe a similique nesciunt aut natus veniam. Hic quibusdam eaque neque earum at.', 'Harum et omnis quis similique delectus dolores doloremque. Voluptatem corporis nihil inventore molestias reiciendis facere ut et. Et modi nisi eos incidunt dolorem.'),
(54, 'Kirk Goyette', 'home', 0, '30 min', 0.00, 5, '(783) 702-5464', '57874 Wilkinson Square Apt. 233\nEast Annabell, KS 68874', '-26.652184', '65.210493', '1', '1', 'https://lorempixel.com/640/480/?63280', 'Ea qui eligendi voluptatem sed placeat. Qui harum nulla voluptatibus error non. Tempora eligendi perspiciatis ea enim.', 'Temporibus optio sed est iusto est. Illum qui quaerat libero nemo accusamus culpa. Cumque dolores voluptatibus necessitatibus sit vero omnis explicabo laudantium. Et totam error iure est.', 'Aut tempora ea magnam omnis. Iusto iure et esse nisi. Accusantium dolorem rerum incidunt voluptas sapiente mollitia minus ratione. Saepe fuga quis quis autem cupiditate neque iusto.'),
(55, 'Madisyn Brekke', 'home', 0, '30 min', 0.00, 5, '320-853-5124 x745', '698 Nikolaus Tunnel Apt. 586\nThielfurt, IN 00426-8578', '31.432017', '69.296041', '1', '1', 'https://lorempixel.com/640/480/?79180', 'Repellendus ut vel aut rerum modi in quia. Officia unde architecto nostrum alias nulla adipisci atque. Nisi eligendi recusandae distinctio eaque debitis. Fugit nesciunt vero voluptatem.', 'Officiis recusandae aut a reiciendis ut. Et incidunt dicta sit ipsum. Deserunt sed enim eius deleniti.', 'Debitis libero enim occaecati natus maxime. Quasi in ipsa tempore sint. Et mollitia qui adipisci quasi cum.'),
(56, 'Jeanie Wiza', 'home', 0, '30 min', 0.00, 5, '(348) 997-0973 x179', '2790 Zemlak Green Suite 226\nNorth Sheamouth, NM 46373-3990', '54.340752', '148.472967', '1', '1', 'https://lorempixel.com/640/480/?71291', 'Voluptas aut ipsam architecto ratione inventore. Natus ducimus labore ut odit. Voluptatem quis dolorem illo. Quia impedit corporis quibusdam quis.', 'Cumque totam rerum accusantium perferendis dolores et reiciendis. Et sint sed sunt deleniti. Excepturi accusamus et quia ipsa non adipisci.', 'Et commodi consequuntur deserunt voluptatem sunt libero. Et molestias eligendi cum reiciendis dignissimos rerum. Rerum dicta aut distinctio vel consectetur quidem labore.'),
(57, 'Kenyon Bergstrom', 'home', 0, '30 min', 0.00, 5, '1-240-864-1294', '3952 Marlon Path\nRippintown, TN 77577-7566', '82.648561', '-114.762943', '1', '1', 'https://lorempixel.com/640/480/?33535', 'Officiis et quia occaecati tenetur et inventore repellendus. Sit delectus aut est ut. Impedit eligendi adipisci consectetur ut et alias et.', 'Veniam deleniti aut ullam pariatur id commodi. Expedita porro porro explicabo doloremque sunt. Sed placeat aut est.', 'Sunt ut rerum ut hic eos sed. Commodi dolores veniam earum iusto modi. Impedit nesciunt ab rem. Dolorem deserunt accusamus ipsam debitis incidunt est ut.'),
(58, 'Ms. Bettye Lebsack', 'home', 0, '30 min', 0.00, 5, '243.312.1454 x02973', '215 Jacobi Mall\nSouth Garrystad, DE 07753', '81.681256', '-49.456648', '1', '1', 'https://lorempixel.com/640/480/?85367', 'Pariatur voluptates quasi deserunt molestiae architecto sapiente aspernatur. Quibusdam consequatur aut sint qui aut. Eveniet aut dolor reiciendis nihil reprehenderit reprehenderit.', 'Qui totam natus occaecati sapiente. Atque placeat delectus est tempore atque error ex.', 'Quisquam omnis eum ut qui quo ut veritatis ab. Dolorem asperiores possimus velit corrupti quos aut velit.'),
(59, 'Vance Ruecker Jr.', 'home', 0, '30 min', 0.00, 5, '+12768775355', '87313 Providenci Islands Apt. 825\nNorth Alexandro, AZ 57591', '-2.07842', '-74.208237', '1', '1', 'https://lorempixel.com/640/480/?62710', 'Consectetur maiores temporibus autem ab in consequuntur blanditiis. Ea et voluptas est et qui error. Velit ipsa ex nihil quia. Odit autem aut voluptas quisquam quia qui.', 'Assumenda voluptas veritatis ab quo corporis quia. Velit eos facere non dolorem. Quo cupiditate iusto aspernatur et quia quo rerum velit. Exercitationem porro qui deserunt provident.', 'Tenetur ea minus nihil et quis. Facilis totam repellat velit corporis facilis nihil. Velit et id non possimus est.'),
(60, 'Dillon Ryan', 'home', 0, '30 min', 0.00, 5, '756.965.1680', '20309 Jocelyn Loop Suite 096\nLake Frances, IA 63007-9437', '-73.145076', '-15.492666', '1', '1', 'https://lorempixel.com/640/480/?88412', 'Excepturi accusantium atque saepe et distinctio ad. Consequatur nihil adipisci sed eum. Hic sequi quae et sit fuga.', 'Laboriosam et fugiat necessitatibus quos quia incidunt in. Eum soluta expedita dolorum corporis. Molestiae iusto tempore nihil qui.', 'Fuga sequi et id rerum architecto culpa itaque. Aut culpa officiis voluptatum pariatur sunt non aut. Molestiae sit quo libero officia.'),
(61, 'Prof. Kaya Altenwerth V', 'home', 0, '30 min', 0.00, 5, '985.891.7045', '6879 Satterfield Vista\nNew Herminio, TX 49885', '-18.750856', '-101.822963', '1', '1', 'https://lorempixel.com/640/480/?93740', 'Amet consequatur et eligendi odio impedit iusto. Voluptatem dignissimos eos quo suscipit architecto repellendus ut. Incidunt sit iure necessitatibus et est natus.', 'Quia et consequuntur quaerat a provident molestiae. Suscipit fugiat rem vel sequi ut asperiores modi corporis.', 'Qui in dolore voluptatem id eius omnis qui. Sit voluptas facere eaque unde commodi. Velit et quasi expedita nihil et quibusdam omnis.'),
(62, 'Merle Bins', 'home', 0, '30 min', 0.00, 5, '762.693.7970', '5554 Austyn Fork\nSouth Dewayneton, VA 00755', '-65.83693', '174.950342', '1', '1', 'https://lorempixel.com/640/480/?52222', 'Et sit aperiam architecto aut corrupti aut. Eligendi minus omnis facere laborum animi facilis. Magni minima sit fugiat ex et tempore.', 'Voluptatem recusandae rerum ipsa ut. Nobis et fugit aut eaque. Autem officia molestiae sapiente blanditiis ea qui quidem eaque.', 'Vero quo qui eius quos neque inventore maxime. Dolor sit velit ab nisi adipisci architecto. Aut sit est perferendis expedita expedita eum veritatis. Asperiores odio consectetur omnis et.'),
(63, 'Libbie Heaney DVM', 'home', 0, '30 min', 0.00, 5, '492-214-5580', '26207 Marks Crescent Apt. 001\nKulastown, NH 39483', '51.886994', '-22.926551', '1', '1', 'https://lorempixel.com/640/480/?40788', 'Sed dolorem voluptates repellendus incidunt eos iusto provident. Dolores excepturi sed adipisci optio veniam. Dolorem perferendis fuga earum omnis fuga ad maiores.', 'Voluptatum ad pariatur quia quibusdam. Qui repellat fugiat et eius ea modi. Quasi optio dolore sit id veniam repudiandae. Blanditiis alias reprehenderit nisi saepe fuga temporibus.', 'Dolorum autem itaque sed eum veritatis vel provident. Quae voluptatibus aliquid ad quae natus. Culpa facilis enim sit et rerum. Voluptatem quaerat consectetur ipsam doloribus autem et.'),
(64, 'Anderson Turcotte', 'home', 0, '30 min', 0.00, 5, '475-787-4134', '813 Brianne Trafficway\nSouth Gilbertoberg, UT 00831', '-39.446488', '124.882102', '1', '1', 'https://lorempixel.com/640/480/?79579', 'Aut eveniet perferendis incidunt animi excepturi. Vero voluptate quisquam veniam. Aut veniam voluptate non ut incidunt. Libero laudantium accusamus repellendus et.', 'Itaque et eos sunt quaerat. Et est quis explicabo amet veritatis delectus. Dolorem veritatis doloremque in itaque aperiam voluptatum. Iusto quasi exercitationem porro magni voluptate nam est.', 'Modi ad aut quas. Labore necessitatibus aliquid alias autem. Ea maxime laudantium quis minima. Velit dicta consequatur fuga occaecati saepe aliquam.'),
(65, 'Cordelia Ritchie', 'home', 0, '30 min', 0.00, 5, '803.915.3205', '70302 Larkin Rapids Apt. 457\nEmmerichfort, ND 95456', '38.582297', '-65.011441', '1', '1', 'https://lorempixel.com/640/480/?54850', 'Est optio qui at consequatur. Dolor rerum quia ducimus et. Tempora quasi officiis non enim ipsa. Dolor consectetur aut et similique voluptate. Ad ducimus fugit illo.', 'Reiciendis tempore aut optio perspiciatis nihil id. Qui ipsum vel accusamus libero voluptatem. Fuga neque aut animi quia rem.', 'Repellendus natus sed commodi odio eum repudiandae ex. Sequi vitae molestiae animi. Recusandae officiis quasi architecto hic ullam.'),
(66, 'Ms. Tania Tillman', 'home', 0, '30 min', 0.00, 5, '429-510-1786 x95430', '80156 Roberts Lake Suite 234\nPort Tyrique, NJ 97546-4318', '49.251895', '-119.285612', '1', '1', 'https://lorempixel.com/640/480/?61620', 'Sit et voluptas recusandae amet nemo nihil vero. Eum facilis sapiente voluptatem voluptate sint. Repellendus vel esse eius illum iste quaerat.', 'Accusantium et itaque rerum ipsa in omnis. Ut quod quae ut impedit sed. Tempore accusamus placeat dolore.', 'Temporibus est ipsum et quo placeat nemo impedit. Fuga rerum nihil vel adipisci.'),
(67, 'Bennett Kassulke', 'home', 0, '30 min', 0.00, 5, '847.943.1574', '7497 Werner Street\nPort Griffin, WV 03029', '60.129636', '3.684058', '1', '1', 'https://lorempixel.com/640/480/?92014', 'Quis quisquam non enim ipsa aperiam. Atque rerum architecto rem sequi omnis. Minus aliquam quaerat dolor hic aut ut. Animi omnis voluptatem nihil provident.', 'Beatae incidunt quos necessitatibus sint dicta voluptatibus doloribus. Vel sed tempore iusto in labore voluptates modi. Eos dignissimos repellat minus. Est itaque aliquid dolor saepe et.', 'Ut quaerat aut non rerum vitae repellat adipisci. Sint numquam est non eveniet. Voluptatum fugiat amet omnis rem deleniti neque. Similique aut qui amet corporis sint.'),
(68, 'Gerard Reinger I', 'home', 0, '30 min', 0.00, 5, '+1 (497) 978-6223', '3864 Selmer Trace\nNew Irvingfurt, DE 61069-6382', '57.295578', '-51.884211', '1', '1', 'https://lorempixel.com/640/480/?94509', 'Qui natus quos ut. Asperiores voluptas dignissimos vel ea voluptatum impedit quia. Voluptatem enim autem voluptas ratione.', 'Corporis et enim officia quo nostrum perspiciatis nihil eos. Eum totam facere quisquam ut rerum. Ut illum nihil non esse. Ea non aperiam velit repellendus fugiat officia.', 'Est non odit sit tenetur. Iste sed molestias harum dolores beatae soluta. Voluptatibus rerum maxime magnam eum recusandae error. Nesciunt dolorum sapiente rerum error cupiditate.'),
(69, 'Thomas Denesik', 'home', 0, '30 min', 0.00, 5, '(781) 209-8257 x148', '9864 Sauer Square\nNorth Luciano, PA 47324', '-59.417721', '121.2856', '1', '1', 'https://lorempixel.com/640/480/?29848', 'Natus vel nemo sed beatae aut. Id possimus perspiciatis modi odio quia autem. Impedit quidem molestiae molestiae at repellat deleniti.', 'Nemo quod quia expedita occaecati et. Incidunt sequi repudiandae inventore sed explicabo omnis voluptatum. Eligendi sit eos doloribus.', 'Magnam labore incidunt dicta corporis expedita autem. Nisi aut aliquid molestiae iusto sunt et enim. Aliquam sed magnam asperiores quaerat aspernatur qui.'),
(70, 'Abdul Monahan', 'home', 0, '30 min', 0.00, 5, '(310) 757-6022 x24024', '3028 Hane Center Suite 857\nNorth Dedric, OK 86105', '68.836725', '-41.12349', '1', '1', 'https://lorempixel.com/640/480/?29375', 'Sint aut dolor id et et. Quidem veritatis pariatur dignissimos praesentium. Quisquam aut veniam magni reprehenderit ea et nulla.', 'Consequatur at consequatur ea molestias consectetur. Recusandae minima ratione eligendi ad.', 'Sit velit iste veritatis nihil saepe. Voluptates non aperiam corporis nemo deleniti. Ipsum quia minus dignissimos rem dicta aspernatur.'),
(71, 'Douglas Streich', 'home', 0, '30 min', 0.00, 5, '357-700-5012', '486 Etha Divide Suite 028\nNew Austen, IN 62809-8992', '54.783506', '-43.7598', '1', '1', 'https://lorempixel.com/640/480/?87352', 'Et blanditiis quia animi. Sed aut nisi aut minima. Ut vel ut aut quia cupiditate ipsum ut dolore.', 'Facilis quis asperiores quasi ex. Quae dignissimos vero eius dicta sint vero. Vel pariatur natus facilis eum. In incidunt nisi quo asperiores et distinctio rerum. Aut veritatis autem numquam animi.', 'Ut quia qui iste quia. Sunt et qui nostrum veritatis.'),
(72, 'Jerel Cassin', 'home', 0, '30 min', 0.00, 5, '762-686-7526 x773', '19692 Marie Centers Suite 578\nPort Mariam, UT 97637', '-50.492446', '151.284987', '1', '1', 'https://lorempixel.com/640/480/?47942', 'Possimus aperiam commodi voluptatem nostrum illo qui. Distinctio ratione omnis ducimus qui ut. Expedita nobis nobis eligendi error. Officiis iusto officiis deleniti ipsam vel.', 'Dolores est dolores et commodi dicta. Vero corrupti enim libero ut. Culpa placeat nisi in. Cupiditate in rerum molestiae corrupti ea ut aut.', 'Sit vitae ipsam hic voluptas. Eius illum vel in ut. Corrupti sed aspernatur necessitatibus id minima praesentium soluta.'),
(73, 'Dr. Daphnee Dicki III', 'home', 0, '30 min', 0.00, 5, '294-814-9320 x73745', '105 Sipes Spring\nKeeblerhaven, WV 02259', '22.7194', '87.767172', '1', '1', 'https://lorempixel.com/640/480/?73199', 'Tenetur libero sunt et ea. Quia repudiandae ipsum dolore necessitatibus voluptas molestias optio atque. Repellendus dolores natus exercitationem accusantium hic dolores. Et hic eum illum labore.', 'Omnis at magni officiis voluptatem sint. Tempora sit quis atque porro enim pariatur. Aliquam debitis dicta doloremque non exercitationem. Optio nobis provident et dolore.', 'Ratione eius ipsam repellat dolorem maiores molestiae. Dolores excepturi sint repudiandae cupiditate debitis. Voluptatibus ut facilis numquam qui sed dolorum.'),
(74, 'Hillary Mante II', 'home', 0, '30 min', 0.00, 5, '(371) 732-5641', '70520 Gibson Meadow Suite 428\nKreigerburgh, WY 85714', '-47.921413', '88.983446', '1', '1', 'https://lorempixel.com/640/480/?17618', 'Quia praesentium sed et dolor quisquam. Nisi reprehenderit velit minima non voluptatem. Quidem saepe quos et eum exercitationem laborum doloremque.', 'Et eius maiores sit nihil id perspiciatis laudantium. Cum harum quibusdam libero quas voluptatibus earum eos. Corporis rerum tempore aliquam ut quo repudiandae optio natus.', 'Quas adipisci at et et rem numquam ut corporis. Esse animi ratione sint ut eius vel consequatur. Doloremque non aspernatur qui et aperiam reprehenderit.');
INSERT INTO `shops` (`id`, `name`, `delivery_type`, `delivery_fee`, `delivery_time`, `discount`, `delivery_range`, `mobile`, `address`, `latitude`, `longitude`, `closed_shop`, `available_for_delivery`, `image`, `description`, `information`, `options`) VALUES
(75, 'Dr. Green DuBuque', 'home', 0, '30 min', 0.00, 5, '+1.306.812.5134', '31731 Julio Cliff Suite 728\nWest Vivian, WI 24773-9390', '-23.633932', '120.405681', '1', '1', 'https://lorempixel.com/640/480/?46986', 'Deleniti dolores non aut nihil. Accusantium perspiciatis nemo sequi. Adipisci unde error ex cum qui omnis.', 'Sit ipsa magni voluptatem architecto explicabo sed. Et blanditiis inventore enim aspernatur. Blanditiis qui ipsam laborum eos.', 'Eos corporis esse reprehenderit et quis aspernatur quia. Aut eaque sunt nisi numquam dolorem voluptatem. Quas alias nam at delectus vitae et.'),
(76, 'Dr. Lavon O\'Reilly I', 'home', 0, '30 min', 0.00, 5, '(262) 939-1846', '2052 Gulgowski Trail\nLake Marcoshire, IA 55530-0715', '-18.332214', '-59.369635', '1', '1', 'https://lorempixel.com/640/480/?95665', 'Autem sint voluptas non voluptatem ut consequatur in illum. Corrupti at dolorem pariatur provident tempore voluptatem. Temporibus ut sit occaecati aliquid quidem.', 'Unde blanditiis consequatur vel voluptas cumque dolore. Minima quia et itaque autem at voluptate porro. Facilis et aut in architecto harum quia cum et. Corporis inventore facere impedit mollitia.', 'Nisi officia nam hic aut eum ducimus sunt. Molestias veniam suscipit provident quia consequatur.'),
(77, 'Randy Hayes', 'home', 0, '30 min', 0.00, 5, '+1-259-924-8523', '5594 Natalie Route Apt. 598\nEast Ernestine, ID 54967', '-70.229747', '-128.947148', '1', '1', 'https://lorempixel.com/640/480/?90419', 'Ea nam mollitia eum accusamus blanditiis. Magni et quas et hic. Eum adipisci suscipit id est saepe et. Veritatis voluptatum quae corrupti blanditiis ratione voluptatum.', 'Quod labore quam maxime optio illum debitis. Dolor consequatur voluptas expedita sapiente rem incidunt. Sunt vitae voluptate et voluptas nam. Deleniti repellat aut quo veniam sed ut.', 'Quas voluptatem odit doloribus placeat unde et cum. Vitae aliquam aliquam similique magnam. Magni incidunt corrupti accusamus.'),
(78, 'Jamaal Grady I', 'home', 0, '30 min', 0.00, 5, '446-826-7195', '24609 Therese Freeway Suite 870\nTristinport, DC 54833', '78.146783', '41.671327', '1', '1', 'https://lorempixel.com/640/480/?65922', 'Id autem mollitia est illo et quidem et. Tenetur id reprehenderit dolore recusandae. Iste magni voluptates voluptas deserunt. Magnam molestias debitis fugiat unde. Dicta veniam qui totam itaque.', 'Qui vero est quidem laborum. Pariatur consequuntur harum sit labore aut. Aut rerum a quae dolorem iure rerum. Quia eum nobis quos quisquam quia odit quibusdam.', 'Consequatur commodi consequatur nulla consequuntur. Nihil et illum nulla. Architecto quia quia aspernatur dolor. Est velit beatae laudantium quia expedita et.'),
(79, 'Justine Harris', 'home', 0, '30 min', 0.00, 5, '930.945.5383', '53787 Hirthe Plaza\nFarrelltown, MD 11946-2709', '-35.522477', '-112.800353', '1', '1', 'https://lorempixel.com/640/480/?43883', 'Et voluptatem illum excepturi porro in ea. Rem nihil excepturi minus et. Totam sed aliquid quia magnam. Praesentium quos ratione est possimus corporis vero aut.', 'Voluptatum aut vero laboriosam nostrum suscipit nulla quo. Quo corporis recusandae eius ratione enim tempora consequuntur. Itaque velit quasi doloremque ut.', 'Corrupti est quia fuga vitae. Et dolorem sed qui ex doloremque corporis. Asperiores ut quos illum est ab et magni illum. Laborum perferendis occaecati autem.'),
(80, 'Olin Toy', 'home', 0, '30 min', 0.00, 5, '+1.872.281.8026', '92743 Vidal Harbors\nPort Alfonso, ME 80348-4151', '15.068406', '21.991564', '1', '1', 'https://lorempixel.com/640/480/?53429', 'Sunt eius omnis similique. Amet neque possimus sequi molestiae. Sapiente sit quia aperiam. Tempore consequatur magni velit modi veniam.', 'Excepturi est inventore saepe ipsum. Error iste at mollitia. Voluptas eum quam quisquam aut explicabo. Tempore tenetur qui et maxime cupiditate.', 'Corporis eos nesciunt quod est illo similique. Molestias dolorum impedit similique aspernatur omnis. Rem culpa fuga neque tempora. Atque eum molestiae nisi at mollitia non voluptas.'),
(81, 'Harrison Predovic', 'home', 0, '30 min', 0.00, 5, '479.567.5542 x7955', '89462 Dickinson Stream Suite 531\nReichelside, NC 87070-1126', '73.248282', '147.850801', '1', '1', 'https://lorempixel.com/640/480/?98920', 'Odit rerum possimus ut rerum et et quia. Unde rerum voluptatem assumenda deleniti. Praesentium aut commodi modi dignissimos et. Qui reprehenderit omnis labore explicabo ea.', 'Voluptatem quod vel optio. Non eum quia ullam qui velit impedit. Veritatis delectus voluptatum pariatur placeat.', 'Eum eaque id ducimus dolorem ullam. Ea quam aut tenetur quasi debitis.'),
(82, 'Dominique Vandervort I', 'home', 0, '30 min', 0.00, 5, '1-294-782-4935 x8170', '901 Kyra Spurs Apt. 799\nChristachester, TX 28365', '-72.230604', '169.142267', '1', '1', 'https://lorempixel.com/640/480/?84630', 'Cumque in earum et qui. Nemo sed voluptatibus accusamus suscipit labore. Voluptas dolorem ut aut consequatur exercitationem.', 'Incidunt sapiente qui numquam voluptas sint eos. In alias aut consequatur repudiandae accusamus sed. Quisquam vitae accusantium dolore excepturi similique. Delectus est sit sequi eveniet et facilis.', 'Ut ut dolorem cumque explicabo. Nam cupiditate ut non adipisci et perspiciatis. Sunt ut quam assumenda sit.'),
(83, 'Ms. Hertha Walsh MD', 'home', 0, '30 min', 0.00, 5, '834-409-9713 x537', '2501 O\'Connell Views Suite 959\nSouth Carlottashire, NY 34689-3619', '-10.472853', '-145.679524', '1', '1', 'https://lorempixel.com/640/480/?59981', 'Dignissimos in rerum quae. Dolor quasi et itaque sit sed praesentium. Rerum impedit explicabo aut et. Consequatur sed quia sequi aut et qui.', 'Voluptates ut officia quo aliquam consequatur error. Consequatur laboriosam libero autem dolore. Et qui quibusdam ut non eius perspiciatis alias. Laborum laborum voluptate adipisci non.', 'Expedita vel soluta voluptas culpa ullam saepe. Distinctio qui provident deserunt asperiores odio quod quasi. Qui asperiores rerum necessitatibus minima recusandae consequatur voluptatum.'),
(84, 'Camilla Connelly', 'home', 0, '30 min', 0.00, 5, '(395) 950-4307 x9501', '250 Wayne Shoal\nShanahanfurt, IN 43459', '54.988785', '150.388749', '1', '1', 'https://lorempixel.com/640/480/?70264', 'Mollitia facere et corrupti nostrum et. Harum ratione animi sapiente quis. Sit nesciunt id magni quo saepe et occaecati. Doloremque temporibus voluptatem repellat iste soluta quia.', 'Qui aut dolor assumenda vero. Esse architecto doloribus voluptatibus id consequuntur et culpa. Placeat vitae nisi doloremque odit quaerat cumque distinctio mollitia. At dolor itaque quasi ut aut quo.', 'Ea quisquam labore totam consectetur maxime molestias laborum. Facere totam cupiditate omnis debitis aut. Vel eligendi beatae perspiciatis provident sed.'),
(85, 'Arvid Fritsch', 'home', 0, '30 min', 0.00, 5, '247-701-7992', '5952 White Stravenue Apt. 715\nLabadiechester, OR 13776-5130', '-62.909814', '23.55539', '1', '1', 'https://lorempixel.com/640/480/?93465', 'Aliquam a et molestiae veritatis. Aspernatur molestiae reiciendis officiis occaecati et. Doloremque ut saepe voluptates eum sit consequatur. Voluptas assumenda quam rerum ut dolor.', 'Ipsa dolor est adipisci tenetur alias sequi est. Quam culpa pariatur ad corrupti. Consequuntur debitis qui et.', 'Reprehenderit ut magnam qui et doloremque pariatur est. Ut eaque deleniti debitis voluptatibus id quo. Laborum totam adipisci ipsam placeat et et dicta. Facere facilis esse accusamus.'),
(86, 'Arvel Nader V', 'home', 0, '30 min', 0.00, 5, '(936) 415-8345 x26909', '376 Wilkinson Forge Apt. 856\nEast Delilahbury, AR 18109-4537', '54.181581', '178.038114', '1', '1', 'https://lorempixel.com/640/480/?76555', 'Ullam inventore omnis fugit alias labore pariatur velit velit. Soluta ducimus aperiam deleniti sequi quod consequatur. At aut libero omnis et assumenda perferendis.', 'Aut ut in possimus dicta. Assumenda et ab vel totam iusto necessitatibus. Aut aut voluptatem possimus.', 'Quaerat at maiores sit labore. Sed sint eius dolores quos molestiae officia aut. Vitae blanditiis ab quis possimus ipsa. Quia non est totam corporis.'),
(87, 'Dr. Gerald Lehner DDS', 'home', 0, '30 min', 0.00, 5, '219.291.6889 x98086', '960 Josianne Prairie Apt. 106\nRahulshire, MO 22586', '-14.446235', '165.629404', '1', '1', 'https://lorempixel.com/640/480/?85257', 'Quis non consequatur quia omnis facilis. Architecto officiis fugit doloribus. A rerum aut qui qui cumque ducimus. Iure quod vel magnam dolores asperiores.', 'Exercitationem enim itaque molestiae. Repellat tempore quae voluptatem voluptas quisquam occaecati aut. Harum cum totam aut et hic aspernatur qui. Rem perferendis et autem debitis sed nemo.', 'Asperiores inventore sunt debitis ipsam repudiandae sunt non. In iusto enim in assumenda accusamus. Voluptatem fuga dolorem aut hic. Eius incidunt ullam quia dolorem odit.'),
(88, 'Woodrow Sporer', 'home', 0, '30 min', 0.00, 5, '331-460-8469 x79811', '18535 Lind Parkway\nWalterberg, KS 95517-9463', '29.349533', '-132.670234', '1', '1', 'https://lorempixel.com/640/480/?42312', 'Minus in omnis tempore quo ut. Et omnis sunt repellat voluptatem sint voluptatem qui unde. Aut assumenda quos ea minus aspernatur. Similique eveniet nostrum explicabo quidem sit consequatur in.', 'Non architecto animi ipsa vel. Sint odit necessitatibus libero iure aut a. Porro et voluptatem at impedit. Ullam sed aliquid sunt ex minus.', 'Necessitatibus sapiente tempore et rerum. Aut temporibus odit molestias est error ut in. Odit soluta voluptatem cupiditate at.'),
(89, 'Kennedi Jacobson', 'home', 0, '30 min', 0.00, 5, '398.331.9091 x801', '4721 Graham Gateway Apt. 041\nAaliyahshire, WY 06349', '77.38505', '88.421881', '1', '1', 'https://lorempixel.com/640/480/?38408', 'Beatae alias exercitationem rerum. Hic non veniam eligendi qui dolores velit tempora. Dicta quae et nobis. Molestiae nesciunt ratione quos vero.', 'Eligendi aspernatur voluptatem officia consequatur eveniet iusto. Eius et et nesciunt aspernatur aut. Porro vel neque sed voluptas.', 'Voluptate fuga illo sunt quasi. Voluptas voluptatem est qui similique. Impedit omnis sint non modi nisi repellat sed voluptas.'),
(90, 'Mr. Hoyt Kassulke', 'home', 0, '30 min', 0.00, 5, '(691) 477-0044 x202', '88430 Wisozk Vista\nSouth Skye, KS 83318-1151', '52.721276', '115.844148', '1', '1', 'https://lorempixel.com/640/480/?20644', 'Excepturi dolorum possimus non et voluptatem sit aut. Occaecati porro vero ab. Quibusdam cupiditate corporis odit. Fugit quos quas provident quos voluptates voluptas inventore.', 'Deleniti quae minus nisi corrupti error quia minus. Dolor quas optio delectus sit repellendus voluptates excepturi sit. Est amet qui accusantium sint dolores est similique.', 'Ea nisi ab libero. Dolorem atque minima quo nesciunt enim totam. Alias voluptas expedita assumenda fugiat tenetur impedit dolorum. Sed corrupti id soluta molestiae voluptas velit vero.'),
(91, 'Dejon Homenick', 'home', 0, '30 min', 0.00, 5, '782.310.7054', '67644 Rachel Springs Apt. 760\nLake Sheridanshire, NJ 76078-7702', '12.192092', '-117.199245', '1', '1', 'https://lorempixel.com/640/480/?38955', 'Corrupti est et sint maiores et. Distinctio sed et qui commodi modi. Et qui expedita id occaecati quisquam ut quis.', 'Quo vero neque neque doloribus suscipit sit nam. Dolore minus rem nulla voluptas qui aut id. Dignissimos est fugit veniam quisquam consequatur sunt.', 'Ducimus et voluptas odio ea. Maxime ea aut placeat consequatur ex omnis. Aut cumque dolorem molestias provident sunt.'),
(92, 'Monroe Gottlieb', 'home', 0, '30 min', 0.00, 5, '463.640.3289 x2432', '93286 Gutkowski Isle Suite 155\nMonroechester, NE 05472', '57.192548', '-144.432886', '1', '1', 'https://lorempixel.com/640/480/?54656', 'Placeat soluta dolorem consectetur soluta vitae. Nisi sint in doloremque deleniti. Et veritatis vel ut enim illo. Odit iusto cumque odit laudantium ut placeat sit.', 'Impedit quod consequuntur ut praesentium. Eos accusantium autem repudiandae qui. Voluptas dicta consectetur veritatis beatae sint omnis et libero.', 'Nihil corporis nam deleniti saepe. Consequuntur in sed beatae praesentium nihil dolorem. Voluptates aut sapiente illo qui aut eum. Adipisci adipisci nihil et et autem.'),
(93, 'Oma Kemmer', 'home', 0, '30 min', 0.00, 5, '1-289-616-8251 x66435', '68911 DuBuque Circle Suite 654\nNew Everthaven, MD 06697', '-64.532378', '-161.959141', '1', '1', 'https://lorempixel.com/640/480/?80225', 'Laudantium aspernatur sint perspiciatis a hic cum in et. Harum ut odit maxime sit voluptas. Et autem repellat eum at corporis.', 'Velit quis at consequuntur at. Autem ut vitae ipsum debitis. Voluptatem autem delectus aliquam quaerat sunt nostrum sed.', 'Sunt voluptatem rerum aut deleniti nobis. Accusantium unde voluptas et cum facilis fugit. Beatae vitae iure cumque in.'),
(94, 'Christiana Hintz', 'home', 0, '30 min', 0.00, 5, '246-457-0357', '59380 Smitham Mountain\nProsaccoburgh, AZ 81646-5381', '-60.076755', '-132.019508', '1', '1', 'https://lorempixel.com/640/480/?35916', 'Soluta voluptatem nihil vel dolorum minima earum omnis. Odio eos eveniet beatae non delectus consectetur.', 'Molestias vero earum et. Amet ex voluptatibus enim praesentium voluptatum laboriosam sit libero. Et laboriosam tenetur et quo.', 'Et sit illo et. Est amet accusantium esse qui pariatur rem. Quia assumenda voluptate corrupti molestias animi voluptatem et voluptas.'),
(95, 'Mr. Werner Wilderman', 'home', 0, '30 min', 0.00, 5, '1-218-851-0675 x3551', '9963 Arnoldo Estate Apt. 846\nWest Elsa, CO 52057', '-20.311169', '-108.383213', '1', '1', 'https://lorempixel.com/640/480/?95305', 'Pariatur doloremque libero explicabo. Aut molestias quia laborum repellat rerum.', 'Aut porro eaque et quia asperiores animi. Quos dicta voluptate asperiores fuga maxime. Et eum natus voluptas illum consequatur.', 'Voluptatum id unde voluptatem in esse quod. Ut voluptatem quis sequi qui. Ea pariatur error corrupti aut rerum minima. Sit labore ab optio.'),
(96, 'Rene Hermiston', 'home', 0, '30 min', 0.00, 5, '+17764133750', '2899 Devante Ports Apt. 211\nSouth Tressie, PA 59841', '-3.148059', '-35.937594', '1', '1', 'https://lorempixel.com/640/480/?75693', 'Similique sit dolor qui minima. Sed odit quisquam perspiciatis accusamus. Veniam praesentium expedita ut vel voluptatem numquam.', 'Vero quo quae commodi et est non quis. Ut totam porro maxime minima. Velit quod rerum est doloribus deserunt. Fugit eius non et ea reprehenderit ullam.', 'Reiciendis quibusdam error rem dolores quis quia ut. Repellendus recusandae sint illo vel voluptatem.'),
(97, 'Jackeline Ritchie MD', 'home', 0, '30 min', 0.00, 5, '1-740-581-6837', '3919 Hayes Mews\nEdwardmouth, NE 26482', '-44.627994', '98.409149', '1', '1', 'https://lorempixel.com/640/480/?80806', 'Et rem suscipit vel nulla sit possimus fugiat. Ducimus modi quibusdam aliquam ex quam veniam eum magni. Neque at nisi consequatur libero quae.', 'Magnam unde animi autem magni mollitia voluptate. Quidem inventore qui voluptatum consequatur. Et repellat similique ut consectetur optio et. Sit sit nihil id. Nihil omnis ipsam unde a.', 'Optio incidunt quo quisquam temporibus sit sed veniam. Dolore autem corporis vel nihil.'),
(98, 'Dr. Jena Lehner Sr.', 'home', 0, '30 min', 0.00, 5, '991-549-7372 x50429', '7354 Glover Extensions Apt. 350\nEast Noble, MA 59986-1451', '64.75658', '167.649305', '1', '1', 'https://lorempixel.com/640/480/?86587', 'Eum aspernatur est voluptate consequatur. Excepturi est sapiente quibusdam ut sed qui. Deleniti incidunt soluta est minima.', 'A ad soluta minima et est. Aliquam sit repellat aut optio. Dicta minus accusamus omnis quam.', 'Quod et et nisi nemo rerum. Veritatis totam porro non numquam consequatur. Quia ullam maxime qui autem. Quo esse consequatur qui dolore rerum eaque rem consequatur.'),
(99, 'Shakira Johnson I', 'home', 0, '30 min', 0.00, 5, '+1.408.201.3938', '969 Harold Ranch\nWest Rosario, IN 66349-7050', '-57.997936', '-162.4029', '1', '1', 'https://lorempixel.com/640/480/?21276', 'Itaque doloribus beatae aliquid possimus dolore. Dolores quod repudiandae est ab rerum perspiciatis. Et totam eum et et excepturi fugit quae. Sequi omnis rem magni qui iure.', 'Rerum nostrum iste molestiae non optio hic veniam voluptatem. Tempora fugit doloremque necessitatibus rerum repudiandae voluptatem dolores. Et sunt tenetur aut voluptatem et amet.', 'Vel voluptatem rerum quam labore saepe. Placeat quod molestiae dolorem in quia cupiditate excepturi. Modi at saepe asperiores excepturi. Porro pariatur accusamus voluptas quae cum.'),
(100, 'Mona Ratke', 'home', 0, '30 min', 0.00, 5, '(312) 751-4502 x026', '22218 Alayna Mount\nWest Lexus, WV 13415-4927', '58.293502', '53.628404', '1', '1', 'https://lorempixel.com/640/480/?60868', 'Cumque ut repellendus voluptas quo qui libero est ipsum. Assumenda maiores vero in quibusdam. Nihil nisi dicta ipsum eos. Incidunt aliquid qui eos et consequuntur accusantium.', 'Aut pariatur nulla est eaque aut mollitia sit. Dolorum minus dolor non quisquam dignissimos sit. Sit sit minus explicabo beatae rerum omnis magni. Ratione dolor animi eius velit voluptatem.', 'Aliquid voluptatem occaecati dicta rerum inventore quod voluptas. Possimus ut ut vitae aliquid dicta quia.');

-- --------------------------------------------------------

--
-- Table structure for table `shop_items`
--

CREATE TABLE `shop_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_items`
--

INSERT INTO `shop_items` (`id`, `shop_id`, `name`, `price`, `discount`, `image`, `description`, `status`) VALUES
(1, 1, 'asdasd', 121.00, 0.00, '12121.jpg', NULL, 'active'),
(2, 1, 'qqqq', 121.00, 0.00, '12121.jpg', NULL, 'active'),
(3, 1, 'wwww', 121.00, 0.00, '12121.jpg', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `shop_promotions`
--

CREATE TABLE `shop_promotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_promotions`
--

INSERT INTO `shop_promotions` (`id`, `message`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Use DOT10 get 120 taka off.', '12345.jpg', 'active', '2020-11-08 18:00:00', '2020-11-09 11:50:40', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` int(11) NOT NULL,
  `type` enum('customer','restaurant','rider') DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `type`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'rider', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2021-01-03 23:02:44', 1, NULL, NULL),
(2, 'customer', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2021-01-03 23:02:44', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TWILIO`
--

CREATE TABLE `TWILIO` (
  `ID` int(11) NOT NULL,
  `TWILIO_SID` varchar(200) DEFAULT 'ACcb39aaff074dc00575b1c06b002ad56c',
  `TWILIO_AUTH_TOKEN` varchar(200) DEFAULT '25ef128cf8de54e680dc80b1ebd02209',
  `TWILIO_VERIFY_SID` varchar(200) DEFAULT 'VAa5f2c859cc5b12fff39d273385c31f7d'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TWILIO`
--

INSERT INTO `TWILIO` (`ID`, `TWILIO_SID`, `TWILIO_AUTH_TOKEN`, `TWILIO_VERIFY_SID`) VALUES
(1, 'ACcb39aaff074dc00575b1c06b002ad56c', '25ef128cf8de54e680dc80b1ebd02209', 'VAa5f2c859cc5b12fff39d273385c31f7d');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Miss Carmen Brekke', 'admin@dd.com', '2020-11-09 11:50:12', '$2y$10$SKkIbnZUTyrGEnOOHH2s7O.qKL7mw0RL1Nn4DUvcAOsrixmo4ffb.', 'xK895gCpvieWYFzq6VOSkxPXMJ1GanW2sCQLdOkC5PbEzqTee15AH2IWAbX0', '2020-11-09 11:50:12', '2020-11-09 11:50:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_color_settings`
--
ALTER TABLE `app_color_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_color_settings_created_by_foreign` (`created_by`),
  ADD KEY `app_color_settings_updated_by_foreign` (`updated_by`),
  ADD KEY `app_color_settings_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `app_currencies_settings`
--
ALTER TABLE `app_currencies_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_currencies_settings_created_by_foreign` (`created_by`),
  ADD KEY `app_currencies_settings_updated_by_foreign` (`updated_by`),
  ADD KEY `app_currencies_settings_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `app_email_settings`
--
ALTER TABLE `app_email_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_email_settings_created_by_foreign` (`created_by`),
  ADD KEY `app_email_settings_updated_by_foreign` (`updated_by`),
  ADD KEY `app_email_settings_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `app_global_settings`
--
ALTER TABLE `app_global_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_global_settings_created_by_foreign` (`created_by`),
  ADD KEY `app_global_settings_updated_by_foreign` (`updated_by`),
  ADD KEY `app_global_settings_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `app_home_screen_layout_settings`
--
ALTER TABLE `app_home_screen_layout_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_home_screen_layout_settings_created_by_foreign` (`created_by`),
  ADD KEY `app_home_screen_layout_settings_updated_by_foreign` (`updated_by`),
  ADD KEY `app_home_screen_layout_settings_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `app_payment_settings`
--
ALTER TABLE `app_payment_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_payment_settings_currency_id_foreign` (`currency_id`),
  ADD KEY `app_payment_settings_created_by_foreign` (`created_by`),
  ADD KEY `app_payment_settings_updated_by_foreign` (`updated_by`),
  ADD KEY `app_payment_settings_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `app_push_notification_settings`
--
ALTER TABLE `app_push_notification_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_push_notification_settings_created_by_foreign` (`created_by`),
  ADD KEY `app_push_notification_settings_updated_by_foreign` (`updated_by`),
  ADD KEY `app_push_notification_settings_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `app_sms_settings`
--
ALTER TABLE `app_sms_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_sms_settings_created_by_foreign` (`created_by`),
  ADD KEY `app_sms_settings_updated_by_foreign` (`updated_by`),
  ADD KEY `app_sms_settings_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `app_social_authentication_settings`
--
ALTER TABLE `app_social_authentication_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_social_authentication_settings_created_by_foreign` (`created_by`),
  ADD KEY `app_social_authentication_settings_updated_by_foreign` (`updated_by`),
  ADD KEY `app_social_authentication_settings_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_updated_by_foreign` (`updated_by`),
  ADD KEY `categories_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `business_categories`
--
ALTER TABLE `business_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_categories_created_by_foreign` (`created_by`),
  ADD KEY `business_categories_updated_by_foreign` (`updated_by`),
  ADD KEY `business_categories_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_updated_by_foreign` (`updated_by`),
  ADD KEY `categories_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complains_customer_id_foreign` (`customer_id`),
  ADD KEY `complains_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `complains_rider_id_foreign` (`rider_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`),
  ADD KEY `coupons_food_id_foreign` (`food_id`),
  ADD KEY `coupons_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `coupons_category_id_foreign` (`category_id`),
  ADD KEY `coupons_created_by_foreign` (`created_by`),
  ADD KEY `coupons_updated_by_foreign` (`updated_by`),
  ADD KEY `coupons_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuisines_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `cuisines_created_by_foreign` (`created_by`),
  ADD KEY `cuisines_updated_by_foreign` (`updated_by`),
  ADD KEY `cuisines_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_phone_number_unique` (`phone_number`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_address_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `customer_profiles`
--
ALTER TABLE `customer_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_profiles_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveries_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extras_food_id_foreign` (`food_id`),
  ADD KEY `extras_extra_group_id_foreign` (`extra_group_id`),
  ADD KEY `extras_created_by_foreign` (`created_by`),
  ADD KEY `extras_updated_by_foreign` (`updated_by`),
  ADD KEY `extras_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `extra_groups`
--
ALTER TABLE `extra_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extra_groups_created_by_foreign` (`created_by`),
  ADD KEY `extra_groups_updated_by_foreign` (`updated_by`),
  ADD KEY `extra_groups_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_foods`
--
ALTER TABLE `favorite_foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorite_foods_customer_id_foreign` (`customer_id`),
  ADD KEY `favorite_foods_food_id_foreign` (`food_id`);

--
-- Indexes for table `favorite_restaurants`
--
ALTER TABLE `favorite_restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorite_restaurants_customer_id_foreign` (`customer_id`),
  ADD KEY `favorite_restaurants_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foods_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `foods_category_id_foreign` (`category_id`),
  ADD KEY `foods_created_by_foreign` (`created_by`),
  ADD KEY `foods_updated_by_foreign` (`updated_by`),
  ADD KEY `foods_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `food_reviews`
--
ALTER TABLE `food_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_reviews_customer_id_foreign` (`customer_id`),
  ADD KEY `food_reviews_food_id_foreign` (`food_id`);

--
-- Indexes for table `food_variants`
--
ALTER TABLE `food_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_variants_food_id_foreign` (`food_id`);

--
-- Indexes for table `help_and_supports`
--
ALTER TABLE `help_and_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_food_id_foreign` (`food_id`),
  ADD KEY `order_details_food_variant_id_foreign` (`food_variant_id`),
  ADD KEY `order_details_extra_id_foreign` (`extra_id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `points_customer_id_foreign` (`customer_id`),
  ADD KEY `points_order_id_foreign` (`order_id`);

--
-- Indexes for table `promotional_banners`
--
ALTER TABLE `promotional_banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_updated_by_foreign` (`updated_by`),
  ADD KEY `categories_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurants_phone_number_unique` (`phone_number`);

--
-- Indexes for table `restaurant_address`
--
ALTER TABLE `restaurant_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_address_customer_id_foreign` (`restaurant_id`);

--
-- Indexes for table `restaurant_operating_locations`
--
ALTER TABLE `restaurant_operating_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_operating_locations_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `restaurant_profiles`
--
ALTER TABLE `restaurant_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_profiles_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `restaurant_profiles_feature_section_foreign` (`feature_section`);

--
-- Indexes for table `restaurant_reviews`
--
ALTER TABLE `restaurant_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_reviews_customer_id_foreign` (`customer_id`),
  ADD KEY `restaurant_reviews_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `restaurant_settings`
--
ALTER TABLE `restaurant_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_settings_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `riders_phone_number_unique` (`phone_number`);

--
-- Indexes for table `rider_address`
--
ALTER TABLE `rider_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_address_customer_id_foreign` (`rider_id`);

--
-- Indexes for table `rider_orders`
--
ALTER TABLE `rider_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rider_orders_order_id_foreign` (`order_id`),
  ADD KEY `rider_orders_rider_id_foreign` (`rider_id`);

--
-- Indexes for table `rider_profiles`
--
ALTER TABLE `rider_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rider_profiles_rider_id_foreign` (`rider_id`);

--
-- Indexes for table `rider_settings`
--
ALTER TABLE `rider_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rider_settings_rider_id_foreign` (`rider_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_items`
--
ALTER TABLE `shop_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_promotions`
--
ALTER TABLE `shop_promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_updated_by_foreign` (`updated_by`),
  ADD KEY `categories_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TWILIO`
--
ALTER TABLE `TWILIO`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_color_settings`
--
ALTER TABLE `app_color_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_currencies_settings`
--
ALTER TABLE `app_currencies_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_email_settings`
--
ALTER TABLE `app_email_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_global_settings`
--
ALTER TABLE `app_global_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_home_screen_layout_settings`
--
ALTER TABLE `app_home_screen_layout_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `app_payment_settings`
--
ALTER TABLE `app_payment_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_push_notification_settings`
--
ALTER TABLE `app_push_notification_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_sms_settings`
--
ALTER TABLE `app_sms_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_social_authentication_settings`
--
ALTER TABLE `app_social_authentication_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `business_categories`
--
ALTER TABLE `business_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer_profiles`
--
ALTER TABLE `customer_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `extra_groups`
--
ALTER TABLE `extra_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite_foods`
--
ALTER TABLE `favorite_foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `favorite_restaurants`
--
ALTER TABLE `favorite_restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `food_reviews`
--
ALTER TABLE `food_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `food_variants`
--
ALTER TABLE `food_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `help_and_supports`
--
ALTER TABLE `help_and_supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1146;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `promotional_banners`
--
ALTER TABLE `promotional_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `restaurant_address`
--
ALTER TABLE `restaurant_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `restaurant_operating_locations`
--
ALTER TABLE `restaurant_operating_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_profiles`
--
ALTER TABLE `restaurant_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `restaurant_reviews`
--
ALTER TABLE `restaurant_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT for table `restaurant_settings`
--
ALTER TABLE `restaurant_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rider_address`
--
ALTER TABLE `rider_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `rider_orders`
--
ALTER TABLE `rider_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rider_profiles`
--
ALTER TABLE `rider_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rider_settings`
--
ALTER TABLE `rider_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `shop_items`
--
ALTER TABLE `shop_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop_promotions`
--
ALTER TABLE `shop_promotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TWILIO`
--
ALTER TABLE `TWILIO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_color_settings`
--
ALTER TABLE `app_color_settings`
  ADD CONSTRAINT `app_color_settings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_color_settings_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_color_settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_currencies_settings`
--
ALTER TABLE `app_currencies_settings`
  ADD CONSTRAINT `app_currencies_settings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_currencies_settings_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_currencies_settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_email_settings`
--
ALTER TABLE `app_email_settings`
  ADD CONSTRAINT `app_email_settings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_email_settings_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_email_settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_global_settings`
--
ALTER TABLE `app_global_settings`
  ADD CONSTRAINT `app_global_settings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_global_settings_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_global_settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_home_screen_layout_settings`
--
ALTER TABLE `app_home_screen_layout_settings`
  ADD CONSTRAINT `app_home_screen_layout_settings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_home_screen_layout_settings_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_home_screen_layout_settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_payment_settings`
--
ALTER TABLE `app_payment_settings`
  ADD CONSTRAINT `app_payment_settings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_payment_settings_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `app_currencies_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_payment_settings_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_payment_settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_push_notification_settings`
--
ALTER TABLE `app_push_notification_settings`
  ADD CONSTRAINT `app_push_notification_settings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_push_notification_settings_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_push_notification_settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_sms_settings`
--
ALTER TABLE `app_sms_settings`
  ADD CONSTRAINT `app_sms_settings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_sms_settings_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_sms_settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_social_authentication_settings`
--
ALTER TABLE `app_social_authentication_settings`
  ADD CONSTRAINT `app_social_authentication_settings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_social_authentication_settings_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_social_authentication_settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `business_categories`
--
ALTER TABLE `business_categories`
  ADD CONSTRAINT `business_categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_categories_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `complains`
--
ALTER TABLE `complains`
  ADD CONSTRAINT `complains_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complains_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complains_rider_id_foreign` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD CONSTRAINT `cuisines_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cuisines_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cuisines_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cuisines_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_profiles`
--
ALTER TABLE `customer_profiles`
  ADD CONSTRAINT `customer_profiles_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `extras`
--
ALTER TABLE `extras`
  ADD CONSTRAINT `extras_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `extras_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `extras_extra_group_id_foreign` FOREIGN KEY (`extra_group_id`) REFERENCES `extra_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `extras_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `extras_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `extra_groups`
--
ALTER TABLE `extra_groups`
  ADD CONSTRAINT `extra_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `extra_groups_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `extra_groups_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorite_foods`
--
ALTER TABLE `favorite_foods`
  ADD CONSTRAINT `favorite_foods_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorite_foods_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorite_restaurants`
--
ALTER TABLE `favorite_restaurants`
  ADD CONSTRAINT `favorite_restaurants_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorite_restaurants_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foods_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foods_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foods_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foods_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `food_reviews`
--
ALTER TABLE `food_reviews`
  ADD CONSTRAINT `food_reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_reviews_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `food_variants`
--
ALTER TABLE `food_variants`
  ADD CONSTRAINT `food_variants_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_extra_id_foreign` FOREIGN KEY (`extra_id`) REFERENCES `extras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_food_variant_id_foreign` FOREIGN KEY (`food_variant_id`) REFERENCES `food_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `points_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_operating_locations`
--
ALTER TABLE `restaurant_operating_locations`
  ADD CONSTRAINT `restaurant_operating_locations_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_profiles`
--
ALTER TABLE `restaurant_profiles`
  ADD CONSTRAINT `restaurant_profiles_feature_section_foreign` FOREIGN KEY (`feature_section`) REFERENCES `app_home_screen_layout_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurant_profiles_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_reviews`
--
ALTER TABLE `restaurant_reviews`
  ADD CONSTRAINT `restaurant_reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurant_reviews_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_settings`
--
ALTER TABLE `restaurant_settings`
  ADD CONSTRAINT `restaurant_settings_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rider_orders`
--
ALTER TABLE `rider_orders`
  ADD CONSTRAINT `rider_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rider_orders_rider_id_foreign` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rider_profiles`
--
ALTER TABLE `rider_profiles`
  ADD CONSTRAINT `rider_profiles_rider_id_foreign` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rider_settings`
--
ALTER TABLE `rider_settings`
  ADD CONSTRAINT `rider_settings_rider_id_foreign` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
