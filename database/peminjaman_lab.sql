-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Sep 2026 pada 08.41
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_lab`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `password`, `nama_admin`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangs`
--

CREATE TABLE `barangs` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `kondisi` enum('baik','rusak','perbaikan') DEFAULT 'baik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barangs`
--

INSERT INTO `barangs` (`id_barang`, `kode_barang`, `nama_barang`, `kategori`, `stok`, `kondisi`) VALUES
(1, 'LP-001', 'Laptop Asus VivoBook 14', 'Laptop', 5, 'baik'),
(2, 'LP-002', 'Laptop Lenovo ThinkPad', 'Laptop', 3, 'baik'),
(3, 'LP-003', 'Laptop Acer Aspire 5', 'Laptop', 5, 'baik'),
(4, 'PJ-001', 'Proyektor Epson EB-X05', 'Proyektor', 2, 'baik'),
(5, 'PJ-002', 'Proyektor BenQ MX560', 'Proyektor', 1, 'perbaikan'),
(6, 'KB-001', 'Kabel HDMI 2 meter', 'Kabel', 8, 'baik'),
(7, 'KB-002', 'Kabel LAN Cat6', 'Kabel', 20, 'baik'),
(8, 'RT-001', 'Router TP-Link Archer C6', 'Jaringan', 3, 'baik'),
(9, 'SW-001', 'Switch Cisco 24 Port', 'Jaringan', 2, 'baik'),
(10, 'MN-001', 'Mouse Logitech Wireless', 'Aksesoris', 15, 'baik'),
(11, 'apa-1', 'entahlah', 'elektronik', 5, 'baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_peminjamans`
--

CREATE TABLE `detail_peminjamans` (
  `id_detail` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_peminjamans`
--

INSERT INTO `detail_peminjamans` (`id_detail`, `id_pinjam`, `id_barang`, `jumlah`) VALUES
(1, 1, 1, 1),
(2, 1, 6, 2),
(3, 2, 4, 1),
(4, 3, 2, 1),
(5, 4, 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id_pinjam` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('dipinjam','dikembalikan') DEFAULT 'dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjamans`
--

INSERT INTO `peminjamans` (`id_pinjam`, `id_siswa`, `id_admin`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(1, 1, 1, '2026-09-20', '2026-09-23', 'dipinjam'),
(2, 3, 1, '2026-09-21', '2026-09-24', 'dikembalikan'),
(3, 2, 1, '2026-09-15', '2026-09-18', 'dikembalikan'),
(4, 5, 1, '2026-09-10', '2026-09-13', 'dikembalikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalians`
--

CREATE TABLE `pengembalians` (
  `id_kembali` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `tanggal_dikembalikan` date NOT NULL,
  `kondisi_kembali` varchar(50) DEFAULT NULL,
  `denda` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengembalians`
--

INSERT INTO `pengembalians` (`id_kembali`, `id_pinjam`, `tanggal_dikembalikan`, `kondisi_kembali`, `denda`) VALUES
(1, 3, '2026-09-17', 'baik', 0),
(2, 4, '2026-09-16', 'baik', 6000),
(3, 2, '2026-09-22', 'baik', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id_siswa`, `nis`, `password`, `nama_siswa`, `kelas`, `no_hp`) VALUES
(1, '2024001', '3afa0d81296a4f17d477ec823261b1ec', 'Andi Pratama', 'XII RPL 1', '081234567890'),
(2, '2024002', '3afa0d81296a4f17d477ec823261b1ec', 'Budi Santoso', 'XII RPL 1', '081234567891'),
(3, '2024003', '3afa0d81296a4f17d477ec823261b1ec', 'Citra Dewi', 'XII RPL 2', '081234567892'),
(4, '2024004', '3afa0d81296a4f17d477ec823261b1ec', 'Dina Ayu', 'XII RPL 2', '081234567893'),
(5, '2024005', '3afa0d81296a4f17d477ec823261b1ec', 'Eko Wijaya', 'XI RPL 1', '081234567894'),
(6, '2024006', '3afa0d81296a4f17d477ec823261b1ec', 'Fitri Handayani', 'XI RPL 1', '081234567895'),
(7, '2024007', '3afa0d81296a4f17d477ec823261b1ec', 'Gilang Ramadhan', 'XI RPL 2', '081234567896'),
(8, '2024008', '3afa0d81296a4f17d477ec823261b1ec', 'Hana Salsabila', 'X RPL 1', '081234567897'),
(9, '00001', '3afa0d81296a4f17d477ec823261b1ec', 'Lares', 'XI RPL 3', '087777777');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pinjam` (`id_pinjam`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `pengembalians`
--
ALTER TABLE `pengembalians`
  ADD PRIMARY KEY (`id_kembali`),
  ADD KEY `id_pinjam` (`id_pinjam`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengembalians`
--
ALTER TABLE `pengembalians`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  ADD CONSTRAINT `detail_peminjamans_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjamans` (`id_pinjam`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_peminjamans_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barangs` (`id_barang`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswas` (`id_siswa`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamans_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id_admin`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengembalians`
--
ALTER TABLE `pengembalians`
  ADD CONSTRAINT `pengembalians_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjamans` (`id_pinjam`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
