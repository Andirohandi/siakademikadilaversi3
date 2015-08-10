-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2015 at 02:18 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siakad_dila`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_lulus`(IN `p_kuota` int, IN p_tahun int)
BEGIN
DECLARE done INT DEFAULT FALSE;	
DECLARE a, i INT;

DECLARE cur1 CURSOR for SELECT id_pendaftaran FROM tr_pendaftaran WHERE `status` = 1 and lulus = 0 ORDER BY nilai DESC;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

set i = 1;
OPEN cur1;
read_loop : LOOP
FETCH cur1 INTO a;
IF done THEN
LEAVE read_loop;
END IF;
IF i > p_kuota THEN
LEAVE read_loop;
END IF;

UPDATE tr_pendaftaran SET status = 2, lulus = 1, no_urut = i, tahun = p_tahun WHERE id_pendaftaran = a ;



set i = i + 1;

END LOOP;
CLOSE cur1;
UPDATE tr_pendaftaran SET  lulus = 1, tahun = p_tahun WHERE  status = 1 ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_seleksi`(IN `p_tahun` INT, IN `p_mulai` INT, IN `p_kelas` INT)
BEGIN
	DECLARE done INT DEFAULT FALSE;
	DECLARE a, b, n INT;
	DECLARE m, c, d, e, f, g, k  VARCHAR(100);

	DECLARE cur1 CURSOR FOR SELECT id_pendaftaran, no_urut, name, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat  FROM tr_pendaftaran WHERE STATUS= 2 and tahun = p_tahun and kelas = 0 and reg = 1  ORDER BY nilai DESC ;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
		
	OPEN cur1;
	read_loop : LOOP
	FETCH cur1 INTO a, b, c, d, e, f, g ;
	IF done THEN 
	LEAVE read_loop;
	END IF;
	UPDATE tr_pendaftaran SET kelas = p_mulai WHERE id_pendaftaran = a ;
	
	SET n = CHAR_LENGTH(b);
	IF n = 1 THEN SET k = CONCAT('00', b);
	ELSEIF n = 2 THEN SET k = CONCAT('0', b);
	ELSE SET k = b;
	END IF;
	SET m = CONCAT(DATE_FORMAT(CURRENT_DATE(), '%y%m'), k  );
	INSERT INTO ref_siswa (nis, id_pendaftaran, kelas, name, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, active, tahun, username, password) VALUES ( m, a, p_mulai, c, d, e, f , g , 1, p_tahun, m , 12345 );
	set p_mulai = p_mulai + 1;
	if p_mulai > p_kelas THEN
	set p_mulai =  1; 
	END IF;
	
	END LOOP;
	CLOSE cur1;
	
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ref_guru`
--

