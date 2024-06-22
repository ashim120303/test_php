-- MySQL dump 10.13  Distrib 8.0.37, for Linux (x86_64)
--
-- Host: localhost    Database: user_management
-- ------------------------------------------------------
-- Server version	8.0.37-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birthdate` date NOT NULL,
  `role` enum('User','Admin') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'john_doe','ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f','John','Doe','Male','1990-01-01','User'),(4,'jane_smith','$2y$10$TuR6nvl9TCFjU6pmVCYhZOiTR1bPGSR9KVLFn6JfPxN5e78GpfFtu','Jane','Smith','Female','1985-05-15','User'),(5,'bob_johnson','7d85ee5d030dbf296246849e9d3ab0f25f768b972c50467d9f7fa08fd26ada08','Bob','Johnson','Male','1992-08-21','User'),(6,'alice_wilson','37473a6d264f63b52195d34aa2c420c4a16e0eb29088ab9b1e156736348acc26','Alice','Wilson','Female','1993-11-30','User'),(7,'michael_brown','1e98c07513987057efbadf8c254252fcb4ac8a751ed1dad5a7afaa0f79d0ea05','Michael','Brown','Male','1987-07-12','User'),(8,'linda_davis','3abc3d442ad87fb94df7d11d3bac3e44d993aa2e921002523be424ef43fc7fd3','Linda','Davis','Female','1995-03-25','User'),(9,'william_miller','99fc1088883782e2c259f0fdbadf50698a576c35c0a50015c45302fd086b5693','William','Miller','Male','1989-09-05','User'),(11,'charles_martinez','8a1425f9ecd8d4d35b4c502fc43953d4083bc65e0e1785587fa54d4c6532c739','Charles','Martinez','Male','1988-06-18','User'),(12,'susan_rodriguez','57806915904307eeb1174d1824633ae406113de3be8295bc997796615c26f6d3','Susan','Rodriguez','Female','1994-04-22','User'),(13,'james_moore','98fb26cb26ed99be42b3f30a20e5a7dd9eab62af6ed36339d0ca13c5f8155a26','James','Moore','Male','1986-02-28','User'),(14,'mary_taylor','6bcc2bd5e7e9c2b5cb51105679a9978689d06763bf11ee2356d819fc5c9716d0','Mary','Taylor','Female','1993-10-07','User'),(15,'david_anderson','b40bce62cc9e64f69cb9ac9d7d9ea08b789a92afba2ee4ef0fdb614eecbaa6cf','David','Anderson','Male','1990-12-01','User'),(16,'patricia_thomas','d336b522fac24ab3570470d71434dd0a03a85fd0aab036632ad2270b11e4f317','Patricia','Thomas','Female','1984-01-16','User'),(17,'robert_jackson','d9d2e736c7be7fa7ce00d33b1d43967436c450d2569f9acdc1e8aa2baff87204','Robert','Jackson','Male','1992-05-11','User'),(18,'barbara_white','06bf07d1bd04d8a051fae11d7f10b125c63b1239c2f816feaaa63322557285b8','Barbara','White','Female','1989-09-17','User'),(19,'thomas_harris','c8bb6a60d36e9e2819c4530504022c6228dd6997be2733f651344c52b78983c1','Thomas','Harris','Male','1991-03-20','User'),(20,'nancy_clark','c09c03ba0f5afe540b410f254419b4e159f501af9b77e5433321fa852ff65501','Nancy','Clark','Male','1995-07-23','User'),(21,'daniel_lewis','31da895dff55475c8f24cc504ea9b2ceeceb4daf8446b12a2c113930d82ebf6c','Daniel','Lewis','Male','1987-11-29','User'),(22,'lisa_robinson','92804ba1c358319cbe8253b1ffa15faf86bec4ed04aa93b21b8fd2db7edc1255','Lisa','Robinson','Female','1990-04-08','User'),(29,'ashim','$2y$10$0EuY1WckDPIfp3JrL3lbdORC5h7Ozk0jItG9s8MGYppqjm9h6pYdK','Ashim','Eminov','Male','2003-03-12','Admin'),(39,'admin','$2y$10$nMwLku1N8dVZ7Y6YKkoo2OmF8Q46RiQEwV1b2jT36A2/tlRK1sghe','ADMIN','ADMIN','Male','0001-01-01','Admin');
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

-- Dump completed on 2024-06-22 18:56:46
