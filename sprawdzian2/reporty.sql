-- MySQL dump 10.13  Distrib 5.7.21, for Linux (i686)
--
-- Host: localhost    Database: reporty
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.17.10.1

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` int(11) DEFAULT NULL,
  `content` text,
  `parent_comment` int(11) DEFAULT NULL,
  `complaint_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `complaintid` (`complaint_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,2,1504959474,'Ktos usunął system, zainstalowano linuxa',NULL,2),(2,3,1502812412,'Gniazdko założone ponownie, nie znaleziono przebicia...',NULL,2),(3,3,1509183640,' Poraziło mnie! Kto Ci dawał SEPY?!',2,4),(4,3,1507480964,'Teraz dostaniecie linuxa',NULL,3),(5,3,1509853902,'Dziwne, u mnie działa',NULL,6),(6,3,1506826617,'Aktualnie mamy braki papieru',NULL,11),(7,2,1504571380,'Aktualnie nie stać nas na licencje na VISIO',NULL,7),(8,1,1502377049,'VISIO MUSI BYĆ',7,6),(9,5,1502378049,'precz z visio',8,6),(10,1,1502379049,'ma byc i ...',9,6);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `note` text,
  `photos` text,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `type` (`type`),
  CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `complaints_ibfk_2` FOREIGN KEY (`type`) REFERENCES `complainttypes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
INSERT INTO `complaints` VALUES (1,3,'Nie działa rzutnik  w sali 021',NULL,3,2,1508171104),(2,1,'Komputer w bibliotece się cały czas resetuje',NULL,1,5,1503724372),(3,3,'ZAINSTALOWAŁ SIEE WIND0WSF 10!!!!!! RARUNKU',NULL,2,2,1504108552),(4,3,'Gniazdko wyrwane ze ściany, na kaloryferze jest przebicie i razi prądem uczniów',NULL,3,6,1509369641),(5,1,'Zapomniałam hasła do dzienniczka',NULL,5,5,1504522551),(6,6,'Ktoś zablokował mi dzienniczek, nie mogę się zalogować',NULL,2,2,1504503832),(7,6,'Proszę o doinstalowanie VIŚIO w sali 018',NULL,3,3,1508951509),(8,9,'Komputery dzialaja 2 razy wolniej niz poprzednio',NULL,2,2,1501246047),(9,9,'Karty sieciowe nie dzialaja, brak sterownikow',NULL,2,6,1509375709),(10,9,'Karty sieciowe nie dzialaja, brak sterownikow',NULL,1,6,1503140405),(11,7,'Drukarka nie ma papieru',NULL,2,4,1507574896);
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaintstatuses`
--

DROP TABLE IF EXISTS `complaintstatuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaintstatuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaintstatuses`
--

LOCK TABLES `complaintstatuses` WRITE;
/*!40000 ALTER TABLE `complaintstatuses` DISABLE KEYS */;
INSERT INTO `complaintstatuses` VALUES (1,'closed','Zamknięte'),(2,'new','Nowe'),(3,'consideration','Rozpatrywanie'),(4,'accepted','Zaakceptowane'),(5,'done','Zrobione'),(6,'rejected','Odrzucone'),(7,'later','Do rozpatrzenia później'),(8,'laterlater','Do rozpatrzenia w dalekiej przyszłości'),(9,'fromAdmin','Tylko dla admina'),(10,'waitingForSupplies','Oczekiwanie na dostarczenie towaru');
/*!40000 ALTER TABLE `complaintstatuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complainttypes`
--

DROP TABLE IF EXISTS `complainttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complainttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complainttypes`
--

LOCK TABLES `complainttypes` WRITE;
/*!40000 ALTER TABLE `complainttypes` DISABLE KEYS */;
INSERT INTO `complainttypes` VALUES (1,'network','Awaria siecowa'),(2,'hardware','Awaria sprzętowa'),(3,'software','Awaria oprogramowania'),(4,'electricity','Awarie elektryczne'),(5,'accounts','Awaria z kontami'),(6,'permissions','Problem z uprawnieniami'),(7,'equipment','Problem z wyposażenim'),(8,'projector','Problem z projektorem'),(9,'activeDirectory','Problem z Active Directory'),(10,'cable','Problem z okablowaniem');
/*!40000 ALTER TABLE `complainttypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `permissions` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Administrator','<span style=\"font-weight: bold; color:red\">','</span>','{\"canSeeReports\":1,\"canEditReports\":1,\"canMakeReports\":1,\"canChangeReportState\":1,\"canDeleteReport\":1)'),(2,'Moderator','<span style=\"color:green\">','</span>','{\"canSeeReports\":1,\"canEditReports\":1,\"canMakeReports\":1,\"canChangeReportState\":1,\"canDeleteReport\":1)'),(3,'Zbanowany','<s>','</s>','{\"canSeeReports\":0,\"canEditReports\":0,\"canMakeReports\":0,\"canChangeReportState\":0,\"canDeleteReport\":0)'),(4,'Użytkownik','','','{\"canSeeReports\":1,\"canEditReports\":0,\"canMakeReports\":1,\"canChangeReportState\":0,\"canDeleteReport\":0)'),(5,'Gość','','','{\"canSeeReports\":1,\"canEditReports\":0,\"canMakeReports\":0,\"canChangeReportState\":0,\"canDeleteReport\":0)');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `submodule` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `translation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES (1,'core','core','reports','Zgłoszenia'),(2,'core','core','show_reports','Zobacz zgłoszenia'),(3,'forms','reportForm','title','Zgłoś błąd'),(4,'forms','reportForm','formTitle','Formularz zgłaszania błędów'),(5,'cp','acp','markAsDone','Oznacz jako rozpatrzone'),(6,'cp','acp','markAsRejected','Oznacz jako odrzucone'),(7,'cp','acp','markAsUnderConsideration','Oznacz jako rozpatrywane'),(8,'cp','acp','delete','Usuń zgłoszenie'),(9,'cp','acp','hide','Ukryj zgłoszenie'),(10,'cp','acp','unhide','Odkryj zgłoszenie');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `passwd` char(60) NOT NULL,
  `group_id` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'janusz.tracz@gmail.com','czart666','$2a$04$.Lexzjp3qJqH/eJkDDjyDeFFYZ.c.gCnp0tGsLvHQ0Ph7y/tz3ZMa',4,'https://i.imgur.com/lFwcwzK.jpg'),(2,'ljkng23@gmail.com','sneakyBeach','$2a$04$FmzBOYZqcNwVYvCvaWYo.ueSvlG.tUWiLpOhjv.O6Jy7MUlAdtJ66',1,'https://avatarfiles.alphacoders.com/858/85882.jpg'),(3,'idontwanttoliveonthisplanetanymore@gmail.com','Nagaide','$2a$04$UtAg7XkxgtyJQiW3D0vuc.X.jhJT/CJTD66ucgXP4M1kPSDKkRvPy',2,'https://www.mpcforum.pl/uploads/profile/photo-847314.png'),(4,'DorothyJHargrove@jourrapide.com','Moseloway','$2a$04$UtAg7XkxgtyJQiW3D0vuc.X.jhJT/CJTD66ucgXP4M1kPSDKkRvPy',3,'https://avatarfiles.alphacoders.com/700/70031.gif'),(5,'MalgorzataGrabowska@rhyta.com ','Rambeens64','$2a$04$UtAg7XkxgtyJQiW3D0vuc.X.jhJT/CJTD66ucgXP4M1kPSDKkRvPy',4,'https://www.fluentin3months.com/wp-content/forum-avatars/1310038006homer-simpson.jpg'),(6,'MargaretWRodriguez@jourrapide.com ','Prectiony','$2a$04$UtAg7XkxgtyJQiW3D0vuc.X.jhJT/CJTD66ucgXP4M1kPSDKkRvPy',2,'https://avatarfiles.alphacoders.com/700/70031.gif'),(7,'AugustynaKaczmarek@teleworm.us ','Hattond','$2a$04$UtAg7XkxgtyJQiW3D0vuc.X.jhJT/CJTD66ucgXP4M1kPSDKkRvPy',4,'https://thumb1.shutterstock.com/display_pic_with_logo/633283/702811219/stock-vector-user-avatar-icon-in-doodle-sketch-lines-social-media-blog-forum-group-internet-connection-teamwork-702811219.jpg'),(8,'DominikaMajewska@jourrapide.com ','Yeartat','$2a$04$UtAg7XkxgtyJQiW3D0vuc.X.jhJT/CJTD66ucgXP4M1kPSDKkRvPy',4,'http://juicebubble.co.za/wp-content/uploads/2015/02/heisenberg-grey.png'),(9,'TeklaBorkowska@dayrep.com ','Lasurged','$2a$04$UtAg7XkxgtyJQiW3D0vuc.X.jhJT/CJTD66ucgXP4M1kPSDKkRvPy',3,'https://www.resetera.com/data/avatars/l/0/835.jpg?1518971392'),(10,'office@zsl.poznan.pl','zsl','$2a$04$TdJmBylDxkyBZ8dctt/0Fe3OxdN2jEHNhmzcNruU6DGEf7nf.S3T6',3,'https://zslpoznan.mobidziennik.pl/grafika/mobilna.png');
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

-- Dump completed on 2018-03-23 14:17:04
