-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: landPage
-- ------------------------------------------------------
-- Server version	5.6.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `industry_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `customer_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` longtext COLLATE utf8_unicode_ci,
  `web` longtext COLLATE utf8_unicode_ci,
  `google_plus` longtext COLLATE utf8_unicode_ci,
  `twitter` longtext COLLATE utf8_unicode_ci,
  `youtube` longtext COLLATE utf8_unicode_ci,
  `linkedin` longtext COLLATE utf8_unicode_ci,
  `instagram` longtext COLLATE utf8_unicode_ci,
  `address_lat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_lng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_zoom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reply_email` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8D36E382B19A734` (`industry_id`),
  KEY `IDX_8D36E389395C3F3` (`customer_id`),
  CONSTRAINT `FK_8D36E382B19A734` FOREIGN KEY (`industry_id`) REFERENCES `industry` (`id`),
  CONSTRAINT `FK_8D36E389395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business`
--

LOCK TABLES `business` WRITE;
/*!40000 ALTER TABLE `business` DISABLE KEYS */;
/*!40000 ALTER TABLE `business` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `code_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiration_code` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `picture` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `plan_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `is_validate` tinyint(1) NOT NULL,
  `is_locked` tinyint(1) NOT NULL,
  `locked_description` longtext COLLATE utf8_unicode_ci,
  `use_trial` tinyint(1) DEFAULT NULL,
  `url_destination` longtext COLLATE utf8_unicode_ci,
  `profile_is_complete` tinyint(1) NOT NULL,
  `business_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_cuit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accept_terms_and_conditions` tinyint(1) NOT NULL,
  `google_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiration_plan` datetime DEFAULT NULL,
  `balance` double NOT NULL,
  `locked_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_81398E09E899029B` (`plan_id`),
  CONSTRAINT `FK_81398E09E899029B` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES ('14ab0d3e-50cd-11e9-802a-f06f5d8273bc','Mauricio','Ampuero',NULL,'mdampuero@gmail.com','$2y$13$sTIGylrE4xzr82AncZzVkuWZvXlHhshtnBBP9TcayZ3XvA/kVYrga',NULL,'2616636938','30385602','ROLE_USER',NULL,'7ce04fc8be8611e98eb4884f570a1292','2019-01-28 17:15:35',1,NULL,'2019-01-27 17:15:35','2019-03-27 20:54:41',0,'5bb93722-36d9-11e9-bed4-2e252c71b32c',1,1,'Tu versión de prueba ha caducado, renueva tu plan ahora.',0,NULL,1,'Mi empresa','20303856022','Valle Hermoso 8835','mdampuero',1,NULL,'2019-05-27 17:15:47',0,'trial_expiret'),('24fc0582-50d0-11e9-802a-f06f5d8273bc','Mauricio','Ampuero',NULL,'mdampuero1@gmail.com','$2y$13$.iJ.Hny.ww92GT7YWfubOe2YIYeyOVfOyJMixfTiAJCWzZLLVHK.u',NULL,'2616636938','2323232323','ROLE_USER',NULL,'177fc942e93f8f52452e52d6ae58fccb','2019-03-28 17:37:31',1,NULL,'2019-03-27 17:37:31','2019-03-27 17:38:24',0,'269110cc-3375-11e9-befa-27c66dcdbd4c',0,0,NULL,1,NULL,1,'Mi empresa','20303856022','dsadas','mdampuero1',1,NULL,'2019-04-11 17:37:45',0,NULL),('307c5878-5191-11e9-822a-2914e74bbfdf','Trial2','Dos',NULL,'trial2@gmail.com','$2y$13$yDK4phoG73jPUQx/Tc/5QOLegJzXloCWKtXLxnHY1HrMtWWfWVtaq',NULL,'2616636938','30385602','ROLE_USER',NULL,'817b6f73586f6387703799c70d895bff','2019-03-29 16:39:23',1,NULL,'2019-03-28 16:39:23','2019-03-28 17:09:09',0,'269110cc-3375-11e9-befa-27c66dcdbd4c',0,0,'Tu plan ha caducado, renuévalo ahora.',0,NULL,1,'Mi empresa','20303856022','Valle Hermoso 8835','trial2',1,NULL,'2019-04-28 17:06:04',0,'trial_expiret'),('5ea6757a-518d-11e9-822a-2914e74bbfdf','Trial','Vence',NULL,'trial@gmail.com','$2y$13$8Y0fOvhbCw4.YsArKqLEFeIkjKBhM88FvgKONTtmZA/4S.eQXxVRK',NULL,'2616636938','30385602','ROLE_USER',NULL,'fc4dcee3b91b8a5a4e299ddffb6ff27b','2019-03-29 16:12:03',1,NULL,'2019-01-28 16:12:03','2019-03-28 18:23:05',0,'5bb93722-36d9-11e9-bed4-2e252c71b32c',1,0,NULL,0,NULL,1,'dsadas','20303856022','Valle Hermoso 8835','trial',1,NULL,'2019-05-27 16:12:17',0,NULL),('84f4a290-519e-11e9-822a-2914e74bbfdf','dsadsadsa','dasdsadsa',NULL,'mdampuero11@gmail.com','$2y$13$XelyPgI6LZ6WEqK5x6gz4uK9qf9jUKJYgQ1w1px3W.vOlrOOUblca',NULL,'342432432','3423432','ROLE_USER',NULL,'dea6ae5196cb53cd6a34ff5e1bb1a298','2019-03-29 18:14:48',1,NULL,'2019-03-28 18:14:48','2019-03-28 18:16:27',0,'5bb93722-36d9-11e9-bed4-2e252c71b32c',0,0,NULL,0,'{\"url\":\"security_frontend_username\",\"params\":[]}',0,'Mi empresa','20303856022','Valle Hermoso 8835','mdampuero11',1,NULL,'2019-04-28 18:15:10',0,NULL),('b6a09bd0-519b-11e9-822a-2914e74bbfdf','Trial','Tres',NULL,'trial3@gmail.com','$2y$13$9s//p.9fbDaXNEbDURp0heQ1k96KA5VqhtcTv2.y.S1luzaUxj23e',NULL,'2611666161','432423432','ROLE_USER',NULL,'112845ca85deb9ce8f5951a6815971f6','2019-03-29 17:54:43',1,NULL,'2019-01-28 17:54:43','2019-03-28 18:13:00',0,'269110cc-3375-11e9-befa-27c66dcdbd4c',1,1,'Tu plan ha caducado, renuévalo ahora.',0,NULL,1,'342423','4324324','32423423432','trial3',1,NULL,'2019-01-28 18:06:47',0,'trial_expiret');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_balance`
--

DROP TABLE IF EXISTS `customer_balance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_balance` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `customer` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `import` double NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B029BB4081398E09` (`customer`),
  CONSTRAINT `FK_B029BB4081398E09` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_balance`
--

LOCK TABLES `customer_balance` WRITE;
/*!40000 ALTER TABLE `customer_balance` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_balance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_transaction`
--

DROP TABLE IF EXISTS `customer_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_transaction` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `customer` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `is_trial` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `import` double NOT NULL,
  `expired_at` datetime NOT NULL,
  `status` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `collection_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `collection_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `external_reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preference_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_717C2ED981398E09` (`customer`),
  CONSTRAINT `FK_717C2ED981398E09` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_transaction`
--

LOCK TABLES `customer_transaction` WRITE;
/*!40000 ALTER TABLE `customer_transaction` DISABLE KEYS */;
INSERT INTO `customer_transaction` VALUES ('0244c87e-519f-11e9-822a-2914e74bbfdf','84f4a290-519e-11e9-822a-2914e74bbfdf',0,'2019-03-28 18:18:19','2019-03-28 18:18:19',0,500,'2019-04-28 18:18:19','initial','initial',NULL,NULL,NULL,NULL,NULL,NULL),('1bca9e18-50cd-11e9-802a-f06f5d8273bc','14ab0d3e-50cd-11e9-802a-f06f5d8273bc',1,'2019-03-27 17:15:47','2019-03-27 17:15:47',0,0,'2019-03-28 17:15:47','approved','approved',NULL,NULL,NULL,NULL,NULL,NULL),('2d4e5d02-50d0-11e9-802a-f06f5d8273bc','24fc0582-50d0-11e9-802a-f06f5d8273bc',1,'2019-03-27 17:37:45','2019-03-27 17:37:45',0,0,'2019-04-11 17:37:45','approved','approved',NULL,NULL,NULL,NULL,NULL,NULL),('361bd8bc-5191-11e9-822a-2914e74bbfdf','307c5878-5191-11e9-822a-2914e74bbfdf',1,'2019-03-28 16:39:33','2019-03-28 16:39:33',0,0,'2019-04-12 16:39:33','approved','approved',NULL,NULL,NULL,NULL,NULL,NULL),('4af8406e-50eb-11e9-802a-f06f5d8273bc','14ab0d3e-50cd-11e9-802a-f06f5d8273bc',0,'2019-03-27 20:51:51','2019-03-27 20:54:41',0,150,'2019-04-27 20:51:51','initial','initial',NULL,'18390843','approved','4af8406e-50eb-11e9-802a-f06f5d8273bc','credit_card','82841009-9f43a5aa-8f6e-41b2-ab1f-9121bb2c7857'),('50910396-50d0-11e9-802a-f06f5d8273bc','24fc0582-50d0-11e9-802a-f06f5d8273bc',0,'2019-03-27 17:38:44','2019-03-27 17:38:44',0,500,'2019-04-27 17:38:44','initial','initial',NULL,NULL,NULL,NULL,NULL,NULL),('65f888f8-519d-11e9-822a-2914e74bbfdf','b6a09bd0-519b-11e9-822a-2914e74bbfdf',0,'2019-03-28 18:06:47','2019-03-28 18:07:20',0,500,'2019-04-28 18:06:47','initial','initial',NULL,'18405645','approved','65f888f8-519d-11e9-822a-2914e74bbfdf','credit_card','82841009-b95a98fa-8672-4aa1-b96d-6e92b54f6aff'),('66f14822-518d-11e9-822a-2914e74bbfdf','5ea6757a-518d-11e9-822a-2914e74bbfdf',1,'2019-03-28 16:12:17','2019-03-28 16:12:17',0,0,'2019-03-29 16:12:17','approved','approved',NULL,NULL,NULL,NULL,NULL,NULL),('7f4a36ec-5195-11e9-822a-2914e74bbfdf','307c5878-5191-11e9-822a-2914e74bbfdf',0,'2019-03-28 17:10:13','2019-03-28 17:10:13',0,500,'2019-04-28 17:10:13','initial','initial',NULL,NULL,NULL,NULL,NULL,NULL),('8379a2a2-5190-11e9-822a-2914e74bbfdf','5ea6757a-518d-11e9-822a-2914e74bbfdf',0,'2019-03-28 16:34:33','2019-03-28 16:35:15',0,150,'2019-04-28 16:34:33','initial','initial',NULL,'18404081','approved','8379a2a2-5190-11e9-822a-2914e74bbfdf','credit_card','82841009-9691eb15-da43-4ea5-b096-d70ee6177332'),('91c5ebbe-519e-11e9-822a-2914e74bbfdf','84f4a290-519e-11e9-822a-2914e74bbfdf',0,'2019-03-28 18:15:10','2019-03-28 18:16:10',0,150,'2019-04-28 18:15:10','initial','initial',NULL,'18405726','approved','91c5ebbe-519e-11e9-822a-2914e74bbfdf','credit_card','82841009-32ca4849-a910-4e6d-b02d-7272f419b4c1'),('b1395e8e-5191-11e9-822a-2914e74bbfdf','307c5878-5191-11e9-822a-2914e74bbfdf',0,'2019-03-28 16:42:59','2019-03-28 16:43:38',0,500,'2019-04-28 16:42:59','initial','initial',NULL,'18404231','approved','b1395e8e-5191-11e9-822a-2914e74bbfdf','credit_card','82841009-dafc6812-4b7e-4947-a6eb-7247e9ccd076'),('be06d06e-519c-11e9-822a-2914e74bbfdf','b6a09bd0-519b-11e9-822a-2914e74bbfdf',0,'2019-03-28 18:02:05','2019-03-28 18:05:36',0,500,'2019-04-28 18:02:05','initial','initial',NULL,'18405627','approved','be06d06e-519c-11e9-822a-2914e74bbfdf','credit_card','82841009-fd2e1a16-9b03-4153-98f9-ffeea562a544'),('be9a6924-519b-11e9-822a-2914e74bbfdf','b6a09bd0-519b-11e9-822a-2914e74bbfdf',1,'2019-03-28 17:54:57','2019-03-28 17:54:57',0,0,'2019-04-12 17:54:57','approved','approved',NULL,NULL,NULL,NULL,NULL,NULL),('c456aee6-5190-11e9-822a-2914e74bbfdf','5ea6757a-518d-11e9-822a-2914e74bbfdf',0,'2019-03-28 16:36:22','2019-03-28 16:37:04',0,150,'2019-04-28 16:36:22','initial','initial',NULL,'18404155','approved','c456aee6-5190-11e9-822a-2914e74bbfdf','credit_card','82841009-c852c9b9-d132-4299-ac0a-865c092c83da'),('ea5d90ba-5194-11e9-822a-2914e74bbfdf','307c5878-5191-11e9-822a-2914e74bbfdf',0,'2019-03-28 17:06:04','2019-03-28 17:09:09',0,500,'2019-04-28 17:06:04','initial','initial',NULL,'18405020','approved','ea5d90ba-5194-11e9-822a-2914e74bbfdf','credit_card','82841009-b87bfb92-ebdb-472c-87b1-dfaf23b5634a'),('edb047f6-5191-11e9-822a-2914e74bbfdf','307c5878-5191-11e9-822a-2914e74bbfdf',0,'2019-03-28 16:44:41','2019-03-28 16:45:18',0,500,'2019-04-28 16:44:41','initial','initial',NULL,'18404242','approved','edb047f6-5191-11e9-822a-2914e74bbfdf','credit_card','82841009-6a439687-a978-413d-99a9-dd71523c2316');
/*!40000 ALTER TABLE `customer_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `demo`
--

DROP TABLE IF EXISTS `demo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `demo` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `demo`
--

LOCK TABLES `demo` WRITE;
/*!40000 ALTER TABLE `demo` DISABLE KEYS */;
/*!40000 ALTER TABLE `demo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `draft_user`
--

DROP TABLE IF EXISTS `draft_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `draft_user` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `plan_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_97D3E04DE899029B` (`plan_id`),
  CONSTRAINT `FK_97D3E04DE899029B` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `draft_user`
--

LOCK TABLES `draft_user` WRITE;
/*!40000 ALTER TABLE `draft_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `draft_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `industry_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `customer_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`),
  KEY `IDX_8C9F36102B19A734` (`industry_id`),
  KEY `IDX_8C9F36109395C3F3` (`customer_id`),
  CONSTRAINT `FK_8C9F36102B19A734` FOREIGN KEY (`industry_id`) REFERENCES `industry` (`id`),
  CONSTRAINT `FK_8C9F36109395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES ('0daac064-4a89-11e9-a12b-f76c37cf6aa2',NULL,'12f0fff9e9f93aab42ce77046e3d8f85.jpeg','2019-03-19 17:53:31','2019-03-19 17:53:31',0,'2309e96c-49da-11e9-b26c-dc520627b209'),('4992f754-4a89-11e9-a12b-f76c37cf6aa2',NULL,'d093c304327850d678b501335a8722f5.jpeg','2019-03-19 17:55:11','2019-03-19 17:55:11',0,'2309e96c-49da-11e9-b26c-dc520627b209'),('5ba91874-4502-11e9-bce0-d274ceaaeb9b','6c50abfc-32b4-11e9-b87d-3b10a2f9fd05','6b31fc307f8546a2045f6da092110a2e.jpeg','2019-03-12 17:06:44','2019-03-12 17:06:44',0,NULL),('5c486370-4502-11e9-bce0-d274ceaaeb9b','6c50abfc-32b4-11e9-b87d-3b10a2f9fd05','b377351db0e5ab133f989cef88b8c2fa.jpeg','2019-03-12 17:06:45','2019-03-12 17:06:45',0,NULL),('5cea9eec-4502-11e9-bce0-d274ceaaeb9b','6c50abfc-32b4-11e9-b87d-3b10a2f9fd05','28dde7f032cf4c909bdfcb23ec5b3f13.jpeg','2019-03-12 17:06:46','2019-03-12 17:06:46',0,NULL),('5d87ffde-4502-11e9-bce0-d274ceaaeb9b','6c50abfc-32b4-11e9-b87d-3b10a2f9fd05','5547d67df3b0a213a4704be74936452c.jpeg','2019-03-12 17:06:47','2019-03-12 17:06:47',0,NULL),('7fb80a68-4a89-11e9-a12b-f76c37cf6aa2',NULL,'9772aa42bb47450bde22d3f7aadbd07e.jpeg','2019-03-19 17:56:42','2019-03-19 17:56:42',0,'2309e96c-49da-11e9-b26c-dc520627b209'),('93b5f402-4a85-11e9-a12b-f76c37cf6aa2',NULL,'99a1c46f0f5b4a645bfcb0b047565e8e.jpeg','2019-03-19 17:28:38','2019-03-19 17:53:46',1,'2309e96c-49da-11e9-b26c-dc520627b209'),('9b2a8028-3f9e-11e9-8b3e-e50d92b3cde9',NULL,'8cabdae0f17d4606ababed4b93b2bb22.jpeg','2019-03-06 00:30:05','2019-03-06 00:30:05',0,'c706ebd8-3f84-11e9-a093-54dd5820999f'),('9b6acad4-3f9e-11e9-8b3e-e50d92b3cde9',NULL,'994cd9a1331560fabc5feeb2fd48fb15.jpeg','2019-03-06 00:30:05','2019-03-06 00:30:05',0,'c706ebd8-3f84-11e9-a093-54dd5820999f'),('9bb551d0-3f9e-11e9-8b3e-e50d92b3cde9',NULL,'fd546bcb7c5c1452e13ec9d4da4622c7.jpeg','2019-03-06 00:30:06','2019-03-06 00:30:06',0,'c706ebd8-3f84-11e9-a093-54dd5820999f'),('9c012e66-3f9e-11e9-8b3e-e50d92b3cde9',NULL,'51886f7c14549654ee1305aa1e55f670.jpeg','2019-03-06 00:30:06','2019-03-06 14:28:53',1,'c706ebd8-3f84-11e9-a093-54dd5820999f'),('9c4b9604-3f9e-11e9-8b3e-e50d92b3cde9',NULL,'fcdd1feb04b8c531016501bbbd3afc09.jpeg','2019-03-06 00:30:07','2019-03-06 00:30:07',0,'c706ebd8-3f84-11e9-a093-54dd5820999f'),('9c9c1e94-3f9e-11e9-8b3e-e50d92b3cde9',NULL,'7ed577f6e6460827827093ec353aae29.jpeg','2019-03-06 00:30:07','2019-03-06 00:30:07',0,'c706ebd8-3f84-11e9-a093-54dd5820999f'),('9ce6ff7c-3f9e-11e9-8b3e-e50d92b3cde9',NULL,'bac2e196882ba3d661ad143690f115c5.jpeg','2019-03-06 00:30:08','2019-03-06 00:30:08',0,'c706ebd8-3f84-11e9-a093-54dd5820999f'),('9cfc7688-3376-11e9-befa-27c66dcdbd4c','6c50abfc-32b4-11e9-b87d-3b10a2f9fd05','05d8b2671b20972eb8aa8073cea43556.jpeg','2019-02-18 09:13:34','2019-02-18 09:13:34',0,NULL),('9d355dac-3f9e-11e9-8b3e-e50d92b3cde9',NULL,'bf8895e89ec390eae16cdbc50a91c487.jpeg','2019-03-06 00:30:08','2019-03-06 00:30:08',0,'c706ebd8-3f84-11e9-a093-54dd5820999f'),('9d854754-3f9e-11e9-8b3e-e50d92b3cde9',NULL,'b120a3b299348ed91f4db1946bccc604.jpeg','2019-03-06 00:30:09','2019-03-06 00:30:27',1,'c706ebd8-3f84-11e9-a093-54dd5820999f'),('f0ca82c4-4446-11e9-8f8d-81c24824d9d7',NULL,'429a9a459012d9c5649043bd470afde9.jpeg','2019-03-11 18:45:08','2019-03-11 18:45:16',1,'c706ebd8-3f84-11e9-a093-54dd5820999f'),('fcd50648-4446-11e9-8f8d-81c24824d9d7',NULL,'dfee9462aea5b57410e63005e405c87e.png','2019-03-11 18:45:29','2019-03-11 18:45:29',0,'c706ebd8-3f84-11e9-a093-54dd5820999f');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `industry`
--

DROP TABLE IF EXISTS `industry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `industry` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `tag_unsplash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `industry`
--

LOCK TABLES `industry` WRITE;
/*!40000 ALTER TABLE `industry` DISABLE KEYS */;
INSERT INTO `industry` VALUES ('6c50abfc-32b4-11e9-b87d-3b10a2f9fd05','Informática','2019-02-17 10:03:30','2019-02-17 10:03:30',0,'tecnología');
/*!40000 ALTER TABLE `industry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing`
--

DROP TABLE IF EXISTS `landing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `industry_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description_2` longtext COLLATE utf8_unicode_ci,
  `description_1` longtext COLLATE utf8_unicode_ci,
  `brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_product_service` tinyint(1) DEFAULT NULL,
  `grid_columns` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `color_primary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `background_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `published_to_at` datetime DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `navbar_top` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navbar_fixed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navbar_top_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navbar_fixed_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `colors_suggested` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `contact_address_lat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_address_lng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_address_zoom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_address_map` tinyint(1) DEFAULT NULL,
  `social_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `contact_social` tinyint(1) DEFAULT NULL,
  `use_whatsapp` tinyint(1) DEFAULT NULL,
  `current_step` int(11) DEFAULT NULL,
  `plugin_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `is_review` tinyint(1) DEFAULT NULL,
  `use_chatbot` tinyint(1) DEFAULT NULL,
  `chatbot_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `business_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `contact_email_reply` longtext COLLATE utf8_unicode_ci NOT NULL,
  `published_from_at` datetime DEFAULT NULL,
  `visits` int(11) DEFAULT NULL,
  `leads` int(11) DEFAULT NULL,
  `convertions` double DEFAULT NULL,
  `description_3` longtext COLLATE utf8_unicode_ci,
  `description_4` longtext COLLATE utf8_unicode_ci,
  `is_active_ai` tinyint(1) DEFAULT NULL,
  `use_whatsapp_mobile` tinyint(1) DEFAULT NULL,
  `brightness` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason_for_rejection` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EF3ACE1533B92F39` (`label_id`),
  UNIQUE KEY `UNIQ_EF3ACE15FFEB5B27` (`social_id`),
  UNIQUE KEY `UNIQ_EF3ACE15EC942BCF` (`plugin_id`),
  UNIQUE KEY `UNIQ_EF3ACE151984C580` (`chatbot_id`),
  KEY `IDX_EF3ACE152B19A734` (`industry_id`),
  KEY `IDX_EF3ACE159395C3F3` (`customer_id`),
  KEY `IDX_EF3ACE15A89DB457` (`business_id`),
  CONSTRAINT `FK_EF3ACE151984C580` FOREIGN KEY (`chatbot_id`) REFERENCES `landing_chatbot` (`id`),
  CONSTRAINT `FK_EF3ACE152B19A734` FOREIGN KEY (`industry_id`) REFERENCES `industry` (`id`),
  CONSTRAINT `FK_EF3ACE1533B92F39` FOREIGN KEY (`label_id`) REFERENCES `landing_label` (`id`),
  CONSTRAINT `FK_EF3ACE159395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `FK_EF3ACE15A89DB457` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`),
  CONSTRAINT `FK_EF3ACE15EC942BCF` FOREIGN KEY (`plugin_id`) REFERENCES `landing_plugin` (`id`),
  CONSTRAINT `FK_EF3ACE15FFEB5B27` FOREIGN KEY (`social_id`) REFERENCES `landing_social` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing`
--

LOCK TABLES `landing` WRITE;
/*!40000 ALTER TABLE `landing` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_chatbot`
--

DROP TABLE IF EXISTS `landing_chatbot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_chatbot` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `landing_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `avatar_name` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `avatar_picture` longtext COLLATE utf8_unicode_ci,
  `label_button` longtext COLLATE utf8_unicode_ci,
  `timeout_open` int(11) DEFAULT NULL,
  `colour` longtext COLLATE utf8_unicode_ci,
  `position` longtext COLLATE utf8_unicode_ci,
  `title` longtext COLLATE utf8_unicode_ci,
  `welcome` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_AE90FE25EFD98736` (`landing_id`),
  CONSTRAINT `FK_AE90FE25EFD98736` FOREIGN KEY (`landing_id`) REFERENCES `landing` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_chatbot`
--

LOCK TABLES `landing_chatbot` WRITE;
/*!40000 ALTER TABLE `landing_chatbot` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_chatbot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_contact`
--

DROP TABLE IF EXISTS `landing_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_contact` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `landing` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `customer` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9F36A819EF3ACE15` (`landing`),
  KEY `IDX_9F36A81981398E09` (`customer`),
  CONSTRAINT `FK_9F36A81981398E09` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`),
  CONSTRAINT `FK_9F36A819EF3ACE15` FOREIGN KEY (`landing`) REFERENCES `landing` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_contact`
--

LOCK TABLES `landing_contact` WRITE;
/*!40000 ALTER TABLE `landing_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_label`
--

DROP TABLE IF EXISTS `landing_label`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_label` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `navbar_about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navbar_product_or_service` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navbar_contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_title` longtext COLLATE utf8_unicode_ci,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_query` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_btn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_description` longtext COLLATE utf8_unicode_ci,
  `product_or_service_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_or_service_description` longtext COLLATE utf8_unicode_ci,
  `product_or_service_btn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `landing_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `form_legend` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BC89F6BEEFD98736` (`landing_id`),
  CONSTRAINT `FK_BC89F6BEEFD98736` FOREIGN KEY (`landing_id`) REFERENCES `landing` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_label`
--

LOCK TABLES `landing_label` WRITE;
/*!40000 ALTER TABLE `landing_label` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_plugin`
--

DROP TABLE IF EXISTS `landing_plugin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_plugin` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `landing_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `google_analitycs` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `google_ads_landing` longtext COLLATE utf8_unicode_ci,
  `google_ads_success` longtext COLLATE utf8_unicode_ci,
  `pixel_facebook` longtext COLLATE utf8_unicode_ci,
  `meta_tags_description` longtext COLLATE utf8_unicode_ci,
  `meta_index` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6BD4FDF3EFD98736` (`landing_id`),
  CONSTRAINT `FK_6BD4FDF3EFD98736` FOREIGN KEY (`landing_id`) REFERENCES `landing` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_plugin`
--

LOCK TABLES `landing_plugin` WRITE;
/*!40000 ALTER TABLE `landing_plugin` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_plugin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_query`
--

DROP TABLE IF EXISTS `landing_query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_query` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `landing` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `contact` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `query` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `is_reply` tinyint(1) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `stats` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_969313BDEF3ACE15` (`landing`),
  KEY `IDX_969313BD4C62E638` (`contact`),
  KEY `IDX_969313BD574767AA` (`stats`),
  CONSTRAINT `FK_969313BD4C62E638` FOREIGN KEY (`contact`) REFERENCES `landing_contact` (`id`),
  CONSTRAINT `FK_969313BD574767AA` FOREIGN KEY (`stats`) REFERENCES `stat` (`id`),
  CONSTRAINT `FK_969313BDEF3ACE15` FOREIGN KEY (`landing`) REFERENCES `landing` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_query`
--

LOCK TABLES `landing_query` WRITE;
/*!40000 ALTER TABLE `landing_query` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_query` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_reply`
--

DROP TABLE IF EXISTS `landing_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_reply` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `query` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `reply` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4F8660B624BDB5EB` (`query`),
  CONSTRAINT `FK_4F8660B624BDB5EB` FOREIGN KEY (`query`) REFERENCES `landing_query` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_reply`
--

LOCK TABLES `landing_reply` WRITE;
/*!40000 ALTER TABLE `landing_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_service`
--

DROP TABLE IF EXISTS `landing_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_service` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `landing` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `description` longtext COLLATE utf8_unicode_ci,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_32C9D4F3EF3ACE15` (`landing`),
  CONSTRAINT `FK_32C9D4F3EF3ACE15` FOREIGN KEY (`landing`) REFERENCES `landing` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_service`
--

LOCK TABLES `landing_service` WRITE;
/*!40000 ALTER TABLE `landing_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_social`
--

DROP TABLE IF EXISTS `landing_social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_social` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `landing_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `facebook` longtext COLLATE utf8_unicode_ci,
  `google_plus` longtext COLLATE utf8_unicode_ci,
  `twitter` longtext COLLATE utf8_unicode_ci,
  `youtube` longtext COLLATE utf8_unicode_ci,
  `linkedin` longtext COLLATE utf8_unicode_ci,
  `instagram` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `web` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F3DB3BE0EFD98736` (`landing_id`),
  CONSTRAINT `FK_F3DB3BE0EFD98736` FOREIGN KEY (`landing_id`) REFERENCES `landing` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_social`
--

LOCK TABLES `landing_social` WRITE;
/*!40000 ALTER TABLE `landing_social` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_test`
--

DROP TABLE IF EXISTS `landing_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_test` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `landing` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `from_at` datetime NOT NULL,
  `to_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4BD200B5EF3ACE15` (`landing`),
  CONSTRAINT `FK_4BD200B5EF3ACE15` FOREIGN KEY (`landing`) REFERENCES `landing` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_test`
--

LOCK TABLES `landing_test` WRITE;
/*!40000 ALTER TABLE `landing_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_test_option`
--

DROP TABLE IF EXISTS `landing_test_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_test_option` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `test` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `option_number` int(11) NOT NULL,
  `visits` int(11) DEFAULT NULL,
  `leads` int(11) DEFAULT NULL,
  `convertions` double DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6ED87431D87F7E0C` (`test`),
  CONSTRAINT `FK_6ED87431D87F7E0C` FOREIGN KEY (`test`) REFERENCES `landing_test` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_test_option`
--

LOCK TABLES `landing_test_option` WRITE;
/*!40000 ALTER TABLE `landing_test_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_test_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `customer_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `type_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BF5476CA9395C3F3` (`customer_id`),
  CONSTRAINT `FK_BF5476CA9395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES ('9f43f1e0-519f-11e9-822a-2914e74bbfdf','5ea6757a-518d-11e9-822a-2914e74bbfdf','Tu cuenta fue bloqueada.','customer_locked',NULL,'ghfj','2019-03-28 18:22:42','2019-03-28 18:22:42',0,0,NULL),('ace8389c-519f-11e9-822a-2914e74bbfdf','5ea6757a-518d-11e9-822a-2914e74bbfdf','Tu cuenta fue habilitada.','customer_unlocked',NULL,'Hemos habilitado nuevamente tu cuenta, ya puedes ingresar.','2019-03-28 18:23:05','2019-03-28 18:23:05',0,0,NULL);
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name_es` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameEn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` longtext COLLATE utf8_unicode_ci,
  `description_en` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES ('574b0a48-3950-11e9-964e-e620e93240a7','Políticas de privacidad','Privacy policies','<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed mattis est justo, ut efficitur elit vulputate in. Aliquam ut tortor vel ante interdum tempus. Maecenas vitae sagittis nisi, vulputate volutpat lacus. Pellentesque posuere porta enim, et dapibus diam pulvinar a. Nulla pharetra vitae massa ut rhoncus. Nunc et accumsan ante. Aenean finibus, lacus sed efficitur tristique, urna risus sodales justo, vitae fringilla arcu odio in mi.</div><div><br></div><div>Phasellus tincidunt dui nulla, vitae faucibus erat mollis nec. Etiam vulputate purus vehicula aliquam sodales. Ut at gravida magna. Aenean blandit ligula in egestas pretium. Sed a libero venenatis, eleifend urna in, tincidunt lorem. Etiam sed pellentesque sem, id scelerisque sapien. Etiam pellentesque lacus at consectetur lobortis. Nulla ultricies, nulla cursus convallis varius, ante ipsum condimentum nulla, quis ultricies eros sem ut nisi. Duis pulvinar a nibh a suscipit. Nullam porta, leo ac elementum molestie, libero orci fermentum risus, at pharetra tellus sapien nec sapien. Donec accumsan leo nec mi egestas, eu mollis leo interdum. Suspendisse ut tempor ipsum, sed porttitor quam.</div><div><br></div><div>Integer felis libero, scelerisque vel rhoncus eget, tempus sollicitudin urna. Quisque nec orci eget justo tincidunt porta. Proin ac metus sed risus tincidunt laoreet. Maecenas tincidunt viverra lacinia. Suspendisse consectetur metus at felis volutpat dictum. Ut fermentum libero mi, ut rhoncus quam facilisis quis. Sed dui metus, congue vitae odio sit amet, vehicula volutpat orci. Aenean at est mauris. Cras eget ullamcorper massa. Sed a metus elit. Vivamus aliquam turpis nec tempus ornare.</div><div><br></div><div>Praesent purus odio, elementum at nunc non, ultrices auctor arcu. Sed a lobortis dui. Nullam eget dui condimentum, lobortis mauris in, ornare ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum vel scelerisque tellus. Mauris mauris leo, blandit eget diam id, ullamcorper blandit metus. Donec mattis semper imperdiet. Praesent augue mi, hendrerit nec gravida ut, mollis et tellus. Sed vel felis felis.</div>','<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed mattis est justo, ut efficitur elit vulputate in. Aliquam ut tortor vel ante interdum tempus. Maecenas vitae sagittis nisi, vulputate volutpat lacus. Pellentesque posuere porta enim, et dapibus diam pulvinar a. Nulla pharetra vitae massa ut rhoncus. Nunc et accumsan ante. Aenean finibus, lacus sed efficitur tristique, urna risus sodales justo, vitae fringilla arcu odio in mi.</div><div><br></div><div>Phasellus tincidunt dui nulla, vitae faucibus erat mollis nec. Etiam vulputate purus vehicula aliquam sodales. Ut at gravida magna. Aenean blandit ligula in egestas pretium. Sed a libero venenatis, eleifend urna in, tincidunt lorem. Etiam sed pellentesque sem, id scelerisque sapien. Etiam pellentesque lacus at consectetur lobortis. Nulla ultricies, nulla cursus convallis varius, ante ipsum condimentum nulla, quis ultricies eros sem ut nisi. Duis pulvinar a nibh a suscipit. Nullam porta, leo ac elementum molestie, libero orci fermentum risus, at pharetra tellus sapien nec sapien. Donec accumsan leo nec mi egestas, eu mollis leo interdum. Suspendisse ut tempor ipsum, sed porttitor quam.</div><div><br></div><div>Integer felis libero, scelerisque vel rhoncus eget, tempus sollicitudin urna. Quisque nec orci eget justo tincidunt porta. Proin ac metus sed risus tincidunt laoreet. Maecenas tincidunt viverra lacinia. Suspendisse consectetur metus at felis volutpat dictum. Ut fermentum libero mi, ut rhoncus quam facilisis quis. Sed dui metus, congue vitae odio sit amet, vehicula volutpat orci. Aenean at est mauris. Cras eget ullamcorper massa. Sed a metus elit. Vivamus aliquam turpis nec tempus ornare.</div><div><br></div><div>Praesent purus odio, elementum at nunc non, ultrices auctor arcu. Sed a lobortis dui. Nullam eget dui condimentum, lobortis mauris in, ornare ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum vel scelerisque tellus. Mauris mauris leo, blandit eget diam id, ullamcorper blandit metus. Donec mattis semper imperdiet. Praesent augue mi, hendrerit nec gravida ut, mollis et tellus. Sed vel felis felis.</div>','2019-02-25 19:54:43','2019-02-25 19:54:43',0,'policies'),('71f46054-3d0d-11e9-975d-d96983531983','Uso de cookies','Use of cookies','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tristique volutpat nisi nec iaculis. Vivamus non dictum orci. Donec malesuada metus ac mi fermentum volutpat. Suspendisse ac ornare nulla, at tempus sapien.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tristique volutpat nisi nec iaculis. Vivamus non dictum orci. Donec malesuada metus ac mi fermentum volutpat. Suspendisse ac ornare nulla, at tempus sapien.','2019-03-02 14:05:56','2019-03-02 14:05:56',0,'cookies'),('98d447d0-32ad-11e9-b87d-3b10a2f9fd05','Términos y condiciones','Terms and conditions','<div style=\"text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eros libero, vulputate sed interdum vel, bibendum sed&nbsp;<span style=\"font-size: 1rem;\">leo. Fusce sit amet venenatis arcu. Donec lectus nunc, iaculis eu sagittis non, sollicitudin non tellus. Praesent sem&nbsp;</span><span style=\"font-size: 1rem;\">eros, tempus sit amet leo a, hendrerit sollicitudin nulla. Ut varius nunc quis sapien convallis, maximus gravida neque&nbsp;</span><span style=\"font-size: 1rem;\">aliquet. Vivamus sit amet odio in ligula lacinia luctus. Nam fermentum metus arcu, in elementum sapien egestas nec.&nbsp;</span><span style=\"font-size: 1rem;\">Vestibulum porttitor dignissim lectus in dapibus.</span></div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Vestibulum hendrerit, ligula in accumsan feugiat, libero ante aliquet ligula, consequat feugiat turpis ligula in augue.&nbsp;<span style=\"font-size: 1rem;\">Donec dignissim nibh eget mi scelerisque, ut facilisis velit viverra. Nullam tincidunt vitae arcu et congue. Lorem&nbsp;</span><span style=\"font-size: 1rem;\">ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra magna arcu, id viverra elit aliquet sit amet. Lorem&nbsp;</span><span style=\"font-size: 1rem;\">ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ligula nibh, dignissim vitae sem vel, ornare bibendum&nbsp;</span><span style=\"font-size: 1rem;\">augue. Maecenas dapibus ipsum a lacus congue, et tincidunt tortor consectetur.</span></div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Sed cursus finibus eros, ut blandit purus tincidunt sed. Cras convallis vel risus aliquet dignissim. Nullam maximus&nbsp;<span style=\"font-size: 1rem;\">odio non ipsum blandit, ut pharetra quam dictum. Nulla a odio risus. Aliquam iaculis quam et porta tincidunt. Vivamus&nbsp;</span><span style=\"font-size: 1rem;\">et tellus efficitur, facilisis nunc sed, pretium libero. Integer cursus congue erat. Nam ultrices eu ante eget&nbsp;</span><span style=\"font-size: 1rem;\">pharetra. Aliquam cursus augue id orci euismod sollicitudin. Ut nulla purus, pharetra nec lacus semper, semper dapibus&nbsp;</span><span style=\"font-size: 1rem;\">libero. Morbi et dapibus nisi. Suspendisse leo lacus, porta ac turpis vitae, bibendum sagittis ipsum. Cras ullamcorper&nbsp;</span><span style=\"font-size: 1rem;\">lectus sed lobortis congue.</span></div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Sed posuere commodo velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;&nbsp;<span style=\"font-size: 1rem;\">Mauris a eleifend leo. Donec ultricies elementum laoreet. Curabitur pulvinar sodales lorem, id tempor eros placerat in.&nbsp;</span><span style=\"font-size: 1rem;\">Aliquam et diam eget erat dapibus feugiat in a nibh. Integer vehicula eu arcu vitae imperdiet. Suspendisse tincidunt</span></div><div style=\"text-align: justify;\">enim ligula, id ornare odio ultrices nec. Sed eget dui tellus. Mauris fermentum elit nisi, eget lobortis massa sagittis&nbsp;<span style=\"font-size: 1rem;\">eu. Morbi eu vestibulum dolor. Fusce rutrum leo pellentesque erat semper posuere. Nam finibus tortor pharetra arcu</span><span style=\"font-size: 1rem;\">gravida, condimentum viverra massa placerat. Duis in arcu id felis pretium euismod a at lectus.</span></div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Integer interdum molestie mauris quis mollis. Integer ex eros, elementum vehicula aliquam et, vestibulum eget massa.&nbsp;<span style=\"font-size: 1rem;\">Nam imperdiet purus a sem hendrerit, id sagittis augue dictum. Proin quis ipsum dolor. Donec sapien velit, lacinia vel&nbsp;</span><span style=\"font-size: 1rem;\">odio id, ultricies ullamcorper mi. Vivamus mattis in nisl eget tristique. Sed id urna sed augue dignissim finibus.&nbsp;</span><span style=\"font-size: 1rem;\">Vestibulum ut hendrerit erat. Vivamus elementum imperdiet efficitur. Nullam tempus odio ut lacus hendrerit, et varius&nbsp;</span><span style=\"font-size: 1rem;\">ligula viverra. Duis sollicitudin, nunc a viverra ullamcorper, lectus sapien fermentum neque, vel facilisis nulla mi ac&nbsp;</span><span style=\"font-size: 1rem;\">risus. Donec at laoreet ante, quis condimentum felis. Integer id feugiat lorem, sed sodales urna. Vestibulum viverra&nbsp;</span><span style=\"font-size: 1rem;\">risus sapien. Etiam pellentesque nisi eget ipsum iaculis aliquam. Curabitur vel nisl nec neque facilisis aliquet.</span></div>','<div style=\"text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eros libero, vulputate sed interdum vel, bibendum sed&nbsp;<span style=\"font-size: 1rem;\">leo. Fusce sit amet venenatis arcu. Donec lectus nunc, iaculis eu sagittis non, sollicitudin non tellus. Praesent sem&nbsp;</span><span style=\"font-size: 1rem;\">eros, tempus sit amet leo a, hendrerit sollicitudin nulla. Ut varius nunc quis sapien convallis, maximus gravida neque&nbsp;</span><span style=\"font-size: 1rem;\">aliquet. Vivamus sit amet odio in ligula lacinia luctus. Nam fermentum metus arcu, in elementum sapien egestas nec.&nbsp;</span><span style=\"font-size: 1rem;\">Vestibulum porttitor dignissim lectus in dapibus.</span></div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Vestibulum hendrerit, ligula in accumsan feugiat, libero ante aliquet ligula, consequat feugiat turpis ligula in augue.&nbsp;<span style=\"font-size: 1rem;\">Donec dignissim nibh eget mi scelerisque, ut facilisis velit viverra. Nullam tincidunt vitae arcu et congue. Lorem&nbsp;</span><span style=\"font-size: 1rem;\">ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra magna arcu, id viverra elit aliquet sit amet. Lorem&nbsp;</span><span style=\"font-size: 1rem;\">ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ligula nibh, dignissim vitae sem vel, ornare bibendum&nbsp;</span><span style=\"font-size: 1rem;\">augue. Maecenas dapibus ipsum a lacus congue, et tincidunt tortor consectetur.</span></div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Sed cursus finibus eros, ut blandit purus tincidunt sed. Cras convallis vel risus aliquet dignissim. Nullam maximus&nbsp;<span style=\"font-size: 1rem;\">odio non ipsum blandit, ut pharetra quam dictum. Nulla a odio risus. Aliquam iaculis quam et porta tincidunt. Vivamus&nbsp;</span><span style=\"font-size: 1rem;\">et tellus efficitur, facilisis nunc sed, pretium libero. Integer cursus congue erat. Nam ultrices eu ante eget&nbsp;</span><span style=\"font-size: 1rem;\">pharetra. Aliquam cursus augue id orci euismod sollicitudin. Ut nulla purus, pharetra nec lacus semper, semper dapibus&nbsp;</span><span style=\"font-size: 1rem;\">libero. Morbi et dapibus nisi. Suspendisse leo lacus, porta ac turpis vitae, bibendum sagittis ipsum. Cras ullamcorper&nbsp;</span><span style=\"font-size: 1rem;\">lectus sed lobortis congue.</span></div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Sed posuere commodo velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;&nbsp;<span style=\"font-size: 1rem;\">Mauris a eleifend leo. Donec ultricies elementum laoreet. Curabitur pulvinar sodales lorem, id tempor eros placerat in.&nbsp;</span><span style=\"font-size: 1rem;\">Aliquam et diam eget erat dapibus feugiat in a nibh. Integer vehicula eu arcu vitae imperdiet. Suspendisse tincidunt</span></div><div style=\"text-align: justify;\">enim ligula, id ornare odio ultrices nec. Sed eget dui tellus. Mauris fermentum elit nisi, eget lobortis massa sagittis&nbsp;<span style=\"font-size: 1rem;\">eu. Morbi eu vestibulum dolor. Fusce rutrum leo pellentesque erat semper posuere. Nam finibus tortor pharetra arcu</span><span style=\"font-size: 1rem;\">gravida, condimentum viverra massa placerat. Duis in arcu id felis pretium euismod a at lectus.</span></div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Integer interdum molestie mauris quis mollis. Integer ex eros, elementum vehicula aliquam et, vestibulum eget massa.&nbsp;<span style=\"font-size: 1rem;\">Nam imperdiet purus a sem hendrerit, id sagittis augue dictum. Proin quis ipsum dolor. Donec sapien velit, lacinia vel&nbsp;</span><span style=\"font-size: 1rem;\">odio id, ultricies ullamcorper mi. Vivamus mattis in nisl eget tristique. Sed id urna sed augue dignissim finibus.&nbsp;</span><span style=\"font-size: 1rem;\">Vestibulum ut hendrerit erat. Vivamus elementum imperdiet efficitur. Nullam tempus odio ut lacus hendrerit, et varius&nbsp;</span><span style=\"font-size: 1rem;\">ligula viverra. Duis sollicitudin, nunc a viverra ullamcorper, lectus sapien fermentum neque, vel facilisis nulla mi ac&nbsp;</span><span style=\"font-size: 1rem;\">risus. Donec at laoreet ante, quis condimentum felis. Integer id feugiat lorem, sed sodales urna. Vestibulum viverra&nbsp;</span><span style=\"font-size: 1rem;\">risus sapien. Etiam pellentesque nisi eget ipsum iaculis aliquam. Curabitur vel nisl nec neque facilisis aliquet.</span></div>','2019-02-17 09:14:38','2019-02-17 09:16:42',0,'terms');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name_es` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `nameEn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trial_days` int(11) NOT NULL,
  `max_landing` int(11) NOT NULL,
  `max_business` int(11) NOT NULL,
  `description_es` longtext COLLATE utf8_unicode_ci,
  `description_en` longtext COLLATE utf8_unicode_ci,
  `order_show` int(11) NOT NULL,
  `support_email` tinyint(1) NOT NULL,
  `max_visits` int(11) NOT NULL,
  `max_leads` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan`
--

LOCK TABLES `plan` WRITE;
/*!40000 ALTER TABLE `plan` DISABLE KEYS */;
INSERT INTO `plan` VALUES ('269110cc-3375-11e9-befa-27c66dcdbd4c','Plata',500,'2019-02-18 09:03:06','2019-02-22 16:38:19',0,NULL,15,2,15,'dsa','dsa',2,1,0,0),('5bb93722-36d9-11e9-bed4-2e252c71b32c','Promo',150,'2019-02-22 16:37:58','2019-03-14 17:22:34',0,NULL,1,2,1,'dsadsadsadsa','dsadsadsdsa',1,1,100000,10000);
/*!40000 ALTER TABLE `plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `google_maps_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `login_google_client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login_facebook_app_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `script_google_analytics` longtext COLLATE utf8_unicode_ci,
  `meta_tags` longtext COLLATE utf8_unicode_ci,
  `greeting_second_response` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `greeting_second_trigger` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `more_info_response` longtext COLLATE utf8_unicode_ci NOT NULL,
  `more_info_trigger` longtext COLLATE utf8_unicode_ci NOT NULL,
  `more_price_response` longtext COLLATE utf8_unicode_ci NOT NULL,
  `more_price_trigger` longtext COLLATE utf8_unicode_ci NOT NULL,
  `not_understand` longtext COLLATE utf8_unicode_ci NOT NULL,
  `not_use_phone_trigger` longtext COLLATE utf8_unicode_ci NOT NULL,
  `not_use_phone_response` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone_not_valid` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email_not_valid` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mp_client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mp_client_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mp_access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES ('setting','AIzaSyCNj3-soT2HznW8fzcFx8G1IqYh6XiA5qE','0000-00-00 00:00:00','2019-03-22 14:25:47',0,'417581591551-dodqqbu0q3mgo50mtlhu65949ah8s24f.apps.googleusercontent.com','562635694234180',NULL,'<meta content=\"\" name=\"keywords\">\r\n<meta content=\"\" name=\"description\">','Hola!!!!!, como te puedo ayudar?','hola,que tal,puto','Para obtener más información un representante se comunicará contigo.<br/>¿Cual es tu número de teléfono, así te contactamos?','info,+info,+ info,saber,quería,quiero','Para obtener una cotización o presupuesto un representante se comunicará contigo.<br/>¿Cual es tu número de teléfono, así te contactamos?','cotización,cotizacion,presupuesto,cotizar,precio,cto sale,sale,cuesta,valor\'','Lo siento no entiendo lo que necesitas.','no tengo,no uso,no,no se,no sé,no lo sé,no lo se,ninguno,ni idea','No te procupes, ¿cual es tu email y te escribiremos?','El teléfono creo que no es válido, podrías ingresarlo de nuevo (intenta ingresar sólo números):','El email no es válido','6855942644171528','N8zF5XaWdZNnVYPXCQLErxNW3dkBywCK','TEST-6855942644171528-030916-9dd174b345a9c9ba5b51294c1f5a0cd9-8284100');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site`
--

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat`
--

DROP TABLE IF EXISTS `stat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `landing_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `browser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `browser_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `os` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `os_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_mobile` tinyint(1) DEFAULT NULL,
  `is_mobile_major` tinyint(1) DEFAULT NULL,
  `is_mobile_android` tinyint(1) DEFAULT NULL,
  `is_mobile_opera` tinyint(1) DEFAULT NULL,
  `is_mobile_windows` tinyint(1) DEFAULT NULL,
  `is_mobile_blackberry` tinyint(1) DEFAULT NULL,
  `is_mobile_ios` tinyint(1) DEFAULT NULL,
  `is_iphone` tinyint(1) DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `finger_print` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acc` int(11) DEFAULT NULL,
  `lead_valid` tinyint(1) DEFAULT NULL,
  `contact` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`),
  KEY `IDX_20B8FF21EFD98736` (`landing_id`),
  KEY `IDX_20B8FF214C62E638` (`contact`),
  CONSTRAINT `FK_20B8FF214C62E638` FOREIGN KEY (`contact`) REFERENCES `landing_contact` (`id`),
  CONSTRAINT `FK_20B8FF21EFD98736` FOREIGN KEY (`landing_id`) REFERENCES `landing` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat`
--

LOCK TABLES `stat` WRITE;
/*!40000 ALTER TABLE `stat` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_message`
--

DROP TABLE IF EXISTS `stat_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_message` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `stat` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `user_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_524747E620B8FF21` (`stat`),
  CONSTRAINT `FK_524747E620B8FF21` FOREIGN KEY (`stat`) REFERENCES `stat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_message`
--

LOCK TABLES `stat_message` WRITE;
/*!40000 ALTER TABLE `stat_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `code_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiration_code` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `picture` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('a368a760-031c-11e9-9093-771a1c40eee9','Superusuario',NULL,'admin@email.com','$2y$13$LEs4yEqUr9yCQgPBYGtfiO28rppFXkUBK9NYi35e7gUupHWDS15Ga',NULL,NULL,'ROLE_SUPER','Super usuario creado automaticamente, se recomienda crear otro usuario con el rol SUPER y elimine este.',NULL,NULL,1,NULL,'2018-12-18 23:28:34','2018-12-19 19:23:20',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-03 16:55:17
