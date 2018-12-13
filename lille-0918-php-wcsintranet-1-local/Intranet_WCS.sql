-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: Intranet_WCS
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCategory` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(255) COLLATE utf8_bin NOT NULL,
  `author` varchar(255) COLLATE utf8_bin NOT NULL,
  `isActif` tinyint(1) DEFAULT NULL,
  `activeCategory` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`userId`),
  KEY `id_subcategory` (`idCategory`),
  CONSTRAINT `article_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `category_fk` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,4,44,'<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in pulvinar purus. Vestibulum porttitor commodo arcu ac pretium. Sed et tempus metus. Donec sit amet lorem vitae erat porttitor finibus id nec ipsum. Suspendisse ac hendrerit risus. Quisque consequat nunc quis facilisis pharetra. Donec sit amet mi sagittis, hendrerit magna quis, tempor elit. Quisque porttitor, metus ac aliquet dictum, lectus orci bibendum ligula, a rutrum neque ante vel erat. Nulla vestibulum interdum convallis. Donec quis nisi id odio tempor porttitor. Donec tempor tellus tortor, eu mollis magna blandit eget. Donec posuere eu mi et lobortis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer vitae justo tristique, gravida velit rutrum, faucibus massa. Maecenas eget nulla placerat, iaculis sem posuere, lacinia odio. Proin non consectetur nisl. Sed nibh lacus, gravida a tempor sed, rutrum vitae massa. Pellentesque rutrum, massa ut facilisis bibendum, eros arcu varius metus, in vehicula magna nulla et tellus. Praesent tempus congue urna, at suscipit sem convallis sit amet. In hac habitasse platea dictumst. Cras porta, diam non tristique posuere, est arcu aliquet velit, quis dictum eros purus a nibh.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer nec luctus enim. Vivamus porttitor vestibulum quam, vitae bibendum mauris lacinia eu. Pellentesque non scelerisque purus. Quisque mattis massa in erat rhoncus auctor. Maecenas vel lorem sapien. Nunc pellentesque molestie erat a vestibulum. Nunc maximus nunc quam, sit amet pellentesque lorem molestie ac. Sed mattis augue lorem, quis efficitur mi finibus et. Nulla eget dolor non purus viverra rutrum at in sem. Nulla suscipit iaculis aliquam. Integer congue sed nunc et aliquam. Integer tincidunt dui lacus, a ullamcorper ante elementum nec. Suspendisse potenti. Aliquam semper nisi lectus, in dictum odio accumsan ut. Morbi lacinia eu lorem in facilisis. Donec id malesuada urna.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nunc at nibh finibus, pulvinar sem sit amet, posuere velit. Nullam a dui diam. Etiam feugiat tincidunt nulla eget sodales. Praesent pulvinar erat eu nunc accumsan, a volutpat lacus porttitor. Duis dictum odio blandit aliquet congue. Aenean in arcu felis. Pellentesque commodo posuere tempor. Sed imperdiet risus ut ante elementum pulvinar. Suspendisse lobortis sem eget consectetur consequat. Mauris ac sapien sit amet est gravida ultrices. Maecenas sed rhoncus ligula. Sed dictum malesuada consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque eu efficitur odio. Duis pulvinar mauris at est blandit tempor.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer sed erat a eros fermentum porta eget non eros. Vestibulum tellus justo, suscipit placerat pellentesque eget, viverra venenatis massa. Nam cursus commodo vehicula. Ut rutrum consectetur augue nec tristique. Sed aliquam auctor dignissim. Nulla fermentum ex diam, id suscipit quam cursus eget. Quisque laoreet iaculis tempor. In ac dapibus ipsum. In hac habitasse platea dictumst. Aliquam molestie pulvinar facilisis. Donec in justo libero. Proin suscipit odio at nibh ultricies, vel bibendum est auctor. Vestibulum ultricies magna vitae ornare mollis. Etiam venenatis, ante eu tincidunt porttitor, justo sapien condimentum velit, condimentum tempor libero mauris ultrices purus.</p>','2018-11-07','Lorem Ipsum','Florian\r\nRADUREAU',1,0),(2,1,44,'<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in pulvinar purus. Vestibulum porttitor commodo arcu ac pretium. Sed et tempus metus. Donec sit amet lorem vitae erat porttitor finibus id nec ipsum. Suspendisse ac hendrerit risus. Quisque consequat nunc quis facilisis pharetra. Donec sit amet mi sagittis, hendrerit magna quis, tempor elit. Quisque porttitor, metus ac aliquet dictum, lectus orci bibendum ligula, a rutrum neque ante vel erat. Nulla vestibulum interdum convallis. Donec quis nisi id odio tempor porttitor. Donec tempor tellus tortor, eu mollis magna blandit eget. Donec posuere eu mi et lobortis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer vitae justo tristique, gravida velit rutrum, faucibus massa. Maecenas eget nulla placerat, iaculis sem posuere, lacinia odio. Proin non consectetur nisl. Sed nibh lacus, gravida a tempor sed, rutrum vitae massa. Pellentesque rutrum, massa ut facilisis bibendum, eros arcu varius metus, in vehicula magna nulla et tellus. Praesent tempus congue urna, at suscipit sem convallis sit amet. In hac habitasse platea dictumst. Cras porta, diam non tristique posuere, est arcu aliquet velit, quis dictum eros purus a nibh.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer nec luctus enim. Vivamus porttitor vestibulum quam, vitae bibendum mauris lacinia eu. Pellentesque non scelerisque purus. Quisque mattis massa in erat rhoncus auctor. Maecenas vel lorem sapien. Nunc pellentesque molestie erat a vestibulum. Nunc maximus nunc quam, sit amet pellentesque lorem molestie ac. Sed mattis augue lorem, quis efficitur mi finibus et. Nulla eget dolor non purus viverra rutrum at in sem. Nulla suscipit iaculis aliquam. Integer congue sed nunc et aliquam. Integer tincidunt dui lacus, a ullamcorper ante elementum nec. Suspendisse potenti. Aliquam semper nisi lectus, in dictum odio accumsan ut. Morbi lacinia eu lorem in facilisis. Donec id malesuada urna.</p>','2018-11-07','Nouveautés dans Symfony 4','Florian\r\nRADUREAU',1,0),(3,5,44,'<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in pulvinar purus. Vestibulum porttitor commodo arcu ac pretium. Sed et tempus metus. Donec sit amet lorem vitae erat porttitor finibus id nec ipsum. Suspendisse ac hendrerit risus. Quisque consequat nunc quis facilisis pharetra. Donec sit amet mi sagittis, hendrerit magna quis, tempor elit. Quisque porttitor, metus ac aliquet dictum, lectus orci bibendum ligula, a rutrum neque ante vel erat. Nulla vestibulum interdum convallis. Donec quis nisi id odio tempor porttitor. Donec tempor tellus tortor, eu mollis magna blandit eget. Donec posuere eu mi et lobortis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer vitae justo tristique, gravida velit rutrum, faucibus massa. Maecenas eget nulla placerat, iaculis sem posuere, lacinia odio. Proin non consectetur nisl. Sed nibh lacus, gravida a tempor sed, rutrum vitae massa. Pellentesque rutrum, massa ut facilisis bibendum, eros arcu varius metus, in vehicula magna nulla et tellus. Praesent tempus congue urna, at suscipit sem convallis sit amet. In hac habitasse platea dictumst. Cras porta, diam non tristique posuere, est arcu aliquet velit, quis dictum eros purus a nibh.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer nec luctus enim. Vivamus porttitor vestibulum quam, vitae bibendum mauris lacinia eu. Pellentesque non scelerisque purus. Quisque mattis massa in erat rhoncus auctor. Maecenas vel lorem sapien. Nunc pellentesque molestie erat a vestibulum. Nunc maximus nunc quam, sit amet pellentesque lorem molestie ac. Sed mattis augue lorem, quis efficitur mi finibus et. Nulla eget dolor non purus viverra rutrum at in sem. Nulla suscipit iaculis aliquam. Integer congue sed nunc et aliquam. Integer tincidunt dui lacus, a ullamcorper ante elementum nec. Suspendisse potenti. Aliquam semper nisi lectus, in dictum odio accumsan ut. Morbi lacinia eu lorem in facilisis. Donec id malesuada urna.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nunc at nibh finibus, pulvinar sem sit amet, posuere velit. Nullam a dui diam. Etiam feugiat tincidunt nulla eget sodales. Praesent pulvinar erat eu nunc accumsan, a volutpat lacus porttitor. Duis dictum odio blandit aliquet congue. Aenean in arcu felis. Pellentesque commodo posuere tempor. Sed imperdiet risus ut ante elementum pulvinar. Suspendisse lobortis sem eget consectetur consequat. Mauris ac sapien sit amet est gravida ultrices. Maecenas sed rhoncus ligula. Sed dictum malesuada consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque eu efficitur odio. Duis pulvinar mauris at est blandit tempor.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer sed erat a eros fermentum porta eget non eros. Vestibulum tellus justo, suscipit placerat pellentesque eget, viverra venenatis massa. Nam cursus commodo vehicula. Ut rutrum consectetur augue nec tristique. Sed aliquam auctor dignissim. Nulla fermentum ex diam, id suscipit quam cursus eget. Quisque laoreet iaculis tempor. In ac dapibus ipsum. In hac habitasse platea dictumst. Aliquam molestie pulvinar facilisis. Donec in justo libero. Proin suscipit odio at nibh ultricies, vel bibendum est auctor. Vestibulum ultricies magna vitae ornare mollis. Etiam venenatis, ante eu tincidunt porttitor, justo sapien condimentum velit, condimentum tempor libero mauris ultrices purus.</p>','2018-11-07','Comment créer un article','Florian\r\nRADUREAU',1,0),(4,2,44,'<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in pulvinar purus. Vestibulum porttitor commodo arcu ac pretium. Sed et tempus metus. Donec sit amet lorem vitae erat porttitor finibus id nec ipsum. Suspendisse ac hendrerit risus. Quisque consequat nunc quis facilisis pharetra. Donec sit amet mi sagittis, hendrerit magna quis, tempor elit. Quisque porttitor, metus ac aliquet dictum, lectus orci bibendum ligula, a rutrum neque ante vel erat. Nulla vestibulum interdum convallis. Donec quis nisi id odio tempor porttitor. Donec tempor tellus tortor, eu mollis magna blandit eget. Donec posuere eu mi et lobortis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer nec luctus enim. Vivamus porttitor vestibulum quam, vitae bibendum mauris lacinia eu. Pellentesque non scelerisque purus. Quisque mattis massa in erat rhoncus auctor. Maecenas vel lorem sapien. Nunc pellentesque molestie erat a vestibulum. Nunc maximus nunc quam, sit amet pellentesque lorem molestie ac. Sed mattis augue lorem, quis efficitur mi finibus et. Nulla eget dolor non purus viverra rutrum at in sem. Nulla suscipit iaculis aliquam. Integer congue sed nunc et aliquam. Integer tincidunt dui lacus, a ullamcorper ante elementum nec. Suspendisse potenti. Aliquam semper nisi lectus, in dictum odio accumsan ut. Morbi lacinia eu lorem in facilisis. Donec id malesuada urna.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer sed erat a eros fermentum porta eget non eros. Vestibulum tellus justo, suscipit placerat pellentesque eget, viverra venenatis massa. Nam cursus commodo vehicula. Ut rutrum consectetur augue nec tristique. Sed aliquam auctor dignissim. Nulla fermentum ex diam, id suscipit quam cursus eget. Quisque laoreet iaculis tempor. In ac dapibus ipsum. In hac habitasse platea dictumst. Aliquam molestie pulvinar facilisis. Donec in justo libero. Proin suscipit odio at nibh ultricies, vel bibendum est auctor. Vestibulum ultricies magna vitae ornare mollis. Etiam venenatis, ante eu tincidunt porttitor, justo sapien condimentum velit, condimentum tempor libero mauris ultrices purus.</p>','2018-11-07','Le JavaScript, c\'est pratique !','Florian\r\nRADUREAU',1,0),(5,1,44,'<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in pulvinar purus. Vestibulum porttitor commodo arcu ac pretium. Sed et tempus metus. Donec sit amet lorem vitae erat porttitor finibus id nec ipsum. Suspendisse ac hendrerit risus. Quisque consequat nunc quis facilisis pharetra. Donec sit amet mi sagittis, hendrerit magna quis, tempor elit. Quisque porttitor, metus ac aliquet dictum, lectus orci bibendum ligula, a rutrum neque ante vel erat. Nulla vestibulum interdum convallis. Donec quis nisi id odio tempor porttitor. Donec tempor tellus tortor, eu mollis magna blandit eget. Donec posuere eu mi et lobortis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer vitae justo tristique, gravida velit rutrum, faucibus massa. Maecenas eget nulla placerat, iaculis sem posuere, lacinia odio. Proin non consectetur nisl. Sed nibh lacus, gravida a tempor sed, rutrum vitae massa. Pellentesque rutrum, massa ut facilisis bibendum, eros arcu varius metus, in vehicula magna nulla et tellus. Praesent tempus congue urna, at suscipit sem convallis sit amet. In hac habitasse platea dictumst. Cras porta, diam non tristique posuere, est arcu aliquet velit, quis dictum eros purus a nibh.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer nec luctus enim. Vivamus porttitor vestibulum quam, vitae bibendum mauris lacinia eu. Pellentesque non scelerisque purus. Quisque mattis massa in erat rhoncus auctor. Maecenas vel lorem sapien. Nunc pellentesque molestie erat a vestibulum. Nunc maximus nunc quam, sit amet pellentesque lorem molestie ac. Sed mattis augue lorem, quis efficitur mi finibus et. Nulla eget dolor non purus viverra rutrum at in sem. Nulla suscipit iaculis aliquam. Integer congue sed nunc et aliquam. Integer tincidunt dui lacus, a ullamcorper ante elementum nec. Suspendisse potenti. Aliquam semper nisi lectus, in dictum odio accumsan ut. Morbi lacinia eu lorem in facilisis. Donec id malesuada urna.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nunc at nibh finibus, pulvinar sem sit amet, posuere velit. Nullam a dui diam. Etiam feugiat tincidunt nulla eget sodales. Praesent pulvinar erat eu nunc accumsan, a volutpat lacus porttitor. Duis dictum odio blandit aliquet congue. Aenean in arcu felis. Pellentesque commodo posuere tempor. Sed imperdiet risus ut ante elementum pulvinar. Suspendisse lobortis sem eget consectetur consequat. Mauris ac sapien sit amet est gravida ultrices. Maecenas sed rhoncus ligula. Sed dictum malesuada consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque eu efficitur odio. Duis pulvinar mauris at est blandit tempor.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer sed erat a eros fermentum porta eget non eros. Vestibulum tellus justo, suscipit placerat pellentesque eget, viverra venenatis massa. Nam cursus commodo vehicula. Ut rutrum consectetur augue nec tristique. Sed aliquam auctor dignissim. Nulla fermentum ex diam, id suscipit quam cursus eget. Quisque laoreet iaculis tempor. In ac dapibus ipsum. In hac habitasse platea dictumst. Aliquam molestie pulvinar facilisis. Donec in justo libero. Proin suscipit odio at nibh ultricies, vel bibendum est auctor. Vestibulum ultricies magna vitae ornare mollis. Etiam venenatis, ante eu tincidunt porttitor, justo sapien condimentum velit, condimentum tempor libero mauris ultrices purus.</p>','2018-11-07','Vive le PHP !','Florian\r\nRADUREAU',1,0),(6,2,44,'<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in pulvinar purus. Vestibulum porttitor commodo arcu ac pretium. Sed et tempus metus. Donec sit amet lorem vitae erat porttitor finibus id nec ipsum. Suspendisse ac hendrerit risus. Quisque consequat nunc quis facilisis pharetra. Donec sit amet mi sagittis, hendrerit magna quis, tempor elit. Quisque porttitor, metus ac aliquet dictum, lectus orci bibendum ligula, a rutrum neque ante vel erat. Nulla vestibulum interdum convallis. Donec quis nisi id odio tempor porttitor. Donec tempor tellus tortor, eu mollis magna blandit eget. Donec posuere eu mi et lobortis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer vitae justo tristique, gravida velit rutrum, faucibus massa. Maecenas eget nulla placerat, iaculis sem posuere, lacinia odio. Proin non consectetur nisl. Sed nibh lacus, gravida a tempor sed, rutrum vitae massa. Pellentesque rutrum, massa ut facilisis bibendum, eros arcu varius metus, in vehicula magna nulla et tellus. Praesent tempus congue urna, at suscipit sem convallis sit amet. In hac habitasse platea dictumst. Cras porta, diam non tristique posuere, est arcu aliquet velit, quis dictum eros purus a nibh.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer nec luctus enim. Vivamus porttitor vestibulum quam, vitae bibendum mauris lacinia eu. Pellentesque non scelerisque purus. Quisque mattis massa in erat rhoncus auctor. Maecenas vel lorem sapien. Nunc pellentesque molestie erat a vestibulum. Nunc maximus nunc quam, sit amet pellentesque lorem molestie ac. Sed mattis augue lorem, quis efficitur mi finibus et. Nulla eget dolor non purus viverra rutrum at in sem. Nulla suscipit iaculis aliquam. Integer congue sed nunc et aliquam. Integer tincidunt dui lacus, a ullamcorper ante elementum nec. Suspendisse potenti. Aliquam semper nisi lectus, in dictum odio accumsan ut. Morbi lacinia eu lorem in facilisis. Donec id malesuada urna.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nunc at nibh finibus, pulvinar sem sit amet, posuere velit. Nullam a dui diam. Etiam feugiat tincidunt nulla eget sodales. Praesent pulvinar erat eu nunc accumsan, a volutpat lacus porttitor. Duis dictum odio blandit aliquet congue. Aenean in arcu felis. Pellentesque commodo posuere tempor. Sed imperdiet risus ut ante elementum pulvinar. Suspendisse lobortis sem eget consectetur consequat. Mauris ac sapien sit amet est gravida ultrices. Maecenas sed rhoncus ligula. Sed dictum malesuada consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque eu efficitur odio. Duis pulvinar mauris at est blandit tempor.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer sed erat a eros fermentum porta eget non eros. Vestibulum tellus justo, suscipit placerat pellentesque eget, viverra venenatis massa. Nam cursus commodo vehicula. Ut rutrum consectetur augue nec tristique. Sed aliquam auctor dignissim. Nulla fermentum ex diam, id suscipit quam cursus eget. Quisque laoreet iaculis tempor. In ac dapibus ipsum. In hac habitasse platea dictumst. Aliquam molestie pulvinar facilisis. Donec in justo libero. Proin suscipit odio at nibh ultricies, vel bibendum est auctor. Vestibulum ultricies magna vitae ornare mollis. Etiam venenatis, ante eu tincidunt porttitor, justo sapien condimentum velit, condimentum tempor libero mauris ultrices purus.</p>','2018-11-07','React','Florian\r\nRADUREAU',1,0),(7,3,44,'<p>Gr&acirc;ce au super filtre d\'articles du site Hacker News en page d\'accueil, vous pouvez d&eacute;sormais avoir acc&egrave;s &agrave; l\'actualit&eacute; tech. Merci &agrave; la d&eacute;veloppeuse qui l\'a mis en place rien que pour nous ! =)</p>','2018-11-07','Plus d\'excuse pour ne pas faire sa veille','Florian\r\nRADUREAU',1,0),(8,1,44,'<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in pulvinar purus. Vestibulum porttitor commodo arcu ac pretium. Sed et tempus metus. Donec sit amet lorem vitae erat porttitor finibus id nec ipsum. Suspendisse ac hendrerit risus. Quisque consequat nunc quis facilisis pharetra. Donec sit amet mi sagittis, hendrerit magna quis, tempor elit. Quisque porttitor, metus ac aliquet dictum, lectus orci bibendum ligula, a rutrum neque ante vel erat. Nulla vestibulum interdum convallis. Donec quis nisi id odio tempor porttitor. Donec tempor tellus tortor, eu mollis magna blandit eget. Donec posuere eu mi et lobortis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer vitae justo tristique, gravida velit rutrum, faucibus massa. Maecenas eget nulla placerat, iaculis sem posuere, lacinia odio. Proin non consectetur nisl. Sed nibh lacus, gravida a tempor sed, rutrum vitae massa. Pellentesque rutrum, massa ut facilisis bibendum, eros arcu varius metus, in vehicula magna nulla et tellus. Praesent tempus congue urna, at suscipit sem convallis sit amet. In hac habitasse platea dictumst. Cras porta, diam non tristique posuere, est arcu aliquet velit, quis dictum eros purus a nibh.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer nec luctus enim. Vivamus porttitor vestibulum quam, vitae bibendum mauris lacinia eu. Pellentesque non scelerisque purus. Quisque mattis massa in erat rhoncus auctor. Maecenas vel lorem sapien. Nunc pellentesque molestie erat a vestibulum. Nunc maximus nunc quam, sit amet pellentesque lorem molestie ac. Sed mattis augue lorem, quis efficitur mi finibus et. Nulla eget dolor non purus viverra rutrum at in sem. Nulla suscipit iaculis aliquam. Integer congue sed nunc et aliquam. Integer tincidunt dui lacus, a ullamcorper ante elementum nec. Suspendisse potenti. Aliquam semper nisi lectus, in dictum odio accumsan ut. Morbi lacinia eu lorem in facilisis. Donec id malesuada urna.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nunc at nibh finibus, pulvinar sem sit amet, posuere velit. Nullam a dui diam. Etiam feugiat tincidunt nulla eget sodales. Praesent pulvinar erat eu nunc accumsan, a volutpat lacus porttitor. Duis dictum odio blandit aliquet congue. Aenean in arcu felis. Pellentesque commodo posuere tempor. Sed imperdiet risus ut ante elementum pulvinar. Suspendisse lobortis sem eget consectetur consequat. Mauris ac sapien sit amet est gravida ultrices. Maecenas sed rhoncus ligula. Sed dictum malesuada consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque eu efficitur odio. Duis pulvinar mauris at est blandit tempor.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer sed erat a eros fermentum porta eget non eros. Vestibulum tellus justo, suscipit placerat pellentesque eget, viverra venenatis massa. Nam cursus commodo vehicula. Ut rutrum consectetur augue nec tristique. Sed aliquam auctor dignissim. Nulla fermentum ex diam, id suscipit quam cursus eget. Quisque laoreet iaculis tempor. In ac dapibus ipsum. In hac habitasse platea dictumst. Aliquam molestie pulvinar facilisis. Donec in justo libero. Proin suscipit odio at nibh ultricies, vel bibendum est auctor. Vestibulum ultricies magna vitae ornare mollis. Etiam venenatis, ante eu tincidunt porttitor, justo sapien condimentum velit, condimentum tempor libero mauris ultrices purus.</p>','2018-11-07','Trouvons des idées d\'article','Florian\r\nRADUREAU',1,0),(9,1,44,'<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in pulvinar purus. Vestibulum porttitor commodo arcu ac pretium. Sed et tempus metus. Donec sit amet lorem vitae erat porttitor finibus id nec ipsum. Suspendisse ac hendrerit risus. Quisque consequat nunc quis facilisis pharetra. Donec sit amet mi sagittis, hendrerit magna quis, tempor elit. Quisque porttitor, metus ac aliquet dictum, lectus orci bibendum ligula, a rutrum neque ante vel erat. Nulla vestibulum interdum convallis. Donec quis nisi id odio tempor porttitor. Donec tempor tellus tortor, eu mollis magna blandit eget. Donec posuere eu mi et lobortis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer vitae justo tristique, gravida velit <strong><em>simple-mvc &agrave; revoir</em></strong> rutrum, faucibus massa. Maecenas eget nulla placerat, iaculis sem posuere, lacinia odio. Proin non consectetur nisl. Sed nibh lacus, gravida a tempor sed, rutrum vitae massa. Pellentesque rutrum, massa ut facilisis bibendum, eros arcu varius metus, in vehicula magna nulla et tellus. Praesent tempus congue urna, at suscipit sem convallis sit amet. In hac habitasse platea dictumst. Cras porta, diam non tristique posuere, est arcu aliquet velit, quis dictum eros purus a nibh.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer nec luctus enim. Vivamus porttitor vestibulum quam, vitae bibendum mauris lacinia eu. Pellentesque non scelerisque purus. Quisque mattis massa in erat rhoncus auctor. Maecenas vel lorem sapien. Nunc pellentesque molestie erat a vestibulum. <strong><em>Il a fallu tout coder !</em></strong> Nunc maximus nunc quam, sit amet pellentesque lorem molestie ac. Sed mattis augue lorem, quis efficitur mi finibus et. Nulla eget dolor non purus viverra rutrum at in sem. Nulla suscipit iaculis aliquam. Integer congue sed nunc et aliquam. Integer tincidunt dui lacus, a ullamcorper ante elementum nec. Suspendisse potenti. Aliquam semper nisi lectus, in dictum odio accumsan ut. Morbi lacinia eu lorem in facilisis. Donec id malesuada urna.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nunc at nibh finibus, pulvinar sem sit amet, posuere velit. Nullam a dui diam. Etiam feugiat tincidunt nulla eget sodales. Praesent pulvinar erat eu nunc accumsan, a volutpat lacus porttitor. Duis dictum odio blandit aliquet congue. Aenean in arcu felis. Pellentesque commodo posuere tempor. <strong><em>Au d&eacute;but c\'&eacute;tait la gal&egrave;re</em></strong>, sed imperdiet risus ut ante elementum pulvinar. Suspendisse lobortis sem eget consectetur consequat. Mauris ac sapien sit amet est gravida ultrices. Maecenas sed rhoncus ligula. Sed dictum malesuada consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque eu efficitur odio. Duis pulvinar mauris at est blandit tempor.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Integer sed erat a eros fermentum porta eget non eros. Vestibulum tellus justo, suscipit placerat pellentesque eget, viverra venenatis massa. Nam cursus commodo vehicula. Ut rutrum consectetur augue nec tristique. Sed aliquam, <strong><em>maintenant on g&egrave;re</em></strong> ! Nulla fermentum ex diam, id suscipit quam cursus eget. Quisque laoreet iaculis tempor. In ac dapibus ipsum. In hac habitasse platea dictumst. Aliquam molestie pulvinar facilisis. Donec in justo libero. Proin suscipit odio at nibh ultricies, vel bibendum est auctor. Vestibulum ultricies magna vitae ornare mollis. Etiam venenatis, ante eu tincidunt porttitor, justo sapien condimentum velit, condimentum tempor libero mauris ultrices purus.</p>','2018-11-07','Simple-mvc ou comment il nous tarde de passer à Symfony','Florian\r\nRADUREAU',1,0);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `isActive` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'PHP',0),(2,'Javascript',0),(3,'Veilles',0),(4,'Divers',0),(5,'Aide',0),(6,'HTML',1),(7,'HTML',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `idArticle` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`idUser`),
  KEY `id_article` (`idArticle`),
  CONSTRAINT `user_fk` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (14,NULL,19,'aa','2018-10-25');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameLanguage` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES (1,'PHP'),(4,'Javascript');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo`
