-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 01 Jun 2017 pada 01.27
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kop_sbj`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `gender` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `birthdate` date NOT NULL,
  `address` text NOT NULL,
  `login` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `gender`, `city`, `birthdate`, `address`, `login`) VALUES
(1, 'Saya adalah admin', 'Laki-laki', 'Jember', '1998-04-08', 'Tanggul Kulon', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cashiers`
--

CREATE TABLE `cashiers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cashiers`
--

INSERT INTO `cashiers` (`id`, `name`, `gender`, `city`, `birthdate`, `address`, `login`) VALUES
(1, 'Saya adalah kasir', 'Perempuan', 'Jember', '1991-08-07', 'Sumber Baru', 6),
(2, 'Unjani Novi Laksita M.Kom.', 'Perempuan', 'Tanjung Pinang', '1982-11-10', 'Ds. Kyai Mojo No. 959', 14),
(3, 'Clara Rahmawati M.Farm', 'Perempuan', 'Mojokerto', '2016-11-23', 'Ds. Dewi Sartika No. 562', 15),
(4, 'Irma Mardhiyah', 'Perempuan', 'Kediri', '1977-08-18', 'Jr. Kusmanto No. 456', 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `deleted_at`) VALUES
(1, 'Laptop', NULL),
(2, 'Smartphone', NULL),
(3, 'Notebook', NULL),
(4, 'Macbook', NULL),
(5, 'Flashdisk', NULL),
(7, 'Baju', NULL),
(8, 'Celana', NULL),
(9, 'Sepatu', NULL),
(10, 'Makanan', '2017-05-31 22:46:50'),
(11, 'Junkfood', '2017-05-31 22:46:55'),
(13, 'Motor', NULL),
(14, 'Harddisk', NULL),
(15, 'Alat Tulis', NULL),
(16, 'Mebel', NULL),
(17, 'Kabel', NULL),
(18, 'ujicoba2', '2017-05-31 23:31:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transactions`
--

CREATE TABLE `detail_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `product` int(10) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `transaction` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_transactions`
--

INSERT INTO `detail_transactions` (`id`, `product`, `price`, `quantity`, `transaction`) VALUES
(1, 59, 3661201, 3, 1),
(2, 59, 3661201, 3, 2),
(3, 24, 4272755, 7, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `logins`
--

CREATE TABLE `logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `logins`
--

INSERT INTO `logins` (`id`, `username`, `password`, `level`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'adminitupenting', '$2y$10$gCdXdWdRKSRKvBVoxbai7ucuF6Z5ItvaSOEQbd4H06qOWy.xYV82y', 1, 'avatars/adminitupenting.jpg', 'UI0LswolvalrbvtDH7FlryQ6zfvGNe4aZ0Ewdo063FPLVbmUhIx1rkFQXc4L', '2017-05-09 03:04:06', '2017-05-31 13:07:34'),
(6, 'kasiritupenting', '$2y$10$B3jbY1SumcI4yNLDAGxjAu6q8af4UtoQJlMG9Vg7MThJUtftH3qem', 3, 'avatars/kasiritupenting.jpg', 'Xm2Rty4L3b0l5jmhjl7AFRtuy8YHy6Vtwb88YM1Zl3A9jGuEYlpYLbAcubYP', '2017-05-09 22:01:09', '2017-05-31 23:58:21'),
(13, 'manajeritupenting', '$2y$10$JBx4mvDi8dl1q0j1dRRYY.wc9BTb5icQjCkjerBak3y7bTZEhmn8m', 2, 'avatars/manajeritupenting.jpg', 'v3TW2YIPr7UKo4pGnNB5FiADsPgURVVkvQJhCGyZbi7vVIB5zwhVcWjQVJmE', '2017-05-10 17:54:07', '2017-05-31 13:29:49'),
(14, 'gaman.wastuti', '$2y$10$qTe85kAst10RDJO7ZcWmVeLo.9ZUtuYF.kGRzj2k7.33HtzVo2YyW', 3, NULL, NULL, NULL, '2017-05-31 14:00:57'),
(15, 'rajasa.gandi', '$2y$10$YTMkE7cWs2M.XhK2Nk047O/ZkikUcaUAyn4cvia5.R.tyXxX3uGTa', 3, NULL, 'sdJiFKOX3hAhW82EPK7ZEUunHGffXMs1oa6rLNC1RmmYv3CbGRfs47B4Ckgq', NULL, '2017-05-31 14:00:47'),
(16, 'agnes.mustofa', '$2y$10$NxXPtEJM6nsohSNW8HITt.ynhSilrAQPa/kfFJtnSu.pDP7z0CAoi', 3, NULL, NULL, NULL, '2017-05-31 14:00:51'),
(18, 'bbbbbbbbbbbbbbbbbbbbbbb', '$2y$10$ib4UhR/QIok5qtlKiKrd5.OcN0jtEK2iwum6lJMwzY9f31kkcuHHS', 3, NULL, NULL, '2017-05-31 23:22:29', '2017-05-31 23:22:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `managers`
--

CREATE TABLE `managers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `managers`
--

INSERT INTO `managers` (`id`, `name`, `gender`, `city`, `birthdate`, `address`, `login`) VALUES
(2, 'Saya adalah manajer', 'Laki-laki', 'Jember', '1980-03-05', 'Sumber baru barat', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2017_05_07_151200_create_all_table', 1),
(3, '2017_05_08_092930_add_foreign_key', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(10) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `barcode`, `name`, `category`, `stock`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2300874257561', 'Axioo 4898 G', 1, 8, 6035656, '2017-05-31 14:18:55', '2017-05-31 14:18:55', NULL),
(2, '9493693830275', 'Samsung 7734 Q', 1, 21, 3994091, '2017-05-31 14:18:55', '2017-05-31 14:18:55', NULL),
(3, '8729647551301', 'Samsung 3331 R', 1, 9, 4282811, '2017-05-31 14:18:55', '2017-05-31 14:18:55', NULL),
(4, '1876513833713', 'HP 1266 J', 1, 28, 3680280, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(5, '9218793988356', 'Toshiba 1275 M', 1, 7, 6404253, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(6, '2909108908301', 'Axioo 5835 V', 1, 29, 5387033, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(7, '0231745743659', 'Toshiba 1021 Y', 1, 11, 4539772, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(8, '3369018452629', 'Asus 2928 M', 1, 34, 6986069, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(9, '2265570626908', 'Axioo 6463 U', 1, 20, 7775759, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(10, '0241409044626', 'Acer 7444 U', 1, 28, 5453238, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(11, '7184225965429', 'HP 4611 Z', 1, 9, 7718391, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(12, '9014329576116', 'Samsung 4710 U', 1, 11, 6926971, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(13, '7007722224731', 'HP 3880 Z', 1, 32, 7290787, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(14, '5771005859331', 'Axioo 3936 Y', 1, 7, 7410388, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(15, '7125844732733', 'Samsung 1366 V', 1, 21, 4295009, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(16, '9383116969425', 'Toshiba 2670 H', 1, 9, 6137639, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(17, '2083677710142', 'Axioo 7574 C', 1, 21, 7019153, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(18, '5320102948198', 'Asus 4057 S', 1, 26, 4278947, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(19, '1372382869735', 'HP 1875 S', 1, 18, 3741495, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(20, '7989650413190', 'Asus 1265 M', 1, 10, 4065159, '2017-05-31 14:18:56', '2017-05-31 14:18:56', NULL),
(21, '4375435143094', 'Samsung 8240 E', 2, 37, 4626258, '2017-05-31 14:23:59', '2017-05-31 14:23:59', NULL),
(22, '5514865700869', 'Smartfren 4577 C', 2, 18, 5131962, '2017-05-31 14:23:59', '2017-05-31 14:23:59', NULL),
(23, '2644498683406', 'Acer 2645 I', 2, 30, 4378217, '2017-05-31 14:23:59', '2017-05-31 14:23:59', NULL),
(24, '7312347539789', 'Advan 3324 A', 2, 19, 4272755, '2017-05-31 14:24:00', '2017-05-31 23:56:45', NULL),
(25, '3637515984494', 'Asus 6270 U', 2, 33, 4818760, '2017-05-31 14:24:00', '2017-05-31 14:24:00', NULL),
(26, '8770132580085', 'Asus 2009 J', 2, 6, 3931144, '2017-05-31 14:24:00', '2017-05-31 14:24:00', NULL),
(27, '2810948522339', 'Smartfren 7563 Q', 2, 14, 5971569, '2017-05-31 14:24:00', '2017-05-31 14:24:00', NULL),
(28, '4129139505104', 'Xiaomi 8524 P', 2, 9, 7538227, '2017-05-31 14:24:00', '2017-05-31 14:24:00', NULL),
(29, '0683106675602', 'Acer 4959 H', 2, 20, 4328856, '2017-05-31 14:24:00', '2017-05-31 14:24:00', NULL),
(30, '1404858875619', 'Asus 7712 A', 2, 19, 6491402, '2017-05-31 14:24:00', '2017-05-31 14:24:00', NULL),
(31, '0455521592563', 'Asus 6826 F', 2, 30, 4496872, '2017-05-31 14:24:00', '2017-05-31 14:24:00', NULL),
(32, '5849603387898', 'Xiaomi 3622 S', 2, 8, 6847274, '2017-05-31 14:24:00', '2017-05-31 14:24:00', NULL),
(33, '7729724541851', 'Samsung 3434 G', 2, 9, 5331002, '2017-05-31 14:24:00', '2017-05-31 14:24:00', NULL),
(34, '8590377528396', 'Smartfren 6410 G', 2, 32, 7457321, '2017-05-31 14:24:00', '2017-05-31 14:24:00', NULL),
(35, '8612217358533', 'Samsung 4874 K', 2, 36, 3242412, '2017-05-31 14:24:01', '2017-05-31 14:24:01', NULL),
(36, '0786447088176', 'Samsung 4234 T', 2, 35, 7040360, '2017-05-31 14:24:01', '2017-05-31 14:24:01', NULL),
(37, '4576929730527', 'Xiaomi 2613 C', 2, 28, 6037680, '2017-05-31 14:24:01', '2017-05-31 14:24:01', NULL),
(38, '9632869378740', 'Acer 2435 O', 2, 14, 4354770, '2017-05-31 14:24:01', '2017-05-31 14:24:01', NULL),
(39, '4004344095292', 'Advan 7950 F', 2, 8, 3587845, '2017-05-31 14:24:01', '2017-05-31 14:24:01', NULL),
(40, '2275434286643', 'Advan 5215 L', 2, 18, 5015945, '2017-05-31 14:24:01', '2017-05-31 14:24:01', NULL),
(41, '9617185908697', 'HP 7566 W', 3, 24, 4574513, '2017-05-31 14:24:58', '2017-05-31 14:24:58', NULL),
(42, '0143452359729', 'Acer 2860 V', 3, 38, 5280099, '2017-05-31 14:24:58', '2017-05-31 14:24:58', NULL),
(43, '0689076771252', 'Acer 8725 Z', 3, 15, 6289936, '2017-05-31 14:24:58', '2017-05-31 14:24:58', NULL),
(44, '0953196741717', 'Asus 6547 A', 3, 39, 6964815, '2017-05-31 14:24:58', '2017-05-31 14:24:58', NULL),
(45, '3572545269565', 'Acer 3408 E', 3, 17, 5820035, '2017-05-31 14:24:58', '2017-05-31 14:24:58', NULL),
(46, '9811318792652', 'HP 7940 T', 3, 19, 7594199, '2017-05-31 14:24:58', '2017-05-31 14:24:58', NULL),
(47, '0467362214122', 'HP 2109 P', 3, 18, 4563688, '2017-05-31 14:24:58', '2017-05-31 14:24:58', NULL),
(48, '0004680197845', 'Toshiba 7925 X', 3, 7, 7370499, '2017-05-31 14:24:58', '2017-05-31 14:24:58', NULL),
(49, '4515431643772', 'Axioo 7997 N', 3, 22, 3749859, '2017-05-31 14:24:59', '2017-05-31 14:24:59', NULL),
(50, '0272155853224', 'Acer 4489 U', 3, 12, 7067197, '2017-05-31 14:24:59', '2017-05-31 14:24:59', NULL),
(51, '6022837351494', 'HP 5953 M', 3, 38, 6344478, '2017-05-31 14:24:59', '2017-05-31 14:24:59', NULL),
(52, '2004949207696', 'Acer 2741 U', 3, 19, 7641399, '2017-05-31 14:24:59', '2017-05-31 14:24:59', NULL),
(53, '1340315540327', 'Acer 8815 W', 3, 14, 4990774, '2017-05-31 14:24:59', '2017-05-31 14:24:59', NULL),
(54, '0720846946927', 'HP 4589 U', 3, 34, 3940758, '2017-05-31 14:24:59', '2017-05-31 14:24:59', NULL),
(55, '9684350089604', 'Samsung 1703 A', 3, 40, 4605008, '2017-05-31 14:24:59', '2017-05-31 14:24:59', NULL),
(56, '7350531072681', 'Toshiba 2164 B', 3, 18, 7376757, '2017-05-31 14:24:59', '2017-05-31 14:24:59', NULL),
(57, '6818733039761', 'Toshiba 4585 J', 3, 40, 6945718, '2017-05-31 14:24:59', '2017-05-31 14:24:59', NULL),
(58, '4695764917327', 'Acer 1758 Z', 3, 36, 6689290, '2017-05-31 14:24:59', '2017-05-31 22:53:21', '2017-05-31 22:53:21'),
(59, '7246839859966', 'Acer 1101 K', 3, 37, 3661201, '2017-05-31 14:24:59', '2017-05-31 23:35:46', NULL),
(60, '7660752721009', 'Axioo 8105 S', 3, 31, 5063384, '2017-05-31 14:24:59', '2017-05-31 14:24:59', NULL),
(61, '5737640662538', 'Macbook Pro 1347 A', 4, 10, 21803152, '2017-05-31 14:27:21', '2017-05-31 14:27:21', NULL),
(62, '4666213173007', 'Macbook Air 8897 X', 4, 13, 27433231, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(63, '2569169066718', 'Macbook Pro 8339 B', 4, 11, 25436597, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(64, '7195686016223', 'Macbook Pro 3134 M', 4, 10, 12348246, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(65, '4844568302505', 'Macbook Pro 6862 W', 4, 16, 13618740, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(66, '0667157738639', 'Macbook Air 8630 B', 4, 19, 24418221, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(67, '9225152004114', 'Macbook Pro 2358 X', 4, 18, 17634996, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(68, '0021940681401', 'Macbook Air 5528 N', 4, 10, 25256954, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(69, '7644782384267', 'Macbook Air 1609 T', 4, 9, 29879228, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(70, '5587671112256', 'Macbook Pro 6368 D', 4, 18, 28881688, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(71, '1222929186682', 'Macbook Air 1252 K', 4, 18, 29040906, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(72, '4325376836609', 'Macbook Air 2483 M', 4, 10, 16952844, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(73, '7248368967648', 'Macbook Air 2385 K', 4, 12, 14086583, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(74, '0094161333374', 'Macbook Pro 4523 Z', 4, 6, 21452436, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(75, '9786261267444', 'Macbook Air 8568 Y', 4, 15, 17251910, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(76, '4126538615069', 'Macbook Pro 3733 N', 4, 7, 12395005, '2017-05-31 14:27:22', '2017-05-31 14:27:22', NULL),
(77, '1637692812933', 'Macbook Pro 8986 C', 4, 7, 15245763, '2017-05-31 14:27:23', '2017-05-31 14:27:23', NULL),
(78, '5478401661499', 'Macbook Pro 8126 J', 4, 13, 27905217, '2017-05-31 14:27:23', '2017-05-31 14:27:23', NULL),
(79, '1042927986660', 'Macbook Air 8865 R', 4, 12, 28404575, '2017-05-31 14:27:23', '2017-05-31 14:27:23', NULL),
(80, '9760342744895', 'Macbook Air 1565 Q', 4, 7, 17031687, '2017-05-31 14:27:23', '2017-05-31 14:27:23', NULL),
(81, '4558524012000', 'Flashdisk Kingston 32 Gb', 5, 29, 128900, '2017-05-31 14:31:20', '2017-05-31 22:53:33', '2017-05-31 22:53:33'),
(82, '3719174346094', 'Flashdisk Toshiba 32 Gb', 5, 11, 142706, '2017-05-31 14:31:20', '2017-05-31 14:31:20', NULL),
(83, '5137858711101', 'Flashdisk Vgen 32 Gb', 5, 22, 114472, '2017-05-31 14:31:20', '2017-05-31 14:31:20', NULL),
(84, '7568971837863', 'Flashdisk Philips 32 Gb', 5, 29, 114189, '2017-05-31 14:31:21', '2017-05-31 14:31:21', NULL),
(97, '5389771401007', 'Flashdisk Kingston 16 Gb', 5, 34, 94310, '2017-05-31 14:32:49', '2017-05-31 14:32:49', NULL),
(98, '7832904549964', 'Flashdisk Toshiba 16 Gb', 5, 33, 90947, '2017-05-31 14:32:49', '2017-05-31 14:32:49', NULL),
(99, '9518417358719', 'Flashdisk Philips 16 Gb', 5, 23, 93546, '2017-05-31 14:32:49', '2017-05-31 14:32:49', NULL),
(103, '7689095455686', 'Flashdisk Toshiba 8 Gb', 5, 21, 89902, '2017-05-31 14:33:13', '2017-05-31 14:33:13', NULL),
(104, '6451502355398', 'Flashdisk Philips 8 Gb', 5, 42, 68608, '2017-05-31 14:33:13', '2017-05-31 14:33:13', NULL),
(105, '6114773763575', 'Flashdisk Vgen 8 Gb', 5, 5, 77834, '2017-05-31 14:33:13', '2017-05-31 14:33:13', NULL),
(109, '2095988751158', 'Flashdisk Vgen 4 Gb', 5, 21, 52771, '2017-05-31 14:33:25', '2017-05-31 14:33:25', NULL),
(110, '0166956686573', 'Flashdisk Toshiba 4 Gb', 5, 5, 41834, '2017-05-31 14:33:25', '2017-05-31 14:33:25', NULL),
(111, '8536677477996', 'Flashdisk Kingston 4 Gb', 5, 33, 62992, '2017-05-31 14:33:25', '2017-05-31 14:33:25', NULL),
(113, '8655043204834', 'Flashdisk Philips 4 Gb', 5, 31, 44591, '2017-05-31 14:33:25', '2017-05-31 14:33:25', NULL),
(115, '6322350756500', 'Flashdisk Toshiba 2 Gb', 5, 22, 47814, '2017-05-31 14:33:38', '2017-05-31 14:33:38', NULL),
(116, '5184270055788', 'Flashdisk Philips 2 Gb', 5, 26, 33788, '2017-05-31 14:33:39', '2017-05-31 14:33:39', NULL),
(117, '2911739637833', 'Flashdisk Kingston 2 Gb', 5, 32, 48565, '2017-05-31 14:33:39', '2017-05-31 14:33:39', NULL),
(139, '3678087268759', 'Adidas 131', 9, 8, 678724, '2017-05-31 14:39:17', '2017-05-31 14:39:17', NULL),
(140, '7423453143545', 'Adidas 193', 9, 28, 323458, '2017-05-31 14:39:17', '2017-05-31 14:39:17', NULL),
(141, '8861551529967', 'Puma 406', 9, 13, 243531, '2017-05-31 14:39:17', '2017-05-31 14:39:17', NULL),
(142, '0721892873212', 'Adidas 138', 9, 6, 157983, '2017-05-31 14:39:17', '2017-05-31 14:39:17', NULL),
(143, '0309127355667', 'Nike 392', 9, 16, 606476, '2017-05-31 14:39:17', '2017-05-31 14:39:17', NULL),
(144, '0540514903348', 'Nike 139', 9, 29, 387910, '2017-05-31 14:39:17', '2017-05-31 14:39:17', NULL),
(145, '6002299178648', 'Nike 491', 9, 29, 450089, '2017-05-31 14:39:17', '2017-05-31 14:39:17', NULL),
(146, '5313273038249', 'Puma 191', 9, 24, 340104, '2017-05-31 14:39:17', '2017-05-31 14:39:17', NULL),
(147, '0444301244952', 'Nike 117', 9, 28, 120215, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(148, '7513709675439', 'Puma 489', 9, 10, 596806, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(149, '1499949061644', 'Nike 365', 9, 24, 102973, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(150, '9018078968925', 'Puma 490', 9, 21, 355075, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(151, '7446711401867', 'Nike 180', 9, 29, 236301, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(152, '2287475885389', 'Adidas 499', 9, 20, 698401, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(153, '2833188696066', 'Adidas 396', 9, 6, 308925, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(154, '1105996727227', 'Nike 341', 9, 9, 441647, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(155, '4650963650444', 'Adidas 141', 9, 8, 234940, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(156, '1750466267132', 'Adidas 449', 9, 12, 453127, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(158, '3696680874733', 'Puma 239', 9, 23, 270238, '2017-05-31 14:39:18', '2017-05-31 14:39:18', NULL),
(159, '7569101295102', 'Rendang Ifa Nadia Permata', 10, 14, 11840, '2017-05-31 14:41:01', '2017-05-31 14:41:01', NULL),
(160, '1014472030839', 'Bakso Ciaobella Zulaika S.Kom', 10, 10, 28667, '2017-05-31 14:41:01', '2017-05-31 14:41:01', NULL),
(161, '0402073223902', 'Rendang Maida Anggraini S.Farm', 10, 8, 16555, '2017-05-31 14:41:01', '2017-05-31 14:41:01', NULL),
(162, '5358656101493', 'Rendang Najwa Wulandari S.Pd', 10, 14, 11192, '2017-05-31 14:41:01', '2017-05-31 14:41:01', NULL),
(163, '6455816161744', 'Bakso Kartika Mulyani', 10, 18, 28275, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(164, '0483260339354', 'Rendang Iriana Aryani', 10, 18, 19800, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(165, '9053892295536', 'Soto Ifa Purwanti S.H.', 10, 20, 27840, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(166, '2570290268445', 'Soto Michelle Elvina Namaga S.Farm', 10, 7, 33623, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(167, '5988353070114', 'Bakso Rachel Ophelia Nuraini', 10, 18, 32837, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(168, '0442884328588', 'Soto Endah Wahyuni', 10, 13, 16287, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(169, '1160990614027', 'Bakso Ghaliyati Azalea Farida S.IP', 10, 18, 31115, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(170, '9309920973199', 'Rendang Azalea Wastuti', 10, 19, 20789, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(171, '3949317280859', 'Bakso Belinda Winarsih', 10, 16, 13713, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(172, '5283340268414', 'Bakso Putri Icha Hasanah S.E.', 10, 11, 25586, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(173, '0679024057651', 'Soto Vanesa Halimah', 10, 6, 24048, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(174, '5380545196709', 'Soto Hana Dian Usamah S.Sos', 10, 18, 11835, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(175, '7243358105956', 'Soto Dalima Safitri', 10, 14, 12786, '2017-05-31 14:41:02', '2017-05-31 14:41:02', NULL),
(176, '1154239549287', 'Rendang Ana Usada S.IP', 10, 11, 22381, '2017-05-31 14:41:03', '2017-05-31 14:41:03', NULL),
(177, '9128264955315', 'Rendang Devi Kani Safitri M.Pd', 10, 12, 18551, '2017-05-31 14:41:03', '2017-05-31 14:41:03', NULL),
(178, '3688473492873', 'Bakso Tami Cici Namaga M.Kom.', 10, 7, 24667, '2017-05-31 14:41:03', '2017-05-31 14:41:03', NULL),
(179, '7246628623631', 'Batik Tarakan', 7, 27, 129474, '2017-05-31 22:05:32', '2017-05-31 22:05:32', NULL),
(180, '2036315542339', 'Batik Ambon', 7, 53, 280160, '2017-05-31 22:05:32', '2017-05-31 22:53:28', '2017-05-31 22:53:28'),
(181, '9316235438176', 'Batik Banjar', 7, 23, 201201, '2017-05-31 22:05:32', '2017-05-31 22:05:32', NULL),
(182, '8701703429571', 'Batik Jambi', 7, 37, 314348, '2017-05-31 22:05:33', '2017-05-31 22:05:33', NULL),
(184, '1859568309440', 'Batik Pangkal Pinang', 7, 60, 359964, '2017-05-31 22:05:33', '2017-05-31 22:05:33', NULL),
(185, '8558115014747', 'Batik Tangerang', 7, 29, 81520, '2017-05-31 22:05:49', '2017-05-31 22:05:49', NULL),
(186, '9127119618054', 'Batik Pasuruan', 7, 28, 322285, '2017-05-31 22:05:49', '2017-05-31 22:05:49', NULL),
(187, '2528844256943', 'Batik Madiun', 7, 28, 181990, '2017-05-31 22:05:49', '2017-05-31 22:05:49', NULL),
(188, '8240271347189', 'Batik Bukittinggi', 7, 56, 250531, '2017-05-31 22:05:49', '2017-05-31 22:05:49', NULL),
(189, '8954726455908', 'Batik Bitung', 7, 50, 395317, '2017-05-31 22:05:49', '2017-05-31 22:05:49', NULL),
(190, '4402176506731', 'Batik Bandung', 7, 21, 391949, '2017-05-31 22:05:49', '2017-05-31 22:52:12', NULL),
(191, '9887298280823', 'Seragam SMP', 7, 33, 201347, '2017-05-31 22:06:30', '2017-05-31 22:06:30', NULL),
(192, '4716076402421', 'Seragam SMA', 7, 44, 340275, '2017-05-31 22:06:30', '2017-05-31 22:06:30', NULL),
(195, '9340338051994', 'Seragam SD', 7, 29, 84091, '2017-05-31 22:06:30', '2017-05-31 22:06:30', NULL),
(197, '3028344347244', 'Jeans Biru', 8, 47, 314772, '2017-05-31 22:07:23', '2017-05-31 22:07:23', NULL),
(198, '0027839648487', 'Jeans Hitam', 8, 41, 208474, '2017-05-31 22:07:23', '2017-05-31 22:07:23', NULL),
(203, '1927987169782', 'Burger', 11, 7, 203395, '2017-05-31 22:08:24', '2017-05-31 22:08:24', NULL),
(206, '4033459612780', 'Spagheti', 11, 36, 63819, '2017-05-31 22:08:25', '2017-05-31 22:08:25', NULL),
(207, '2890981966345', 'Pizza', 11, 22, 66487, '2017-05-31 22:08:25', '2017-05-31 22:08:25', NULL),
(209, '5100653657875', 'Honda Vario 2010', 13, 18, 20209091, '2017-05-31 22:11:42', '2017-05-31 22:11:42', NULL),
(210, '4827089676218', 'Honda Vario 2017', 13, 24, 15690342, '2017-05-31 22:11:42', '2017-05-31 22:11:42', NULL),
(211, '5386542067899', 'Honda Supra Fit 2016', 13, 27, 21444501, '2017-05-31 22:11:42', '2017-05-31 22:11:42', NULL),
(212, '0511625905460', 'Honda Beat 2016', 13, 21, 23824267, '2017-05-31 22:11:42', '2017-05-31 22:11:42', NULL),
(213, '2495873876612', 'Honda Supra Fit 2015', 13, 31, 21710883, '2017-05-31 22:11:42', '2017-05-31 22:11:42', NULL),
(214, '5940869968521', 'Honda Beat 2013', 13, 20, 16291256, '2017-05-31 22:11:42', '2017-05-31 22:11:42', NULL),
(215, '6930249013841', 'Yamaha Vega R 2016', 13, 10, 19171355, '2017-05-31 22:12:19', '2017-05-31 22:12:19', NULL),
(216, '8942134140653', 'Yamaha Mio 2012', 13, 11, 22013114, '2017-05-31 22:12:19', '2017-05-31 22:12:19', NULL),
(217, '0832693418073', 'Yamaha Jupiter 2012', 13, 10, 16707931, '2017-05-31 22:12:19', '2017-05-31 22:12:19', NULL),
(218, '9217893565993', 'Yamaha Jupiter 2010', 13, 40, 19292037, '2017-05-31 22:12:19', '2017-05-31 22:12:19', NULL),
(219, '4245941081978', 'Yamaha Vega R 2012', 13, 20, 17233469, '2017-05-31 22:12:19', '2017-05-31 22:12:19', NULL),
(220, '0029964958165', 'Yamaha Jupiter 2017', 13, 16, 20839764, '2017-05-31 22:12:20', '2017-05-31 22:12:20', NULL),
(221, '8040639213190', 'Toshiba 320Gb 2011', 14, 34, 366276, '2017-05-31 22:14:54', '2017-05-31 22:14:54', NULL),
(222, '6888283672466', 'Toshiba 320Gb 2017', 14, 11, 310073, '2017-05-31 22:14:54', '2017-05-31 22:53:39', '2017-05-31 22:53:39'),
(223, '2350209880612', 'Vgen 320Gb 2013', 14, 39, 425236, '2017-05-31 22:14:54', '2017-05-31 22:14:54', NULL),
(224, '1024662794540', 'Samsung 320Gb 2011', 14, 11, 394572, '2017-05-31 22:14:54', '2017-05-31 22:14:54', NULL),
(226, '5437773193663', 'Vgen 320Gb 2010', 14, 26, 392445, '2017-05-31 22:14:54', '2017-05-31 22:14:54', NULL),
(227, '3196303319615', 'Vgen 500Gb 2016', 14, 23, 797599, '2017-05-31 22:15:22', '2017-05-31 22:15:22', NULL),
(228, '9371765199157', 'Vgen 500Gb 2015', 14, 27, 589369, '2017-05-31 22:15:22', '2017-05-31 22:15:22', NULL),
(229, '6747585289607', 'Vgen 500Gb 2010', 14, 9, 714738, '2017-05-31 22:15:22', '2017-05-31 22:15:22', NULL),
(230, '2848436231449', 'Toshiba 500Gb 2014', 14, 29, 897328, '2017-05-31 22:15:22', '2017-05-31 22:15:22', NULL),
(231, '6185600751157', 'Toshiba 500Gb 2010', 14, 12, 818347, '2017-05-31 22:15:22', '2017-05-31 22:15:22', NULL),
(232, '2540138602380', 'Toshiba 500Gb 2016', 14, 35, 534926, '2017-05-31 22:15:22', '2017-05-31 22:15:22', NULL),
(233, '7950795309662', 'Vgen 1Tb 2017', 14, 13, 1079020, '2017-05-31 22:15:48', '2017-05-31 22:15:48', NULL),
(235, '9855789365281', 'Toshiba 1Tb 2017', 14, 40, 864874, '2017-05-31 22:15:48', '2017-05-31 22:15:48', NULL),
(236, '2725029073368', 'Samsung 1Tb 2013', 14, 33, 1076469, '2017-05-31 22:15:48', '2017-05-31 22:15:48', NULL),
(239, '3272890148149', 'TipeX', 15, 27, 4145, '2017-05-31 22:17:16', '2017-05-31 22:17:16', NULL),
(240, '9823944925335', 'Buku Tulis', 15, 32, 3984, '2017-05-31 22:17:16', '2017-05-31 22:17:16', NULL),
(241, '4250467162902', 'Pensil 2B', 15, 17, 3825, '2017-05-31 22:17:16', '2017-05-31 22:17:16', NULL),
(242, '5749889134264', 'Penghapus', 15, 13, 2511, '2017-05-31 22:17:16', '2017-05-31 22:17:16', NULL),
(245, '1784147540542', 'Ranjang', 16, 26, 4348120, '2017-05-31 22:19:01', '2017-05-31 22:19:01', NULL),
(247, '2505223304433', 'Meja', 16, 15, 2103827, '2017-05-31 22:19:02', '2017-05-31 22:19:02', NULL),
(248, '5807098744817', 'Kursi', 16, 30, 2020092, '2017-05-31 22:19:02', '2017-05-31 22:19:02', NULL),
(250, '4252187544341', 'Meja Belajar', 16, 24, 2018580, '2017-05-31 22:19:02', '2017-05-31 22:19:02', NULL),
(257, '3556059236077', 'LAN', 17, 17, 4551, '2017-05-31 22:21:14', '2017-05-31 22:21:14', NULL),
(259, '4483913484994', 'Biru', 17, 18, 2883, '2017-05-31 22:21:14', '2017-05-31 22:21:14', NULL),
(260, '2479975126431', 'USB', 17, 28, 2131, '2017-05-31 22:21:14', '2017-05-31 22:21:14', NULL),
(261, '9652307611062', 'UTP', 17, 27, 4340, '2017-05-31 22:21:15', '2017-05-31 22:21:15', NULL),
(262, '7676903184043', 'Hitam', 17, 7, 2056, '2017-05-31 22:21:15', '2017-05-31 22:21:15', NULL),
(263, '9839493849389489', 'ujicoba', 18, 8, 3000, '2017-05-31 23:30:21', '2017-05-31 23:30:46', '2017-05-31 23:30:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_changes`
--

CREATE TABLE `stock_changes` (
  `id` int(10) UNSIGNED NOT NULL,
  `product` int(10) UNSIGNED NOT NULL,
  `change` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_changes`
--

INSERT INTO `stock_changes` (`id`, `product`, `change`, `created_at`) VALUES
(1, 263, 5, '2017-05-31 23:30:39'),
(2, 24, 20, '2017-05-31 23:56:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `nota` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payin` double NOT NULL,
  `cashier` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `nota`, `created_at`, `payin`, `cashier`) VALUES
(1, '20170601063232', '2017-05-31 23:32:32', 11000000, 1),
(2, '20170601063546', '2017-05-31 23:35:46', 11000000, 1),
(3, '20170601063645', '2017-05-31 23:36:45', 30000000, 1),
(4, '20170601012116', '2017-05-31 18:21:16', 20000000, 1),
(5, '20170601012116', '2017-05-31 18:21:16', 0, 1),
(6, '20170601012117', '2017-05-31 18:21:17', 0, 1),
(7, '20170601012117', '2017-05-31 18:21:17', 0, 1),
(8, '20170601012117', '2017-05-31 18:21:17', 0, 1),
(9, '20170601012117', '2017-05-31 18:21:17', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_login` (`login`);

--
-- Indexes for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cashiers_login_unique` (`login`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `detail_transactions`
--
ALTER TABLE `detail_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detil_transaksi` (`transaction`),
  ADD KEY `fk_detail_product` (`product`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `logins_username_unique` (`username`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `managers_login_unique` (`login`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_barcode_unique` (`barcode`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD KEY `products_category_foreign` (`category`);

--
-- Indexes for table `stock_changes`
--
ALTER TABLE `stock_changes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_changes_product_foreign` (`product`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaksi_kasir` (`cashier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `detail_transactions`
--
ALTER TABLE `detail_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;
--
-- AUTO_INCREMENT for table `stock_changes`
--
ALTER TABLE `stock_changes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_login` FOREIGN KEY (`login`) REFERENCES `logins` (`id`);

--
-- Ketidakleluasaan untuk tabel `cashiers`
--
ALTER TABLE `cashiers`
  ADD CONSTRAINT `cashiers_login_foreign` FOREIGN KEY (`login`) REFERENCES `logins` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_transactions`
--
ALTER TABLE `detail_transactions`
  ADD CONSTRAINT `fk_detail_product` FOREIGN KEY (`product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_detil_transaksi` FOREIGN KEY (`transaction`) REFERENCES `transactions` (`id`);

--
-- Ketidakleluasaan untuk tabel `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `managers_login_foreign` FOREIGN KEY (`login`) REFERENCES `logins` (`id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_foreign` FOREIGN KEY (`category`) REFERENCES `categories` (`id`);

--
-- Ketidakleluasaan untuk tabel `stock_changes`
--
ALTER TABLE `stock_changes`
  ADD CONSTRAINT `stock_changes_product_foreign` FOREIGN KEY (`product`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transaksi_kasir` FOREIGN KEY (`cashier`) REFERENCES `cashiers` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
