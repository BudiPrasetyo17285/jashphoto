-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2025 at 08:24 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jasphoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_product` int NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `status` enum('menunggu','fix') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Wedding'),
(2, 'Foto Produk'),
(3, 'Portrait'),
(4, 'Foto Keluarga'),
(5, 'Event'),
(6, 'Wisuda');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `id_fotografer` int NOT NULL,
  `id_kategori` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `id_fotografer`, `id_kategori`, `nama`, `harga`, `deskripsi`, `image`) VALUES
(1, 10, 1, 'Paket Wedding Silver', 3500000, 'Paket pemotretan wedding dasar dengan 1 fotografer dan 1 asisten, durasi 4 jam.', '[\"wedding_silver_1.jpg\", \"wedding_silver_2.jpg\"]'),
(2, 10, 1, 'Paket Wedding Gold', 5500000, 'Paket wedding lengkap dengan 2 fotografer, premium editing, dan album cetak.', '[\"wedding_gold_1.jpg\", \"wedding_gold_2.jpg\"]'),
(3, 10, 2, 'Paket Foto Produk Basic', 500000, 'Foto produk untuk katalog online dengan editing standar. Maksimal 10 produk.', '[\"produk_basic_1.jpg\", \"produk_basic_2.jpg\"]'),
(4, 10, 2, 'Paket Foto Produk Premium', 1200000, 'Foto produk dengan lighting profesional dan advanced retouching.', '[\"produk_premium_1.jpg\", \"produk_premium_2.jpg\"]'),
(5, 10, 3, 'Paket Foto Studio Portrait', 750000, 'Sesi foto portrait indoor dengan backdrop profesional dan 10 hasil edit.', '[\"portrait_studio_1.jpg\", \"portrait_studio_2.jpg\"]'),
(6, 10, 3, 'Paket Outdoor Portrait', 900000, 'Pemotretan outdoor 2 jam, termasuk 15 foto yang di-retouch.', '[\"portrait_outdoor_1.jpg\", \"portrait_outdoor_2.jpg\"]'),
(7, 10, 4, 'Paket Foto Keluarga', 1500000, 'Foto keluarga outdoor dengan konsep santai. Termasuk 20 foto edit.', '[\"foto_keluarga_1.jpg\", \"foto_keluarga_2.jpg\"]'),
(8, 10, 5, 'Paket Foto Event Basic', 2000000, 'Dokumentasi event kecil (maks 3 jam) dengan 1 fotografer.', '[\"event_basic_1.jpg\", \"event_basic_2.jpg\"]'),
(9, 10, 5, 'Paket Foto Event Premium', 4000000, 'Dokumentasi event besar (6 jam) dengan 2 fotografer dan video short clip.', '[\"event_premium_1.jpg\", \"event_premium_2.jpg\"]'),
(10, 10, 2, 'Paket Foto Wisuda', 500000, 'Foto wisuda individu outdoor atau indoor. Termasuk 10 foto edit.', '[\"foto_wisuda_1.jpg\", \"foto_wisuda_2.jpg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_hp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` enum('pengguna','fotografer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pengguna'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `alamat`, `no_hp`, `role`) VALUES
(10, 'Jono Photo', '$2y$10$zsgeCUM9Pm3iOj3Yjx7nsO/luzHAMrsd4VsWAV8G1uTgvFIPpVNOe', NULL, NULL, 'pengguna');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_fotografer` (`id_fotografer`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `id_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `id_fotografer` FOREIGN KEY (`id_fotografer`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
