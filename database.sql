-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2021 at 06:39 PM
-- Server version: 10.3.31-MariaDB-cll-lve
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u5533013_kp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bimbingan`
--

CREATE TABLE `tbl_bimbingan` (
  `kdbimbingan` int(11) NOT NULL,
  `kdpenempatan` int(11) NOT NULL,
  `nip` char(21) NOT NULL,
  `nis` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `judul` varchar(50) NOT NULL,
  `catatan` text NOT NULL,
  `file` text DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bimbingan`
--

INSERT INTO `tbl_bimbingan` (`kdbimbingan`, `kdpenempatan`, `nip`, `nis`, `tanggal`, `judul`, `catatan`, `file`, `source`, `type`) VALUES
(6, 21, '082285498005', 6400, '2021-10-10', 'testing', 'adad', 'lampiran/bimbingan/andre.PNG', 'pembimbing', NULL),
(9, 21, '082285498005', 6400, '2021-10-12', 'bimbingan 1', 'ini bimbingan yang saya buat pak ', 'lampiran/bimbingan/1._SPESIFIKASI_TEKNIK_Rehab_DPRD5.pdf', 'siswa', NULL),
(10, 21, '082285498005', 6400, '2021-10-12', 'dad', 'tes', 'lampiran/bimbingan/Rancangan_Kontrak.pdf', 'siswa', NULL),
(11, 21, '082285498005', 6400, '2021-10-12', 'tes2', 'tes2', 'lampiran/bimbingan/1._SPESIFIKASI_TEKNIK_Rehab_DPRD1.pdf', 'siswa', NULL),
(12, 21, '082285498005', 6400, '2021-10-14', 'bimbingan', 'catatan', NULL, 'siswa', NULL),
(13, 21, '082285498005', 6400, '2021-10-14', 'bimbingan', 'vimbingan', 'lampiran/bimbingan/1._SPESIFIKASI_TEKNIK_Rehab_DPRD2.pdf', 'siswa', '.pdf'),
(14, 21, '082285498005', 6400, '2021-10-14', 'dad', 'adad', 'lampiran/bimbingan/b2.png', 'siswa', '.png'),
(17, 22, '123456789', 123456, '2021-10-27', 'bimbingan pertama', 'coba 1', 'lampiran/bimbingan/Install_H5P_Add_Recording_audio_using_H5P.docx', 'siswa', '.docx'),
(18, 22, '123456789', 123456, '2021-10-27', 'Oke di lanjut', 'siap', NULL, 'pembimbing', NULL),
(19, 24, '123456789', 2021, '2021-10-27', 'Bab 1', 'Progress bab 1', 'lampiran/bimbingan/mx_configuration.pdf', 'siswa', '.pdf'),
(20, 24, '123456789', 2021, '2021-10-27', 'Revisi Bab 1', 'Harap abs', NULL, 'pembimbing', NULL),
(22, 27, '123456789', 2015420064, '2021-12-02', 'Sistem Informasi', 'bimbingan bab 1', NULL, 'siswa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `kdfile` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` text NOT NULL,
  `share` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`kdfile`, `judul`, `tanggal`, `nama`, `share`, `keterangan`) VALUES
