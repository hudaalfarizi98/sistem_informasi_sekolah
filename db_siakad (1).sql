-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Feb 2019 pada 15.50
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siakad`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata_guru`
--

CREATE TABLE `biodata_guru` (
  `Id` bigint(20) NOT NULL,
  `Nama` varchar(200) NOT NULL,
  `NoTlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `biodata_guru`
--

INSERT INTO `biodata_guru` (`Id`, `Nama`, `NoTlp`) VALUES
(19712007, 'Agus', '081276543241'),
(19832007, 'Marsujid', '08785465342');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata_siswa`
--

CREATE TABLE `biodata_siswa` (
  `Id` bigint(20) NOT NULL,
  `NamaSiswa` text NOT NULL,
  `Jurusan` bigint(20) NOT NULL,
  `Kelas` bigint(20) NOT NULL,
  `NoTlp` varchar(18) NOT NULL,
  `Alamat` text NOT NULL,
  `Email` text NOT NULL,
  `Nama_ayah` text NOT NULL,
  `Nama_ibu` text NOT NULL,
  `TanggalLahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `biodata_siswa`
--

INSERT INTO `biodata_siswa` (`Id`, `NamaSiswa`, `Jurusan`, `Kelas`, `NoTlp`, `Alamat`, `Email`, `Nama_ayah`, `Nama_ibu`, `TanggalLahir`) VALUES
(19982014, 'Huda Alfarizi', 2, 12, '081298987657', 'kp sawah jatimurni', 'huda.alfarizi.it@gmail.com', 'Riyadi', 'Lilik Rahmawati', '1998-12-06'),
(19981549703748, 'murid', 2, 12, '081911655559', 'jakarta', 'huda.alfarizi.it@gmail.com', 'riyadi', 'lilik', '2019-02-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `Id` int(11) NOT NULL,
  `IdGuru` int(11) NOT NULL,
  `Nama` varchar(200) NOT NULL,
  `Kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`Id`, `IdGuru`, `Nama`, `Kelas`) VALUES
(301, 19712007, 'Matematika', 10),
(302, 19712007, 'Penjaskes', 10),
(303, 19712007, 'SI', 12),
(304, 19832007, 'Mikrotik', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `Id` bigint(20) NOT NULL,
  `Username` varchar(200) NOT NULL,
  `Password` text NOT NULL,
  `Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`Id`, `Username`, `Password`, `Level`) VALUES
(19712007, 'Agus', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2),
(19832007, 'marsujid', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2),
(199820141, 'Huda', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3),
(19981549275145, 'Rifai', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3),
(19981549703748, 'murid', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `Id` bigint(11) NOT NULL,
  `IdSiswa` bigint(11) NOT NULL,
  `IdMapel` bigint(11) NOT NULL,
  `Nilai` decimal(11,0) NOT NULL,
  `Status` enum('y','t') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`Id`, `IdSiswa`, `IdMapel`, `Nilai`, `Status`) VALUES
(7, 19982014, 303, '100', 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_materi`
--

CREATE TABLE `post_materi` (
  `IdPost` bigint(20) NOT NULL,
  `IdMapel` bigint(20) NOT NULL,
  `IdGuru` bigint(20) NOT NULL,
  `Judul` text NOT NULL,
  `Content` text NOT NULL,
  `tgl` date NOT NULL,
  `Kelas` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `post_materi`
--

INSERT INTO `post_materi` (`IdPost`, `IdMapel`, `IdGuru`, `Judul`, `Content`, `tgl`, `Kelas`) VALUES
(1, 301, 19712007, 'Rumus Luas Lingkaran', '<p>test</p>', '2019-01-16', 0),
(3, 302, 19712007, 'test', '<p>test</p>', '2019-01-17', 10),
(4, 303, 19712007, 'Sejarah Sistem Informasi', '<p>Testing</p>', '2019-01-17', 12),
(6, 303, 19712007, 'Sejarah Sistem Informasi', '<p>Testing</p>', '2019-01-17', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `Id` bigint(11) NOT NULL,
  `IdGuru` bigint(11) NOT NULL,
  `IdMapel` bigint(11) NOT NULL,
  `Soal` text NOT NULL,
  `gambar_soal` text NOT NULL,
  `suara_soal` text NOT NULL,
  `a` text NOT NULL,
  `gambar_a` text NOT NULL,
  `suara_a` text NOT NULL,
  `b` text NOT NULL,
  `gambar_b` text NOT NULL,
  `suara_b` text NOT NULL,
  `c` text NOT NULL,
  `gambar_c` text NOT NULL,
  `suara_c` text NOT NULL,
  `d` text NOT NULL,
  `gambar_d` text NOT NULL,
  `suara_d` text NOT NULL,
  `jawaban_benar` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`Id`, `IdGuru`, `IdMapel`, `Soal`, `gambar_soal`, `suara_soal`, `a`, `gambar_a`, `suara_a`, `b`, `gambar_b`, `suara_b`, `c`, `gambar_c`, `suara_c`, `d`, `gambar_d`, `suara_d`, `jawaban_benar`) VALUES
(1, 19712007, 303, ' test', '', '', 'test', '', '', 'test', '', '', 'test', '', '', 'test', '', '', 'D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_status`
--

CREATE TABLE `soal_status` (
  `Id` bigint(20) NOT NULL,
  `IdMapel` bigint(20) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `status` enum('y','t') NOT NULL,
  `Kelas` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal_status`
--

INSERT INTO `soal_status` (`Id`, `IdMapel`, `Nama`, `status`, `Kelas`) VALUES
(2, 302, 'Penjaskes', 't', 10),
(3, 303, 'SI', 'y', 12),
(6, 304, 'Mikrotik', 't', 12),
(8, 305, '', 'y', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata_guru`
--
ALTER TABLE `biodata_guru`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `biodata_siswa`
--
ALTER TABLE `biodata_siswa`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `post_materi`
--
ALTER TABLE `post_materi`
  ADD PRIMARY KEY (`IdPost`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `soal_status`
--
ALTER TABLE `soal_status`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata_guru`
--
ALTER TABLE `biodata_guru`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19832008;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `Id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `post_materi`
--
ALTER TABLE `post_materi`
  MODIFY `IdPost` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `Id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `soal_status`
--
ALTER TABLE `soal_status`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
