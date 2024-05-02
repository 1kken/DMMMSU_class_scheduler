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
-- Dumping data for table `instructor`
--

LOCK TABLES `instructor` WRITE;
/*!40000 ALTER TABLE `instructor` DISABLE KEYS */;
INSERT INTO `instructor` VALUES ('21121876','Williams','Robert','Christopher','rcwilliams1876@instructor.dmmmsu.edu.ph'),('21123987','Smith','John','David','jdsmith3987@instructor.dmmmsu.edu.ph'),('21124567','Johnson','Jane','Michael','jmjohnson4567@instructor.dmmmsu.edu.ph'),('21127643','Miller','Elizabeth','Ann','eamiller7643@instructor.dmmmsu.edu.ph'),('21127654','Brown','Mary','Elizabeth','mebrown7654@instructor.dmmmsu.edu.ph'),('21127698','Garcia','Maria','Isabel','migarcia7698@instructor.dmmmsu.edu.ph'),('21127890','Davis','Michael','Joseph','mjdavis7890@instructor.dmmmsu.edu.ph'),('21128735','Jones','William','Thomas','wtjones8765@instructor.dmmmsu.edu.ph'),('21128765','Martinez','Jose','Antonio','jamartinez8765@instructor.dmmmsu.edu.ph'),('21128876','Hernandez','Ana','Gabriela','aghernandez8876@instructor.dmmmsu.edu.ph'),('21234876','Anderson','David','Richard','dranderson4876@instructor.dmmmsu.edu.ph'),('21245678','Williams','Emily','Nicole','enwilliams5678@instructor.dmmmsu.edu.ph'),('21257689','Thompson','Michael','William','mwthompson7689@instructor.dmmmsu.edu.ph'),('21268907','Johnson','Emma','Grace','egjohnson8907@instructor.dmmmsu.edu.ph'),('21275678','Brown','Christopher','Daniel','cdbrown5678@instructor.dmmmsu.edu.ph'),('21284567','Martinez','Sophia','Isabella','sismartinez4567@instructor.dmmmsu.edu.ph'),('21298165','Taylor','Andrew','Jacob','ajtaylor8765@instructor.dmmmsu.edu.ph'),('21307654','Garcia','Olivia','Ava','oagarcia7654@instructor.dmmmsu.edu.ph'),('21318865','Hernandez','Joshua','Nathan','jnhernandez8765@instructor.dmmmsu.edu.ph'),('21327654','Jones','Liam','Ethan','ljeones7654@instructor.dmmmsu.edu.ph'),('21334876','Smith','Amelia','Charlotte','acsmith4876@instructor.dmmmsu.edu.ph'),('21345678','Miller','Daniel','Joseph','djmillerr5678@instructor.dmmmsu.edu.ph'),('21357689','Davis','Sophia','Ella','sedavis7689@instructor.dmmmsu.edu.ph'),('21368907','Wilson','Ethan','Mason','ewilson8907@instructor.dmmmsu.edu.ph'),('21375678','Lopez','Mia','Avery','malopez5678@instructor.dmmmsu.edu.ph'),('21384567','Gonzalez','Elijah','Logan','elgonzalez4567@instructor.dmmmsu.edu.ph'),('21398365','Harris','Madison','Evelyn','meharris8765@instructor.dmmmsu.edu.ph'),('21407654','Clark','Alexander','Sebastian','asclark7654@instructor.dmmmsu.edu.ph'),('21418965','Young','Abigail','Harper','ayoung8765@instructor.dmmmsu.edu.ph'),('21427654','Lewis','Jayden','William','jwlewis7654@instructor.dmmmsu.edu.ph'),('21434876','Hall','Chloe','Natalie','cchall4876@instructor.dmmmsu.edu.ph'),('21445678','King','Benjamin','Elijah','beking5678@instructor.dmmmsu.edu.ph'),('21457689','Allen','Zoey','Riley','zrallen7689@instructor.dmmmsu.edu.ph'),('21468907','Scott','Carter','Dylan','ccscott8907@instructor.dmmmsu.edu.ph'),('21475678','Walker','Samuel','Henry','swhwalker5678@instructor.dmmmsu.edu.ph');
/*!40000 ALTER TABLE `instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES ('CLR101','laboratory',5),('CLR102','laboratory',4),('CLR201','laboratory',3),('CLR202','laboratory',3),('CLR301','laboratory',1),('LR101','lecture',5),('LR102','lecture',5),('LR103','lecture',5),('LR201','lecture',3),('LR202','lecture',3),('LR203','lecture',3),('LR301','lecture',2),('LR302','lecture',2),('LR303','Lecture',2);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `section`
--

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;
INSERT INTO `section` VALUES ('1A'),('1B'),('1C'),('1D'),('1E'),('1F'),('2A'),('2B'),('2C'),('2D'),('2E'),('2F'),('3A'),('3B'),('3C'),('3D'),('3E'),('3F'),('4A'),('4B'),('4C'),('4D'),('4E'),('4F');
/*!40000 ALTER TABLE `section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES ('39078901','Watson','Ethan','William','ethanwilliam8901@student.dmmmsu.edu.ph','2C'),('39089012','Young','Emma','Olivia','emmaolivia9012@student.dmmmsu.edu.ph','2D'),('39090123','Adams','Noah','Aiden','noahaiden0123@student.dmmmsu.edu.ph','3A'),('39101234','Baker','Sophia','Ella','sophiaella1234@student.dmmmsu.edu.ph','3B'),('39112345','Carter','Logan','Ava','loganava2345@student.dmmmsu.edu.ph','3C'),('39123456','Davis','Elijah','Liam','elijahlilm3456@student.dmmmsu.edu.ph','3D'),('39134567','Evans','Mia','Lucas','mialucas4567@student.dmmmsu.edu.ph','3E'),('39145678','Foster','Jackson','Sophie','jacksonsophie5678@student.dmmmsu.edu.ph','3F'),('39156789','Garcia','Jack','Benjamin','jackbenjamin6789@student.dmmmsu.edu.ph','4A'),('39167890','Hall','Grace','Sophia','gracesophia7890@student.dmmmsu.edu.ph','4B'),('39178901','Irwin','Ethan','Liam','ethanliam8901@student.dmmmsu.edu.ph','4C'),('39189012','James','Ava','Harper','avaharper9012@student.dmmmsu.edu.ph','4D'),('39190123','Kelly','Samuel','Lucas','samuellucas0123@student.dmmmsu.edu.ph','4E'),('39201234','Lopez','Sophia','Avery','sophiaavery1234@student.dmmmsu.edu.ph','4F'),('39212345','Martin','Elijah','Eli','elijaheli2345@student.dmmmsu.edu.ph','1A'),('39223456','Nelson','Lily','Ella','lilyella3456@student.dmmmsu.edu.ph','1B'),('39234567','Owens','Zoe','Emma','zoeemma4567@student.dmmmsu.edu.ph','1C'),('39245678','Perez','Gabriel','Ethan','gabrielethan5678@student.dmmmsu.edu.ph','1D'),('39256789','Reed','Harper','Avery','harperavery6789@student.dmmmsu.edu.ph','1E'),('39267890','Scott','Landon','Ella','lellascott7890@student.dmmmsu.edu.ph','1F'),('39278901','Smith','Oliver','Sophia','oliversophia8901@student.dmmmsu.edu.ph','2A'),('39289012','Taylor','Aria','Isabella','ariaisabella9012@student.dmmmsu.edu.ph','2B'),('39290123','Watson','Ethan','William','ethanwilliam0123@student.dmmmsu.edu.ph','2C'),('39301234','Young','Emma','Olivia','emmaolivia1234@student.dmmmsu.edu.ph','2D'),('39312345','Adams','Noah','Aiden','noahaiden2345@student.dmmmsu.edu.ph','2E'),('39323456','Baker','Sophia','Ella','sophiaella3456@student.dmmmsu.edu.ph','2F'),('39334567','Carter','Logan','Ava','loganava4567@student.dmmmsu.edu.ph','3A'),('39345678','Davis','Elijah','Liam','elijahlilm5678@student.dmmmsu.edu.ph','3B'),('39356789','Evans','Mia','Lucas','mialucas6789@student.dmmmsu.edu.ph','3C'),('39367890','Foster','Jackson','Sophie','jacksonsophie7890@student.dmmmsu.edu.ph','3D'),('39378901','Garcia','Jack','Benjamin','jackbenjamin8901@student.dmmmsu.edu.ph','3E');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES ('CSAE101','introduction to natural language processing',3,0,3,3,2,2),('CSAE102','digital design',2,1,3,3,2,2),('CSAE103','methods of research',3,0,3,2,3,2),('CSAE104','methods of research',2,1,3,3,3,2),('CSAE105','parallel and distributed computing',2,1,3,3,4,1),('CSAE106','mobile application development',2,1,3,5,3,2),('CSC101','introduction to computing',2,1,3,3,1,1),('CSC102','fundamentals of programming',2,1,3,3,1,1),('CSCC101','intermediate programming',2,1,3,3,1,2),('CSCC105','information management',2,1,3,3,2,2),('CSCC106','application development and emerging technologies',2,1,3,3,4,1),('CSME101','introduction to numerical analysis',3,0,3,3,2,2),('CSPC101','discrete structure 1',3,0,3,3,1,2),('CSPC102','discrete structure 2',3,0,3,3,2,1),('CSPC103','object oriented programming',2,1,3,3,2,1),('CSPC104','algorithms and complexity',2,1,3,3,2,2),('CSPC105','automata theory and formal languages',3,0,3,3,3,1),('CSPC106','architecture and organization',2,1,3,3,3,1),('CSPC107','information assurance and security',3,0,3,3,3,1),('CSPC108','networks and communication',2,1,3,3,3,1),('CSPC109','human and computer interaction',2,1,3,2,3,1),('CSPC110','programming languages',2,1,3,3,3,2),('CSPC111','software engineering 1',2,1,3,1,3,2),('CSPC112','software enigneering 2',2,1,3,3,4,1),('CSPC114','Operating Systems',2,1,3,3,4,1),('CSPC115','social issues and proffesional practice',3,0,3,3,3,2),('CSPC116','CS thesis writing 1',3,0,3,2,4,1),('CSPC117','CS thesis writing 2',3,0,3,2,4,1),('CSPE101','graphics and visual computing',2,1,3,5,2,1),('CSPE102','intelligent system',2,1,3,3,3,1),('CSPE103','Introduction to knowledge management',3,0,3,2,4,1),('GECC101','enviromental science',3,0,3,3,1,1),('GECC101a','art appreciation',3,0,3,3,1,1),('GECC102a','purposive communication',3,0,3,3,1,1),('GECC103a','mathematics in modern world',3,0,3,3,1,1),('GECC104a','ethics',3,0,3,2,1,2),('GECC105a','science, technology and society',3,0,3,2,1,2),('GECC106','introduction to linear programming',3,0,3,2,1,2),('GECC106a','reading in the phillipines history',3,0,3,2,1,2),('GECC107a','the contemporary world',3,0,3,2,1,2),('GECC108a','understanding the self',3,0,3,2,2,1),('GEEC105','theory of probability',3,0,3,2,2,1),('GEEC112','the entreprenurial minds',2,1,3,3,2,2),('GEMC101a','the life and works of rizal',3,0,3,2,2,1),('NSTP101','reserved officer trainig corps',2,0,2,1,1,1),('NSTP102','reserved officer trainig corps 2',2,0,2,1,1,2),('PATHFIT101','movement competency training',2,0,2,3,1,1),('PATHFIT102','exercise based fitness activities',2,0,2,1,1,2),('PATHFIT103','individual, dual and team sports',2,0,2,1,2,1),('PATHFIT104','outdoor and adventure activities',2,0,2,1,2,2);
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `subject_instructor`
--

LOCK TABLES `subject_instructor` WRITE;
/*!40000 ALTER TABLE `subject_instructor` DISABLE KEYS */;
INSERT INTO `subject_instructor` VALUES (4,'CSAE102','21123987'),(5,'CSAE101','21121876'),(6,'CSC101','21121876'),(7,'CSC102','21123987'),(8,'GECC101','21124567'),(9,'GECC101a','21127643'),(10,'GECC102a','21127654'),(11,'GECC103a','21127698'),(12,'NSTP101','21127890'),(13,'GECC101','21128735'),(14,'CSCC101','21128765'),(15,'CSPC101','21128876'),(16,'GECC104a','21234876'),(17,'GECC105a','21245678'),(18,'GECC106','21257689'),(19,'GECC106a','21268907'),(20,'GECC107a','21275678'),(21,'NSTP102','21284567'),(22,'PATHFIT102','21298165');
/*!40000 ALTER TABLE `subject_instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (11,'instructor',NULL,'21307654','$2y$12$XO7fG2oGbb2z/UfxP.DK8.0Ya9683RQMKYPl5Vd09GmNt9PLsPJ1S');
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

-- Dump completed on 2024-05-02  9:35:43
