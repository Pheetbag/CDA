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


CREATE TABLE `clientes` (
  `nombre_cliente` varchar(20) NOT NULL,
  `apellido_cliente` varchar(20) NOT NULL,
  `ci_cliente` varchar(12) NOT NULL,
  `direccion_cliente` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `detalles_facturacion` (
  `codigo_factura` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` DECIMAL(15,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `detalles_pedido` (
  `codigo_pedido` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `precio_compra` DECIMAL(15,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` DECIMAL(15,2) NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `facturacion` (
  `codigo_factura` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `ci_cliente` varchar(12) NOT NULL,
  `subtotal` DECIMAL(15,2) NOT NULL,
  `iva` DECIMAL(15,2) NOT NULL,
  `total` DECIMAL(15,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `pedidos` (
  `codigo_pedido` varchar(20) NOT NULL,
  `codigo_proveedor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_llegada` date NOT NULL,
  `subtotal` DECIMAL(15,2) NOT NULL,
  `iva` DECIMAL(15,2) NOT NULL,
  `total` DECIMAL(15,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `productos` (
  `codigo_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `tipo_producto` varchar(100) NOT NULL,
  `marca_producto` varchar(100) NOT NULL,
  `modelo_producto` varchar(100) NOT NULL,
  `precio_venta` DECIMAL(15,2) NOT NULL,
  `existencias` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `proveedores` (
  `nombre_empresa` varchar(100) NOT NULL,
  `codigo_proveedor` int(11) NOT NULL,
  `telefono` int(15) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `rif` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `clave` varchar(16) NOT NULL,
  `rango` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ci_cliente`);

ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`codigo_factura`);

ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codigo_pedido`);

ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo_producto`);

ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`codigo_proveedor`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

/*---------------------------------------------------------------------------*/

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
  REFERENCES `proveedores`(`codigo_proveedor`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
  ;

ALTER TABLE `facturacion`
  ADD FOREIGN KEY (`ci_cliente`)
  REFERENCES `clientes`(`ci_cliente`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
  ;

  /*-------------------------------------------------------------------------*/


ALTER TABLE `facturacion`
  MODIFY `codigo_factura` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pedidos`
  MODIFY `codigo_pedido` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `productos`
  MODIFY `codigo_producto` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `proveedores`
  MODIFY `codigo_proveedor` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `usuarios`(`usuario`, `clave`, `rango`)
VALUES ('administrador','',1);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
