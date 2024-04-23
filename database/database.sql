/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - tru_fabrics_ltd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `activity_log` */

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `activity_log` */

/*Table structure for table `attribute_options` */

DROP TABLE IF EXISTS `attribute_options`;

CREATE TABLE `attribute_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_options_attribute_id_foreign` (`attribute_id`),
  KEY `attribute_options_created_by_foreign` (`created_by`),
  KEY `attribute_options_updated_by_foreign` (`updated_by`),
  CONSTRAINT `attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`),
  CONSTRAINT `attribute_options_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `attribute_options_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `attribute_options` */

insert  into `attribute_options`(`id`,`attribute_id`,`name`,`description`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,3,'10X10/44X38',NULL,1,NULL,NULL,'2024-03-22 09:38:22','2024-03-22 09:38:22'),
(2,3,'10x16/64x62',NULL,1,NULL,NULL,'2024-03-22 09:38:33','2024-03-22 09:38:33'),
(3,3,'10x16/67x60',NULL,1,NULL,NULL,'2024-03-22 09:38:40','2024-03-22 09:38:40'),
(4,3,'16x16+70D/94x40',NULL,1,NULL,NULL,'2024-03-22 09:38:46','2024-03-22 09:38:46'),
(5,3,'16x20+70D/90x65',NULL,1,NULL,NULL,'2024-03-22 09:38:57','2024-03-22 09:38:57'),
(6,4,'61\"',NULL,1,NULL,NULL,'2024-03-22 09:42:26','2024-03-22 09:42:26'),
(7,4,'69\"',NULL,1,NULL,NULL,'2024-03-22 09:42:32','2024-03-22 09:42:32'),
(8,4,'68\'\'',NULL,1,NULL,NULL,'2024-03-22 09:42:40','2024-03-22 09:42:40'),
(9,4,'71\'\'',NULL,1,NULL,NULL,'2024-03-22 09:42:45','2024-03-22 09:42:45'),
(10,4,'72\"',NULL,1,NULL,NULL,'2024-03-22 09:42:51','2024-03-22 09:42:51'),
(11,4,'70\'\'',NULL,1,NULL,NULL,'2024-03-22 09:43:00','2024-03-22 09:43:00'),
(12,5,'Linen',NULL,1,NULL,NULL,'2024-03-22 09:43:24','2024-03-22 09:43:24'),
(13,5,'3/1 Z Twill',NULL,1,NULL,NULL,'2024-03-22 09:43:53','2024-03-22 09:43:53'),
(14,5,'3/1 Twill',NULL,1,NULL,NULL,'2024-03-22 09:44:07','2024-03-22 09:44:07'),
(15,5,'S. Canvas',NULL,1,NULL,NULL,'2024-03-22 09:44:16','2024-03-22 09:44:16'),
(16,5,'Sheeting',NULL,1,NULL,NULL,'2024-03-22 09:44:23','2024-03-22 09:44:23'),
(17,5,'2/1 Twill',NULL,1,NULL,NULL,'2024-03-22 09:44:33','2024-03-22 09:44:33'),
(18,5,'Dobby',NULL,1,NULL,NULL,'2024-03-22 09:44:43','2024-03-22 09:44:43'),
(19,2,'(10-100) White Light Aop CW-B',NULL,1,NULL,NULL,'2024-03-22 09:45:13','2024-03-22 09:45:13'),
(20,2,'(72-302) Blue Bright Aop CW-A',NULL,1,NULL,NULL,'2024-03-22 09:45:21','2024-03-22 09:45:21'),
(21,2,'(74-209) Blue Light CW-03',NULL,1,NULL,NULL,'2024-03-22 09:45:28','2024-03-22 09:45:28'),
(22,2,'01 (Pearl White)',NULL,1,NULL,NULL,'2024-03-22 09:45:36','2024-03-22 09:45:36'),
(23,2,'01 BLACK',NULL,1,NULL,NULL,'2024-03-22 09:45:45','2024-03-22 09:45:45'),
(24,2,'01 Pearl White',NULL,1,NULL,NULL,'2024-03-22 09:45:53','2024-03-22 09:45:53'),
(25,2,'03 Beige',NULL,1,NULL,NULL,'2024-03-22 09:46:01','2024-03-22 09:46:01'),
(26,1,'S',NULL,1,NULL,NULL,'2024-03-22 09:46:35','2024-03-22 09:46:35'),
(27,1,'M',NULL,1,NULL,NULL,'2024-03-22 09:46:39','2024-03-22 09:46:39'),
(28,1,'L',NULL,1,NULL,NULL,'2024-03-22 09:46:44','2024-03-22 09:46:44'),
(29,1,'XL',NULL,1,NULL,NULL,'2024-03-22 09:46:48','2024-03-22 09:46:48'),
(30,1,'0.05 mm',NULL,1,NULL,NULL,'2024-03-22 09:46:56','2024-03-22 09:46:56');

/*Table structure for table `attributes` */

DROP TABLE IF EXISTS `attributes`;

CREATE TABLE `attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `searchable` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attributes_created_by_foreign` (`created_by`),
  KEY `attributes_updated_by_foreign` (`updated_by`),
  CONSTRAINT `attributes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `attributes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `attributes` */

