-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: class_schedule
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructor` (
  `instructor_id` varchar(10) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`instructor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor`
--

LOCK TABLES `instructor` WRITE;
/*!40000 ALTER TABLE `instructor` DISABLE KEYS */;
INSERT INTO `instructor` VALUES ('21121876','Williams','Robert','Christopher','rcwilliams1876@instructor.dmmmsu.edu.ph'),('21123987','Smith','John','David','jdsmith3987@instructor.dmmmsu.edu.ph'),('21124567','Johnson','Jane','Michael','jmjohnson4567@instructor.dmmmsu.edu.ph'),('21127643','Miller','Elizabeth','Ann','eamiller7643@instructor.dmmmsu.edu.ph'),('21127654','Brown','Mary','Elizabeth','mebrown7654@instructor.dmmmsu.edu.ph'),('21127698','Garcia','Maria','Isabel','migarcia7698@instructor.dmmmsu.edu.ph'),('21127890','Davis','Michael','Joseph','mjdavis7890@instructor.dmmmsu.edu.ph'),('21128735','Jones','William','Thomas','wtjones8765@instructor.dmmmsu.edu.ph'),('21128765','Martinez','Jose','Antonio','jamartinez8765@instructor.dmmmsu.edu.ph'),('21128876','Hernandez','Ana','Gabriela','aghernandez8876@instructor.dmmmsu.edu.ph'),('21234876','Anderson','David','Richard','dranderson4876@instructor.dmmmsu.edu.ph'),('21245678','Williams','Emily','Nicole','enwilliams5678@instructor.dmmmsu.edu.ph'),('21257689','Thompson','Michael','William','mwthompson7689@instructor.dmmmsu.edu.ph'),('21268907','Johnson','Emma','Grace','egjohnson8907@instructor.dmmmsu.edu.ph'),('21275678','Brown','Christopher','Daniel','cdbrown5678@instructor.dmmmsu.edu.ph'),('21284567','Martinez','Sophia','Isabella','sismartinez4567@instructor.dmmmsu.edu.ph'),('21298165','Taylor','Andrew','Jacob','ajtaylor8765@instructor.dmmmsu.edu.ph'),('21307654','Garcia','Olivia','Ava','oagarcia7654@instructor.dmmmsu.edu.ph'),('21318865','Hernandez','Joshua','Nathan','jnhernandez8765@instructor.dmmmsu.edu.ph'),('21327654','Jones','Liam','Ethan','ljeones7654@instructor.dmmmsu.edu.ph'),('21334876','Smith','Amelia','Charlotte','acsmith4876@instructor.dmmmsu.edu.ph'),('21345678','Miller','Daniel','Joseph','djmillerr5678@instructor.dmmmsu.edu.ph'),('21357689','Davis','Sophia','Ella','sedavis7689@instructor.dmmmsu.edu.ph'),('21368907','Wilson','Ethan','Mason','ewilson8907@instructor.dmmmsu.edu.ph'),('21375678','Lopez','Mia','Avery','malopez5678@instructor.dmmmsu.edu.ph'),('21384567','Gonzalez','Elijah','Logan','elgonzalez4567@instructor.dmmmsu.edu.ph'),('21398365','Harris','Madison','Evelyn','meharris8765@instructor.dmmmsu.edu.ph'),('21407654','Clark','Alexander','Sebastian','asclark7654@instructor.dmmmsu.edu.ph'),('21418965','Young','Abigail','Harper','ayoung8765@instructor.dmmmsu.edu.ph'),('21427654','Lewis','Jayden','William','jwlewis7654@instructor.dmmmsu.edu.ph'),('21434876','Hall','Chloe','Natalie','cchall4876@instructor.dmmmsu.edu.ph'),('21445678','King','Benjamin','Elijah','beking5678@instructor.dmmmsu.edu.ph'),('21457689','Allen','Zoey','Riley','zrallen7689@instructor.dmmmsu.edu.ph'),('21468907','Scott','Carter','Dylan','ccscott8907@instructor.dmmmsu.edu.ph'),('21475678','Walker','Samuel','Henry','swhwalker5678@instructor.dmmmsu.edu.ph');
/*!40000 ALTER TABLE `instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `room_id` varchar(25) NOT NULL,
  `room_type` varchar(10) NOT NULL,
  `priority` int(10) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES ('CLR101','Laboratory',5),('CLR102','Laboratory',4),('CLR201','Laboratory',3),('CLR202','Laboratory',3),('CLR203','Laboratory',3),('CLR301','Laboratory',1),('CLR302','Laboratory',1),('CLR303','Laboratory',1),('LR101','Lecture',5),('LR102','Lecture',5),('LR103','Lecture',5),('LR201','Lecture',3),('LR202','Lecture',3),('LR203','Lecture',3),('LR301','Lecture',2),('LR302','Lecture',2),('LR303','Lecture',2),('MH1','Lecture',1),('MH2','Lecture',1),('MH3','Lecture',1),('MH4','Lecture',1),('MSC','Lecture',1),('MSC1','Lecture',1),('MSC2','Lecture',1),('MSC3','Lecture',1);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` text NOT NULL,
  `room_id` varchar(25) NOT NULL,
  `instructor_id` varchar(10) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `section_id` varchar(2) NOT NULL,
  `sy` varchar(9) NOT NULL,
  `type` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `room_id` (`room_id`),
  KEY `subject_id` (`subject_id`),
  KEY `instructor_id` (`instructor_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `schedule_ibfk_5` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (104,'PATHFIT1011A2425','MSC1','21298165','monday','08:00:00','09:00:00','PATHFIT101','1A','2024-2025','lecture',1),(105,'GECC101a1A2425','LR201','21127643','monday','10:00:00','11:00:00','GECC101a','1A','2024-2025','lecture',1),(106,'GECC102a1A2425','LR201','21127654','monday','11:00:00','12:00:00','GECC102a','1A','2024-2025','lecture',1),(107,'CSC1011A2425','LR201','21121876','monday','13:00:00','14:00:00','CSC101','1A','2024-2025','lecture',1),(108,'CSC1021A2425','LR201','21123987','monday','14:00:00','15:00:00','CSC102','1A','2024-2025','lecture',1),(109,'GECC1011A2425','LR301','21124567','monday','15:30:00','17:00:00','GECC101','1A','2024-2025','lecture',1),(110,'GECC103a1A2425','LR201','21127698','tuesday','08:00:00','09:30:00','GECC103a','1A','2024-2025','lecture',1),(111,'CSC1021A2425','CLR302','21123987','tuesday','09:30:00','11:00:00','CSC102','1A','2024-2025','laboratory',1),(112,'CSC1011A2425','CLR301','21121876','tuesday','14:00:00','15:30:00','CSC101','1A','2024-2025','laboratory',1),(113,'GECC101a1A2425','LR201','21127643','wednesday','10:00:00','11:00:00','GECC101a','1A','2024-2025','lecture',1),(114,'GECC102a1A2425','LR201','21127654','wednesday','11:00:00','12:00:00','GECC102a','1A','2024-2025','lecture',1),(115,'GECC103a1A2425','LR201','21127698','thursday','08:00:00','09:30:00','GECC103a','1A','2024-2025','lecture',1),(116,'CSC1021A2425','CLR302','21123987','thursday','09:30:00','11:00:00','CSC102','1A','2024-2025','laboratory',1),(117,'CSC1011A2425','CLR301','21121876','thursday','14:00:00','15:30:00','CSC101','1A','2024-2025','laboratory',1),(118,'PATHFIT1011A2425','MSC1','21298165','friday','08:00:00','09:00:00','PATHFIT101','1A','2024-2025','lecture',1),(119,'GECC101a1A2425','LR201','21127643','friday','10:00:00','11:00:00','GECC101a','1A','2024-2025','lecture',1),(120,'GECC102a1A2425','LR201','21127654','friday','11:00:00','12:00:00','GECC102a','1A','2024-2025','lecture',1),(121,'CSC1011A2425','LR201','21121876','friday','13:00:00','14:00:00','CSC101','1A','2024-2025','lecture',1),(122,'CSC1021A2425','LR201','21123987','friday','14:00:00','15:00:00','CSC102','1A','2024-2025','lecture',1),(123,'GECC1011A2425','LR301','21124567','friday','15:30:00','17:00:00','GECC101','1A','2024-2025','lecture',1),(124,'NSTP1011A2425','MSC2','21127890','saturday','08:00:00','11:00:00','NSTP101','1A','2024-2025','lecture',1),(125,'GECC104a1A2425','MH4','21234876','monday','08:00:00','09:00:00','GECC104a','1A','2024-2025','lecture',2),(126,'GECC105a1A2425','MH4','21245678','monday','09:00:00','10:00:00','GECC105a','1A','2024-2025','lecture',2),(127,'CSCC1011A2425','MH4','21128765','monday','10:00:00','11:00:00','CSCC101','1A','2024-2025','lecture',2),(128,'GECC106a1A2425','MH4','21268907','monday','12:30:00','14:00:00','GECC106a','1A','2024-2025','lecture',2),(129,'GECC107a1A2425','MH4','21275678','monday','14:00:00','15:30:00','GECC107a','1A','2024-2025','lecture',2),(130,'CSPC1011A2425','LR101','21128876','monday','15:30:00','17:00:00','CSPC101','1A','2024-2025','lecture',2),(131,'CSCC1011A2425','CLR203','21128765','tuesday','08:00:00','09:30:00','CSCC101','1A','2024-2025','laboratory',2),(132,'GECC1061A2425','MH4','21257689','tuesday','09:30:00','11:00:00','GECC106','1A','2024-2025','lecture',2),(133,'PATHFIT1021A2425','MSC3','21298165','tuesday','13:00:00','15:00:00','PATHFIT102','1A','2024-2025','lecture',2),(134,'GECC104a1A2425','MH4','21234876','wednesday','08:00:00','09:00:00','GECC104a','1A','2024-2025','lecture',2),(135,'GECC105a1A2425','MH4','21245678','wednesday','09:00:00','10:00:00','GECC105a','1A','2024-2025','lecture',2),(136,'CSCC1011A2425','CLR203','21128765','thursday','08:00:00','09:30:00','CSCC101','1A','2024-2025','laboratory',2),(137,'GECC1061A2425','MH4','21257689','thursday','09:30:00','11:00:00','GECC106','1A','2024-2025','lecture',2),(138,'GECC104a1A2425','MH4','21234876','friday','08:00:00','09:00:00','GECC104a','1A','2024-2025','lecture',2),(139,'GECC105a1A2425','MH4','21245678','friday','09:00:00','10:00:00','GECC105a','1A','2024-2025','lecture',2),(140,'CSCC1011A2425','MH4','21128765','friday','10:00:00','11:00:00','CSCC101','1A','2024-2025','lecture',2),(141,'GECC106a1A2425','MH4','21268907','friday','12:30:00','14:00:00','GECC106a','1A','2024-2025','lecture',2),(142,'GECC107a1A2425','MH4','21275678','friday','14:00:00','15:30:00','GECC107a','1A','2024-2025','lecture',2),(143,'CSPC1011A2425','LR101','21128876','friday','15:30:00','17:00:00','CSPC101','1A','2024-2025','lecture',2),(144,'CSPE1012A2425','MH3','21475678','monday','08:00:00','09:00:00','CSPE101','2A','2024-2025','lecture',1),(145,'CSPE1012A2425','CLR301','21475678','monday','15:30:00','17:00:00','CSPE101','2A','2024-2025','laboratory',1),(146,'GEMC101a2A2425','LR302','21345678','monday','09:00:00','10:00:00','GEMC101a','2A','2024-2025','lecture',1),(147,'CSPC1022A2425','LR302','21307654','monday','11:00:00','12:00:00','CSPC102','2A','2024-2025','lecture',1),(148,'PATHFIT1032A2425','MSC1','21368907','monday','12:00:00','13:00:00','PATHFIT103','2A','2024-2025','lecture',1),(149,'GECC108a2A2425','LR302','21334876','monday','14:00:00','15:30:00','GECC108a','2A','2024-2025','lecture',1),(151,'CSCC1042A2425','CLR202','21327654','tuesday','09:00:00','10:30:00','CSCC104','2A','2024-2025','laboratory',1),(152,'CSCC1042A2425','LR303','21327654','tuesday','11:00:00','12:00:00','CSCC104','2A','2024-2025','lecture',1),(153,'GEEC1122A2425','MH3','21427654','tuesday','14:00:00','15:30:00','GEEC112','2A','2024-2025','lecture',1),(154,'CSPC1032A2425','CLR201','21318865','tuesday','15:30:00','17:00:00','CSPC103','2A','2024-2025','laboratory',1),(155,'GEMC101a2A2425','LR302','21345678','wednesday','09:00:00','10:00:00','GEMC101a','2A','2024-2025','lecture',1),(156,'CSPC1032A2425','LR303','21318865','wednesday','10:00:00','12:00:00','CSPC103','2A','2024-2025','lecture',1),(157,'CSCC1042A2425','CLR202','21327654','thursday','11:00:00','12:00:00','CSCC104','2A','2024-2025','laboratory',1),(158,'CSCC1042A2425','CLR202','21327654','thursday','09:00:00','10:30:00','CSCC104','2A','2024-2025','laboratory',1),(159,'GEEC1122A2425','MH3','21427654','thursday','14:00:00','15:30:00','GEEC112','2A','2024-2025','lecture',1),(160,'CSPC1032A2425','CLR201','21318865','thursday','15:30:00','17:00:00','CSPC103','2A','2024-2025','laboratory',1),(161,'CSPE1012A2425','MH3','21475678','friday','08:00:00','09:00:00','CSPE101','2A','2024-2025','lecture',1),(162,'CSPE1012A2425','CLR301','21475678','friday','15:30:00','17:00:00','CSPE101','2A','2024-2025','laboratory',1),(163,'GEMC101a2A2425','LR302','21345678','friday','09:00:00','10:00:00','GEMC101a','2A','2024-2025','lecture',1),(164,'CSPC1022A2425','LR302','21307654','friday','11:00:00','12:00:00','CSPC102','2A','2024-2025','lecture',1),(165,'PATHFIT1032A2425','MSC1','21368907','friday','12:00:00','13:00:00','PATHFIT103','2A','2024-2025','lecture',1),(166,'GECC108a2A2425','LR302','21334876','friday','14:00:00','15:30:00','GECC108a','2A','2024-2025','lecture',1),(167,'PATHFIT1042A2425','MSC','21121876','monday','08:00:00','10:00:00','PATHFIT104','2A','2024-2025','lecture',2),(168,'CSAE1022A2425','CLR301','21418965','monday','11:00:00','12:30:00','CSAE102','2A','2024-2025','laboratory',2),(169,'CSME1012A2425','LR201','21398365','monday','12:30:00','13:00:00','CSME101','2A','2024-2025','lecture',2),(170,'CSAE1012A2425','CLR101','21407654','monday','15:30:00','17:00:00','CSAE101','2A','2024-2025','laboratory',2),(171,'CSCC1052A2425','LR303','21384567','tuesday','09:00:00','10:00:00','CSCC105','2A','2024-2025','lecture',2),(172,'CSPC1042A2425','LR303','21375678','tuesday','10:00:00','11:00:00','CSPC104','2A','2024-2025','lecture',2),(173,'GEEC1052A2425','LR303','21357689','tuesday','12:30:00','14:00:00','GEEC105','2A','2024-2025','lecture',2),(174,'CSPC1042A2425','CLR202','21375678','tuesday','15:30:00','17:00:00','CSPC104','2A','2024-2025','laboratory',2),(175,'CSCC1052A2425','CLR201','21384567','wednesday','11:00:00','14:00:00','CSCC105','2A','2024-2025','laboratory',2),(176,'CSCC1052A2425','LR303','21384567','thursday','09:00:00','10:00:00','CSCC105','2A','2024-2025','lecture',2),(177,'CSPC1042A2425','LR303','21375678','thursday','10:00:00','11:00:00','CSPC104','2A','2024-2025','lecture',2),(178,'GEEC1052A2425','LR303','21357689','thursday','12:30:00','14:00:00','GEEC105','2A','2024-2025','lecture',2),(179,'CSAE1022A2425','LR303','21418965','thursday','14:00:00','15:00:00','CSAE102','2A','2024-2025','lecture',2),(180,'CSPC1042A2425','CLR202','21375678','thursday','15:30:00','17:00:00','CSPC104','2A','2024-2025','laboratory',2),(181,'CSAE1022A2425','CLR301','21418965','friday','11:00:00','12:30:00','CSAE102','2A','2024-2025','laboratory',2),(182,'CSME1012A2425','LR201','21398365','friday','12:30:00','14:00:00','CSME101','2A','2024-2025','lecture',2),(183,'CSAE1012A2425','CLR101','21407654','friday','15:30:00','17:00:00','CSAE101','2A','2024-2025','laboratory',2),(184,'CSAE1022A2425','LR303','21418965','tuesday','14:00:00','15:00:00','CSAE102','2A','2024-2025','lecture',2),(185,'CSPC1063A2425','LR303','21124567','monday','08:00:00','09:00:00','CSPC106','3A','2024-2025','lecture',1),(186,'CSPC1063A2425','LR303','21124567','friday','08:00:00','09:00:00','CSPC106','3A','2024-2025','lecture',1),(187,'CSPC1093A2425','CLR201','21127698','monday','09:30:00','11:00:00','CSPC109','3A','2024-2025','laboratory',1),(188,'CSPC1093A2425','CLR201','21127698','friday','09:30:00','11:00:00','CSPC109','3A','2024-2025','laboratory',1),(189,'CSPC1073A2425','LR101','21127643','monday','11:00:00','12:00:00','CSPC107','3A','2024-2025','lecture',1),(190,'CSPC1073A2425','LR101','21127643','friday','11:00:00','12:00:00','CSPC107','3A','2024-2025','lecture',1),(191,'CSPE1023A2425','MH4','21127890','monday','13:00:00','14:00:00','CSPE102','3A','2024-2025','lecture',1),(192,'CSPE1023A2425','MH4','21127890','friday','13:00:00','14:00:00','CSPE102','3A','2024-2025','lecture',1),(193,'CSPC1053A2425','MH4','21123987','monday','15:30:00','17:00:00','CSPC105','3A','2024-2025','lecture',1),(194,'CSPC1053A2425','MH4','21123987','friday','15:30:00','17:00:00','CSPC105','3A','2024-2025','lecture',1),(195,'CSPC1063A2425','CLR203','21124567','tuesday','08:00:00','09:30:00','CSPC106','3A','2024-2025','laboratory',1),(196,'CSPC1063A2425','CLR203','21124567','thursday','08:00:00','09:30:00','CSPC106','3A','2024-2025','laboratory',1),(197,'CSPC1093A2425','MH2','21127698','tuesday','10:00:00','11:00:00','CSPC109','3A','2024-2025','lecture',1),(198,'CSPC1093A2425','MH2','21127698','thursday','10:00:00','11:00:00','CSPC109','3A','2024-2025','lecture',1),(199,'CSPC1083A2425','CLR203','21127643','wednesday','11:00:00','14:00:00','CSPC108','3A','2024-2025','laboratory',1),(200,'CSPE1023A2425','CLR101','21127890','tuesday','14:00:00','15:30:00','CSPE102','3A','2024-2025','laboratory',1),(201,'CSPE1023A2425','CLR101','21127890','thursday','14:00:00','15:30:00','CSPE102','3A','2024-2025','laboratory',1),(202,'CSPC1083A2425','LR303','21127654','tuesday','16:00:00','17:00:00','CSPC108','3A','2024-2025','lecture',1),(203,'CSPC1083A2425','LR303','21127654','thursday','16:00:00','17:00:00','CSPC108','3A','2024-2025','lecture',1),(204,'CSAE1033A2425','LR102','21234876','monday','08:00:00','09:00:00','CSAE103','3A','2024-2025','lecture',2),(205,'CSAE1063A2425','LR101','21128735','monday','11:00:00','12:00:00','CSAE106','3A','2024-2025','lecture',2),(206,'CSPC1153A2425','LR101','21257689','monday','13:00:00','14:00:00','CSPC115','3A','2024-2025','lecture',2),(207,'CSAE1043A2425','LR103','21245678','monday','14:00:00','15:00:00','CSAE104','3A','2024-2025','lecture',2),(208,'CSPC1113A2425','LR202','21128876','monday','15:00:00','16:00:00','CSPC111','3A','2024-2025','lecture',2),(209,'CSPC1103A2425','LR103','21128765','tuesday','08:00:00','09:00:00','CSPC110','3A','2024-2025','lecture',2),(210,'CSPC1113A2425','CLR201','21128876','tuesday','09:30:00','11:00:00','CSPC111','3A','2024-2025','laboratory',2),(211,'CSAE1043A2425','CLR202','21245678','tuesday','12:30:00','14:00:00','CSAE104','3A','2024-2025','laboratory',2),(212,'CSPC1103A2425','CLR102','21128765','tuesday','14:00:00','15:30:00','CSPC110','3A','2024-2025','laboratory',2),(213,'CSAE1063A2425','CLR101','21128735','tuesday','15:30:00','17:00:00','CSAE106','3A','2024-2025','laboratory',2),(214,'CSAE1033A2425','LR102','21234876','wednesday','08:00:00','09:00:00','CSAE103','3A','2024-2025','lecture',2),(215,'CSPC1153A2425','LR101','21257689','wednesday','13:00:00','14:00:00','CSPC115','3A','2024-2025','lecture',2),(216,'CSPC1103A2425','LR103','21128765','thursday','08:00:00','09:00:00','CSPC110','3A','2024-2025','lecture',2),(217,'CSPC1113A2425','CLR201','21128876','thursday','09:30:00','11:00:00','CSPC111','3A','2024-2025','laboratory',2),(218,'CSAE1043A2425','CLR201','21245678','thursday','12:30:00','14:00:00','CSAE104','3A','2024-2025','laboratory',2),(219,'CSPC1103A2425','CLR102','21128765','thursday','14:00:00','15:30:00','CSPC110','3A','2024-2025','laboratory',2),(220,'CSAE1063A2425','CLR101','21128735','thursday','15:30:00','17:00:00','CSAE106','3A','2024-2025','laboratory',2),(221,'CSAE1033A2425','LR102','21234876','friday','08:00:00','09:00:00','CSAE103','3A','2024-2025','lecture',2),(222,'CSAE1063A2425','LR101','21128735','friday','11:00:00','12:00:00','CSAE106','3A','2024-2025','lecture',2),(223,'CSPC1153A2425','LR101','21257689','friday','13:00:00','14:00:00','CSPC115','3A','2024-2025','lecture',2),(224,'CSAE1043A2425','LR103','21245678','friday','14:00:00','15:00:00','CSAE104','3A','2024-2025','lecture',2),(225,'CSPC1113A2425','LR202','21128876','friday','15:00:00','16:00:00','CSPC111','3A','2024-2025','lecture',2),(231,'CSPC1164A2425','MH1','21284567','monday','09:00:00','10:00:00','CSPC116','4A','2024-2025','lecture',1),(232,'CSPE1034A2425','MH3','21298165','monday','12:30:00','14:00:00','CSPE103','4A','2024-2025','lecture',1),(233,'CSPC1144A2425','MH2','21275678','tuesday','09:00:00','10:00:00','CSPC114','4A','2024-2025','lecture',1),(234,'CSPC1124A2425','LR301','21268907','tuesday','11:00:00','12:00:00','CSPC112','4A','2024-2025','lecture',1),(235,'CSPC1164A2425','MH2','21284567','tuesday','13:30:00','14:30:00','CSPC116','4A','2024-2025','lecture',1),(236,'CSPC1144A2425','CLR101','21275678','wednesday','08:00:00','11:00:00','CSPC114','4A','2024-2025','laboratory',1),(237,'CSPC1124A2425','CLR201','21268907','wednesday','14:00:00','17:00:00','CSPC112','4A','2024-2025','laboratory',1),(238,'CSPC1144A2425','LR301','21275678','thursday','09:00:00','10:00:00','CSPC114','4A','2024-2025','lecture',1),(239,'CSPC1124A2425','LR301','21268907','thursday','11:00:00','12:00:00','CSPC112','4A','2024-2025','lecture',1),(240,'CSPC1164A2425','MH1','21284567','friday','09:00:00','10:00:00','CSPC116','4A','2024-2025','lecture',1),(241,'CSPE1034A2425','MH3','21298165','friday','12:30:00','14:00:00','CSPE103','4A','2024-2025','lecture',1),(242,'CSAE1054A2425','CLR202','21327654','monday','08:00:00','09:30:00','CSAE105','4A','2024-2025','laboratory',2),(243,'CSCC1064A2425','CLR202','21318865','monday','11:00:00','12:30:00','CSCC106','4A','2024-2025','laboratory',2),(244,'CSCC1064A2425','LR302','21318865','tuesday','10:00:00','11:00:00','CSCC106','4A','2024-2025','lecture',2),(245,'CSPC1174A2425','LR102','21307654','tuesday','11:00:00','12:30:00','CSPC117','4A','2024-2025','lecture',2),(246,'CSAE1054A2425','LR303','21327654','tuesday','15:00:00','16:00:00','CSAE105','4A','2024-2025','lecture',2),(247,'CSCC1064A2425','LR302','21318865','thursday','10:00:00','11:00:00','CSCC106','4A','2024-2025','lecture',2),(248,'CSPC1174A2425','LR102','21307654','thursday','11:00:00','12:30:00','CSPC117','4A','2024-2025','lecture',2),(249,'CSAE1054A2425','LR303','21327654','thursday','15:00:00','16:00:00','CSAE105','4A','2024-2025','lecture',2),(250,'CSAE1054A2425','CLR202','21327654','friday','08:00:00','09:30:00','CSAE105','4A','2024-2025','laboratory',2),(251,'CSCC1064A2425','CLR202','21318865','friday','11:00:00','12:30:00','CSCC106','4A','2024-2025','laboratory',2);
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `insert_unit_counter_trigger` AFTER INSERT ON `schedule` 
    FOR EACH ROW BEGIN
    DECLARE time_counter INT;
    
    IF NEW.type = 'Lecture' THEN
        SET time_counter = TIMESTAMPDIFF(SECOND, NEW.start_time, NEW.end_time);
        INSERT INTO unit_counter (schedule_id, CODE, lecture_count)
        VALUES (NEW.schedule_id, NEW.code, time_counter / 1800 / 2);
    ELSEIF NEW.type = 'Laboratory' THEN
        SET time_counter = TIMESTAMPDIFF(SECOND, NEW.start_time, NEW.end_time);
        INSERT INTO unit_counter (schedule_id, CODE, laboratory_count)
        VALUES (NEW.schedule_id, NEW.code, time_counter / 1800 / 2 - 1);
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `insert_unit_counter_trigger_update` AFTER UPDATE ON `schedule` 
    FOR EACH ROW BEGIN
    DECLARE time_counter INT;
    
    IF NEW.type = 'Lecture' THEN
        SET time_counter = TIMESTAMPDIFF(SECOND, NEW.start_time, NEW.end_time);
        INSERT INTO unit_counter (schedule_id, CODE, lecture_count)
        VALUES (NEW.schedule_id, NEW.code, time_counter / 1800 / 2);
    ELSEIF NEW.type = 'Laboratory' THEN
        SET time_counter = TIMESTAMPDIFF(SECOND, NEW.start_time, NEW.end_time);
        INSERT INTO unit_counter (schedule_id, CODE, laboratory_count)
        VALUES (NEW.schedule_id, NEW.code, time_counter / 1800 / 2 - 1);
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `section` (
  `section_id` varchar(2) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section`
--

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;
INSERT INTO `section` VALUES ('1A'),('1B'),('1C'),('1D'),('1E'),('1F'),('2A'),('2B'),('2C'),('2D'),('2E'),('2F'),('3A'),('3B'),('3C'),('3D'),('3E'),('3F'),('4A'),('4B'),('4C'),('4D'),('4E'),('4F');
/*!40000 ALTER TABLE `section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `student_id` varchar(10) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `section_id` varchar(2) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES ('39078901','Watson','Ethan','William','ethanwilliam8901@student.dmmmsu.edu.ph','2A'),('39089012','Young','Emma','Olivia','emmaolivia9012@student.dmmmsu.edu.ph','2D'),('39090123','Adams','Noah','Aiden','noahaiden0123@student.dmmmsu.edu.ph','3A'),('39101234','Baker','Sophia','Ella','sophiaella1234@student.dmmmsu.edu.ph','3B'),('39112345','Carter','Logan','Ava','loganava2345@student.dmmmsu.edu.ph','3C'),('39123456','Davis','Elijah','Liam','elijahlilm3456@student.dmmmsu.edu.ph','3D'),('39134567','Evans','Mia','Lucas','mialucas4567@student.dmmmsu.edu.ph','3E'),('39145678','Foster','Jackson','Sophie','jacksonsophie5678@student.dmmmsu.edu.ph','3F'),('39156789','Garcia','Jack','Benjamin','jackbenjamin6789@student.dmmmsu.edu.ph','4A'),('39167890','Hall','Grace','Sophia','gracesophia7890@student.dmmmsu.edu.ph','4B'),('39178901','Irwin','Ethan','Liam','ethanliam8901@student.dmmmsu.edu.ph','4C'),('39189012','James','Ava','Harper','avaharper9012@student.dmmmsu.edu.ph','4D'),('39190123','Kelly','Samuel','Lucas','samuellucas0123@student.dmmmsu.edu.ph','4E'),('39201234','Lopez','Sophia','Avery','sophiaavery1234@student.dmmmsu.edu.ph','4F'),('39212345','Martin','Elijah','Eli','elijaheli2345@student.dmmmsu.edu.ph','1A'),('39223456','Nelson','Lily','Ella','lilyella3456@student.dmmmsu.edu.ph','1B'),('39234567','Owens','Zoe','Emma','zoeemma4567@student.dmmmsu.edu.ph','1C'),('39245678','Perez','Gabriel','Ethan','gabrielethan5678@student.dmmmsu.edu.ph','1D'),('39256789','Reed','Harper','Avery','harperavery6789@student.dmmmsu.edu.ph','1E'),('39267890','Scott','Landon','Ella','lellascott7890@student.dmmmsu.edu.ph','1F'),('39278901','Smith','Oliver','Sophia','oliversophia8901@student.dmmmsu.edu.ph','2A'),('39289012','Taylor','Aria','Isabella','ariaisabella9012@student.dmmmsu.edu.ph','2B'),('39290123','Watson','Ethan','William','ethanwilliam0123@student.dmmmsu.edu.ph','2C'),('39301234','Young','Emma','Olivia','emmaolivia1234@student.dmmmsu.edu.ph','2D'),('39312345','Adams','Noah','Aiden','noahaiden2345@student.dmmmsu.edu.ph','2E'),('39323456','Baker','Sophia','Ella','sophiaella3456@student.dmmmsu.edu.ph','2F'),('39334567','Carter','Logan','Ava','loganava4567@student.dmmmsu.edu.ph','3A'),('39345678','Davis','Elijah','Liam','elijahlilm5678@student.dmmmsu.edu.ph','3B'),('39356789','Evans','Mia','Lucas','mialucas6789@student.dmmmsu.edu.ph','3C'),('39367890','Foster','Jackson','Sophie','jacksonsophie7890@student.dmmmsu.edu.ph','3D'),('39378901','Garcia','Jack','Benjamin','jackbenjamin8901@student.dmmmsu.edu.ph','3E');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subject` (
  `subject_id` varchar(20) NOT NULL,
  `descriptive_title` text NOT NULL,
  `lecture_units` int(3) NOT NULL,
  `laboratory_units` int(6) NOT NULL,
  `total_units` int(10) NOT NULL,
  `priority` int(3) NOT NULL,
  `year_level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES ('CSAE101','introduction to natural language processing',2,1,3,3,2,2),('CSAE102','digital design',2,1,3,3,2,2),('CSAE103','methods of research',3,0,3,2,3,2),('CSAE104','web programming',2,1,3,3,3,2),('CSAE105','parallel and distributed computing',2,1,3,3,4,2),('CSAE106','mobile application development',2,1,3,5,3,2),('CSC101','introduction to computing',2,1,3,3,1,1),('CSC102','fundamentals of programming',2,1,3,3,1,1),('CSCC101','intermediate programming',2,1,3,3,1,2),('CSCC104','data structures and algortihms',2,1,3,3,2,1),('CSCC105','information management',2,1,3,3,2,2),('CSCC106','application development and emerging technologies',2,1,3,3,4,2),('CSME101','introduction to numerical analysis',3,0,3,3,2,2),('CSPC101','discrete structure 1',3,0,3,3,1,2),('CSPC102','discrete structure 2',3,0,3,3,2,1),('CSPC103','object oriented programming',2,1,3,3,2,1),('CSPC104','algorithms and complexity',2,1,3,3,2,2),('CSPC105','automata theory and formal languages',3,0,3,3,3,1),('CSPC106','architecture and organization',2,1,3,3,3,1),('CSPC107','information assurance and security',3,0,3,3,3,1),('CSPC108','networks and communication',2,1,3,3,3,1),('CSPC109','human and computer interaction',2,1,3,2,3,1),('CSPC110','programming languages',2,1,3,3,3,2),('CSPC111','software engineering 1',2,1,3,1,3,2),('CSPC112','software enigneering 2',2,1,3,3,4,1),('CSPC114','Operating Systems',2,1,3,3,4,1),('CSPC115','social issues and proffesional practice',3,0,3,3,3,2),('CSPC116','CS thesis writing 1',3,0,3,2,4,1),('CSPC117','CS thesis writing 2',3,0,3,2,4,2),('CSPE101','graphics and visual computing',2,1,3,5,2,1),('CSPE102','intelligent system',2,1,3,3,3,1),('CSPE103','Introduction to knowledge management',3,0,3,2,4,1),('GECC101','enviromental science',3,0,3,3,1,1),('GECC101a','art appreciation',3,0,3,3,1,1),('GECC102a','purposive communication',3,0,3,3,1,1),('GECC103a','mathematics in modern world',3,0,3,3,1,1),('GECC104a','ethics',3,0,3,2,1,2),('GECC105a','science, technology and society',3,0,3,2,1,2),('GECC106','introduction to linear programming',3,0,3,2,1,2),('GECC106a','reading in the phillipines history',3,0,3,2,1,2),('GECC107a','the contemporary world',3,0,3,2,1,2),('GECC108a','understanding the self',3,0,3,2,2,1),('GEEC105','theory of probability',3,0,3,2,2,2),('GEEC112','the entreprenurial minds',3,0,3,3,2,1),('GEMC101a','the life and works of rizal',3,0,3,2,2,1),('NSTP101','reserved officer trainig corps',2,0,2,1,1,1),('NSTP102','reserved officer trainig corps 2',2,0,2,1,1,2),('PATHFIT101','movement competency training',2,0,2,3,1,1),('PATHFIT102','exercise based fitness activities',2,0,2,1,1,2),('PATHFIT103','individual, dual and team sports',2,0,2,1,2,1),('PATHFIT104','outdoor and adventure activities',2,0,2,1,2,2);
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject_instructor`
--

DROP TABLE IF EXISTS `subject_instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subject_instructor` (
  `si_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject_id` varchar(20) NOT NULL,
  `instructor_id` varchar(10) NOT NULL,
  PRIMARY KEY (`si_id`),
  KEY `subject_id` (`subject_id`),
  KEY `instructor_id` (`instructor_id`),
  CONSTRAINT `subject_instructor_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subject_instructor_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=544 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_instructor`
--

LOCK TABLES `subject_instructor` WRITE;
/*!40000 ALTER TABLE `subject_instructor` DISABLE KEYS */;
INSERT INTO `subject_instructor` VALUES (487,'CSC101','21121876'),(488,'CSC102','21123987'),(489,'GECC101','21124567'),(490,'GECC101a','21127643'),(491,'GECC102a','21127654'),(492,'GECC103a','21127698'),(493,'PATHFIT101','21298165'),(494,'NSTP101','21127890'),(495,'GECC101','21128735'),(496,'CSCC101','21128765'),(497,'CSPC101','21128876'),(498,'GECC104a','21234876'),(499,'GECC105a','21245678'),(500,'GECC106','21257689'),(501,'GECC106a','21268907'),(502,'GECC107a','21275678'),(503,'NSTP102','21284567'),(504,'PATHFIT102','21298165'),(505,'CSPC102','21307654'),(506,'CSPC103','21318865'),(507,'CSCC104','21327654'),(508,'GECC108a','21334876'),(509,'GEMC101a','21345678'),(510,'GEEC105','21357689'),(511,'PATHFIT103','21368907'),(512,'CSPC104','21375678'),(513,'CSCC105','21384567'),(514,'CSME101','21398365'),(515,'CSAE101','21407654'),(516,'CSAE102','21418965'),(517,'GEEC112','21427654'),(518,'PATHFIT104','21121876'),(519,'CSPC105','21123987'),(520,'CSPC106','21124567'),(521,'CSPC107','21127643'),(522,'CSPC108','21127654'),(523,'CSPC109','21127698'),(524,'CSPE102','21127890'),(525,'CSAE106','21128735'),(526,'CSPC110','21128765'),(527,'CSPC111','21128876'),(528,'CSAE103','21234876'),(529,'CSAE104','21245678'),(530,'CSPC115','21257689'),(531,'CSPC112','21268907'),(532,'CSPC114','21275678'),(533,'CSPC116','21284567'),(534,'CSPE103','21298165'),(535,'CSPC117','21307654'),(536,'CSCC106','21318865'),(537,'CSAE105','21327654'),(538,'GECC106a','21345678'),(539,'GECC107a','21357689'),(540,'GEMC101a','21368907'),(541,'NSTP102','21375678'),(542,'PATHFIT103','21384567'),(543,'CSPE101','21475678');
/*!40000 ALTER TABLE `subject_instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_counter`
--

DROP TABLE IF EXISTS `unit_counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit_counter` (
  `schedule_id` int(20) NOT NULL,
  `code` text NOT NULL,
  `lecture_count` float NOT NULL DEFAULT 0,
  `laboratory_count` float NOT NULL DEFAULT 0,
  KEY `schedule_id` (`schedule_id`),
  CONSTRAINT `unit_counter_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_counter`
--

LOCK TABLES `unit_counter` WRITE;
/*!40000 ALTER TABLE `unit_counter` DISABLE KEYS */;
INSERT INTO `unit_counter` VALUES (104,'PATHFIT1011A2425',1,0),(105,'GECC101a1A2425',1,0),(106,'GECC102a1A2425',1,0),(107,'CSC1011A2425',1,0),(108,'CSC1021A2425',1,0),(109,'GECC1011A2425',1.5,0),(110,'GECC103a1A2425',1.5,0),(111,'CSC1021A2425',0,0.5),(112,'CSC1011A2425',0,0.5),(113,'GECC101a1A2425',1,0),(114,'GECC102a1A2425',1,0),(115,'GECC103a1A2425',1.5,0),(116,'CSC1021A2425',0,0.5),(117,'CSC1011A2425',0,0.5),(118,'PATHFIT1011A2425',1,0),(119,'GECC101a1A2425',1,0),(120,'GECC102a1A2425',1,0),(121,'CSC1011A2425',1,0),(122,'CSC1021A2425',1,0),(123,'GECC1011A2425',1.5,0),(124,'NSTP1011A2425',3,0),(125,'GECC104a1A2425',1,0),(126,'GECC105a1A2425',1,0),(127,'CSCC1011A2425',1,0),(128,'GECC106a1A2425',1.5,0),(129,'GECC107a1A2425',1.5,0),(130,'CSPC1011A2425',1.5,0),(131,'CSCC1011A2425',0,0.5),(132,'GECC1061A2425',1.5,0),(133,'PATHFIT1021A2425',2,0),(134,'GECC104a1A2425',1,0),(135,'GECC105a1A2425',1,0),(136,'CSCC1011A2425',0,0.5),(137,'GECC1061A2425',1.5,0),(138,'GECC104a1A2425',1,0),(139,'GECC105a1A2425',1,0),(140,'CSCC1011A2425',1,0),(141,'GECC106a1A2425',1.5,0),(142,'GECC107a1A2425',1.5,0),(143,'CSPC1011A2425',1.5,0),(144,'CSPE1012A2425',1,0),(145,'CSPE1012A2425',0,0.5),(146,'GEMC101a2A2425',1,0),(147,'CSPC1022A2425',1,0),(148,'PATHFIT1032A2425',1,0),(149,'GECC108a2A2425',1.5,0),(151,'CSCC1042A2425',0,0.5),(152,'CSCC1042A2425',1,0),(153,'GEEC1122A2425',1.5,0),(154,'CSPC1032A2425',0,0.5),(155,'GEMC101a2A2425',1,0),(156,'CSPC1032A2425',2,0),(157,'CSCC1042A2425',0,0),(158,'CSCC1042A2425',0,0.5),(159,'GEEC1122A2425',1.5,0),(160,'CSPC1032A2425',0,0.5),(161,'CSPE1012A2425',1,0),(162,'CSPE1012A2425',0,0.5),(163,'GEMC101a2A2425',1,0),(164,'CSPC1022A2425',1,0),(165,'PATHFIT1032A2425',1,0),(166,'GECC108a2A2425',1.5,0),(167,'PATHFIT1042A2425',2,0),(168,'CSAE1022A2425',0,0.5),(169,'CSME1012A2425',0.5,0),(170,'CSAE1012A2425',0,0.5),(171,'CSCC1052A2425',1,0),(172,'CSPC1042A2425',1,0),(173,'GEEC1052A2425',1.5,0),(174,'CSPC1042A2425',0,0.5),(175,'CSCC1052A2425',0,2),(176,'CSCC1052A2425',1,0),(177,'CSPC1042A2425',1,0),(178,'GEEC1052A2425',1.5,0),(179,'CSAE1022A2425',1,0),(180,'CSPC1042A2425',0,0.5),(181,'CSAE1022A2425',0,0.5),(182,'CSME1012A2425',1.5,0),(183,'CSAE1012A2425',0,0.5),(184,'CSAE1022A2425',1,0),(185,'CSPC1063A2425',1,0),(186,'CSPC1063A2425',1,0),(187,'CSPC1093A2425',0,0.5),(188,'CSPC1093A2425',0,0.5),(189,'CSPC1073A2425',1,0),(190,'CSPC1073A2425',1,0),(191,'CSPE1023A2425',1,0),(192,'CSPE1023A2425',1,0),(193,'CSPC1053A2425',1.5,0),(194,'CSPC1053A2425',1.5,0),(195,'CSPC1063A2425',0,0.5),(196,'CSPC1063A2425',0,0.5),(197,'CSPC1093A2425',1,0),(198,'CSPC1093A2425',1,0),(199,'CSPC1083A2425',0,2),(200,'CSPE1023A2425',0,0.5),(201,'CSPE1023A2425',0,0.5),(202,'CSPC1083A2425',1,0),(203,'CSPC1083A2425',1,0),(204,'CSAE1033A2425',1,0),(205,'CSAE1063A2425',1,0),(206,'CSPC1153A2425',1,0),(207,'CSAE1043A2425',1,0),(208,'CSPC1113A2425',1,0),(209,'CSPC1103A2425',1,0),(210,'CSPC1113A2425',0,0.5),(211,'CSAE1043A2425',0,0.5),(212,'CSPC1103A2425',0,0.5),(213,'CSAE1063A2425',0,0.5),(214,'CSAE1033A2425',1,0),(215,'CSPC1153A2425',1,0),(216,'CSPC1103A2425',1,0),(217,'CSPC1113A2425',0,0.5),(218,'CSAE1043A2425',0,0.5),(219,'CSPC1103A2425',0,0.5),(220,'CSAE1063A2425',0,0.5),(221,'CSAE1033A2425',1,0),(222,'CSAE1063A2425',1,0),(223,'CSPC1153A2425',1,0),(224,'CSAE1043A2425',1,0),(225,'CSPC1113A2425',1,0),(231,'CSPC1164A2425',1,0),(232,'CSPE1034A2425',1.5,0),(233,'CSPC1144A2425',1,0),(234,'CSPC1124A2425',1,0),(235,'CSPC1164A2425',1,0),(236,'CSPC1144A2425',0,2),(237,'CSPC1124A2425',0,2),(238,'CSPC1144A2425',1,0),(239,'CSPC1124A2425',1,0),(240,'CSPC1164A2425',1,0),(241,'CSPE1034A2425',1.5,0),(242,'CSAE1054A2425',0,0.5),(243,'CSCC1064A2425',0,0.5),(244,'CSCC1064A2425',1,0),(245,'CSPC1174A2425',1.5,0),(246,'CSAE1054A2425',1,0),(247,'CSCC1064A2425',1,0),(248,'CSPC1174A2425',1.5,0),(249,'CSAE1054A2425',1,0),(250,'CSAE1054A2425',0,0.5),(251,'CSCC1064A2425',0,0.5);
/*!40000 ALTER TABLE `unit_counter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(10) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL,
  `instructor_id` varchar(10) DEFAULT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `student_id` (`student_id`),
  KEY `instructor_id` (`instructor_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (13,'instructor',NULL,'21307654','$2y$12$Z5qVkY5ldp1bNqluuMrpde3leAIzdixonTjYrQuazh3Uowbr1En7m');
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

-- Dump completed on 2024-05-10 21:02:29
