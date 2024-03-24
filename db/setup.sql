-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 07:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `setup`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `parent_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `descriptions` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `client_id`, `name`, `code`, `type_id`, `parent_account_id`, `descriptions`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'Gloabl FPO', 'GFPO2024', 1, 2, 'this is test descriptions', 0, '2024-02-09 07:18:56', '2024-02-09 07:18:56'),
(2, 0, 'Gloabl FPO', 'GFPO20245', 1, 2, 'this is test descriptions', 0, '2024-02-09 08:37:19', '2024-02-09 08:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `industry_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Account Name',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `identification_no` varchar(255) DEFAULT NULL COMMENT 'Account No, Random Generated\r\n',
  `account_currency` int(11) DEFAULT NULL,
  `descriptions` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`id`, `customer_id`, `industry_id`, `name`, `parent_id`, `identification_no`, `account_currency`, `descriptions`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'Assets', 0, '101', NULL, 'test', 215, 0, '2024-02-08 14:04:58', '2024-02-08 14:04:58'),
(2, 0, 0, 'Liabilities', 0, '102', NULL, 'test', 215, 0, '2024-02-08 14:04:58', '2024-02-08 14:04:58'),
(3, 0, 0, 'Equity', 0, '103', NULL, 'test', 215, 0, '2024-02-08 14:07:46', '2024-02-08 14:07:46'),
(4, 0, 0, 'Income', 0, '104', NULL, 'test', 215, 0, '2024-02-08 14:07:46', '2024-02-08 14:07:46'),
(5, 0, 0, 'Current Assets', 1, '101.1', NULL, 'test', 215, 0, '2024-02-08 14:08:56', '2024-02-08 14:08:56'),
(6, 0, 0, 'Fixed Assets', 1, '102.1', NULL, 'test', 215, 0, '2024-02-08 14:08:56', '2024-02-08 14:08:56'),
(7, 0, 0, 'Intangible Assets', 1, '101.3', NULL, 'test', 215, 0, '2024-02-08 14:09:58', '2024-02-08 14:09:58'),
(8, 0, 0, 'Current Liabilities', 2, NULL, NULL, NULL, 215, 0, NULL, NULL),
(12, 0, 0, 'test', 3, NULL, NULL, NULL, NULL, 0, '2024-02-09 08:48:41', '2024-02-09 08:48:41'),
(13, 0, 0, 'Cash on Hand', 1, 'GFPO-31', 2, 'this is test', 0, 0, '2024-02-12 04:07:29', '2024-02-14 02:12:25'),
(18, 1, 1, 'Assets1', 0, '101', NULL, 'test', 215, 0, '2024-02-08 08:34:58', '2024-02-08 08:34:58'),
(19, 1, 1, 'Liabilities1', 0, '102', NULL, 'test', 215, 0, '2024-02-08 08:34:58', '2024-02-08 08:34:58'),
(20, 1, 1, 'Equity1', 0, '103', NULL, 'test', 215, 0, '2024-02-08 08:37:46', '2024-02-08 08:37:46'),
(21, 1, 1, 'Income1', 5, '104', NULL, 'test', 215, 0, '2024-02-08 08:37:46', '2024-02-08 08:37:46'),
(22, 1, 1, 'Current Assets1', 1, '101.1', NULL, 'test', 215, 0, '2024-02-08 08:38:56', '2024-02-08 08:38:56'),
(23, 1, 1, 'Fixed Assets1', 1, '102.1', NULL, 'test', 215, 0, '2024-02-08 08:38:56', '2024-02-08 08:38:56'),
(24, 1, 1, 'Intangible Assets1', 1, '101.3', NULL, 'test', 215, 0, '2024-02-08 08:39:58', '2024-02-08 08:39:58'),
(25, 1, 1, 'Current Liabilities1', 21, NULL, NULL, NULL, 215, 0, NULL, NULL),
(27, 1, 1, 'Cash on Hand1', 1, 'GFPO-31', 2, 'this is test', 0, 0, '2024-02-11 22:37:29', '2024-02-13 20:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer`, `first_name`, `last_name`, `email`, `phone_no`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Global FPO', 'Hari', 'Yadav', 'hdyadav@globalfpo.com', '9572284955', 0, '2024-02-13 01:54:52', '2024-02-13 01:54:52'),
(2, 'Global FPO', 'Hari', 'Yadav', 'hdyadav@globalfpo.com', '9572284955', 0, '2024-02-13 01:55:36', '2024-02-13 01:55:36'),
(3, 'Global FPO', 'Hari', 'Yadav', 'hdyadav@globalfpo.com', '9572284955', 4, '2024-02-13 01:57:13', '2024-02-13 01:57:13'),
(4, 'Global FPO', 'Hari', 'Yadav', 'hdyadav@globalfpo.com', '9572284955', 4, '2024-02-13 01:57:25', '2024-02-13 01:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_09_25_110243_create_permission_tables', 1),
(11, '2023_10_11_064349_create_user_otps_table', 1),
(12, '2024_02_08_134637_create_chart_of_accounts_table', 2),
(13, '2024_02_09_112156_create_accounts_table', 3),
(14, '2023_10_26_121204_create_tasks_table', 4),
(15, '2024_02_12_140833_create_vendors_table', 4),
(16, '2024_02_13_070312_create_customers_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0062bea4d285a07d64e30dce362e21d1273417d7f69a7db2e4408fb8700faf9866609704a885f204', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 03:28:40', '2024-02-13 03:28:40', '2025-02-13 08:58:40'),
('00af66090aa8c0e8337b036bd237a86c5096a56b3cd0d18737207571b9b7b5629416efced292e2ad', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:25:16', '2024-02-13 06:25:16', '2025-02-13 11:55:16'),
('01af36baa612f7a0c201beff2636d551ec1bcd4c8ce606de0ce2a5a1c75ee650400df2a2a320426e', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:19:42', '2024-02-13 05:19:42', '2025-02-13 10:49:42'),
('0300d21614183012b47f46953976f2f156af2c4de66d50ec17829ad6eb5e70f81132121d7d5a47da', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 08:01:05', '2024-02-13 08:01:09', '2024-02-13 13:31:09'),
('041670de847f616d8fdd0be82136c6797d323e8af52d68f194cfdda9759e1b763d2c4283f02fd6ec', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:18:31', '2024-02-13 05:18:31', '2025-02-13 10:48:31'),
('0566697bbb93e8d83cfd80a7c540e3230c393a2983c600121e3b93e0f95ebf11619bf00434308423', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:20:56', '2024-02-13 05:20:56', '2025-02-13 10:50:56'),
('065fcbd717b4fc847b2677616a148cec208ac85407bccbef304b0ccf92b17425f204bcc52aaa1255', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:32:27', '2024-02-28 01:33:50', '2024-02-28 07:03:50'),
('07e770b668b4631554459a03cf4152e4e7ab8eb1ef49193dfab0758202df74a5a1215e56ce552ca4', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:01:14', '2024-02-13 06:01:14', '2025-02-13 11:31:14'),
('0891632da2c389000a1284b8de0dbcf245226c7538f45f723c4f2500866c8c33b9c8617cfdaab66b', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 03:33:01', '2024-02-13 03:33:01', '2025-02-13 09:03:01'),
('0f0e17ece10c9fcaa687e65b6ffa1c6989de87021ff7fb1724de496fce127d59760a89cadd47aa85', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:32:19', '2024-02-14 01:33:05', '2024-02-14 07:03:05'),
('1489226ebc7c0633895231a18b68e28004c2b77c945bf637e75cd90f6d428d928a25c2d8349c8d22', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 07:55:56', '2024-02-13 07:56:42', '2024-02-13 13:26:42'),
('17d0d0f5c3abe828e163eadc8206bf04d6461a2dcd2859fa7f9fb93d28d290c5e95098b5949877ab', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:35:29', '2024-02-28 01:35:31', '2024-02-28 07:05:31'),
('18dbe41a67691645c45ec493e779e532b043ebf89258289c8d4f8c44eb6b4cf8e4bdd47127221e1a', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:04:34', '2024-02-13 06:04:34', '2025-02-13 11:34:34'),
('18df2b135027e6ae12791b9123d59bf478625efe3ad97bcf7e225bcb37b879acf3dd2fb6179e287e', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:20:32', '2024-02-13 05:20:32', '2025-02-13 10:50:32'),
('19d8fab6544069897966eabbe610691060589fd2aca1d10277adef935adb2eb1c066ad9219c06c2f', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:18:07', '2024-02-13 05:18:07', '2025-02-13 10:48:07'),
('1a4f302fdfc8d2011a179ea0f3289464f6831b510773f7214932f105392ae8832f0c16fb74bb4772', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 01:14:47', '2024-02-14 01:14:48', '2025-02-14 06:44:47'),
('1c547078c2a3e51bee48548374143e44b1741d65a520cdb37dc7a3cc0acb820050375deec11a49e1', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:36:19', '2024-02-14 01:37:14', '2024-02-14 07:07:14'),
('1ca946b6504f52f18983cb8f04ad9098f275040f7eb4ad33e56cb607a7247ef8fc624c91951fe8f9', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 05:52:10', '2024-02-14 05:52:10', '2025-02-14 11:22:10'),
('1d023351493f9fdad863e5b6fd16a7ef5777fe099a3ba3b1a308eab2bb8b886a75975be17185719a', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-09 05:44:09', '2024-02-12 02:12:46', '2024-02-12 07:42:46'),
('1d574c631da4394d64209e9630433ccc962b68d3033672941d11f4d07e71d6a92509e3fc86fae080', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-27 02:19:50', '2024-02-27 02:19:50', '2025-02-27 07:49:50'),
('1ea448e4fad8d160514434bf7a9ad05f004503037f1796bcb82fea406c26d571089eba22fa48b075', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 06:01:56', '2024-02-14 06:01:56', '2025-02-14 11:31:56'),
('1fdc027a18f05236773d35eb14e5e64c18038ac39b7b8db14733cec86b98be3574e6102977fe57ef', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 07:58:21', '2024-02-13 07:58:23', '2024-02-13 13:28:23'),
('2006a2faec7957e280bd8839873697bf6f36f717ccc558d70ae4ebe9f2f00d83b617acd50c124df7', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:39:56', '2024-02-13 06:39:56', '2025-02-13 12:09:56'),
('20df90a9b1a6e0affcd46be4dfa9ecf1717ebe891d47e1a51ddf472acca7c39a76e4d61bf136091d', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:25:52', '2024-02-13 06:25:52', '2025-02-13 11:55:52'),
('217608f39133baa16d75419fa6c3316bc901f3a7c7e040c3617e8b3c1bf33b8bc2ba13e0b9768bb1', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 01:42:40', '2024-02-14 01:42:40', '2025-02-14 07:12:40'),
('22087f0e2f6f913ac7dbd8c3645ac4c68011a938dc9f6a893a517ea153d70335204d029f29e416bc', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:43:21', '2024-02-13 05:43:21', '2025-02-13 11:13:21'),
('25706eaf5392b2955c17610f45bc76de823a233886ca54aa777de26baab4c3d48956f31bd8908e90', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:22:53', '2024-02-13 05:22:53', '2025-02-13 10:52:53'),
('268b0335385057c32197072670c0692aef1cab7af5b1e1d422a5f0cb8446215053288e3e2639e089', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:37:17', '2024-02-14 01:42:36', '2024-02-14 07:12:36'),
('27b39ae6c998323cccb9b39b7b21c7d28011381a8ac0526b7e3c16aef501a71a414a26e12c7c254d', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-09 03:35:25', '2024-02-09 03:36:28', '2025-02-09 09:05:25'),
('2f779be1c3ff7f286560c51cfad7fbb676fb9bdc023bab6857da39dbe3dd09b0df254e879c7df9cb', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:48:01', '2024-02-13 06:48:01', '2025-02-13 12:18:01'),
('307e2060f5061b1a21dc6a149441b32168172737f2cff2f314ab7f2212301f8a55599b017f5dcfbc', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:07:47', '2024-02-13 06:07:47', '2025-02-13 11:37:47'),
('30f7651edba917643e476ef58c5a77b10fc87eedc02121da350ab0605682b9745c9dcb3b0e2323a1', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:48:25', '2024-02-13 06:48:25', '2025-02-13 12:18:25'),
('317c84dfd9aaf64b98df7ec23da8ee2bdf6b4b8206a6791ce60785d345c857bac8ead07fe4fd7ef7', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:15:00', '2024-02-14 01:16:35', '2024-02-14 06:46:35'),
('34d35a15d179e720e076ac6b54313d6e7033a8d2e530ebdfebc9c14f7d5d34be53207223b49b19d1', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:16:47', '2024-02-13 05:16:47', '2025-02-13 10:46:47'),
('3637b59bbe11176bdd03254f3f0aec64ca5e1fe426f82b09f9b86508f0db3238a7bd7afb421e797b', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:20:20', '2024-02-13 06:20:20', '2025-02-13 11:50:20'),
('3702a9e23cca563f3b5990b8c7e1d3f1c4a337d8541a641d24f1d55dd60dffcde81f40f20f6a726e', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 07:20:50', '2024-02-13 07:20:50', '2025-02-13 12:50:50'),
('370ff473e16f310b03d5cc57cb3a6f163beb10521f5eaeb4337e7175176f52cce23379ea05d1775a', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-27 04:12:08', '2024-02-27 04:12:08', '2025-02-27 09:42:08'),
('37ce325c152e270380a156fa4e1fabeb0ea3e27d79d9576791db4d34b74ee92ba1b1049f0f9f6be8', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 07:23:01', '2024-02-13 07:23:01', '2025-02-13 12:53:01'),
('388dab6b267bc55a5f229f08395444d8a90fd3d0bf78d356ba23b29d20dbddcd8b5e54df64cc7b03', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 03:32:22', '2024-02-13 03:32:22', '2025-02-13 09:02:22'),
('3ae21c5ddd5beb730f2aaa0d1b81a751a82041634250d3d096f2d8c7512ef05437278b7427db1fb9', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-28 05:59:17', '2024-02-28 05:59:17', '2025-02-28 11:29:17'),
('3d9289b70333d116e7d9516d5d1ddaf31e7b0dc9744196aa4cf49f4cf0b793a25312325c33427362', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:20:51', '2024-02-13 06:20:51', '2025-02-13 11:50:51'),
('3de4b3b6b5132296db7d41d2f05fc6b33b466a3fe3b85beca7fd22ca960d2edb605919dba64d480d', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:08:38', '2024-02-13 06:08:38', '2025-02-13 11:38:38'),
('3f8f8d3dff6c9587e4c43344daaafb3dc3b15e34d667e95ed495bde6b33052ccbcd8b15f985a1e1a', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[\"read\"]', 0, '2024-02-14 04:56:50', '2024-02-14 04:56:50', '2025-02-14 10:26:50'),
('400dc320b77f405a5108f5b90db8a1c055c6ae74690f9b78eecd72626e1e4c687c7ce2e281bfa43c', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 08:02:42', '2024-02-13 08:02:48', '2024-02-13 13:32:48'),
('42d93eb8e08e1a74dad6cc0f51335fdca295b6a56cc76bd362df7d67d6b457a9efde340d42fda298', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:22:13', '2024-02-13 05:22:13', '2025-02-13 10:52:13'),
('42dc9425cfb2788df2bacf728ff63cb5639db8fe354d6382f4de6b8add5bf8a56da1fada32026175', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:02:44', '2024-02-13 06:02:44', '2025-02-13 11:32:44'),
('44fc289adc4336070fd985597f156d7d9351c31087412df25859a83a21622f2ed355576663cb4811', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 07:59:11', '2024-02-13 07:59:14', '2024-02-13 13:29:14'),
('4550858c12797d46522320af6bbd1f1cb0c1efbc771f98f05ebfcdf2746091eb85476b40ae8db37f', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 05:47:28', '2024-02-14 05:47:29', '2025-02-14 11:17:28'),
('462c04ff6e314f7df33f61caddce1e6ea79432852002b2c4df4d770de1bfc162e6376329319faa39', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:33:23', '2024-02-14 01:35:35', '2024-02-14 07:05:35'),
('475b7f9d81a946690e23a10636802a7bffc5ea129295ed89b24fc12f3a1212902a0d917ef9ccae66', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:23:30', '2024-02-13 05:23:30', '2025-02-13 10:53:30'),
('4a4bc0785365126ef1852834ce158269bb46351aa7aaff99a7df1b9720dddae459290c1ac3cea8e9', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 01:25:13', '2024-02-14 01:25:14', '2025-02-14 06:55:13'),
('4d5e9025d711e030a6b9f33b51e59842a722a5f7a40fcdda3e8bbce60a66c3af028203e278b1aede', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:15:10', '2024-02-13 05:15:10', '2025-02-13 10:45:10'),
('4de1672b73b4fda88a0129dba55012cf86df38ec2d7b69920c3b2b846fc163f9351a47e0d06183f0', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:33:41', '2024-02-13 06:33:41', '2025-02-13 12:03:41'),
('504181ff2fbfa9e355074c0fb5109705e490fc3d90e5ffda170bd9912c89615844749dfd44bda37d', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:35:09', '2024-02-28 01:35:10', '2024-02-28 07:05:10'),
('50591ae40ce38bee445c876727f8ccb5426855717dbf84b0e114e2a0bdce55f7b4e6d96367a04cd9', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 05:56:34', '2024-02-14 05:56:34', '2025-02-14 11:26:34'),
('5230da77af26c2200e9832a9e720486d3c9ddcd9b4c4c314b5ce66356f7fbc94e4e8f9d82973548d', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:20:36', '2024-02-14 01:25:07', '2024-02-14 06:55:07'),
('54d9d27a0fd8240b8cf47ac52ecf6f406fa205f650e525583855735dfe92664f1628dd1ba4732965', 3, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-08 05:46:56', '2024-02-08 05:46:56', '2025-02-08 11:16:56'),
('56cb80888ca7112357312d2e103f5c32bd31c3e89d09742fd4c388ff668b0022a12d40a6f6c6b9e2', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:02:15', '2024-02-13 06:02:15', '2025-02-13 11:32:15'),
('58a5559677e6d02d94fbbc2499fd1a09e3642a7c185d3579fdd1b95864439f9a28fd3e5358f9f1a5', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-09 03:57:01', '2024-02-09 05:42:48', '2024-02-09 11:12:48'),
('591b42af1b98c5a3c7c8ce26c5c3ac8786ba07e2d3ecc9aee10a41623a1b23c16865c49fd07ca532', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-27 04:38:48', '2024-02-27 04:38:48', '2025-02-27 10:08:48'),
('59d3cfb7eae8fb5fd975ffafd25a56af549d60002200a4f699ab11e820b49f2ed61e90549b51c097', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:03:33', '2024-02-13 06:03:33', '2025-02-13 11:33:33'),
('59decd7f44dae7cfbc637ef60159fbe1882e794835919d81e0eae438300fa9b73c2588793d6e8f1a', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 03:19:01', '2024-02-14 03:19:01', '2025-02-14 08:49:01'),
('5cc9f339c1570b429e1732192f6c0886ad40953b1ee981f0a9cea690fb953df14682a2e86e074daf', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:34:59', '2024-02-28 01:35:01', '2024-02-28 07:05:01'),
('6067c73eceece2beeb1daa9a984daaeeefd17d9d4ac3be61a1dd283aa0ec872cfa4b038cabf0649b', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 04:11:33', '2024-02-13 04:11:33', '2025-02-13 09:41:33'),
('636537a38cf94a0f94a82a38d645d0da883b78e94c0c1138f13dd8d22b15fc5013a15ee00c879ed3', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:35:56', '2024-02-13 06:35:56', '2025-02-13 12:05:56'),
('698abdbf435cf913125573a8fe28fd135d94c94a4b547633dd52296f9177b26801676fe9c8aedab8', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 07:17:11', '2024-02-13 07:17:11', '2025-02-13 12:47:11'),
('6a88837956d932f1a1fbc83e00e62f7468b267d6ebc5656b5723ccd688b2d241602e3331d93106cf', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:14:51', '2024-02-13 05:14:51', '2025-02-13 10:44:51'),
('6ad560e1c385d207502039b1e0c16c246f912b7ccbf45f36a857892ec778852dfb680f479fc4179c', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-22 01:08:13', '2024-02-22 01:08:13', '2025-02-22 06:38:13'),
('6b3bdf187a985b4e6ca3cecd4a57fc92a465eb7c06bef14ce287d044fb7ed3da5f2450e32c09c3fc', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 07:26:41', '2024-02-13 07:26:41', '2025-02-13 12:56:41'),
('6ccd3d88139d885376bd44167c1f25ecddd4b94c0247cd14c7db5939feb8283b955f751f1a6e0e16', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 08:52:15', '2024-02-13 08:52:15', '2025-02-13 14:22:15'),
('6d14228c360b8e470d66f64c245f2c1ed8c0e4e107c91fdc37f9b1483581f40dfdb219bdc1a67351', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-27 05:10:04', '2024-02-27 05:10:04', '2025-02-27 10:40:04'),
('703b0cfae678ca91031f390145b2a493ca55dcec4199188446e78cf84565802909e744a4469b2c6e', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:35:13', '2024-02-13 05:35:13', '2025-02-13 11:05:13'),
('727385d66821f655b1e927c5b1eea7484c4314f843225ce7f5e2ff228e35948687bda0e97283b32d', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:42:33', '2024-02-13 05:42:33', '2025-02-13 11:12:33'),
('76ff198366e087118eda46ddda78082a67601f0dad7d6ea77d5bfa957e6a7d7090fb417cdb91be67', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 04:13:34', '2024-02-14 04:13:34', '2025-02-14 09:43:34'),
('77dd992dfea212332096835758b5c975412b3427c3b953ca89451e1fcb1cd80fc3b5f7504ad7efb3', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:25:03', '2024-02-13 06:25:03', '2025-02-13 11:55:03'),
('7b3e33a2b31fed28a65b8d10d1fa3a8f287ef2c7075939ecc3b7797e63017ea9e7c2e768eb1c72bf', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:26:04', '2024-02-14 01:28:43', '2024-02-14 06:58:43'),
('7c0c36ac744055c629a0ce2cf25f7787ce2767811244413eae9c7c95bea53ac31bd4e5f32f112854', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 08:03:06', '2024-02-13 08:35:30', '2024-02-13 14:05:30'),
('7f82bf4649ecb8846774bf0999926d52a99ea769a64a6d2fe34260aef6c6ee206fdc6656cbfad896', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 04:10:56', '2024-02-13 04:10:56', '2025-02-13 09:40:56'),
('7fd65d9ee15b58496296e0fe9b17dbda0fbb925e8578e81164cc0fd166d9919bb778ffd0b3ec0a47', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:16:54', '2024-02-14 01:16:59', '2024-02-14 06:46:59'),
('7ffbfe68e36568636111787f4b81a619d0c00b0c8c1a52c7188bc94660afdb483858769915937452', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 04:20:48', '2024-02-13 04:20:48', '2025-02-13 09:50:48'),
('8015ae01bb8d8e66c29f487d1fffaf02241259ed06437d653670d9a78c34f9b4b22aeccf25d4bad6', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:11:59', '2024-02-13 06:11:59', '2025-02-13 11:41:59'),
('8053b4b1648f299916ee94436a65063f134ba40feb7e21c951587fc998ef851c668c4624725a53f5', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:59:41', '2024-02-13 05:59:41', '2025-02-13 11:29:41'),
('80af1ba9434ae25f19b8c9755b0286e92d7983aa9744cb68ff673f467f6dc7e8249addbd2ed67e93', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:35:40', '2024-02-14 01:36:11', '2024-02-14 07:06:11'),
('81a7fcff73631fa329848d2c78ba993c61444ece641ddb7b0b5ed4ca6b95af7d562a2eaf08baa234', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 04:34:41', '2024-02-14 04:34:41', '2025-02-14 10:04:41'),
('81a90638a4eee6ffdde8f6d93a9d8f7a494663a7da2e274f45d455b0654ac16e5db8991294c6777e', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:26:21', '2024-02-13 06:26:21', '2025-02-13 11:56:21'),
('82b354920ae18fa4b5a574e1d8c5f7e066b39d4c68b50a5d5bd09836978fd9cf218b66395eefd1ae', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:59:17', '2024-02-13 05:59:17', '2025-02-13 11:29:17'),
('8662f76f3d935d3455d3567bc4ea520462627720a1c8fbc2a7bb814f26b8b29adb88c3e1734dcd0a', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-08 06:00:16', '2024-02-08 06:00:16', '2025-02-08 11:30:16'),
('870e2833cc102ed430873c4fc239cd8d904a090be1b75890f3646a4bdb307e1ccc404f982ea084f4', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 08:35:32', '2024-02-13 08:42:25', '2024-02-13 14:12:25'),
('87c3fd922cdb4e5a3533046cbccfe21da706fc568f235476ba3e14d2bd2ec31cdf1839be169f89c3', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-12 02:13:26', '2024-02-12 02:13:26', '2025-02-12 07:43:26'),
('88092aece7b9563f9812f7aea95a89063e25a64de9f93d8825ca59af7d038ed954ec2594d0501fbf', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:27:23', '2024-02-13 06:27:23', '2025-02-13 11:57:23'),
('899f2db86d244e102f60f077fd8b7419cddd509729dc69f60d55df576279c0a73dcb3b9ec2a2600f', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-27 04:18:22', '2024-02-27 04:18:22', '2025-02-27 09:48:22'),
('8afb26cbd0eb21a02dc59201d8539529f5b1fc507df25704209100f14216f67549a45d0988d62c89', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 03:46:04', '2024-02-13 03:46:04', '2025-02-13 09:16:04'),
('8ea22cd63e8e5f45ba3fa3a191a280f34069c35650802de19d18682044c3d22df7a8db705b767c6b', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-27 02:20:53', '2024-02-27 02:20:53', '2025-02-27 07:50:53'),
('8fbe41cf3e8ce72e51188ea334bf1e25c7720d51f6a869775e4c5c5a666b89b8a8938753c3ad8484', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:32:08', '2024-02-14 01:32:15', '2024-02-14 07:02:15'),
('8fe202bd46dc189975dae765e2d0babf27d35c3ebdf7e30efd6bca69026084735627d8d0ea44c6ba', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 05:36:44', '2024-02-14 05:36:44', '2025-02-14 11:06:44'),
('902c0f080970e0ecdd5fe9831866ef05f729914a9703d96f90edd312382ca1dfbd8a93ae67f28782', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:13:50', '2024-02-13 05:13:50', '2025-02-13 10:43:50'),
('9128cabb54f5407df2cb82c4a083072195da1e22ea7833eff7927af65c56bfc3eb206d3b9f1dc85e', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 08:42:26', '2024-02-13 08:50:35', '2024-02-13 14:20:35'),
('9141929b267cf035eab24533db11e75b997697da234cd1a31b2c8a505d82773c81e7e9a72b86ab89', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:48:27', '2024-02-13 06:48:27', '2025-02-13 12:18:27'),
('92fc6ef0fe0873c1a80f9b4c9997866fca7783e9086d8b37b6dcc459fc6c2e4dc3adbda06abb7742', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:16:30', '2024-02-13 05:16:30', '2025-02-13 10:46:30'),
('96f9795cc92dff1e6c4f1da9fc2c5fa6b34133567cb6d39abdb2b202e6664c52ab9242586bd0c3ff', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 04:10:47', '2024-02-13 04:10:47', '2025-02-13 09:40:47'),
('9741d93704f748693f6049453f1206a878f6e1ab70781c9b3a30cefa691872ae4aa38046908cad1b', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-08 07:05:02', '2024-02-08 07:05:02', '2025-02-08 12:35:02'),
('98909f3d04e1228cdc4f3788fe06c639436296a99511e94a4e97043a7c3603e391fd0ddb0f6d2b8e', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 07:56:45', '2024-02-13 07:56:47', '2024-02-13 13:26:47'),
('99c102eecd3eb76e7987a25e26b105fe46de4cb317e2b72df6b2c22dbd44e2a1ad487182f5b08e0f', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 04:08:43', '2024-02-14 04:08:43', '2025-02-14 09:38:43'),
('99d1d1b8224fd76ca4555eb6b4ce40804723fec4d97b0ed1c23f29c497c19d9ae820bde51cbe5f77', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 08:03:03', '2024-02-13 08:03:04', '2024-02-13 13:33:04'),
('9afd50c55e914a1c086f7ad949a94fd6c5f993a5621facb64210d3f813357d96ca349096d32132ee', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:23:00', '2024-02-13 06:23:00', '2025-02-13 11:53:00'),
('9bcd4cbccdbc659cbdd49364d6071d3f60ab85fa92dd94d55e65266ff8773a2e301502bee2953c4b', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:34:59', '2024-02-13 06:34:59', '2025-02-13 12:04:59'),
('9c9d6eda6d2d3fbef33f14be68dcc45c7178788fb6d239895282639cae8240ef2f75a8734ad80435', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 03:43:07', '2024-02-13 03:43:07', '2025-02-13 09:13:07'),
('9f3e5c65878aa692b46c3e0c5f9d5cfdcf6dcfa9b62562aa6d941a2f2bc245a5176260fddb257be7', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:21:19', '2024-02-13 06:21:19', '2025-02-13 11:51:19'),
('9fb12ef03f5800cb86070f7d6c27dcb8503121376b42216168574c0bd46feee2d2652f3f4eae5e42', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:01:32', '2024-02-13 06:01:32', '2025-02-13 11:31:32'),
('9fbf6d04b0228b3a8c4d2fdcbd1898fd96fd501c3cc2b49c5da5865958f073cfbb8b2382aa2ca969', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 07:13:15', '2024-02-13 07:13:15', '2025-02-13 12:43:15'),
('9fd7884e6ba5b8c8272358dc2536b8d58408e8b44b66ec6b8e738975f007b364a144c54379e4ae14', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:19:29', '2024-02-13 05:19:29', '2025-02-13 10:49:29'),
('9ff34c90d7048cb693a4227e76c7fdb8e12b424b447ab82fd71e7e7988c030842f60c8c97c77d5e0', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-08 07:04:23', '2024-02-08 07:04:23', '2025-02-08 12:34:23'),
('a2fac7de53c513b60fe1aaf7cbc672689be1fcde1e212cc61c0dcb6332625352d5542364f0ed29b8', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 04:17:06', '2024-02-13 04:17:06', '2025-02-13 09:47:06'),
('a2ff7d4a2ea9565f00c91c88d495a0acb88c30258761005fc07a877e972db9dbd17d0811e13629b6', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:20:02', '2024-02-13 05:20:02', '2025-02-13 10:50:02'),
('a4165ba7aa95d5ad5e7e934ad33d7871fa716931fde0f5a43330af7160c0d7e38b9d4989e8175494', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 04:53:15', '2024-02-14 04:53:15', '2025-02-14 10:23:15'),
('a41eab6b1e35a6bbf8d723ba875faffd943109fec9d96438bd204785165e62cee2343de77d5dd390', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:35:24', '2024-02-28 01:35:27', '2024-02-28 07:05:27'),
('a4d6d49c5865a40d6b8ac17c43ea4c742542b478f57cef4bce8ab861090a5f842800a92f23c8cc52', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:31:39', '2024-02-28 01:31:46', '2024-02-28 07:01:46'),
('a661277b8904c3a66e36e4c8439e4e9d77ceffc790dbd2a5f9f7cb8aeb79062ebfddec551ba2a2e9', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:35:47', '2024-02-28 03:17:45', '2024-02-28 08:47:45'),
('a69865fd0a71227ce3a659a3d6fb52820ce4b99a1f290a66574b824524f5369594726159a04cf2bd', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:49:27', '2024-02-13 06:49:27', '2025-02-13 12:19:27'),
('a7406fd8b508639ee6f90b70b0e29d9cb335420d9eb3c31f9eb824457ef66d979faa69b60cd43539', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:15:46', '2024-02-13 05:15:46', '2025-02-13 10:45:46'),
('a7de559a9b08ae57451d1b35c610de11d8801ed4a4dc81a1c9c0377463a6997a005d43e5d2e1d803', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-08 06:39:36', '2024-02-08 06:51:12', '2025-02-08 12:09:36'),
('a8726efeac0d9e688a7139b8f2b0436f9d4bfcf804ab02ef370f0c37daa560d75b4c533664bb6637', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:28:48', '2024-02-14 01:31:35', '2024-02-14 07:01:35'),
('a9e35a7ac6d11121a0f1ec72fa0e7a6bed41a72e69d7a5e9270237805219e388d71636036dc8fe3b', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:29:33', '2024-02-13 06:29:33', '2025-02-13 11:59:33'),
('ac1a7ffa314a532b97a98d2c2e9297625e77fd668f6815f86f06636c92651b4948be35374a4b2891', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 03:29:48', '2024-02-13 03:29:48', '2025-02-13 08:59:48'),
('ad7fd20b50cda02cec87a02aee2a0b5bcffa96916de23411e8abd9e98d84e5af0dc22684b8745337', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:20:53', '2024-02-28 01:25:52', '2024-02-28 06:55:52'),
('afb8197b3ad1421bf0b7ccf036eb9c5d7f68e495fe95fdc4c3015f7da6c34f143984855c383ed8bd', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:27:50', '2024-02-13 05:27:50', '2025-02-13 10:57:50'),
('b05182cd4f22e2ed67a7460e949893c34af9533d1d57bc5aed041038097cc685b39bf32c350ac70b', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:23:23', '2024-02-13 06:23:23', '2025-02-13 11:53:23'),
('b0d61abc58173911964ef23e4adcad4a7cd3bdb70ce4a0f2f5f4c7dd5d8eebe531602acfdb9cb1fb', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 04:05:02', '2024-02-14 04:05:02', '2025-02-14 09:35:02'),
('b0e5072716eca5a35bed3d9cf4478d17bc3e43716a1de4a9f1d242c9b4fa9389f7d45718c1cfd8af', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:08:03', '2024-02-13 06:08:03', '2025-02-13 11:38:03'),
('b3dcc4e3ca56cba777623c6e6277900cbc03e240229a7dc80f41a23dba191ce9654844614e89445d', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-08 08:56:51', '2024-02-08 08:56:51', '2025-02-08 14:26:51'),
('b5452fbd2105c3e562f1942dab5fa8c8ad977c71947bd6e43639b6fc4534a6a69c278bf79db10742', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 05:58:34', '2024-02-14 05:58:34', '2025-02-14 11:28:34'),
('b5be5ef42e8d93ad20c04bee95b617cae4e259fd5e36256915f91c0d6e83d999e911834329fae786', 3, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-08 05:49:08', '2024-02-08 05:49:08', '2025-02-08 11:19:08'),
('b60e93b496180ee5436666cbea7172447d4eeaafdbcfbf884dcaccbb2215e78f0f55f0fffcadb627', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:09:35', '2024-02-13 06:09:35', '2025-02-13 11:39:35'),
('b74a06dd8e7a369ffa6b68266db70578cfd81ad9b00f8ccc1623e29602f5adb0ddf5dadbd8e97d6c', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:20:32', '2024-02-13 05:20:32', '2025-02-13 10:50:32'),
('b8ea76d1994f5292e5c7537cf39bfa0096ba08ee64106f7e3e0ae4840efdc4f7ef71a36a0d75ea18', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 03:42:51', '2024-02-13 03:42:51', '2025-02-13 09:12:51'),
('b9005f452339dbd7cb3560265d9d4b7415b879530f4dc8d4663d3a80e324a9a04ed72bdbcb06830f', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-09 03:36:52', '2024-02-09 03:36:52', '2025-02-09 09:06:52'),
('b9f88189b09fbf87dfa763269155ce05eb05403ba7ec5457b557e3bdb99e265b2f6a2f678f225bd2', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 07:58:08', '2024-02-13 07:58:08', '2025-02-13 13:28:08'),
('ba989e2a2d182e2154030173c8b18bbcb51cdcbe416022fc53376edf308c9ecb879849aee56f7d08', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:16:40', '2024-02-14 01:16:46', '2024-02-14 06:46:46'),
('bae8c9a742a2959da59ae71d05dd34703835b3be00433fb62bee97ead8d0b564d94d4ba7c4f542fb', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-08 06:51:31', '2024-02-08 06:51:42', '2025-02-08 12:21:31'),
('bca89f68cf6d10f6d6814af12212f2cce5d5cadd7f61f9bef41a114f89a4ca5ab70ead98fb75525f', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 05:51:17', '2024-02-14 05:51:17', '2025-02-14 11:21:17'),
('bde7bbdd39c1ec4c9f9cf176b4b4a2932f5d91e0a3468b5b32b9a4b7fdc3a0d8d505259482df2da7', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 08:01:40', '2024-02-13 08:01:42', '2024-02-13 13:31:42'),
('c2509d42321dfee2057deb872dfebbaa5d9b583cdab6395ce9b5ae8ff289f8b125914ac3d0f9102a', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 08:02:51', '2024-02-13 08:02:53', '2024-02-13 13:32:53'),
('c6af0865c6488fee82a473d4a39e222a0b8db754456e7e113906044a520d74e00886d7d1b582207b', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 09:01:25', '2024-02-13 09:01:25', '2025-02-13 14:31:25'),
('c76a66196c67c4097074fcee61356d47ac41e1b5199da1b800b1a134a9983a60ee9b76c63d08fc90', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 06:19:39', '2024-02-14 06:56:58', '2024-02-14 12:26:58'),
('c7ddc3c35dd9f34b5380ee0be08370575b972f49bbc072c781fcc5e28b035922dcabd259cfdf1b04', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:08:33', '2024-02-13 06:08:33', '2025-02-13 11:38:33'),
('c934988f0e81f76d8241a782432107898a1bd54afe8a1ecc155d642dd7cad75bfa69eb0d402709bf', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-12 03:37:44', '2024-02-12 03:37:44', '2025-02-12 09:07:44'),
('ca44be8433113b79269d5ee562b451a3015c428b6abf6e3d41a0340b276edca163d0a2e671aaa5e6', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:19:13', '2024-02-13 05:19:14', '2025-02-13 10:49:13'),
('caebdcbce886a1780b61ab7863c818841132f8ae3778abbf83000cdba3885f152713727524561099', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 03:36:23', '2024-02-13 03:36:23', '2025-02-13 09:06:23'),
('cbe45f76c4a501dfbe730dbbfea715459c4dcea223e145271c42c17daaf6883859f47a7513e92bf6', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 04:15:38', '2024-02-13 04:15:38', '2025-02-13 09:45:38'),
('cda70be89ddea65ee02fbc1776540c7db731bf479a006fa9dddfde06593212f6840a29f8156b9a83', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:15:41', '2024-02-13 05:15:41', '2025-02-13 10:45:41'),
('d46aa7518449c39a8697fb4123a6795a26e05f5054e4835f68703bae9d9a7cc333553880d603f5dc', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-27 03:30:10', '2024-02-27 04:12:05', '2024-02-27 09:42:05'),
('d5098001f81586a0a589e58b10fe2775a2deacb205529d2a1eb472b84948dfa8d3d4dbdd07528123', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 08:51:45', '2024-02-13 08:52:01', '2024-02-13 14:22:01'),
('d552a527b3b723a824d919fa87f0846d5214f3d1afeb1e5f90db0da4538f2797dcf5823974929086', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:34:23', '2024-02-28 01:34:26', '2024-02-28 07:04:26'),
('d710b75d1ddd1b837b59cb9cdfe2af0fa3cb743807cc4d92aaf9ab388b4f15a929790884577a32ca', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-09 03:40:10', '2024-02-09 03:40:26', '2024-02-09 09:10:26'),
('d75e8756660d0886315a07d2a2964387a9990b20e471504df9350974ac2d705ae9f7e510270ac38d', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:20:43', '2024-02-13 05:20:43', '2025-02-13 10:50:43'),
('d8dc43c462967e449c3af8ced450efb2650f87af0068a88919811b317357d111bf8706f29be25c69', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 07:16:15', '2024-02-13 07:16:15', '2025-02-13 12:46:15'),
('d945d98805f0f2712d5b69825590ad5d4765434568a9c370d38a4d4ee828b1840b1ca8fa01812993', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:28:50', '2024-02-13 05:28:50', '2025-02-13 10:58:50'),
('dbf63a51d627050deb5eaebb2fe73f105f6d7f84bdef66835bfca541604b13c5902a8053b86f9a97', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-27 08:16:55', '2024-02-27 08:16:55', '2025-02-27 13:46:55'),
('dce7cfec6295c77135ed8c85d0a6ad19118940340a0421facc886a698c2fe6fe60eb473149e64fbd', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 03:17:57', '2024-02-28 05:59:15', '2024-02-28 11:29:15'),
('dd83579275ab8046c85cfad12f7f566e21cddf5f97833c3caff46198eba2ee7a2c531add928056e2', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-09 05:42:54', '2024-02-09 05:44:04', '2024-02-09 11:14:04'),
('de1100746358c757a684ee37c11911c8cc0de89d10cb0154b8e198165150d0c492e8df5fc5d7aed3', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 04:11:26', '2024-02-13 04:11:26', '2025-02-13 09:41:26'),
('df836ab428e39047c61ec4f0b5adf55aa048b4ad4b9c7b47eceac3e3255a9007bd75a1393527a9d5', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:43:07', '2024-02-13 05:43:07', '2025-02-13 11:13:07'),
('dfb0028faebf9292c18672dd0a2c3f0f93ff1c086d28b37fe1e2b926b00007c9e5d4475996e68d53', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:20:48', '2024-02-13 06:20:48', '2025-02-13 11:50:48'),
('e000ef9c89d669fdfecb73765f419bb51631fa52cecbc7bc79c064f8b829091a0b363d622dc83a05', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:35:30', '2024-02-13 06:35:30', '2025-02-13 12:05:30'),
('e0274aad8b14ad11f1402f9264f48bcd940c7d3bbd18f8d40ee653d614ebc1a92dbd6a0e53f6ca6c', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 03:14:04', '2024-02-13 03:14:04', '2025-02-13 08:44:04'),
('e02c56293b454dbce6728f418507c395f74926858858829e962cc2a9c6da4803bd822d836fb1c6c9', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 03:51:35', '2024-02-13 03:51:35', '2025-02-13 09:21:35'),
('e1d3210f6dfefaed013b4366c59bcc4132c397bcb7c1270ab5894246fa7b1cdfea22ca84055e7599', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 01:25:17', '2024-02-14 01:25:37', '2024-02-14 06:55:37'),
('e20cf1df8c980f77b71bc40a00cd47769d20951b2b77cb4754d3beef05de74326f27d774ca0d58b2', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:13:44', '2024-02-13 05:13:44', '2025-02-13 10:43:44'),
('e287d4b7b149e73713cd82ac8bc9a2a6ad46f3acc27196cc3c1f03335986b59871a8e1018b6277cc', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:34:29', '2024-02-28 01:34:30', '2024-02-28 07:04:30'),
('e2ef6ae069f726cf2e60366879328073d41e803276c78e5694c52e4c5a84cd9f9e6f18e90658fcf3', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:20:10', '2024-02-13 06:20:10', '2025-02-13 11:50:10'),
('ee779b547f27ef5014a706e02609555e89e51633cd01d49d3fe757b44c3ff927f5901b4ad24ac957', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-13 07:59:17', '2024-02-13 07:59:20', '2024-02-13 13:29:20'),
('ef01d32c705197f6238e7269d28aea3fae06e226f5d4c8b4b7e86c19f67e8beaddcb1861ce7505b2', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-14 06:19:34', '2024-02-14 06:19:37', '2024-02-14 11:49:37'),
('f1225bf170097a7f2d83fd1ac6354897bbc2bad1e997f1bfbebb71bc30d77959e228612948dad4b8', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-08 09:29:19', '2024-02-08 09:29:38', '2025-02-08 14:59:19'),
('f4dc1ceff49fa884079b5e7c9ea43b89c3b88a1521ce3759aca93014d0d7fdc8cde33e8384574b01', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 1, '2024-02-28 01:35:03', '2024-02-28 01:35:06', '2024-02-28 07:05:06'),
('f7db11387a11ca585e28d92ac1825397f7f62e2d6879b77d0e7de6fc19e5e9cc8255011314c7fd82', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-14 06:57:00', '2024-02-14 06:57:00', '2025-02-14 12:27:00'),
('fd2bde8ad8b9c63e857251a0b986549bb41d5e192aa885a922529af4ebeaf60c38256c181da598b5', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 05:21:44', '2024-02-13 05:21:44', '2025-02-13 10:51:44'),
('fe7b5b0b7e364216ca020d5fc314e0d0f12baebde472ea6da8ad575ecc286b3ea05bbe9dbed4abc8', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 07:18:49', '2024-02-13 07:18:49', '2025-02-13 12:48:49'),
('ffb541afc3b3a322556cd8621a15f118858ec8f70c3cccf9c165c3d70cb92085bc79a66f984905d5', 4, '9b494b6e-ee87-4246-b1e0-52ef9928071e', 'Laravel Password Grant Client', '[]', 0, '2024-02-13 06:10:13', '2024-02-13 06:10:13', '2025-02-13 11:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
('9b494b6e-ee87-4246-b1e0-52ef9928071e', NULL, 'Laravel Personal Access Client', 'JOPRp06UuTCPgryRHo6IXVXZjI0UXEYnO19vnv0e', NULL, 'http://localhost', 1, 0, 0, '2024-02-08 05:46:44', '2024-02-08 05:46:44'),
('9b494b6e-f42f-47b1-8821-09e4a5ebae1c', NULL, 'Laravel Password Grant Client', 'C5nS2sEI4WcwH08z9x7Oq3iHDyVwgrlnz2tLHVk2', 'users', 'http://localhost', 0, 1, 0, '2024-02-08 05:46:44', '2024-02-08 05:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, '9b494b6e-ee87-4246-b1e0-52ef9928071e', '2024-02-08 05:46:44', '2024-02-08 05:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message_giver_id` int(11) NOT NULL,
  `care_taker_id` int(11) NOT NULL,
  `task_start_date` date NOT NULL,
  `task_end_date` date NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Hari', 'haridwar.yadav@globalfpo.com', '8383472642', NULL, '$2y$10$Nt5FMnslEx6fGkv.t64urOCIIVJJ82ZMj.HI.1aQ6hayiCPsAE3xi', NULL, '2024-02-08 05:56:31', '2024-02-08 05:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_otps`
--

CREATE TABLE `user_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `province_state` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `type`, `currency_id`, `country_id`, `province_state`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Hari', 'Regular', 2, 2, 5, 215, '2024-02-12 08:59:48', '2024-02-12 08:59:48'),
(2, '', '', 0, 0, 0, 215, '2024-02-13 01:41:45', '2024-02-13 01:41:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_otps`
--
ALTER TABLE `user_otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_otps`
--
ALTER TABLE `user_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
