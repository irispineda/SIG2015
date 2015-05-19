-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2015 at 05:45 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sig`
--

-- --------------------------------------------------------

--
-- Table structure for table `contribuyente`
--

CREATE TABLE IF NOT EXISTS `contribuyente` (
  `ident` int(11) NOT NULL COMMENT 'Identificador unico',
  `codigo` varchar(45) DEFAULT NULL COMMENT 'Codigo de contribuyente',
  `nombre` varchar(150) DEFAULT NULL COMMENT 'Nombre según documento del contribuyente',
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla de contribuyentes';

-- --------------------------------------------------------

--
-- Table structure for table `rptestra1`
--

CREATE TABLE IF NOT EXISTS `rptestra1` (
  `ident` int(11) NOT NULL COMMENT 'Identificador unico del registro',
  `anio` int(11) DEFAULT NULL COMMENT 'Año del registro',
  `zona` int(11) DEFAULT NULL COMMENT 'Codigo de zona',
  `meses` int(11) DEFAULT NULL COMMENT 'Numero de meses adeudados',
  `deudor` int(11) DEFAULT NULL COMMENT 'Deudor',
  `monto` decimal(16,2) DEFAULT NULL COMMENT 'Monto total de la deuda',
  PRIMARY KEY (`ident`),
  KEY `rptestra1_zona_idx` (`zona`),
  KEY `rptestra1_contribuyente_idx` (`deudor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Nivel Estrátegico-Reporte 1. Reporte de contribuyentes morosos mayor a tres meses';

-- --------------------------------------------------------

--
-- Table structure for table `zona`
--

CREATE TABLE IF NOT EXISTS `zona` (
  `ident` int(11) NOT NULL COMMENT 'Identificador unico del registro',
  `codigo` varchar(45) DEFAULT NULL COMMENT 'Codigo de la zona',
  `descripcion` varchar(150) DEFAULT NULL COMMENT 'Descripcion de la zona',
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Catalogo de zonas';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rptestra1`
--
ALTER TABLE `rptestra1`
  ADD CONSTRAINT `rptestra1_contribuyente` FOREIGN KEY (`deudor`) REFERENCES `contribuyente` (`ident`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rptestra1_zona` FOREIGN KEY (`zona`) REFERENCES `zona` (`ident`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
