SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `cda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

ALTER DATABASE `cda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cda`;

/*---------------------------------------------------------------------------*/


	DROP TABLE IF EXISTS `usuarios`;
	CREATE TABLE IF NOT EXISTS `usuarios` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `usuario` varchar(25) NOT NULL,
	  `clave` varchar(16) NOT NULL,
	  `rango` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=INNODB  DEFAULT CHARSET=utf8mb4;

	DROP TABLE IF EXISTS `productos`;
	CREATE TABLE IF NOT EXISTS `productos` (
	  `codigo_producto` int(11) NOT NULL AUTO_INCREMENT,
	  `nombre_producto` varchar(100) NOT NULL,
	  `tipo_producto` varchar(100) NOT NULL,
	  `marca_producto` varchar(100) NOT NULL,
	  `modelo_producto` varchar(100) NOT NULL,
	  `precio_venta` decimal(17,2) NOT NULL,
	  `existencias` int(11) NOT NULL,
	  PRIMARY KEY (`codigo_producto`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	DROP TABLE IF EXISTS `clientes`;
	CREATE TABLE IF NOT EXISTS `clientes` (
	  `nombre_cliente` varchar(20) NOT NULL,
	  `apellido_cliente` varchar(20) NOT NULL,
	  `ci_cliente` varchar(12) NOT NULL,
	  `direccion_cliente` varchar(100) NOT NULL,
	  `telefono` varchar(15) NOT NULL,
	  PRIMARY KEY (`ci_cliente`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;


	DROP TABLE IF EXISTS `proveedores`;
	CREATE TABLE IF NOT EXISTS `proveedores` (
	  `nombre_empresa` varchar(100) NOT NULL,
	  `telefono` varchar(15) NOT NULL,
	  `direccion` varchar(100) NOT NULL,
	  `rif` varchar(20) NOT NULL,
	  PRIMARY KEY (`rif`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	DROP TABLE IF EXISTS `facturacion`;
	CREATE TABLE IF NOT EXISTS `facturacion` (
	  `codigo_factura` int(11) NOT NULL AUTO_INCREMENT,
	  `fecha_venta` datetime NOT NULL,
	  `ci_cliente` varchar(12),
	  `subtotal` decimal(17,2) NOT NULL,
	  `iva` decimal(17,2) NOT NULL,
	  `total` decimal(17,2) NOT NULL,
	  PRIMARY KEY (`codigo_factura`),
	  KEY `ci_cliente` (`ci_cliente`),
	  FOREIGN KEY (`ci_cliente`)
	  REFERENCES `clientes`(`ci_cliente`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	DROP TABLE IF EXISTS `pedidos`;
	CREATE TABLE IF NOT EXISTS `pedidos` (
	  `codigo_pedido` int(11) NOT NULL AUTO_INCREMENT,
	  `codigo_proveedor` varchar(20),
	  `fecha` datetime NOT NULL,
	  `fecha_llegada` datetime NOT NULL,
	  `subtotal` decimal(17,2) NOT NULL,
	  PRIMARY KEY (`codigo_pedido`),
	  KEY `codigo_proveedor` (`codigo_proveedor`),
	  FOREIGN KEY (`codigo_proveedor`)
	  REFERENCES `proveedores`(`rif`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	DROP TABLE IF EXISTS `detalles_facturacion`;
	CREATE TABLE IF NOT EXISTS `detalles_facturacion` (
	  `codigo_factura` int(11),
	  `codigo_producto` int(11),
	  `cantidad` int(11) NOT NULL,
	  `subtotal` decimal(17,2) NOT NULL,
	  KEY `codigo_producto` (`codigo_producto`),
	  KEY `codigo_factura` (`codigo_factura`),
	  FOREIGN KEY (`codigo_producto`)
	  REFERENCES `productos`(`codigo_producto`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE,
	  FOREIGN KEY (`codigo_factura`)
	  REFERENCES `facturacion`(`codigo_factura`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

	DROP TABLE IF EXISTS `detalles_pedido`;
	CREATE TABLE IF NOT EXISTS `detalles_pedido` (
	  `codigo_pedido` int(11),
	  `codigo_producto` int(11),
	  `precio_compra` decimal(17,2) NOT NULL,
	  `cantidad` int(11) NOT NULL,
	  `subtotal` decimal(17,2) NOT NULL,
	  KEY `codigo_producto` (`codigo_producto`),
	  KEY `codigo_pedido` (`codigo_pedido`),
	  FOREIGN KEY (`codigo_producto`)
	  REFERENCES `productos`(`codigo_producto`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE,
	  FOREIGN KEY (`codigo_pedido`)
	  REFERENCES `pedidos`(`codigo_pedido`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;
/*---------------------------------------------------------------------------*/
/*
ALTER TABLE `detalles_pedido`
  ADD FOREIGN KEY (`codigo_producto`)
  REFERENCES `productos`(`codigo_producto`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
  ;

ALTER TABLE `detalles_pedido`
  ADD FOREIGN KEY (`codigo_pedido`)
  REFERENCES `pedidos`(`codigo_pedido`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
  ;

ALTER TABLE `detalles_facturacion`
  ADD FOREIGN KEY (`codigo_producto`)
  REFERENCES `productos`(`codigo_producto`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
  ;

ALTER TABLE `detalles_facturacion`
  ADD FOREIGN KEY (`codigo_factura`)
  REFERENCES `facturacion`(`codigo_factura`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
  ;

ALTER TABLE `pedidos`
  ADD FOREIGN KEY (`codigo_proveedor`)
  REFERENCES `proveedores`(`rif`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
  ;

ALTER TABLE `facturacion`
  ADD FOREIGN KEY (`ci_cliente`)
  REFERENCES `clientes`(`ci_cliente`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
  ;
*/
INSERT INTO `usuarios` (`usuario`, `clave`, `rango`) VALUES
('ADMIN', '', 1),
('OPERADOR', '', 2),
('VENDEDOR', '', 3)
;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
