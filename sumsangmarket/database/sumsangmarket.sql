-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 10:53 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sumsangmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `namakategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`) VALUES
(10, ' Samsung'),
(11, ' Iphone');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idpembayaran` int(11) NOT NULL,
  `idpembelian` int(11) NOT NULL,
  `nama` text NOT NULL,
  `tanggaltransfer` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `bukti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`idpembayaran`, `idpembelian`, `nama`, `tanggaltransfer`, `tanggal`, `bukti`) VALUES
(8, 41, 'Sugeng', '2024-01-10', '2024-01-10 00:00:00', '20240110164629no-img.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaranrekening`
--

CREATE TABLE `pembayaranrekening` (
  `idpembayaranrekening` int(11) NOT NULL,
  `namapembayaran` text NOT NULL,
  `norek` text NOT NULL,
  `atasnama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaranrekening`
--

INSERT INTO `pembayaranrekening` (`idpembayaranrekening`, `namapembayaran`, `norek`, `atasnama`) VALUES
(1, 'Transfer Bank BCA', '  111000111100', '  Sumsang Market'),
(2, 'Transfer Bank Mandiri', '111000111199', 'Sumsang Market');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `idpembelian` int(11) NOT NULL,
  `notransaksi` text NOT NULL,
  `id` int(11) NOT NULL,
  `tanggalbeli` date NOT NULL,
  `totalbeli` text NOT NULL DEFAULT '\'belum bayar\'',
  `alamatpengiriman` text NOT NULL,
  `totalberat` varchar(255) NOT NULL,
  `kota` text NOT NULL,
  `ongkir` text NOT NULL,
  `statusbeli` text NOT NULL,
  `resipengiriman` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`idpembelian`, `notransaksi`, `id`, `tanggalbeli`, `totalbeli`, `alamatpengiriman`, `totalberat`, `kota`, `ongkir`, `statusbeli`, `resipengiriman`, `waktu`) VALUES
(41, '#INV-20240110044610', 13, '2024-01-10', '2600000', 'Jl. Palembang', '', 'Palembang', '7000', 'Selesai', '12112', '2024-01-10 16:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `pembelianproduk`
--

CREATE TABLE `pembelianproduk` (
  `idpembeliandetail` int(11) NOT NULL,
  `idpembelian` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `nama` text NOT NULL,
  `harga` text NOT NULL,
  `berat` text NOT NULL,
  `subberat` text NOT NULL,
  `subharga` text NOT NULL,
  `jumlah` text NOT NULL,
  `statusulasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelianproduk`
--

INSERT INTO `pembelianproduk` (`idpembeliandetail`, `idpembelian`, `idproduk`, `nama`, `harga`, `berat`, `subberat`, `subharga`, `jumlah`, `statusulasan`) VALUES
(50, 41, 4, 'Samsung A24', '2600000', '', '', '2600000', '1', 'Sudah');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `fotoprofil` varchar(255) NOT NULL,
  `level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `telepon`, `alamat`, `fotoprofil`, `level`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin', '0812345678', 'Palembang', 'Untitled.png', 'Admin'),
(13, 'Sugeng', 'sugeng@gmail.com', 'sugeng', '08952815929', 'Jl. Palembang', 'Untitled.png', 'Pelanggan'),
(14, 'pemilik', 'pemilik@gmail.com', 'pemilik', '0823121931', 'Jl Sudirman', '', 'Pemilik');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namaproduk` text NOT NULL,
  `hargaproduk` text NOT NULL,
  `beratproduk` text NOT NULL,
  `stokproduk` text NOT NULL,
  `fotoproduk` text NOT NULL,
  `deskripsiproduk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `hargaproduk`, `beratproduk`, `stokproduk`, `fotoproduk`, `deskripsiproduk`) VALUES
(3, 10, 'Samsung A05', '1300000', '1', '40', '60487223b92c2e807d8b4567_1701314958.webp', '<p>Performa Galaxy A05 ditenagai Mediatek Helio G85 yang dipadukan tiga opsi konfigurasi memori, yaitu RAM 4/64 GB, 4/128 GB dan RAM 6 GB/128 GB.</p>\r\n\r\n<p>Penyimpanan internalnya dapat diperluas hingga 1 TB menggunakan kartu microSD. Di sektor sumber daya, Galaxy A05 menggunakan baterai berkapasitas 5.000 mAh dengan pengisian daya Super-Fast Charging 25W.</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(4, 10, 'Samsung A24', '2600000', '1', '30', '61655a89b42c2e538716449d_1685680006.webp', '<p>Performa Samsung Galaxy A24 ditenagai prosesor Helio G99 yang ditopang memori RAM 8 GB yang bisa diperluas dengan RAM Plus hingga 8 GB. Untuk penyimpanan tersedia memori internal sebesar 128 GB yang bisa diperluas hingga 1 TB.&nbsp;</p>\r\n\r\n<p>Sumber daya Samsung Galaxy A24 berasal dari baterai 5.000 mAh yang di dukung fitur 25W fast charging. Fitur lainnya ada akses biometrik fingerprint serta NFC untuk melakukan pembayaran digital tanpa tunai.</p>\r\n'),
(22, 10, 'Samsung A34 5G', '4000000', '1', '10', '61655a89b42c2e538716449d_1680330227.webp', '<p>Galaxy A34 5G dibekali tiga kamera belakang dengan konfigurasi kamera utama 48 MP, 8 MP ultra-wide, dan 2 MP makro. Kamera ini pun memiliki fitur optical image stabilization (OIS) dan video digital image stabilization (VDIS) yang sudah ditingkatkan.</p>\r\n\r\n<p>Performanya ditenagai prosesor MediaTek Dimensity 1080 yang di sokong memori RAM 8 GB yang bisa diperkuas hingga 8 GB dengan fitur RAM Plus (total RAM 16 GB). Untuk memori internalnya ada dua opsi yaitu 128 GB dan 256 GB.</p>\r\n'),
(23, 11, 'Iphone 11', '3000000', '1', '10', 'apple_iphone_11_black_new_1_7_3.jpg', '<p>Apple iPhone 11 merupakan HP dengan layar 6.1&quot; dan tingkat densitas piksel sebesar 326ppi. Ia dilengkapi dengan kamera belakang 12 + 12MP dan kamera depan 12MP. HP ini juga hadir dengan kapasitas baterai 3110mAh. Apple iPhone 11 dirilis pada: 2019.</p>\r\n'),
(24, 11, 'Iphone XR', '2500000', '1', '10', 'w9LqkiL5luZpEgKMuGvoRgcuDLT1evTdklTm94DB.jpeg', '<p>Apple iPhone XR merupakan HP dengan layar 6.1&quot; dan tingkat densitas piksel sebesar 326ppi. Ia dilengkapi dengan kamera belakang 12MP dan kamera depan 7MP. HP ini juga hadir dengan kapasitas baterai 2942mAh. Apple iPhone XR dirilis pada: 2018.</p>\r\n'),
(25, 11, 'Iphone 12', '5000000', '1', '10', 'iphone_12_green_1.jpg', '<p>Apple iPhone 12 merupakan HP dengan layar 6.1&quot; dan tingkat densitas piksel sebesar 476ppi. Ia dilengkapi dengan kamera belakang 12 + 12MP dan kamera depan 12MP. HP ini juga hadir dengan kapasitas baterai 2815mAh. Apple iPhone 12 dirilis pada: 2020.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `idulasan` int(11) NOT NULL,
  `idpembelian` int(11) NOT NULL,
  `idproduk` text NOT NULL,
  `idpengguna` text NOT NULL,
  `bintang` text NOT NULL,
  `ulasan` text NOT NULL,
  `tampilannama` text NOT NULL,
  `foto` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`idulasan`, `idpembelian`, `idproduk`, `idpengguna`, `bintang`, `ulasan`, `tampilannama`, `foto`, `waktu`) VALUES
(4, 41, '4', '13', '5', 'gg', 'Tampilkan Nama', 'no-img.png', '2024-01-10 16:47:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idpembayaran`),
  ADD KEY `idbeli` (`idpembelian`);

--
-- Indexes for table `pembayaranrekening`
--
ALTER TABLE `pembayaranrekening`
  ADD PRIMARY KEY (`idpembayaranrekening`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`idpembelian`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `pembelianproduk`
--
ALTER TABLE `pembelianproduk`
  ADD PRIMARY KEY (`idpembeliandetail`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `id_kategori` (`idkategori`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`idulasan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `idpembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaranrekening`
--
ALTER TABLE `pembayaranrekening`
  MODIFY `idpembayaranrekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `idpembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pembelianproduk`
--
ALTER TABLE `pembelianproduk`
  MODIFY `idpembeliandetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `idulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`idpembelian`) REFERENCES `pembelian` (`idpembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
