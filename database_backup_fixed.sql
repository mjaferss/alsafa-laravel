-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: alsafa
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO,MYSQL40' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `model_type` varchar(255) DEFAULT NULL,
  `model_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_user_id_foreign` (`user_id`),
  CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) TYPE=InnoDB AUTO_INCREMENT=5;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,1,'╪¬┘à ╪¬╪¡╪»┘è╪½ ╪º┘ä┘à╪│╪¬╪«╪»┘à: ┘à╪│╪¬╪«╪»┘à super_admin 1','updated','App\\Models\\User',1,'2025-05-28 16:28:34','2025-05-28 16:28:34');
INSERT INTO `activities` VALUES (2,1,'╪¬┘à ╪¬╪│╪¼┘è┘ä ╪º┘ä╪»╪«┘ê┘ä','login',NULL,NULL,'2025-05-28 16:44:55','2025-05-28 16:44:55');
INSERT INTO `activities` VALUES (3,1,'╪¬┘à ╪¬╪¡╪»┘è╪½ ╪º┘ä┘à┘ä┘ü ╪º┘ä╪┤╪«╪╡┘è','update_profile',NULL,NULL,'2025-05-28 16:44:55','2025-05-28 16:44:55');
INSERT INTO `activities` VALUES (4,1,'╪¬┘à ╪Ñ╪╢╪º┘ü╪⌐ ┘à╪│╪¬╪«╪»┘à ╪¼╪»┘è╪»','create_user',NULL,NULL,'2025-05-28 16:44:55','2025-05-28 16:44:55');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apartment_types`
--

DROP TABLE IF EXISTS `apartment_types`;
CREATE TABLE `apartment_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `apartment_types_created_by_foreign` (`created_by`),
  KEY `apartment_types_updated_by_foreign` (`updated_by`),
  KEY `apartment_types_name_ar_index` (`name_ar`),
  KEY `apartment_types_name_en_index` (`name_en`),
  KEY `apartment_types_is_active_index` (`is_active`),
  CONSTRAINT `apartment_types_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `apartment_types_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) TYPE=InnoDB AUTO_INCREMENT=2;

--
-- Dumping data for table `apartment_types`
--

