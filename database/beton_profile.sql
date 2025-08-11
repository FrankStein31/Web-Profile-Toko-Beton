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
(1,'admin','$2y$12$snLd.kqqLzuLAGMIylAQZOnlpIdu9qOPj4t.bWpMtK4odMBumo7AS','Administrator','admin@turenindahbangunan.com','super_admin','2025-08-11 21:31:07','2025-08-11 19:01:44','2025-08-11 21:31:07');

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
(6,'U-Ditch','Saluran beton precast berbagai ukuran',NULL,'aktif','2025-08-11 19:01:44','2025-08-11 19:01:44'),
(7,'coba','coba',NULL,'aktif','2025-08-11 21:31:34','2025-08-11 21:31:34');

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
(7,7,'coba','coba','coba','kanstin,pembatas,jalan',85000.00,100,'kg','1754922739_6899fef305b48.jpg',NULL,'aktif','2025-08-11 21:32:19','2025-08-11 21:32:19');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
