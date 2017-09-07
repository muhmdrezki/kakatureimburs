-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2017 at 04:15 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_operasional-kantor`
--

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_anggota`
--

CREATE TABLE `jabatan_anggota` (
  `id_anggota` varchar(5) NOT NULL,
  `id_jabatan` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan_anggota`
--

INSERT INTO `jabatan_anggota` (`id_anggota`, `id_jabatan`) VALUES
('00001', '111'),
('12974', '557'),
('88863', '004'),
('72555', '541'),
('62541', '571'),
('87553', '557');

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id` int(11) NOT NULL,
  `id_anggota` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `latitude` varchar(1000) NOT NULL,
  `longitude` varchar(1000) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_absen`
--

INSERT INTO `tb_absen` (`id`, `id_anggota`, `tanggal`, `jam_masuk`, `jam_keluar`, `keterangan`, `latitude`, `longitude`, `foto`) VALUES
(1, '12974', '2017-09-04', '07:24:27', '15:00:00', 'hadir', '325342534543', '345345345435', '-'),
(2, '72555', '2017-09-04', '09:00:00', '14:00:00', 'izin', '4134234523432', '4324324324234', '-'),
(3, '88863', '2017-09-04', '07:00:00', '15:00:00', 'sakit', '321321432424', '123213123213', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `password` varchar(15) NOT NULL,
  `foto_profile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `email`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `password`, `foto_profile`) VALUES
