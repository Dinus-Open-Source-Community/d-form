/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dform
-- ------------------------------------------------------
-- Server version	10.11.13-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES
('d_form_cache_356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1749819298),
('d_form_cache_356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1749819298;',1749819298);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `cover_event` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `map_url` varchar(255) DEFAULT NULL,
  `gform_url` varchar(255) DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration_days` int(11) NOT NULL,
  `participants` int(11) NOT NULL,
  `type` enum('RKT','NON-RKT') NOT NULL,
  `division` enum('General','Programming','Multimedia','Networking') NOT NULL DEFAULT 'General',
  `start_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_user_id_foreign` (`user_id`),
  CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES
('0197695a-9413-7206-a443-9e96ed18fa50',1,'Release Party 2025','Release Party 2025 pecah',35000.00,NULL,'TVKU Building 3rd Floor','https://google.com','https://google.com','07:30:00','13:00:00',1,350,'RKT','General','2025-06-14','2025-06-13 19:53:53','2025-06-13 19:53:53');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
INSERT INTO `failed_jobs` VALUES
(1,'1480e7c0-4c55-440b-83d1-1ca71806e4ea','database','default','{\"uuid\":\"1480e7c0-4c55-440b-83d1-1ca71806e4ea\",\"displayName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":1800,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\GenerateQrZipJob\\\":2:{s:7:\\\"eventId\\\";s:36:\\\"0197695a-9413-7206-a443-9e96ed18fa50\\\";s:11:\\\"zipFilePath\\\";s:81:\\\"\\/srv\\/www\\/d-form\\/public\\/barcodes\\/barcodes_0197695a-9413-7206-a443-9e96ed18fa50.zip\\\";}\"},\"createdAt\":1749822147,\"delay\":null}','ErrorException: file_put_contents(/srv/www/d-form/public/barcodes/0197695a-9413-7206-a443-9e96ed18fa50/Pramudya Putra Pratama.png): Failed to open stream: No such file or directory in /srv/www/d-form/vendor/simplesoftwareio/simple-qrcode/src/Generator.php:179\nStack trace:\n#0 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(256): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 [internal function]: Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /srv/www/d-form/vendor/simplesoftwareio/simple-qrcode/src/Generator.php(179): file_put_contents()\n#3 /srv/www/d-form/app/Jobs/GenerateQrZipJob.php(49): SimpleSoftwareIO\\QrCode\\Generator->generate()\n#4 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\GenerateQrZipJob->handle()\n#5 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#6 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#7 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#8 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Container/Container.php(754): Illuminate\\Container\\BoundMethod::call()\n#9 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call()\n#10 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#11 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#12 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then()\n#13 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#14 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#15 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#16 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then()\n#17 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#18 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#19 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(441): Illuminate\\Queue\\Jobs\\Job->fire()\n#20 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(391): Illuminate\\Queue\\Worker->process()\n#21 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(177): Illuminate\\Queue\\Worker->runJob()\n#22 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon()\n#23 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#24 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#25 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#26 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#27 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#28 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Container/Container.php(754): Illuminate\\Container\\BoundMethod::call()\n#29 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call()\n#30 /srv/www/d-form/vendor/symfony/console/Command/Command.php(279): Illuminate\\Console\\Command->execute()\n#31 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run()\n#32 /srv/www/d-form/vendor/symfony/console/Application.php(1094): Illuminate\\Console\\Command->run()\n#33 /srv/www/d-form/vendor/symfony/console/Application.php(342): Symfony\\Component\\Console\\Application->doRunCommand()\n#34 /srv/www/d-form/vendor/symfony/console/Application.php(193): Symfony\\Component\\Console\\Application->doRun()\n#35 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run()\n#36 /srv/www/d-form/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle()\n#37 /srv/www/d-form/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#38 {main}','2025-06-13 20:42:30');
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES
(4,'default','{\"uuid\":\"4cacd623-01ec-4d8f-aee7-584f2a5fdafd\",\"displayName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":1800,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\GenerateQrZipJob\\\":2:{s:7:\\\"eventId\\\";s:36:\\\"0197695a-9413-7206-a443-9e96ed18fa50\\\";s:11:\\\"zipFilePath\\\";s:81:\\\"\\/srv\\/www\\/d-form\\/public\\/barcodes\\/barcodes_0197695a-9413-7206-a443-9e96ed18fa50.zip\\\";}\"},\"createdAt\":1749822150,\"delay\":null}',0,NULL,1749822150,1749822150),
(5,'default','{\"uuid\":\"443a6e60-5a7b-4a73-8203-403bf3be1274\",\"displayName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":1800,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\GenerateQrZipJob\\\":2:{s:7:\\\"eventId\\\";s:36:\\\"0197695a-9413-7206-a443-9e96ed18fa50\\\";s:11:\\\"zipFilePath\\\";s:81:\\\"\\/srv\\/www\\/d-form\\/public\\/barcodes\\/barcodes_0197695a-9413-7206-a443-9e96ed18fa50.zip\\\";}\"},\"createdAt\":1749822151,\"delay\":null}',0,NULL,1749822151,1749822151),
(6,'default','{\"uuid\":\"1efbaea1-3fe9-4131-8396-33c622592176\",\"displayName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":1800,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\GenerateQrZipJob\\\":2:{s:7:\\\"eventId\\\";s:36:\\\"0197695a-9413-7206-a443-9e96ed18fa50\\\";s:11:\\\"zipFilePath\\\";s:81:\\\"\\/srv\\/www\\/d-form\\/public\\/barcodes\\/barcodes_0197695a-9413-7206-a443-9e96ed18fa50.zip\\\";}\"},\"createdAt\":1749822164,\"delay\":null}',0,NULL,1749822164,1749822164),
(7,'default','{\"uuid\":\"9b515e67-c5ac-4730-9534-5f9b03e7fb19\",\"displayName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":1800,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\GenerateQrZipJob\\\":2:{s:7:\\\"eventId\\\";s:36:\\\"0197695a-9413-7206-a443-9e96ed18fa50\\\";s:11:\\\"zipFilePath\\\";s:81:\\\"\\/srv\\/www\\/d-form\\/public\\/barcodes\\/barcodes_0197695a-9413-7206-a443-9e96ed18fa50.zip\\\";}\"},\"createdAt\":1749822168,\"delay\":null}',0,NULL,1749822168,1749822168),
(8,'default','{\"uuid\":\"9d56a2b1-d61a-4be1-9665-0c52c6b7a6f4\",\"displayName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":1800,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\GenerateQrZipJob\\\":2:{s:7:\\\"eventId\\\";s:36:\\\"0197695a-9413-7206-a443-9e96ed18fa50\\\";s:11:\\\"zipFilePath\\\";s:81:\\\"\\/srv\\/www\\/d-form\\/public\\/barcodes\\/barcodes_0197695a-9413-7206-a443-9e96ed18fa50.zip\\\";}\"},\"createdAt\":1749822174,\"delay\":null}',0,NULL,1749822174,1749822174),
(9,'default','{\"uuid\":\"839963ef-f691-408c-9525-999cdfb02f67\",\"displayName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":1800,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\GenerateQrZipJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\GenerateQrZipJob\\\":2:{s:7:\\\"eventId\\\";s:36:\\\"0197695a-9413-7206-a443-9e96ed18fa50\\\";s:11:\\\"zipFilePath\\\";s:81:\\\"\\/srv\\/www\\/d-form\\/public\\/barcodes\\/barcodes_0197695a-9413-7206-a443-9e96ed18fa50.zip\\\";}\"},\"createdAt\":1749858165,\"delay\":null}',0,NULL,1749858165,1749858165);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_02_03_065206_create_events_table',1),
(5,'2025_02_05_000006_create_participants_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `participants` (
  `id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `school` varchar(255) DEFAULT NULL,
  `is_presence` tinyint(1) NOT NULL DEFAULT 0,
  `presence_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `participants_event_id_foreign` (`event_id`),
  CONSTRAINT `participants_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
INSERT INTO `participants` VALUES
('0197695a-ac7a-7123-b141-b65d66e25d22','0197695a-9413-7206-a443-9e96ed18fa50','Coba coba','UDINUS',1,'2025-06-14 07:26:31','2025-06-13 19:53:59','2025-06-14 07:26:31'),
('0197695a-ac7c-7332-98ac-5d490c1e5149','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad iadhjlandkl','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ac7d-706a-b174-3b0069a5b2e2','0197695a-9413-7206-a443-9e96ed18fa50','Pramudya Putra Pratama','UDINUS',1,'2025-06-14 07:35:32','2025-06-13 19:53:59','2025-06-14 07:35:32'),
('0197695a-ac81-7373-9067-26628e340ee7','0197695a-9413-7206-a443-9e96ed18fa50','Agil Rahman','UDINUS',1,'2025-06-14 07:35:13','2025-06-13 19:53:59','2025-06-14 07:35:13'),
('0197695a-ac82-711f-91eb-4f0aae852894','0197695a-9413-7206-a443-9e96ed18fa50','Kin Rajasa Abdi Bawana','UDINUS',1,'2025-06-14 07:35:17','2025-06-13 19:53:59','2025-06-14 07:35:17'),
('0197695a-ac82-711f-91eb-4f0aaea5c653','0197695a-9413-7206-a443-9e96ed18fa50','Aditia Eka Ramadhan','UDINUS',1,'2025-06-14 07:54:38','2025-06-13 19:53:59','2025-06-14 07:54:38'),
('0197695a-ac83-72c7-ad5f-969532cc6982','0197695a-9413-7206-a443-9e96ed18fa50','Danendra Althaf Yuganfa','UDINUS',1,'2025-06-14 08:05:30','2025-06-13 19:53:59','2025-06-14 08:05:30'),
('0197695a-ac83-72c7-ad5f-9695335221a5','0197695a-9413-7206-a443-9e96ed18fa50','Daniel Aquaries Pratama','UDINUS',1,'2025-06-14 07:43:20','2025-06-13 19:53:59','2025-06-14 07:43:20'),
('0197695a-ac84-72fe-bf41-0e98fe4e4009','0197695a-9413-7206-a443-9e96ed18fa50','Thoriq Hafizh Deandra','UDINUS',1,'2025-06-14 09:08:40','2025-06-13 19:53:59','2025-06-14 09:08:40'),
('0197695a-ac84-72fe-bf41-0e98ff3c25fe','0197695a-9413-7206-a443-9e96ed18fa50','Egi Indra Raditya','UDINUS',1,'2025-06-14 07:59:07','2025-06-13 19:53:59','2025-06-14 07:59:07'),
('0197695a-ac85-71b2-8ecd-a3e1f807171f','0197695a-9413-7206-a443-9e96ed18fa50','Syahratu Andhara Satriani','UDINUS',1,'2025-06-14 08:46:14','2025-06-13 19:53:59','2025-06-14 08:46:14'),
('0197695a-ac85-71b2-8ecd-a3e1f84c0e4e','0197695a-9413-7206-a443-9e96ed18fa50','Mayra Anggraini','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ac86-70c2-8eff-44d4939397cd','0197695a-9413-7206-a443-9e96ed18fa50','Feby Akliji Rofiah','UDINUS',1,'2025-06-14 08:24:47','2025-06-13 19:53:59','2025-06-14 08:24:47'),
('0197695a-ac86-70c2-8eff-44d49421fe9a','0197695a-9413-7206-a443-9e96ed18fa50','Rama Eka Saputra','UDINUS',1,'2025-06-14 07:59:49','2025-06-13 19:53:59','2025-06-14 07:59:49'),
('0197695a-ac87-728b-9732-7bea8a06f7d7','0197695a-9413-7206-a443-9e96ed18fa50','Najma Aura Dias Prameswari','UDINUS',1,'2025-06-14 08:24:34','2025-06-13 19:53:59','2025-06-14 08:24:34'),
('0197695a-ac87-728b-9732-7bea8afc4279','0197695a-9413-7206-a443-9e96ed18fa50','Hani Nafilah','UDINUS',1,'2025-06-14 07:35:42','2025-06-13 19:53:59','2025-06-14 07:35:42'),
('0197695a-ac88-725c-a861-b522e9b17414','0197695a-9413-7206-a443-9e96ed18fa50','Najwah Kamila','UDINUS',1,'2025-06-14 07:35:47','2025-06-13 19:53:59','2025-06-14 07:35:47'),
('0197695a-ac88-725c-a861-b522ea1dd49f','0197695a-9413-7206-a443-9e96ed18fa50','Mahdalena','UDINUS',1,'2025-06-14 08:22:01','2025-06-13 19:53:59','2025-06-14 08:22:01'),
('0197695a-ac89-722e-8b50-6a20bdcbd0fd','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Najmi Aqil','UDINUS',1,'2025-06-14 08:21:51','2025-06-13 19:53:59','2025-06-14 08:21:51'),
('0197695a-ac89-722e-8b50-6a20bdfa70cc','0197695a-9413-7206-a443-9e96ed18fa50','Elisabet Cynthia Adrianetta','UDINUS',1,'2025-06-14 08:14:31','2025-06-13 19:53:59','2025-06-14 08:14:31'),
('0197695a-ac8a-72c2-8683-78e104cc11c2','0197695a-9413-7206-a443-9e96ed18fa50','Citra Aulia Fadila','UDINUS',1,'2025-06-14 08:34:35','2025-06-13 19:53:59','2025-06-14 08:34:35'),
('0197695a-ac8a-72c2-8683-78e105277cc4','0197695a-9413-7206-a443-9e96ed18fa50','Zahra Afifah','UDINUS',1,'2025-06-14 08:34:37','2025-06-13 19:53:59','2025-06-14 08:34:37'),
('0197695a-ac8b-73f9-bec4-676c236c512e','0197695a-9413-7206-a443-9e96ed18fa50','Ahmad Zuhdi Bassam Nuris','UDINUS',1,'2025-06-14 08:47:09','2025-06-13 19:53:59','2025-06-14 08:47:09'),
('0197695a-ac8b-73f9-bec4-676c23ac37be','0197695a-9413-7206-a443-9e96ed18fa50','Taufiqul Umam','UDINUS',1,'2025-06-14 09:02:27','2025-06-13 19:53:59','2025-06-14 09:02:27'),
('0197695a-ac8b-73f9-bec4-676c23e142ff','0197695a-9413-7206-a443-9e96ed18fa50','Fadhil Yuka Sahistya','UDINUS',1,'2025-06-14 08:47:26','2025-06-13 19:53:59','2025-06-14 08:47:26'),
('0197695a-ac8c-7119-af8f-d0b4571111ce','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Sholahuddin Rasyid','UDINUS',1,'2025-06-14 08:04:33','2025-06-13 19:53:59','2025-06-14 08:04:33'),
('0197695a-ac8c-7119-af8f-d0b457b92105','0197695a-9413-7206-a443-9e96ed18fa50','Syalom Christian','UDINUS',1,'2025-06-14 08:02:17','2025-06-13 19:53:59','2025-06-14 08:02:17'),
('0197695a-ac8d-70d4-8c98-b266ac3fc9ba','0197695a-9413-7206-a443-9e96ed18fa50','Mohammad Arief Rizky Aditya','UDINUS',1,'2025-06-14 08:02:05','2025-06-13 19:53:59','2025-06-14 08:02:05'),
('0197695a-ac8d-70d4-8c98-b266acd713ca','0197695a-9413-7206-a443-9e96ed18fa50','Kohelet aprillo toka','UDINUS',1,'2025-06-14 08:14:25','2025-06-13 19:53:59','2025-06-14 08:14:25'),
('0197695a-ac8e-722b-9c1e-02ce424bd179','0197695a-9413-7206-a443-9e96ed18fa50','Hafif Hidayatullah','UDINUS',1,'2025-06-14 09:21:50','2025-06-13 19:53:59','2025-06-14 09:21:50'),
('0197695a-ac8e-722b-9c1e-02ce430fdf5e','0197695a-9413-7206-a443-9e96ed18fa50','raka warnandi','UDINUS',1,'2025-06-14 09:23:02','2025-06-13 19:53:59','2025-06-14 09:23:02'),
('0197695a-ac8f-739b-9371-c9e82307ff17','0197695a-9413-7206-a443-9e96ed18fa50','Choirul Andi Setiawan','UDINUS',1,'2025-06-14 09:21:38','2025-06-13 19:53:59','2025-06-14 09:21:38'),
('0197695a-ac8f-739b-9371-c9e8235d4910','0197695a-9413-7206-a443-9e96ed18fa50','Sandy Candra Ramadhan','UDINUS',1,'2025-06-14 08:25:35','2025-06-13 19:53:59','2025-06-14 08:25:35'),
('0197695a-ac90-72d7-be73-17815e9b38c4','0197695a-9413-7206-a443-9e96ed18fa50','ALFIN AQILA MUZAKI','UDINUS',1,'2025-06-14 08:45:56','2025-06-13 19:53:59','2025-06-14 08:45:56'),
('0197695a-ac90-72d7-be73-17815f12a99a','0197695a-9413-7206-a443-9e96ed18fa50','PUTRA IQBAL AMRULLAH','UDINUS',1,'2025-06-14 08:46:29','2025-06-13 19:53:59','2025-06-14 08:46:29'),
('0197695a-ac91-70a4-a6d0-7f60f0d8497b','0197695a-9413-7206-a443-9e96ed18fa50','MOHAMAD RIVAL FARID RIWALDI','UDINUS',1,'2025-06-14 08:46:33','2025-06-13 19:53:59','2025-06-14 08:46:33'),
('0197695a-ac91-70a4-a6d0-7f60f1a72184','0197695a-9413-7206-a443-9e96ed18fa50','Sikah Afni Afifah','UDINUS',1,'2025-06-14 08:19:20','2025-06-13 19:53:59','2025-06-14 08:19:20'),
('0197695a-ac92-70d2-9aec-f9b0c52c06f2','0197695a-9413-7206-a443-9e96ed18fa50','Anisa Dwi Cahyaningrum','UDINUS',1,'2025-06-14 08:19:49','2025-06-13 19:53:59','2025-06-14 08:19:49'),
('0197695a-ac92-70d2-9aec-f9b0c55e1698','0197695a-9413-7206-a443-9e96ed18fa50','Tata Ayu Maulidya Putri','UDINUS',1,'2025-06-14 08:18:58','2025-06-13 19:53:59','2025-06-14 08:18:58'),
('0197695a-ac93-7209-ab7b-87ceaa11376c','0197695a-9413-7206-a443-9e96ed18fa50','Abdul Rozak Saputra','UDINUS',1,'2025-06-14 09:10:58','2025-06-13 19:53:59','2025-06-14 09:10:58'),
('0197695a-ac93-7209-ab7b-87ceaaf485e9','0197695a-9413-7206-a443-9e96ed18fa50','Nauval Khudzaifi Sutisna','UDINUS',1,'2025-06-14 09:10:39','2025-06-13 19:53:59','2025-06-14 09:10:39'),
('0197695a-ac94-70e4-a6e7-38440a9dd92c','0197695a-9413-7206-a443-9e96ed18fa50','Tsaabitah Arga Nitibaskara','UDINUS',1,'2025-06-14 09:10:56','2025-06-13 19:53:59','2025-06-14 09:10:56'),
('0197695a-ac94-70e4-a6e7-38440b90ef20','0197695a-9413-7206-a443-9e96ed18fa50','Ahmad Nabilul As\'ad','UDINUS',1,'2025-06-14 08:08:21','2025-06-13 19:53:59','2025-06-14 08:08:21'),
('0197695a-ac94-70e4-a6e7-38440c494395','0197695a-9413-7206-a443-9e96ed18fa50','Naufal Rizky Ramadhan','UDINUS',1,'2025-06-14 08:07:04','2025-06-13 19:53:59','2025-06-14 08:07:04'),
('0197695a-ac95-700f-bb8e-01a92efd44f1','0197695a-9413-7206-a443-9e96ed18fa50','Aufa Fadholi Suharyoto','UDINUS',1,'2025-06-14 08:08:05','2025-06-13 19:53:59','2025-06-14 08:08:05'),
('0197695a-ac95-700f-bb8e-01a92f0cfc22','0197695a-9413-7206-a443-9e96ed18fa50','Ardian Danendra','UDINUS',1,'2025-06-14 08:08:09','2025-06-13 19:53:59','2025-06-14 08:08:09'),
('0197695a-ac96-736a-8064-f6c737fb2f44','0197695a-9413-7206-a443-9e96ed18fa50','Shiyanah','UDINUS',1,'2025-06-14 08:18:19','2025-06-13 19:53:59','2025-06-14 08:18:19'),
('0197695a-ac96-736a-8064-f6c738d83569','0197695a-9413-7206-a443-9e96ed18fa50','Siti Syaharani Khoiriyah','UDINUS',1,'2025-06-14 08:17:59','2025-06-13 19:53:59','2025-06-14 08:17:59'),
('0197695a-ac97-7343-869d-b9422a137fc7','0197695a-9413-7206-a443-9e96ed18fa50','Amelia Fitri Sibarani','UDINUS',1,'2025-06-14 08:17:50','2025-06-13 19:53:59','2025-06-14 08:17:50'),
('0197695a-ac97-7343-869d-b9422a18f045','0197695a-9413-7206-a443-9e96ed18fa50','Gibran Rais Hilmy Iskandar','UDINUS',1,'2025-06-14 08:55:02','2025-06-13 19:53:59','2025-06-14 08:55:02'),
('0197695a-ac98-7178-a2c0-715664bfc661','0197695a-9413-7206-a443-9e96ed18fa50','Adi Priyo Pangestu','UDINUS',1,'2025-06-14 07:46:36','2025-06-13 19:53:59','2025-06-14 07:46:36'),
('0197695a-ac98-7178-a2c0-71566586b11c','0197695a-9413-7206-a443-9e96ed18fa50','Della Destania','UDINUS',1,'2025-06-14 07:46:26','2025-06-13 19:53:59','2025-06-14 07:46:26'),
('0197695a-ac99-71b1-b489-d0bcdb87d3bf','0197695a-9413-7206-a443-9e96ed18fa50','Aliyah Zahratu Rizqi','UDINUS',1,'2025-06-14 08:14:17','2025-06-13 19:53:59','2025-06-14 08:14:17'),
('0197695a-ac99-71b1-b489-d0bcdbef26ed','0197695a-9413-7206-a443-9e96ed18fa50','Aditya Firman Gani','UDINUS',1,'2025-06-14 09:47:08','2025-06-13 19:53:59','2025-06-14 09:47:08'),
('0197695a-ac9a-719f-b0a9-865ccfd3716a','0197695a-9413-7206-a443-9e96ed18fa50','Haeranisa Bella Krisanti','UDINUS',1,'2025-06-14 09:47:09','2025-06-13 19:53:59','2025-06-14 09:47:09'),
('0197695a-ac9a-719f-b0a9-865ccfd947cd','0197695a-9413-7206-a443-9e96ed18fa50','Mamay Maida','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ac9b-7202-9e7e-add0817e0bb1','0197695a-9413-7206-a443-9e96ed18fa50','Hestiana Putri Novitasari','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ac9b-7202-9e7e-add0827003fa','0197695a-9413-7206-a443-9e96ed18fa50','Sifa Ayu Rosita Sari','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ac9c-736c-9b7b-de91fe79e4c2','0197695a-9413-7206-a443-9e96ed18fa50','Yudha Aji Prasetya','UDINUS',1,'2025-06-14 09:21:34','2025-06-13 19:53:59','2025-06-14 09:21:34'),
('0197695a-ac9c-736c-9b7b-de91ff51ea1f','0197695a-9413-7206-a443-9e96ed18fa50','Nabil Nazhmi Kurniali','UDINUS',1,'2025-06-14 09:21:31','2025-06-13 19:53:59','2025-06-14 09:21:31'),
('0197695a-ac9c-736c-9b7b-de91ff65115a','0197695a-9413-7206-a443-9e96ed18fa50','Bagas Humanabiyu','UDINUS',1,'2025-06-14 09:21:18','2025-06-13 19:53:59','2025-06-14 09:21:18'),
('0197695a-ac9d-7121-ab68-5dbc15d71a2d','0197695a-9413-7206-a443-9e96ed18fa50','Angga Tri Pamungkas','UDINUS',1,'2025-06-14 08:37:06','2025-06-13 19:53:59','2025-06-14 08:37:06'),
('0197695a-ac9d-7121-ab68-5dbc16acfc70','0197695a-9413-7206-a443-9e96ed18fa50','Nauval Aqila Hanan Mufid','UDINUS',1,'2025-06-14 08:37:05','2025-06-13 19:53:59','2025-06-14 08:37:05'),
('0197695a-ac9e-72ba-895e-64b83f554b8b','0197695a-9413-7206-a443-9e96ed18fa50','Akhmad Faizal','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ac9e-72ba-895e-64b8404e1a60','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Fabian Rizky Fatah','UDINUS',1,'2025-06-14 08:06:55','2025-06-13 19:53:59','2025-06-14 08:06:55'),
('0197695a-ac9f-7203-a40b-50ad6cc7b775','0197695a-9413-7206-a443-9e96ed18fa50','Isra Shahzada Azwa Saqiba','UDINUS',1,'2025-06-14 07:51:50','2025-06-13 19:53:59','2025-06-14 07:51:50'),
('0197695a-ac9f-7203-a40b-50ad6d486939','0197695a-9413-7206-a443-9e96ed18fa50','Ravicenna Mahardhika','UDINUS',1,'2025-06-14 07:51:40','2025-06-13 19:53:59','2025-06-14 07:51:40'),
('0197695a-aca0-7218-9371-9e5a49a0cb9f','0197695a-9413-7206-a443-9e96ed18fa50','Della Sabrina','UDINUS',1,'2025-06-14 07:42:16','2025-06-13 19:53:59','2025-06-14 07:42:16'),
('0197695a-aca0-7218-9371-9e5a4a39dd25','0197695a-9413-7206-a443-9e96ed18fa50','Hafid Nur Azis','UDINUS',1,'2025-06-14 07:50:31','2025-06-13 19:53:59','2025-06-14 07:50:31'),
('0197695a-aca1-70c8-8ff7-965b227a6c93','0197695a-9413-7206-a443-9e96ed18fa50','Ferdy Hasan Mulya','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-aca1-70c8-8ff7-965b22947788','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Aulia Anhar','UDINUS',1,'2025-06-14 07:59:43','2025-06-13 19:53:59','2025-06-14 07:59:43'),
('0197695a-aca2-70f5-b011-ce27cac6f9c9','0197695a-9413-7206-a443-9e96ed18fa50','Vincentius Hari Kurniawan','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-aca2-70f5-b011-ce27cbba1bff','0197695a-9413-7206-a443-9e96ed18fa50','Ephesians Prismaranatha','UDINUS',1,'2025-06-14 09:12:15','2025-06-13 19:53:59','2025-06-14 09:12:15'),
('0197695a-aca3-731e-a89f-800d65082bc5','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Falah Altairgunna','UDINUS',1,'2025-06-14 07:51:34','2025-06-13 19:53:59','2025-06-14 07:51:34'),
('0197695a-aca3-731e-a89f-800d656aeb55','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Ibadullah','UDINUS',1,'2025-06-14 08:06:28','2025-06-13 19:53:59','2025-06-14 08:06:28'),
('0197695a-aca3-731e-a89f-800d658e2419','0197695a-9413-7206-a443-9e96ed18fa50','Harits Martsyabel Ristyan Jessy','UDINUS',1,'2025-06-14 08:16:42','2025-06-13 19:53:59','2025-06-14 08:16:42'),
('0197695a-aca4-73d1-853f-a7a802248074','0197695a-9413-7206-a443-9e96ed18fa50','Fahrial Septian Irviano','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-aca4-73d1-853f-a7a8022fee96','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Surya Aditya','UDINUS',1,'2025-06-14 08:44:02','2025-06-13 19:53:59','2025-06-14 08:44:02'),
('0197695a-aca5-738a-b9f0-17bfb88bef85','0197695a-9413-7206-a443-9e96ed18fa50','Wahyu Trilambang','UDINUS',1,'2025-06-14 09:22:28','2025-06-13 19:53:59','2025-06-14 09:22:28'),
('0197695a-aca5-738a-b9f0-17bfb96454f1','0197695a-9413-7206-a443-9e96ed18fa50','Hajar Surya Prasumba','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-aca6-71c3-8bfa-a2242c2062f5','0197695a-9413-7206-a443-9e96ed18fa50','Parani Wildhiyanaufaldi','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-aca6-71c3-8bfa-a2242cc99c82','0197695a-9413-7206-a443-9e96ed18fa50','Fawwaz Azhima Putra','UDINUS',1,'2025-06-14 08:48:01','2025-06-13 19:53:59','2025-06-14 08:48:01'),
('0197695a-aca7-73ec-82be-105738660c6f','0197695a-9413-7206-a443-9e96ed18fa50','Dimas Rizki Pratama','UDINUS',1,'2025-06-14 08:48:13','2025-06-13 19:53:59','2025-06-14 08:48:13'),
('0197695a-aca7-73ec-82be-1057393b4582','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Diva Irnanda','UDINUS',1,'2025-06-14 10:10:52','2025-06-13 19:53:59','2025-06-14 10:10:52'),
('0197695a-aca8-7305-8dde-c1c78417c072','0197695a-9413-7206-a443-9e96ed18fa50','Fauzan Arif Prayogi','UDINUS',1,'2025-06-14 08:47:54','2025-06-13 19:53:59','2025-06-14 08:47:54'),
('0197695a-aca8-7305-8dde-c1c7844af3aa','0197695a-9413-7206-a443-9e96ed18fa50','Iqbal Ika Rahmawan','UDINUS',1,'2025-06-14 08:48:12','2025-06-13 19:53:59','2025-06-14 08:48:12'),
('0197695a-aca9-7318-9459-ec9580312fcb','0197695a-9413-7206-a443-9e96ed18fa50','Arya Pratama Suriawibowo','UDINUS',1,'2025-06-14 08:48:07','2025-06-13 19:53:59','2025-06-14 08:48:07'),
('0197695a-aca9-7318-9459-ec9580e621e4','0197695a-9413-7206-a443-9e96ed18fa50','Ananda Putri','UDINUS',1,'2025-06-14 09:23:14','2025-06-13 19:53:59','2025-06-14 09:23:14'),
('0197695a-acaa-70cf-9ee1-436d1a06174d','0197695a-9413-7206-a443-9e96ed18fa50','Khafidha Sukma Dewi','UDINUS',1,'2025-06-14 08:14:22','2025-06-13 19:53:59','2025-06-14 08:14:22'),
('0197695a-acaa-70cf-9ee1-436d1a58661b','0197695a-9413-7206-a443-9e96ed18fa50','Albireo Musyaffa Finoe','UDINUS',1,'2025-06-14 09:24:30','2025-06-13 19:53:59','2025-06-14 09:24:30'),
('0197695a-acab-71dd-8bfd-135ac617e7bd','0197695a-9413-7206-a443-9e96ed18fa50','Ghulam Muhammaad','UDINUS',1,'2025-06-14 09:24:45','2025-06-13 19:53:59','2025-06-14 09:24:45'),
('0197695a-acab-71dd-8bfd-135ac6ef613b','0197695a-9413-7206-a443-9e96ed18fa50','Naufal Risqi Nurida','UDINUS',1,'2025-06-14 09:24:51','2025-06-13 19:53:59','2025-06-14 09:24:51'),
('0197695a-acab-71dd-8bfd-135ac7d4a9b7','0197695a-9413-7206-a443-9e96ed18fa50','Deni Kurniawan','UDINUS',1,'2025-06-14 07:59:14','2025-06-13 19:53:59','2025-06-14 07:59:14'),
('0197695a-acac-70cc-8786-6571e81172bf','0197695a-9413-7206-a443-9e96ed18fa50','Andika Apriyanto','UDINUS',1,'2025-06-14 08:14:51','2025-06-13 19:53:59','2025-06-14 08:14:51'),
('0197695a-acac-70cc-8786-6571e8af71a3','0197695a-9413-7206-a443-9e96ed18fa50','Hafizh Naufal Nuha Kusuma','UDINUS',1,'2025-06-14 08:14:48','2025-06-13 19:53:59','2025-06-14 08:14:48'),
('0197695a-acad-712a-9709-bf6f79e2256e','0197695a-9413-7206-a443-9e96ed18fa50','Yahya Kurnia Alamsyah','UDINUS',1,'2025-06-14 07:33:06','2025-06-13 19:53:59','2025-06-14 07:33:06'),
('0197695a-acad-712a-9709-bf6f7a473c7c','0197695a-9413-7206-a443-9e96ed18fa50','Agustina Diah Kusuma Dewi','UDINUS',1,'2025-06-14 08:41:40','2025-06-13 19:53:59','2025-06-14 08:41:40'),
('0197695a-acae-700a-b589-32fcf8ee82fd','0197695a-9413-7206-a443-9e96ed18fa50','WAHYU ALIF ADRIAS','UDINUS',1,'2025-06-14 08:06:04','2025-06-13 19:53:59','2025-06-14 08:06:04'),
('0197695a-acae-700a-b589-32fcf97f4a2f','0197695a-9413-7206-a443-9e96ed18fa50','Ibrahim Akbar Arga Dewangga','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acaf-734c-89bf-53e99187bb73','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Dwi Kuncoro','UDINUS',1,'2025-06-14 09:37:41','2025-06-13 19:53:59','2025-06-14 09:37:41'),
('0197695a-acaf-734c-89bf-53e991d7ca8b','0197695a-9413-7206-a443-9e96ed18fa50','Michael Novando Napitupulu','UDINUS',1,'2025-06-14 08:06:08','2025-06-13 19:53:59','2025-06-14 08:06:08'),
('0197695a-acb0-7322-b1c2-740f8412c5f0','0197695a-9413-7206-a443-9e96ed18fa50','Abito setyaji','UDINUS',1,'2025-06-14 07:50:32','2025-06-13 19:53:59','2025-06-14 07:50:32'),
('0197695a-acb0-7322-b1c2-740f85094d78','0197695a-9413-7206-a443-9e96ed18fa50','Shelomita Fitriyani','UDINUS',1,'2025-06-14 07:57:55','2025-06-13 19:53:59','2025-06-14 07:57:55'),
('0197695a-acb1-7280-8030-c73b7c5b5b86','0197695a-9413-7206-a443-9e96ed18fa50','Dani Yudanta Prapaskia','UDINUS',1,'2025-06-14 09:05:22','2025-06-13 19:53:59','2025-06-14 09:05:22'),
('0197695a-acb1-7280-8030-c73b7cca384d','0197695a-9413-7206-a443-9e96ed18fa50','Bima Sakti Khaharrasul','UDINUS',1,'2025-06-14 09:05:42','2025-06-13 19:53:59','2025-06-14 09:05:42'),
('0197695a-acb2-714e-8261-193b2f29f5e1','0197695a-9413-7206-a443-9e96ed18fa50','Jastin Fadillah Sitompul','UDINUS',1,'2025-06-14 09:05:46','2025-06-13 19:53:59','2025-06-14 09:05:46'),
('0197695a-acb2-714e-8261-193b2fbcba3c','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad bayu candra adi','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acb3-73d3-96c5-6040b5303f5b','0197695a-9413-7206-a443-9e96ed18fa50','Mahendra Setiawan','UDINUS',1,'2025-06-14 09:10:49','2025-06-13 19:53:59','2025-06-14 09:10:49'),
('0197695a-acb3-73d3-96c5-6040b55d76c3','0197695a-9413-7206-a443-9e96ed18fa50','Indra fias Prayoga','UDINUS',1,'2025-06-14 09:10:37','2025-06-13 19:53:59','2025-06-14 09:10:37'),
('0197695a-acb4-7348-a6c6-f758ffd843b2','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad naufal romadhanu','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acb4-7348-a6c6-f75900cb0a03','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Syihabuddin Musyaffa\'','UDINUS',1,'2025-06-14 09:22:11','2025-06-13 19:53:59','2025-06-14 09:22:11'),
('0197695a-acb5-7130-a6fb-a99eebb9df68','0197695a-9413-7206-a443-9e96ed18fa50','Erlanda Galant Prasetio','UDINUS',1,'2025-06-14 09:22:00','2025-06-13 19:53:59','2025-06-14 09:22:00'),
('0197695a-acb5-7130-a6fb-a99eec611b35','0197695a-9413-7206-a443-9e96ed18fa50','Mohammad Aviscena Zaidan','UDINUS',1,'2025-06-14 09:22:22','2025-06-13 19:53:59','2025-06-14 09:22:22'),
('0197695a-acb6-7127-8cdf-6b2fda9de551','0197695a-9413-7206-a443-9e96ed18fa50','ihda nur maulidia hanum (A11.2023.15394)','UDINUS',1,'2025-06-14 09:07:05','2025-06-13 19:53:59','2025-06-14 09:07:05'),
('0197695a-acb6-7127-8cdf-6b2fdb076665','0197695a-9413-7206-a443-9e96ed18fa50','Masayu Octa Faradisa (A11.2023.15374)','UDINUS',1,'2025-06-14 09:07:14','2025-06-13 19:53:59','2025-06-14 09:07:14'),
('0197695a-acb6-7127-8cdf-6b2fdbd215bc','0197695a-9413-7206-a443-9e96ed18fa50','Claresta nalla satwika (A11.2023.15365)','UDINUS',1,'2025-06-14 09:05:48','2025-06-13 19:53:59','2025-06-14 09:05:48'),
('0197695a-acb7-7297-8a14-4d9704033b02','0197695a-9413-7206-a443-9e96ed18fa50','MUHAMMAD ARIEF HIDAYATULLAH','UDINUS',1,'2025-06-14 08:32:26','2025-06-13 19:53:59','2025-06-14 08:32:26'),
('0197695a-acba-710f-a9f4-17518ae505dd','0197695a-9413-7206-a443-9e96ed18fa50','Azzam Izzuddin','UDINUS',1,'2025-06-14 08:43:26','2025-06-13 19:53:59','2025-06-14 08:43:26'),
('0197695a-acba-710f-a9f4-17518b210737','0197695a-9413-7206-a443-9e96ed18fa50','Suluh Yoga Pratama','UDINUS',1,'2025-06-14 08:43:16','2025-06-13 19:53:59','2025-06-14 08:43:16'),
('0197695a-acbb-7300-a0bd-1a8302849ba7','0197695a-9413-7206-a443-9e96ed18fa50','Ariawan Soffan Farajaya','UDINUS',1,'2025-06-14 11:37:51','2025-06-13 19:53:59','2025-06-14 11:37:51'),
('0197695a-acbb-7300-a0bd-1a83030093ce','0197695a-9413-7206-a443-9e96ed18fa50','Mellynda Noor Romadhoni','UDINUS',1,'2025-06-14 07:42:07','2025-06-13 19:53:59','2025-06-14 07:42:07'),
('0197695a-acbc-7369-9a3b-ea14231e7320','0197695a-9413-7206-a443-9e96ed18fa50','Eka Wahyu Utami','UDINUS',1,'2025-06-14 07:42:24','2025-06-13 19:53:59','2025-06-14 07:42:24'),
('0197695a-acbc-7369-9a3b-ea14232fb266','0197695a-9413-7206-a443-9e96ed18fa50','Nur Aqliah Ilmi','UDINUS',1,'2025-06-14 07:42:19','2025-06-13 19:53:59','2025-06-14 07:42:19'),
('0197695a-acbd-7370-8156-94563e926021','0197695a-9413-7206-a443-9e96ed18fa50','Gatot Ifal Falaah Waskitha','UDINUS',1,'2025-06-14 08:05:42','2025-06-13 19:53:59','2025-06-14 08:05:42'),
('0197695a-acbd-7370-8156-94563f4c4e2c','0197695a-9413-7206-a443-9e96ed18fa50','Firnanda Rahmawati','UDINUS',1,'2025-06-14 09:07:16','2025-06-13 19:53:59','2025-06-14 09:07:16'),
('0197695a-acbe-7087-a668-849f6eb1eaa5','0197695a-9413-7206-a443-9e96ed18fa50','Najwa Kaila Nuraisyah','UDINUS',1,'2025-06-14 09:07:25','2025-06-13 19:53:59','2025-06-14 09:07:25'),
('0197695a-acbe-7087-a668-849f6f2e22ab','0197695a-9413-7206-a443-9e96ed18fa50','Virgina Staraina','UDINUS',1,'2025-06-14 09:06:02','2025-06-13 19:53:59','2025-06-14 09:06:02'),
('0197695a-acbf-7121-b3c1-8edf1e268651','0197695a-9413-7206-a443-9e96ed18fa50','DIMAS RIZQI PRATAMA','UDINUS',1,'2025-06-14 08:03:46','2025-06-13 19:53:59','2025-06-14 08:03:46'),
('0197695a-acbf-7121-b3c1-8edf1ef9758b','0197695a-9413-7206-a443-9e96ed18fa50','Novriansyah Afqi Nur Akmal Fauzi','UDINUS',1,'2025-06-14 08:04:09','2025-06-13 19:53:59','2025-06-14 08:04:09'),
('0197695a-acc0-726e-88d1-5945e21128cd','0197695a-9413-7206-a443-9e96ed18fa50','Angga Guardi Zunus Saputra','UDINUS',1,'2025-06-14 08:03:50','2025-06-13 19:53:59','2025-06-14 08:03:50'),
('0197695a-acc0-726e-88d1-5945e30cd6c8','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Noor Fandhilah','UDINUS',1,'2025-06-14 08:04:55','2025-06-13 19:53:59','2025-06-14 08:04:55'),
('0197695a-acc1-735b-b1fe-e35a50969e53','0197695a-9413-7206-a443-9e96ed18fa50','Ricky Primayuda Putra','UDINUS',1,'2025-06-14 09:05:11','2025-06-13 19:53:59','2025-06-14 09:05:11'),
('0197695a-acc1-735b-b1fe-e35a518588ea','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Rizky Ramadhan','UDINUS',1,'2025-06-14 09:04:39','2025-06-13 19:53:59','2025-06-14 09:04:39'),
('0197695a-acc1-735b-b1fe-e35a523ceae5','0197695a-9413-7206-a443-9e96ed18fa50','Naufal Naba\'ul Choir','UDINUS',1,'2025-06-14 09:05:18','2025-06-13 19:53:59','2025-06-14 09:05:18'),
('0197695a-acc2-7352-b993-065c6f9c9d71','0197695a-9413-7206-a443-9e96ed18fa50','AKHMADI','UDINUS',1,'2025-06-14 08:04:02','2025-06-13 19:53:59','2025-06-14 08:04:02'),
('0197695a-acc2-7352-b993-065c70095d18','0197695a-9413-7206-a443-9e96ed18fa50','1 Orang','UDINUS',1,'2025-06-13 20:53:18','2025-06-13 19:53:59','2025-06-13 20:53:18'),
('0197695a-acc3-73c5-995f-8109acc21f01','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Bagus Aditya','UDINUS',1,'2025-06-14 07:39:41','2025-06-13 19:53:59','2025-06-14 07:39:41'),
('0197695a-acc3-73c5-995f-8109acedeafd','0197695a-9413-7206-a443-9e96ed18fa50','Awaludin Gymnastiar','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acc4-70ab-ac4a-b121f0d0415e','0197695a-9413-7206-a443-9e96ed18fa50','Gerardo pranoto','UDINUS',1,'2025-06-14 09:25:46','2025-06-13 19:53:59','2025-06-14 09:25:46'),
('0197695a-acc4-70ab-ac4a-b121f1c93497','0197695a-9413-7206-a443-9e96ed18fa50','Steven Oscar Dharmasetiana','UDINUS',1,'2025-06-14 09:25:40','2025-06-13 19:53:59','2025-06-14 09:25:40'),
('0197695a-acc5-705b-ba1f-ce30088b436c','0197695a-9413-7206-a443-9e96ed18fa50','Mohammad Tsaqif Akmal Al-Hammam','UDINUS',1,'2025-06-14 09:23:43','2025-06-13 19:53:59','2025-06-14 09:23:43'),
('0197695a-acc5-705b-ba1f-ce300908b714','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Imam Rafi\'','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acc6-707c-b484-8e26c4002987','0197695a-9413-7206-a443-9e96ed18fa50','Suryanto','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acc6-707c-b484-8e26c4e6b58d','0197695a-9413-7206-a443-9e96ed18fa50','Suryanti','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acc7-7165-95fe-f73a70af83cd','0197695a-9413-7206-a443-9e96ed18fa50','Suryani','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acc7-7165-95fe-f73a70ca92d1','0197695a-9413-7206-a443-9e96ed18fa50','dropdown','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acc8-703c-9982-6eabcb8a317a','0197695a-9413-7206-a443-9e96ed18fa50','Huga Hazimulfikri Nawawi','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acc8-703c-9982-6eabcc52f3fa','0197695a-9413-7206-a443-9e96ed18fa50','Fa’idzaa Fi Ibaad','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acc9-7304-8887-463fa4a9d88d','0197695a-9413-7206-a443-9e96ed18fa50','Mohammad Rizky Reza Pahlevi','UDINUS',1,'2025-06-14 09:25:59','2025-06-13 19:53:59','2025-06-14 09:25:59'),
('0197695a-acc9-7304-8887-463fa4b2ea56','0197695a-9413-7206-a443-9e96ed18fa50','Ulya Layyina','UDINUS',1,'2025-06-14 08:46:06','2025-06-13 19:53:59','2025-06-14 08:46:06'),
('0197695a-acca-7159-9cc4-c2e785d9a1c8','0197695a-9413-7206-a443-9e96ed18fa50','Fariida Qurrota \'Aini','UDINUS',1,'2025-06-14 08:57:58','2025-06-13 19:53:59','2025-06-14 08:57:58'),
('0197695a-acca-7159-9cc4-c2e786928782','0197695a-9413-7206-a443-9e96ed18fa50','Pramitha Witawacita Astadewi','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acca-7159-9cc4-c2e786c984f5','0197695a-9413-7206-a443-9e96ed18fa50','VIBRA LINTAS ERANEO','UDINUS',1,'2025-06-14 09:32:40','2025-06-13 19:53:59','2025-06-14 09:32:40'),
('0197695a-accb-7050-9aac-3af5175e2adf','0197695a-9413-7206-a443-9e96ed18fa50','DADY BIMA NUR SEJATI','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-accb-7050-9aac-3af517b0af5d','0197695a-9413-7206-a443-9e96ed18fa50','HAFIIDH AKBAR SYA\'BANI','UDINUS',1,'2025-06-14 08:52:40','2025-06-13 19:53:59','2025-06-14 08:52:40'),
('0197695a-accc-716f-a646-a30873645fa2','0197695a-9413-7206-a443-9e96ed18fa50','Tsania Camila Finnisa','UDINUS',1,'2025-06-14 07:52:12','2025-06-13 19:53:59','2025-06-14 07:52:12'),
('0197695a-accc-716f-a646-a30873f0b164','0197695a-9413-7206-a443-9e96ed18fa50','Wanda Yuniar','UDINUS',1,'2025-06-14 07:52:12','2025-06-13 19:53:59','2025-06-14 07:52:12'),
('0197695a-accd-7165-bb21-246a11a32e5c','0197695a-9413-7206-a443-9e96ed18fa50','Nadia Aulia Astrianingrum','UDINUS',1,'2025-06-14 07:52:26','2025-06-13 19:53:59','2025-06-14 07:52:26'),
('0197695a-accd-7165-bb21-246a11bd8782','0197695a-9413-7206-a443-9e96ed18fa50','Brenendra Putra Oktaviansyah','UDINUS',1,'2025-06-14 09:43:22','2025-06-13 19:53:59','2025-06-14 09:43:22'),
('0197695a-acce-725e-a611-ab0e784fb1f8','0197695a-9413-7206-a443-9e96ed18fa50','Nada Tiyasa Salsabela','UDINUS',1,'2025-06-14 07:52:26','2025-06-13 19:53:59','2025-06-14 07:52:26'),
('0197695a-acce-725e-a611-ab0e7884ba02','0197695a-9413-7206-a443-9e96ed18fa50','Bhima Pradita Hidayat','UDINUS',1,'2025-06-14 08:16:58','2025-06-13 19:53:59','2025-06-14 08:16:58'),
('0197695a-accf-719d-9e55-8968756b4473','0197695a-9413-7206-a443-9e96ed18fa50','Ilham Adi Nugroho','UDINUS',1,'2025-06-14 08:16:54','2025-06-13 19:53:59','2025-06-14 08:16:54'),
('0197695a-accf-719d-9e55-8968758f02d6','0197695a-9413-7206-a443-9e96ed18fa50','Pahlevi Cendikia Muslim','UDINUS',1,'2025-06-14 08:17:04','2025-06-13 19:53:59','2025-06-14 08:17:04'),
('0197695a-acd0-705b-a840-69f48667e8a7','0197695a-9413-7206-a443-9e96ed18fa50','eko kurnia pradika','UMUM',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acd0-705b-a840-69f486c91ff1','0197695a-9413-7206-a443-9e96ed18fa50','Fadil Septian Sasandi','UDINUS',1,'2025-06-14 07:36:21','2025-06-13 19:53:59','2025-06-14 07:36:21'),
('0197695a-acd1-7074-bb4f-2d10050fc66a','0197695a-9413-7206-a443-9e96ed18fa50','Ade duta pramana','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acd1-7074-bb4f-2d100538ef6b','0197695a-9413-7206-a443-9e96ed18fa50','Ryandika sauqi Ramadani','UDINUS',1,'2025-06-14 07:33:21','2025-06-13 19:53:59','2025-06-14 07:33:21'),
('0197695a-acd2-7267-8ec6-fbe4fa06cf75','0197695a-9413-7206-a443-9e96ed18fa50','Abdul khalim','UDINUS',1,'2025-06-14 08:45:32','2025-06-13 19:53:59','2025-06-14 08:45:32'),
('0197695a-acd2-7267-8ec6-fbe4fa58e4c3','0197695a-9413-7206-a443-9e96ed18fa50','Syahrul Naufal Tsaqib','UMUM',1,'2025-06-14 08:40:18','2025-06-13 19:53:59','2025-06-14 08:40:18'),
('0197695a-acd3-73fc-bbf0-25681c8eb822','0197695a-9413-7206-a443-9e96ed18fa50','Zaki Ashfa Ashfiya','UMUM',1,'2025-06-14 08:40:33','2025-06-13 19:53:59','2025-06-14 08:40:33'),
('0197695a-acd3-73fc-bbf0-25681cf19588','0197695a-9413-7206-a443-9e96ed18fa50','Husain Fadllullah','UMUM',1,'2025-06-14 08:40:27','2025-06-13 19:53:59','2025-06-14 08:40:27'),
('0197695a-acd4-7252-b3d3-3fd4c2c4246e','0197695a-9413-7206-a443-9e96ed18fa50','Benaya Friyandi Siahaan','UDINUS',1,'2025-06-14 07:36:51','2025-06-13 19:53:59','2025-06-14 07:36:51'),
('0197695a-acd4-7252-b3d3-3fd4c3448584','0197695a-9413-7206-a443-9e96ed18fa50','Dina Hapsari','UMUM',1,'2025-06-14 07:50:45','2025-06-13 19:53:59','2025-06-14 07:50:45'),
('0197695a-acd4-7252-b3d3-3fd4c3a1b905','0197695a-9413-7206-a443-9e96ed18fa50','M Kelik Firmansyah','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acd5-7388-b13c-f615b92d8499','0197695a-9413-7206-a443-9e96ed18fa50','Ryan Nova Syahida','UDINUS',1,'2025-06-14 08:10:23','2025-06-13 19:53:59','2025-06-14 08:10:23'),
('0197695a-acd8-72c5-97a2-bc75f4b3dfe9','0197695a-9413-7206-a443-9e96ed18fa50','Pasha aditya dhananjaya','UDINUS',1,'2025-06-14 10:22:28','2025-06-13 19:53:59','2025-06-14 10:22:28'),
('0197695a-acd8-72c5-97a2-bc75f4d8d451','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Zuhdy Adly','UDINUS',1,'2025-06-14 10:35:33','2025-06-13 19:53:59','2025-06-14 10:35:33'),
('0197695a-acd9-711b-9933-73b5f99b4a24','0197695a-9413-7206-a443-9e96ed18fa50','Helena Hapsari Nugroho','UDINUS',1,'2025-06-14 09:11:10','2025-06-13 19:53:59','2025-06-14 09:11:10'),
('0197695a-acd9-711b-9933-73b5fa706cf5','0197695a-9413-7206-a443-9e96ed18fa50','Suci Ayu Veronica','UDINUS',1,'2025-06-14 09:11:26','2025-06-13 19:53:59','2025-06-14 09:11:26'),
('0197695a-acda-7177-a52f-dda6c612c810','0197695a-9413-7206-a443-9e96ed18fa50','Kamilah Falah Syifa','UDINUS',1,'2025-06-14 09:11:17','2025-06-13 19:53:59','2025-06-14 09:11:17'),
('0197695a-acda-7177-a52f-dda6c6188263','0197695a-9413-7206-a443-9e96ed18fa50','Fauzan Habib Assidiq','UMUM',1,'2025-06-14 08:12:59','2025-06-13 19:53:59','2025-06-14 08:12:59'),
('0197695a-acdb-7257-8a30-927d51bc99f5','0197695a-9413-7206-a443-9e96ed18fa50','Alfi Hidayat','UMUM',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-acdb-7257-8a30-927d52173067','0197695a-9413-7206-a443-9e96ed18fa50','Much Panji Laksono','UDINUS',1,'2025-06-14 08:25:11','2025-06-13 19:53:59','2025-06-14 08:25:11'),
('0197695a-acdc-701c-9d3d-522e6ae180a1','0197695a-9413-7206-a443-9e96ed18fa50','Septada Alvian Rasyid','UDINUS',1,'2025-06-14 08:25:11','2025-06-13 19:53:59','2025-06-14 08:25:11'),
('0197695a-acdc-701c-9d3d-522e6bbc0350','0197695a-9413-7206-a443-9e96ed18fa50','Ananta Surya Pratama','UDINUS',1,'2025-06-14 08:47:53','2025-06-13 19:53:59','2025-06-14 08:47:53'),
('0197695a-acdd-70ed-ac1b-35fee1b2c968','0197695a-9413-7206-a443-9e96ed18fa50','Dhimas Priscila Ramadhan','UMUM',1,'2025-06-14 08:13:10','2025-06-13 19:53:59','2025-06-14 08:13:10'),
('0197695a-acdd-70ed-ac1b-35fee277d948','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Malikus Shaleh','UMUM',1,'2025-06-14 08:13:01','2025-06-13 19:53:59','2025-06-14 08:13:01'),
('0197695a-acdd-70ed-ac1b-35fee2fe5388','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Rheno Nabil farohi','UDINUS',1,'2025-06-14 07:40:05','2025-06-13 19:53:59','2025-06-14 07:40:05'),
('0197695a-acde-719f-b271-c79abcf66c9c','0197695a-9413-7206-a443-9e96ed18fa50','Alif noor rohman','UDINUS',1,'2025-06-14 08:08:46','2025-06-13 19:53:59','2025-06-14 08:08:46'),
('0197695a-acde-719f-b271-c79abd6219d6','0197695a-9413-7206-a443-9e96ed18fa50','Ficky alfriza Ardiputra','UDINUS',1,'2025-06-14 07:40:16','2025-06-13 19:53:59','2025-06-14 07:40:16'),
('0197695a-acdf-733c-83cc-2f003b958e48','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Imaduddin Abdurrohim','UDINUS',1,'2025-06-14 09:12:56','2025-06-13 19:53:59','2025-06-14 09:12:56'),
('0197695a-acdf-733c-83cc-2f003c74d09d','0197695a-9413-7206-a443-9e96ed18fa50','Ghevary Pappo Suprapto','UDINUS',1,'2025-06-14 08:31:11','2025-06-13 19:53:59','2025-06-14 08:31:11'),
('0197695a-ace0-732d-8df0-78db2c6f4ce8','0197695a-9413-7206-a443-9e96ed18fa50','Ghivary Pappo Suprapto','UDINUS',1,'2025-06-14 08:31:21','2025-06-13 19:53:59','2025-06-14 08:31:21'),
('0197695a-ace0-732d-8df0-78db2cac330d','0197695a-9413-7206-a443-9e96ed18fa50','Arya Febi Prasetyawan','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ace1-7141-99a1-ab1081e3ad5e','0197695a-9413-7206-a443-9e96ed18fa50','Arya febi Prasetyawan','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ace1-7141-99a1-ab1082368aec','0197695a-9413-7206-a443-9e96ed18fa50','Arya febi Prasetyawan','UDINUS',1,'2025-06-14 07:43:34','2025-06-13 19:53:59','2025-06-14 07:43:34'),
('0197695a-ace2-721c-bc9a-80e6ad4d8ac1','0197695a-9413-7206-a443-9e96ed18fa50','Rizka Dian Safitri','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ace2-721c-bc9a-80e6adf2abe2','0197695a-9413-7206-a443-9e96ed18fa50','M. Aqil Bintang Pradana','UDINUS',1,'2025-06-14 09:17:49','2025-06-13 19:53:59','2025-06-14 09:17:49'),
('0197695a-ace3-708a-971d-80916ec861ee','0197695a-9413-7206-a443-9e96ed18fa50','Sifa Fissabillih','UDINUS',1,'2025-06-14 08:53:32','2025-06-13 19:53:59','2025-06-14 08:53:32'),
('0197695a-ace3-708a-971d-80916f29f4e4','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Babassamasi','UDINUS',1,'2025-06-14 08:40:04','2025-06-13 19:53:59','2025-06-14 08:40:04'),
('0197695a-ace4-71d6-a09f-479635a22195','0197695a-9413-7206-a443-9e96ed18fa50','Nabilla Zahra Diyas','UDINUS',1,'2025-06-14 08:30:42','2025-06-13 19:53:59','2025-06-14 08:30:42'),
('0197695a-ace4-71d6-a09f-479635e6bdbd','0197695a-9413-7206-a443-9e96ed18fa50','Ah','UMUM',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ace5-7246-84f4-ba9714ec8008','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad Arkan Yumna','UDINUS',1,'2025-06-14 08:53:48','2025-06-13 19:53:59','2025-06-14 08:53:48'),
('0197695a-ace5-7246-84f4-ba9715425716','0197695a-9413-7206-a443-9e96ed18fa50','mohammad zufar faiz','UDINUS',1,'2025-06-14 08:53:06','2025-06-13 19:53:59','2025-06-14 08:53:06'),
('0197695a-ace6-7061-9faf-89496df3aa10','0197695a-9413-7206-a443-9e96ed18fa50','Shafa Naila Kamal','UDINUS',1,'2025-06-14 07:36:27','2025-06-13 19:53:59','2025-06-14 07:36:27'),
('0197695a-ace8-73c9-90ff-f51ffc6195f2','0197695a-9413-7206-a443-9e96ed18fa50','Fadhil Riyanto','UDINUS',0,NULL,'2025-06-13 19:53:59','2025-06-13 19:53:59'),
('0197695a-ace9-7346-afdb-63ac2bb5814d','0197695a-9413-7206-a443-9e96ed18fa50','Sapto Gusty Humam Al Farisi','UDINUS',1,'2025-06-14 07:37:03','2025-06-13 19:53:59','2025-06-14 07:37:03'),
('0197695a-ace9-7346-afdb-63ac2c8d4aca','0197695a-9413-7206-a443-9e96ed18fa50','Inas Salwa Nuraini','UDINUS',1,'2025-06-14 09:16:20','2025-06-13 19:53:59','2025-06-14 09:16:20'),
('0197695a-acea-72cf-94cb-4aadd5477054','0197695a-9413-7206-a443-9e96ed18fa50','Adib Aunur Rohim','UMUM',1,'2025-06-14 08:40:05','2025-06-13 19:53:59','2025-06-14 08:40:05'),
('0197695a-acea-72cf-94cb-4aadd57d7b01','0197695a-9413-7206-a443-9e96ed18fa50','Faza Althaf Naufal Rafif','UDINUS',1,'2025-06-14 08:14:08','2025-06-13 19:53:59','2025-06-14 08:14:08'),
('0197695a-aceb-7378-bb17-b3305838e1bf','0197695a-9413-7206-a443-9e96ed18fa50','Adhitya Wisnu Priambadha','UDINUS',1,'2025-06-14 08:14:00','2025-06-13 19:53:59','2025-06-14 08:14:00'),
('0197695a-aceb-7378-bb17-b330589bb470','0197695a-9413-7206-a443-9e96ed18fa50','Abil Fajri Musfiyono','UMUM',1,'2025-06-14 08:48:23','2025-06-13 19:53:59','2025-06-14 08:48:23'),
('0197695a-acec-7260-9856-9b235c5a7c9c','0197695a-9413-7206-a443-9e96ed18fa50','Zulfa Sowam','UMUM',1,'2025-06-14 08:48:21','2025-06-13 19:53:59','2025-06-14 08:48:21'),
('0197695a-acec-7260-9856-9b235d08192f','0197695a-9413-7206-a443-9e96ed18fa50','Muhammad labib Bu','UDINUS',1,'2025-06-14 08:31:27','2025-06-13 19:53:59','2025-06-14 08:31:27'),
('0197695a-acec-7260-9856-9b235dddf026','0197695a-9413-7206-a443-9e96ed18fa50','Aurelia Putri Salsabila Sanusi','UDINUS',1,'2025-06-14 09:35:08','2025-06-13 19:53:59','2025-06-14 09:35:08'),
('0197695a-aced-71ee-9912-8bd6a6ad70f1','0197695a-9413-7206-a443-9e96ed18fa50','Marshanda Salsabila Sanusi','UDINUS',1,'2025-06-14 08:01:25','2025-06-13 19:53:59','2025-06-14 08:01:25'),
('0197695a-aced-71ee-9912-8bd6a74f8ce3','0197695a-9413-7206-a443-9e96ed18fa50','Widia Anggela','UDINUS',1,'2025-06-14 08:01:40','2025-06-13 19:53:59','2025-06-14 08:01:40');
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('3mw1QxUdoeLD7ieSTclXYxxeiM4YQnefDfCIbamI',1,'103.246.107.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSjBjSGhzamlOOEdXak9BZDVIVFN6bmJXajk5YTQyQktUeXlPb1JXQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmcvYWRtaW4vc2NhbnFyLzAxOTc2OTVhLTk0MTMtNzIwNi1hNDQzLTllOTZlZDE4ZmE1MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDE6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmcvYWRtaW4vZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1749876228),
('5P5xQcKxWLNsRaCLMA1mVkLKEfcfkCJ0QH9q4mUx',NULL,'178.128.18.34','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15','YTozOntzOjY6Il90b2tlbiI7czo0MDoidEdmYkxmdDZSY2k5VWZJdWdGd0pBUWl6N3MxREVBN01zZ0VMZ0xzYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1749886379),
('98LWtQg2YYMrjxdNDcrYaOUGQTQPe13HTvgyQIbi',1,'103.246.107.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoidFZ1b0ZHOFh0a0J1RUFZWWNDQ2tzRnhQMjBoRjFoRFpTalZURXltNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmcvYWRtaW4vZXZlbnRzLzAxOTc2OTVhLTk0MTMtNzIwNi1hNDQzLTllOTZlZDE4ZmE1MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDE6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmcvYWRtaW4vZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1749880961),
('CoQTSix9gRosdx7ggoAA6y5mTL1mdPNxlekCmYSC',1,'103.246.107.2','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU1huOTY4c0lYUWRhOTlER1JMdGxFQkhGMjBCVlhPcXFISnlNS3pTSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmcvYWRtaW4vZXZlbnRzLzAxOTc2OTVhLTk0MTMtNzIwNi1hNDQzLTllOTZlZDE4ZmE1MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDE6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmcvYWRtaW4vZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1749882198),
('jzJaYIZgzLSqH52974YbeNEl8VqKNfkrjwxyOCr8',NULL,'35.87.152.20','Mozilla/5.0 (iPhone; CPU iPhone OS 14_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.4 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0lSYjl1STFHS1FoeXg3dEV3ZVJqZ2c0TkpITGhnb1o3QVJYaDlwVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1749875570),
('plwAmvaAUGZ03WZePhrAG3iDDm7GRypEBMcwO8CM',NULL,'103.246.107.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGJTUjJ5SUNsN0VKTHB4UFFrWWNQOUFZMlBOajFjQnJ2dFVtUXE5dyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmcvYWJvdXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1749883672),
('xZhnRrSIsHmdZvwaRVrNdH3OUEDVtY1EqRRqleUa',NULL,'114.10.126.23','Mozilla/5.0 (iPhone; CPU iPhone OS 18_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.4 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTBWUlJWOUc1TUcxanZieW1uSFVLWUJGV1FYMDltYld0Y2ZNNFNZQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmcvYWRtaW4vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1749886669),
('zDDog4VD2VxYOCSBYJQoSXZ8FNUN1Ee5lJGmrcw3',NULL,'35.87.152.20','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.19582','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlBCNWUxazM3enplZXRQRXVZTElpUEROUHJCVEpGYWpJcmdnS3FlYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZC1mb3JtLmRvc2NvbS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1749875562);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Super Admin','admin@mail.com','2025-06-13 19:52:36','$2y$12$FGbvxWLdZt0MbhD/uMwVzeJo0.EatAgZIpcQRApy9aVIfOkQ2CTyW','hJFP5GppSzvB8O3BNwpUfev4w8lOUGrncjWdSUxWzFgTncQXDv2MHjmKauLQ','2025-06-13 19:52:37','2025-06-13 19:52:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-14  9:14:01
