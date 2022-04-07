-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2022 at 11:34 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `service_adept`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `pincode`, `city_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Greenland', '360001', 1, NULL, NULL, NULL),
(2, 'Madhapar', '360001', 1, NULL, NULL, NULL),
(3, 'Aji Dam', '360001', 1, NULL, NULL, NULL),
(4, 'Sorathiyawadi', '360001', 1, NULL, NULL, NULL),
(5, 'Bopal', '320008', 2, NULL, NULL, NULL),
(6, 'Iskon', '320008', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Rajkot', 'Gujrat', NULL, NULL),
(2, 'Ahmedabad', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentable_id` bigint(20) NOT NULL,
  `documentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document_path`, `documentable_id`, `documentable_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'C:\\xampp\\htdocs\\service-adept\\public\\uploads/1648980409.jpg', 1, 'App\\Models\\Organization', '2022-04-03 04:36:49', '2022-04-03 04:36:49', NULL),
(2, 'C:\\xampp\\htdocs\\service-adept\\public\\uploads/1648980623.jpg', 2, 'App\\Models\\Organization', '2022-04-03 04:40:23', '2022-04-03 04:40:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` bigint(20) NOT NULL,
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_path`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'http://localhost:8000/images/1648669320.jpg', 1, 'App\\Models\\Service', '2022-03-30 14:12:00', '2022-03-30 14:12:00', NULL),
(2, 'http://localhost:8000/images/1648747663.jpg', 49, 'App\\Models\\Service', '2022-03-31 11:57:43', '2022-03-31 14:38:56', '2022-03-31 14:38:56'),
(3, 'http://localhost:8000/images/1648747708.jpg', 50, 'App\\Models\\Service', '2022-03-31 11:58:28', '2022-03-31 14:38:21', '2022-03-31 14:38:21'),
(4, 'http://localhost:8000/images/1648747759.jpg', 51, 'App\\Models\\Service', '2022-03-31 11:59:19', '2022-03-31 14:39:22', '2022-03-31 14:39:22'),
(5, 'http://localhost:8000/images/1648757301.jpg', 50, 'App\\Models\\Service', '2022-03-31 14:38:21', '2022-03-31 14:38:21', NULL),
(6, 'http://localhost:8000/images/1648757336.jpg', 49, 'App\\Models\\Service', '2022-03-31 14:38:56', '2022-03-31 14:38:56', NULL),
(7, 'http://localhost:8000/images/1648757362.png', 51, 'App\\Models\\Service', '2022-03-31 14:39:22', '2022-03-31 14:40:03', '2022-03-31 14:40:03'),
(8, 'http://localhost:8000/images/1648757403.jpg', 51, 'App\\Models\\Service', '2022-03-31 14:40:03', '2022-03-31 14:40:03', NULL),
(9, 'http://127.0.0.1:8000/images/1648833940.jpg', 52, 'App\\Models\\Service', '2022-04-01 11:55:40', '2022-04-01 11:55:40', NULL),
(10, 'http://127.0.0.1:8000/images/1648834819.jpg', 53, 'App\\Models\\Service', '2022-04-01 12:10:19', '2022-04-01 12:10:19', NULL),
(11, 'http://127.0.0.1:8000/images/1648834876.jpg', 54, 'App\\Models\\Service', '2022-04-01 12:11:16', '2022-04-01 12:11:16', NULL),
(12, 'http://127.0.0.1:8000/images/1648834927.jpg', 55, 'App\\Models\\Service', '2022-04-01 12:12:07', '2022-04-01 12:12:07', NULL),
(13, 'http://127.0.0.1:8000/images/1648835029.jpg', 56, 'App\\Models\\Service', '2022-04-01 12:13:49', '2022-04-01 12:13:49', NULL),
(14, 'http://127.0.0.1:8000/images/1648835120.jpg', 57, 'App\\Models\\Service', '2022-04-01 12:15:20', '2022-04-01 12:15:20', NULL),
(15, 'http://127.0.0.1:8000/images/1648835465.jpg', 58, 'App\\Models\\Service', '2022-04-01 12:21:05', '2022-04-01 12:21:05', NULL),
(16, 'http://127.0.0.1:8000/images/1648835509.jpg', 59, 'App\\Models\\Service', '2022-04-01 12:21:49', '2022-04-01 12:21:49', NULL),
(17, 'http://127.0.0.1:8000/images/1648835575.jpg', 60, 'App\\Models\\Service', '2022-04-01 12:22:55', '2022-04-01 12:22:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `due` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` bigint(20) UNSIGNED DEFAULT NULL,
  `amount_paid` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_state_id` int(11) NOT NULL DEFAULT 1 COMMENT '1 => Unpaid, 2 => paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `due`, `user_id`, `service_order_id`, `amount`, `amount_paid`, `description`, `invoice_state_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, NULL, 1, 3, 0, 0, NULL, 2, '2022-04-06 08:34:27', '2022-04-06 08:34:27', NULL),
