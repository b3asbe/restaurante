-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: sistema_pedidos
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `estados_pedido`
--

DROP TABLE IF EXISTS `estados_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estados_pedido` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados_pedido`
--

LOCK TABLES `estados_pedido` WRITE;
/*!40000 ALTER TABLE `estados_pedido` DISABLE KEYS */;
INSERT INTO `estados_pedido` VALUES (1,'Pendiente'),(2,'En preparación'),(3,'Listo'),(4,'Entregado'),(5,'Cancelado'),(6,'En camino'),(7,'Pagado'),(8,'Facturado'),(9,'Devuelto'),(10,'Archivado');
/*!40000 ALTER TABLE `estados_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insumos`
--

DROP TABLE IF EXISTS `insumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `insumos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `cantidad` int NOT NULL,
  `unidad` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insumos`
--

LOCK TABLES `insumos` WRITE;
/*!40000 ALTER TABLE `insumos` DISABLE KEYS */;
INSERT INTO `insumos` VALUES (1,'Tomate',100,'kg'),(2,'Lechuga',50,'kg'),(3,'Carne',200,'kg'),(4,'Pan',150,'unidades'),(5,'Queso',80,'kg'),(6,'Arroz',120,'kg'),(7,'Pasta',100,'kg'),(8,'Pescado',60,'kg'),(9,'Aceite',40,'litros'),(10,'Azúcar',30,'kg');
/*!40000 ALTER TABLE `insumos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Desayuno','Platos para empezar el día'),(2,'Almuerzo','Comidas principales del mediodía'),(3,'Cena','Platos ligeros para la noche'),(4,'Menú Ejecutivo','Opción económica entre semana'),(5,'Vegetariano','Opciones sin carne'),(6,'Niños','Porciones y sabores para los pequeños'),(7,'Postres','Dulces y pastelillos'),(8,'Bebidas','Refrescos, jugos y más'),(9,'Especiales','Platos del día'),(10,'Promociones','Ofertas y combos');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesas`
--

DROP TABLE IF EXISTS `mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` int NOT NULL,
  `capacidad` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (1,1,2),(2,2,4),(3,3,4),(4,4,6),(5,5,6),(6,6,8),(7,7,8),(8,8,10),(9,9,10),(10,10,12);
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos_insumo`
--

DROP TABLE IF EXISTS `movimientos_insumo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimientos_insumo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `insumo_id` int NOT NULL,
  `cantidad` int NOT NULL,
  `tipo` enum('ENTRADA','SALIDA') NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `insumo_id` (`insumo_id`),
  CONSTRAINT `movimientos_insumo_ibfk_1` FOREIGN KEY (`insumo_id`) REFERENCES `insumos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos_insumo`
--

LOCK TABLES `movimientos_insumo` WRITE;
/*!40000 ALTER TABLE `movimientos_insumo` DISABLE KEYS */;
INSERT INTO `movimientos_insumo` VALUES (1,1,100,'ENTRADA','2025-05-01 08:00:00'),(2,2,50,'ENTRADA','2025-05-01 08:05:00'),(3,3,200,'ENTRADA','2025-05-01 08:10:00'),(4,4,20,'SALIDA','2025-05-14 10:00:00'),(5,5,10,'SALIDA','2025-05-14 10:05:00'),(6,6,30,'ENTRADA','2025-05-14 10:10:00'),(7,7,15,'SALIDA','2025-05-15 09:00:00'),(8,8,5,'SALIDA','2025-05-16 18:00:00'),(9,9,10,'ENTRADA','2025-05-17 07:00:00'),(10,10,5,'SALIDA','2025-05-18 20:00:00'),(11,10,44,'SALIDA','2025-06-01 10:15:00'),(12,5,9,'ENTRADA','2025-06-01 10:30:00'),(13,5,15,'SALIDA','2025-06-01 10:45:00'),(14,9,31,'SALIDA','2025-06-01 11:00:00'),(15,2,50,'SALIDA','2025-06-01 11:15:00'),(16,10,13,'SALIDA','2025-06-01 11:30:00'),(17,10,15,'ENTRADA','2025-06-01 11:45:00'),(18,2,26,'SALIDA','2025-06-01 12:00:00'),(19,1,43,'SALIDA','2025-06-01 12:15:00'),(20,9,35,'ENTRADA','2025-06-01 12:30:00'),(21,8,44,'ENTRADA','2025-06-01 12:45:00'),(22,4,7,'ENTRADA','2025-06-01 13:00:00'),(23,9,43,'ENTRADA','2025-06-01 13:15:00'),(24,7,33,'ENTRADA','2025-06-01 13:30:00'),(25,4,3,'ENTRADA','2025-06-01 13:45:00'),(26,6,44,'SALIDA','2025-06-01 14:00:00'),(27,9,38,'SALIDA','2025-06-01 14:15:00'),(28,3,5,'ENTRADA','2025-06-01 14:30:00'),(29,9,38,'ENTRADA','2025-06-01 14:45:00'),(30,1,8,'ENTRADA','2025-06-01 15:00:00'),(31,3,34,'SALIDA','2025-06-01 15:15:00'),(32,6,34,'ENTRADA','2025-06-01 15:30:00'),(33,4,21,'SALIDA','2025-06-01 15:45:00'),(34,7,25,'SALIDA','2025-06-01 16:00:00'),(35,5,46,'SALIDA','2025-06-01 16:15:00'),(36,2,2,'SALIDA','2025-06-01 16:30:00'),(37,4,5,'ENTRADA','2025-06-01 16:45:00'),(38,6,50,'SALIDA','2025-06-01 17:00:00'),(39,3,45,'SALIDA','2025-06-01 17:15:00'),(40,2,3,'SALIDA','2025-06-01 17:30:00'),(41,7,43,'SALIDA','2025-06-01 17:45:00'),(42,5,12,'ENTRADA','2025-06-01 18:00:00'),(43,1,1,'ENTRADA','2025-06-01 18:15:00'),(44,4,48,'ENTRADA','2025-06-01 18:30:00'),(45,1,50,'ENTRADA','2025-06-01 18:45:00'),(46,6,9,'ENTRADA','2025-06-01 19:00:00'),(47,9,31,'SALIDA','2025-06-01 19:15:00'),(48,2,24,'SALIDA','2025-06-01 19:30:00'),(49,7,21,'SALIDA','2025-06-01 19:45:00'),(50,4,16,'SALIDA','2025-06-01 20:00:00'),(51,3,31,'ENTRADA','2025-06-01 20:15:00'),(52,6,14,'ENTRADA','2025-06-01 20:30:00'),(53,7,1,'ENTRADA','2025-06-01 20:45:00'),(54,3,12,'SALIDA','2025-06-01 21:00:00'),(55,6,19,'ENTRADA','2025-06-01 21:15:00'),(56,6,17,'SALIDA','2025-06-01 21:30:00'),(57,3,16,'ENTRADA','2025-06-01 21:45:00'),(58,1,22,'ENTRADA','2025-06-01 22:00:00'),(59,9,45,'SALIDA','2025-06-01 22:15:00'),(60,6,33,'ENTRADA','2025-06-01 22:30:00'),(61,4,6,'ENTRADA','2025-06-01 22:45:00'),(62,8,44,'ENTRADA','2025-06-01 23:00:00'),(63,6,33,'ENTRADA','2025-06-01 23:15:00'),(64,9,7,'SALIDA','2025-06-01 23:30:00'),(65,1,32,'SALIDA','2025-06-01 23:45:00'),(66,1,5,'SALIDA','2025-06-02 00:00:00'),(67,10,3,'ENTRADA','2025-06-02 00:15:00'),(68,8,23,'SALIDA','2025-06-02 00:30:00'),(69,8,45,'SALIDA','2025-06-02 00:45:00'),(70,7,27,'SALIDA','2025-06-02 01:00:00'),(71,10,28,'ENTRADA','2025-06-02 01:15:00'),(72,1,13,'ENTRADA','2025-06-02 01:30:00'),(73,7,40,'SALIDA','2025-06-02 01:45:00'),(74,8,3,'SALIDA','2025-06-02 02:00:00'),(75,9,19,'ENTRADA','2025-06-02 02:15:00'),(76,3,21,'ENTRADA','2025-06-02 02:30:00'),(77,2,14,'ENTRADA','2025-06-02 02:45:00'),(78,10,37,'ENTRADA','2025-06-02 03:00:00'),(79,9,7,'ENTRADA','2025-06-02 03:15:00'),(80,5,40,'SALIDA','2025-06-02 03:30:00'),(81,3,28,'ENTRADA','2025-06-02 03:45:00'),(82,3,14,'ENTRADA','2025-06-02 04:00:00'),(83,1,23,'ENTRADA','2025-06-02 04:15:00'),(84,10,3,'SALIDA','2025-06-02 04:30:00'),(85,1,50,'SALIDA','2025-06-02 04:45:00'),(86,1,42,'ENTRADA','2025-06-02 05:00:00'),(87,10,12,'SALIDA','2025-06-02 05:15:00'),(88,2,16,'SALIDA','2025-06-02 05:30:00'),(89,9,7,'ENTRADA','2025-06-02 05:45:00'),(90,9,29,'ENTRADA','2025-06-02 06:00:00'),(91,8,16,'SALIDA','2025-06-02 06:15:00'),(92,10,4,'ENTRADA','2025-06-02 06:30:00'),(93,6,36,'ENTRADA','2025-06-02 06:45:00'),(94,5,42,'SALIDA','2025-06-02 07:00:00'),(95,7,43,'SALIDA','2025-06-02 07:15:00'),(96,9,29,'SALIDA','2025-06-02 07:30:00'),(97,7,38,'SALIDA','2025-06-02 07:45:00'),(98,4,10,'SALIDA','2025-06-02 08:00:00'),(99,7,19,'ENTRADA','2025-06-02 08:15:00'),(100,8,25,'ENTRADA','2025-06-02 08:30:00'),(101,7,45,'SALIDA','2025-06-02 08:45:00'),(102,7,41,'ENTRADA','2025-06-02 09:00:00'),(103,10,41,'ENTRADA','2025-06-02 09:15:00'),(104,3,13,'SALIDA','2025-06-02 09:30:00'),(105,7,29,'ENTRADA','2025-06-02 09:45:00'),(106,2,2,'SALIDA','2025-06-02 10:00:00'),(107,9,11,'SALIDA','2025-06-02 10:15:00'),(108,7,34,'SALIDA','2025-06-02 10:30:00'),(109,4,31,'ENTRADA','2025-06-02 10:45:00'),(110,9,12,'SALIDA','2025-06-02 11:00:00'),(111,5,38,'SALIDA','2025-06-02 11:15:00'),(112,2,3,'SALIDA','2025-06-02 11:30:00'),(113,4,6,'SALIDA','2025-06-02 11:45:00'),(114,8,18,'SALIDA','2025-06-02 12:00:00'),(115,9,19,'ENTRADA','2025-06-02 12:15:00'),(116,2,3,'SALIDA','2025-06-02 12:30:00'),(117,7,6,'ENTRADA','2025-06-02 12:45:00'),(118,1,13,'ENTRADA','2025-06-02 13:00:00'),(119,6,33,'SALIDA','2025-06-02 13:15:00'),(120,4,27,'ENTRADA','2025-06-02 13:30:00');
/*!40000 ALTER TABLE `movimientos_insumo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_productos`
--

DROP TABLE IF EXISTS `pedido_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_productos` (
  `pedido_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`pedido_id`,`producto_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `pedido_productos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `pedido_productos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_productos`
--

LOCK TABLES `pedido_productos` WRITE;
/*!40000 ALTER TABLE `pedido_productos` DISABLE KEYS */;
INSERT INTO `pedido_productos` VALUES (1,1,2,25.50),(1,2,3,28.62),(2,2,1,18.00),(2,6,5,18.27),(3,3,1,15.75),(3,6,1,19.08),(4,4,3,22.30),(4,8,4,14.36),(5,2,1,14.74),(5,5,2,12.50),(6,2,5,26.16),(6,6,1,30.00),(7,1,1,18.31),(7,7,2,24.00),(8,8,1,20.00),(8,10,1,15.96),(9,9,4,14.50),(10,1,1,25.37),(10,10,3,10.00),(11,6,4,23.57),(12,1,5,20.68),(13,6,1,18.22),(14,9,3,20.16),(15,10,1,12.77),(16,10,2,26.87),(17,2,5,22.46),(18,2,2,29.71),(19,8,1,23.48),(20,6,5,14.53),(21,4,4,16.59),(22,7,3,20.41),(23,2,2,14.42),(24,9,2,16.72),(25,8,3,12.30),(26,10,1,24.44),(27,5,2,17.70),(28,1,1,11.86),(29,7,4,20.51),(30,6,3,27.14),(31,6,2,12.38),(32,9,2,28.29),(33,5,5,10.73),(34,2,2,18.94),(35,10,3,25.44),(36,9,2,18.48),(37,3,5,21.55),(38,1,4,15.78),(39,2,1,26.43),(40,9,2,10.99),(41,8,1,10.11),(42,4,5,18.06),(43,4,2,14.45),(44,5,4,22.99),(45,4,3,19.64),(46,8,2,27.88),(47,5,3,16.90),(48,5,4,26.50),(49,8,3,16.62),(50,8,4,21.16),(51,6,5,13.08),(52,10,2,20.25),(53,8,4,14.32),(54,8,3,27.20),(55,10,5,23.31),(56,3,3,11.81),(57,3,1,29.96),(58,6,5,25.69),(59,3,1,19.84),(60,7,5,24.28),(61,8,5,18.24),(62,10,1,24.90),(63,5,5,14.40),(64,4,3,18.19),(65,7,3,26.55),(66,10,3,11.69),(67,3,2,25.81),(68,4,4,27.67),(69,1,5,26.01),(70,4,4,13.56),(71,5,3,18.05),(72,6,1,20.38),(73,2,5,21.46),(74,10,4,21.33),(75,5,2,18.77),(76,1,5,25.92),(77,6,3,16.99),(78,3,3,25.03),(79,7,4,17.53),(80,10,4,23.40),(81,5,3,19.78),(82,9,3,23.03),(83,3,5,21.80),(84,9,5,15.06),(85,8,2,29.73),(86,9,2,12.26),(87,7,4,28.90),(88,5,3,24.91),(89,3,1,10.83),(90,2,5,16.58),(91,9,5,22.47),(92,7,5,14.97),(93,5,1,23.07),(94,8,5,29.01),(95,4,1,20.70),(96,2,5,19.95),(97,9,5,21.07),(98,3,3,16.62),(99,2,5,20.55),(100,1,3,25.85),(101,5,5,22.71),(102,6,2,14.43),(103,7,3,16.18),(104,1,4,11.86),(105,2,1,29.12),(106,10,5,24.97),(107,9,3,23.54),(108,1,1,25.98),(109,10,5,21.59),(110,7,5,29.01);
/*!40000 ALTER TABLE `pedido_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `mesa_id` int DEFAULT NULL,
  `estado_id` int NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_entrega` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `mesa_id` (`mesa_id`),
  KEY `estado_id` (`estado_id`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`),
  CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`estado_id`) REFERENCES `estados_pedido` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,2,1,1,'2025-05-14 12:05:00','2025-05-14 12:30:00'),(2,3,2,2,'2025-05-15 13:35:00','2025-05-15 14:00:00'),(3,1,3,3,'2025-05-16 19:05:00',NULL),(4,4,4,4,'2025-05-17 20:10:00','2025-05-17 20:40:00'),(5,5,5,1,'2025-05-18 18:50:00',NULL),(6,6,6,2,'2025-05-19 12:20:00','2025-05-19 12:45:00'),(7,7,7,3,'2025-05-20 14:05:00','2025-05-20 14:30:00'),(8,8,8,4,'2025-05-21 15:35:00','2025-05-21 16:00:00'),(9,9,9,5,'2025-05-22 17:10:00',NULL),(10,10,10,6,'2025-05-23 19:35:00','2025-05-23 20:00:00'),(11,3,6,5,'2025-06-01 10:25:00',NULL),(12,8,2,1,'2025-06-01 10:50:00',NULL),(13,9,8,1,'2025-06-01 11:15:00','2025-06-01 12:12:00'),(14,7,4,10,'2025-06-01 11:40:00','2025-06-01 12:17:00'),(15,3,8,7,'2025-06-01 12:05:00',NULL),(16,8,8,8,'2025-06-01 12:30:00',NULL),(17,1,2,10,'2025-06-01 12:55:00','2025-06-01 13:38:00'),(18,4,8,8,'2025-06-01 13:20:00',NULL),(19,4,3,5,'2025-06-01 13:45:00','2025-06-01 14:35:00'),(20,7,7,6,'2025-06-01 14:10:00','2025-06-01 14:46:00'),(21,3,5,5,'2025-06-01 14:35:00','2025-06-01 15:33:00'),(22,8,2,3,'2025-06-01 15:00:00',NULL),(23,5,2,10,'2025-06-01 15:25:00','2025-06-01 15:48:00'),(24,5,9,5,'2025-06-01 15:50:00','2025-06-01 16:49:00'),(25,10,7,9,'2025-06-01 16:15:00','2025-06-01 17:01:00'),(26,8,3,5,'2025-06-01 16:40:00',NULL),(27,1,7,2,'2025-06-01 17:05:00','2025-06-01 17:49:00'),(28,8,10,6,'2025-06-01 17:30:00',NULL),(29,7,7,5,'2025-06-01 17:55:00',NULL),(30,2,7,4,'2025-06-01 18:20:00','2025-06-01 19:08:00'),(31,4,7,6,'2025-06-01 18:45:00','2025-06-01 19:01:00'),(32,9,10,3,'2025-06-01 19:10:00','2025-06-01 19:46:00'),(33,8,1,2,'2025-06-01 19:35:00','2025-06-01 20:06:00'),(34,7,6,4,'2025-06-01 20:00:00','2025-06-01 20:48:00'),(35,1,6,4,'2025-06-01 20:25:00',NULL),(36,3,5,8,'2025-06-01 20:50:00',NULL),(37,10,10,4,'2025-06-01 21:15:00',NULL),(38,5,1,2,'2025-06-01 21:40:00',NULL),(39,10,8,2,'2025-06-01 22:05:00','2025-06-01 22:46:00'),(40,8,7,7,'2025-06-01 22:30:00',NULL),(41,3,6,7,'2025-06-01 22:55:00',NULL),(42,6,8,9,'2025-06-01 23:20:00','2025-06-01 23:55:00'),(43,2,6,7,'2025-06-01 23:45:00','2025-06-02 00:42:00'),(44,1,7,8,'2025-06-02 00:10:00','2025-06-02 01:09:00'),(45,7,7,5,'2025-06-02 00:35:00',NULL),(46,8,5,4,'2025-06-02 01:00:00',NULL),(47,9,2,8,'2025-06-02 01:25:00',NULL),(48,9,7,6,'2025-06-02 01:50:00',NULL),(49,10,7,9,'2025-06-02 02:15:00',NULL),(50,9,1,10,'2025-06-02 02:40:00',NULL),(51,8,4,8,'2025-06-02 03:05:00','2025-06-02 04:02:00'),(52,6,9,2,'2025-06-02 03:30:00','2025-06-02 04:01:00'),(53,10,8,5,'2025-06-02 03:55:00',NULL),(54,8,4,8,'2025-06-02 04:20:00',NULL),(55,2,3,8,'2025-06-02 04:45:00','2025-06-02 05:09:00'),(56,8,6,9,'2025-06-02 05:10:00','2025-06-02 06:03:00'),(57,2,8,3,'2025-06-02 05:35:00',NULL),(58,3,2,5,'2025-06-02 06:00:00','2025-06-02 06:24:00'),(59,5,3,1,'2025-06-02 06:25:00','2025-06-02 07:12:00'),(60,9,7,3,'2025-06-02 06:50:00','2025-06-02 07:48:00'),(61,10,6,2,'2025-06-02 07:15:00','2025-06-02 07:47:00'),(62,1,10,9,'2025-06-02 07:40:00','2025-06-02 08:08:00'),(63,7,9,7,'2025-06-02 08:05:00',NULL),(64,5,9,10,'2025-06-02 08:30:00',NULL),(65,7,7,9,'2025-06-02 08:55:00','2025-06-02 09:42:00'),(66,5,3,1,'2025-06-02 09:20:00',NULL),(67,6,9,1,'2025-06-02 09:45:00','2025-06-02 10:31:00'),(68,10,8,7,'2025-06-02 10:10:00','2025-06-02 10:33:00'),(69,4,1,1,'2025-06-02 10:35:00',NULL),(70,7,4,3,'2025-06-02 11:00:00',NULL),(71,7,7,5,'2025-06-02 11:25:00',NULL),(72,6,3,4,'2025-06-02 11:50:00','2025-06-02 12:24:00'),(73,10,1,2,'2025-06-02 12:15:00',NULL),(74,4,2,5,'2025-06-02 12:40:00',NULL),(75,7,5,4,'2025-06-02 13:05:00',NULL),(76,5,3,3,'2025-06-02 13:30:00','2025-06-02 13:44:00'),(77,7,5,7,'2025-06-02 13:55:00',NULL),(78,8,7,9,'2025-06-02 14:20:00',NULL),(79,10,2,6,'2025-06-02 14:45:00',NULL),(80,4,9,10,'2025-06-02 15:10:00',NULL),(81,10,8,1,'2025-06-02 15:35:00',NULL),(82,1,9,9,'2025-06-02 16:00:00','2025-06-02 16:16:00'),(83,5,8,3,'2025-06-02 16:25:00',NULL),(84,8,8,7,'2025-06-02 16:50:00','2025-06-02 17:37:00'),(85,5,4,9,'2025-06-02 17:15:00',NULL),(86,9,6,2,'2025-06-02 17:40:00',NULL),(87,5,1,5,'2025-06-02 18:05:00',NULL),(88,3,4,6,'2025-06-02 18:30:00',NULL),(89,6,2,10,'2025-06-02 18:55:00',NULL),(90,7,2,9,'2025-06-02 19:20:00','2025-06-02 19:57:00'),(91,9,10,2,'2025-06-02 19:45:00','2025-06-02 20:01:00'),(92,6,3,6,'2025-06-02 20:10:00','2025-06-02 20:26:00'),(93,10,1,9,'2025-06-02 20:35:00',NULL),(94,5,5,10,'2025-06-02 21:00:00',NULL),(95,3,1,1,'2025-06-02 21:25:00',NULL),(96,3,3,7,'2025-06-02 21:50:00','2025-06-02 22:11:00'),(97,2,2,2,'2025-06-02 22:15:00','2025-06-02 22:46:00'),(98,4,2,5,'2025-06-02 22:40:00','2025-06-02 23:35:00'),(99,7,2,5,'2025-06-02 23:05:00','2025-06-02 23:23:00'),(100,8,10,6,'2025-06-02 23:30:00',NULL),(101,8,4,9,'2025-06-02 23:55:00',NULL),(102,3,9,6,'2025-06-03 00:20:00','2025-06-03 00:55:00'),(103,3,1,3,'2025-06-03 00:45:00',NULL),(104,5,7,2,'2025-06-03 01:10:00',NULL),(105,8,6,7,'2025-06-03 01:35:00','2025-06-03 02:23:00'),(106,5,9,6,'2025-06-03 02:00:00',NULL),(107,3,5,7,'2025-06-03 02:25:00','2025-06-03 02:53:00'),(108,6,4,4,'2025-06-03 02:50:00','2025-06-03 03:48:00'),(109,1,7,7,'2025-06-03 03:15:00','2025-06-03 03:30:00'),(110,9,3,6,'2025-06-03 03:40:00',NULL),(111,2,9,1,'2025-06-03 04:05:00','2025-06-03 04:58:00'),(112,2,2,3,'2025-06-03 04:30:00',NULL),(113,10,9,9,'2025-06-03 04:55:00','2025-06-03 05:41:00'),(114,1,4,1,'2025-06-03 05:20:00','2025-06-03 06:05:00'),(115,10,1,6,'2025-06-03 05:45:00',NULL),(116,2,7,9,'2025-06-03 06:10:00',NULL),(117,4,7,5,'2025-06-03 06:35:00','2025-06-03 07:23:00'),(118,3,3,6,'2025-06-03 07:00:00',NULL),(119,2,4,5,'2025-06-03 07:25:00','2025-06-03 08:14:00'),(120,4,8,4,'2025-06-03 07:50:00','2025-06-03 08:37:00');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `precio` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Pizza Margarita','Pizza con tomate, queso y albahaca',25.50,10),(2,'Hamburguesa Clásica','Carne de res, lechuga, tomate y salsa',18.00,20),(3,'Ensalada César','Lechuga, pollo, queso y aderezo César',15.75,15),(4,'Spaghetti Boloñesa','Pasta con salsa de carne',22.30,12),(5,'Tacos de Pollo','Tortilla, pollo, cebolla y cilantro',12.50,25),(6,'Sushi Mix','Selección de sushi variado',30.00,8),(7,'Lomo Saltado','Carne de res, papas fritas y cebolla',24.00,10),(8,'Ceviche Clásico','Pescado, limón, cebolla y cilantro',20.00,18),(9,'Empanadas de Carne','Empanadas rellenas de carne y especias',14.50,30),(10,'Tequeños','Palitos de queso envueltos en masa',10.00,40);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos_menus`
--

DROP TABLE IF EXISTS `productos_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos_menus` (
  `menu_id` int NOT NULL,
  `producto_id` int NOT NULL,
  PRIMARY KEY (`menu_id`,`producto_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `productos_menus_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  CONSTRAINT `productos_menus_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos_menus`
--

LOCK TABLES `productos_menus` WRITE;
/*!40000 ALTER TABLE `productos_menus` DISABLE KEYS */;
INSERT INTO `productos_menus` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);
/*!40000 ALTER TABLE `productos_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promociones`
--

DROP TABLE IF EXISTS `promociones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promociones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promociones`
--

LOCK TABLES `promociones` WRITE;
/*!40000 ALTER TABLE `promociones` DISABLE KEYS */;
INSERT INTO `promociones` VALUES (1,'Combo Familiar',20.00,'2025-05-01','2025-05-31'),(2,'Descuento Verano',15.00,'2025-06-01','2025-06-30'),(3,'Happy Hour',10.00,'2025-05-14','2025-05-14'),(4,'Promo Fin de Semana',25.00,'2025-05-17','2025-05-18'),(5,'2x1 Postres',50.00,'2025-05-10','2025-05-20'),(6,'Descuento Estudiantes',30.00,'2025-05-01','2025-12-31'),(7,'Combo Sushi',10.00,'2025-05-05','2025-05-25'),(8,'Oferta Vegetariana',15.00,'2025-05-01','2025-05-31'),(9,'Especial de Tequeños',5.00,'2025-05-14','2025-05-14'),(10,'Promo Niños',40.00,'2025-05-01','2025-05-31');
/*!40000 ALTER TABLE `promociones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promociones_productos`
--

DROP TABLE IF EXISTS `promociones_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promociones_productos` (
  `promocion_id` int NOT NULL,
  `producto_id` int NOT NULL,
  PRIMARY KEY (`promocion_id`,`producto_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `promociones_productos_ibfk_1` FOREIGN KEY (`promocion_id`) REFERENCES `promociones` (`id`),
  CONSTRAINT `promociones_productos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promociones_productos`
--

LOCK TABLES `promociones_productos` WRITE;
/*!40000 ALTER TABLE `promociones_productos` DISABLE KEYS */;
INSERT INTO `promociones_productos` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);
/*!40000 ALTER TABLE `promociones_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mesa_id` int NOT NULL,
  `cliente` varchar(100) DEFAULT NULL,
  `fecha_reserva` datetime NOT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mesa_id` (`mesa_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`),
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (1,1,'Luis Fernández','2025-05-14 12:00:00',2),(2,2,'Ana Calderón','2025-05-15 13:30:00',3),(3,3,'Carlos Méndez','2025-05-16 19:00:00',1),(4,4,'Elena Gómez','2025-05-17 20:00:00',4),(5,5,'Jorge Ramírez','2025-05-18 18:45:00',5),(6,6,'Lucía Pérez','2025-05-19 12:15:00',6),(7,7,'Diego Santana','2025-05-20 14:00:00',7),(8,8,'Paula Ortiz','2025-05-21 15:30:00',8),(9,9,'Andrés Torres','2025-05-22 17:00:00',9),(10,10,'Carla Núñez','2025-05-23 19:30:00',10),(11,6,'Cliente_1','2025-06-01 10:30:00',8),(12,10,'Cliente_2','2025-06-01 11:00:00',4),(13,6,'Cliente_3','2025-06-01 11:30:00',1),(14,4,'Cliente_4','2025-06-01 12:00:00',8),(15,3,'Cliente_5','2025-06-01 12:30:00',4),(16,5,'Cliente_6','2025-06-01 13:00:00',1),(17,4,'Cliente_7','2025-06-01 13:30:00',4),(18,2,'Cliente_8','2025-06-01 14:00:00',4),(19,10,'Cliente_9','2025-06-01 14:30:00',9),(20,5,'Cliente_10','2025-06-01 15:00:00',2),(21,6,'Cliente_11','2025-06-01 15:30:00',7),(22,9,'Cliente_12','2025-06-01 16:00:00',4),(23,10,'Cliente_13','2025-06-01 16:30:00',1),(24,4,'Cliente_14','2025-06-01 17:00:00',1),(25,9,'Cliente_15','2025-06-01 17:30:00',10),(26,1,'Cliente_16','2025-06-01 18:00:00',7),(27,9,'Cliente_17','2025-06-01 18:30:00',6),(28,4,'Cliente_18','2025-06-01 19:00:00',6),(29,1,'Cliente_19','2025-06-01 19:30:00',8),(30,6,'Cliente_20','2025-06-01 20:00:00',1),(31,3,'Cliente_21','2025-06-01 20:30:00',7),(32,2,'Cliente_22','2025-06-01 21:00:00',6),(33,5,'Cliente_23','2025-06-01 21:30:00',6),(34,2,'Cliente_24','2025-06-01 22:00:00',9),(35,9,'Cliente_25','2025-06-01 22:30:00',10),(36,2,'Cliente_26','2025-06-01 23:00:00',6),(37,3,'Cliente_27','2025-06-01 23:30:00',3),(38,5,'Cliente_28','2025-06-02 00:00:00',7),(39,2,'Cliente_29','2025-06-02 00:30:00',3),(40,7,'Cliente_30','2025-06-02 01:00:00',3),(41,2,'Cliente_31','2025-06-02 01:30:00',7),(42,10,'Cliente_32','2025-06-02 02:00:00',7),(43,10,'Cliente_33','2025-06-02 02:30:00',1),(44,6,'Cliente_34','2025-06-02 03:00:00',7),(45,3,'Cliente_35','2025-06-02 03:30:00',1),(46,9,'Cliente_36','2025-06-02 04:00:00',4),(47,3,'Cliente_37','2025-06-02 04:30:00',4),(48,2,'Cliente_38','2025-06-02 05:00:00',6),(49,9,'Cliente_39','2025-06-02 05:30:00',4),(50,3,'Cliente_40','2025-06-02 06:00:00',10),(51,5,'Cliente_41','2025-06-02 06:30:00',2),(52,10,'Cliente_42','2025-06-02 07:00:00',7),(53,10,'Cliente_43','2025-06-02 07:30:00',6),(54,2,'Cliente_44','2025-06-02 08:00:00',6),(55,2,'Cliente_45','2025-06-02 08:30:00',7),(56,7,'Cliente_46','2025-06-02 09:00:00',7),(57,2,'Cliente_47','2025-06-02 09:30:00',8),(58,2,'Cliente_48','2025-06-02 10:00:00',7),(59,9,'Cliente_49','2025-06-02 10:30:00',4),(60,4,'Cliente_50','2025-06-02 11:00:00',5),(61,3,'Cliente_51','2025-06-02 11:30:00',1),(62,5,'Cliente_52','2025-06-02 12:00:00',9),(63,4,'Cliente_53','2025-06-02 12:30:00',8),(64,10,'Cliente_54','2025-06-02 13:00:00',1),(65,4,'Cliente_55','2025-06-02 13:30:00',10),(66,10,'Cliente_56','2025-06-02 14:00:00',6),(67,3,'Cliente_57','2025-06-02 14:30:00',3),(68,8,'Cliente_58','2025-06-02 15:00:00',5),(69,2,'Cliente_59','2025-06-02 15:30:00',1),(70,10,'Cliente_60','2025-06-02 16:00:00',5),(71,4,'Cliente_61','2025-06-02 16:30:00',3),(72,6,'Cliente_62','2025-06-02 17:00:00',6),(73,4,'Cliente_63','2025-06-02 17:30:00',6),(74,9,'Cliente_64','2025-06-02 18:00:00',1),(75,5,'Cliente_65','2025-06-02 18:30:00',7),(76,2,'Cliente_66','2025-06-02 19:00:00',2),(77,8,'Cliente_67','2025-06-02 19:30:00',4),(78,4,'Cliente_68','2025-06-02 20:00:00',1),(79,8,'Cliente_69','2025-06-02 20:30:00',10),(80,3,'Cliente_70','2025-06-02 21:00:00',1),(81,6,'Cliente_71','2025-06-02 21:30:00',4),(82,3,'Cliente_72','2025-06-02 22:00:00',4),(83,6,'Cliente_73','2025-06-02 22:30:00',8),(84,3,'Cliente_74','2025-06-02 23:00:00',4),(85,4,'Cliente_75','2025-06-02 23:30:00',9),(86,2,'Cliente_76','2025-06-03 00:00:00',5),(87,6,'Cliente_77','2025-06-03 00:30:00',8),(88,10,'Cliente_78','2025-06-03 01:00:00',2),(89,10,'Cliente_79','2025-06-03 01:30:00',8),(90,1,'Cliente_80','2025-06-03 02:00:00',8),(91,6,'Cliente_81','2025-06-03 02:30:00',8),(92,2,'Cliente_82','2025-06-03 03:00:00',1),(93,8,'Cliente_83','2025-06-03 03:30:00',3),(94,5,'Cliente_84','2025-06-03 04:00:00',4),(95,2,'Cliente_85','2025-06-03 04:30:00',2),(96,6,'Cliente_86','2025-06-03 05:00:00',10),(97,3,'Cliente_87','2025-06-03 05:30:00',10),(98,3,'Cliente_88','2025-06-03 06:00:00',6),(99,8,'Cliente_89','2025-06-03 06:30:00',6),(100,4,'Cliente_90','2025-06-03 07:00:00',3),(101,10,'Cliente_91','2025-06-03 07:30:00',2),(102,9,'Cliente_92','2025-06-03 08:00:00',10),(103,2,'Cliente_93','2025-06-03 08:30:00',7),(104,9,'Cliente_94','2025-06-03 09:00:00',4),(105,7,'Cliente_95','2025-06-03 09:30:00',7),(106,7,'Cliente_96','2025-06-03 10:00:00',9),(107,1,'Cliente_97','2025-06-03 10:30:00',4),(108,9,'Cliente_98','2025-06-03 11:00:00',7),(109,2,'Cliente_99','2025-06-03 11:30:00',4),(110,10,'Cliente_100','2025-06-03 12:00:00',8),(111,4,'Cliente_101','2025-06-03 12:30:00',9),(112,6,'Cliente_102','2025-06-03 13:00:00',9),(113,5,'Cliente_103','2025-06-03 13:30:00',4),(114,4,'Cliente_104','2025-06-03 14:00:00',10),(115,7,'Cliente_105','2025-06-03 14:30:00',3),(116,1,'Cliente_106','2025-06-03 15:00:00',10),(117,9,'Cliente_107','2025-06-03 15:30:00',4),(118,8,'Cliente_108','2025-06-03 16:00:00',6),(119,10,'Cliente_109','2025-06-03 16:30:00',5),(120,9,'Cliente_110','2025-06-03 17:00:00',7);
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(4,'Cajero'),(3,'Cocinero'),(2,'Mesero'),(5,'Repartidor');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Juan Pérez','juan.perez@rest.com','pass1',2),(2,'Ana López','ana.lopez@rest.com','pass2',3),(3,'Carlos Ruiz','carlos.ruiz@rest.com','pass3',1),(4,'Sofía García','sofia.garcia@rest.com','pass4',5),(5,'Pedro Fernández','pedro.fernandez@rest.com','pass5',2),(6,'Lucía Torres','lucia.torres@rest.com','pass6',2),(7,'Diego Soto','diego.soto@rest.com','pass7',3),(8,'Paula Mendoza','paula.mendoza@rest.com','pass8',3),(9,'Jorge Chávez','jorge.chavez@rest.com','pass9',4),(10,'Elena Ramos','elena.ramos@rest.com','pass10',5);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-21 21:55:49
