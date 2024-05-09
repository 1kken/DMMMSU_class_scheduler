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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-09 21:35:54
