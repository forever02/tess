CREATE DATABASE  IF NOT EXISTS `tess_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tess_db`;
-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: tess_db
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `tbl_setting`
--

DROP TABLE IF EXISTS `tbl_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_setting` (
  `id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `longitude` double NOT NULL DEFAULT '0',
  `latitude` double NOT NULL DEFAULT '0',
  `bug_report` varchar(50) CHARACTER SET latin1 NOT NULL,
  `contact` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting`
--

LOCK TABLES `tbl_setting` WRITE;
/*!40000 ALTER TABLE `tbl_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `surname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `mobile` varchar(50) CHARACTER SET latin1 NOT NULL,
  `radius` double NOT NULL DEFAULT '1',
  `verify_code` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `administrator` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0',
  `start_date` date DEFAULT '2014-04-01',
  `end_date` date DEFAULT '2020-12-31',
  `device_token` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  KEY `surname` (`surname`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'adf','asdf','sdf','sdf',0,'sdf',0,1,'2014-04-01','2020-12-31',''),(17,'firstname','lastname','phone','email',3.5,'630c2f32f6a1c06a',0,1,'2014-04-01','2020-12-31',''),(12,'firstname','lastname','tesees','test',1,NULL,0,1,'2014-04-01','2020-12-31',''),(5,'1','2','3','4',5,'sedefe',0,1,'2014-04-01','2020-12-31',''),(6,'test','tee','','',1,NULL,0,1,'2014-04-01','2020-12-31',''),(7,'test','tee','','',1,NULL,0,1,'2014-04-01','2020-12-31',''),(10,'firstname','lastname','','',1,NULL,0,1,'2014-04-01','2020-12-31',''),(9,'Wilson','Champs-Elysees','','',1,NULL,0,1,'2014-04-01','2020-12-31',''),(13,'firstname','lastname','tesees','test',2.5,NULL,0,1,'2014-04-01','2020-12-31',''),(14,'firstname','lastname','phone','email',3.5,'71c1666d6740e20c',0,1,'2014-04-01','2020-12-31',''),(15,'sdfsdf','sdfs','sdsdfsd','email',3.5,'85be3db6896de39f',0,1,'2014-04-01','2020-12-31',''),(16,'sdfsdf','sdfs','sdsdfsd','email',3.523,'994e33d34f18544b',0,0,'2014-04-01','2020-12-31',''),(18,'firstname','lastname','mobile','email',3.5,'1d475035b4a2e9aa',0,0,'2014-04-01','2020-12-31',''),(19,'firstname','lastname','mobile','email',5,'7ae352c6370ad00b',0,0,'2014-04-01','2020-12-31',''),(20,'firstname','lastname','mobile','email',5,'8b4b28781e250488',0,0,'2014-04-01','2020-12-31',''),(21,'firstname','lastname','mobile','email',3.5,'1e631b607db82cc0',0,0,'2014-04-01','2020-12-31',''),(24,'firstname','lastname','email','mobile',3.5,'e09193a2361d88e6',0,1,'2014-04-01','2020-12-31',''),(25,'firstname1','lastname1','email1','mobile1',3.5,'290a97a50e2f8e67',0,1,'2014-04-01','2020-12-31',''),(26,'firstname122','lastname122','email122','mobile1',3.5,'bd05aee7973a7fa8',0,1,'2014-04-01','2020-12-31',''),(27,'a','b','c','5',0,'e08c03e5547facc8',0,1,'2014-04-01','2020-12-31',''),(28,'a','b','csdfsdfsdf','5',1600,'4b51e0fd9e99d21b',0,1,'2014-04-01','2020-12-31',''),(29,'aa','bb','ascsdfsdfsdf','5',800,'91b62974eb4daaed',0,1,'2014-04-01','2020-12-31',''),(30,'aqq','bqq','cqq','544',800,'0829cbfb17b35049',0,1,'2014-04-01','2020-12-31',''),(31,'ab','bb','cd','566',1200,'c44a330a57a2fb74',0,1,'2014-04-01','2020-12-31',''),(32,'s','mh','a@a.com','12345',100,'07a3e77ed828f83f',0,1,'2014-04-01','2020-12-31',''),(33,'aa','bb','cdf','5125',400,'7026c14f2819b35d',0,1,'2014-04-01','2020-12-31',''),(34,'aa','bv','cv','533',1200,'eb6832ab41b3041e',0,1,'2014-04-01','2020-12-31',''),(35,'ae','bgg','cfg','55698',400,'05b1f8ef711d3090',0,1,'2014-04-01','2020-12-31',''),(36,'Test','B','c@a.com','123456',400,'6495bbf198b6f35d',0,1,'2014-04-01','2020-12-31','');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-22 13:08:15
