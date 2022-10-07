-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.22-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para librerias
CREATE DATABASE IF NOT EXISTS `librerias` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `librerias`;

-- Volcando estructura para tabla librerias.bookmarks
CREATE TABLE IF NOT EXISTS `bookmarks` (
  `Book ID` varchar(50) NOT NULL DEFAULT '',
  `User ID` varchar(50) NOT NULL,
  PRIMARY KEY (`Book ID`,`User ID`),
  KEY `Book ID` (`Book ID`),
  KEY `Used ID` (`User ID`),
  CONSTRAINT `Book ID M` FOREIGN KEY (`Book ID`) REFERENCES `libro` (`Book ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `User ID M` FOREIGN KEY (`User ID`) REFERENCES `usuario` (`Used ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla librerias.capitulo
CREATE TABLE IF NOT EXISTS `capitulo` (
  `Chapter_ID` varchar(50) NOT NULL,
  `Book ID` varchar(50) NOT NULL,
  `Chapter Num` int(10) DEFAULT NULL,
  `Texto` longtext DEFAULT NULL,
  PRIMARY KEY (`Chapter_ID`,`Book ID`),
  KEY `Book ID` (`Book ID`),
  CONSTRAINT `Book ID` FOREIGN KEY (`Book ID`) REFERENCES `libro` (`Book ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla librerias.comentario capitulo
CREATE TABLE IF NOT EXISTS `comentario capitulo` (
  `Comentario ID` varchar(50) NOT NULL DEFAULT '',
  `User ID` varchar(50) NOT NULL DEFAULT '',
  `Chapter_ID` varchar(50) NOT NULL,
  `Book ID` varchar(50) NOT NULL,
  `Texto` mediumtext DEFAULT NULL,
  PRIMARY KEY (`Comentario ID`,`User ID`,`Chapter_ID`,`Book ID`),
  KEY `Chapter_ID` (`Chapter_ID`),
  KEY `Book ID` (`Book ID`),
  KEY `User ID` (`User ID`),
  CONSTRAINT `Book ID C` FOREIGN KEY (`Book ID`) REFERENCES `capitulo` (`Book ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Chapter ID C` FOREIGN KEY (`Chapter_ID`) REFERENCES `capitulo` (`Chapter_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `User ID C` FOREIGN KEY (`User ID`) REFERENCES `usuario` (`Used ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla librerias.comentario libro
CREATE TABLE IF NOT EXISTS `comentario libro` (
  `Comentario ID` varchar(50) NOT NULL DEFAULT '',
  `User ID` varchar(50) NOT NULL DEFAULT '',
  `Book ID` varchar(50) NOT NULL DEFAULT '',
  `Texto` mediumtext DEFAULT NULL,
  PRIMARY KEY (`Comentario ID`,`User ID`,`Book ID`),
  KEY `User ID` (`User ID`),
  KEY `Book ID` (`Book ID`),
  CONSTRAINT `Book ID L` FOREIGN KEY (`Book ID`) REFERENCES `capitulo` (`Chapter_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `User ID L` FOREIGN KEY (`User ID`) REFERENCES `usuario` (`Used ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla librerias.libro
CREATE TABLE IF NOT EXISTS `libro` (
  `Book ID` varchar(50) NOT NULL DEFAULT '',
  `Nota` decimal(2,1) NOT NULL DEFAULT 0.0,
  `img` longblob DEFAULT NULL,
  PRIMARY KEY (`Book ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla librerias.review
CREATE TABLE IF NOT EXISTS `review` (
  `Used ID` varchar(50) NOT NULL,
  `Book ID` varchar(50) NOT NULL,
  `Nota` decimal(2,1) NOT NULL DEFAULT 0.0,
  `ID Review` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Used ID`,`Book ID`,`ID Review`),
  KEY `Book ID` (`Book ID`),
  KEY `Used ID` (`Used ID`),
  CONSTRAINT `Book ID R` FOREIGN KEY (`Book ID`) REFERENCES `libro` (`Book ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `User ID R` FOREIGN KEY (`Used ID`) REFERENCES `usuario` (`Used ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla librerias.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `Used ID` varchar(50) NOT NULL DEFAULT '',
  `Password` varchar(50) NOT NULL DEFAULT '',
  `img` longblob DEFAULT NULL,
  PRIMARY KEY (`Used ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tendra unas cuantas cosas dentro de si, como contraseña, nombreID, Lista de Libros';

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
