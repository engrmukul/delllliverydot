-- MySQL dump 10.13  Distrib 8.0.19, for Linux (x86_64)
--
-- Host: localhost    Database: deliverydot
-- ------------------------------------------------------
-- Server version	8.0.19-0ubuntu5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_code` int NOT NULL,
  `total_used_code` int DEFAULT NULL,
  `discount_type` enum('percent','fixed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percent',
  `discount` double(10,2) NOT NULL DEFAULT '0.00',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `food_id` bigint unsigned DEFAULT NULL,
  `restaurant_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `expire_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enabled` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupons_food_id_foreign` (`food_id`),
  KEY `coupons_restaurant_id_foreign` (`restaurant_id`),
  KEY `coupons_category_id_foreign` (`category_id`),
  KEY `coupons_created_by_foreign` (`created_by`),
  KEY `coupons_updated_by_foreign` (`updated_by`),
  KEY `coupons_deleted_by_foreign` (`deleted_by`),
  CONSTRAINT `coupons_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `coupons_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `coupons_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `coupons_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE,
  CONSTRAINT `coupons_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `coupons_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (51,'DDR2',100,NULL,'fixed',50.00,'mmmm',NULL,121,NULL,'2021-01-29 18:00:00','1','active',NULL,NULL,NULL,1,NULL,NULL),(52,'DDR2',100,NULL,'fixed',50.00,'mmmm',NULL,122,NULL,'2021-01-29 18:00:00','1','active',NULL,NULL,NULL,1,NULL,NULL),(53,'DDR2',100,NULL,'fixed',50.00,'mmmm',NULL,123,NULL,'2021-01-29 18:00:00','1','active',NULL,NULL,NULL,1,NULL,NULL),(54,'DDR2',100,NULL,'fixed',50.00,'mmmm',NULL,124,NULL,'2021-01-29 18:00:00','1','active',NULL,NULL,NULL,1,NULL,NULL),(55,'DDR2',100,NULL,'fixed',50.00,'mmmm',NULL,132,NULL,'2021-01-29 18:00:00','1','active',NULL,NULL,NULL,1,NULL,NULL),(56,'QWER',100,NULL,'fixed',50.00,'mmmm',NULL,133,NULL,'2021-01-22 07:56:30','1','active',NULL,'2021-01-22 01:56:30',NULL,1,1,NULL),(57,'DDR2',100,NULL,'fixed',50.00,'mmmm',NULL,134,NULL,'2021-01-29 18:00:00','1','active',NULL,NULL,NULL,1,NULL,NULL),(58,'DDR2',100,NULL,'fixed',50.00,'mmmm',NULL,135,NULL,'2021-01-29 18:00:00','1','active',NULL,NULL,NULL,1,NULL,NULL),(59,'DDR2',100,NULL,'fixed',50.00,'mmmm',NULL,136,NULL,'2021-01-29 18:00:00','1','active',NULL,NULL,NULL,1,NULL,NULL),(60,'DDR2',100,NULL,'fixed',50.00,'mmmm',NULL,137,NULL,'2021-01-29 18:00:00','1','active',NULL,NULL,NULL,1,NULL,NULL),(61,'DDR2',100,NULL,'fixed',50.00,'mmmm',NULL,138,NULL,'2021-01-29 18:00:00','1','active',NULL,NULL,NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-22 16:39:25
