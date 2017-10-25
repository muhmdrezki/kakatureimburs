-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2017 at 04:19 PM
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
  `password` varchar(255) NOT NULL,
  `foto_profile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `email`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `password`, `foto_profile`) VALUES
('00001', 'Isma', 'admin@gmail.com', 'Dipati Ukur', 'Bandung', '1995-08-01', 'P', 'TYzoDemc6uiapr2nm8wqjgP7OEEzh5N8MdlWr2vHil8=', 'icon.png'),
('14048', 'Imam Arief', 'imamariefrahmann@gmail.com', 'Jalan Dipatiukur nomor 42', 'Mataram', '1994-05-08', 'L', 'nB6PS0hngXXL1EqLEx9m3z+JWJYqlJWhAh2+xe6fCZQ=', '-'),
('27225', 'Rizki Adam', 'rizkiadam@kakatu.id', 'Jalan Sukasari 4', 'Bandung', '1992-08-17', 'L', 'y3VQsKgL/hKXjTBSe4hXkFd74MS+0PDk3SmvQ6ua1so=', '-'),
('62541', 'Eki', 'rezkimuhmd@gmail.com', '-', 'Ciamis', '1996-02-21', 'L', 'tFIBiXXNUgy3n6CHfoyGCvoHUSDBk4T+wav92M8/tUM=', '-'),
('72555', 'Aldy Subagja', 'aldysubagja@gmail.com', '-', '-', '1000-01-01', '-', 'ey740agDEKcPo3p85iHVkn0LD0ornRhmjNfdej8K8uI=', '-'),
('87553', 'Chandra', 'schandraj@gmail.com', '-', '-', '1000-01-01', '-', 'tcHIgOmtx2nwTEhT193u3NjUkEIgAuJtancrxlY3Kqc=', '-'),
('88863', 'Imam Robani', '-', '-', '-', '1000-01-01', '-', 'fu6lEerNZng0tcoe3Py0q28qFKW2lSJXlMqgfw7pFew=', '-'),
('90706', 'Idan Freak', 'idanfreak@gmail.com', 'Jalan Dipati Ukur nomor 20', 'Dago', '1994-05-08', 'L', 'R/v7V9ZhFBTy59EXcrlxVdko4i2cKRxvbHR1I2HZJ/A=', '-');

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
(68, '80133', 'IMG_20170508_155537_HDR.jpg'),
(69, '97391', '10824.jpg'),
(70, '94100', 'elektromagnetik.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_credits_anggota`
--

