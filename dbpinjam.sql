-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2026 at 01:19 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpinjam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `iduser` int(11) NOT NULL,
  `nmuser` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`iduser`, `nmuser`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', '202cb962ac59075b964b07152d234b70', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `noanggota` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenkel` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`noanggota`, `nama`, `jenkel`) VALUES
('AG00001', 'Fakhril', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kdbuku` varchar(10) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tmpterbit` varchar(100) DEFAULT NULL,
  `klasifikasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kdbuku`, `judul`, `pengarang`, `penerbit`, `tmpterbit`, `klasifikasi`) VALUES
('BK0001', 'Sumpah pocong', 'Mbak kunti', 'PT. Oh Seram', 'Bandung', 'Bagus banget'),
('BK0002', 'Beranak dalam kubur', 'ocong', 'Mbak gombel', 'Pt. Sesajen', 'Serem banget'),
('BK0003', 'Misteri konde emak', 'Mak lampir', 'PT. Gondoruo', 'CV. Mundur', 'Ga kuat liatnya');

-- --------------------------------------------------------

--
-- Table structure for table `copybuku`
--

CREATE TABLE `copybuku` (
  `kdcopybuku` varchar(10) NOT NULL,
  `cetakan` varchar(50) DEFAULT NULL,
  `tahunterbit` year(4) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kdbuku` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `copybuku`
--

INSERT INTO `copybuku` (`kdcopybuku`, `cetakan`, `tahunterbit`, `jumlah`, `kdbuku`) VALUES
('CP00001', '1', 2026, 2, 'BK0001'),
('CP00002', '4', 2026, 1, 'BK0001'),
('CP00003', '5', 2025, 1, 'BK0002');

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `nodenda` varchar(10) NOT NULL,
  `namadenda` varchar(100) NOT NULL,
  `besardenda` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`nodenda`, `namadenda`, `besardenda`) VALUES
('DN00001', 'Rudak parah', '20000.00');

-- --------------------------------------------------------

--
-- Table structure for table `detaidenda`
--

CREATE TABLE `detaidenda` (
  `nosanksi` varchar(10) NOT NULL,
  `nodenda` varchar(10) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `nopinjam` varchar(10) NOT NULL,
  `tglpinjam` date NOT NULL,
  `tglharuskembali` date NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `noanggota` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`nopinjam`, `tglpinjam`, `tglharuskembali`, `kelas`, `noanggota`) VALUES
('PJ000001', '2026-07-02', '2026-07-03', '6', 'AG00001');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `nokembali` varchar(10) NOT NULL,
  `tglkembali` date NOT NULL,
  `nopinjam` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `nopinjam` varchar(10) NOT NULL,
  `nocopybuku` varchar(10) NOT NULL,
  `jlhpinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`nopinjam`, `nocopybuku`, `jlhpinjam`) VALUES
('PJ000001', 'CP00001', 1),
('PJ000001', 'CP00003', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sanksidenda`
--

CREATE TABLE `sanksidenda` (
  `NoSanksi` varchar(10) NOT NULL,
  `TglSanksi` date NOT NULL,
  `NoKembali` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`noanggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kdbuku`);

--
-- Indexes for table `copybuku`
--
ALTER TABLE `copybuku`
  ADD PRIMARY KEY (`kdcopybuku`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`nodenda`);

--
-- Indexes for table `detaidenda`
--
ALTER TABLE `detaidenda`
  ADD PRIMARY KEY (`nosanksi`,`nodenda`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`nopinjam`),
  ADD UNIQUE KEY `noanggota` (`noanggota`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`nokembali`),
  ADD UNIQUE KEY `nopinjam` (`nopinjam`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`nopinjam`,`nocopybuku`);

--
-- Indexes for table `sanksidenda`
--
ALTER TABLE `sanksidenda`
  ADD PRIMARY KEY (`NoSanksi`),
  ADD KEY `fk_sanksi_kembali` (`NoKembali`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sanksidenda`
--
ALTER TABLE `sanksidenda`
  ADD CONSTRAINT `fk_sanksi_kembali` FOREIGN KEY (`NoKembali`) REFERENCES `pengembalian` (`nokembali`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
