-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 01 Okt 2019 pada 23.07
-- Versi server: 5.7.17-log
-- Versi PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_osis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_no` int(2) NOT NULL,
  `pilihan` bigint(200) NOT NULL,
  `aktif` varchar(1) NOT NULL,
  `user` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_hasil`
--

INSERT INTO `tb_hasil` (`id_no`, `pilihan`, `aktif`, `user`) VALUES
(29, 1, 'A', 2),
(31, 3, 'A', 3),
(32, 1, 'A', 2),
(33, 2, 'A', 2),
(34, 2, 'A', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemilihanosis`
--

CREATE TABLE `tb_pemilihanosis` (
  `id_biodata` int(2) NOT NULL,
  `no_calon` int(2) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `warna` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_pemilihanosis`
--

INSERT INTO `tb_pemilihanosis` (`id_biodata`, `no_calon`, `nama`, `gambar`, `warna`) VALUES
(1, 1, 'Najua Septiana', 'najua.jpg', '#800000'),
(2, 2, 'Daffa Atmagora', 'daffa.jpg', '#0000ff'),
(3, 3, 'Bunga', 'Hydrangeas.jpg', '#ff8000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`) VALUES
(1, 'Admin', '12345'),
(2, 'User1', 'aaaaa'),
(3, 'User2', 'bbbbb');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id_no`);

--
-- Indeks untuk tabel `tb_pemilihanosis`
--
ALTER TABLE `tb_pemilihanosis`
  ADD PRIMARY KEY (`id_biodata`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id_no` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tb_pemilihanosis`
--
ALTER TABLE `tb_pemilihanosis`
  MODIFY `id_biodata` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
