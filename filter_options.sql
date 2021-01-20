-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: deliverydot
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.3

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
-- Table structure for table `filter_options`
--

DROP TABLE IF EXISTS `filter_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filter_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `filter_type` enum('price_range','other_option','food_type','other_feature') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other_option',
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupons_created_by_foreign` (`created_by`),
  KEY `coupons_updated_by_foreign` (`updated_by`),
  KEY `coupons_deleted_by_foreign` (`deleted_by`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filter_options`
--

LOCK TABLES `filter_options` WRITE;
/*!40000 ALTER TABLE `filter_options` DISABLE KEYS */;
INSERT INTO `filter_options` VALUES (1,'price_range','Price up to 99','price_up_to_99','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(2,'price_range','Price up to 999','price_up_to_999','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(3,'other_option','It has offers','it_has_offers','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(4,'other_option','Free delivery option','free_delivery_option','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(5,'other_option','I can pay with bKash','i_can_pay_with_bKash','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(6,'other_option','I can pay with card','i_can_pay_with_card','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(7,'other_option','Cash on delivery','cash_on_delivery','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(8,'food_type','Fast food','fast_food','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(9,'food_type','Bangladeshi food','bangladeshi_food','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(10,'food_type','Burgers','burgers','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(11,'food_type','Snacks','snacks','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(12,'food_type','Pizza','pizza','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(13,'food_type','Desert','desert','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(14,'food_type','Chicken','chicken','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(15,'other_feature','Set menu','set_menu','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(16,'other_feature','Has meyonese','has_meyonese','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(17,'other_feature','Extra Chees','extra_chees','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(18,'other_feature','Onion','onion','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(19,'other_feature','Jelapeno','jelapeno','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL),(20,'other_feature','Set menu','set_menu','active','2021-01-20 14:51:08','2021-01-20 14:51:12','2021-01-20 14:51:10',1,NULL,NULL);
/*!40000 ALTER TABLE `filter_options` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-20 21:03:28