insert  into `attributes`(`id`,`name`,`code`,`description`,`searchable`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Size','Size','N/A','yes',1,1,NULL,'2024-03-22 09:30:27','2024-03-22 09:31:34'),
(2,'Color','Color','N/A','yes',1,NULL,NULL,'2024-03-22 09:30:51','2024-03-22 09:30:51'),
(3,'Construction','Construction','Construction','yes',1,NULL,NULL,'2024-03-22 09:36:00','2024-03-22 09:36:00'),
(4,'Width','Width',NULL,'yes',1,NULL,NULL,'2024-03-22 09:36:17','2024-03-22 09:36:17'),
(5,'Weave','Weave',NULL,'yes',1,NULL,NULL,'2024-03-22 09:36:44','2024-03-22 09:36:44');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_created_by_foreign` (`created_by`),
  KEY `categories_updated_by_foreign` (`updated_by`),
  CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`code`,`name`,`parent_id`,`description`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'CT-0001','Greige',NULL,'For Greige',1,1,NULL,'2024-03-22 10:16:03','2024-03-22 10:40:22'),
(2,'CT-0002','Dyes & Chemicals',NULL,NULL,1,NULL,NULL,'2024-03-22 10:56:33','2024-03-22 10:56:33');

/*Table structure for table `categories_attributes` */

DROP TABLE IF EXISTS `categories_attributes`;

CREATE TABLE `categories_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `attribute_id` bigint unsigned NOT NULL,
  `serial` int NOT NULL DEFAULT '0',
  `options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_attributes_category_id_foreign` (`category_id`),
  KEY `categories_attributes_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `categories_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`),
  CONSTRAINT `categories_attributes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories_attributes` */

insert  into `categories_attributes`(`id`,`category_id`,`attribute_id`,`serial`,`options`,`created_at`,`updated_at`) values 
(1,1,3,1,'[\"1\",\"2\",\"3\",\"4\",\"5\"]','2024-03-22 10:54:48','2024-03-22 10:54:48'),
(2,1,4,1,'[\"6\",\"7\",\"8\",\"9\",\"10\",\"11\"]','2024-03-22 10:54:48','2024-03-22 10:54:48'),
(3,1,5,1,'[\"12\",\"13\",\"14\",\"15\",\"16\",\"18\"]','2024-03-22 10:54:48','2024-03-22 10:54:48');

/*Table structure for table `categories_departments` */

DROP TABLE IF EXISTS `categories_departments`;

CREATE TABLE `categories_departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_departments_category_id_foreign` (`category_id`),
  KEY `categories_departments_department_id_foreign` (`department_id`),
  CONSTRAINT `categories_departments_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `categories_departments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories_departments` */

insert  into `categories_departments`(`id`,`category_id`,`department_id`,`created_at`,`updated_at`) values 
(4,1,1,NULL,NULL),
(5,1,2,NULL,NULL),
(6,1,3,NULL,NULL),
(7,2,1,NULL,NULL),
(8,2,2,NULL,NULL),
(9,2,3,NULL,NULL);

/*Table structure for table `charges` */

DROP TABLE IF EXISTS `charges`;

CREATE TABLE `charges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `charge_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('bank','others') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'bank',
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `charges_created_by_foreign` (`created_by`),
  KEY `charges_updated_by_foreign` (`updated_by`),
  CONSTRAINT `charges_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `charges_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `charges` */

insert  into `charges`(`id`,`charge_name`,`charge_code`,`type`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Bank Charges','CHG-01','bank','active',1,NULL,NULL,'2024-03-27 04:33:27','2024-03-27 04:33:27'),
(2,'LC Open','CHG-02','bank','active',1,NULL,NULL,'2024-03-27 04:33:36','2024-03-27 04:33:36'),
(3,'LC Amendment','CHG-03','bank','active',1,NULL,NULL,'2024-03-27 04:33:56','2024-03-27 04:33:56'),
(4,'Acceptance','CHG-04','bank','active',1,NULL,NULL,'2024-03-27 04:34:06','2024-03-27 04:34:06'),
(5,'Discrepancies','CHG-05','bank','active',1,NULL,NULL,'2024-03-27 04:34:16','2024-03-27 04:34:16'),
(6,'Other Bank Charges','CHG-06','bank','active',1,NULL,NULL,'2024-03-27 04:34:30','2024-03-27 04:34:30'),
(7,'Insurance Charges','CHG-07','others','active',1,NULL,NULL,'2024-03-27 04:34:40','2024-03-27 04:34:40');

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agreement` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `term_conditions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_created_by_foreign` (`created_by`),
  KEY `customers_updated_by_foreign` (`updated_by`),
  CONSTRAINT `customers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `customers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

/*Table structure for table `departments` */

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_created_by_foreign` (`created_by`),
  KEY `departments_updated_by_foreign` (`updated_by`),
  CONSTRAINT `departments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `departments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `departments` */

insert  into `departments`(`id`,`name`,`code`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Productions','D-0001','active',1,NULL,NULL,'2024-03-22 05:38:19','2024-03-22 05:51:10'),
(2,'Commercial','D-0002','active',1,NULL,NULL,'2024-03-22 05:51:43','2024-03-22 05:51:43'),
(3,'Factory','D-0003','active',1,NULL,NULL,'2024-03-22 05:51:52','2024-03-22 05:51:52'),
(4,'Head Office','D-0004','active',1,NULL,NULL,'2024-03-22 05:52:04','2024-03-22 05:52:04');

/*Table structure for table `designations` */

DROP TABLE IF EXISTS `designations`;

CREATE TABLE `designations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `designations_created_by_foreign` (`created_by`),
  KEY `designations_updated_by_foreign` (`updated_by`),
  CONSTRAINT `designations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `designations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `designations` */

insert  into `designations`(`id`,`name`,`code`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Chairman','D-0001','active',1,NULL,NULL,'2024-03-22 17:03:40','2024-03-22 17:03:40'),
(2,'MD','D-0002','active',1,NULL,NULL,'2024-03-22 17:03:46','2024-03-22 17:03:46'),
(3,'Executive','D-0003','active',1,NULL,NULL,'2024-03-22 17:04:02','2024-03-22 17:04:02'),
(4,'Factory Manager','D-0004','active',1,NULL,NULL,'2024-03-22 17:04:12','2024-03-22 17:04:12');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `finished_goods` */

DROP TABLE IF EXISTS `finished_goods`;

CREATE TABLE `finished_goods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `work_order_item_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `warehouse_id` bigint unsigned NOT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `qty` double NOT NULL DEFAULT '0',
  `total_price` double NOT NULL DEFAULT '0',
  `inspection` enum('fresh','reject','wip') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fresh',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finished_goods_work_order_item_id_foreign` (`work_order_item_id`),
  KEY `finished_goods_product_id_foreign` (`product_id`),
  KEY `finished_goods_warehouse_id_foreign` (`warehouse_id`),
  KEY `finished_goods_created_by_foreign` (`created_by`),
  KEY `finished_goods_updated_by_foreign` (`updated_by`),
  CONSTRAINT `finished_goods_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `finished_goods_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `finished_goods_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `finished_goods_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`),
  CONSTRAINT `finished_goods_work_order_item_id_foreign` FOREIGN KEY (`work_order_item_id`) REFERENCES `work_order_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_goods` */

/*Table structure for table `finished_goods_delivery` */

DROP TABLE IF EXISTS `finished_goods_delivery`;

CREATE TABLE `finished_goods_delivery` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finished_good_id` bigint unsigned NOT NULL,
  `delivery_qty` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finished_goods_delivery_finished_good_id_foreign` (`finished_good_id`),
  CONSTRAINT `finished_goods_delivery_finished_good_id_foreign` FOREIGN KEY (`finished_good_id`) REFERENCES `finished_goods` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_goods_delivery` */

/*Table structure for table `finished_goods_docs` */

DROP TABLE IF EXISTS `finished_goods_docs`;

CREATE TABLE `finished_goods_docs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `finished_goods_delivery_id` bigint unsigned NOT NULL,
  `discrepancies_charge` double NOT NULL DEFAULT '0',
  `realized_value` double NOT NULL DEFAULT '0',
  `fg_files` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finished_goods_docs_finished_goods_delivery_id_foreign` (`finished_goods_delivery_id`),
  CONSTRAINT `finished_goods_docs_finished_goods_delivery_id_foreign` FOREIGN KEY (`finished_goods_delivery_id`) REFERENCES `finished_goods_delivery` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_goods_docs` */

/*Table structure for table `grn_charges` */

DROP TABLE IF EXISTS `grn_charges`;

CREATE TABLE `grn_charges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `grn_id` bigint unsigned NOT NULL,
  `charge_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grn_charges_grn_id_foreign` (`grn_id`),
  KEY `grn_charges_charge_id_foreign` (`charge_id`),
  CONSTRAINT `grn_charges_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`),
  CONSTRAINT `grn_charges_grn_id_foreign` FOREIGN KEY (`grn_id`) REFERENCES `grns` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `grn_charges` */

/*Table structure for table `grn_items` */

DROP TABLE IF EXISTS `grn_items`;

CREATE TABLE `grn_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `grn_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `qty` double NOT NULL DEFAULT '0',
  `sub_total_price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `discount_amount` double NOT NULL DEFAULT '0',
  `vat_type` enum('inclusive','exclusive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'exclusive',
  `vat` double NOT NULL DEFAULT '0',
  `vat_amount` double NOT NULL DEFAULT '0',
  `total_price` double NOT NULL DEFAULT '0',
  `quality_ensure` enum('pending','approved','return','replace') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `received_qty` double NOT NULL DEFAULT '0',
  `expire_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grn_items_grn_id_foreign` (`grn_id`),
  KEY `grn_items_product_id_foreign` (`product_id`),
  CONSTRAINT `grn_items_grn_id_foreign` FOREIGN KEY (`grn_id`) REFERENCES `grns` (`id`),
  CONSTRAINT `grn_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `grn_items` */

/*Table structure for table `grns` */

DROP TABLE IF EXISTS `grns`;

CREATE TABLE `grns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proforma_invoice_id` bigint unsigned NOT NULL,
  `reference_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `vat` double NOT NULL DEFAULT '0',
  `gross_price` double NOT NULL DEFAULT '0',
  `status` enum('full','partial') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'full',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grns_proforma_invoice_id_foreign` (`proforma_invoice_id`),
  KEY `grns_created_by_foreign` (`created_by`),
  KEY `grns_updated_by_foreign` (`updated_by`),
  CONSTRAINT `grns_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `grns_proforma_invoice_id_foreign` FOREIGN KEY (`proforma_invoice_id`) REFERENCES `proforma_invoices` (`id`),
  CONSTRAINT `grns_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `grns` */

/*Table structure for table `language_libraries` */

DROP TABLE IF EXISTS `language_libraries`;

CREATE TABLE `language_libraries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `language_id` bigint unsigned NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `translation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language_libraries_language_id_foreign` (`language_id`),
  KEY `language_libraries_created_by_foreign` (`created_by`),
  KEY `language_libraries_updated_by_foreign` (`updated_by`),
  CONSTRAINT `language_libraries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `language_libraries_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `language_libraries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `language_libraries` */

insert  into `language_libraries`(`id`,`language_id`,`slug`,`translation`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,'en','EN',1,NULL,NULL,'2024-03-20 09:41:31',NULL);

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'US',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `languages_created_by_foreign` (`created_by`),
  KEY `languages_updated_by_foreign` (`updated_by`),
  CONSTRAINT `languages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `languages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `languages` */

insert  into `languages`(`id`,`code`,`name`,`flag`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'en','English','US',1,1,NULL,'2024-01-23 04:54:39','2024-01-26 21:09:35'),
(2,'bn','Bangla','BD',1,1,NULL,'2024-03-20 04:07:08','2024-03-20 04:07:28');

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_receipt` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `logs` */

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_num` tinyint unsigned NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_for` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menu for admin',
  `open_new_tab` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Open New Tab',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_created_by_foreign` (`created_by`),
  KEY `menus_updated_by_foreign` (`updated_by`),
  CONSTRAINT `menus_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menus_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`name_bn`,`url`,`icon_class`,`icon`,`big_icon`,`serial_num`,`status`,`slug`,`menu_for`,`open_new_tab`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Dashboard',NULL,'dashboard','uil-home-alt',NULL,NULL,1,'Active','[\"Dashboard\"]','Menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 00:27:14','2023-02-02 03:06:05'),
(2,'ACL',NULL,'#','mdi mdi-account-settings',NULL,NULL,2,'Active','[\"submenu-list\",\"menu-list\",\"user-list\",\"role-list\",\"permission-list\"]','Menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 00:48:23','2023-02-16 00:40:50'),
(11,'Settings',NULL,'#','ri-settings-3-fill',NULL,NULL,8,'Active','[\"settings-list\"]','Menu for admin','No Open New Tab',1,1,NULL,'2023-03-25 08:50:28','2023-03-25 08:51:49'),
(12,'IMS',NULL,'#','uil-globe',NULL,NULL,9,'Active','[\"customers\",\"suppliers\",\"charges\",\"warehouses\",\"units\",\"designations\",\"departments\"]','Menu for admin','No Open New Tab',1,1,NULL,'2024-01-21 05:56:35','2024-03-21 04:43:46'),
(13,'Language',NULL,'#','uil-globe',NULL,NULL,14,'Active','[\"language-library\",\"languages\"]','Menu for admin','No Open New Tab',1,1,NULL,'2024-01-23 04:10:16','2024-03-22 06:07:35'),
(14,'Plans',NULL,'admin/plans','ri-task-fill',NULL,NULL,11,'Active','[\"plan-delete\",\"plan-edit\",\"plan-create\",\"plans\"]','Menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:19','2024-01-23 04:30:37','2024-03-19 10:36:19'),
(15,'Subscribers',NULL,'admin/subscribers','uil-user-circle',NULL,NULL,12,'Active','[\"subscriber-approver\",\"subscriber-delete\",\"subscriber-edit\",\"subscriber-create\",\"subscribers\"]','Menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:15','2024-01-24 03:54:32','2024-03-19 10:36:15'),
(16,'Plan Payments',NULL,'admin/payments','uil-usd-square',NULL,NULL,13,'Active','[\"payment-delete\",\"payment-show\",\"payments\"]','Menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:10','2024-01-24 03:55:39','2024-03-19 10:36:10'),
(17,'Reports',NULL,'#','uil-file-bookmark-alt',NULL,NULL,14,'Active','[\"documents\",\"reports-generate\",\"reports\"]','Menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:05','2024-01-24 03:56:15','2024-03-19 10:36:05'),
(18,'Notifications',NULL,'admin/notifications','ri-notification-3-line noti-icon',NULL,NULL,15,'Active','[\"read-logs\",\"logs\"]','Menu for admin','No Open New Tab',1,1,NULL,'2024-01-31 15:27:30','2024-01-31 15:28:37'),
(19,'Products',NULL,'#','uil-package',NULL,NULL,10,'Active','[\"products\",\"groups\",\"categories\",\"attribute-options\",\"attributes\"]','Menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-22 06:08:30','2024-03-22 06:08:30'),
(20,'Commercial',NULL,'#','mdi mdi-import',NULL,NULL,11,'Active','[\"proforma-invoices\"]','Menu for admin','No Open New Tab',1,1,NULL,'2024-03-28 04:13:52','2024-03-28 04:15:14');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2020_11_24_022623_create_menus_table',1),
(6,'2020_11_24_031938_create_sub_menus_table',1),
(7,'2020_11_24_032345_create_sub_sub_menus_table',1),
(8,'2022_12_18_153538_user_column_visibilities',1),
(9,'2022_12_18_153539_create_permission_tables',2),
(10,'2022_12_25_132445_add_module_to_permissions',2),
(11,'2023_02_02_034707_add_soft_delete_to_table',2),
(12,'2023_03_23_192825_add_type_column_in_users',2),
(13,'2023_06_05_085004_create_settings_website_table',2),
(14,'2023_06_05_085031_create_settings_social_media_table',2),
(15,'2023_06_05_085047_create_settings_wallet_table',2),
(16,'2023_06_05_085145_create_settings_mail_table',2),
(17,'2023_06_05_155801_add_two_column_in_settings_website',2),
(18,'2024_01_18_093516_create_activity_log_table',2),
(19,'2024_01_18_093517_add_event_column_to_activity_log_table',2),
(20,'2024_01_18_093518_add_batch_uuid_column_to_activity_log_table',2),
(21,'2024_01_18_103116_add_column_roles_table',2),
(22,'2024_01_20_180108_create_services_table',3),
(23,'2024_01_20_180122_create_document_types_table',4),
(24,'2024_01_21_033756_languages',5),
(25,'2024_01_21_033805_language_libraries',5),
(26,'2024_01_21_033903_plans',6),
(27,'2024_01_21_033908_plan_services',6),
(28,'2024_01_21_034023_business_information',7),
(29,'2024_01_21_034148_subscriptions',7),
(30,'2024_01_21_042528_subscription_plan_services',7),
(31,'2024_01_21_042538_subscription_additional_services',7),
(32,'2024_01_21_042549_subscription_payments',7),
(37,'2024_01_21_034452_report_requests',8),
(38,'2024_01_21_034459_report_request_documents',8),
(39,'2024_01_21_034509_reports',8),
(40,'2024_01_21_034517_report_documents',8),
(41,'2024_01_23_160921_add_column_settings_website_table',9),
(42,'2024_01_26_055524_wesite_multiple_language',10),
(43,'2024_01_26_055557_cms_multiple_language',11),
(44,'2024_01_26_055630_plan_multiple_language',12),
(45,'2024_01_26_091208_add_flag_to_language',13),
(46,'2024_01_27_084952_add_plan_features_in_website_settings',14),
(47,'2024_01_27_100058_add_service_agreement_in_website_settings',15),
(48,'2024_01_28_102014_add_timeline',16),
(49,'2024_01_28_171327_remove_doc_type_form_report_doc',17),
(50,'2024_01_30_152054_logs',18),
(51,'2024_01_30_154125_update_wallet',19),
(52,'2024_01_31_031850_add_read_in_log_table',20),
(53,'2024_02_05_154803_add_year_month_to_report',21),
(54,'2024_02_05_161925_add_options_to_website',22),
(55,'2024_02_05_162450_update_business_info',23),
(56,'2024_02_06_174556_plan_document_types',24),
(57,'2024_02_07_140114_add_type_to_services',25),
(59,'2024_02_11_140633_update_report',26),
(60,'2024_02_11_180543_add_membership_email',27),
(61,'2024_02_14_105953_salespersons',28),
(62,'2024_02_14_110019_add_salesperson_to_business_info',29),
(63,'2024_02_14_153438_agreement_email',30),
(64,'2024_02_15_154410_update_additional_services',31),
(65,'2024_03_06_061425_add_note_at_business_information_table',32),
(66,'2024_03_20_041526_create_departments_table',33),
(67,'2024_03_20_041543_create_designations_table',33),
(68,'2024_03_20_041715_create_units_table',33),
(69,'2024_03_20_041728_create_charges_table',33),
(70,'2024_03_20_041756_create_warehouses_table',33),
(71,'2024_03_20_041853_create_suppliers_table',33),
(72,'2024_03_20_041902_create_customers_table',33),
(73,'2024_03_20_043648_create_attributes_table',34),
(74,'2024_03_20_043657_create_attribute_options_table',34),
(75,'2024_03_20_043909_create_categories_table',34),
(76,'2024_03_20_043945_create_categories_departments_table',34),
(77,'2024_03_20_043954_create_categories_attributes_table',34),
(78,'2024_03_20_044242_create_products_table',35),
(79,'2024_03_20_044252_create_product_attributes_table',35),
(80,'2024_03_20_050815_create_product_groups_table',36),
(81,'2024_03_20_050846_add_columns_in_products_table',36),
(82,'2024_03_22_052322_create_product_suppliers_table',37),
(83,'2024_03_27_064259_create_proforma_invoices_table',38),
(84,'2024_03_27_064312_create_proforma_invoice_items_table',38),
(85,'2024_03_27_064342_create_grns_table',38),
(86,'2024_03_27_064350_create_grn_items_table',38),
(87,'2024_03_27_075524_create_stock_inventory_table',39),
(88,'2024_03_27_082907_create_work_orders_table',40),
(89,'2024_03_27_082914_create_work_order_items_table',40),
(90,'2024_03_27_083010_create_requisitions_table',40),
(91,'2024_03_27_083017_create_requisition_items_table',40),
(92,'2024_03_27_083424_create_requisition_delivery_table',41),
(93,'2024_03_27_084514_create_grn_charges_table',41),
(94,'2024_03_28_110156_create_work_order_item_charges_table',41),
(95,'2024_03_28_110748_create_finished_goods_table',41),
(96,'2024_03_28_111018_create_finished_goods_delivery_table',41),
(97,'2024_03_28_111455_create_finished_goods_docs_table',41);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

insert  into `model_has_permissions`(`permission_id`,`model_type`,`model_id`) values 
(2,'App\\Models\\User',1),
(3,'App\\Models\\User',1),
(4,'App\\Models\\User',1),
(5,'App\\Models\\User',1),
(6,'App\\Models\\User',1),
(7,'App\\Models\\User',1),
(8,'App\\Models\\User',1),
(9,'App\\Models\\User',1),
(10,'App\\Models\\User',1),
(11,'App\\Models\\User',1),
(12,'App\\Models\\User',1),
(13,'App\\Models\\User',1),
(14,'App\\Models\\User',1),
(15,'App\\Models\\User',1),
(16,'App\\Models\\User',1),
(17,'App\\Models\\User',1),
(18,'App\\Models\\User',1),
(19,'App\\Models\\User',1),
(20,'App\\Models\\User',1),
(21,'App\\Models\\User',1),
(22,'App\\Models\\User',1),
(23,'App\\Models\\User',1),
(24,'App\\Models\\User',1),
(25,'App\\Models\\User',1),
(26,'App\\Models\\User',1),
(27,'App\\Models\\User',1),
(28,'App\\Models\\User',1),
(29,'App\\Models\\User',1),
(30,'App\\Models\\User',1),
(35,'App\\Models\\User',1),
(36,'App\\Models\\User',1),
(37,'App\\Models\\User',1),
(38,'App\\Models\\User',1),
(39,'App\\Models\\User',1),
(40,'App\\Models\\User',1),
(41,'App\\Models\\User',1),
(42,'App\\Models\\User',1),
(57,'App\\Models\\User',1),
(58,'App\\Models\\User',1),
(59,'App\\Models\\User',1),
(60,'App\\Models\\User',1),
(61,'App\\Models\\User',1),
(62,'App\\Models\\User',1),
(63,'App\\Models\\User',1),
(64,'App\\Models\\User',1),
(65,'App\\Models\\User',1),
(66,'App\\Models\\User',1),
(67,'App\\Models\\User',1),
(68,'App\\Models\\User',1),
(69,'App\\Models\\User',1),
(70,'App\\Models\\User',1),
(71,'App\\Models\\User',1),
(72,'App\\Models\\User',1),
(73,'App\\Models\\User',1),
(74,'App\\Models\\User',1),
(75,'App\\Models\\User',1),
(76,'App\\Models\\User',1),
(77,'App\\Models\\User',1),
(78,'App\\Models\\User',1),
(79,'App\\Models\\User',1),
(80,'App\\Models\\User',1),
(81,'App\\Models\\User',1),
(82,'App\\Models\\User',1),
(83,'App\\Models\\User',1),
(84,'App\\Models\\User',1),
(85,'App\\Models\\User',1),
(86,'App\\Models\\User',1),
(22,'App\\Models\\User',2),
(35,'App\\Models\\User',2),
(36,'App\\Models\\User',2),
(37,'App\\Models\\User',2),
(38,'App\\Models\\User',2),
(39,'App\\Models\\User',2),
(40,'App\\Models\\User',2),
(41,'App\\Models\\User',2),
(42,'App\\Models\\User',2),
(57,'App\\Models\\User',2),
(58,'App\\Models\\User',2),
(59,'App\\Models\\User',2),
(60,'App\\Models\\User',2),
(61,'App\\Models\\User',2),
(62,'App\\Models\\User',2),
(63,'App\\Models\\User',2),
(64,'App\\Models\\User',2),
(65,'App\\Models\\User',2),
(66,'App\\Models\\User',2),
(67,'App\\Models\\User',2),
(68,'App\\Models\\User',2),
(69,'App\\Models\\User',2),
(70,'App\\Models\\User',2),
(71,'App\\Models\\User',2),
(72,'App\\Models\\User',2),
(73,'App\\Models\\User',2),
(74,'App\\Models\\User',2),
(75,'App\\Models\\User',2),
(76,'App\\Models\\User',2),
(77,'App\\Models\\User',2),
(78,'App\\Models\\User',2),
(79,'App\\Models\\User',2),
(80,'App\\Models\\User',2),
(81,'App\\Models\\User',2),
(82,'App\\Models\\User',2),
(83,'App\\Models\\User',2),
(84,'App\\Models\\User',2),
(85,'App\\Models\\User',2),
(86,'App\\Models\\User',2);

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values 
(1,'App\\Models\\User',1),
(4,'App\\Models\\User',2);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`module`,`created_at`,`updated_at`) values 
(2,'permission-create','web','ACL','2023-01-31 09:37:24','2023-01-31 09:37:24'),
(3,'permission-edit','web','ACL','2023-01-31 09:37:24','2023-01-31 09:37:24'),
(4,'permission-delete','web','ACL','2023-01-31 09:37:24','2023-01-31 09:37:24'),
(5,'permission-list','web','ACL','2023-01-31 10:04:40','2023-01-31 10:04:40'),
(6,'role-list','web','ACL','2023-01-31 10:06:18','2023-01-31 10:06:18'),
(7,'role-create','web','ACL','2023-01-31 10:06:18','2023-01-31 10:06:18'),
(8,'role-edit','web','ACL','2023-01-31 10:06:18','2023-01-31 10:06:18'),
(9,'role-delete','web','ACL','2023-01-31 10:06:18','2023-01-31 10:06:18'),
(10,'user-list','web','Users','2023-01-31 10:06:41','2023-01-31 10:06:41'),
(11,'user-create','web','Users','2023-01-31 10:06:41','2023-01-31 10:06:41'),
(12,'user-edit','web','Users','2023-01-31 10:06:41','2023-01-31 10:06:41'),
(13,'user-delete','web','Users','2023-01-31 10:06:41','2023-01-31 10:06:41'),
(14,'menu-list','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(15,'menu-edit','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(16,'menu-create','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(17,'menu-delete','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(18,'submenu-list','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(19,'submenu-create','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(20,'submenu-edit','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(21,'submenu-delete','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(22,'Dashboard','web','Dashboard','2023-02-02 00:35:11','2023-02-02 00:35:11'),
(23,'settings-list','web','Settings','2024-01-19 06:31:40','2024-01-19 06:31:40'),
(24,'settings-create','web','Settings','2024-01-19 06:31:40','2024-01-19 06:31:40'),
(25,'settings-edit','web','Settings','2024-01-19 06:31:40','2024-01-19 06:31:40'),
(26,'settings-delete','web','Settings','2024-01-19 06:31:40','2024-01-19 06:31:40'),
(27,'services','web','CMS','2024-01-21 05:52:03','2024-01-21 05:52:03'),
(28,'service-create','web','CMS','2024-01-21 05:52:03','2024-01-21 05:52:03'),
(29,'service-edit','web','CMS','2024-01-21 05:52:03','2024-01-21 05:52:03'),
(30,'service-delete','web','CMS','2024-01-21 05:52:03','2024-01-21 05:52:03'),
(35,'languages','web','Language','2024-01-23 04:15:22','2024-01-23 04:15:22'),
(36,'language-create','web','Language','2024-01-23 04:15:24','2024-01-23 04:15:24'),
(37,'language-edit','web','Language','2024-01-23 04:15:24','2024-01-23 04:15:24'),
(38,'language-delete','web','Language','2024-01-23 04:15:24','2024-01-23 04:15:24'),
(39,'language-library','web','Language','2024-01-23 04:16:19','2024-01-23 04:16:19'),
(40,'language-library-create','web','Language','2024-01-23 04:16:21','2024-01-23 04:16:21'),
(41,'language-library-edit','web','Language','2024-01-23 04:16:21','2024-01-23 04:16:21'),
(42,'language-library-delete','web','Language','2024-01-23 04:16:21','2024-01-23 04:16:21'),
(57,'logs','web','Logs','2024-01-31 15:22:59','2024-01-31 15:22:59'),
(58,'read-logs','web','Logs','2024-01-31 15:22:59','2024-01-31 15:22:59'),
(59,'departments','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(60,'department-create','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(61,'department-edit','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(62,'department-delete','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(63,'designations','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(64,'designation-create','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(65,'designation-edit','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(66,'designation-delete','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(67,'units','web','IMS','2024-03-21 04:01:53','2024-03-21 04:01:53'),
(68,'unit-create','web','IMS','2024-03-21 04:01:53','2024-03-21 04:01:53'),
(69,'unit-edit','web','IMS','2024-03-21 04:01:53','2024-03-21 04:01:53'),
(70,'unit-delete','web','IMS','2024-03-21 04:01:53','2024-03-21 04:01:53'),
(71,'warehouses','web','IMS','2024-03-21 04:01:54','2024-03-21 04:01:54'),
(72,'warehouse-create','web','IMS','2024-03-21 04:01:54','2024-03-21 04:01:54'),
(73,'warehouse-edit','web','IMS','2024-03-21 04:01:54','2024-03-21 04:01:54'),
(74,'warehouse-delete','web','IMS','2024-03-21 04:01:54','2024-03-21 04:01:54'),
(75,'charges','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(76,'charge-create','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(77,'charge-edit','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(78,'charge-delete','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(79,'suppliers','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(80,'supplier-create','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(81,'supplier-edit','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(82,'supplier-delete','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(83,'customers','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(84,'customer-create','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(85,'customer-edit','web','IMS','2024-03-21 04:03:14','2024-03-21 04:03:14'),
(86,'customer-delete','web','IMS','2024-03-21 04:03:14','2024-03-21 04:03:14'),
(87,'attributes','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(88,'attribute-create','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(89,'attribute-edit','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(90,'attribute-delete','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(91,'attribute-options','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(92,'attribute-option-create','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(93,'attribute-option-edit','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(94,'attribute-option-delete','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(95,'categories','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(96,'category-create','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(97,'category-edit','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(98,'category-delete','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(99,'groups','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(100,'group-create','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(101,'group-edit','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(102,'group-delete','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(103,'products','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(104,'product-create','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(105,'product-edit','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(106,'product-delete','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(107,'proforma-invoices','web','Import Goods','2024-03-28 04:09:17','2024-03-28 04:09:17'),
(108,'proforma-invoice-create','web','Import Goods','2024-03-28 04:09:17','2024-03-28 04:09:17'),
(109,'proforma-invoice-edit','web','Import Goods','2024-03-28 04:09:17','2024-03-28 04:09:17'),
(110,'proforma-invoice-delete','web','Import Goods','2024-03-28 04:09:17','2024-03-28 04:09:17');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `product_attributes` */

DROP TABLE IF EXISTS `product_attributes`;

CREATE TABLE `product_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `attribute_option_id` bigint unsigned NOT NULL,
  `serial` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attributes_product_id_foreign` (`product_id`),
  KEY `product_attributes_attribute_option_id_foreign` (`attribute_option_id`),
  CONSTRAINT `product_attributes_attribute_option_id_foreign` FOREIGN KEY (`attribute_option_id`) REFERENCES `attribute_options` (`id`),
  CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_attributes` */

insert  into `product_attributes`(`id`,`product_id`,`attribute_option_id`,`serial`,`created_at`,`updated_at`) values 
(28,6,1,1,'2024-03-27 06:10:02','2024-03-27 06:10:02'),
(29,6,6,1,'2024-03-27 06:10:02','2024-03-27 06:10:02'),
(30,6,12,1,'2024-03-27 06:10:02','2024-03-27 06:10:02');

/*Table structure for table `product_groups` */

DROP TABLE IF EXISTS `product_groups`;

CREATE TABLE `product_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_groups_created_by_foreign` (`created_by`),
  KEY `product_groups_updated_by_foreign` (`updated_by`),
  CONSTRAINT `product_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `product_groups_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_groups` */

insert  into `product_groups`(`id`,`name`,`code`,`description`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Chemical','PG-001',NULL,1,NULL,NULL,'2024-03-22 17:38:31','2024-03-22 17:38:31'),
(2,'Printing Chemical','PG-002',NULL,1,NULL,NULL,'2024-03-22 17:38:48','2024-03-22 17:38:48'),
(3,'Dyes','PG-003',NULL,1,NULL,NULL,'2024-03-22 17:39:00','2024-03-22 17:39:00'),
(4,'Greige','PG-004',NULL,1,NULL,NULL,'2024-03-27 04:36:21','2024-03-27 04:36:21');

/*Table structure for table `product_suppliers` */

DROP TABLE IF EXISTS `product_suppliers`;

CREATE TABLE `product_suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_suppliers_product_id_foreign` (`product_id`),
  KEY `product_suppliers_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `product_suppliers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_suppliers_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_suppliers` */

insert  into `product_suppliers`(`id`,`product_id`,`supplier_id`,`created_at`,`updated_at`) values 
(11,6,1,NULL,NULL),
(12,6,4,NULL,NULL);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `product_group_id` bigint unsigned NOT NULL,
  `unit_id` bigint unsigned NOT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `vat` double NOT NULL DEFAULT '0',
  `sales_price` double NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `mode_of_purchase` enum('import','native') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_unit_id_foreign` (`unit_id`),
  KEY `products_created_by_foreign` (`created_by`),
  KEY `products_updated_by_foreign` (`updated_by`),
  KEY `products_product_group_id_foreign` (`product_group_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `products_product_group_id_foreign` FOREIGN KEY (`product_group_id`) REFERENCES `product_groups` (`id`),
  CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`),
  CONSTRAINT `products_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`sku`,`name`,`parent_id`,`category_id`,`product_group_id`,`unit_id`,`unit_price`,`tax`,`vat`,`sales_price`,`description`,`status`,`mode_of_purchase`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(6,'P-24-TRU-00001','Greige-Imported',NULL,1,4,1,500,0,0,0,'N/A','approved','import',NULL,NULL,NULL,'2024-03-27 05:12:29','2024-03-27 06:10:02');

/*Table structure for table `proforma_invoice_items` */

DROP TABLE IF EXISTS `proforma_invoice_items`;

CREATE TABLE `proforma_invoice_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proforma_invoice_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `qty` double NOT NULL DEFAULT '0',
  `sub_total_price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `discount_amount` double NOT NULL DEFAULT '0',
  `vat_type` enum('inclusive','exclusive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'exclusive',
  `vat` double NOT NULL DEFAULT '0',
  `vat_amount` double NOT NULL DEFAULT '0',
  `total_price` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proforma_invoice_items_proforma_invoice_id_foreign` (`proforma_invoice_id`),
  KEY `proforma_invoice_items_product_id_foreign` (`product_id`),
  CONSTRAINT `proforma_invoice_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `proforma_invoice_items_proforma_invoice_id_foreign` FOREIGN KEY (`proforma_invoice_id`) REFERENCES `proforma_invoices` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `proforma_invoice_items` */

/*Table structure for table `proforma_invoices` */

DROP TABLE IF EXISTS `proforma_invoices`;

CREATE TABLE `proforma_invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `pi_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pi_date` date DEFAULT NULL,
  `mrr_no` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lc_no` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lc_date` date DEFAULT NULL,
  `total_price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `vat` double NOT NULL DEFAULT '0',
  `gross_price` double NOT NULL DEFAULT '0',
  `status` enum('pending','approved','halt') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `pi_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `instructions_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proforma_invoices_supplier_id_foreign` (`supplier_id`),
  KEY `proforma_invoices_created_by_foreign` (`created_by`),
  KEY `proforma_invoices_updated_by_foreign` (`updated_by`),
  CONSTRAINT `proforma_invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `proforma_invoices_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  CONSTRAINT `proforma_invoices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `proforma_invoices` */

/*Table structure for table `requisition_delivery` */

DROP TABLE IF EXISTS `requisition_delivery`;

CREATE TABLE `requisition_delivery` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `requisition_item_id` bigint unsigned NOT NULL,
  `stock_inventory_id` bigint unsigned NOT NULL,
  `issued_qty` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requisition_delivery_requisition_item_id_foreign` (`requisition_item_id`),
  KEY `requisition_delivery_stock_inventory_id_foreign` (`stock_inventory_id`),
  CONSTRAINT `requisition_delivery_requisition_item_id_foreign` FOREIGN KEY (`requisition_item_id`) REFERENCES `requisition_items` (`id`),
  CONSTRAINT `requisition_delivery_stock_inventory_id_foreign` FOREIGN KEY (`stock_inventory_id`) REFERENCES `stock_inventory` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `requisition_delivery` */

/*Table structure for table `requisition_items` */

DROP TABLE IF EXISTS `requisition_items`;

CREATE TABLE `requisition_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `requisition_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requisition_items_requisition_id_foreign` (`requisition_id`),
  KEY `requisition_items_product_id_foreign` (`product_id`),
  CONSTRAINT `requisition_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `requisition_items_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `requisition_items` */

/*Table structure for table `requisitions` */

DROP TABLE IF EXISTS `requisitions`;

CREATE TABLE `requisitions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `work_order_item_id` bigint unsigned NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisition_date` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `requisition_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requisitions_work_order_item_id_foreign` (`work_order_item_id`),
  KEY `requisitions_created_by_foreign` (`created_by`),
  KEY `requisitions_updated_by_foreign` (`updated_by`),
  CONSTRAINT `requisitions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `requisitions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `requisitions_work_order_item_id_foreign` FOREIGN KEY (`work_order_item_id`) REFERENCES `work_order_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `requisitions` */

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values 
(2,1),
(3,1),
(4,1),
(5,1),
(6,1),
(7,1),
(8,1),
(9,1),
(10,1),
(11,1),
(12,1),
(13,1),
(14,1),
(15,1),
(16,1),
(17,1),
(18,1),
(19,1),
(20,1),
(21,1),
(22,1),
(23,1),
(24,1),
(25,1),
(26,1),
(27,1),
(28,1),
(29,1),
(30,1),
(35,1),
(36,1),
(37,1),
(38,1),
(39,1),
(40,1),
(41,1),
(42,1),
(57,1),
(58,1),
(59,1),
(60,1),
(61,1),
(62,1),
(63,1),
(64,1),
(65,1),
(66,1),
(67,1),
(68,1),
(69,1),
(70,1),
(71,1),
(72,1),
(73,1),
(74,1),
(75,1),
(76,1),
(77,1),
(78,1),
(79,1),
(80,1),
(81,1),
(82,1),
(83,1),
(84,1),
(85,1),
(86,1),
(87,1),
(88,1),
(89,1),
(90,1),
(91,1),
(92,1),
(93,1),
(94,1),
(95,1),
(96,1),
(97,1),
(98,1),
(99,1),
(100,1),
(101,1),
(102,1),
(103,1),
(104,1),
(105,1),
(106,1),
(107,1),
(108,1),
(109,1),
(110,1),
(22,4),
(35,4),
(36,4),
(37,4),
(38,4),
(39,4),
(40,4),
(41,4),
(42,4),
(57,4),
(58,4),
(59,4),
(60,4),
(61,4),
(62,4),
(63,4),
(64,4),
(65,4),
(66,4),
(67,4),
(68,4),
(69,4),
(70,4),
(71,4),
(72,4),
(73,4),
(74,4),
(75,4),
(76,4),
(77,4),
(78,4),
(79,4),
(80,4),
(81,4),
(82,4),
(83,4),
(84,4),
(85,4),
(86,4),
(87,4),
(88,4),
(89,4),
(90,4),
(91,4),
(92,4),
(93,4),
(94,4),
(95,4),
(96,4),
(97,4),
(98,4),
(99,4),
(100,4),
(101,4),
(102,4),
(103,4),
(104,4),
(105,4),
(106,4),
(107,4),
(108,4),
(109,4),
(110,4);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `word_restrictions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`word_restrictions`,`guard_name`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Super-Admin','[\"\"]','web','2023-01-31 10:54:55','2023-02-16 00:37:53',NULL),
(3,'Customer','[\"\"]','web',NULL,NULL,NULL),
(4,'Admin','[\"\"]','web','2024-03-21 04:40:59','2024-03-21 04:40:59',NULL);

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slug` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `type` enum('sellable','other-services-monthly-charge','other-services-onetime-charge','other-affiliate-services') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sellable',
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_created_by_foreign` (`created_by`),
  KEY `services_updated_by_foreign` (`updated_by`),
  CONSTRAINT `services_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `services_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `services` */

/*Table structure for table `settings_mail` */

DROP TABLE IF EXISTS `settings_mail`;

CREATE TABLE `settings_mail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mail_mailer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mail_host` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mail_port` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mail_user_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mail_user_password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mail_encryption` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mail_from_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mail_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings_mail` */

insert  into `settings_mail`(`id`,`mail_mailer`,`mail_host`,`mail_port`,`mail_user_name`,`mail_user_password`,`mail_encryption`,`mail_from_address`,`mail_name`,`created_at`,`updated_at`) values 
(1,'smtp','mail.trugroup.com.bd','465','test@trugroup.com.bd','#11nrd~@$4he','ssl','test@trugroup.com.bd','TRU Group','2024-01-31 04:37:44','2024-03-20 03:58:31');

/*Table structure for table `settings_social_media` */

DROP TABLE IF EXISTS `settings_social_media`;

CREATE TABLE `settings_social_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `twitter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `telegram` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `discord` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `youtube` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `vimeo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tiktok` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings_social_media` */

insert  into `settings_social_media`(`id`,`twitter`,`facebook`,`telegram`,`discord`,`youtube`,`vimeo`,`tiktok`,`created_at`,`updated_at`) values 
(1,'#','https://www.facebook.com/','https://www.linkedin.com/company/','https://www.instagram.com/','https://youtube.com','#','https://www.tiktok.com/','2024-01-25 20:40:47','2024-03-20 03:57:01');

/*Table structure for table `settings_wallet` */

DROP TABLE IF EXISTS `settings_wallet`;

CREATE TABLE `settings_wallet` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `environment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `access_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `application_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `location_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `redirect_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `merchant_support_email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings_wallet` */

insert  into `settings_wallet`(`id`,`environment`,`access_token`,`application_id`,`location_id`,`redirect_url`,`merchant_support_email`,`created_at`,`updated_at`) values 
(1,'sandbox','EAAAl9vQAdez0WbH2r75gBLhpLTdfwUWBt8LcCbQqx1PEMoLZuvs8fwgGS4J5t4g','sandbox-sq0idb-LOSO1E8bZRG4GxYFo2sRUg','LEY0GQQHR60WC','http://127.0.0.1:8000/guest/callback','gmfaruk2021@gmail.com','2024-01-31 03:52:30','2024-01-31 03:52:30');

/*Table structure for table `settings_website` */

DROP TABLE IF EXISTS `settings_website`;

CREATE TABLE `settings_website` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slogan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `logo` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_user_logo` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `membership_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agreement_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_phone` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `default_user_cover` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee_like_qty` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '10',
  `monthly_plan_features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_agreements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `business_structures` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tax_filing_statuses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings_website` */

insert  into `settings_website`(`id`,`name`,`slogan`,`logo`,`default_user_logo`,`favicon`,`official_email`,`membership_email`,`agreement_email`,`official_phone`,`official_address`,`default_user_cover`,`fee_like_qty`,`monthly_plan_features`,`service_agreements`,`business_structures`,`tax_filing_statuses`,`created_at`,`updated_at`) values 
(1,'{\"en\":\"TRU Group.\"}','{\"en\":\"TRU Group.\"}','uploads/website/logo/897200324040206.webp','uploads/website/defaultUser/298200324035031.png','uploads/website/favicon/918200324040206.png','info@bizzsol.com.bd','info@bizzsol.com.bd','info@bizzsol.com.bd','.','{\"en\":\".\"}','uploads/website/defaultCover/213200324040206.webp','5','.','<h4 style=\"margin-bottom: 35px\">.</h4><ol>\r\n</ol>','[\"sole-proprietor\",\"partnership\",\"LLC\",\"c-corp\",\"s-corp\",\"non-profit\"]','[\"individual\",\"partnership\",\"corporation\"]','2023-06-06 01:51:13','2024-03-20 04:02:06');

/*Table structure for table `stock_inventory` */

DROP TABLE IF EXISTS `stock_inventory`;

CREATE TABLE `stock_inventory` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `grn_item_id` bigint unsigned NOT NULL,
  `warehouse_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `status` enum('fresh','expire') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'fresh',
  `type` enum('in','out') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'in',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_inventory_grn_item_id_foreign` (`grn_item_id`),
  KEY `stock_inventory_warehouse_id_foreign` (`warehouse_id`),
  KEY `stock_inventory_product_id_foreign` (`product_id`),
  CONSTRAINT `stock_inventory_grn_item_id_foreign` FOREIGN KEY (`grn_item_id`) REFERENCES `grn_items` (`id`),
  CONSTRAINT `stock_inventory_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `stock_inventory_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `stock_inventory` */

/*Table structure for table `sub_menus` */

DROP TABLE IF EXISTS `sub_menus`;

CREATE TABLE `sub_menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_num` tinyint unsigned NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_for` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sub menu for admin',
  `open_new_tab` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Open New Tab',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_menus_menu_id_foreign` (`menu_id`),
  KEY `sub_menus_created_by_foreign` (`created_by`),
  KEY `sub_menus_updated_by_foreign` (`updated_by`),
  CONSTRAINT `sub_menus_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  CONSTRAINT `sub_menus_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_menus` */

insert  into `sub_menus`(`id`,`menu_id`,`name`,`name_bn`,`url`,`icon_class`,`icon`,`big_icon`,`serial_num`,`status`,`slug`,`menu_for`,`open_new_tab`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,2,'Permission',NULL,'admin/acl/permission','uil uil-lock-access',NULL,NULL,1,'Active','[\"permission-list\",\"permission-delete\",\"permission-edit\",\"permission-create\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 02:18:50','2023-02-28 23:58:35'),
(2,2,'Roles',NULL,'admin/acl/roles','uil uil-shield-check',NULL,NULL,2,'Active','[\"role-delete\",\"role-edit\",\"role-create\",\"role-list\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 02:32:37','2023-02-28 23:59:11'),
(3,2,'Menu',NULL,'admin/acl/menu','uil  uil-align',NULL,NULL,3,'Active','[\"submenu-delete\",\"submenu-edit\",\"submenu-create\",\"submenu-list\",\"menu-delete\",\"menu-create\",\"menu-edit\",\"menu-list\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 02:33:11','2023-02-28 23:59:45'),
(4,2,'Users',NULL,'admin/acl/users','uil uil-user-circle',NULL,NULL,4,'Active','[\"user-delete\",\"user-edit\",\"user-create\",\"user-list\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 03:13:29','2023-03-01 00:00:30'),
(23,11,'Website',NULL,'admin/website-settings','mdi mdi-web-check',NULL,NULL,1,'Active','[\"settings-delete\",\"settings-edit\",\"settings-create\",\"settings-list\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2023-03-25 09:17:19','2023-03-25 09:17:19'),
(24,11,'Social Media',NULL,'admin/social-media-settings','mdi mdi-facebook',NULL,NULL,2,'Active','[\"settings-list\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2023-03-25 09:19:48','2023-03-25 09:19:48'),
(25,11,'Wallet Connect',NULL,'admin/wallet-connect','mdi mdi-wallet-plus',NULL,NULL,3,'Active','[\"settings-list\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2023-03-25 09:22:03','2023-03-25 09:22:03'),
(26,11,'Payment Getway',NULL,'admin/payment-getway','mdi mdi-contactless-payment',NULL,NULL,4,'Active','[\"settings-list\"]','Sub menu for admin','No Open New Tab',1,NULL,'2023-06-06 12:44:42','2023-03-25 09:34:16','2023-06-06 12:44:42'),
(27,11,'Mail Credential',NULL,'admin/mail-credential','mdi mdi-email-lock',NULL,NULL,5,'Active','[\"settings-list\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2023-03-25 09:35:20','2023-03-25 09:35:20'),
(28,12,'Departments',NULL,'admin/departments','uil-align',NULL,NULL,1,'Active','[\"department-delete\",\"department-edit\",\"department-create\",\"departments\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-01-21 05:57:18','2024-03-21 04:04:43'),
(29,12,'Document Types',NULL,'admin/document-types','uil-file',NULL,NULL,2,'Active','[\"document-type-delete\",\"document-type-edit\",\"document-type-create\",\"document-types\"]','Sub menu for admin','No Open New Tab',1,NULL,'2024-03-19 10:36:46','2024-01-21 05:58:40','2024-03-19 10:36:46'),
(30,13,'Language',NULL,'admin/languages','uil-globe',NULL,NULL,1,'Active','[\"language-delete\",\"language-edit\",\"language-create\",\"languages\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-01-23 04:14:05','2024-01-24 03:46:13'),
(31,13,'Language Library',NULL,'admin/language-library','uil-notebooks',NULL,NULL,2,'Active','[\"language-library-delete\",\"language-library-edit\",\"language-library-create\",\"language-library\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-01-23 04:14:30','2024-01-24 03:46:03'),
(32,17,'Upload Reports',NULL,'admin/upload-reports','uil-list-ui-alt',NULL,NULL,1,'Active','[\"reports-generate\",\"reports\"]','Sub menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:05','2024-01-24 03:59:16','2024-03-19 10:36:05'),
(33,17,'Documents',NULL,'admin/documents','uil-list-ui-alt',NULL,NULL,2,'Active','[\"documents\"]','Sub menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:05','2024-02-12 02:50:09','2024-03-19 10:36:05'),
(34,12,'Salesperson',NULL,'admin/salespersons','mdi mdi-account-settings',NULL,NULL,3,'Active','[\"salesperson-delete\",\"salesperson-edit\",\"salesperson-create\",\"salespersons\"]','Sub menu for admin','No Open New Tab',1,NULL,'2024-03-19 10:36:41','2024-02-14 10:58:05','2024-03-19 10:36:41'),
(35,12,'Designations',NULL,'admin/designations','mdi mdi-text',NULL,NULL,2,'Active','[\"designation-delete\",\"designation-edit\",\"designation-create\",\"designations\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-21 04:05:24','2024-03-21 04:06:11'),
(36,12,'Units',NULL,'admin/units','mdi mdi-text',NULL,NULL,3,'Active','[\"unit-delete\",\"unit-edit\",\"unit-create\",\"units\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-21 04:06:48','2024-03-21 04:06:48'),
(37,12,'Charges',NULL,'admin/charges','mdi mdi-text',NULL,NULL,4,'Active','[\"charge-delete\",\"charge-edit\",\"charge-create\",\"charges\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-21 04:07:12','2024-03-21 04:07:12'),
(38,12,'Warehouses',NULL,'admin/warehouses','mdi mdi-home',NULL,NULL,5,'Active','[\"warehouse-delete\",\"warehouse-edit\",\"warehouse-create\",\"warehouses\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-21 04:07:40','2024-03-21 04:07:53'),
(39,12,'Suppliers',NULL,'admin/suppliers','mdi mdi-account-settings',NULL,NULL,6,'Active','[\"supplier-delete\",\"supplier-edit\",\"supplier-create\",\"suppliers\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-21 04:08:26','2024-03-21 04:08:52'),
(40,12,'Customers',NULL,'admin/customers','mdi mdi-account-settings',NULL,NULL,7,'Active','[\"customer-delete\",\"customer-edit\",\"customer-create\",\"customers\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-21 04:09:35','2024-03-21 04:09:35'),
(41,19,'Attributes',NULL,'admin/attribute-options','uil-list-ui-alt',NULL,NULL,1,'Active','[\"attribute-option-delete\",\"attribute-option-edit\",\"attribute-option-create\",\"attribute-options\",\"attribute-delete\",\"attribute-edit\",\"attribute-create\",\"attributes\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-22 06:11:35','2024-03-22 06:14:15'),
(42,19,'Categories',NULL,'admin/categories','uil-list-ui-alt',NULL,NULL,2,'Active','[\"category-delete\",\"category-edit\",\"category-create\",\"categories\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-22 06:14:00','2024-03-22 06:14:00'),
(43,19,'Groups',NULL,'admin/product-groups','uil-list-ui-alt',NULL,NULL,3,'Active','[\"group-delete\",\"group-edit\",\"group-create\",\"groups\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-22 06:15:03','2024-03-22 06:15:03'),
(44,19,'Products',NULL,'admin/products','mdi mdi-format-align-justify',NULL,NULL,4,'Active','[\"product-delete\",\"product-edit\",\"product-create\",\"products\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-22 06:15:36','2024-03-22 06:17:17'),
(45,20,'Proforma Invoice',NULL,'admin/commercial/proforma-invoices','mdi mdi-paperclip',NULL,NULL,1,'Active','[\"proforma-invoice-delete\",\"proforma-invoice-edit\",\"proforma-invoice-create\",\"proforma-invoices\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-28 04:17:09','2024-03-28 04:17:09');

/*Table structure for table `sub_sub_menus` */

DROP TABLE IF EXISTS `sub_sub_menus`;

CREATE TABLE `sub_sub_menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `sub_menu_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_num` tinyint unsigned NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_for` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sub Sub Menu for admin',
  `open_new_tab` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Open New Tab',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_sub_menus_menu_id_foreign` (`menu_id`),
  KEY `sub_sub_menus_sub_menu_id_foreign` (`sub_menu_id`),
  KEY `sub_sub_menus_created_by_foreign` (`created_by`),
  KEY `sub_sub_menus_updated_by_foreign` (`updated_by`),
  CONSTRAINT `sub_sub_menus_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_sub_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  CONSTRAINT `sub_sub_menus_sub_menu_id_foreign` FOREIGN KEY (`sub_menu_id`) REFERENCES `sub_menus` (`id`),
  CONSTRAINT `sub_sub_menus_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_sub_menus` */

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agreement` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `term_conditions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suppliers_created_by_foreign` (`created_by`),
  KEY `suppliers_updated_by_foreign` (`updated_by`),
  CONSTRAINT `suppliers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `suppliers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suppliers` */

insert  into `suppliers`(`id`,`name`,`code`,`segments`,`phone`,`email`,`mobile_no`,`tin`,`trade`,`bin`,`vat`,`website`,`agreement`,`term_conditions`,`address`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Pee Vee Tex., India','SPL-01','greige',NULL,NULL,NULL,NULL,'123',NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-03-27 04:31:29','2024-03-27 04:31:29'),
(2,'UTML','SPL-02','greige',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-03-27 04:32:27','2024-03-27 04:32:27'),
(3,'Zhejiang Dream, China','SPL-03','greige',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-03-27 04:32:39','2024-03-27 04:32:39'),
(4,'Active Tex Solution','SPL-04','d&c',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-03-27 04:32:55','2024-03-27 04:32:55'),
(5,'Alfya Traders','SPL-05','d&c',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-03-27 04:33:11','2024-03-27 04:33:11');

/*Table structure for table `units` */

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `units_created_by_foreign` (`created_by`),
  KEY `units_updated_by_foreign` (`updated_by`),
  CONSTRAINT `units_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `units_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `units` */

insert  into `units`(`id`,`unit_name`,`unit_code`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Yds','U-0001','active',1,NULL,NULL,'2024-03-22 17:09:50','2024-03-22 17:13:09'),
(2,'KG','U-0002','active',1,NULL,NULL,'2024-03-22 17:09:57','2024-03-22 17:09:57'),
(3,'Gram','U-0003','active',1,1,NULL,'2024-03-22 17:10:22','2024-03-22 17:11:08'),
(4,'Pound','U-0004','active',1,NULL,NULL,'2024-03-22 17:11:14','2024-03-22 17:11:14'),
(5,'Box','U-0005','active',1,NULL,NULL,'2024-03-22 17:11:21','2024-03-22 17:11:21'),
(6,'Dozen','U-0006','active',1,NULL,NULL,'2024-03-22 17:11:29','2024-03-22 17:11:29'),
(7,'Piece','U-0007','active',1,NULL,NULL,'2024-03-22 17:11:46','2024-03-22 17:11:46');

/*Table structure for table `user_column_visibilities` */

DROP TABLE IF EXISTS `user_column_visibilities`;

CREATE TABLE `user_column_visibilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `columns` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_column_visibilities_user_id_foreign` (`user_id`),
  CONSTRAINT `user_column_visibilities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_column_visibilities` */

insert  into `user_column_visibilities`(`id`,`user_id`,`url`,`columns`,`created_at`,`updated_at`) values 
(1,1,'http://yb-customer-areas.test/admin/subscribers','[\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"false\",\"false\",\"false\",\"false\",\"false\",\"true\",\"false\",\"true\",\"false\"]','2024-02-22 07:01:22','2024-02-22 07:02:22'),
(2,1,'http://tru-fabrics-ltd.test/admin/acl/users','[\"true\",\"true\",\"true\",\"false\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\"]','2024-03-21 04:42:06','2024-03-21 04:42:06'),
(3,2,'http://tru-fabrics-ltd.test/admin/acl/users','[\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"false\",\"true\",\"true\",\"true\",\"true\"]','2024-03-21 04:46:11','2024-03-21 04:46:11'),
(4,1,'http://tru-fabrics-ltd.test/admin/units','[\"true\",\"true\",\"true\",\"true\",\"true\"]','2024-03-23 06:13:26','2024-03-23 06:13:28');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('admin','seller','customer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`username`,`phone`,`avatar`,`bio`,`company_name`,`website`,`location`,`email_verified_at`,`password`,`type`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Super Admin','admin@bizzsol.com.bd','admin@bizzsol.com.bd','01754148869','uploads/users/997180124065328.png','Bizz Solutions PLC','Bizz Solutions PLC','https://bizzsol.com.bd','Dhaka',NULL,'$2y$12$FnXSzY.0KPnl66kfgIgenu5usGKDbYIcs44idtBIaTkFfe1MCkK/S','admin','2ZwrbzM5O2zlXkpyT5SGXvaz9OyhPKRv3AgsqsODuJNvO88uBVdU0rdhXLY6','2024-01-18 22:40:25','2024-03-19 10:40:25',NULL),
(2,'Nahid','nahid@bizzsol.com.bd','nahid@bizzsol.com.bd','01689984966','uploads/users/572210324044658.png',NULL,NULL,NULL,'City centre 90/1, Level-25 Type-D2, Motijheel C/A, Dhaka-1000, Bangladesh.',NULL,'$2y$12$YIia3V7WvJYqZ2r4SVg9gum18xUZ3GrBi5yeALc.6fmiy8x69W5bu','admin','vcWowPDpUYRMc8IdoK5UdwY0v5WiJjPH07uwnthMticb41M6EtAcJNleVamA','2024-03-21 04:41:40','2024-03-21 04:46:58',NULL);

/*Table structure for table `warehouses` */

DROP TABLE IF EXISTS `warehouses`;

CREATE TABLE `warehouses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warehouses_created_by_foreign` (`created_by`),
  KEY `warehouses_updated_by_foreign` (`updated_by`),
  CONSTRAINT `warehouses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `warehouses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `warehouses` */

insert  into `warehouses`(`id`,`name`,`code`,`phone`,`email`,`location`,`address`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Greige Store','WH-001','01822252198','info@bizzsol.com.bd','Narayanganj','Noapara, Tarabo, Rupgonj, Narayanganj','active',1,NULL,NULL,'2024-03-22 17:17:44','2024-03-22 17:17:44'),
(2,'Dyes & Chemical Store','WH-002',NULL,NULL,NULL,'Noapara, Tarabo, Rupgonj, Narayanganj','active',1,NULL,NULL,'2024-03-22 17:22:05','2024-03-22 17:22:05'),
(3,'FG & Delivery Store','WH-003',NULL,NULL,'Narayanganj','Noapara, Tarabo, Rupgonj, Narayanganj','active',1,NULL,NULL,'2024-03-22 17:22:33','2024-03-22 17:22:33');

/*Table structure for table `work_order_charges` */

DROP TABLE IF EXISTS `work_order_charges`;

CREATE TABLE `work_order_charges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` bigint unsigned NOT NULL,
  `charge_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_order_charges_work_order_id_foreign` (`work_order_id`),
  KEY `work_order_charges_charge_id_foreign` (`charge_id`),
  CONSTRAINT `work_order_charges_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`),
  CONSTRAINT `work_order_charges_work_order_id_foreign` FOREIGN KEY (`work_order_id`) REFERENCES `work_orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `work_order_charges` */

/*Table structure for table `work_order_items` */

DROP TABLE IF EXISTS `work_order_items`;

CREATE TABLE `work_order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `qty` double NOT NULL DEFAULT '0',
  `sub_total` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_order_items_work_order_id_foreign` (`work_order_id`),
  KEY `work_order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `work_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `work_order_items_work_order_id_foreign` FOREIGN KEY (`work_order_id`) REFERENCES `work_orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `work_order_items` */

/*Table structure for table `work_orders` */

DROP TABLE IF EXISTS `work_orders`;

CREATE TABLE `work_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_order_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garments_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `lab_dep_approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shrinkage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `terms_condition` text COLLATE utf8mb4_unicode_ci,
  `wo_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_orders_customer_id_foreign` (`customer_id`),
  KEY `work_orders_created_by_foreign` (`created_by`),
  KEY `work_orders_updated_by_foreign` (`updated_by`),
  CONSTRAINT `work_orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `work_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `work_orders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `work_orders` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
