-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 02 Sep 2016 pada 06.13
-- Versi Server: 5.5.50-0ubuntu0.14.04.1
-- Versi PHP: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `ci`
--
CREATE DATABASE IF NOT EXISTS `ci` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ci`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_groups`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `admin_groups`;
CREATE TABLE IF NOT EXISTS `admin_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `admin_groups`
--

INSERT INTO `admin_groups` (`id`, `name`, `description`) VALUES
(1, 'webmaster', 'Webmaster'),
(2, 'admin', 'Administrator'),
(5, 'staff', 'Staff');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_login_attempts`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `admin_login_attempts`;
CREATE TABLE IF NOT EXISTS `admin_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_users`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `admin_users`
--

INSERT INTO `admin_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES
(1, '127.0.0.1', 'webmaster', '$2y$08$/X5gzWjesYi78GqeAv5tA.dVGBVP7C1e1PzqnYCVe5s1qhlDIPPES', NULL, NULL, NULL, NULL, NULL, 'V.QwzR4e7nEDlaqhR7n07O', 1451900190, 1472707733, 1, 'Herman', NULL),
(2, '127.0.0.1', 'admin', '$2y$08$7Bkco6JXtC3Hu6g9ngLZDuHsFLvT7cyAxiz1FzxlX5vwccvRT7nKW', NULL, NULL, NULL, NULL, NULL, NULL, 1451900228, 1472443869, 1, 'Reva', ''),
(3, '127.0.0.1', 'panji', '$2y$08$USkhXxnlSTowPNbZ.EmJQeXUcw1Q9o.8YeeHBWNAdKE364buBwrMa', NULL, NULL, NULL, NULL, NULL, NULL, 1469104293, NULL, 1, 'Panji', NULL),
(4, '::1', 'rui', '$2y$08$VboZOAqGExwJ4jGNar3o1.UEFmVp4VicLy06nYrDRT0TMbb24nP5e', NULL, NULL, NULL, NULL, NULL, NULL, 1472442630, NULL, 1, 'rui', 'ill');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_users_groups`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `admin_users_groups`;
CREATE TABLE IF NOT EXISTS `admin_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `admin_users_groups`
--

INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(6, 3, 5),
(7, 4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_access`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `api_access`;
CREATE TABLE IF NOT EXISTS `api_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL DEFAULT '',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_keys`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `api_keys`;
CREATE TABLE IF NOT EXISTS `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'anonymous', 1, 1, 0, NULL, 1463388382);

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_limits`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `api_limits`;
CREATE TABLE IF NOT EXISTS `api_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_logs`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `api_logs`;
CREATE TABLE IF NOT EXISTS `api_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `demo_blog_categories`
--
-- Pembuatan: 19 Agu 2016 pada 00.20
--

DROP TABLE IF EXISTS `demo_blog_categories`;
CREATE TABLE IF NOT EXISTS `demo_blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `demo_blog_categories`
--

