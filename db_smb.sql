-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_smb
DROP DATABASE IF EXISTS `db_smb`;
CREATE DATABASE IF NOT EXISTS `db_smb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_smb`;

-- Dumping structure for table db_smb.detail_nota
DROP TABLE IF EXISTS `detail_nota`;
CREATE TABLE IF NOT EXISTS `detail_nota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_nota` text DEFAULT NULL,
  `barang` text DEFAULT NULL,
  `jumlah` int(11) DEFAULT 0,
  `jumlah_dibayar` int(11) DEFAULT 0,
  `harga` int(11) DEFAULT 0,
  `dibayar` int(11) DEFAULT 0,
  `kekurangan` int(11) DEFAULT 0,
  `subtotal` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table db_smb.detail_nota: ~2 rows (approximately)
DELETE FROM `detail_nota`;
/*!40000 ALTER TABLE `detail_nota` DISABLE KEYS */;
INSERT INTO `detail_nota` (`id`, `kode_nota`, `barang`, `jumlah`, `jumlah_dibayar`, `harga`, `dibayar`, `kekurangan`, `subtotal`) VALUES
	(22, 'N071019-0002', 'jilbab', 3, 3, 20000, 60000, 0, 60000),
	(23, 'N071019-0002', 'sarung', 4, 4, 1000, 4000, 0, 4000);
/*!40000 ALTER TABLE `detail_nota` ENABLE KEYS */;

-- Dumping structure for table db_smb.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_smb.migrations: ~2 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table db_smb.nota
DROP TABLE IF EXISTS `nota`;
CREATE TABLE IF NOT EXISTS `nota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` text DEFAULT NULL,
  `total` int(11) DEFAULT 0,
  `dibayar` int(11) DEFAULT 0,
  `kekurangan` int(11) DEFAULT 0,
  `pembeli` int(11) DEFAULT NULL,
  `pembuat` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `status` enum('lunas','belum lunas','pengajuan') DEFAULT 'pengajuan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_smb.nota: ~1 rows (approximately)
DELETE FROM `nota`;
/*!40000 ALTER TABLE `nota` DISABLE KEYS */;
INSERT INTO `nota` (`id`, `kode`, `total`, `dibayar`, `kekurangan`, `pembeli`, `pembuat`, `tgl`, `status`) VALUES
	(5, 'N071019-0002', 64000, 64000, 0, 6, 'admin', '2019-10-07', 'lunas');
/*!40000 ALTER TABLE `nota` ENABLE KEYS */;

-- Dumping structure for table db_smb.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_smb.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table db_smb.pengajuan
DROP TABLE IF EXISTS `pengajuan`;
CREATE TABLE IF NOT EXISTS `pengajuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pembeli` int(11) DEFAULT NULL,
  `status` enum('retur','cancel','update stok') DEFAULT 'update stok',
  `keterangan` text DEFAULT NULL,
  `kode_nota` varchar(50) DEFAULT NULL,
  `kode_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `admin` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `dibaca` enum('Y','N') DEFAULT 'N',
  `konfirmasi` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table db_smb.pengajuan: ~0 rows (approximately)
DELETE FROM `pengajuan`;
/*!40000 ALTER TABLE `pengajuan` DISABLE KEYS */;
INSERT INTO `pengajuan` (`id`, `pembeli`, `status`, `keterangan`, `kode_nota`, `kode_barang`, `jumlah`, `admin`, `tgl`, `jam`, `dibaca`, `konfirmasi`) VALUES
	(6, 6, 'update stok', 'asdfasdf', NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N');
/*!40000 ALTER TABLE `pengajuan` ENABLE KEYS */;

-- Dumping structure for table db_smb.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('admin','super admin','pengguna') COLLATE utf8mb4_unicode_ci DEFAULT 'pengguna',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notelp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_smb.users: ~4 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `level`, `email`, `notelp`, `alamat`, `password`, `remember_token`) VALUES
	(1, 'superadmin', 'superadmin', 'super admin', 'satriosuklun@gmail.com', NULL, NULL, '$2y$10$qPBQvj.D90dK5vUG1MrrSuSkV8pp4UJqsivmw7NsG4S6MaukZrDuC', NULL),
	(6, 'jono', 'jono', 'pengguna', NULL, '14045', 'gurah, kediri', '$2y$10$dwRpaO/RLdHLSsTyW2MxM.F.CyEPWVBMpf6vPrkyule.EZZHifza.', NULL),
	(7, 'admin', 'admin', 'admin', 'asklf@gmail.com', NULL, NULL, '$2y$10$helPBE6kAu.gTN/ADx5yzOlTlSyTFxKyhi4xZxohvBiY8DAMTyAwK', NULL),
	(8, 'joni', 'joni', 'pengguna', NULL, '209384902', 'akslfj', '$2y$10$I51ZJk431NXyUrBkClBlyezAxaekbkyoqQwznlIhU9pcetNUnjj4.', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for trigger db_smb.nota_before_delete
DROP TRIGGER IF EXISTS `nota_before_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `nota_before_delete` BEFORE DELETE ON `nota` FOR EACH ROW BEGIN
delete from detail_nota where detail_nota.kode_nota = old.kode;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
