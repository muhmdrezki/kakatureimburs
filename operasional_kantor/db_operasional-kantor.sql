-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2017 at 06:14 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
('88863', '004'),
('72555', '541'),
('62541', '571'),
('87553', '557'),
('14048', '004'),
('27225', '002'),
('90706', '557');

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE `tb_absen` (
  `status_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `warna` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_absen`
--

INSERT INTO `tb_absen` (`status_id`, `status`, `warna`) VALUES
(1, 'Hadir', '#00c0ef'),
(2, 'Hadir Diluar', '#0073b7'),
(3, 'Sakit', '#f56954'),
(4, 'Izin', '#f39c12'),
(5, 'Cuti', '#00a65a'),
(6, 'Alpha', '#c0c0c0');

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
('00001', 'Isma', 'admin@gmail.com', 'Dipati Ukur', 'Bandung', '1995-08-01', 'P', '00001', 'icon.png'),
('14048', 'Imam Arief Rahman', 'imamariefrahmann@gmail.com', 'Jalan Dipatiukur nomor 42', 'Mataram', '1994-05-08', 'L', '14048', '-'),
('27225', 'Rizki Adam', 'rizki.adam@kakatu.id', 'Jalan Sukasari 4', 'Bandung', '1992-08-17', 'L', '27225', '-'),
('62541', 'Eki', 'rezkimuhmd@gmail.com', '-', 'Ciamis', '1996-02-21', 'L', 'kiwikiwi123', '-'),
('72555', 'Aldy Subagja', 'aldysubagja@gmail.com', '-', '-', '1000-01-01', '-', '72555', '-'),
('87553', 'Chandra', 'schandraj@gmail.com', '-', '-', '1000-01-01', '-', '87553', '-'),
('88863', 'Imam Robani', '-', '-', '-', '1000-01-01', '-', '88863', '-'),
('90706', 'Idan Freak', 'idanfreak@gmail.com', 'Jalan Dipati Ukur nomor 20', 'Dago', '1994-05-08', 'L', 'makanan13', '-');

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
(65, '76673', 'belanda.png'),
(66, '80133', 'IMG_20170729_094819_HDR.jpg'),
(67, '27650', 'MainMenu (Admin).png'),
(68, '80133', 'IMG_20170508_155537_HDR.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_credits_anggota`
--

CREATE TABLE `tb_credits_anggota` (
  `id` int(4) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `topup_credit` bigint(10) NOT NULL DEFAULT '0',
  `total_credit` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_credits_anggota`
--

INSERT INTO `tb_credits_anggota` (`id`, `id_anggota`, `topup_credit`, `total_credit`) VALUES
(1, '00001', 97000, 0),
(23, '14048', 90000, 810000),
(24, '87553', 70000, 0),
(25, '72555', 70000, 0),
(26, '88863', 50000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cuti_anggota`
--

CREATE TABLE `tb_cuti_anggota` (
  `id_cuti` int(11) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `cuti_used` int(4) NOT NULL DEFAULT '0',
  `cuti_qty` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cuti_anggota`
--

INSERT INTO `tb_cuti_anggota` (`id_cuti`, `id_anggota`, `cuti_used`, `cuti_qty`) VALUES
(1, '00001', 0, 15),
(2, '27225', 0, 12),
(3, '14048', 0, 9),
(4, '87553', 0, 13),
(5, '62541', 0, 12),
(6, '72555', 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_absen`
--

CREATE TABLE `tb_detail_absen` (
  `id` int(11) NOT NULL,
  `id_anggota` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `status_id` int(2) NOT NULL,
  `keterangan` varchar(255) DEFAULT '',
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `alamat_lokasi` varchar(255) DEFAULT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `foto_lokasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_absen`
--

INSERT INTO `tb_detail_absen` (`id`, `id_anggota`, `tanggal`, `jam_masuk`, `status_id`, `keterangan`, `latitude`, `longitude`, `alamat_lokasi`, `tgl_awal`, `tgl_akhir`, `foto_lokasi`) VALUES
(1, '00001', '2017-09-22', '00:50:37', 5, 'Bulan madu', -6.886720180511475, 107.6164192, 'Jl. Tubagus Ismail Dalam No.32, Lebakgede, Coblong, Kota Bandung, Jawa Barat 40132, Indonesia', '2017-09-22', '2017-09-24', '10824.jpg'),
(2, '00001', '2017-09-19', '01:46:55', 2, 'Lapar', -6.88667631149292, 107.6164022, 'Jl. Tubagus Ismail Dalam No.32, Lebakgede, Coblong, Kota Bandung, Jawa Barat 40132, Indonesia', '2017-09-19', '2017-09-21', '10824.jpg'),
(3, '00001', '2017-09-16', '02:47:29', 4, 'Lapar', -6.886645793914795, 107.6163899, 'Jl. Tubagus Ismail Dalam No.16B, Lebakgede, Coblong, Kota Bandung, Jawa Barat 40132, Indonesia', '2017-09-16', '2017-09-18', '10824.jpg'),
(4, '00001', '2017-09-26', '01:30:34', 3, 'Demam berdarah', -6.886902332305908, 107.6168659, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-26', '2017-09-30', '10825.jpg'),
(5, '00001', '2017-09-25', '03:32:00', 2, '', -6.886944770812988, 107.61681139999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', NULL),
(6, '14048', '2017-09-26', '06:37:06', 2, 'kangen mama', -6.8868794441223145, 107.61689009999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', NULL),
(7, '14048', '2017-09-26', '07:35:25', 1, '', 0, 0, 'Tidak Ketemu', '2017-09-26', '2017-09-26', NULL),
(8, '14048', '2017-09-26', '07:56:38', 1, '', -6.8869053, 107.61686639999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-26', '2017-09-26', NULL),
(9, '14048', '2017-09-26', '07:58:52', 1, '', -6.8868799, 107.61689, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-26', '2017-09-26', NULL),
(10, '14048', '2017-09-26', '08:00:46', 1, '', -6.8869359, 107.6168558, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-26', '2017-09-26', NULL),
(11, '14048', '2017-09-26', '08:03:31', 1, '', -6.8868796, 107.61689, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-26', '2017-09-26', NULL),
(12, '14048', '2017-09-26', '08:09:24', 1, '', -6.8869242999999996, 107.6168615, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-26', '2017-09-26', NULL),
(13, '14048', '2017-09-26', '08:10:25', 1, '', -6.886879400000001, 107.61689, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-26', '2017-09-26', NULL),
(14, '14048', '2017-09-26', '08:10:51', 3, 'ingat mama', -6.886908699999999, 107.61686139999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', NULL),
(15, '14048', '2017-09-26', '08:36:44', 1, '', -6.8868796, 107.61689249999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-26', '2017-09-26', NULL),
(16, '00001', '2017-09-27', '13:36:46', 1, '', -6.8869682999999995, 107.6168591, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-27', '2017-09-27', NULL),
(17, '00001', '2017-08-28', '04:21:49', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-08-28', '2017-08-28', '10824.jpg'),
(18, '00001', '2017-09-28', '04:32:51', 3, 'Demam Malaria coy', -6.8869071, 107.6168537, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(19, '00001', '2017-09-28', '04:45:34', 3, 'Gersang sekali', -6.8868604, 107.6168778, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(20, '00001', '2017-09-28', '04:53:11', 4, 'Haus', -6.8869278, 107.61682359999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(21, '00001', '2017-09-28', '05:17:45', 5, 'Menjenguk Obama', -6.8868601, 107.616878, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-30', '10823.jpg'),
(22, '00001', '2017-09-28', '05:22:00', 2, 'Ke SMA 5 bandung', -6.8869069000000005, 107.6168571, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(23, '00001', '2017-09-28', '05:24:45', 3, 'lapar ikan', -6.9174638999999996, 107.61912280000001, 'Gg. Kebonpisang, Kb. Pisang, Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(24, '00001', '2017-09-28', '05:29:09', 4, 'Menjenguk mantan kedua', -6.8868601, 107.61687789999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(25, '00001', '2017-09-28', '05:31:43', 2, 'Menangis untuk keuda kalinya', -6.8868607, 107.6168778, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(26, '00001', '2017-09-28', '05:32:35', 2, 'cerita lama', -6.8868588, 107.6168794, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(27, '00001', '2017-09-28', '05:34:11', 2, 'Setelah sekian lama', -6.8868601, 107.61687769999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(28, '00001', '2017-09-28', '05:35:16', 3, 'Dia kembali', -6.8868605, 107.61687769999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(29, '00001', '2017-09-28', '05:35:54', 4, 'okay', -6.8868604, 107.6168778, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(30, '00001', '2017-09-28', '05:37:38', 2, 'keterlaluan', -6.8868604, 107.61687789999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(31, '00001', '2017-09-28', '05:40:30', 3, 'Mengapa', -6.8868586, 107.6168781, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(32, '00001', '2017-09-28', '05:41:58', 2, 'kiuta', -6.8868588, 107.61687880000001, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(33, '00001', '2017-09-28', '05:43:05', 4, 'ilang', -6.8868604, 107.6168778, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(34, '00001', '2017-09-28', '05:44:21', 4, 'fsdfdsf', -6.8868607, 107.61687769999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(35, '00001', '2017-09-28', '05:46:03', 2, 'inilah dunia', -6.8868601, 107.61687789999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(36, '00001', '2017-09-28', '05:48:38', 4, 'izinkan', -6.8868601, 107.6168778, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(37, '00001', '2017-09-28', '05:49:24', 4, 'izinkanlah', -6.8868598, 107.61688, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(38, '00001', '2017-09-28', '05:56:05', 2, 'Mengingat mantan', -6.9174638999999996, 107.61912280000001, 'Gg. Kebonpisang, Kb. Pisang, Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(39, '00001', '2017-09-28', '05:56:58', 3, 'menghilang dari peredaran', -6.8868598, 107.61688009999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(40, '00001', '2017-09-28', '06:00:30', 5, 'ke Paris', -6.8868599999999995, 107.6168778, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-10-02', '10823.jpg'),
(41, '00001', '2017-09-28', '06:05:55', 5, 'ke jerman', -6.8868591, 107.61687859999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-30', '10823.jpg'),
(42, '00001', '2017-09-28', '06:24:33', 5, 'Bertemu Obama', -6.8868588, 107.6168794, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-30', '10823.jpg'),
(43, '00001', '2017-09-28', '06:27:10', 5, 'menari disana', -6.8868599999999995, 107.6168778, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-30', '10823.jpg'),
(44, '00001', '2017-09-28', '06:28:22', 5, 'menari dikota', -6.8868601, 107.6168778, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-30', '10823.jpg'),
(45, '00001', '2017-09-28', '06:29:52', 5, 'menari dikota cahaya', -6.9174638999999996, 107.61912280000001, 'Gg. Kebonpisang, Kb. Pisang, Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '2017-09-28', '2017-09-30', '10823.jpg'),
(46, '00001', '2017-09-28', '06:31:02', 5, 'menari diatas api', -6.8868591, 107.61687859999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-30', '10823.jpg'),
(47, '00001', '2017-09-28', '07:21:08', 4, 'Menikam dia', -6.8869029, 107.61685879999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(48, '00001', '2017-09-28', '07:24:21', 2, 'test drive', -6.8868601, 107.61687789999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(49, '00001', '2017-09-28', '15:35:55', 1, '', -6.8901547, 107.5801977, 'Jl. Sukasari I No.8, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(50, '00001', '2017-09-28', '15:37:57', 4, 'Presentasi', -6.890166600000001, 107.58019279999999, 'Jl. Sukasari I No.8, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg');

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
('002', 'System Analyst', 3500000),
('004', 'Researcher', 3900000),
('111', 'Admin', 3900000),
('135', 'Bendahara', 3000000),
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
('80133', '62541', '0', '0'),
('81676', '62541', '0', '2'),
('18823', '62541', '0', '2'),
('89607', '62541', '0', '2'),
('21113', '62541', '0', '0'),
('68022', '62541', '0', '0'),
('85887', '62541', '0', '0'),
('40467', '90706', '0', '2'),
('60195', '90706', '0', '2'),
('17153', '62541', '0', '0');

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
('17153', '62541', '2017-09-29 04:44:43', 'TR-02', '400', 'cash', '0'),
('18823', '62541', '2017-09-07 15:39:50', 'TR-04', '50000', 'Bayar ART', '1'),
('21113', '62541', '2017-09-11 21:15:01', 'TR-05', '900', 'Bayar tunai', '0'),
('27650', '62541', '2017-09-07 04:14:09', 'TR-03', '50000', 'Bayar sampah        \r\n      ', '2'),
('39969', '62541', '2017-09-07 07:06:51', 'TR-01', '1000000', '2        \r\n      ', '2'),
('40467', '90706', '2017-09-16 21:41:21', 'TR-03', '300', 'Bayar cash', '1'),
('42232', '62541', '2017-09-03 12:50:42', 'TR-02', '50000', 'Air Galon         \r\n      ', '2'),
('43240', '90706', '2017-09-16 21:44:44', 'TR-05', '400', 'Bayar cash', '2'),
('47203', '62541', '2017-09-03 12:58:51', 'TR-03', '60000', '1', '2'),
('60195', '90706', '2017-09-16 22:19:05', 'TR-03', '300', 'Cash', '1'),
('68022', '62541', '2017-09-11 21:16:34', 'TR-05', '50000', ' Bayar tunai ', '0'),
('76673', '62541', '2017-09-06 06:30:42', 'TR-04', '90000', 'Bayar ART\r\n      ', '2'),
('80133', '62541', '2017-09-06 06:35:47', 'TR-02', '50000', 'Bayar test        \r\n      ', '0'),
('80206', '62541', '2017-09-07 09:20:57', 'TR-05', '60000', 'bayar transport meeting', '2'),
('81676', '62541', '2017-09-07 14:16:44', 'TR-02', '50000', 'Bayar 2 Air Galon, cash ke warung', '1'),
('85887', '62541', '2017-09-15 15:11:20', 'TR-03', '300', 'Cash aja bro', '0'),
('89607', '62541', '2017-09-07 15:40:13', 'TR-01', '10000', 'Bayar Listrik Bulan Ini', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tgllibur`
--

CREATE TABLE `tb_tgllibur` (
  `id` int(4) NOT NULL,
  `nama_libur` varchar(50) NOT NULL,
  `tglawal` date DEFAULT NULL,
  `tglakhir` date DEFAULT NULL,
  `jmlhari` mediumint(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tgllibur`
--

INSERT INTO `tb_tgllibur` (`id`, `nama_libur`, `tglawal`, `tglakhir`, `jmlhari`) VALUES
(1, 'Hari Natal', '2017-12-24', '2017-12-26', 3),
(2, 'Tahun Baru 2018', '2018-01-01', '2018-01-01', 1),
(8, 'Libur Kantor', '2017-10-28', '2017-10-28', 1),
(9, 'Idul Adha', '2017-10-02', '2017-10-03', 2);

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
  ADD PRIMARY KEY (`status_id`);

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
-- Indexes for table `tb_credits_anggota`
--
ALTER TABLE `tb_credits_anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `tb_cuti_anggota`
--
ALTER TABLE `tb_cuti_anggota`
  ADD PRIMARY KEY (`id_cuti`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `tb_detail_absen`
--
ALTER TABLE `tb_detail_absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idanggota` (`id_anggota`),
  ADD KEY `status_id` (`status_id`);

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
-- Indexes for table `tb_tgllibur`
--
ALTER TABLE `tb_tgllibur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_buktipembayaran`
--
ALTER TABLE `tb_buktipembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tb_credits_anggota`
--
ALTER TABLE `tb_credits_anggota`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_cuti_anggota`
--
ALTER TABLE `tb_cuti_anggota`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_detail_absen`
--
ALTER TABLE `tb_detail_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_tgllibur`
--
ALTER TABLE `tb_tgllibur`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Constraints for table `tb_buktipembayaran`
--
ALTER TABLE `tb_buktipembayaran`
  ADD CONSTRAINT `fk_idpembayaran` FOREIGN KEY (`id_pembayaran`) REFERENCES `tb_pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_credits_anggota`
--
ALTER TABLE `tb_credits_anggota`
  ADD CONSTRAINT `tb_credits_anggota_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_cuti_anggota`
--
ALTER TABLE `tb_cuti_anggota`
  ADD CONSTRAINT `tb_cuti_anggota_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_absen`
--
ALTER TABLE `tb_detail_absen`
  ADD CONSTRAINT `ibfk_idanggota3` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_absen_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `tb_absen` (`status_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
