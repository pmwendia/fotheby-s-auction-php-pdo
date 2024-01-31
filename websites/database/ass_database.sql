-- MariaDB dump 10.17  Distrib 10.4.15-MariaDB, for Linux (x86_64)
--
-- Host: mysql    Database: 
-- ------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('AdminTestTest','AdminTestTest@example.com','$2y$10$.fA6fGoS15wYZX5eT.6LgOx22U7dwcVca4CpRJ237EtkYZ/cdxO8u','AdminTest','Test'),('JaneDoe','JaneDoe@Fothebys.co.uk','$2y$10$DCauCt6iICIWs0ZrOEuy3OUH3JLmeuni0riL3Orva65FG4VOMyTB2','Jane','Doe'),('JohnDoe','JohnDoe@Fothebys.co.uk','$2y$10$jSR99jk01R/A7T/WrWHzo.9Qx3L0Cm7iGGXPeyAqimIOskoStqOJW','John','Doe');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `dob` date NOT NULL,
  `level` char(2) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Poorvaja','Sathasivam','admin@news.com','letmein','1996-08-02',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `lotReference` int(6) NOT NULL AUTO_INCREMENT,
  `pieceTitle` varchar(45) NOT NULL,
  `pieceDescription` varchar(500) NOT NULL,
  `categoryId` varchar(45) NOT NULL,
  `auctionDate` varchar(20) NOT NULL,
  `imageName` longblob NOT NULL,
  `collectionTitle` varchar(500) NOT NULL,
  `lotNumber` int(6) NOT NULL,
  `dateOfProduction` int(4) NOT NULL,
  `estimate` varchar(45) NOT NULL,
  `dimensions` varchar(45) DEFAULT NULL,
  `auctionPeriod` varchar(45) DEFAULT NULL,
  `framed` varchar(45) DEFAULT NULL,
  `artist` varchar(45) DEFAULT NULL,
  `material` varchar(45) DEFAULT NULL,
  `pieceWeight` varchar(45) DEFAULT NULL,
  `medium` varchar(45) DEFAULT NULL,
  `pieceType` varchar(45) DEFAULT NULL,
  `locationId` varchar(45) NOT NULL,
  PRIMARY KEY (`lotReference`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (21,'Natural World Piece 1',' A stained Maple Frame with traditional Oil Painting on Canvas.','Paintings','25/01/2023','s-l500.jpg','A Natural World',1,2006,'6000','','Afternoon','Maple','Teresa Green','','','Oil','','London');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auctionPeriods`
--

DROP TABLE IF EXISTS `auctionPeriods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auctionPeriods` (
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auctionPeriods`
--

LOCK TABLES `auctionPeriods` WRITE;
/*!40000 ALTER TABLE `auctionPeriods` DISABLE KEYS */;
INSERT INTO `auctionPeriods` VALUES ('Afternoon'),('Morning');
/*!40000 ALTER TABLE `auctionPeriods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `pieceId` int(11) NOT NULL AUTO_INCREMENT,
  `pieceTitle` varchar(45) NOT NULL,
  `dateOfPiece` varchar(45) DEFAULT NULL,
  `condition` varchar(45) NOT NULL,
  `estimate` varchar(45) DEFAULT NULL,
  `itemDescription` varchar(45) NOT NULL,
  `artist` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pieceId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;

UNLOCK TABLES;

--
-- Table structure for table `buyerApproval`
--

DROP TABLE IF EXISTS `buyerApproval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buyerApproval` (
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buyerApproval`
--

LOCK TABLES `buyerApproval` WRITE;
/*!40000 ALTER TABLE `buyerApproval` DISABLE KEYS */;
INSERT INTO `buyerApproval` VALUES ('No'),('Unknown'),('Yes');
/*!40000 ALTER TABLE `buyerApproval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES ('Carvings'),('Drawings'),('Paintings'),('Photographic Images'),('Sculptures');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientStatus`
--

DROP TABLE IF EXISTS `clientStatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientStatus` (
  `name` varchar(12) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientStatus`
--

LOCK TABLES `clientStatus` WRITE;
/*!40000 ALTER TABLE `clientStatus` DISABLE KEYS */;
INSERT INTO `clientStatus` VALUES ('Buyer'),('Joint'),('Seller');
/*!40000 ALTER TABLE `clientStatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collections`
--

DROP TABLE IF EXISTS `collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collections` (
  `name` varchar(35) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collections`
--

LOCK TABLES `collections` WRITE;
/*!40000 ALTER TABLE `collections` DISABLE KEYS */;
INSERT INTO `collections` VALUES ('A Natural World'),('Black and White Struggles'),('Condescending Minds'),('Upcoming Young Artists');
/*!40000 ALTER TABLE `collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `commentID` int(6) NOT NULL AUTO_INCREMENT,
  `commentContent` varchar(45) DEFAULT NULL,
  `articleId` int(6) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`commentID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,' Test Comment',16,'TestHash@example.com',NULL),(2,' Stock category comment',10,'TestHash@example.com',NULL),(6,' Test comment',2,'TestHash@example.com',NULL),(7,' Test Comment Alex',10,'AlexFisher@example.com',NULL),(8,' Test Comment Alex',11,'AlexFisher@example.com',NULL),(9,' Sandra Test Comment',7,'SandraSmith@example.com',NULL),(10,' Sandra Test Comment',8,'SandraSmith@example.com',NULL);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emailTemplates`
--

DROP TABLE IF EXISTS `emailTemplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emailTemplates` (
  `name` varchar(40) NOT NULL,
  `mainContent` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emailTemplates`
--

LOCK TABLES `emailTemplates` WRITE;
/*!40000 ALTER TABLE `emailTemplates` DISABLE KEYS */;
INSERT INTO `emailTemplates` VALUES ('Appraisal Rejected','Dear [User], We are sorry to inform you that your item [Item Name] has been denied. This is because [Denial Reason]. Please Contact us to arrange the return of your item. Thank You for Using Our Service at Fotheby\'s '),('Item has been listed at Auction','Dear [User], We are happy to inform you that your item [Item Name] has been listed as part of the [Collection Title] collection. This will take place in [Location], at [Date], in the [Acution Period] session. Please let us know if you need anymore details. Thank you for listing your item with us from all at Fotheby\'s'),('New User Accepted ','Dear [User], We are happy to inform you that your Account has been created. We are looking forward to working with you in the future. You can access our latest collections on our website. Please contact us if you need anymore details.');
/*!40000 ALTER TABLE `emailTemplates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emailTemplatesCategory`
--

DROP TABLE IF EXISTS `emailTemplatesCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emailTemplatesCategory` (
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emailTemplatesCategory`
--

LOCK TABLES `emailTemplatesCategory` WRITE;
/*!40000 ALTER TABLE `emailTemplatesCategory` DISABLE KEYS */;
INSERT INTO `emailTemplatesCategory` VALUES ('Appraisal Rejected '),('Auction Details (Coming Soon)'),('Important Update (Coming Soon)'),('Item Accepted at Auction (Coming Soon)'),('Item has been listed at Auction'),('New User Accepted '),('New User Denial (Coming Soon)'),('Seat Booking Accepted (Coming Soon)'),('Seat Booking Denial (Coming Soon)'),('Succesful Purchase (Coming Soon)');
/*!40000 ALTER TABLE `emailTemplatesCategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `name` varchar(35) NOT NULL DEFAULT 'London',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES ('London'),('New York'),('Paris');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `idsales` int(11) NOT NULL AUTO_INCREMENT,
  `lotNumber` varchar(45) NOT NULL,
  `pieceTitle` varchar(45) NOT NULL,
  `commissionBids` varchar(500) DEFAULT NULL,
  `reservePrice` varchar(20) DEFAULT NULL,
  `sold` varchar(45) NOT NULL,
  `price` varchar(20) NOT NULL,
  `clientEmail` varchar(45) NOT NULL,
  `auctionComments` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idsales`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (3,'02','Natural World Piece 2','','','Yes','£20000','TEST',' Piece Test Sale, This should show in customer account');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salesYesNo`
--

DROP TABLE IF EXISTS `salesYesNo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salesYesNo` (
  `name` varchar(4) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salesYesNo`
--

LOCK TABLES `salesYesNo` WRITE;
/*!40000 ALTER TABLE `salesYesNo` DISABLE KEYS */;
INSERT INTO `salesYesNo` VALUES ('No'),('Yes');
/*!40000 ALTER TABLE `salesYesNo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seatBookingRequests`
--

DROP TABLE IF EXISTS `seatBookingRequests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seatBookingRequests` (
  `bookingID` int(11) NOT NULL AUTO_INCREMENT,
  `collectionTitle` varchar(45) NOT NULL,
  `location` varchar(45) NOT NULL,
  `clientEmail` varchar(45) NOT NULL,
  `considerations` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`bookingID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seatBookingRequests`
--

LOCK TABLES `seatBookingRequests` WRITE;
/*!40000 ALTER TABLE `seatBookingRequests` DISABLE KEYS */;
INSERT INTO `seatBookingRequests` VALUES (2,'A Natural World','London','OOO','0OLO0OL');
