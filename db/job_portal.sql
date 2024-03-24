-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 05:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
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
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `identification_no` varchar(255) DEFAULT NULL,
  `account_currency` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `industry_id` bigint(20) UNSIGNED DEFAULT NULL,
  `descriptions` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(12, '2024_02_08_134637_create_chart_of_accounts_table', 1),
(13, '2024_02_09_112156_create_accounts_table', 1),
(14, '2024_02_12_140833_create_vendors_table', 1),
(15, '2024_02_13_070312_create_customers_table', 1);

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
('0231a4fb16d3c8b0d590b1c18b6f74324f7f86cec51f1638ed120e9f8d4f84f494e4f622b4ab9697', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 01:54:10', '2024-03-24 01:54:10', '2025-03-24 07:24:10'),
('04269a27f0f0c08173cc7e0ae0b9cdb38a6d40791eae60fb40a085f9325ab68301e7848b11038ce6', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 11:52:10', '2024-03-10 12:09:49', '2024-03-10 17:39:49'),
('0c6a6c0356e72d699053e3ecedba29d8c5763818e6bc89a15e2e621065645f479be510741c141cd0', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 09:41:08', '2024-03-24 09:41:08', '2025-03-24 15:11:08'),
('0ea7e6b2f235d20840e5bd227a727ffc4a2d4b461e4af04c57619bd205d371728b53f281cf4f62b8', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-24 03:56:52', '2024-03-24 03:56:58', '2024-03-24 09:26:58'),
('0ecc1882a44b558ea58ebf68b47110e6dfc9feba2d5ffd2de9de30c3f3c0c935fdabdb39a0fea7c1', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 03:34:32', '2024-03-24 03:34:32', '2025-03-24 09:04:32'),
('1287c605104ed15fa85cf91e1ca999aeeed291404195b30470b85da57e273165fb568ba36424e73b', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 07:39:17', '2024-03-24 07:39:17', '2025-03-24 13:09:17'),
('146c409000c3780e4a75a230aa7fbccd580c7e6a17a7f475519e4dfb2c0638eb604675e19776fd37', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 03:20:05', '2024-03-24 03:20:05', '2025-03-24 08:50:05'),
('14c3969b5bf59025750f73dc5a45f24458469274478ba950544a56c21b29fe1a596ed064f07f85d0', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 01:55:57', '2024-03-24 01:55:57', '2025-03-24 07:25:57'),
('1fdebfa4dbf37979e73858ac9c62b31432341647143818daee22f64e57f649caa9415a1784d9814d', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 08:25:45', '2024-03-24 08:25:45', '2025-03-24 13:55:45'),
('2338100b7223c20d529b8df164a45866cf582e9e4d1cac7918c34365ccdeb8faaaa2b2aa1c8f45d5', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 03:46:30', '2024-03-24 03:46:30', '2025-03-24 09:16:30'),
('260e70b4d49c189087a199b626e141a84e58a69e9782e34bcbb4693e44aac829ee6a2ef2a56eb627', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 03:49:16', '2024-03-24 03:49:16', '2025-03-24 09:19:16'),
('308717d94f3d4a90b6344ea1cf8ca64923d17710b16c7aec51cb544562b355342c5f054f4595d4ca', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 08:26:39', '2024-03-24 08:26:39', '2025-03-24 13:56:39'),
('378a489c5cc3aa7d10eff99ab59191d8141ea77aab72c8571b7eae6f79cc07494354062a1ce2d7db', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 01:58:26', '2024-03-24 01:58:26', '2025-03-24 07:28:26'),
('37ee2a73c15a1945c192172d9a731bf4badcba36dd310fca235bc25b850f55b96e64e3996043df99', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 08:54:26', '2024-03-10 08:57:47', '2024-03-10 14:27:47'),
('3807098441db2bfac4910c54101007e5d845b1118fda21b1ac1ef5be8209c40da02772065815733e', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 08:31:13', '2024-03-10 08:31:26', '2024-03-10 14:01:26'),
('3b81065c2edea158c3edb60ac111d1d5020b368cf8415260012b679b442367a3e92a0e016f05fecf', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-10 08:31:34', '2024-03-10 08:31:34', '2025-03-10 14:01:34'),
('3f63c26c5928ecab296ff1283d18a788400477c6a618c56a2503520c3847b0b1b4a2c30bb1f2ba26', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 09:45:44', '2024-03-10 10:05:06', '2024-03-10 15:35:06'),
('4210a13431b87dce2ff53fb3614f0c50662c470ea948a46b5d4da73e0b7970a5f3cff71170d487eb', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 11:28:15', '2024-03-10 11:52:04', '2024-03-10 17:22:04'),
('4557c087fd8f2d40e8d6a1d8c3a22713b86c3c9f64e81f9c5c88ca413144b88cac1c67ca672710b4', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 09:59:36', '2024-03-24 09:59:36', '2025-03-24 15:29:36'),
('4bf67dc8534901a579d7ed1b7ba8ef4e796f44479fa2f92600a2aa6e8e8f6c315a43fd2486ff11ec', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 09:57:28', '2024-03-24 09:57:28', '2025-03-24 15:27:28'),
('512bc1230002e00036055c232224a102bfbdf27488c7e0595f5585bcc0f9ac4cf6a970bbc3324713', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 00:13:33', '2024-03-24 00:13:33', '2025-03-24 05:43:33'),
('5620f80540b4b4de45b449a2d20dc3b630dde698ab340c82ba435a98fb41794852ee3f63d0297ebd', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 00:10:58', '2024-03-24 00:10:58', '2025-03-24 05:40:58'),
('5667bc3ad3ab8a6b84ff7696b143dcdd4f81a5b2f7d261fcfb2e73765160506aa0a7e37724063bc2', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 09:56:32', '2024-03-24 09:56:32', '2025-03-24 15:26:32'),
('580d7ccb5ebd9268becb974c95469ae8f467f9d829344633c3c29045da317ab1620a794cf3ebc605', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 09:08:19', '2024-03-10 09:16:13', '2024-03-10 14:46:13'),
('66e374863e546dbfcb8d212d9e4a4a37456115a61b8f145510a90905f6ad0fee4649748a4764e1e3', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 08:52:38', '2024-03-10 08:54:21', '2024-03-10 14:24:21'),
('6a749d859b37bef3a1dbe8d4fa745486ee5c1b1b44cd4e54850d45955fff76e2206e16d391e2da26', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-10 02:16:19', '2024-03-10 02:16:19', '2025-03-10 07:46:19'),
('6c640f0d499d9e12824c145b0f5fe8f708a9954dc5ccbe0abae477578b7190997f1c83f8934eddb2', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-10 09:38:23', '2024-03-10 09:38:23', '2025-03-10 15:08:23'),
('6c66327c7320e778d3286c093d20f923c68eb1c72ecb57674f4563b579beeaf9727dfd2aebd293b0', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 09:41:51', '2024-03-24 09:41:51', '2025-03-24 15:11:51'),
('751439d64a9314e9775141ecfdf0da8fd16dc6651ed6d938ee4acde830f24498b1486df0c8cd3b2a', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 09:39:39', '2024-03-24 09:39:39', '2025-03-24 15:09:39'),
('854892400886a2bb139a3a4bb9cb63fdde03b5889f9c477de76e8a178196b00a1dd2514a651f620a', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 08:50:54', '2024-03-10 08:51:04', '2024-03-10 14:21:04'),
('8791cfe57cff5456c7a5aef589a1e789585c84b965524df8d2528499ac64062848fde7c6ee9f3f64', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 02:03:50', '2024-03-24 02:03:50', '2025-03-24 07:33:50'),
('8aa86f53c77edfadd95571be873b551070b9c0f38b5c1ddc688dcc4dfefdc07391e842d27858d3b3', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 11:24:30', '2024-03-10 11:28:09', '2024-03-10 16:58:09'),
('9553cdf318dc1055db8b874a587696efade311342b13791d829136b574132c198fe97e0a164ec5bc', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 07:44:24', '2024-03-24 07:44:24', '2025-03-24 13:14:24'),
('95c88942f19b618227041e27acd9d7183f5b2de9d5784e86e2d570212ed29cddbf5125020fd2a0cc', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 01:57:58', '2024-03-24 01:57:58', '2025-03-24 07:27:58'),
('a1502cfc3945aeacf7e9b717911074023399c352f7a4e1aac9a4288bc88d81aa032c9cfdd009a5d2', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 08:59:18', '2024-03-10 09:08:10', '2024-03-10 14:38:10'),
('a33b69a9d3ce6e2c3ac4512259a427418570e3cb076cdf7b947b00f0a646c5b0a60d9abcc75929aa', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 03:37:59', '2024-03-24 03:37:59', '2025-03-24 09:07:59'),
('a41df81d121e1d8b4c2051729654660e2c48ae14c2338746e5399e03367dd24087d230c986d97def', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 01:57:45', '2024-03-24 01:57:45', '2025-03-24 07:27:45'),
('aa73e8c51f7f61e3615bca16c6ac641b2f21c3f7f5324dc1faa71f53612480cb182f2fbaa9936744', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 07:42:27', '2024-03-24 07:42:27', '2025-03-24 13:12:27'),
('ac2cb25202eb495ba9753b89beadd3fa7d382209dfa76e87dd10de68d1720645009d69ae1c69f8ae', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 02:53:01', '2024-03-24 02:53:01', '2025-03-24 08:23:01'),
('ac6a0a2afc73fd2a17ab9ed02c27cdb49934732d8a6dd8d9330c36a98825b0715d05b4ce5122f330', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 03:33:29', '2024-03-24 03:33:29', '2025-03-24 09:03:29'),
('acfdb03441dcafdbe4bf390c05231138c1f004e6b54858f2a459b36fcb10e5953dde4cbf0a65a982', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 10:05:11', '2024-03-10 11:24:24', '2024-03-10 16:54:24'),
('b21a2a0a2550b40a1bffca3a7e492ad7ffe974e7d42a1c8619887c611c492a625763c1b6a1abaf3f', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-10 11:29:17', '2024-03-10 11:29:17', '2025-03-10 16:59:17'),
('b21e0447caee3ec9f236583dce1a13679f1c55739697c7f5da1e75d6191157418756b58fa6e30707', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-20 22:04:28', '2024-03-20 22:04:28', '2025-03-21 03:34:28'),
('b5821eed9a208c6861653fe7043a90f30b1b32ec1f85dfb7bd45c5ac41915041099c3cbc2e429fbe', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-24 03:53:52', '2024-03-24 03:53:57', '2024-03-24 09:23:57'),
('b76bf76bce38a355ab7177c19ea5d1775b145e774c824d995e4a2fcea2e4563e4e5cd9bd005b1337', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 08:31:08', '2024-03-24 08:31:08', '2025-03-24 14:01:08'),
('bcbabaf35fe62a60d4c0fca4f6943974e48e38e11512cd093861946a2385ba89400701b4082fd8a1', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-24 08:35:28', '2024-03-24 08:35:37', '2024-03-24 14:05:37'),
('c276f3db3ae39b0dfbac6ebea40db10d4f8a46fe4897ea215f81641cc070708c233796d82cf59c7f', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 01:58:55', '2024-03-24 01:58:55', '2025-03-24 07:28:55'),
('c880dc11edc3a8373333e007df2947c61227e66b014b679ab3d6c417eb5943b8348d748c061d866e', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 03:32:13', '2024-03-24 03:32:13', '2025-03-24 09:02:13'),
('dbf5e229b9b6b13d9967888eda231c5f3b9f6dd4229bee80256f834f3b78179d17757d0b811ce301', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 08:27:05', '2024-03-24 08:27:05', '2025-03-24 13:57:05'),
('df5d7f3575c54b5abcf5b893415f64ca95a4ea3966ff85e94ce1a3b4545c2a2eed1bbedd58ab6af9', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-24 03:57:42', '2024-03-24 03:57:47', '2024-03-24 09:27:47'),
('e41940eb6937f9065b5c31bb17deeac2d2d740f64b6969f447217bc0279fa90b688d69ae958c9482', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-10 08:51:10', '2024-03-10 08:52:16', '2024-03-10 14:22:16'),
('e83fefd8fe0692001ed69177f98ec1f0ff0138a857534e83796788c66adac5168892ab8c626fe740', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 1, '2024-03-24 03:59:56', '2024-03-24 04:00:05', '2024-03-24 09:30:05'),
('ebb64cecb4fd21cb1fa600cab87789d0bc3ce4ef702b7489342a9d6ba02d385d01e82c4762a2d167', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-10 09:16:21', '2024-03-10 09:16:21', '2025-03-10 14:46:21'),
('ec25b6ef68b6dac38d36d0e6c30a456e560a7705e1bdf158e5c6ae7bdb6afa3ee2a653fd2de320aa', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 02:03:13', '2024-03-24 02:03:13', '2025-03-24 07:33:13'),
('f333b0c60e89d52a049c29f08a283309175f69b84f4abdf84941c13ba4415d1e3bd4a82f8ab4cca2', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 09:56:10', '2024-03-24 09:56:10', '2025-03-24 15:26:10'),
('f5879319ff1a00c4cfb380d95c8a6de59a5a3b48ff12b936f5bf65004bcdad422e2bef0bd67cb025', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-10 12:09:54', '2024-03-10 12:09:54', '2025-03-10 17:39:54'),
('f6b7d678bd253baa795873d6ff7f5f637ef78ea87aceccbc948d772bab4d39c58810893f1985e574', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 03:44:27', '2024-03-24 03:44:27', '2025-03-24 09:14:27'),
('fccbe4e169434c43440bcf8ad5b16a6c51235c57286c90efec9990c83b46ae11b9e43b4f4c02d2f1', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 09:40:26', '2024-03-24 09:40:26', '2025-03-24 15:10:26'),
('ffda6eb6668d47e4f4326781ada87fd963fa6e11e12565c5c8b97d1fbd61dc0187a7a721e7ff0051', 2, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', 'Laravel Password Grant Client', '[]', 0, '2024-03-24 03:35:47', '2024-03-24 03:35:47', '2025-03-24 09:05:47');

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
('9b875ca7-8e34-460b-b9e6-c5d19fede05e', NULL, 'yes', 'MUKgqT42SuWZGML6s5epI9env32fLNptkg1ROT4C', NULL, 'http://localhost', 1, 0, 0, '2024-03-10 02:16:13', '2024-03-10 02:16:13');

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
(1, '9b875ca7-8e34-460b-b9e6-c5d19fede05e', '2024-03-10 02:16:13', '2024-03-10 02:16:13');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
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
(2, 'Hari', 'h.hariy2k@gmail.com', '838347264123', NULL, '$2y$10$n.xMsMr1zQkgWFWNxeHKku2eWQKaT71Z3V6kqPW.f7Yn95pyi.7G2', NULL, '2024-03-10 01:53:53', '2024-03-10 01:53:53'),
(3, 'Peeter', 'peeter@gmail.com', '98913228642', NULL, '$2y$10$XYCep952kIuwOBe/QPnnWOJYmDptzaAgAIbSVP6YalNw0zLMEoBWy', NULL, '2024-03-10 11:27:12', '2024-03-10 11:27:12'),
(4, 'Chanel Nader', 'carrie.connelly@example.com', '', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zDrHNnmttV', '2024-03-10 12:14:56', '2024-03-10 12:14:56'),
(5, 'Jared Wiegand', 'qwolf@example.net', '', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SwQxZ6E3ad', '2024-03-10 12:14:56', '2024-03-10 12:14:56'),
(6, 'Trenton Keebler', 'spinka.henriette@example.org', '', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5D9aqeWPIY', '2024-03-10 12:14:56', '2024-03-10 12:14:56'),
(7, 'Wiley Green', 'estell.feil@example.net', '', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sy8rd79wKC', '2024-03-10 12:14:56', '2024-03-10 12:14:56'),
(8, 'Dr. Estell Prohaska DVM', 'dhill@example.net', '', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'V2FoEkuQBD', '2024-03-10 12:14:56', '2024-03-10 12:14:56'),
(9, 'Amy Lynch', 'owill@example.net', '', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'I0fdIp8Hgw', '2024-03-10 12:14:56', '2024-03-10 12:14:56'),
(10, 'Dr. Hailie Walsh', 'ivandervort@example.com', '', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kxvojol9by', '2024-03-10 12:14:56', '2024-03-10 12:14:56'),
(11, 'Birdie Dietrich', 'carter.damian@example.com', '', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jUZ95H2TPA', '2024-03-10 12:14:56', '2024-03-10 12:14:56'),
(12, 'Una Ferry', 'bhamill@example.com', '', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dTtNuBvkxE', '2024-03-10 12:14:56', '2024-03-10 12:14:56'),
(13, 'Ransom Schowalter', 'marmstrong@example.net', '', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5UCBuRwLHr', '2024-03-10 12:14:56', '2024-03-10 12:14:56'),
(14, 'Test User', 'test@example.com', '9572284955', '2024-03-10 12:14:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FQOshyrpW5', '2024-03-10 12:14:56', '2024-03-10 12:14:56');

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
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_otps`
--
ALTER TABLE `user_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
