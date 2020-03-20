-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26 Jul 2019 pada 04.32
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taiger`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `ID_BAR` char(5) NOT NULL,
  `NAMA_BAR` varchar(20) NOT NULL,
  `FOTO_BAR` char(12) NOT NULL,
  `HARGA_BAR` int(11) NOT NULL,
  `STATUS` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`ID_BAR`, `NAMA_BAR`, `FOTO_BAR`, `HARGA_BAR`, `STATUS`) VALUES
('BR001', 'Batik tulis', 'noimgpro.png', 120000, 1),
('BR002', 'Batik anyam', '52723006.png', 150000, 1);

--
-- Trigger `barang`
--
DELIMITER $$
CREATE TRIGGER `idbar` BEFORE INSERT ON `barang` FOR EACH ROW begin
	declare jumlah integer;
	declare urut integer;
    select count(*) into jumlah from `barang`;
	set urut := jumlah +1;
    set NEW.`ID_BAR` := concat('BR',LPAD(urut,3,'0'));
    INSERT INTO `history_harga` (`ID_HARGA`, `ID_BAR`, `HARGA`, `TANGGAL`) VALUES ('', NEW.`ID_BAR`, NEW.HARGA_BAR, CURRENT_TIMESTAMP);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `ID_CUS` char(6) NOT NULL,
  `ID_KOTA` char(5) NOT NULL,
  `USER_CUS` varchar(15) NOT NULL,
  `PASS_CUS` varchar(32) NOT NULL,
  `EMAIL_CUS` varchar(30) NOT NULL,
  `NAMA_CUS` varchar(30) NOT NULL,
  `ALAMAT_CUS` varchar(50) NOT NULL,
  `TELEPON_CUS` varchar(13) NOT NULL,
  `KODEPOS_CUS` char(5) NOT NULL,
  `FOTO_CUS` char(12) DEFAULT NULL,
  `STATUS_CUS` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`ID_CUS`, `ID_KOTA`, `USER_CUS`, `PASS_CUS`, `EMAIL_CUS`, `NAMA_CUS`, `ALAMAT_CUS`, `TELEPON_CUS`, `KODEPOS_CUS`, `FOTO_CUS`, `STATUS_CUS`) VALUES
('C00001', '409', 'autocreate', 'autocreate', 'autocreate', 'pelanggan langsung', 'Jl. Simowau baru gang semanggi no 15', '085943358461', '65125', NULL, '0'),
('C00002', '344', 'fiereseshi', '8fae959b94a7e52deea92dc9c420d042', 'adit.cmt3@gmail.com', 'MR RYAN ACUNA', 'Jl. Simowau baru gg semanggi no 15', '07943546580', '12345', NULL, '1');

--
-- Trigger `customer`
--
DELIMITER $$
CREATE TRIGGER `idcus` BEFORE INSERT ON `customer` FOR EACH ROW begin
	declare jumlah integer;
	declare urut integer;
    select count(*) into jumlah from `customer`;
	set urut := jumlah +1;
    set NEW.`ID_CUS` := concat('C',LPAD(urut,5,'0'));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_barang`
--

