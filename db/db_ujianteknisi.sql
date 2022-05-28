-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 07:34 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujianteknisi`
--

-- --------------------------------------------------------

--
-- Table structure for table `centroid_temp`
--

CREATE TABLE `centroid_temp` (
  `id` int(5) NOT NULL,
  `iterasi` int(11) NOT NULL,
  `c1` varchar(50) NOT NULL,
  `c2` varchar(50) NOT NULL,
  `c3` varchar(50) NOT NULL,
  `c4` varchar(50) NOT NULL,
  `c5` varchar(50) NOT NULL,
  `c6` varchar(50) NOT NULL,
  `c7` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `centroid_temp`
--

INSERT INTO `centroid_temp` (`id`, `iterasi`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `c7`) VALUES
(1, 1, '0', '0', '0', '0', '0', '1', '0'),
(2, 1, '0', '1', '0', '0', '0', '0', '0'),
(3, 2, '0', '0', '0', '0', '0', '1', '0'),
(4, 2, '0', '1', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_centroid`
--

CREATE TABLE `hasil_centroid` (
  `nomor` int(2) NOT NULL,
  `c1a` varchar(50) NOT NULL,
  `c1b` varchar(50) NOT NULL,
  `c1c` varchar(50) NOT NULL,
  `c1d` varchar(50) NOT NULL,
  `c2a` varchar(50) NOT NULL,
  `c2b` varchar(50) NOT NULL,
  `c2c` varchar(50) NOT NULL,
  `c2d` varchar(59) NOT NULL,
  `c3a` varchar(50) NOT NULL,
  `c3b` varchar(50) NOT NULL,
  `c3c` varchar(50) NOT NULL,
  `c3d` varchar(50) NOT NULL,
  `c4a` varchar(50) NOT NULL,
  `c4b` varchar(50) NOT NULL,
  `c4c` varchar(10) NOT NULL,
  `c4d` varchar(20) NOT NULL,
  `c5a` varchar(20) NOT NULL,
  `c5b` varchar(50) NOT NULL,
  `c5c` varchar(30) NOT NULL,
  `c5d` varchar(30) NOT NULL,
  `c6a` varchar(20) NOT NULL,
  `c6b` varchar(20) NOT NULL,
  `c6c` varchar(20) NOT NULL,
  `c6d` varchar(20) NOT NULL,
  `c7a` varchar(20) NOT NULL,
  `c7b` varchar(20) NOT NULL,
  `c7c` varchar(20) NOT NULL,
  `c7d` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_centroid`
--

INSERT INTO `hasil_centroid` (`nomor`, `c1a`, `c1b`, `c1c`, `c1d`, `c2a`, `c2b`, `c2c`, `c2d`, `c3a`, `c3b`, `c3c`, `c3d`, `c4a`, `c4b`, `c4c`, `c4d`, `c5a`, `c5b`, `c5c`, `c5d`, `c6a`, `c6b`, `c6c`, `c6d`, `c7a`, `c7b`, `c7c`, `c7d`) VALUES
(1, '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '5', '17.525', '8', '8', '0', '0', '0', '0'),
(2, '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '5', '17.525', '8', '8', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_klasterisasi`
--

CREATE TABLE `hasil_klasterisasi` (
  `id_klasterisasi` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_teknisi` varchar(200) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `jabatan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_klasterisasi`
--

INSERT INTO `hasil_klasterisasi` (`id_klasterisasi`, `user_id`, `nama_teknisi`, `ujian_id`, `jabatan`) VALUES
(1, 3, 'Bagas', 7, 'Teknisi Software'),
(2, 4, 'Abdul', 7, 'Teknisi Inventory');

-- --------------------------------------------------------

--
-- Table structure for table `tb_akumulasi`
--

CREATE TABLE `tb_akumulasi` (
  `akumulasi_id` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `akumulasi_jenis` enum('pg','essai','uprak') NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `akumulasi_skor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_akumulasi`
--

INSERT INTO `tb_akumulasi` (`akumulasi_id`, `ujian_id`, `user_id`, `akumulasi_jenis`, `kategori_id`, `akumulasi_skor`) VALUES
(73, 6, 4, 'pg', 1, 1),
(74, 6, 4, 'pg', 2, 0),
(75, 6, 4, 'pg', 3, 0),
(76, 6, 4, 'pg', 4, 0),
(77, 6, 3, 'pg', 1, 0),
(78, 6, 3, 'pg', 2, 0),
(79, 6, 3, 'pg', 3, 1),
(80, 6, 3, 'pg', 4, 0),
(81, 6, 3, 'essai', 1, 4),
(82, 6, 3, 'essai', 2, 8),
(83, 6, 3, 'essai', 3, 8),
(84, 6, 3, 'essai', 4, 10),
(85, 6, 3, 'uprak', 1, NULL),
(86, 6, 3, 'uprak', 2, NULL),
(87, 6, 3, 'uprak', 3, NULL),
(88, 6, 3, 'uprak', 4, NULL),
(89, 6, 4, 'essai', 1, 5),
(90, 6, 4, 'essai', 2, 9),
(91, 6, 4, 'essai', 3, 10),
(92, 6, 4, 'essai', 4, 10),
(93, 6, 4, 'uprak', 1, NULL),
(94, 6, 4, 'uprak', 2, NULL),
(95, 6, 4, 'uprak', 3, NULL),
(96, 6, 4, 'uprak', 4, NULL),
(97, 7, 4, 'pg', 1, 0),
(98, 7, 4, 'pg', 2, 0),
(99, 7, 4, 'pg', 3, 1),
(100, 7, 4, 'pg', 4, 0),
(101, 7, 3, 'pg', 1, 1),
(102, 7, 3, 'pg', 2, 1),
(103, 7, 3, 'pg', 3, 0),
(104, 7, 3, 'pg', 4, 0),
(105, 7, 4, 'essai', 1, 4),
(106, 7, 4, 'essai', 2, 9),
(107, 7, 4, 'essai', 3, NULL),
(108, 7, 4, 'essai', 4, NULL),
(109, 7, 4, 'uprak', 1, NULL),
(110, 7, 4, 'uprak', 2, NULL),
(111, 7, 4, 'uprak', 3, NULL),
(112, 7, 4, 'uprak', 4, NULL),
(113, 7, 3, 'essai', 1, 4),
(114, 7, 3, 'essai', 2, 8),
(115, 7, 3, 'essai', 3, 8),
(116, 7, 3, 'essai', 4, 8),
(117, 7, 3, 'uprak', 1, NULL),
(118, 7, 3, 'uprak', 2, 8.525),
(119, 7, 3, 'uprak', 3, NULL),
(120, 7, 3, 'uprak', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_akumulasi_temp`
--

CREATE TABLE `tb_akumulasi_temp` (
  `id_teknisi` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_teknisi` varchar(28) NOT NULL,
  `pu` double DEFAULT NULL,
  `software` double DEFAULT NULL,
  `hardware` double DEFAULT NULL,
  `kelistrikan` double DEFAULT NULL,
  `akumulasi` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_akumulasi_temp`
--

INSERT INTO `tb_akumulasi_temp` (`id_teknisi`, `user_id`, `nama_teknisi`, `pu`, `software`, `hardware`, `kelistrikan`, `akumulasi`) VALUES
(1, 3, 'Bagas', 5, 17.525, 8, 8, NULL),
(2, 4, 'Abdul', 0, 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_ujian`
--

CREATE TABLE `tb_hasil_ujian` (
  `h_ujian_id` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ujian_created` datetime DEFAULT NULL,
  `h_ujian_status` enum('0','1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hasil_ujian`
--

INSERT INTO `tb_hasil_ujian` (`h_ujian_id`, `ujian_id`, `user_id`, `ujian_created`, `h_ujian_status`) VALUES
(8, 6, 3, '2020-07-15 22:45:44', '4'),
(9, 6, 4, '2020-07-15 22:45:47', '4'),
(10, 7, 3, '2020-07-22 07:56:11', '4'),
(11, 7, 4, '2020-07-22 07:57:01', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tb_indikator_jabatan`
--

CREATE TABLE `tb_indikator_jabatan` (
  `i_jabatan_id` int(11) NOT NULL,
  `i_jabatan_teknisi` varchar(100) NOT NULL,
  `i_jabatan_kode` varchar(5) DEFAULT NULL,
  `i_jabatan_pu` float NOT NULL,
  `i_jabatan_software` float NOT NULL,
  `i_jabatan_hardware` float NOT NULL,
  `i_jabatan_listrik` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_indikator_jabatan`
--

INSERT INTO `tb_indikator_jabatan` (`i_jabatan_id`, `i_jabatan_teknisi`, `i_jabatan_kode`, `i_jabatan_pu`, `i_jabatan_software`, `i_jabatan_hardware`, `i_jabatan_listrik`) VALUES
(1, 'Teknisi Produksi', 'tp', 0.5, 0.2, 0.7, 0.6),
(2, 'Teknisi Inventory', 'ti', 0.8, 0.2, 0.2, 0.2),
(3, 'Teknisi Instalasi Listrik', 'til', 0.6, 0.3, 0.7, 0.8),
(4, 'Teknisi Instalasi Umum', 'tiu', 0.8, 0.5, 0.5, 0.5),
(5, 'Teknisi Konfigurasi', 'tk', 0.7, 0.8, 0.6, 0.5),
(6, 'Teknisi Software', 'ts', 0.6, 0.9, 0.6, 0.5),
(7, 'Teknisi RnD', 'tr', 0.8, 0.8, 0.8, 0.7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_indikator_nilai_essai`
--

CREATE TABLE `tb_indikator_nilai_essai` (
  `indikator_nilai_essai_id` int(11) NOT NULL,
  `soal_essai_id` int(11) NOT NULL,
  `skor` varchar(20) NOT NULL,
  `indikator` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_indikator_nilai_essai`
--

INSERT INTO `tb_indikator_nilai_essai` (`indikator_nilai_essai_id`, `soal_essai_id`, `skor`, `indikator`) VALUES
(1, 2, '1-3', 'Jaringan Komputer adalah jaringan telekomunikasi antar komputer'),
(2, 2, '4-5', 'Jaringan Komputer adalah jaringan telekomunikasi antar komputer yang memungkinkan komputer untuk berkomunikasi dengan bertukar data');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_soal`
--

CREATE TABLE `tb_kategori_soal` (
  `kategori_id` int(11) NOT NULL,
  `kategori_soal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_soal`
--

INSERT INTO `tb_kategori_soal` (`kategori_id`, `kategori_soal`) VALUES
(1, 'Pengetahuan Umum'),
(2, 'Software'),
(3, 'Hardware'),
(4, 'Kelistrikan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komponen_uprak`
--

CREATE TABLE `tb_komponen_uprak` (
  `komponen_uprak_id` int(11) NOT NULL,
  `komponen_uprak_komponen` varchar(200) NOT NULL,
  `komponen_uprak_bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_komponen_uprak`
--

INSERT INTO `tb_komponen_uprak` (`komponen_uprak_id`, `komponen_uprak_komponen`, `komponen_uprak_bobot`) VALUES
(1, 'Persiapan Kerja', 20),
(2, 'Proses (Sistematika dan Cara Kerja)', 35),
(3, 'Hasil Kerja', 35),
(4, 'Efektivitas Kerja', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_materi_uprak`
--

CREATE TABLE `tb_materi_uprak` (
  `uprak_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `uprak_materi` text NOT NULL,
  `uprak_bobot` int(11) NOT NULL,
  `uprak_tahun` varchar(4) NOT NULL,
  `uprak_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_materi_uprak`
--

INSERT INTO `tb_materi_uprak` (`uprak_id`, `kategori_id`, `uprak_materi`, `uprak_bobot`, `uprak_tahun`, `uprak_status`) VALUES
(2, 2, 'Praktekan cara memasukkan konten pada Nova Studio', 10, '2019', '1'),
(3, 4, 'Bagaimana cara merangkai listrik DC?', 20, '2020', '1'),
(4, 3, 'Praktekan konfigurasi mikrotik', 20, '2020', '1'),
(5, 1, 'Praktekan cara me-masking LED?', 10, '2020', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_essai`
--

CREATE TABLE `tb_nilai_essai` (
  `nilai_essai_id` int(11) NOT NULL,
  `soal_essai_id` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nilai_essai_jawaban` text NOT NULL,
  `nilai_essai_skor` int(11) DEFAULT NULL,
  `nilai_essai_ragu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai_essai`
--

INSERT INTO `tb_nilai_essai` (`nilai_essai_id`, `soal_essai_id`, `ujian_id`, `user_id`, `nilai_essai_jawaban`, `nilai_essai_skor`, `nilai_essai_ragu`) VALUES
(19, 1, 6, 3, 'dsa', 8, 0),
(20, 2, 6, 3, 'dsa', 4, 0),
(21, 4, 6, 3, 'dsa', 8, 0),
(22, 6, 6, 3, 'dsa', 10, 0),
(23, 3, 6, 4, 'dsa', 9, 0),
(24, 7, 6, 4, 'dsa', 5, 0),
(25, 8, 6, 4, 'dsa', 10, 0),
(26, 9, 6, 4, 'dsa', 10, 0),
(27, 3, 7, 4, 'jawaban', 9, 0),
(28, 7, 7, 4, 'Local Area Network', 4, 0),
(29, 8, 7, 4, 'modul led adalah', NULL, 0),
(30, 9, 7, 4, 'step adalah', NULL, 0),
(31, 1, 7, 3, 'asd', 8, 0),
(32, 2, 7, 3, 'asd', 4, 0),
(33, 4, 7, 3, 'asd', 8, 0),
(34, 6, 7, 3, 'asd', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_pg`
--

CREATE TABLE `tb_nilai_pg` (
  `nilai_pg_id` int(11) NOT NULL,
  `soal_pg_id` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nilai_pg_jawaban` varchar(2) NOT NULL,
  `nilai_pg_ragu` enum('0','1') NOT NULL,
  `nilai_pg_koreksi` enum('0','1') NOT NULL,
  `nilai_pg_skor` int(11) NOT NULL,
  `nilai_pg_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai_pg`
--

INSERT INTO `tb_nilai_pg` (`nilai_pg_id`, `soal_pg_id`, `ujian_id`, `user_id`, `nilai_pg_jawaban`, `nilai_pg_ragu`, `nilai_pg_koreksi`, `nilai_pg_skor`, `nilai_pg_order`) VALUES
(31, 2, 6, 3, 'a', '0', '0', 0, NULL),
(32, 7, 6, 4, 'a', '0', '0', 0, NULL),
(33, 10, 6, 4, 'c', '0', '0', 0, NULL),
(34, 3, 6, 3, 'a', '0', '1', 1, NULL),
(35, 4, 6, 3, 'c', '0', '0', 0, NULL),
(36, 5, 6, 3, 'b', '0', '0', 0, NULL),
(37, 11, 6, 4, 'd', '0', '0', 0, NULL),
(38, 6, 6, 4, 'b', '0', '1', 1, NULL),
(39, 2, 7, 3, 'b', '0', '1', 1, NULL),
(40, 3, 7, 3, 'c', '0', '0', 0, NULL),
(41, 6, 7, 4, 'c', '0', '0', 0, NULL),
(42, 7, 7, 4, 'b', '0', '0', 0, NULL),
(43, 10, 7, 4, 'b', '0', '0', 0, NULL),
(44, 11, 7, 4, 'd', '0', '1', 1, NULL),
(45, 4, 7, 3, 'b', '0', '0', 0, NULL),
(46, 5, 7, 3, 'a', '0', '1', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_subkomponen_uprak`
--

CREATE TABLE `tb_nilai_subkomponen_uprak` (
  `nilai_sk_uprak_id` int(11) NOT NULL,
  `uprak_id` int(11) NOT NULL,
  `komponen_uprak_id` int(11) NOT NULL,
  `sk_uprak_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `sk_uprak_nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai_subkomponen_uprak`
--

INSERT INTO `tb_nilai_subkomponen_uprak` (`nilai_sk_uprak_id`, `uprak_id`, `komponen_uprak_id`, `sk_uprak_id`, `user_id`, `ujian_id`, `sk_uprak_nilai`) VALUES
(1, 2, 1, 16, 3, 7, 80),
(2, 2, 2, 17, 3, 7, 90),
(3, 2, 2, 18, 3, 7, 90),
(4, 2, 3, 19, 3, 7, 90),
(5, 2, 3, 20, 3, 7, 80),
(6, 2, 4, 21, 3, 7, 80);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_uprak`
--

CREATE TABLE `tb_nilai_uprak` (
  `nilai_uprak_id` int(11) NOT NULL,
  `uprak_id` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nilai_uprak_skor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai_uprak`
--

INSERT INTO `tb_nilai_uprak` (`nilai_uprak_id`, `uprak_id`, `ujian_id`, `user_id`, `nilai_uprak_skor`) VALUES
(1, 2, 7, 3, 8.525);

-- --------------------------------------------------------

--
-- Table structure for table `tb_skor_max`
--

CREATE TABLE `tb_skor_max` (
  `skor_max_id` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `skor_max_skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_skor_max`
--

INSERT INTO `tb_skor_max` (`skor_max_id`, `ujian_id`, `kategori_id`, `skor_max_skor`) VALUES
(17, 6, 1, 16),
(18, 6, 2, 21),
(19, 6, 3, 31),
(20, 6, 4, 31),
(21, 7, 1, 16),
(22, 7, 2, 21),
(23, 7, 3, 31),
(24, 7, 4, 31);

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_d`
--

CREATE TABLE `tb_soal_d` (
  `soal_d_id` int(11) NOT NULL,
  `soal_d_tgl` date DEFAULT NULL,
  `soal_d_status` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal_d`
--

INSERT INTO `tb_soal_d` (`soal_d_id`, `soal_d_tgl`, `soal_d_status`) VALUES
(1, '2019-11-27', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_essai`
--

CREATE TABLE `tb_soal_essai` (
  `soal_essai_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `soal_essai_soal` text NOT NULL,
  `soal_essai_jawaban` text NOT NULL,
  `soal_essai_bobot` int(11) NOT NULL,
  `soal_essai_tahun` varchar(4) NOT NULL,
  `soal_essai_status` enum('A','B') NOT NULL,
  `soal_essai_media` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal_essai`
--

INSERT INTO `tb_soal_essai` (`soal_essai_id`, `kategori_id`, `soal_essai_soal`, `soal_essai_jawaban`, `soal_essai_bobot`, `soal_essai_tahun`, `soal_essai_status`, `soal_essai_media`) VALUES
(1, 2, 'Apa nama komponen diatas ini? Jelaskan fungsinya!', '', 10, '2019', 'A', 'WhatsApp_Image_2020-07-21_at_23_42_12.jpeg'),
(2, 1, 'Apa yang dimaksud Jaringan Komputer?', 'Jaringan Komputer adalah jaringan telekomunikasi antar komputer yang memungkinkan komputer untuk berkomunikasi dengan bertukar data', 5, '2019', 'A', ''),
(3, 2, 'Apa nama komponen diatas ini? Jelaskan fungsinya!', '', 10, '2019', 'B', 'WhatsApp_Image_2020-07-21_at_23_42_12_(1).jpeg'),
(4, 3, 'Apa yang dimaksud videotron?', '', 10, '2020', 'A', ''),
(6, 4, 'Apa fungsi panel listrik pada videotron?', '', 10, '2020', 'A', ''),
(7, 1, 'Apa yang dimaksud LAN?', 'jaringan komputer yang jaringannya hanya mencakup wilayah kecil; seperti jaringan komputer kampus, gedung, kantor, dalam rumah, sekolah atau yang lebih kecil', 5, '2019', 'B', NULL),
(8, 3, 'Apa yang dimaksud Modul LED?', '', 10, '2019', 'B', 'default.jpg'),
(9, 4, 'Kenapa panel listrik disebut step, berikan alasannya?', '', 10, '2019', 'B', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_pg`
--

CREATE TABLE `tb_soal_pg` (
  `soal_pg_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `soal_pg_bobot` int(11) NOT NULL,
  `soal_pg_soal` text NOT NULL,
  `soal_pg_pil_a` text NOT NULL,
  `soal_pg_pil_b` text NOT NULL,
  `soal_pg_pil_c` text NOT NULL,
  `soal_pg_pil_d` text NOT NULL,
  `soal_pg_jawaban` enum('a','b','c','d') NOT NULL,
  `soal_pg_tahun` varchar(4) NOT NULL,
  `soal_pg_status` enum('A','B') NOT NULL,
  `soal_pg_media` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal_pg`
--

INSERT INTO `tb_soal_pg` (`soal_pg_id`, `kategori_id`, `soal_pg_bobot`, `soal_pg_soal`, `soal_pg_pil_a`, `soal_pg_pil_b`, `soal_pg_pil_c`, `soal_pg_pil_d`, `soal_pg_jawaban`, `soal_pg_tahun`, `soal_pg_status`, `soal_pg_media`) VALUES
(2, 2, 1, 'Software yang digunakan untuk konfigurasi Media Player?', 'Nova Studio', 'Led Vision', 'Xampp', 'Visual Studio', 'b', '2019', 'A', ''),
(3, 3, 1, 'Apa nama komponen diatas ini?', 'Kabel VGA', 'LED Display', 'Videotron', 'Media Player', 'a', '2019', 'A', 'WhatsApp_Image_2020-07-21_at_23_28_36.jpeg'),
(4, 4, 1, 'Berapa tegangan listik yang masuk ke modul LED?', '220 V', '230 V', '250 V', '120 V', 'a', '2019', 'A', ''),
(5, 1, 1, 'Bagaimana urutan warna penyambungan kabel UTP crossover?', 'Putih hijau - hijau - putih orange - biru - putih biru - orange - putih coklat - coklat', 'Putih coklat - coklat - putih hijau - hijau - putih orange - biru - putih biru - orange', 'Putih biru - orange - putih coklat - coklat - putih hijau - hijau - putih orange - biru', 'Putih orange - biru - putih coklat - coklat - putih hijau - hijau', 'a', '2019', 'A', ''),
(6, 1, 1, 'Bagaimana urutan warna penyambungan kabel UTP straight?', 'Putih hijau - hijau - putih orange - biru - putih biru - orange - putih coklat - coklat', 'Putih orange - orange - putih hijau - biru - putih biru - hijau - putih coklat - coklat', 'Putih biru - hijau - putih orange - orange - putih hijau - biru - putih coklat - coklat', 'Putih hijau - biru - putih orange - orange - putih biru - hijau - putih coklat - coklat', 'b', '2019', 'B', ''),
(7, 2, 1, 'Sebutkan software yang digunakan untuk konfigurasi Nova Mctrl300?', 'Xampp', 'Led Vision', 'Nova Studio', 'Visual Studio', 'c', '2019', 'B', ''),
(10, 4, 1, 'Jika di PSU tertera 60A, berapa kapasitas PSU sebenarnya?', '100 watt', '200 watt', '300 watt', '400 watt', 'a', '2019', 'B', ''),
(11, 3, 1, 'Apa nama perangkat diatas ini?', 'Kabel VGA', 'Led Display', 'Router', 'Media Player', 'd', '2019', 'B', 'WhatsApp_Image_2020-07-21_at_23_28_37.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_subkomponen_uprak`
--

CREATE TABLE `tb_subkomponen_uprak` (
  `sk_uprak_id` int(11) NOT NULL,
  `komponen_uprak_id` int(11) NOT NULL,
  `uprak_id` int(11) NOT NULL,
  `sk_subkomponen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_subkomponen_uprak`
--

INSERT INTO `tb_subkomponen_uprak` (`sk_uprak_id`, `komponen_uprak_id`, `uprak_id`, `sk_subkomponen`) VALUES
(1, 1, 5, 'abc'),
(2, 2, 5, 'langkah1'),
(3, 2, 5, 'langkah2'),
(4, 3, 5, 'hasil1'),
(5, 4, 5, 'kecepatan'),
(6, 4, 5, 'kerapihan'),
(7, 1, 4, 'siap1'),
(8, 2, 4, 'proses1'),
(9, 3, 4, 'hasil1'),
(11, 1, 3, 'persiapan'),
(12, 2, 3, 'proses1'),
(13, 3, 3, 'hasil'),
(14, 4, 3, 'kecepatan'),
(15, 4, 4, 'kebersihan1'),
(16, 1, 2, 'siap1'),
(17, 2, 2, 'p1'),
(18, 2, 2, 'p2'),
(19, 3, 2, 'h1'),
(20, 3, 2, 'h2'),
(21, 4, 2, 'plus'),
(22, 2, 3, 'proses2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ujian`
--

CREATE TABLE `tb_ujian` (
  `ujian_id` int(11) NOT NULL,
  `ujian_nama` varchar(100) NOT NULL,
  `ujian_tanggal` date NOT NULL,
  `ujian_waktu` int(11) NOT NULL,
  `ujian_essai_waktu` int(11) NOT NULL,
  `ujian_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ujian`
--

INSERT INTO `tb_ujian` (`ujian_id`, `ujian_nama`, `ujian_tanggal`, `ujian_waktu`, `ujian_essai_waktu`, `ujian_status`) VALUES
(6, 'ujian1', '2020-07-02', 180, 180, '0'),
(7, 'ujian tes', '2020-07-22', 60, 60, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` text NOT NULL,
  `user_jk` enum('L','P') NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_nohp` varchar(13) NOT NULL,
  `user_alamat` text NOT NULL,
  `user_foto` text NOT NULL,
  `user_level` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_jk`, `user_email`, `user_nohp`, `user_alamat`, `user_foto`, `user_level`) VALUES
(1, 'Gugun Gunawan', 'gugun', '$2y$10$niLOZhUQwyFAHxBtcCHz1.sZtAn1iyfiw5ajUfpj3sCGauz8lWL86', 'L', 'gugun@gmail.com', '089123123123', 'Jakarta Pusat', '', '1'),
(2, 'Ramadhan', 'rama', '$2y$10$niLOZhUQwyFAHxBtcCHz1.sZtAn1iyfiw5ajUfpj3sCGauz8lWL86', 'L', 'rama@gmail.com', '089123123456', 'Kalijati, Subang', '', '1'),
(3, 'Bagas', 'bagas', '$2y$10$niLOZhUQwyFAHxBtcCHz1.sZtAn1iyfiw5ajUfpj3sCGauz8lWL86', 'L', 'bagas@gmail.com', '089123123123', 'Sagalaherang', '', '2'),
(4, 'Abdul', 'abdul', '$2y$10$KnqZZfbB4v2vjG1DykZ7EOFeDMWlDcHszbvBMNGvXE/HeL5Y5vwuS', 'L', 'abdul@gmail.com', '089123123123', 'Perum Boncu', '', '2'),
(5, 'Irshadi', 'icad', '$2y$10$Y5EVFk4a5CmF00FNOM3o4ueq37NVJEGyJ15U22nde3USG4tk1f6Mu', 'L', 'irshadi@gmail.com', '089123123123', 'Soklat', '', '2'),
(6, 'dahlan', 'emon', '$2y$10$Eo8uV.ez6wIqKTW6pytBxe3cKDlOYho86I6oxYd8xezkcPqa3.eha', 'L', 'emon@gmail.com', '0896798789', 'Sukamandi\r\n', '', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centroid_temp`
--
ALTER TABLE `centroid_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_centroid`
--
ALTER TABLE `hasil_centroid`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `hasil_klasterisasi`
--
ALTER TABLE `hasil_klasterisasi`
  ADD PRIMARY KEY (`id_klasterisasi`);

--
-- Indexes for table `tb_akumulasi`
--
ALTER TABLE `tb_akumulasi`
  ADD PRIMARY KEY (`akumulasi_id`);

--
-- Indexes for table `tb_akumulasi_temp`
--
ALTER TABLE `tb_akumulasi_temp`
  ADD PRIMARY KEY (`id_teknisi`);

--
-- Indexes for table `tb_hasil_ujian`
--
ALTER TABLE `tb_hasil_ujian`
  ADD PRIMARY KEY (`h_ujian_id`);

--
-- Indexes for table `tb_indikator_jabatan`
--
ALTER TABLE `tb_indikator_jabatan`
  ADD PRIMARY KEY (`i_jabatan_id`);

--
-- Indexes for table `tb_indikator_nilai_essai`
--
ALTER TABLE `tb_indikator_nilai_essai`
  ADD PRIMARY KEY (`indikator_nilai_essai_id`);

--
-- Indexes for table `tb_kategori_soal`
--
ALTER TABLE `tb_kategori_soal`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tb_komponen_uprak`
--
ALTER TABLE `tb_komponen_uprak`
  ADD PRIMARY KEY (`komponen_uprak_id`);

--
-- Indexes for table `tb_materi_uprak`
--
ALTER TABLE `tb_materi_uprak`
  ADD PRIMARY KEY (`uprak_id`);

--
-- Indexes for table `tb_nilai_essai`
--
ALTER TABLE `tb_nilai_essai`
  ADD PRIMARY KEY (`nilai_essai_id`);

--
-- Indexes for table `tb_nilai_pg`
--
ALTER TABLE `tb_nilai_pg`
  ADD PRIMARY KEY (`nilai_pg_id`);

--
-- Indexes for table `tb_nilai_subkomponen_uprak`
--
ALTER TABLE `tb_nilai_subkomponen_uprak`
  ADD PRIMARY KEY (`nilai_sk_uprak_id`);

--
-- Indexes for table `tb_nilai_uprak`
--
ALTER TABLE `tb_nilai_uprak`
  ADD PRIMARY KEY (`nilai_uprak_id`);

--
-- Indexes for table `tb_skor_max`
--
ALTER TABLE `tb_skor_max`
  ADD PRIMARY KEY (`skor_max_id`);

--
-- Indexes for table `tb_soal_d`
--
ALTER TABLE `tb_soal_d`
  ADD PRIMARY KEY (`soal_d_id`);

--
-- Indexes for table `tb_soal_essai`
--
ALTER TABLE `tb_soal_essai`
  ADD PRIMARY KEY (`soal_essai_id`);

--
-- Indexes for table `tb_soal_pg`
--
ALTER TABLE `tb_soal_pg`
  ADD PRIMARY KEY (`soal_pg_id`);

--
-- Indexes for table `tb_subkomponen_uprak`
--
ALTER TABLE `tb_subkomponen_uprak`
  ADD PRIMARY KEY (`sk_uprak_id`);

--
-- Indexes for table `tb_ujian`
--
ALTER TABLE `tb_ujian`
  ADD PRIMARY KEY (`ujian_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centroid_temp`
--
ALTER TABLE `centroid_temp`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hasil_centroid`
--
ALTER TABLE `hasil_centroid`
  MODIFY `nomor` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hasil_klasterisasi`
--
ALTER TABLE `hasil_klasterisasi`
  MODIFY `id_klasterisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_akumulasi`
--
ALTER TABLE `tb_akumulasi`
  MODIFY `akumulasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `tb_akumulasi_temp`
--
ALTER TABLE `tb_akumulasi_temp`
  MODIFY `id_teknisi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_hasil_ujian`
--
ALTER TABLE `tb_hasil_ujian`
  MODIFY `h_ujian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_indikator_jabatan`
--
ALTER TABLE `tb_indikator_jabatan`
  MODIFY `i_jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_indikator_nilai_essai`
--
ALTER TABLE `tb_indikator_nilai_essai`
  MODIFY `indikator_nilai_essai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kategori_soal`
--
ALTER TABLE `tb_kategori_soal`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_komponen_uprak`
--
ALTER TABLE `tb_komponen_uprak`
  MODIFY `komponen_uprak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_materi_uprak`
--
ALTER TABLE `tb_materi_uprak`
  MODIFY `uprak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_nilai_essai`
--
ALTER TABLE `tb_nilai_essai`
  MODIFY `nilai_essai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_nilai_pg`
--
ALTER TABLE `tb_nilai_pg`
  MODIFY `nilai_pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tb_nilai_subkomponen_uprak`
--
ALTER TABLE `tb_nilai_subkomponen_uprak`
  MODIFY `nilai_sk_uprak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_nilai_uprak`
--
ALTER TABLE `tb_nilai_uprak`
  MODIFY `nilai_uprak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_skor_max`
--
ALTER TABLE `tb_skor_max`
  MODIFY `skor_max_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_soal_d`
--
ALTER TABLE `tb_soal_d`
  MODIFY `soal_d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_soal_essai`
--
ALTER TABLE `tb_soal_essai`
  MODIFY `soal_essai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_soal_pg`
--
ALTER TABLE `tb_soal_pg`
  MODIFY `soal_pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_subkomponen_uprak`
--
ALTER TABLE `tb_subkomponen_uprak`
  MODIFY `sk_uprak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_ujian`
--
ALTER TABLE `tb_ujian`
  MODIFY `ujian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