('00001', 'Isma', 'admin@gmail.com', '-', 'Bandung', '1995-08-01', 'P', '00001', 'icon.png'),
('12974', 'Muhamad Rezki', 'muhmdrezki@gmail.com', 'PPR ITB Bandung', 'Ciamis', '1996-02-21', 'L', '12974', '1504447292808789644462.jpg'),
('62541', 'Eki', 'rezkimuhmd@gmail.com', '-', 'Ciamis', '1996-02-21', 'L', 'kiwikiwi123', '-'),
('72555', 'Aldy Subagja', 'aldysubagja@gmail.com', '-', '-', '1000-01-01', '-', '72555', '-'),
('87553', 'Chandra', 'schandraj@gmail.com', '-', '-', '1000-01-01', '-', 'kiwikiwi', '-'),
('88863', 'Imam Robani', '-', '-', '-', '1000-01-01', '-', '88863', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buktipembayaran`
--

CREATE TABLE `tb_buktipembayaran` (
  `id` int(11) NOT NULL,
  `id_pembayaran` varchar(5) NOT NULL,
  `bukti` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_buktipembayaran`
--

INSERT INTO `tb_buktipembayaran` (`id`, `id_pembayaran`, `bukti`) VALUES
(62, '32123', 'konde.png'),
(64, '56271', '1504424058838-1774796322.jpg'),
(65, '76673', 'belanda.png'),
(66, '80133', 'IMG_20170729_094819_HDR.jpg'),
(67, '27650', 'MainMenu (Admin).png'),
(68, '80133', 'IMG_20170508_155537_HDR.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` varchar(3) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `jabatan`, `gaji`) VALUES
('002', 'System Analyst', 4000000),
('004', 'Researcher', 3900000),
('111', 'Admin', 2500000),
('135', 'Bendahara', 2900000),
('468', 'Android Developer', 3500000),
('541', 'UI/UX Designer', 3250000),
('557', 'Web Developer', 3300000),
('571', 'CEO ', 5000000),
('847', 'CTO', 4850000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenistransaksi`
--

CREATE TABLE `tb_jenistransaksi` (
  `id_jenis` varchar(6) NOT NULL,
  `jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenistransaksi`
--

INSERT INTO `tb_jenistransaksi` (`id_jenis`, `jenis`) VALUES
('TR-01', 'Bayar Listrik'),
('TR-02', 'Bayar Air Minum'),
('TR-03', 'Bayar Sampah'),
('TR-04', 'Bayar ART'),
('TR-05', 'Bayar Transport'),
('TR-06', 'Bayar Konsumsi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_konfirmasi`
--

CREATE TABLE `tb_konfirmasi` (
  `id_pembayaran` varchar(5) NOT NULL,
  `id_anggota` varchar(5) NOT NULL,
  `konfirm_anggota` varchar(1) NOT NULL,
  `konfirm_admin` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_konfirmasi`
--

INSERT INTO `tb_konfirmasi` (`id_pembayaran`, `id_anggota`, `konfirm_anggota`, `konfirm_admin`) VALUES
('49742', '12974', '0', '0'),
('49338', '12974', '0', '0'),
('94767', '12974', '0', '0'),
('63855', '12974', '0', '0'),
('69436', '12974', '0', '0'),
('69436', '12974', '0', '0'),
('33594', '12974', '0', '0'),
('90143', '12974', '0', '0'),
('87653', '12974', '0', '0'),
('56271', '12974', '0', '0'),
('83027', '12974', '0', '0'),
('32788', '12974', '0', '0'),
('80133', '62541', '0', '0'),
('81676', '62541', '0', '0'),
('18823', '62541', '0', '0'),
('89607', '62541', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` varchar(5) NOT NULL,
  `id_anggota` varchar(5) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_jenis` varchar(5) NOT NULL,
  `nominal` varchar(9) NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_anggota`, `tanggal`, `id_jenis`, `nominal`, `keterangan`, `status`) VALUES
('10837', '62541', '2017-09-03 12:54:44', 'TR-04', '120000', 'Test        \r\n      ', '2'),
('14680', '12974', '2017-09-29 06:01:05', 'TR-02', '600000', '        t\r\n      ', '2'),
('18823', '62541', '2017-09-07 15:39:50', 'TR-04', '50000', 'Bayar ART', '0'),
('27650', '62541', '2017-09-07 04:14:09', 'TR-03', '50000', 'Bayar sampah        \r\n      ', '2'),
('32123', '12974', '2017-07-26 11:19:19', 'TR-03', '500000', 'Bayar Sampah', '1'),
('32788', '12974', '2017-09-03 07:37:13', 'TR-01', '500000', '    1    ', '0'),
('33594', '12974', '2017-08-29 05:48:03', 'TR-06', '88000', 't', '0'),
('33661', '12974', '2017-08-29 05:49:08', 'TR-03', '50000', 'g   \r\n      ', '2'),
('39969', '62541', '2017-09-07 07:06:51', 'TR-01', '1000000', '2        \r\n      ', '2'),
('42232', '62541', '2017-09-03 12:50:42', 'TR-02', '50000', 'Air Galon         \r\n      ', '2'),
('45118', '12974', '2017-09-03 07:53:59', 'TR-03', '50000', '6        \r\n      ', '2'),
('47203', '62541', '2017-09-03 12:58:51', 'TR-03', '60000', '1', '2'),
('49338', '12974', '2017-08-29 05:38:25', 'TR-01', '1000000', '    B   \r\n      ', '0'),
('49742', '12974', '2017-08-29 05:26:49', 'TR-04', '70000', 'Bayar bersih - bersih kantor\r\n      ', '0'),
('56271', '12974', '2017-09-03 07:34:19', 'TR-01', '2500000', 'Testing', '0'),
('63855', '12974', '2017-08-29 05:45:00', 'TR-06', '60000', 'B        \r\n      ', '0'),
('64309', '12974', '2017-08-29 05:59:37', 'TR-04', '50000', '3        \r\n      ', '2'),
('69436', '12974', '2017-08-29 05:47:08', 'TR-05', '50000', '2        \r\n      ', '0'),
('76673', '62541', '2017-09-06 06:30:42', 'TR-04', '90000', 'Bayar ART\r\n      ', '2'),
('80133', '62541', '2017-09-06 06:35:47', 'TR-02', '50000', 'Bayar test        \r\n      ', '0'),
('80206', '62541', '2017-09-07 09:20:57', 'TR-05', '60000', 'bayar transport meeting', '2'),
('81676', '62541', '2017-09-07 14:16:44', 'TR-02', '50000', 'Bayar 2 Air Galon, cash ke warung', '0'),
('83027', '12974', '2017-09-03 07:35:25', 'TR-01', '500', '        \r\n   A', '0'),
('86948', '12974', '2017-08-29 06:18:55', 'TR-05', '80000', 'n        \r\n      ', '2'),
('87653', '12974', '2017-09-03 05:06:06', 'TR-06', '90000', '1', '0'),
('89607', '62541', '2017-09-07 15:40:13', 'TR-01', '10000', 'Bayar Listrik Bulan Ini', '0'),
('90143', '12974', '2017-08-29 05:50:02', 'TR-02', '50000', 'g      ', '0'),
('94767', '12974', '2017-08-29 05:43:14', 'TR-05', '60000', 'W        \r\n      ', '0'),
('98381', '12974', '2017-08-29 05:51:54', 'TR-03', '600000', 'e        \r\n      ', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan_anggota`
--
ALTER TABLE `jabatan_anggota`
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idanggota` (`id_anggota`);

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `tb_buktipembayaran`
--
ALTER TABLE `tb_buktipembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_jenistransaksi`
--
ALTER TABLE `tb_jenistransaksi`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  ADD KEY `fk_idbayar` (`id_pembayaran`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_buktipembayaran`
--
ALTER TABLE `tb_buktipembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `jabatan_anggota`
--
ALTER TABLE `jabatan_anggota`
  ADD CONSTRAINT `fk_id-anggota` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id-jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD CONSTRAINT `ibfk_idanggota3` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_buktipembayaran`
--
ALTER TABLE `tb_buktipembayaran`
  ADD CONSTRAINT `fk_idpembayaran` FOREIGN KEY (`id_pembayaran`) REFERENCES `tb_pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  ADD CONSTRAINT `ibfk_idbayar` FOREIGN KEY (`id_pembayaran`) REFERENCES `tb_pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `fk_idanggota` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idjenis` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenistransaksi` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
