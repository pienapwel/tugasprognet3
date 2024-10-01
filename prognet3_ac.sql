-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Okt 2024 pada 17.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prognet3_ac`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ac`
--

CREATE TABLE `data_ac` (
  `id` int(11) NOT NULL,
  `suhu` decimal(5,2) DEFAULT NULL,
  `kelembapan` decimal(5,2) DEFAULT NULL,
  `status_ac` varchar(50) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_ac`
--

INSERT INTO `data_ac` (`id`, `suhu`, `kelembapan`, `status_ac`, `waktu`) VALUES
(27, 16.00, 33.00, 'AC Bekerja Sedang', '2024-10-01 15:25:06'),
(28, 30.00, 20.00, 'AC Bekerja Sedang', '2024-10-01 15:25:26'),
(29, 30.00, 20.00, 'AC Bekerja Sedang', '2024-10-01 15:25:56'),
(30, 30.00, 40.00, 'AC Bekerja Sedang', '2024-10-01 15:26:13'),
(31, 33.00, 22.00, 'AC Mati', '2024-10-01 15:26:59'),
(32, 33.00, 33.00, 'AC Mati', '2024-10-01 15:32:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_ac`
--
ALTER TABLE `data_ac`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_ac`
--
ALTER TABLE `data_ac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