(2, 'Contoh 1', '2021-08-23', 'x8-sandbox-Apk.png', 0, 'Ini hanya contoh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info`
--

CREATE TABLE `tbl_info` (
  `kdinfo` int(11) NOT NULL,
  `kdlabel` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `judul` text NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text NOT NULL,
  `penulis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kdjurusan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kdjurusan`, `nama`) VALUES
(1, 'TI'),
(2, 'TS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `kdkelas` int(11) NOT NULL,
  `kdjurusan` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`kdkelas`, `kdjurusan`, `nama`) VALUES
(1, 1, '1 B'),
(2, 2, '1A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_label`
--

CREATE TABLE `tbl_label` (
  `kdlabel` int(11) NOT NULL,
  `nama_label` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_label`
--

INSERT INTO `tbl_label` (`kdlabel`, `nama_label`, `keterangan`) VALUES
(1, 'Pengumuman', '-'),
(2, 'Tips', '-'),
(3, 'Industri', '-'),
(4, 'Sekolah', '-'),
(5, 'Lain-lain', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `kdnilai` int(11) NOT NULL,
  `kdpenempatan` int(11) NOT NULL,
  `keterangan` enum('Teknis','Non-Teknis','Laporan') NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`kdnilai`, `kdpenempatan`, `keterangan`, `nilai`) VALUES
(1, 24, 'Teknis', 50),
(2, 27, 'Teknis', 97);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemb`
--

CREATE TABLE `tbl_pemb` (
  `kdpemb` int(11) NOT NULL,
  `kdjurusan` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` text NOT NULL,
  `nip` char(21) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `wilayah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pemb`
--

INSERT INTO `tbl_pemb` (`kdpemb`, `kdjurusan`, `username`, `password`, `nip`, `nama_lengkap`, `wilayah`) VALUES
(3, 1, 'muhammad', 'a7777999e260290f68a1455cacdabf6c', '123456789', 'Muhammad Ansori', 'Surabaya'),
(5, 1, 'lutvi', '7e96f0a92e84e79e04c4da1c83b64755', '082285498005', 'Lutvi', 'Padang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penempatan`
--

CREATE TABLE `tbl_penempatan` (
  `kdpenempatan` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `kdpemb` int(11) DEFAULT NULL,
  `nama_industri` varchar(225) NOT NULL,
  `tanggal` date NOT NULL,
  `wilayah` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL,
  `status` enum('-','proses','ditolak','diterima') NOT NULL,
  `surat` text NOT NULL,
  `deskripsi` varchar(225) NOT NULL,
  `alamat` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penempatan`
--

INSERT INTO `tbl_penempatan` (`kdpenempatan`, `nis`, `kdpemb`, `nama_industri`, `tanggal`, `wilayah`, `tahun`, `status`, `surat`, `deskripsi`, `alamat`) VALUES
(21, 6400, 5, 'Teknik', '2021-10-10', '1', 2021, 'diterima', '00022.png', 'dabdalda', 'antahlan'),
(22, 123456, 3, 'PT Coba', '2021-10-10', 'Surabaya', 2021, 'diterima', '0001.png', 'Jasa', 'Surabaya'),
(23, 0, 3, 'PT Teknokomindo', '2021-10-14', 'Jakarta', 2021, 'proses', 'PT_Cipta_Naratas_Cakrawala.jpg', 'Jasa', 'Senen'),
(24, 2021, 3, 'PT Coba', '2021-10-27', 'Surabaya', 2021, 'diterima', 'IBT.jpg', 'Jasa', 'Surabaya'),
(27, 2015420064, 3, 'juragan web', '2021-12-02', 'surabaya', 2021, 'diterima', '-', 'freelance', 'bagong');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nis` int(11) NOT NULL,
  `kdkelas` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `telp` varchar(14) NOT NULL,
  `foto` text NOT NULL,
  `password` text NOT NULL,
  `kdpemb` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`nis`, `kdkelas`, `nama_lengkap`, `telp`, `foto`, `password`, `kdpemb`) VALUES
(0, 1, 'Salam', '021', 'Promo_Ads-02.jpg', '4a7d1ed414474e4033ac29ccb8653d9b', 3),
(2021, 2, 'Achmad Wahyudi', '2021', 'IBT1.jpg', '05a5cf06982ba7892ed2a6d38fe832d6', 3),
(6400, 1, 'budi', '082285498005', '11.PNG', 'd6dabcc412981d56c8733b52586a9d44', 5),
(123456, 1, 'Khairon', '082285498005', 'IBT.jpg', 'e10adc3949ba59abbe56e057f20f883e', 3),
(2015420064, 1, 'Muz Ammar', '082331484634', 'Photo.png', '734794bbc555664f529dc7b5ad485714', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_pendaftaran`
--

CREATE TABLE `tbl_status_pendaftaran` (
  `id` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_status_pendaftaran`
--

INSERT INTO `tbl_status_pendaftaran` (`id`, `status`) VALUES
(1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tolak_penempatan`
--

CREATE TABLE `tbl_tolak_penempatan` (
  `kdtolak` int(11) NOT NULL,
  `kdpenempatan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `alasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `identitas` varchar(32) NOT NULL,
  `password` text NOT NULL,
  `status` varchar(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `nama_lengkap`, `identitas`, `password`, `status`, `foto`) VALUES
(1, 'admin', 'Heri Mukti', '', '21232f297a57a5a743894a0e4a801fc3', '-', 'law-firm-logo_7169-322.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  ADD PRIMARY KEY (`kdbimbingan`),
  ADD KEY `kdpenempatan` (`kdpenempatan`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`kdfile`);

--
-- Indexes for table `tbl_info`
--
ALTER TABLE `tbl_info`
  ADD PRIMARY KEY (`kdinfo`),
  ADD KEY `kdlabel` (`kdlabel`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`kdjurusan`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`kdkelas`),
  ADD KEY `kdjurusan` (`kdjurusan`);

--
-- Indexes for table `tbl_label`
--
ALTER TABLE `tbl_label`
  ADD PRIMARY KEY (`kdlabel`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`kdnilai`),
  ADD KEY `kdpenempatan` (`kdpenempatan`);

--
-- Indexes for table `tbl_pemb`
--
ALTER TABLE `tbl_pemb`
  ADD PRIMARY KEY (`kdpemb`),
  ADD KEY `kdjurusan` (`kdjurusan`);

--
-- Indexes for table `tbl_penempatan`
--
ALTER TABLE `tbl_penempatan`
  ADD PRIMARY KEY (`kdpenempatan`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `kdkelas` (`kdkelas`);

--
-- Indexes for table `tbl_status_pendaftaran`
--
ALTER TABLE `tbl_status_pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tolak_penempatan`
--
ALTER TABLE `tbl_tolak_penempatan`
  ADD PRIMARY KEY (`kdtolak`),
  ADD KEY `kdpenempatan` (`kdpenempatan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  MODIFY `kdbimbingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `kdfile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_info`
--
ALTER TABLE `tbl_info`
  MODIFY `kdinfo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  MODIFY `kdjurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `kdkelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_label`
--
ALTER TABLE `tbl_label`
  MODIFY `kdlabel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `kdnilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pemb`
--
ALTER TABLE `tbl_pemb`
  MODIFY `kdpemb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_penempatan`
--
ALTER TABLE `tbl_penempatan`
  MODIFY `kdpenempatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_tolak_penempatan`
--
ALTER TABLE `tbl_tolak_penempatan`
  MODIFY `kdtolak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  ADD CONSTRAINT `tbl_bimbingan_ibfk_1` FOREIGN KEY (`kdpenempatan`) REFERENCES `tbl_penempatan` (`kdpenempatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bimbingan_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_info`
--
ALTER TABLE `tbl_info`
  ADD CONSTRAINT `tbl_info_ibfk_1` FOREIGN KEY (`kdlabel`) REFERENCES `tbl_label` (`kdlabel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD CONSTRAINT `tbl_kelas_ibfk_1` FOREIGN KEY (`kdjurusan`) REFERENCES `tbl_jurusan` (`kdjurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD CONSTRAINT `tbl_nilai_ibfk_1` FOREIGN KEY (`kdpenempatan`) REFERENCES `tbl_penempatan` (`kdpenempatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pemb`
--
ALTER TABLE `tbl_pemb`
  ADD CONSTRAINT `tbl_pemb_ibfk_1` FOREIGN KEY (`kdjurusan`) REFERENCES `tbl_jurusan` (`kdjurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_penempatan`
--
ALTER TABLE `tbl_penempatan`
  ADD CONSTRAINT `tbl_penempatan_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_ibfk_1` FOREIGN KEY (`kdkelas`) REFERENCES `tbl_kelas` (`kdkelas`);

--
-- Constraints for table `tbl_tolak_penempatan`
--
ALTER TABLE `tbl_tolak_penempatan`
  ADD CONSTRAINT `tbl_tolak_penempatan_ibfk_1` FOREIGN KEY (`kdpenempatan`) REFERENCES `tbl_penempatan` (`kdpenempatan`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