LOCK TABLES `apartment_types` WRITE;
/*!40000 ALTER TABLE `apartment_types` DISABLE KEYS */;
INSERT INTO `apartment_types` VALUES (1,'╪º┘è╪¼╪º╪▒','rent',1,1,NULL,'2025-06-04 21:18:53','2025-06-04 21:18:53',NULL);
/*!40000 ALTER TABLE `apartment_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apartments`
--

DROP TABLE IF EXISTS `apartments`;
CREATE TABLE `apartments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tower_id` bigint(20) unsigned NOT NULL,
  `apartment_type_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `floor_number` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `apartments_created_by_foreign` (`created_by`),
  KEY `apartments_updated_by_foreign` (`updated_by`),
  KEY `apartments_tower_id_index` (`tower_id`),
  KEY `apartments_apartment_type_id_index` (`apartment_type_id`),
  KEY `apartments_floor_number_index` (`floor_number`),
  KEY `apartments_tower_id_floor_number_index` (`tower_id`,`floor_number`),
  CONSTRAINT `apartments_apartment_type_id_foreign` FOREIGN KEY (`apartment_type_id`) REFERENCES `apartment_types` (`id`),
  CONSTRAINT `apartments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `apartments_tower_id_foreign` FOREIGN KEY (`tower_id`) REFERENCES `towers` (`id`),
  CONSTRAINT `apartments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) TYPE=InnoDB AUTO_INCREMENT=2;

--
-- Dumping data for table `apartments`
--

LOCK TABLES `apartments` WRITE;
/*!40000 ALTER TABLE `apartments` DISABLE KEYS */;
INSERT INTO `apartments` VALUES (1,3,1,'2565',2,1500.00,1,NULL,'2025-06-04 21:19:51','2025-06-04 21:19:51',NULL);
/*!40000 ALTER TABLE `apartments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `address_ar` varchar(255) DEFAULT NULL,
  `address_en` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) TYPE=InnoDB AUTO_INCREMENT=6;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'┘ü╪▒╪╣ ╪º┘ä╪▒┘è╪º╪╢','Riyadh Branch','╪º┘ä╪▒┘è╪º╪╢╪î ╪¡┘è ╪º┘ä┘à┘ä┘é╪º','Riyadh, Al Malqa District','+966512345678',1,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `branches` VALUES (2,'┘ü╪▒╪╣ ╪┤┘à╪º┘ä ╪º┘ä╪▒┘è╪º╪╢','North Riyadh Branch','╪¡┘è ╪º┘ä┘å╪«┘è┘ä╪î ╪º┘ä╪▒┘è╪º╪╢','Al Nakheel District, Riyadh','+966500000002',1,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `branches` VALUES (3,'┘ü╪▒╪╣ ╪┤╪▒┘é ╪º┘ä╪▒┘è╪º╪╢','East Riyadh Branch','╪¡┘è ╪º┘ä╪▒┘ê╪╢╪⌐╪î ╪º┘ä╪▒┘è╪º╪╢','Al Rawdah District, Riyadh','+966500000003',1,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `branches` VALUES (4,'┘ü╪▒╪╣ ╪║╪▒╪¿ ╪º┘ä╪▒┘è╪º╪╢','West Riyadh Branch','╪¡┘è ╪º┘ä╪│┘ê┘è╪»┘è╪î ╪º┘ä╪▒┘è╪º╪╢','Al Suwaidi District, Riyadh','+966500000004',1,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `branches` VALUES (5,'┘ü╪▒╪╣ ╪¼┘å┘ê╪¿ ╪º┘ä╪▒┘è╪º╪╢','South Riyadh Branch','╪¡┘è ╪º┘ä╪│┘ä┘è╪î ╪º┘ä╪▒┘è╪º╪╢','Al Sulay District, Riyadh','+966500000005',1,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) TYPE=InnoDB;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `main_sections`
--

DROP TABLE IF EXISTS `main_sections`;
CREATE TABLE `main_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `main_sections_created_by_foreign` (`created_by`),
  KEY `main_sections_updated_by_foreign` (`updated_by`),
  CONSTRAINT `main_sections_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `main_sections_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) TYPE=InnoDB AUTO_INCREMENT=22;

--
-- Dumping data for table `main_sections`
--

LOCK TABLES `main_sections` WRITE;
/*!40000 ALTER TABLE `main_sections` DISABLE KEYS */;
INSERT INTO `main_sections` VALUES (1,'╪º┘ä╪│╪¿╪º┘â╪⌐','Plumbing',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (2,'╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Electricity',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (3,'╪º┘ä╪¬┘â┘è┘è┘ü','Air Conditioning',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (4,'╪º┘ä┘å╪¼╪º╪▒╪⌐','Carpentry',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (5,'╪º┘ä╪»┘ç╪º┘å','Painting',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (6,'╪º┘ä╪¿┘ä╪º╪╖','Tiles',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (7,'╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Aluminum',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (8,'╪º┘ä╪¡╪»╪º╪»╪⌐','Blacksmith',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (9,'╪º┘ä╪▓╪¼╪º╪¼','Glass',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (10,'╪º┘ä╪╣╪▓┘ä','Insulation',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (11,'┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Fire Fighting',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (12,'╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','General Maintenance',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (13,'┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Construction and Renovation',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (14,'┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Gardens',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (15,'┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Parking',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (16,'┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Swimming Pools',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (17,'┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Windows and Doors',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (18,'┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Decoration',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (19,'┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Insulation',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (20,'┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Aluminum',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `main_sections` VALUES (21,'┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Marble and Ceramic',0.00,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
/*!40000 ALTER TABLE `main_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance_descriptions`
--

DROP TABLE IF EXISTS `maintenance_descriptions`;
CREATE TABLE `maintenance_descriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `main_section_id` bigint(20) unsigned NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maintenance_descriptions_main_section_id_foreign` (`main_section_id`),
  KEY `maintenance_descriptions_created_by_foreign` (`created_by`),
  CONSTRAINT `maintenance_descriptions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `maintenance_descriptions_main_section_id_foreign` FOREIGN KEY (`main_section_id`) REFERENCES `main_sections` (`id`)
) TYPE=InnoDB AUTO_INCREMENT=106;

--
-- Dumping data for table `maintenance_descriptions`
--

LOCK TABLES `maintenance_descriptions` WRITE;
/*!40000 ALTER TABLE `maintenance_descriptions` DISABLE KEYS */;
INSERT INTO `maintenance_descriptions` VALUES (1,1,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä╪│╪¿╪º┘â╪⌐','Maintenance 1 - Plumbing','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä╪│╪¿╪º┘â╪⌐','Description for maintenance 1 in section Plumbing',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (2,1,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä╪│╪¿╪º┘â╪⌐','Maintenance 2 - Plumbing','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä╪│╪¿╪º┘â╪⌐','Description for maintenance 2 in section Plumbing',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (3,1,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä╪│╪¿╪º┘â╪⌐','Maintenance 3 - Plumbing','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä╪│╪¿╪º┘â╪⌐','Description for maintenance 3 in section Plumbing',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (4,1,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä╪│╪¿╪º┘â╪⌐','Maintenance 4 - Plumbing','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä╪│╪¿╪º┘â╪⌐','Description for maintenance 4 in section Plumbing',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (5,1,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä╪│╪¿╪º┘â╪⌐','Maintenance 5 - Plumbing','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä╪│╪¿╪º┘â╪⌐','Description for maintenance 5 in section Plumbing',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (6,2,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Maintenance 1 - Electricity','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Description for maintenance 1 in section Electricity',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (7,2,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Maintenance 2 - Electricity','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Description for maintenance 2 in section Electricity',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (8,2,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Maintenance 3 - Electricity','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Description for maintenance 3 in section Electricity',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (9,2,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Maintenance 4 - Electricity','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Description for maintenance 4 in section Electricity',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (10,2,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Maintenance 5 - Electricity','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä┘â┘ç╪▒╪¿╪º╪í','Description for maintenance 5 in section Electricity',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (11,3,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä╪¬┘â┘è┘è┘ü','Maintenance 1 - Air Conditioning','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¬┘â┘è┘è┘ü','Description for maintenance 1 in section Air Conditioning',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (12,3,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä╪¬┘â┘è┘è┘ü','Maintenance 2 - Air Conditioning','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¬┘â┘è┘è┘ü','Description for maintenance 2 in section Air Conditioning',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (13,3,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä╪¬┘â┘è┘è┘ü','Maintenance 3 - Air Conditioning','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¬┘â┘è┘è┘ü','Description for maintenance 3 in section Air Conditioning',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (14,3,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä╪¬┘â┘è┘è┘ü','Maintenance 4 - Air Conditioning','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¬┘â┘è┘è┘ü','Description for maintenance 4 in section Air Conditioning',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (15,3,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä╪¬┘â┘è┘è┘ü','Maintenance 5 - Air Conditioning','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¬┘â┘è┘è┘ü','Description for maintenance 5 in section Air Conditioning',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (16,4,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä┘å╪¼╪º╪▒╪⌐','Maintenance 1 - Carpentry','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä┘å╪¼╪º╪▒╪⌐','Description for maintenance 1 in section Carpentry',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (17,4,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä┘å╪¼╪º╪▒╪⌐','Maintenance 2 - Carpentry','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä┘å╪¼╪º╪▒╪⌐','Description for maintenance 2 in section Carpentry',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (18,4,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä┘å╪¼╪º╪▒╪⌐','Maintenance 3 - Carpentry','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä┘å╪¼╪º╪▒╪⌐','Description for maintenance 3 in section Carpentry',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (19,4,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä┘å╪¼╪º╪▒╪⌐','Maintenance 4 - Carpentry','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä┘å╪¼╪º╪▒╪⌐','Description for maintenance 4 in section Carpentry',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (20,4,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä┘å╪¼╪º╪▒╪⌐','Maintenance 5 - Carpentry','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä┘å╪¼╪º╪▒╪⌐','Description for maintenance 5 in section Carpentry',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (21,5,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä╪»┘ç╪º┘å','Maintenance 1 - Painting','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä╪»┘ç╪º┘å','Description for maintenance 1 in section Painting',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (22,5,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä╪»┘ç╪º┘å','Maintenance 2 - Painting','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä╪»┘ç╪º┘å','Description for maintenance 2 in section Painting',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (23,5,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä╪»┘ç╪º┘å','Maintenance 3 - Painting','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä╪»┘ç╪º┘å','Description for maintenance 3 in section Painting',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (24,5,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä╪»┘ç╪º┘å','Maintenance 4 - Painting','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä╪»┘ç╪º┘å','Description for maintenance 4 in section Painting',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (25,5,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä╪»┘ç╪º┘å','Maintenance 5 - Painting','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä╪»┘ç╪º┘å','Description for maintenance 5 in section Painting',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (26,6,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä╪¿┘ä╪º╪╖','Maintenance 1 - Tiles','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¿┘ä╪º╪╖','Description for maintenance 1 in section Tiles',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (27,6,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä╪¿┘ä╪º╪╖','Maintenance 2 - Tiles','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¿┘ä╪º╪╖','Description for maintenance 2 in section Tiles',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (28,6,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä╪¿┘ä╪º╪╖','Maintenance 3 - Tiles','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¿┘ä╪º╪╖','Description for maintenance 3 in section Tiles',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (29,6,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä╪¿┘ä╪º╪╖','Maintenance 4 - Tiles','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¿┘ä╪º╪╖','Description for maintenance 4 in section Tiles',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (30,6,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä╪¿┘ä╪º╪╖','Maintenance 5 - Tiles','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¿┘ä╪º╪╖','Description for maintenance 5 in section Tiles',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (31,7,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Maintenance 1 - Aluminum','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Description for maintenance 1 in section Aluminum',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (32,7,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Maintenance 2 - Aluminum','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Description for maintenance 2 in section Aluminum',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (33,7,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Maintenance 3 - Aluminum','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Description for maintenance 3 in section Aluminum',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (34,7,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Maintenance 4 - Aluminum','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Description for maintenance 4 in section Aluminum',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (35,7,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Maintenance 5 - Aluminum','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Description for maintenance 5 in section Aluminum',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (36,8,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä╪¡╪»╪º╪»╪⌐','Maintenance 1 - Blacksmith','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¡╪»╪º╪»╪⌐','Description for maintenance 1 in section Blacksmith',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (37,8,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä╪¡╪»╪º╪»╪⌐','Maintenance 2 - Blacksmith','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¡╪»╪º╪»╪⌐','Description for maintenance 2 in section Blacksmith',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (38,8,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä╪¡╪»╪º╪»╪⌐','Maintenance 3 - Blacksmith','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¡╪»╪º╪»╪⌐','Description for maintenance 3 in section Blacksmith',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (39,8,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä╪¡╪»╪º╪»╪⌐','Maintenance 4 - Blacksmith','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¡╪»╪º╪»╪⌐','Description for maintenance 4 in section Blacksmith',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (40,8,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä╪¡╪»╪º╪»╪⌐','Maintenance 5 - Blacksmith','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä╪¡╪»╪º╪»╪⌐','Description for maintenance 5 in section Blacksmith',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (41,9,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä╪▓╪¼╪º╪¼','Maintenance 1 - Glass','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä╪▓╪¼╪º╪¼','Description for maintenance 1 in section Glass',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (42,9,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä╪▓╪¼╪º╪¼','Maintenance 2 - Glass','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä╪▓╪¼╪º╪¼','Description for maintenance 2 in section Glass',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (43,9,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä╪▓╪¼╪º╪¼','Maintenance 3 - Glass','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä╪▓╪¼╪º╪¼','Description for maintenance 3 in section Glass',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (44,9,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä╪▓╪¼╪º╪¼','Maintenance 4 - Glass','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä╪▓╪¼╪º╪¼','Description for maintenance 4 in section Glass',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (45,9,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä╪▓╪¼╪º╪¼','Maintenance 5 - Glass','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä╪▓╪¼╪º╪¼','Description for maintenance 5 in section Glass',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (46,10,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä╪╣╪▓┘ä','Maintenance 1 - Insulation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Description for maintenance 1 in section Insulation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (47,10,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä╪╣╪▓┘ä','Maintenance 2 - Insulation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Description for maintenance 2 in section Insulation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (48,10,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä╪╣╪▓┘ä','Maintenance 3 - Insulation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Description for maintenance 3 in section Insulation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (49,10,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä╪╣╪▓┘ä','Maintenance 4 - Insulation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Description for maintenance 4 in section Insulation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (50,10,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä╪╣╪▓┘ä','Maintenance 5 - Insulation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Description for maintenance 5 in section Insulation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (51,11,'╪╡┘è╪º┘å╪⌐ 1 - ┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Maintenance 1 - Fire Fighting','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Description for maintenance 1 in section Fire Fighting',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (52,11,'╪╡┘è╪º┘å╪⌐ 2 - ┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Maintenance 2 - Fire Fighting','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Description for maintenance 2 in section Fire Fighting',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (53,11,'╪╡┘è╪º┘å╪⌐ 3 - ┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Maintenance 3 - Fire Fighting','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Description for maintenance 3 in section Fire Fighting',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (54,11,'╪╡┘è╪º┘å╪⌐ 4 - ┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Maintenance 4 - Fire Fighting','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Description for maintenance 4 in section Fire Fighting',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (55,11,'╪╡┘è╪º┘å╪⌐ 5 - ┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Maintenance 5 - Fire Fighting','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ┘à┘â╪º┘ü╪¡╪⌐ ╪º┘ä╪¡╪▒╪º╪ª┘é','Description for maintenance 5 in section Fire Fighting',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (56,12,'╪╡┘è╪º┘å╪⌐ 1 - ╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','Maintenance 1 - General Maintenance','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','Description for maintenance 1 in section General Maintenance',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (57,12,'╪╡┘è╪º┘å╪⌐ 2 - ╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','Maintenance 2 - General Maintenance','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','Description for maintenance 2 in section General Maintenance',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (58,12,'╪╡┘è╪º┘å╪⌐ 3 - ╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','Maintenance 3 - General Maintenance','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','Description for maintenance 3 in section General Maintenance',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (59,12,'╪╡┘è╪º┘å╪⌐ 4 - ╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','Maintenance 4 - General Maintenance','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','Description for maintenance 4 in section General Maintenance',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (60,12,'╪╡┘è╪º┘å╪⌐ 5 - ╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','Maintenance 5 - General Maintenance','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ╪º┘ä╪╡┘è╪º┘å╪⌐ ╪º┘ä╪╣╪º┘à╪⌐','Description for maintenance 5 in section General Maintenance',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (61,13,'╪╡┘è╪º┘å╪⌐ 1 - ┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Maintenance 1 - Construction and Renovation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Description for maintenance 1 in section Construction and Renovation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (62,13,'╪╡┘è╪º┘å╪⌐ 2 - ┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Maintenance 2 - Construction and Renovation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Description for maintenance 2 in section Construction and Renovation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (63,13,'╪╡┘è╪º┘å╪⌐ 3 - ┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Maintenance 3 - Construction and Renovation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Description for maintenance 3 in section Construction and Renovation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (64,13,'╪╡┘è╪º┘å╪⌐ 4 - ┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Maintenance 4 - Construction and Renovation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Description for maintenance 4 in section Construction and Renovation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (65,13,'╪╡┘è╪º┘å╪⌐ 5 - ┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Maintenance 5 - Construction and Renovation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪¿┘å╪º╪í ┘ê╪º┘ä╪¬╪▒┘à┘è┘à','Description for maintenance 5 in section Construction and Renovation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (66,14,'╪╡┘è╪º┘å╪⌐ 1 - ┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Maintenance 1 - Gardens','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Description for maintenance 1 in section Gardens',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (67,14,'╪╡┘è╪º┘å╪⌐ 2 - ┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Maintenance 2 - Gardens','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Description for maintenance 2 in section Gardens',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (68,14,'╪╡┘è╪º┘å╪⌐ 3 - ┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Maintenance 3 - Gardens','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Description for maintenance 3 in section Gardens',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (69,14,'╪╡┘è╪º┘å╪⌐ 4 - ┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Maintenance 4 - Gardens','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Description for maintenance 4 in section Gardens',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (70,14,'╪╡┘è╪º┘å╪⌐ 5 - ┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Maintenance 5 - Gardens','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪¡╪»╪º╪ª┘é','Description for maintenance 5 in section Gardens',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (71,15,'╪╡┘è╪º┘å╪⌐ 1 - ┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Maintenance 1 - Parking','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Description for maintenance 1 in section Parking',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (72,15,'╪╡┘è╪º┘å╪⌐ 2 - ┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Maintenance 2 - Parking','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Description for maintenance 2 in section Parking',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (73,15,'╪╡┘è╪º┘å╪⌐ 3 - ┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Maintenance 3 - Parking','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Description for maintenance 3 in section Parking',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (74,15,'╪╡┘è╪º┘å╪⌐ 4 - ┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Maintenance 4 - Parking','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Description for maintenance 4 in section Parking',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (75,15,'╪╡┘è╪º┘å╪⌐ 5 - ┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Maintenance 5 - Parking','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘à┘ê╪º┘é┘ü','Description for maintenance 5 in section Parking',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (76,16,'╪╡┘è╪º┘å╪⌐ 1 - ┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Maintenance 1 - Swimming Pools','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Description for maintenance 1 in section Swimming Pools',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (77,16,'╪╡┘è╪º┘å╪⌐ 2 - ┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Maintenance 2 - Swimming Pools','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Description for maintenance 2 in section Swimming Pools',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (78,16,'╪╡┘è╪º┘å╪⌐ 3 - ┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Maintenance 3 - Swimming Pools','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Description for maintenance 3 in section Swimming Pools',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (79,16,'╪╡┘è╪º┘å╪⌐ 4 - ┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Maintenance 4 - Swimming Pools','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Description for maintenance 4 in section Swimming Pools',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (80,16,'╪╡┘è╪º┘å╪⌐ 5 - ┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Maintenance 5 - Swimming Pools','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘à╪│╪º╪¿╪¡','Description for maintenance 5 in section Swimming Pools',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (81,17,'╪╡┘è╪º┘å╪⌐ 1 - ┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Maintenance 1 - Windows and Doors','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Description for maintenance 1 in section Windows and Doors',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (82,17,'╪╡┘è╪º┘å╪⌐ 2 - ┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Maintenance 2 - Windows and Doors','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Description for maintenance 2 in section Windows and Doors',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (83,17,'╪╡┘è╪º┘å╪⌐ 3 - ┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Maintenance 3 - Windows and Doors','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Description for maintenance 3 in section Windows and Doors',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (84,17,'╪╡┘è╪º┘å╪⌐ 4 - ┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Maintenance 4 - Windows and Doors','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Description for maintenance 4 in section Windows and Doors',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (85,17,'╪╡┘è╪º┘å╪⌐ 5 - ┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Maintenance 5 - Windows and Doors','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä┘å┘ê╪º┘ü╪░ ┘ê╪º┘ä╪ú╪¿┘ê╪º╪¿','Description for maintenance 5 in section Windows and Doors',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (86,18,'╪╡┘è╪º┘å╪⌐ 1 - ┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Maintenance 1 - Decoration','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Description for maintenance 1 in section Decoration',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (87,18,'╪╡┘è╪º┘å╪⌐ 2 - ┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Maintenance 2 - Decoration','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Description for maintenance 2 in section Decoration',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (88,18,'╪╡┘è╪º┘å╪⌐ 3 - ┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Maintenance 3 - Decoration','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Description for maintenance 3 in section Decoration',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (89,18,'╪╡┘è╪º┘å╪⌐ 4 - ┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Maintenance 4 - Decoration','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Description for maintenance 4 in section Decoration',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (90,18,'╪╡┘è╪º┘å╪⌐ 5 - ┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Maintenance 5 - Decoration','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪»┘è┘â┘ê╪▒','Description for maintenance 5 in section Decoration',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (91,19,'╪╡┘è╪º┘å╪⌐ 1 - ┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Maintenance 1 - Insulation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Description for maintenance 1 in section Insulation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (92,19,'╪╡┘è╪º┘å╪⌐ 2 - ┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Maintenance 2 - Insulation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Description for maintenance 2 in section Insulation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (93,19,'╪╡┘è╪º┘å╪⌐ 3 - ┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Maintenance 3 - Insulation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Description for maintenance 3 in section Insulation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (94,19,'╪╡┘è╪º┘å╪⌐ 4 - ┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Maintenance 4 - Insulation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Description for maintenance 4 in section Insulation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (95,19,'╪╡┘è╪º┘å╪⌐ 5 - ┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Maintenance 5 - Insulation','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪╣╪▓┘ä','Description for maintenance 5 in section Insulation',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (96,20,'╪╡┘è╪º┘å╪⌐ 1 - ┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Maintenance 1 - Aluminum','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Description for maintenance 1 in section Aluminum',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (97,20,'╪╡┘è╪º┘å╪⌐ 2 - ┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Maintenance 2 - Aluminum','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Description for maintenance 2 in section Aluminum',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (98,20,'╪╡┘è╪º┘å╪⌐ 3 - ┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Maintenance 3 - Aluminum','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Description for maintenance 3 in section Aluminum',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (99,20,'╪╡┘è╪º┘å╪⌐ 4 - ┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Maintenance 4 - Aluminum','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Description for maintenance 4 in section Aluminum',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (100,20,'╪╡┘è╪º┘å╪⌐ 5 - ┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Maintenance 5 - Aluminum','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪ú┘ä┘à┘å┘è┘ê┘à','Description for maintenance 5 in section Aluminum',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (101,21,'╪╡┘è╪º┘å╪⌐ 1 - ┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Maintenance 1 - Marble and Ceramic','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 1 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Description for maintenance 1 in section Marble and Ceramic',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (102,21,'╪╡┘è╪º┘å╪⌐ 2 - ┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Maintenance 2 - Marble and Ceramic','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 2 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Description for maintenance 2 in section Marble and Ceramic',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (103,21,'╪╡┘è╪º┘å╪⌐ 3 - ┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Maintenance 3 - Marble and Ceramic','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 3 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Description for maintenance 3 in section Marble and Ceramic',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (104,21,'╪╡┘è╪º┘å╪⌐ 4 - ┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Maintenance 4 - Marble and Ceramic','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 4 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Description for maintenance 4 in section Marble and Ceramic',1,1,NULL,NULL);
INSERT INTO `maintenance_descriptions` VALUES (105,21,'╪╡┘è╪º┘å╪⌐ 5 - ┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Maintenance 5 - Marble and Ceramic','┘ê╪╡┘ü ╪º┘ä╪╡┘è╪º┘å╪⌐ 5 ┘ä┘ä┘é╪│┘à ┘é╪│┘à ╪º┘ä╪▒╪«╪º┘à ┘ê╪º┘ä╪│┘è╪▒╪º┘à┘è┘â','Description for maintenance 5 in section Marble and Ceramic',1,1,NULL,NULL);
/*!40000 ALTER TABLE `maintenance_descriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance_request_items`
--

DROP TABLE IF EXISTS `maintenance_request_items`;
CREATE TABLE `maintenance_request_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `maintenance_request_id` bigint(20) unsigned NOT NULL,
  `maintenance_description_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `has_tax` tinyint(1) NOT NULL DEFAULT 1,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maintenance_request_items_maintenance_request_id_foreign` (`maintenance_request_id`),
  KEY `maintenance_request_items_maintenance_description_id_foreign` (`maintenance_description_id`),
  CONSTRAINT `maintenance_request_items_maintenance_description_id_foreign` FOREIGN KEY (`maintenance_description_id`) REFERENCES `maintenance_descriptions` (`id`),
  CONSTRAINT `maintenance_request_items_maintenance_request_id_foreign` FOREIGN KEY (`maintenance_request_id`) REFERENCES `maintenance_requests` (`id`) ON DELETE CASCADE
) TYPE=InnoDB AUTO_INCREMENT=61;

--
-- Dumping data for table `maintenance_request_items`
--

LOCK TABLES `maintenance_request_items` WRITE;
/*!40000 ALTER TABLE `maintenance_request_items` DISABLE KEYS */;
INSERT INTO `maintenance_request_items` VALUES (1,1,15,5,448.00,1,336.00,2240.00,2576.00,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (2,1,61,5,893.00,1,669.75,4465.00,5134.75,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (3,1,91,2,464.00,1,139.20,928.00,1067.20,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (4,2,11,1,811.00,1,121.65,811.00,932.65,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (5,2,49,2,929.00,1,278.70,1858.00,2136.70,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (6,2,51,5,239.00,1,179.25,1195.00,1374.25,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (7,3,55,4,132.00,1,79.20,528.00,607.20,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (8,3,87,5,589.00,1,441.75,2945.00,3386.75,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (9,3,103,1,732.00,1,109.80,732.00,841.80,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (10,4,19,3,284.00,1,127.80,852.00,979.80,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (11,4,44,5,968.00,1,726.00,4840.00,5566.00,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (12,4,52,5,241.00,1,180.75,1205.00,1385.75,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (13,5,46,2,873.00,1,261.90,1746.00,2007.90,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (14,5,65,4,764.00,1,458.40,3056.00,3514.40,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (15,5,96,1,199.00,1,29.85,199.00,228.85,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (16,6,35,1,664.00,1,99.60,664.00,763.60,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (17,6,68,3,538.00,1,242.10,1614.00,1856.10,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (18,6,80,5,432.00,1,324.00,2160.00,2484.00,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (19,7,51,1,574.00,1,86.10,574.00,660.10,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (20,7,94,1,598.00,1,89.70,598.00,687.70,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (21,7,103,4,223.00,1,133.80,892.00,1025.80,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (22,8,32,2,611.00,1,183.30,1222.00,1405.30,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (23,8,35,2,488.00,1,146.40,976.00,1122.40,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (24,8,81,5,143.00,1,107.25,715.00,822.25,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (25,9,29,2,122.00,1,36.60,244.00,280.60,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (26,9,61,2,687.00,1,206.10,1374.00,1580.10,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (27,9,90,5,675.00,1,506.25,3375.00,3881.25,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (28,10,44,2,159.00,1,47.70,318.00,365.70,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (29,10,52,4,397.00,1,238.20,1588.00,1826.20,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (30,10,96,3,453.00,1,203.85,1359.00,1562.85,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (31,11,26,3,913.00,1,410.85,2739.00,3149.85,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (32,11,42,5,613.00,1,459.75,3065.00,3524.75,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (33,11,58,3,928.00,1,417.60,2784.00,3201.60,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (34,12,59,5,697.00,1,522.75,3485.00,4007.75,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (35,12,96,3,288.00,1,129.60,864.00,993.60,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (36,12,105,3,459.00,1,206.55,1377.00,1583.55,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (37,13,34,5,535.00,1,401.25,2675.00,3076.25,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (38,13,39,1,960.00,1,144.00,960.00,1104.00,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (39,13,104,4,530.00,1,318.00,2120.00,2438.00,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (40,14,26,1,760.00,1,114.00,760.00,874.00,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (41,14,44,4,663.00,1,397.80,2652.00,3049.80,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (42,14,68,3,489.00,1,220.05,1467.00,1687.05,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (43,15,7,3,728.00,1,327.60,2184.00,2511.60,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (44,15,19,3,593.00,1,266.85,1779.00,2045.85,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (45,15,40,2,132.00,1,39.60,264.00,303.60,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (46,16,12,1,828.00,1,124.20,828.00,952.20,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (47,16,68,2,915.00,1,274.50,1830.00,2104.50,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (48,16,79,2,452.00,1,135.60,904.00,1039.60,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (49,17,3,5,882.00,1,661.50,4410.00,5071.50,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (50,17,31,5,449.00,1,336.75,2245.00,2581.75,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (51,17,75,5,757.00,1,567.75,3785.00,4352.75,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (52,18,31,2,257.00,1,77.10,514.00,591.10,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (53,18,32,5,261.00,1,195.75,1305.00,1500.75,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (54,18,47,5,532.00,1,399.00,2660.00,3059.00,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (55,19,47,5,135.00,1,101.25,675.00,776.25,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (56,19,67,5,559.00,1,419.25,2795.00,3214.25,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (57,19,98,2,519.00,1,155.70,1038.00,1193.70,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (58,20,33,1,900.00,1,135.00,900.00,1035.00,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (59,20,69,5,764.00,1,573.00,3820.00,4393.00,'2025-05-26 13:57:10','2025-05-26 13:57:10');
INSERT INTO `maintenance_request_items` VALUES (60,20,94,2,946.00,1,283.80,1892.00,2175.80,'2025-05-26 13:57:10','2025-05-26 13:57:10');
/*!40000 ALTER TABLE `maintenance_request_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance_requests`
--

DROP TABLE IF EXISTS `maintenance_requests`;
CREATE TABLE `maintenance_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `branch_id` bigint(20) unsigned NOT NULL,
  `tower_id` bigint(20) unsigned NOT NULL,
  `main_section_id` bigint(20) unsigned NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('pending','supervisor_approved','supervisor_rejected','manager_approved','manager_rejected') NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `supervisor_id` bigint(20) unsigned DEFAULT NULL,
  `supervisor_notes` text DEFAULT NULL,
  `supervisor_action_at` timestamp NULL DEFAULT NULL,
  `manager_id` bigint(20) unsigned DEFAULT NULL,
  `manager_notes` text DEFAULT NULL,
  `manager_action_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maintenance_requests_user_id_foreign` (`user_id`),
  KEY `maintenance_requests_branch_id_foreign` (`branch_id`),
  KEY `maintenance_requests_tower_id_foreign` (`tower_id`),
  KEY `maintenance_requests_main_section_id_foreign` (`main_section_id`),
  KEY `maintenance_requests_supervisor_id_foreign` (`supervisor_id`),
  KEY `maintenance_requests_manager_id_foreign` (`manager_id`),
  CONSTRAINT `maintenance_requests_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `maintenance_requests_main_section_id_foreign` FOREIGN KEY (`main_section_id`) REFERENCES `main_sections` (`id`),
  CONSTRAINT `maintenance_requests_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`),
  CONSTRAINT `maintenance_requests_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`),
  CONSTRAINT `maintenance_requests_tower_id_foreign` FOREIGN KEY (`tower_id`) REFERENCES `towers` (`id`),
  CONSTRAINT `maintenance_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) TYPE=InnoDB AUTO_INCREMENT=21;

--
-- Dumping data for table `maintenance_requests`
--

LOCK TABLES `maintenance_requests` WRITE;
/*!40000 ALTER TABLE `maintenance_requests` DISABLE KEYS */;
INSERT INTO `maintenance_requests` VALUES (1,4,1,1,9,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',7633.00,1144.95,8777.95,1,3,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (2,4,1,2,8,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',3864.00,579.60,4443.60,1,3,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (3,4,1,3,5,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',4205.00,630.75,4835.75,1,3,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (4,4,1,4,5,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',6897.00,1034.55,7931.55,1,3,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (5,8,2,5,10,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',5001.00,750.15,5751.15,1,7,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (6,8,2,6,18,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',4438.00,665.70,5103.70,1,7,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (7,8,2,7,5,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',2064.00,309.60,2373.60,1,7,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (8,8,2,8,13,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',2913.00,436.95,3349.95,1,7,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (9,12,3,9,4,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',4993.00,748.95,5741.95,1,11,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (10,12,3,10,2,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',3265.00,489.75,3754.75,1,11,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (11,12,3,11,17,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',8588.00,1288.20,9876.20,1,11,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (12,12,3,12,9,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',5726.00,858.90,6584.90,1,11,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (13,16,4,13,17,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',5755.00,863.25,6618.25,1,15,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (14,16,4,14,9,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',4879.00,731.85,5610.85,1,15,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (15,16,4,15,2,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',4227.00,634.05,4861.05,1,15,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (16,16,4,16,17,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',3562.00,534.30,4096.30,1,15,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (17,20,5,17,2,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',10440.00,1566.00,12006.00,1,19,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (18,20,5,18,15,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',4479.00,671.85,5150.85,1,19,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (19,20,5,19,6,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',4508.00,676.20,5184.20,1,19,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
INSERT INTO `maintenance_requests` VALUES (20,20,5,20,1,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪╣┘ä┘ë ╪º┘ä╪╖┘ä╪¿','pending',6612.00,991.80,7603.80,1,19,'┘à┘ä╪º╪¡╪╕╪º╪¬ ╪º┘ä┘à╪┤╪▒┘ü','2025-05-26 13:57:10',NULL,NULL,NULL,'2025-05-26 13:57:10','2025-05-26 13:57:10',NULL);
/*!40000 ALTER TABLE `maintenance_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=InnoDB AUTO_INCREMENT=14;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO `migrations` VALUES (2,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` VALUES (3,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` VALUES (4,'2025_05_25_222550_create_branches_table',1);
INSERT INTO `migrations` VALUES (5,'2025_05_25_222613_create_users_table',1);
INSERT INTO `migrations` VALUES (6,'2025_05_25_223402_create_main_sections_table',1);
INSERT INTO `migrations` VALUES (7,'2025_05_25_224110_create_towers_table',1);
INSERT INTO `migrations` VALUES (8,'2025_05_25_224700_create_maintenance_requests_table',1);
INSERT INTO `migrations` VALUES (9,'2025_05_25_225704_create_maintenance_descriptions_table',1);
INSERT INTO `migrations` VALUES (10,'2025_05_25_225758_create_maintenance_request_items_table',1);
INSERT INTO `migrations` VALUES (11,'2024_05_28_000000_create_activities_table',2);
INSERT INTO `migrations` VALUES (12,'2025_06_04_231509_create_apartment_types_table',3);
INSERT INTO `migrations` VALUES (13,'2025_06_04_231725_create_apartments_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) TYPE=InnoDB;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) TYPE=InnoDB;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `towers`
--

DROP TABLE IF EXISTS `towers`;
CREATE TABLE `towers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `branch_id` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `towers_branch_id_foreign` (`branch_id`),
  KEY `towers_created_by_foreign` (`created_by`),
  KEY `towers_updated_by_foreign` (`updated_by`),
  CONSTRAINT `towers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `towers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `towers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) TYPE=InnoDB AUTO_INCREMENT=21;

--
-- Dumping data for table `towers`
--

LOCK TABLES `towers` WRITE;
/*!40000 ALTER TABLE `towers` DISABLE KEYS */;
INSERT INTO `towers` VALUES (1,'╪¿╪▒╪¼ 1 - ┘ü╪▒╪╣ ╪º┘ä╪▒┘è╪º╪╢','Tower 1 - Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 1 - ┘ü╪▒╪╣ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 1 - Riyadh Branch',0.00,1,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (2,'╪¿╪▒╪¼ 2 - ┘ü╪▒╪╣ ╪º┘ä╪▒┘è╪º╪╢','Tower 2 - Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 2 - ┘ü╪▒╪╣ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 2 - Riyadh Branch',12222.00,1,1,1,1,'2025-05-26 13:57:09','2025-06-04 19:14:39',NULL);
INSERT INTO `towers` VALUES (3,'╪¿╪▒╪¼ 3 - ┘ü╪▒╪╣ ╪º┘ä╪▒┘è╪º╪╢','Tower 3 - Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 3 - ┘ü╪▒╪╣ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 3 - Riyadh Branch',0.00,1,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (4,'╪¿╪▒╪¼ 4 - ┘ü╪▒╪╣ ╪º┘ä╪▒┘è╪º╪╢','Tower 4 - Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 4 - ┘ü╪▒╪╣ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 4 - Riyadh Branch',0.00,1,1,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (5,'╪¿╪▒╪¼ 1 - ┘ü╪▒╪╣ ╪┤┘à╪º┘ä ╪º┘ä╪▒┘è╪º╪╢','Tower 1 - North Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 1 - ┘ü╪▒╪╣ ╪┤┘à╪º┘ä ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 1 - North Riyadh Branch',0.00,1,2,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (6,'╪¿╪▒╪¼ 2 - ┘ü╪▒╪╣ ╪┤┘à╪º┘ä ╪º┘ä╪▒┘è╪º╪╢','Tower 2 - North Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 2 - ┘ü╪▒╪╣ ╪┤┘à╪º┘ä ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 2 - North Riyadh Branch',0.00,1,2,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (7,'╪¿╪▒╪¼ 3 - ┘ü╪▒╪╣ ╪┤┘à╪º┘ä ╪º┘ä╪▒┘è╪º╪╢','Tower 3 - North Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 3 - ┘ü╪▒╪╣ ╪┤┘à╪º┘ä ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 3 - North Riyadh Branch',0.00,1,2,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (8,'╪¿╪▒╪¼ 4 - ┘ü╪▒╪╣ ╪┤┘à╪º┘ä ╪º┘ä╪▒┘è╪º╪╢','Tower 4 - North Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 4 - ┘ü╪▒╪╣ ╪┤┘à╪º┘ä ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 4 - North Riyadh Branch',0.00,1,2,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (9,'╪¿╪▒╪¼ 1 - ┘ü╪▒╪╣ ╪┤╪▒┘é ╪º┘ä╪▒┘è╪º╪╢','Tower 1 - East Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 1 - ┘ü╪▒╪╣ ╪┤╪▒┘é ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 1 - East Riyadh Branch',0.00,1,3,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (10,'╪¿╪▒╪¼ 2 - ┘ü╪▒╪╣ ╪┤╪▒┘é ╪º┘ä╪▒┘è╪º╪╢','Tower 2 - East Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 2 - ┘ü╪▒╪╣ ╪┤╪▒┘é ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 2 - East Riyadh Branch',0.00,1,3,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (11,'╪¿╪▒╪¼ 3 - ┘ü╪▒╪╣ ╪┤╪▒┘é ╪º┘ä╪▒┘è╪º╪╢','Tower 3 - East Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 3 - ┘ü╪▒╪╣ ╪┤╪▒┘é ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 3 - East Riyadh Branch',0.00,1,3,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (12,'╪¿╪▒╪¼ 4 - ┘ü╪▒╪╣ ╪┤╪▒┘é ╪º┘ä╪▒┘è╪º╪╢','Tower 4 - East Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 4 - ┘ü╪▒╪╣ ╪┤╪▒┘é ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 4 - East Riyadh Branch',0.00,1,3,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (13,'╪¿╪▒╪¼ 1 - ┘ü╪▒╪╣ ╪║╪▒╪¿ ╪º┘ä╪▒┘è╪º╪╢','Tower 1 - West Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 1 - ┘ü╪▒╪╣ ╪║╪▒╪¿ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 1 - West Riyadh Branch',0.00,1,4,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (14,'╪¿╪▒╪¼ 2 - ┘ü╪▒╪╣ ╪║╪▒╪¿ ╪º┘ä╪▒┘è╪º╪╢','Tower 2 - West Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 2 - ┘ü╪▒╪╣ ╪║╪▒╪¿ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 2 - West Riyadh Branch',0.00,1,4,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (15,'╪¿╪▒╪¼ 3 - ┘ü╪▒╪╣ ╪║╪▒╪¿ ╪º┘ä╪▒┘è╪º╪╢','Tower 3 - West Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 3 - ┘ü╪▒╪╣ ╪║╪▒╪¿ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 3 - West Riyadh Branch',0.00,1,4,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (16,'╪¿╪▒╪¼ 4 - ┘ü╪▒╪╣ ╪║╪▒╪¿ ╪º┘ä╪▒┘è╪º╪╢','Tower 4 - West Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 4 - ┘ü╪▒╪╣ ╪║╪▒╪¿ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 4 - West Riyadh Branch',0.00,1,4,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (17,'╪¿╪▒╪¼ 1 - ┘ü╪▒╪╣ ╪¼┘å┘ê╪¿ ╪º┘ä╪▒┘è╪º╪╢','Tower 1 - South Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 1 - ┘ü╪▒╪╣ ╪¼┘å┘ê╪¿ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 1 - South Riyadh Branch',0.00,1,5,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (18,'╪¿╪▒╪¼ 2 - ┘ü╪▒╪╣ ╪¼┘å┘ê╪¿ ╪º┘ä╪▒┘è╪º╪╢','Tower 2 - South Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 2 - ┘ü╪▒╪╣ ╪¼┘å┘ê╪¿ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 2 - South Riyadh Branch',0.00,1,5,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (19,'╪¿╪▒╪¼ 3 - ┘ü╪▒╪╣ ╪¼┘å┘ê╪¿ ╪º┘ä╪▒┘è╪º╪╢','Tower 3 - South Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 3 - ┘ü╪▒╪╣ ╪¼┘å┘ê╪¿ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 3 - South Riyadh Branch',0.00,1,5,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `towers` VALUES (20,'╪¿╪▒╪¼ 4 - ┘ü╪▒╪╣ ╪¼┘å┘ê╪¿ ╪º┘ä╪▒┘è╪º╪╢','Tower 4 - South Riyadh Branch','┘ê╪╡┘ü ╪º┘ä╪¿╪▒╪¼ 4 - ┘ü╪▒╪╣ ╪¼┘å┘ê╪¿ ╪º┘ä╪▒┘è╪º╪╢','Description for Tower 4 - South Riyadh Branch',0.00,1,5,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
/*!40000 ALTER TABLE `towers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` enum('super_admin','manager','supervisor','user') NOT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `password_changed_at` timestamp NULL DEFAULT NULL,
  `branch_id` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_branch_id_foreign` (`branch_id`),
  CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`)
) TYPE=InnoDB AUTO_INCREMENT=21;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'┘à╪│╪¬╪«╪»┘à super_admin 1','super_admin1@alsafa.com','$2y$10$LJNWmSL4UzkAYfTgvLwrg.BFdZEODMME.y1xkZa5Befjm4lxoDRhS','+966510000001','super_admin',NULL,NULL,1,1,'xuBv9jO2790d1GEED6xtOoaZhhT6DEaoDVrs1VJO3mM3k1fUQX4Y8SIZny5q','2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (2,'┘à╪»┘è╪▒ 1','manager1@alsafa.com','$2y$10$K6SkgsZzTv3hgDoMKKo8UeidwTBLYdnB3OZGAehoU5JE1.KykxE2y','+966520000001','manager',NULL,NULL,1,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (3,'┘à╪┤╪▒┘ü 1','supervisor1@alsafa.com','$2y$10$tvf7orKIZT4MrdDRDrhCFuJHWWplpaEddysL7ToERyfhrb5QTcqc6','+966530000001','supervisor',NULL,NULL,1,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (4,'┘à╪│╪¬╪«╪»┘à 1','user1@alsafa.com','$2y$10$pu/R3j1TDkaMQUvVETz97u7hj.lfcOBVXuEh03vH2sAvAUAJHao4a','+966540000001','user',NULL,NULL,1,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (5,'┘à╪│╪¬╪«╪»┘à super_admin 2','super_admin2@alsafa.com','$2y$10$q5SqsquRPJXQgoGyzJVd.ukIiMQrUmxj5.uovWHbbJ.dBhGvq8oS2','+966510000002','super_admin',NULL,NULL,2,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (6,'┘à╪»┘è╪▒ 2','manager2@alsafa.com','$2y$10$5Y0pPeAxqO5JCqaZ1Ggfce84JtYYMKCwC9YMJn7YXihJc.8w2CtJm','+966520000002','manager',NULL,NULL,2,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (7,'┘à╪┤╪▒┘ü 2','supervisor2@alsafa.com','$2y$10$/ak4eb0xYLCe6Or/MdIeQ.Z426Q0ldgSCIVGpOt9mlbxo4azRNAAC','+966530000002','supervisor',NULL,NULL,2,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (8,'┘à╪│╪¬╪«╪»┘à 2','user2@alsafa.com','$2y$10$xbsdZV2aGYvvUgCRowSehOd5PhV4K7gWKOEaNyip2vhALEIPn2fVe','+966540000002','user',NULL,NULL,2,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (9,'┘à╪│╪¬╪«╪»┘à super_admin 3','super_admin3@alsafa.com','$2y$10$LRF1rZyMFzq6HoEvJO5qeO2ZG0ehwOW56Hani1kOrkoLZ9wal7/pq','+966510000003','super_admin',NULL,NULL,3,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (10,'┘à╪»┘è╪▒ 3','manager3@alsafa.com','$2y$10$bI3nWE6HXnLNMiWOeaGqFu7Nqb2neN9C4qWDwwsW60fRO4rCs1vAS','+966520000003','manager',NULL,NULL,3,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (11,'┘à╪┤╪▒┘ü 3','supervisor3@alsafa.com','$2y$10$afPWA0YkIbn6Y10muT1hzu86frMysJDjN2VFi1mx1eBP.bTXQtM5K','+966530000003','supervisor',NULL,NULL,3,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (12,'┘à╪│╪¬╪«╪»┘à 3','user3@alsafa.com','$2y$10$dNb6fJKAHJqiNjtwPjbVSeeAb7S1EAA.ZchvRlvBug1WGSSdf4Fcq','+966540000003','user',NULL,NULL,3,1,NULL,'2025-05-26 13:57:08','2025-05-26 13:57:08',NULL);
INSERT INTO `users` VALUES (13,'┘à╪│╪¬╪«╪»┘à super_admin 4','super_admin4@alsafa.com','$2y$10$QcNB95B26hGTDSWz1w7IjeKygd1Cp.B5e5mBmWDd8aD7GvtEzWiYa','+966510000004','super_admin',NULL,NULL,4,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `users` VALUES (14,'┘à╪»┘è╪▒ 4','manager4@alsafa.com','$2y$10$QCj2aOTGGz8JhbYdvcXLu.f9Yn4H7IdI4DaGD2qfRdR.YWM4NxoKK','+966520000004','manager',NULL,NULL,4,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `users` VALUES (15,'┘à╪┤╪▒┘ü 4','supervisor4@alsafa.com','$2y$10$88EpKEk4RRyQcuAumNZ3x.RI5DYW9zXHOiiWWKWYCpHwC44nLIfLi','+966530000004','supervisor',NULL,NULL,4,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `users` VALUES (16,'┘à╪│╪¬╪«╪»┘à 4','user4@alsafa.com','$2y$10$qG.0P.y/rn382CvyT5fNB.x8Fv1aSl5pYSbzrXi8BznzMQWUAkHTq','+966540000004','user',NULL,NULL,4,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `users` VALUES (17,'┘à╪│╪¬╪«╪»┘à super_admin 5','super_admin5@alsafa.com','$2y$10$pXfVj5FwIXNJif/fjvC3WOPh/.GKXQ1ubZ7KJsG1C.ct8/TkShCZ.','+966510000005','super_admin',NULL,NULL,5,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `users` VALUES (18,'┘à╪»┘è╪▒ 5','manager5@alsafa.com','$2y$10$XrykP9Ofyi4yaLWKds94H.rmVCxXAfMBxi5cCM09T2UnsJC6/SV9W','+966520000005','manager',NULL,NULL,5,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `users` VALUES (19,'┘à╪┤╪▒┘ü 5','supervisor5@alsafa.com','$2y$10$l1yiTYhuwaq2fBikAXLcUO.RQk13KGLS9O35/qCkJ5POI7JwhVDoa','+966530000005','supervisor',NULL,NULL,5,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
INSERT INTO `users` VALUES (20,'┘à╪│╪¬╪«╪»┘à 5','user5@alsafa.com','$2y$10$QyZrRSLz5t6A4seqDG3gbepaMStmWDxfaV3yEc5oPre9bFiqHkOkK','+966540000005','user',NULL,NULL,5,1,NULL,'2025-05-26 13:57:09','2025-05-26 13:57:09',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-08  2:10:37
