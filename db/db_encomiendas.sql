-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para db_caminata
CREATE DATABASE IF NOT EXISTS `db_caminata` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `db_caminata`;

-- Volcando estructura para tabla db_caminata.tbl_accesos
CREATE TABLE IF NOT EXISTS `tbl_accesos` (
  `idAcceso` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAcceso` varchar(50) NOT NULL,
  `descripcionAcceso` text NOT NULL,
  `estadoAcceso` int(11) NOT NULL,
  `fechaAcceso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idAcceso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_accesos: ~1 rows (aproximadamente)
INSERT INTO `tbl_accesos` (`idAcceso`, `nombreAcceso`, `descripcionAcceso`, `estadoAcceso`, `fechaAcceso`) VALUES
	(1, 'Administrador', 'Acceso total al sistema.', 1, '2025-04-11 17:29:43');

-- Volcando estructura para tabla db_caminata.tbl_cargos
CREATE TABLE IF NOT EXISTS `tbl_cargos` (
  `idCargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCargo` varchar(50) NOT NULL,
  PRIMARY KEY (`idCargo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_cargos: ~3 rows (aproximadamente)
INSERT INTO `tbl_cargos` (`idCargo`, `nombreCargo`) VALUES
	(1, 'Administrador'),
	(2, 'Empacador'),
	(3, 'Gestor');

-- Volcando estructura para tabla db_caminata.tbl_cuentas_gastos
CREATE TABLE IF NOT EXISTS `tbl_cuentas_gastos` (
  `idCuenta` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCuenta` varchar(75) NOT NULL,
  `descripcionCuenta` text NOT NULL,
  `estadoCuenta` text NOT NULL DEFAULT '1',
  `creadoAt` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idCuenta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_cuentas_gastos: ~2 rows (aproximadamente)
INSERT INTO `tbl_cuentas_gastos` (`idCuenta`, `nombreCuenta`, `descripcionCuenta`, `estadoCuenta`, `creadoAt`) VALUES
	(2, 'LUZ ELECTRICA', 'PARA EL CONTROL DE PAGO DE LUZ ELECTRICA', '1', '2025-04-10 18:01:00'),
	(3, 'BOLETOS DE AVION', 'PARA LLEVAR EL CONTROL DE LOS GASTOS EN BOLETOS DE AVION', '1', '2025-04-10 19:45:46');

-- Volcando estructura para tabla db_caminata.tbl_destinos
CREATE TABLE IF NOT EXISTS `tbl_destinos` (
  `idDestino` int(11) NOT NULL AUTO_INCREMENT,
  `nombreDestino` varchar(50) NOT NULL,
  `creadoDestino` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idDestino`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_destinos: ~10 rows (aproximadamente)
INSERT INTO `tbl_destinos` (`idDestino`, `nombreDestino`, `creadoDestino`) VALUES
	(1, 'Usulután', '2023-03-20 23:05:55'),
	(2, 'Virginia', '2023-03-20 23:05:55'),
	(3, 'Washington', '2023-05-13 22:15:25'),
	(4, 'Maryland', '2025-03-26 22:14:49'),
	(5, 'Pittsburg', '2025-03-26 22:15:29'),
	(6, 'Los Angeles', '2025-03-26 22:15:34'),
	(7, 'San Francisco', '2025-03-26 22:15:46'),
	(8, 'Houston', '2025-04-17 19:38:19'),
	(9, 'Irving', '2025-04-17 19:38:26'),
	(10, 'Dallas', '2025-04-17 19:38:34');

-- Volcando estructura para tabla db_caminata.tbl_detalle_orden
CREATE TABLE IF NOT EXISTS `tbl_detalle_orden` (
  `idDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `idOrden` int(11) NOT NULL,
  `contenidoPaquete` text NOT NULL,
  `pesoPaquete` decimal(9,2) NOT NULL,
  `precioLibra` decimal(9,2) NOT NULL,
  `declaradoPaquete` decimal(9,2) NOT NULL,
  `totalPaquete` decimal(9,2) NOT NULL,
  `adicionalesPaquete` text NOT NULL,
  `ordenPaquete` text NOT NULL,
  `qrArticulo` text NOT NULL,
  `eliminadoArticulo` int(11) NOT NULL DEFAULT 1,
  `creadoArticulo` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idDetalle`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla db_caminata.tbl_detalle_orden: ~7 rows (aproximadamente)
INSERT INTO `tbl_detalle_orden` (`idDetalle`, `idOrden`, `contenidoPaquete`, `pesoPaquete`, `precioLibra`, `declaradoPaquete`, `totalPaquete`, `adicionalesPaquete`, `ordenPaquete`, `qrArticulo`, `eliminadoArticulo`, `creadoArticulo`) VALUES
	(14, 7, 'CREMAS CORPORALES, JABONES, LOCIONES 4.5 LBS 1/5\r\nMEDICINA 2/5\r\nROPA 1LBS 3/5\r\nCAFE DE EL SALVADOR 2LBS 4/5\r\nDISPOSITIVOS ELECTRONICOS 5/5', 10.00, 8.00, 0.00, 80.00, '[{"concepto":"MEDICINA A","monto":"4.6"},{"concepto":"MEDICINA B","monto":"3.99"},{"concepto":"MEDICINA C","monto":"6.30"}]', '[{"concepto":"CREMAS CORPORALES, JABONES, LOCIONES 4.5 LBS","detalle":"1\\/5","paquete":1},{"concepto":"MEDICINA","detalle":"2\\/5","paquete":2},{"concepto":"ROPA 1LBS","detalle":"3\\/5","paquete":3},{"concepto":"CAFE DE EL SALVADOR 2LBS","detalle":"4\\/5","paquete":4},{"concepto":"DISPOSITIVOS ELECTRONICOS","detalle":"5\\/5","paquete":5}]', '', 1, '2025-03-27 17:36:52'),
	(15, 8, 'JUGUETES\r\nROPA\r\nJOYAS', 8.60, 8.00, 0.00, 68.80, '', '[{"concepto":"JUGUETES","detalle":"","paquete":1},{"concepto":"ROPA","detalle":"","paquete":2},{"concepto":"JOYAS","detalle":"","paquete":3}]', '', 1, '2025-03-31 21:08:20'),
	(16, 9, 'ROPA 1/3\r\nAUDIFONOS JBL 2/3\r\nJUGUETES  3/3', 9.00, 8.00, 0.00, 72.00, '', '[{"concepto":"ROPA","detalle":"1\\/3","paquete":1},{"concepto":"AUDIFONOS JBL","detalle":"2\\/3","paquete":2},{"concepto":"JUGUETES ","detalle":"3\\/3","paquete":3}]', '', 1, '2025-04-03 20:12:22'),
	(17, 10, 'ROPA 1/6\r\nMEDICINAS 2/6\r\nJUGUETES 3/6\r\nDOCUMENTOS LEGALES 4/6\r\nPOLLO CAMPERO 5/6\r\nZAPATOS MARCA ADIDAD 6/6', 20.00, 8.00, 0.00, 160.00, '[{"concepto":"ACETAMINOFEN","monto":"5"},{"concepto":"DOGENAL","monto":"25"},{"concepto":"VIROGRIP","monto":"12"}]', '[{"concepto":"ROPA","detalle":"1\\/6","paquete":1},{"concepto":"MEDICINAS","detalle":"2\\/6","paquete":2},{"concepto":"JUGUETES","detalle":"3\\/6","paquete":3},{"concepto":"DOCUMENTOS LEGALES","detalle":"4\\/6","paquete":4},{"concepto":"POLLO CAMPERO","detalle":"5\\/6","paquete":5},{"concepto":"ZAPATOS MARCA ADIDAD","detalle":"6\\/6","paquete":6}]', '', 1, '2025-04-03 20:17:36'),
	(18, 11, 'ROPA Y JOYAS ', 3.00, 8.00, 0.00, 24.00, '', '[]', '', 1, '2025-04-09 21:22:31'),
	(19, 12, 'POLLO CAMPERO 1/2\r\nJUGUETES 2/2', 6.00, 8.00, 0.00, 48.00, '', '[{"concepto":"POLLO CAMPERO","detalle":"1\\/2","paquete":1},{"concepto":"JUGUETES","detalle":"2\\/2","paquete":2}]', '', 1, '2025-04-17 19:42:11'),
	(20, 13, 'JOYAS ', 2.00, 8.00, 0.00, 16.00, '', '[]', '', 1, '2025-04-17 19:48:10');

-- Volcando estructura para tabla db_caminata.tbl_emisores
CREATE TABLE IF NOT EXISTS `tbl_emisores` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `codigoCliente` int(11) NOT NULL,
  `nombreCliente` text NOT NULL,
  `documentoCliente` varchar(15) NOT NULL,
  `telefonoCliente` varchar(15) NOT NULL,
  `correoCliente` text NOT NULL,
  `paisCliente` int(11) NOT NULL,
  `distritoCliente` int(11) NOT NULL,
  `municipioCliente` int(11) NOT NULL,
  `direccionCliente` text NOT NULL,
  `strPais` text NOT NULL,
  `strEstado` text NOT NULL,
  `strMunicipio` text NOT NULL,
  `estadoCliente` int(11) NOT NULL DEFAULT 1,
  `creadoCliente` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_emisores: ~10 rows (aproximadamente)
INSERT INTO `tbl_emisores` (`idCliente`, `codigoCliente`, `nombreCliente`, `documentoCliente`, `telefonoCliente`, `correoCliente`, `paisCliente`, `distritoCliente`, `municipioCliente`, `direccionCliente`, `strPais`, `strEstado`, `strMunicipio`, `estadoCliente`, `creadoCliente`) VALUES
	(1, 1000, 'Juan Antonio-Campos Sanchez', '47856946', '78956236', '-', 1, 13, 67, 'Barrio el Calvario', '1- El Salvador', '13- San Miguel ', '67-Chinameca', 1, '2023-03-20 23:08:03'),
	(2, 1001, 'Flor de Maria-Fuentes Saravia', '56987456', '78956321', '-', 1, 1, 2, 'Barrio el calvario', '1- El Salvador', '1-Ahuachapán', '2-Jujutla', 1, '2023-03-20 23:08:40'),
	(3, 1002, 'Carmen del Cid-Medrano', '05123698', '74569812', '-', 1, 3, 0, 'El centro, Usulutan', '1- El Salvador', '3-Sonsonate', '', 1, '2023-03-21 04:04:33'),
	(4, 1003, 'Marcos Antonio-Carcamo', '102653489', '23659685', '-', 2, 52, 268, '123 Main Street', '2- Estados Unidos', '52- Pensilvania ', '268-Pittsburg', 1, '2025-03-22 16:52:49'),
	(5, 1004, '', '', '', '', 0, 0, 0, '', '', '', '', 0, '2025-03-26 16:52:57'),
	(6, 1005, '', '', '', '', 0, 0, 0, '', '', '', '', 0, '2025-03-26 16:55:21'),
	(7, 1006, 'Francisco Adalberto-Campos', '123456', '26359874', 'example@example.com', 1, 11, 61, 'Colonia La Pradera', '1-El Salvador', '11-Usulután', '61-Santa María', 1, '2025-03-26 19:47:06'),
	(8, 1007, 'Marcos Antonio-Maldonado', '987456321', '23659874', 'example@example.com', 1, 12, 0, 'Colonia La Pradera', '1-El Salvador', '12-San Miguel', '', 1, '2025-03-26 22:08:06'),
	(9, 1008, 'Felipe Alonso-Campos', '456321', '6398-5698', 'example@example.com', 2, 57, 264, '1200  HOLLY HILL DR GRAND PRAIRIE', '2- Estados Unidos', '57- Texas ', '264-Irving', 1, '2025-03-27 14:43:05'),
	(10, 1009, 'Juan Adalberto-Valdez Parada', '963265987', '7546-8956', '-', 1, 11, 51, 'Barrio la parroquia', '1-El Salvador', '11-Usulután', '51-Jucuarán', 1, '2025-04-08 17:20:18');

-- Volcando estructura para tabla db_caminata.tbl_empleados
CREATE TABLE IF NOT EXISTS `tbl_empleados` (
  `idEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEmpleado` varchar(50) NOT NULL,
  `edadEmpleado` int(11) NOT NULL,
  `telefonoEmpleado` varchar(10) NOT NULL,
  `cargoEmpleado` int(11) NOT NULL,
  `sexoEmpleado` varchar(10) NOT NULL,
  `estadoEmpleado` int(11) NOT NULL DEFAULT 1,
  `direccionEmpleado` text NOT NULL,
  `duiEmpleado` text NOT NULL,
  `ingresoEmpleado` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_empleados: ~4 rows (aproximadamente)
INSERT INTO `tbl_empleados` (`idEmpleado`, `nombreEmpleado`, `edadEmpleado`, `telefonoEmpleado`, `cargoEmpleado`, `sexoEmpleado`, `estadoEmpleado`, `direccionEmpleado`, `duiEmpleado`, `ingresoEmpleado`) VALUES
	(1, 'Edwin Alexander Cortez Orantes', 29, '6310-0397 ', 1, 'Masculino', 1, 'Usulután', '', '2021-01-04 06:00:00'),
	(2, 'Carla Isolina', 27, '7537-3424 ', 2, 'Femenino', 1, 'Usulután', '', '2020-07-01 06:00:00'),
	(3, 'Carla Marisa Parada Soto', 21, '7193-3931', 3, 'Femenino', 1, 'Usulután', '', '2020-07-01 06:00:00'),
	(4, 'Catalina de Jesús Miranda Batres', 42, '7492-2204 ', 3, 'Femenino', 1, 'Canton el Palmital, Ozatlan, Usulután', '', '2016-08-08 06:00:00');

-- Volcando estructura para tabla db_caminata.tbl_empresa
CREATE TABLE IF NOT EXISTS `tbl_empresa` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEmpresa` text NOT NULL,
  `telefonoEmpresa` text NOT NULL,
  `correoEmpresa` text NOT NULL,
  `direccionEmpresa` text NOT NULL,
  `logoEmpresa` text NOT NULL,
  `creadaEmpresa` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla db_caminata.tbl_empresa: ~1 rows (aproximadamente)
INSERT INTO `tbl_empresa` (`idEmpresa`, `nombreEmpresa`, `telefonoEmpresa`, `correoEmpresa`, `direccionEmpresa`, `logoEmpresa`, `creadaEmpresa`) VALUES
	(1, 'GENCIA DE VIAJES CAMPOS', '+1 (703) 731-7202, 6001-4277', 'agenciadeencomiendascampos@gmail.com', '4TA CALLE ORIENTE #53 USULUTAN, FRENTE A AGROSERVICIO SAN JOSE', 'logo_empresa', '2025-04-02 20:24:43');

-- Volcando estructura para tabla db_caminata.tbl_envios
CREATE TABLE IF NOT EXISTS `tbl_envios` (
  `idEnvio` int(11) NOT NULL AUTO_INCREMENT,
  `codigoEnvio` int(11) NOT NULL DEFAULT 0,
  `gestorEnvio` int(11) NOT NULL,
  `fechaEnvio` date NOT NULL,
  `destinoOrden` int(11) NOT NULL,
  `agregadoEnvio` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idEnvio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla db_caminata.tbl_envios: ~4 rows (aproximadamente)
INSERT INTO `tbl_envios` (`idEnvio`, `codigoEnvio`, `gestorEnvio`, `fechaEnvio`, `destinoOrden`, `agregadoEnvio`) VALUES
	(1, 1000, 3, '2025-04-10', 3, '2025-04-04 15:49:17'),
	(2, 1001, 4, '2025-04-10', 3, '2025-04-04 15:51:48'),
	(3, 1002, 4, '2025-04-22', 3, '2025-04-14 19:34:33'),
	(4, 1003, 4, '2025-04-22', 4, '2025-04-14 20:03:47');

-- Volcando estructura para tabla db_caminata.tbl_estados
CREATE TABLE IF NOT EXISTS `tbl_estados` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEstado` text NOT NULL,
  `abreviaturaEstado` text NOT NULL,
  `idPais` int(11) NOT NULL,
  `estadoEstado` int(11) NOT NULL DEFAULT 1,
  `creadoEstado` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=442 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_estados: ~64 rows (aproximadamente)
INSERT INTO `tbl_estados` (`idEstado`, `nombreEstado`, `abreviaturaEstado`, `idPais`, `estadoEstado`, `creadoEstado`) VALUES
	(1, 'Ahuachapán', '', 1, 1, '2025-03-26 16:37:37'),
	(2, 'Santa Ana', '', 1, 1, '2025-03-26 16:37:37'),
	(3, 'Sonsonate', '', 1, 1, '2025-03-26 16:37:37'),
	(4, 'La Libertad', '', 1, 1, '2025-03-26 16:37:37'),
	(5, 'Chalatenango', '', 1, 1, '2025-03-26 16:37:37'),
	(6, 'San Salvador', '', 1, 1, '2025-03-26 16:37:37'),
	(7, 'Cuscatlán', '', 1, 1, '2025-03-26 16:37:37'),
	(8, 'La Paz', '', 1, 1, '2025-03-26 16:37:37'),
	(9, 'Cabañas', '', 1, 1, '2025-03-26 16:37:37'),
	(10, 'San Vicente', '', 1, 1, '2025-03-26 16:37:37'),
	(11, 'Usulután', '', 1, 1, '2025-03-26 16:37:37'),
	(12, 'Morazán', '', 1, 1, '2025-03-26 16:37:37'),
	(13, 'San Miguel', '', 1, 1, '2025-03-26 16:37:37'),
	(14, 'La Unión', '', 1, 1, '2025-03-26 16:37:37'),
	(15, 'Alabama', 'AL', 2, 1, '2025-03-26 16:38:07'),
	(16, 'Alaska', 'AK', 2, 1, '2025-03-26 16:38:07'),
	(17, 'Arizona', 'AZ', 2, 1, '2025-03-26 16:38:07'),
	(18, 'Arkansas', 'AR', 2, 1, '2025-03-26 16:38:07'),
	(19, 'California', 'CA', 2, 1, '2025-03-26 16:38:07'),
	(20, 'Colorado', 'CO', 2, 1, '2025-03-26 16:38:07'),
	(21, 'Connecticut', 'CT', 2, 1, '2025-03-26 16:38:07'),
	(22, 'Delaware', 'DE', 2, 1, '2025-03-26 16:38:07'),
	(23, 'Florida', 'FL', 2, 1, '2025-03-26 16:38:07'),
	(24, 'Georgia', 'GA', 2, 1, '2025-03-26 16:38:07'),
	(25, 'Hawái', 'HI', 2, 1, '2025-03-26 16:38:07'),
	(26, 'Idaho', 'ID', 2, 1, '2025-03-26 16:38:07'),
	(27, 'Illinois', 'IL', 2, 1, '2025-03-26 16:38:07'),
	(28, 'Indiana', 'IN', 2, 1, '2025-03-26 16:38:07'),
	(29, 'Iowa', 'IA', 2, 1, '2025-03-26 16:38:07'),
	(30, 'Kansas', 'KS', 2, 1, '2025-03-26 16:38:07'),
	(31, 'Kentucky', 'KY', 2, 1, '2025-03-26 16:38:07'),
	(32, 'Luisiana', 'LA', 2, 1, '2025-03-26 16:38:07'),
	(33, 'Maine', 'ME', 2, 1, '2025-03-26 16:38:07'),
	(34, 'Maryland', 'MD', 2, 1, '2025-03-26 16:38:07'),
	(35, 'Massachusetts', 'MA', 2, 1, '2025-03-26 16:38:07'),
	(36, 'Míchigan', 'MI', 2, 1, '2025-03-26 16:38:07'),
	(37, 'Minnesota', 'MN', 2, 1, '2025-03-26 16:38:07'),
	(38, 'Misisipi', 'MS', 2, 1, '2025-03-26 16:38:07'),
	(39, 'Misuri', 'MO', 2, 1, '2025-03-26 16:38:07'),
	(40, 'Montana', 'MT', 2, 1, '2025-03-26 16:38:07'),
	(41, 'Nebraska', 'NE', 2, 1, '2025-03-26 16:38:07'),
	(42, 'Nevada', 'NV', 2, 1, '2025-03-26 16:38:07'),
	(43, 'Nuevo Hampshire', 'NH', 2, 1, '2025-03-26 16:38:07'),
	(44, 'Nueva Jersey', 'NJ', 2, 1, '2025-03-26 16:38:07'),
	(45, 'Nuevo México', 'NM', 2, 1, '2025-03-26 16:38:07'),
	(46, 'Nueva York', 'NY', 2, 1, '2025-03-26 16:38:07'),
	(47, 'Carolina del Norte', 'NC', 2, 1, '2025-03-26 16:38:07'),
	(48, 'Dakota del Norte', 'ND', 2, 1, '2025-03-26 16:38:07'),
	(49, 'Ohio', 'OH', 2, 1, '2025-03-26 16:38:07'),
	(50, 'Oklahoma', 'OK', 2, 1, '2025-03-26 16:38:07'),
	(51, 'Oregón', 'OR', 2, 1, '2025-03-26 16:38:07'),
	(52, 'Pensilvania', 'PA', 2, 1, '2025-03-26 16:38:07'),
	(53, 'Rhode Island', 'RI', 2, 1, '2025-03-26 16:38:07'),
	(54, 'Carolina del Sur', 'SC', 2, 1, '2025-03-26 16:38:07'),
	(55, 'Dakota del Sur', 'SD', 2, 1, '2025-03-26 16:38:07'),
	(56, 'Tennessee', 'TN', 2, 1, '2025-03-26 16:38:07'),
	(57, 'Texas', 'TX', 2, 1, '2025-03-26 16:38:07'),
	(58, 'Utah', 'UT', 2, 1, '2025-03-26 16:38:07'),
	(59, 'Vermont', 'VT', 2, 1, '2025-03-26 16:38:07'),
	(60, 'Virginia', 'VA', 2, 1, '2025-03-26 16:38:07'),
	(61, 'Washington', 'WA', 2, 1, '2025-03-26 16:38:07'),
	(62, 'Virginia Occidental', 'WV', 2, 1, '2025-03-26 16:38:07'),
	(63, 'Wisconsin', 'WI', 2, 1, '2025-03-26 16:38:07'),
	(64, 'Wyoming', 'WY', 2, 1, '2025-03-26 16:38:07');

-- Volcando estructura para tabla db_caminata.tbl_estado_orden
CREATE TABLE IF NOT EXISTS `tbl_estado_orden` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEstado` varchar(50) NOT NULL,
  `creadoEstado` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_estado_orden: ~4 rows (aproximadamente)
INSERT INTO `tbl_estado_orden` (`idEstado`, `nombreEstado`, `creadoEstado`) VALUES
	(1, 'Recibido', '2023-03-20 23:47:44'),
	(2, 'En Tránsito ', '2023-03-20 23:47:44'),
	(3, 'Llego a destino', '2023-03-20 23:47:44'),
	(4, 'Entregado', '2023-03-20 23:47:44');

-- Volcando estructura para tabla db_caminata.tbl_gastos
CREATE TABLE IF NOT EXISTS `tbl_gastos` (
  `idGasto` int(11) NOT NULL AUTO_INCREMENT,
  `codigoGasto` int(11) NOT NULL,
  `idCuentaGasto` int(11) NOT NULL,
  `entregadoGasto` varchar(50) NOT NULL,
  `montoGasto` decimal(9,2) NOT NULL,
  `pagoGasto` text NOT NULL,
  `descripcionGasto` text NOT NULL,
  `fechaGasto` date NOT NULL,
  `efectuoGasto` text NOT NULL,
  `eliminadoPor` text NOT NULL,
  `estadoGasto` int(11) NOT NULL DEFAULT 1,
  `creadoAt` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idGasto`),
  KEY `idCuentaGasto` (`idCuentaGasto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_gastos: ~2 rows (aproximadamente)
INSERT INTO `tbl_gastos` (`idGasto`, `codigoGasto`, `idCuentaGasto`, `entregadoGasto`, `montoGasto`, `pagoGasto`, `descripcionGasto`, `fechaGasto`, `efectuoGasto`, `eliminadoPor`, `estadoGasto`, `creadoAt`) VALUES
	(1, 1, 2, 'CARLOS APARICIO', 150.00, 'Efectivo', 'PAGO DE LUZ ELECTRICA', '2025-04-10', 'Edwin Cortez', '', 1, '2025-04-10 21:20:58'),
	(2, 2, 3, 'PATRICIA ALFARO', 50.00, 'Efectivo', 'POR PAGO DE BOLETO AEREO', '2025-04-10', 'Edwin Cortez', '', 0, '2025-04-10 21:45:08');

-- Volcando estructura para tabla db_caminata.tbl_maletas
CREATE TABLE IF NOT EXISTS `tbl_maletas` (
  `idMaleta` int(11) NOT NULL AUTO_INCREMENT,
  `idEnvio` int(11) NOT NULL,
  `codigoMaleta` int(11) NOT NULL,
  `tipoMaleta` int(11) NOT NULL DEFAULT 1,
  `creada` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idMaleta`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_maletas: ~9 rows (aproximadamente)
INSERT INTO `tbl_maletas` (`idMaleta`, `idEnvio`, `codigoMaleta`, `tipoMaleta`, `creada`) VALUES
	(1, 2, 1743786037, 1, '2025-04-04 17:00:37'),
	(2, 2, 1743786061, 2, '2025-04-04 17:01:01'),
	(3, 2, 1743786093, 1, '2025-04-04 17:01:33'),
	(4, 2, 1743786422, 1, '2025-04-04 17:07:02'),
	(5, 2, 1743788047, 1, '2025-04-04 17:34:07'),
	(6, 3, 1744659283, 1, '2025-04-14 19:34:43'),
	(7, 3, 1744659284, 1, '2025-04-14 19:34:44'),
	(8, 4, 1744661033, 1, '2025-04-14 20:03:53'),
	(9, 4, 1744661034, 1, '2025-04-14 20:03:54');

-- Volcando estructura para tabla db_caminata.tbl_maleta_ordenes
CREATE TABLE IF NOT EXISTS `tbl_maleta_ordenes` (
  `idOrdenMaleta` int(11) NOT NULL AUTO_INCREMENT,
  `idOrden` int(11) NOT NULL,
  `idMaleta` int(11) NOT NULL,
  `codigoOrdenMaleta` text NOT NULL,
  `strDetalle` text NOT NULL,
  `creadoOrdenMaleta` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idOrdenMaleta`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_maleta_ordenes: ~10 rows (aproximadamente)
INSERT INTO `tbl_maleta_ordenes` (`idOrdenMaleta`, `idOrden`, `idMaleta`, `codigoOrdenMaleta`, `strDetalle`, `creadoOrdenMaleta`) VALUES
	(6, 7, 1, '1000-1', 'CREMAS CORPORALES, JABONES, LOCIONES 4.5 LBS', '2025-04-04 21:46:33'),
	(7, 7, 1, '1000-2', 'MEDICINA', '2025-04-04 21:46:37'),
	(8, 8, 1, '1001', 'JUGUETES ROPA JOYAS', '2025-04-04 21:46:42'),
	(9, 7, 1, '1000-3', 'ROPA 1LBS', '2025-04-04 21:47:14'),
	(10, 7, 1, '1000-4', 'CAFE DE EL SALVADOR 2LBS', '2025-04-04 21:47:30'),
	(11, 7, 2, '1000-5', 'DISPOSITIVOS ELECTRONICOS', '2025-04-04 21:54:12'),
	(12, 11, 2, '1004', 'ROPA Y JOYAS ', '2025-04-09 21:31:58'),
	(13, 7, 6, '1000-1', 'CREMAS CORPORALES, JABONES, LOCIONES 4.5 LBS', '2025-04-14 19:35:17'),
	(14, 7, 6, '1000-3', 'ROPA 1LBS', '2025-04-14 19:36:22'),
	(15, 8, 8, '1001-1', 'JUGUETES ROPA JOYAS', '2025-04-14 20:04:19');

-- Volcando estructura para tabla db_caminata.tbl_menu
CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `idMenu` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMenu` varchar(25) NOT NULL,
  `htmlMenu` text NOT NULL,
  `fechaMenu` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_menu: ~24 rows (aproximadamente)
INSERT INTO `tbl_menu` (`idMenu`, `nombreMenu`, `htmlMenu`, `fechaMenu`) VALUES
	(1, 'Pacientes', '<li class="menu-item">\r\n                    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#patient" aria-expanded="false"\r\n                        aria-controls="patient">\r\n                        <span><i class="fas fa-user"></i>Pacientes</span>\r\n                    </a>\r\n                    <ul id="patient" class="collapse" aria-labelledby="patient" data-parent="#side-nav-accordion">\r\n                        <li> <a href="<?php echo base_url(); ?>Paciente/agregar_pacientes">Agregar paciente</a> </li>\r\n                        <li> <a href="<?php echo base_url(); ?>Paciente/lista_pacientes">Lista pacientes</a> </li>\r\n                    </ul>\r\n                </li>', '2021-04-29 19:00:15'),
	(2, 'Hoja de cobro', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#hojaCobro" aria-expanded="false"\r\n        aria-controls="hojaCobro">\r\n        <span><i class="fa fa-file"></i>Hoja de cobro</span>\r\n    </a>\r\n    <ul id="hojaCobro" class="collapse" aria-labelledby="hojaCobro" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>Hoja/">Agregar Hoja</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Hoja/lista_hojas">Listado de Hojas</a> </li>\r\n        <!--<li> <a href="<?php echo base_url(); ?>Hoja/lista_paquetes">Paquetes</a> </li>-->\r\n        <li> <a href="<?php echo base_url(); ?>Hoja/lista_paquetes">Paquetes</a> \r\n        <li> <a href="<?php echo base_url(); ?>ServiciosExternos/">Servicios Externos</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Proveedor/">Proveedores</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Hoja/historial_hojas">Historial de Hojas</a> </li>\r\n    </ul>\r\n</li>', '2021-04-29 19:00:15'),
	(3, 'Botiquin', '<li class="menu-item">\r\n                    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#botiquin" aria-expanded="false"\r\n                        aria-controls="botiquin">\r\n                        <span><i class="fa fa-thermometer"></i>Botiquin</span>\r\n                    </a>\r\n                    <ul id="botiquin" class="collapse" aria-labelledby="botiquin" data-parent="#side-nav-accordion">\r\n                        <li> <a href="<?php echo base_url(); ?>Botiquin/">Medicamentos</a> </li>\r\n                        <li> <a href="<?php echo base_url(); ?>Botiquin/agregar_medicamento">Agregar compra</a> </li>\r\n                        <li> <a href="<?php echo base_url(); ?>Botiquin/historial_compras">Historial compras</a> </li>\r\n                        <li> <a href="<?php echo base_url(); ?>Botiquin/kardex">Movimientos</a> </li>\r\n                    </ul>\r\n                </li>', '2021-04-29 19:00:43'),
	(4, 'Cotización', '<li class="menu-item">\r\n                    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#cotizacion" aria-expanded="false"\r\n                        aria-controls="cotizacion">\r\n                        <span><i class="fa fa-file"></i>Cotización</span>\r\n                    </a>\r\n                    <ul id="cotizacion" class="collapse" aria-labelledby="cotizacion" data-parent="#side-nav-accordion">\r\n                        <li> <a href="<?php echo base_url(); ?>Hoja/presupuesto">Crear cotización</a> </li>\r\n                        <li> <a href="<?php echo base_url(); ?>Hoja/lista_presupuestos">Listado de cotizaciones</a> </li>\r\n                    </ul>\r\n                </li>', '2021-04-29 21:20:37'),
	(5, 'Gastos', '<li class="menu-item">\r\n                    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#gastos" aria-expanded="false"\r\n                        aria-controls="gastos">\r\n                        <span><i class="fa fa-tasks"></i>Gastos</span>\r\n                    </a>\r\n                    <ul id="gastos" class="collapse" aria-labelledby="gastos" data-parent="#side-nav-accordion">\r\n                        <li> <a href="<?php echo base_url(); ?>Gastos/">Cuentas</a> </li>\r\n                        <li> <a href="<?php echo base_url(); ?>Gastos/control_gastos">Control de gastos</a> </li>\r\n                    </ul>\r\n                </li>', '2021-04-30 17:20:44'),
	(6, 'Médicos', '<li class="menu-item">\r\n                    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#doctor" aria-expanded="false"\r\n                        aria-controls="doctor">\r\n                        <span><i class="fas fa-stethoscope"></i>Médico</span>\r\n                    </a>\r\n                    <ul id="doctor" class="collapse" aria-labelledby="doctor" data-parent="#side-nav-accordion">\r\n                        <li> <a href="<?php echo base_url(); ?>Medico/">Lista médicos</a> </li>\r\n                    </ul>\r\n                </li>', '2021-04-30 17:20:44'),
	(7, 'Empleados', '<li class="menu-item">\r\n                    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#empleados" aria-expanded="false"\r\n                        aria-controls="empleados">\r\n                        <span><i class="fas fa-users"></i>Empleados</span>\r\n                    </a>\r\n                    <ul id="empleados" class="collapse" aria-labelledby="empleados" data-parent="#side-nav-accordion">\r\n                        <li> <a href="<?php echo base_url(); ?>Empleado/">Agregar empleado</a> </li>\r\n                        <li> <a href="<?php echo base_url(); ?>Empleado/lista_empleados">Lista empleados</a> </li>\r\n                        <li> <a href="<?php echo base_url(); ?>Empleado/vacaciones_empleados">Cumpleañeros</a> </li>\r\n                        <li> <a href="<?php echo base_url(); ?>Empleado/cargos_empleados">Cargos</a> </li>\r\n                    </ul>\r\n                </li>', '2021-04-30 17:20:44'),
	(8, 'Habitaciones', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#habitacion" aria-expanded="false"\r\n        aria-controls="habitacion">\r\n        <span><i class="fas fa-hospital"></i>Habitaciones</span>\r\n    </a>\r\n    <ul id="habitacion" class="collapse" aria-labelledby="habitacion" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>Paciente/esquema_habitaciones">Esquema de habitaciones</a></li>\r\n        <li> <a href="<?php echo base_url(); ?>Paciente/senso_diario">Censo diario</a></li>\r\n    </ul>\r\n</li>', '2021-04-30 17:20:44'),
	(9, 'Reportes', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#reportes" aria-expanded="false"\r\n        aria-controls="reportes">\r\n        <span><i class="fas fa-file-invoice-dollar"></i>Reportes</span>\r\n    </a>\r\n    <ul id="reportes" class="collapse" aria-labelledby="reportes" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/liquidacion_caja">Liquidación de caja</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/cobros_pacientes">Cobros a pacientes</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/externos_hoja">Externos por hoja</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/usg_rx">USG y RX</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/rx_laboratorio">RX y Laboratorio</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/ingresos_costos_gastos">Ingresos, Costos, Gastos</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/detalle_gastos">Detalle gastos</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/detalle_facturas">Facturas</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/salidas_botiquin">Salidas de botiquín</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/detalle_medicamento">Detalle medicamento</a> </li>\r\n    </ul>\r\n</li>', '2021-04-30 17:20:44'),
	(10, 'Configuraciòn', '<li class="menu-item">\r\n                    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#configuracion"\r\n                        aria-expanded="false" aria-controls="configuracion">\r\n                        <span><i class="fa fa-cog"></i>Configuración</span>\r\n                    </a>\r\n                    <ul id="configuracion" class="collapse" aria-labelledby="configuracion"\r\n                        data-parent="#side-nav-accordion">\r\n                        <li><a href="<?php echo base_url(); ?>Accesos/">Accesos</a></li>\r\n                        <li><a href="<?php echo base_url(); ?>Usuarios/gestion_usuarios">Usuarios</a></li>\r\n                        <li><a href="<?php echo base_url(); ?>Permisos/">Permisos</a></li>\r\n	     <li><a href="<?php echo base_url(); ?>Herramientas/movimientos_hojas">Movimientos hoja</a></li>\r\n                    </ul>\r\n                </li>', '2021-04-30 17:20:44'),
	(11, 'Cuentas por pagar', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#pagar" aria-expanded="false" aria-controls="pagar">\r\n        <span><i class="fas fa-clipboard-list"></i>Cuentas por pagar</span>\r\n    </a>\r\n    <ul id="pagar" class="collapse" aria-labelledby="pagar" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>CuentasPendientes/cuentas_por_pagar">Gestión cuentas</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>CuentasPendientes/cuentas_por_proveedor">Cuentas por proveedor</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>CuentasPendientes/cuentas_por_fecha">Cuentas por fecha</a> </li>\r\n    </ul>\r\n</li>', '2021-05-18 16:29:04'),
	(12, 'Stock Medicamentos', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#stock" aria-expanded="false"\r\n        aria-controls="stock">\r\n        <span><i class="fas fa-clipboard-list"></i>Stock Medicamentos</span>\r\n    </a>\r\n    <ul id="stock" class="collapse" aria-labelledby="stock" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>Botiquin/stock_medicamentos">Actualizar Stock</a> </li>\r\n    </ul>\r\n</li>', '2021-06-30 13:54:18'),
	(13, 'Laboratorio', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#laboratorio" aria-expanded="false"aria-controls="laboratorio">\r\n        <span><i class="fas fa-flask"></i>Laboratorio</span>\r\n    </a>\r\n    <ul id="laboratorio" class="collapse" aria-labelledby="laboratorio" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>Laboratorio/agregar_examen">Agregar examen</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Laboratorio/examenes_realizados">Examenes realizados</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Laboratorio/historial_examenes">Historial examenes</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Laboratorio/resumen_examenes">Resumen examenes</a> </li>\r\n    </ul>\r\n</li>', '2021-09-25 14:27:48'),
	(14, 'Honorarios', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#honorarios" aria-expanded="false"aria-controls="honorarios">\r\n        <span><i class="fa fa-money-bill"></i>Honorarios</span>\r\n    </a>\r\n    <ul id="honorarios" class="collapse" aria-labelledby="laboratorio" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>Honorarios/gestion_honorarios">Gestion de honorarios</a> </li>\r\n    </ul>\r\n</li>', '2021-11-23 22:07:16'),
	(15, 'Reporte', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#reporte" aria-expanded="false"\r\n        aria-controls="reporte">\r\n        <span><i class="fas fa-file-invoice-dollar"></i>Reporte</span>\r\n    </a>\r\n    <ul id="reporte" class="collapse" aria-labelledby="reporte" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>Reportes/externos_hoja">Externos por hoja</a> </li>\r\n    </ul>\r\n</li>', '2021-12-04 14:19:05'),
	(16, 'Facturación', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#anuncio" aria-expanded="false"aria-controls="anuncio">\r\n        <span><i class="fas fa-newspaper"></i>Facturación</span>\r\n    </a>\r\n    <ul id="anuncio" class="collapse" aria-labelledby="laboratorio" data-parent="#side-nav-accordion">\r\n        <!-- <li> <a href="<?php echo base_url(); ?>Herramientas/agregar_anuncio">Gestion de anuncios</a> </li> -->\r\n        <!-- <li> <a href="<?php echo base_url(); ?>Herramientas/factura_isbm">Factura ISBM</a> </li> -->\r\n        <li> <a href="<?php echo base_url(); ?>Herramientas/facturacion">Facturación</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Herramientas/resumen_diario">Resumen diario</a> </li>\r\n    </ul>\r\n</li>', '2021-12-17 14:25:07'),
	(17, 'Consultas ISBM', '<li class="menu-item">\r\n                    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#botiquin" aria-expanded="false"\r\n                        aria-controls="botiquin">\r\n                        <span><i class="fa fa-thermometer"></i>Botiquin</span>\r\n                    </a>\r\n                    <ul id="botiquin" class="collapse" aria-labelledby="botiquin" data-parent="#side-nav-accordion">\r\n                        <li> <a href="<?php echo base_url(); ?>Botiquin/">Medicamentos</a> </li>\r\n                    </ul>\r\n                </li>', '2022-01-10 14:51:51'),
	(18, 'Precio medicamentos', '<li class="menu-item">\r\n    <a href="<?php echo base_url(); ?>Botiquin/precios_medicamentos/">\r\n    <span><i class="fas fa-list"></i>Precio medicamentos</span>\r\n    </a>\r\n</li>', '2022-02-14 14:02:15'),
	(19, 'Hemodialisis', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#hemodialisis" aria-expanded="false" aria-controls="hemodialisis">\r\n        <span><i class="fa fa-tasks"></i>Hemodiálisis </span>\r\n    </a>\r\n    <ul id="hemodialisis" class="collapse" aria-labelledby="hemodialisis" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>Hemodialisis/agregar_paciente/">Agregar paciente</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Hemodialisis/agregar_cita/">Agregar cita</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Hemodialisis/lista_citas/">Lista citas</a> </li>\r\n    </ul>\r\n</li>', '2022-02-21 13:36:48'),
	(20, 'ISBM, Hemo, Empleados', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#isbm" aria-expanded="false" aria-controls="isbm">\r\n        <span><i class="fa fa-tablets"></i>ISBM, Hemo, Empleados</span>\r\n    </a>\r\n    <ul id="isbm" class="collapse" aria-labelledby="isbm" data-parent="#side-nav-accordion">\r\n        <!--<li> <a href="<?php echo base_url(); ?>Isbm/cuentas_isbm/">Crear Requisición</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Isbm/cuentas_isbm/">Lista requisiciones</a> </li>-->\r\n        <li> <a href="<?php echo base_url(); ?>Isbm/cuenta_descargo/">Crear cuenta para descargos</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Isbm/lista_cuenta_descargos/">Lista cuenta descargos</a> </li>\r\n    </ul>\r\n</li>', '2022-04-26 20:39:22'),
	(21, 'Insumos laboratorio', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#insumosLab" aria-expanded="false" aria-controls="insumosLab">\r\n        <span><i class="fa fa-vials"></i>Insumos laboratorio</span>\r\n    </a>\r\n    <ul id="insumosLab" class="collapse" aria-labelledby="insumosLab" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>InsumosLab/agregar_compra/">Agregar compra</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>InsumosLab/lista_compras/">Lista compras</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>InsumosLab/lista_insumos/">Lista insumos</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>InsumosLab/gestion_insumos/">Salidas</a> </li>\r\n       <li> <a href="<?php echo base_url(); ?>InsumosLab/donantes/">Donantes</a> </li>\r\n       <li> <a href="<?php echo base_url(); ?>InsumosLab/lista_donantes/">Lista donantes</a> </li>\r\n    </ul>\r\n</li>', '2022-07-13 12:49:45'),
	(22, 'Insumos limpieza', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#insumosLimpieza" aria-expanded="false" aria-controls="insumosLimpieza">\r\n        <span><i class="fa fa-list"></i>Insumos limpieza</span>\r\n    </a>\r\n    <ul id="insumosLimpieza" class="collapse" aria-labelledby="insumosLimpieza" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>Limpieza/agregar_compra/">Agregar compra</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Limpieza/lista_compras/">Lista compras</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Limpieza/descargos_insumos/">Salidas</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Limpieza/">Gestión insumos</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Limpieza/seguimiento_insumos/">Seguimiento insumos</a> </li>\r\n    </ul>\r\n</li>', '2022-08-30 14:56:51'),
	(23, 'Insumos Hemodialisis', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#insumosHemodialisis" aria-expanded="false" aria-controls="insumosHemodialisis">\r\n        <span><i class="fa fa-notes-medical"></i>Insumos Hemodialisis</span>\r\n    </a>\r\n    <ul id="insumosHemodialisis" class="collapse" aria-labelledby="insumosHemodialisis" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>InsumosHemo/agregar_compra/">Agregar compra</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>InsumosHemo/lista_compras/">Lista compras</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>InsumosHemo/descargos_insumos/">Salidas</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>InsumosHemo/">Gestión insumos</a> </li>\r\n    </ul>\r\n</li>', '2022-09-26 13:54:22'),
	(24, 'Planilla', '<li class="menu-item">\r\n    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#planilla" aria-expanded="false" aria-controls="planilla">\r\n        <span><i class="fa fa-users"></i>Planilla</span>\r\n    </a>\r\n    <ul id="planilla" class="collapse" aria-labelledby="planilla" data-parent="#side-nav-accordion">\r\n        <li> <a href="<?php echo base_url(); ?>Planilla/">Crear planilla</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Planilla/historial_planillas/">Historial planilla</a> </li>\r\n        <li> <a href="<?php echo base_url(); ?>Planilla/personal_planilla/">Personal planilla</a> </li>\r\n</li>', '2023-02-27 14:35:08');

-- Volcando estructura para tabla db_caminata.tbl_municipios_condados
CREATE TABLE IF NOT EXISTS `tbl_municipios_condados` (
  `idMunicipio` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMunicipio` text NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  PRIMARY KEY (`idMunicipio`)
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_municipios_condados: ~268 rows (aproximadamente)
INSERT INTO `tbl_municipios_condados` (`idMunicipio`, `nombreMunicipio`, `idDepartamento`) VALUES
	(1, 'Ahuachapán', 1),
	(2, 'Jujutla', 1),
	(3, 'Atiquizaya', 1),
	(4, 'Concepción de Ataco', 1),
	(5, 'El Refugio', 1),
	(6, 'Guaymango', 1),
	(7, 'Apaneca', 1),
	(8, 'San Francisco Menéndez', 1),
	(9, 'San Lorenzo', 1),
	(10, 'San Pedro Puxtla', 1),
	(11, 'Tacuba', 1),
	(12, 'Turín', 1),
	(13, 'Candelaria de la Frontera', 2),
	(14, 'Chalchuapa', 2),
	(15, 'Coatepeque', 2),
	(16, 'El Congo', 2),
	(17, 'El Porvenir', 2),
	(18, 'Masahuat', 2),
	(19, 'Metapán', 2),
	(20, 'San Antonio Pajonal', 2),
	(21, 'San Sebastián Salitrillo', 2),
	(22, 'Santa Ana', 2),
	(23, 'Santa Rosa Guachipilín', 2),
	(24, 'Santiago de la Frontera', 2),
	(25, 'Texistepeque', 2),
	(26, 'Acajutla', 3),
	(27, 'Armenia', 3),
	(28, 'Caluco', 3),
	(29, 'Cuisnahuat', 3),
	(30, 'Izalco', 3),
	(31, 'Juayúa', 3),
	(32, 'Nahuizalco', 3),
	(33, 'Nahulingo', 3),
	(34, 'Salcoatitán', 3),
	(35, 'San Antonio del Monte', 3),
	(36, 'San Julián', 3),
	(37, 'Santa Catarina Masahuat', 3),
	(38, 'Santa Isabel Ishuatán', 3),
	(39, 'Santo Domingo de Guzmán', 3),
	(40, 'Sonsonate', 3),
	(41, 'Sonzacate', 3),
	(42, 'Alegría', 11),
	(43, 'Berlín', 11),
	(44, 'California', 11),
	(45, 'Concepción Batres', 11),
	(46, 'El Triunfo', 11),
	(47, 'Ereguayquín', 11),
	(48, 'Estanzuelas', 11),
	(49, 'Jiquilisco', 11),
	(50, 'Jucuapa', 11),
	(51, 'Jucuarán', 11),
	(52, 'Mercedes Umaña', 11),
	(53, 'Nueva Granada', 11),
	(54, 'Ozatlán', 11),
	(55, 'Puerto El Triunfo', 11),
	(56, 'San Agustín', 11),
	(57, 'San Buenaventura', 11),
	(58, 'San Dionisio', 11),
	(59, 'San Francisco Javier', 11),
	(60, 'Santa Elena', 11),
	(61, 'Santa María', 11),
	(62, 'Santiago de María', 11),
	(63, 'Tecapán', 11),
	(64, 'Usulután', 11),
	(65, 'Carolina', 13),
	(66, 'Chapeltique', 13),
	(67, 'Chinameca', 13),
	(68, 'Chirilagua', 13),
	(69, 'Ciudad Barrios', 13),
	(70, 'Comacarán', 13),
	(71, 'El Tránsito', 13),
	(72, 'Lolotique', 13),
	(73, 'Moncagua', 13),
	(74, 'Nueva Guadalupe', 13),
	(75, 'Nuevo Edén de San Juan', 13),
	(76, 'Quelepa', 13),
	(77, 'San Antonio del Mosco', 13),
	(78, 'San Gerardo', 13),
	(79, 'San Jorge', 13),
	(80, 'San Luis de la Reina', 13),
	(81, 'San Miguel', 13),
	(82, 'San Rafael Oriente', 13),
	(83, 'Sesori', 13),
	(84, 'Uluazapa', 13),
	(85, 'Arambala', 12),
	(86, 'Cacaopera', 12),
	(87, 'Chilanga', 12),
	(88, 'Corinto', 12),
	(89, 'Delicias de Concepción', 12),
	(90, 'El Divisadero', 12),
	(91, 'El Rosario (Morazán)', 12),
	(92, 'Gualococti', 12),
	(93, 'Guatajiagua', 12),
	(94, 'Joateca', 12),
	(95, 'Jocoaitique', 12),
	(96, 'Jocoro', 12),
	(97, 'Lolotiquillo', 12),
	(98, 'Meanguera', 12),
	(99, 'Osicala', 12),
	(100, 'Perquín', 12),
	(101, 'San Carlos', 12),
	(102, 'San Fernando (Morazán)', 12),
	(103, 'San Francisco Gotera', 12),
	(104, 'San Isidro (Morazán)', 12),
	(105, 'San Simón', 12),
	(106, 'Sensembra', 12),
	(107, 'Sociedad', 12),
	(108, 'Torola', 12),
	(109, 'Yamabal', 12),
	(110, 'Yoloaiquín', 12),
	(111, 'La Unión', 14),
	(112, 'San Alejo', 14),
	(113, 'Yucuaiquín', 14),
	(114, 'Conchagua', 14),
	(115, 'Intipucá', 14),
	(116, 'San José', 14),
	(117, 'El Carmen (La Unión)', 14),
	(118, 'Yayantique', 14),
	(119, 'Bolívar', 14),
	(120, 'Meanguera del Golfo', 14),
	(121, 'Santa Rosa de Lima', 14),
	(122, 'Pasaquina', 14),
	(123, 'Anamoros', 14),
	(124, 'Nueva Esparta', 14),
	(125, 'El Sauce', 14),
	(126, 'Concepción de Oriente', 14),
	(127, 'Polorós', 14),
	(128, 'Lislique', 14),
	(129, 'Antiguo Cuscatlán', 4),
	(130, 'Chiltiupán', 4),
	(131, 'Ciudad Arce', 4),
	(132, 'Colón', 4),
	(133, 'Comasagua', 4),
	(134, 'Huizúcar', 4),
	(135, 'Jayaque', 4),
	(136, 'Jicalapa', 4),
	(137, 'La Libertad', 4),
	(138, 'Santa Tecla', 4),
	(139, 'Nuevo Cuscatlán', 4),
	(140, 'San Juan Opico', 4),
	(141, 'Quezaltepeque', 4),
	(142, 'Sacacoyo', 4),
	(143, 'San José Villanueva', 4),
	(144, 'San Matías', 4),
	(145, 'San Pablo Tacachico', 4),
	(146, 'Talnique', 4),
	(147, 'Tamanique', 4),
	(148, 'Teotepeque', 4),
	(149, 'Tepecoyo', 4),
	(150, 'Zaragoza', 4),
	(151, 'Agua Caliente', 5),
	(152, 'Arcatao', 5),
	(153, 'Azacualpa', 5),
	(154, 'Cancasque', 5),
	(155, 'Chalatenango', 5),
	(156, 'Citalá', 5),
	(157, 'Comapala', 5),
	(158, 'Concepción Quezaltepeque', 5),
	(159, 'Dulce Nombre de María', 5),
	(160, 'El Carrizal', 5),
	(161, 'El Paraíso', 5),
	(162, 'La Laguna', 5),
	(163, 'La Palma', 5),
	(164, 'La Reina', 5),
	(165, 'Las Vueltas', 5),
	(166, 'Nueva Concepción', 5),
	(167, 'Nueva Trinidad', 5),
	(168, 'Nombre de Jesús', 5),
	(169, 'Ojos de Agua', 5),
	(170, 'Potonico', 5),
	(171, 'San Antonio de la Cruz', 5),
	(172, 'San Antonio Los Ranchos', 5),
	(173, 'San Fernando (Chalatenango)', 5),
	(174, 'San Francisco Lempa', 5),
	(175, 'San Francisco Morazán', 5),
	(176, 'San Ignacio', 5),
	(177, 'San Isidro Labrador', 5),
	(178, 'Las Flores', 5),
	(179, 'San Luis del Carmen', 5),
	(180, 'San Miguel de Mercedes', 5),
	(181, 'San Rafael', 5),
	(182, 'Santa Rita', 5),
	(183, 'Tejutla', 5),
	(184, 'Cojutepeque', 7),
	(185, 'Candelaria', 7),
	(186, 'El Carmen (Cuscatlán)', 7),
	(187, 'El Rosario (Cuscatlán)', 7),
	(188, 'Monte San Juan', 7),
	(189, 'Oratorio de Concepción', 7),
	(190, 'San Bartolomé Perulapía', 7),
	(191, 'San Cristóbal', 7),
	(192, 'San José Guayabal', 7),
	(193, 'San Pedro Perulapán', 7),
	(194, 'San Rafael Cedros', 7),
	(195, 'San Ramón', 7),
	(196, 'Santa Cruz Analquito', 7),
	(197, 'Santa Cruz Michapa', 7),
	(198, 'Suchitoto', 7),
	(199, 'Tenancingo', 7),
	(200, 'Aguilares', 6),
	(201, 'Apopa', 6),
	(202, 'Ayutuxtepeque', 6),
	(203, 'Cuscatancingo', 6),
	(204, 'Ciudad Delgado', 6),
	(205, 'El Paisnal', 6),
	(206, 'Guazapa', 6),
	(207, 'Ilopango', 6),
	(208, 'Mejicanos', 6),
	(209, 'Nejapa', 6),
	(210, 'Panchimalco', 6),
	(211, 'Rosario de Mora', 6),
	(212, 'San Marcos', 6),
	(213, 'San Martín', 6),
	(214, 'San Salvador', 6),
	(215, 'Santiago Texacuangos', 6),
	(216, 'Santo Tomás', 6),
	(217, 'Soyapango', 6),
	(218, 'Tonacatepeque', 6),
	(219, 'Zacatecoluca', 8),
	(220, 'Cuyultitán', 8),
	(221, 'El Rosario (La Paz)', 8),
	(222, 'Jerusalén', 8),
	(223, 'Mercedes La Ceiba', 8),
	(224, 'Olocuilta', 8),
	(225, 'Paraíso de Osorio', 8),
	(226, 'San Antonio Masahuat', 8),
	(227, 'San Emigdio', 8),
	(228, 'San Francisco Chinameca', 8),
	(229, 'San Pedro Masahuat', 8),
	(230, 'San Juan Nonualco', 8),
	(231, 'San Juan Talpa', 8),
	(232, 'San Juan Tepezontes', 8),
	(233, 'San Luis La Herradura', 8),
	(234, 'San Luis Talpa', 8),
	(235, 'San Miguel Tepezontes', 8),
	(236, 'San Pedro Nonualco', 8),
	(237, 'San Rafael Obrajuelo', 8),
	(238, 'Santa María Ostuma', 8),
	(239, 'Santiago Nonualco', 8),
	(240, 'Tapalhuaca', 8),
	(241, 'Cinquera', 9),
	(242, 'Dolores', 9),
	(243, 'Guacotecti', 9),
	(244, 'Ilobasco', 9),
	(245, 'Jutiapa', 9),
	(246, 'San Isidro (Cabañas)', 9),
	(247, 'Sensuntepeque', 9),
	(248, 'Tejutepeque', 9),
	(249, 'Victoria', 9),
	(250, 'Apastepeque', 10),
	(251, 'Guadalupe', 10),
	(252, 'San Cayetano Istepeque', 10),
	(253, 'San Esteban Catarina', 10),
	(254, 'San Ildefonso', 10),
	(255, 'San Lorenzo', 10),
	(256, 'San Sebastián', 10),
	(257, 'San Vicente', 10),
	(258, 'Santa Clara', 10),
	(259, 'Santo Domingo', 10),
	(260, 'Tecoluca', 10),
	(261, 'Tepetitán', 10),
	(262, 'Verapaz', 10),
	(263, 'Houston', 57),
	(264, 'Irving', 57),
	(265, 'Dallas', 57),
	(266, 'San Francisco', 19),
	(267, 'Los Angeles', 19),
	(268, 'Pittsburg', 52);

-- Volcando estructura para tabla db_caminata.tbl_ordenes
CREATE TABLE IF NOT EXISTS `tbl_ordenes` (
  `idOrden` int(11) NOT NULL AUTO_INCREMENT,
  `codigoOrden` int(11) NOT NULL,
  `fechaEnvio` date NOT NULL,
  `fechaLlegada` date NOT NULL,
  `emisorOrden` int(11) NOT NULL,
  `receptorOrden` int(11) NOT NULL,
  `tipoPago` varchar(15) NOT NULL,
  `estadoPago` varchar(15) NOT NULL,
  `tipoServicio` varchar(15) NOT NULL,
  `abonoOrden` decimal(9,2) NOT NULL DEFAULT 0.00,
  `otraDireccionOrden` text NOT NULL,
  `destinoOrden` int(11) NOT NULL,
  `observacionesOrden` text NOT NULL,
  `estadoOrden` int(11) NOT NULL DEFAULT 1,
  `creoQR` int(11) NOT NULL DEFAULT 0,
  `gestorOrden` int(11) NOT NULL,
  `empacadaPor` text NOT NULL,
  `creadaOrden` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idOrden`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_ordenes: ~7 rows (aproximadamente)
INSERT INTO `tbl_ordenes` (`idOrden`, `codigoOrden`, `fechaEnvio`, `fechaLlegada`, `emisorOrden`, `receptorOrden`, `tipoPago`, `estadoPago`, `tipoServicio`, `abonoOrden`, `otraDireccionOrden`, `destinoOrden`, `observacionesOrden`, `estadoOrden`, `creoQR`, `gestorOrden`, `empacadaPor`, `creadaOrden`) VALUES
	(7, 1000, '2025-04-01', '2025-04-05', 2, 9, 'Efectivo', 'Pagado', 'Entrega', 0.00, '', 3, 'N/A', 1, 0, 0, '', '2025-03-27 17:38:22'),
	(8, 1001, '2025-03-31', '2025-03-31', 9, 1, 'Efectivo', 'Pagado', 'Entrega', 0.00, '', 1, 'N/A', 1, 0, 0, '', '2025-03-31 20:53:46'),
	(9, 1002, '2025-04-03', '2025-04-03', 1, 7, 'Efectivo', 'Pagado', 'Entrega', 0.00, '', 1, 'N/A', 1, 0, 0, '', '2025-04-03 20:12:22'),
	(10, 1003, '2025-04-05', '2025-04-15', 1, 9, 'Efectivo', 'Pagado', 'Entrega', 0.00, '', 5, 'Tratar con cuidado', 1, 0, 0, '', '2025-04-03 20:17:36'),
	(11, 1004, '2025-04-09', '2025-04-09', 1, 8, 'Efectivo', 'Por pagar', 'Entrega', 15.00, '', 6, 'Ninguna', 1, 0, 0, '', '2025-04-09 21:22:31'),
	(12, 1005, '2025-04-17', '2025-04-17', 1, 3, 'Efectivo', 'Pagado', 'Entrega', 0.00, '', 2, 'N/A', 1, 0, 0, '', '2025-04-17 19:42:11'),
	(13, 1006, '2025-04-17', '2025-04-17', 4, 7, 'Efectivo', 'Pagado', 'Entrega', 0.00, '', 1, '', 1, 0, 0, 'Edwin Cortez', '2025-04-17 19:48:10');

-- Volcando estructura para tabla db_caminata.tbl_orden_qr
CREATE TABLE IF NOT EXISTS `tbl_orden_qr` (
  `idOrdenQr` int(11) NOT NULL AUTO_INCREMENT,
  `idOrden` int(11) NOT NULL,
  `nombreQr` text NOT NULL,
  `creadoQr` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idOrdenQr`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla db_caminata.tbl_orden_qr: ~4 rows (aproximadamente)
INSERT INTO `tbl_orden_qr` (`idOrdenQr`, `idOrden`, `nombreQr`, `creadoQr`) VALUES
	(14, 1, '1000-1', '2023-05-14 23:10:28'),
	(15, 1, '1000-2', '2023-05-14 23:10:28'),
	(16, 1, '1000-3', '2023-05-14 23:10:28'),
	(17, 1, '1000-4', '2023-05-14 23:10:28');

-- Volcando estructura para tabla db_caminata.tbl_pais
CREATE TABLE IF NOT EXISTS `tbl_pais` (
  `idPais` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePais` text NOT NULL,
  `estadoPais` int(11) NOT NULL DEFAULT 1,
  `creadoPais` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_pais: ~2 rows (aproximadamente)
INSERT INTO `tbl_pais` (`idPais`, `nombrePais`, `estadoPais`, `creadoPais`) VALUES
	(1, 'El Salvador', 1, '2025-03-26 16:32:17'),
	(2, 'Estados Unidos', 1, '2025-03-26 16:32:17');

-- Volcando estructura para tabla db_caminata.tbl_permisos
CREATE TABLE IF NOT EXISTS `tbl_permisos` (
  `idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `idMenu` int(11) NOT NULL,
  `idAcceso` int(11) NOT NULL,
  `estadoPermiso` int(11) NOT NULL,
  `fechaPermiso` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_permisos: ~109 rows (aproximadamente)
INSERT INTO `tbl_permisos` (`idPermiso`, `idMenu`, `idAcceso`, `estadoPermiso`, `fechaPermiso`) VALUES
	(1, 1, 1, 1, '2021-04-29 19:41:05'),
	(2, 3, 1, 1, '2021-04-29 19:41:05'),
	(3, 2, 1, 1, '2021-04-29 21:13:09'),
	(4, 4, 1, 1, '2021-04-30 18:48:46'),
	(5, 5, 1, 1, '2021-04-30 18:48:46'),
	(6, 6, 1, 1, '2021-04-30 18:48:46'),
	(7, 7, 1, 1, '2021-04-30 18:48:46'),
	(8, 8, 1, 1, '2021-04-30 18:48:47'),
	(9, 9, 1, 1, '2021-04-30 18:48:47'),
	(10, 10, 1, 1, '2021-04-30 18:48:47'),
	(11, 3, 3, 1, '2021-05-03 17:17:51'),
	(12, 2, 3, 1, '2021-05-03 18:31:34'),
	(13, 1, 3, 1, '2021-05-03 18:41:32'),
	(14, 11, 1, 1, '2021-05-18 16:29:19'),
	(15, 1, 4, 1, '2021-06-15 15:40:40'),
	(16, 2, 4, 1, '2021-06-15 15:40:40'),
	(17, 3, 4, 1, '2021-06-15 15:40:40'),
	(18, 4, 4, 1, '2021-06-15 15:40:40'),
	(19, 5, 4, 1, '2021-06-15 15:40:40'),
	(20, 8, 4, 1, '2021-06-15 15:40:40'),
	(21, 4, 3, 1, '2021-06-15 15:43:17'),
	(22, 2, 2, 1, '2021-06-24 16:25:36'),
	(23, 4, 2, 1, '2021-06-24 16:25:36'),
	(24, 6, 2, 1, '2021-06-24 16:25:56'),
	(25, 6, 4, 1, '2021-06-24 16:39:55'),
	(26, 6, 3, 1, '2021-06-24 16:41:25'),
	(27, 2, 5, 1, '2021-06-29 13:00:56'),
	(28, 5, 5, 1, '2021-06-29 13:00:56'),
	(29, 9, 5, 1, '2021-06-29 13:00:56'),
	(30, 11, 5, 1, '2021-06-29 13:00:56'),
	(31, 1, 2, 1, '2021-06-29 13:15:02'),
	(32, 12, 1, 1, '2021-06-30 13:55:15'),
	(33, 1, 7, 1, '2021-07-01 12:17:54'),
	(34, 2, 7, 1, '2021-07-01 12:17:54'),
	(35, 9, 4, 1, '2021-07-01 14:01:07'),
	(36, 1, 5, 1, '2021-07-02 19:40:22'),
	(37, 6, 5, 1, '2021-07-02 19:40:22'),
	(38, 12, 3, 1, '2021-07-05 13:13:27'),
	(39, 1, 9, 1, '2021-07-16 15:37:23'),
	(40, 2, 9, 1, '2021-07-16 15:37:23'),
	(41, 3, 9, 1, '2021-07-16 15:37:24'),
	(42, 4, 9, 1, '2021-07-16 15:37:24'),
	(43, 5, 9, 1, '2021-07-16 15:37:24'),
	(44, 6, 9, 1, '2021-07-16 15:37:24'),
	(45, 7, 9, 1, '2021-07-16 15:37:24'),
	(46, 8, 9, 1, '2021-07-16 15:37:24'),
	(47, 9, 9, 1, '2021-07-16 15:37:24'),
	(48, 13, 1, 1, '2021-09-25 15:32:19'),
	(49, 13, 7, 1, '2021-09-27 13:38:40'),
	(50, 1, 8, 1, '2021-10-23 16:50:40'),
	(51, 2, 8, 1, '2021-10-23 16:50:40'),
	(52, 4, 8, 1, '2021-10-23 16:50:40'),
	(53, 6, 8, 1, '2021-10-23 16:50:40'),
	(54, 14, 1, 1, '2021-11-23 22:08:18'),
	(55, 14, 5, 1, '2021-11-24 13:14:23'),
	(56, 14, 4, 1, '2021-11-26 15:45:12'),
	(57, 1, 10, 1, '2021-12-04 14:30:21'),
	(58, 2, 10, 1, '2021-12-04 14:30:22'),
	(59, 4, 10, 1, '2021-12-04 14:30:22'),
	(60, 15, 10, 1, '2021-12-04 14:30:22'),
	(61, 6, 10, 1, '2021-12-04 14:31:34'),
	(62, 15, 2, 0, '2021-12-13 17:19:15'),
	(63, 16, 1, 1, '2021-12-17 14:25:16'),
	(64, 16, 10, 1, '2021-12-17 16:17:48'),
	(65, 16, 2, 1, '2021-12-17 21:34:02'),
	(66, 16, 9, 1, '2021-12-20 14:17:01'),
	(67, 14, 10, 1, '2021-12-30 15:52:38'),
	(68, 1, 11, 1, '2022-01-07 20:56:19'),
	(69, 2, 11, 1, '2022-01-07 20:56:19'),
	(70, 3, 11, 1, '2022-01-07 20:56:19'),
	(71, 4, 11, 1, '2022-01-07 20:56:19'),
	(72, 6, 11, 1, '2022-01-07 20:56:19'),
	(73, 17, 12, 1, '2022-01-10 14:52:07'),
	(74, 16, 5, 1, '2022-01-24 15:42:19'),
	(75, 1, 13, 1, '2022-02-01 13:58:12'),
	(76, 2, 13, 1, '2022-02-01 13:58:12'),
	(77, 6, 13, 1, '2022-02-01 13:58:13'),
	(78, 18, 1, 1, '2022-02-14 14:02:59'),
	(79, 18, 11, 0, '2022-02-14 14:04:01'),
	(80, 18, 3, 1, '2022-02-14 14:04:35'),
	(81, 18, 8, 1, '2022-02-14 14:04:49'),
	(82, 18, 4, 1, '2022-02-14 14:05:01'),
	(83, 18, 2, 1, '2022-02-14 14:05:14'),
	(84, 18, 10, 1, '2022-02-14 14:05:30'),
	(85, 12, 11, 0, '2022-02-16 14:53:27'),
	(86, 19, 13, 1, '2022-02-21 13:37:59'),
	(87, 19, 1, 1, '2022-02-21 13:40:14'),
	(88, 8, 11, 1, '2022-02-24 17:47:25'),
	(89, 3, 5, 1, '2022-04-26 20:21:38'),
	(90, 20, 3, 1, '2022-04-26 20:40:15'),
	(91, 20, 1, 1, '2022-04-26 20:40:35'),
	(92, 20, 11, 1, '2022-04-27 14:22:43'),
	(93, 21, 7, 1, '2022-07-13 12:50:06'),
	(94, 21, 1, 1, '2022-07-16 13:10:25'),
	(95, 18, 15, 1, '2022-08-01 14:09:44'),
	(96, 22, 1, 1, '2022-08-30 15:08:15'),
	(97, 23, 5, 1, '2022-09-26 13:54:31'),
	(98, 23, 1, 1, '2022-09-26 13:57:32'),
	(99, 18, 13, 1, '2022-10-20 14:31:45'),
	(100, 21, 16, 1, '2023-02-02 14:17:38'),
	(101, 22, 16, 1, '2023-02-02 14:17:38'),
	(102, 23, 16, 1, '2023-02-02 14:17:39'),
	(103, 24, 1, 1, '2023-02-27 14:35:19'),
	(104, 24, 4, 1, '2023-02-27 14:40:04'),
	(105, 15, 1, 1, '2023-04-08 23:37:11'),
	(106, 17, 1, 1, '2023-04-08 23:38:18'),
	(107, 1, 19, 1, '2023-04-08 23:47:11'),
	(108, 2, 19, 1, '2023-04-08 23:47:11'),
	(109, 3, 19, 1, '2023-04-08 23:47:11');

-- Volcando estructura para tabla db_caminata.tbl_receptores
CREATE TABLE IF NOT EXISTS `tbl_receptores` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `codigoCliente` int(11) NOT NULL,
  `nombreCliente` text NOT NULL,
  `documentoCliente` varchar(15) NOT NULL,
  `telefonoCliente` varchar(15) NOT NULL,
  `correoCliente` text NOT NULL,
  `paisCliente` int(11) NOT NULL,
  `distritoCliente` int(11) NOT NULL,
  `direccionCliente` text NOT NULL,
  `municipioCliente` text NOT NULL,
  `strPais` text NOT NULL,
  `strEstado` text NOT NULL,
  `strMunicipio` text NOT NULL,
  `pivoteEmisor` int(11) NOT NULL,
  `estadoCliente` int(11) NOT NULL DEFAULT 1,
  `creadoCliente` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_caminata.tbl_receptores: ~10 rows (aproximadamente)
INSERT INTO `tbl_receptores` (`idCliente`, `codigoCliente`, `nombreCliente`, `documentoCliente`, `telefonoCliente`, `correoCliente`, `paisCliente`, `distritoCliente`, `direccionCliente`, `municipioCliente`, `strPais`, `strEstado`, `strMunicipio`, `pivoteEmisor`, `estadoCliente`, `creadoCliente`) VALUES
	(1, 1000, 'Juan Antonio-Campos Sanchez', '47856946', '78956236', '-', 1, 13, 'Barrio el Calvario', '67', '1- El Salvador', '13- San Miguel ', '67-Chinameca', 1, 1, '2023-03-20 23:08:03'),
	(2, 1001, 'Flor de Maria-Fuentes Saravia', '56987456', '78956321', '-', 1, 1, 'Barrio el calvario', '2', '1- El Salvador', '1-Ahuachapán', '2-Jujutla', 2, 1, '2023-03-20 23:08:40'),
	(3, 1002, 'Carmen del Cid-Medrano', '05123698', '74569812', '-', 1, 3, 'El centro, Usulutan', '', '1- El Salvador', '3-Sonsonate', '', 3, 1, '2023-03-21 04:04:33'),
	(4, 1003, 'Marcos Antonio-Carcamo', '102653489', '23659685', '-', 2, 52, '123 Main Street', '268', '2- Estados Unidos', '52- Pensilvania ', '268-Pittsburg', 4, 1, '2025-03-22 16:52:49'),
	(5, 1004, '', '', '', '', 0, 0, '', '', '', '', '', 5, 0, '2025-03-26 16:52:57'),
	(6, 1005, '', '', '', '', 0, 0, '', '', '', '', '', 6, 0, '2025-03-26 16:55:21'),
	(7, 1006, 'Francisco Adalberto-Campos', '123456', '26359874', 'example@example.com', 1, 11, 'Colonia La Pradera', '61', '1-El Salvador', '11-Usulután', '61-Santa María', 7, 1, '2025-03-26 19:47:06'),
	(8, 1007, 'Marcos Antonio-Maldonado', '987456321', '23659874', 'example@example.com', 1, 12, 'Colonia La Pradera', '', '1-El Salvador', '12-San Miguel', '', 8, 1, '2025-03-26 22:08:06'),
	(9, 1008, 'Felipe Alonso-Campos', '456321', '6398-5698', 'example@example.com', 2, 57, '1200  HOLLY HILL DR GRAND PRAIRIE', '264', '2- Estados Unidos', '57- Texas ', '264-Irving', 9, 1, '2025-03-27 14:43:05'),
	(10, 1009, 'Juan Adalberto-Valdez Parada', '963265987', '7546-8956', '-', 1, 11, 'Barrio la parroquia', '51', '1-El Salvador', '11-Usulután', '51-Jucuarán', 10, 1, '2025-04-08 17:20:18');

-- Volcando estructura para tabla db_caminata.tbl_usuarios
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(50) NOT NULL,
  `psUsuario` varchar(50) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idAcceso` int(11) NOT NULL,
  `estadoUsuario` int(11) NOT NULL DEFAULT 1,
  `codigoVerificacion` varchar(50) NOT NULL,
  `pivoteUsuario` int(11) NOT NULL DEFAULT 0,
  `nivelUsuario` int(11) NOT NULL DEFAULT 0,
  `fechaUsuario` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla db_caminata.tbl_usuarios: ~1 rows (aproximadamente)
INSERT INTO `tbl_usuarios` (`idUsuario`, `nombreUsuario`, `psUsuario`, `idEmpleado`, `idAcceso`, `estadoUsuario`, `codigoVerificacion`, `pivoteUsuario`, `nivelUsuario`, `fechaUsuario`) VALUES
	(1, 'Informatica', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 1, '', 0, 0, '2025-04-11 17:29:13');

-- Volcando estructura para disparador db_caminata.tbl_emisores_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tbl_emisores_after_delete` AFTER DELETE ON `tbl_emisores` FOR EACH ROW BEGIN
	UPDATE tbl_receptores AS r SET r.estadoCliente = '0'
	WHERE r.pivoteEmisor = OLD.idCliente;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador db_caminata.tbl_ordenes_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tbl_ordenes_after_insert` AFTER INSERT ON `tbl_ordenes` FOR EACH ROW BEGIN
	INSERT INTO tbl_detalle_orden(idOrden) VALUES(NEW.idOrden);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
