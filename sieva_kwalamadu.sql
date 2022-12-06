-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2022 at 03:32 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sieva_kwalamadu`
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
  `c3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `centroid_temp`
--

INSERT INTO `centroid_temp` (`id`, `iterasi`, `c1`, `c2`, `c3`) VALUES
(1, 1, '1', '0', '0'),
(2, 1, '0', '1', '0'),
(3, 1, '1', '0', '0'),
(4, 1, '1', '0', '0'),
(5, 1, '1', '0', '0'),
(6, 1, '0', '1', '0'),
(7, 1, '1', '0', '0'),
(8, 1, '1', '0', '0'),
(9, 1, '1', '0', '0'),
(10, 1, '1', '0', '0'),
(11, 1, '0', '0', '1'),
(12, 1, '0', '1', '0'),
(13, 1, '1', '0', '0'),
(14, 1, '0', '0', '1'),
(15, 1, '0', '0', '1'),
(16, 1, '1', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `no_data` int(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`no_data`, `title`, `sub`) VALUES
(1, 'SISTEM INFORMASI EVALUASI (SIEVA) HASIL PANEN RAYA LAHAN TEBU PTPN II KWALA MADU', 'Kecamatan Stabat, Kabupaten Langkat'),
(2, 'Petunjuk Penggunaan', '<b>Admin</b><br>\r\n<ol>\r\n<li>Tambahkan terlebih dahulu Master Data untuk Data Kebun sebelum menambah Data Hasil Panen jika Data Kebun belum terdata</li>\r\n<li>Tambahkan Data Hasil Panen dengan menyesuaikan Nomor Petak pada Data Kebun</li>\r\n</ol>\r\n<br>\r\n<b>Pimpinan</b><br>\r\n<ol>\r\n<li>Untuk mencetak laporan dalam bentuk PDF, klik \"Cetak Data\" pada halaman Cetak Laporan Data</li>\r\n</ol>\r\n<br>\r\n<b>Analis</b><br>\r\n<ol>\r\n<li>Untuk melakukan Generate nilai Rata-rata dan Centroid, Proses Data Rata-rata terlebih dahulu kemudian Proses Data Akhir </li>\r\n<li>Untuk melakukan Iterasi K-Means, pada Data Awal lakukan proses iterasi selanjutnya sampai tahapan akhir agar mendapatkan hasil akhir iterasi</li>\r\n</ol>'),
(3, 'Tentang', 'PT Perkebunan Nusantara II Kwala Madu merupakan salah satu kebun PT Perkebunan Nusantara II yang berada di Distrik Semusim dan termasuk dalam unit usaha budidaya tebu. Selama ini hasil panen merupakan permasalahan dalam PT Perkebunan Nusantara II Kwala Madu. Terdapat beberapa faktor yang mempengaruhi produktivitas panen raya lahan tebu seperti kesuburan tanah, ketersediaan tenaga kerja, ketidaksesuaian antara varietas tebu dengan lokasi pertanian yang tersedia, sistem irigasi dan penerapan teknologi. </br>Maka dari permasalahan tersebut diperlukan suatu sistem evaluasi yang dapat memperbaiki hasil produktivitas panen raya lahan tebu. Kemudian untuk membuat sistem evaluasi tersebut berjalan dengan baik, mengatasi kecurangan dan memudahkan karyawan maka diperlukan digitilisasi dari sistem evaluasi tersebut menggunakan metode K-Means Clustering.'),
(4, 'Wewenang', '<b>Admin</b><br>\r\n<ul>\r\n<li>Manajemen data kebun yaitu menambah, mengubah, dan menghapus data</li>\r\n<li>Manajemen data hasil panen yaitu menambah, mengubah, dan menghapus data</li>\r\n</ul>\r\n<br>\r\n<b>Pimpinan</b><br>\r\n<ul>\r\n<li>Cetak laporan data kebun</li>\r\n<li>Cetak laporan data hasil panen</li>\r\n</ul>\r\n<br>\r\n<b>Analis</b><br>\r\n<ul>\r\n<li>Analisis data generate data rata rata dan centroid</li>\r\n<li>Analisis data Iterasi K-Means</li>\r\n</ul>');

-- --------------------------------------------------------

--
-- Table structure for table `data_hasilpanen`
--

CREATE TABLE `data_hasilpanen` (
  `no_hasilpanen` int(5) NOT NULL,
  `no_spta` varchar(28) NOT NULL,
  `nomor_petak` varchar(32) NOT NULL,
  `bruto` int(11) NOT NULL,
  `tara` int(11) NOT NULL,
  `netto` int(11) NOT NULL,
  `tgl_timbang` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_hasilpanen`
--

INSERT INTO `data_hasilpanen` (`no_hasilpanen`, `no_spta`, `nomor_petak`, `bruto`, `tara`, `netto`, `tgl_timbang`) VALUES
(1, 'BP06-01032022-0316', '21KB0105', 9190, 3290, 5900, '2022-03-01 11:21:00'),
(2, 'BP06-01032022-0319', '21KB0105', 8990, 3270, 5720, '2022-03-01 14:13:00'),
(3, 'BP06-01032022-0320', '21KB0105', 9040, 3250, 5790, '2022-03-01 16:34:00'),
(4, 'BP06-01032022-0328', '21KB0108', 8900, 3290, 5610, '2022-03-01 21:03:00'),
(5, 'BP06-02032022-0234', '21KB0041', 9080, 3290, 5790, '2022-03-02 09:52:00'),
(6, 'BP06-02032022-0489', '21KB0046', 8710, 3290, 5420, '2022-03-02 12:11:00'),
(7, 'BP06-02032022-0481', '21KB0046', 8750, 3270, 5480, '2022-03-02 15:20:00'),
(8, 'BP06-02032022-0484', '21KB0046', 8470, 3290, 5180, '2022-03-02 19:14:00'),
(9, 'BP06-03032022-0314', '21KB0106', 9540, 3280, 6260, '2022-03-03 10:09:00'),
(10, 'BP06-03032022-0329', '21KB0106', 8850, 3240, 5610, '2022-03-03 14:36:00'),
(11, 'BP06-03032022-0332', '21KB0106', 8930, 3230, 5700, '2022-03-03 16:55:00'),
(12, 'BP06-03032022-0306', '21KB0053', 8420, 3230, 5190, '2022-03-03 19:04:00'),
(13, 'BP06-03032022-0305', '21KB0053', 8540, 3220, 5320, '2022-03-03 21:31:00'),
(14, 'BP06-04032022-0275', '21KB0043', 8650, 3240, 5410, '2022-03-04 08:28:00'),
(15, 'BP06-04032022-0272', '21KB162B', 8960, 3220, 5740, '2022-03-04 10:32:00'),
(16, 'BP06-04032022-0264', '21KB162B', 9010, 3210, 5800, '2022-03-04 12:46:00'),
(17, 'BP06-04032022-0534', '21KB0052', 9030, 3210, 5820, '2022-03-04 15:02:00'),
(18, 'BP06-04032022-0537', '21KB0052', 9100, 3260, 5840, '2022-03-04 17:42:00'),
(19, 'BP06-04032022-0556', '21KB0106', 8470, 3280, 5190, '2022-03-04 20:59:00'),
(20, 'BP06-05032022-0300', '21KB0053', 8790, 3270, 5520, '2022-03-05 10:30:00'),
(21, 'BP06-05032022-0317', '21KB0047', 9210, 3260, 5950, '2022-03-05 12:38:00'),
(22, 'BP06-05032022-0314', '21KB0059', 10000, 3310, 6690, '2022-03-05 15:56:00'),
(23, 'BP06-06032022-0436', '21KB0046', 9570, 3230, 6340, '2022-03-06 08:40:00'),
(24, 'BP06-06032022-0439', '21KB162B', 9110, 3200, 5910, '2022-03-06 10:51:00'),
(25, 'BP06-06032022-0539', '21KB0179', 9080, 3190, 5890, '2022-03-06 12:55:00'),
(26, 'BP06-06032022-0538', '21KB0179', 8920, 3250, 5670, '2022-03-06 15:11:00'),
(27, 'BP06-06032022-0530', '21KB0175', 8700, 3190, 5510, '2022-03-06 17:21:00'),
(28, 'BP06-06032022-0522', '21KB0175', 7810, 3200, 4610, '2022-03-06 19:27:00'),
(29, 'BP06-06032022-0518', '21KB0182', 7780, 3180, 4600, '2022-03-06 22:04:00'),
(30, 'BP06-07032022-0357', '21KB0059', 9230, 3230, 6000, '2022-03-07 10:28:00'),
(31, 'BP06-01032022-6969', '21KB0169', 1500, 500, 1000, '2022-12-03 17:24:00'),
(32, 'BP06-01032022-1999', '21KB0199', 2500, 500, 2000, '2022-12-03 17:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `data_kebun`
--

CREATE TABLE `data_kebun` (
  `no` int(5) NOT NULL,
  `nomor_petak` varchar(32) NOT NULL,
  `nama_kebun` varchar(127) NOT NULL,
  `blok` varchar(3) NOT NULL,
  `luas` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kebun`
--

INSERT INTO `data_kebun` (`no`, `nomor_petak`, `nama_kebun`, `blok`, `luas`) VALUES
(1, '21KB0105', 'Ryn KWM, DP02,MT 3B,TT R2, BLOK 105', 'R2', 0.1),
(2, '21KB0108', 'Ryn KWM, DP02,MT 3B,TT R2, BLOK 108', 'R2', 0.1),
(3, '21KB0041', 'Ryn KWM, DP02,MT 3A,TT R2, BLOK 41', 'R2', 0.1),
(4, '21KB0046', 'Ryn KWM, DP02,MT 3A,TT R2, BLOK 46', 'R2', 0.1),
(5, '21KB0106', 'Ryn KWM, DP02,MT 3B,TT R2, BLOK 106', 'R2', 0.1),
(6, '21KB0053', 'Ryn KWM, DP02,MT 3B,TT R2, BLOK 53', 'R2', 0.1),
(7, '21KB0043', 'Ryn KWM, DP02,MT 3A,TT R2, BLOK 43', 'R2', 0.06),
(8, '21KB162B', 'Ryn KWM, DP02,MT 3A,TT R1, BLOK 162B', 'R1', 0.1),
(9, '21KB0052', 'Ryn KWM, DP02,MT 3B,TT R2, BLOK 52', 'R2', 0.1),
(10, '21KB0053', 'Ryn KWM, DP02,MT 3B,TT R2, BLOK 53', 'R2', 0.1),
(11, '21KB0047', 'Ryn KWM, DP02,MT 4B,TT R2, BLOK 47', 'R2', 0.1),
(12, '21KB0059', 'Ryn KWM, DP02,MT 3B,TT R2, BLOK 59', 'R2', 0.07),
(13, '21KB0179', 'Ryn KWM, DP02,MT 2A,TT R1, BLOK 179', 'R1', 0.1),
(14, '21KB0175', 'Ryn KWM, DP02,MT 2A,TT R1, BLOK 175', 'R1', 0.1),
(15, '21KB0182', 'Ryn KWM, DP02,MT 2A,TT R1, BLOK 182', 'R1', 0.07),
(16, '21KB0104', 'Ryn KWM, DP02,MT 3B,TT R2, BLOK 104', 'R2', 0.1),
(17, '21KB0169', 'Ryn KWM, DP02,MT 3B,TT R2, BLOK 169', 'R2', 0.1),
(18, '21KB0199', 'Ryn KWM, DP02,MT 3B,TT R2, BLOK 199', 'R2', 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(5) NOT NULL,
  `nomor_petak` varchar(38) NOT NULL,
  `predikat` varchar(30) NOT NULL,
  `d1` int(11) NOT NULL,
  `d2` int(11) NOT NULL,
  `d3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `nomor_petak`, `predikat`, `d1`, `d2`, `d3`) VALUES
(1, '21KB0041', 'Baik', 10, 590, 1190),
(2, '21KB0043', 'Cukup', 390, 210, 810),
(3, '21KB0046', 'Baik', 195, 405, 1005),
(4, '21KB0046', 'Baik', 195, 405, 1005),
(5, '21KB0046', 'Baik', 195, 405, 1005),
(6, '21KB0046', 'Baik', 195, 405, 1005),
(7, '21KB0047', 'Baik', 150, 750, 1350),
(8, '21KB0052', 'Baik', 30, 630, 1230),
(9, '21KB0052', 'Baik', 30, 630, 1230),
(10, '21KB0053', 'Cukup', 457, 143, 743),
(11, '21KB0053', 'Cukup', 457, 143, 743),
(12, '21KB0053', 'Cukup', 457, 143, 743),
(13, '21KB0059', 'Baik', 545, 1145, 1745),
(14, '21KB0059', 'Baik', 545, 1145, 1745),
(15, '21KB0105', 'Baik', 3, 603, 1203),
(16, '21KB0105', 'Baik', 3, 603, 1203),
(17, '21KB0105', 'Baik', 3, 603, 1203),
(18, '21KB0106', 'Baik', 110, 490, 1090),
(19, '21KB0106', 'Baik', 110, 490, 1090),
(20, '21KB0106', 'Baik', 110, 490, 1090),
(21, '21KB0106', 'Baik', 110, 490, 1090),
(22, '21KB0108', 'Baik', 190, 410, 1010),
(23, '21KB0169', 'Kurang', 4800, 4200, 3600),
(24, '21KB0175', 'Cukup', 740, 140, 460),
(25, '21KB0175', 'Cukup', 740, 140, 460),
(26, '21KB0179', 'Baik', 20, 580, 1180),
(27, '21KB0179', 'Baik', 20, 580, 1180),
(28, '21KB0182', 'Kurang', 1200, 600, 0),
(29, '21KB0199', 'Kurang', 3800, 3200, 2600),
(30, '21KB162B', 'Baik', 17, 617, 1217),
(31, '21KB162B', 'Baik', 17, 617, 1217),
(32, '21KB162B', 'Baik', 17, 617, 1217);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_centroid`
--

CREATE TABLE `hasil_centroid` (
  `nomor` int(2) NOT NULL,
  `c1a` varchar(50) NOT NULL,
  `c1b` varchar(50) NOT NULL,
  `c1c` varchar(50) NOT NULL,
  `c2a` varchar(50) NOT NULL,
  `c2b` varchar(50) NOT NULL,
  `c2c` varchar(50) NOT NULL,
  `c3a` varchar(50) NOT NULL,
  `c3b` varchar(50) NOT NULL,
  `c3c` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_centroid`
--

INSERT INTO `hasil_centroid` (`nomor`, `c1a`, `c1b`, `c1c`, `c2a`, `c2b`, `c2c`, `c3a`, `c3b`, `c3c`) VALUES
(1, '0.097', '5822', '2.3', '0.086666666666667', '5271.1111', '3', '0.09', '2533.3333333333', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rata_rata`
--

CREATE TABLE `rata_rata` (
  `id` int(5) NOT NULL,
  `nomor_petak` varchar(32) NOT NULL,
  `rata_rata` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rata_rata`
--

INSERT INTO `rata_rata` (`id`, `nomor_petak`, `rata_rata`) VALUES
(1, '21KB0041', 5790),
(2, '21KB0043', 5410),
(3, '21KB0046', 5605),
(4, '21KB0047', 5950),
(5, '21KB0052', 5830),
(6, '21KB0053', 5343),
(7, '21KB0059', 6345),
(8, '21KB0105', 5803),
(9, '21KB0106', 5690),
(10, '21KB0108', 5610),
(11, '21KB0169', 1000),
(12, '21KB0175', 5060),
(13, '21KB0179', 5780),
(14, '21KB0182', 4600),
(15, '21KB0199', 2000),
(16, '21KB162B', 5817);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `nama`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'Zarwin Admin'),
(2, 'pimpinan', '59335c9f58c78597ff73f6706c6c8fa278e08b3a', 2, 'Muhammad Zarwin'),
(3, 'analis', '4f5dc9ce48e697aa6f0c2cccb76ec926c9b33796', 3, 'Zarwin Analis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centroid_temp`
--
ALTER TABLE `centroid_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`no_data`);

--
-- Indexes for table `data_hasilpanen`
--
ALTER TABLE `data_hasilpanen`
  ADD PRIMARY KEY (`no_hasilpanen`);

--
-- Indexes for table `data_kebun`
--
ALTER TABLE `data_kebun`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_centroid`
--
ALTER TABLE `hasil_centroid`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `rata_rata`
--
ALTER TABLE `rata_rata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centroid_temp`
--
ALTER TABLE `centroid_temp`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `no_data` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_hasilpanen`
--
ALTER TABLE `data_hasilpanen`
  MODIFY `no_hasilpanen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `data_kebun`
--
ALTER TABLE `data_kebun`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `hasil_centroid`
--
ALTER TABLE `hasil_centroid`
  MODIFY `nomor` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rata_rata`
--
ALTER TABLE `rata_rata`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