--

LOCK TABLES `promo` WRITE;
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;
INSERT INTO `promo` VALUES (3,'2019-01'),(5,'2019-03'),(6,'2018-09');
/*!40000 ALTER TABLE `promo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `firstName` varchar(16) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `isAdmin` int(1) DEFAULT NULL,
  `avatar` varchar(64) DEFAULT '/assets/images/logo.png',
  `password` varchar(255) DEFAULT NULL,
  `code` text,
  `birthDate` varchar(16) DEFAULT NULL,
  `phoneNumber` varchar(16) DEFAULT NULL,
  `gitHub` varchar(64) DEFAULT NULL,
  `linkedin` varchar(64) DEFAULT NULL,
  `odyssey` varchar(64) DEFAULT NULL,
  `idPromo` int(11) DEFAULT NULL,
  `idLanguage` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promo` (`idPromo`),
  KEY `idLanguage` (`idLanguage`),
  CONSTRAINT `language_fk` FOREIGN KEY (`idLanguage`) REFERENCES `language` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `promo_fk` FOREIGN KEY (`idPromo`) REFERENCES `promo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (44,'fradureau@gmail.com','florian','radureau',1,'/assets/images/44.JPG','$2y$10$yoa7nGMOJaGoqhkmt.tvSefV.eSLP5HlSYyllIQ11qbzSQdi89jaG','0','1991-07-23','','https://github.com/florianRadureau','https://www.linkedin.com/in/florian-radureau-161662bb/','',6,1),(64,'s.dailliez@gmail.com','Steven','Antal',0,'/assets/images/64.JPG',NULL,'$2y$10$FsPmV65BhjoyGYv1RRGcseWu4keyh.2UYf76mk0MpcxgLUqJ.6uUK',NULL,'','','','',6,4),(65,'vinchent_maureen@gmail.com','Maureen','Vinchent',0,'/assets/images/65.JPG',NULL,'$2y$10$63vyGE.1pjdpHQgP2lxwR.rcnNXVbznzvgj3x7BcSkflH648A.ZPC',NULL,'','','','',6,4),(66,'malutaantoine@gmail.com','Antoine','Maluta',0,'/assets/images/66.JPG',NULL,'$2y$10$CieWfGe./y6X/fiyj/7qpOs0vY38GEoTH9EvwFTUvQaKXQL/V9YD6',NULL,'','','','',6,4),(67,'duhamelni@gmail.com','Nicolas','Duhamel',0,'/assets/images/67.JPG',NULL,'$2y$10$ZYzbEhS7tpaJK25Aid61LOZsG/5gB2cLEgRT.PIcQS2Eo9gCzv8vK',NULL,'','','','',6,4),(68,'emilie.boeglen@gmail.com','Emilie','Boeglen',0,'/assets/images/68.JPG',NULL,'$2y$10$pKcPIcymLFJIzKkTX1zkTOF/4SjQCU3Zrdu2ZbpkendkYfFp4H3GO',NULL,'','','','',6,4),(69,'gaveaufrancoisaxel@gmail.com','François-Axel','Gaveau',0,'/assets/images/69.JPG',NULL,'$2y$10$Fb5vSw2JvLCnBjrMXvLMIulG6cQoE1HrijjuYCbJ4.nT/vGNEZFm6',NULL,'','','','',6,4),(70,'arlensiu.celis@gmail.com','Arlensiù','Celis',0,'/assets/images/70.JPG',NULL,'$2y$10$iAeNXgFTkfnC6sU74ORORO2JhSqXQTdnV9qppEZq1sXzO6WC3o.lu',NULL,'','','','',6,4),(71,'emmaemobaka@gmail.com','Emma','Kimpe',0,'/assets/images/71.JPG',NULL,'$2y$10$WzL27WGizFOtb4WZ5aj4Fu5x7wzov67PNkLcw3FcTwQP7.pr1wcW2',NULL,'','','','',6,4),(72,'jeanmichbravo@gmail.com','Jean-Michel','Bravo',0,'/assets/images/72.JPG',NULL,'$2y$10$hAmgZkvaGR.yESE3i3HSEuHYDsf/oIdIsCzbzIEcMBER3k3jk8Sju',NULL,'','','','',6,4),(73,'elie1delattre@gmail.com','Elie','Delattre',0,'/assets/images/73.JPG',NULL,'$2y$10$OaCfWcdOwtsFFNuaeD7j4uaSZD2iOnEIbR64psRISr.7zBl5cnkm.',NULL,'','','','',6,4),(74,'sy.thomas.pro@gmail.com','Thomas','Sy',0,'/assets/images/74.JPG',NULL,'$2y$10$XxoDGpW2rei2d6kU9V3IcOQDW9Q0c7zSQGnGdMz.mQMsVaoCd00NW',NULL,'','','','',6,1),(75,'jer.vignerot@gmail.com','Jerôme','Vignerot',0,'/assets/images/75.JPG',NULL,'$2y$10$MbJ7TZ.M/ZoRw7g5q63ASOBd3iDGdhvl0VuQn1LWnDwJqZOvLsAey',NULL,'','','','',6,1),(76,'vincent.leschaeve@gmail.com','Vincent','Leschaeve',0,'/assets/images/76.JPG',NULL,'$2y$10$WEsOPdD9N63jtyNWH5Yf4eNGsoZtbu/HsJjq37x6nu2lEhOOVz6mu',NULL,'','','','',6,1),(77,'julie.delmas33@gmail.com','Julie','Delmas',0,'/assets/images/77.JPG',NULL,'$2y$10$r766cTFpbsKymy3dWwVrQ.yBsksP8w8cecVv.Mt68iK3biOWi3ryu',NULL,'','','','',6,1),(78,'juju.sambon@gmail.com','Julien','Sambon',0,'/assets/images/78.JPG',NULL,'$2y$10$/aDYSb34QZQEcyBbb4eyyusb.MVSMk0ieFCUsGHFWXdHxYrr6DPq6',NULL,'','','','',6,1),(79,'vladimirsolovyev9@gmail.com','Vladimir','Solovyev',0,'/assets/images/79.JPG',NULL,'$2y$10$DRxVSmSUXpU/DJqgtxZrDOLAAWZGhF4w9omC6cuDSsU2KkLTaiJO.',NULL,'','','','',6,1),(80,'ma.castelain@gmail.com','Marc-Antoine','Castelain',0,'/assets/images/80.JPG',NULL,'$2y$10$YcEANeVPztSA7Ljrw4ehd.mtBhyELdHhB1z8e/NFyPUhRAESkH7Xe',NULL,'','','','',6,1),(81,'fleurcastel.pro@gmail.com','Fleur','Castel',0,'/assets/images/81.JPG',NULL,'$2y$10$n61fNWvf4WNGXZtmjMEh4.JR2BitfOUeB8bBtqCzxz.vwfaJJK.Q6',NULL,'','','','',6,1),(82,'samiaid2@gmail.com','Sami','Aid',0,'/assets/images/82.JPG',NULL,'$2y$10$rWBHyjLi1WLDRS0.vIpZaOrBuA2Q5jWQW6.mpybDI3OCkVLnqsV4u',NULL,'','','','',6,1),(83,'nicollasbogucki@gmail.com','Nicolas','Bogucki',0,'/assets/images/83.JPG',NULL,'$2y$10$3p3K1rWZ0z9YpJj32.EFSu9t0Ux.cYVzj2av0z6ebIz.gMu.BYAu.',NULL,'','','','',6,1);
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

-- Dump completed on 2018-11-07 14:36:29
