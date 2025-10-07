-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2025 at 09:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbjagakos`
--

-- --------------------------------------------------------

--
-- Table structure for table `kartupesanan`
--

CREATE TABLE `kartupesanan` (
  `nomor_pesanan` int(5) NOT NULL,
  `jenis_pesanan` varchar(20) DEFAULT NULL,
  `jml_pesanan` bigint(10) DEFAULT NULL,
  `tgl_pesanan` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `pemesan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kartupesanan`
--

INSERT INTO `kartupesanan` (`nomor_pesanan`, `jenis_pesanan`, `jml_pesanan`, `tgl_pesanan`, `tgl_selesai`, `pemesan`) VALUES
(1, 'Sepatu', 4000, '2004-01-01', '2004-01-30', 'PT Karya'),
(2, 'Sendal', 3000, '2004-02-02', '2004-02-28', 'PT Abdi'),
(3, 'Tas', 500, '2004-03-03', '2004-03-30', 'PT Maju');

-- --------------------------------------------------------

--
-- Stand-in structure for view `kasus_a`
-- (See below for the actual view)
--
CREATE TABLE `kasus_a` (
`NO_PESANAN` int(5)
,`JENIS_PRODUK` varchar(20)
,`JML_PESANAN` bigint(10)
,`KELOMPOK_BIAYA` varchar(20)
,`JUMLAH_BIAYA` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kasus_b`
-- (See below for the actual view)
--
CREATE TABLE `kasus_b` (
`TAHUN` int(4)
,`BULAN` int(2)
,`KELOMPOK_BIAYA` varchar(20)
,`JUMLAH_BIAYA` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kasus_c`
-- (See below for the actual view)
--
CREATE TABLE `kasus_c` (
`NAMA_PESANAN` varchar(20)
,`kelompok` varchar(20)
,`JUMLAH_BIAYA` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kasus_d`
-- (See below for the actual view)
--
CREATE TABLE `kasus_d` (
`NOMOR_PESANAN` int(5)
,`JENIS_PRODUK` varchar(20)
,`JML_PESANAN` bigint(10)
,`BIAYA_LANGSUNG` decimal(65,0)
,`BIAYA_OVERHEAD` decimal(65,4)
,`TOTAL_BIAYA` decimal(65,4)
,`BIAYA_PER_UNIT` decimal(65,8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kasus_e`
-- (See below for the actual view)
--
CREATE TABLE `kasus_e` (
`SUBKELOMPOK` varchar(20)
,`JUMLAH_BIAYA` decimal(65,0)
,`JML_PESANAN` bigint(10)
,`RATA_RATA` decimal(65,4)
,`BIAYA_MAX` int(100)
,`BIAYA_MIN` int(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kasus_f`
-- (See below for the actual view)
--
CREATE TABLE `kasus_f` (
`NOMOR_PESANAN` int(5)
,`JENIS_PRODUK` varchar(20)
,`JUMLAH_PESANAN` bigint(10)
,`KELOMPOK_BIAYA` varchar(20)
,`JUMLAH_BIAYA` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kasus_g`
-- (See below for the actual view)
--
CREATE TABLE `kasus_g` (
`NOMOR_PESANAN` int(5)
,`JENIS_PRODUK` varchar(20)
,`JUMLAH_PESANAN` bigint(10)
,`KELOMPOK_BIAYA` varchar(20)
,`JUMLAH_BIAYA` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kasus_h`
-- (See below for the actual view)
--
CREATE TABLE `kasus_h` (
`KELOMPOK_BIAYA` varchar(20)
,`JENIS_PRODUK` varchar(20)
,`nomor_pesanan` int(5)
,`JUMLAH_BIAYA` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `rincianbiaya`
--

CREATE TABLE `rincianbiaya` (
  `nomor_pesanan` int(5) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `kelompok` varchar(20) DEFAULT NULL,
  `subkelompok` varchar(20) DEFAULT NULL,
  `jumlah` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rincianbiaya`
--

INSERT INTO `rincianbiaya` (`nomor_pesanan`, `tgl`, `kelompok`, `subkelompok`, `jumlah`) VALUES
(1, '2004-01-15', 'Material', 'Kulit', 10000000),
(1, '2004-01-15', 'Material', 'Kain', 5000000),
(1, '2004-01-15', 'Tenaga Kerja', 'Upah', 30000000),
(2, '2004-01-15', 'Material', 'Kulit', 20000000),
(2, '2004-02-15', 'Material', 'Kain', 10000000),
(2, '2004-02-15', 'Tenaga Kerja', 'Upah Buruh', 60000000),
(2, '2004-02-15', 'Tenaga Kerja', 'Upah Tenaga Ahli', 13000000),
(3, '2004-03-15', 'Material', 'Kulit', 15000000),
(3, '2004-03-15', 'Material', 'Kain', 14000000),
(3, '2004-03-15', 'Tenaga Kerja', 'Upah Buruh', 8000000);

-- --------------------------------------------------------

--
-- Structure for view `kasus_a`
--
DROP TABLE IF EXISTS `kasus_a`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kasus_a`  AS SELECT `kp`.`nomor_pesanan` AS `NO_PESANAN`, `kp`.`jenis_pesanan` AS `JENIS_PRODUK`, `kp`.`jml_pesanan` AS `JML_PESANAN`, `rb`.`kelompok` AS `KELOMPOK_BIAYA`, sum(`rb`.`jumlah`) AS `JUMLAH_BIAYA` FROM (`kartupesanan` `kp` join `rincianbiaya` `rb` on(`kp`.`nomor_pesanan` = `rb`.`nomor_pesanan`)) GROUP BY `kp`.`nomor_pesanan`, `kp`.`jenis_pesanan`, `kp`.`jml_pesanan`, `rb`.`kelompok` ORDER BY `kp`.`nomor_pesanan` ASC, `kp`.`jenis_pesanan` ASC, `kp`.`jml_pesanan` ASC, `rb`.`kelompok` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `kasus_b`
--
DROP TABLE IF EXISTS `kasus_b`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kasus_b`  AS SELECT year(`rb`.`tgl`) AS `TAHUN`, month(`rb`.`tgl`) AS `BULAN`, `rb`.`kelompok` AS `KELOMPOK_BIAYA`, sum(`rb`.`jumlah`) AS `JUMLAH_BIAYA` FROM (`kartupesanan` `kp` join `rincianbiaya` `rb` on(`kp`.`nomor_pesanan` = `rb`.`nomor_pesanan`)) GROUP BY year(`rb`.`tgl`), month(`rb`.`tgl`), `rb`.`kelompok` ORDER BY 1 ASC, 2 ASC, 3 ASC ;

-- --------------------------------------------------------

--
-- Structure for view `kasus_c`
--
DROP TABLE IF EXISTS `kasus_c`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kasus_c`  AS SELECT `kp`.`jenis_pesanan` AS `NAMA_PESANAN`, `rb`.`kelompok` AS `kelompok`, sum(`rb`.`jumlah`) AS `JUMLAH_BIAYA` FROM (`kartupesanan` `kp` join `rincianbiaya` `rb` on(`kp`.`nomor_pesanan` = `rb`.`nomor_pesanan`)) GROUP BY `kp`.`jenis_pesanan`, `rb`.`kelompok` ORDER BY 1 ASC, 2 ASC ;

-- --------------------------------------------------------

--
-- Structure for view `kasus_d`
--
DROP TABLE IF EXISTS `kasus_d`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kasus_d`  AS SELECT `kp`.`nomor_pesanan` AS `NOMOR_PESANAN`, `kp`.`jenis_pesanan` AS `JENIS_PRODUK`, `kp`.`jml_pesanan` AS `JML_PESANAN`, sum(`rb`.`jumlah`) AS `BIAYA_LANGSUNG`, sum(`rb`.`jumlah`) * 30 / 100 AS `BIAYA_OVERHEAD`, sum(`rb`.`jumlah`) * 130 / 100 AS `TOTAL_BIAYA`, sum(`rb`.`jumlah`) * 130 / 100 / `kp`.`jml_pesanan` AS `BIAYA_PER_UNIT` FROM (`kartupesanan` `kp` join `rincianbiaya` `rb` on(`kp`.`nomor_pesanan` = `rb`.`nomor_pesanan`)) GROUP BY `kp`.`nomor_pesanan`, `kp`.`jenis_pesanan`, `kp`.`jml_pesanan` ORDER BY `kp`.`nomor_pesanan` ASC, `kp`.`jenis_pesanan` ASC, `kp`.`jml_pesanan` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `kasus_e`
--
DROP TABLE IF EXISTS `kasus_e`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kasus_e`  AS SELECT `rb`.`subkelompok` AS `SUBKELOMPOK`, sum(`rb`.`jumlah`) AS `JUMLAH_BIAYA`, `kp`.`jml_pesanan` AS `JML_PESANAN`, avg(`rb`.`jumlah`) AS `RATA_RATA`, max(`rb`.`jumlah`) AS `BIAYA_MAX`, min(`rb`.`jumlah`) AS `BIAYA_MIN` FROM (`kartupesanan` `kp` join `rincianbiaya` `rb` on(`kp`.`nomor_pesanan` = `rb`.`nomor_pesanan`)) GROUP BY `rb`.`subkelompok` ORDER BY `rb`.`subkelompok` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `kasus_f`
--
DROP TABLE IF EXISTS `kasus_f`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kasus_f`  AS SELECT `kp`.`nomor_pesanan` AS `NOMOR_PESANAN`, `kp`.`jenis_pesanan` AS `JENIS_PRODUK`, `kp`.`jml_pesanan` AS `JUMLAH_PESANAN`, `rb`.`kelompok` AS `KELOMPOK_BIAYA`, sum(`rb`.`jumlah`) AS `JUMLAH_BIAYA` FROM (`kartupesanan` `kp` join `rincianbiaya` `rb` on(`kp`.`nomor_pesanan` = `rb`.`nomor_pesanan`)) WHERE `kp`.`jenis_pesanan` = 'Sepatu' GROUP BY `kp`.`nomor_pesanan`, `kp`.`jenis_pesanan`, `kp`.`jml_pesanan`, `rb`.`kelompok` ORDER BY `kp`.`nomor_pesanan` ASC, `kp`.`jenis_pesanan` ASC, `kp`.`jml_pesanan` ASC, `rb`.`kelompok` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `kasus_g`
--
DROP TABLE IF EXISTS `kasus_g`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kasus_g`  AS SELECT `kp`.`nomor_pesanan` AS `NOMOR_PESANAN`, `kp`.`jenis_pesanan` AS `JENIS_PRODUK`, `kp`.`jml_pesanan` AS `JUMLAH_PESANAN`, `rb`.`kelompok` AS `KELOMPOK_BIAYA`, sum(`rb`.`jumlah`) AS `JUMLAH_BIAYA` FROM (`kartupesanan` `kp` join `rincianbiaya` `rb` on(`kp`.`nomor_pesanan` = `rb`.`nomor_pesanan`)) GROUP BY `kp`.`nomor_pesanan`, `kp`.`jenis_pesanan`, `kp`.`jml_pesanan`, `rb`.`kelompok` HAVING sum(`rb`.`jumlah`) >= 20000000 ORDER BY `kp`.`nomor_pesanan` ASC, `kp`.`jenis_pesanan` ASC, `kp`.`jml_pesanan` ASC, `rb`.`kelompok` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `kasus_h`
--
DROP TABLE IF EXISTS `kasus_h`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kasus_h`  AS SELECT `rb`.`kelompok` AS `KELOMPOK_BIAYA`, `kp`.`jenis_pesanan` AS `JENIS_PRODUK`, `kp`.`nomor_pesanan` AS `nomor_pesanan`, sum(`rb`.`jumlah`) AS `JUMLAH_BIAYA` FROM (`kartupesanan` `kp` join `rincianbiaya` `rb` on(`kp`.`nomor_pesanan` = `rb`.`nomor_pesanan`)) GROUP BY `rb`.`kelompok`, `kp`.`jenis_pesanan`, `kp`.`nomor_pesanan` ORDER BY sum(`rb`.`jumlah`) DESC LIMIT 0, 3 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kartupesanan`
--
ALTER TABLE `kartupesanan`
  ADD PRIMARY KEY (`nomor_pesanan`);

--
-- Indexes for table `rincianbiaya`
--
ALTER TABLE `rincianbiaya`
  ADD KEY `nomor_pesanan` (`nomor_pesanan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rincianbiaya`
--
ALTER TABLE `rincianbiaya`
  ADD CONSTRAINT `rincianbiaya_ibfk_1` FOREIGN KEY (`nomor_pesanan`) REFERENCES `kartupesanan` (`nomor_pesanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
