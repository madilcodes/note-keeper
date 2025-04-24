-- MySQL dump 10.14  Distrib 5.5.68-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: curdyt
-- ------------------------------------------------------
-- Server version	5.5.68-MariaDB

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
-- Table structure for table `Customer_Orders`
--

DROP TABLE IF EXISTS `Customer_Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Customer_Orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `house_number` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `landmark` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `stores` varchar(100) DEFAULT NULL,
  `pulses` varchar(100) DEFAULT NULL,
  `oils` varchar(100) DEFAULT NULL,
  `kitchens` varchar(100) DEFAULT NULL,
  `snacks` varchar(100) DEFAULT NULL,
  `drinks` varchar(50) DEFAULT NULL,
  `breakfast_cereals` varchar(100) DEFAULT NULL,
  `dairy` varchar(100) DEFAULT NULL,
  `household_care` varchar(100) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `agent` varchar(30) NOT NULL DEFAULT '',
  `order_status` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customer_Orders`
--

LOCK TABLES `Customer_Orders` WRITE;
/*!40000 ALTER TABLE `Customer_Orders` DISABLE KEYS */;
INSERT INTO `Customer_Orders` VALUES (1,'mohd adil','mohdadil67719@gmail.com','9603085825','17-3-301/784 sri sampada bulilding ','madhapur','500521','beside kasariya sweet shop','hyderabad','Telangana','D Mart','Toovar dal','Blended Oil','Cookware & Non-Stick','Cream Biscuits','Glucose','Noodles','Paneer & Tofu','Toilet Paper','2024-03-19 04:27:45','adil','delivered'),(2,'nick','nick@gmail.com','765869798','12-31-123 james street','losangels','8767','near towers','paries','paries capital','D Mart','','','','','','','','','2025-04-21 10:44:30','harish','');
/*!40000 ALTER TABLE `Customer_Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_details`
--

DROP TABLE IF EXISTS `admin_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_details` (
  `sno` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `phone_number` varchar(15) NOT NULL DEFAULT '0',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_details`
--

LOCK TABLES `admin_details` WRITE;
/*!40000 ALTER TABLE `admin_details` DISABLE KEYS */;
INSERT INTO `admin_details` VALUES (1,'admin','adil@123','adil@dev.deepijatel.com','7330066083','2024-07-29 07:13:00','2024-11-01 09:59:31');
/*!40000 ALTER TABLE `admin_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_messages`
--

DROP TABLE IF EXISTS `admin_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `agent_name` varchar(20) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_messages`
--

LOCK TABLES `admin_messages` WRITE;
/*!40000 ALTER TABLE `admin_messages` DISABLE KEYS */;
INSERT INTO `admin_messages` VALUES (1,'admin','hello adil','adil','2024-03-05 06:04:09'),(2,'admin','hii','adil','2024-03-19 09:45:30'),(3,'admin','good','mohd','2024-08-27 13:00:26'),(4,'admin','hello','adil','2024-08-27 13:00:36'),(5,'admin','hi','','2024-08-27 13:00:47'),(6,'admin','hello harish','harish','2025-04-21 10:37:05');
/*!40000 ALTER TABLE `admin_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coffee_orders`
--

DROP TABLE IF EXISTS `coffee_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coffee_orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `coffee_type` varchar(30) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  `sugar` varchar(25) DEFAULT NULL,
  `customer_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coffee_orders`
--

LOCK TABLES `coffee_orders` WRITE;
/*!40000 ALTER TABLE `coffee_orders` DISABLE KEYS */;
INSERT INTO `coffee_orders` VALUES (3,'espresso',116,0,'No-sugar','adil','mohdadil67719@gmail.com',1,'2024-03-15 06:23:42');
/*!40000 ALTER TABLE `coffee_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_complaints`
--

DROP TABLE IF EXISTS `customer_complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_complaints` (
  `comp_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_complaints`
--

LOCK TABLES `customer_complaints` WRITE;
/*!40000 ALTER TABLE `customer_complaints` DISABLE KEYS */;
INSERT INTO `customer_complaints` VALUES (1,'adil','mohdadil67719@gmail.com','7887876867','https://ai.pulsehrm.com/ords/f?p=120:611:10199523723734:::::','https://chat.openai.com/c/05e12587-6114-49fc-85e7-05dd86a967f3','2024-03-08 05:59:16');
/*!40000 ALTER TABLE `customer_complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_registrations`
--

DROP TABLE IF EXISTS `customer_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_registrations` (
  `custo_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `subscribe` varchar(2) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`custo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_registrations`
--

LOCK TABLES `customer_registrations` WRITE;
/*!40000 ALTER TABLE `customer_registrations` DISABLE KEYS */;
INSERT INTO `customer_registrations` VALUES (1,'mohammed','Adil','mohdadil67719@gmail.com','1234','Y','2024-03-15 07:14:51'),(2,'adil','adil','adil@dev.deepijatel.com','adil1234','N','2024-03-15 07:15:29'),(3,'nick','jones','nick@gmail.com','nick123','Y','2024-11-09 15:20:37');
/*!40000 ALTER TABLE `customer_registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_logins`
--

DROP TABLE IF EXISTS `customers_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_logins` (
  `sno` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_logins`
--

LOCK TABLES `customers_logins` WRITE;
/*!40000 ALTER TABLE `customers_logins` DISABLE KEYS */;
INSERT INTO `customers_logins` VALUES (1,'mohdadil67719@gmail.com','1234','2024-03-15 09:47:58'),(2,'mohdadil67719@gmail.com','1234','2024-03-19 04:14:32'),(3,'mohdadil67719@gmail.com','1234','2024-03-19 04:16:57'),(4,'nick@gmail.com','nick123','2024-11-09 15:21:28');
/*!40000 ALTER TABLE `customers_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_details`
--

DROP TABLE IF EXISTS `login_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_details` (
  `sno` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `event` varchar(25) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_details`
--

LOCK TABLES `login_details` WRITE;
/*!40000 ALTER TABLE `login_details` DISABLE KEYS */;
INSERT INTO `login_details` VALUES (3,'harish','1234','LOGOUT','2025-04-23 13:13:49','2025-04-23 13:14:24');
/*!40000 ALTER TABLE `login_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_details_log`
--

DROP TABLE IF EXISTS `login_details_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_details_log` (
  `sno` int(10) NOT NULL DEFAULT '0',
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `event` varchar(25) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logout_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_details_log`
--

LOCK TABLES `login_details_log` WRITE;
/*!40000 ALTER TABLE `login_details_log` DISABLE KEYS */;
INSERT INTO `login_details_log` VALUES (1,'agent','agent1','LOGOUT','2025-01-16 09:26:26','2025-01-16 09:53:34'),(2,'agent','agent123','LOGOUT','2025-01-16 09:47:38','2025-01-16 09:53:34'),(3,'adil','1234','LOGOUT','2025-01-16 09:58:41','2025-01-16 10:01:07'),(1,'harish','1234','LOGOUT','2025-04-21 10:36:19','2025-04-21 10:45:13'),(2,'harish','1234','LOGOUT','2025-04-21 10:46:30','2025-04-21 10:46:38');
/*!40000 ALTER TABLE `login_details_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration_details`
--

DROP TABLE IF EXISTS `registration_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration_details` (
  `registration_id` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL,
  `ConfirmPassword` varchar(25) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `state` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `profile_pic` varchar(255) DEFAULT 'default.jpg',
  `Services` varchar(50) NOT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`registration_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration_details`
--

LOCK TABLES `registration_details` WRITE;
/*!40000 ALTER TABLE `registration_details` DISABLE KEYS */;
INSERT INTO `registration_details` VALUES (1,'adil','adil@dev.deepijatel.com','1234','1234','7330066083','Male','Telangana','Hyderabad','adil_1736923885.png','Front-End Development','hello','2025-01-15 06:51:25'),(2,'mohd','mohd@gmail.com','1212','1212','9876453622','Male','Telangana','hyderabad','mohd_1728393772.jpg','Data Science','need software..','2024-10-08 13:22:52'),(3,'md','md@gmail.com','1234','1234','7687979798','Male','Telangana','','default.jpg','','','2024-07-26 11:19:05'),(4,'agent','agent@gmail.com','Agent123','Agent123','9898877878','Others','Telangana','Hyderbad','agent_1737021054.png','Desktop Development','','2025-01-16 09:50:54'),(5,'harish','harish@gmail.com','1234','1234','9883439934','Male','chhattigarh ','raipur ','default.jpg','Desktop Development','','2025-04-21 10:38:24');
/*!40000 ALTER TABLE `registration_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `sno` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `mobile_number` varchar(30) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'adil','mohdadil67719@gmail.com','7330066083','7249','2025-03-06 07:57:52');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_complaints`
--

DROP TABLE IF EXISTS `users_complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_complaints` (
  `sno` int(20) NOT NULL AUTO_INCREMENT,
  `agent_name` varchar(25) NOT NULL,
  `message` varchar(255) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_complaints`
--

LOCK TABLES `users_complaints` WRITE;
/*!40000 ALTER TABLE `users_complaints` DISABLE KEYS */;
INSERT INTO `users_complaints` VALUES (1,'adil','hello world','2024-03-05 09:26:10'),(2,'adil','complaits not showing.','2024-03-15 06:32:19'),(3,'convox12','testingg','2024-03-19 09:44:41'),(4,'adil','testing','2024-08-01 09:48:09'),(5,'adil','123','2024-08-27 13:08:36'),(6,'agent','testing','2025-01-16 09:51:58');
/*!40000 ALTER TABLE `users_complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_messages`
--

DROP TABLE IF EXISTS `users_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_messages` (
  `message_id` int(10) NOT NULL AUTO_INCREMENT,
  `agent_name` varchar(25) NOT NULL,
  `message` varchar(255) NOT NULL,
  `flag` int(2) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_messages`
--

LOCK TABLES `users_messages` WRITE;
/*!40000 ALTER TABLE `users_messages` DISABLE KEYS */;
INSERT INTO `users_messages` VALUES (1,'adil','hiii',1,'2024-03-05 06:04:09'),(2,'mohd','hi good morning sir.',1,'2024-08-27 13:00:26'),(3,'adil','adfgsfsd',1,'2024-03-19 09:45:30'),(4,'adil','hello',1,'2024-08-27 13:00:36'),(5,'','adil adil',1,'2024-08-27 13:00:47'),(6,'','testing',1,'2024-08-27 13:00:47'),(7,'','hi good morning mohd',1,'2024-08-27 13:00:47'),(8,'','hi md',1,'2024-08-27 13:00:47'),(9,'adil','hello adil',1,'2024-08-27 13:00:36'),(10,'mohd','hii',1,'2024-08-27 13:00:26'),(11,'mohd','hello',1,'2024-08-27 13:00:26'),(12,'mohd','hi',1,'2024-08-27 13:00:26'),(13,'agent','hi sir',0,'2025-01-16 09:26:36'),(14,'harish','hi sir\r\n',1,'2025-04-21 10:37:05');
/*!40000 ALTER TABLE `users_messages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-24 13:03:57