CREATE TABLE `tb_credits_anggota` (
  `id` int(4) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `topup_credit` bigint(10) NOT NULL DEFAULT '0',
  `status` varchar(15) NOT NULL,
  `tanggal_set` date NOT NULL,
  `total_credit` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_credits_anggota`
--

INSERT INTO `tb_credits_anggota` (`id`, `id_anggota`, `topup_credit`, `status`, `tanggal_set`, `total_credit`) VALUES
(1, '00001', 97000, 'paid', '2017-09-01', 4753000),
(23, '14048', 95000, 'paid', '2017-09-01', 1170000),
(24, '87553', 70000, 'paid', '2017-09-01', 210000),
(25, '72555', 70000, 'paid', '2017-09-01', 210000),
(26, '88863', 50000, 'paid', '2017-09-01', 150000),
(27, '62541', 70000, 'paid', '2017-09-01', 350000),
(39, '00001', 97000, 'unpaid', '2017-10-11', 21146000),
(40, '14048', 95000, 'unpaid', '2017-10-11', 855000),
(42, '72555', 70000, 'unpaid', '2017-10-11', 420000),
(43, '88863', 50000, 'unpaid', '2017-10-11', 300000),
(44, '62541', 70000, 'unpaid', '2017-10-11', 490000),
(45, '87553', 78000, 'unpaid', '2017-10-11', 468000),
(46, '27225', 80000, 'unpaid', '2017-10-11', 400000),
(47, '90706', 87000, 'unpaid', '2017-10-11', 522000),
(48, '14048', 45000, 'paid', '2017-08-01', 450000),
(49, '00001', 70000, 'paid', '2017-08-01', 450000),
(50, '27225', 75000, 'paid', '2060-00-00', 0),
(51, '62541', 60000, 'paid', '2017-08-10', 500000),
(52, '72555', 65000, 'paid', '2017-08-02', 900000);

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
(1, '00001', 0, 10),
(2, '27225', 15, 12),
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
  `id_anggota` varchar(15) NOT NULL,
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
(50, '00001', '2017-09-28', '15:37:57', 4, 'Presentasi', -6.890166600000001, 107.58019279999999, 'Jl. Sukasari I No.8, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-09-28', '2017-09-28', '10823.jpg'),
(51, '00001', '2017-10-04', '07:44:44', 2, 'kerja lampung', -6.8870027, 107.6168771, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(52, '00001', '2017-10-04', '07:46:39', 2, '', -6.886959399999999, 107.6168807, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(53, '00001', '2017-10-04', '07:47:11', 2, '', -6.8870759999999995, 107.6168434, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(54, '00001', '2017-10-04', '07:49:36', 2, 'tes2345', -6.8869975, 107.6168784, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(55, '00001', '2017-10-04', '08:41:10', 2, 'presentasi kakatu', -6.8869902, 107.6168804, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(56, '00001', '2017-10-04', '08:42:44', 1, '', -6.8869874, 107.6168818, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(57, '00001', '2017-10-04', '08:44:00', 1, '', -6.8869796, 107.616889, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(58, '00001', '2017-10-04', '08:46:47', 1, '', -6.8870002, 107.61687739999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(59, '00001', '2017-10-04', '08:47:59', 2, 'lapar', -6.8870138999999995, 107.6168782, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(60, '00001', '2017-10-04', '08:48:48', 2, 'LaPAr', -6.887034099999999, 107.6168583, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(61, '00001', '2017-10-04', '08:50:23', 1, '', -6.887016399999999, 107.6168784, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(62, '00001', '2017-10-04', '08:50:46', 1, '', -6.8870074, 107.61687889999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(63, '00001', '2017-10-04', '15:35:02', 2, 'Ingin THR', -6.887014700000001, 107.6168603, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(64, '00001', '2017-10-04', '15:35:37', 2, 'Ingin makan THR', -6.886995499999999, 107.61683169999999, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(65, '00001', '2017-10-04', '15:37:34', 2, 'Isi perut doeloe', -6.8869874, 107.6168634, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(66, '00001', '2017-10-04', '15:40:47', 2, 'ingin terbang keangkasa', -6.8870911999999995, 107.61682929999999, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(67, '00001', '2017-10-04', '15:47:18', 2, 'terangkanlah mereka', -6.887071, 107.6168319, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(68, '00001', '2017-10-04', '16:07:04', 2, 'makan di BIP', -6.8869668, 107.6168807, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(69, '00001', '2017-10-04', '16:20:13', 2, 'memasak kentang', -6.8870292, 107.6168263, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(70, '00001', '2017-10-04', '16:21:51', 2, 'mengenang ajsa para pahlawan', -6.8869718, 107.6168616, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(71, '00001', '2017-10-04', '16:23:30', 2, 'menembak teroris', -6.8870062999999995, 107.6168635, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(72, '00001', '2017-10-04', '16:23:51', 2, 'Menembak terror', -6.887074500000001, 107.6168381, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(73, '00001', '2017-10-04', '16:33:42', 2, 'mengenang jasa ibu', -6.8870303999999996, 107.61684419999999, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(74, '00001', '2017-10-04', '16:34:54', 2, 'ggdfgdfg df dfgdf', -6.8870046, 107.6168332, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(75, '00001', '2017-10-04', '16:36:29', 2, 'menebang leyalinan', -6.886982400000001, 107.6168793, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(76, '00001', '2017-10-04', '16:45:26', 2, 'mengenang mantan ke 100', -6.886977099999999, 107.6168569, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(77, '00001', '2017-10-04', '16:46:13', 2, 'mengenang mantan ke 100', -6.886977099999999, 107.6168569, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(78, '00001', '2017-10-04', '16:46:36', 2, 'ddggdg dfg df gd fg ', -6.8869948, 107.6168538, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(79, '00001', '2017-10-04', '17:13:42', 2, 'menakar tanah', -6.886802258805256, 107.61682636489604, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(80, '00001', '2017-10-04', '17:53:12', 4, 'menuju Paris kota', -6.8870491, 107.61682839999999, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(81, '00001', '2017-10-04', '17:55:46', 4, 'menjenguk mertua mantan', -6.8870758, 107.61683060000001, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-07', NULL),
(82, '00001', '2017-10-04', '18:02:18', 4, 'nonton SCTV', -6.887039, 107.616851, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(83, '00001', '2017-10-04', '18:03:18', 4, 'nonton Indosiar', -6.887046499999999, 107.61685, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-06', NULL),
(84, '00001', '2017-10-04', '18:07:47', 4, 'menuju bintang cahaya', -6.8870052, 107.6168781, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-06', NULL),
(85, '00001', '2017-10-04', '18:10:37', 4, 'sdfsd sd fsf s', -6.887117399999999, 107.6168412, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-05', '2017-10-08', NULL),
(86, '00001', '2017-10-04', '18:12:53', 4, 'sdvsdv sdf sdf s', -6.8870521, 107.6168347, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-06', NULL),
(87, '00001', '2017-10-04', '18:15:33', 4, 'sdfds sd sd sdv s  sd sd vsd vs s s vdv s vsdv', -6.8869921, 107.61686209999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-07', NULL),
(88, '00001', '2017-10-04', '18:48:39', 5, 'keliling eropa', -6.8870916, 107.61683289999999, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-07', NULL),
(89, '00001', '2017-10-04', '18:49:19', 5, 'keliling Asia', -6.887049299999999, 107.61682940000001, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-08', '2017-10-11', NULL),
(90, '00001', '2017-10-04', '18:53:36', 5, 'keliling Indonesia', -6.886980599999999, 107.616878, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-12', '2017-10-13', NULL),
(91, '00001', '2017-10-04', '18:55:27', 5, 'keliling Jawa Barat', -6.8870099, 107.61685609999999, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-13', '2017-10-14', NULL),
(92, '00001', '2017-10-04', '21:04:44', 1, '', -6.8870394, 107.61685399999999, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-04', '2017-10-04', NULL),
(93, '62541', '2017-10-04', '23:05:59', 1, '', -6.8869825, 107.61686429999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(94, '62541', '2017-10-04', '23:07:53', 1, '', -6.8870192999999995, 107.6168781, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(95, '62541', '2017-10-04', '23:08:17', 2, 'Menangis untuk menang', -6.8869003, 107.61687789999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-04', '2017-10-04', NULL),
(96, '00001', '2017-10-05', '01:01:04', 3, 'demam malaria', -6.8869956, 107.61687789999999, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-05', '2017-10-07', NULL),
(97, '00001', '2017-10-05', '15:43:41', 2, 'bebas', -6.890119299999999, 107.58022749999999, 'Jl. Sukasari I No.8, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-10-05', '2017-10-05', NULL),
(98, '00001', '2017-10-05', '15:45:01', 4, 'lapar', -6.890159499999999, 107.58021869999999, 'Jl. Sukasari I No.8, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-10-05', '2017-10-05', NULL),
(99, '27225', '2017-10-05', '16:00:03', 2, 'Sosialisasi SMIT AL marjan', -6.8902135, 107.580222, 'Jl. Sukasari II No.1, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-10-05', '2017-10-05', NULL),
(100, '00001', '2017-10-05', '16:00:53', 4, 'bebaskahsaja', -6.8902188803272795, 107.58023928270545, 'Jl. Sukasari II No.1, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-10-05', '2017-10-05', NULL),
(101, '27225', '2017-10-05', '16:01:20', 2, 'Sosialisasi sd almarjan', -6.8902007, 107.580242, 'Jl. Sukasari II No.1, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-10-05', '2017-10-05', NULL),
(102, '27225', '2017-10-05', '16:03:29', 3, 'Demam', -6.8902313, 107.5802305, 'Jl. Sukasari II No.1, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-10-05', '2017-10-05', NULL),
(103, '27225', '2017-10-05', '16:06:50', 4, 'Keperluan keluarga', -6.8902217, 107.5802189, 'Jl. Sukasari II No.1, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-10-05', '2017-10-05', NULL),
(104, '27225', '2017-10-05', '16:09:03', 5, 'Istri melahirkan', -6.8902217, 107.5802189, 'Jl. Sukasari II No.1, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-10-05', '2017-10-19', NULL),
(122, '00001', '2017-10-09', '23:58:17', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-09', '2017-10-09', NULL),
(123, '14048', '2017-10-09', '23:58:17', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-09', '2017-10-09', NULL),
(124, '27225', '2017-10-09', '23:58:17', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-09', '2017-10-09', NULL),
(125, '62541', '2017-10-09', '23:58:17', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-09', '2017-10-09', NULL),
(126, '72555', '2017-10-09', '23:58:17', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-09', '2017-10-09', NULL),
(127, '87553', '2017-10-09', '23:58:17', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-09', '2017-10-09', NULL),
(128, '88863', '2017-10-09', '23:58:17', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-09', '2017-10-09', NULL),
(129, '90706', '2017-10-09', '23:58:17', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-09', '2017-10-09', NULL),
(130, '00001', '2017-10-11', '00:22:03', 1, '', -6.8868488999999995, 107.6167905, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-11', '2017-10-11', NULL),
(132, '14048', '2017-10-11', '00:24:53', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-11', '2017-10-11', NULL),
(134, '62541', '2017-10-11', '00:24:53', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-11', '0000-00-00', NULL),
(138, '90706', '2017-10-11', '00:24:53', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-11', '2017-10-11', NULL),
(140, '14048', '2017-10-11', '10:37:19', 1, '', -6.8868408, 107.6168169, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-11', '2017-10-11', NULL),
(141, '14048', '2017-10-11', '11:13:22', 3, 'Malaria', -6.8868477, 107.6167929, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-11', '2017-10-11', NULL),
(151, '00001', '2017-10-12', '14:37:05', 1, '', -6.886879400000001, 107.6167605, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-12', '2017-10-12', NULL),
(169, '00001', '2017-10-12', '16:14:33', 3, 'malaria', -6.8901569, 107.58022179999999, 'Jl. Sukasari I No.8, Sukawarna, Sukajadi, Kota Bandung, Jawa Barat 40164, Indonesia', '2017-10-12', '2017-10-12', NULL),
(170, '00001', '2017-10-12', '16:36:46', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-12', '2017-10-12', NULL),
(171, '14048', '2017-10-12', '16:36:46', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-12', '2017-10-12', NULL),
(172, '27225', '2017-10-12', '16:36:46', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-12', '2017-10-12', NULL),
(173, '62541', '2017-10-12', '16:36:46', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-12', '2017-10-12', NULL),
(174, '72555', '2017-10-12', '16:36:46', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-12', '2017-10-12', NULL),
(175, '87553', '2017-10-12', '16:36:46', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-12', '2017-10-12', NULL),
(176, '88863', '2017-10-12', '16:36:46', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-12', '2017-10-12', NULL),
(177, '90706', '2017-10-12', '16:36:46', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-12', '2017-10-12', NULL),
(178, '00001', '2017-10-13', '12:14:40', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-13', '2017-10-13', NULL),
(179, '14048', '2017-10-13', '12:14:40', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-13', '2017-10-13', NULL),
(180, '27225', '2017-10-13', '12:14:40', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-13', '2017-10-13', NULL),
(181, '62541', '2017-10-13', '12:14:40', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-13', '2017-10-13', NULL),
(182, '72555', '2017-10-13', '12:14:40', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-13', '2017-10-13', NULL),
(183, '87553', '2017-10-13', '12:14:40', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-13', '2017-10-13', NULL),
(184, '88863', '2017-10-13', '12:14:40', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-13', '2017-10-13', NULL),
(185, '90706', '2017-10-13', '12:14:40', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-13', '2017-10-13', NULL),
(186, '00001', '2017-10-13', '20:06:45', 3, 'demam', -6.8869073, 107.61675489999999, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-13', '2017-10-13', NULL),
(188, '14048', '2017-10-14', '08:39:05', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-14', '2017-10-14', NULL),
(189, '27225', '2017-10-14', '08:39:05', 6, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-14', '2017-10-14', NULL),
(190, '62541', '2017-10-14', '08:39:05', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-14', '2017-10-14', NULL),
(191, '72555', '2017-10-14', '08:39:05', 5, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-14', '2017-10-14', NULL),
(192, '87553', '2017-10-14', '08:39:05', 1, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-14', '2017-10-14', NULL),
(193, '88863', '2017-10-14', '08:39:05', 2, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-14', '2017-10-14', NULL),
(194, '90706', '2017-10-14', '08:39:05', 3, '', -6.8869112, 107.6168524, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-14', '2017-10-14', NULL),
(195, '00001', '2017-10-14', '08:41:28', 4, 'malaria 3', -6.886863000000001, 107.616813, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-14', '2017-10-14', NULL),
(196, '00001', '2017-10-15', '14:06:25', 1, '', -6.8869273, 107.61675249999999, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-15', '2017-10-15', NULL),
(197, '00001', '2017-10-17', '21:44:49', 3, 'lapar', -6.9174638999999996, 107.61912280000001, 'Gg. Kebonpisang, Kb. Pisang, Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '2017-10-17', '2017-10-17', NULL),
(198, '00001', '2017-10-17', '22:00:43', 1, '', -6.88692724798516, 107.61646340611168, 'Jl. Tubagus Ismail Dalam No.13, Lebakgede, Coblong, Kota Bandung, Jawa Barat 40132, Indonesia', '2017-10-17', '2017-10-17', NULL),
(199, '00001', '2017-10-17', '22:46:43', 4, 'sakit', -6.88707074909483, 107.61672789759983, 'Jl. Tubagus Ismail Dalam No.15, Sekeloa, Coblong, Kota Bandung, Jawa Barat 40134, Indonesia', '2017-10-17', '2017-10-17', NULL),
(214, '00001', '2017-10-18', '21:40:02', 2, 'presentasi kakatu di SMA 3 Bandung', -6.8868623, 107.6168386, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-18', '2017-10-18', NULL),
(215, '00001', '2017-10-18', '21:42:23', 1, '', -6.8868623, 107.6168386, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-18', '2017-10-18', NULL),
(256, '00001', '2017-10-19', '23:38:43', 1, '', -6.8868161, 107.6168283, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-19', '2017-10-19', NULL),
(257, '00001', '2017-10-19', '23:38:55', 2, '', -6.9174638999999996, 107.61912280000001, 'Gg. Kebonpisang, Kb. Pisang, Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '2017-10-19', '2017-10-19', NULL),
(258, '00001', '2017-10-19', '23:40:38', 3, '', -6.9174638999999996, 107.61912280000001, 'Gg. Kebonpisang, Kb. Pisang, Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '2017-10-19', '2017-10-19', NULL),
(259, '00001', '2017-10-19', '23:41:23', 5, '', -6.9174638999999996, 107.61912280000001, 'Gg. Kebonpisang, Kb. Pisang, Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '2017-10-19', '2017-10-19', NULL),
(260, '00001', '2017-10-22', '15:41:55', 1, '', -6.8866681, 107.6168625, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-22', '2017-10-22', NULL),
(385, '00001', '2017-10-24', '21:31:01', 5, '', -6.8868585, 107.6168333, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-24', '2017-11-09', NULL),
(386, '00001', '2017-10-24', '21:31:01', 5, '', -6.8868585, 107.6168333, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-25', '2017-11-09', NULL),
(387, '00001', '2017-10-24', '21:31:02', 5, '', -6.8868585, 107.6168333, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-30', '2017-11-09', NULL),
(388, '00001', '2017-10-24', '21:31:02', 5, '', -6.8868585, 107.6168333, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-31', '2017-11-09', NULL),
(389, '00001', '2017-10-24', '21:31:02', 5, '', -6.8868585, 107.6168333, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-11-03', '2017-11-09', NULL),
(390, '00001', '2017-10-24', '21:31:03', 5, '', -6.8868585, 107.6168333, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-11-06', '2017-11-09', NULL),
(391, '00001', '2017-10-24', '21:31:03', 5, '', -6.8868585, 107.6168333, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-11-09', '2017-11-09', NULL),
(392, '00001', '2017-10-24', '21:41:49', 1, '', -6.8868583, 107.6168356, 'Gang III, Coblong, Kota Bandung, Jawa Barat, Indonesia', '2017-10-24', '2017-10-24', NULL);

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
('21113', '62541', '0', '2'),
('68022', '62541', '0', '0'),
('85887', '62541', '0', '0'),
('40467', '90706', '0', '2'),
('60195', '90706', '0', '2'),
('17153', '62541', '0', '0'),
('91901', '62541', '0', '0'),
('97391', '62541', '0', '0'),
('87738', '90706', '0', '0'),
('49009', '62541', '0', '0'),
('97130', '90706', '0', '0'),
('59434', '14048', '0', '0'),
('94100', '14048', '0', '0'),
('77878', '14048', '0', '0'),
('15665', '90706', '0', '0'),
('83236', '14048', '0', '0'),
('65336', '90706', '0', '0'),
('26950', '14048', '0', '0');

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
('15665', '90706', '2017-10-09 18:40:28', 'TR-01', '68000', 'hararta', '0'),
('17153', '62541', '2017-09-29 04:44:43', 'TR-02', '400', 'cash', '0'),
('18823', '62541', '2017-09-07 15:39:50', 'TR-04', '50000', 'Bayar ART', '1'),
('21113', '62541', '2017-09-11 21:15:01', 'TR-05', '900', 'Bayar tunai', '1'),
('26950', '14048', '2017-10-11 11:27:42', 'TR-04', '67000', 'Tidak Mahal', '0'),
('27650', '62541', '2017-09-07 04:14:09', 'TR-03', '50000', 'Bayar sampah        \r\n      ', '2'),
('39969', '62541', '2017-09-07 07:06:51', 'TR-01', '1000000', '2        \r\n      ', '2'),
('40467', '90706', '2017-09-16 21:41:21', 'TR-03', '300', 'Bayar cash', '1'),
('42232', '62541', '2017-09-03 12:50:42', 'TR-02', '50000', 'Air Galon         \r\n      ', '2'),
('43240', '90706', '2017-09-16 21:44:44', 'TR-05', '400', 'Bayar cash', '2'),
('47203', '62541', '2017-09-03 12:58:51', 'TR-03', '60000', '1', '2'),
('49009', '62541', '2017-10-09 18:16:44', 'TR-06', '69000', 'Cash', '0'),
('59434', '14048', '2017-10-09 18:30:39', 'TR-02', '68000', 'Cash dari dompet', '0'),
('60195', '90706', '2017-09-16 22:19:05', 'TR-03', '300', 'Cash', '1'),
('65336', '90706', '2017-10-09 19:03:46', 'TR-06', '46000', 'lapar', '0'),
('65848', '14048', '2017-10-09 18:54:29', 'TR-03', '63000', 'murah', '2'),
('68022', '62541', '2017-09-11 21:16:34', 'TR-05', '50000', ' Bayar tunai ', '0'),
('76673', '62541', '2017-09-06 06:30:42', 'TR-04', '90000', 'Bayar ART\r\n      ', '2'),
('77878', '14048', '2017-10-09 18:39:39', 'TR-06', '65000', 'bebas', '0'),
('80133', '62541', '2017-09-06 06:35:47', 'TR-02', '50000', 'Bayar test        \r\n      ', '0'),
('80206', '62541', '2017-09-07 09:20:57', 'TR-05', '60000', 'bayar transport meeting', '2'),
('81676', '62541', '2017-09-07 14:16:44', 'TR-02', '50000', 'Bayar 2 Air Galon, cash ke warung', '1'),
('83236', '14048', '2017-10-09 18:51:48', 'TR-01', '56000', 'murah sekali', '0'),
('85887', '62541', '2017-09-15 15:11:20', 'TR-03', '300', 'Cash aja bro', '0'),
('87738', '90706', '2017-10-09 18:08:10', 'TR-03', '65000', 'Cash', '0'),
('89607', '62541', '2017-09-07 15:40:13', 'TR-01', '10000', 'Bayar Listrik Bulan Ini', '1'),
('91901', '62541', '2017-10-05 10:38:25', 'TR-01', '65000', 'Bayar mandiri', '0'),
('94100', '14048', '2017-10-09 18:38:13', 'TR-05', '30000', 'ngutang', '0'),
('97130', '90706', '2017-10-09 18:18:19', 'TR-04', '52000', 'Cash langsung', '0'),
('97391', '62541', '2017-10-05 10:39:40', 'TR-05', '68600', 'Naik Avansa', '0');

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
(2, 'Tahun Baru 2018', '2018-01-01', '2018-01-04', 1),
(8, 'Libur Kantor', '2017-11-07', '2017-11-08', 2),
(9, 'Idul Adha', '2017-10-02', '2017-10-03', 2),
(10, 'nyoba 1', '2017-11-01', '2017-11-02', 2),
(11, 'nyoba 2', '2017-10-26', '2017-10-28', 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tb_credits_anggota`
--
ALTER TABLE `tb_credits_anggota`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tb_cuti_anggota`
--
ALTER TABLE `tb_cuti_anggota`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_detail_absen`
--
ALTER TABLE `tb_detail_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- AUTO_INCREMENT for table `tb_tgllibur`
--
ALTER TABLE `tb_tgllibur`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
