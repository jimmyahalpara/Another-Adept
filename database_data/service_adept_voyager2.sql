-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2022 at 10:26 AM
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
-- Database: `service_adept_voyager`
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
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, NULL, 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, NULL, 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, NULL, 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, NULL, 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'voyager::seeders.data_rows.roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, NULL, 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 1, 1, 1, 1, 1, 1, NULL, 9),
(22, 5, 'id', 'text', 'Id', 1, 1, 1, 0, 0, 0, '{}', 1),
(23, 5, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(24, 5, 'state', 'text', 'State', 0, 1, 1, 1, 1, 1, '{}', 3),
(25, 5, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(26, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(27, 7, 'id', 'text', 'Id', 1, 1, 1, 1, 1, 1, '{}', 1),
(28, 7, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(29, 7, 'pincode', 'text', 'Pincode', 1, 1, 1, 1, 1, 1, '{}', 3),
(30, 7, 'city_id', 'text', 'City Id', 0, 1, 1, 1, 1, 1, '{}', 4),
(31, 7, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(32, 7, 'updated_at', 'timestamp', 'Updated At', 0, 1, 1, 1, 1, 1, '{}', 6),
(33, 7, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 7),
(35, 7, 'area_belongsto_city_relationship', 'relationship', 'cities', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\City\",\"table\":\"cities\",\"type\":\"belongsTo\",\"column\":\"city_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 8),
(36, 9, 'id', 'text', 'Id', 1, 1, 1, 1, 1, 1, '{}', 1),
(37, 9, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(38, 9, 'description', 'text', 'Description', 1, 1, 1, 1, 1, 1, '{}', 3),
(39, 9, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(40, 9, 'updated_at', 'timestamp', 'Updated At', 0, 1, 1, 1, 0, 1, '{}', 5),
(41, 10, 'id', 'text', 'Id', 1, 1, 1, 1, 1, 1, '{}', 1),
(42, 10, 'document_path', 'file', 'Document Path', 1, 1, 1, 1, 1, 1, '{}', 2),
(43, 10, 'documentable_id', 'text', 'Documentable Id', 1, 1, 1, 1, 1, 1, '{}', 3),
(44, 10, 'documentable_type', 'text', 'Documentable Type', 1, 1, 1, 1, 1, 1, '{}', 4),
(45, 10, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(46, 10, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(47, 10, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 7),
(48, 13, 'id', 'text', 'Id', 1, 1, 1, 1, 1, 1, '{}', 1),
(49, 13, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(50, 13, 'description', 'text', 'Description', 1, 1, 1, 1, 1, 1, '{}', 3),
(51, 13, 'wallet_balance', 'text', 'Wallet Balance', 1, 1, 1, 1, 1, 1, '{}', 4),
(52, 13, 'organization_state_id', 'text', 'Organization State Id', 1, 1, 1, 1, 1, 1, '{}', 5),
(53, 13, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(54, 13, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(55, 13, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 8),
(56, 13, 'organization_belongsto_organization_state_relationship', 'relationship', 'organization_states', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\OrganizationState\",\"table\":\"organization_states\",\"type\":\"belongsTo\",\"column\":\"organization_state_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 9),
(57, 1, 'user_belongsto_area_relationship', 'relationship', 'areas', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Area\",\"table\":\"areas\",\"type\":\"belongsTo\",\"column\":\"area_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 13),
(58, 15, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(59, 15, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(60, 15, 'description', 'text', 'Description', 1, 1, 1, 1, 1, 1, '{}', 3),
(61, 15, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(62, 15, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(63, 15, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 6),
(64, 15, 'user_state_hasmany_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"hasMany\",\"column\":\"user_state_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(65, 1, 'user_belongsto_user_state_relationship', 'relationship', 'user_states', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\UserState\",\"table\":\"user_states\",\"type\":\"belongsTo\",\"column\":\"user_state_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 14),
(66, 17, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(67, 17, 'bank_name', 'text', 'Bank Name', 0, 1, 1, 1, 1, 1, '{}', 2),
(68, 17, 'bank_account_number', 'text', 'Bank Account Number', 0, 1, 1, 1, 1, 1, '{}', 3),
(69, 17, 'ifsc', 'text', 'Ifsc', 0, 1, 1, 1, 1, 1, '{}', 4),
(70, 17, 'upi_id', 'text', 'Upi Id', 0, 1, 1, 1, 1, 1, '{}', 5),
(71, 17, 'organization_id', 'text', 'Organization Id', 1, 1, 1, 1, 1, 1, '{}', 6),
(72, 17, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 7),
(73, 17, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(74, 13, 'organization_hasone_organization_payment_information_relationship', 'relationship', 'organization_payment_information', 0, 0, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\OrganizationPaymentInformation\",\"table\":\"organization_payment_information\",\"type\":\"hasOne\",\"column\":\"organization_id\",\"key\":\"id\",\"label\":\"bank_account_number\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 10),
(75, 19, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(76, 19, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(77, 19, 'description', 'text', 'Description', 1, 1, 1, 1, 1, 1, '{}', 3),
(78, 19, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{}', 4),
(79, 19, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 5),
(80, 19, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(81, 19, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(82, 21, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(83, 21, 'organization_id', 'text', 'Organization Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(84, 21, 'amount', 'text', 'Amount', 1, 1, 1, 1, 1, 1, '{}', 3),
(85, 21, 'status', 'text', 'Status', 1, 1, 1, 1, 1, 1, '{}', 4),
(86, 21, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(87, 21, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(88, 13, 'organization_hasmany_organization_payout_relationship', 'relationship', 'organization_payouts', 0, 0, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\OrganizationPayout\",\"table\":\"organization_payouts\",\"type\":\"hasMany\",\"column\":\"organization_id\",\"key\":\"id\",\"label\":\"amount\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 11),
(89, 21, 'organization_payout_belongsto_organization_relationship', 'relationship', 'organizations', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Organization\",\"table\":\"organizations\",\"type\":\"belongsTo\",\"column\":\"organization_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 7),
(90, 23, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(91, 23, 'user_id', 'text', 'User Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(92, 23, 'organization_id', 'text', 'Organization Id', 1, 1, 1, 1, 1, 1, '{}', 3),
(93, 23, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(94, 23, 'updated_at', 'timestamp', 'Updated At', 0, 1, 1, 1, 0, 0, '{}', 5),
(95, 23, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 6),
(96, 23, 'user_organization_membership_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 7),
(97, 23, 'user_organization_membership_belongsto_organization_relationship', 'relationship', 'organizations', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Organization\",\"table\":\"organizations\",\"type\":\"belongsTo\",\"column\":\"organization_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 8),
(98, 25, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(99, 25, 'organization_role_id', 'text', 'Organization Role Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(100, 25, 'user_organization_membership_id', 'text', 'User Organization Membership Id', 1, 1, 1, 1, 1, 1, '{}', 3),
(101, 25, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(102, 25, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(103, 25, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 6),
(104, 25, 'user_organization_membership_role_belongsto_user_organization_membership_relationship', 'relationship', 'user_organization_memberships', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\UserOrganizationMembership\",\"table\":\"user_organization_memberships\",\"type\":\"belongsTo\",\"column\":\"user_organization_membership_id\",\"key\":\"id\",\"label\":\"id\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(105, 25, 'user_organization_membership_role_belongsto_organization_role_relationship', 'relationship', 'organization_roles', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\OrganizationRole\",\"table\":\"organization_roles\",\"type\":\"belongsTo\",\"column\":\"organization_role_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 8),
(106, 26, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(107, 26, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(108, 26, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(109, 26, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(110, 26, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 5),
(111, 28, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(112, 28, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(113, 28, 'description', 'text', 'Description', 0, 1, 1, 1, 1, 1, '{}', 3),
(114, 28, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(115, 28, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(116, 28, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 6),
(117, 30, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(118, 30, 'service_id', 'text', 'Service Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(119, 30, 'area_id', 'text', 'Area Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(120, 30, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(121, 30, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(122, 30, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 6),
(123, 32, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(124, 32, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(125, 32, 'description', 'text', 'Description', 1, 1, 1, 1, 1, 1, '{}', 3),
(126, 32, 'price', 'text', 'Price', 1, 1, 1, 1, 1, 1, '{}', 4),
(127, 32, 'price_type_id', 'text', 'Price Type Id', 1, 1, 1, 1, 1, 1, '{}', 5),
(128, 32, 'organization_id', 'text', 'Organization Id', 1, 1, 1, 1, 1, 1, '{}', 6),
(129, 32, 'service_category_id', 'text', 'Service Category Id', 0, 1, 1, 1, 1, 1, '{}', 7),
(130, 32, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 8),
(131, 32, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 9),
(132, 32, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 10),
(133, 32, 'service_belongstomany_area_relationship', 'relationship', 'areas', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Area\",\"table\":\"areas\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"service_area_availablities\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(134, 32, 'service_belongsto_organization_relationship', 'relationship', 'organizations', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Organization\",\"table\":\"organizations\",\"type\":\"belongsTo\",\"column\":\"organization_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 12),
(135, 32, 'service_belongsto_price_type_relationship', 'relationship', 'price_types', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\PriceType\",\"table\":\"price_types\",\"type\":\"belongsTo\",\"column\":\"price_type_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 13),
(136, 32, 'service_belongsto_service_category_relationship', 'relationship', 'service_categories', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\ServiceCategory\",\"table\":\"service_categories\",\"type\":\"belongsTo\",\"column\":\"service_category_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 14),
(137, 30, 'service_area_availablity_hasone_service_relationship', 'relationship', 'services', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Service\",\"table\":\"services\",\"type\":\"belongsTo\",\"column\":\"service_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(138, 30, 'service_area_availablity_belongsto_area_relationship', 'relationship', 'areas', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Area\",\"table\":\"areas\",\"type\":\"belongsTo\",\"column\":\"area_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 8),
(139, 13, 'organization_hasmany_service_relationship', 'relationship', 'services', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Service\",\"table\":\"services\",\"type\":\"hasMany\",\"column\":\"organization_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 12),
(140, 35, 'id', 'text', 'Id', 1, 1, 1, 1, 1, 1, '{}', 1),
(141, 35, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(142, 35, 'description', 'text', 'Description', 1, 1, 1, 1, 1, 1, '{}', 3),
(143, 35, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(144, 35, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(145, 35, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 6),
(146, 36, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(147, 36, 'user_id', 'text', 'User Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(148, 36, 'service_id', 'text', 'Service Id', 1, 1, 1, 1, 1, 1, '{}', 3),
(149, 36, 'order_state_id', 'text', 'Order State Id', 1, 1, 1, 1, 1, 1, '{}', 4),
(150, 36, 'comment', 'text', 'Comment', 0, 1, 1, 1, 1, 1, '{}', 5),
(151, 36, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(152, 36, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(153, 36, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 8),
(154, 36, 'service_order_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 9),
(155, 36, 'service_order_belongsto_service_relationship', 'relationship', 'services', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Service\",\"table\":\"services\",\"type\":\"belongsTo\",\"column\":\"service_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 10),
(156, 36, 'service_order_belongsto_order_state_relationship', 'relationship', 'order_states', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\OrderState\",\"table\":\"order_states\",\"type\":\"belongsTo\",\"column\":\"order_state_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":\"0\"}', 11),
(157, 38, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(158, 38, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(159, 38, 'description', 'text', 'Description', 0, 1, 1, 1, 1, 1, '{}', 3),
(160, 38, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(161, 38, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(162, 38, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 6),
(163, 39, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(164, 39, 'user_organization_membership_id', 'text', 'User Organization Membership Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(165, 39, 'service_order_id', 'text', 'Service Order Id', 1, 1, 1, 1, 1, 1, '{}', 3),
(166, 39, 'order_member_state_id', 'text', 'Order Member State Id', 1, 1, 1, 1, 1, 1, '{}', 4),
(167, 39, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(168, 39, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(169, 39, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 7),
(170, 39, 'order_member_belongsto_user_organization_membership_relationship', 'relationship', 'user_organization_memberships', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\UserOrganizationMembership\",\"table\":\"user_organization_memberships\",\"type\":\"belongsTo\",\"column\":\"user_organization_membership_id\",\"key\":\"id\",\"label\":\"id\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 8),
(171, 39, 'order_member_belongsto_service_order_relationship', 'relationship', 'service_orders', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\ServiceOrder\",\"table\":\"service_orders\",\"type\":\"belongsTo\",\"column\":\"service_order_id\",\"key\":\"id\",\"label\":\"id\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 9),
(172, 39, 'order_member_belongsto_order_member_state_relationship', 'relationship', 'order_member_states', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\OrderMemberState\",\"table\":\"order_member_states\",\"type\":\"belongsTo\",\"column\":\"order_member_state_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 10),
(173, 41, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(174, 41, 'due', 'timestamp', 'Due', 0, 1, 1, 1, 1, 1, '{}', 2),
(175, 41, 'user_id', 'text', 'User Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(176, 41, 'service_order_id', 'text', 'Service Order Id', 0, 1, 1, 1, 1, 1, '{}', 4),
(177, 41, 'amount', 'text', 'Amount', 0, 1, 1, 1, 1, 1, '{}', 5),
(178, 41, 'amount_paid', 'text', 'Amount Paid', 1, 1, 1, 1, 1, 1, '{}', 6),
(179, 41, 'description', 'text', 'Description', 0, 1, 1, 1, 1, 1, '{}', 7),
(180, 41, 'invoice_state_id', 'text', 'Invoice State Id', 1, 1, 1, 1, 1, 1, '{}', 8),
(181, 41, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 9),
(182, 41, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 10),
(183, 41, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 11),
(184, 43, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(185, 43, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(186, 43, 'description', 'text', 'Description', 0, 1, 1, 1, 1, 1, '{}', 3),
(187, 43, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(188, 43, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(189, 41, 'invoice_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 12),
(190, 41, 'invoice_belongsto_service_order_relationship', 'relationship', 'service_orders', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\ServiceOrder\",\"table\":\"service_orders\",\"type\":\"belongsTo\",\"column\":\"service_order_id\",\"key\":\"id\",\"label\":\"id\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 13),
(191, 41, 'invoice_belongsto_invoice_state_relationship', 'relationship', 'invoice_states', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\InvoiceState\",\"table\":\"invoice_states\",\"type\":\"belongsTo\",\"column\":\"invoice_state_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 14),
(193, 36, 'service_order_hasmany_invoice_relationship', 'relationship', 'invoices', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Invoice\",\"table\":\"invoices\",\"type\":\"hasMany\",\"column\":\"service_order_id\",\"key\":\"id\",\"label\":\"amount\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 12),
(194, 45, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 0),
(195, 45, 'amount', 'text', 'Amount', 1, 1, 1, 1, 1, 1, '{}', 2),
(196, 45, 'transaction_id', 'text', 'Transaction Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(197, 45, 'status', 'text', 'Status', 1, 1, 1, 1, 1, 1, '{}', 4),
(198, 45, 'user_id', 'text', 'User Id', 1, 1, 1, 1, 1, 1, '{}', 5),
(199, 45, 'order_id', 'text', 'Order Id', 0, 1, 1, 1, 1, 1, '{}', 6),
(200, 45, 'invoice_id', 'text', 'Invoice Id', 0, 1, 1, 1, 1, 1, '{}', 7),
(201, 45, 'payment_method', 'text', 'Payment Method', 1, 1, 1, 1, 1, 1, '{}', 8),
(202, 45, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 9),
(203, 45, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 10),
(204, 45, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 11),
(205, 45, 'payment_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 12),
(206, 45, 'payment_belongsto_invoice_relationship', 'relationship', 'invoices', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Invoice\",\"table\":\"invoices\",\"type\":\"belongsTo\",\"column\":\"invoice_id\",\"key\":\"id\",\"label\":\"amount\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 13),
(207, 1, 'user_belongstomany_service_relationship', 'relationship', 'services', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Service\",\"table\":\"services\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"user_service_likes\",\"pivot\":\"1\",\"taggable\":\"on\"}', 15),
(208, 1, 'user_hasmany_user_service_rating_relationship', 'relationship', 'user_service_ratings', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\UserServiceRating\",\"table\":\"user_service_ratings\",\"type\":\"hasMany\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"rating\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 16),
(209, 32, 'service_hasmany_user_service_rating_relationship', 'relationship', 'user_service_ratings', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\UserServiceRating\",\"table\":\"user_service_ratings\",\"type\":\"hasMany\",\"column\":\"service_id\",\"key\":\"id\",\"label\":\"rating\",\"pivot_table\":\"areas\",\"pivot\":\"0\",\"taggable\":null}', 15);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', '', 1, 0, NULL, '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(5, 'cities', 'cities', 'City', 'Cities', NULL, 'App\\Models\\City', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-04-09 05:09:15', '2022-04-10 03:33:07'),
(7, 'areas', 'areas', 'Area', 'Areas', NULL, 'App\\Models\\Area', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-04-09 05:16:08', '2022-04-10 03:32:04'),
(9, 'organization_states', 'organization-states', 'Organization State', 'Organization States', NULL, 'App\\Models\\OrganizationState', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-09 05:44:44', '2022-04-09 05:44:44'),
(10, 'documents', 'documents', 'Document', 'Documents', 'voyager-files', 'App\\Models\\Document', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-04-09 05:54:20', '2022-04-10 03:33:17'),
(13, 'organizations', 'organizations', 'Organization', 'Organizations', NULL, 'App\\Models\\Organization', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-04-09 14:02:08', '2022-04-10 03:25:28'),
(15, 'user_states', 'user-states', 'User State', 'User States', NULL, 'App\\Models\\UserState', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-04-09 14:12:52', '2022-04-09 14:15:14'),
(17, 'organization_payment_information', 'organization-payment-information', 'Organization Payment Information', 'Organization Payment Informations', NULL, 'App\\Models\\OrganizationPaymentInformation', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-09 14:21:04', '2022-04-09 14:21:04'),
(19, 'organization_roles', 'organization-roles', 'Organization Role', 'Organization Roles', NULL, 'App\\Models\\OrganizationRole', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-09 14:26:05', '2022-04-09 14:26:05'),
(21, 'organization_payouts', 'organization-payouts', 'Organization Payout', 'Organization Payouts', NULL, 'App\\Models\\OrganizationPayout', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-09 14:27:06', '2022-04-09 14:27:06'),
(23, 'user_organization_memberships', 'user-organization-memberships', 'User Organization Membership', 'User Organization Memberships', NULL, 'App\\Models\\UserOrganizationMembership', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-04-09 15:00:16', '2022-04-09 15:01:07'),
(25, 'user_organization_membership_roles', 'user-organization-membership-roles', 'User Organization Membership Role', 'User Organization Membership Roles', NULL, 'App\\Models\\UserOrganizationMembershipRole', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-04-09 15:03:57', '2022-04-09 15:08:00'),
(26, 'price_types', 'price-types', 'Price Type', 'Price Types', NULL, 'App\\Models\\PriceType', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-09 15:17:21', '2022-04-09 15:17:21'),
(28, 'service_categories', 'service-categories', 'Service Category', 'Service Categories', NULL, 'App\\Models\\ServiceCategory', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-09 15:21:49', '2022-04-09 15:21:49'),
(30, 'service_area_availablities', 'service-area-availablities', 'Service Area Availablity', 'Service Area Availablities', NULL, 'App\\Models\\ServiceAreaAvailablity', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-04-09 15:24:45', '2022-04-09 15:38:32'),
(32, 'services', 'services', 'Service', 'Services', NULL, 'App\\Models\\Service', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-04-09 15:26:21', '2022-04-10 03:35:16'),
(35, 'order_states', 'order-states', 'Order State', 'Order States', NULL, 'App\\Models\\OrderState', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-10 03:41:13', '2022-04-10 03:41:13'),
(36, 'service_orders', 'service-orders', 'Service Order', 'Service Orders', NULL, 'App\\Models\\ServiceOrder', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-04-10 03:41:58', '2022-04-10 03:47:51'),
(38, 'order_member_states', 'order-member-states', 'Order Member State', 'Order Member States', NULL, 'App\\Models\\OrderMemberState', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-10 03:55:35', '2022-04-10 03:55:35'),
(39, 'order_members', 'order-members', 'Order Member', 'Order Members', NULL, 'App\\Models\\OrderMember', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-10 03:56:14', '2022-04-10 03:56:14'),
(41, 'invoices', 'invoices', 'Invoice', 'Invoices', NULL, 'App\\Models\\Invoice', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-10 04:06:39', '2022-04-10 04:06:39'),
(43, 'invoice_states', 'invoice-states', 'Invoice State', 'Invoice States', NULL, 'App\\Models\\InvoiceState', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-10 04:08:05', '2022-04-10 04:08:05'),
(45, 'payments', 'payments', 'Payment', 'Payments', NULL, 'App\\Models\\Payment', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-04-10 04:16:27', '2022-04-10 04:16:27');

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
(2, 'C:\\xampp\\htdocs\\service-adept\\public\\uploads/1648980623.jpg', 2, 'App\\Models\\Organization', '2022-04-03 04:40:23', '2022-04-03 04:40:23', NULL),
(3, 'C:\\xampp\\htdocs\\service-adept\\public\\uploads/1649610968.pdf', 3, 'App\\Models\\Organization', '2022-04-10 11:46:08', '2022-04-10 11:46:08', NULL),
(4, 'documents/1649672706.pdf', 4, 'App\\Models\\Organization', '2022-04-11 04:55:06', '2022-04-11 04:55:06', NULL),
(5, 'http://localhost:8000/private_documents/1649740254.pdf', 5, 'App\\Models\\Organization', '2022-04-11 23:40:54', '2022-04-11 23:40:54', NULL);

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
(17, 'http://127.0.0.1:8000/images/1648835575.jpg', 60, 'App\\Models\\Service', '2022-04-01 12:22:55', '2022-04-01 12:22:55', NULL),
(18, 'http://localhost:8000/images/1649611369.jpg', 61, 'App\\Models\\Service', '2022-04-10 11:52:49', '2022-04-10 11:52:49', NULL);

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
(9, '2022-04-12 15:37:00', 1, 10, 1000, 0, NULL, 2, '2022-04-07 15:37:00', '2022-04-07 15:58:49', NULL),
(10, '2022-04-13 09:12:59', 1, 3, 2090, 0, 'Some extra charge', 2, '2022-04-08 09:12:59', '2022-04-08 09:13:38', NULL),
(11, '2022-04-13 14:15:49', 1, 3, 192, 0, NULL, 2, '2022-04-08 14:15:49', '2022-04-08 14:16:33', NULL),
(12, '2022-04-13 14:18:11', 1, 3, 12, 0, NULL, 2, '2022-04-08 14:18:11', '2022-04-08 14:32:30', NULL),
(13, '2022-04-15 04:20:32', 1, 4, 9012, 0, NULL, 2, '2022-04-10 04:20:32', '2022-04-10 04:20:57', NULL),
(14, '2022-04-15 12:22:50', 1, 14, 5000, 0, NULL, 2, '2022-04-10 12:22:50', '2022-04-10 12:25:45', NULL),
(15, '2022-04-15 12:23:16', 1, 14, 200, 0, NULL, 1, '2022-04-10 12:23:16', '2022-04-10 12:24:13', '2022-04-10 12:24:13'),
(16, '2022-04-15 12:24:33', 1, 14, 5000, 5000, NULL, 2, '2022-04-10 12:24:33', '2022-04-11 04:47:14', NULL);

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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2022-04-09 04:58:31', '2022-04-09 04:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2022-04-09 04:58:31', '2022-04-09 04:58:31', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 12, '2022-04-09 04:58:31', '2022-04-10 13:25:03', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, 40, 1, '2022-04-09 04:58:31', '2022-04-10 13:25:03', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 2, '2022-04-09 04:58:31', '2022-04-09 04:58:31', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 4, '2022-04-09 04:58:31', '2022-04-10 13:25:03', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2022-04-09 04:58:31', '2022-04-09 05:45:17', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2022-04-09 04:58:31', '2022-04-10 13:25:01', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2022-04-09 04:58:31', '2022-04-10 13:25:01', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2022-04-09 04:58:31', '2022-04-10 13:25:01', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 5, '2022-04-09 04:58:31', '2022-04-10 13:25:03', 'voyager.settings.index', NULL),
(11, 1, 'Cities', '', '_self', 'voyager-location', '#000000', 39, 1, '2022-04-09 05:09:15', '2022-04-10 13:00:24', 'voyager.cities.index', 'null'),
(12, 1, 'Areas', '', '_self', 'voyager-location', '#000000', 39, 2, '2022-04-09 05:16:08', '2022-04-10 13:00:28', 'voyager.areas.index', 'null'),
(14, 1, 'Organization States', '', '_self', 'voyager-power', '#000000', 35, 4, '2022-04-09 05:44:44', '2022-04-10 13:24:57', 'voyager.organization-states.index', 'null'),
(15, 1, 'Documents', '', '_self', 'voyager-file-text', '#000000', NULL, 11, '2022-04-09 05:54:20', '2022-04-10 13:25:03', 'voyager.documents.index', 'null'),
(17, 1, 'Organizations', '', '_self', 'voyager-company', '#000000', 35, 1, '2022-04-09 14:02:08', '2022-04-10 12:44:56', 'voyager.organizations.index', 'null'),
(18, 1, 'User States', '', '_self', 'voyager-power', '#000000', 40, 2, '2022-04-09 14:12:52', '2022-04-10 13:25:04', 'voyager.user-states.index', 'null'),
(19, 1, 'Organization Payment Informations', '', '_self', 'voyager-credit-card', '#000000', 35, 5, '2022-04-09 14:21:04', '2022-04-10 13:24:57', 'voyager.organization-payment-information.index', 'null'),
(20, 1, 'Organization Roles', '', '_self', 'voyager-group', '#000000', 35, 7, '2022-04-09 14:26:05', '2022-04-10 13:24:57', 'voyager.organization-roles.index', 'null'),
(21, 1, 'Organization Payouts', '', '_self', 'voyager-dollar', '#000000', 35, 6, '2022-04-09 14:27:06', '2022-04-10 13:24:57', 'voyager.organization-payouts.index', 'null'),
(22, 1, 'Org. Memberships', '', '_self', 'voyager-people', '#000000', 35, 2, '2022-04-09 15:00:16', '2022-04-10 13:01:31', 'voyager.user-organization-memberships.index', 'null'),
(23, 1, 'Org. Membership Roles', '', '_self', 'voyager-group', '#000000', 35, 3, '2022-04-09 15:03:57', '2022-04-10 13:01:31', 'voyager.user-organization-membership-roles.index', 'null'),
(24, 1, 'Price Types', '', '_self', 'voyager-dollar', '#000000', 36, 3, '2022-04-09 15:17:21', '2022-04-10 13:01:02', 'voyager.price-types.index', 'null'),
(25, 1, 'Service Categories', '', '_self', 'voyager-tag', '#000000', 36, 2, '2022-04-09 15:21:49', '2022-04-10 13:01:02', 'voyager.service-categories.index', 'null'),
(26, 1, 'Service Area Availablities', '', '_self', 'voyager-location', '#000000', 36, 4, '2022-04-09 15:24:45', '2022-04-10 13:01:02', 'voyager.service-area-availablities.index', 'null'),
(27, 1, 'Services', '', '_self', 'voyager-tools', '#000000', 36, 1, '2022-04-09 15:26:21', '2022-04-10 12:47:58', 'voyager.services.index', 'null'),
(28, 1, 'Order States', '', '_self', 'voyager-power', '#000000', 37, 2, '2022-04-10 03:41:13', '2022-04-10 13:02:26', 'voyager.order-states.index', 'null'),
(29, 1, 'Service Orders', '', '_self', 'voyager-basket', '#000000', 37, 1, '2022-04-10 03:41:58', '2022-04-10 12:49:51', 'voyager.service-orders.index', 'null'),
(30, 1, 'Order Member States', '', '_self', 'voyager-power', '#000000', 37, 4, '2022-04-10 03:55:35', '2022-04-10 13:02:26', 'voyager.order-member-states.index', 'null'),
(31, 1, 'Order Members', '', '_self', 'voyager-anchor', '#000000', 37, 3, '2022-04-10 03:56:14', '2022-04-10 13:02:26', 'voyager.order-members.index', 'null'),
(32, 1, 'Invoices', '', '_self', 'voyager-mail', '#000000', 38, 1, '2022-04-10 04:06:39', '2022-04-10 12:51:12', 'voyager.invoices.index', 'null'),
(33, 1, 'Invoice States', '', '_self', 'voyager-power', '#000000', 38, 3, '2022-04-10 04:08:05', '2022-04-10 13:24:50', 'voyager.invoice-states.index', 'null'),
(34, 1, 'Payments', '', '_self', 'voyager-credit-card', '#000000', 38, 2, '2022-04-10 04:16:27', '2022-04-10 13:00:47', 'voyager.payments.index', 'null'),
(35, 1, 'Organization', '', '_self', 'voyager-company', '#000000', NULL, 6, '2022-04-10 12:44:10', '2022-04-10 13:25:03', NULL, ''),
(36, 1, 'Service', '', '_self', 'voyager-tools', '#000000', NULL, 7, '2022-04-10 12:47:18', '2022-04-10 13:25:03', NULL, ''),
(37, 1, 'Order', '', '_self', 'voyager-basket', '#000000', NULL, 8, '2022-04-10 12:49:07', '2022-04-10 13:25:03', NULL, ''),
(38, 1, 'Billing', '', '_self', 'voyager-dollar', '#000000', NULL, 9, '2022-04-10 12:50:25', '2022-04-10 13:25:03', NULL, ''),
(39, 1, 'Location', '', '_self', 'voyager-location', '#000000', NULL, 10, '2022-04-10 13:00:15', '2022-04-10 13:25:03', NULL, ''),
(40, 1, 'User', '', '_self', 'voyager-person', '#000000', NULL, 3, '2022-04-10 13:24:40', '2022-04-10 13:25:30', NULL, '');

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
(50, '2022_03_23_193725_create_payments_table', 19),
(51, '2022_04_08_204600_create_roles_table', 20),
(52, '2022_04_08_205200_create_permissions_table', 20),
(53, '2022_04_08_205244_create_user_roles_table', 20),
(54, '2022_04_08_205310_create_role_permissions_table', 20),
(55, '2022_04_08_205324_create_user_permissions_table', 20),
(56, '2016_01_01_000000_add_voyager_user_fields', 21),
(57, '2016_01_01_000000_create_data_types_table', 21),
(58, '2016_05_19_173453_create_menu_table', 21),
(59, '2016_10_21_190000_create_roles_table', 21),
(60, '2016_10_21_190000_create_settings_table', 21),
(61, '2016_11_30_135954_create_permission_table', 21),
(62, '2016_11_30_141208_create_permission_role_table', 21),
(63, '2016_12_26_201236_data_types__add__server_side', 21),
(64, '2017_01_13_000000_add_route_to_menu_items_table', 21),
(65, '2017_01_14_005015_create_translations_table', 21),
(66, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 21),
(67, '2017_03_06_000000_add_controller_to_data_types_table', 21),
(68, '2017_04_21_000000_add_order_to_data_rows_table', 21),
(69, '2017_07_05_210000_add_policyname_to_data_types_table', 21),
(70, '2017_08_05_000000_add_group_to_settings_table', 21),
(71, '2017_11_26_013050_add_user_role_relationship', 21),
(72, '2017_11_26_015000_create_user_roles_table', 21),
(73, '2018_03_11_000000_add_user_settings', 21),
(74, '2018_03_14_000000_add_details_to_data_types_table', 21),
(75, '2018_03_16_000000_make_settings_value_nullable', 21);

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
(16, 3, 10, 1, '2022-04-06 05:11:55', '2022-04-06 05:11:55', NULL),
(17, 5, 14, 2, '2022-04-10 12:17:16', '2022-04-10 12:19:41', NULL);

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
(1, 'Jimmy 123 Organization', 'this is some description', 23542, 2, '2022-04-03 04:36:49', '2022-04-10 04:20:57', NULL),
(2, '5 Foundation', 'Description of 5 Foundation', 0, 2, '2022-04-03 04:40:23', '2022-04-03 04:40:23', NULL),
(3, 'Bhuva Foundation', 'Bhuva Foundation Description', 10000, 2, '2022-04-10 11:46:00', '2022-04-11 04:47:14', NULL),
(4, 'Another Organization', 'Another Organization Description', 0, 1, '2022-04-11 04:55:06', '2022-04-11 23:39:33', '2022-04-11 23:39:33'),
(5, 'Another ORganization', 'Another ORganization Description', 0, 2, '2022-04-11 23:40:54', '2022-04-11 23:41:45', NULL);

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
(1, 'Bank of india2', '8023428293482', 'fdsdfi2304', 'upsdsdfs@sdfs', 1, '2022-04-07 12:20:11', '2022-04-07 13:12:49'),
(2, 'Bank Of India', '2342034920349', '239402', 'sdfsd@upd', 3, '2022-04-10 11:50:47', '2022-04-10 11:50:47');

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
(3, 1, 2000, 0, '2022-04-12 07:01:56', '2022-04-12 07:01:56');

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

--
-- Dumping data for table `organization_states`
--

INSERT INTO `organization_states` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Inactive', 'Inactive', NULL, NULL),
(2, 'Active', 'Active', NULL, NULL);

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
(30, 1000, '20220408111212800110168147903573198', 1, 1, '9_1649366904', 9, 'Paytm', '2022-04-07 15:58:24', '2022-04-07 15:58:49', NULL),
(31, 2090, '20220408111212800110168071103597700', 1, 1, '10_1649428991', 10, 'Paytm', '2022-04-08 09:13:11', '2022-04-08 09:13:38', NULL),
(32, 192, '20220409111212800110168869303580563', 1, 1, '11_1649447172', 11, 'Paytm', '2022-04-08 14:16:12', '2022-04-08 14:16:33', NULL),
(33, 12, NULL, 0, 1, '12_1649447298', 12, 'Paytm', '2022-04-08 14:18:18', '2022-04-08 14:18:18', NULL),
(34, 12, NULL, 0, 1, '12_1649447443', 12, 'Paytm', '2022-04-08 14:20:43', '2022-04-08 14:20:43', NULL),
(35, 12, NULL, 0, 1, '12_1649447584', 12, 'Paytm', '2022-04-08 14:23:04', '2022-04-08 14:23:04', NULL),
(36, 12, NULL, 0, 1, '12_1649447592', 12, 'Paytm', '2022-04-08 14:23:12', '2022-04-08 14:23:12', NULL),
(37, 12, NULL, 0, 1, '12_1649447719', 12, 'Paytm', '2022-04-08 14:25:19', '2022-04-08 14:25:19', NULL),
(38, 12, NULL, 0, 1, '12_1649447981', 12, 'Paytm', '2022-04-08 14:29:41', '2022-04-08 14:29:41', NULL),
(39, 12, NULL, 0, 1, '12_1649448059', 12, 'Paytm', '2022-04-08 14:30:59', '2022-04-08 14:30:59', NULL),
(40, 12, NULL, 0, 1, '12_1649448071', 12, 'Paytm', '2022-04-08 14:31:11', '2022-04-08 14:31:11', NULL),
(41, 12, '20220409111212800110168749803601531', 1, 1, '12_1649448093', 12, 'Paytm', '2022-04-08 14:31:33', '2022-04-08 14:32:30', NULL),
(42, 9012, '20220410111212800110168198903630171', 1, 1, '13_1649584241', 13, 'Paytm', '2022-04-10 04:20:41', '2022-04-10 04:20:57', NULL),
(43, 5000, NULL, 0, 1, '14_1649613291', 14, 'Paytm', '2022-04-10 12:24:51', '2022-04-10 12:24:51', NULL),
(44, 5000, '20220410111212800110168524303618528', 1, 1, '14_1649613336', 14, 'Paytm', '2022-04-10 12:25:36', '2022-04-10 12:25:45', NULL),
(45, 5000, '20220411111212800110168438203597399', 0, 1, '16_1649672152', 16, 'Paytm', '2022-04-11 04:45:53', '2022-04-11 04:46:11', NULL),
(46, 5000, '20220411111212800110168786503624592', 0, 1, '16_1649672175', 16, 'Paytm', '2022-04-11 04:46:15', '2022-04-11 04:46:21', NULL),
(47, 5000, '20220411111212800110168463903613472', 0, 1, '16_1649672186', 16, 'Paytm', '2022-04-11 04:46:26', '2022-04-11 04:46:35', NULL),
(48, 5000, '20220411111212800110168025205014271', 1, 1, '16_1649672216', 16, 'Paytm', '2022-04-11 04:46:56', '2022-04-11 04:47:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(2, 'browse_bread', NULL, '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(3, 'browse_database', NULL, '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(4, 'browse_media', NULL, '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(5, 'browse_compass', NULL, '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(6, 'browse_menus', 'menus', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(7, 'read_menus', 'menus', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(8, 'edit_menus', 'menus', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(9, 'add_menus', 'menus', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(10, 'delete_menus', 'menus', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(11, 'browse_roles', 'roles', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(12, 'read_roles', 'roles', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(13, 'edit_roles', 'roles', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(14, 'add_roles', 'roles', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(15, 'delete_roles', 'roles', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(16, 'browse_users', 'users', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(17, 'read_users', 'users', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(18, 'edit_users', 'users', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(19, 'add_users', 'users', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(20, 'delete_users', 'users', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(21, 'browse_settings', 'settings', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(22, 'read_settings', 'settings', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(23, 'edit_settings', 'settings', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(24, 'add_settings', 'settings', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(25, 'delete_settings', 'settings', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(26, 'browse_cities', 'cities', '2022-04-09 05:09:15', '2022-04-09 05:09:15'),
(27, 'read_cities', 'cities', '2022-04-09 05:09:15', '2022-04-09 05:09:15'),
(28, 'edit_cities', 'cities', '2022-04-09 05:09:15', '2022-04-09 05:09:15'),
(29, 'add_cities', 'cities', '2022-04-09 05:09:15', '2022-04-09 05:09:15'),
(30, 'delete_cities', 'cities', '2022-04-09 05:09:15', '2022-04-09 05:09:15'),
(31, 'browse_areas', 'areas', '2022-04-09 05:16:08', '2022-04-09 05:16:08'),
(32, 'read_areas', 'areas', '2022-04-09 05:16:08', '2022-04-09 05:16:08'),
(33, 'edit_areas', 'areas', '2022-04-09 05:16:08', '2022-04-09 05:16:08'),
(34, 'add_areas', 'areas', '2022-04-09 05:16:08', '2022-04-09 05:16:08'),
(35, 'delete_areas', 'areas', '2022-04-09 05:16:08', '2022-04-09 05:16:08'),
(36, 'browse_organization_states', 'organization_states', '2022-04-09 05:44:44', '2022-04-09 05:44:44'),
(37, 'read_organization_states', 'organization_states', '2022-04-09 05:44:44', '2022-04-09 05:44:44'),
(38, 'edit_organization_states', 'organization_states', '2022-04-09 05:44:44', '2022-04-09 05:44:44'),
(39, 'add_organization_states', 'organization_states', '2022-04-09 05:44:44', '2022-04-09 05:44:44'),
(40, 'delete_organization_states', 'organization_states', '2022-04-09 05:44:44', '2022-04-09 05:44:44'),
(41, 'browse_documents', 'documents', '2022-04-09 05:54:20', '2022-04-09 05:54:20'),
(42, 'read_documents', 'documents', '2022-04-09 05:54:20', '2022-04-09 05:54:20'),
(43, 'edit_documents', 'documents', '2022-04-09 05:54:20', '2022-04-09 05:54:20'),
(44, 'add_documents', 'documents', '2022-04-09 05:54:20', '2022-04-09 05:54:20'),
(45, 'delete_documents', 'documents', '2022-04-09 05:54:20', '2022-04-09 05:54:20'),
(46, 'browse_organizations', 'organizations', '2022-04-09 14:02:08', '2022-04-09 14:02:08'),
(47, 'read_organizations', 'organizations', '2022-04-09 14:02:08', '2022-04-09 14:02:08'),
(48, 'edit_organizations', 'organizations', '2022-04-09 14:02:08', '2022-04-09 14:02:08'),
(49, 'add_organizations', 'organizations', '2022-04-09 14:02:08', '2022-04-09 14:02:08'),
(50, 'delete_organizations', 'organizations', '2022-04-09 14:02:08', '2022-04-09 14:02:08'),
(51, 'browse_user_states', 'user_states', '2022-04-09 14:12:52', '2022-04-09 14:12:52'),
(52, 'read_user_states', 'user_states', '2022-04-09 14:12:52', '2022-04-09 14:12:52'),
(53, 'edit_user_states', 'user_states', '2022-04-09 14:12:52', '2022-04-09 14:12:52'),
(54, 'add_user_states', 'user_states', '2022-04-09 14:12:52', '2022-04-09 14:12:52'),
(55, 'delete_user_states', 'user_states', '2022-04-09 14:12:52', '2022-04-09 14:12:52'),
(56, 'browse_organization_payment_information', 'organization_payment_information', '2022-04-09 14:21:04', '2022-04-09 14:21:04'),
(57, 'read_organization_payment_information', 'organization_payment_information', '2022-04-09 14:21:04', '2022-04-09 14:21:04'),
(58, 'edit_organization_payment_information', 'organization_payment_information', '2022-04-09 14:21:04', '2022-04-09 14:21:04'),
(59, 'add_organization_payment_information', 'organization_payment_information', '2022-04-09 14:21:04', '2022-04-09 14:21:04'),
(60, 'delete_organization_payment_information', 'organization_payment_information', '2022-04-09 14:21:04', '2022-04-09 14:21:04'),
(61, 'browse_organization_roles', 'organization_roles', '2022-04-09 14:26:05', '2022-04-09 14:26:05'),
(62, 'read_organization_roles', 'organization_roles', '2022-04-09 14:26:05', '2022-04-09 14:26:05'),
(63, 'edit_organization_roles', 'organization_roles', '2022-04-09 14:26:05', '2022-04-09 14:26:05'),
(64, 'add_organization_roles', 'organization_roles', '2022-04-09 14:26:05', '2022-04-09 14:26:05'),
(65, 'delete_organization_roles', 'organization_roles', '2022-04-09 14:26:05', '2022-04-09 14:26:05'),
(66, 'browse_organization_payouts', 'organization_payouts', '2022-04-09 14:27:06', '2022-04-09 14:27:06'),
(67, 'read_organization_payouts', 'organization_payouts', '2022-04-09 14:27:06', '2022-04-09 14:27:06'),
(68, 'edit_organization_payouts', 'organization_payouts', '2022-04-09 14:27:06', '2022-04-09 14:27:06'),
(69, 'add_organization_payouts', 'organization_payouts', '2022-04-09 14:27:06', '2022-04-09 14:27:06'),
(70, 'delete_organization_payouts', 'organization_payouts', '2022-04-09 14:27:06', '2022-04-09 14:27:06'),
(71, 'browse_user_organization_memberships', 'user_organization_memberships', '2022-04-09 15:00:16', '2022-04-09 15:00:16'),
(72, 'read_user_organization_memberships', 'user_organization_memberships', '2022-04-09 15:00:16', '2022-04-09 15:00:16'),
(73, 'edit_user_organization_memberships', 'user_organization_memberships', '2022-04-09 15:00:16', '2022-04-09 15:00:16'),
(74, 'add_user_organization_memberships', 'user_organization_memberships', '2022-04-09 15:00:16', '2022-04-09 15:00:16'),
(75, 'delete_user_organization_memberships', 'user_organization_memberships', '2022-04-09 15:00:16', '2022-04-09 15:00:16'),
(76, 'browse_user_organization_membership_roles', 'user_organization_membership_roles', '2022-04-09 15:03:57', '2022-04-09 15:03:57'),
(77, 'read_user_organization_membership_roles', 'user_organization_membership_roles', '2022-04-09 15:03:57', '2022-04-09 15:03:57'),
(78, 'edit_user_organization_membership_roles', 'user_organization_membership_roles', '2022-04-09 15:03:57', '2022-04-09 15:03:57'),
(79, 'add_user_organization_membership_roles', 'user_organization_membership_roles', '2022-04-09 15:03:57', '2022-04-09 15:03:57'),
(80, 'delete_user_organization_membership_roles', 'user_organization_membership_roles', '2022-04-09 15:03:57', '2022-04-09 15:03:57'),
(81, 'browse_price_types', 'price_types', '2022-04-09 15:17:21', '2022-04-09 15:17:21'),
(82, 'read_price_types', 'price_types', '2022-04-09 15:17:21', '2022-04-09 15:17:21'),
(83, 'edit_price_types', 'price_types', '2022-04-09 15:17:21', '2022-04-09 15:17:21'),
(84, 'add_price_types', 'price_types', '2022-04-09 15:17:21', '2022-04-09 15:17:21'),
(85, 'delete_price_types', 'price_types', '2022-04-09 15:17:21', '2022-04-09 15:17:21'),
(86, 'browse_service_categories', 'service_categories', '2022-04-09 15:21:49', '2022-04-09 15:21:49'),
(87, 'read_service_categories', 'service_categories', '2022-04-09 15:21:49', '2022-04-09 15:21:49'),
(88, 'edit_service_categories', 'service_categories', '2022-04-09 15:21:49', '2022-04-09 15:21:49'),
(89, 'add_service_categories', 'service_categories', '2022-04-09 15:21:49', '2022-04-09 15:21:49'),
(90, 'delete_service_categories', 'service_categories', '2022-04-09 15:21:49', '2022-04-09 15:21:49'),
(91, 'browse_service_area_availablities', 'service_area_availablities', '2022-04-09 15:24:45', '2022-04-09 15:24:45'),
(92, 'read_service_area_availablities', 'service_area_availablities', '2022-04-09 15:24:45', '2022-04-09 15:24:45'),
(93, 'edit_service_area_availablities', 'service_area_availablities', '2022-04-09 15:24:45', '2022-04-09 15:24:45'),
(94, 'add_service_area_availablities', 'service_area_availablities', '2022-04-09 15:24:45', '2022-04-09 15:24:45'),
(95, 'delete_service_area_availablities', 'service_area_availablities', '2022-04-09 15:24:45', '2022-04-09 15:24:45'),
(96, 'browse_services', 'services', '2022-04-09 15:26:21', '2022-04-09 15:26:21'),
(97, 'read_services', 'services', '2022-04-09 15:26:21', '2022-04-09 15:26:21'),
(98, 'edit_services', 'services', '2022-04-09 15:26:21', '2022-04-09 15:26:21'),
(99, 'add_services', 'services', '2022-04-09 15:26:21', '2022-04-09 15:26:21'),
(100, 'delete_services', 'services', '2022-04-09 15:26:21', '2022-04-09 15:26:21'),
(101, 'browse_order_states', 'order_states', '2022-04-10 03:41:13', '2022-04-10 03:41:13'),
(102, 'read_order_states', 'order_states', '2022-04-10 03:41:13', '2022-04-10 03:41:13'),
(103, 'edit_order_states', 'order_states', '2022-04-10 03:41:13', '2022-04-10 03:41:13'),
(104, 'add_order_states', 'order_states', '2022-04-10 03:41:13', '2022-04-10 03:41:13'),
(105, 'delete_order_states', 'order_states', '2022-04-10 03:41:13', '2022-04-10 03:41:13'),
(106, 'browse_service_orders', 'service_orders', '2022-04-10 03:41:58', '2022-04-10 03:41:58'),
(107, 'read_service_orders', 'service_orders', '2022-04-10 03:41:58', '2022-04-10 03:41:58'),
(108, 'edit_service_orders', 'service_orders', '2022-04-10 03:41:58', '2022-04-10 03:41:58'),
(109, 'add_service_orders', 'service_orders', '2022-04-10 03:41:58', '2022-04-10 03:41:58'),
(110, 'delete_service_orders', 'service_orders', '2022-04-10 03:41:58', '2022-04-10 03:41:58'),
(111, 'browse_order_member_states', 'order_member_states', '2022-04-10 03:55:35', '2022-04-10 03:55:35'),
(112, 'read_order_member_states', 'order_member_states', '2022-04-10 03:55:35', '2022-04-10 03:55:35'),
(113, 'edit_order_member_states', 'order_member_states', '2022-04-10 03:55:35', '2022-04-10 03:55:35'),
(114, 'add_order_member_states', 'order_member_states', '2022-04-10 03:55:35', '2022-04-10 03:55:35'),
(115, 'delete_order_member_states', 'order_member_states', '2022-04-10 03:55:35', '2022-04-10 03:55:35'),
(116, 'browse_order_members', 'order_members', '2022-04-10 03:56:14', '2022-04-10 03:56:14'),
(117, 'read_order_members', 'order_members', '2022-04-10 03:56:14', '2022-04-10 03:56:14'),
(118, 'edit_order_members', 'order_members', '2022-04-10 03:56:14', '2022-04-10 03:56:14'),
(119, 'add_order_members', 'order_members', '2022-04-10 03:56:14', '2022-04-10 03:56:14'),
(120, 'delete_order_members', 'order_members', '2022-04-10 03:56:14', '2022-04-10 03:56:14'),
(121, 'browse_invoices', 'invoices', '2022-04-10 04:06:39', '2022-04-10 04:06:39'),
(122, 'read_invoices', 'invoices', '2022-04-10 04:06:39', '2022-04-10 04:06:39'),
(123, 'edit_invoices', 'invoices', '2022-04-10 04:06:39', '2022-04-10 04:06:39'),
(124, 'add_invoices', 'invoices', '2022-04-10 04:06:39', '2022-04-10 04:06:39'),
(125, 'delete_invoices', 'invoices', '2022-04-10 04:06:39', '2022-04-10 04:06:39'),
(126, 'browse_invoice_states', 'invoice_states', '2022-04-10 04:08:05', '2022-04-10 04:08:05'),
(127, 'read_invoice_states', 'invoice_states', '2022-04-10 04:08:05', '2022-04-10 04:08:05'),
(128, 'edit_invoice_states', 'invoice_states', '2022-04-10 04:08:05', '2022-04-10 04:08:05'),
(129, 'add_invoice_states', 'invoice_states', '2022-04-10 04:08:05', '2022-04-10 04:08:05'),
(130, 'delete_invoice_states', 'invoice_states', '2022-04-10 04:08:05', '2022-04-10 04:08:05'),
(131, 'browse_payments', 'payments', '2022-04-10 04:16:27', '2022-04-10 04:16:27'),
(132, 'read_payments', 'payments', '2022-04-10 04:16:27', '2022-04-10 04:16:27'),
(133, 'edit_payments', 'payments', '2022-04-10 04:16:27', '2022-04-10 04:16:27'),
(134, 'add_payments', 'payments', '2022-04-10 04:16:27', '2022-04-10 04:16:27'),
(135, 'delete_payments', 'payments', '2022-04-10 04:16:27', '2022-04-10 04:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(56, 3),
(57, 1),
(57, 3),
(58, 1),
(58, 3),
(59, 1),
(59, 3),
(60, 1),
(61, 1),
(61, 3),
(62, 1),
(62, 3),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(66, 3),
(67, 1),
(67, 3),
(68, 1),
(68, 3),
(69, 1),
(69, 3),
(70, 1),
(70, 3),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1);

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
(13, 'Cancelled: By User', 4, 'App\\Models\\ServiceOrder', '2022-04-06 04:14:00', '2022-04-06 04:14:00', NULL),
(14, 'Cancelled: By User', 15, 'App\\Models\\ServiceOrder', '2022-04-10 12:12:24', '2022-04-10 12:12:24', NULL),
(15, 'Rejected: Out of service area', 13, 'App\\Models\\ServiceOrder', '2022-04-10 12:17:43', '2022-04-10 12:17:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(2, 'user', 'Normal User', '2022-04-09 04:58:31', '2022-04-09 04:58:31'),
(3, 'accountmanager', 'Account Manager', '2022-04-10 12:28:49', '2022-04-10 12:28:49');

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
(49, 'First Service', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, ipsam. Sint, neque. Asperiores provident\r\n            mollitia hic fuga, ex blanditiis, quisquam, fugit architecto modi necessitatibus nihil. Nihil dolorum velit\r\n            facere, temporibus, error adipisci quas omnis voluptates, placeat consequuntur distinctio culpa deleniti\r\n            quaerat. Dolore pariatur cum deserunt voluptatem. Sapiente beatae ea inventore repellat repudiandae amet magnam\r\n            nobis rem mollitia obcaecati, commodi delectus recusandae facilis rerum eaque aliquam vero ipsum expedita,\r\n            consequuntur at dolorem, minima explicabo modi accusamus! Fugiat, dolor. Aspernatur omnis reiciendis in, ullam\r\n            dicta ut officia, voluptates asperiores adipisci inventore quia beatae aliquid? Porro maiores fugiat excepturi\r\n            inventore quo debitis vero laborum repellendus, reprehenderit numquam cum accusamus, aliquam illum velit tempore\r\n            similique accusantium eveniet quia nihil, beatae minima. Tenetur, neque ut aliquid veniam expedita doloremque\r\n            sapiente pariatur libero delectus eius saepe nostrum reiciendis sint quo quas dignissimos dolore modi sed\r\n            consequuntur nisi quis quibusdam sit corrupti. Sapiente repudiandae in aliquam recusandae sed minima, eligendi\r\n            illum illo nobis qui quo. Iusto velit soluta eos voluptatibus voluptas, debitis quia ab, nemo similique quam\r\n            praesentium dolorem quasi doloremque vel nesciunt! Omnis eligendi molestiae non odio, error explicabo magni a\r\n            architecto voluptate eveniet necessitatibus quos dolor, labore cum laborum tempore nulla? Quia fugit numquam\r\n            inventore, earum ipsam facere! Repellendus necessitatibus aliquid molestiae et nulla facere voluptate ratione\r\n            dolores, enim voluptas corporis nesciunt vel consequuntur earum nihil provident excepturi reprehenderit, unde\r\n            quam at distinctio magnam veniam velit. Non aspernatur corrupti deleniti cumque incidunt et numquam sequi\r\n            pariatur animi sint libero delectus quas, voluptates dolorum quasi voluptate suscipit qui similique temporibus\r\n            veniam. Iusto debitis sint quasi quis esse quam, laboriosam eligendi, quas iste non cumque architecto\r\n            necessitatibus cupiditate suscipit illo praesentium voluptatem sapiente, consequatur deserunt! Nam eveniet\r\n            laboriosam quidem ipsum odit quas. Optio reprehenderit aliquid ab mollitia beatae tempore similique, delectus\r\n            molestiae porro repellat quia quaerat sit obcaecati consequuntur illum ipsam libero. Animi molestias odio odit\r\n            hic. Alias nulla expedita perferendis corporis facere quidem recusandae laboriosam blanditiis quam accusantium\r\n            veritatis fugit mollitia sequi reprehenderit, ipsa sunt natus ducimus? Velit quis soluta tempora doloribus?\r\n            Praesentium ipsa adipisci temporibus repellendus, similique odio sit, tenetur, culpa nostrum pariatur deserunt\r\n            dolore quia provident. Illo eveniet iusto maxime dignissimos expedita, saepe vitae dolore, repellendus beatae\r\n            nesciunt hic ullam perspiciatis ut obcaecati id quasi, dolorum delectus ipsa laboriosam asperiores. Distinctio\r\n            exercitationem, officia facere nulla voluptates, sint iusto perferendis consequatur culpa tempora ex eaque\r\n            veritatis repudiandae hic dolorem accusamus. Ipsam vitae velit porro corrupti mollitia eum perspiciatis? Eaque\r\n            perspiciatis temporibus est adipisci totam excepturi recusandae hic reprehenderit velit iste accusantium\r\n            voluptates debitis itaque id dolorum quis, modi quibusdam et. Alias aliquam repellat, dolor animi facilis fugiat\r\n            modi corrupti culpa eos eum in, veniam quos, ex est architecto sunt commodi ut nihil dignissimos dolores. Quidem\r\n            ut iusto corrupti veritatis quasi placeat odio assumenda omnis cupiditate qui, nihil iure tempora at, maxime\r\n            provident sit praesentium tempore! Quia ea ad exercitationem illo veritatis ipsam alias modi voluptate\r\n            voluptatibus soluta, nulla tempore! Nulla a in sint maxime ad ipsam fugiat vero aspernatur perspiciatis\r\n            possimus. Fugit sapiente iste quod.', 0, 6, 1, 1, '2022-03-31 06:27:43', '2022-04-08 14:46:23', NULL),
(50, 'Second Service', 'Second Service', 0, 6, 1, 4, '2022-03-31 06:28:28', '2022-04-08 14:47:05', NULL),
(51, 'Third Servive', 'Third Service', 9012, 3, 1, 7, '2022-03-31 06:29:19', '2022-04-08 14:47:10', NULL),
(52, 'Escort', 'Expert and nice', 2000, 2, 2, 5, '2022-04-01 06:25:40', '2022-04-01 06:25:40', NULL),
(53, 'Paint Job', 'Paints your house', 100000, 1, 2, 2, '2022-04-01 06:40:18', '2022-04-01 06:40:18', NULL),
(54, 'Cleaning JOb', 'want your home neat and clean ?', 3000, 4, 2, 5, '2022-04-01 06:41:16', '2022-04-01 06:41:16', NULL),
(55, 'Food', 'having troubles with your wife not making any food ?', 5000, 4, 2, 5, '2022-04-01 06:42:07', '2022-04-01 06:42:07', NULL),
(56, 'Expert Electrician', 'Is your switch giving you shocks ? try our men', 5000, 1, 2, 4, '2022-04-01 06:43:49', '2022-04-01 06:43:49', NULL),
(57, 'Fast Carpenter', 'Want to impress your guests with your tables ?', 3000, 2, 2, 3, '2022-04-01 06:45:20', '2022-04-01 06:45:20', NULL),
(58, 'Fourth Service', 'Fourth Service', 0, 6, 1, 1, '2022-04-01 06:51:05', '2022-04-08 14:47:15', '2022-04-08 14:47:15'),
(59, 'Fifth Service', 'Fifth Service', 12, 2, 1, 5, '2022-04-01 06:51:49', '2022-04-08 14:47:20', '2022-04-08 14:47:20'),
(60, 'Sixth Service', 'Sixth Service', 5700, 4, 1, 2, '2022-04-01 06:52:55', '2022-04-08 14:47:25', '2022-04-08 14:47:25'),
(61, 'Cleaning', 'Cleaning Nice CLeaning', 5000, 4, 3, 5, '2022-04-10 11:52:49', '2022-04-10 11:52:49', NULL);

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
(28, 49, 4, '2022-04-06 01:45:21', '2022-04-06 01:45:21', NULL),
(40, 61, 3, '2022-04-10 12:16:39', '2022-04-10 12:16:39', NULL),
(41, 61, 1, '2022-04-10 12:16:39', '2022-04-10 12:16:39', NULL),
(42, 61, 2, '2022-04-10 12:16:40', '2022-04-10 12:16:40', NULL),
(43, 61, 4, '2022-04-10 12:16:40', '2022-04-10 12:16:40', NULL);

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
(10, 1, 49, 2, NULL, '2022-04-06 04:36:45', '2022-04-06 05:11:55', NULL),
(11, 1, 57, 1, NULL, '2022-04-08 14:56:45', '2022-04-08 14:56:45', NULL),
(12, 1, 57, 1, NULL, '2022-04-10 12:10:17', '2022-04-10 12:10:17', NULL),
(13, 1, 61, 4, NULL, '2022-04-10 12:10:40', '2022-04-10 12:17:43', NULL),
(14, 1, 61, 6, NULL, '2022-04-10 12:10:56', '2022-04-10 13:20:49', NULL),
(15, 1, 61, 3, NULL, '2022-04-10 12:11:00', '2022-04-10 12:12:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Service Adept', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'We Rise by Lifting Others', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', 'settings\\April2022\\xujqf6pw9yop44KmI6Fj.png', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', 'settings\\April2022\\JDfcJzQSbCDL87XCCEip.jpg', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Admin -  Service Adept', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Hard working place.', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', 'settings\\April2022\\chPJ1At9oLmaylo8LArS.png', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_state_id` bigint(20) NOT NULL,
  `area_id` bigint(20) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `phone_number`, `address`, `user_state_id`, `area_id`, `remember_token`, `settings`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Jimmy Kumar Ahalpara 123', 'jimmyahalpara123@gmail.com', 'users/default.png', '2022-04-03 04:33:59', '$2y$10$vlOZlkFRHRb77YQcCHhvEuCFGsSnFBib0M7xJXji2YPBWBdDld6..', '9090909090', 'bhavnagar', 1, 6, 'q6bzfjMc08q1dZCBw6rKH503dsw7REor6rPmlqcq3NzJks42yf6VdGJk4Svo', NULL, '2022-04-03 04:33:36', '2022-04-09 04:59:06', NULL),
(2, NULL, 'Jimmy 5 ahalpara', 'jahalpara5@gmail.com', 'users/default.png', '2022-04-03 04:40:00', '$2y$10$0DILSA1qhmJivY0mpTzj1uCdTCLJGxj788YsGbhhVg67hIxKmoGkW', '9090909090', 'Bhavnagar', 1, 5, NULL, '{\"locale\":\"en\"}', '2022-04-03 04:39:38', '2022-04-09 05:32:05', NULL),
(4, NULL, 'Jimmy tridhya', 'jimmyatridhyatech@gmail.com', 'users/default.png', '2022-04-05 06:56:44', '$2y$10$Pgn5kA5BT3Ft0lCTPqoKuu3aJmR5DqvXerTXFWug78Ab64K1KY/sC', '9090909090', 'Rajkot', 1, 3, NULL, NULL, '2022-04-05 06:56:12', '2022-04-05 06:56:44', NULL),
(5, 2, 'Dhruval Bhuva', 'dhruvalbhuva2000@gmail.com', 'users/default.png', '2022-04-10 11:45:37', '$2y$10$qiqlautVtVh6OuBS0NH9zOXOjUfNIH5gCZV2XF1YQCbJVkYVmCSBW', '9090909090', 'Rajkot', 1, 1, 'BAikFiCT1QRxexdpRF1cCGDMEKAOKBitIzQaFb7kBAxSUv2zPFZ8Xy0P6icQ', NULL, '2022-04-10 11:44:11', '2022-04-10 11:45:37', NULL),
(6, 2, 'Jimmy', 'jimmyahalpara@gmail.com', 'users/default.png', '2022-04-10 11:57:04', '$2y$10$Hp93MR/62jXTZx27Zn1P1ehbkkGkOstaNlOUN/31LBFyan6bb23fy', '9090909090', 'dflshdf sldf sfdsd fsdf', 1, 2, '0rlPubrJX5Hiwc6JZ2fxwG3YqcIgQlXkKB8EeB0IY2iVl73t5iwASxVSvj2f', NULL, '2022-04-10 11:55:21', '2022-04-10 11:57:04', NULL),
(7, 2, 'Another User', 'another@gmail.com', 'users/default.png', '2022-04-11 04:54:42', '$2y$10$eFIfMiQFObmh/TPd/ipqvev4BtPsm3zLWd0Y/g0czBu5E2ChPr5S6', '9090909090', 'another socity, rajkot', 1, 3, 'QlZdRTxVH4RUp6mSn6GrUGgAtingf2TpaeqcHjFhqEI9BXVs8yW2EMpdTTDn', NULL, '2022-04-11 04:54:27', '2022-04-11 04:54:42', NULL);

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
(3, 4, 1, '2022-04-05 06:56:12', '2022-04-05 06:56:12', NULL),
(4, 5, 3, '2022-04-10 11:46:08', '2022-04-10 11:46:08', NULL),
(5, 6, 3, '2022-04-10 11:55:26', '2022-04-10 11:55:26', NULL),
(6, 7, 4, '2022-04-11 04:55:06', '2022-04-11 23:39:33', '2022-04-11 23:39:33'),
(7, 7, 5, '2022-04-11 23:40:54', '2022-04-11 23:40:54', NULL);

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
(3, 3, 3, '2022-04-05 06:56:12', '2022-04-05 06:56:12', NULL),
(4, 1, 4, '2022-04-10 11:46:08', '2022-04-10 11:46:08', NULL),
(5, 3, 5, '2022-04-10 11:55:26', '2022-04-10 12:21:55', NULL),
(6, 1, 6, '2022-04-11 04:55:06', '2022-04-11 23:39:33', '2022-04-11 23:39:33'),
(7, 1, 7, '2022-04-11 23:40:54', '2022-04-11 23:40:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(2, 2),
(2, 3);

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
(2, 1, 49, 'Great Service', 5, '2022-04-03 15:48:40', '2022-04-03 15:48:40', NULL),
(3, 1, 57, 'y not available in my area ?', 3, '2022-04-10 12:03:03', '2022-04-10 12:03:03', NULL),
(4, 1, 57, 'y not available in my area ?', 3, '2022-04-10 12:03:03', '2022-04-10 12:03:03', NULL),
(5, 1, 57, 'y not available in my area ?', 1, '2022-04-10 12:03:03', '2022-04-10 12:03:03', NULL),
(6, 1, 57, 'y not available in my area ?', 3, '2022-04-10 12:03:03', '2022-04-10 12:03:03', NULL),
(7, 1, 52, 'why not available ?', 4, '2022-04-03 04:45:19', '2022-04-03 04:45:19', NULL),
(8, 1, 49, 'Great Service', 5, '2022-04-03 15:48:40', '2022-04-03 15:48:40', NULL),
(9, 1, 57, 'y not available in my area ?', 2, '2022-04-10 12:03:03', '2022-04-10 12:03:03', NULL),
(10, 1, 57, 'y not available in my area ?', 3, '2022-04-10 12:03:03', '2022-04-10 12:03:03', NULL),
(11, 1, 57, 'y not available in my area ?', 3, '2022-04-10 12:03:03', '2022-04-10 12:03:03', NULL),
(12, 1, 57, 'y not available in my area ?', 2, '2022-04-10 12:03:03', '2022-04-10 12:03:03', NULL);

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
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

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
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

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
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `invoice_states`
--
ALTER TABLE `invoice_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `order_members`
--
ALTER TABLE `order_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_member_states`
--
ALTER TABLE `order_member_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `organization_payment_information`
--
ALTER TABLE `organization_payment_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organization_payouts`
--
ALTER TABLE `organization_payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organization_roles`
--
ALTER TABLE `organization_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organization_states`
--
ALTER TABLE `organization_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `service_area_availablities`
--
ALTER TABLE `service_area_availablities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_orders`
--
ALTER TABLE `service_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_organization_memberships`
--
ALTER TABLE `user_organization_memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_organization_membership_roles`
--
ALTER TABLE `user_organization_membership_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_service_likes`
--
ALTER TABLE `user_service_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_service_ratings`
--
ALTER TABLE `user_service_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_states`
--
ALTER TABLE `user_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