CREATE TABLE IF NOT EXISTS `ref_guru` (
  `id_guru` int(11) NOT NULL,
  `nm_guru` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `active` int(11) NOT NULL,
  `password` varchar(5) NOT NULL DEFAULT '12345',
  `photo` varchar(200) NOT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_guru`
--

INSERT INTO `ref_guru` (`id_guru`, `nm_guru`, `alamat`, `telp`, `active`, `password`, `photo`) VALUES
(32005, 'NIngrum Soleha, S.Pd', 'jl.dago barat no 10', '08121122290', 1, '12345', 'empat.jpg'),
(9032007, 'Hj. Yoyoh Kadariah, S.Pd.', 'jl.Cilengkrang', '08121228988', 1, '12345', 'empat.jpg'),
(7032005, 'Dra. Dian Chaerany', 'komplek alamanda', '081322098999', 1, '12345', 'tiga.jpg'),
(6031012, 'Slamet Herdiana S, Pd.', 'Jl. Cikadut No. 12', '08198991281', 1, '12345', 'empat.jpg'),
(5012002, 'Siti Komariah, S.Pd.', 'jl.dago barat', '0819881991', 1, '12345', 'empat.jpg'),
(8032015, 'Dra. Eveline Julita Riah', 'Cigadung Barat ', '081821877878', 1, '12345', 'empat.jpg'),
(8021002, 'Nanang Suhartono, S.Pd., MM.', 'jl. cikutra barat no 108', '08180976765', 1, '12345', 'empat.jpg'),
(4122004, 'Hj. Lilis Pudjarawati, S.Pd.', 'jl.cikutra barat ', '08191156111', 1, '12345', 'empat.jpg'),
(9032002, 'Hj. Sri Yulia Widiati, S.Pd.', 'Jl.Ciheulang no 19 ', '081324765655', 1, '12345', 'empat.jpg'),
(2032003, 'Dra. Hj. Eet Rukmini', 'Jl. Cikutra Barat no 100', '081871766567', 1, '12345', 'empat.jpg'),
(122004, 'Sri Muwarni, S.Pd.', 'JL.soekarno hatta no 10 ', '08987887722', 1, '12345', 'empat.jpg'),
(6031006, 'Ade Sunaryo, BA', 'Jl.Jatihandap no 109', '081765516161', 1, '12345', 'empat.jpg'),
(6032009, 'Rasmita Ningsih T., MM.', 'Jl.Padasuka Barat No 10 ', '08180898786', 1, '12345', 'empat.jpg'),
(7011017, 'Supian, S.Ag.', 'Jl.Venus No 10, Soekarno Hatta', '08180987879', 1, '12345', 'empat.jpg'),
(7211069, 'Slamet, S.Ag., M.Mpd.', 'jl.cisangkuy 2 no 10', '0896322222', 1, '12345', 'empat.jpg'),
(8031003, 'Drs. Yohanes Suwarno', 'jl. cisaat no 10 ', '081221435567', 1, '12345', 'empat.jpg'),
(7011020, 'Engkus Warsakusumah, S.Pd.', 'Jl.Cikutra Timur No 10/8', '08122345221', 1, '12345', 'empat.jpg'),
(8032006, 'Dra. Denti Sri Murdianti', 'Jl.Ciheulang Timur No 10b', '081321234456', 1, '12345', 'empat.jpg'),
(1012006, 'Elly Indaryati', 'Jl.Ujung Berung n0 19/c ', '08180898786', 1, '12345', 'empat.jpg'),
(8022002, 'Reni Mariah, S.Pd.', 'Jl.Dago Timur ', '08176166661', 1, '12345', 'empat.jpg'),
(8032003, 'Betti Ariani S., S.Pd.', 'Jl. Cikutra ', '0818089876', 1, '12345', 'empat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ref_kelas`
--

CREATE TABLE IF NOT EXISTS `ref_kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nm_kelas` varchar(20) NOT NULL,
  `tingkat` smallint(3) NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ref_kelas`
--

INSERT INTO `ref_kelas` (`id_kelas`, `nm_kelas`, `tingkat`, `jurusan`) VALUES
(1, '7A', 1, ''),
(2, '7B', 2, ''),
(3, '7C', 1, ''),
(4, '7D`', 1, ''),
(5, '7E', 1, ''),
(6, '7F', 1, ''),
(7, '7G', 1, ''),
(8, '7H', 1, ''),
(9, '7I', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `ref_level`
--

CREATE TABLE IF NOT EXISTS `ref_level` (
  `id_level` smallint(6) NOT NULL AUTO_INCREMENT,
  `nm_level` varchar(30) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_level`),
  KEY `uq_id_level` (`id_level`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ref_level`
--

INSERT INTO `ref_level` (`id_level`, `nm_level`, `active`) VALUES
(1, 'System Administrator', 1),
(2, 'Guru', 1),
(3, 'Wali Kelas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ref_level_menu_access`
--

CREATE TABLE IF NOT EXISTS `ref_level_menu_access` (
  `id_level_menu_access` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_level` smallint(6) DEFAULT NULL,
  `id_menu_details` tinyint(4) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_level_menu_access`),
  KEY `uq_id_level_menu_access` (`id_level_menu_access`) USING BTREE,
  KEY `id_level` (`id_level`),
  KEY `id_menu_details` (`id_menu_details`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `ref_level_menu_access`
--

INSERT INTO `ref_level_menu_access` (`id_level_menu_access`, `id_level`, `id_menu_details`, `active`) VALUES
(1, 1, 1, 1),
(9, 1, 7, 1),
(11, 1, 9, 1),
(12, 1, 4, 1),
(13, 1, 11, 1),
(15, 1, 13, 1),
(16, 1, 14, 1),
(17, 1, 15, 1),
(18, 1, 16, 1),
(20, 1, 17, 1),
(21, 1, 18, 1),
(22, 1, 19, 1),
(23, 1, 20, 1),
(26, 7, 23, 1),
(28, 1, 25, 1),
(31, 1, 28, 1),
(32, 1, 2, 1),
(33, 1, 29, 1),
(34, 1, 30, 1),
(35, 1, 31, 1),
(37, 1, 5, 1),
(38, 1, 33, 1),
(40, 1, 36, 0),
(41, 1, 37, 1),
(42, 1, 38, 0),
(43, 1, 39, 1),
(44, 1, 43, 1),
(45, 2, 41, 1),
(46, 1, 42, 1),
(47, 1, 40, 1),
(48, 1, 41, 1),
(49, 2, 43, 1),
(50, 1, 44, 1),
(51, 3, 42, 1),
(53, 1, 45, 1),
(54, 1, 46, 0),
(55, 1, 47, 1),
(56, 1, 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ref_menu_details`
--

CREATE TABLE IF NOT EXISTS `ref_menu_details` (
  `id_menu_details` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nm_menu_details` varchar(21) DEFAULT NULL,
  `url` varchar(21) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` tinyint(2) NOT NULL DEFAULT '0',
  `id_menu_groups` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_menu_details`),
  KEY `id_menu_groups` (`id_menu_groups`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `ref_menu_details`
--

INSERT INTO `ref_menu_details` (`id_menu_details`, `nm_menu_details`, `url`, `active`, `position`, `id_menu_groups`) VALUES
(1, 'Menu Groups', 'menu_groups', 1, 1, 1),
(2, 'Level', 'level', 1, 5, 1),
(4, 'Menu Details', 'menu_details', 1, 2, 1),
(5, 'User', 'user', 1, 4, 1),
(9, 'Menu Access', 'level_menu_access', 1, 3, 1),
(36, 'Tahun Ajaran_', 'calon_siswa', 1, 1, 4),
(37, 'Calon Siswa', 'tahun_ajaran', 1, 2, 4),
(38, 'Daftar Ulang', 'lulus', 0, 3, 4),
(39, 'Mata Pelajaran', 'mapel', 1, 3, 1),
(40, 'Guru', 'guru', 1, 4, 1),
(42, 'Rapot', 'ajaran', 1, 9, 5),
(43, 'Nilai', 'nilai', 1, 1, 3),
(44, 'Kelas', 'kelas', 1, 8, 1),
(45, 'Siswa', 'siswa', 1, 9, 1),
(46, 'Siswa Tidak Lulus', 'lulus/tidak', 0, 4, 4),
(47, 'Siswa Lulus', 'lulus', 1, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ref_menu_groups`
--

CREATE TABLE IF NOT EXISTS `ref_menu_groups` (
  `id_menu_groups` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nm_menu_groups` varchar(21) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_menu_groups`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ref_menu_groups`
--

INSERT INTO `ref_menu_groups` (`id_menu_groups`, `nm_menu_groups`, `active`, `position`) VALUES
(1, 'Master', 1, 1),
(3, 'Guru', 1, 3),
(4, 'Pendaftaran ', 1, 4),
(5, 'Wali Kelas', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ref_pelajaran`
--

CREATE TABLE IF NOT EXISTS `ref_pelajaran` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `id_guru` int(11) NOT NULL,
  `nm_pelajaran` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_mapel`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ref_pelajaran`
--

INSERT INTO `ref_pelajaran` (`id_mapel`, `id_guru`, `nm_pelajaran`, `active`) VALUES
(2, 32005, 'Seni Budaya', 1),
(5, 7032005, 'bahasa indonesia', 1),
(4, 9032007, 'Seni Budaya', 1),
(6, 6031012, 'bahasa indonesia', 1),
(7, 5012002, 'bahasa indonesia', 1),
(8, 8032003, 'Bahasa Inggris', 1),
(9, 7032005, 'MATEMATIKA', 1),
(10, 8021002, 'MATEMATIKA', 1),
(11, 4122004, 'IPA', 0),
(12, 9032002, 'IPA', 1),
(13, 2032003, 'IPS', 1),
(14, 6031006, 'PKN ', 1),
(15, 6032009, 'IPS', 1),
(16, 7011017, 'PAI', 1),
(17, 7211069, 'PAI', 1),
(18, 8031003, 'PENJASKES', 1),
(19, 7011020, 'TIK', 1),
(3, 8032006, 'B.Sunda', 1),
(1, 8022002, 'BP', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_siswa`
--

CREATE TABLE IF NOT EXISTS `ref_siswa` (
  `nis` varchar(20) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` tinyint(2) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(6) DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `tahun` smallint(4) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `id_level` tinyint(1) NOT NULL DEFAULT '4',
  PRIMARY KEY (`id_pendaftaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=336 ;

-- --------------------------------------------------------

--
-- Table structure for table `ref_user`
--

CREATE TABLE IF NOT EXISTS `ref_user` (
  `id_user` varchar(21) NOT NULL,
  `nm_user_first` varchar(21) DEFAULT NULL,
  `nm_user_last` varchar(21) DEFAULT NULL,
  `username` varchar(21) DEFAULT NULL,
  `password` varchar(21) DEFAULT NULL,
  `tahun` smallint(4) DEFAULT NULL,
  `kelas` tinyint(2) DEFAULT NULL,
  `id_level` smallint(6) DEFAULT '3',
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `uq_id_user` (`id_user`) USING BTREE,
  KEY `id_level` (`id_level`),
  KEY `id_level_2` (`id_level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_user`
--

INSERT INTO `ref_user` (`id_user`, `nm_user_first`, `nm_user_last`, `username`, `password`, `tahun`, `kelas`, `id_level`, `active`) VALUES
('122004', 'Ningrum ', 'Soleha', 'NingrumSoleha', '123456', 0, 0, 2, 1),
('12201', 'Sri', 'Muwarni', 'MuwarniSri', '123456', 2015, 7, 3, 1),
('1234', 'Aldila', 'Karunia', 'laidla', '212121', 0, 0, 3, 1),
('1502345', 'Aldila', 'Karunia', 'admin', 'admin', 2015, 1, 1, 1),
('34567', 'Ibnu', 'Salam', 'ibnu', 'ibnu', NULL, NULL, 2, 1),
('9090', 'Fauzan Fathur', 'Rohman', 'fathur', 'blackberry', 0, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_mengajar`
--

CREATE TABLE IF NOT EXISTS `tr_mengajar` (
  `id_mengajar` int(11) NOT NULL AUTO_INCREMENT,
  `id_mapel` int(11) DEFAULT NULL,
  `nis` int(11) DEFAULT NULL,
  `latihan` smallint(3) DEFAULT '0',
  `uts` smallint(3) DEFAULT '0',
  `uas` smallint(3) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_mengajar`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tr_mengajar`
--

INSERT INTO `tr_mengajar` (`id_mengajar`, `id_mapel`, `nis`, `latihan`, `uts`, `uas`, `status`) VALUES
(1, 1, 1507001, 3, 3, 3, 1),
(3, 5, 150789, 5, 5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_pendaftaran`
--

CREATE TABLE IF NOT EXISTS `tr_pendaftaran` (
  `id_pendaftaran` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nisn` varchar(21) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  `asal_sekolah` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(6) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(50) DEFAULT '',
  `nun` float DEFAULT NULL,
  `no_ijazah` varchar(50) DEFAULT NULL,
  `password` varchar(21) DEFAULT '12345',
  `nilai` float DEFAULT '0',
  `active` tinyint(1) DEFAULT '0',
  `tahun` smallint(4) DEFAULT '0',
  `kelas` tinyint(2) DEFAULT '0',
  `no_urut` smallint(4) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `reg` tinyint(1) DEFAULT '0',
  `lulus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_pendaftaran`),
  UNIQUE KEY `uq_nisn` (`nisn`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `tr_pendaftaran`
--

INSERT INTO `tr_pendaftaran` (`id_pendaftaran`, `nisn`, `name`, `asal_sekolah`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nun`, `no_ijazah`, `password`, `nilai`, `active`, `tahun`, `kelas`, `no_urut`, `status`, `reg`, `lulus`) VALUES
(1, '1234567', 'AL', 'sdn 2 ', 'Pria', NULL, NULL, '', 27, '87777777', '12345', 26, 1, 2010, 0, 0, 1, 1, 1),
(2, '7666666', 'dila', 'sdn 8 ', 'Wanita', NULL, NULL, '', 29, '77888788', '12345', 29, 1, 2014, 1, 1, 2, 1, 1),
(3, '21211111', 'fathur', 'sdn 9', 'Pria', NULL, NULL, '', 27, '626662662', '12345', 27, 1, 2014, 2, 2, 2, 1, 1),
(4, '22222', 'fauzan', 'sdn 2 ', 'Pria', NULL, NULL, '', 22, '88888888', '12345', 22, 1, 2013, 0, 1, 2, 1, 1),
(5, 'oo26363722', 'Ade Isma Faishal', 'sdn 2 cikadut', 'Pria', NULL, NULL, '', 27, '12211111', '12345', 27, 1, 2015, 0, 54, 2, 0, 1),
(6, '0025140723', 'Ai Siti Rohaeti', 'sdn 2 coblong ', 'Wanita', NULL, NULL, '', 27, '201527771', '12345', 27, 1, 2015, 1, 52, 2, 1, 1),
(7, '002729813', 'Ajeng Solihat', 'sdn 1 ', 'Wanita', NULL, NULL, '', 28, '20162222', '12345', 28, 1, 2015, 0, 25, 2, 0, 1),
(8, '0011225891', 'Amelia Dwi Chandhary', 'sdn 1 cikadut', 'Wanita', NULL, NULL, '', 27, '666161616', '12345', 28, 1, 2015, 0, 24, 2, 0, 1),
(9, '00225636058', 'Ardujidan Renanda Putra', 'sdn 1 ', 'Pria', NULL, NULL, '', 28, '201611111', '12345', 28, 1, 2015, 0, 23, 2, 0, 0),
(10, '0026202975', 'Ashari Suka Mustaqim', 'sdn 8 ', 'Pria', NULL, NULL, '', 27, '201511111', '12345', 27, 1, 2015, 0, 47, 2, 0, 1),
(11, '0025636059', 'Binno Marwa Supanco', 'sdn 1 coblong', 'Pria', NULL, NULL, '', 29, '1221111', '12345', 27, 1, 2015, 0, 48, 2, 0, 1),
(12, '0018422429', 'Candra Ade Rahayu', 'sdn 1 sukaasih', 'Wanita', NULL, NULL, '', 29, '11211111', '12345', 29, 1, 2015, 0, 17, 2, 0, 1),
(13, '0027563382', 'Dewi Banowati Arbaini', 'sdn 1 sukaluyu', 'Wanita', NULL, NULL, '', 28, '888181818', '12345', 28, 1, 2015, 0, 26, 2, 0, 1),
(14, '0024093616', 'Dinar Aqila', 'sdn II mekarsari', 'Wanita', NULL, NULL, '', 27, '717717771', '12345', 27, 1, 2015, 0, 49, 2, 0, 1),
(15, '0028678616', 'Elsya Saniayu', 'sdn 11 mekarwangi', 'Wanita', NULL, NULL, '', 29, '81881881881', '12345', 0, 0, 2015, 0, 67, 2, 0, 1),
(16, '0027292888', 'Fajriyanti Anna Ramadhani', 'sdn 1 cikutra', 'Wanita', NULL, NULL, '', 26, '77167771', '12345', 26, 1, 2015, 0, 58, 2, 0, 1),
(17, '002469234', 'Fasya Billa Suhendar', 'Sdn III Mekararum', 'Wanita', NULL, NULL, '', 26, '7717171771', '12345', 26, 1, 2015, 0, 59, 2, 0, 1),
(18, '0024487402', 'Faujiah Nur Sa''adah', 'sdn 1 bojongkoneng', 'Pria', NULL, NULL, '', 29, '111221111', '12345', 30, 1, 2015, 0, 2, 2, 0, 1),
(19, '0023275251', 'Handifa Cahayana', 'sdn 2 cikutra', 'Pria', NULL, NULL, '', 26, '81818818', '12345', 27, 1, 2015, 0, 50, 2, 0, 1),
(20, '0011225921', 'Helza Vivia Ramadhanty', 'sdn 1 sukaasih', 'Wanita', NULL, NULL, '', 28, '12888181881', '12345', 28, 1, 2015, 0, 34, 2, 0, 0),
(21, '001827206', 'Iwan Feroloy S', 'sdn 1 cikadut', 'Pria', NULL, NULL, '', 26, '661555151', '12345', 26, 1, 2015, 0, 61, 2, 0, 1),
(22, '002563082', 'Juwono Saputra', 'sdn 3 sadang serang', 'Pria', NULL, NULL, '', 27, '127771717', '12345', 27, 1, 2015, 0, 51, 2, 0, 1),
(23, '0015136809', 'Kinanti Salasabila Rahmannisya', 'sdn II cicadas', 'Wanita', NULL, NULL, '', 25, '21212222', '12345', 25, 1, 2015, 0, 65, 2, 0, 1),
(24, '0028635033', 'Yutika Khairunnisa', 'sdn 1 cicaheum', 'Wanita', NULL, NULL, '', 28, '27', '12345', 28, 1, 2015, 0, 36, 2, 0, 1),
(25, '001070783', 'Zahra Azkyia Nabila', 'sdn 1 sadang seramg', 'Wanita', NULL, NULL, '', 29, '8828282882', '12345', 29, 1, 2015, 0, 5, 2, 0, 1),
(26, '0023275258', 'Alexandra Gracey Zanetta  ', 'sdn 1 cikutra', 'Wanita', NULL, NULL, '', 29, '11221111', '12345', 29, 1, 2015, 0, 6, 2, 0, 1),
(27, '0027096056', 'Al-Fath Shohibulwafas', 'sdn 11 kiaracondong', 'Pria', NULL, NULL, '', 29, '11211111', '12345', 29, 1, 2015, 0, 7, 2, 0, 1),
(28, '0030195511', 'Damar Wulan Pitaloka', 'sdn 2 sekeloa', 'Wanita', NULL, NULL, '', 26, '717177171', '12345', 26, 1, 2015, 0, 63, 2, 0, 1),
(29, '0011728461', 'Deswiya Nurul Azzahra', 'sdn 1 cikudapateuh', 'Wanita', NULL, NULL, '', 29, '292929922', '12345', 29, 1, 2015, 0, 8, 2, 0, 1),
(30, '0028642250', 'Firlly Anggraeni Cahyaningrum', 'sdn 2 ciambuleuit', 'Wanita', NULL, NULL, '', 27, '212222222', '12345', 27, 1, 2015, 0, 55, 2, 0, 1),
(31, '0025496810', 'Ghina Kamilathinnajah', 'sdn 1 pahlawan', 'Wanita', NULL, NULL, '', 29, '71717177171', '12345', 29, 1, 2015, 0, 9, 2, 0, 1),
(32, '0028678586', 'Handika Priyadi', 'sdn 11 ', 'Pria', NULL, NULL, '', 30, '616166161616', '12345', 30, 1, 2015, 0, 1, 2, 0, 1),
(33, '0023512538', 'Irman Nugraha', 'sdn 1 bojongkoneng', 'Wanita', NULL, NULL, '', 29, '9191991991', '12345', 29, 1, 2015, 0, 10, 2, 0, 1),
(34, '0010421216', 'Karmelia Putri', 'sdn 2 bojongkoneng', 'Wanita', NULL, NULL, '', 30, '21112111', '12345', 30, 1, 2015, 0, 4, 2, 0, 1),
(35, '002353813', 'Krisna Adli Hafidz', 'sdn 1 haurmekar', 'Pria', NULL, NULL, '', 28, '81818818181', '12345', 28, 1, 2015, 0, 31, 2, 0, 1),
(36, '0019986745', 'Lina Kania Dewi', 'sdn 1 bojongkoneng', 'Wanita', NULL, NULL, '', 29, '1616161661', '12345', 29, 1, 2015, 0, 11, 2, 0, 1),
(37, '0023865809', 'Lyra Annisya Fasya', 'sdn 2 haurpancuh', 'Wanita', NULL, NULL, '', 30, '71717177111', '12345', 30, 1, 2015, 0, 3, 2, 0, 1),
(38, '0017054415', 'Muhammad Faza Dinan Hakim', 'sdn 1 sindanglaya', 'Pria', NULL, NULL, '', 29, '128881181', '12345', 29, 1, 2015, 0, 12, 2, 0, 1),
(39, '0015968544', 'Nur Annisa Noviyanti', 'sdn 1 sindanglaya', 'Wanita', NULL, NULL, '', 29, '1666161616', '12345', 29, 1, 2015, 0, 18, 2, 0, 1),
(40, '0012809783', 'Salsabilah Nurfadilah', 'sdn 1 haurpancuh', 'Wanita', NULL, NULL, '', 29, '128199191', '12345', 29, 1, 2015, 0, 13, 2, 0, 1),
(41, '0027677300', 'Seppyan Irawan', 'sdn 1 cikadut', 'Pria', NULL, NULL, '', 29, '1818818181', '12345', 29, 1, 2015, 0, 14, 2, 0, 1),
(42, '001142777', 'Sinta Desiyana', 'sdn 1 haurpancuh', 'Wanita', NULL, NULL, '', 29, '18281818', '12345', 29, 1, 2015, 0, 15, 2, 0, 1),
(43, '0025635483', 'Vedia Wanti Kusumah', 'sd II ciambuleuit', 'Wanita', NULL, NULL, '', 28, '8188188181', '12345', 28, 0, 2015, 0, 32, 2, 0, 1),
(44, '0021288578', 'Yunita Amdani', 'sdn 1 cikadut', 'Wanita', NULL, NULL, '', 28, '81818188111', '12345', 28, 1, 2015, 0, 27, 2, 0, 1),
(45, '0018430704', 'Zhahra Bebie Anggistie', 'sdn 11 ', 'Wanita', NULL, NULL, '', 27, '91919111', '12345', 27, 1, 2015, 0, 53, 2, 0, 1),
(46, '0027590844', 'Aiswarai Diva Aisha Salsabhila', 'sdn 2 sukaasih', 'Wanita', NULL, NULL, '', 28, '818111111', '12345', 28, 1, 2015, 0, 28, 2, 0, 1),
(47, '0017257897', 'Annisa Nur Fitriyani', 'sdn 1 cikadut', 'Wanita', NULL, NULL, '', 28, '211222', '12345', 28, 1, 2015, 0, 29, 2, 0, 1),
(48, '0025391447', 'Faris Amran Samudera', 'sdn 1 cikutra', 'Pria', NULL, NULL, '', 28, '18188181812', '12345', 27, 1, 2015, 0, 46, 2, 0, 1),
(49, '0022291410', 'Gaza Karim Amrulloh', 'sdn 1 mekawangi', 'Wanita', NULL, NULL, '', 29, '1818181111', '12345', 27, 1, 2015, 0, 45, 2, 0, 1),
(50, '0026985665', 'Muhammad Hilal Luthfi', 'sdn 1 cikutra', 'Pria', NULL, NULL, '', 29, '122211111', '12345', 29, 1, 2015, 0, 19, 2, 0, 1),
(51, '141507103', 'Silmi Nur Fadillah', 'sdn 1 dipatiukur', 'Wanita', NULL, NULL, '', 29, '2122222', '12345', 29, 1, 2015, 0, 16, 2, 0, 1),
(52, '0017054392', 'zalfa chelinda', 'sdn 1 coblong', 'Wanita', NULL, NULL, '', 26, '576568866', '12345', 26, 1, 2015, 0, 57, 2, 0, 1),
(53, '0010404788', 'Akbar fauzi', 'sdn 1 cicaheum', 'Pria', NULL, NULL, '', 27, '24368995', '12345', 27, 1, 2015, 0, 42, 2, 0, 1),
(54, '0022639848', 'Aldy dwi ananda', 'sdn 1 dipatiukur', 'Pria', NULL, NULL, '', 27, '65772266', '12345', 27, 1, 2015, 0, 41, 2, 0, 1),
(55, '0027959328', 'Anisa Rahmaita', 'sdn 1 cicaheum', 'Wanita', NULL, NULL, '', 28, '4753882522', '12345', 27, 1, 2015, 0, 39, 2, 0, 1),
(56, '00234470520', 'Arief Al Ghifari', 'sdn 2 cikutra', 'Pria', NULL, NULL, '', 29, '46757534', '12345', 27, 0, 2015, 0, 38, 2, 0, 1),
(57, '0022830138', 'Deni Rahmat Pratama', 'sdn 11 kiaracondong', 'Pria', NULL, NULL, '', 28, '53657855', '12345', 28, 1, 2015, 0, 33, 2, 0, 1),
(58, '0015643682', 'Fitri Dewi Lestari', 'sdn 1 sindanglaya', 'Wanita', NULL, NULL, '', 28, '476476587', '12345', 26, 0, 2015, 0, 62, 2, 0, 1),
(59, '002371629', 'Fadhil Muhammad', 'sdn 1 sukaluyu', 'Pria', NULL, NULL, '', 29, '365786950', '12345', 17, 1, 2015, 0, 66, 2, 0, 1),
(60, '0011225919', 'Syifa Fadiah Idzhni Nabilah', 'sdn 1 haurpancuh', 'Wanita', NULL, NULL, '', 28, '08929802', '12345', 28, 1, 2015, 0, 30, 2, 0, 1),
(61, '0019955095', 'Silpiyani', 'sdn II cicadas', 'Wanita', NULL, NULL, '', 29, '101002872', '12345', 29, 1, 2015, 0, 21, 2, 0, 1),
(62, '0010404367', 'Viana Anggraeni', 'sdn 2 bojongkoneng', 'Wanita', NULL, NULL, '', 26, '537620281', '12345', 26, 1, 2015, 0, 60, 2, 0, 1),
(63, '0027292579', 'Zulfah Safrani', 'sd', 'Wanita', NULL, NULL, '', 29, '287258270', '12345', 29, 1, 2015, 0, 22, 2, 0, 1),
(64, '0018393284', 'Aina Salsabila', 'sdn 2 ciambuleuit', 'Wanita', NULL, NULL, '', 28, '532829622', '12345', 28, 1, 2015, 0, 35, 2, 0, 1),
(65, '0023455909', 'Bintang Junianto', 'sdn 1 coblong', 'Pria', NULL, NULL, '', 29, '2452156890', '12345', 28, 1, 2015, 0, 37, 2, 0, 1),
(66, '0023455900', 'Arizal Muhammad', 'sdn 1 cikadut', 'Pria', NULL, NULL, '', 27, '452380902', '12345', 27, 1, 2015, 0, 43, 2, 0, 1),
(67, '0023455957', 'Cindy Pertiwi', 'sdn 1 cikutra', 'Wanita', NULL, NULL, '', 27, '0279372890', '12345', 27, 1, 2015, 0, 44, 2, 0, 1),
(68, '0018549352', 'Agus', 'sdn 1 cikutra', 'Pria', NULL, NULL, '', 26, '651090082', '12345', 25, 1, 2015, 0, 64, 2, 0, 1),
(69, '0016898027', 'Rizky Ramadhan', 'sdn 1 coblong', 'Pria', NULL, NULL, '', 29, '69202381o', '12345', 29, 1, 2015, 0, 20, 2, 0, 1),
(70, '0027292569', 'Siti Rika', 'sdn 1 haurpancuh', 'Wanita', NULL, NULL, '', 20, '693634933', '12345', 26, 1, 2015, 0, 56, 2, 0, 1),
(71, '2020202', 'Chilman', 'sdn 1 haurgeulis', 'Pria', NULL, NULL, '', 28, '222222', '12345', 0, 0, 2015, 0, 68, 2, 0, 1),
(72, '21212720', 'Nur Aldila Karunia', 'Sdn 1 Cikadut', 'Wanita', NULL, NULL, '', 27, '292929292', '12345', 27, 1, 2015, 0, 40, 2, 0, 1),
(73, '191919191', 'Nofia ', 'sdn 1 cikutra', 'Wanita', NULL, NULL, '', 28, '7777777', '12345', 27, 1, 2015, 0, 3, 2, 0, 1),
(74, '272727272', 'Chilman', 'sdn 1 margahayu', 'Pria', NULL, NULL, '', 27, '717171711', '12345', 27, 1, 2015, 0, 4, 2, 0, 1),
(75, '27122222', 'Ilham', 'sdn 2 antapani', 'Pria', NULL, NULL, '', 28, '18888181', '12345', 28, 1, 2015, 0, 1, 2, 0, 1),
(76, '2222222', 'Diah', 'sdn II ', 'Wanita', NULL, NULL, '', 28, '171771711', '12345', 28, 1, 2015, 0, 2, 2, 0, 1),
(77, '222222', 'aldila karunia', 'sdn 3 ', 'Wanita', NULL, NULL, '', 29, '19191991', '12345', 29, 1, 2016, 0, 1, 2, 0, 1),
(78, '22222`', 'aaaa', 'sdn 2', 'Pria', NULL, NULL, '', 89, '22222', '12345', 89, 1, 2011, 0, 1, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_tahun_ajaran`
--

CREATE TABLE IF NOT EXISTS `tr_tahun_ajaran` (
  `id_tahun_ajaran` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` smallint(4) DEFAULT NULL,
  `kelas` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `kuota` smallint(4) DEFAULT NULL,
  PRIMARY KEY (`id_tahun_ajaran`),
  UNIQUE KEY `TAHUN_AJARAN` (`tahun`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tr_tahun_ajaran`
--

INSERT INTO `tr_tahun_ajaran` (`id_tahun_ajaran`, `tahun`, `kelas`, `status`, `kuota`) VALUES
(6, 2010, 9, 1, 300);

--
-- Triggers `tr_tahun_ajaran`
--
DROP TRIGGER IF EXISTS `seleksi`;
DELIMITER //
CREATE TRIGGER `seleksi` BEFORE UPDATE ON `tr_tahun_ajaran`
 FOR EACH ROW BEGIN
     IF new.status = 2 THEN
	call p_lulus(old.kuota, old.tahun );
   
    ELSEIF new.status = 3 THEN
	call p_seleksi(old.tahun, 1, old.kelas );
   END IF;
    END
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