INSERT INTO `demo_blog_categories` (`id`, `pos`, `title`) VALUES
(1, 1, 'Category 1'),
(2, 2, 'Category 2'),
(3, 3, 'Category 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `demo_blog_posts`
--
-- Pembuatan: 19 Agu 2016 pada 00.20
--

DROP TABLE IF EXISTS `demo_blog_posts`;
CREATE TABLE IF NOT EXISTS `demo_blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '1',
  `author_id` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `content_brief` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `publish_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('draft','active','hidden') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `demo_blog_posts`
--

INSERT INTO `demo_blog_posts` (`id`, `category_id`, `author_id`, `title`, `image_url`, `content_brief`, `content`, `publish_time`, `status`) VALUES
(1, 1, 2, 'Blog Post 1', '', '<p>\r\n	Blog Post 1 Content Brief</p>\r\n', '<p>\r\n	Blog Post 1 Content</p>\r\n', '2015-09-25 17:00:00', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `demo_blog_posts_tags`
--
-- Pembuatan: 19 Agu 2016 pada 00.20
--

DROP TABLE IF EXISTS `demo_blog_posts_tags`;
CREATE TABLE IF NOT EXISTS `demo_blog_posts_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `demo_blog_posts_tags`
--

INSERT INTO `demo_blog_posts_tags` (`id`, `post_id`, `tag_id`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `demo_blog_tags`
--
-- Pembuatan: 19 Agu 2016 pada 00.20
--

DROP TABLE IF EXISTS `demo_blog_tags`;
CREATE TABLE IF NOT EXISTS `demo_blog_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `demo_blog_tags`
--

INSERT INTO `demo_blog_tags` (`id`, `title`) VALUES
(1, 'Tag 1'),
(2, 'Tag 2'),
(3, 'Tag 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `demo_cover_photos`
--
-- Pembuatan: 19 Agu 2016 pada 00.21
--

DROP TABLE IF EXISTS `demo_cover_photos`;
CREATE TABLE IF NOT EXISTS `demo_cover_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) NOT NULL DEFAULT '0',
  `image_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','hidden') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `demo_cover_photos`
--

INSERT INTO `demo_cover_photos` (`id`, `pos`, `image_url`, `status`) VALUES
(1, 2, '45296-2.jpg', 'active'),
(2, 1, '2934f-1.jpg', 'active'),
(3, 3, '3717d-3.jpg', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'members', 'General User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--
-- Pembuatan: 26 Agu 2016 pada 09.16
--

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `phone` char(12) DEFAULT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `first_name`, `last_name`, `alamat`, `phone`, `active`) VALUES
(1, 'join', 'jono', 'sasak', '081212332122', 0),
(2, 'ardi', 'irda', 'pamulang', '082212848292', 0),
(3, 'Panji', 'Eko yuniarso', 'pamulang', '02178667836', 0),
(4, 'karim', 'mimin', 'pamulang', '034235232', 0),
(5, 'jiji', 'njipnjip', 'pamulang', '02178667657', 1);

--
-- Trigger `karyawan`
--
DROP TRIGGER IF EXISTS `auk_active`;
DELIMITER //
CREATE TRIGGER `auk_active` AFTER UPDATE ON `karyawan`
 FOR EACH ROW BEGIN
IF NEW.active <> OLD.active THEN
	INSERT INTO log_absen SET tanggal = CURDATE(), karyawan_id = OLD.id, kehadiran = NEW.active, lastTimeUpdate = CURTIME(), countUpdate = 1 ON DUPLICATE KEY UPDATE kehadiran = NEW.active, lastTimeUpdate = CURTIME(), countUpdate = countUpdate + 1;
END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_absen`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `log_absen`;
CREATE TABLE IF NOT EXISTS `log_absen` (
  `tanggal` date NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `kehadiran` tinyint(1) NOT NULL,
  `lastTimeUpdate` time DEFAULT NULL,
  `countUpdate` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`tanggal`,`karyawan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_absen`
--

INSERT INTO `log_absen` (`tanggal`, `karyawan_id`, `kehadiran`, `lastTimeUpdate`, `countUpdate`) VALUES
('2016-05-11', 1, 1, NULL, 1),
('2016-05-12', 1, 1, NULL, 1),
('2016-05-12', 2, 1, NULL, 1),
('2016-05-12', 3, 0, NULL, 1),
('2016-05-12', 4, 1, NULL, 1),
('2016-05-12', 5, 1, NULL, 1),
('2016-05-16', 4, 1, NULL, 1),
('2016-05-16', 5, 0, NULL, 1),
('2016-05-19', 3, 0, NULL, 1),
('2016-05-19', 5, 0, NULL, 1),
('2016-05-24', 3, 1, NULL, 1),
('2016-05-24', 4, 0, NULL, 1),
('2016-05-24', 5, 0, NULL, 1),
('2016-05-24', 6, 0, NULL, 1),
('2016-05-25', 5, 1, NULL, 1),
('2016-05-27', 1, 1, '22:22:55', 2),
('2016-05-27', 2, 0, NULL, 1),
('2016-05-27', 4, 1, NULL, 1),
('2016-05-27', 5, 1, '22:20:32', 3),
('2016-05-31', 1, 1, '11:03:24', 2),
('2016-05-31', 4, 0, '10:38:23', 1),
('2016-05-31', 5, 1, '11:02:59', 2),
('2016-06-01', 1, 1, '16:10:14', 4),
('2016-06-01', 2, 1, '16:10:12', 3),
('2016-06-01', 3, 1, '13:26:30', 6),
('2016-06-01', 4, 1, '11:05:40', 3),
('2016-06-01', 5, 1, '11:05:36', 2),
('2016-06-03', 5, 0, '21:13:47', 1),
('2016-06-04', 1, 0, '13:28:01', 1),
('2016-06-07', 1, 1, '13:08:09', 1),
('2016-06-07', 2, 1, '07:31:34', 2),
('2016-06-07', 4, 0, '07:31:29', 1),
('2016-06-07', 5, 1, '13:52:14', 3),
('2016-06-13', 2, 0, '14:40:53', 1),
('2016-06-18', 2, 1, '11:38:19', 1),
('2016-06-18', 4, 1, '11:38:14', 1),
('2016-07-17', 1, 1, '13:59:28', 4),
('2016-08-04', 1, 1, '14:34:10', 2),
('2016-08-04', 2, 0, '14:16:40', 1),
('2016-08-04', 3, 0, '14:16:46', 1),
('2016-08-04', 5, 1, '14:34:18', 2),
('2016-08-05', 2, 1, '23:01:22', 1),
('2016-08-05', 3, 1, '23:01:20', 1),
('2016-08-08', 1, 0, '10:31:25', 1),
('2016-08-08', 3, 0, '10:31:30', 1),
('2016-08-19', 1, 1, '07:00:00', 1),
('2016-08-19', 3, 1, '06:59:58', 1),
('2016-08-25', 1, 0, '19:19:21', 1),
('2016-08-25', 2, 0, '19:19:24', 1),
('2016-08-26', 1, 1, '06:35:44', 1),
('2016-08-26', 2, 1, '06:35:48', 1),
('2016-09-01', 1, 0, '12:29:22', 1),
('2016-09-01', 2, 0, '12:29:20', 1),
('2016-09-01', 3, 0, '12:29:17', 1),
('2016-09-01', 4, 0, '12:29:14', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_parent` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `name`, `link`, `icon`, `is_active`, `is_parent`) VALUES
(0, 'fasfa', 'sfafa', 'gsd', 0, 21),
(15, 'menu management', 'menu', 'fa fa-list-alt', 1, 0),
(16, 'data siswa', 'siswa', 'fa fa-graduation-cap', 1, 18),
(17, 'data jurusan', 'jurusan', 'fa fa-list-alt', 1, 15),
(18, 'hooh', '#', 'fa fa-list-altfas', 1, 15),
(30, 'fasfsafds', 'fasfafa', 'gsd', 0, 0),
(31, 'fsafafax', 'asda', 'gsd', 0, 0),
(32, 'fas', 'ada', 'sg', 0, 0),
(33, 'fasfaxc', 'fasfa', 'gsd', 0, 0),
(35, 'sa', 'asfa', 'sdggsd', 1, 34),
(36, 'mhgf', 'f mm', 'gsd', 1, 17),
(37, 'hgh', 'hdfh', 'gsd', 1, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  `phone` char(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `phone`, `email`) VALUES
(1, 'SDN Pamulang III', '0217866783', 'sdnpamulang3@sdn.id'),
(2, 'Gilang', '081257392321', 'gilang@gmail.com'),
(7, 'njip njip', '081319026682', 'panjieko.pey@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanans`
--
-- Pembuatan: 31 Agu 2016 pada 10.45
--

DROP TABLE IF EXISTS `pemesanans`;
CREATE TABLE IF NOT EXISTS `pemesanans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pesanan` varchar(5) NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `tgl_pengambilan` date DEFAULT NULL,
  `jenis` varchar(100) NOT NULL,
  `jumlah` int(2) NOT NULL,
  `keterangan` text,
  `image_url` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('proses','selesai & belum lunas','selesai & lunas') NOT NULL DEFAULT 'proses',
  `pelanggan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kd_pemesanan` (`kode_pesanan`),
  KEY `id_pelanggan` (`pelanggan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data untuk tabel `pemesanans`
--

INSERT INTO `pemesanans` (`id`, `kode_pesanan`, `tgl_pemesanan`, `tgl_pengambilan`, `jenis`, `jumlah`, `keterangan`, `image_url`, `status`, `pelanggan_id`) VALUES
(1, 'PS001', '2016-05-02', '2016-05-26', 'SERAGAM PRAMUKA', 3, NULL, NULL, 'selesai & lunas', 1),
(11, 'PS002', '2016-05-07', '2016-05-19', 'SERAGAM SEKOLAH', 3, 'safasfa\r\n', NULL, 'selesai & lunas', 2),
(13, 'PS003', '2016-05-08', '2016-06-21', 'KEBAYA', 9, 'modelnya kayak begini ya\r\n', '4c197-_.png', 'selesai & belum lunas', 2),
(14, 'PS004', '2016-05-31', '2016-06-15', 'SERAGAM OLAHRAGA', 6, NULL, NULL, 'selesai & belum lunas', 1),
(15, 'PS005', '2016-06-07', '2016-06-15', 'BATIK', 7, 'serssr', NULL, 'selesai & belum lunas', 2),
(16, 'PS006', '2016-06-13', '2016-09-12', 'TES', 12, 'tes pemesanan', NULL, 'proses', 1),
(17, 'PS007', '2016-06-29', '2016-08-30', 'SERAGAM KANTOR', 12, 'yihuy', NULL, 'selesai & belum lunas', 2);

--
-- Trigger `pemesanans`
--
DROP TRIGGER IF EXISTS `ai_p`;
DELIMITER //
CREATE TRIGGER `ai_p` AFTER INSERT ON `pemesanans`
 FOR EACH ROW BEGIN
    INSERT INTO pemesanan_biaya SET pemesanan_id = NEW.id;
  END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_bahanBaku`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `pemesanan_bahanBaku`;
CREATE TABLE IF NOT EXISTS `pemesanan_bahanBaku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_item` varchar(50) NOT NULL,
  `qty` int(2) NOT NULL,
  `N_biaya` decimal(12,0) DEFAULT '0',
  `pemesanan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kd_pemesanan` (`pemesanan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `pemesanan_bahanBaku`
--

INSERT INTO `pemesanan_bahanBaku` (`id`, `nama_item`, `qty`, `N_biaya`, `pemesanan_id`) VALUES
(1, 'fafas', 1, 30000, 1),
(5, 'LOLOP', 1, 40000, 11),
(10, 'CJS', 13, 70000, 13),
(12, 'df', 4, 110000, 13),
(13, 'A', 1, 10000, 14),
(14, 'fasfa', 1, 8000, 14),
(15, 'gsdgsg', 3, 30000, 15),
(16, 'x', 1, 300000, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_biaya`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `pemesanan_biaya`;
CREATE TABLE IF NOT EXISTS `pemesanan_biaya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `N_biaya_tambahan` decimal(12,0) DEFAULT '0',
  `pemesanan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pemesanan_id` (`pemesanan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- RELASI UNTUK TABEL `pemesanan_biaya`:
--   `pemesanan_id`
--       `pemesanans` -> `id`
--

--
-- Dumping data untuk tabel `pemesanan_biaya`
--

INSERT INTO `pemesanan_biaya` (`id`, `N_biaya_tambahan`, `pemesanan_id`) VALUES
(1, 10000, 1),
(11, 50000, 11),
(13, 300000, 13),
(14, 20000, 14),
(15, 250000, 15),
(16, 0, 16),
(17, 100000, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_transaksi`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `pemesanan_transaksi`;
CREATE TABLE IF NOT EXISTS `pemesanan_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` date NOT NULL,
  `N_nominal` decimal(12,0) NOT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `pemesanan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pemesanan` (`pemesanan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data untuk tabel `pemesanan_transaksi`
--

INSERT INTO `pemesanan_transaksi` (`id`, `tgl_transaksi`, `N_nominal`, `keterangan`, `pemesanan_id`) VALUES
(1, '2016-05-09', 10000, 'safsasfaf', 1),
(2, '2016-05-08', 129000, 'LUNAS YEEEEE...', 1),
(3, '2016-05-08', 20000, NULL, 11),
(4, '2016-05-08', 80000, NULL, 11),
(5, '2016-05-08', 80000, NULL, 11),
(6, '2016-05-08', 310000, 'DP', 13),
(16, '2016-05-09', 150000, NULL, 13),
(17, '2016-05-10', 10000, NULL, 11),
(18, '2016-05-14', 50000, NULL, 11),
(19, '2016-05-14', 180000, NULL, 16),
(33, '2016-05-14', 5000, NULL, 13),
(34, '2016-05-31', 70000, 'DP', 14),
(38, '2016-05-31', 100000, 'TESTESSSSSs', 13),
(39, '2016-06-07', 400000, NULL, 15),
(40, '2016-08-27', 45000, NULL, 11),
(41, '2016-09-01', 200000, NULL, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `produksi`;
CREATE TABLE IF NOT EXISTS `produksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_produksi` date NOT NULL,
  `keterangan` text,
  `upah_kerja` decimal(12,0) NOT NULL DEFAULT '0',
  `pemesanan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kd_produksi` (`tgl_produksi`,`pemesanan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id`, `tgl_produksi`, `keterangan`, `upah_kerja`, `pemesanan_id`) VALUES
(14, '2016-05-07', NULL, 19000, 1),
(23, '2016-05-08', NULL, 65000, 11),
(40, '2016-05-10', 'fasfa', 20000, 13),
(60, '2016-05-31', 'TESSSSS', 15000, 13),
(61, '2016-06-04', 'jojo', 70000, 13),
(63, '2016-06-04', 'sadasda', 70000, 14),
(64, '2016-06-07', NULL, 42342, 15),
(65, '2016-06-29', NULL, 70000, 17),
(66, '2016-07-29', 'coba hari ini ah', 120000, 16),
(67, '2016-08-26', '\r\n', 40000, 17),
(69, '2016-08-26', 'ahay', 6666, 14);

--
-- Trigger `produksi`
--
DROP TRIGGER IF EXISTS `auuk_pr`;
DELIMITER //
CREATE TRIGGER `auuk_pr` AFTER UPDATE ON `produksi`
 FOR EACH ROW BEGIN
IF NEW.upah_kerja <> OLD.upah_kerja THEN
  UPDATE produksi_detail SET N_upah = (selesai * NEW.upah_kerja) WHERE produksi_id = OLD.id;
END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi_detail`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `produksi_detail`;
CREATE TABLE IF NOT EXISTS `produksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produksi_id` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `selesai` tinyint(2) DEFAULT NULL,
  `N_upah` decimal(12,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data untuk tabel `produksi_detail`
--

INSERT INTO `produksi_detail` (`id`, `produksi_id`, `karyawan_id`, `selesai`, `N_upah`) VALUES
(2, 14, 4, 1, 80000),
(3, 14, 2, 1, 18000),
(4, 23, 5, 1, 65000),
(5, 23, 4, 1, 65000),
(6, 23, 2, 1, 65000),
(7, 40, 3, 2, 50000),
(11, 14, 3, 1, 1000),
(12, 40, 5, 1, 1200),
(21, 60, 5, 1, 20000),
(22, 60, 1, 1, 15000),
(25, 60, 2, 2, 30000),
(27, 61, 4, 1, 70000),
(28, 63, 3, 3, 210000),
(29, 64, 2, 2, 84684),
(30, 64, 3, 5, 211710),
(31, 65, 1, 2, 140000),
(32, 65, 2, 1, 70000),
(33, 65, 3, 1, 70000),
(34, 65, 4, 2, 140000),
(35, 61, 3, 1, 70000),
(36, 66, 3, 2, 240000),
(37, 66, 5, 1, 120000),
(38, 67, 2, 1, 40000),
(41, 69, 1, 2, 13332),
(42, 69, 2, 1, 6666),
(43, 67, 1, 1, 40000),
(44, 67, 3, 2, 80000),
(46, 67, 5, 1, 40000),
(47, 67, 4, 1, 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'member', '$2y$08$kkqUE2hrqAJtg.pPnAhvL.1iE7LIujK5LZ61arONLpaBBWh/ek61G', NULL, 'member@member.com', NULL, NULL, NULL, NULL, 1451903855, 1471661424, 1, 'Member', 'One', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--
-- Pembuatan: 22 Jul 2016 pada 18.26
--

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vap_today`
--
DROP VIEW IF EXISTS `vap_today`;
CREATE TABLE IF NOT EXISTS `vap_today` (
`id` int(11)
,`karyawan_id` int(11)
,`tgl_produksi` date
,`pemesanan_id` int(11)
,`selesai` tinyint(2)
,`N_upah` decimal(12,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vbiaya_jasa_karyawan`
--
DROP VIEW IF EXISTS `vbiaya_jasa_karyawan`;
CREATE TABLE IF NOT EXISTS `vbiaya_jasa_karyawan` (
`p_id` int(11)
,`karyawan_id` int(11)
,`jml_selesai` decimal(25,0)
,`N_bupah` decimal(34,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vpemesanan`
--
DROP VIEW IF EXISTS `vpemesanan`;
CREATE TABLE IF NOT EXISTS `vpemesanan` (
`id` int(11)
,`kode_pesanan` varchar(5)
,`tgl_pemesanan` date
,`tgl_pengambilan` date
,`limit_hari` int(7)
,`jenis` varchar(100)
,`jumlah` int(2)
,`selesai` decimal(47,0)
,`N_ttlBiaya` decimal(65,0)
,`N_jmlTransaksi` decimal(34,0)
,`N_sisa_bayar` decimal(65,0)
,`keterangan` text
,`status` enum('proses','selesai & belum lunas','selesai & lunas')
,`image_url` varchar(300)
,`pelanggan_id` int(11)
,`prosentase` varchar(53)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vpemesanan2`
--
DROP VIEW IF EXISTS `vpemesanan2`;
CREATE TABLE IF NOT EXISTS `vpemesanan2` (
`id` int(11)
,`kode_pesanan` varchar(5)
,`tgl_pemesanan` date
,`tgl_pengambilan` date
,`jenis` varchar(100)
,`jumlah` int(2)
,`selesai` decimal(47,0)
,`N_ttlBiaya` decimal(65,0)
,`N_jmlTransaksi` decimal(34,0)
,`keterangan` text
,`status` enum('proses','selesai & belum lunas','selesai & lunas')
,`image_url` varchar(300)
,`pelanggan_id` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vpemesanan_biaya`
--
DROP VIEW IF EXISTS `vpemesanan_biaya`;
CREATE TABLE IF NOT EXISTS `vpemesanan_biaya` (
`id` int(11)
,`N_biaya_bhnbaku` decimal(34,0)
,`N_biaya_jasa` decimal(56,0)
,`N_biaya_tambahan` decimal(12,0)
,`pemesanan_id` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vproduksi`
--
DROP VIEW IF EXISTS `vproduksi`;
CREATE TABLE IF NOT EXISTS `vproduksi` (
`id` int(11)
,`tgl_produksi` date
,`keterangan` text
,`jml_selesai` decimal(25,0)
,`N_upah` decimal(34,0)
,`pemesanan_id` int(11)
);
-- --------------------------------------------------------

--
-- Struktur untuk view `vap_today`
--
DROP TABLE IF EXISTS `vap_today`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vap_today` AS select `prdtl`.`produksi_id` AS `id`,`prdtl`.`karyawan_id` AS `karyawan_id`,`pr`.`tgl_produksi` AS `tgl_produksi`,`pr`.`pemesanan_id` AS `pemesanan_id`,`prdtl`.`selesai` AS `selesai`,`prdtl`.`N_upah` AS `N_upah` from (`produksi` `pr` left join `produksi_detail` `prdtl` on((`pr`.`id` = `prdtl`.`produksi_id`))) order by `pr`.`tgl_produksi`;

-- --------------------------------------------------------

--
-- Struktur untuk view `vbiaya_jasa_karyawan`
--
DROP TABLE IF EXISTS `vbiaya_jasa_karyawan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vbiaya_jasa_karyawan` AS select distinct `p`.`id` AS `p_id`,`prdtl`.`karyawan_id` AS `karyawan_id`,(select sum(`prdtl`.`selesai`) AS `jml_selesai` from (`produksi_detail` `prdtl` join `produksi` `pr`) where ((`prdtl`.`karyawan_id` = `k`.`id`) and (`prdtl`.`produksi_id` = `pr`.`id`) and (`pr`.`pemesanan_id` = `p`.`id`))) AS `jml_selesai`,(select sum(`prdtl`.`N_upah`) AS `N_upah` from (`produksi_detail` `prdtl` join `produksi` `pr`) where ((`prdtl`.`karyawan_id` = `k`.`id`) and (`prdtl`.`produksi_id` = `pr`.`id`) and (`pr`.`pemesanan_id` = `p`.`id`))) AS `N_bupah` from (((`karyawan` `k` left join `produksi_detail` `prdtl` on((`k`.`id` = `prdtl`.`karyawan_id`))) left join `produksi` `pr` on((`pr`.`id` = `prdtl`.`produksi_id`))) left join `pemesanans` `p` on((`p`.`id` = `pr`.`pemesanan_id`))) order by `p`.`id`;

-- --------------------------------------------------------

--
-- Struktur untuk view `vpemesanan`
--
DROP TABLE IF EXISTS `vpemesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vpemesanan` AS select `p`.`id` AS `id`,`p`.`kode_pesanan` AS `kode_pesanan`,`p`.`tgl_pemesanan` AS `tgl_pemesanan`,`p`.`tgl_pengambilan` AS `tgl_pengambilan`,(to_days(`p`.`tgl_pengambilan`) - to_days(from_unixtime(unix_timestamp()))) AS `limit_hari`,`p`.`jenis` AS `jenis`,`p`.`jumlah` AS `jumlah`,(select sum(`vpr`.`jml_selesai`) from `vproduksi` `vpr` where (`vpr`.`pemesanan_id` = `p`.`id`)) AS `selesai`,(select sum(((`vpb`.`N_biaya_bhnbaku` + `vpb`.`N_biaya_jasa`) + `vpb`.`N_biaya_tambahan`)) from `vpemesanan_biaya` `vpb` where (`vpb`.`pemesanan_id` = `p`.`id`)) AS `N_ttlBiaya`,(select sum(`pemesanan_transaksi`.`N_nominal`) from `pemesanan_transaksi` where (`pemesanan_transaksi`.`pemesanan_id` = `p`.`id`)) AS `N_jmlTransaksi`,((select sum(((`vpb`.`N_biaya_bhnbaku` + `vpb`.`N_biaya_jasa`) + `vpb`.`N_biaya_tambahan`)) from `vpemesanan_biaya` `vpb` where (`vpb`.`pemesanan_id` = `p`.`id`)) - (select sum(`pemesanan_transaksi`.`N_nominal`) from `pemesanan_transaksi` where (`pemesanan_transaksi`.`pemesanan_id` = `p`.`id`))) AS `N_sisa_bayar`,`p`.`keterangan` AS `keterangan`,`p`.`status` AS `status`,`p`.`image_url` AS `image_url`,`p`.`pelanggan_id` AS `pelanggan_id`,if(isnull(concat(round(((if(isnull((select sum(`vpr`.`jml_selesai`) from `vproduksi` `vpr` where (`vpr`.`pemesanan_id` = `p`.`id`))),0,(select sum(`vpr`.`jml_selesai`) from `vproduksi` `vpr` where (`vpr`.`pemesanan_id` = `p`.`id`))) / `p`.`jumlah`) * 100),0),'%')),'0%',concat(round(((if(isnull((select sum(`vpr`.`jml_selesai`) from `vproduksi` `vpr` where (`vpr`.`pemesanan_id` = `p`.`id`))),0,(select sum(`vpr`.`jml_selesai`) from `vproduksi` `vpr` where (`vpr`.`pemesanan_id` = `p`.`id`))) / `p`.`jumlah`) * 100),0),'%')) AS `prosentase` from `pemesanans` `p`;

-- --------------------------------------------------------

--
-- Struktur untuk view `vpemesanan2`
--
DROP TABLE IF EXISTS `vpemesanan2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vpemesanan2` AS select `p`.`id` AS `id`,`p`.`kode_pesanan` AS `kode_pesanan`,`p`.`tgl_pemesanan` AS `tgl_pemesanan`,`p`.`tgl_pengambilan` AS `tgl_pengambilan`,`p`.`jenis` AS `jenis`,`p`.`jumlah` AS `jumlah`,(select sum(`vpr`.`jml_selesai`) from `vproduksi` `vpr` where (`vpr`.`pemesanan_id` = `p`.`id`)) AS `selesai`,(select sum((((select sum(`pbb`.`N_biaya`) AS `N_biaya_bhnbaku` from `pemesanan_bahanBaku` `pbb` where (`pbb`.`pemesanan_id` = `p`.`id`)) + (select sum(`vpr2`.`N_upah`) AS `N_biaya_jasa` from `vproduksi` `vpr2` where (`vpr2`.`pemesanan_id` = `p`.`id`))) + `pb`.`N_biaya_tambahan`)) from `pemesanan_biaya` `pb` where (`pb`.`pemesanan_id` = `p`.`id`)) AS `N_ttlBiaya`,(select sum(`pemesanan_transaksi`.`N_nominal`) from `pemesanan_transaksi` where (`pemesanan_transaksi`.`pemesanan_id` = `p`.`id`)) AS `N_jmlTransaksi`,`p`.`keterangan` AS `keterangan`,`p`.`status` AS `status`,`p`.`image_url` AS `image_url`,`p`.`pelanggan_id` AS `pelanggan_id` from `pemesanans` `p`;

-- --------------------------------------------------------

--
-- Struktur untuk view `vpemesanan_biaya`
--
DROP TABLE IF EXISTS `vpemesanan_biaya`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vpemesanan_biaya` AS select `pb`.`id` AS `id`,(select sum(`pbb`.`N_biaya`) from `pemesanan_bahanBaku` `pbb` where (`pbb`.`pemesanan_id` = `pb`.`pemesanan_id`)) AS `N_biaya_bhnbaku`,(select sum(`vpr`.`N_upah`) from `vproduksi` `vpr` where (`vpr`.`pemesanan_id` = `pb`.`pemesanan_id`)) AS `N_biaya_jasa`,`pb`.`N_biaya_tambahan` AS `N_biaya_tambahan`,`pb`.`pemesanan_id` AS `pemesanan_id` from `pemesanan_biaya` `pb` where 1;

-- --------------------------------------------------------

--
-- Struktur untuk view `vproduksi`
--
DROP TABLE IF EXISTS `vproduksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vproduksi` AS select `pr`.`id` AS `id`,`pr`.`tgl_produksi` AS `tgl_produksi`,`pr`.`keterangan` AS `keterangan`,(select sum(`prdtl`.`selesai`) AS `jml_selesai` from `produksi_detail` `prdtl` where (`prdtl`.`produksi_id` = `pr`.`id`)) AS `jml_selesai`,(select sum(`prdtl`.`N_upah`) AS `N_upah` from `produksi_detail` `prdtl` where (`prdtl`.`produksi_id` = `pr`.`id`)) AS `N_upah`,`pr`.`pemesanan_id` AS `pemesanan_id` from `produksi` `pr`;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemesanan_biaya`
--
ALTER TABLE `pemesanan_biaya`
  ADD CONSTRAINT `pemesanan_biaya_ibfk_1` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
