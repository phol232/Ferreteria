-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: ferreteria
-- ------------------------------------------------------
-- Server version	8.0.44

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombreCliente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidosCliente` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dniCliente` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccionCliente` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonoCliente` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correoCliente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Britney','Torres','75653211','El tambo huancayo','965874213','btorres@estado.com','2025-11-07 21:45:02','2025-11-07 21:45:02'),(2,'Diego','Tovar','75362844','Sicaya - Huancayo','985674321','diego@gmail.com','2025-11-07 22:18:40','2025-11-07 22:18:40'),(3,'Lisseth','Cochachi Sanabria','65325222','San Pedro de Cajas\nHuancayo \nConstruccion','965328741','lisseth@gmail.com','2025-11-07 22:20:41','2025-11-07 22:20:41'),(4,'Julio','Madrid Orozco','65324711','Huancayo - Chilca','965874221','jmadrid@mpc.pe','2025-11-07 23:09:41','2025-11-07 23:09:41'),(5,'Pedro','Perez Huaman','52336655','Huancayo Ciudad Universitaria','966665544','pperez@gmail.com','2025-11-08 00:06:17','2025-11-08 00:06:17'),(6,'Sonia','Mamani Quispe','66688554','San Carlos\n200','955887743','sonia@gmail.com','2025-11-08 00:06:57','2025-11-08 00:06:57');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_movimientos`
--

DROP TABLE IF EXISTS `detalle_movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_movimientos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idMovimiento` bigint unsigned NOT NULL,
  `codigoProducto` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreProducto` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcionProducto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int NOT NULL,
  `costoProducto` double NOT NULL,
  `gananciaProducto` double NOT NULL,
  `precioProducto` double NOT NULL,
  `imageProducto` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_movimientos_idmovimiento_foreign` (`idMovimiento`),
  CONSTRAINT `detalle_movimientos_idmovimiento_foreign` FOREIGN KEY (`idMovimiento`) REFERENCES `movimientos_inventario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_movimientos`
--

