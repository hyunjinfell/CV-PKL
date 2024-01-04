-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jan 2024 pada 12.41
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sie`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `id_dokumentasi` int(11) NOT NULL,
  `id_ekskul` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekskul`
--

CREATE TABLE `ekskul` (
  `id_ekskul` int(11) NOT NULL,
  `nama_ekskul` varchar(50) NOT NULL,
  `penanggung_jawab` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ekskul`
--

INSERT INTO `ekskul` (`id_ekskul`, `nama_ekskul`, `penanggung_jawab`, `lokasi`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(30, 'Basket', 'Pak Eky', 'Labana', 'senin', '15:30:00', '18:00:00'),
(31, 'Voli', 'Pak Eky', 'Labana', 'senin', '15:30:00', '17:00:00'),
(32, 'Birama', 'Bapak', 'Ruang Musik', 'selasa', '15:30:00', '17:00:00'),
(33, 'Futsal', 'Pak Idin', 'Lapangan Sampo', 'kamis', '15:30:00', '18:00:00'),
(35, 'GVED', 'Bapak', 'Ruang 2', 'kamis', '15:30:00', '17:00:00'),
(36, 'Seni Tari', 'Ibu', 'Labana', 'kamis', '15:30:00', '17:00:00'),
(38, 'Rohis', 'Ibu', 'Masjid SMKN 4 Malang', 'sabtu', '09:00:00', '12:00:00'),
(39, 'Broadcasting', 'Bapak', 'Hall Lt.3', 'sabtu', '09:00:00', '12:00:00'),
(40, 'Pramuka', 'Bapak', 'Labana', 'sabtu', '08:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembina`
--

CREATE TABLE `pembina` (
  `id_pembina` int(11) NOT NULL,
  `nama_pembina` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_ekskul` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembina`
--

INSERT INTO `pembina` (`id_pembina`, `nama_pembina`, `username`, `password`, `id_ekskul`, `role`) VALUES
(1, 'Pak Eky', 'pembinabasket', 'pembinabasket', 30, 2),
(2, 'Pak Eky', 'pembinavoli', 'pembinavoli', 31, 2),
(3, 'Bapak', 'pembinabirama', 'pembinabirama', 32, 2),
(4, 'Pak Idin', 'pembinafutsal', 'pembinafutsal', 33, 2),
(5, 'Ibu', 'pembinasenitari', 'pembinasenitari', 36, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_ekskul` int(10) NOT NULL,
  `nama_pengumuman` varchar(300) CHARACTER SET utf8 NOT NULL,
  `isi_pengumuman` varchar(300) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id_ekskul`, `nama_pengumuman`, `isi_pengumuman`) VALUES
(1, 'Pengumuman 1', 'isi Pengumuman 1'),
(5, 'Pengumuman 2', 'Pengumuman 2'),
(6, 'Pengumuman 3', 'Pengumuman 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `registrasi`
--

CREATE TABLE `registrasi` (
  `id_registrasi` int(11) NOT NULL,
  `id_ekskul` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `registrasi`
--

INSERT INTO `registrasi` (`id_registrasi`, `id_ekskul`, `id_siswa`, `tanggal_daftar`) VALUES
(18, 33, 43, '2023-12-03'),
(19, 31, 44, '2023-12-03'),
(20, 32, 46, '2023-12-03'),
(21, 39, 47, '2023-12-03'),
(22, 33, 48, '2023-12-03'),
(23, 39, 49, '2023-12-03'),
(24, 40, 50, '2023-12-03'),
(25, 30, 52, '2023-12-03'),
(26, 35, 53, '2023-12-03'),
(27, 32, 70, '2023-12-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `Jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `kelas` varchar(55) NOT NULL,
  `kelas1` varchar(55) NOT NULL,
  `nilai` varchar(55) NOT NULL,
  `rombel` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL DEFAULT 'Belum Diterima'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama_siswa`, `tempat_lahir`, `tanggal_lahir`, `Jenis_kelamin`, `tanggal_daftar`, `username`, `password`, `kelas`, `kelas1`, `nilai`, `rombel`, `keterangan`) VALUES
(43, '22749', 'Nefarrah Risqi Ananda Suhanto', 'Malang', '2006-09-10', 'Perempuan', '2023-11-21', 'farah', 'farah', 'RPL B', 'XI', 'B', '36', 'Diterima'),
(44, '22748', 'Najia Binazir', 'Malang', '2006-09-17', 'Perempuan', '2023-11-21', 'najia', 'najia', 'RPL B', 'XI', 'C', '31', 'Diterima'),
(46, '22729', 'Aurelya Dea Savira', 'Malang', '2007-06-15', 'Perempuan', '2023-11-21', 'vira', 'vira', 'RPL B', 'XI', 'B', '32', 'Diterima'),
(47, '22756', 'Winda Karunia Sari', 'Malang', '2007-07-16', 'Perempuan', '2023-11-21', 'winda', 'winda', 'RPL B', 'XI', 'A', '39', 'Diterima'),
(48, '22735', 'Garcia Fernanda Valenca Archadea', 'Malang', '2007-09-19', 'Laki-Laki', '2023-11-21', 'valen', 'valen', 'RPL B', 'XI', '', '33', 'Diterima'),
(49, '22724', 'Ahmad Dimas Adi Syaputra', 'Malang', '2000-04-03', 'Laki-Laki', '2023-11-21', 'dimas', 'dimas', 'RPL B', 'XI', '  ', '39', 'Belum Diterima'),
(50, '22723', 'Achmad Rasya Panca Putra', 'Malang', '2006-09-15', 'Laki-Laki', '2023-11-21', 'rasya', 'rasya', 'RPL B', 'XI', '  ', '40', 'Belum Diterima'),
(52, '22731', 'Cheeryl Diandra Paramitha', 'Malang', '2000-10-25', 'Perempuan', '2023-11-21', 'cheril', 'cheril', 'RPL B', 'XI', 'C', '30', 'Diterima'),
(53, '22747', 'Nadin Wibian Siska', 'Malang', '2000-10-03', 'Perempuan', '2023-11-21', 'nadin', 'nadin', 'RPL B', 'XI', '', '35', 'Belum Diterima'),
(70, '22749', 'Nefarrah Risqi Ananda Suhanto', 'Malang', '2006-09-10', 'Perempuan', '2023-11-23', 'farah', 'farah', 'RPL B', 'XI', 'B', '32', 'Diterima'),
(83, '22748', 'Najia Binazir', 'Malang', '2006-09-17', 'Perempuan', '2023-12-04', '', '', 'RPL B', 'XI', '', '35', 'Belum Diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `nis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `id_siswa`, `nis`) VALUES
(1, 'admin', 'admin', '1', 43, 0),
(2, 'siswa', 'siswa', '0', 44, 0),
(3, 'najia', 'najia', '0', 44, 22748),
(4, 'farah', 'farah', '0', 43, 22749),
(6, 'kevin', 'kevin', '0', NULL, 123456);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`id_dokumentasi`),
  ADD KEY `fk_dokumentasi_ekskul` (`id_ekskul`);

--
-- Indeks untuk tabel `ekskul`
--
ALTER TABLE `ekskul`
  ADD PRIMARY KEY (`id_ekskul`);

--
-- Indeks untuk tabel `pembina`
--
ALTER TABLE `pembina`
  ADD PRIMARY KEY (`id_pembina`),
  ADD KEY `id_ekskul` (`id_ekskul`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_ekskul`);

--
-- Indeks untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id_registrasi`),
  ADD KEY `fk_registrasi_ekskul` (`id_ekskul`),
  ADD KEY `fk_registrasi_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_siswa` (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokumentasi`
--
ALTER TABLE `dokumentasi`
  MODIFY `id_dokumentasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ekskul`
--
ALTER TABLE `ekskul`
  MODIFY `id_ekskul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `pembina`
--
ALTER TABLE `pembina`
  MODIFY `id_pembina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_ekskul` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD CONSTRAINT `fk_dokumentasi_ekskul` FOREIGN KEY (`id_ekskul`) REFERENCES `ekskul` (`id_ekskul`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembina`
--
ALTER TABLE `pembina`
  ADD CONSTRAINT `pembina_ibfk_1` FOREIGN KEY (`id_ekskul`) REFERENCES `ekskul` (`id_ekskul`);

--
-- Ketidakleluasaan untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  ADD CONSTRAINT `fk_registrasi_ekskul` FOREIGN KEY (`id_ekskul`) REFERENCES `ekskul` (`id_ekskul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_registrasi_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
