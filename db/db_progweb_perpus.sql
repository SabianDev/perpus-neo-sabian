-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 08:22 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_progweb_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `bk_id` int(12) NOT NULL,
  `bk_nama` varchar(100) NOT NULL,
  `bk_pengarang` varchar(100) NOT NULL,
  `bk_penerbit` varchar(50) NOT NULL,
  `bk_thnterbit` varchar(4) NOT NULL,
  `bk_kategori` varchar(20) NOT NULL,
  `bk_halaman` varchar(10) NOT NULL,
  `bk_status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`bk_id`, `bk_nama`, `bk_pengarang`, `bk_penerbit`, `bk_thnterbit`, `bk_kategori`, `bk_halaman`, `bk_status`) VALUES
(15, 'Oppenheimer', 'Udin Sudrajat S.Pd', 'Gramedia', '2021', 'Fiksi', '200', 'Ada'),
(16, 'Hayu Diajar Basa Sunda', 'Rudy Tabuti Nugraha', 'Bale Budaya Jabar', '1980', 'Education', '99', 'Dipinjam'),
(18, 'Tutorial Membuat Cimol No Root', 'Dadang Karbu', 'Elex Media Komputindo', '2013', 'Lifestyle', '120', 'Ada');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku_kategori`
--

CREATE TABLE `tb_buku_kategori` (
  `ktg_id` int(11) NOT NULL,
  `ktg_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_buku_kategori`
--

INSERT INTO `tb_buku_kategori` (`ktg_id`, `ktg_nama`) VALUES
(1, 'Novel'),
(2, 'Biografi'),
(3, 'Jurnal/Skripsi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `log_id` int(11) NOT NULL,
  `log_username` varchar(12) NOT NULL,
  `log_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`log_id`, `log_username`, `log_password`) VALUES
(1, 'alzarin', '$2y$10$sKPz/U22d4KalXkpo5LhpOjCufaAoXhPP9LvmEt0IWn58uHo9l2k2'),
(3, 'admin', '$2y$10$BBxIbP2jnU.4MsA/sFQrCe1WF20owxNqdeDy0G2yIaUcYcVpf/0au');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `mbr_npm` varchar(15) NOT NULL,
  `mbr_nama` varchar(25) NOT NULL,
  `mbr_angkatan` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`mbr_npm`, `mbr_nama`, `mbr_angkatan`) VALUES
('21402066', 'Reyhan Sabian', '2021'),
('21402098', 'Yoel Horas .S', '2021'),
('21402111', 'Ridzwan Tapibohong', '2023'),
('21403001', 'Alina Taranova', '2021'),
('21403005', 'Rudi Tabuti', '2021'),
('21403006', 'Fauzan Awwali N.', '2025');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `pjm_id` varchar(15) NOT NULL,
  `mbr_npm` varchar(15) NOT NULL,
  `bk_id` varchar(20) NOT NULL,
  `pjm_tglpinjam` date NOT NULL,
  `pjm_bataskembali` date NOT NULL,
  `pjm_tglkembali` date NOT NULL,
  `pjm_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengunjung`
--

CREATE TABLE `tb_pengunjung` (
  `visitor_id` int(10) NOT NULL,
  `visitor_nama` varchar(100) NOT NULL,
  `visitor_kelas` varchar(20) NOT NULL,
  `visitor_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengunjung`
--

INSERT INTO `tb_pengunjung` (`visitor_id`, `visitor_nama`, `visitor_kelas`, `visitor_date`) VALUES
(1, 'Tiffany Fatimah Azzahra', 'MIK-R41/22', '2023-11-29'),
(2, 'Adnan Faturrazi', 'MBS-R42/22', '2023-12-04'),
(3, 'Alzarin Latif', 'SI-R41/10', '2023-12-05'),
(4, 'Arzy Ubaidilla', 'SI-R41/10', '2023-12-05'),
(5, 'Siti Nurbaya', 'RMIK-R41/22', '2023-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_placeholder`
--

CREATE TABLE `tb_placeholder` (
  `id` int(11) NOT NULL,
  `column1` varchar(11) NOT NULL,
  `column2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_placeholder`
--

INSERT INTO `tb_placeholder` (`id`, `column1`, `column2`) VALUES
(1001, 'Udin', 'Karbu'),
(1002, 'Sigit', 'Rendang'),
(1003, 'Farhan', 'Kebab'),
(1004, 'Reza', 'Kecap'),
(1005, 'Rudi', 'Tubles'),
(1006, 'Haryo', 'Speaker'),
(1007, 'Deden', 'Baskom'),
(1008, 'Asep', 'Icikiwir'),
(1009, 'Abim', 'Kalkulator'),
(1010, 'Rusdi', 'Pensil'),
(1011, 'Alex', 'Prosesor'),
(1012, 'Ujang', 'Rambo'),
(1013, 'Didit', 'Koyo'),
(1014, 'Iwan', 'Katel'),
(1015, 'David', 'Cakue'),
(1016, 'Randi', 'Kabel'),
(1017, 'Hamdan', 'Colokan'),
(1018, 'Gerald', 'Casan'),
(1019, 'Burhan', 'Pintu'),
(1020, 'Danu', 'Kulkas'),
(1021, 'Zaki', 'Indomie'),
(1022, 'Fiqih', 'Lemari'),
(1023, 'Andi', 'Karpet'),
(1024, 'Radit', 'Neon'),
(1025, 'Rizki', 'Jok'),
(1026, 'Endang', 'Cireng'),
(1027, 'Budi', 'Jengkol'),
(1028, 'Rahmat', 'AC Mobil'),
(1029, 'Rian', 'Batagor'),
(1030, 'Jajang', 'Kupat'),
(1031, 'Gio', 'Galon'),
(1032, 'Jordi', 'Sambel'),
(1033, 'Fandi', 'Pop Mie'),
(1034, 'Banu', 'Knalpot'),
(1035, 'Ihsan', 'Lele'),
(1036, 'Zaenal', 'Stroberi'),
(1037, 'Asep', 'Peteuy'),
(1038, 'Ikmal', 'Santan'),
(1039, 'Kamal', 'Flashdisk'),
(1040, 'Nasar', 'Durian'),
(1041, 'Raffi', 'Donat'),
(1042, 'Soleh', 'Sate'),
(1043, 'Hari', 'Motor'),
(1044, 'Fikri', 'Dasbor'),
(1045, 'Karyo', 'Tempe'),
(1046, 'Joko', 'Matic'),
(1047, 'Maulana', 'Bensin'),
(1048, 'Kevin', 'Lontong'),
(1049, 'Ucok', 'Hardisk'),
(1050, 'Imran', 'Redmi'),
(1051, 'Ghafir', 'Keset'),
(1052, 'Iman', 'Tembok');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`bk_id`);

--
-- Indexes for table `tb_buku_kategori`
--
ALTER TABLE `tb_buku_kategori`
  ADD PRIMARY KEY (`ktg_id`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`mbr_npm`);

--
-- Indexes for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`pjm_id`);

--
-- Indexes for table `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
  ADD PRIMARY KEY (`visitor_id`);

--
-- Indexes for table `tb_placeholder`
--
ALTER TABLE `tb_placeholder`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `bk_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_buku_kategori`
--
ALTER TABLE `tb_buku_kategori`
  MODIFY `ktg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
  MODIFY `visitor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