(5, '2022-04-12 14:20:26', 1, 3, 200, 0, NULL, 2, '2022-04-07 14:20:26', '2022-04-07 15:30:41', NULL),
(6, '2022-04-12 15:36:13', 1, 4, 9012, 0, 'Please Pay Fast', 2, '2022-04-07 15:36:13', '2022-04-07 15:44:04', NULL),
(7, '2022-04-12 15:36:29', 1, 5, 12, 0, 'Please Pay Fast', 2, '2022-04-07 15:36:29', '2022-04-07 15:47:57', NULL),
(8, '2022-04-12 15:36:41', 1, 5, 12, 0, NULL, 2, '2022-04-07 15:36:41', '2022-04-07 15:57:18', NULL),
(9, '2022-04-12 15:37:00', 1, 10, 1000, 0, NULL, 2, '2022-04-07 15:37:00', '2022-04-07 15:58:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_states`
--

CREATE TABLE `invoice_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_states`
--

INSERT INTO `invoice_states` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Unpaid', 'Unpaid Invoice', NULL, NULL),
(2, 'Paid', 'Paid Invoice', NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_23_183454_create_user_states_table', 1),
(6, '2022_03_23_184145_create_areas_table', 1),
(7, '2022_03_23_185001_create_cities_table', 1),
(8, '2022_03_23_185217_create_organizations_table', 1),
(9, '2022_03_23_185227_create_organization_states_table', 1),
(10, '2022_03_23_185934_create_user_organization_memberships_table', 1),
(11, '2022_03_23_190534_create_price_types_table', 1),
(13, '2022_03_23_191551_create_organization_roles_table', 1),
(15, '2022_03_23_192803_create_order_states_table', 1),
(18, '2022_03_24_174746_create_service_categories_table', 1),
(19, '2022_03_25_110806_create_images_table', 1),
(21, '2022_03_23_190714_create_services_table', 2),
(23, '2022_03_31_201622_create_user_service_likes_table', 3),
(26, '2022_03_23_191859_create_user_organization_membership_roles_table', 4),
(29, '2022_03_28_065906_create_service_area_availablities_table', 6),
(30, '2022_03_31_201741_create_user_service_ratings_table', 7),
(32, '2022_03_25_121147_create_documents_table', 8),
(35, '2022_03_23_193042_create_service_orders_table', 10),
(40, '2022_04_04_194059_create_order_member_states_table', 12),
(41, '2022_04_04_180156_create_order_members_table', 13),
(43, '2022_04_05_044349_create_invoice_states_table', 14),
(46, '2022_04_05_045846_create_reasons_table', 15),
(47, '2022_04_03_075621_create_invoices_table', 16),
(48, '2022_04_07_120419_create_organization_payment_information_table', 17),
(49, '2022_04_07_180740_create_organization_payouts_table', 18),
(50, '2022_03_23_193725_create_payments_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `order_members`
--

CREATE TABLE `order_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_organization_membership_id` bigint(20) UNSIGNED NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `order_member_state_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_members`
--

INSERT INTO `order_members` (`id`, `user_organization_membership_id`, `service_order_id`, `order_member_state_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 3, 3, 1, '2022-04-05 08:22:36', '2022-04-05 08:24:33', '2022-04-05 08:24:33'),
(12, 3, 8, 1, '2022-04-05 08:32:38', '2022-04-05 08:32:51', '2022-04-05 08:32:51'),
(13, 1, 4, 1, '2022-04-05 08:33:49', '2022-04-05 08:34:41', '2022-04-05 08:34:41'),
(14, 1, 5, 2, '2022-04-06 03:31:22', '2022-04-07 15:35:48', NULL),
(15, 3, 9, 1, '2022-04-06 05:11:03', '2022-04-06 05:11:47', NULL),
(16, 3, 10, 1, '2022-04-06 05:11:55', '2022-04-06 05:11:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_member_states`
--

CREATE TABLE `order_member_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_member_states`
--

INSERT INTO `order_member_states` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Incomplete', 'Incomplete', NULL, NULL, NULL),
(2, 'Complete', 'Complete', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_states`
--

CREATE TABLE `order_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_states`
--

INSERT INTO `order_states` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Placed', 'Order Placed', NULL, NULL, NULL),
(2, 'Assigned', 'Order Assigned', NULL, NULL, NULL),
(3, 'Cancelled', 'Order Cancelled', NULL, NULL, NULL),
(4, 'Rejected', 'Order Rejected', NULL, NULL, NULL),
(5, 'Hold', 'Order On Hold', NULL, NULL, NULL),
(6, 'Completed', 'Order Complete', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_balance` int(11) NOT NULL DEFAULT 0,
  `organization_state_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `description`, `wallet_balance`, `organization_state_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Jimmy 123 Organization', 'this is some description', 12236, 2, '2022-04-03 04:36:49', '2022-04-07 15:58:49', NULL),
(2, '5 Foundation', 'Description of 5 Foundation', 0, 2, '2022-04-03 04:40:23', '2022-04-03 04:40:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organization_payment_information`
--

CREATE TABLE `organization_payment_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upi_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_payment_information`
--

INSERT INTO `organization_payment_information` (`id`, `bank_name`, `bank_account_number`, `ifsc`, `upi_id`, `organization_id`, `created_at`, `updated_at`) VALUES
(1, 'Bank of india2', '8023428293482', 'fdsdfi2304', 'upsdsdfs@sdfs', 1, '2022-04-07 12:20:11', '2022-04-07 13:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `organization_payouts`
--

CREATE TABLE `organization_payouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) UNSIGNED NOT NULL,
  `status` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0: pending, 1: paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_payouts`
--

INSERT INTO `organization_payouts` (`id`, `organization_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 200, 0, '2022-04-07 13:24:57', '2022-04-07 13:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `organization_roles`
--

CREATE TABLE `organization_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_roles`
--

INSERT INTO `organization_roles` (`id`, `name`, `description`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin', NULL, NULL, NULL),
(2, 'manager', 'manager', 'manager', NULL, NULL, NULL),
(3, 'provider', 'provider', 'provider', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organization_states`
--

CREATE TABLE `organization_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: pending, 1: paid',
  `user_id` bigint(20) NOT NULL,
  `order_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_id` bigint(20) DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Paytm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `transaction_id`, `status`, `user_id`, `order_id`, `invoice_id`, `payment_method`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 200, '20220408111212800110168423303572504', 1, 1, '5_1649365228', 5, 'Paytm', '2022-04-07 15:30:28', '2022-04-07 15:30:41', NULL),
(21, 9012, NULL, 0, 1, '6_1649365639', 6, 'Paytm', '2022-04-07 15:37:19', '2022-04-07 15:37:19', NULL),
(22, 9012, '20220408111212800110168327003615579', 1, 1, '6_1649365751', 6, 'Paytm', '2022-04-07 15:39:11', '2022-04-07 15:44:04', NULL),
(23, 12, NULL, 0, 1, '7_1649366052', 7, 'Paytm', '2022-04-07 15:44:12', '2022-04-07 15:44:12', NULL),
(24, 12, NULL, 0, 1, '7_1649366118', 7, 'Paytm', '2022-04-07 15:45:18', '2022-04-07 15:45:18', NULL),
(25, 12, '20220408111212800110168595203589095', 1, 1, '7_1649366240', 7, 'Paytm', '2022-04-07 15:47:20', '2022-04-07 15:47:57', NULL),
(26, 12, NULL, 0, 1, '8_1649366281', 8, 'Paytm', '2022-04-07 15:48:01', '2022-04-07 15:48:01', NULL),
(27, 12, NULL, 0, 1, '8_1649366434', 8, 'Paytm', '2022-04-07 15:50:34', '2022-04-07 15:50:34', NULL),
(28, 1000, NULL, 0, 1, '9_1649366762', 9, 'Paytm', '2022-04-07 15:56:02', '2022-04-07 15:56:02', NULL),
(29, 12, '20220408111212800110168635203600101', 1, 1, '8_1649366814', 8, 'Paytm', '2022-04-07 15:56:54', '2022-04-07 15:57:18', NULL),
(30, 1000, '20220408111212800110168147903573198', 1, 1, '9_1649366904', 9, 'Paytm', '2022-04-07 15:58:24', '2022-04-07 15:58:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_types`
--

CREATE TABLE `price_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_types`
--

INSERT INTO `price_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Once', NULL, NULL, NULL),
(2, 'Hourly', NULL, NULL, NULL),
(3, 'Daily', NULL, NULL, NULL),
(4, 'Monthly', NULL, NULL, NULL),
(5, 'Yearly', NULL, NULL, NULL),
(6, 'Variable', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reasonable_id` bigint(20) UNSIGNED NOT NULL,
  `reasonable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `body`, `reasonable_id`, `reasonable_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Rejected: Out of service area', 8, 'App\\Models\\ServiceOrder', '2022-04-06 00:30:05', '2022-04-06 00:30:05', NULL),
(11, 'Rejected: Price dissaggrement', 3, 'App\\Models\\ServiceOrder', '2022-04-06 03:39:19', '2022-04-06 03:39:19', NULL),
(12, 'Cancelled: By User', 5, 'App\\Models\\ServiceOrder', '2022-04-06 04:11:41', '2022-04-06 04:11:41', NULL),
(13, 'Cancelled: By User', 4, 'App\\Models\\ServiceOrder', '2022-04-06 04:14:00', '2022-04-06 04:14:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL,
  `price_type_id` bigint(20) NOT NULL,
  `organization_id` bigint(20) NOT NULL,
  `service_category_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `price_type_id`, `organization_id`, `service_category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(49, 'First Service', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, ipsam. Sint, neque. Asperiores provident\r\n            mollitia hic fuga, ex blanditiis, quisquam, fugit architecto modi necessitatibus nihil. Nihil dolorum velit\r\n            facere, temporibus, error adipisci quas omnis voluptates, placeat consequuntur distinctio culpa deleniti\r\n            quaerat. Dolore pariatur cum deserunt voluptatem. Sapiente beatae ea inventore repellat repudiandae amet magnam\r\n            nobis rem mollitia obcaecati, commodi delectus recusandae facilis rerum eaque aliquam vero ipsum expedita,\r\n            consequuntur at dolorem, minima explicabo modi accusamus! Fugiat, dolor. Aspernatur omnis reiciendis in, ullam\r\n            dicta ut officia, voluptates asperiores adipisci inventore quia beatae aliquid? Porro maiores fugiat excepturi\r\n            inventore quo debitis vero laborum repellendus, reprehenderit numquam cum accusamus, aliquam illum velit tempore\r\n            similique accusantium eveniet quia nihil, beatae minima. Tenetur, neque ut aliquid veniam expedita doloremque\r\n            sapiente pariatur libero delectus eius saepe nostrum reiciendis sint quo quas dignissimos dolore modi sed\r\n            consequuntur nisi quis quibusdam sit corrupti. Sapiente repudiandae in aliquam recusandae sed minima, eligendi\r\n            illum illo nobis qui quo. Iusto velit soluta eos voluptatibus voluptas, debitis quia ab, nemo similique quam\r\n            praesentium dolorem quasi doloremque vel nesciunt! Omnis eligendi molestiae non odio, error explicabo magni a\r\n            architecto voluptate eveniet necessitatibus quos dolor, labore cum laborum tempore nulla? Quia fugit numquam\r\n            inventore, earum ipsam facere! Repellendus necessitatibus aliquid molestiae et nulla facere voluptate ratione\r\n            dolores, enim voluptas corporis nesciunt vel consequuntur earum nihil provident excepturi reprehenderit, unde\r\n            quam at distinctio magnam veniam velit. Non aspernatur corrupti deleniti cumque incidunt et numquam sequi\r\n            pariatur animi sint libero delectus quas, voluptates dolorum quasi voluptate suscipit qui similique temporibus\r\n            veniam. Iusto debitis sint quasi quis esse quam, laboriosam eligendi, quas iste non cumque architecto\r\n            necessitatibus cupiditate suscipit illo praesentium voluptatem sapiente, consequatur deserunt! Nam eveniet\r\n            laboriosam quidem ipsum odit quas. Optio reprehenderit aliquid ab mollitia beatae tempore similique, delectus\r\n            molestiae porro repellat quia quaerat sit obcaecati consequuntur illum ipsam libero. Animi molestias odio odit\r\n            hic. Alias nulla expedita perferendis corporis facere quidem recusandae laboriosam blanditiis quam accusantium\r\n            veritatis fugit mollitia sequi reprehenderit, ipsa sunt natus ducimus? Velit quis soluta tempora doloribus?\r\n            Praesentium ipsa adipisci temporibus repellendus, similique odio sit, tenetur, culpa nostrum pariatur deserunt\r\n            dolore quia provident. Illo eveniet iusto maxime dignissimos expedita, saepe vitae dolore, repellendus beatae\r\n            nesciunt hic ullam perspiciatis ut obcaecati id quasi, dolorum delectus ipsa laboriosam asperiores. Distinctio\r\n            exercitationem, officia facere nulla voluptates, sint iusto perferendis consequatur culpa tempora ex eaque\r\n            veritatis repudiandae hic dolorem accusamus. Ipsam vitae velit porro corrupti mollitia eum perspiciatis? Eaque\r\n            perspiciatis temporibus est adipisci totam excepturi recusandae hic reprehenderit velit iste accusantium\r\n            voluptates debitis itaque id dolorum quis, modi quibusdam et. Alias aliquam repellat, dolor animi facilis fugiat\r\n            modi corrupti culpa eos eum in, veniam quos, ex est architecto sunt commodi ut nihil dignissimos dolores. Quidem\r\n            ut iusto corrupti veritatis quasi placeat odio assumenda omnis cupiditate qui, nihil iure tempora at, maxime\r\n            provident sit praesentium tempore! Quia ea ad exercitationem illo veritatis ipsam alias modi voluptate\r\n            voluptatibus soluta, nulla tempore! Nulla a in sint maxime ad ipsam fugiat vero aspernatur perspiciatis\r\n            possimus. Fugit sapiente iste quod.', 0, 6, 1, 1, '2022-03-31 11:57:43', '2022-04-02 03:28:44', NULL),
(50, 'Second Service', 'Second Service', 0, 6, 1, 4, '2022-03-31 11:58:28', '2022-04-01 15:04:26', NULL),
(51, 'Third Servive', 'Third Service', 9012, 3, 1, 7, '2022-03-31 11:59:19', '2022-03-31 11:59:19', NULL),
(52, 'Escort', 'Expert and nice', 2000, 2, 2, 5, '2022-04-01 11:55:40', '2022-04-01 11:55:40', NULL),
(53, 'Paint Job', 'Paints your house', 100000, 1, 2, 2, '2022-04-01 12:10:18', '2022-04-01 12:10:18', NULL),
(54, 'Cleaning JOb', 'want your home neat and clean ?', 3000, 4, 2, 5, '2022-04-01 12:11:16', '2022-04-01 12:11:16', NULL),
(55, 'Food', 'having troubles with your wife not making any food ?', 5000, 4, 2, 5, '2022-04-01 12:12:07', '2022-04-01 12:12:07', NULL),
(56, 'Expert Electrician', 'Is your switch giving you shocks ? try our men', 5000, 1, 2, 4, '2022-04-01 12:13:49', '2022-04-01 12:13:49', NULL),
(57, 'Fast Carpenter', 'Want to impress your guests with your tables ?', 3000, 2, 2, 3, '2022-04-01 12:15:20', '2022-04-01 12:15:20', NULL),
(58, 'Fourth Service', 'Fourth Service', 0, 6, 1, 1, '2022-04-01 12:21:05', '2022-04-01 15:07:20', NULL),
(59, 'Fifth Service', 'Fifth Service', 12, 2, 1, 5, '2022-04-01 12:21:49', '2022-04-01 12:21:49', NULL),
(60, 'Sixth Service', 'Sixth Service', 5700, 4, 1, 2, '2022-04-01 12:22:55', '2022-04-01 12:22:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_area_availablities`
--

CREATE TABLE `service_area_availablities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `area_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_area_availablities`
--

INSERT INTO `service_area_availablities` (`id`, `service_id`, `area_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 49, 6, '2022-04-06 01:45:21', '2022-04-06 01:45:21', NULL),
(28, 49, 4, '2022-04-06 01:45:21', '2022-04-06 01:45:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Plumbing', NULL, NULL, NULL, NULL),
(2, 'HandyMan', NULL, NULL, NULL, NULL),
(3, 'Carpenter', NULL, NULL, NULL, NULL),
(4, 'Wiremen', NULL, NULL, NULL, NULL),
(5, 'House Maid', NULL, NULL, NULL, NULL),
(6, 'Haircut', NULL, NULL, NULL, NULL),
(7, 'AC Service', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_orders`
--

CREATE TABLE `service_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `order_state_id` bigint(20) NOT NULL DEFAULT 1,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_orders`
--

INSERT INTO `service_orders` (`id`, `user_id`, `service_id`, `order_state_id`, `comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 1, 49, 2, 'Please someone nice', '2022-04-03 15:51:24', '2022-04-06 03:39:19', NULL),
(4, 1, 51, 2, NULL, '2022-04-04 11:49:43', '2022-04-06 04:14:00', NULL),
(5, 1, 59, 2, NULL, '2022-04-04 11:49:59', '2022-04-06 04:11:41', NULL),
(6, 2, 52, 2, NULL, '2022-04-04 11:50:21', '2022-04-04 11:50:21', NULL),
(7, 2, 57, 2, NULL, '2022-04-04 11:50:42', '2022-04-04 11:50:42', NULL),
(8, 2, 58, 2, NULL, '2022-04-04 11:59:01', '2022-04-06 00:30:05', NULL),
(9, 1, 50, 6, NULL, '2022-04-06 04:31:54', '2022-04-06 06:25:34', NULL),
(10, 1, 49, 2, NULL, '2022-04-06 04:36:45', '2022-04-06 05:11:55', NULL);

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
  `phone_number` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_state_id` bigint(20) NOT NULL,
  `area_id` bigint(20) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone_number`, `address`, `user_state_id`, `area_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Jimmy Kumar Ahalpara 123', 'jimmyahalpara123@gmail.com', '2022-04-03 04:33:59', '$2y$10$vlOZlkFRHRb77YQcCHhvEuCFGsSnFBib0M7xJXji2YPBWBdDld6..', '9090909090', 'bhavnagar', 1, 6, 'vxrkShqySPH94Ed9M0Wnd3p4GHBEDep347HwZUHPN2LLQ97VxUiNWLFSGOBV', '2022-04-03 04:33:36', '2022-04-03 04:33:59', NULL),
(2, 'Jimmy 5 ahalpara', 'jahalpara5@gmail.com', '2022-04-03 04:40:00', '$2y$10$0DILSA1qhmJivY0mpTzj1uCdTCLJGxj788YsGbhhVg67hIxKmoGkW', '9090909090', 'Bhavnagar', 1, 5, NULL, '2022-04-03 04:39:38', '2022-04-03 04:40:00', NULL),
(4, 'Jimmy tridhya', 'jimmyatridhyatech@gmail.com', '2022-04-05 06:56:44', '$2y$10$Pgn5kA5BT3Ft0lCTPqoKuu3aJmR5DqvXerTXFWug78Ab64K1KY/sC', '9090909090', 'Rajkot', 1, 3, NULL, '2022-04-05 06:56:12', '2022-04-05 06:56:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_organization_memberships`
--

CREATE TABLE `user_organization_memberships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `organization_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_organization_memberships`
--

INSERT INTO `user_organization_memberships` (`id`, `user_id`, `organization_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2022-04-03 04:36:49', '2022-04-03 04:36:49', NULL),
(2, 2, 2, '2022-04-03 04:40:23', '2022-04-03 04:40:23', NULL),
(3, 4, 1, '2022-04-05 06:56:12', '2022-04-05 06:56:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_organization_membership_roles`
--

CREATE TABLE `user_organization_membership_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_role_id` bigint(20) NOT NULL,
  `user_organization_membership_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_organization_membership_roles`
--

INSERT INTO `user_organization_membership_roles` (`id`, `organization_role_id`, `user_organization_membership_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2022-04-03 04:36:49', '2022-04-03 04:36:49', NULL),
(2, 1, 2, '2022-04-03 04:40:23', '2022-04-03 04:40:23', NULL),
(3, 3, 3, '2022-04-05 06:56:12', '2022-04-05 06:56:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_service_likes`
--

CREATE TABLE `user_service_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_service_likes`
--

INSERT INTO `user_service_likes` (`id`, `user_id`, `service_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 1, 49, '2022-04-06 02:25:41', '2022-04-06 02:25:41', NULL),
(20, 1, 50, '2022-04-06 04:21:21', '2022-04-06 04:21:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_service_ratings`
--

CREATE TABLE `user_service_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_service_ratings`
--

INSERT INTO `user_service_ratings` (`id`, `user_id`, `service_id`, `feedback`, `rating`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 52, 'why not available ?', 4, '2022-04-03 04:45:19', '2022-04-03 04:45:19', NULL),
(2, 1, 49, 'Great Service', 5, '2022-04-03 15:48:40', '2022-04-03 15:48:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_states`
--

CREATE TABLE `user_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_states`
--

INSERT INTO `user_states` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Active', 'User Is Active', NULL, NULL, NULL),
(2, 'Inactive', 'User is Inactive', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_states`
--
ALTER TABLE `invoice_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_members`
--
ALTER TABLE `order_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_member_states`
--
ALTER TABLE `order_member_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_states`
--
ALTER TABLE `order_states`
  ADD UNIQUE KEY `primary_key` (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_payment_information`
--
ALTER TABLE `organization_payment_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_payouts`
--
ALTER TABLE `organization_payouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_roles`
--
ALTER TABLE `organization_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_states`
--
ALTER TABLE `organization_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `price_types`
--
ALTER TABLE `price_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_area_availablities`
--
ALTER TABLE `service_area_availablities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_orders`
--
ALTER TABLE `service_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_organization_memberships`
--
ALTER TABLE `user_organization_memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_organization_membership_roles`
--
ALTER TABLE `user_organization_membership_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_service_likes`
--
ALTER TABLE `user_service_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_service_ratings`
--
ALTER TABLE `user_service_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_states`
--
ALTER TABLE `user_states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice_states`
--
ALTER TABLE `invoice_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `order_members`
--
ALTER TABLE `order_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_member_states`
--
ALTER TABLE `order_member_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organization_payment_information`
--
ALTER TABLE `organization_payment_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organization_payouts`
--
ALTER TABLE `organization_payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organization_roles`
--
ALTER TABLE `organization_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organization_states`
--
ALTER TABLE `organization_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_types`
--
ALTER TABLE `price_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `service_area_availablities`
--
ALTER TABLE `service_area_availablities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_orders`
--
ALTER TABLE `service_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_organization_memberships`
--
ALTER TABLE `user_organization_memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_organization_membership_roles`
--
ALTER TABLE `user_organization_membership_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_service_likes`
--
ALTER TABLE `user_service_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_service_ratings`
--
ALTER TABLE `user_service_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_states`
--
ALTER TABLE `user_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
