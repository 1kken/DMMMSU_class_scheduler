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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-09 21:35:54