LOCK TABLES `detalle_movimientos` WRITE;
/*!40000 ALTER TABLE `detalle_movimientos` DISABLE KEYS */;
INSERT INTO `detalle_movimientos` VALUES (4,4,'001','Cemento Sol 42.5kg','Saco de cemento Portland',50,22.5,7.5,30,'https://example.com/images/cemento_sol.jpg','2025-11-08 03:07:29','2025-11-08 03:07:29'),(5,4,'002','Arena fina m³','Arena para construcción',10,35,10,45,'https://example.com/images/arena_fina.jpg','2025-11-08 03:07:29','2025-11-08 03:07:29');
/*!40000 ALTER TABLE `detalle_movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalleventas`
--

DROP TABLE IF EXISTS `detalleventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalleventas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idVenta` bigint unsigned NOT NULL,
  `idProducto` bigint unsigned NOT NULL,
  `cantidadDetalleVenta` bigint NOT NULL,
  `subtotalDetalleVenta` double NOT NULL,
  `totalDetalleVenta` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalleventas_idventa_foreign` (`idVenta`),
  KEY `detalleventas_idproducto_foreign` (`idProducto`),
  CONSTRAINT `detalleventas_idproducto_foreign` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`),
  CONSTRAINT `detalleventas_idventa_foreign` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleventas`
--

LOCK TABLES `detalleventas` WRITE;
/*!40000 ALTER TABLE `detalleventas` DISABLE KEYS */;
INSERT INTO `detalleventas` VALUES (3,2,1,1,35,35,'2025-11-07 21:57:10','2025-11-07 21:57:10'),(4,2,6,1,15,15,'2025-11-07 21:57:10','2025-11-07 21:57:10'),(5,3,1,2,70,70,'2025-11-07 23:20:51','2025-11-07 23:20:51'),(6,4,4,3,66,66,'2025-11-07 23:21:05','2025-11-07 23:21:05'),(7,4,5,1,18,18,'2025-11-07 23:21:05','2025-11-07 23:21:05'),(8,5,2,2,1500,1500,'2025-11-07 23:21:11','2025-11-07 23:21:11'),(9,5,3,1,110,110,'2025-11-07 23:21:11','2025-11-07 23:21:11'),(10,6,4,1,22,22,'2025-11-07 23:21:22','2025-11-07 23:21:22'),(11,7,4,1,22,22,'2025-11-07 23:21:29','2025-11-07 23:21:29'),(12,8,4,4,88,88,'2025-11-07 23:21:41','2025-11-07 23:21:41'),(13,9,9,1,25,25,'2025-11-07 23:22:19','2025-11-07 23:22:19'),(14,9,12,1,17,17,'2025-11-07 23:22:19','2025-11-07 23:22:19'),(15,9,11,1,30,30,'2025-11-07 23:22:19','2025-11-07 23:22:19'),(16,10,19,1,10,10,'2025-11-07 23:22:29','2025-11-07 23:22:29'),(17,10,20,4,88,88,'2025-11-07 23:22:29','2025-11-07 23:22:29'),(18,11,16,2,44,44,'2025-11-07 23:22:46','2025-11-07 23:22:46'),(19,11,17,1,20,20,'2025-11-07 23:22:46','2025-11-07 23:22:46'),(20,12,20,3,66,66,'2025-11-07 23:22:55','2025-11-07 23:22:55'),(21,12,21,3,90,90,'2025-11-07 23:22:55','2025-11-07 23:22:55'),(22,13,26,2,370,370,'2025-11-07 23:23:02','2025-11-07 23:23:02'),(23,13,27,2,420,420,'2025-11-07 23:23:02','2025-11-07 23:23:02'),(24,14,28,2,380,380,'2025-11-07 23:23:09','2025-11-07 23:23:09'),(25,14,29,1,400,400,'2025-11-07 23:23:09','2025-11-07 23:23:09'),(26,15,32,2,590,590,'2025-11-07 23:23:19','2025-11-07 23:23:19'),(27,15,31,1,28,28,'2025-11-07 23:23:19','2025-11-07 23:23:19'),(28,16,4,2,44,44,'2025-11-07 23:23:35','2025-11-07 23:23:35'),(29,16,5,1,18,18,'2025-11-07 23:23:35','2025-11-07 23:23:35'),(30,17,4,2,44,44,'2025-11-07 23:26:15','2025-11-07 23:26:15'),(31,17,5,1,18,18,'2025-11-07 23:26:15','2025-11-07 23:26:15'),(32,18,9,2,50,50,'2025-11-07 23:26:24','2025-11-07 23:26:24'),(33,19,7,2,120,120,'2025-11-07 23:26:28','2025-11-07 23:26:28'),(34,20,10,2,56,56,'2025-11-07 23:26:34','2025-11-07 23:26:34'),(35,20,11,1,30,30,'2025-11-07 23:26:34','2025-11-07 23:26:34'),(36,21,15,2,42,42,'2025-11-07 23:26:41','2025-11-07 23:26:41'),(37,21,14,1,34,34,'2025-11-07 23:26:41','2025-11-07 23:26:41'),(38,22,16,1,22,22,'2025-11-07 23:26:49','2025-11-07 23:26:49'),(39,23,16,1,22,22,'2025-11-07 23:27:15','2025-11-07 23:27:15'),(40,23,17,1,20,20,'2025-11-07 23:27:15','2025-11-07 23:27:15'),(41,24,20,2,44,44,'2025-11-07 23:27:53','2025-11-07 23:27:53'),(42,25,23,2,132,132,'2025-11-07 23:28:02','2025-11-07 23:28:02'),(43,25,22,1,41,41,'2025-11-07 23:28:02','2025-11-07 23:28:02'),(44,26,22,1,41,41,'2025-11-07 23:28:59','2025-11-07 23:28:59'),(45,27,1,1,35,35,'2025-11-07 23:29:05','2025-11-07 23:29:05'),(46,28,1,1,35,35,'2025-11-07 23:29:11','2025-11-07 23:29:11'),(47,29,1,1,35,35,'2025-11-07 23:30:37','2025-11-07 23:30:37'),(48,30,8,1,37,37,'2025-11-07 23:30:52','2025-11-07 23:30:52'),(49,31,7,1,60,60,'2025-11-07 23:30:56','2025-11-07 23:30:56'),(50,32,10,1,28,28,'2025-11-07 23:31:05','2025-11-07 23:31:05'),(51,33,13,1,24,24,'2025-11-07 23:32:28','2025-11-07 23:32:28'),(52,34,14,1,34,34,'2025-11-07 23:32:32','2025-11-07 23:32:32'),(54,36,17,1,20,20,'2025-11-07 23:32:42','2025-11-07 23:32:42'),(55,37,17,1,20,20,'2025-11-08 02:51:34','2025-11-08 02:51:34');
/*!40000 ALTER TABLE `detalleventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_09_16_021612_create_clientes_table',1),(5,'2024_09_16_022739_create_proveedores_table',1),(6,'2024_09_16_022740_create_productos_table',1),(7,'2024_09_16_022840_create_ventas_table',1),(8,'2024_09_16_022903_create_detalleventas_table',1),(9,'2024_10_08_013411_add_avatar_to_users_table',1),(10,'2024_10_08_013810_cambiar_propiedades_to_users_table',1),(11,'2024_11_07_100001_create_movimientos_inventario_table',1),(12,'2024_11_07_100002_create_detalle_movimientos_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos_inventario`
--

DROP TABLE IF EXISTS `movimientos_inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimientos_inventario` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idProveedor` bigint unsigned NOT NULL,
  `tipoMovimiento` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'entrada',
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `fechaMovimiento` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movimientos_inventario_idproveedor_foreign` (`idProveedor`),
  CONSTRAINT `movimientos_inventario_idproveedor_foreign` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos_inventario`
--

LOCK TABLES `movimientos_inventario` WRITE;
/*!40000 ALTER TABLE `movimientos_inventario` DISABLE KEYS */;
INSERT INTO `movimientos_inventario` VALUES (4,3,'entrada','Ingreso de nuevos materiales para reposición de stock','2025-11-08','2025-11-08 03:07:29','2025-11-08 03:07:29');
/*!40000 ALTER TABLE `movimientos_inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idProveedor` bigint unsigned NOT NULL,
  `codigoProducto` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreProducto` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcionProducto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidadProducto` bigint NOT NULL,
  `costoProducto` float NOT NULL,
  `gananciaProducto` float NOT NULL,
  `precioProducto` float NOT NULL,
  `imageProducto` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_idproveedor_foreign` (`idProveedor`),
  CONSTRAINT `productos_idproveedor_foreign` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,3,'001','Cemento Sol 42.5kg','Saco de cemento Portland',124,22.5,7.5,30,'https://example.com/images/cemento_sol.jpg','2025-11-07 20:42:47','2025-11-08 03:09:33'),(2,3,'002','Arena fina m³','Arena para construcción',23,35,10,45,'https://example.com/images/arena_fina.jpg','2025-11-07 20:43:45','2025-11-08 03:09:33'),(3,2,'003','Juego de llaves combinadas (10 piezas)','juego de llaves',8,90,20,110,'https://www.aibitech.com/92578-large_default/juego-de-llaves-10-piezas-combinadas-estandar-pulgadas-toolcraft-tc5799.jpg','2025-11-07 20:44:38','2025-11-07 23:21:11'),(4,2,'004','Tornillos autorroscantes 4×20 mm','tornillo',87,15,7,22,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsXvUkTl-eekq0aT8CzOERusQNip1D6Lq8fQ&s','2025-11-07 20:52:27','2025-11-07 23:26:15'),(5,2,'005','Cinta métrica 5 m','cinta metrica',7,12,6,18,'https://promart.vteximg.com.br/arquivos/ids/9115333-700-700/20506.jpg?v=638882937402230000','2025-11-07 20:53:25','2025-11-07 23:26:15'),(6,3,'006','Destornillador punta plana 6×150 mm','destornillador',9,10,5,15,'https://promart.vteximg.com.br/arquivos/ids/602309-700-700/125674.jpg?v=637425299907970000','2025-11-07 20:54:34','2025-11-07 21:57:10'),(7,3,'007','Alicate universal 8','alicate',12,45,15,60,'https://gpc.pe/cdn/shop/products/6164-0.png?v=1666816838','2025-11-07 20:55:45','2025-11-07 23:30:56'),(8,3,'008','Sierra manual 22″','cierra',9,32,5,37,'https://http2.mlstatic.com/D_NQ_NP_727013-MLA79385839372_092024-O.webp','2025-11-07 20:56:32','2025-11-07 23:30:52'),(9,3,'009','Guantes de seguridad talla L','guantes',47,20,5,25,'https://promart.vteximg.com.br/arquivos/ids/5978930/image-1b9cb43c9c3344e8b130b1321831a065.jpg?v=637931755049500000','2025-11-07 20:57:24','2025-11-07 23:26:24'),(10,2,'010','Cemento gris 50 kg','cemento gris',17,20,8,28,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4gFzICCKSOEZM_YX0-h143UG-nqxcX8YgTA&s','2025-11-07 20:59:13','2025-11-07 23:31:05'),(11,2,'001','Cemento blanco 40 kg','cemento blanco',48,22,8,30,'https://www.depositosancarlos.co/wp-content/uploads/2020/10/011895-40-CEMENTO-BLANCO-CEMEX-X-40-KLS-1.jpg','2025-11-07 21:00:20','2025-11-07 23:26:34'),(12,3,'012','Cemento tipo portland 25 kg','cemento porlant',9,12,5,17,'https://www.cemex.com.pe/documents/46808606/99696147/productos-cemento-tipo-i-20250123.jpg/49b5f3f1-5084-8a57-2144-fd77418df91f?t=1737677788653','2025-11-07 21:01:17','2025-11-07 23:22:19'),(13,2,'013','Bolsa de aditivo impermeabilizante','aditivo',9,18,6,24,'https://cdn.homedepot.com.mx/productos/699859/699859-z.jpg','2025-11-07 21:06:25','2025-11-07 23:32:28'),(14,2,'014','Sacos de cemento reforzado','saco',13,24,10,34,'https://promart.vteximg.com.br/arquivos/ids/8550267/22485.jpg?v=638727525604030000','2025-11-07 21:07:12','2025-11-07 23:32:32'),(15,2,'015','Cemento rápido de fraguado 20 kg','rapido',18,15,6,21,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIh8bUqkpXo57pbxvRnmQqTbIkKbTH_vq0uA&s','2025-11-07 21:07:56','2025-11-08 02:58:38'),(16,2,'016','Mortero premezclado','cemnto',26,17,5,22,'https://www.cemix.com/wp-content/uploads/2020/09/Mortero.Seco_.SG_.jpg','2025-11-07 21:09:21','2025-11-07 23:27:15'),(17,2,'017','Cemento para rejuntados 25 kg','cemento',26,14,6,20,'https://grillcorp.com.pe/cdn/shop/files/CEMENTODE25KG-GRILLCORP.png?v=1754084636','2025-11-07 21:10:22','2025-11-08 02:51:34'),(18,2,'018','Cemento ecológico “verde” 40 kg','cemento',0,23,9,32,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbW5ze3pR6qheiLl2_80oeDhT82MzKmjgt5A&s','2025-11-07 21:11:16','2025-11-07 21:11:16'),(19,2,'019','Bolsa de cemento para reparaciones','cemento',22,7,3,10,'https://promart.vteximg.com.br/arquivos/ids/8246753-700-700/109472.jpg?v=638648076634030000','2025-11-07 21:12:08','2025-11-07 23:22:29'),(20,9,'020','Barra corrugada Ø 10 mm (6 m)','10mm',91,16,6,22,'https://media.falabella.com/sodimacPE/2209985_01/w=1500,h=1500,fit=pad','2025-11-07 21:14:38','2025-11-07 23:27:53'),(21,8,'021','Barra corrugada Ø 12 mm (6 m)','12MM',117,22,8,30,'https://media.falabella.com/sodimacPE/84212_01/w=1500,h=1500,fit=pad','2025-11-07 21:15:54','2025-11-07 23:22:55'),(22,8,'022','Barra corrugada Ø 16 mm (6 m)','16mm',133,35,6,41,'https://media.falabella.com/sodimacPE/84239_01/w=1500,h=1500,fit=pad','2025-11-07 21:44:51','2025-11-07 23:28:59'),(23,8,'023','Barra corrugada Ø 20 mm (6 m)','20mm',98,55,11,66,'https://media.falabella.com/sodimacPE/84239_21/w=800,h=800,fit=pad','2025-11-07 21:45:46','2025-11-07 23:28:02'),(24,8,'024','Barra corrugada Ø 25 mm (6 m)','25mm',90,75,24,99,'https://acerosarequipa.com/sites/default/files/productos/2023-03/BARRA%20CORRUGADA%20COL%202289.jpg','2025-11-07 21:46:57','2025-11-07 21:46:57'),(26,9,'026','Perfil U de acero 100×50×5 mm (6 m)','perfil',113,140,45,185,'https://www.perfimet.cl/wp-content/uploads/2021/06/canales.jpg','2025-11-07 21:49:24','2025-11-07 23:23:02'),(27,9,'027','Perfil I de acero 125 mm (6 m)','perfil',73,165,45,210,'https://media.prodalam.cl/media-pim/9392/9392_1.jpg','2025-11-07 21:50:36','2025-11-07 23:23:02'),(28,9,'028','Placa de acero 6 mm × 2 m × 1 m','placa',48,145,45,190,'https://aceropanel.es/17013-large_default/chapa-placa-de-acero-a-medida-e6.jpg','2025-11-07 21:51:43','2025-11-07 23:23:09'),(29,9,'029','Tubo de acero estructural Ø 100 mm','tubo',19,305,95,400,'https://acerosarequipa.com/sites/default/files/productos/2023-02/TUBOS_SCH_CON_COSTURA.jpg','2025-11-07 21:53:16','2025-11-07 23:23:09'),(30,9,'030','Ángulo de acero 50×50×5 mm','angulo',56,95,35,130,'https://acerosarequipa.com/sites/default/files/productos/2023-03/CANALES%20U%20450x450%20%281%29.jpg','2025-11-07 21:54:38','2025-11-07 21:54:38'),(31,9,'031','Barra lisa de acero Ø 12 mm (6 m)','barra lisa',78,20,8,28,'https://dojiw2m9tvv09.cloudfront.net/43701/product/default1727.jpg','2025-11-07 21:55:35','2025-11-07 23:23:19'),(32,9,'032','Malla electrosoldada de acero 6×2 m','malla',96,220,75,295,'https://acerosarequipa.com/sites/default/files/productos/2023-02/Malla_electrosoldada_para_mineria.png','2025-11-07 21:56:44','2025-11-07 23:23:19');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `razonSocial` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rucProveedor` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correoProveedor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccionProveedor` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonoProveedor` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Nuevo','20123456789','test@example.com','Av. Test 123','+51 999999999','2025-11-07 20:29:12','2025-11-08 01:53:28'),(2,'CEMEX PERU S.A.','20516020301','cromina@cemex.pe','Dirección Legal: Av. Santo Toribio Nro. 143 Res. Residencial\nDistrito / Ciudad: San Isidro\nDepartamento: Lima, Perú\nEstado Domicilio: Habido','951236874','2025-11-07 20:34:13','2025-11-07 20:34:13'),(3,'GRUPO ROMINA S.A.C.','20600485050','gromina@ventas.pe','Callao - Canta Callao','957846321','2025-11-07 20:36:06','2025-11-07 20:36:06'),(5,'MIROMINA S.A.','20543847420','miromina@ventas.com','Dirección Legal: Av. los Ingenieros Nro. 154\nUrbanizacion: Industrial Santa Raquel I','935214687','2025-11-07 20:57:04','2025-11-07 20:57:04'),(6,'EDIFICA Y CONSTRUYE GEA SOCIEDAD ANONIMA CERRADA','20608523597','edificayconstruye@gmail.com','Dirección Legal: Jr. Vitacura Mza. B Lote. 9 (Cda 26 Av San Carlos)\nDistrito / Ciudad: Huancayo','956321847','2025-11-07 20:58:30','2025-11-07 20:58:30'),(7,'SAINT-GOBAIN ABRASIVOS Y ADHESIVOS PERU S.A.C.','20462262087','scesar@saintgobain.pe','Dirección Legal: Jr. Flora Tristan Nro. 310 Int. 2001\nUrbanizacion: Orrantia del Mar (Edificio Bloom Tower - Vigesimo Piso)','965874132','2025-11-07 21:06:34','2025-11-07 21:06:34'),(8,'SIDERPERU','20402885549','sider@gmail.com','jr miraflores 123','987654321','2025-11-07 21:12:56','2025-11-07 21:14:50'),(9,'ACEROS AREQUIPA','20370146994','aceros@gmail.com','jr cirolanda 156','963285147','2025-11-07 21:13:35','2025-11-07 21:15:01'),(10,'Saint-Gobain Productos para la Construccion S.a.C.','20604381801','ventas@saintgobain.pe','Razón Social: SAINT-GOBAIN PRODUCTOS PARA LA CONSTRUCCION S.A.C.\nRazon Social Anterior: Japearbe S.a.C.','965874213','2025-11-07 21:54:25','2025-11-07 21:54:25'),(11,'CERAMICA SAN LORENZO SAC','20307146798','slorenzo@gmail.com','Dirección Legal: Av. Industrial Nro. S/n (Alt.Km.36.5 Panam.Sur (Prad.de Lurin))\nDistrito / Ciudad: Lurin\nDepartamento: Lima, Perú','965872451','2025-11-07 21:55:54','2025-11-07 21:55:54');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
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
INSERT INTO `sessions` VALUES ('0Wbk5YjtlOYBobUeYPlNmTtsga6wTryJ0zywsluk',NULL,'165.22.51.107','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1lXeHlEYUtZdGxRaUd5YU9yd2R3V1VsQnpVSkY0Q0s1TzhCNzljQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762663663),('7gwwV2XtnkGIGbwLOdjNfUCD9bYx7LOn08YEDigf',NULL,'65.49.1.138','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1pkYTJLNkpiTExUaXpiQ1lxU1Y3VkdEUGdBeDZEOGJFeGdQMUxRUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9hcGkuaXBpZnkub3JnLz9mb3JtYXQ9anNvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762659842),('9ed5vIgbfA9XAcRausyrrMnIaYfsPlKSLNydPA3P',NULL,'143.244.145.190','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3E2YTc4Q2M2NFVaYjlEdmplc0R3Q0VWZk93ekVVWTQ2VmhpU3k4SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1762693462),('AFbAxaG12svdgAao4V5G2mis3lMhI7Ss6cHYwRmi',NULL,'64.62.156.214','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoieTVDZHZINEV2NHByQmdpU1ZITFZ3QzY3RU9pclRmSmFNM0lCeERNRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9hcGkuaXBpZnkub3JnLz9mb3JtYXQ9anNvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762735264),('CTqzqZ0HXlnCROZ3BsmyDRtBfilBIT5WTAyJyUFT',NULL,'165.154.172.88','Mozilla/5.0 (Macintosh; Intel Mac OS X 9_1) AppleWebKit/550.49 (KHTML, like Gecko) Chrome/59.0.965 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiamZLQUl1VDhzZ3pGVzQ4WGd0VHkxR1hrYjhqQmdkMlBTU1lzd0R0dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762718838),('jQiaWxnUexlxQ2pvgeMbfa4j6zFniBQDakywud9A',NULL,'45.156.129.132','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36 ','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTIzMk5ZVVlnSW1sT2IyU1JyaEo0cWNyYW1IYk1VY3JzR081c1hWMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762669855),('L618xpgj0Yy25elaIlSNMrIE8h67XQqfJZnjWwuh',NULL,'64.62.156.212','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3RqdlVjalU2Q3ZVZkRodzJWM05CY3lTUVZEWmphZFdWdDZkMDNONyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762735239),('lKoex3GhNuVqFpsycBd65VuX3DxXue0DhIYbDQVy',NULL,'44.220.188.224','Mozilla/5.0 (Windows NT 6.2;en-US) AppleWebKit/537.32.36 (KHTML, live Gecko) Chrome/55.0.3018.87 Safari/537.32','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTIzV293TVlwcWh5bFREdDZ6MU9VaVptRU9vWjlEUVF6Tjh6VEdFeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762736634),('mmyv8BcnQBZXy6XpY6cqfMNeSr6ELB4DdfNQ0Va0',NULL,'45.142.154.91','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTd6VmxSN1FqeDlqR3ZoeDd5Y05TYXEzVmQxYUlBUDhmYjNkejk3YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762689975),('oysuYz4px3MuktDkRPLnbQBKCXyVntgzQSI5Qh3y',NULL,'65.49.1.132','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ05jZG5McGJzMURlSXVueHo0bE5uYUZNMmtTQTVzMTJqbUlhWFhzTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762659812),('R6SoTJOvwVnr6JnUU1Sy3T0ppsi5CMSk65bvwPtJ',NULL,'165.22.51.107','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoienlPYzdhZ3RMQ0lXb3dVclpTR0FTNzhTbVB0N2dEVG0zYkw2SmNYVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762663662),('S6lUohxnZXK0gPxzhpQxcvqsTTEEzXUbf73C68qJ',NULL,'165.154.163.113','curl/7.29.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoicndlN1NNUFRxRnN1dDdaUExMdDI1dk9BRzBhODBZeHZHbWVqRVRERyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1762718804),('sGVvNoM0oEIpIhi8qBIyiWhyJCurDFsBm97tP8T8',NULL,'45.142.154.91','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiektzNTh0YTZLNE85TlcwQW4xTGJmM1dWaDg5VXJTWkhYWDhrNlpzeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762689974),('Te2zARO7d9loNmnsL9Lt9Bg94Z6n2R1qwSauSGWg',NULL,'199.45.155.95','Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)','YTozOntzOjY6Il90b2tlbiI7czo0MDoidUM4MEllaVJjYTN0Rm9MMnBzYUJZdlZXUllPbU45TmUySnJwaHFBSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762666314),('Um8ltadtMtF7rmkeNGFQMHv9pm8LwfZxp60i5kuB',NULL,'199.45.155.95','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVNKRjJzNlZwTXI5WjhlMWVPeTRvVmVxOXU3WlduVjNjYjZUdzY1TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762666302),('x9ro669WECc6kge8BSZDc1CuIE8CJHAAu97iUK06',NULL,'204.76.203.18','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUR3ODZLemhoTTRCSmxKR01IZWF2eHR0NDBwSHpNZnpEZXZVcmtNTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762728051),('xMX7yo3kmZf7RotMqwH8VNStnBuFQ79dSbzLxiYV',NULL,'199.45.155.95','Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUk1xOFlvQ2twZmpETmJPY3dhTlhheVhibVFSRzBCV1REOUVLeDFKVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNDMuMTEwLjIyNi4yMTQ6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762666307);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idCliente` bigint unsigned NOT NULL,
  `subtotalVenta` float NOT NULL,
  `gananciasVenta` float NOT NULL,
  `igvVenta` float NOT NULL,
  `totalVenta` float NOT NULL,
  `fechaVenta` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_idcliente_foreign` (`idCliente`),
  CONSTRAINT `ventas_idcliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (2,1,50,15,9,59,'2025-11-07','2025-11-07 21:57:10','2025-11-07 21:57:10'),(3,2,70,20,12.6,82.6,'2025-11-07','2025-11-07 23:20:51','2025-11-07 23:20:51'),(4,3,84,27,15.12,99.12,'2025-11-07','2025-11-07 23:21:05','2025-11-07 23:21:05'),(5,4,1610,320,289.8,1899.8,'2025-11-07','2025-11-07 23:21:11','2025-11-07 23:21:11'),(6,1,22,7,3.96,25.96,'2025-11-07','2025-11-07 23:21:22','2025-11-07 23:21:22'),(7,2,22,7,3.96,25.96,'2025-11-07','2025-11-07 23:21:29','2025-11-07 23:21:29'),(8,4,88,28,15.84,103.84,'2025-11-07','2025-11-07 23:21:41','2025-11-07 23:21:41'),(9,2,72,18,12.96,84.96,'2025-11-07','2025-11-07 23:22:19','2025-11-07 23:22:19'),(10,2,98,27,17.64,115.64,'2025-11-07','2025-11-07 23:22:29','2025-11-07 23:22:29'),(11,2,64,16,11.52,75.52,'2025-11-07','2025-11-07 23:22:46','2025-11-07 23:22:46'),(12,2,156,42,28.08,184.08,'2025-11-07','2025-11-07 23:22:55','2025-11-07 23:22:55'),(13,2,790,180,142.2,932.2,'2025-11-07','2025-11-07 23:23:02','2025-11-07 23:23:02'),(14,2,780,185,140.4,920.4,'2025-11-07','2025-11-07 23:23:09','2025-11-07 23:23:09'),(15,2,618,158,111.24,729.24,'2025-11-07','2025-11-07 23:23:18','2025-11-07 23:23:18'),(16,2,62,20,11.16,73.16,'2025-11-07','2025-11-07 23:23:35','2025-11-07 23:23:35'),(17,2,62,20,11.16,73.16,'2025-11-07','2025-11-07 23:26:15','2025-11-07 23:26:15'),(18,2,50,10,9,59,'2025-11-07','2025-11-07 23:26:24','2025-11-07 23:26:24'),(19,1,120,30,21.6,141.6,'2025-11-07','2025-11-07 23:26:28','2025-11-07 23:26:28'),(20,4,86,24,15.48,101.48,'2025-11-07','2025-11-07 23:26:34','2025-11-07 23:26:34'),(21,4,76,22,13.68,89.68,'2025-11-07','2025-11-07 23:26:41','2025-11-07 23:26:41'),(22,3,22,5,3.96,25.96,'2025-11-07','2025-11-07 23:26:49','2025-11-07 23:26:49'),(23,3,42,11,7.56,49.56,'2025-11-07','2025-11-07 23:27:15','2025-11-07 23:27:15'),(24,3,44,12,7.92,51.92,'2025-11-07','2025-11-07 23:27:53','2025-11-07 23:27:53'),(25,3,173,28,31.14,204.14,'2025-11-07','2025-11-07 23:28:02','2025-11-07 23:28:02'),(26,3,41,6,7.38,48.38,'2025-11-07','2025-11-07 23:28:59','2025-11-07 23:28:59'),(27,1,35,10,6.3,41.3,'2025-11-07','2025-11-07 23:29:05','2025-11-07 23:29:05'),(28,2,35,10,6.3,41.3,'2025-11-07','2025-11-07 23:29:11','2025-11-07 23:29:11'),(29,3,35,10,6.3,41.3,'2025-11-07','2025-11-07 23:30:37','2025-11-07 23:30:37'),(30,2,37,5,6.66,43.66,'2025-11-07','2025-11-07 23:30:52','2025-11-07 23:30:52'),(31,2,60,15,10.8,70.8,'2025-11-07','2025-11-07 23:30:56','2025-11-07 23:30:56'),(32,4,28,8,5.04,33.04,'2025-11-07','2025-11-07 23:31:05','2025-11-07 23:31:05'),(33,3,24,6,4.32,28.32,'2025-11-07','2025-11-07 23:32:28','2025-11-07 23:32:28'),(34,4,34,10,6.12,40.12,'2025-11-07','2025-11-07 23:32:32','2025-11-07 23:32:32'),(36,3,20,6,3.6,23.6,'2025-11-07','2025-11-07 23:32:42','2025-11-07 23:32:42'),(37,3,20,6,3.6,23.6,'2025-11-07','2025-11-08 02:51:34','2025-11-08 02:51:34');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-14 17:05:55
