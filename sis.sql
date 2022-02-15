-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Feb 2022 pada 05.31
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendances_log`
--

CREATE TABLE `attendances_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `santri_id` int(10) UNSIGNED NOT NULL COMMENT 'NIS Santri',
  `checkroll_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `attendances_log`
--

INSERT INTO `attendances_log` (`id`, `santri_id`, `checkroll_time`) VALUES
(2, 3528, '2022-02-10 10:44:56'),
(3, 12345, '2022-02-10 10:45:00'),
(4, 3528, '2022-02-10 10:45:04'),
(5, 12345, '2022-02-10 10:45:11'),
(6, 3528, '2022-02-10 11:50:13'),
(7, 12345, '2022-02-10 11:50:20'),
(8, 12345, '2022-02-11 07:00:00'),
(9, 12345, '2022-02-11 13:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendance_time`
--

CREATE TABLE `attendance_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `attendance_time`
--

INSERT INTO `attendance_time` (`id`, `hari`, `start_time`, `end_time`) VALUES
(1, 'Senin', '07:30:00', '12:30:00'),
(2, 'Selasa', '07:30:00', '12:30:00'),
(3, 'Rabu', '07:30:00', '12:30:00'),
(4, 'Kamis', '07:30:00', '12:30:00'),
(5, 'Jumat', '07:30:00', '15:30:00'),
(6, 'Sabtu', '07:30:00', '15:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `santri_id` int(10) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED DEFAULT NULL,
  `is_paid` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bills`
--

