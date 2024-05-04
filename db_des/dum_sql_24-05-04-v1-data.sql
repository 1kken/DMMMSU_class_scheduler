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
INSERT INTO `rooms` VALUES ('CLR101','Laboratory',5),('CLR102','Laboratory',4),('CLR201','Laboratory',3),('CLR202','Laboratory',3),('CLR301','Laboratory',1),('CLR302','Laboratory',1),('CLR303','Laboratory',1),('LR101','Lecture',5),('LR102','Lecture',5),('LR103','Lecture',5),('LR201','Lecture',3),('LR202','Lecture',3),('LR203','Lecture',3),('LR301','Lecture',2),('LR302','Lecture',2),('LR303','Lecture',2),('MH1','Lecture',1),('MH2','Lecture',1),('MH3','Lecture',1),('MH4','Lecture',1),('MSC1','Lecture',1),('MSC2','Lecture',1),('MSC3','Lecture',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (44,'PATHFIT1011A2425','MSC1','21298165','monday','08:00:00','09:00:00','PATHFIT101','1A','2024-2025','lecture',1),(45,'GECC101a1A2425','LR201','21127643','monday','10:00:00','11:00:00','GECC101a','1A','2024-2025','lecture',1),(46,'GECC102a1A2425','LR201','21127654','monday','11:00:00','12:00:00','GECC102a','1A','2024-2025','lecture',1),(47,'CSC1011A2425','LR201','21121876','monday','13:00:00','14:00:00','CSC101','1A','2024-2025','lecture',1),(48,'CSC1021A2425','LR201','21123987','monday','14:00:00','15:00:00','CSC102','1A','2024-2025','lecture',1),(49,'GECC1011A2425','LR301','21124567','monday','15:30:00','17:00:00','GECC101','1A','2024-2025','lecture',1);
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `student` VALUES ('39078901','Watson','Ethan','William','ethanwilliam8901@student.dmmmsu.edu.ph','2C'),('39089012','Young','Emma','Olivia','emmaolivia9012@student.dmmmsu.edu.ph','2D'),('39090123','Adams','Noah','Aiden','noahaiden0123@student.dmmmsu.edu.ph','3A'),('39101234','Baker','Sophia','Ella','sophiaella1234@student.dmmmsu.edu.ph','3B'),('39112345','Carter','Logan','Ava','loganava2345@student.dmmmsu.edu.ph','3C'),('39123456','Davis','Elijah','Liam','elijahlilm3456@student.dmmmsu.edu.ph','3D'),('39134567','Evans','Mia','Lucas','mialucas4567@student.dmmmsu.edu.ph','3E'),('39145678','Foster','Jackson','Sophie','jacksonsophie5678@student.dmmmsu.edu.ph','3F'),('39156789','Garcia','Jack','Benjamin','jackbenjamin6789@student.dmmmsu.edu.ph','4A'),('39167890','Hall','Grace','Sophia','gracesophia7890@student.dmmmsu.edu.ph','4B'),('39178901','Irwin','Ethan','Liam','ethanliam8901@student.dmmmsu.edu.ph','4C'),('39189012','James','Ava','Harper','avaharper9012@student.dmmmsu.edu.ph','4D'),('39190123','Kelly','Samuel','Lucas','samuellucas0123@student.dmmmsu.edu.ph','4E'),('39201234','Lopez','Sophia','Avery','sophiaavery1234@student.dmmmsu.edu.ph','4F'),('39212345','Martin','Elijah','Eli','elijaheli2345@student.dmmmsu.edu.ph','1A'),('39223456','Nelson','Lily','Ella','lilyella3456@student.dmmmsu.edu.ph','1B'),('39234567','Owens','Zoe','Emma','zoeemma4567@student.dmmmsu.edu.ph','1C'),('39245678','Perez','Gabriel','Ethan','gabrielethan5678@student.dmmmsu.edu.ph','1D'),('39256789','Reed','Harper','Avery','harperavery6789@student.dmmmsu.edu.ph','1E'),('39267890','Scott','Landon','Ella','lellascott7890@student.dmmmsu.edu.ph','1F'),('39278901','Smith','Oliver','Sophia','oliversophia8901@student.dmmmsu.edu.ph','2A'),('39289012','Taylor','Aria','Isabella','ariaisabella9012@student.dmmmsu.edu.ph','2B'),('39290123','Watson','Ethan','William','ethanwilliam0123@student.dmmmsu.edu.ph','2C'),('39301234','Young','Emma','Olivia','emmaolivia1234@student.dmmmsu.edu.ph','2D'),('39312345','Adams','Noah','Aiden','noahaiden2345@student.dmmmsu.edu.ph','2E'),('39323456','Baker','Sophia','Ella','sophiaella3456@student.dmmmsu.edu.ph','2F'),('39334567','Carter','Logan','Ava','loganava4567@student.dmmmsu.edu.ph','3A'),('39345678','Davis','Elijah','Liam','elijahlilm5678@student.dmmmsu.edu.ph','3B'),('39356789','Evans','Mia','Lucas','mialucas6789@student.dmmmsu.edu.ph','3C'),('39367890','Foster','Jackson','Sophie','jacksonsophie7890@student.dmmmsu.edu.ph','3D'),('39378901','Garcia','Jack','Benjamin','jackbenjamin8901@student.dmmmsu.edu.ph','3E');
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
INSERT INTO `subject` VALUES ('CSAE101','introduction to natural language processing',3,0,3,3,2,2),('CSAE102','digital design',2,1,3,3,2,2),('CSAE103','methods of research',3,0,3,2,3,2),('CSAE104','methods of research',2,1,3,3,3,2),('CSAE105','parallel and distributed computing',2,1,3,3,4,1),('CSAE106','mobile application development',2,1,3,5,3,2),('CSC101','introduction to computing',2,1,3,3,1,1),('CSC102','fundamentals of programming',2,1,3,3,1,1),('CSCC101','intermediate programming',2,1,3,3,1,2),('CSCC104','data structures and algortihms',2,1,3,3,4,1),('CSCC105','information management',2,1,3,3,2,2),('CSCC106','application development and emerging technologies',2,1,3,3,4,1),('CSME101','introduction to numerical analysis',3,0,3,3,2,2),('CSPC101','discrete structure 1',3,0,3,3,1,2),('CSPC102','discrete structure 2',3,0,3,3,2,1),('CSPC103','object oriented programming',2,1,3,3,2,1),('CSPC104','algorithms and complexity',2,1,3,3,2,2),('CSPC105','automata theory and formal languages',3,0,3,3,3,1),('CSPC106','architecture and organization',2,1,3,3,3,1),('CSPC107','information assurance and security',3,0,3,3,3,1),('CSPC108','networks and communication',2,1,3,3,3,1),('CSPC109','human and computer interaction',2,1,3,2,3,1),('CSPC110','programming languages',2,1,3,3,3,2),('CSPC111','software engineering 1',2,1,3,1,3,2),('CSPC112','software enigneering 2',2,1,3,3,4,1),('CSPC114','Operating Systems',2,1,3,3,4,1),('CSPC115','social issues and proffesional practice',3,0,3,3,3,2),('CSPC116','CS thesis writing 1',3,0,3,2,4,1),('CSPC117','CS thesis writing 2',3,0,3,2,4,1),('CSPE101','graphics and visual computing',2,1,3,5,2,1),('CSPE102','intelligent system',2,1,3,3,3,1),('CSPE103','Introduction to knowledge management',3,0,3,2,4,1),('GECC101','enviromental science',3,0,3,3,1,1),('GECC101a','art appreciation',3,0,3,3,1,1),('GECC102a','purposive communication',3,0,3,3,1,1),('GECC103a','mathematics in modern world',3,0,3,3,1,1),('GECC104a','ethics',3,0,3,2,1,2),('GECC105a','science, technology and society',3,0,3,2,1,2),('GECC106','introduction to linear programming',3,0,3,2,1,2),('GECC106a','reading in the phillipines history',3,0,3,2,1,2),('GECC107a','the contemporary world',3,0,3,2,1,2),('GECC108a','understanding the self',3,0,3,2,2,1),('GEEC105','theory of probability',3,0,3,2,2,1),('GEEC112','the entreprenurial minds',2,1,3,3,2,2),('GEMC101a','the life and works of rizal',3,0,3,2,2,1),('NSTP101','reserved officer trainig corps',2,0,2,1,1,1),('NSTP102','reserved officer trainig corps 2',2,0,2,1,1,2),('PATHFIT101','movement competency training',2,0,2,3,1,1),('PATHFIT102','exercise based fitness activities',2,0,2,1,1,2),('PATHFIT103','individual, dual and team sports',2,0,2,1,2,1),('PATHFIT104','outdoor and adventure activities',2,0,2,1,2,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=487 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_instructor`
--

LOCK TABLES `subject_instructor` WRITE;
/*!40000 ALTER TABLE `subject_instructor` DISABLE KEYS */;
INSERT INTO `subject_instructor` VALUES (431,'CSC101','21121876'),(432,'CSC102','21123987'),(433,'GECC101','21124567'),(434,'GECC101a','21127643'),(435,'GECC102a','21127654'),(436,'GECC103a','21127698'),(437,'PATHFIT101','21298165'),(438,'NSTP101','21127890'),(439,'GECC101','21128735'),(440,'CSCC101','21128765'),(441,'CSPC101','21128876'),(442,'GECC104a','21234876'),(443,'GECC105a','21245678'),(444,'GECC106','21257689'),(445,'GECC106a','21268907'),(446,'GECC107a','21275678'),(447,'NSTP102','21284567'),(448,'PATHFIT102','21298165'),(449,'CSPC102','21307654'),(450,'CSPC103','21318865'),(451,'CSCC104','21327654'),(452,'GECC108a','21334876'),(453,'GEMC101a','21345678'),(454,'GEEC105','21357689'),(455,'PATHFIT103','21368907'),(456,'CSPC104','21375678'),(457,'CSCC105','21384567'),(458,'CSME101','21398365'),(459,'CSAE101','21407654'),(460,'CSAE102','21418965'),(461,'GEEC112','21427654'),(462,'PATHFIT104','21121876'),(463,'CSPC105','21123987'),(464,'CSPC106','21124567'),(465,'CSPC107','21127643'),(466,'CSPC108','21127654'),(467,'CSPC109','21127698'),(468,'CSPE102','21127890'),(469,'CSAE106','21128735'),(470,'CSPC110','21128765'),(471,'CSPC111','21128876'),(472,'CSAE103','21234876'),(473,'CSAE104','21245678'),(474,'CSPC115','21257689'),(475,'CSPC112','21268907'),(476,'CSPC114','21275678'),(477,'CSPC116','21284567'),(478,'CSPE103','21298165'),(479,'CSPC117','21307654'),(480,'CSCC106','21318865'),(481,'CSAE105','21327654'),(482,'GECC106a','21345678'),(483,'GECC107a','21357689'),(484,'GEMC101a','21368907'),(485,'NSTP102','21375678'),(486,'PATHFIT103','21384567');
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
INSERT INTO `unit_counter` VALUES (44,'PATHFIT1011A2425',1,0),(45,'GECC101a1A2425',1,0),(46,'GECC102a1A2425',1,0),(47,'CSC1011A2425',1,0),(48,'CSC1021A2425',1,0),(49,'GECC1011A2425',1.5,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (12,'instructor',NULL,'21307654','$2y$12$MAjNrfze7Eu1WFT15zhL..KFlWX.Ve9/3KXeTUKvMgwhT1vm5.iQq');
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

-- Dump completed on 2024-05-04 12:01:58