CREATE TABLE `detail_barang` (
  `ID_WAR` char(5) NOT NULL,
  `ID_UK` char(5) NOT NULL,
  `ID_BAR` char(5) NOT NULL,
  `STOCK_BAR` int(5) NOT NULL,
  `STATUS_BAR` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_barang`
--

INSERT INTO `detail_barang` (`ID_WAR`, `ID_UK`, `ID_BAR`, `STOCK_BAR`, `STATUS_BAR`) VALUES
('WAR01', 'UK001', 'BR001', 100, '1'),
('WAR01', 'UK002', 'BR001', 100, '1'),
('WAR02', 'UK001', 'BR001', 100, '1'),
('WAR02', 'UK002', 'BR002', 100, '1');

--
-- Trigger `detail_barang`
--
DELIMITER $$
CREATE TRIGGER `insstok` BEFORE INSERT ON `detail_barang` FOR EACH ROW BEGIN
INSERT INTO `history_stok` (`ID_STOK`, `ID_WAR`, `ID_UK`, `ID_BAR`, `STOK`, `TANGGAL`) VALUES ('', NEW.ID_wAR, NEW.ID_UK, NEW.ID_BAR,  NEW.STOCK_BAR, CURRENT_TIMESTAMP);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `instok2` BEFORE UPDATE ON `detail_barang` FOR EACH ROW BEGIN
INSERT INTO `history_stok` (`ID_STOK`, `ID_WAR`, `ID_UK`, `ID_BAR`, `STOK`, `TANGGAL`) VALUES ('', NEW.ID_wAR, NEW.ID_UK, NEW.ID_BAR, NEW.STOCK_BAR, CURRENT_TIMESTAMP);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `NO_INVOICE` char(12) NOT NULL,
  `ID_WAR` char(5) NOT NULL,
  `ID_UK` char(5) NOT NULL,
  `ID_BAR` char(5) NOT NULL,
  `JUMLAH` decimal(3,0) NOT NULL,
  `SUBTOTAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `detail_pemesanan`
--
DELIMITER $$
CREATE TRIGGER `inputstok` BEFORE INSERT ON `detail_pemesanan` FOR EACH ROW BEGIN
	DECLARE jmlh integer;
    DECLARE minstok integer;
    SELECT STOCK_BAR into jmlh FROM detail_barang WHERE ID_WAR = NEW.ID_wAR AND ID_BAR = NEW.ID_BAR AND ID_UK = NEW.ID_UK;
    SET	minstok := jmlh-NEW.JUMLAH;
    UPDATE detail_barang set STOCK_BAR = minstok WHERE ID_WAR = NEW.ID_wAR AND ID_BAR = NEW.ID_BAR AND ID_UK = NEW.ID_UK;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_harga`
--

CREATE TABLE `history_harga` (
  `ID_HARGA` varchar(10) NOT NULL,
  `ID_BAR` varchar(10) NOT NULL,
  `HARGA` int(11) NOT NULL,
  `TANGGAL` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `history_harga`
--
DELIMITER $$
CREATE TRIGGER `idharga` BEFORE INSERT ON `history_harga` FOR EACH ROW begin
	declare jumlah integer;
	declare urut integer;
    declare cekid integer;
    select count(*) into jumlah from `history_harga`;
	set urut := jumlah +1;
    set NEW.`ID_HARGA` := concat('H',LPAD(urut,4,'0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_stok`
--

CREATE TABLE `history_stok` (
  `ID_STOK` varchar(10) NOT NULL,
  `ID_WAR` varchar(10) NOT NULL,
  `ID_UK` varchar(10) NOT NULL,
  `ID_BAR` varchar(10) NOT NULL,
  `STOK` int(11) NOT NULL,
  `TANGGAL` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history_stok`
--

INSERT INTO `history_stok` (`ID_STOK`, `ID_WAR`, `ID_UK`, `ID_BAR`, `STOK`, `TANGGAL`) VALUES
('S0001', 'WAR01', 'UK001', 'BR001', 100, '2019-07-26 02:29:54');

--
-- Trigger `history_stok`
--
DELIMITER $$
CREATE TRIGGER `idstok` BEFORE INSERT ON `history_stok` FOR EACH ROW begin
	declare jumlah integer;
	declare urut integer;
    select count(*) into jumlah from `history_stok`;
	set urut := jumlah +1;
    set NEW.`ID_STOK` := concat('S',LPAD(urut,4,'0'));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pengiriman`
--

CREATE TABLE `jenis_pengiriman` (
  `ID_JEN` char(3) NOT NULL,
  `NAMA_JEN` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_pengiriman`
--

INSERT INTO `jenis_pengiriman` (`ID_JEN`, `NAMA_JEN`) VALUES
('J01', 'TIKI'),
('J02', 'POS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `ID_KOTA` char(5) NOT NULL,
  `ID_PROV` char(3) NOT NULL,
  `NAMA_KOTA` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`ID_KOTA`, `ID_PROV`, `NAMA_KOTA`) VALUES
('1', '21', 'Kab. Aceh Barat'),
('10', '21', 'Kab. Aceh Timur'),
('100', '19', 'Kab. Buru Selatan'),
('101', '30', 'Kab. Buton'),
('102', '30', 'Kab. Buton Utara'),
('103', '9', 'Kab. Ciamis'),
('104', '9', 'Kab. Cianjur'),
('105', '10', 'Kab. Cilacap'),
('106', '3', 'Kota Cilegon'),
('107', '9', 'Kota Cimahi'),
('108', '9', 'Kab. Cirebon'),
('109', '9', 'Kota Cirebon'),
('11', '21', 'Kab. Aceh Utara'),
('110', '34', 'Kab. Dairi'),
('111', '24', 'Kab. Deiyai (Deliyai)'),
('112', '34', 'Kab. Deli Serdang'),
('113', '10', 'Kab. Demak'),
('114', '1', 'Kota Denpasar'),
('115', '9', 'Kota Depok'),
('116', '32', 'Kab. Dharmasraya'),
('117', '24', 'Kab. Dogiyai'),
('118', '22', 'Kab. Dompu'),
('119', '29', 'Kab. Donggala'),
('12', '32', 'Kab. Agam'),
('120', '26', 'Kota Dumai'),
('121', '33', 'Kab. Empat Lawang'),
('122', '23', 'Kab. Ende'),
('123', '28', 'Kab. Enrekang'),
('124', '25', 'Kab. Fakfak'),
('125', '23', 'Kab. Flores Timur'),
('126', '9', 'Kab. Garut'),
('127', '21', 'Kab. Gayo Lues'),
('128', '1', 'Kab. Gianyar'),
('129', '7', 'Kab. Gorontalo'),
('13', '23', 'Kab. Alor'),
('130', '7', 'Kota Gorontalo'),
('131', '7', 'Kab. Gorontalo Utara'),
('132', '28', 'Kab. Gowa'),
('133', '11', 'Kab. Gresik'),
('134', '10', 'Kab. Grobogan'),
('135', '5', 'Kab. Gunung Kidul'),
('136', '14', 'Kab. Gunung Mas'),
('137', '34', 'Kota Gunungsitoli'),
('138', '20', 'Kab. Halmahera Barat'),
('139', '20', 'Kab. Halmahera Selatan'),
('14', '19', 'Kota Ambon'),
('140', '20', 'Kab. Halmahera Tengah'),
('141', '20', 'Kab. Halmahera Timur'),
('142', '20', 'Kab. Halmahera Utara'),
('143', '13', 'Kab. Hulu Sungai Selatan'),
('144', '13', 'Kab. Hulu Sungai Tengah'),
('145', '13', 'Kab. Hulu Sungai Utara'),
('146', '34', 'Kab. Humbang Hasundutan'),
('147', '26', 'Kab. Indragiri Hilir'),
('148', '26', 'Kab. Indragiri Hulu'),
('149', '9', 'Kab. Indramayu'),
('15', '34', 'Kab. Asahan'),
('150', '24', 'Kab. Intan Jaya'),
('151', '6', 'Kota Jakarta Barat'),
('152', '6', 'Kota Jakarta Pusat'),
('153', '6', 'Kota Jakarta Selatan'),
('154', '6', 'Kota Jakarta Timur'),
('155', '6', 'Kota Jakarta Utara'),
('156', '8', 'Kota Jambi'),
('157', '24', 'Kab. Jayapura'),
('158', '24', 'Kota Jayapura'),
('159', '24', 'Kab. Jayawijaya'),
('16', '24', 'Kab. Asmat'),
('160', '11', 'Kab. Jember'),
('161', '1', 'Kab. Jembrana'),
('162', '28', 'Kab. Jeneponto'),
('163', '10', 'Kab. Jepara'),
('164', '11', 'Kab. Jombang'),
('165', '25', 'Kab. Kaimana'),
('166', '26', 'Kab. Kampar'),
('167', '14', 'Kab. Kapuas'),
('168', '12', 'Kab. Kapuas Hulu'),
('169', '10', 'Kab. Karanganyar'),
('17', '1', 'Kab. Badung'),
('170', '1', 'Kab. Karangasem'),
('171', '9', 'Kab. Karawang'),
('172', '17', 'Kab. Karimun'),
('173', '34', 'Kab. Karo'),
('174', '14', 'Kab. Katingan'),
('175', '4', 'Kab. Kaur'),
('176', '12', 'Kab. Kayong Utara'),
('177', '10', 'Kab. Kebumen'),
('178', '11', 'Kab. Kediri'),
('179', '11', 'Kota Kediri'),
('18', '13', 'Kab. Balangan'),
('180', '24', 'Kab. Keerom'),
('181', '10', 'Kab. Kendal'),
('182', '30', 'Kota Kendari'),
('183', '4', 'Kab. Kepahiang'),
('184', '17', 'Kab. Kepulauan Anambas'),
('185', '19', 'Kab. Kepulauan Aru'),
('186', '32', 'Kab. Kepulauan Mentawai'),
('187', '26', 'Kab. Kepulauan Meranti'),
('188', '31', 'Kab. Kepulauan Sangihe'),
('189', '6', 'Kab. Kepulauan Seribu'),
('19', '15', 'Kota Balikpapan'),
('190', '31', 'Kab. Kepulauan Siau Tagulandan'),
('191', '20', 'Kab. Kepulauan Sula'),
('192', '31', 'Kab. Kepulauan Talaud'),
('193', '24', 'Kab. Kepulauan Yapen (Yapen Wa'),
('194', '8', 'Kab. Kerinci'),
('195', '12', 'Kab. Ketapang'),
('196', '10', 'Kab. Klaten'),
('197', '1', 'Kab. Klungkung'),
('198', '30', 'Kab. Kolaka'),
('199', '30', 'Kab. Kolaka Utara'),
('2', '21', 'Kab. Aceh Barat Daya'),
('20', '21', 'Kota Banda Aceh'),
('200', '30', 'Kab. Konawe'),
('201', '30', 'Kab. Konawe Selatan'),
('202', '30', 'Kab. Konawe Utara'),
('203', '13', 'Kab. Kotabaru'),
('204', '31', 'Kota Kotamobagu'),
('205', '14', 'Kab. Kotawaringin Barat'),
('206', '14', 'Kab. Kotawaringin Timur'),
('207', '26', 'Kab. Kuantan Singingi'),
('208', '12', 'Kab. Kubu Raya'),
('209', '10', 'Kab. Kudus'),
('21', '18', 'Kota Bandar Lampung'),
('210', '5', 'Kab. Kulon Progo'),
('211', '9', 'Kab. Kuningan'),
('212', '23', 'Kab. Kupang'),
('213', '23', 'Kota Kupang'),
('214', '15', 'Kab. Kutai Barat'),
('215', '15', 'Kab. Kutai Kartanegara'),
('216', '15', 'Kab. Kutai Timur'),
('217', '34', 'Kab. Labuhan Batu'),
('218', '34', 'Kab. Labuhan Batu Selatan'),
('219', '34', 'Kab. Labuhan Batu Utara'),
('22', '9', 'Kab. Bandung'),
('220', '33', 'Kab. Lahat'),
('221', '14', 'Kab. Lamandau'),
('222', '11', 'Kab. Lamongan'),
('223', '18', 'Kab. Lampung Barat'),
('224', '18', 'Kab. Lampung Selatan'),
('225', '18', 'Kab. Lampung Tengah'),
('226', '18', 'Kab. Lampung Timur'),
('227', '18', 'Kab. Lampung Utara'),
('228', '12', 'Kab. Landak'),
('229', '34', 'Kab. Langkat'),
('23', '9', 'Kota Bandung'),
('230', '21', 'Kota Langsa'),
('231', '24', 'Kab. Lanny Jaya'),
('232', '3', 'Kab. Lebak'),
('233', '4', 'Kab. Lebong'),
('234', '23', 'Kab. Lembata'),
('235', '21', 'Kota Lhokseumawe'),
('236', '32', 'Kab. Lima Puluh Koto/Kota'),
('237', '17', 'Kab. Lingga'),
('238', '22', 'Kab. Lombok Barat'),
('239', '22', 'Kab. Lombok Tengah'),
('24', '9', 'Kab. Bandung Barat'),
('240', '22', 'Kab. Lombok Timur'),
('241', '22', 'Kab. Lombok Utara'),
('242', '33', 'Kota Lubuk Linggau'),
('243', '11', 'Kab. Lumajang'),
('244', '28', 'Kab. Luwu'),
('245', '28', 'Kab. Luwu Timur'),
('246', '28', 'Kab. Luwu Utara'),
('247', '11', 'Kab. Madiun'),
('248', '11', 'Kota Madiun'),
('249', '10', 'Kab. Magelang'),
('25', '29', 'Kab. Banggai'),
('250', '10', 'Kota Magelang'),
('251', '11', 'Kab. Magetan'),
('252', '9', 'Kab. Majalengka'),
('253', '27', 'Kab. Majene'),
('254', '28', 'Kota Makassar'),
('255', '11', 'Kab. Malang'),
('256', '11', 'Kota Malang'),
('257', '16', 'Kab. Malinau'),
('258', '19', 'Kab. Maluku Barat Daya'),
('259', '19', 'Kab. Maluku Tengah'),
('26', '29', 'Kab. Banggai Kepulauan'),
('260', '19', 'Kab. Maluku Tenggara'),
('261', '19', 'Kab. Maluku Tenggara Barat'),
('262', '27', 'Kab. Mamasa'),
('263', '24', 'Kab. Mamberamo Raya'),
('264', '24', 'Kab. Mamberamo Tengah'),
('265', '27', 'Kab. Mamuju'),
('266', '27', 'Kab. Mamuju Utara'),
('267', '31', 'Kota Manado'),
('268', '34', 'Kab. Mandailing Natal'),
('269', '23', 'Kab. Manggarai'),
('27', '2', 'Kab. Bangka'),
('270', '23', 'Kab. Manggarai Barat'),
('271', '23', 'Kab. Manggarai Timur'),
('272', '25', 'Kab. Manokwari'),
('273', '25', 'Kab. Manokwari Selatan'),
('274', '24', 'Kab. Mappi'),
('275', '28', 'Kab. Maros'),
('276', '22', 'Kota Mataram'),
('277', '25', 'Kab. Maybrat'),
('278', '34', 'Kota Medan'),
('279', '12', 'Kab. Melawi'),
('28', '2', 'Kab. Bangka Barat'),
('280', '8', 'Kab. Merangin'),
('281', '24', 'Kab. Merauke'),
('282', '18', 'Kab. Mesuji'),
('283', '18', 'Kota Metro'),
('284', '24', 'Kab. Mimika'),
('285', '31', 'Kab. Minahasa'),
('286', '31', 'Kab. Minahasa Selatan'),
('287', '31', 'Kab. Minahasa Tenggara'),
('288', '31', 'Kab. Minahasa Utara'),
('289', '11', 'Kab. Mojokerto'),
('29', '2', 'Kab. Bangka Selatan'),
('290', '11', 'Kota Mojokerto'),
('291', '29', 'Kab. Morowali'),
('292', '33', 'Kab. Muara Enim'),
('293', '8', 'Kab. Muaro Jambi'),
('294', '4', 'Kab. Muko Muko'),
('295', '30', 'Kab. Muna'),
('296', '14', 'Kab. Murung Raya'),
('297', '33', 'Kab. Musi Banyuasin'),
('298', '33', 'Kab. Musi Rawas'),
('299', '24', 'Kab. Nabire'),
('3', '21', 'Kab. Aceh Besar'),
('30', '2', 'Kab. Bangka Tengah'),
('300', '21', 'Kab. Nagan Raya'),
('301', '23', 'Kab. Nagekeo'),
('302', '17', 'Kab. Natuna'),
('303', '24', 'Kab. Nduga'),
('304', '23', 'Kab. Ngada'),
('305', '11', 'Kab. Nganjuk'),
('306', '11', 'Kab. Ngawi'),
('307', '34', 'Kab. Nias'),
('308', '34', 'Kab. Nias Barat'),
('309', '34', 'Kab. Nias Selatan'),
('31', '11', 'Kab. Bangkalan'),
('310', '34', 'Kab. Nias Utara'),
('311', '16', 'Kab. Nunukan'),
('312', '33', 'Kab. Ogan Ilir'),
('313', '33', 'Kab. Ogan Komering Ilir'),
('314', '33', 'Kab. Ogan Komering Ulu'),
('315', '33', 'Kab. Ogan Komering Ulu Selatan'),
('316', '33', 'Kab. Ogan Komering Ulu Timur'),
('317', '11', 'Kab. Pacitan'),
('318', '32', 'Kota Padang'),
('319', '34', 'Kab. Padang Lawas'),
('32', '1', 'Kab. Bangli'),
('320', '34', 'Kab. Padang Lawas Utara'),
('321', '32', 'Kota Padang Panjang'),
('322', '32', 'Kab. Padang Pariaman'),
('323', '34', 'Kota Padang Sidempuan'),
('324', '33', 'Kota Pagar Alam'),
('325', '34', 'Kab. Pakpak Bharat'),
('326', '14', 'Kota Palangka Raya'),
('327', '33', 'Kota Palembang'),
('328', '28', 'Kota Palopo'),
('329', '29', 'Kota Palu'),
('33', '13', 'Kab. Banjar'),
('330', '11', 'Kab. Pamekasan'),
('331', '3', 'Kab. Pandeglang'),
('332', '9', 'Kab. Pangandaran'),
('333', '28', 'Kab. Pangkajene Kepulauan'),
('334', '2', 'Kota Pangkal Pinang'),
('335', '24', 'Kab. Paniai'),
('336', '28', 'Kota Parepare'),
('337', '32', 'Kota Pariaman'),
('338', '29', 'Kab. Parigi Moutong'),
('339', '32', 'Kab. Pasaman'),
('34', '9', 'Kota Banjar'),
('340', '32', 'Kab. Pasaman Barat'),
('341', '15', 'Kab. Paser'),
('342', '11', 'Kab. Pasuruan'),
('343', '11', 'Kota Pasuruan'),
('344', '10', 'Kab. Pati'),
('345', '32', 'Kota Payakumbuh'),
('346', '25', 'Kab. Pegunungan Arfak'),
('347', '24', 'Kab. Pegunungan Bintang'),
('348', '10', 'Kab. Pekalongan'),
('349', '10', 'Kota Pekalongan'),
('35', '13', 'Kota Banjarbaru'),
('350', '26', 'Kota Pekanbaru'),
('351', '26', 'Kab. Pelalawan'),
('352', '10', 'Kab. Pemalang'),
('353', '34', 'Kota Pematang Siantar'),
('354', '15', 'Kab. Penajam Paser Utara'),
('355', '18', 'Kab. Pesawaran'),
('356', '18', 'Kab. Pesisir Barat'),
('357', '32', 'Kab. Pesisir Selatan'),
('358', '21', 'Kab. Pidie'),
('359', '21', 'Kab. Pidie Jaya'),
('36', '13', 'Kota Banjarmasin'),
('360', '28', 'Kab. Pinrang'),
('361', '7', 'Kab. Pohuwato'),
('362', '27', 'Kab. Polewali Mandar'),
('363', '11', 'Kab. Ponorogo'),
('364', '12', 'Kab. Pontianak'),
('365', '12', 'Kota Pontianak'),
('366', '29', 'Kab. Poso'),
('367', '33', 'Kota Prabumulih'),
('368', '18', 'Kab. Pringsewu'),
('369', '11', 'Kab. Probolinggo'),
('37', '10', 'Kab. Banjarnegara'),
('370', '11', 'Kota Probolinggo'),
('371', '14', 'Kab. Pulang Pisau'),
('372', '20', 'Kab. Pulau Morotai'),
('373', '24', 'Kab. Puncak'),
('374', '24', 'Kab. Puncak Jaya'),
('375', '10', 'Kab. Purbalingga'),
('376', '9', 'Kab. Purwakarta'),
('377', '10', 'Kab. Purworejo'),
('378', '25', 'Kab. Raja Ampat'),
('379', '4', 'Kab. Rejang Lebong'),
('38', '28', 'Kab. Bantaeng'),
('380', '10', 'Kab. Rembang'),
('381', '26', 'Kab. Rokan Hilir'),
('382', '26', 'Kab. Rokan Hulu'),
('383', '23', 'Kab. Rote Ndao'),
('384', '21', 'Kota Sabang'),
('385', '23', 'Kab. Sabu Raijua'),
('386', '10', 'Kota Salatiga'),
('387', '15', 'Kota Samarinda'),
('388', '12', 'Kab. Sambas'),
('389', '34', 'Kab. Samosir'),
('39', '5', 'Kab. Bantul'),
('390', '11', 'Kab. Sampang'),
('391', '12', 'Kab. Sanggau'),
('392', '24', 'Kab. Sarmi'),
('393', '8', 'Kab. Sarolangun'),
('394', '32', 'Kota Sawah Lunto'),
('395', '12', 'Kab. Sekadau'),
('396', '28', 'Kab. Selayar (Kepulauan Selaya'),
('397', '4', 'Kab. Seluma'),
('398', '10', 'Kab. Semarang'),
('399', '10', 'Kota Semarang'),
('4', '21', 'Kab. Aceh Jaya'),
('40', '33', 'Kab. Banyuasin'),
('400', '19', 'Kab. Seram Bagian Barat'),
('401', '19', 'Kab. Seram Bagian Timur'),
('402', '3', 'Kab. Serang'),
('403', '3', 'Kota Serang'),
('404', '34', 'Kab. Serdang Bedagai'),
('405', '14', 'Kab. Seruyan'),
('406', '26', 'Kab. Siak'),
('407', '34', 'Kota Sibolga'),
('408', '28', 'Kab. Sidenreng Rappang/Rapang'),
('409', '11', 'Kab. Sidoarjo'),
('41', '10', 'Kab. Banyumas'),
('410', '29', 'Kab. Sigi'),
('411', '32', 'Kab. Sijunjung (Sawah Lunto Si'),
('412', '23', 'Kab. Sikka'),
('413', '34', 'Kab. Simalungun'),
('414', '21', 'Kab. Simeulue'),
('415', '12', 'Kota Singkawang'),
('416', '28', 'Kab. Sinjai'),
('417', '12', 'Kab. Sintang'),
('418', '11', 'Kab. Situbondo'),
('419', '5', 'Kab. Sleman'),
('42', '11', 'Kab. Banyuwangi'),
('420', '32', 'Kab. Solok'),
('421', '32', 'Kota Solok'),
('422', '32', 'Kab. Solok Selatan'),
('423', '28', 'Kab. Soppeng'),
('424', '25', 'Kab. Sorong'),
('425', '25', 'Kota Sorong'),
('426', '25', 'Kab. Sorong Selatan'),
('427', '10', 'Kab. Sragen'),
('428', '9', 'Kab. Subang'),
('429', '21', 'Kota Subulussalam'),
('43', '13', 'Kab. Barito Kuala'),
('430', '9', 'Kab. Sukabumi'),
('431', '9', 'Kota Sukabumi'),
('432', '14', 'Kab. Sukamara'),
('433', '10', 'Kab. Sukoharjo'),
('434', '23', 'Kab. Sumba Barat'),
('435', '23', 'Kab. Sumba Barat Daya'),
('436', '23', 'Kab. Sumba Tengah'),
('437', '23', 'Kab. Sumba Timur'),
('438', '22', 'Kab. Sumbawa'),
('439', '22', 'Kab. Sumbawa Barat'),
('44', '14', 'Kab. Barito Selatan'),
('440', '9', 'Kab. Sumedang'),
('441', '11', 'Kab. Sumenep'),
('442', '8', 'Kota Sungaipenuh'),
('443', '24', 'Kab. Supiori'),
('444', '11', 'Kota Surabaya'),
('445', '10', 'Kota Surakarta (Solo)'),
('446', '13', 'Kab. Tabalong'),
('447', '1', 'Kab. Tabanan'),
('448', '28', 'Kab. Takalar'),
('449', '25', 'Kab. Tambrauw'),
('45', '14', 'Kab. Barito Timur'),
('450', '16', 'Kab. Tana Tidung'),
('451', '28', 'Kab. Tana Toraja'),
('452', '13', 'Kab. Tanah Bumbu'),
('453', '32', 'Kab. Tanah Datar'),
('454', '13', 'Kab. Tanah Laut'),
('455', '3', 'Kab. Tangerang'),
('456', '3', 'Kota Tangerang'),
('457', '3', 'Kota Tangerang Selatan'),
('458', '18', 'Kab. Tanggamus'),
('459', '34', 'Kota Tanjung Balai'),
('46', '14', 'Kab. Barito Utara'),
('460', '8', 'Kab. Tanjung Jabung Barat'),
('461', '8', 'Kab. Tanjung Jabung Timur'),
('462', '17', 'Kota Tanjung Pinang'),
('463', '34', 'Kab. Tapanuli Selatan'),
('464', '34', 'Kab. Tapanuli Tengah'),
('465', '34', 'Kab. Tapanuli Utara'),
('466', '13', 'Kab. Tapin'),
('467', '16', 'Kota Tarakan'),
('468', '9', 'Kab. Tasikmalaya'),
('469', '9', 'Kota Tasikmalaya'),
('47', '28', 'Kab. Barru'),
('470', '34', 'Kota Tebing Tinggi'),
('471', '8', 'Kab. Tebo'),
('472', '10', 'Kab. Tegal'),
('473', '10', 'Kota Tegal'),
('474', '25', 'Kab. Teluk Bintuni'),
('475', '25', 'Kab. Teluk Wondama'),
('476', '10', 'Kab. Temanggung'),
('477', '20', 'Kota Ternate'),
('478', '20', 'Kota Tidore Kepulauan'),
('479', '23', 'Kab. Timor Tengah Selatan'),
('48', '17', 'Kota Batam'),
('480', '23', 'Kab. Timor Tengah Utara'),
('481', '34', 'Kab. Toba Samosir'),
('482', '29', 'Kab. Tojo Una-Una'),
('483', '29', 'Kab. Toli-Toli'),
('484', '24', 'Kab. Tolikara'),
('485', '31', 'Kota Tomohon'),
('486', '28', 'Kab. Toraja Utara'),
('487', '11', 'Kab. Trenggalek'),
('488', '19', 'Kota Tual'),
('489', '11', 'Kab. Tuban'),
('49', '10', 'Kab. Batang'),
('490', '18', 'Kab. Tulang Bawang'),
('491', '18', 'Kab. Tulang Bawang Barat'),
('492', '11', 'Kab. Tulungagung'),
('493', '28', 'Kab. Wajo'),
('494', '30', 'Kab. Wakatobi'),
('495', '24', 'Kab. Waropen'),
('496', '18', 'Kab. Way Kanan'),
('497', '10', 'Kab. Wonogiri'),
('498', '10', 'Kab. Wonosobo'),
('499', '24', 'Kab. Yahukimo'),
('5', '21', 'Kab. Aceh Selatan'),
('50', '8', 'Kab. Batang Hari'),
('500', '24', 'Kab. Yalimo'),
('501', '5', 'Kota Yogyakarta'),
('51', '11', 'Kota Batu'),
('52', '34', 'Kab. Batu Bara'),
('53', '30', 'Kota Bau-Bau'),
('54', '9', 'Kab. Bekasi'),
('55', '9', 'Kota Bekasi'),
('56', '2', 'Kab. Belitung'),
('57', '2', 'Kab. Belitung Timur'),
('58', '23', 'Kab. Belu'),
('59', '21', 'Kab. Bener Meriah'),
('6', '21', 'Kab. Aceh Singkil'),
('60', '26', 'Kab. Bengkalis'),
('61', '12', 'Kab. Bengkayang'),
('62', '4', 'Kota Bengkulu'),
('63', '4', 'Kab. Bengkulu Selatan'),
('64', '4', 'Kab. Bengkulu Tengah'),
('65', '4', 'Kab. Bengkulu Utara'),
('66', '15', 'Kab. Berau'),
('67', '24', 'Kab. Biak Numfor'),
('68', '22', 'Kab. Bima'),
('69', '22', 'Kota Bima'),
('7', '21', 'Kab. Aceh Tamiang'),
('70', '34', 'Kota Binjai'),
('71', '17', 'Kab. Bintan'),
('72', '21', 'Kab. Bireuen'),
('73', '31', 'Kota Bitung'),
('74', '11', 'Kab. Blitar'),
('75', '11', 'Kota Blitar'),
('76', '10', 'Kab. Blora'),
('77', '7', 'Kab. Boalemo'),
('78', '9', 'Kab. Bogor'),
('79', '9', 'Kota Bogor'),
('8', '21', 'Kab. Aceh Tengah'),
('80', '11', 'Kab. Bojonegoro'),
('81', '31', 'Kab. Bolaang Mongondow (Bolmon'),
('82', '31', 'Kab. Bolaang Mongondow Selatan'),
('83', '31', 'Kab. Bolaang Mongondow Timur'),
('84', '31', 'Kab. Bolaang Mongondow Utara'),
('85', '30', 'Kab. Bombana'),
('86', '11', 'Kab. Bondowoso'),
('87', '28', 'Kab. Bone'),
('88', '7', 'Kab. Bone Bolango'),
('89', '15', 'Kota Bontang'),
('9', '21', 'Kab. Aceh Tenggara'),
('90', '24', 'Kab. Boven Digoel'),
('91', '10', 'Kab. Boyolali'),
('92', '10', 'Kab. Brebes'),
('93', '32', 'Kota Bukittinggi'),
('94', '1', 'Kab. Buleleng'),
('95', '28', 'Kab. Bulukumba'),
('96', '16', 'Kab. Bulungan (Bulongan)'),
('97', '8', 'Kab. Bungo'),
('98', '29', 'Kab. Buol'),
('99', '19', 'Kab. Buru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `otoritas`
--

CREATE TABLE `otoritas` (
  `ID_OTORITAS` char(1) NOT NULL,
  `NAMA_OTORITAS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `otoritas`
--

INSERT INTO `otoritas` (`ID_OTORITAS`, `NAMA_OTORITAS`) VALUES
('1', 'Pemilik'),
('2', 'Kasir'),
('3', 'Pengiriman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_PEG` char(12) NOT NULL,
  `ID_OTORITAS` char(1) NOT NULL,
  `ID_KOTA` char(5) NOT NULL,
  `USER_PEG` varchar(15) NOT NULL,
  `PASS_PEG` varchar(32) NOT NULL,
  `EMAIL_PEG` varchar(30) NOT NULL,
  `NAMA_PEG` varchar(30) NOT NULL,
  `ALAMAT_PEG` varchar(50) NOT NULL,
  `TELEPON_PEG` varchar(13) NOT NULL,
  `KODEPOS_PEG` char(5) NOT NULL,
  `FOTO_PEG` char(12) DEFAULT NULL,
  `STATUS_PEG` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`ID_PEG`, `ID_OTORITAS`, `ID_KOTA`, `USER_PEG`, `PASS_PEG`, `EMAIL_PEG`, `NAMA_PEG`, `ALAMAT_PEG`, `TELEPON_PEG`, `KODEPOS_PEG`, `FOTO_PEG`, `STATUS_PEG`) VALUES
('P0001', '1', '342', 'pemilik', '58399557dae3c60e23c78606771dfa3d', 'pemilik@pemilik.com', 'Yovan', 'Jl. raya keletek', '085730060500', '65491', NULL, '1'),
('P0002', '2', '289', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'askdmal213@gmail.com', 'MR RYAN ACUNA', 'alamatnya pegawai dua', '085730008012', '12345', NULL, '1'),
('P0003', '3', '91', 'pengiriman', 'd7394563946d263a0014dd98c678c43b', 'askdweq3@gmail.com', 'admin pegawai satu', 'alamatnya pegawai satu', '087300080123', '12312', NULL, '1');

--
-- Trigger `pegawai`
--
DELIMITER $$
CREATE TRIGGER `idpeg` BEFORE INSERT ON `pegawai` FOR EACH ROW begin
	declare jumlah integer;
	declare urut integer;
    select count(*) into jumlah from `pegawai`;
	set urut := jumlah +1;
    set NEW.`ID_PEG` := concat('P',LPAD(urut,4,'0'));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `KODE_BAYAR` char(13) NOT NULL,
  `NO_INVOICE` char(12) NOT NULL,
  `ID_PEG` char(12) DEFAULT NULL,
  `JENIS_BAYAR` char(15) NOT NULL,
  `BUKTI_BAYAR` char(20) DEFAULT NULL,
  `TGL_BAYAR` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `HARGA_BAYAR` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `NO_INVOICE` char(12) NOT NULL,
  `ID_CUS` char(6) NOT NULL,
  `ID_KOTA` char(5) DEFAULT NULL,
  `ID_JEN` char(3) DEFAULT NULL,
  `ID_STAT` char(3) NOT NULL,
  `TGL_TRANSAKSI` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `NAMA_KTP` varchar(50) DEFAULT NULL,
  `NOMER_KTP` varchar(50) DEFAULT NULL,
  `NAMA_PEN` varchar(30) DEFAULT NULL,
  `ALAMAT_PEN` varchar(50) DEFAULT NULL,
  `TELEPON_PEN` varchar(13) DEFAULT NULL,
  `KODEPOS_PEN` char(5) DEFAULT NULL,
  `ONGKIR_PESAN` int(11) DEFAULT NULL,
  `LAYANAN_PESAN` varchar(50) DEFAULT NULL,
  `TOTAL_HARGA_PESAN` int(11) NOT NULL,
  `STATUS_DP` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `pemesanan`
--
DELIMITER $$
CREATE TRIGGER `trg_idinvoice` BEFORE INSERT ON `pemesanan` FOR EACH ROW begin
	declare jumlah integer;
    declare urut integer;
    DECLARE nama VARCHAR(30);
    DECLARE alamat VARCHAR(50);
    DECLARE kodepos VARCHAR(30);
    DECLARE kota VARCHAR(30);
    DECLARE telepon VARCHAR(30);
    select count(*) into jumlah from pemesanan where
	SUBSTRING(NO_INVOICE, 2, 2)= LPAD(EXTRACT(DAY FROM CURRENT_TIMESTAMP), 2, "0") and
	SUBSTRING(NO_INVOICE, 4, 2)= LPAD(EXTRACT(MONTH FROM CURRENT_TIMESTAMP), 2, "0") and
	SUBSTRING(NO_INVOICE, 6, 2)= SUBSTRING(EXTRACT(YEAR FROM CURRENT_TIMESTAMP), 3, 2);
    set urut := jumlah +1;
	set NEW.`NO_INVOICE`:= concat('T',(LPAD(EXTRACT(DAY FROM sysdate()), 2, "0")),(LPAD(EXTRACT(MONTH FROM sysdate()), 2, "0")),(SUBSTRING(EXTRACT(YEAR FROM CURRENT_TIMESTAMP), 3, 2)),LPAD(urut,4,'0'));
IF (NEW.NAMA_PEN IS null)
THEN
SET NEW.NAMA_PEN =(SELECT NAMA_CUS FROM customer WHERE ID_CUS = NEW.ID_CUS);
SET NEW.ALAMAT_PEN =(SELECT ALAMAT_CUS FROM customer WHERE ID_CUS = NEW.ID_CUS);
SET NEW.KODEPOS_PEN =(SELECT KODEPOS_CUS FROM customer WHERE ID_CUS = NEW.ID_CUS);
SET NEW.ID_KOTA =(SELECT ID_KOTA FROM customer WHERE ID_CUS = NEW.ID_CUS);
SET NEW.TELEPON_PEN =(SELECT TELEPON_CUS FROM customer WHERE ID_CUS = NEW.ID_CUS);
END IF;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `NO_RESI` char(12) NOT NULL,
  `KODE_BAYAR` char(13) NOT NULL,
  `TGL_KIRIM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `ID_PROV` char(3) NOT NULL,
  `NAMA_PROV` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`ID_PROV`, `NAMA_PROV`) VALUES
('1', 'Bali'),
('10', 'Jawa Tengah'),
('11', 'Jawa Timur'),
('12', 'Kalimantan Barat'),
('13', 'Kalimantan Selatan'),
('14', 'Kalimantan Tengah'),
('15', 'Kalimantan Timur'),
('16', 'Kalimantan Utara'),
('17', 'Kepulauan Riau'),
('18', 'Lampung'),
('19', 'Maluku'),
('2', 'Bangka Belitung'),
('20', 'Maluku Utara'),
('21', 'Nanggroe Aceh Darussalam (NAD)'),
('22', 'Nusa Tenggara Barat (NTB)'),
('23', 'Nusa Tenggara Timur (NTT)'),
('24', 'Papua'),
('25', 'Papua Barat'),
('26', 'Riau'),
('27', 'Sulawesi Barat'),
('28', 'Sulawesi Selatan'),
('29', 'Sulawesi Tengah'),
('3', 'Banten'),
('30', 'Sulawesi Tenggara'),
('31', 'Sulawesi Utara'),
('32', 'Sumatera Barat'),
('33', 'Sumatera Selatan'),
('34', 'Sumatera Utara'),
('4', 'Bengkulu'),
('5', 'DI Yogyakarta'),
('6', 'DKI Jakarta'),
('7', 'Gorontalo'),
('8', 'Jambi'),
('9', 'Jawa Barat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `ID_STAT` char(3) NOT NULL,
  `NAMA_STAT` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`ID_STAT`, `NAMA_STAT`) VALUES
('SJ1', 'menunggu pelunasan'),
('SJ2', 'lunas'),
('SP1', 'keranjang'),
('SP2', 'belum bayar'),
('SP3', 'menunggu dikonfirmasi'),
('SP4', 'pembayaran dikonfirmasi'),
('SP5', 'packing'),
('SP6', 'proses pengiriman'),
('SPT', 'pembayaran ditolak'),
('ST1', 'transaksi dibatalkan'),
('ST2', 'transaksi selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ukuran`
--

CREATE TABLE `ukuran` (
  `ID_UK` char(5) NOT NULL,
  `UKURAN` varchar(15) NOT NULL,
  `STATUS` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ukuran`
--

INSERT INTO `ukuran` (`ID_UK`, `UKURAN`, `STATUS`) VALUES
('UK001', 'S', 1),
('UK002', 'M', 1),
('UK003', 'XL', 1);

--
-- Trigger `ukuran`
--
DELIMITER $$
CREATE TRIGGER `iduk` BEFORE INSERT ON `ukuran` FOR EACH ROW begin
	declare jumlah integer;
	declare urut integer;
    select count(*) into jumlah from `ukuran`;
	set urut := jumlah +1;
    set NEW.`ID_UK` := concat('UK',LPAD(urut,3,'0'));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `warna`
--

CREATE TABLE `warna` (
  `ID_WAR` char(5) NOT NULL,
  `WARNA` varchar(25) NOT NULL,
  `STATUS` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `warna`
--

INSERT INTO `warna` (`ID_WAR`, `WARNA`, `STATUS`) VALUES
('WAR01', 'Biru', 1),
('WAR02', 'Abu-abu', 1);

--
-- Trigger `warna`
--
DELIMITER $$
CREATE TRIGGER `idwar` BEFORE INSERT ON `warna` FOR EACH ROW begin
	declare jumlah integer;
	declare urut integer;
    select count(*) into jumlah from `warna`;
	set urut := jumlah +1;
    set NEW.`ID_WAR` := concat('WAR',LPAD(urut,2,'0'));
end
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BAR`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID_CUS`),
  ADD KEY `FK_MEMILIKIASDZXC` (`ID_KOTA`);

--
-- Indexes for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD PRIMARY KEY (`ID_WAR`,`ID_UK`,`ID_BAR`),
  ADD KEY `FK_RELATIONSHIP_18` (`ID_BAR`),
  ADD KEY `FK_SDASD23` (`ID_UK`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`ID_WAR`,`NO_INVOICE`,`ID_UK`,`ID_BAR`),
  ADD KEY `FK_DIBUTUHKAN` (`NO_INVOICE`),
  ADD KEY `FK_ZMEMBUTUHKAN` (`ID_WAR`,`ID_UK`,`ID_BAR`);

--
-- Indexes for table `history_harga`
--
ALTER TABLE `history_harga`
  ADD PRIMARY KEY (`ID_HARGA`);

--
-- Indexes for table `history_stok`
--
ALTER TABLE `history_stok`
  ADD PRIMARY KEY (`ID_STOK`);

--
-- Indexes for table `jenis_pengiriman`
--
ALTER TABLE `jenis_pengiriman`
  ADD PRIMARY KEY (`ID_JEN`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`ID_KOTA`),
  ADD KEY `FK_MEMILIKISDLK` (`ID_PROV`);

--
-- Indexes for table `otoritas`
--
ALTER TABLE `otoritas`
  ADD PRIMARY KEY (`ID_OTORITAS`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID_PEG`),
  ADD KEY `FK_MEMILIKI` (`ID_KOTA`),
  ADD KEY `FK_MEMPUNYAI` (`ID_OTORITAS`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`KODE_BAYAR`),
  ADD KEY `FK_MELAYANI` (`ID_PEG`),
  ADD KEY `FK_MEMBUTUHKANZXCXZ` (`NO_INVOICE`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`NO_INVOICE`),
  ADD KEY `FK_ASMEMBUTUHKAN` (`ID_JEN`),
  ADD KEY `FK_MELAKUKAN` (`ID_CUS`),
  ADD KEY `FK_MEMILIKIASD` (`ID_KOTA`),
  ADD KEY `FK_RELATIONSHIP_19` (`ID_STAT`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`NO_RESI`),
  ADD KEY `FK_MEMBUTUHKANZXC` (`KODE_BAYAR`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`ID_PROV`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID_STAT`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`ID_UK`);

--
-- Indexes for table `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`ID_WAR`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_MEMILIKIASDZXC` FOREIGN KEY (`ID_KOTA`) REFERENCES `kota` (`ID_KOTA`);

--
-- Ketidakleluasaan untuk tabel `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD CONSTRAINT `FK_MEMBUTUHKAN` FOREIGN KEY (`ID_WAR`) REFERENCES `warna` (`ID_WAR`),
  ADD CONSTRAINT `FK_RELATIONSHIP_18` FOREIGN KEY (`ID_BAR`) REFERENCES `barang` (`ID_BAR`),
  ADD CONSTRAINT `FK_SDASD23` FOREIGN KEY (`ID_UK`) REFERENCES `ukuran` (`ID_UK`);

--
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `FK_DIBUTUHKAN` FOREIGN KEY (`NO_INVOICE`) REFERENCES `pemesanan` (`NO_INVOICE`),
  ADD CONSTRAINT `FK_ZMEMBUTUHKAN` FOREIGN KEY (`ID_WAR`,`ID_UK`,`ID_BAR`) REFERENCES `detail_barang` (`ID_WAR`, `ID_UK`, `ID_BAR`);

--
-- Ketidakleluasaan untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD CONSTRAINT `FK_MEMILIKISDLK` FOREIGN KEY (`ID_PROV`) REFERENCES `provinsi` (`ID_PROV`);

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_KOTA`) REFERENCES `kota` (`ID_KOTA`),
  ADD CONSTRAINT `FK_MEMPUNYAI` FOREIGN KEY (`ID_OTORITAS`) REFERENCES `otoritas` (`ID_OTORITAS`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `FK_MELAYANI` FOREIGN KEY (`ID_PEG`) REFERENCES `pegawai` (`ID_PEG`),
  ADD CONSTRAINT `FK_MEMBUTUHKANZXCXZ` FOREIGN KEY (`NO_INVOICE`) REFERENCES `pemesanan` (`NO_INVOICE`);

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `FK_ASMEMBUTUHKAN` FOREIGN KEY (`ID_JEN`) REFERENCES `jenis_pengiriman` (`ID_JEN`),
  ADD CONSTRAINT `FK_MELAKUKAN` FOREIGN KEY (`ID_CUS`) REFERENCES `customer` (`ID_CUS`),
  ADD CONSTRAINT `FK_MEMILIKIASD` FOREIGN KEY (`ID_KOTA`) REFERENCES `kota` (`ID_KOTA`),
  ADD CONSTRAINT `FK_RELATIONSHIP_19` FOREIGN KEY (`ID_STAT`) REFERENCES `status` (`ID_STAT`);

--
-- Ketidakleluasaan untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `FK_MEMBUTUHKANZXC` FOREIGN KEY (`KODE_BAYAR`) REFERENCES `pembayaran` (`KODE_BAYAR`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
