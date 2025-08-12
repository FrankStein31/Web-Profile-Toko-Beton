/*
SQLyog Enterprise
MySQL - 8.0.30 : Database - beton_profile
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`beton_profile` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `beton_profile`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` enum('super_admin','admin') DEFAULT 'admin',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`,`nama_lengkap`,`email`,`level`,`last_login`,`created_at`,`updated_at`) values 
(1,'admin','$2y$12$snLd.kqqLzuLAGMIylAQZOnlpIdu9qOPj4t.bWpMtK4odMBumo7AS','Administrator','admin@turenindahbangunan.com','super_admin','2025-08-12 10:21:14','2025-08-11 19:01:44','2025-08-12 10:21:14');

/*Table structure for table `berita` */

DROP TABLE IF EXISTS `berita`;

CREATE TABLE `berita` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text,
  `konten` longtext,
  `tags` varchar(500) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `link_website` varchar(500) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `tanggal_publikasi` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `berita` */

insert  into `berita`(`id`,`judul`,`slug`,`deskripsi`,`konten`,`tags`,`gambar`,`link_website`,`status`,`tanggal_publikasi`,`created_at`,`updated_at`) values 
(1,'Tips Memilih Beton Berkualitas','tips-memilih-beton-berkualitas','Panduan lengkap memilih beton berkualitas untuk konstruksi yang tahan lama','<p>Memilih beton berkualitas adalah hal yang sangat penting dalam konstruksi bangunan. Berikut adalah tips-tips yang perlu Anda perhatikan:</p>\r\n\r\n<h3>1. Perhatikan Komposisi Material</h3>\r\n\r\n<p>Pastikan komposisi semen, pasir, kerikil, dan air sesuai dengan standar yang berlaku.</p>\r\n\r\n<h3>2. Cek Sertifikat Mutu</h3>\r\n\r\n<p>Pilih supplier yang memiliki sertifikat mutu dari lembaga yang terpercaya.</p>\r\n\r\n<h3>3. Perhatikan Kuat Tekan</h3>\r\n\r\n<p>Sesuaikan kuat tekan beton dengan kebutuhan konstruksi Anda.</p>\r\n','beton, konstruksi, tips, kualitas','1754966585_689aaa39161a6.jpg','https://www.turenindahbangunan.com/nippon-paint-terdekat-di-turen-indah-bangunan/','nonaktif','2025-08-12 09:08:00','2025-08-12 09:08:31','2025-08-12 09:56:42'),
(2,'Inovasi Terbaru dalam Teknologi Beton','inovasi-terbaru-dalam-teknologi-beton','Mengenal teknologi terbaru dalam industri beton yang ramah lingkungan','<p>Industri beton terus berkembang dengan berbagai inovasi teknologi terbaru yang lebih ramah lingkungan dan efisien.</p>\r\n\r\n<h3><strong>Green Concrete</strong></h3>\r\n\r\n<p>Beton hijau menggunakan material daur ulang dan mengurangi emisi karbon.</p>\r\n\r\n<h3>Self-Healing Concrete</h3>\r\n\r\n<p>Teknologi beton yang dapat memperbaiki retakan secara otomatis.</p>\r\n','inovasi, teknologi, beton hijau, ramah lingkungan','1754966707_689aaab394518.jpg','https://www.turenindahbangunan.com/jual-cat-avian-di-malang-di-turen-indah-bangunan/','aktif','2025-08-12 09:08:00','2025-08-12 09:08:31','2025-08-12 09:45:07'),
(3,'Perawatan Struktur Beton yang Benar','perawatan-struktur-beton-yang-benar','Cara merawat struktur beton agar awet dan tahan lama','<p>Perawatan yang tepat dapat memperpanjang umur struktur beton hingga puluhan tahun.</p>\r\n\r\n<h3>Pembersihan Rutin</h3>\r\n\r\n<p>Bersihkan kotoran dan debu secara rutin untuk mencegah kerusakan permukaan.</p>\r\n\r\n<h3>Pelapisan Pelindung</h3>\r\n\r\n<p>Gunakan coating pelindung untuk melindungi dari cuaca ekstrem.</p>\r\n','perawatan, beton, maintenance, konstruksi','1754966606_689aaa4e81335.jpg','https://www.turenindahbangunan.com/jual-paving-grass-block-terdekat-di-turen-indah-bangunan-malang/','aktif','2025-08-12 09:08:00','2025-08-12 09:08:31','2025-08-12 09:43:26'),
(7,'coba coba coba','coba-coba-coba','coba','<p><strong>Ini coba</strong></p>\r\n\r\n<p>ini isi berita</p>\r\n\r\n<p><em>Ini link github saya :&nbsp;</em></p>\r\n\r\n<p>https://github.com/FrankStein31/</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Saya Frankie Steinlie</p>\r\n\r\n<ol>\r\n	<li>coba</li>\r\n	<li>lagi</li>\r\n</ol>\r\n\r\n<p><strong>Terima Kasih</strong></p>\r\n','Coba, frankie, steinlie, github, link','1754967519_689aaddfdd80c.jpg','https://github.com/FrankStein31/','aktif','2025-08-12 09:57:00','2025-08-12 09:58:39','2025-08-12 10:24:06');

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `kategori` */

