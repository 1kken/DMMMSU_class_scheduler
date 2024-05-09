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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-09 21:35:55