INSERT INTO `bills` (`id`, `santri_id`, `amount`, `is_paid`, `created_at`, `created_by`) VALUES
(6, 3528, 2000, 0, '2022-02-15 09:46:48', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bill_items`
--

CREATE TABLE `bill_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(10) UNSIGNED NOT NULL,
  `retail_sub_item_id` int(10) UNSIGNED NOT NULL,
  `total_item` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bill_items`
--

INSERT INTO `bill_items` (`id`, `bill_id`, `retail_sub_item_id`, `total_item`) VALUES
(10, 6, 8, 1),
(11, 6, 8, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `icon` varchar(30) DEFAULT 'NULL',
  `sequence` int(10) UNSIGNED DEFAULT NULL,
  `parrent_id` int(10) UNSIGNED DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL COMMENT 'ID Role',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `icon`, `sequence`, `parrent_id`, `role_id`, `created_at`) VALUES
(12, 'Dashboard', '', 'NULL', NULL, NULL, 1, '2022-02-08 15:09:18'),
(13, 'Dashboard', 'dashboard', 'fa fa-home', 1, 12, 1, '2022-02-08 15:09:34'),
(14, 'Master Data', '', NULL, NULL, NULL, 1, '2022-02-08 15:10:13'),
(15, 'Category Item', 'category-items', 'fas fa-archive', 2, 14, 1, '2022-02-08 15:11:08'),
(16, 'List Item', 'items', 'fas fa-bars', 3, 14, 1, '2022-02-08 15:11:30'),
(17, 'Dashboard', '', NULL, NULL, NULL, 2, '2022-02-08 15:09:18'),
(18, 'Dashboard', 'dashboard', 'fa fa-home', 1, 17, 2, '2022-02-08 15:09:34'),
(19, 'Master Data', '', NULL, NULL, NULL, 2, '2022-02-08 15:10:13'),
(20, 'Category Item', 'category-items', 'fas fa-archive', 2, 19, 2, '2022-02-08 15:11:08'),
(21, 'List Item', 'items', 'fas fa-bars', 3, 19, 2, '2022-02-08 15:11:30'),
(22, 'Transaction', '', NULL, NULL, NULL, 2, '2022-02-08 15:10:13'),
(23, 'Proses Transaksi', 'transaction', 'fab fa-amazon-pay', NULL, 22, 2, '2022-02-08 15:10:13'),
(24, 'List Transaksi', 'transaction/list', 'fab fa-slack', NULL, 22, 2, '2022-02-08 15:10:13'),
(25, 'Data Santri', 'santri', 'fas fa-users', 4, 14, 1, '2022-02-08 15:11:30'),
(26, 'Data Orang Tua', 'parrents', 'fas fa-users', 5, 14, 1, '2022-02-08 15:11:30'),
(27, 'Attendance', '', NULL, NULL, NULL, 1, '2022-02-08 15:10:13'),
(28, 'Daftar Kehadiran', 'attendances', 'far fa-list-alt', 1, 27, 1, '2022-02-08 15:10:13'),
(29, 'Report Kehadiran', 'report-attendances', 'far fa-list-alt', 1, 27, 1, '2022-02-08 15:10:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `parrents`
--

CREATE TABLE `parrents` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `parrents`
--

INSERT INTO `parrents` (`id`, `nama_lengkap`, `email`, `phone`, `created_at`) VALUES
(2, 'Orang Tua', 'orangtua@gmail.com', '089123617234', '2022-02-10 09:01:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `retail_category_items`
--

CREATE TABLE `retail_category_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `retail_category_items`
--

INSERT INTO `retail_category_items` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', '2022-02-08 09:30:12', NULL),
(2, 'Minuman', '2022-02-08 09:52:49', NULL),
(3, 'Perlengkapan Ibadah', '2022-02-08 10:28:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `retail_items`
--

CREATE TABLE `retail_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `retail_category_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID Retail Category Item',
  `price` int(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `retail_items`
--

INSERT INTO `retail_items` (`id`, `title`, `retail_category_id`, `price`, `created_at`, `updated_at`) VALUES
(2, 'Chocolatos', 1, 1000, '2022-02-08 09:52:24', '2022-02-08 13:31:02'),
(4, 'Sarung', 3, 60000, '2022-02-08 14:49:50', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `retail_sub_items`
--

CREATE TABLE `retail_sub_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `barcode` varchar(15) NOT NULL DEFAULT 'NULL',
  `retail_item_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID Retail Item',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `retail_sub_items`
--

INSERT INTO `retail_sub_items` (`id`, `barcode`, `retail_item_id`, `created_at`, `updated_at`) VALUES
(8, '8993365132', 2, '2022-02-08 14:41:22', '2022-02-15 10:32:12'),
(9, '8993365132535', 2, '2022-02-15 10:32:23', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`) VALUES
(1, 'Administrator', 'admin'),
(2, 'Kasir', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `santri`
--

CREATE TABLE `santri` (
  `nis` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tag_id` varchar(15) DEFAULT NULL,
  `walletamount` int(10) DEFAULT NULL,
  `parrent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `santri`
--

INSERT INTO `santri` (`nis`, `nama_lengkap`, `tag_id`, `walletamount`, `parrent_id`, `created_at`, `updated_at`) VALUES
(3528, 'Fatoni', 'F0909', 200000, NULL, '2022-02-10 09:40:55', '2022-02-10 09:41:19'),
(12343, 'Masa', 'F12342', 121231, 2, '2022-02-09 15:36:45', '2022-02-10 09:09:55'),
(12345, 'Ahmad', 'F1234', 1200000, 2, '2022-02-09 15:36:45', '2022-02-10 09:09:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID Role',
  `cookie` varchar(100) DEFAULT 'NULL',
  `status` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `role_id`, `cookie`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$sTV3BdKbGUzAGTNdfx1M7.lmA7a2QM9ML/a1uLAkb/oWkbrqKEzLG', 'Administrator', 1, 'NULL', 1, '2022-02-08 08:19:05', NULL),
(2, 'kasir', '$2y$10$sTV3BdKbGUzAGTNdfx1M7.lmA7a2QM9ML/a1uLAkb/oWkbrqKEzLG', 'Kasir', 2, 'NULL', 1, '2022-02-08 15:07:20', '2022-02-08 15:07:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `attendances_log`
--
ALTER TABLE `attendances_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `santri att fk` (`santri_id`);

--
-- Indeks untuk tabel `attendance_time`
--
ALTER TABLE `attendance_time`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `santri fk` (`santri_id`);

--
-- Indeks untuk tabel `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill id fk` (`bill_id`),
  ADD KEY `retail item fk` (`retail_sub_item_id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `parrents`
--
ALTER TABLE `parrents`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `retail_category_items`
--
ALTER TABLE `retail_category_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `retail_items`
--
ALTER TABLE `retail_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id_fk` (`retail_category_id`);

--
-- Indeks untuk tabel `retail_sub_items`
--
ALTER TABLE `retail_sub_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_fk` (`retail_item_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `parrent id fk` (`parrent_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `attendances_log`
--
ALTER TABLE `attendances_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `attendance_time`
--
ALTER TABLE `attendance_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `parrents`
--
ALTER TABLE `parrents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `retail_category_items`
--
ALTER TABLE `retail_category_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `retail_items`
--
ALTER TABLE `retail_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `retail_sub_items`
--
ALTER TABLE `retail_sub_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `attendances_log`
--
ALTER TABLE `attendances_log`
  ADD CONSTRAINT `santri att fk` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `santri fk` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bill_items`
--
ALTER TABLE `bill_items`
  ADD CONSTRAINT `bill id fk` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retail item fk` FOREIGN KEY (`retail_sub_item_id`) REFERENCES `retail_sub_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `retail_items`
--
ALTER TABLE `retail_items`
  ADD CONSTRAINT `category_id_fk` FOREIGN KEY (`retail_category_id`) REFERENCES `retail_category_items` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `retail_sub_items`
--
ALTER TABLE `retail_sub_items`
  ADD CONSTRAINT `item_fk` FOREIGN KEY (`retail_item_id`) REFERENCES `retail_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD CONSTRAINT `parrent id fk` FOREIGN KEY (`parrent_id`) REFERENCES `parrents` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
