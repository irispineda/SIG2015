-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2015 at 04:00 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `rptestra1`
--

CREATE TABLE IF NOT EXISTS `rptestra1` (
  `ident` int(11) NOT NULL COMMENT 'Identificador unico del registro',
  `anio` int(11) DEFAULT NULL COMMENT 'Año del registro',
  `cod_zona` varchar(45) DEFAULT NULL COMMENT 'Codigo de zona',
  `des_zona` varchar(150) DEFAULT NULL,
  `meses` varchar(45) DEFAULT NULL COMMENT 'Numero de meses adeudados',
  `deudor` varchar(500) DEFAULT NULL COMMENT 'Deudor',
  `monto` decimal(16,2) DEFAULT NULL COMMENT 'Monto total de la deuda',
  PRIMARY KEY (`ident`),
  KEY `rptestra1_zona_idx` (`cod_zona`),
  KEY `rptestra1_contribuyente_idx` (`deudor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Nivel Estrátegico-Reporte 1. Reporte de contribuyentes morosos mayor a tres meses';

-- --------------------------------------------------------

--
-- Table structure for table `rptestra2`
--

CREATE TABLE IF NOT EXISTS `rptestra2` (
  `ident` int(11) NOT NULL,
  `cod_zona` varchar(45) DEFAULT NULL,
  `des_zona` varchar(150) DEFAULT NULL,
  `contribuyente` int(11) DEFAULT NULL,
  `finicio` date DEFAULT NULL,
  `ffin` date DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  `saldo` decimal(16,2) DEFAULT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='CONTROL DE CONVENIOS DE PAGOS POR PERIODO';

-- --------------------------------------------------------

--
-- Table structure for table `rptestra3`
--

CREATE TABLE IF NOT EXISTS `rptestra3` (
  `ident` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `cod_municipio` varchar(45) DEFAULT NULL,
  `des_municipio` varchar(150) DEFAULT NULL,
  `cod_sector` varchar(45) DEFAULT NULL,
  `des_sector` varchar(150) DEFAULT NULL,
  `tasaact` decimal(16,2) DEFAULT NULL,
  `tasaant` decimal(16,2) DEFAULT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='REPORTE DE ACTUALIZACION DE SALDOS E IMPUESTOS Y TASAS POR AÑO';

-- --------------------------------------------------------

--
-- Table structure for table `rptestra4`
--

CREATE TABLE IF NOT EXISTS `rptestra4` (
  `ident` int(11) NOT NULL,
  `cod_sector` varchar(45) DEFAULT NULL,
  `des_sector` varchar(150) DEFAULT NULL,
  `des_servicio` varchar(150) DEFAULT NULL,
  `des_contribuyente` varchar(500) DEFAULT NULL,
  `direccion` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='REPORTE DE CLASIFICACION DE CONTRIBUYENTES POR SERVICIOS PRESTADOS';

-- --------------------------------------------------------

--
-- Table structure for table `rptestra5`
--

CREATE TABLE IF NOT EXISTS `rptestra5` (
  `ident` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `cod_contribuyente` varchar(45) DEFAULT NULL,
  `des_contribuyente` varchar(500) DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='REPORTE DEL SEGUIMIENTO DE LOS CONTRIBUYENTES SOLVENTES CON LA MUNICIPALIDAD';

-- --------------------------------------------------------

--
-- Table structure for table `rptestra6`
--

CREATE TABLE IF NOT EXISTS `rptestra6` (
  `ident` int(11) NOT NULL,
  `cod_servicio` varchar(45) DEFAULT NULL,
  `des_servicio` varchar(150) DEFAULT NULL,
  `cod_local` varchar(45) DEFAULT NULL,
  `des_local` varchar(150) DEFAULT NULL,
  `arrendador` varchar(500) DEFAULT NULL,
  `tipo_contrato` varchar(45) DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='REPORTE DE LOCALES ARRENDADOS POR LA MUNICIPALIDAD POR TIPO DE SERVICIO';

-- --------------------------------------------------------

--
-- Table structure for table `rpttacti1`
--

CREATE TABLE IF NOT EXISTS `rpttacti1` (
  `ident` int(11) NOT NULL,
  `cod_sector` varchar(45) DEFAULT NULL,
  `des_sector` varchar(150) DEFAULT NULL,
  `cod_contribuyente` varchar(45) DEFAULT NULL,
  `tipo_inmueble` varchar(100) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `des_servicio` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='INFORME DE PERSONAS CON SERVICIOS DE AGUA Y BIENES INMUEBLES REGISTRADOS';

-- --------------------------------------------------------

--
-- Table structure for table `rpttacti2`
--

CREATE TABLE IF NOT EXISTS `rpttacti2` (
  `ident` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `cod_zona` varchar(45) DEFAULT NULL,
  `des_zona` varchar(150) DEFAULT NULL,
  `tipo_cementerio` varchar(100) DEFAULT NULL,
  `propietario` varchar(500) DEFAULT NULL,
  `tipo_espacio` varchar(100) DEFAULT NULL,
  `fallecido` varchar(500) DEFAULT NULL,
  `beneficiarios` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ESTADOS DE LOS TITULOS PERPETUIDAD';

-- --------------------------------------------------------

--
-- Table structure for table `rpttacti3`
--

CREATE TABLE IF NOT EXISTS `rpttacti3` (
  `ident` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `cod_sector` varchar(45) DEFAULT NULL,
  `des_sector` varchar(150) DEFAULT NULL,
  `cod_contribuyente` varchar(45) DEFAULT NULL,
  `des_contribuyente` varchar(500) DEFAULT NULL,
  `des_servicio` varchar(150) DEFAULT NULL,
  `activo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='REPORTE DEL CONTROL DEL NUMERO DE CONTRIBUYENTES ACTIVOS';

-- --------------------------------------------------------

--
-- Table structure for table `rpttacti4`
--

CREATE TABLE IF NOT EXISTS `rpttacti4` (
  `ident` int(11) NOT NULL,
  `cod_zona` varchar(45) DEFAULT NULL,
  `des_zona` varchar(150) DEFAULT NULL,
  `encargado` varchar(500) DEFAULT NULL,
  `fcambio` date DEFAULT NULL,
  `frevision` date DEFAULT NULL,
  `reporte` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='INFORME DEL RESPONSABLE POR BARRIO Y CANTONES DEL MUNICIPIO';

-- --------------------------------------------------------

--
-- Table structure for table `rpttacti5`
--

CREATE TABLE IF NOT EXISTS `rpttacti5` (
  `ident` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `cod_sector` varchar(45) DEFAULT NULL,
  `des_sector` varchar(150) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `des_servicio` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='REPORTE DE BARRIOS Y CANTONES QUE NO POSEEN SERVICIOS MUNICIPALES';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