insert  into `kategori`(`id`,`nama_kategori`,`deskripsi`,`gambar`,`status`,`created_at`,`updated_at`) values 
(1,'Beton Ready Mix','Beton siap pakai dengan berbagai mutu dan kualitas terjamin',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 19:01:44'),
(2,'Paving Block','Paving block berbagai ukuran dan motif untuk jalan dan taman',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 19:01:44'),
(3,'Kanstin','Kanstin beton untuk pembatas jalan dan trotoar',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 19:01:44'),
(4,'Buis Beton','Buis beton untuk drainase dan saluran air',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 19:01:44'),
(5,'Panel Lantai','Panel lantai beton precast untuk konstruksi',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 19:01:44'),
(6,'U-Ditch','Saluran beton precast berbagai ukuran','1754963910_689a9fc652f97.jpg','aktif','2025-08-11 19:01:44','2025-08-12 08:58:30'),
(7,'coba coba','coba','1754961636_689a96e494004.jpg','aktif','2025-08-11 21:31:34','2025-08-12 10:23:29');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_kategori` int NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `deskripsi` text,
  `deskripsi_tambahan` text,
  `tags` varchar(500) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT '0.00',
  `stok` int DEFAULT '0',
  `satuan` varchar(50) DEFAULT 'pcs',
  `gambar_utama` varchar(255) DEFAULT NULL,
  `galeri_gambar` text,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `produk` */

insert  into `produk`(`id`,`id_kategori`,`nama_produk`,`deskripsi`,`deskripsi_tambahan`,`tags`,`harga`,`stok`,`satuan`,`gambar_utama`,`galeri_gambar`,`status`,`created_at`,`updated_at`) values 
(1,1,'Beton Ready Mix K250','Beton ready mix mutu K250 untuk konstruksi ringan','Cocok untuk rumah tinggal, jalan lingkungan, dan konstruksi ringan lainnya','beton,ready mix,k250,konstruksi',850000.00,100,'m3','1754921502_6899fa1ecd1ad.jpg',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 21:11:42'),
(2,1,'Beton Ready Mix K300','Beton ready mix mutu K300 untuk konstruksi sedang','Ideal untuk bangunan bertingkat rendah dan infrastruktur sedang','beton,ready mix,k300,konstruksi',900000.00,80,'m3','1754921480_6899fa08a89f9.jpg',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 21:11:20'),
(3,2,'Paving Block Hexagon','Paving block motif hexagon 6cm','Paving block dengan motif hexagon, ketebalan 6cm, cocok untuk taman dan area parkir','paving,hexagon,taman,parkir',85000.00,500,'m2','1754921463_6899f9f75f650.png',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 21:11:03'),
(4,3,'Kanstin Tegak 15x25x100','Kanstin tegak ukuran 15x25x100cm','Kanstin beton untuk pembatas jalan dengan kualitas tinggi','kanstin,pembatas,jalan',75000.00,200,'pcs','1754921439_6899f9df01718.jpg',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 21:10:39'),
(5,4,'Buis Beton Diameter 40cm','Buis beton diameter 40cm panjang 100cm','Buis beton berkualitas untuk sistem drainase','buis,drainase,saluran',250000.00,50,'pcs','1754921430_6899f9d6d51d5.jpg',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 21:10:30'),
(6,5,'Panel Lantai 120x60','Panel lantai beton precast 120x60cm','Panel lantai berkualitas tinggi untuk konstruksi cepat','panel,lantai,precast',185000.00,30,'pcs','1754921449_6899f9e917710.jpg',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 21:10:49'),
(7,7,'coba coba coba','coba','coba','kanstin,pembatas,jalan',85000.00,100,'kg','1754963925_689a9fd5d23c0.jpg',NULL,'aktif','2025-08-11 21:32:19','2025-08-12 10:23:52');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
